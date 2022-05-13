<?php
	$arResult = [
		'image' => [
			'middle' => wp_get_attachment_image_url($args['image'], 'middle'),
			'blur' => wp_get_attachment_image_url($args['image'], 'blur'),
		],
		'title' => [
			'state' => $args['title_state'],
			'text' => $args['title'],
		],
	
	];

	
	$id_form = rand(1, 999);
	?>



<div class="section cta">
	<div class="container">

		<div class="cta-block">

			<div class="cta__bg lazyload" style="background-image: url('<?= $arResult['image']['blur'] ?>');" data-src="<?= $arResult['image']['middle'] ?>"></div>	

					<?php if($arResult['title']['text']): ?>
						<<?= $arResult['title']['state']; ?> class="section-title">
							<?= $arResult['title']['text']; ?>
						</<?= $arResult['title']['state']; ?>>
					<?php endif; ?>

					<div class="cta__form id_<?= $id_form ?>">

					<?= do_shortcode('[contact-form-7 id="168" title="Открытая ФОС" html_class="form"]'); ?>

					<script> 
						document.querySelector('.cta__form.id_<?= $id_form ?>  .check-wrapper .wpcf7-list-item > label').classList.add('custom-checkbox');
						document.querySelector('.cta__form.id_<?= $id_form ?>  .check-wrapper .custom-checkbox').insertBefore(document.createElement('span'), document.querySelector('.cta__form.id_<?= $id_form ?> .check-wrapper .wpcf7-list-item .custom-checkbox .wpcf7-list-item-label'));
						document.querySelector('.cta__form.id_<?= $id_form ?>  .check-wrapper .wpcf7-list-item > label > input').classList.add('input-check');
					</script>  

					</div>
			</div>

	</div>
</div>		
