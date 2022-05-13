<?php

$arResult = [
    'logo' => [
        'first' => [
            'link' => wp_get_attachment_image_url(carbon_get_theme_option( 'footer_logo_first' ), 'full'),
            'alt' => get_post_meta(carbon_get_theme_option( 'footer_logo_first' ), '_wp_attachment_image_alt', TRUE),
        ],
    ],  
    'desc' => carbon_get_theme_option( 'footer_description' ),
    'phones' => carbon_get_theme_option( 'footer_phones' ), 
    'mails' => carbon_get_theme_option( 'footer_mails' ),
    'social' => carbon_get_theme_option( 'footer_list_social' ),
    'address' => carbon_get_theme_option( 'footer_address' ),   
    'hours' => carbon_get_theme_option( 'footer_hours' ),
    'copy' => carbon_get_theme_option( 'copy' ),


    'side_social' => carbon_get_theme_option( 'side_list_social' ),
];

?>

<footer class="footer">

    <div class="footer-top">

        <div class="container">
            <div class="footer-top-block">

                <div class="footer-head">
                    <?php if(!is_front_page()): ?>

                    <a href="/" class="logo footer__logo">
                        <img src="<?= $arResult['logo']['first']['link']; ?>" alt="<?= $arResult['logo']['first']['alt']; ?>">
                    </a>

                    <?php else: ?>

                    <span class="logo footer__logo">
                        <img src="<?= $arResult['logo']['first']['link']; ?>" alt="<?= $arResult['logo']['first']['alt']; ?>">
                    </span>

                    <?php endif; ?>	
                    <?php if($arResult['desc']): ?>
                    <span class="slogan footer__slogan"><?= $arResult['desc']; ?></span>
                    <?php endif; ?>
                    <?php if($arResult['social']): ?>
                    <div class="socials footer__socials">		
                        <?php foreach ($arResult['social'] as $item):
                        $image = wp_get_attachment_image_url($item['footer_icon_social'], 'full');
                        $alt = get_post_meta($item['footer_icon_social'], '_wp_attachment_image_alt', TRUE);
                        $link = $item['footer_link_social'];
                        ?>			
                        <a href="<?= $link ?>" target="_blank" class="socials__link"><img src="<?= $image ?>" alt="<?= $alt ?>" class="svg"></a>		
                        <?php endforeach; ?>	
                    </div>
                    <?php endif; ?>

                </div>

                <div class="footer-menu-block">
                            
                    <?php if(wp_nav_menu( array(
                            'theme_location'  => 'footer_menu_1',
                            'container'       => false,
                            'menu_class'      => 'footer-menu__list',
                            'depth'           => 1,
                            'walker'          => new walker_bem_footer_menu_top('footer-menu-item'),
                        ) )): ?> 
                    <div class="footer-menu">

                        <div class="footer__title">Информация</div>

                      
                        
                        <?php
                        wp_nav_menu( array(
                            'theme_location'  => 'footer_menu_1',
                            'container'       => false,
                            'menu_class'      => 'footer-menu__list',
                            'depth'           => 1,
                            'walker'          => new walker_bem_footer_menu_top('footer-menu-item'),
                        ) );
                        ?>

                    </div>

                    <?php endif; ?>
                    
                    <?php if( wp_nav_menu( array(
                            'theme_location'  => 'footer_menu_2',
                            'container'       => false,
                            'menu_class'      => 'footer-menu__list',
                            'depth'           => 1,
                            'walker'          => new walker_bem_footer_menu_top('footer-menu-item'),
                        ) )): ?>
                    <div class="footer-menu">

                        <div class="footer__title">Все о нас</div>

                       
                        
                        <?php
                        wp_nav_menu( array(
                            'theme_location'  => 'footer_menu_2',
                            'container'       => false,
                            'menu_class'      => 'footer-menu__list',
                            'depth'           => 1,
                            'walker'          => new walker_bem_footer_menu_top('footer-menu-item'),
                        ) );
                        ?>

                    </div>
                    <?php endif; ?>
                </div>

                <div class="footer-contacts-block">

                    <div class="footer__title">Контакты</div>
                    <?php if($arResult['phones']): ?>
                    <div class="phones footer__phones">
                        <?php
                        foreach ($arResult['phones'] as $item):
                            
                            $link = preg_replace( array( '/\s/', '/\(/', '/\)/', '/-/' ), '', $item['phone'] );
                            $text = $item['phone'];
                           
                            
                             if( $link[0] != '+' ) {
                                $link[0] = '7';
                                $link = '+'.$link;
                            }


                        ?>
                        <a href="tel:<?= $link ?>"><?= $text ?></a>
                        <?php endforeach; ?>
                    </div>	
                    <?php endif; ?>

                    <div class="footer-contacts">
                        <?php if($arResult['mails']): ?>
                        <div class="contact">
                            <img src="<?= _assets(); ?>/img/mail-icon.svg" alt="Alt" class="svg">
                            <?php
                            foreach ($arResult['mails'] as $item):
                                $text = $item['mail']; ?>
                            <a href="mailto:<?= $text ?>"><?= $text ?></a>
                           <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <?php if($arResult['hours']): ?>
                        <div class="contact">
                            <img src="<?= _assets(); ?>/img/clock-icon.svg" alt="Alt" class="svg">
                            <span><?= $arResult['hours']; ?></span>
                        </div>	
                        <?php endif; ?>	
                        <?php if($arResult['address']): ?>
                        <div class="contact">
                            <img src="<?= _assets(); ?>/img/pin-icon.svg" alt="Alt" class="svg">
                            <span> <?= $arResult['address']; ?></span>
                        </div>	
                        <?php endif; ?>
                    </div>											

                </div>					

            </div>
        </div>
    </div>		

    <div class="footer-bot">
        <div class="container">
            <div class="footer-bot-block">
                <div class="copy">
                    © 2020, Хаус Люкс. <br>
                    Все материалы данного сайта являются объектами авторского права (в том числе дизайн). Запрещается копирование, распространение (в том числе путем копирования на другие сайты и ресурсы в Интернете) или любое иное использование информации и объектов без предварительного согласия правообладателя.
                </div>
                <a href="http://mtsite.ru" target="_blank" rel="nofollow" class="developer">							
                    <span class="developer__logo"><img src="<?= _assets(); ?>/img/multisite.svg" alt="multi site"></span>
                    <span class="developer__title">Сделано в веб-студии "Мультисайт"<br>Разработка и продвижение сайтов.</span>
                </a>
            </div>
        </div>
        <div class="container">	
            <br>		
            <div class="recapcha-copy copy">
                        Этот сайт защищен reCAPTCHA и применяются <a target="_blank" rel="nofollow" href="https://policies.google.com/privacy">Политика конфиденциальности</a> и <a target="_blank" rel="nofollow" href="https://policies.google.com/terms">Условия использования</a> Google.
            </div>
            
        </div>
    </div>

</footer>	



<?php if($arResult['side_social']): ?>
<div class="social-panel-wrapper">
    <div class="social-panel">
        <div class="social__title"> Cоц. сети:</div>
        <div class="social">
            <?php foreach ($arResult['side_social'] as $item):
            $image = wp_get_attachment_image_url($item['side_icon_social'], 'full');
            $alt = get_post_meta($item['side_icon_social'], '_wp_attachment_image_alt', TRUE);
            $link = $item['side_link_social'];
            ?>							
            <a href="<?= $link ?>" target="_blank" class="social__link"><img src="<?= $image ?>" alt="<?= $alt ?>" class="svg"></a>		
            <?php endforeach; ?>						
        </div>
    </div>
</div>
<?php endif; ?>

	


