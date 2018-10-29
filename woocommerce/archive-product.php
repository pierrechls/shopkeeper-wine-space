<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

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

		<style type="text/css">

				#page_wrapper, .content-area {
					padding: 0;
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

				.ev-flash-message-actived #page_wrapper.sticky_header .content-area, #page_wrapper.transparent_header .content-area {
				    margin-top: 4rem;
				}

				#page_wrapper.sticky_header .content-area, #page_wrapper.transparent_header .content-area {
					margin: 0;
				}

				#primary > .row, .tob_bar_shop > .row {
					padding: 1rem 2rem;
				}

				.row #button_offcanvas_sidebar_left .filters-text {
					font-size: 1.2rem;
				}

				.woocommerce .woocommerce-result-count,
				.woocommerce-page .woocommerce-result-count,
				p.woocommerce-result-count,
				.select2-container .select2-choice > .select2-chosen {
					font-size: 1.2rem;
				}

				.select2-result.select2-highlighted {
					background: #BAA571;
				}

				.tob_bar_shop {
					margin-top: 2rem;
				}

		</style>

   	<div id="primary" class="content-area shop-page<?php echo $shop_has_sidebar ? ' shop-has-sidebar':'';?>">

			<!-- <div class="slider-ev-home-header-box-shadow"></div> -->
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
									<h1 class="title-content-page-slider"><?php woocommerce_page_title(); ?></h1>
									<div class="description-content-page-slider"><?php echo $term->description; ?></div>
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

        <div class="tob_bar_shop">
            <div class="row">
                <div class="small-12 medium-12 large-6 xlarge-6 columns text-left">
                    <?php if (is_active_sidebar( 'catalog-widget-area')) : ?>
                        <div id="button_offcanvas_sidebar_left"  data-toggle="offCanvasLeft1">
                        <span class="filters-text">
                            <i class="spk-icon spk-icon-menu-filters"></i>
                            <?php echo esc_html_e('Filter', 'woocommerce'); ?>
                        </span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="small-12 medium-12 large-6 xlarge-6 columns text-right">
                    <div class="catalog-ordering">
                        <?php if ( have_posts() ) : ?>
                            <?php do_action( 'woocommerce_before_shop_loop_catalog_ordering' ); ?>
                            <?php do_action( 'woocommerce_before_shop_loop_result_count' ); ?>
                        <?php endif; ?>
                    </div> <!--catalog-ordering-->
                </div>
            </div>
        </div><!-- .top_bar_shop-->

        <div class="row">
			<div class="large-12 columns">

			   <div class="before_main_content">
				   <?php do_action( 'woocommerce_before_main_content'); ?>
			   </div>

                <div id="content" class="site-content" role="main">
                    <div class="row">

					 <div class="large-12 columns">
					    <div class="catalog_top">
                           <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                        </div>
					</div>

				  <?php if ( $shop_has_sidebar ) : ?>

					   <div class="xlarge-2 large-3 columns show-for-large">
						   <div class="shop_sidebar wpb_widgetised_column">
							   <?php do_action('woocommerce_sidebar'); ?>
						   </div>
					   </div>

					   <div class="xlarge-10 large-9 columns">

				   <?php else : ?>

					   <div class="large-12 columns">

				   <?php endif; ?>

						<?php

						$show_categories = FALSE;

						if ( is_shop() && (get_option('woocommerce_shop_page_display') == '') ) $show_categories = FALSE;
						if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'products') ) $show_categories = FALSE;
						if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_categories = TRUE;
						if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_categories = false;

						if ( is_product_category() && (get_option('woocommerce_category_archive_display') == '') ) $show_categories = FALSE;
						if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'products') ) $show_categories = FALSE;
						if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_categories = TRUE;
						if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_categories = false;

                        if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') ) $show_categories = FALSE;
                        if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_categories = TRUE;
                        if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $show_categories = FALSE;


						if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_categories = FALSE;

						//echo "Shop Page Display: " . get_option('woocommerce_shop_page_display') . "<br />";
						//echo "Default Category Display: " . get_option('woocommerce_category_archive_display') . "<br />";
						//echo "Display type (edit product category): " . get_woocommerce_term_meta($term->term_id, 'display_type', true) . "<br />";

						?>

						<?php if (!is_paged()) : //show categories only on first page ?>

                        <?php if ($show_categories == TRUE) : ?>

                            <?php if ($categories) : ?>

                                <div class="row">
                                    <div class="categories_grid">

                                        <?php $cat_counter = 0; ?>

                                        <?php $cat_number = count($categories); ?>

                                        <?php foreach($categories as $category) : ?>

                                            <?php
                                                $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                                                $image = wp_get_attachment_url( $thumbnail_id );
                                                $cat_class = "";
                                            ?>

                                            <?php

                                                if (is_shop() && get_option('woocommerce_shop_page_display') == 'both') $cat_class = "original_grid";
                                                if (is_product_category() && get_option('woocommerce_category_archive_display') == 'both') $cat_class = "original_grid";

                                                if (is_product_category() && get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') $cat_class = "";
                                                if (is_product_category() && get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories') $cat_class = "";
                                                if (is_product_category() && get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') $cat_class = "original_grid";

                                            ?>

                                            <?php
                                                if($cat_class != "original_grid")
                                                {
                                                    $cat_counter++;

                                                    switch ($cat_number) {
                                                        case 1:
                                                            $cat_class = "one_cat_" . $cat_counter;
                                                            break;
                                                        case 2:
                                                            $cat_class = "two_cat_" . $cat_counter;
                                                            break;
                                                        case 3:
                                                            $cat_class = "three_cat_" . $cat_counter;
                                                            break;
                                                        case 4:
                                                            $cat_class = "four_cat_" . $cat_counter;
                                                            break;
                                                        case 5:
                                                            $cat_class = "five_cat_" . $cat_counter;
                                                            break;
                                                        default:
                                                            if ($cat_counter < 7) {
                                                                $cat_class = $cat_counter;
                                                            } else {
                                                                $cat_class = "more_than_6";
                                                            }
                                                    }

                                                }
                                            ?>

                                            <div class="category_<?php echo $cat_class; ?>">
                                                <div class="category_grid_box">
                                                    <span class="category_item_bkg" style="background-image:url(<?php echo esc_url($image); ?>)"></span>
                                                    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item">
                                                        <span class="category_name"><?php echo esc_html($category->name); ?></span>
                                                    </a>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>

                                        <div class="clearfix"></div>

                                    </div>
                                </div>

                                <?php endif; ?>

                            <?php endif; ?>

                        <?php endif; ?>

                        <?php

                        $show_products = TRUE;

                        if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_products = FALSE;

                        if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_products = FALSE;

                        if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_products = TRUE;

                        if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_products = FALSE;

						if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_products = TRUE;

                        ?>

                        <?php if ($show_products == TRUE) : ?>

							<?php if ( have_posts() ) : ?>

                                <?php do_action( 'woocommerce_before_shop_loop' ); ?>

                                <div class="row">
                                    <div class="large-12 columns">
                                        <?php $animateCounter = 0; ?>
                                        <?php woocommerce_product_loop_start(); ?>
                                            <?php while ( have_posts() ) : the_post(); ?>
                                                <?php $animateCounter++; ?>
                                                <?php wc_get_template_part( 'content', 'product' ); ?>
                                            <?php endwhile; // end of the loop. ?>
                                        <?php woocommerce_product_loop_end(); ?>

                                    </div><!-- .columns -->
                                </div>

								<div class="woocommerce-after-shop-loop-wrapper">
									<?php do_action( 'woocommerce_after_shop_loop' ); ?>
								</div>

                            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

								<?php wc_get_template( 'loop/no-products-found.php' ); ?>

                            <?php endif; ?>

                        <?php endif; ?>

						<?php do_action('woocommerce_after_main_content'); ?>

						</div><!--.large-12-->
					</div><!-- .row-->
				</div><!-- #content -->

			</div><!-- .large-12 -->
        </div><!-- .row -->

    </div><!-- #primary -->

<?php get_footer('shop'); ?>
