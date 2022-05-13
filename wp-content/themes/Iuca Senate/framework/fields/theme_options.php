<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('theme_options', 'Настройки сайта')
    ->add_tab('Шапка сайта', 
        array(
            Field::make('image', 'header_logo_first', 'Логотип - основной')
                ->set_width(50),
            Field::make('image', 'header_logo_second', 'Логотип - дополнительный')
                ->set_help_text( '* Может не использоваться на вашем сайте' )
                ->set_width(50), 

            Field::make('textarea', 'header_description', 'Слоган')
                ->set_attribute( 'placeholder', 'Здесь распологается слоган вашей компании' )
                ->set_help_text( '* Может не использоваться на вашем сайте' )
                ->set_width(100),
            
            Field::make('complex', 'header_phones', 'Телефоны')
                ->add_fields(array(
                    Field::make('text', 'phone', 'Телефон')
                        ->set_attribute( 'placeholder', '+7 (***) ***-****' )
                ))
                ->setup_labels(array('plural_name' => 'Телефоны', 'singular_name' => 'телефон')),        
            Field::make('text', 'header_mobile_phone', 'Телефон для мобильной версии')
                ->set_attribute( 'placeholder', '+7 (***) ***-****' )
                ->set_width(100),        
            Field::make('complex', 'header_mails', 'Электронная почта')
                ->add_fields(array(
                    Field::make('text', 'mail', 'Электронная почта')
                        ->set_attribute( 'placeholder', 'exmaple@mail.com' )
                ))
                ->setup_labels(array('plural_name' => 'Почты', 'singular_name' => 'почту')),
            Field::make('complex', 'header_list_social', 'Соц.сети')
                ->add_fields(array(
                    Field::make('image', 'header_icon_social', 'Иконка соц.сети')
                        ->set_width(30),
                    Field::make('text', 'header_link_social', 'Введите ссылку')
                        ->set_attribute('placeholder', 'vk.com/company_group')
                        ->set_width(70),
                ))
                ->set_max(5)
                ->setup_labels(array('plural_name' => 'Соц.сеть', 'singular_name' => 'соц.сеть')),        
            Field::make('text', 'header_link_text', 'Текст для кнопки в шапке')
                ->set_width(50),
            Field::make('text', 'header_link', 'Ссылка для кнопки в шапке')
                ->set_width(50),        
            Field::make('textarea', 'header_address', 'Адрес')
                ->set_attribute( 'placeholder', 'г.Название города, ул. Название улицы, д.1, офис 20' )
                ->set_width(100),
           
            Field::make('textarea', 'header_hours', 'Время работы')
                ->set_attribute( 'placeholder', 'Режим работы: вт-сб 10:00 - 19:00, вс-пн - выходные дни' )
                ->set_width(100),
        )
    )












    
    ->add_tab('Подвал сайта', array(
        Field::make('image', 'footer_logo_first', 'Логотип - основной')
            ->set_width(50),   
        Field::make('textarea', 'footer_description', 'Слоган')
            ->set_attribute( 'placeholder', 'Здесь распологается слоган вашей компании' )
            ->set_help_text( '* Может не использоваться на вашем сайте' )
            ->set_width(100),         
        Field::make('complex', 'footer_phones', 'Телефоны')
            ->add_fields(array(
                Field::make('text', 'phone', 'Телефон')
                    ->set_attribute( 'placeholder', '+7 (***) ***-****' )
            ))
            ->setup_labels(array('plural_name' => 'Телефоны', 'singular_name' => 'телефон')),
        Field::make('complex', 'footer_mails', 'Электронная почта')
            ->add_fields(array(
                Field::make('text', 'mail', 'Электронная почта')
                    ->set_attribute( 'placeholder', 'exmaple@mail.com' )
            ))
            ->setup_labels(array('plural_name' => 'Почты', 'singular_name' => 'почту')),  
        Field::make('complex', 'footer_list_social', 'Соц.сети')
            ->add_fields(array(
                Field::make('image', 'footer_icon_social', 'Иконка соц.сети')
                    ->set_width(30),
                Field::make('text', 'footer_link_social', 'Введите ссылку')
                    ->set_attribute('placeholder', 'vk.com/company_group')
                    ->set_width(70),
            ))
            ->set_max(5)
            ->setup_labels(array('plural_name' => 'Соц.сеть', 'singular_name' => 'соц.сеть')), 
        Field::make('textarea', 'footer_address', 'Адрес')
            ->set_attribute( 'placeholder', 'г.Название города, ул. Название улицы, д.1, офис 20' )
            ->set_width(100),      
        Field::make('textarea', 'footer_hours', 'Время работы')
            ->set_attribute( 'placeholder', 'Режим работы: вт-сб 10:00 - 19:00, вс-пн - выходные дни' )
            ->set_width(100),
        Field::make('textarea', 'copy', 'Копирайт'),
        ))
    ->add_tab('Техническая информация', array(
        Field::make('textarea', 'addones', 'Дополнительный код')
            ->set_width(100),       
        ))
    
    

;
