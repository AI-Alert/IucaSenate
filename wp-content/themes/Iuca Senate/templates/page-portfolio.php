<?php

//Template Name: Портфолио

get_header();


$arResult = [
    'title' => [
        'status' => carbon_get_the_post_meta('title_status'), 
        'text'  => carbon_get_the_post_meta('title_text'),
    ],

    'form' => [
        'title' => carbon_get_the_post_meta('form_title'), 
        'image' => [
            'hero' => wp_get_attachment_image_url( carbon_get_the_post_meta('form_image'), 'hero'),
            'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('form_image'), 'blur'),
        ],        
    ],
    'content' => apply_filters('the_content', carbon_get_the_post_meta('content')),
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



    <div class="portfolio-section">		
        <div class="container">
            <<?= $arResult['title']['status']; ?> class="section-title">
                <?if($arResult['title']['text']): echo $arResult['title']['text']; else: the_title(); endif; ?>
            </<?= $arResult['title']['status']; ?>>
        </div>

        <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            $stati_children = new WP_Query(array(
                'post_type' => 'page',
                'post_parent' => get_the_ID(),
                'posts_per_page' => 4,
                'paged' => $paged,
                )
            );
        ?>

        <?php if($stati_children->have_posts()): ?>

        <div class="portfolio-col">

            <?php while($stati_children->have_posts()): $stati_children->the_post(); ?>


            <?php
                $arItem = [
                   
                    'info' => [
                        'address'  => carbon_get_the_post_meta('address'),
                        'factory'  => carbon_get_the_post_meta('factory'),
                        'model'  => carbon_get_the_post_meta('model'),
                        'price'  => carbon_get_the_post_meta('price'),
                        
                        'addone'  => carbon_get_the_post_meta('addone'),
                    ],
                    'gallery' => carbon_get_the_post_meta('gallery'),
               

                    'feed' => [                   
                        'min' => carbon_get_the_post_meta('feed_mini'),                    
                        'name' => carbon_get_the_post_meta('feed_name'), 
                        'image' => [            
                            'middle' => wp_get_attachment_image_url( carbon_get_the_post_meta('feed_image'), 'middle'),
                            'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('feed_image'), 'blur'),
                            'alt' => get_post_meta( carbon_get_the_post_meta('feed_image'), '_wp_attachment_image_alt', TRUE), 
                        ],
                    ],

                ];
            ?>

            <div class="portfolio">		

                    <div class="portfolio__slider-arrows">						
                        <button class="back"><img src="<?= _assets(); ?>/img/next.svg" alt="Alt" class="svg"></button>
                        <button class="next"><img src="<?= _assets(); ?>/img/next.svg" alt="Alt" class="svg"></button>						
                    </div>					

                    <div class="portfolio__foto">

                        <?php
                            foreach($arItem['gallery'] as $item):

                            $image = [
                                'hero' => wp_get_attachment_image_url( $item, 'hero'),                              
                                'blur' => wp_get_attachment_image_url( $item, 'blur'),
                                'alt' => get_post_meta( $item, '_wp_attachment_image_alt', TRUE), 
                            ];
                        
                        ?>

                        <img class="lazyload" data-src="<?= $image['hero'] ?>" src="<?= $image['blur'] ?>" alt="<?= $image['alt'] ?>">

                        <?php endforeach; ?>
                       
                    </div>

                    <div class="portfolio__info">

                        <div class="portfolio__title"><?php the_title(); ?></div>
                        
                        <div class="portfolio__chars">
                            
                            <?php if($arItem['info']['address'] || $arItem['info']['factory'] || $arItem['info']['model'] || $arItem['info']['price'] ): ?>
                            <table>
                                <?php if($arItem['info']['address']): ?>
                                <tr>
                                    <td>Адрес:</td>
                                    <td><?= $arItem['info']['address'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($arItem['info']['factory']): ?>
                                <tr>
                                    <td>Фабрика:</td>
                                    <td><?= $arItem['info']['factory'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($arItem['info']['model']): ?>
                                <tr>
                                    <td>Модель:</td>
                                    <td><?= $arItem['info']['model'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($arItem['info']['price']): ?>
                                <tr>
                                    <td>Стоимость:</td>
                                    <td><?= $arItem['info']['price'] ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                            <?php endif; ?>	

                            <?php if($arItem['info']['addone']): ?>
                            <div class="portfolio__small"><?= $arItem['info']['addone'] ?></div>
                            <?php endif; ?>							
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn">Подробнее</a>
                    </div>


                    <?php if($arItem['feed']['min']): ?>
                    <div class="portfolio-review">
                        <div class="portfolio-review__text format-text">
                            <blockquote><?= $arItem['feed']['min'] ?></blockquote>
                        </div>
                        <?php if($arItem['feed']['name']): ?>   
                        <div class="portfolio-review__foot">
                            <?php if($arItem['feed']['image']['blur']): ?>
                            <img src="<?= $arItem['feed']['image']['blur'] ?>" alt="<?= $arItem['feed']['image']['alt'] ?>">
                            <?php endif; ?>
                            <span class="portfolio-review__name"><?= $arItem['feed']['name'] ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                
            </div>

            <?php endwhile; ?>

        </div>	

        <?php endif; ?>

        <?php wp_pagenavi(array('query'=> $stati_children ));  wp_reset_query(); ?>
        
        

    </div>	

    <?php if($arResult['form']['title']): ?>

    <div class="section cta">
        <div class="container">

            <div class="cta-block">

                <div class="cta__bg lazyload" style="background-image: url('<?= $arResult['form']['image']['blur'] ?>');" data-src="<?= $arResult['form']['image']['hero'] ?>"></div>	

                <div class="section-title">
                    <?= $arResult['form']['title'] ?>
                </div>

                <div class="cta__form">
                    <?= do_shortcode('[contact-form-7 id="168" title="Открытая ФОС" html_class="form"]'); ?>

                    <script> 
                        document.querySelector('.cta__form  .check-wrapper .wpcf7-list-item > label').classList.add('custom-checkbox');
                        document.querySelector('.cta__form  .check-wrapper .custom-checkbox').insertBefore(document.createElement('span'), document.querySelector('.cta__form .check-wrapper .wpcf7-list-item .custom-checkbox .wpcf7-list-item-label'));
                        document.querySelector('.cta__form  .check-wrapper .wpcf7-list-item > label > input').classList.add('input-check');
                    </script>                            
                </div>
            </div>

        </div>
    </div>

    <?php endif; ?>

    <?php if($arResult['content'] && !is_paged()): ?>
        <div class="section seo">
            <div class="container">               
                <div class="seo__text format-text">
                    <?= $arResult['content'] ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>	



<?php 

get_footer(); 
