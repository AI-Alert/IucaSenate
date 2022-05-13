<?php

/* -------------------------------------------------------------------------- */
/*	. Устраняем баг с несуществующей пагинацией страниц
/* -------------------------------------------------------------------------- */

add_filter( 'pre_handle_404', function( $false, $wp_query ) {
    if ( is_singular() && get_query_var( 'page' ) ) {
        $wp_query->set_404();
        status_header( 404 );
        nocache_headers();

        return 'stop';
    }
    return $false;
} , 10, 2 );

// Добавляем поддержку миниатюр постов
add_theme_support( 'post-thumbnails' );

//Включение возможности перезаписи title
add_theme_support( 'title-tag' );


// Разрешение SVG формата
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');




// Перенаправление на основную запись
function template_redirect_attachment() {
    global $post;

    if ( is_attachment() ) {
        wp_redirect( get_permalink( $post->post_parent ), 301 );
    }
}

add_action( 'template_redirect', 'template_redirect_attachment' );




//ошибка микроразметки
function artabr_opengraph_fix_yandex($lang) {
    $lang_prefix = 'prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#  profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#"';
    $lang_fix = preg_replace('!prefix="(.*?)"!si', $lang_prefix, $lang);
    return $lang_fix;
}
add_filter( 'language_attributes', 'artabr_opengraph_fix_yandex',20,1);







add_action( 'admin_head', 'minimize_term_separator' );

function minimize_term_separator(){
    global $current_screen;

    if($current_screen->id == 'edit-category') {
        ?>
        <style>
        .cf-container-term-meta .cf-separator .cf-field__body {
            position: static !important;
        }

    
        </style>
        <?php
    }  
    
}




add_action( 'admin_head', 'color_picker_z_index' );

function color_picker_z_index(){
   

   
        ?>

    
        <style>
      
        .cf-complex__groups {
            z-index: 333 !important;
        }

        .postbox .cf-complex__inserter-menu {           
            z-index: 10000000;
        }
        
        </style>
        <?php
      
    
}







 /* _____________________________ 10. start custom BUTTON for editor ______________________________ */

  // content btn shortcode register
  function popupbtn_add_mce_button() {
    // проверяем права пользователя - может ли он редактировать посты и страницы
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
      return; // если не может, то и кнопка ему не понадобится, в этом случае выходим из функции
    }
    // проверяем, включен ли визуальный редактор у пользователя в настройках (если нет, то и кнопку подключать незачем)
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
      add_filter( 'mce_external_plugins', 'popupbtn_add_tinymce_script' );
      add_filter( 'mce_buttons', 'popupbtn_register_mce_button' );
    }
  }

  add_action( 'admin_head', 'popupbtn_add_mce_button' );

  // В этом функции указываем ссылку на JavaScript-файл кнопки
  function popupbtn_add_tinymce_script( $plugin_array ) {
    $plugin_array['popupbtn_mce_button'] = _mt_assets().'/js/template-parts/mce-button/script.js'; // popupbtn_mce_button - идентификатор кнопки

    return $plugin_array;
  }

  // Регистрируем кнопку в редакторе
  function popupbtn_register_mce_button( $buttons ) {
    array_push( $buttons, 'popupbtn_mce_button' ); // popupbtn_mce_button - идентификатор кнопки

    return $buttons;
  }


  /* _____________________________ 10. end   custom BUTTON for editor ______________________________ */




