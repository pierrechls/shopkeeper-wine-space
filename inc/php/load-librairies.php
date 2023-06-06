<?php

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


function wpex_add_custom_fonts() {
	return array( 'OpenSans' ); // You can add more then 1 font to the array!
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', PHP_INT_MAX);
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/styles/fonts.css', array( 'parent-style' ) );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/styles/style2.css', array( 'parent-style' ) );
}

function load_siema_library() {
    wp_enqueue_script(
        'siema-library',
        get_stylesheet_directory_uri() . '/inc/js/siema/siema.min.js',
        array( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'load_siema_library' );

function load_toggle_menu() {
    wp_enqueue_script(
        'ev-toggle-menu',
        get_stylesheet_directory_uri() . '/inc/js/menu/toggle-menu.js',
        array( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'load_toggle_menu' );

function load_search_ev_script() {
    wp_enqueue_script(
        'search-ev-script',
        get_stylesheet_directory_uri() . '/inc/js/ev/search.js',
        array( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'load_search_ev_script' );

?>