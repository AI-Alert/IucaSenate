<?php

$arResult = [
	'type_banner' => $args['type_banner'],
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'caption' => apply_filters( 'the_content', $args['content'] ),
    'image' => wp_get_attachment_image_url($args['image'], 'url'),
    'button' => $args['button']
];

?>

<div class="section cta">
    <div class="container">
        <div class="cta-block <?php if($args['type_banner'] == 'full') echo 'cta-block--full'; ?>" style="background-image: url('<?= $arResult['image'] ?>');">
            <div class="cta__info">
                <<?= $arResult['title']['state']; ?> class="section-title cta__title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>
                <div class="cta__subtitle format-text">
                        <?= $arResult['caption']; ?>
                </div>
                <?php 
                //var_dump($arResult['button']);
                    if(isset($arResult['button'][0])):
                        $link = $arResult['button'][0]['link'];
                        $text = $arResult['button'][0]['text'];
                ?>
                
                <a rel="nofollow" target="_blank" href="<?= $link; ?>" class="btn cta__btn">
                    <?= $text; ?>
                </a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>