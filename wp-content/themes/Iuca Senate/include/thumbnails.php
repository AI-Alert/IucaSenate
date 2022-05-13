<?php

/* -------------------------------------------------------------------------- */
/*	Регистрация миниатюр изображений
/* -------------------------------------------------------------------------- */

if( function_exists( 'add_image_size' )) {
    add_image_size( 'blur', 60, 60, true );
    // add_image_size( 'banner', 950, 425, true ); 
    // add_image_size( 'product', 240, 330, true ); 
    // add_image_size( 'news', 350, 270, true ); 
    // add_image_size( 'serv', 400, 350, true ); 
    add_image_size( 'middle', 650, 650, true ); 

    // add_image_size( 'news_big', 480, 360, true );
   
    // add_image_size( 'card', 610, 337, true );
    // add_image_size( 'card_big', 915, 480, true );
    add_image_size( 'hero', 1920, 960, true );
}



/* -------------------------------------------------------------------------- */
/*	Убираем лишние размеры миниатюр изображений
/* -------------------------------------------------------------------------- */


// function filter_image_sizes() {
//     foreach ( get_intermediate_image_sizes() as $size ) {
//         if ( in_array( $size, array( '1536x1536', '2048x2048', 'scaled' ) ) ) {
//             remove_image_size( $size );
//         }
//     }
// }
