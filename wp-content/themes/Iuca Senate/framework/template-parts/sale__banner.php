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

<div class="section discount">
    <div class="container">
        <div class="discount-block lazyload" 
        style="background-image: url('<?= $arResult['image']['blur']; ?>');"
        data-src="<?= $arResult['image']['full']; ?>">
            <div class="discount__info">
                <<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>
                <div class="section-info format-text">
                    <?= $arResult['content']; ?>
                </div>

                <?= do_shortcode('[contact-form-7 id="142" title="Акционный баннер" html_class="form"]'); ?>
            </div>
        </div>
    </div>
</div>


