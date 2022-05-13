

<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'],
        'text' => $args['title'],
    ],   
    'links' => $args['links']
];

?>


<div class="section works">

    <div class="container">

        <?php if($arResult['title']['text']): ?>
        <<?= $arResult['title']['state']; ?> class="section-title">
            <?= $arResult['title']['text']; ?>
        </<?= $arResult['title']['state']; ?>>
        <?php endif; ?>	

        <div class="portfolio__slider-arrows">						
            <button class="back"><img src="<?= _assets(); ?>/img/next.svg" alt="<" class="svg"></button>
            <button class="next"><img src="<?= _assets(); ?>/img/next.svg" alt=">" class="svg"></button>						
        </div>

    </div>

    <div class="portfolio__slider">

            <?php
            $array_posts = [];
            foreach($arResult['links'] as $item) {
                array_push($array_posts, $item['id']);
            }

            $cases = new WP_Query( array(
            'post_type'      => array('page'),
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'post__in' => $array_posts
            ));

            while($cases->have_posts()): $cases->the_post();
            ?>

            <div class="portfolio__slide">


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

                    <div class="portfolio__foto">

                        <?php
                            $item = $arItem['gallery'][0];

                            $image = [
                                'hero' => wp_get_attachment_image_url( $item, 'hero'),                              
                                'blur' => wp_get_attachment_image_url( $item, 'blur'),
                                'alt' => get_post_meta( $item, '_wp_attachment_image_alt', TRUE), 
                            ];
                        
                        ?>

                        <img class="lazyload" data-src="<?= $image['hero'] ?>" src="<?= $image['blur'] ?>" alt="<?= $image['alt'] ?>">

                       
                       
                    </div>

                    <div class="portfolio__info">
                                             
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

               

            </div>

            <?php  endwhile; wp_reset_postdata(); ?>       

    </div>															

</div>	







