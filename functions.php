<?php

include_once( get_stylesheet_directory() .'/inc/php/load-librairies.php');
include_once( get_stylesheet_directory() .'/inc/php/load-acf-conf.php');
include_once( get_stylesheet_directory() .'/inc/php/load-languages.php');

include_once( get_stylesheet_directory() .'/inc/php/breadcrumbs.php');
include_once( get_stylesheet_directory() .'/inc/php/cart-and-checkout.php');

// CUSTOMIZE ON SALE TEXT
// add_filter('woocommerce_sale_flash', 'ev_display_on_sale_loop_woocommerce', 10, 3);
// function ev_display_on_sale_loop_woocommerce($text, $post, $_product)
// {
//     return '<span class="onsale">PUT YOUR TEXT</span>';
// }


// CUSTOMIZE SOLD OUT
// add_action( 'woocommerce_before_shop_loop_item_title', 'ev_display_sold_out_loop_woocommerce' );
// function ev_display_sold_out_loop_woocommerce() {
//     global $product;
//
//     if ( !$product->is_in_stock() ) {
// 			// <div class="out_of_stock_badge_loop">Rupture de stock</div>
//         echo '<span class="soldout">Bientôt dispo</span>';
//     }
// }

function replaceDefaultWocommerceString( $translatedText, $text, $domain ) {
	switch ( $translatedText ) {
		case '<MY_TEXT_TO_TEST>' :
			$translatedText = $translatedText . " (Domain : '" . $domain ."' - Text : '" . $text ."'";
			break;
	}
	return $translatedText;
}
add_filter( 'gettext', 'replaceDefaultWocommerceString', 20, 3 );

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

?>