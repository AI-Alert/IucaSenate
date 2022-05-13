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

  Container::make( 'post_meta', 'Настройки страницы' )
        ->where( 'post_id', '=', get_option( 'page_on_front' ) )
        ->or_where( 'post_template', '=', 'front-page.php' )
        ->or_where( 'post_template', '=', 'templates/single-simple.php' )
        ->or_where( 'post_template', '=', 'singular.php' )
        ->or_where( 'post_template', '=', 'page.php' )
        ->add_fields( array(
            Field::make( 'complex', 'front_page', ' ' )
                ->setup_labels( array(
                    'plural_name' => 'Секции',
                    'singular_name' => 'секцию',
                ))
                ->add_fields('slider__hero', 'Слайдер - Баннер', array(  
                    Field::make('complex', 'slides', 'Слайд')
                    ->set_layout('tabbed-horizontal')
                    ->add_fields('slide', '', array(
                        Field::make( 'text', 'title', 'Предаголовок' )
                            ->set_width(100),
                        Field::make( 'select', 'title_state', 'Статус заголовка' )
                            ->set_width(10)
                            ->set_options( $tags )
                            ->set_default_value( 'span' ),
                        Field::make( 'text', 'title_bold', 'Заголовок (большими буквами)' )
                            ->set_width(90),                            
                        Field::make('rich_text', 'content', 'Текст')
                            ->set_width(75),
                        Field::make( 'image', 'image', 'Фоновая картинка' )
                            ->set_width(25),
                        
                        Field::make('text', 'btn_text', 'Текст')
                            ->set_width(50)
                            ->set_default_value( 'Оставить заявку' ),
                        Field::make('text', 'btn_link', 'Ссылка')
                            ->set_width(50)
                            ->set_default_value( '#callback' ),
                    )),                  
                    Field::make('complex', 'advantages', 'Преимущества')
                        ->add_fields(array(
                            Field::make('image', 'icon', 'Иконка')
                                ->set_width(40),
                            Field::make('textarea', 'text', 'Описание')
                                ->set_width(60)
                        )),
                   
                ))
                ->add_fields('list__terms_main', 'Список основных разделов', array(
                    Field::make( 'text', 'subtitle', 'Предзаголовок' ),
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'span' ),
                    Field::make( 'text', 'title_text', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Основные разделы'),

                    Field::make('complex', 'terms', 'Разделы')
                        ->add_fields(array(
                            Field::make('image', 'image', 'Изображение')
                                ->set_width(10),
                            Field::make('text', 'text', 'Подпись')
                                ->set_width(30),
                            Field::make( 'association', 'links' , 'Категория' )
                                ->set_width(60)
                                ->set_max( 1 )
                                ->set_types(array(
                                    array(
                                        'type'      => 'term',
                                        'post_type' => 'product_cat',
                                        'taxonomy'  => 'product_cat'
                                    )
                                )),
                        ))
                ))
                ->add_fields('list__terms_popular', 'Список популярных разделов', array(
                    Field::make( 'text', 'subtitle', 'Предзаголовок' ),
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'span' ),
                    Field::make( 'text', 'title_text', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Популярные разделы'),
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(100),
                    Field::make('complex', 'terms', 'Категории')
                        ->add_fields(array(
                            Field::make('image', 'image', 'Иконка')
                                ->set_width(10),
                            Field::make('text', 'text', 'Подпись')
                                ->set_width(30),
                            Field::make( 'association', 'links' , 'Категория' )
                                ->set_width(60)
                                ->set_max( 1 )
                                ->set_types(array(
                                    array(
                                        'type'      => 'term',
                                        'post_type' => 'product_cat',
                                        'taxonomy'  => 'product_cat'
                                    ),
                                    array(
                                        'type'      => 'post',
                                        'post_type' => 'page',
                                    )
                                )),
                        ))
                ))
                ->add_fields('list__products_popular', 'Продукция', array(
                    Field::make( 'text', 'subtitle', 'Предзаголовок' ),
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'h2' ),
                    Field::make( 'text', 'title', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Лучшие предложения'),                   
                    Field::make( 'association', 'links' , 'Выбрать продукцию' )
                        ->set_width(100)
                        ->set_types(array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'product',
                            )
                        )),
                ))
                ->add_fields('form__gift', 'Форма обратной связи', array(
                    Field::make( 'text', 'subtitle', 'Предзаголовок' ),
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'h2' ),
                    Field::make( 'text', 'title', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Проект от дизайнера в подарок'),  
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(100),   
                    Field::make('image','image', 'Изображение')
                ))
                ->add_fields('list__post_news', 'Список новостей', array(
                    Field::make( 'text', 'subtitle', 'Предзаголовок' ),
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'h2' ),
                    Field::make( 'text', 'title', 'Заголовок' )
                        ->set_width(90),                          
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(100),   
                    Field::make( 'association', 'list' , 'Выбрать новости' )
                        ->set_width(100)
                        ->set_types(array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'post',
                            )
                        )),
                ))
                ->add_fields('slider__about', 'Слайдер - О нас', array(
                    Field::make( 'text', 'subtitle', 'Предзаголовок' ),
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'h2' ),
                    Field::make( 'text', 'title', 'Заголовок' )
                        ->set_width(90),                          
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(100),   
                    Field::make( 'complex', 'preview', 'Фото/Видео оформление' )
                        ->set_width(30)
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
                    Field::make( 'text', 'link', 'Ссылка "Подробнее"' )
                        ->set_width(50)
                ))
                ->add_fields('list__terms_brand', 'Список брендов', array(                 
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'span' ),
                    Field::make( 'text', 'title_text', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Бренды'),
                    Field::make( 'association', 'terms' , 'Бренды' )
                        ->set_width(60)
                        ->set_types(array(
                            array(
                                'type'      => 'term',
                                'post_type' => 'product_tag',
                                'taxonomy'  => 'product_tag'
                            )
                        )),
                ))
                ->add_fields('seo__block', 'Контентный блок', array(
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(50)
                        ->set_options( array(
                            'span'  => 'span',
                            'h1'    => 'h1',
                            'h2'    => 'h2',
                            'h3'    => 'h3',
                            'h4'    => 'h4',
                            'h5'    => 'h5',
                            'p'     => 'p',
                        ) )
                        ->set_default_value( 'h2' ),
                    Field::make( 'text', 'title', 'Заголовок' )
                        ->set_width(50)
                        ->set_default_value('СЕО Текст'),
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(100),
                ))
        ));
