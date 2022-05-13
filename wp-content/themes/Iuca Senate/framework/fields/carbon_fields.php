<?php

/* -------------------------------------------------------------------------- */
/*	 Подключение carbon-fields
/* -------------------------------------------------------------------------- */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_fields' );

function crb_attach_fields() {
	require_once get_stylesheet_directory() . '/framework/fields/theme_options.php';
	require_once get_stylesheet_directory() . '/framework/fields/front_meta.php';
	require_once get_stylesheet_directory() . '/framework/fields/term_meta.php';
	require_once get_stylesheet_directory() . '/framework/fields/post_meta.php';	
	require_once get_stylesheet_directory() . '/framework/fields/product_meta.php';
}

/* -------------------------------------------------------------------------- */
/*	 Подключение скрипта для carbon-fields (сворачивает секции)
/* -------------------------------------------------------------------------- */

add_action( 'admin_enqueue_scripts', function(){
	wp_enqueue_script( 'carbon_fields', get_template_directory_uri() . '/framework/js/carbon_fields.js', array(), '1.0' );
}, 99 );






