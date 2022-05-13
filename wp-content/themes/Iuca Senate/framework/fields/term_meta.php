<?php

  use Carbon_Fields\Container;
  use Carbon_Fields\Field;

  $tags = array(
    'span'  => 'span',
    'h1'    => 'h1',
    'h2'    => 'h2',
    'h3'    => 'h3',
    'h4'    => 'h4',
    'h5'    => 'h5',
    'p'     => 'p',
  );

  Container::make('term_meta', 'Настраиваемый заголовок страницы')
    ->where('term_taxonomy', '=', 'product_cat')
    ->or_where('term_taxonomy', '=', 'product_tag')
        ->add_fields(array(
          Field::make('separator', 'title','Настраиваемый заголовок' ),
          Field::make('select', 'title_status', 'Статус заголовка')->set_options( $tags ) ->set_default_value('h1') ->set_width(20),
          Field::make('text', 'title_text', 'Текст заголовка')->set_width(80),
          
          Field::make('separator', 'banner_sep','Баннер' ),
          Field::make('image', 'banner_image', 'Изображение баннера')->set_width(30),
          Field::make('rich_text', 'banner_content', 'Текст баннера')->set_width(70),


          Field::make('separator', 'devs_sep','Производители' ),
          Field::make('select', 'devs_status', 'Статус заголовка')->set_options( $tags ) ->set_default_value('h2') ->set_width(20),
          Field::make('text', 'devs_text', 'Текст заголовка')->set_width(80),
          Field::make('association', 'devs_links' , 'Выбрать услуги' )
                                ->set_types(array(
                                    array(
                                        'type'      => 'term',
                                        'taxonomy' => 'product_tag',
                                    )
                                )),

          Field::make('separator', 'fos_sep','ФОС' ),
          Field::make('select', 'fos_status', 'Статус заголовка ФОС')->set_options( $tags ) ->set_default_value('span') ->set_width(20),
          Field::make('text', 'fos_text', 'Заголовок ФОС')->set_width(80),
          Field::make('rich_text', 'fos_content', 'Текст ФОС')->set_width(70),
          Field::make('image', 'fos_image', 'Изображение ФОС')->set_width(30),

          Field::make('separator', 'seo_sep', 'Баннер' ),
          Field::make('rich_text', 'seo_content', 'Текст для СЕО'),
          

    
     ));


Container::make('term_meta', 'Настраиваемый заголовок страницы')
    ->where('term_taxonomy', '=', 'product_tag')
//    ->or_where('term_taxonomy', '=', 'product_cat')
    ->add_fields(array(
        Field::make('image', 'brand_image', 'Изображение баннера')->set_width(30),
        Field::make('checkbox', 'brand_click', 'Бренд кликабелен?')->set_width(30),
    ));

