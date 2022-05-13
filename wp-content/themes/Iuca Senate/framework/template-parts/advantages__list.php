<?php

$arResult = [
    'advantages_list' => $args['advantages']
];

?>



<div class="advantages">
    <div class="container">
        <div class="advantages-block">
        <?php foreach($arResult['advantages_list'] as $item): ?>
            <div class="advantage">
                <img src="<?= wp_get_attachment_image_url($item['image']); ?>" alt="<?= get_post_meta($item['image'], '_wp_attachment_image_alt', TRUE); ?>">
                <span class="advantage__title"><?= $item['text']; ?></span>
            </div>
        <?php endforeach; ?>   						
        </div>
    </div>	
</div>