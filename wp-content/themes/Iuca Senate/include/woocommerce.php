<?php

function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

//убираем стандартные вкладки woocommerce
// add_filter('woocommerce_product_tabs', 'remove_product_tabs', 25);
// function remove_product_tabs($tabs)
// {
//     unset($tabs['description']); // вкладка Описание
// unset($tabs['reviews']); // вкладка Отзывы
// unset($tabs['additional_information']); // вкладка Детали

// return $tabs;
// }

//добавить доп. поле Хит для популярных продуктов
add_action('woocommerce_product_options_general_product_data', 'truemisha_2_checkboxes');

function truemisha_2_checkboxes()
{
    echo '<div class="option_group">';

    woocommerce_wp_checkbox(array(
    'id'      => 'is_popular_good',
    'value'   => get_post_meta(get_the_ID(), 'is_popular_good', true),
    'label'   => 'Хит',
));
    echo '</div>';
}


add_action('woocommerce_process_product_meta', 'truemisha_save_checkboxes', 20, 2);

function truemisha_save_checkboxes($id, $post)
{
    update_post_meta($id, 'is_popular_good', isset($_POST[ 'is_popular_good' ]) ? 'yes' : 'no');
}

//remove product and product cat from woocommerce urls
// add_filter('request', function ($vars) {
//     global $wpdb;
//     if (! empty($vars['pagename']) || ! empty($vars['category_name']) || ! empty($vars['name']) || ! empty($vars['attachment'])) {
//         $slug   = ! empty($vars['pagename']) ? $vars['pagename'] : (! empty($vars['name']) ? $vars['name'] : (! empty($vars['category_name']) ? $vars['category_name'] : $vars['attachment']));
//         $exists = $wpdb->get_var($wpdb->prepare("SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s", array( $slug )));
//         if ($exists) {
//             $old_vars = $vars;
//             $vars     = array( 'product_cat' => $slug );
//             if (! empty($old_vars['paged']) || ! empty($old_vars['page'])) {
//                 $vars['paged'] = ! empty($old_vars['paged']) ? $old_vars['paged'] : $old_vars['page'];
//             }
//             if (! empty($old_vars['orderby'])) {
//                 $vars['orderby'] = $old_vars['orderby'];
//             }
//             if (! empty($old_vars['order'])) {
//                 $vars['order'] = $old_vars['order'];
//             }
//         }
//     }

//     return $vars;
// });



//remove product and product cat from woocommerce urls
add_filter( 'request', function ( $vars ) {
    global $wpdb;
    if ( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
      $slug   = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( ! empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
      $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s", array( $slug ) ) );
      if ( $exists ) {
        $old_vars = $vars;
        $vars     = array( 'product_cat' => $slug );
        if ( ! empty( $old_vars['paged'] ) || ! empty( $old_vars['page'] ) ) {
          $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
        }
        if ( ! empty( $old_vars['orderby'] ) ) {
          $vars['orderby'] = $old_vars['orderby'];
        }
        if ( ! empty( $old_vars['order'] ) ) {
          $vars['order'] = $old_vars['order'];
        }
      }
    }

    return $vars;
  } );


   //disable sidebar
   function disable_woo_commerce_sidebar() {
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
  }
  add_action('init', 'disable_woo_commerce_sidebar');