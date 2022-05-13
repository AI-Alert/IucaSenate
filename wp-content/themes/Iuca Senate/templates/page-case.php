<?php

//Template Name: Кейс - портфолио

get_header();


$arResult = [
    'title' => [
        'status' => carbon_get_the_post_meta('title_status'), 
        'text'  => carbon_get_the_post_meta('title_text'),
    ],

    'info' => [
        'address'  => carbon_get_the_post_meta('address'),
        'factory'  => carbon_get_the_post_meta('factory'),
        'model'  => carbon_get_the_post_meta('model'),
        'price'  => carbon_get_the_post_meta('price'),
        'task'  => carbon_get_the_post_meta('task'),
        'addone'  => carbon_get_the_post_meta('addone'),
    ],

    'image' => [
        'full' => wp_get_attachment_image_url( carbon_get_the_post_meta('image'), 'full'),
        'middle' => wp_get_attachment_image_url( carbon_get_the_post_meta('image'), 'middle'),
        'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('image'), 'blur'),
        'alt' => get_post_meta( carbon_get_the_post_meta('image'), '_wp_attachment_image_alt', TRUE), 
    ],

    'gallery' => carbon_get_the_post_meta('gallery'),


    'case' => [
        'image' => [
            'full' => wp_get_attachment_image_url( carbon_get_the_post_meta('case_image'), 'full'),
            'middle' => wp_get_attachment_image_url( carbon_get_the_post_meta('case_image'), 'middle'),
            'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('case_image'), 'blur'),
            'alt' => get_post_meta( carbon_get_the_post_meta('case_image'), '_wp_attachment_image_alt', TRUE), 
        ],
        'video' => carbon_get_the_post_meta('case_video'),
        'title' => [
            'status' => carbon_get_the_post_meta('case_status'), 
            'text'  => carbon_get_the_post_meta('case_text'),
        ],

        'content' => apply_filters('the_content', carbon_get_the_post_meta('content')),
        
    ],

    'feed' => [
        'title' => [
            'status' => carbon_get_the_post_meta('feed_status'), 
            'text'  => carbon_get_the_post_meta('feed_text'),
        ],
      
        'max' => carbon_get_the_post_meta('feed_max'), 
        'name' => carbon_get_the_post_meta('feed_name'), 
        'image' => [            
            'middle' => wp_get_attachment_image_url( carbon_get_the_post_meta('feed_image'), 'middle'),
            'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('feed_image'), 'blur'),
            'alt' => get_post_meta( carbon_get_the_post_meta('feed_image'), '_wp_attachment_image_alt', TRUE), 
        ],
    ],

    'gallery_2' => carbon_get_the_post_meta('gallery_2'),

    'fos' => [      
        'disbale' =>   carbon_get_the_post_meta('fos_disable'), 
        'text' => carbon_get_the_post_meta('fos_text'), 
        'caption' => apply_filters('the_content', carbon_get_the_post_meta('fos_caption')), 
        'btn_text' => carbon_get_the_post_meta('btn_text'), 
    ]
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

    <div class="case-section">

        <div class="case-hero">
            <div class="container">								
                <div class="case-hero-block">
                    <div class="case-hero__info">
                        <<?= $arResult['title']['status']; ?> class="section-title">
                            <?if($arResult['title']['text']): echo $arResult['title']['text']; else: the_title(); endif; ?>
                        </<?= $arResult['title']['status']; ?>>

                        <?php if($arResult['info']['address'] || $arResult['info']['factory'] || $arResult['info']['model'] || $arResult['info']['price'] || $arResult['info']['addone'] || $arResult['info']['task']): ?>
                        <div class="case-hero__chars">
                            <table>
                                <?php if($arResult['info']['address']): ?>
                                <tr>
                                    <td>Адрес:</td>
                                    <td><?= $arResult['info']['address'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($arResult['info']['factory']): ?>
                                <tr>
                                    <td>Фабрика:</td>
                                    <td><?= $arResult['info']['factory'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($arResult['info']['model']): ?>
                                <tr>
                                    <td>Модель:</td>
                                    <td><?= $arResult['info']['model'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($arResult['info']['price']): ?>
                                <tr>
                                    <td>Стоимость:</td>
                                    <td><?= $arResult['info']['price'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($arResult['info']['task']): ?>
                                <tr>
                                    <td>Задача:</td>
                                    <td><?= $arResult['info']['task'] ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($arResult['info']['addone']): ?>
                                <tr>
                                    <td></td>
                                    <td class="td__note"><?= $arResult['info']['addone'] ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>	
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if($arResult['image']['full']): ?>
                    <a href="<?= $arResult['image']['full'] ?>"><img class="lazyload" src="<?= $arResult['image']['blur'] ?>" data-src="<?= $arResult['image']['middle'] ?>" alt="<?= $arResult['image']['alt'] ?>"></a>
                    <?php endif; ?>
                </div>
                <?php if($arResult['gallery']): ?>
                <div class="case-hero__gallery">
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


        <?php if($arResult['case']['content']):  ?>
        <div class="section section--dark decision">
            <div class="container">								
                <div class="decision-block">
                    <?php if($arResult['case']['image']['full']): ?>
                    <div class="decision__video">

                        <?php
                        if($arResult['case']['video']):
                            $link = $arResult['case']['video'];
                        else: 
                            $link = $arResult['case']['image']['full'];
                        endif;
                        
                        ?>


                        <a href="<?= $link ?>" class="about__multimedia about__multimedia--video" data-fancybox>
                            <img class="lazyload" data-src="<?= $arResult['case']['image']['middle'] ?>" src="<?= $arResult['case']['image']['blur'] ?>" alt="<?= $arResult['case']['image']['alt'] ?>">
                            <?php
                            if($arResult['case']['video']): ?>
                            <span class="play"><img src="<?= _assets(); ?>/img/play.svg" alt="Alt" class="svg"></span>
                            <?php endif;                        
                            ?>
                        </a>

                    </div>
                    <?php endif; ?>
                    
                    
                    <div class="decision__info">

                    <?php if($arResult['case']['title']['text']): ?>
                        <<?= $arResult['case']['title']['status']; ?> class="section-h2">
                            <?= $arResult['case']['title']['text']; ?>
                        </<?= $arResult['case']['title']['status']; ?>>
                    <?php  endif; ?>

                        <div class="decision__text format-text">
                            <?= $arResult['case']['content'] ?>
                        </div>	
                    </div>				

                </div>
                
            </div>
        </div>
        <?php endif; ?>



        <?php if($arResult['feed']['max']): ?>
        <div class="section case-review">
            <div class="container">
                <?php if($arResult['feed']['title']['text']): ?>
                    <<?= $arResult['feed']['title']['status']; ?> class="section-h2">
                        <?= $arResult['feed']['title']['text']; ?>
                    </<?= $arResult['feed']['title']['status']; ?>>
                <?php  endif; ?>
                <div class="case-review-block">
                    <div class="case-review__info">
                        <div class="case-review__text format-text">
                            <blockquote>
                                <?= $arResult['feed']['max'] ?>
                            </blockquote>
                        </div>
                        <?php if($arResult['feed']['name']): ?>                        
                        <div class="case-review__author"> <?= $arResult['feed']['name'] ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- <a href="img/review-foto.jpg"><img src="img/review-foto-thumb.jpg" alt="Alt"></a>  -->
                    <?php if($arResult['feed']['image']['middle']): ?>
                    <img src="<?= $arResult['feed']['image']['middle'] ?>" alt="<?= $arResult['feed']['image']['alt'] ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>	
        <?php endif; ?>
        

        <?php if($arResult['gallery']): ?>
        <div class="case-gallery">
            <div class="container">
                <div class="case-gallery-grid">
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
            </div>
        </div>
        <?php endif; ?>


        <?php if(!$arResult['fos']['disbale']): ?>
        <div class="container">
            <div class="min-cta">
                <div class="section-h2"><?= $arResult['fos']['text'] ?></div>
                <div class="min-cta__text format-text">
                    <?= $arResult['fos']['caption'] ?>
                </div>
                <button data-href="#callback" class="btn"><?= $arResult['fos']['btn_text'] ?></button>
            </div>
        </div>
        <?php endif; ?>
    </div>												

</main>

<?php 

get_footer();