<?php
/*
Template Name: EV Custom Woocomerce Pages
Template Post Type: page

@author 		WooThemes
* @package 	WooCommerce/Templates
* @version     2.0.0
*/

	global $shopkeeper_theme_options;

	//woocommerce_before_main_content
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

	add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20 );

	//woocommerce_before_shop_loop
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

	add_action( 'woocommerce_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
	add_action( 'woocommerce_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

?>

<?php get_header(); ?>

	<div id="primary" class="content-area shop-page<?php echo $shop_has_sidebar ? ' shop-has-sidebar':'';?>">

        <div id="content" class="site-content" role="main">
						<style type="text/css">

						/***********************/
						/* CONTENT LINKS STYLE */
						/***********************/

						.ev-flash-message-actived #page_wrapper.sticky_header .content-area, #page_wrapper.transparent_header .content-area {
						    margin-top: 4rem;
						}

						#st-container #page_wrapper #primary.content-area #content p a,
						#st-container #page_wrapper #primary.content-area #content p a:link,
						#st-container #page_wrapper #primary.content-area #content p a:visited,
						#st-container #page_wrapper #primary.content-area #content p a:hover,
						#st-container #page_wrapper #primary.content-area #content p a:active {
							color: #BAA571;
							text-decoration: underline;
						}

								#page_wrapper, .content-area {
									padding: 0;
									margin: 0;
								}

								.slider-ev-home, .slider-ev-siema {
							    margin-bottom: 3rem;
								}

								#page_wrapper.sticky_header .content-area, #page_wrapper.transparent_header .content-area {
									margin: 0;
								}

								@media only screen and (max-width: 40.063em) {
									#page_wrapper {
											padding-top: 50px;
									}
								}

								@media only screen and (max-width: 63.9375em) and (min-width: 40.063em) {
									#page_wrapper {
									    padding-top: 63px;
									}
								}

								@media screen and (max-width: 500px) {
									.slider-ev-home,
									.slider-ev-siema,
									.slider-ev-home img {
								    height: 15rem;
									}

									.slider-ev-home h1.title-content-page-slider {
										font-size: 2rem;
    								padding: 0 2rem;
									}
								}

						</style>

						<!-- <div class="slider-ev-home-header-box-shadow"></div> -->
						<div class="slider-ev-home">
							<div class="slider-ev-siema">

								<?php
									$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
									$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
									$categoryImage = wp_get_attachment_image_src( $thumbnail_id, 'large')[0];
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
							<div class="ev-breadcrumb"><?php custom_breadcrumbs(); ?></div>
						</div>

						<script type="text/javascript">

							document.addEventListener('DOMContentLoaded', function(e) {
								changeRedirectFilters();
							});

							function changeRedirectFilters() {
							  var links = document.querySelectorAll('.off-canvas-wrapper .off-canvas.shop-has-sidebar a');
								console.log(links);
							  for (i = 0; i < links.length; i++) {
							    links[i].addEventListener('click', function(event) {
										console.log(event);
							      console.log(this);
							    });
							  }
							}

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

						<?php var_dump(have_posts()); ?>

						<div class="tob_bar_shop">
		            <div class="row">
		                <div class="number-of-product small-12 medium-12 large-6 xlarge-6 columns text-left" style="display:flex;align-items:center;">
											<div class="catalog-ordering">
													<?php if ( have_posts() ) : ?>
															<?php do_action( 'woocommerce_before_shop_loop_result_count' ); ?>
													<?php endif; ?>
											</div> <!--catalog-ordering-->
		                </div>
		                <div class="small-12 medium-12 large-6 xlarge-6 columns text-right" style="display: flex;align-items: center;align-content: center;justify-content: flex-end;flex-wrap: wrap;">
												<?php if (is_active_sidebar( 'catalog-widget-area')) : ?>
														<div id="button_offcanvas_sidebar_left"  data-toggle="offCanvasLeft1" style="z-index:0;">
														<span class="filters-text" style="border: 1px solid #000;padding: 0.6rem 1rem 0.4rem 1.2rem;border-radius: 6px;">
																<i class="spk-icon spk-icon-menu-filters"></i>
																<?php echo esc_html_e('Filter'); ?>
														</span>
														</div>
												<?php endif; ?>
		                    <div class="catalog-ordering">
		                        <?php if ( have_posts() ) : ?>
		                            <?php do_action( 'woocommerce_before_shop_loop_catalog_ordering' ); ?>
		                        <?php endif; ?>
		                    </div> <!--catalog-ordering-->
		                </div>
		            </div>
		        </div><!-- .top_bar_shop-->


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
