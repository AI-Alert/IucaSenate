<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'caption' => apply_filters( 'the_content', $args['content'] ),
    'preview' => $args['preview'],
    'image_add' => $args['image_add'],
    'link' => $args['link']
];

?>


<div class="section about">
    <div class="container">						
        <div class="about-block clearfix">	
            <?php
                if(isset($arResult['preview'][0])):
                    $arItem = $arResult['preview'][0];                
                    $image_full      = wp_get_attachment_image_url($arItem['preview'], 'full');
                    $image_about     = wp_get_attachment_image_url($arItem['preview'], 'about');
                    $image_blur      = wp_get_attachment_image_url($arItem['preview'], 'blur');
                    $image_alt = get_post_meta($arItem['preview'], '_wp_attachment_image_alt', TRUE);
                ?>
            <div class="about__media">

                <?php  if( $arItem['_type'] == 'video'): 
                            $video = $arItem['link']; ?>
                
                    <a href="<?= $video; ?>" class="about__multimedia about__multimedia--video" data-fancybox><img class="lazyload" data-src="<?= $image_about; ?>" src="<?= $image_blur; ?>" alt="<?= $image_alt; ?>"><button class="play"><img src="<?= _assets(); ?>/img/play.svg" alt="Alt" class="svg"></button></a>
                    <?php else: ?>
                    <a href="<?= $image_full; ?>" class="about__multimedia"><img class="lazyload" data-src="<?= $image_about; ?>" src="<?= $image_blur; ?>" alt="<?= $image_alt; ?>"></a>
                    <?php endif; ?>

                    <?php  
                    $image_add_full      = wp_get_attachment_image_url($arResult['image_add']);
                    $image_add_about     = wp_get_attachment_image_url($arResult['image_add'], 'about');
                    $image_add_blur      = wp_get_attachment_image_url($arResult['image_add'], 'blur');
                    $image_add_alt = get_post_meta($arResult['image_add'], '_wp_attachment_image_alt', TRUE);    ?>

                    <a href="<?= $image_add_full; ?>" class="about__image"><img class="lazyload" data-src="<?= $image_add_full; ?>" src="<?= $image_add_blur; ?>" alt="<?= $image_add_alt; ?>"></a>								
                    <a href="<?= the_permalink(14 ); ?>" class="about__to-map"><img src="<?= _assets(); ?>/img/placeholder-g.svg" alt="Alt" class="svg">Смотреть на карте</a>
            </div>	
             <?php endif; ?>
            
            
            <<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>
            <div class="about__text format-text">
                <?= $arResult['caption']; ?>
            </div>		
            <a href="<?= $arResult['link']; ?>" class="btn btn--bdr about__btn">Подробнее</a>				

        </div>											
        
    </div>	
</div>

