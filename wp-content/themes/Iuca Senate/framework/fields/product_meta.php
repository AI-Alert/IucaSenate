<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;




// страница Контакты
Container::make('post_meta', 'Описание товара')
    ->where( 'post_type', '=', 'product' )
    ->add_tab('Доп.поле', array(
        Field::make('rich_text', 'product_additional', 'Дополнительное текстовое поле'),
    ))
    ->add_tab('Описание', array(
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
    ))
    ->add_tab('Примеры реализации', array(
        Field::make('checkbox', 'seo2__off', 'Отключить секцию?'),      
        Field::make( 'select', 'seo2__title_state', 'Статус заголовка' )
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
        Field::make('text', 'seo2__title', 'Заголовок')
            ->set_width(50),
        Field::make('rich_text', 'seo2__content', 'Описание')
            ->set_width(100),
    ))
    ->add_tab('Характеристики', array(
        Field::make('checkbox', 'seo3__off', 'Отключить секцию?'),      
        Field::make( 'select', 'seo3__title_state', 'Статус заголовка' )
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
        Field::make('text', 'seo3__title', 'Заголовок')
            ->set_width(50),
        Field::make('rich_text', 'seo3__content', 'Описание')
            ->set_width(100),
    ))
    ->add_tab('Преимущества', array(
        Field::make('checkbox', 'seo4__off', 'Отключить секцию?'),      
        Field::make( 'select', 'seo4__title_state', 'Статус заголовка' )
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
        Field::make('text', 'seo4__title', 'Заголовок')
            ->set_width(50),
        Field::make('rich_text', 'seo4__content', 'Описание')
            ->set_width(100),
    ))
    
    ;