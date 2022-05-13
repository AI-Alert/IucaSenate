<?php

//Template Name: Команда

get_header();


$arResult = [
    'title' => [
        'status' => carbon_get_the_post_meta('title_status'), 
        'text'  => carbon_get_the_post_meta('title_text'),
    ],

    'dir' => [
        'dir_name' => carbon_get_the_post_meta('dir_name'), 
        'dir_position' => carbon_get_the_post_meta('dir_position'), 
        'dir_content' => apply_filters('the_content', carbon_get_the_post_meta('dir_content')), 
        'dir_image' => [
            'hero' => wp_get_attachment_image_url( carbon_get_the_post_meta('dir_image'), 'hero'),
            'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('dir_image'), 'blur'),
            'alt' => get_post_meta( carbon_get_the_post_meta('dir_image'), '_wp_attachment_image_alt', TRUE), 
        ],
        'dir_link' => carbon_get_the_post_meta('dir_link'),
    ],

    'team' => [
        'status' => carbon_get_the_post_meta('team_status'), 
        'text'  => carbon_get_the_post_meta('team_text'),
        'list' => carbon_get_the_post_meta('team_list'),
    ],

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

        <div class="team-section">

            <div class="container">
                <<?= $arResult['title']['status']; ?> class="section-title">
                    <?if($arResult['title']['text']): echo $arResult['title']['text']; else: the_title(); endif; ?>
                </<?= $arResult['title']['status']; ?>>
            </div>
            <?php if($arResult['dir']['dir_name']): ?>
            <div class="section director">

                <div class="container">
                    <div class="director-block">
                        <div class="director__info">
                            <div class="section-h2"><?= $arResult['dir']['dir_name'] ?></div>
                            <div class="director__subtitle"><?= $arResult['dir']['dir_position'] ?></div>
                            <div class="director__text format-text">
                                <blockquote>
                                    <?= $arResult['dir']['dir_content'] ?>
                                </blockquote>											
                            </div>
                            <?php if($arResult['dir']['dir_link']): ?>                           
                            <a href="<?= get_permalink($arResult['dir']['dir_link'][0]['id']); ?>" class="btn btn--more">Подробнее</a>
                            <?php endif; ?>
                        </div>

                        <div class="director__photo">
                            <img class="lazyload" src="<?= $arResult['dir']['dir_image']['blur'] ?>" data-src="<?= $arResult['dir']['dir_image']['hero'] ?>" alt="<?= $arResult['dir']['dir_image']['alt'] ?>">
                        </div>

                    </div>
                </div>

            </div>
            <?php endif; ?>

            <div class="section section--dark team">
                <div class="container">

                    <?php if($arResult['team']['list']): ?>
                    <<?= $arResult['team']['status']; ?> class="section-h2">
                        <?if($arResult['team']['text']): echo $arResult['team']['text']; else: the_title(); endif; ?>
                    </<?= $arResult['team']['status']; ?>>

                    <div class="team-block">

                        <?php
                        foreach ($arResult['team']['list'] as $item):
                            $image = [
                                'middle' => wp_get_attachment_image_url( $item['image'], 'middle'),
                                'blur' => wp_get_attachment_image_url( $item['image'], 'blur'),
                                'alt' => get_post_meta( $item['image'], '_wp_attachment_image_alt', TRUE), 
                            ];
                        ?>

                        <?php if($item['link']): ?>

                            <a href="<?= get_permalink($item['link'][0]['id']); ?>" class="team__item">
                                <span class="team__photo">
                                    <img src="<?= $image['blur'] ?>" data-src="<?= $image['middle'] ?>" class="lazyload" alt="<?= $image['alt'] ?>">
                                </span>		
                                <span class="team__name"><?= $item['name'] ?></span>
                                <span class="team__job"><?= $item['position'] ?></span>
                                <span class="btn btn--more">Подробнее</span>
                            </a>

                        <?php else: ?>

                            <span class="team__item">
                                <span class="team__photo">
                                    <img src="<?= $image['blur'] ?>" data-src="<?= $image['middle'] ?>" class="lazyload" alt="<?= $image['alt'] ?>">
                                </span>		
                                <span class="team__name"><?= $item['name'] ?></span>
                                <span class="team__job"><?= $item['position'] ?></span>
                                <span style="opacity: 0" class="btn btn--more">Подробнее</span>
                            </span>

                        <?php endif; ?>

                        <?php endforeach; ?>
                       
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
            </div>

        </div>									

</main>



<?php 

get_footer(); 
