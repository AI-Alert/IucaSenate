<?php

$arResult = [
    'logo' => [
        'link' => wp_get_attachment_image_url(carbon_get_theme_option( 'footer_logo' )),
        'alt' => get_post_meta(carbon_get_theme_option( 'footer_logo' ), '_wp_attachment_image_alt', TRUE),
    ],
    'phones' => carbon_get_theme_option( 'header_phones' ),
    'hours' => carbon_get_theme_option( 'footer_hours' ),
    'address' =>  carbon_get_theme_option( 'footer_address' ),
    'mail' => carbon_get_theme_option( 'footer_mail' ),
    'slogan' => carbon_get_theme_option( 'footer_slogan' ),
    'social' => carbon_get_theme_option( 'header_list_social' ),
    'copy' => carbon_get_theme_option( 'copy' ),
];



?>



<footer class="footer">

    <div class="footer-top">

        <div class="container">
            <div class="footer-top-block">

                <div class="footer-head">

                    <div class="logo-block footer__logo-block">
                         <?php if(!is_front_page()): ?>
                        <a href="/" class="logo">
                            <img src="<?= $arResult['logo']['link']; ?>" alt="<?= $arResult['logo']['alt']; ?>">
                        </a>
                        <?php else: ?>
                        <span class="logo">
                            <img src="<?= $arResult['logo']['link']; ?>" alt="<?= $arResult['logo']['alt']; ?>">
                        </span>
                        <?php endif; ?>
                        <div class="slogan"><?= $arResult['slogan']; ?></div>
                    </div>

                    <div class="social footer__social">
                    <?php foreach ($arResult['social'] as $item): ?>
                    <a href="<?= $item['header_link_social']; ?>" target="_blank" class="social__link"><img src="<?= wp_get_attachment_image_url($item['header_icon_social']); ?>" alt="<?= wp_get_attachment_image_url($item['header_icon_social']); ?>" class="svg"></a>
                    <?php endforeach; ?>                     
                    </div>

                </div>

                <div class="footer-menu">

                    <?php wp_nav_menu( array(
                        'theme_location'  => 'footer_menu1',
                        'container'       => false,
                        'menu_class'      => 'footer-menu__list',
                        'depth'           => 1,
                        'walker'          => new walker_bem_footer_menu('footer-menu'),
                    ) ); ?>


                    <?php wp_nav_menu( array(
                        'theme_location'  => 'footer_menu2',
                        'container'       => false,
                        'menu_class'      => 'footer-menu__list',
                        'depth'           => 1,
                        'walker'          => new walker_bem_footer_menu('footer-menu'),
                    ) ); ?>


                    <?php wp_nav_menu( array(
                        'theme_location'  => 'footer_menu3',
                        'container'       => false,
                        'menu_class'      => 'footer-menu__list',
                        'depth'           => 1,
                        'walker'          => new walker_bem_footer_menu('footer-menu'),
                    ) ); ?>

                   
                </div>

                <div class="footer-contacts">

                    <div class="phone footer__phone">
                        <img src="<?= _assets(); ?>/img/phone.svg" alt="Alt" class="svg">
                        <div class="phone__tels">
                        <?php foreach ($arResult['phones'] as $item):                                              
                                $link = preg_replace( array( '/\s/', '/\(/', '/\)/', '/-/' ), '', $item['phone'] );
                                $text = $item['phone'];                           
                        ?>
                            <a href="tel:<?= $link; ?>" class="phone__tel"><?= $text; ?></a>

                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php if($arResult['mail']): ?>
                    <div class="footer-contact">
                        <img src="<?= _assets(); ?>/img/email.svg" alt="Alt" class="svg">
                        <div class="footer-contact__info"><a href="mailto:<?= $arResult['mail']; ?>"><?= $arResult['mail']; ?></a></div>
                    </div>
                    <?php endif; ?>
                    <?php if($arResult['hours']): ?>
                    <div class="footer-contact">
                        <img src="<?= _assets(); ?>/img/time.svg" alt="Alt" class="svg">
                        <div class="footer-contact__info"><?= $arResult['hours']; ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if($arResult['address']): ?>
                    <div class="footer-contact">
                        <img src="<?= _assets(); ?>/img/placeholder.svg" alt="Alt" class="svg">
                        <div class="footer-contact__info"><?= $arResult['address']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bot">
        <div class="container">
            <div class="footer-bot-block">
                <div class="copy">
                   <?= $arResult['copy']; ?>
                </div>

                <div class="developer">
                    <a href="https://mtsite.ru" target="_blank" rel="nofollow" class="developer__logo"><img
                            src="<?= _assets(); ?>/img/multisite.svg" alt="multi site"></a>
                    <span class="developer__title">Сделано в <a href="https://mtsite.ru" target="_blank"
                            rel="nofollow">веб-студии "Мультисайт"</a><br>Разработка и продвижение сайтов.</span>
                </div>

            </div>
        </div>
		<div class="container">
				
			<div class="recapcha-copy copy">
			  Этот сайт защищен reCAPTCHA и применяются <a target="_blank" rel="nofollow" href="https://policies.google.com/privacy">Политика
																									  конфиденциальности</a> и <a target="_blank" rel="nofollow" href="https://policies.google.com/terms">Условия
																																																		  использования</a> Google.
			</div>
			<br>
		 </div>
    </div>

</footer>


<button class="up"></button>	