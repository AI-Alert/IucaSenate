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

//страница Карточка товара
Container::make('post_meta', 'Страница товара')
    ->where('post_type', '=', 'post')
    ->or_where( 'post_template', '=', 'templates/single-product.php' )
    ->add_fields(array(
        Field::make('select', 'title_status', 'Статус заголовка')
        ->set_options( $tags ) 
        ->set_default_value('h1') 
        ->set_width(20),
		Field::make('text', 'title_text', 'Текст заголовка')
        ->set_width(80),
        Field::make('image', 'image', 'Изображение')
        ->set_width(100),
        

        Field::make('rich_text', 'content_side', 'Текст под фото слева - без обтекания')
        ->set_width(50),

        Field::make('complex', 'chars', 'Характеристики')
        ->add_fields(array(
            Field::make( 'text', 'name', 'Название' )->set_width(50),
            Field::make( 'text', 'caption', 'Значение' )->set_width(50),
        ))
        ->set_width(50),

        Field::make('text', 'regular_price', 'Основная цена')
        ->set_width(50),
        Field::make('text', 'old_price', 'Старая цена')
        ->set_width(50),

        Field::make('rich_text', 'content', 'Контентная область под фото - на всю ширину')
        ->set_width(100),

        Field::make( 'media_gallery', 'gallery', 'Галерея' )
        ->set_type( array( 'image', 'image' ) )
        ->set_width(100),

        Field::make('checkbox', 'similiar', 'Скрыть похожие?')
        ->set_width(100),

        Field::make('rich_text', 'content_2', 'Контентная область')
        ->set_width(100),

));

// добавление анонса Карточки товара
Container::make('post_meta', 'Анонс товара')
    ->where('post_type', '=', 'post')
    ->or_where( 'post_template', '=', 'templates/page-product.php' )
    ->set_context( 'side' )
    ->add_fields( array(
        Field::make( 'text', 'anons_name', 'Название на анонсе'),
        Field::make('complex', 'anons_mark', 'Маркеры на анонсе')
        ->add_fields(array(
            Field::make( 'text', 'name', 'Название' )->set_width(50),
            Field::make( 'color', 'color', 'Цвет' )->set_width(50),
        ))        
    ))
;

// страница Портфолио
Container::make('post_meta', 'Портфолио')
    ->where( 'post_template', '=', 'templates/page-portfolio.php' )
    ->add_fields(array(
        Field::make('select', 'title_status', 'Статус заголовка')
        ->set_options( $tags ) 
        ->set_default_value('h1') 
        ->set_width(20),
		Field::make('text', 'title_text', 'Текст заголовка')
        ->set_width(80),

        Field::make('separator', 'form', 'Настройки формы обратной связи' ),
        Field::make('textarea', 'form_title', 'Заголовок формы')
        ->set_width(75),
        Field::make('image', 'form_image', 'Изображение формы')
        ->set_width(25),

        Field::make('separator', 'cont', 'Текстовая область после ФОС' ),
        Field::make('rich_text', 'content', 'Контентная область')
        ->set_width(100),


    ))
;

// страница Кейс-портфолио
Container::make('post_meta', 'Кейс-портфолио')
    ->where( 'post_template', '=', 'templates/page-case.php' )
    ->add_fields(array(
        Field::make('separator', 'port', 'Основная информация' ),

        Field::make('select', 'title_status', 'Статус заголовка')
        ->set_options( $tags ) 
        ->set_default_value('h1') 
        ->set_width(20),

		Field::make('text', 'title_text', 'Текст заголовка')
        ->set_help_text('*Только для внутренней страницы')
        ->set_width(80),
      

        Field::make('text', 'address', 'Адрес')
        ->set_width(25),
        Field::make('text', 'factory', 'Фабрика')
        ->set_width(25),
        Field::make('text', 'model', 'Модель')
        ->set_width(25),
        Field::make('text', 'price', 'Стоимость')
        ->set_width(25),
        Field::make('textarea', 'task', 'Задача')
        ->set_help_text('*Только для внутренней страницы')
        ->set_width(100),

        Field::make('text', 'addone', 'Примечание*')
        ->set_width(100),

        Field::make('image', 'image', 'Изображение')
        ->set_width(100),

        Field::make( 'media_gallery', 'gallery', 'Галерея' )
        ->set_type( array( 'image', 'image' ) )
        ->set_help_text('*Подхватываются и для вывода на странице портфолио')
        ->set_width(100),


       



        Field::make('separator', 'case', 'Решение' ),

        Field::make('image', 'case_image', 'Изображение')
        ->set_width(50),
        Field::make('text', 'case_video', 'Ссылка на видео')
        ->set_width(50),
        Field::make('select', 'case_status', 'Статус заголовка')
        ->set_options( $tags ) 
        ->set_default_value('span') 
        ->set_width(20),
		Field::make('text', 'case_text', 'Текст заголовка')
        ->set_default_value('Решение')
        ->set_width(80),
        Field::make('rich_text', 'content', 'Контентная область')
        ->set_width(100),


        
        Field::make('separator', 'feed', 'Отзыв' ),

        Field::make('select', 'feed_status', 'Статус заголовка')
        ->set_options( $tags ) 
        ->set_default_value('span') 
        ->set_width(20),

		Field::make('text', 'feed_text', 'Текст заголовка')
        ->set_default_value('Отзыв клиента')
        ->set_width(80),

        Field::make('textarea', 'feed_mini', 'Соркащённый отзыв')
        ->set_width(70)
        ->set_help_text('*Укороченный текст отзыва на превью на странице "Портфолио"'),
        Field::make('image', 'feed_image', 'Фото клиента')
        ->set_width(30),
        Field::make('textarea', 'feed_max', 'Развёрнутый отзыв')
        ->set_width(100),

        Field::make('text', 'feed_name', 'Имя клиента')
        ->set_width(100),

        
       

        Field::make( 'media_gallery', 'gallery_2', 'Галерея после отзыва' )
        ->set_type( array( 'image', 'image' ) )
        ->set_width(100),

        Field::make('separator', 'fos', 'Форма обратной связи' ),

        Field::make('checkbox', 'fos_disable', 'Выключить блок с ФОС?')
        ->set_width(100),

        Field::make('text', 'fos_text', 'Текст заголовка')  
        ->set_default_value('Понравился дизайн? Закажи похожий!')      
        ->set_width(100),

        Field::make('rich_text', 'fos_caption', 'Подзаголовок')
        ->set_default_value('Оставьте заявку на сайте и нам менеджер свяжется с Вами в ближайшее время!') 
        ->set_width(100),
	  
        Field::make('text', 'btn_text', 'Текст')
        ->set_default_value('Оставить заявку') 
        ->set_width(50),



    ))
;


// страница Команда
Container::make('post_meta', 'Команда')
    ->where( 'post_template', '=', 'templates/page-team.php' )
    ->add_fields(array(
        Field::make('select', 'title_status', 'Статус заголовка')
        ->set_options( $tags ) 
        ->set_default_value('h1') 
        ->set_width(20),
		Field::make('text', 'title_text', 'Текст заголовка')
        ->set_width(80),


        Field::make('separator', 'dir', 'Директор' ),
        Field::make('text', 'dir_name', 'ФИО директора')
        ->set_width(70),
        Field::make('text', 'dir_position', 'Должность')
        ->set_width(30),
        Field::make( 'rich_text', 'dir_content', 'Цитата директора' )
        ->set_width(75),
        Field::make('image', 'dir_image', 'Фотография директора')
        ->set_width(25),
        Field::make('association', 'dir_link', 'Страница директора')
        ->set_max(1)
        ->set_types(array(
            array(
                'type' => 'post',
                'post_type' => 'page'
            )
        )),

        
        Field::make('separator', 'team', 'Команда' ),
        Field::make('select', 'team_status', 'Статус заголовка')
        ->set_options( $tags ) 
        ->set_default_value('h2') 
        ->set_width(20),
		Field::make('text', 'team_text', 'Текст заголовка')
        ->set_width(80),
        Field::make('complex', 'team_list', 'Команда')
        ->add_fields(array(
            Field::make('text', 'name', 'ФИО члена команды')
            ->set_width('60'),
            Field::make('text', 'position', 'Должность')
            ->set_width('40'),
            Field::make('image', 'image', 'Фотография')
            ->set_width('30'),
            Field::make('association', 'link', 'Ссылка')
            ->set_width('70')
            ->set_max(1)
            ->set_types(array(
                array(
                    'type' => 'post',
                    'post_type' => 'page'
                ))                
            ),

        )),


        Field::make('separator', 'fos', 'Форма обратной связи' ),

        Field::make('checkbox', 'fos_disable', 'Выключить блок с ФОС?')
        ->set_width(100),

        Field::make('text', 'fos_text', 'Текст заголовка')  
     
        ->set_width(100),

        Field::make('rich_text', 'fos_caption', 'Подзаголовок')
        
        ->set_width(100),
	  
        Field::make('text', 'btn_text', 'Текст')
        ->set_default_value('Оставить заявку') 
        ->set_width(50),



    ))
;

// страница Контакты
Container::make('post_meta', 'Страница контакты')
    ->where( 'post_template', '=', 'templates/page-kontakty.php' )
    ->add_fields(array(
        Field::make( 'select', 'title_state', 'Статус заголовка' )
            ->set_options( $tags ) 
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
        ))
;



// страница Новости
Container::make('post_meta', 'Страница новости')
    ->where('post_template', '=', 'templates/page-news.php')
    ->add_fields(array(
        Field::make( 'select', 'title_state', 'Статус заголовка' )
            ->set_options( $tags ) 
            ->set_width(10)              
            ->set_default_value( 'h1' ),
        Field::make( 'text', 'title', 'Заголовок' )
            ->set_width(90),
        Field::make( 'rich_text', 'content', 'Описание' )
            ->set_width(100),
        Field::make( 'rich_text', 'content_2', 'Описание после вывода постов' )
            ->set_width(100),   
    ))
;


// добавление анонса и параметра даты всем страницам
Container::make('post_meta', 'Анонс')
    ->where('post_template', '=', 'page.php')
    ->set_context( 'side' )
    ->add_fields( array(
        Field::make( 'textarea', 'anons' , 'Анонс' ),
        Field::make( 'checkbox', 'date', 'Скрыть дату')
    ))
;






