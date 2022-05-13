<?php

add_filter('xmlrpc_enabled', '__return_false');

remove_action( 'wp_head', 'rsd_link' );


/* -------------------------------------------------------------------------- */
/*	. Убираем в Yoast Seo разметку поиска
/* -------------------------------------------------------------------------- */

add_filter( 'disable_wpseo_json_ld_search', '__return_true' );


/* -------------------------------------------------------------------------- */
/*	. Выключить добавление изображений в XML Sitemap
/* -------------------------------------------------------------------------- */

add_filter( 'wpseo_xml_sitemap_img', '__return_false' );


// Disable Gutenberg
if ( version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' ) ) {
    // WP > 5 beta
    add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );

}


//Скрываем визуальный редактор в админке
add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
    remove_post_type_support( 'page', 'editor' );
    remove_post_type_support( 'post', 'editor' );
}



//избавляемся от category в url
function post_is_in_descendant_category( $cats, $_post = null ) {
    foreach ( (array) $cats as $cat ) {
        // get_term_children() accepts integer ID only
        $descendants = get_term_children( (int) $cat, 'category' );
        if ( $descendants && in_category( $descendants, $_post ) ) {
            return true;
        }
    }
    return false;
}



//убираем мусор из скриптов
add_action( 'template_redirect', function () {
    ob_start( function ( $buffer ) {
        $buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $buffer );
        $buffer = str_replace( array( 'type="text/css"', "type='text/css'" ), '', $buffer );

        return $buffer;
    } );
} );


//убираем атрибут размера из полей cf7
add_filter( 'wpcf7_form_elements', 'remove_attr_size' );
function remove_attr_size( $content ) {
    $content = preg_replace( '/ size=".*?"/i', ' ', $content );

    return $content;
}


/**
 * Remove default description column from category
 *
 */
add_action( 'admin_head', 'remove_term_description' );

function remove_term_description(){
    
    ?>
    <script type="text/javascript">
    jQuery(document).ready( function($) {
        document.querySelector('.form-field.term-description-wrap').style.display = 'none';
    });
    </script>
    <?php
}
 






// remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
// remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
// remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
// remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
// remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
// remove_action( 'rest_api_init', 'wp_oembed_register_route' );
// remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
// remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );



// remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
// remove_action( 'wp_print_styles', 'print_emoji_styles' );

// remove_action( 'wp_head', 'wp_resource_hints', 2 );

// remove_action( 'wp_head', 'wp_shortlink_wp_head' );
// remove_action( 'template_redirect', 'wp_shortlink_header', 11 );


// remove_action( 'wp_head', 'wlwmanifest_link' );
// remove_action( 'wp_head', 'rsd_link' );
// remove_action( 'wp_head', 'wp_generator' );
// //Удаляет ссылку из формы комментариев
// add_filter( 'cancel_comment_reply_link', '__return_false' );

// //удаление заголовков, связанных с REST API start
// remove_action('wp_head', 'rest_output_link_wp_head', 10);
// remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
// remove_action('wp_head', 'wp_oembed_add_host_js');
// remove_action('template_redirect', 'rest_output_link_header', 11, 0);







//html5 галерея wp
//   add_theme_support( 'html5', array( 'gallery' ) );

//    //отключение inline стилей для галерей start
//  add_filter('use_default_gallery_style', '__return_false');


//add Site settings tab to wp admin bar
add_action( 'admin_bar_menu', 'toolbar_link_to_mypage', 999 );

function toolbar_link_to_mypage( $wp_admin_bar ) {
   $option_page = get_option( 'crb_carbon_fields_container' );
   $args = array(
       'id'    =>  1,
       'title' => 'Настройка сайта',
       'href'  => '/wp-admin/admin.php?page=crb_carbon_fields_container.php',
       'meta'  => array( 'class' => 'my-toolbar-page' )
   );
   $wp_admin_bar->add_node( $args );
}




 //remove product and product cat from woocommerce urls
//  add_filter( 'request', function ( $vars ) {
//     global $wpdb;
//     if ( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
//       $slug   = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( ! empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
//       $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s", array( $slug ) ) );
//       if ( $exists ) {
//         $old_vars = $vars;
//         $vars     = array( 'product_cat' => $slug );
//         if ( ! empty( $old_vars['paged'] ) || ! empty( $old_vars['page'] ) ) {
//           $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
//         }
//         if ( ! empty( $old_vars['orderby'] ) ) {
//           $vars['orderby'] = $old_vars['orderby'];
//         }
//         if ( ! empty( $old_vars['order'] ) ) {
//           $vars['order'] = $old_vars['order'];
//         }
//       }
//     }

//     return $vars;
//   } );



  

// add_action('admin_init', function () {
//     // Redirect any user trying to access comments page
//     global $pagenow;
    
//     if ($pagenow === 'edit-comments.php') {
//         wp_redirect(admin_url());
//         exit;
//     }

//     // Remove comments metabox from dashboard
//     remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

//     // Disable support for comments and trackbacks in post types
//     foreach (get_post_types() as $post_type) {
//         if (post_type_supports($post_type, 'comments')) {
//             remove_post_type_support($post_type, 'comments');
//             remove_post_type_support($post_type, 'trackbacks');
//         }
//     }
// });

// // Close comments on the front-end
// add_filter('comments_open', '__return_false', 20, 2);
// add_filter('pings_open', '__return_false', 20, 2);

// // Hide existing comments
// add_filter('comments_array', '__return_empty_array', 10, 2);

// // Remove comments page in menu
// add_action('admin_menu', function () {
//     remove_menu_page('edit-comments.php');
// });

// // Remove comments links from admin bar
// add_action('init', function () {
//     if (is_admin_bar_showing()) {
//         remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
//     }
// });