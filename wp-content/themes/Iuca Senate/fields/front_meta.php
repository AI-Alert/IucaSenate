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
                        ->set_max(3)
                        ->add_fields(array(
                            Field::make('image', 'icon', 'Иконка')
                                ->set_width(40),
                            Field::make('textarea', 'text', 'Описание')
                                ->set_width(60)
                        )),
                   
                ))
                ->add_fields('list__term', 'Список - Категорий', array(
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'span' ),
                    Field::make( 'text', 'title_text', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Бренды'),
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(100),   
                    Field::make('association', 'list', 'Список брендов')
                        ->set_types(array(
                                array(
                                    'type' => 'term',
                                    'taxonomy' => 'category'
                                )
                            ))
                ))
                ->add_fields('slider__product', 'Слайдер - Продукции', array(                  
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'h2' ),
                    Field::make( 'text', 'title', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Популярные модели'),                   
                    Field::make( 'association', 'links' , 'Выбрать продукцию' )
                        ->set_width(100)
                        ->set_types(array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'post',
                            )
                        )),
                ))
                ->add_fields('banner__sale', 'Баннер - распродажа', array(
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'span' ),
                    Field::make( 'text', 'title_text', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Бренды'),
                    Field::make( 'image', 'image', 'Фоновая картинка' )
                        ->set_width(25),
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(75),   
                    Field::make( 'text', 'link', 'Ссылка' )
                        ->set_width(50),
                    Field::make( 'text', 'link_text', 'Текст на кнопке' )
                        ->set_width(50)
                ))
                ->add_fields('banner__team', 'Баннер - комментарий директора', array(
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'span' ),
                    Field::make( 'text', 'title_text', 'Имя' )
                        ->set_width(90)
                        ->set_default_value('Александр Глущенко'),
                    Field::make( 'text', 'position', 'Должность' ),
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(75), 
                    Field::make( 'image', 'image', 'Фотография' )
                        ->set_width(25),                      
                    Field::make( 'text', 'link', 'Ссылка' )
                        ->set_width(50),
                    Field::make( 'text', 'link_text', 'Текст на кнопке' )
                        ->set_width(50)
                ))
                ->add_fields('slider__portfolio', 'Слайдер - Портфолио', array(                  
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'h2' ),
                    Field::make( 'text', 'title', 'Заголовок' )
                        ->set_width(90)
                        ->set_default_value('Посмотрите примеры<br> работ наших клиентов'),                   
                    Field::make( 'association', 'links' , 'Выбрать кейсы' )
                        ->set_width(100)
                        ->set_types(array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'page',
                                
                            )
                        )),
                ))
                ->add_fields('slider__about', 'Слайдер - О нас', array(
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
                    Field::make('complex', 'advantages', 'Преимущества')
                        ->set_max(3)
                        ->add_fields(array(
                            Field::make('image', 'icon', 'Иконка')
                                ->set_width(40),
                            Field::make('textarea', 'text', 'Описание')
                                ->set_width(60)
                        )),
                    
                ))
                ->add_fields('list__steps', 'Список этапов', array(
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'h2' ),
                    Field::make( 'text', 'title', 'Заголовок' )
                        ->set_width(90),                          
                    Field::make( 'rich_text', 'content', 'Описание' )
                        ->set_width(100),                    
                    Field::make('complex', 'steps', 'Этапы')
                        ->set_max(9)
                        ->add_fields(array(
                            Field::make('text', 'title', 'Заголовок')
                                ->set_width(40),
                            Field::make('textarea', 'text', 'Описание')
                                ->set_width(60)
                        )),
                    
                ))
                ->add_fields('banner__form', 'Баннер - форма обратной связи', array(
                    Field::make( 'select', 'title_state', 'Статус заголовка' )
                        ->set_width(10)
                        ->set_options( $tags )
                        ->set_default_value( 'span' ),
                    Field::make('textarea', 'title', 'Заголовок формы')
                        ->set_default_value( 'Заполните форму и наш менеджер перезвонит вам, чтобы назначить удобное время для встречи')
                        ->set_width(75),                        
                    Field::make('image', 'image', 'Изображение формы')
                        ->set_width(25),
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
