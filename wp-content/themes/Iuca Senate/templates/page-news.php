<?php 

//Template Name: Новости и акции

get_header(); 


$arResult = [
    'title' => [
        'status' => carbon_get_the_post_meta('title_status'), 
        'text'  => carbon_get_the_post_meta('title_text'),
    ],

    'content' => apply_filters('the_content', carbon_get_the_post_meta('content')),
    'content_2' => apply_filters('the_content', carbon_get_the_post_meta('content_2')),

]

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

    <div class="news-section">

        <div class="container">
            <<?= $arResult['title']['status']; ?> class="section-title">
                <?if($arResult['title']['text']): echo $arResult['title']['text']; else: the_title(); endif; ?>
            </<?= $arResult['title']['status']; ?>>


            <?php if($arResult['content'] && !is_paged()): ?>
                <div class="section seo">                                  
                        <div class="seo__text format-text">
                            <?= $arResult['content'] ?>
                        </div>                    
                </div>
            <?php endif; ?>

            <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                $stati_children = new WP_Query(array(
                    'post_type' => 'page',
                    'post_parent' => get_the_ID(),
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    )
                );
            ?>

            <?php if($stati_children->have_posts()): ?>

            <div class="news-grid">

                <?php while($stati_children->have_posts()): $stati_children->the_post(); ?>
                
                <?php

                    $arItem = [
                        'image' => [
                            'blur' => get_the_post_thumbnail_url(get_the_ID(), 'blur'),
                            'middle' => get_the_post_thumbnail_url(get_the_ID(), 'middle'),
                            'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)
                        ],
                        'anons' => carbon_get_the_post_meta('anons'),
                        'date' => carbon_get_the_post_meta('date')
                    ];

                ?>

                <a href="<?php the_permalink(); ?>" class="new">
                    <span class="new__foto">
                        <img class="lazyload" data-src="<?=  $arItem['image']['middle'] ?>" src="<?=  $arItem['image']['blur'] ?>" alt="<?=  $arItem['image']['alt'] ?>">
                    </span>
                    <span class="new__foot">
                        <span class="new__title"><?php the_title(); ?></span>

                        <?php if( $arItem['anons']): ?>
                        <span class="new__text format-text">
                            <?= $arItem['anons'] ?>
                        </span>
                        <?php endif; ?>
                        <?php if( !$arItem['date']): ?>
                        <span class="new__date"><?= get_the_date('d.m.y'); ?></span>
                        <?php endif; ?>
                        <span class="new__more"><img src="<?= _assets(); ?>/img/next.svg" alt="Подробнее" class="svg"></span>
                    </span>
                </a>

                <?php endwhile; ?>

            </div>

            <?php endif; ?>

            <?php wp_pagenavi(array('query'=> $stati_children ));  wp_reset_query(); ?>

            <?php if($arResult['content'] && !is_paged()): ?>
                <div class="section seo">                                  
                        <div class="seo__text format-text">
                            <?= $arResult['content'] ?>
                        </div>                    
                </div>
            <?php endif; ?>

        </div>					

    </div>									

</main>	




<?php 

get_footer();