<?php

/**
 * Show sale prices in the cart.
 */
function my_custom_show_sale_price_at_cart( $old_display, $cart_item, $cart_item_key ) {

	/** @var WC_Product $product */
	$product = $cart_item['data'];

	if ( $product ) {
		return $product->get_price_html();
	}

	return $old_display;

}
add_filter( 'woocommerce_cart_item_price', 'my_custom_show_sale_price_at_cart', 10, 3 );

/**
 * Show sale prices at the checkout.
 */
function my_custom_show_sale_price_at_checkout( $subtotal, $cart_item, $cart_item_key ) {

	/** @var WC_Product $product */
	$product = $cart_item['data'];
	$quantity = $cart_item['quantity'];

	if ( ! $product ) {
		return $subtotal;
	}

	$regular_price = $sale_price = $suffix = '';

	if ( $product->is_taxable() ) {

		if ( 'excl' === WC()->cart->tax_display_cart ) {

			$regular_price = wc_get_price_excluding_tax( $product, array( 'price' => $product->get_regular_price(), 'qty' => $quantity ) );
			$sale_price    = wc_get_price_excluding_tax( $product, array( 'price' => $product->get_sale_price(), 'qty' => $quantity ) );

			if ( WC()->cart->prices_include_tax && WC()->cart->tax_total > 0 ) {
				$suffix .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
			}
		} else {

			$regular_price = wc_get_price_including_tax( $product, array( 'price' => $product->get_regular_price(), 'qty' => $quantity ) );
			$sale_price = wc_get_price_including_tax( $product, array( 'price' => $product->get_sale_price(), 'qty' => $quantity ) );

			if ( ! WC()->cart->prices_include_tax && WC()->cart->tax_total > 0 ) {
				$suffix .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
			}
		}
	} else {
		$regular_price    = $product->get_price() * $quantity;
		$sale_price       = $product->get_sale_price() * $quantity;
	}

	if ( $product->is_on_sale() && ! empty( $sale_price ) ) {
		$price = wc_format_sale_price(
			         wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price(), 'qty' => $quantity ) ),
			         wc_get_price_to_display( $product, array( 'qty' => $quantity ) )
		         ) . $product->get_price_suffix();
	} else {
		$price = wc_price( $regular_price ) . $product->get_price_suffix();
	}

	// VAT suffix
	$price = $price . $suffix;

	return $price;

}
add_filter( 'woocommerce_cart_item_subtotal', 'my_custom_show_sale_price_at_checkout', 10, 3 );


/**
 * Show savings at the cart.
 */
function my_custom_buy_now_save_x_cart() {

	$savings = 0;

	foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
		/** @var WC_Product $product */
		$product = $cart_item['data'];

		if ( $product->is_on_sale() ) {
			$savings += ( $product->get_regular_price() - $product->get_sale_price() ) * $cart_item['quantity'];
		}
	}

	if ( ! empty( $savings ) ) {
		?><tr class="order-savings">
			<th><?php _e('Your discount', 'wine-space-shopkeeper'); ?></th>
			<td data-title="<?php _e('Your discount', 'wine-space-shopkeeper'); ?>"><?php echo sprintf( __( 'Buy now and save %s!', 'wine-space-shopkeeper'), wc_price( $savings ) ); ?></td>
		</tr><?php
	}

}
add_action( 'woocommerce_cart_totals_before_order_total', 'my_custom_buy_now_save_x_cart' );


/**
* Add shipping condition link on checkout page
*/

add_action( 'woocommerce_checkout_before_terms_and_conditions', 'add_shipping_conditions_link_page' );

function add_shipping_conditions_link_page() {
	echo '<p><a href="'.get_site_url().'/conditions-de-livraison" style="text-transform: uppercase;font-weight: bold;">'. __('Terms of delivery', 'wine-space-shopkeeper') .'</a></p>';
}

/**
* WooCommerce: show all product attributes listed below each item on Cart page
*/
function ev_woo_cart_attributes( $cart_item, $cart_item_key ) {
    if (!is_cart()) {
			return $cart_item;
		}

		$item_data = $cart_item_key['data'];
    $attributes = $item_data->get_attributes();

		$displayed_attributes = ['pa_domaine'];

    if ( ! $attributes ) {
        return $cart_item;
    }

    $out = $cart_item;

    foreach ( $attributes as $attribute ) {
        // skip variations
        if ( $attribute->get_variation() ) {
            continue;
        }

        $name = $attribute->get_name();
				if (in_array($name, $displayed_attributes)) {
	        if ( $attribute->is_taxonomy() ) {
	            $product_id = $item_data->get_id();
	            $terms = wp_get_post_terms( $product_id, $name, 'all' );
	            if ( ! empty( $terms ) ) {
	                if ( ! is_wp_error( $terms ) ) {
	                    // get the taxonomy
	                    $tax = $terms[0]->taxonomy;
	                    // get the tax object
	                    $tax_object = get_taxonomy($tax);
	                    // get tax label
	                    if ( isset ( $tax_object->labels->singular_name ) ) {
	                        $tax_label = $tax_object->labels->singular_name;
	                    } elseif ( isset( $tax_object->label ) ) {
	                        $tax_label = $tax_object->label;
	                        // Trim label prefix since WC 3.0
	                        $label_prefix = 'Product ';
	                        if ( 0 === strpos( $tax_label,  $label_prefix ) ) {
	                            $tax_label = substr( $tax_label, strlen( $label_prefix ) );
	                        }
	                    }
	                    $tax_terms = array();
	                    foreach ( $terms as $term ) {
	                        $single_term = esc_html( $term->name );
	                        array_push( $tax_terms, $single_term );
	                    }
	                    $out .= implode(', ', $tax_terms). '<br />';

	                }
	            }
	        } else { // not a taxonomy
	            $out .= esc_html( implode( ', ', $attribute->get_options() ) ) . '<br />';
	        }
				}
    }

		// Displaying Toolset attributes
		$millesime = types_render_field('product-millesime', array('post_id' => $item_data->get_id()));
		if ($millesime) {
			$out .= strip_tags($millesime) . '<br />';
		}

    echo $out;
}

add_filter( 'woocommerce_cart_item_name', ev_woo_cart_attributes, 10, 2 );

?>