<?php
$arResult = [
	'title' => [
		'state' => $args['title_state'],
		'text' => $args['title'],
	],
	'content' => apply_filters('the_content', $args['content']),
	'preview' => $args['preview'],
	'advantages' => $args['advantages'],
];

?>






<div class="section about">
	<div class="container">								
		<div class="about-block clearfix">						
			<div class="about__slider">
				<?php foreach ($arResult['preview'] as $item): ?>	
					<?php if($item['_type'] == 'video'):
					$image = [
						'middle' => wp_get_attachment_image_url($item['preview'], 'middle'),
						'blur' => wp_get_attachment_image_url($item['preview'], 'blur'),
						'alt' => get_post_meta($item['preview'], '_wp_attachment_image_alt', TRUE), 
					];
					
					?>
					<a href="<?= $item['link'] ?>" class="about__multimedia about__multimedia--video" data-fancybox><img src="<?= $image['blur'] ?>" data-src="<?= $image['middle'] ?>" class="lazyload" alt="<?= $image['alt'] ?>"><span class="play"><img src="<?= _assets(); ?>/img/play.svg" alt="Alt" class="svg"></span></a>
					<?php else:
						$image = [
							'full' => wp_get_attachment_image_url($item['preview'], 'full'),
							'middle' => wp_get_attachment_image_url($item['preview'], 'middle'),
							'blur' => wp_get_attachment_image_url($item['preview'], 'blur'),
							'alt' => get_post_meta($item['preview'], '_wp_attachment_image_alt', TRUE), 
						];
							?>
					<a href="<?= $image['full'] ?>" class="about__multimedia"><img src="<?= $image['blur'] ?>" class="lazyload" data-src="<?= $image['middle'] ?>" alt="<?= $image['alt'] ?>"></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="about__info">
				<?php if($arResult['title']['text']): ?>
					<<?= $arResult['title']['state']; ?> class="section-title">
						<?= $arResult['title']['text']; ?>
					</<?= $arResult['title']['state']; ?>>
				<?php endif; ?>
				<?php if($arResult['content']): ?>
				<div class="about__text format-text">
					<?= $arResult['content'] ?>
				</div>
				<?php endif; ?>
			</div>						
		</div>	


		<?php if($arResult['advantages']): ?>
		<div class="tizers about__tizers">
			<?php foreach ($arResult['advantages'] as $item):
                $alt = get_post_meta($item['icon'], '_wp_attachment_image_alt', TRUE);
                $full = wp_get_attachment_url($item['icon'], 'full');                
                ?>
				<div class="tizer">
					<img src="<?= $full ?>" alt="<?= $alt ?>">
					<span class="tizer__title"><?= $item['text'] ?></span>
				</div>						
			<?php endforeach; ?>	
		</div>
		<?php endif; ?> 
	</div>	
</div>


					

			















