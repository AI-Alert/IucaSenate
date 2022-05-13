<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;




// страница Контакты
Container::make('post_meta', 'Страница контакты')
    ->where( 'post_template', '=', 'templates/page-kontakty.php' )
    ->add_fields(array(
        Field::make( 'select', 'title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ))
            ->set_width(20)              
            ->set_default_value( 'span' ),
        Field::make('text', 'title', 'Заголовок')
            ->set_width(80), 
        Field::make('text', 'address', 'Адрес')
            ->set_width(50),
        Field::make('textarea', 'hours', 'Часы работы')
            ->set_width(50),
        Field::make('complex', 'phones', 'Телефоны')
            ->add_fields(array(
                Field::make('text', 'phone', 'Телефон')
                    ->set_attribute( 'placeholder', '+7 (***) ***-****' )
            ))
            ->setup_labels(array('plural_name' => 'Телефоны', 'singular_name' => 'телефон')),
        Field::make('text', 'mail', 'Почта'),
        Field::make('complex', 'list_social', 'Соц.сети')
            ->add_fields(array(
                Field::make('image', 'icon_social', 'Иконка соц.сети')
                    ->set_width(30),
                Field::make('text', 'link_social', 'Введите ссылку')
                    ->set_attribute('placeholder', 'vk.com/company_group')
                    ->set_width(70),
            ))
            ->set_max(5)
            ->setup_labels(array('plural_name' => 'Соц.сеть', 'singular_name' => 'соц.сеть')),        
        Field::make('text', 'coord_1', 'Координаты - Широта')->set_width(50),
        Field::make('text', 'coord_2', 'Координаты - Долгота')->set_width(50),
        Field::make('image', 'image', 'Изображение'),
        Field::make('image', 'map_image', 'Изображение на карте')->set_width(50),
        Field::make('textarea', 'map_text', 'Текст на карте')
            ->set_width(50),
        ));

// страница Новости
Container::make('post_meta', 'Страница новости')
    ->where('post_template', '=', 'templates/category-news.php')
    ->add_fields(array(
        Field::make( 'select', 'title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ) )
            ->set_width(10)              
            ->set_default_value( 'h1' ),
        Field::make( 'text', 'title', 'Заголовок' )
            ->set_width(90),
        Field::make( 'rich_text', 'content', 'Описание' )
            ->set_width(100),
        Field::make( 'rich_text', 'content_bottom', 'Описание после вывода постов' )
            ->set_width(100),   
    ));


// страница Услуга
Container::make('post_meta', 'Страница услуги')
    ->where('post_template', '=', 'templates/single-service.php')
    ->add_tab('Баннер', array(
        Field::make( 'select', 'title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ) )
            ->set_width(10)              
            ->set_default_value( 'h1' ),
        Field::make( 'text', 'title', 'Заголовок' )
            ->set_width(90),
        Field::make( 'complex', 'hero__table', 'Таблица' )
            ->add_fields(array(
                Field::make('text', 'keys', 'Характеристика')
                    ->set_width(50),   
                Field::make('text', 'values', 'Значение')
                    ->set_width(50),   
            ))
            ->set_width(70),
        Field::make( 'image', 'hero__image', 'Изображение' )
            ->set_width(30), 
    ))
    ->add_tab('Продукты', array(
     
        Field::make('rich_text', 'product__content', 'Описание')
    ))
    ->add_tab('Акционный баннер', array(
        Field::make('checkbox', 'sale__off', 'Отключить секцию?'),
        Field::make('image', 'sale__image', 'Фоновое изображение')
            ->set_width(40),
        Field::make( 'select', 'sale__title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ) )
            ->set_width(10)              
            ->set_default_value( 'span' ),
        Field::make('text', 'sale__title', 'Заголовок')
            ->set_width(50),
        Field::make('rich_text', 'sale__content', 'Описание')
            ->set_width(100)
    ))
    ->add_tab('Товары', array(
        Field::make('checkbox', 'goods__off', 'Отключить секцию?'),       
        Field::make( 'select', 'goods__title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ) )
            ->set_width(20)              
            ->set_default_value( 'span' ),
        Field::make('text', 'goods__title', 'Заголовок')
            ->set_width(80),
        Field::make('rich_text', 'goods__content', 'Описание')
            ->set_width(100),
        Field::make('complex', 'goods__list', 'Товары')
            ->add_fields(
                array(
                    Field::make('image', 'image', 'Изображение')
                        ->set_width(33),
                    Field::make('text', 'name', 'Наименование')
                        ->set_width(33),
                    Field::make('text', 'price', 'Цена')
                        ->set_width(33),
                )
            )
            ->set_width(100)
    ))
    ->add_tab('Преимущества', array(
        Field::make('checkbox', 'advantages__off', 'Отключить секцию?'),
        Field::make('image', 'advantages__image', 'Изображение')
            ->set_width(30),       
        Field::make( 'select', 'advantages__title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ) )
            ->set_width(20)              
            ->set_default_value( 'span' ),
        Field::make('text', 'advantages__title', 'Заголовок')
            ->set_default_value('Преимущества')
            ->set_width(50),
        Field::make('rich_text', 'advantages__content', 'Описание')
            ->set_width(100),
    ))
    ->add_tab('Наши работы', array(
        Field::make('checkbox', 'works__off', 'Отключить секцию?'),      
        Field::make( 'select', 'works__title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ) )
            ->set_width(20)              
            ->set_default_value( 'span' ),
        Field::make('text', 'works__title', 'Заголовок')
            ->set_default_value('Наши работы')
            ->set_width(50),
        Field::make('rich_text', 'works__content', 'Описание')
            ->set_width(100),
    ))
    ->add_tab('Текстовая область', array(
        Field::make('checkbox', 'seo__off', 'Отключить секцию?'),      
        Field::make( 'select', 'seo__title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ) )
            ->set_width(20)              
            ->set_default_value( 'span' ),
        Field::make('text', 'seo__title', 'Заголовок')
            ->set_width(50),
        Field::make('rich_text', 'seo__content', 'Описание')
            ->set_width(100),
    ));


// страница Наши работы
Container::make('post_meta', 'Наши работы')
    ->where('post_template', '=', 'templates/category-gallery.php')
    ->add_tab('До вывода работ', array( 
        Field::make( 'select', 'works__title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ))
            ->set_width(20)              
            ->set_default_value( 'span' ),
        Field::make('text', 'works__title', 'Заголовок')
            ->set_width(50),
        Field::make('rich_text', 'works__content', 'Описание')
            ->set_width(100),
    ))
    ->add_tab('После вывода работ', array( 
        Field::make( 'select', 'works_post__title_state', 'Статус заголовка' )
            ->set_options( array(
                'span'  => 'span',
                'h1'    => 'h1',
                'h2'    => 'h2',
                'h3'    => 'h3',
                'h4'    => 'h4',
                'h5'    => 'h5',
                'p'     => 'p',                
            ) )
            ->set_width(20)              
            ->set_default_value( 'span' ),
        Field::make('text', 'works_post__title', 'Заголовок')
            ->set_width(50),
        Field::make('rich_text', 'works_post__content', 'Описание')
            ->set_width(100)
    ));




Container::make('post_meta', 'Отзывы')
    ->where('post_type', '=', 'post')
    ->where( 'post_id', 'CUSTOM', function( $post_id ) {
        return ( get_the_category($post_id)[0]->term_id == 83 );
    })
    ->add_fields( array(
        Field::make( 'complex', 'preview', 'Фото/Видео оформление' )
            ->set_width(100)
            ->setup_labels( array(
                'plural_name' => 'Превью',
                'singular_name' => 'превью',
            ))
            ->add_fields('image', 'Фото',  array(
                Field::make('image', 'preview', 'Фото')
            ))
            ->add_fields('video', 'Видео',  array(
                Field::make('image', 'preview', 'Фото'),
                Field::make( 'text', 'link' , 'Ссылка на видео' )
                    ->set_width(100),
            )), 


    ));






// добавление анонса и параметра даты всем страницам
Container::make('post_meta', 'Анонс')
    ->where( 'post_id', '!=', get_option( 'page_on_front' ) )
    ->set_context( 'side' )
    ->add_fields( array(
        Field::make( 'textarea', 'anons' , 'Анонс' ),
        Field::make( 'checkbox', 'date', 'Показывать дату'),
        Field::make( 'text', 'price', 'Цена')
  ));