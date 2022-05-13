<?php
$arResult = [
	'title' => [
		'state' => $args['title_state'],
		'text' => $args['title_text'],
	],
	'content' => apply_filters('the_content', $args['content']),
	'image' => [
		'hero' => wp_get_attachment_image_url($args['image'], 'hero'),
		'blur' => wp_get_attachment_image_url($args['image'], 'blur'),
		'alt' => get_post_meta($args['image'], '_wp_attachment_image_alt', TRUE), 
	],
	'link' => $args['link'],
	'link_text' => $args['link_text'],
];

?>


<div class="section section--dark offer">
	<div class="container">						
		<div class="offer-block">
			<?php if($arResult['image']['blur']): ?>
			<img src="<?= $arResult['image']['blur'] ?>" data-src="<?= $arResult['image']['hero'] ?>" class="lazyload" alt="<?= $arResult['image']['alt'] ?>">
			<?php endif; ?>
			<div class="offer__info">
				<?php if($arResult['title']['text']): ?>
					<<?= $arResult['title']['state']; ?> class="section-title">
						<?= $arResult['title']['text']; ?>
					</<?= $arResult['title']['state']; ?>>
				<?php endif; ?>
				<?php if($arResult['content']): ?>
				<div class="offer__text format-text">
					<?= $arResult['content'] ?>
				</div>
				<?php endif; ?>
				<?php if($arResult['link']): ?>
				<a href="<?= $arResult['link'] ?>" class="btn"><?= $arResult['link_text'] ?></a>
				<?php endif; ?>
			</div>							
		</div>
	</div>
</div>
				

			















