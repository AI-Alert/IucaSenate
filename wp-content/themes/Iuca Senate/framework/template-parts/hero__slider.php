<?php

$arResult = [
    'slides' => $args['slides'],
    'member-image' => [
        'link' => wp_get_original_image_url(carbon_get_theme_option( 'member_image' )),
        'alt' => get_post_meta(carbon_get_theme_option( 'member_image' ), '_wp_attachment_image_alt', TRUE),
    ],
    'member-link' => carbon_get_theme_option( 'member_link' )
];

?>


<div class="hero">
    <div class="hero-block">
        <?php foreach($arResult['slides'] as $item): ?>
        <div class="hero-slide">
            <div class="container">
                <div class="hero__info">
                    <<?= $item['title_state']; ?> class="hero__title"><?= $item['title_bold']; ?></<?= $item['title_state']; ?>>
                    <div class="hero__subtitle"><?=  $item['title']; ?></div>
                    <a class="btn btn--dark hero__btn" data-href="<?= $item['btn_link']; ?>"><?= $item['btn_text']; ?></a>
                </div>
            </div>
            <div class="container hero-image__container">
                <div class="hero-image lazyload" style="background-image: url(<?= wp_get_attachment_image_url($item['image'], 'blur'); ?>);" data-src="<?= wp_get_attachment_image_url($item['image'], 'banner'); ?>"></div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <div class="container">
        <div class="hero__slider-arrows">
            <button class="hero__back"><img src="<?= _assets(); ?>/img/arrow-left.svg" alt="Alt" class="svg"></button>
            <span class="hero__count"><strong>1</strong>/<small>4</small></span>
            <button class="hero__next"><img src="<?= _assets(); ?>/img/arrow-right.svg" alt="Alt" class="svg"></button>
        </div>
    </div>

    <a rel="nofollow, noindex" href="<?= $arResult['member-link']; ?>" class="hero__link" target="_blank"><img src="<?= $arResult['member-image']['link']; ?>" alt="<?= $arResult['member-image']['alt']; ?>"></a>
</div>
