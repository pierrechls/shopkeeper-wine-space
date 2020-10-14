					<?php global $page_id, $woocommerce, $shopkeeper_theme_options; ?>

                    <?php

                    $page_footer_option = "on";

					if (get_post_meta( $page_id, 'footer_meta_box_check', true )) {
						$page_footer_option = get_post_meta( $page_id, 'footer_meta_box_check', true );
					}

					if (class_exists('WooCommerce')) {
						if (is_shop() && get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'footer_meta_box_check', true )) {
							$page_footer_option = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'footer_meta_box_check', true );
						}
					}

					?>

					<?php if ( $page_footer_option == "on" ) : ?>

                    <footer id="site-footer" class="ev" role="contentinfo">
											<div class="ev-footer">
													<div class="ev-footer-values">
													  <div class="ev-footer-values-value">
															<img src="<?php echo get_stylesheet_directory_uri() . '/images/footer/price.svg' ?>"/>
															<p><?php _e('Direct producer prices', 'wine-space-shopkeeper');?></p>
														</div>
													  <div class="ev-footer-values-value">
															<img src="<?php echo get_stylesheet_directory_uri() . '/images/footer/advice.svg' ?>"/>
															<p><?php _e('Selection of wines and advice', 'wine-space-shopkeeper');?></p>
														</div>
														<div class="ev-footer-values-value">
															<img src="<?php echo get_stylesheet_directory_uri() . '/images/footer/delivery.svg' ?>"/>
															<p><?php _e('Fast delivery and protected bottles', 'wine-space-shopkeeper');?></p>
														</div>
														<div class="ev-footer-values-value">
															<img src="<?php echo get_stylesheet_directory_uri() . '/images/footer/payment.svg' ?>"/>
															<p><?php _e('Secure payments', 'wine-space-shopkeeper');?></p>
														</div>
													</div>
													<div class="ev-footer-cave-informations">
													  <div class="ev-footer-cave-informations-infos" itemscope itemtype="http://schema.org/LocalBusiness">
															<h6><?php _e('Discover our cellar', 'wine-space-shopkeeper');?> <span><?php echo _x('in', 'ev-in-city', 'wine-space-shopkeeper');?> <span itemprop="name"><?php _e('Saint Chinian (South of France)', 'wine-space-shopkeeper');?></span></span></h6>
															<img style="display:none;" itemprop="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/header/logo.png" alt="Logo <?php echo str_replace(' ', '-', strtolower(bloginfo('name'))); ?>" /></a>
															<div class="cave-info" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
																<p><?php _e('Address', 'wine-space-shopkeeper');?> :</p>
																<p class="address">
																	<span itemprop="streetAddress"><?php echo _x('8 Avenue de Béziers', 'location', 'wine-space-shopkeeper');?></span><br>
																	<span itemprop="postalCode"><?php echo _x('34600', 'location', 'wine-space-shopkeeper');?></span>, <span itemprop="addressLocality"><?php echo _x('Saint-Chinian, France', 'location', 'wine-space-shopkeeper');?></span></span>
																</address>
																<p><a class="address-link"target="_blank" href="https://www.google.com/maps/dir//ESPACE+VIN+DE+SAINT+CHINIAN,+8+Avenue+de+B%C3%A9ziers,+34600+Saint-Chinian,+France/@43.420462,2.9459483,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x12b1a2c59320f399:0xd606b10b6439f9d0!2m2!1d2.948137!2d43.420462?hl=fr-FR"><?php _e('Phone', 'wine-space-shopkeeper');?></a></p>
															</div>
															<div class="cave-info">
																<p><?php _e('Opening time', 'wine-space-shopkeeper');?> :</p>
																<p><?php _e('Monday to Sunday 9 a.m. to 12:15 p.m. and 2 p.m. to 7 p.m.', 'wine-space-shopkeeper');?></p>
															</div>
															<div class="cave-info">
																<p><?php _e('Phone', 'wine-space-shopkeeper');?> :</p>
																<p><span itemprop="telephone"><a href="tel:+33467382318">04 67 38 23 18</a></span></p>
															</div>
														</div>
														<div class="ev-footer-cave-informations-image">
															<img src="<?php echo get_stylesheet_directory_uri() . '/images/footer/shop-photo.png' ?>"/>
														</div>
													</div>
													<div class="ev-footer-legal-informations">
														<div class="ev-footer-legal-info-image">
															<img src="<?php echo get_stylesheet_directory_uri() . '/images/footer/marianne-logo.png' ?>"/>
														</div>
														<div class="ev-footer-legal-info-text">
															<p><?php _e('Ban on the sale of alcoholic beverages to minors under 18 years of age.', 'wine-space-shopkeeper');?></p>
															<p><?php _e('Proof of the majority of the buyer is required at the time of online sale. Alcohol abuse is dangerous for health. To consume with moderation.', 'wine-space-shopkeeper'); ?></p>
														</div>
													</div>
											</div>

                    	 <?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>

							<div class="trigger-footer-widget-area">
								<span class="trigger-footer-widget spk-icon-load-more"></span>
							</div>

							<div class="site-footer-widget-area">
								<div class="row">
									<?php dynamic_sidebar( 'footer-widget-area' ); ?>
								</div><!-- .row -->
							</div><!-- .site-footer-widget-area -->

						<?php endif; ?>

                    </footer>

                    <?php endif; ?>

                </div><!-- #page_wrapper -->

             </div><!--</st-content -->

        <?php if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() )) : ?>
        <div class="off-canvas-wrapper">
        	<div class="off-canvas <?php echo is_rtl() ? 'position-right' : 'position-left' ?> <?php echo ( is_active_sidebar( 'catalog-widget-area' ) && ( isset($shopkeeper_theme_options['sidebar_style']) && ( $shopkeeper_theme_options['sidebar_style'] == "0" ) ) ) ? 'hide-for-large':''; ?> <?php echo ( is_active_sidebar( 'catalog-widget-area' ) ) ? 'shop-has-sidebar':''; ?>" id="offCanvasLeft1" data-off-canvas>

        		<div class="menu-close hide-for-medium">
					<button class="close-button" aria-label="Close menu" type="button" data-close>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

	            <div class="nano">
	                <div class="content">
	                    <div class="offcanvas_content_left wpb_widgetised_column">
	                        <div id="filters-offcanvas">
	                            <?php if ( is_active_sidebar( 'catalog-widget-area' ) ) : ?>
	                                <?php dynamic_sidebar( 'catalog-widget-area' ); ?>
	                            <?php endif; ?>
	                        </div>
	                    </div>
	               </div>
	            </div>
	        </div>
        </div>
    	<?php endif; ?>

		<div class="off-canvas-wrapper">
			<div class="off-canvas <?php echo is_rtl() ? 'position-left' : 'position-right' ?> " id="offCanvasRight1" data-off-canvas>

				<div class="menu-close hide-for-medium">
					<button class="close-button" aria-label="Close menu" type="button" data-close>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

	           	<div class="nano">
	                <div class="content">
	                    <div class="offcanvas_content_right">

	                        <div id="mobiles-menu-offcanvas">

		                            <?php if ( (isset($shopkeeper_theme_options['main_header_layout'])) && ( $shopkeeper_theme_options['main_header_layout'] != "2" ) && ( $shopkeeper_theme_options['main_header_layout'] != "22" ) ) : ?>

		                            	<?php if( has_nav_menu("main-navigation") ) : ?>
			                                <nav class="mobile-navigation primary-navigation hide-for-large" role="navigation">
			                                <?php
			                                    wp_nav_menu(array(
			                                        'theme_location'  => 'main-navigation',
			                                        'fallback_cb'     => false,
			                                        'container'       => false,
			                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                    ));
			                                ?>
			                                </nav>
			                            <?php endif; ?>

		                            <?php endif; ?>

		                            <?php if ( (isset($shopkeeper_theme_options['main_header_layout'])) && ( $shopkeeper_theme_options['main_header_layout'] == "2" || $shopkeeper_theme_options['main_header_layout'] == "22" ) ) : ?>

		                                <?php if( has_nav_menu("centered_header_left_navigation") ) : ?>
			                                <nav class="mobile-navigation hide-for-large" role="navigation">
			                                <?php
			                                    wp_nav_menu(array(
			                                        'theme_location'  => 'centered_header_left_navigation',
			                                        'fallback_cb'     => false,
			                                        'container'       => false,
			                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                    ));
			                                ?>
			                                </nav>
			                            <?php endif; ?>

		                                <?php if( has_nav_menu("centered_header_right_navigation") ) : ?>
			                                <nav class="mobile-navigation hide-for-large" role="navigation">
			                                <?php
			                                    wp_nav_menu(array(
			                                        'theme_location'  => 'centered_header_right_navigation',
			                                        'fallback_cb'     => false,
			                                        'container'       => false,
			                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                    ));
			                                ?>
			                                </nav>
			                            <?php endif; ?>

		                            <?php endif; ?>

									<?php if ( (isset($shopkeeper_theme_options['main_header_off_canvas'])) && (trim($shopkeeper_theme_options['main_header_off_canvas']) == "1" ) ) : ?>
										<?php if( has_nav_menu("secondary_navigation") ) : ?>
			                                <nav class="mobile-navigation" role="navigation">
			                                <?php
			                                    wp_nav_menu(array(
			                                        'theme_location'  => 'secondary_navigation',
			                                        'fallback_cb'     => false,
			                                        'container'       => false,
			                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                    ));
			                                ?>
			                                </nav>
			                            <?php endif; ?>
		                            <?php endif; ?>

		                            <?php
									$theme_locations  = get_nav_menu_locations();
									if (isset($theme_locations['top-bar-navigation'])) {
										$menu_obj = get_term($theme_locations['top-bar-navigation'], 'nav_menu');
									}

									if ( (isset($menu_obj->count) && ($menu_obj->count > 0)) || (is_user_logged_in()) ) {
									?>

										<?php if ( (isset($shopkeeper_theme_options['top_bar_switch'])) && ($shopkeeper_theme_options['top_bar_switch'] == "1" ) ) : ?>
											<?php if( has_nav_menu("top-bar-navigation") ) : ?>
			                                    <nav class="mobile-navigation hide-for-large" role="navigation">
			                                    <?php
			                                        wp_nav_menu(array(
			                                            'theme_location'  => 'top-bar-navigation',
			                                            'fallback_cb'     => false,
			                                            'container'       => false,
			                                            'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                        ));
			                                    ?>

			                                    <?php if ( is_user_logged_in() ) { ?>
			                                        <ul><li><a href="<?php echo get_site_url(); ?>/?<?php echo get_option('woocommerce_logout_endpoint'); ?>=true" class="logout_link"><?php _e('Logout', 'woocommerce'); ?></a></li></ul>
			                                    <?php } ?>
			                                    </nav>
			                                <?php endif; ?>
		                                <?php endif; ?>

									<?php } ?>

	                        </div>
	                        <?php if ( is_active_sidebar( 'offcanvas-widget-area' ) ) : ?>
	                        	<div class="shop_sidebar wpb_widgetised_column">
	                            	<?php dynamic_sidebar( 'offcanvas-widget-area' ); ?>
	                            </div>
	                        <?php endif; ?>

						</div> <!-- offcanvas_content_right -->
					</div> <!-- content -->
				</div> <!-- nano -->
			</div> <!-- offcanvas -->
		</div> <!-- offcanvas wrapper -->

    <!-- ******************************************************************** -->
    <!-- * Mini Cart ******************************************************** -->
    <!-- ******************************************************************** -->

    <?php if ( (isset($shopkeeper_theme_options['main_header_shopping_bag'])) && ($shopkeeper_theme_options['main_header_shopping_bag'] == "1") ) : ?>
	    <div class="shopkeeper-mini-cart">
	    	<?php if ( class_exists( 'WC_Widget_Cart' ) ) { the_widget( 'WC_Widget_Cart' ); } ?>

	    	<?php
	    		if (!empty($shopkeeper_theme_options['main_header_minicart_message'])):
	    			echo '<div class="minicart-message">'. esc_html__( $shopkeeper_theme_options['main_header_minicart_message'], 'getbowtied' ) .'</div>';
	    		endif;
	    	?>
	    </div>
	<?php endif; ?>

	<!-- ******************************************************************** -->
    <!-- * Site Search ****************************************************** -->
    <!-- ******************************************************************** -->
    <div class="off-canvas-wrapper">
		<div class="site-search off-canvas position-top is-transition-overlap" id="offCanvasTop1" data-off-canvas>
			<div class="row has-scrollbar">
				<div class="site-search-close">
					<button class="close-button" aria-label="Close menu" type="button" data-close>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<p class="search-text">
					<?php esc_html_e('What are you looking for?', 'getbowtied'); ?>
				</p>
				<?php
				if (class_exists('WooCommerce')) {
					if ( isset($shopkeeper_theme_options['predictive_search']) && $shopkeeper_theme_options['predictive_search'] ) {
						do_action( 'getbowtied_product_search' );
					} else {
						the_widget( 'WC_Widget_Product_Search', 'title=' );
					}
				} else {
					the_widget( 'WP_Widget_Search', 'title=' );
				}
				?>
			</div>
		</div>
	</div><!-- .site-search -->

	<!-- ******************************************************************** -->
    <!-- * Back To Top Button *********************************************** -->
    <!-- ******************************************************************** -->
    <?php $shopkeeper_theme_options['back_to_top_button'] = isset($shopkeeper_theme_options['back_to_top_button']) ? $shopkeeper_theme_options['back_to_top_button'] : '1'; ?>
	<?php if ( $shopkeeper_theme_options['back_to_top_button'] == '1') : ?>
	<a href="#0" class="cd-top">
		<i class="spk-icon spk-icon-up-small" aria-hidden="true"></i>

	</a>
	<?php endif; ?>


	<!-- ******************************************************************** -->
    <!-- * Product Quick View *********************************************** -->
    <!-- ******************************************************************** -->
    <!-- <div id="quick_view_container">
		<div id="placeholder_product_quick_view" class="woocommerce"></div>
	</div> -->

	<div class="cd-quick-view woocommerce">
	</div> <!-- cd-quick-view -->

    <!-- ******************************************************************** -->
    <!-- * Custom Footer JavaScript Code ************************************ -->
    <!-- ******************************************************************** -->

    <?php if ( (isset($shopkeeper_theme_options['footer_js'])) && ($shopkeeper_theme_options['footer_js'] != "") ) : ?>
		<?php echo $shopkeeper_theme_options['footer_js']; ?>
    <?php endif; ?>

    <!-- ******************************************************************** -->
    <!-- * WP Footer() ****************************************************** -->
    <!-- ******************************************************************** -->

	<?php wp_footer(); ?>

</body>

</html>
