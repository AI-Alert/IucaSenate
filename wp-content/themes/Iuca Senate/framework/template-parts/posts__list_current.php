<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'caption' => apply_filters( 'the_content', $args['content'] ),
    'post_list' => $args['links'],
    'link' => $args['link']
];

?>

<div class="section s-vacancy">
    <div class="container">
        <<?= $arResult['title']['state']; ?> class="section-title has-slider-arrows"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>

        <div class="section-info format-text has-slider-arrows">
            <?= $arResult['caption']; ?>
        </div>

        <div class="slider-arrows vacancy__slider-arrows">
            <button class="back"><img src="<?= _html(); ?>/img/prev.svg" alt="Alt" class="svg"></button>
            <button class="next"><img src="<?= _html(); ?>/img/next.svg" alt="Alt" class="svg"></button>
        </div>

        <?php if($arResult['post_list']): ?>       
        <div class="vacancy-grid vacancy-slider">
            <?php 
				
                //  if(isset($arResult['post_list'])): 
                    $arResult['post_list'] = [];
                //  else: 
                    $stati_children = new WP_Query(array(
						//'post_type' => 'page',
						//'post_parent' => get_the_ID(),
						'cat' => sl(2, 10),
						'posts_per_page' => -1						
						)
                      );
                     
                     if($stati_children->have_posts()): 
                        while($stati_children->have_posts()): $stati_children->the_post(); 
                           // if(has_post_thumbnail()):                             
                                array_push( $arResult['post_list'], [ 'id' => get_the_ID()]);
                           // endif;
                     endwhile;
                    endif;
                    wp_reset_postdata(  );
                       // var_dump( $arResult['post_list'] );
                //  endif;

                //var_dump($stati_children);
                
                foreach ($arResult['post_list'] as $arLink): 
                    // $image = wp_get_attachment_image_url($arItem['image']); 
                    // $image_alt = get_post_meta($arItem['image'], '_wp_attachment_image_alt', TRUE);
            ?>
            <a href="<?= get_permalink( $arLink['id'] ); ?>" class="vacancy">
                <div class="vacancy__photo">
                <?php if(get_the_post_thumbnail_url($arLink['id'], 'blur')): ?>    
                	<img src="<?php echo get_the_post_thumbnail_url($arLink['id'], 'blur'); ?>" class="lazyload" alt="<?php the_title(); ?>" data-src="<?php echo get_the_post_thumbnail_url($arLink['id'], 'news_big'); ?>">
				<?php else: ?>
					                      
						
                    <img src="/wp-content/uploads/2020/11/no_photo3-1.jpg" alt="<?= get_the_title($arLink['id']); ?>">
                
										
				<?php endif; ?>
                </div>
                <div class="vacancy__body">
                    <div class="vacancy__info">
                        <div class="vacancy__title"><?= get_the_title($arLink['id']); ?></div>
                        <div class="vacancy__types"><table><tr><td><?= sl('Тип судна:', 'Vessel type name:'); ?></td><td><?= carbon_get_post_meta( $arLink['id'], 'vessel_type_name' ); ?></td></tr></table></div>
                    </div>
                    <?php if((int)carbon_get_post_meta( $arLink['id'], 'amount' ) > 0 ): ?>
                    <div class="vacancy__price"> 
							<span class="vacancy__price-text">Salary:</span>
							<span class="vacancy__price-value"> 
							<?= carbon_get_post_meta(  $arLink['id'], 'currency_name' ); ?> <?= (int)carbon_get_post_meta(  $arLink['id'], 'amount' ); ?>
							</span>					
							<span class="vacancy__price-text">
								<?php if(carbon_get_post_meta(  $arLink['id'], 'amount_period' ) == 'monthly'): ?>
									monthly
								<?php else: ?>
									daily
								<?php endif; ?>
								
							</span>
						</div>
                    <?php endif; ?>
                </div>
            </a>            
            <?php endforeach; ?>
        </div>
        <?php endif; ?>             
        <?php if($arResult['link']): ?>
        <div class="btns vacancy__btns">
            <a href="<?= $arResult['link']; ?>" class="btn btn--bdr"><?= sl('Смотреть все', 'See more'); ?></a>
        </div>
        <?php endif; ?>
    </div>
</div>