<?php
$arResult = [
	'title' => [
		'state' => $args['title_state'],
		'text' => $args['title_text'],
	],
	'position' => $args['position'],
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


<div class="section director">
	<div class="container">
		<div class="director-block">
			<div class="director__info">
				<?php if($arResult['title']['text']): ?>
					<<?= $arResult['title']['state']; ?> class="section-title">
						<?= $arResult['title']['text']; ?>
					</<?= $arResult['title']['state']; ?>>
				<?php endif; ?>
				<?php if($arResult['position']): ?>
				<div class="director__subtitle"><?= $arResult['position'] ?></div>
				<?php endif; ?>
				<div class="director__text format-text">
					<blockquote>
						<?= $arResult['content'] ?>
					</blockquote>											
				</div>
				<?php if($arResult['link']): ?>
				<a href="<?= $arResult['link'] ?>" class="btn btn--more"><?= $arResult['link_text'] ?></a>
				<?php endif; ?>
			</div>
			<?php if($arResult['image']['blur']): ?>
			<div class="director__photo">			
				<img src="<?= $arResult['image']['blur'] ?>" data-src="<?= $arResult['image']['hero'] ?>" class="lazyload" alt="<?= $arResult['image']['alt'] ?>">
			</div>
			<?php endif; ?>

		</div>
	</div>

</div>
		

			















