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



Container::make('term_meta', 'Категория товаров')
	->where('term_taxonomy', '=', 'category')
	->add_fields(array(
		Field::make('select', 'title_status', 'Статус заголовка')
		->set_options( $tags ) 
		->set_default_value('h1') 
		->set_width(20),
		Field::make('text', 'title_text', 'Текст заголовка')
		->set_width(80),
		Field::make('image', 'brand_image', 'Логотип бренда')
		->set_width(100),
		Field::make('rich_text', 'content', 'Контентная область перед выводом записей/товаров')
		->set_width(100),
		
	
		Field::make('association', 'subterms', 'Выборка подкатегорий')
		->set_types(array(
			array(
				'type' => 'term',
				'taxonomy' => 'category',
			))
		)
		->set_width(100),

		Field::make('rich_text', 'content_2', 'Контентная область после вывода записей/товаров')
		->set_width(100),

		Field::make('separator', 'front','Для отображения на главной и на контентных страницах:' ),
			Field::make('image', 'front_image', 'Превью бренда')
			->set_width(100),
			Field::make('textarea', 'front_anons', 'Анонс бренда')
			->set_attribute( 'maxLength', '310' )
			->set_help_text( '* до 310 символов (включая пробелы)' )		
			->set_width(100),

		Field::make('separator', 'subterm','Для отображения в родительских категориях:' ),
			Field::make('textarea', 'subterm_anons', 'Анонс бренда')
			->set_attribute( 'maxLength', '100' )
			->set_help_text( '* до 100 символов (включая пробелы)' )		
			->set_width(100),
			

		
	))
;
