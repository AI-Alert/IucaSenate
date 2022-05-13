<?php
/*

Default call:

get_template_part('framework/template-parts/header/template');

*/


?>

<?php

// Массив данных шапки сайта

$arResult = [
    'logo' => [
        'first' => [
            'link' => wp_get_attachment_image_url(carbon_get_theme_option( 'header_logo_first' ), 'full'),
            'alt' => get_post_meta(carbon_get_theme_option( 'header_logo_first' ), '_wp_attachment_image_alt', TRUE),
        ],
        'second' => [
            'link' => wp_get_attachment_image_url(carbon_get_theme_option( 'header_logo_second' ), 'full'),
            'alt' => get_post_meta(carbon_get_theme_option( 'header_logo_second' ), '_wp_attachment_image_alt', TRUE),
        ],
    ],
    'desc' => carbon_get_theme_option( 'header_description' ),
    'phones' => carbon_get_theme_option( 'header_phones' ),
    'mobile' => carbon_get_theme_option( 'header_mobile_phone'  ),
    'mails' => carbon_get_theme_option( 'header_mails' ),
    'social' => carbon_get_theme_option( 'header_list_social' ),
    'button' => [
        'link' => carbon_get_theme_option( 'header_link' ),
        'text' => carbon_get_theme_option( 'header_link_text' ),
    ],
    'address' => carbon_get_theme_option( 'header_address' ),
    'address_red' => carbon_get_theme_option( 'header_address_red' ),
    'hours' => carbon_get_theme_option( 'header_hours' ),
    'catalog_list' => carbon_get_theme_option( 'catalog_list' ),
    'menu_list' => carbon_get_theme_option( 'menu_list' ),
];

?>






<header class="header" <?php if(is_user_logged_in()) echo 'style="margin-top:32px;"' ?>>

        <div class="overlay"></div>

        <div class="navbar">
            <div class="container">

                <div class="navbar-block">
                    <?php if(!is_front_page()): ?>
                    <a href="/" class="logo navbar__logo">
                        <img src="<?= $arResult['logo']['first']['link']; ?>" alt="<?= $arResult['logo']['first']['alt']; ?>">
                    </a>
                    <?php else: ?>
                    <span class="logo navbar__logo">
                        <img src="<?= $arResult['logo']['first']['link']; ?>" alt="<?= $arResult['logo']['first']['alt']; ?>">
                    </span>
                    <?php endif; ?>

                    <?php if($arResult['desc']): ?>
                    <span class="slogan navbar__slogan"><?= $arResult['desc'] ?></span>
                    <?php endif; ?>


                    <?php if($arResult['phones']): ?>
                    <div class="phones navbar__phones">
                    <?php
                                foreach ($arResult['phones'] as $item):
                                    $link = preg_replace( array( '/\s/', '/\(/', '/\)/', '/-/' ), '', $item['phone'] );
                                    $text = $item['phone']; ?>
                        <a href="tel:<?=  $link  ?>"><?=  $text  ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <?php if($arResult['button']['text']): ?>
                    <button data-href="<?= $arResult['button']['link']; ?>" class="btn btn--bdr navbar__btn"><?= $arResult['button']['text']; ?></button>
                    <?php endif; ?>

                    <?php if($arResult['mobile']):
                    $link = preg_replace( array( '/\s/', '/\(/', '/\)/', '/-/' ), '', $arResult['mobile'] );
                    if( $link[0] != '+' ) {
                                    $link[0] = '7';
                                    $link = '+'.$link;
                                }
                    ?>
                    <a href="tel:<?=  $link  ?>" class="navbar__phone_mobile"><img src="<?= _assets(); ?>/img/phone.svg" alt="Телефон" class="svg"></a>
                    <?php endif; ?>

                    <a class="hamburger hamburger--slider">
                        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                    </a>

                    </div>

                </div>
            </div>

            <div class="menu-block">

                <?php if(!is_front_page()): ?>
                <a href="/" class="logo mobile-menu__logo">
                    <img src="<?= $arResult['logo']['first']['link']; ?>" alt="<?= $arResult['logo']['first']['alt']; ?>">
                </a>
                <?php else: ?>
                <span class="logo mobile-menu__logo">
                    <img src="<?= $arResult['logo']['first']['link']; ?>" alt="<?= $arResult['logo']['first']['alt']; ?>">
                </span>
                <?php endif; ?>


                <a class="hamburger hamburger--slider is-active mobile-menu__hamburger">
                    <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                </a>

                <nav class="menu">

                    <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'header_menu_1',
                        'container'       => false,
                        'menu_class'      => 'menu__list',
                        'depth'           => 3,
                        'walker'          => new walker_bem_header_menu_top('menu'),
                    ) );
                    ?>




                    <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'header_menu_2',
                        'container'       => false,
                        'menu_class'      => 'menu__list menu__list--foot',
                        'depth'           => 1,
                        'walker'          => new walker_bem_header_menu_bottom('menu'),
                    ) );
                    ?>



                    <?php if($arResult['social']): ?>
                    <div class="socials navbar__socials">
                        <?php foreach ($arResult['social'] as $item):
                        $image = wp_get_attachment_image_url($item['header_icon_social'], 'full');
                        $alt = get_post_meta($item['header_icon_social'], '_wp_attachment_image_alt', TRUE);
                        $link = $item['header_link_social'];
                        ?>
                        <a href="<?= $link ?>" target="_blank" class="socials__link"><img src="<?= $image ?>" alt="<?= $alt ?>" class="svg"></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </nav>

            <div class="mobile-menu__bot">
                <?php if($arResult['phones']): ?>
                <div class="phone mobile-menu__phone">
                    <div class="phones contacts__phones">
                        <img src="<?= _assets(); ?>/img/phone-icon.svg" alt="Телефоны" class="svg">
                        <?php
                                foreach ($arResult['phones'] as $item):
                                    $link = preg_replace( array( '/\s/', '/\(/', '/\)/', '/-/' ), '', $item['phone'] );
                                    $text = $item['phone']; ?>
                        <a href="tel:<?=  $link  ?>"><?=  $text  ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($arResult['hours']): ?>
                <div class="mobile-menu__contact">
                    <div class="contact__title">Режим работы:</div>
                    <div class="contact">
                        <span><?= $arResult['hours']; ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($arResult['mails']): ?>
                <div class="mobile-menu__contact">
                    <div class="contact__title">Почта:</div>
                    <div class="contact">
                    <?php foreach ($arResult['mails'] as $item):
                        $text = $item['mail'];
                    ?>
                        <a href="mailto:<?= $text; ?>"><?= $text; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($arResult['address']): ?>
                <div class="mobile-menu__contact">
                    <div class="contact__title">Адрес:</div>
                    <div class="contact">
                        <span><?= $arResult['address']; ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($arResult['button']['text']): ?>
                <button data-href="<?= $arResult['button']['link']; ?>" class="btn btn--bdr mobile-menu__btn">
                    <?= $arResult['button']['text']; ?>
                </button>
                <?php endif; ?>
            </div>
        </div>

    </div>

</header>
