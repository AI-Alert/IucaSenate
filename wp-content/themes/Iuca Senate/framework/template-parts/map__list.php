<?php 

$arResult = [
    'title' => [
        'state' => $args['title_state'],
        'text' => $args['title'],
    ],
    'list' => $args['list']
];




?>



<div class="section partners">
    <div class="container">
        <<?= $arResult['title']['state']; ?> class="section-title"><?= $arResult['title']['text']; ?></<?= $arResult['title']['state']; ?>>

        <div class="partners-block">

            <div class="partners__list">

            
                <?php
                $list = $arResult['list'];
                $counter = 0;
                foreach($list as $item):
                    

                ?>

                <div class="partner" data-item="<?= $counter; ?>">
                    <div class="partner__country"><?= $item['name']; ?></div>
                    <div class="partner__count"><?= $item['count']; ?></div>
                </div> 
                
                <?php $counter++;
                    endforeach;
                ?>
               

            </div>

            <div class="partners__map" id="partnersMap">

                <script>
                setTimeout(function() {
                    var elem = document.createElement('script');
                    elem.type = 'text/javascript';
                    elem.src =
                        'https://api-maps.yandex.ru/2.1/?load=package.standard&lang=<?= sl('ru-RU', 'en-US'); ?>&onload=getYaMap';
                    document.getElementsByTagName('body')[0].appendChild(elem);
                }, 3500);

                function getYaMap() {
                    ymaps.ready(init);
                    var myMap,
                        html;
                    var myPlacemark = [];
                    var locations = [
                        <?php
                        $list = $arResult['list'];
                       // $counter = 0;
                        $counter2 = 0;
                        foreach($list as $item):
                        ?>
                        {                        
                            x: <?= $item['map_x']; ?>,
                            y: <?= $item['map_y']; ?>,
                            html: '<div class="map-popup"><b><?= $item['name']; ?></b></div>'
                        }<?php $counter2++; if($counter != $counter2): echo ','; endif; ?>
                        <?php endforeach; ?>
                    ];

                    function init(objects) {
                        myMap = new ymaps.Map("partnersMap", {
                            center: [55.673560, 23.665389],
                            zoom: 1.5 + (($(window).width() < 768) ? +0 : +1),
                            controls: ['zoomControl', 'geolocationControl']
                        });

                        for (var i = 0; i < locations.length; i++) {
                            myPlacemark[i] = new ymaps.Placemark([locations[i].x, locations[i].y], {
                                balloonContent: locations[i].html
                            }, {
                                iconLayout: 'default#image',
                                iconImageHref: '<?= _html();?>/img/partners-map-marker.png',
                                iconImageSize: [26, 26],
                                iconImageOffset: [5, 0],
                                hideIconOnBalloonOpen: false
                            });
                            myMap.geoObjects.add(myPlacemark[i]);

                        };

                        myMap.behaviors.disable('scrollZoom');
                        if ($(window).innerWidth() < 1024) {
                            myMap.behaviors.disable('drag');
                        };
                        myMap.options.set({
                            balloonPanelMaxMapArea: '0'
                        });
                    }

                    $('.partner').click(function(e) {
                        e.preventDefault();
                        $id = $(this).data('item');
                        myPlacemark[$id].balloon.open();
                    });

                }
                </script>

            </div>

        </div>
    </div>
</div>