<?php

	if (is_front_page()) {
		include 'page-home-template.php';
	} else {

				$isWooCommercePage = false;

        if (function_exists ( 'is_woocommerce' ) && is_woocommerce()) {
            $isWooCommercePage = true;
        }

        $woocommerce_keys = array ('woocommerce_shop_page_id',
                                   'woocommerce_terms_page_id',
                                   'woocommerce_cart_page_id',
                                   'woocommerce_checkout_page_id',
                                   'woocommerce_pay_page_id',
                                   'woocommerce_thanks_page_id',
                                   'woocommerce_myaccount_page_id',
                                   'woocommerce_edit_address_page_id',
                                   'woocommerce_view_order_page_id',
                                   'woocommerce_change_password_page_id',
                                   'woocommerce_logout_page_id',
                                   'woocommerce_lost_password_page_id');

        foreach ($woocommerce_keys as $wc_page_id) {
            if (get_the_ID () == get_option ($wc_page_id, 0)) {
                $isWooCommercePage = true ;
            }
        }

?>


<?php

	global $shopkeeper_theme_options;

	$page_id = "";
	if ( is_single() || is_page() ) {
		$page_id = get_the_ID();
	} else if ( is_home() ) {
		$page_id = get_option('page_for_posts');
	}

    $page_header_src = "";

    if (has_post_thumbnail()) $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) );

    $page_title_option = "on";

	if (get_post_meta( $page_id, 'page_title_meta_box_check', true )) {
		$page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
	}

?>

<?php get_header(); ?>

	<style type="text/css">

			#page_wrapper, .content-area {
				padding: 0;
				margin: 0;
			}

			#page_wrapper.sticky_header .content-area, #page_wrapper.transparent_header .content-area {
				margin: 0;
			}

	</style>

	<div id="primary" class="content-area">

        <div id="content" class="site-content" role="main">

						<div class="slider-ev-home-header-box-shadow"></div>
						<div class="slider-ev-home">
							<div class="slider-ev-siema">

								<?php
									$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
									$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
									$categoryImage = wp_get_attachment_url( $thumbnail_id );
								?>

								<div class="slider-ev-siema-slide-background" style="background-image: url('<?php if( $categoryImage != '' ) { echo $categoryImage; } else { echo get_stylesheet_directory_uri() . '/images/products/products-background.png'; } ?>');">
										<img src="<?php echo get_stylesheet_directory_uri() . '/images/products/slider-image.png'; ?>" alt="espace-vin-slider-image" />
										<div class="slider-ev-siema-slide-content">
											<div class="slider-ev-siema-slide-content-center">
												<h1 class="title-content-page-slider"><?php the_title(); ?></h1>
												<!--<div class="description-content-page-slider"> HERE THE PAGE DESCRIPTION </div>-->
											</div>
										</div>
								</div>

							</div>
						</div>

						<script type="text/javascript">

							const siemaWithDots = new Siema({
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

       		<header style="margin-top: 5rem;">


            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

                <?php   if (function_exists('is_cart') && is_cart()) : ?>
                <?php else: ?>
                <div class="clearfix"></div>
                <footer class="entry-meta">
                    <?php // edit_post_link( __( 'Edit', 'shopkeeper' ), '<div class="edit-link"><i class="fa fa-pencil"></i> ', '</div>' );  ?>
                </footer><!-- .entry-meta -->
                <?php endif; ?>

                <?php

                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() ) comments_template();

                ?>

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->

    </div><!-- #primary -->

<?php get_footer(); ?>

<?php

	}

?>
