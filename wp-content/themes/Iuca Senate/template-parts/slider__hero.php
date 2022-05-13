<?php

$arResult = [
    
    'slides' => $args['slides'],
    'advantages' =>  $args['advantages'],
    
];

?>




<?php if($arResult['slides']): ?>
<div class="hero">		

    <div class="hero__bgs">
        <?php foreach ($arResult['slides'] as $item): 
            $hero = wp_get_attachment_url($item['image'], 'hero');
            ?>
        <div class="hero__bg" style="background-image: url('<?= $hero ?>');"></div>
        <?php endforeach; ?>
    </div>

    <div class="container">			
    
        <div class="hero-block">		
            <?php foreach ($arResult['slides'] as $item):  ?>
            <div class="hero__info">
                <?php if($item['title']): ?>
                <div class="hero__suptitle"><?= $item['title'] ?></div>
                <?php endif; ?>
                <?php if($item['title_bold']): ?>
                <<?= $item['title_state'] ?> class="hero__title"><?= $item['title_bold'] ?></<?= $item['title_state'] ?>>
                <?php endif; ?>
                <?php if( $item['content']): ?>
                <div class="hero__text format-text">
                <?= apply_filters('the_content', $item['content']); ?> 
                </div>
                <?php endif; ?>	
                <?php if( $item['btn_text']): ?>	
                <a class="btn hero__btn" href="<?= $item['btn_link'] ?>"><?= $item['btn_text'] ?></a>
                <?php endif; ?>							

            </div>
            <?php endforeach; ?>
        </div>			
        <?php if($arResult['advantages']): ?>
        <div class="tizers">
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
<?php endif; ?>
