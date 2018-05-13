<?php

function replaceDefaultWocommerceString( $translatedText, $text, $domain ) {

	switch ( $translatedText ) {
		case 'Produits apparentés' :
    case 'Related Products' :
			$translatedText = 'Nos vins sélectionnés pour vous !';
			break;
		case 'What are you looking for?' :
			$translatedText = 'Recherchez un vin, un domaine...';
			break;
		case 'Continue Reading' :
			$translatedText = 'Lire plus';
			break;
		case 'Previous Reading' :
			$translatedText = 'Article précédent';
			break;
		case 'Next Reading' :
			$translatedText = 'Article suivant';
			break;
		case 'All' :
			$translatedText = 'Tous';
			break;
		case 'Category Archives' :
			$translatedText = 'Archives de catégorie';
			break;
		case ' by ' :
			$translatedText = ' par ';
			break;
		case ' on ' :
			$translatedText = ' le ';
			break;
		case ' in ' :
			$translatedText = ' dans ';
			break;
	}
	return $translatedText;
}
add_filter( 'gettext', 'replaceDefaultWocommerceString', 20, 3 );

if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
		'page_title' 	=> 'Wine Space Settings',
		'menu_title'	=> 'WS Settings',
		'menu_slug' 	=> 'ws-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Wine Space Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'ws-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Wine Space Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'ws-general-settings',
	));

  acf_add_options_sub_page(array(
		'page_title' 	=> 'Wine Space Flash Message Settings',
		'menu_title'	=> 'Flash Message',
		'parent_slug'	=> 'ws-general-settings',
	));
}

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

// Breadcrumbs
function custom_breadcrumbs() {

    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs woocommerce-breadcrumb';
    $home_title         = 'Accueil';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrums
        echo '<nav id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
        // Home page
        echo '<a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a>';
        echo '<span class="breadcrump_sep separator separator-home"> ' . $separator . ' </span>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

            echo post_type_archive_title($prefix, false);

        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a>';
                echo '<span class="breadcrump_sep separator"> ' . $separator . ' </span>';

            }

            $custom_tax_name = get_queried_object()->name;
            echo $custom_tax_name;

        } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a>';
                echo '<span class="breadcrump_sep separator"> ' . $separator . ' </span>';

            }

            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {

                // Get last category post is in
                $last_category = end(array_values($category));

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= $parents;
                    $cat_display .= '<span class="breadcrump_sep separator"> ' . $separator . ' </span>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo get_the_title();

            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {

                echo $cat_name;
                echo '<span class="breadcrump_sep separator"> ' . $separator . ' </span>';
                echo get_the_title();

            } else {

                echo get_the_title();

            }

        } else if ( is_category() ) {

            // Category page
            echo single_cat_title('', false);

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a>';
                    $parents .= '<span class="breadcrump_sep separator"> ' . $separator . ' </span>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo get_the_title();

            } else {

                // Just display current page if not parents
                echo get_the_title();

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;

            // Display the tag name
            echo $get_term_name;

        } elseif ( is_day() ) {

            // Day archive

            // Year link
            echo '<a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a>';
            echo '<span class="breadcrump_sep separator"> ' . $separator . ' </span>';

            // Month link
            echo '<a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a>';
            echo '<span class="breadcrump_sep separator"> ' . $separator . ' </span>';

            // Day display
            echo 'Archives';

        } else if ( is_month() ) {

            // Month Archive

            // Year link
            echo '<a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a>';
            echo '<span class="breadcrump_sep separator"> ' . $separator . ' </span>';

            // Month display
            echo 'Archives';

        } else if ( is_year() ) {

            // Display year archive
            echo 'Archives';

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo 'Author: ' . $userdata->display_name;

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo __('Page') . ' ' . get_query_var('paged');

        } else if ( is_search() ) {

            // Search results page
            echo 'Résultats pour : ' . get_search_query();

        } elseif ( is_404() ) {

            // 404 page
            echo 'Error 404';
        }

        echo '</nav>';

    }

}

?>
