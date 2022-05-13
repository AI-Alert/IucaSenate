<?php


/* -------------------------------------------------------------------------- */
/*	Регистрация меню
/* -------------------------------------------------------------------------- */
 
register_nav_menus(
    array(
        'header_menu_1'        => 'Меню шапки 1',
        'header_menu_2'        => 'Меню шапки 2',
        'footer_menu_1'        => 'Меню в подвале 1',
        'footer_menu_2'        => 'Меню в подвале 2',
      
    )
);

/* -------------------------------------------------------------------------- */
/*	Регистрация дочерних классов для формирования меню
/* -------------------------------------------------------------------------- */


class walker_bem_header_menu_top extends Walker_Nav_Menu {
    function __construct( $css_class_prefix ) {
        $this->css_class_prefix = $css_class_prefix;

        // Define menu item names appropriately
        $this->item_css_class_suffixes = array(
            'item'                    => '__item',
            'link'                    => '__link',
            
            'parent_item'             => ' menu__item--sub',

            'active_item'             => '__iteml  active',
            'active_sub_item'         => '__submenu__item  active',
            'parent_of_active_item'   => '__iteml active',
            'ancestor_of_active_item' => '__iteml ancestor-active',

            'sub_menu'                => '__submenu submenu',
            'sub_item'                => '__ submenu__item',
            'sub_link'                => '__ submenu__link'
        );
    }

    // Check for children
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

    function start_lvl( &$output, $depth = 1, $args = array() ) {

        $real_depth = $depth + 1;

        $indent      = str_repeat( "\t", $real_depth );
        $prefix      = $this->css_class_prefix;
        $suffix      = $this->item_css_class_suffixes;
        $classes     = array(
            $prefix . $suffix['sub_menu'],
        );
        $class_names = implode( ' ', $classes );
        // Add a ul wrapper to sub nav
        $output .= "\n" . $indent . '<ul class="' . $class_names . '"> <li class="menu__back"><a href="javascript:void(0);">Назад</a></li>' . "\n";
    }

    // Add main/sub classes to li's and links

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;

        $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent
        $prefix = $this->css_class_prefix;
        $suffix = $this->item_css_class_suffixes;
        // Item classes
        $item_classes = array(
            'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : $prefix . $suffix['sub_item'],
            'parent_class'          => $args->has_children ? $parent_class = $suffix['parent_item'] : '',
            'active_page_class'     => in_array( "current-menu-item", $item->classes ) ? ( $depth == 0 ? $prefix . $suffix['active_item'] : $prefix . $suffix['active_sub_item'] ) : '',
            'active_parent_class'   => in_array( "current-menu-parent", $item->classes ) ? $prefix . $suffix['parent_of_active_item'] : '',
            'active_ancestor_class' => in_array( "current-menu-ancestor", $item->classes ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
            'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--' . $item->classes[0] : ''
        );
        // convert array to string excluding any empty values
        $class_string = implode( "  ", array_filter( $item_classes ) );
        // Add the classes to the wrapping <li>
        $output .= $indent . '<li class="' . $class_string . '">';
        // Link classes
        $link_classes      = array(
            'item_link' => $depth == 0 ? $prefix . $suffix['link'] : $prefix . $suffix['sub_link'],
        );
        $link_class_string = implode( "  ", array_filter( $link_classes ) );
        $link_class_output = 'class="' . $link_class_string . '"';
        // link attributes
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        // remove circular references
        if ( ! $item->current ) {
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
        } else {
            $attributes .= ! empty( $item->url ) ? ' ' : ' ';
        }
        // Creatre link markup
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' ' . $link_class_output . '>';
        $item_output .= $args->link_before;
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= $args->after;
        $item_output .= '</a>';
        // Filter <li>

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class walker_bem_header_menu_bottom extends Walker_Nav_Menu {
    function __construct( $css_class_prefix ) {
        $this->css_class_prefix = $css_class_prefix;

        // Define menu item names appropriately
        $this->item_css_class_suffixes = array(
            'item'                    => '__item',
            'link'                    => '__link',
            


            'active_item'             => '__item  active',
            'active_sub_item'         => '__submenu__item  active',
            'parent_of_active_item'   => '__item parent-active',
            'ancestor_of_active_item' => '__item ancestor-active',

            'sub_menu'                => '__submenu submenu',
            'sub_item'                => '__submenu__item',
            'sub_link'                => '__submenu__link'
        );
    }

    // Check for children
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

    function start_lvl( &$output, $depth = 1, $args = array() ) {

        $real_depth = $depth + 1;

        $indent      = str_repeat( "\t", $real_depth );
        $prefix      = $this->css_class_prefix;
        $suffix      = $this->item_css_class_suffixes;
        $classes     = array(
            $prefix . $suffix['sub_menu'],
        );
        $class_names = implode( ' ', $classes );
        // Add a ul wrapper to sub nav
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    // Add main/sub classes to li's and links

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;

        $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent
        $prefix = $this->css_class_prefix;
        $suffix = $this->item_css_class_suffixes;
        // Item classes
        $item_classes = array(
            'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : $prefix . $suffix['sub_item'],
            'parent_class'          => $args->has_children ? $parent_class = $suffix['parent_item'] : '',
            'active_page_class'     => in_array( "current-menu-item", $item->classes ) ? ( $depth == 0 ? $prefix . $suffix['active_item'] : $prefix . $suffix['active_sub_item'] ) : '',
            'active_parent_class'   => in_array( "current-menu-parent", $item->classes ) ? $prefix . $suffix['parent_of_active_item'] : '',
            'active_ancestor_class' => in_array( "current-menu-ancestor", $item->classes ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
            'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--' . $item->classes[0] : ''
        );
        // convert array to string excluding any empty values
        $class_string = implode( "  ", array_filter( $item_classes ) );
        // Add the classes to the wrapping <li>
        $output .= $indent . '<li class="' . $class_string . '">';
        // Link classes
        $link_classes      = array(
            'item_link' => $depth == 0 ? $prefix . $suffix['link'] : $prefix . $suffix['sub_link'],
        );
        $link_class_string = implode( "  ", array_filter( $link_classes ) );
        $link_class_output = 'class="' . $link_class_string . '"';
        // link attributes
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        // remove circular references
        if ( ! $item->current ) {
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
        } else {
            $attributes .= ! empty( $item->url ) ? ' ' : ' ';
        }
        // Creatre link markup
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' ' . $link_class_output . '>';
        $item_output .= $args->link_before;
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= $args->after;
        $item_output .= '</a>';
        // Filter <li>

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


class walker_bem_footer_menu_top extends Walker_Nav_Menu {
    function __construct( $css_class_prefix ) {
        $this->css_class_prefix = $css_class_prefix;

        // Define menu item names appropriately
        $this->item_css_class_suffixes = array(
            'item'                    => '__item',
            'link'                    => '__link',
            


            'active_item'             => '__item  active',
            'active_sub_item'         => '__submenu__item  active',
            'parent_of_active_item'   => '__item parent-active',
            'ancestor_of_active_item' => '__item ancestor-active',

            'sub_menu'                => '__submenu submenu',
            'sub_item'                => '__submenu__item',
            'sub_link'                => '__submenu__link'
        );
    }

    // Check for children
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

    function start_lvl( &$output, $depth = 1, $args = array() ) {

        $real_depth = $depth + 1;

        $indent      = str_repeat( "\t", $real_depth );
        $prefix      = $this->css_class_prefix;
        $suffix      = $this->item_css_class_suffixes;
        $classes     = array(
            $prefix . $suffix['sub_menu'],
        );
        $class_names = implode( ' ', $classes );
        // Add a ul wrapper to sub nav
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    // Add main/sub classes to li's and links

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;

        $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent
        $prefix = $this->css_class_prefix;
        $suffix = $this->item_css_class_suffixes;
        // Item classes
        $item_classes = array(
            'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : $prefix . $suffix['sub_item'],
            'parent_class'          => $args->has_children ? $parent_class = $suffix['parent_item'] : '',
            'active_page_class'     => in_array( "current-menu-item", $item->classes ) ? ( $depth == 0 ? $prefix . $suffix['active_item'] : $prefix . $suffix['active_sub_item'] ) : '',
            'active_parent_class'   => in_array( "current-menu-parent", $item->classes ) ? $prefix . $suffix['parent_of_active_item'] : '',
            'active_ancestor_class' => in_array( "current-menu-ancestor", $item->classes ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
            'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--' . $item->classes[0] : ''
        );
        // convert array to string excluding any empty values
        $class_string = implode( "  ", array_filter( $item_classes ) );
        // Add the classes to the wrapping <li>
        $output .= $indent . '<li class="' . $class_string . '">';
        // Link classes
        $link_classes      = array(
            'item_link' => $depth == 0 ? $prefix . $suffix['link'] : $prefix . $suffix['sub_link'],
        );
        $link_class_string = implode( "  ", array_filter( $link_classes ) );
        $link_class_output = 'class="' . $link_class_string . '"';
        // link attributes
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        // remove circular references
        if ( ! $item->current ) {
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
        } else {
            $attributes .= ! empty( $item->url ) ? ' ' : ' ';
        }
        // Creatre link markup
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' ' . $link_class_output . '>';
        $item_output .= $args->link_before;
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= $args->after;
        $item_output .= '</a>';
        // Filter <li>

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class walker_bem_footer_menu_bottom extends Walker_Nav_Menu {
    function __construct( $css_class_prefix ) {
        $this->css_class_prefix = $css_class_prefix;

        // Define menu item names appropriately
        $this->item_css_class_suffixes = array(
            'item'                    => '__item',
            'link'                    => '__link',
            
            'parent_item'             => 's menu__link--sub has-child',

            'active_item'             => '__item  active',
            'active_sub_item'         => '__submenu__item  active',
            'parent_of_active_item'   => '__item parent-active',
            'ancestor_of_active_item' => '__item ancestor-active',

            'sub_menu'                => '__submenu submenu',
            'sub_item'                => '__submenu__item',
            'sub_link'                => '__submenu__link'
        );
    }

    // Check for children
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

    function start_lvl( &$output, $depth = 1, $args = array() ) {

        $real_depth = $depth + 1;

        $indent      = str_repeat( "\t", $real_depth );
        $prefix      = $this->css_class_prefix;
        $suffix      = $this->item_css_class_suffixes;
        $classes     = array(
            $prefix . $suffix['sub_menu'],
        );
        $class_names = implode( ' ', $classes );
        // Add a ul wrapper to sub nav
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    // Add main/sub classes to li's and links

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;

        $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent
        $prefix = $this->css_class_prefix;
        $suffix = $this->item_css_class_suffixes;
        // Item classes
        $item_classes = array(
            'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : $prefix . $suffix['sub_item'],
            'parent_class'          => $args->has_children ? $parent_class = $suffix['parent_item'] : '',
            'active_page_class'     => in_array( "current-menu-item", $item->classes ) ? ( $depth == 0 ? $prefix . $suffix['active_item'] : $prefix . $suffix['active_sub_item'] ) : '',
            'active_parent_class'   => in_array( "current-menu-parent", $item->classes ) ? $prefix . $suffix['parent_of_active_item'] : '',
            'active_ancestor_class' => in_array( "current-menu-ancestor", $item->classes ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
            'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--' . $item->classes[0] : ''
        );
        // convert array to string excluding any empty values
        $class_string = implode( "  ", array_filter( $item_classes ) );
        // Add the classes to the wrapping <li>
        $output .= $indent . '<li class="' . $class_string . '">';
        // Link classes
        $link_classes      = array(
            'item_link' => $depth == 0 ? $prefix . $suffix['link'] : $prefix . $suffix['sub_link'],
        );
        $link_class_string = implode( "  ", array_filter( $link_classes ) );
        $link_class_output = 'class="' . $link_class_string . '"';
        // link attributes
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        // remove circular references
        if ( ! $item->current ) {
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
        } else {
            $attributes .= ! empty( $item->url ) ? ' ' : ' ';
        }
        // Creatre link markup
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' ' . $link_class_output . '>';
        $item_output .= $args->link_before;
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= $args->after;
        $item_output .= '</a>';
        // Filter <li>

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}



// class walker_bem_head_menu_cats extends Walker_Nav_Menu {
//     function __construct( $css_class_prefix ) {
//         $this->css_class_prefix = $css_class_prefix;

//         // Define menu item names appropriately
//         $this->item_css_class_suffixes = array(
//             'item'                    => '__item',
//             'sub_item'                => '__ submenu__item',
//             'parent_item'             => 's menu__link--sub has-child',
//             'active_item'             => '__item active',
//             'active_sub_item'         => '__dropdown-item--active',
//             'parent_of_active_item'   => '__item--parent-active',
//             'ancestor_of_active_item' => '__item--ancestor-active',
//             'sub_menu'                => 's submenu',
//             'link'                    => '__link',
//             'sub_link'                => '__sub-link submenu__link',
//             'sub_menu_item'           => '__ submenu__item'
//         );
//     }

//     // Check for children
//     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

//         $id_field = $this->db_fields['id'];

//         if ( is_object( $args[0] ) ) {
//             $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
//         }

//         return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

//     }

//     function start_lvl( &$output, $depth = 1, $args = array() ) {

//         $real_depth = $depth + 1;

//         $indent      = str_repeat( "\t", $real_depth );
//         $prefix      = $this->css_class_prefix;
//         $suffix      = $this->item_css_class_suffixes;
//         $classes     = array(
//             $prefix . $suffix['sub_menu'],
//         );
//         $class_names = implode( ' ', $classes );
//         // Add a ul wrapper to sub nav
//         $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
//     }

//     // Add main/sub classes to li's and links

//     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

//         global $wp_query;

//         $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent
//         $prefix = $this->css_class_prefix;
//         $suffix = $this->item_css_class_suffixes;
//         // Item classes
//         $item_classes = array(
//             'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : $prefix . $suffix['sub_item'],
//             'parent_class'          => $args->has_children ? $parent_class = $suffix['parent_item'] : '',
//             'active_page_class'     => in_array( "current-menu-item", $item->classes ) ? ( $depth == 0 ? $prefix . $suffix['active_item'] : $prefix . $suffix['active_sub_item'] ) : '',
//             'active_parent_class'   => in_array( "current-menu-parent", $item->classes ) ? $prefix . $suffix['parent_of_active_item'] : '',
//             'active_ancestor_class' => in_array( "current-menu-ancestor", $item->classes ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
//             'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--' . $item->classes[0] : ''
//         );
//         // convert array to string excluding any empty values
//         $class_string = implode( "  ", array_filter( $item_classes ) );
//         // Add the classes to the wrapping <li>
//         $output .= $indent . '<li class="' . $class_string . '">';
//         // Link classes
//         $link_classes      = array(
//             'item_link' => $depth == 0 ? $prefix . $suffix['link'] : $prefix . $suffix['sub_link'],
//         );
//         $link_class_string = implode( "  ", array_filter( $link_classes ) );
//         $link_class_output = 'class="' . $link_class_string . '"';
//         // link attributes
//         $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
//         $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
//         $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
//         // remove circular references
//         if ( ! $item->current ) {
//             $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
//         } else {
//             $attributes .= ! empty( $item->url ) ? ' ' : ' ';
//         }
//         // Creatre link markup
//         $item_output = $args->before;
//         $item_output .= '<a' . $attributes . ' ' . $link_class_output . '>';
//         $item_output .= $args->link_before;
//         $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
//         $item_output .= $args->link_after;
//         $item_output .= $args->after;
//         $item_output .= '</a>';
//         // Filter <li>

//         $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
//     }
// }

// class walker_bem_side_menu extends Walker_Nav_Menu {
//     function __construct( $css_class_prefix ) {
//         $this->css_class_prefix = $css_class_prefix;

//         // Define menu item names appropriately
//         $this->item_css_class_suffixes = array(
//             'item'                    => '-item',
//             'sub_item'                => '__sub-item',
//             'parent_item'             => 'has-child',
//             'active_item'             => 'is-active',
//             'active_sub_item'         => '__dropdown-item--active',
//             'parent_of_active_item'   => '__item--parent-active',
//             'ancestor_of_active_item' => '__item--ancestor-active',
//             'sub_menu'                => '__sub-list',
//             'link'                    => '-link',
//             'sub_link'                => '__sub-link',
//             'sub_menu_item'           => '__sub-menu__item'
//         );
//     }

//     // Check for children
//     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

//         $id_field = $this->db_fields['id'];

//         if ( is_object( $args[0] ) ) {
//             $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
//         }

//         return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

//     }

//     function start_lvl( &$output, $depth = 1, $args = array() ) {

//         $real_depth = $depth + 1;

//         $indent      = str_repeat( "\t", $real_depth );
//         $prefix      = $this->css_class_prefix;
//         $suffix      = $this->item_css_class_suffixes;
//         $classes     = array(
//             $prefix . $suffix['sub_menu'],
//         );
//         $class_names = implode( ' ', $classes );
//         // Add a ul wrapper to sub nav
//         $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
//     }

//     // Add main/sub classes to li's and links

//     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

//         global $wp_query;

//         $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent
//         $prefix = $this->css_class_prefix;
//         $suffix = $this->item_css_class_suffixes;
//         // Item classes
//         $item_classes = array(
//             'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : $prefix . $suffix['sub_item'],
//             'parent_class'          => $args->has_children ? $parent_class = $suffix['parent_item'] : '',
//             'active_page_class'     => in_array( "current-menu-item", $item->classes ) ? ( $depth == 0 ? $prefix . $suffix['active_item'] : $prefix . $suffix['active_sub_item'] ) : '',
//             'active_parent_class'   => in_array( "current-menu-parent", $item->classes ) ? $prefix . $suffix['parent_of_active_item'] : '',
//             'active_ancestor_class' => in_array( "current-menu-ancestor", $item->classes ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
//             'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--' . $item->classes[0] : ''
//         );
//         // convert array to string excluding any empty values
//         $class_string = implode( "  ", array_filter( $item_classes ) );
//         // Add the classes to the wrapping <li>
//         $output .= $indent . '<li class="' . $class_string . '">';
//         // Link classes
//         $link_classes      = array(
//             'item_link' => $depth == 0 ? $prefix . $suffix['link'] : $prefix . $suffix['sub_link'],
//         );
//         $link_class_string = implode( "  ", array_filter( $link_classes ) );
//         $link_class_output = 'class="' . $link_class_string . '"';
//         // link attributes
//         $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
//         $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
//         $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
//         // remove circular references
//         if ( ! $item->current ) {
//             $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
//         } else {
//             $attributes .= ! empty( $item->url ) ? ' ' : ' ';
//         }
//         // Creatre link markup
//         $item_output = $args->before;
//         $item_output .= '<a' . $attributes . ' ' . $link_class_output . '>';
//         $item_output .= $args->link_before;
//         $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
//         $item_output .= $args->link_after;
//         $item_output .= $args->after;
//         $item_output .= '</a>';
//         // Filter <li>

//         $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
//     }
// }

// class walker_bem_side_menu_cats extends Walker_Nav_Menu {
//     function __construct( $css_class_prefix ) {
//         $this->css_class_prefix = $css_class_prefix;

//         // Define menu item names appropriately
//         $this->item_css_class_suffixes = array(
//             'item'                    => '__item',
//             'sub_item'                => '__sub-item',
//             'parent_item'             => ' has-child',
//             'active_item'             => '__item nav-item__active',
//             'active_sub_item'         => '__dropdown-item--active',
//             'parent_of_active_item'   => '__item--parent-active',
//             'ancestor_of_active_item' => '__item--ancestor-active',
//             'sub_menu'                => '__sub-list',
//             'link'                    => '__link',
//             'sub_link'                => '__sub-link',
//             'sub_menu_item'           => '__sub-menu__item'
//         );
//     }

//     // Check for children
//     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

//         $id_field = $this->db_fields['id'];

//         if ( is_object( $args[0] ) ) {
//             $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
//         }

//         return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

//     }

//     function start_lvl( &$output, $depth = 1, $args = array() ) {

//         $real_depth = $depth + 1;

//         $indent      = str_repeat( "\t", $real_depth );
//         $prefix      = $this->css_class_prefix;
//         $suffix      = $this->item_css_class_suffixes;
//         $classes     = array(
//             $prefix . $suffix['sub_menu'],
//         );
//         $class_names = implode( ' ', $classes );
//         // Add a ul wrapper to sub nav
//         $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
//     }

//     // Add main/sub classes to li's and links

//     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

//         global $wp_query;

//         $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent
//         $prefix = $this->css_class_prefix;
//         $suffix = $this->item_css_class_suffixes;
//         // Item classes
//         $item_classes = array(
//             'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : $prefix . $suffix['sub_item'],
//             'parent_class'          => $args->has_children ? $parent_class = $suffix['parent_item'] : '',
//             'active_page_class'     => in_array( "current-menu-item", $item->classes ) ? ( $depth == 0 ? $prefix . $suffix['active_item'] : $prefix . $suffix['active_sub_item'] ) : '',
//             'active_parent_class'   => in_array( "current-menu-parent", $item->classes ) ? $prefix . $suffix['parent_of_active_item'] : '',
//             'active_ancestor_class' => in_array( "current-menu-ancestor", $item->classes ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
//             'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--' . $item->classes[0] : ''
//         );
//         // convert array to string excluding any empty values
//         $class_string = implode( "  ", array_filter( $item_classes ) );
//         // Add the classes to the wrapping <li>
//         $output .= $indent . '<li class="' . $class_string . '">';
//         // Link classes
//         $link_classes      = array(
//             'item_link' => $depth == 0 ? $prefix . $suffix['link'] : $prefix . $suffix['sub_link'],
//         );
//         $link_class_string = implode( "  ", array_filter( $link_classes ) );
//         $link_class_output = 'class="' . $link_class_string . '"';
//         // link attributes
//         $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
//         $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
//         $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
//         // remove circular references
//         if ( ! $item->current ) {
//             $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
//         } else {
//             $attributes .= ! empty( $item->url ) ? ' ' : ' ';
//         }
//         // Creatre link markup
//         $item_output = $args->before;
//         $item_output .= '<a' . $attributes . ' ' . $link_class_output . '>';
//         $item_output .= $args->link_before;
//         $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
//         $item_output .= $args->link_after;
//         $item_output .= $args->after;
//         $item_output .= '</a>';
//         // Filter <li>

//         $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
//     }
// }

// class walker_bem_footer_menu extends Walker_Nav_Menu {
//     function __construct( $css_class_prefix ) {
//         $this->css_class_prefix = $css_class_prefix;

//         // Define menu item names appropriately
//         $this->item_css_class_suffixes = array(
//             'item'                    => '__item',
//             'sub_item'                => '-sub-item',
//             'parent_item'             => 'menu-item-parent',
//             'active_item'             => 'dd active',
//             'active_sub_item'         => '__item--active',
//             'parent_of_active_item'   => '__item--parent-active',
//             'ancestor_of_active_item' => '__item--ancestor-active',
//             'sub_menu'                => '',
//             'link'                    => '__link',
//             'sub_link'                => '-link'
//         );
//     }

//     // Check for children
//     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

//         $id_field = $this->db_fields['id'];

//         if ( is_object( $args[0] ) ) {
//             $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
//         }

//         return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

//     }

//     function start_lvl( &$output, $depth = 1, $args = array() ) {

//         $real_depth = $depth + 1;

//         $indent      = str_repeat( "\t", $real_depth );
//         $prefix      = $this->css_class_prefix;
//         $suffix      = $this->item_css_class_suffixes;
//         $classes     = array(
//             $prefix . $suffix['sub_menu'],
//         );
//         $class_names = implode( ' ', $classes );
//         // Add a ul wrapper to sub nav
//         $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
//     }

//     // Add main/sub classes to li's and links

//     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

//         global $wp_query;

//         $indent = ( $depth > 0 ? str_repeat( "    ", $depth ) : '' ); // code indent
//         $prefix = $this->css_class_prefix;
//         $suffix = $this->item_css_class_suffixes;
//         // Item classes
//         $item_classes = array(
//             'item_class'            => $depth == 0 ? $prefix . $suffix['item'] : $prefix . $suffix['sub_item'],
//             'parent_class'          => $args->has_children ? $parent_class = $suffix['parent_item'] : '',
//             'active_page_class'     => in_array( "current-menu-item", $item->classes ) ? ( $depth == 0 ? $prefix . $suffix['active_item'] : $prefix . $suffix['active_sub_item'] ) : '',
//             'active_parent_class'   => in_array( "current-menu-parent", $item->classes ) ? $prefix . $suffix['parent_of_active_item'] : '',
//             'active_ancestor_class' => in_array( "current-menu-ancestor", $item->classes ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
//             'user_class'            => $item->classes[0] !== '' ? $prefix . '__item--' . $item->classes[0] : ''
//         );
//         // convert array to string excluding any empty values
//         $class_string = implode( "  ", array_filter( $item_classes ) );
//         // Add the classes to the wrapping <li>
//         $output .= $indent . '<li class="' . $class_string . '">';
//         // Link classes
//         $link_classes      = array(
//             'item_link' => $depth == 0 ? $prefix . $suffix['link'] : $prefix . $suffix['sub_link'],
//         );
//         $link_class_string = implode( "  ", array_filter( $link_classes ) );
//         $link_class_output = 'class="' . $link_class_string . '"';
//         // link attributes
//         $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
//         $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
//         $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
//         // remove circular references
//         if ( ! $item->current ) {
//             $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
//         } else {
//             $attributes .= ! empty( $item->url ) ? ' ' : ' ';
//         }
//         // Creatre link markup
//         $item_output = $args->before;
//         $item_output .= '<a' . $attributes . ' ' . $link_class_output . '>';
//         $item_output .= $args->link_before;
//         $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
//         $item_output .= $args->link_after;
//         $item_output .= $args->after;
//         $item_output .= '</a>';
//         // Filter <li>

//         $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
//     }
// }

// class walker_bem_footer_menu_cats extends Walker_Nav_Menu {
//     function __construct( $css_class_prefix ) {
//         $this->css_class_prefix = $css_class_prefix;

//         // Define menu item names appropriately
//         $this->item_css_class_suffixes = array(
//             'item'                    => '-item',
//             'sub_item'                => '-sub-item',
//             'parent_item'             => 'menu-item-parent',
//             'active_item'             => '__item--active',
//             'active_sub_item'         => '__item--active',
//             'parent_of_active_item'   => '__item--parent-active',
//             'ancestor_of_active_item' => '__item--ancestor-active',
//             'sub_menu'                => '',
//             'link'                    => '-link',
//             'sub_link'                => '-link'
//         );
//     }

//     // Check for children
//     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

//         $id_field = $this->db_fields['id'];

//         if ( is_object( $args[0] ) ) {
//             $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
//         }

//         return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

//     }

//     function start_lvl( &$output, $depth = 1, $args = a