<?php

/* -------------------------------------------------------------------------- */
/*	Переподключаем стандартный jQuery в footer
/* -------------------------------------------------------------------------- */


add_action( 'wp_enqueue_scripts', function() {
    wp_deregister_script( 'jquery' );
} );


/* -------------------------------------------------------------------------- */
/*	Подключаем CSS и JS mt-фреймворка
/* -------------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'enqueue_vendor_js_and_css' );

function enqueue_vendor_js_and_css() {
    //CSS
    wp_enqueue_style( 'normalize_css', get_stylesheet_directory_uri() . '/assets/libs/normalize.css', false , get_stylesheet_directory_uri() . '/assets/libs/normalize.css'  );
    wp_enqueue_style( 'animate_css', get_stylesheet_directory_uri() . '/assets/libs/animate/animate.min.css', false , get_stylesheet_directory_uri() . '/assets/libs/animate/animate.min.css'  );
    wp_enqueue_style( 'hamburgers_css', get_stylesheet_directory_uri() . '/assets/libs/css-hamburgers/dist/hamburgers.min.css', false , get_stylesheet_directory_uri() . '/assets/libs/css-hamburgers/dist/hamburgers.min.css'  );
    wp_enqueue_style( 'slick_css', get_stylesheet_directory_uri() . '/assets/libs/slick/slick.css', false , get_stylesheet_directory_uri() . '/assets/libs/slick/slick.css'  );
    wp_enqueue_style( 'fancybox_css', get_stylesheet_directory_uri() . '/assets/libs/fancybox-master/dist/jquery.fancybox.min.css', false , get_stylesheet_directory_uri() . '/assets/libs/fancybox-master/dist/jquery.fancybox.min.css'  );
    wp_enqueue_style( 'jquerymCustomScrollbar_css', get_stylesheet_directory_uri() . '/assets/libs/custom-scrollbar/jquery.mCustomScrollbar.min.css', false, get_stylesheet_directory_uri() . '/assets/libs/custom-scrollbar/jquery.mCustomScrollbar.min.css'  );


    //JavaScript
    wp_enqueue_script( 'lazyload', get_stylesheet_directory_uri() . '/framework/js/lazyload.js', array(  ), '' , true );


    wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/assets/libs/jquery/jquery.js', array(  ), '' , true );
    wp_enqueue_script( 'slick_js', get_stylesheet_directory_uri() . '/assets/libs/slick/slick.min.js', array( 'jquery' ), get_stylesheet_directory_uri() . '/assets/libs/slick/slick.min.js' , true );
    wp_enqueue_script( 'fancybox_js', get_stylesheet_directory_uri() . '/assets/libs/fancybox-master/dist/jquery.fancybox.min.js', array( 'jquery' ), get_stylesheet_directory_uri() . '/assets/libs/fancybox-master/dist/jquery.fancybox.min.js' , true );
    wp_enqueue_script( 'maskedinput_js', get_stylesheet_directory_uri() . '/assets/libs/maskedinput/maskedinput.js', array( 'jquery' ), get_stylesheet_directory_uri() . '/assets/libs/maskedinput/maskedinput.js' , true );
    wp_enqueue_script( 'match_height_js', get_stylesheet_directory_uri() . '/assets/libs/jquery-match-height-master/dist/jquery.matchHeight-min.js', array( 'jquery' ), get_stylesheet_directory_uri() . '/assets/libs/jquery-match-height-master/dist/jquery.matchHeight-min.js' , true );
    wp_enqueue_script( 'custom_scrollbar_js', get_stylesheet_directory_uri() . '/assets/libs/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), get_stylesheet_directory_uri() . '/assets/libs/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js' , true );
}


/* -------------------------------------------------------------------------- */
/*	Подключаем CSS и JS конкретного проекта
/* -------------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'enqueue_theme_js_and_css' );

function enqueue_theme_js_and_css() {
    //CSS
    wp_enqueue_style( 'style_css', get_stylesheet_directory_uri() . '/assets/css/style.css', false , get_stylesheet_directory_uri() . '/assets/css/style.css' );

    //JavaScript
    wp_enqueue_script( 'main_js', get_stylesheet_directory_uri() . '/assets/js/main.js', array( 'jquery' ), get_stylesheet_directory_uri() . '/assets/js/main.js' , true );
}