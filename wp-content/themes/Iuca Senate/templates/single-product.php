<?php

get_header(); 

$arResult = [
    'title' => [
        'status' => carbon_get_the_post_meta('title_status'), 
        'text'  => carbon_get_the_post_meta('title_text'),
    ],
    'image' =>[
		'hero' => wp_get_attachment_image_url( carbon_get_the_post_meta('image'), 'hero'),
		'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('image'), 'blur'),
		'alt' => get_post_meta( carbon_get_the_post_meta('image'), '_wp_attachment_image_alt', TRUE), 
	],

    'content_side' => apply_filters('the_content', carbon_get_the_post_meta('content_side')),

    'chars' => carbon_get_the_post_meta('chars'),
    'regular_price' => carbon_get_the_post_meta('regular_price'),
    'old_price' => carbon_get_the_post_meta('old_price'),
    'content' => apply_filters('the_content', carbon_get_the_post_meta('content')),
    'gallery' => carbon_get_the_post_meta('gallery'),
    'similiar' => carbon_get_the_post_meta('similiar'),

    'content_2' => apply_filters('the_content', carbon_get_the_post_meta('content_2')),
];



?>


<main class="main">

    <div class="breadcrumbs-block">
        <div class="container">
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<ul class="breadcrumbs__list">','</ul>' );
                }	
			
            ?>
        </div>
    </div>

    <div class="card-section">

        <div class="card">
            <div class="container">
                <div class="card__photo">

                    <?php if($arResult['image']['blur']): ?>
                    <img src="<?= $arResult['image']['blur'] ?>" data-src="<?= $arResult['image']['hero'] ?>" class="lazyload" alt="<?= $arResult['image']['alt'] ?>">
                    <?php endif; ?>


                    <<?= $arResult['title']['status']; ?> class="card__title">
                        <?if($arResult['title']['text']): echo $arResult['title']['text']; else: the_title(); endif; ?>
                    </<?= $arResult['title']['status']; ?>>
                </div>

                <div class="card-block">
                    <?php if($arResult['content_side']): ?>
                    <div class="card__text">
                        <?= $arResult['content_side'] ?>
                    </div>
                    <?php endif; ?>
                    <?php if($arResult['chars'] || $arResult['regular_price']): ?>
                    <div class="card__info">
                        <?php if($arResult['chars'] ): ?>
                        <div class="card__chars">
                            <?php foreach($arResult['chars'] as $item): ?>
                            <div class="card__char">
                                <div class="card__char-title"><?= $item['name'] ?></div>
                                <div class="card__char-value"><?= $item['caption'] ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <?php if($arResult['regular_price']): ?>
                        <div class="card__price">
                            <?php if($arResult['old_price']): ?>
                            <span class="card__old-price"><?= $arResult['old_price'] ?></span>
                            <?php endif; ?>
                            <span class="card__new-price"><?= $arResult['regular_price'] ?></span>
                        </div>
                        <?php endif; ?>

                        <button data-href="#callback" class="btn">Отправить заявку</button>
                    </div>
                    <?php endif; ?>

                </div>

                <?php if($arResult['content']): ?>
                <div class="section seo">
                                  
                        <div class="seo__text format-text">
                            <?= $arResult['content'] ?>
                        </div>
                   
                </div>
                <?php endif; ?>

                <?php if($arResult['gallery']): ?>
                <div class="card__gallery">
                    <?php
                    foreach($arResult['gallery'] as $item):

                    $image = [
                        'middle' => wp_get_attachment_image_url( $item, 'middle'),
                        'full' => wp_get_attachment_image_url( $item, 'full'),
                        'blur' => wp_get_attachment_image_url( $item, 'blur'),
                        'alt' => get_post_meta( $item, '_wp_attachment_image_alt', TRUE), 
                    ];
                   
                    ?>
                    <a href="<?= $image['full'] ?>"><img class="lazyload" data-src="<?= $image['middle'] ?>" src="<?= $image['blur'] ?>" alt="<?= $image['alt'] ?>"></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

       

        <?php if(!$arResult['similiar']): ?>
                <?php

                $current = get_the_ID();

                $products = new WP_Query( array(
                    'post_type'      => 'post',
                    'post_status'    => 'publish',    
                    'posts_per_page' => 8,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => get_the_terms( $current, "category" )[0]->term_id,
                        ),
                    ),
                ) );
                if($products->have_posts()):
                ?>

                <div class="section kitchens">
                    <div class="container">
                        <div class="section-h2">Похожие кухни</div>

                        <div class="kitchens-wrap">

                            <div class="kitchens-block">

                        
                            <?php
                            while($products->have_posts()): $products->the_post(); 
                                if($current != get_the_ID()): 
                                    get_template_part( 'template-parts/grid', 'product' );
                                endif;
                            endwhile; wp_reset_postdata(); 
                            ?>                           

                            </div>

                            <div class="slider-arrows kitchens__slider-arrows">
                                <button class="prev"><img src="<?= _assets(); ?>/img/next-2.svg" alt="Alt" class="svg"></button>
                                <button class="forward"><img src="<?= _assets(); ?>/img/next-2.svg" alt="Alt" class="svg"></button>
                            </div>

                        </div>

                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($arResult['content_2']): ?>
        <div class="section seo">
            <div class="container">               
                <div class="seo__text format-text">
                    <?= $arResult['content_2'] ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>

</main>


<?php

get_footer(); 

?>