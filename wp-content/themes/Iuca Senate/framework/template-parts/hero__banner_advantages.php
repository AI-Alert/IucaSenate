<?php

// ->add_fields('hero__banner_advantages', 'Баннер с преимуществами',  array(
//     Field::make( 'select', 'title_state', 'Статус заголовка' )
//         ->set_width(10)
//         ->set_options( array(
//             'span'  => 'span',
//             'h1'    => 'h1',
//             'h2'    => 'h2',
//             'h3'    => 'h3',
//             'h4'    => 'h4',
//             'h5'    => 'h5',
//             'p'     => 'p',                
//         ) )
//         ->set_default_value( 'h1' ),
//     Field::make( 'text', 'title', 'Заголовок' )
//         ->set_width(45)
//         ->set_default_value('Трудоустройство специалистов'), 
//     Field::make( 'text', 'title_bold', 'Заголовок (большими буквами)' )  
//         ->set_width(45)
//         ->set_default_value('на суда дальнего плавания'),           
//     Field::make( 'image', 'image', 'Фоновая картинка' )
//         ->set_width(25),
//     Field::make( 'rich_text', 'content', 'Описание' )
//         ->set_width(75)
//         ->set_default_value('Разнообразный и богатый опыт новая модель организационной деятельности позволяет выполнять важные задания'),
//     Field::make( 'complex', 'advantages_list', ' ' )
//         ->setup_labels( array(
//             'plural_name' => 'Преимущества',
//             'singular_name' => 'преимущество',
//         ))
//         ->add_fields( 'advantages', 'Преимущество',  array(
//             Field::make( 'image', 'image', 'Иконка' )
//                 ->set_width(25),        
//             Field::make( 'textarea', 'text', 'Описание' )
//                 ->set_width(75)                               
//         )) 
// ))

$arResult = [
    'background' => [
            'blur'  => wp_get_attachment_image_url($args['image'], 'blur'), 
            'hero'  => wp_get_attachment_image_url($args['image'], 'hero')
    ],
    'title' => [
        'state' => $args['title_state'], 
        'text'  => $args['title'],
        'bold'  => $args['title_bold'],
    ],
    'caption' => apply_filters( 'the_content', $args['content'] ),
    'advantages_list' => $args['advantages_list']
];

?>

<div class="hero" style="background-image: url('<?= $arResult['background']['hero']; ?>');">
    <div class="container">
        <div class="hero-block">
            <<?= $arResult['title']['state']; ?> class="hero__title"> <?= $arResult['title']['text']; ?> <span> <?= $arResult['title']['bold']; ?> </span></<?= $arResult['title']['state']; ?>>
            <div class="hero__text format-text format-text--w">
                <?= $arResult['caption']; ?>
            </div>
            <?php if($arResult['advantages_list']): ?>
            <div class="hero__tizers"> 
                <?php 
                    foreach ($arResult['advantages_list'] as $arItem): 
                        $image = wp_get_attachment_image_url($arItem['image']); 
                        $image_alt = get_post_meta($arItem['image'], '_wp_attachment_image_alt', TRUE);
                ?>            
                <div class="hero__tizer">
                    <img src="<?= $image; ?>" alt="<?= $image_alt; ?>" class="hero__tizer-icon svg">
                    <div class="hero__tizer-text">
                        <?= wpautop($arItem['text']); ?>
                    </div>
                </div> 
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

