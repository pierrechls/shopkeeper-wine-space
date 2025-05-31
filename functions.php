<?php

/****************************************************************/
/**************************** GLOBAL ****************************/
/****************************************************************/

add_action( 'wp_enqueue_scripts', 'shopkeeper_enqueue_styles', 99 );
function shopkeeper_enqueue_styles() {

    // enqueue parent styles
    wp_enqueue_style( 'shopkeeper-icon-font', get_template_directory_uri() . '/inc/fonts/shopkeeper-icon-font/style.css', NULL, shopkeeper_theme_version(), 'all' );
    wp_enqueue_style( 'shopkeeper-styles', get_template_directory_uri() .'/css/styles.css', NULL, shopkeeper_theme_version(), 'all' );
    wp_enqueue_style( 'shopkeeper-default-style', get_template_directory_uri() .'/style.css', NULL, shopkeeper_theme_version(), 'all' );

    // enqueue child styles
    wp_enqueue_style( 'shopkeeper-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'shopkeeper-default-style' ),
        shopkeeper_theme_version(),
        'all'
    );

    // enqueue RTL styles
    if( is_rtl() ) {
        wp_enqueue_style( 'shopkeeper-child-rtl-styles',  get_template_directory_uri() . '/rtl.css', array( 'shopkeeper-styles' ), wp_get_theme()->get('Version') );
    }
}


add_filter( 'woocommerce_before_main_content_breadcrumb', 'remove_breadcrumbs');
function remove_breadcrumbs() {
    if(is_product()) {
        remove_action( 'woocommerce_before_main_content_breadcrumb','woocommerce_breadcrumb', 20, 0);
    }
}

/****************************************************************/
/****************************************************************/
/****************************************************************/



/****************************************************************/
/*********************** ARCHIVE PRODUCT ************************/
/****************************************************************/

add_action('woocommerce_before_shop_loop_item', 'add_product_medailles');


function add_domaine_and_millesime_infos() {
    $domaineId = wpcf_pr_post_get_belongs(get_the_ID(), 'domaine');
    echo '<div class="ev-loop-item-product-additionnals-infos">';
    if (!empty($domaineId)) {
        echo '<p style="margin: 0;">'. get_the_title($domaineId) .'</p>';
    } else {
        echo '<p style="margin: 0;"></br></p>';
    }
    $millesime = types_render_field('product-millesime');
    if ($millesime != '') {
        echo $millesime;
    } else {
        echo '<p style="margin: 0;"></br></p>';
    }
    echo '</div>';
}

add_action('woocommerce_after_shop_loop_item_title', 'add_domaine_and_millesime_infos');


/****************************************************************/
/****************************************************************/
/****************************************************************/


/****************************************************************/
/************************ SINGLE PRODUCT ************************/
/****************************************************************/

// Add background product
function add_product_background_header() {
    if (!is_product()) {  return; }

    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    $categoryID = '';
    $categoryName = '';
    $categoryImage = '';

    if ( $product_cats && ! is_wp_error ( $product_cats ) ){

      $queryCat = get_query_var( 'cat', 0 );

      if($queryCat != 0){

        foreach ($product_cats as $product_cat){
            if( $product_cat->term_taxonomy_id == $queryCat ) {
              $categoryID = $queryCat;
              $categoryName = get_cat_name( $categoryID );
              break;
            }
        }
      }

      if($categoryID == '') {
        $single_cat = array_shift($product_cats);
        if($single_cat->parent == 0) {
          foreach ($product_cats as $product_cat){
              if( $product_cat->parent > 0 ) {
                $single_cat = $product_cat;
                break;
              }
          }
        }
        $categoryID = $single_cat->term_taxonomy_id;
        $categoryName = $single_cat->name;
      }

      $thumbnail_id = get_woocommerce_term_meta( $categoryID, 'thumbnail_id', true );
	  $categoryImage = wp_get_attachment_image_src( $thumbnail_id, 'large')[0];

    }

    echo '<div class="ev-single-product-header">
            <div class="slider-ev-siema">
                <div class="ev-single-product-background" style="background-image: url('. "'" . ($categoryImage != '' ? ($categoryImage) : (get_stylesheet_directory_uri() . '/images/products/products-background.jpg')) . "'" . ')">
                    <img src="'. get_stylesheet_directory_uri() . '/images/products/slider-image.png" alt="espace-vin-slider-image" />
                    <div class="ev-single-product-slide-content">
                        <div class="ev-single-product-slide-content-center">
                        </div>
                    </div>
                </div>
            </div>
          </div>';

    echo '<div class="large-12 xlarge-10 xxlarge-9 large-centered columns">';
    woocommerce_breadcrumb();
    echo '</div>';
          

}

add_action('woocommerce_before_main_content', 'add_product_background_header');


function add_domain_link_single_product() {
    $domaineId = wpcf_pr_post_get_belongs(get_the_ID(), 'domaine');
    echo '<div class="domain-single-product">';
    echo '<p style="font-weight:normal;"><strong>Domaine : </strong></p><p><a href="'. get_post_permalink( $domaineId ) .'">'. get_the_title($domaineId) .'</a></p>';
    echo '</div>';
}
add_action('woocommerce_before_add_to_cart_form', 'add_domain_link_single_product');


// Add background medailles

function add_product_medailles() {
    $medailles = get_field('medailles');
    if( $medailles ) {
		echo '<div class="ev-product-medailles">';
            foreach( $medailles as $medaille ) {
                if( $medaille === 'prix-propiete' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/product-icon-prix-propriete.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Prix propriété</div>
                    </div></div>';
                }
                if( $medaille === 'bio' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/product-icon-agriculture-biologique.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Bio</div>
                    </div></div>';
                }
                if( $medaille === 'terra-vitis' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/medaille-tv.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Terra Vitis</div>
                    </div></div>';
                }
                if( $medaille === 'agriculture-raisonnee' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/medaille-ag.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Agriculture Raisonnee</div>
                    </div></div>';
                }
                if( $medaille === 'biodynamie' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/product-icon-biodynamie.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Biodynamie</div>
                    </div></div>';
                }
                if( $medaille === 'haute-valeur-environnementale' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/product-icon-haute-valeur-environnementale.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">HVE</div>
                    </div></div>';
                }
                if( $medaille === 'vin-nature' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/product-icon-vin-nature.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Nature</div>
                    </div></div>';
                }
                if( $medaille === 'conversion-agriculture-biologique' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/product-icon-conversion-agriculture-biologique.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Conversion Agriculture Biologique</div>
                    </div></div>';
                }
                if( $medaille === 'elevage-amphore' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/product-icon-elevage-amphore.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Élevage Amphore</div>
                    </div></div>';
                }
                if( $medaille === 'sans-sulfite-ajoute' ) { echo '<div class="ev-product-medaille"><img src="' . get_stylesheet_directory_uri() . '/images/products/product-icon-sans-sulfite-ajoute.png' . '"/>
                    <div class="ev-medaille-text-area">
                        <div class="ev-medaille-text">Sans Sulfite Ajouté</div>
                    </div></div>';
                }
            }
        echo '</div>';
    }
}

add_action('woocommerce_single_product_summary', 'add_product_medailles');

// Add production informations
function add_product_detailled_informations() {

    $domaineId = wpcf_pr_post_get_belongs(get_the_ID(), 'domaine');
    
    if (!empty($domaineId)) {
        echo '<div class="ev-single-product-informations ev-single-product-informations-no-border ev-single-product-informations-domain">';
        echo '<div class="ev-product-info-block">';
        echo '<div class="ev-product-info-element">';
        echo '<p style="font-weight:normal;"><strong>Domaine : </strong></p><p><a href="'. get_post_permalink( $domaineId ) .'">'. get_the_title($domaineId) .'</a></p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    $millesime = types_render_field('product-millesime');
    if ($millesime != '') {
        echo '<div class="ev-single-product-informations ev-single-product-informations-no-border">';
        echo '<div class="ev-product-info-block">';
        echo '<div class="ev-product-info-element">';
        echo '<p>Millesime : </p>'. $millesime;
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }


    echo '<div class="ev-single-product-informations">';
    $productAppellation = types_render_field('product-appellation');
    $productElevage = types_render_field('product-elevage');
    $productCepages = types_render_field('product-cepages');
    $productVinification = types_render_field('product-vinification');
    $productService = types_render_field('product-service');
    $productGarde = types_render_field('product-garde');
    $productContenance = types_render_field('product-contenance');
    $productCommentairesDegustations = types_render_field('product-commentaires-degustations');

    if ($productAppellation != '') { echo '<div class="ev-product-info-block"><div class="ev-product-info-element"><p>Appellation :</p>'. $productAppellation. '</div></div>'; }
    if ($productElevage != '') { echo '<div class="ev-product-info-block"><div class="ev-product-info-element"><p>Élevage :</p>'. $productElevage. '</div></div>'; }
    if ($productCepages != '') { echo '<div class="ev-product-info-block"><div class="ev-product-info-element"><p>Cépages :</p>'. $productCepages. '</div></div>'; }
    if ($productVinification != '') {  echo '<div class="ev-product-info-block"><div class="ev-product-info-element"><p>Vinification :</p>'. $productVinification .'</div></div>'; }
    if ($productService != '') {  echo '<div class="ev-product-info-block"><div class="ev-product-info-element"><p>Service :</p>'. $productService .'</div></div>'; }
    if ($productGarde != '') {  echo '<div class="ev-product-info-block"><div class="ev-product-info-element"><p>Garde :</p>'. $productGarde .'</div></div>'; }
    if ($productContenance != '') {  echo '<div class="ev-product-info-block"><div class="ev-product-info-element"><p>Contenance :</p>'. $productContenance .'</div></div>'; }
    echo '</div>';
}

add_action('woocommerce_single_product_summary', 'add_product_detailled_informations');


// Add wine waiter informations

function add_wine_waiter_informations() {
    $wineWaiter = get_field('wine-waiter');
    $reviewTitle = get_field('review-title');
    $reviewText = get_field('review-text');

    if($reviewTitle && $reviewText && $wineWaiter) {
        echo '<div class="large-12 xlarge-10 xxlarge-9 large-centered columns">';
        echo '<div class="ev-single-product-wine-waiter-review">
                <div class="wine-waiter-picture">
                <img src="'.$wineWaiter.'"/>
              </div>
              <div class="wine-waiter-review">
                <p>'.$reviewTitle.'</p>
                <p>'.$reviewText.'</p>
              </div>
            </div>';
        echo '</div>';
    }
}

add_action('woocommerce_after_single_product_summary_data_tabs', 'add_wine_waiter_informations', 5);


// Remove the weight and dimension
add_filter( 'wc_product_enable_dimensions_display', '__return_false' );

/* Remove product meta */
/* WooCommerce hide product page meta - hide_product_meta */
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );


/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 10;
  return $cols;
}


/****************************************************************/
/****************************************************************/
/****************************************************************/


function woocommerce_category_product_header() {

    if ( is_product_category() || is_shop() ) {
        $title =  get_the_title( get_option( 'woocommerce_shop_page_id' ));
        $description = '';
        $categoryImage = '';
        if (is_product_category()) {
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            $categoryImage = wp_get_attachment_url( $thumbnail_id );
            $title = $cat->name;
            $description = $cat->description;
        }

        echo '<div class="single-product" id="category-header-background">';
        echo '<div class="ev-single-product-header">
            <div class="slider-ev-siema">
                <div class="ev-single-product-background" style="background-image: url('. "'" . ($categoryImage != '' ? ($categoryImage) : (get_stylesheet_directory_uri() . '/images/products/products-background.jpg')) . "'" . ')">
                    <img src="'. get_stylesheet_directory_uri() . '/images/products/slider-image.png" alt="espace-vin-slider-image" />
                    <div class="ev-single-product-slide-content">
                        <div class="ev-single-product-slide-content-center">
                            <h1 class="title-content-page-slider" style="color: #FFF; text">'. $title .'</h1>
                        </div>
                    </div>
                </div>
            </div>
          </div>';

        echo '<div class="woocommerce large-12 xlarge-10 xxlarge-9 large-centered columns">';
        woocommerce_breadcrumb();
        echo '</div>';
        echo '</div>';
        echo '<div class="archive-product-description">
            <div style="margin: 2em 0 4em 0;">
                <h6 style="font-weight: 100; color: #797979; text-align: center;">'. $description .'</h6>
            </div>
        </div>';

        echo '<script>
            const container = document.querySelector(\'div#primary.shop-page\');
            const element = document.querySelector(\'#category-header-background\');
            container.insertAdjacentElement("afterbegin", element);

            const oldHeader = document.querySelector(\'.woocommerce-products-header.shop_header\');
            if (oldHeader) { oldHeader.remove() }
        </script>';
        echo '<style>
            #primary.shop-page {
                padding-top: 0;
            }
        </style>';
    }
}
add_action( 'woocommerce_before_main_content', 'woocommerce_category_product_header', 2 );


/****************************************************************/
/************************ SINGLE DOMAINE ************************/
/****************************************************************/

function domain_related_products($content){
    $postType = get_post_type();
    if ($postType === 'domaine' && !is_archive() ) {
        // BEFORE CONTENT
        $before = '';
        ob_start();
        $queryCat = get_query_var( 'cat', 0 );
        $categoryImage = '';

        if($queryCat != 0){
            $thumbnail_id = get_woocommerce_term_meta( $queryCat, 'thumbnail_id', true );
            $categoryImage = wp_get_attachment_image_src( $thumbnail_id, 'large')[0];
        }

        echo '<div class="single-product" id="domain-header-background">';
        echo '<div class="ev-single-product-header">
            <div class="slider-ev-siema">
                <div class="ev-single-product-background" style="background-image: url('. "'" . ($categoryImage != '' ? ($categoryImage) : (get_stylesheet_directory_uri() . '/images/products/products-background.jpg')) . "'" . ')">
                    <img src="'. get_stylesheet_directory_uri() . '/images/products/slider-image.png" alt="espace-vin-slider-image" />
                    <div class="ev-single-product-slide-content">
                        <div class="ev-single-product-slide-content-center">
                        </div>
                    </div>
                </div>
            </div>
          </div>';

        echo '<div class="woocommerce large-12 xlarge-10 xxlarge-9 large-centered columns">';
        woocommerce_breadcrumb();
        echo '</div>';
        echo '</div>';

        echo '<script>
            const container = document.querySelector(\'div[data-elementor-type="single-post"].domaine\');
            const element = document.querySelector(\'#domain-header-background\');
            container.insertAdjacentElement("afterbegin", element);
        </script>';

        $before = ob_get_contents();
		ob_end_clean();



        // AFTER CONTENT
        ob_start();
        global $post;
        echo '<div id="domaine-products" class="woocommerce">';
		$products = types_child_posts('product');
        if( count($products) > 0 ) {

            echo '<div class="domaine-products-list row">';
			do_action('woocommerce_before_shop_loop');
			echo '<div class="large-12 columns">';
            $animateCounter = 0;
            woocommerce_product_loop_start();
            foreach($products as $product) { // variable must be called $post (IMPORTANT)
                global $post;
                $post = $product;
                setup_postdata($post);
                $animateCounter++;
                $after .= wc_get_template_part( 'content', 'product' );
            }
            woocommerce_product_loop_end();
			echo '</div><!-- .columns -->'; 
            echo '</div>';
            wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
            echo '<div class="woocommerce-after-shop-loop-wrapper">';
			do_action( 'woocommerce_after_shop_loop' );
			echo '</div>';
		}
		echo '</div>';

        $after = ob_get_contents();
		ob_end_clean();

        $content = $before . $content . $after;
    }

    return $content; 
} 

add_filter( 'the_content', 'domain_related_products' );



/****************************************************************/
/****************************************************************/
/****************************************************************/

// Intented to use bootstrap 3.
// Location is like a 'primary'
// After, you print menu just add create_bootstrap_menu("primary") in your preferred position;
 
#add this function in your theme functions.php
 
function create_bootstrap_menu( $menu_name ) {

    print_r(get_nav_menu_locations());

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<ul id="menu-' . $menu_name . '">';

        foreach ( (array) $menu_items as $key => $menu_item ) {
            $title = $menu_item->title;
            $url = $menu_item->url;
            $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
        }
        $menu_list .= '</ul>';
    } else {
        $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    }
	
	echo $menu_list;
}