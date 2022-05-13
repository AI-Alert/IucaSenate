<?php
// Подключение к БД.
$pwd = passward;
$login = login;
$dbh = new PDO('mysql:dbname=db_name;host=localhost', '$login', '$pwd');

$dirs = array(
    __DIR__ . '/themes',
    __DIR__ . '/uploads',
);

$exts = array('png', 'jpg', 'jpeg');


$api_key = '54271824959019231';

function glob_recursive($pattern, $flags = 0)
{
    $files = glob($pattern, $flags);
    foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        $files = array_merge($files, glob_recursive($dir . '/' . basename($pattern), $flags));
    }
    return $files;
}

$sth = $dbh->prepare("SELECT * FROM `optimize_img` WHERE `done` = 0 AND `error` = '' ORDER BY `id` DESC");
$sth->execute();
$item = $sth->fetch(PDO::FETCH_ASSOC);

if (empty($item)) {
    foreach ($dirs as $dir) {
        foreach (glob_recursive($dir . '/*.*') as $file) {
            $ext = strtolower(substr(strrchr($file, '.'), 1));
            if (in_array($ext, $exts)) {
                $file = str_replace(__DIR__, '', $file);
                $sth = $dbh->prepare("SELECT * FROM `optimize_img` WHERE `img` = ?");
                $sth->execute(array($file));
                $isdb = $sth->fetch(PDO::FETCH_ASSOC);
                if (empty($isdb)) {
                    $sth = $dbh->prepare("INSERT INTO `optimize_img` SET `img` = ?");
                    $sth->execute(array($file));
                }
            }
        }
    }
} elseif (!is_file(__DIR__ . $item['img'])) {
    $sth = $dbh->prepare("DELETE FROM `optimize_img` WHERE `id` = ?");
    $sth->execute(array($item['id']));
} else {
    $ch = curl_init('https://api.tinify.com/shrink');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERPWD, ':' . $api_key);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        json_encode(
            array(
                'source' => array(
                    'url' => 'http://example.com' . str_replace('%2F', '/', rawurlencode($item['img']))
                )
            )
        )
    );

    $res = curl_exec($ch);
    curl_close($ch);

    $res = json_decode($res, JSON_OBJECT_AS_ARRAY);

    if (!empty($res['error'])) {
        $sth = $dbh->prepare("UPDATE `optimize_img` SET `error` = ? WHERE `id` = ?");
        $sth->execute(array($res['message'], $item['id']));
    } elseif (!empty($res['output']['url'])) {
        $file = __DIR__ . $item['img'];

        if (rename($file, $file . '.bak')) {
            if (copy($res['output']['url'], $file)) {
                $diff = $res['input']['size'] - $res['output']['size'];

                $sth = $dbh->prepare("UPDATE `optimize_img` SET `done` = 1, `diff` = ? WHERE `id` = ?");
                $sth->execute(array($diff, $item['id']));
                exit;
            } else {
                rename($file . '.bak', $file);
            }
        }

        $sth = $dbh->prepare("UPDATE `optimize_img` SET `error` = ? WHERE `id` = ?");
        $sth->execute(array('Ошибка замены файла', $item['id']));
    }
}