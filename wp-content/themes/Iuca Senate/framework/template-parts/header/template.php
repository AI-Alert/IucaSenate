<?php

// Массив данных шапки сайта

$arResult = [
    'logo' => [
        'first' => [
            'link' => wp_get_attachment_image_url(carbon_get_theme_option( 'header_logo_first' ), 'full'),
            'alt' => get_post_meta(carbon_get_theme_option( 'header_logo_first' ), '_wp_attachment_image_alt', TRUE),
        ],
        'second' => [
            'link' => wp_get_attachment_image_url(carbon_get_theme_option( 'header_logo_second' ), 'full'),
            'alt' => get_post_meta(carbon_get_theme_option( 'header_logo_second' ), '_wp_attachment_image_alt', TRUE),
        ],
    ], 
    'desc' => carbon_get_theme_option( 'header_description' ),
    'phones' => carbon_get_theme_option( 'header_phones' ),    
    'mobile' => carbon_get_theme_option( 'header_mobile_phone'  ),
    'mails' => carbon_get_theme_option( 'header_mails' ),
    'social' => carbon_get_theme_option( 'header_list_social' ),    
    'button' => [
        'link' => carbon_get_theme_option( 'header_link' ),
        'text' => carbon_get_theme_option( 'header_link_text' ),
    ],  
    'address' => carbon_get_theme_option( 'header_address' ),
    'hours' => carbon_get_theme_option( 'header_hours' ),
];

?>





<!-- Функция для смещения header -->
<?php if(is_user_logged_in()) echo 'style="margin-top:32px;"' ?>


<!-- Некликабельное лого на главной странице -->
<?php if(!is_front_page()): ?>
    Кликабельное
<?php else: ?>
    Некликабельное
<?php endif; ?>



<!-- Лого основное -->
<img src="<?= $arResult['logo']['first']['link']; ?>" alt="<?= $arResult['logo']['first']['alt']; ?>">



<!-- Лого дополнительное -->
<img src="<?= $arResult['logo']['second']['link']; ?>" alt="<?= $arResult['logo']['second']['alt']; ?>">



<!-- Слоган -->
<?= $arResult['desc']; ?>



<!-- Вывод телефонов -->
<?php if($arResult['phones']): ?>
    <?php foreach ($arResult['phones'] as $item):
            $link = preg_replace( array( '/\s/', '/\(/', '/\)/', '/-/' ), '', $item['phone'] );
            $text = $item['phone'];
    ?>
        <a href="tel:<?= $link; ?>" ><?= $text; ?></a>

    <?php endforeach; ?>
<?php endif; ?>



<!-- Вывод телефона для мобильной версии -->
<?php if($arResult['mobile']): 
        $link = preg_replace( array( '/\s/', '/\(/', '/\)/', '/-/' ), '', $arResult['mobile'] );
?>
    <a href="tel:<?= $link ?>">
        Телефон для мобильной версии
    </a>

<?php endif; ?>



<!-- Вывод электронной почты -->
<?php if($arResult['mails']): ?>

    <?php foreach ($arResult['mails'] as $item):
            $text = $item['mail'];
    ?>

        <a href="tel:<?= $text; ?>" ><?= $text; ?></a>

    <?php endforeach; ?>

<?php endif; ?>



<!-- Вывод социальных сетей -->
<?php if($arResult['social']): ?>

    <?php foreach ($arResult['social'] as $item): 
            $image = wp_get_attachment_image_url($item['header_icon_social'], 'full');
            $alt = get_post_meta($item['header_icon_social'], '_wp_attachment_image_alt', TRUE);
            $link = $item['header_link_social'];
        ?>

        <a href="<?= $link ?>" target="_blank" rel="nofollow">
            <img src="<?= $image ?>" alt="<?= $alt ?>">
        </a>

    <?php endforeach; ?>

<?php endif; ?>



<!-- Вывод кнопки для отправки заявок -->
<?php if($arResult['button']['text']): ?>

    <button data-href="<?= $arResult['button']['link']; ?>">

        <?= $arResult['button']['text']; ?>

    </button>

<?php endif; ?>



<!-- Вывод адреса -->
<?php if($arResult['address']): ?>  

       <?= $arResult['address']; ?> 

<?php endif; ?>



<!-- Вывод времени работы -->
<?php if($arResult['hours']): ?>
           
           <?= $arResult['hours']; ?>

<?php endif; ?>


