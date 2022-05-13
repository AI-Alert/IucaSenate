<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'caption' => apply_filters( 'the_content', $args['content'] ),
    'post_list' => $args['links']
];

?>


<div class="section products">
    <div class="container">
        <<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>
        <div class="section-info format-text">
            <?= $arResult['caption']; ?>
        </div>
        <div class="products-grid">
            <?php 
            
            foreach($arResult['post_list'] as $id): $id = $id['id']; ?>

            <a href="<?= get_permalink( $id ); ?>" class="product lazyload" style="background-image: url('<?= get_the_post_thumbnail_url( $id, 'blur'); ?>');" data-src="<?= get_the_post_thumbnail_url( $id, 'serv'); ?>">
                <span class="product__info">
                    <span class="product__title"><?= get_the_title($id); ?></span>
                    <span class="product__price"><?= carbon_get_post_meta($id, 'price'); ?></span>
                </span>
            </a>

            <?php endforeach; ?> 
           
        </div>

        <div class="btns products__btns">
            <a href="javascript:void(0);" class="btn btn--bdr">Смотреть все</a>
        </div>

    </div>
</div>