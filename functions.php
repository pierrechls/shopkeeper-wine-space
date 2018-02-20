<?php

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', PHP_INT_MAX);
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/styles/fonts.css', array( 'parent-style' ) );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/styles/style.css', array( 'parent-style' ) );
}

function load_siema_library() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/inc/js/siema/siema.min.js',
        array( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'load_siema_library' );

class Social_Icons_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    $class_names = ' class="' . esc_attr( $class_names ) . '"';
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $socialId = types_get_field_meta_value( 'id', $item->object_id);
    $socialLink = types_get_field_meta_value( 'lien', $item->object_id);
    $socialIcons = types_get_field_meta_value( 'icon-fontawesome', $item->object_id);

    $output .= $indent . '<li' . $id . $value . $class_names .'>';
    $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ' target="_blank"';
    $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
    $attributes .= ! empty( $socialLink ) ? ' href="' . esc_attr( $socialLink ) .'"' : '';
    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . $args->link_after;
    $item_output .= '<i class="'. $socialIcons .'" aria-hidden="true"></i>';
    $item_output .= '</a>';

    if ($item->object == 'category') {

      $child_cats = wp_list_categories('taxonomy=group&title_li=&echo=0&child_of='.$item->object_id);

      if ($child_cats) {
        $item_output .= '<ul class="sub-menu">' .$child_cats. '</ul>';;
      }
    }

    $item_output .= $args->after;
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

  }
}

function wpex_add_custom_fonts() {
	return array( 'OpenSans' ); // You can add more then 1 font to the array!
}

?>
