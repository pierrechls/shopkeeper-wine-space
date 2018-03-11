<?php
/**
 * The template for displaying all single posts.
 *
 * @package winespace
 */

get_header(); ?>

<style type="text/css">

  #primary {
    padding: 0;
	}

	.ev-single-domaine-container {
		padding: 2rem;
	}

	.domaine-products-list ul {
		list-style: none;
	}

	#primary .row {
    padding: 0 !important;
	}

</style>

<div id="primary" class="content-area">

    <div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="slider-ev-home-header-box-shadow"></div>
			<div class="slider-ev-home">
				<div class="slider-ev-siema">

					<?php
						$queryCat = get_query_var( 'cat', 0 );
						$categoryImage = '';

						if($queryCat != 0){
							$thumbnail_id = get_woocommerce_term_meta( $queryCat, 'thumbnail_id', true );
							$categoryImage = wp_get_attachment_url( $thumbnail_id );
						}
					?>

					<div class="slider-ev-siema-slide-background" style="background-image: url('<?php if( $categoryImage != '' ) { echo $categoryImage; } else { echo get_stylesheet_directory_uri() . '/images/products/products-background.png'; } ?>');">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/products/slider-image.png'; ?>" alt="espace-vin-slider-image" />
							<div class="slider-ev-siema-slide-content">
								<div class="slider-ev-siema-slide-content-center">
									<h1 class="title-content-page-slider"><?php the_title(); ?></h1>
									<div class="description-content-page-slider">Domaine</div>
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

			<div class="ev-single-domaine-container">

					<div class="domaine"><?php the_content() ?></div>

					<div id="domaine-products">
							<?php

								$products = types_child_posts('product');
							?>

							<?php

							if( count($products > 0 )): ?>
									<div class="domaine-products-list row">
											<?php do_action( 'woocommerce_before_shop_loop' ); ?>
											<div class="large-12 columns">
													<?php $animateCounter = 0; ?>
													<?php woocommerce_product_loop_start(); ?>
													<?php foreach($products as $product) { // variable must be called $post (IMPORTANT) ?>
															<?php
																global $post;
																$post = $product;
																setup_postdata($post);
															?>
															<?php $animateCounter++; ?>
															<?php wc_get_template_part( 'content', 'product' ); ?>
													<?php } ?>
													<?php woocommerce_product_loop_end(); ?>
											</div><!-- .columns -->
									</div>
									<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
									<div class="woocommerce-after-shop-loop-wrapper">
										<?php do_action( 'woocommerce_after_shop_loop' ); ?>
									</div>
							<?php endif; ?>
					</div>
			</div>

    <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->

</div><!-- #primary -->

<?php get_footer(); ?>
