<?php

get_header(); 

$category     = get_queried_object();
$category_id  = $category->term_id;

$arResult = [
	'title' => [
        'status' => carbon_get_term_meta( $category_id, 'title_status' ),
        'text'  => carbon_get_term_meta( $category_id, 'title_text' )
    ],
	'image' => [
		'full' => wp_get_attachment_image_url(  carbon_get_term_meta( $category_id,'brand_image'), 'full'),
		'blur' => wp_get_attachment_image_url(  carbon_get_term_meta( $category_id,'brand_image'), 'blur'),
		'alt' => get_post_meta(  carbon_get_term_meta( $category_id,'brand_image'), '_wp_attachment_image_alt', TRUE), 
	],
	'content' => apply_filters('the_content', carbon_get_term_meta( $category_id,'content')),

	'subterms'  => carbon_get_term_meta( $category_id, 'subterms' ),

	'content_2' => apply_filters('the_content', carbon_get_term_meta( $category_id,'content_2')),



];


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

<div class="category-section">

	<div class="container">
		<<?= $arResult['title']['status']; ?> class="section-title">
			<?if($arResult['title']['text']): echo $arResult['title']['text']; else: single_cat_title(); endif; ?>
		</<?= $arResult['title']['status']; ?>>
	</div>

	<?php if($arResult['image'] || $arResult['content']): ?>
	<div class="category-hero">
		<div class="container">
			<div class="category-hero-block">
				<?php if($arResult['image']['full']): ?>
				<img src="<?= $arResult['image']['blur'] ?>"  data-src="<?= $arResult['image']['full'] ?>" class="lazyload" alt="<?= $arResult['image']['alt'] ?>">
				<?php endif; ?>		
				<?php if($arResult['content']): ?>			
				<div class="category-hero__text format-text">
					<?= $arResult['content'] ?>
				</div>
				<?php endif; ?>				
			</div>
		</div>
	</div>
	<?php endif; ?>	

	<?php if($arResult['subterms']): ?>			
	<div class="categories">
		<div class="container">
			<div class="categories-block">

				<?php 
				foreach($arResult['subterms'] as $item):

					$category_id = $item['id'];					

					$term = get_term_by( 'id', $category_id, 'category' ); 

					$subterm_anons = carbon_get_term_meta( $category_id, 'subterm_anons' );			

					$image = [
						'middle' => wp_get_attachment_image_url(  carbon_get_term_meta( $category_id,'front_image'), 'middle'),
						'blur' => wp_get_attachment_image_url(  carbon_get_term_meta( $category_id,'front_image'), 'blur'),
						'alt' => get_post_meta(  carbon_get_term_meta( $category_id,'front_image'), '_wp_attachment_image_alt', TRUE), 
					];

					?>
					<a href="<?= get_term_link( $term->term_id, $term->taxonomy ); ?>" class="category">
						<span class="category__foto">
							<img src="<?= $image['blur'] ?>" data-src="<?= $image['middle'] ?>" class="lazyload" alt="<?= $image['alt'] ?>">
						</span>
						<span class="category__info">
							<span class="category__title"><?= $term->name ?></span>

							<span class="category__text format-text">
								<?= $subterm_anons ?>
							</span>

						</span>									
					</a>
				<?php endforeach; ?>
				
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php  if( have_posts()): ?>
	<div class="categories-kitchens">

		<div class="container">
			<div class="kitchens-grid">
				<?php while( have_posts() ): the_post();  
				

				get_template_part( 'template-parts/grid', 'product' );


				endwhile; ?>

			</div>

			<?php wp_pagenavi(); ?>
		</div>

	</div>
	<?php endif; ?>

	<?php if($arResult['content_2']): ?>	
	<div class="section seo">
		<div class="container">					
			<div class="seo__text format-text">
				<?= $arResult['content_2'] ?>
			</div>
		</div>
	</div>							
	<?php endif; ?>	


    <?php if( !have_posts() && !$arResult['content'] && !$arResult['content_2'] && !$arResult['subterms']):?>
    <div class="section seo">
		<div class="container">					
			<div class="seo__text format-text">
				К сожалению, данная страница находится на стадии заполнения
			</div>
		</div>
	</div>	
    <?php endif; ?>


</div>												

</main>	






<?php get_footer(); ?>













