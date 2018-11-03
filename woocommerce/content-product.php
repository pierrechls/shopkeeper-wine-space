<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $shopkeeper_theme_options, $animateCounter;

//woocommerce_shop_loop_item_title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

//woocommerce_before_shop_loop_item
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

//woocommerce_after_shop_loop_item_title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop_item_title_loop_price', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title_loop_rating', 'woocommerce_template_loop_rating', 5 );

//woocommerce_before_shop_loop_item_title
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>


<li itemprop="itemListElement" itemscope itemtype="http://schema.org/Product" class="column <?php if ( $animateCounter ) echo ' delay-' . $animateCounter; ?><?php if ( (isset($shopkeeper_theme_options['catalog_mode'])) && ($shopkeeper_theme_options['catalog_mode'] == 1) ) echo ' display_buttons'; ?><?php if ( !$shopkeeper_theme_options['add_to_cart_display']) echo ' display_buttons'; ?>">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<?php
			$attachment_ids = $product->get_gallery_image_ids();
			if ( $attachment_ids ) {
				$loop = 0;
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					if (!$image_link) continue;
					$loop++;
					$product_thumbnail_second = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
					if ($loop == 1) break;
				}
			}
		?>

		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

		<?php

		$style = '';
		$class = '';
		if (isset($product_thumbnail_second[0])) {
			$style = 'background-image:url(' . $product_thumbnail_second[0] . ')';
			$class = 'with_second_image';
		}

		if ( (isset($shopkeeper_theme_options['second_image_product_listing'])) && ($shopkeeper_theme_options['second_image_product_listing'] == "0" ) ) {
			$style = '';
			$class = '';
		}

		?>

		<div class="product_thumbnail_wrapper <?php if ( !$product->is_in_stock() ) : ?>outofstock<?php endif; ?>">

			<div class="product_thumbnail <?php echo $class; ?>">
				<a href="<?php the_permalink(); ?>" itemprop="url">
					<span class="product_thumbnail_background" style="<?php echo $style; ?>"></span>
					<?php
						if ( has_post_thumbnail( $product->get_id() ) ) {
							echo get_the_post_thumbnail( $product->get_id(), 'medium', array( 'itemprop' => 'image' ));
						} else {
							?>
								<img  itemprop="image" width="104" height="300" src="<?php echo get_stylesheet_directory_uri() . '/images/products/default-bottle.svg'; ?>" class="attachment-medium size-medium wp-post-image"  alt="default-bottle-image" srcset="<?php echo get_stylesheet_directory_uri() . '/images/products/default-bottle.svg'; ?>" sizes="(max-width: 104px) 100vw, 104px" style="opacity: 1;" />
							<?php
						}
					?>
				</a>
			</div><!--.product_thumbnail-->

			<?php if ( (isset($shopkeeper_theme_options['catalog_mode'])) && ($shopkeeper_theme_options['catalog_mode'] == 0) ) : ?>
				<?php wc_get_template( 'loop/sale-flash.php' ); ?>
            <?php endif; ?>

			<?php if ( (isset($shopkeeper_theme_options['catalog_mode'])) && ($shopkeeper_theme_options['catalog_mode'] == 0) ) : ?>
				<?php if ( !$product->is_in_stock() && !empty($shopkeeper_theme_options['out_of_stock_label']) ) : ?>
                    <div class="out_of_stock_badge_loop"><?php _e( $shopkeeper_theme_options['out_of_stock_label'], 'woocommerce' ); ?></div>
                <?php endif; ?>
            <?php endif; ?>

			<?php if (class_exists('YITH_WCWL')) : ?>
			<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

		</div><!--.product_thumbnail_wrapper-->
		<div class="ev-loop-product-description">
			<h3 itemprop="name"><a class="product-title-link ev-loop-product-title-link" itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php
				$domaineId = wpcf_pr_post_get_belongs(get_the_ID(), 'domaine');
				$millesime = types_render_field('product-millesime');
				if (!empty($domaineId) || $millesime != '') {
			?>
				<div class="ev-loop-product-domaine-and-cuvee">
					<?php if (!empty($domaineId)) { ?> <p><?php echo get_the_title($domaineId); ?></p> <?php } ?>
					<?php if ($millesime != '') { echo $millesime; } ?>
				</div>
			<?php
				}
			?>

			<div class="ev-loop-price-add-to-cart">
				<div class="ev-loop-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					<p class="ev-price">
						<?php
							if($product->get_sale_price() > 0 ){
						?>
								<span class="regular-price"><?php echo number_format($product->get_regular_price(), 2); ?> €</span>
								<span itemprop="price" class="product-price"><?php echo number_format($product->get_price(), 2); ?> €</span>
						<?php
							} else {
						?>
								<span class="blank-regular-price"></span>
								<span itemprop="price" class="product-price"><?php echo number_format($product->get_price(), 2); ?> €</span>
						<?php
							}
						?>
					</p>
				</div>
				<div class="ev-loop-add-to-cart">
					<div class="actions <?php if ( !$product->is_in_stock() ) { echo 'not-is-stock'; } ?>">
						<div class="add-product p-action">
							<?php if ( $product->is_in_stock() ) { ?>
								<div id="ev-add-to-card-product-<?php echo $product->get_id(); ?>" class="ev-loop-add-to-card-product">
										<?php woocommerce_quantity_input(); ?>

										<?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
											sprintf( "<a id=\"ev-a-link-add-cart-%s\" href=\"%s\" rel=\"nofollow\" data-product_id=\"%s\" data-product_sku=\"%s\" data-quantity=\"%s\" class=\"%s ev-link-add-cart product_type_%s %s\"><span class='ev-cart-icon'>%s</span></a>",
												esc_attr( $product->get_id() ),
												esc_url( $product->add_to_cart_url() ),
												esc_attr( $product->get_id() ),
												esc_attr( $product->get_sku() ),
												esc_attr( isset( $quantity ) ? $quantity : 1 ),
												$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
												esc_attr( $product->product_type ),
												'ajax_add_to_cart',
												esc_html('')
											), $product ); ?>
								</div>
								<script type="text/javascript">

										var productForm = document.getElementById('ev-add-to-card-product-<?php echo $product->get_id(); ?>')
										var linkAddProduct = productForm.querySelector('a.ev-link-add-cart')
										var inputQuantityProduct = productForm.querySelector('.quantity.custom input.custom-qty')
										var minButtonProduct = productForm.querySelector('.quantity.custom a.minus-btn')
										var maxButtonProduct = productForm.querySelector('.quantity.custom a.plus-btn')

										linkAddProduct.addEventListener('click', function() {
												setTimeout(function(){
														var form = document.getElementById('ev-add-to-card-product-<?php echo $product->get_id(); ?>')
														form.innerHTML = '<div class="ev-spinner-loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
														setTimeout(function(){
																form.innerHTML = '<p class="product-add-see-cart"><a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>">Voir panier</a></p>';
														}, 2 * 1000)
												}, 0.1 * 1000)
								    })

										inputQuantityProduct.addEventListener('change', function() {
											var input = document.querySelector('#ev-add-to-card-product-<?php echo $product->get_id(); ?> .quantity.custom input.custom-qty')
											var link = document.getElementById('ev-a-link-add-cart-<?php echo $product->get_id(); ?>')
											var quantity = parseInt(input.value) == 0 || !Number.isInteger(parseInt(input.value)) ? 1 : parseInt(input.value)
											input.value = quantity
											link.setAttribute('data-quantity', quantity)
								    })

								    minButtonProduct.addEventListener('click', function() {
											var input = document.querySelector('#ev-add-to-card-product-<?php echo $product->get_id(); ?> .quantity.custom input.custom-qty')
											var link = document.getElementById('ev-a-link-add-cart-<?php echo $product->get_id(); ?>')
											var quantity = parseInt(input.value) > 1 ? parseInt(input.value) - 1 : parseInt(input.value)
											link.setAttribute('data-quantity', quantity)
								    })

								    maxButtonProduct.addEventListener('click', function() {
											var input = document.querySelector('#ev-add-to-card-product-<?php echo $product->get_id(); ?> .quantity.custom input.custom-qty')
											var link = document.getElementById('ev-a-link-add-cart-<?php echo $product->get_id(); ?>')
											var quantity = parseInt(input.value) + 1
											link.setAttribute('data-quantity', quantity)
								    })

								</script>
							<?php } else { ?>
								<p class="product-not-in-stock-see-text">
									<a class="product-not-in-stock-see-link" href="<?php echo esc_url( add_query_arg( 'cat', $term->term_id, get_permalink( $products->post->ID )) ); ?>">
										<span class='ev-see-icon'></span>
									</a>
								</p>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
</li>
