<?php 
//Template Name: Контакты



$arResult = [
    'title' => [
        'state' => carbon_get_the_post_meta('title_state'), 
        'text'  => carbon_get_the_post_meta('title'),
    ],
	
    'address' => carbon_get_the_post_meta('address'),
	'hours' => carbon_get_the_post_meta('hours'),
	'phones' => carbon_get_the_post_meta('phones'),
	'mail' => carbon_get_the_post_meta('mail'),
	'social' => carbon_get_the_post_meta('list_social'),
	'coord_1' => carbon_get_the_post_meta('coord_1'),
	'coord_2' => carbon_get_the_post_meta('coord_2'),
	'image' =>[
		'full' => wp_get_attachment_image_url( carbon_get_the_post_meta('image'), 'full'),
		'middle' => wp_get_attachment_image_url( carbon_get_the_post_meta('image'), 'middle'),
		'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('image'), 'blur'),
		'alt' => get_post_meta( carbon_get_the_post_meta('image'), '_wp_attachment_image_alt', TRUE), 
	],
	'map_image' =>[
		'full' => wp_get_attachment_image_url( carbon_get_the_post_meta('map_image'), 'full'),
		'blur' => wp_get_attachment_image_url( carbon_get_the_post_meta('map_image'), 'blur'),
		'alt' => get_post_meta( carbon_get_the_post_meta('map_image'), '_wp_attachment_image_alt', TRUE), 
	],
	'map_text' => carbon_get_the_post_meta('map_text'),
];

get_header(); ?>



<main class="main">	

	<div class="breadcrumbs-block">
        <div class="container">
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<ul class="breadcrumbs__list">','</ul>' );
                }	
			
            ?>
        </div>
    </div>		

	<div class="contacts-section">			

		<div class="container">		

			<<?= $arResult['title']['state']; ?> class="section-title">
                <?if($arResult['title']['text']): echo $arResult['title']['text']; else: the_title(); endif; ?>
            </<?= $arResult['title']['state']; ?>>

			<div class="contacts-block">												

				<div class="contacts">	
					<?php if($arResult['phones'] || $arResult['social']): ?>
					<div class="contacts__item">
						<?php if($arResult['phones']): ?>
						<div class="contact__title">Телефон:</div>
						<div class="phones contacts__phones">
							<img src="<?= _assets(); ?>/img/phone-icon.svg" alt="Телефоны" class="svg">
							<?php foreach ($arResult['phones'] as $item): 
									
									$link = preg_replace( array( '/\s/', '/\(/', '/\)/', '/-/' ), '', $item['phone'] );
									
									 if( $link[0] != '+' ) {
                                        $link[0] = '7';
                                        $link = '+'.$link;
                                    }
                            
                            ?>
							<a href="tel:<?= $link; ?>"><?= $item['phone']; ?></a>
							<?php endforeach; ?>
						</div>	
						<?php endif; ?>
						<?php if($arResult['social']): ?>
						<div class="socials contacts__socials">	
							<?php foreach ($arResult['social'] as $item):
								$image = wp_get_attachment_image_url($item['icon_social'], 'full');
								$alt = get_post_meta($item['icon_social'], '_wp_attachment_image_alt', TRUE);
								$link = $item['link_social'];
							?>			
							<a href="<?= $link ?>" target="_blank" class="socials__link"><img src="<?= $image ?>" alt="<?= $alt ?>" class="svg"></a>		
							<?php endforeach; ?>							
						</div>
						<?php endif; ?>
					</div>										
					<?php endif; ?>
					<?php if($arResult['hours']): ?>
					<div class="contacts__item">
						<div class="contact__title">Режим работы:</div>
						<div class="contact">
							<img src="<?= _assets(); ?>/img/clock-icon.svg" alt="Alt" class="svg">
							<span><?= $arResult['hours']; ?></span>
						</div>			
					</div>
					<?php endif; ?>
					<?php if($arResult['mail']): ?>
					<div class="contacts__item">
						<div class="contact__title">Почта:</div>
						<a href="mailto:<?= $arResult['mail']; ?>" class="contact">
							<img src="<?= _assets(); ?>/img/mail-icon.svg" alt="Alt" class="svg">
							<?= $arResult['mail']; ?>
						</a>	
					</div>
					<?php endif; ?>
					<?php if($arResult['address']): ?>
					<div class="contacts__item">
						<div class="contact__title">Адрес:</div>
						<div class="contact">
							<img src="<?= _assets(); ?>/img/pin-icon.svg" alt="Alt" class="svg">
							<span><?= $arResult['address']; ?></span>
						</div>	
						<?php if($arResult['image']['full']): ?>
						<a href="<?= $arResult['image']['full']; ?>" class="contacts__photo"><img  class="lazyload" data-src="<?= $arResult['image']['middle']; ?>" src="<?= $arResult['image']['blur']; ?>" alt="<?= $arResult['image']['alt']; ?>"></a>
						<?php endif; ?>
					</div>			
					<?php endif; ?>
				</div>

			</div>
		</div>
			

			<div class="map" id="map"></div>	
				<script>											
				setTimeout(function(){
					var elem = document.createElement('script');
					elem.type = 'text/javascript';
					elem.src = 'https://api-maps.yandex.ru/2.1/?load=package.standard&lang=ru-RU&onload=getYaMap';
					document.getElementsByTagName('body')[0].appendChild(elem);
				}, 3500);

				function getYaMap(){
					ymaps.ready(init);
					var myMap,
					myPlacemark;
					var	html  = '<div class="map-popup"><?= $arResult['map_text']; ?></div>';
					function init(){
						myMap = new ymaps.Map("map", {
							center: [<?= $arResult['coord_1']; ?>, <?= $arResult['coord_2']; ?>],								
							zoom: 16,
							controls: ['zoomControl', 'geolocationControl']
						});											
						myPlacemark = new ymaps.Placemark([<?= $arResult['coord_1']; ?>, <?= $arResult['coord_2']; ?>], {
							balloonContent: html
						},{
							iconLayout: 'default#image',
							iconImageHref: '<?= $arResult['map_image']['full']; ?>',
							iconImageSize: [46, 64],
							iconImageOffset: [-23, -64],
							hideIconOnBalloonOpen: false,
							balloonOffset: [55, 65]
						});							
						myMap.geoObjects.add(myPlacemark);	
						myMap.options.set({balloonPanelMaxMapArea:'0'});																		
						myMap.behaviors.disable('scrollZoom');	
						if ($(window).innerWidth() < 1024) {
							myMap.behaviors.disable('drag');
						};	
					}
				}
			</script>

		</div>										

</main>



<?php

get_footer(); 	