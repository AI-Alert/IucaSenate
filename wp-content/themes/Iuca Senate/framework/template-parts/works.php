<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'content' => apply_filters( 'the_content', $args['content'] ),
];

?>


<div class="section works">
    <div class="container">
        <<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>
        <div class="section-info format-text">
            <?= $arResult['content']; ?>
        </div>
        
        <a target="_blank" href="https://www.instagram.com/werner.39/" class="btn btn--dark btn--social"><img src="<?= _assets(); ?>/img/insta.svg"
                alt="Инстаграм">Инстаграм</a>

                <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                $childrens = get_children( [
                    'post_parent' => 22,
                    'post_type'   => 'page', 
                    'numberposts' => -1,
                    'post_status' => 'any'
                ] );

                $target_parents = array();

                foreach($childrens as $child) {
                    array_push($target_parents, $child->ID);
                }


                $stati_children = new WP_Query(array(
                        'post_type' => 'page',
                        'post_parent__in' => $target_parents,
                        'posts_per_page' => -1,
                        'paged' => $paged,
                    )
                );
            ?>
            <?php if($stati_children->have_posts()): ?>
        <div class="works-slider">
            <div class="works-js-slider">


            <?php while($stati_children->have_posts()): $stati_children->the_post();
            
                $blur = get_the_post_thumbnail_url( get_the_ID(), 'blur');
                $full = get_the_post_thumbnail_url( get_the_ID(), 'news');
            ?>

                <a href="<?php the_permalink(); ?>" class="work lazyload" 
                    style="background-image: url('<?= $blur; ?>');"
                    data-src="<?= $full; ?>">
                    <span class="work__title"><?php the_title(); ?></span>
                </a>

                <?php endwhile; ?>
                
            </div>

            <div class="slider-arrows works__slider-arrows">
                <button class="back"><img src="<?= _assets(); ?>/img/back.svg" alt="<" class="svg"></button>
                <button class="next"><img src="<?= _assets(); ?>/img/next.svg" alt=">" class="svg"></button>
            </div>

        </div>

        <?php endif;  wp_reset_postdata(); ?>

        <div class="btns works__btns"><a href="/nashi-raboty" class="btn btn--bdr">Больше работ</a></div>

    </div>
</div>
