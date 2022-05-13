<?php

$arResult = [
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
    ],
    'caption' => apply_filters( 'the_content', $args['content'] ),
    'service_list' => $args['service_list']
];

?>




<div class="section services">
    <div class="container">
        <div class="services-block">

            <div class="services__info">
                <<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>
                <div class="format-text">
                    <?= $arResult['caption']; ?>                
                </div>
            </div>

            <div class="services__items">
                <div class="services__items-block">
                    <?php foreach ($arResult['service_list'] as $item): 
                         $image = wp_get_attachment_image_url($item['image']); 
                         $image_alt = get_post_meta($item['image'], '_wp_attachment_image_alt', TRUE);  
                    ?>
                        
                    <a href="<?php the_permalink( $item['links'][0]['id']); ?>" class="service">
                        <img src="<?= $image; ?>" alt="<?= $image_alt; ?>">
                        <span class="service__title"><?= $item['text']; ?></span>
                    </a>

                    <?php endforeach; ?>
                   								
                </div>
            </div>

        </div>						
    </div>	

</div>
