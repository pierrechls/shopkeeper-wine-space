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

	<div id="primary" class="content-area">

        <div id="content" class="site-content" role="main">

       		<header class="entry-header <?php if ($page_header_src != "") : ?>with_featured_img<?php endif; ?>" <?php if ($page_header_src != "") : ?>style="background-image:url(<?php echo esc_url($page_header_src); ?>)"<?php endif; ?>>

                <div class="page_header_overlay"></div>

                <div class="row">
                    <div class="large-10 large-centered columns without-sidebar">

                        <?php if ( (isset($page_title_option)) && ($page_title_option == "on") ) : ?>
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        <?php endif; ?>

                        <?php if($post->post_excerpt) : ?>
                                <div class="page-description"><?php the_excerpt(); ?></div>
                        <?php endif; ?>

                    </div>
                </div>


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
