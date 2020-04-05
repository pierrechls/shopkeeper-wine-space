<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    global $post, $product, $shopkeeper_theme_options;

    //woocommerce_before_single_product
	//nothing changed

	//woocommerce_before_single_product_summary
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

	add_action( 'woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20 );

	//woocommerce_single_product_summary
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

	add_action( 'woocommerce_single_product_summary_single_title', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary_single_rating', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary_single_price', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary_single_excerpt', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'woocommerce_single_product_summary_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30 );
	add_action( 'woocommerce_single_product_summary_single_meta', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary_single_sharing', 'woocommerce_template_single_sharing', 50 );

	//woocommerce_after_single_product_summary
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	add_action( 'woocommerce_after_single_product_summary_data_tabs', 'woocommerce_output_product_data_tabs', 10 );

	//woocommerce_after_single_product
	//nothing changed

	//custom actions
	add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

?>

<style type="text/css">


  .slider-ev-home, .slider-ev-siema {
    height: 20rem;
  }

  .slider-ev-home img {
    height: 20rem;
  }

  .product_layout_classic .product_content_wrapper, .product_content_wrapper {
    margin: 0 auto;
    padding: 0;
  }

  .ev-single-product .row,  .ev-single-product-container .row {
    margin: 2rem auto;
    padding: 1rem 2rem;
    max-width: none;
  }

  .ev-single-product-container .related.products {
    padding: 0;
    margin: 0 auto;
  }

  .ev-single-product-container .related.products h2 {
    padding: 0;
    margin: 0 auto;
    font-size: 2rem !important;
    color: #BAA571;
    font-family: 'Lora';
		font-weight: 800;
  }

	.ev-single-product-container .related.products h2	span {
		font-weight: 800;
	}

  .ev-single-product-container ul.products-grid {
    margin-bottom: 0;
  }

	@media screen and (max-width: 500px) {
	  .slider-ev-home {
      height: auto;
	  }
		.slider-ev-home .ev-breadcrumb {
			position: relative;
		}
		.slider-ev-home .ev-breadcrumb nav,
		.slider-ev-home .ev-breadcrumb nav a,
		.slider-ev-home .ev-breadcrumb nav a:hover,
		.slider-ev-home .ev-breadcrumb nav .breadcrump_sep {
		  color: rgba(0,0,0,0.8);
		  text-shadow: none;
		}
	}

	.woocommerce div.product .out-of-stock,
	.woocommerce div.product p.out-of-stock {
		color: #D0D0D0;
    font-size: 1.5rem;

	}

</style>

<div class="product_layout_classic ev-single-product-container">

  <?php

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
  ?>

  <!-- <div class="slider-ev-home-header-box-shadow"></div> -->
  <div class="slider-ev-home">
    <div class="slider-ev-siema">

      <div class="slider-ev-siema-slide-background" style="background-image: url('<?php if( $categoryImage != '' ) { echo $categoryImage; } else { echo get_stylesheet_directory_uri() . '/images/products/products-background.jpg'; } ?>');">
          <img src="<?php echo get_stylesheet_directory_uri() . '/images/products/slider-image.png'; ?>" alt="espace-vin-slider-image" />
          <div class="slider-ev-siema-slide-content">
            <div class="slider-ev-siema-slide-content-center">
            </div>
          </div>
      </div>
    </div>
    <div class="ev-breadcrumb"><?php do_action('woocommerce_before_main_content_breadcrumb'); ?></div>
  </div>

  <script type="text/javascript">

    const siemaSlider = new Siema({
      selector: '.slider-ev-siema',
      duration: 200,
      easing: 'ease-out',
      perPage: 1,
      startIndex: 0,
      draggable: false,
      multipleDrag: false,
      loop: false,
      onInit: function(){},
      onChange: function(){}
    });

  </script>

	<?php if ( !post_password_required() ) : ?>
    <div itemscope itemtype="http://schema.org/Product" class="ev-single-product">
  		<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
  			<div class="row">
  		        <div class="">
  					<div class="product_content_wrapper">

  						<?php do_action( 'woocommerce_before_single_product' ); ?>

  						<div class="row">

                <div class="ev-single-product-content">
                  <div class="ev-single-product-image">
                      <div class="product_thumbnail <?php echo $class; ?>">
              					<?php
              						if ( has_post_thumbnail( get_the_ID() ) ) {
              							echo get_the_post_thumbnail( get_the_ID(), 'large', array( 'itemprop' => 'image' ));
              						} else {
              							?>
              								<img  itemprop="image" width="104" height="300" src="<?php echo get_stylesheet_directory_uri() . '/images/products/default-bottle.svg'; ?>" class="attachment-medium size-medium wp-post-image"  alt="default-bottle-image" srcset="<?php echo get_stylesheet_directory_uri() . '/images/products/default-bottle.svg'; ?>" sizes="(max-width: 104px) 100vw, 104px" style="opacity: 1;" />
              							<?php
              						}
              					?>
              			</div><!--.product_thumbnail-->
                  </div>
                  <div class="ev-single-product-text">
										<div class="ev-single-product-text-header">
											<div>
												<div class="ev-single-product-title-domaine">
		                      <div class="ev-single-product-title">
		                        <h1 itemprop="name"><?php the_title(); ?></h1>
		                      </div>
													<!-- <div class="ev-single-product-categories">
			                      <?php do_action( 'woocommerce_single_product_summary_single_meta' ); ?>
			                    </div> -->
			                    <?php
			                      $millesime = types_render_field('product-millesime');
			                			if ($millesime != '') {
			              		  ?>
			                      <div class="ev-single-product-millesime">
			                          <p><?php echo _x( 'Vintage', 'wine', 'wine-space-shopkeeper'); ?> :</p><?php echo $millesime; ?>
			                      </div>
			                    <?php
			                      }
			                    ?>
			                    <div class="ev-single-product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			                      <p><?php echo _e( 'Price', 'wine-space-shopkeeper'); ?> :
															<?php
																if($product->get_sale_price() > 0 ){
															?>
																	<span class="regular-price"><?php echo number_format($product->get_regular_price(), 2); ?> €</span>
															<?php
																}
															?>
															<span itemprop="price" content="<?php echo number_format($product->get_price(), 2); ?>" class="product-price"><?php echo number_format($product->get_price(), 2); ?></span> <span itemprop="priceCurrency" content="EUR" class="product-price">€</span></p>
													</div>
													
													<!-- NUMBER OF INTERESTED PERSON AND DOWNLOAD LIST TO CSV FILE -->
													<?php
														$user = wp_get_current_user();
														$allowed_roles = array('editor', 'administrator', 'author');
														if (array_intersect($allowed_roles, $user->roles ) && !$product->is_in_stock()) {
															$product_subscriber = get_post_meta($post->ID, '_product_subscriber', true);
															if (!empty($product_subscriber)) {
																$no_of_subscriber = count($product_subscriber);
																?>
																<style type="text/css">
																	.ev-number-of-interested-person p {
																		display: inline-block;
																		margin-right: 1rem;
																		font-size: 1.5rem;
																		font-weight: 800;
																		color: #000000;
																		font-family: 'OpenSans';
																		display: inline-flex;
																		align-items: center;
																		vertical-align: middle;
																		align-content: center;
																	}
																	.ev-number-of-interested-person p span {
																		margin-right: 0.5rem;
																		color: #A50611;
																	}
																	.ev-number-of-interested-person p svg {
																		width: 2rem;
																		height: auto;
																		margin-left: 0.5rem;
																		cursor: pointer;
																	}
																</style>
																<div class="ev-number-of-interested-person">
																	<p onclick="downloadCsvFile()" class="ev-form-field ev-stock_field ev-number-of-interested-person-text">
																		<?php echo sprintf( __( '<span>%s</span> persons are interested', 'wine-space-shopkeeper'), $no_of_subscriber); ?>
																		<svg class="svg-icon" viewBox="0 0 20 20">
																			<path fill="#A50611" d="M17.222,5.041l-4.443-4.414c-0.152-0.151-0.356-0.235-0.571-0.235h-8.86c-0.444,0-0.807,0.361-0.807,0.808v17.602c0,0.448,0.363,0.808,0.807,0.808h13.303c0.448,0,0.808-0.36,0.808-0.808V5.615C17.459,5.399,17.373,5.192,17.222,5.041zM15.843,17.993H4.157V2.007h7.72l3.966,3.942V17.993z"></path>
																			<path fill="#A50611" d="M5.112,7.3c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808c0-0.447-0.363-0.808-0.808-0.808H5.92C5.475,6.492,5.112,6.853,5.112,7.3z"></path>
																			<path fill="#A50611" d="M5.92,5.331h4.342c0.445,0,0.808-0.361,0.808-0.808c0-0.446-0.363-0.808-0.808-0.808H5.92c-0.444,0-0.808,0.361-0.808,0.808C5.112,4.97,5.475,5.331,5.92,5.331z"></path>
																			<path fill="#A50611" d="M13.997,9.218H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,9.58,14.442,9.218,13.997,9.218z"></path>
																			<path fill="#A50611" d="M13.997,11.944H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,12.306,14.442,11.944,13.997,11.944z"></path>
																			<path fill="#A50611" d="M13.997,14.67H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.447,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,15.032,14.442,14.67,13.997,14.67z"></path>
																		</svg>
																	</p>
																<div>
																<script type="text/javascript">
																	function downloadCsvFile() {
																		var rows = [];
																		<?php 
																			foreach($product_subscriber as $subscriber){?>
																				rows.push('<?php echo $subscriber; ?>');
																				<?php
																			}
																		?>

																		let csvContent = rows.join("\n");

																		var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
																		if (navigator.msSaveBlob) { // IE 10+
																			navigator.msSaveBlob(blob, filename);
																		} else {
																			var link = document.createElement("a");
																			if (link.download !== undefined) { // feature detection
																				// Browsers that support HTML5 download attribute
																				var url = URL.createObjectURL(blob);
																				link.setAttribute("href", url);
																				link.setAttribute("download", 'interested-people-product-<?php echo get_the_ID(); ?>');
																				link.style.visibility = 'hidden';
																				document.body.appendChild(link);
																				link.click();
																				document.body.removeChild(link);
																			}
																		}
																	}
																</script>
																<?php
															}
														}
													?>
													
													<?php if ($product->stock && $product->is_in_stock()) { ?>
														<div class="ev-single-product-stock-remaining">
															<?php $stockNumber = number_format($product->stock, 0, '', ''); ?>
															<?php
																if ($stockNumber > 12) {
																	echo '<p>'. __('Bottles in stock', 'wine-space-shopkeeper') . '</p>';
																} else {
																	echo sprintf(__('<p>Only <strong>%s</strong> bottles left</p>', 'wine-space-shopkeeper'), $stockNumber);
																}
															?>
														</div>
													<?php } ?>
			                    <div class="ev-single-product-add-to-cart">
			                      <!-- <?php if ( (isset($shopkeeper_theme_options['catalog_mode'])) && ($shopkeeper_theme_options['catalog_mode'] == 0) ) : ?>
			                          <?php if ( !$product->is_in_stock() && !empty($shopkeeper_theme_options['out_of_stock_label']) ) : ?>
			                                  <div class="out_of_stock_wrapper">
			                                      <div class="out_of_stock_badge_single <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php _e( $shopkeeper_theme_options['out_of_stock_label'], 'woocommerce' ); ?>

			                                      </div>
			                                  </div>
			                          <?php endif; ?>
			                      <?php endif; ?> -->

			                       <?php
			                         do_action( 'woocommerce_single_product_summary_single_add_to_cart' );
			                         do_action( 'woocommerce_single_product_summary' );
			                       ?>
			                    </div>
		                    </div>
											</div>
											<div>
												<div class="ev-single-product-title-domaine">
		                      <div class="ev-single-product-domaine">
		                        <?php
		              						$parent_id = wpcf_pr_post_get_belongs(get_the_ID(), 'domaine');
		              						if (!empty($parent_id)) {
		              							$parentTitle = get_the_title($parent_id);
		              							$parentURL = get_post_permalink( $parent_id );
		              						}
		              					?>
		                        <?php if($parentTitle != '') { ?>
		                          <?php if($parentURL != '') { ?>
		                            <p><a href="<?php if($categoryID != '') { echo esc_url( add_query_arg( 'cat', $categoryID, $parentURL) ); } else { echo $parentURL; } ?>"><?php echo _e('Domain', 'wine-space-shopkeeper'); ?> : <?php echo $parentTitle ?><i class="ev-arrow-right"></i></a></p>
		                          <?php } ?>
		                        <?php } ?>
		                      </div>
													<?php
														$medailles = get_field('medailles');
														if( $medailles ):
													?>
															<div class="ev-product-medailles">
																<?php foreach( $medailles as $medaille ): ?>
																	<?php if( $medaille === 'prix-propiete' ) { ?> <img src="<?php echo get_stylesheet_directory_uri() . '/images/products/medaille-pp.png'; ?>" /> <?php } ?>
																	<?php if( $medaille === 'bio' ) { ?> <img src="<?php echo get_stylesheet_directory_uri() . '/images/products/medaille-bio.png'; ?>" /> <?php } ?>
																	<?php if( $medaille === 'terra-vitis' ) { ?> <img src="<?php echo get_stylesheet_directory_uri() . '/images/products/medaille-tv.png'; ?>" /> <?php } ?>
																	<?php if( $medaille === 'agriculture-raisonnee' ) { ?> <img src="<?php echo get_stylesheet_directory_uri() . '/images/products/medaille-ag.png'; ?>" /> <?php } ?>
																	<?php if( $medaille === 'biodynamie' ) { ?> <img src="<?php echo get_stylesheet_directory_uri() . '/images/products/medaille-bd.png'; ?>" /> <?php } ?>
																<?php endforeach; ?>
															</div>
													<?php
														endif;
													?>
		                    </div>
											</div>
										</div>

                    <?php
                      $wineWaiter = get_field('wine-waiter');
                      $reviewTitle = get_field('review-title');
                      $reviewText = get_field('review-text');

                      if($reviewTitle && $reviewText) {
                    ?>
                          <div class="ev-single-product-wine-waiter-review">
                            <?php
                              if($wineWaiter) {
                            ?>
                                <div class="wine-waiter-picture">
                                  <img src="<?php echo $wineWaiter; ?>"/>
                                </div>
                            <?php
                              }
                            ?>
                            <div class="wine-waiter-review">
                              <p><?php echo $reviewTitle; ?></p>
                              <p><?php echo $reviewText; ?></p>
                            </div>
                          </div>
                    <?php
                      }
                    ?>

                    <div class="ev-single-product-informations">
                        <?php
                          $productAppellation = types_render_field('product-appellation');
                          $productElevage = types_render_field('product-elevage');
                          $productCepages = types_render_field('product-cepages');
                          $productVinification = types_render_field('product-vinification');
                          $productService = types_render_field('product-service');
                          $productGarde = types_render_field('product-garde');
                          $productContenance = types_render_field('product-contenance');
                          $productCommentairesDegustations = types_render_field('product-commentaires-degustations');
                        ?>
                        <div class="ev-product-info-block">
                          <?php if ($productAppellation != '') { ?><div class="ev-product-info-element"><p><?php echo _x('Appellation', 'wine', 'wine-space-shopkeeper'); ?> :</p><?php echo $productAppellation; ?></div><?php } ?>
                          <?php if ($productElevage != '') { ?><div class="ev-product-info-element"><p><?php echo _x('Maturation', 'wine', 'wine-space-shopkeeper'); ?> :</p><?php echo $productElevage; ?></div><?php } ?>
                          <?php if ($productCepages != '') { ?><div class="ev-product-info-element"><p><?php echo _x('Grape varieties', 'wine', 'wine-space-shopkeeper'); ?> :</p><?php echo $productCepages; ?></div><?php } ?>
                        </div>
                        <div class="ev-product-info-block">
                          <?php if ($productVinification != '') { ?><div class="ev-product-info-element"><p><?php echo _x('Winemaking', 'wine', 'wine-space-shopkeeper'); ?> :</p><?php echo $productVinification; ?></div><?php } ?>
                          <?php if ($productService != '') { ?><div class="ev-product-info-element"><p><?php echo _x('Serving', 'wine', 'wine-space-shopkeeper'); ?> :</p><?php echo $productService; ?></div><?php } ?>
                          <?php if ($productGarde != '') { ?><div class="ev-product-info-element"><p><?php echo _x('Aging', 'wine', 'wine-space-shopkeeper'); ?> :</p><?php echo $productGarde; ?></div><?php } ?>
                          <?php if ($productContenance != '') { ?><div class="ev-product-info-element"><p><?php echo _x('Capacity', 'wine', 'wine-space-shopkeeper'); ?> :</p><?php echo $productContenance; ?></div><?php } ?>
                        </div>
                    </div>
                  </div>
                </div>
  						</div><!-- .row -->

  					</div><!--.product_content_wrapper-->

  			   </div><!--large-9-->
  		    </div><!-- .row -->

  		    <meta itemprop="url" content="<?php the_permalink(); ?>" />

  		</div><!-- #product-<?php the_ID(); ?> -->

    </div>

    <div class="ev-single-product-content-article">
      <?php the_content(); ?>
    </div>

		<div class="single_product_summary_related">
		    <div class="row-ev">
				<div>
					<?php do_action( 'woocommerce_after_single_product_summary_related_products' ); ?>
				</div><!--.large-9-->
		    </div><!-- .row -->
		</div><!-- .single_product_summary_related -->


	<?php else: ?>

		<div class="row">
		    <div class="large-9 large-centered columns">
		    <br/><br/><br/><br/>
				<?php echo get_the_password_form(); ?>
			</div>
		</div>

	<?php endif; ?>


	<script type="text/javascript">

		document.addEventListener('DOMContentLoaded', function () {
			var buttonAddToCard = document.querySelector('.ev-single-product-add-to-cart form.cart button.single_add_to_cart_button');
			var img = document.createElement('img');
			img.src = '<?php echo get_stylesheet_directory_uri() . '/images/cart/cart.svg'; ?>';

			buttonAddToCard.prepend(img);
		}, false);

	</script>

</div>
