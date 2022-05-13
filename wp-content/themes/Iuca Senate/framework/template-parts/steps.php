<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'steps' => $args['steps'],
];

?>



<div class="section section--bg steps">
    <div class="container">
    <<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>
        <ol class="steps__list">
            <?php foreach ($arResult['steps'] as $item):
                 $image = wp_get_attachment_image_url($item['image']);
                 $image_alt = get_post_meta($item['image'], '_wp_attachment_image_alt', TRUE);             
                ?>
            <li class="step">
                <span class="step__icon"><img src="<?= $image; ?>" alt="<?= $image_alt; ?>"></span>
                <span class="step__title"><?= $item['name'] ?></span>
                <span class="step__text format-text"><?= $item['desc'] ?></span>
            </li>
            <?php endforeach; ?>
            
        </ol>

        <button data-href="#callback" class="btn steps__btn">Оставить заявку</button>

    </div>
</div>