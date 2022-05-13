<?php

$item = [
    'anons_mark' => carbon_get_the_post_meta('anons_mark'),
    'anons_name' => carbon_get_the_post_meta('anons_name'),
    'image' => [
        'blur' => get_the_post_thumbnail_url( get_the_ID(), 'blur'),
        'middle' => get_the_post_thumbnail_url( get_the_ID(), 'middle'),
        'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)
    ],
    'old_price' => carbon_get_the_post_meta('old_price'),
    'regular_price' => carbon_get_the_post_meta('regular_price'),
]

?>


<a href="<?php the_permalink(); ?>" class="kitchen">
    <span class="kitchen__foto">
        <?php if($item['anons_mark'] ): ?>
        <span class="kitchen__labels">
            <?php foreach($item['anons_mark'] as $subitem): ?>

            <span style="background: <?php print_r($subitem['color']); ?>" class="kitchen__label"><?= $subitem['name'] ?></span>

            <?php endforeach; ?>
        </span>
        <?php endif; ?>
        <img class="lazyload" data-src="<?= $item['image']['middle'] ?>" src="<?= $item['image']['blur'] ?>" alt="<?= $item['image']['alt'] ?>">
    </span>
    <span class="kitchen__foot">
        <span class="kitchen__title">
            <?php if($item['anons_name']): echo $item['anons_name']; else: the_title(); endif; ?>
        </span>
        <?php if($item['regular_price']): ?>
        <span class="kitchen__price">
            <?php if($item['old_price']): ?>
            <span class="kitchen__old-price"><?= $item['old_price'] ?></span>
            <?php endif; ?>
            <span class="kitchen__new-price"><?= $item['regular_price'] ?></span>
        </span>
        <?php endif; ?>
    </span>
</a>