<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'caption' => apply_filters( 'the_content', $args['content'] )
];

?>


<div class="section seo">
    <div class="container">
<?php if($arResult['title']['text']){ ?><<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>> <?php } ?>
        <div class="seo-block">
            <div class="seo__text format-text clearfix">
                <?= $arResult['caption']; ?>
            </div>
        </div>

    </div>
</div>

