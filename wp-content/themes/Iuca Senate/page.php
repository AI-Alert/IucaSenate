<?php
//Template Name: Контентная страница

get_header();

$arParams = carbon_get_the_post_meta( 'front_page' );

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

    <?php
    
        if($arParams):

            foreach($arParams as $arItem):

                get_template_part('template-parts/'.$arItem['_type'], NULL, $arItem);

            endforeach;

        else:

            ?>

            <div class="container">
                <h1 class="section-title">
                    <?php the_title(); ?>
                </h1>
            </div>

            <div class="section seo">
                <div class="container">					
                    <div class="seo__text format-text">
                        К сожалению, данная страница находится на стадии заполнения
                    </div>
                </div>
            </div>	

            <?php
            
        endif; 
    ?>

</main>		

<?php

get_footer();

?>