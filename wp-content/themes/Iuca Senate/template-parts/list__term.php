<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'],
        'text' => $args['title_text'],
    ],
    'content' => applY_filters('the_content', $args['content']),
    'list' => $args['list']
];

?>



<div class="section section--dark brands">
    <div class="container">
        <?php if($arResult['title']['text']): ?>
        <<?= $arResult['title']['state']; ?> class="section-title">
            <?= $arResult['title']['text']; ?>
        </<?= $arResult['title']['state']; ?>>
        <?php endif; ?>
        <?php if($arResult['content']): ?>
        <div class="section-info format-text">
            <?= $arResult['content'] ?>
        </div>
        <?php endif; ?>

        <div class="brands-block">
            <?php foreach($arResult['list'] as $item): 

                $image = [
                    'middle' => wp_get_attachment_image_url( carbon_get_term_meta( $item['id'], 'front_image' ), 'middle'),
                    'blur' => wp_get_attachment_image_url( carbon_get_term_meta( $item['id'], 'front_image' ), 'blur'),
                    'alt' => get_post_meta( carbon_get_term_meta( $item['id'], 'front_image' ), '_wp_attachment_image_alt', TRUE), 
                ];

                $anons = carbon_get_term_meta( $item['id'], 'front_anons' );

                $brand_image = [
                    'middle' => wp_get_attachment_image_url( carbon_get_term_meta( $item['id'], 'brand_image' ), 'middle'),
                    'blur' => wp_get_attachment_image_url( carbon_get_term_meta( $item['id'], 'brand_image' ), 'blur'),
                    'alt' => get_post_meta( carbon_get_term_meta( $item['id'], 'brand_image' ), '_wp_attachment_image_alt', TRUE), 
                ];

                $link = get_category_link( $item['id'] );
               
               ?>

            <a href="<?= $link ?>" class="brand">
                <span class="brand__front">
                    <span class="brand__photo">
                        <img src="<?= $image['blur'] ?>" data-src="<?= $image['middle'] ?>" class="lazyload" alt="<?= $image['alt'] ?>">
                    </span>
                    <span class="brand__title">
                        <?= get_cat_name($item['id']); ?>
                    </span>
                    <span class="brand__link"><img src="<?= _assets(); ?>/img/next.svg" alt="Подробнее" class="svg"></span>
                </span>
                <span class="brand__back">
                    <?php if($brand_image['middle']): ?>
                    <span class="brand__logo">
                        <img src="<?= $brand_image['blur'] ?>" data-src="<?= $brand_image['middle'] ?>" class="lazyload" alt="<?= $brand_image['alt'] ?>">
                    </span>
                    <?php endif; ?>
                    <?php if($anons): ?>
                    <span class="brand__text format-text">
                        <?= $anons; ?>
                    </span>
                    <?php endif; ?>
                    <span class="brand__link"><img src="<?= _assets(); ?>/img/next.svg" alt="Подробнее" class="svg"></span>
                </span>
            </a> 
            
            <?php endforeach; ?>

        </div>
    </div>
</div>

