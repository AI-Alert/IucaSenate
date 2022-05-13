<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'content' => apply_filters( 'the_content', $args['content'] )
];

?>

<div class="section seo">
    <div class="container">
        <br>
        <?php if($arResult['title']['text']): ?>
            <<?= $arResult['title']['state']; ?> class="section-title">
                <?= $arResult['title']['text']; ?>
            </<?= $arResult['title']['state']; ?>>
        <?php endif; ?>
        <div class="seo__text format-text clearfix">
            <?= $arResult['content']; ?>
        </div>
    </div>
</div>

