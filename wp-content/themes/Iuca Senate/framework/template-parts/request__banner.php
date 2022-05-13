
	<?php
        $arResult = [
            'image' => [
                'full' => wp_get_attachment_image_url($args['image'], 'hero'),
                'blur' => wp_get_attachment_image_url($args['image'], 'blur'),
                'alt' => get_post_meta($args['image'], '_wp_attachment_image_alt', TRUE), 
            ],
            'title' => [
                'state' => $args['title_state'],
                'text' => $args['title'],
            ],
            'content' => apply_filters('the_content', $args['content'])
        ];
        
        ?>
	<div class="section request">
		<div class="container">
			<div class="request-block">
				<div class="request__image lazyload" style="background-image: url('<?= $arResult['image']['blur']; ?>');" data-src="<?= $arResult['image']['full']; ?>">></div>
				<div class="request__info">
					<<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>
					<div class="section-info format-text">
					    <?= $arResult['content']; ?>
					</div>

				    <?= do_shortcode('[contact-form-7 id="488" title="Акционный баннер 2_copy"  html_class="form"]'); ?>

				</div>
			</div>
		</div>
	</div>
	<style>
	    
	    .section.request .check-wrapper, .section.request .wpcf7-not-valid-tip {
	            filter: brightness(2);
	    }
	</style>
	
