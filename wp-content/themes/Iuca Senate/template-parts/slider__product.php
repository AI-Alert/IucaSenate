

<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'],
        'text' => $args['title'],
    ],   
    'links' => $args['links']
];

?>

<div class="section pop-kitchens">						
    <div class="container">
        <?php if($arResult['title']['text']): ?>
        <<?= $arResult['title']['state']; ?> class="section-title">
            <?= $arResult['title']['text']; ?>
        </<?= $arResult['title']['state']; ?>>
        <?php endif; ?>		

        <div class="kitchens-wrap">		

            <div class="kitchens-block">
            <?php
            $array_posts = [];
            foreach($arResult['links'] as $item) {
                array_push($array_posts, $item['id']);
            }

            $products = new WP_Query( array(
            'post_type'      => array('post'),
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'post__in' => $array_posts
            ));

            while($products->have_posts()): $products->the_post();
            ?>

                <?php get_template_part( 'template-parts/grid', 'product' ); ?>

            <?php  endwhile; wp_reset_postdata(); ?>

            </div>

            <div class="slider-arrows kitchens__slider-arrows">						
                <button class="prev"><img src="<?= _assets(); ?>/img/next-2.svg" alt="<" class="svg"></button>
                <button class="forward"><img src="<?= _assets(); ?>/img/next-2.svg" alt=">" class="svg"></button>						
            </div>

        </div>

    </div>	
</div>	





