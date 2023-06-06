<?php global $yith_wcwl, $woocommerce; ?>

<?php
    $header_alignment = $shopkeeper_theme_options['main_header_layout'] == 1 ? 'align_left' : 'align_right';
?>

<?php

  $isWooCommercePage = false;

  // if (function_exists ( 'is_woocommerce' ) && is_woocommerce()) {
  //     $isWooCommercePage = true;
  // }

  $woocommerce_keys = array ('woocommerce_shop_page_id',
                             // 'woocommerce_terms_page_id',
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

<!-- STYLE FOR WooCommerce pages -->

<?php
  if ($isWooCommercePage) {
?>
    <style type="text/css">

      #page_wrapper.sticky_header .content-area h1.page-title:first-child,
      #page_wrapper.transparent_header .content-area h1.page-title:first-child,
      #page_wrapper .content-area h1.page-title:first-child,
      #primary h1.page-title:first-child {
        font-size: 4rem;
        margin-bottom: 1.2rem;
      }

      #page_wrapper.sticky_header .content-area,
      #page_wrapper.transparent_header .content-area,
      #page_wrapper .content-area,
      #primary {
        margin: 0rem auto;
        padding: 7rem 0 3rem 0;
      }

      @media only screen and (max-width: 1024px) {
          #page_wrapper.sticky_header .content-area,
          #page_wrapper.transparent_header .content-area,
          #page_wrapper .content-area,
          #primary {
            padding: 2rem 0 3rem 0;
          }
      }

      .ev-flash-message-actived #page_wrapper.sticky_header .content-area,
      .ev-flash-message-actived #page_wrapper.transparent_header .content-area,
      .ev-flash-message-actived #page_wrapper .content-area,
      .ev-flash-message-actived #primary {
        margin: 5rem auto;
      }

      @media only screen and (max-width: 1200px) {
        .woocommerce-cart .entry-content .woocommerce > form,
        .woocommerce-cart .entry-content .woocommerce .cart-collaterals {
          width: 100%;
          margin-bottom: 50px;
        }
      }

      #primary .row {
        padding: 0 1rem !important;
      }

      .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button,
      .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button,
      .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button,
      .woocommerce-page input.button, .woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt,
      .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt,
      .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt {
        font-size: 1.4rem !important;
      }

      .woocommerce form .form-row input.input-text,
      .woocommerce form .form-row textarea,
      p label {
        font-size: 1.2rem !important;
      }

      #billing_country_field .select2-selection__rendered, #billing_country_field .select2-selection__placeholder, #billing_state_field .select2-selection__rendered, #billing_state_field .select2-selection__placeholder, #calc_shipping_country_field .select2-selection__rendered, #calc_shipping_country_field .select2-selection__placeholder, #calc_shipping_state_field .select2-selection__rendered, #calc_shipping_state_field .select2-selection__placeholder, #shipping_country_field .select2-selection__rendered, #shipping_country_field .select2-selection__placeholder, #shipping_state_field .select2-selection__rendered, #shipping_state_field .select2-selection__placeholder, .woocommerce-widget-layered-nav-dropdown .select2-selection__rendered, .woocommerce-widget-layered-nav-dropdown .select2-selection__placeholder {
        font-size: 1.2rem !important;
      }

      label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox {
        font-size: 1.2rem !important;
      }

    </style>
<?php
  }
?>

<header id="masthead" class="site-header default-ev-header <?php if($isWooCommercePage) { echo 'default-ev-header-woocommerce'; } ?>" role="banner">

    <?php if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "custom") ) : ?>
    <div class="row">
        <div class="columns">
    <?php endif; ?>

            <div class="site-header-wrapper" style="max-width:<?php echo esc_html($header_max_width_style); ?>">

                <div class="ev-menu-left-part">
                  <a class="offcanvas-menu-button hide-for-large" href="<?php echo get_site_url(); ?>"><img class="ev-logo-icon" src="<?php bloginfo('stylesheet_directory'); ?>/images/header/logo-icon.png" alt="Logo <?php echo str_replace(' ', '-', strtolower(bloginfo('name'))); ?>" /></a>
                  <a class="offcanvas-menu-button hide-for-large" href="#" style="margin-left: 2rem;" id="toggle-menu-open"><img class="open-menu-icon" src="<?php bloginfo('stylesheet_directory'); ?>/images/header/menu-open.svg" alt="open-menu" /></a>
                </div>

                <?php
				$site_tools_padding_class = "";
				if ( (isset($shopkeeper_theme_options['main_header_off_canvas'])) && ($shopkeeper_theme_options['main_header_off_canvas'] == "1") ) {
					if ( (!isset($shopkeeper_theme_options['main_header_off_canvas_icon'])) || ($shopkeeper_theme_options['main_header_off_canvas_icon']) == "" ) {
                		$site_tools_padding_class = "offset";
					}
				}
				elseif ( (isset($shopkeeper_theme_options['main_header_search_bar'])) && ($shopkeeper_theme_options['main_header_search_bar'] == "1") ) {
                	if ( (!isset($shopkeeper_theme_options['main_header_search_bar_icon'])) || ($shopkeeper_theme_options['main_header_search_bar_icon']) == "" ) {
						$site_tools_padding_class = "offset";
					}
				}
                ?>

                <div class="site-tools <?php echo esc_html($site_tools_padding_class); ?> <?php if ( (isset($header_alignment)) ) echo esc_html($header_alignment); ?>">
                    <ul>
                        <!-- <li class="ev-facebook-messenger">
                          <a href="#fb-messenger">
                            <img class="ev-chat-icon-white" src="<?php bloginfo('stylesheet_directory'); ?>/images/chat/chat-white.svg">
                            <img class="ev-chat-icon-black" src="<?php bloginfo('stylesheet_directory'); ?>/images/chat/chat-black.svg">
                          </a>
                        </li> -->
                        <?php if (class_exists('YITH_WCWL')) : ?>
                        <?php if ( (isset($shopkeeper_theme_options['main_header_wishlist'])) && ($shopkeeper_theme_options['main_header_wishlist'] == "1") ) : ?>
                        <li class="wishlist-button">
                            <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="tools_button">
                                <span class="tools_button_icon">
                                    <?php if ( (isset($shopkeeper_theme_options['main_header_wishlist_icon'])) && ($shopkeeper_theme_options['main_header_wishlist_icon'] != "") ) : ?>
                                    <img src="<?php echo esc_url($shopkeeper_theme_options['main_header_wishlist_icon']); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-heart"></i>
									<?php endif; ?>
                                </span>
                                <span class="wishlist_items_number"><?php echo yith_wcwl_count_products(); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if (class_exists('WooCommerce')) : ?>
                        <?php if ( (isset($shopkeeper_theme_options['main_header_shopping_bag'])) && ($shopkeeper_theme_options['main_header_shopping_bag'] == "1") ) : ?>
                        <?php if ( (isset($shopkeeper_theme_options['catalog_mode'])) && ($shopkeeper_theme_options['catalog_mode'] == 1) ) : ?>
                        <?php else : ?>
                        <li class="shopping-bag-button">
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="tools_button">
                                <span class="tools_button_icon">
                                	<?php if ( (isset($shopkeeper_theme_options['main_header_shopping_bag_icon'])) && ($shopkeeper_theme_options['main_header_shopping_bag_icon'] != "") ) : ?>
                                    <img src="<?php echo esc_url($shopkeeper_theme_options['main_header_shopping_bag_icon']); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-cart-shopkeeper"></i>
									<?php endif; ?>
                                </span>
                                <span class="shopping_bag_items_number"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if ( (isset($shopkeeper_theme_options['my_account_icon_state'])) && ($shopkeeper_theme_options['my_account_icon_state'] == "1") ) : ?>
                        <li class="my_account_icon">
                            <a class="tools_button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                                <span class="tools_button_icon">
                                    <?php if ( (isset($shopkeeper_theme_options['custom_my_account_icon'])) && ($shopkeeper_theme_options['custom_my_account_icon'] != "") ) : ?>
                                    <img src="<?php echo esc_url($shopkeeper_theme_options['custom_my_account_icon']); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-user-account"></i>
                                    <?php endif; ?>
                                </span>
                            </a>
                        </li>
                        <?php endif; ?>


                        <?php if ( (isset($shopkeeper_theme_options['main_header_search_bar'])) && ($shopkeeper_theme_options['main_header_search_bar'] == "1") ) : ?>
                        <li class="offcanvas-menu-button search-button">
                            <a class="tools_button" data-toggle="offCanvasTop1">
                                <span class="tools_button_icon">
                                	<?php if ( (isset($shopkeeper_theme_options['main_header_search_bar_icon'])) && ($shopkeeper_theme_options['main_header_search_bar_icon'] != "") ) : ?>
                                    <img src="<?php echo esc_url($shopkeeper_theme_options['main_header_search_bar_icon']); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-search"></i>
									<?php endif; ?>
                                </span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                      <div class="lang-switcher"">
                        <?php wp_nav_menu(array('menu' => 'lang-switcher')) ?>
                      </div>
                </div>

            </div><!--.site-header-wrapper-->

    <?php if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "custom") ) : ?>
        </div><!-- .columns -->
    </div><!-- .row -->
    <?php endif; ?>

</header><!-- #masthead -->



<script>

	jQuery(document).ready(function($) {

    "use strict";

    var original_logo = $('.site-logo').attr('src');

		$(window).scroll(function() {

			if ($(window).scrollTop() > 0) {

				<?php if ( (isset($shopkeeper_theme_options['sticky_header'])) && (trim($shopkeeper_theme_options['sticky_header']) == "1" ) ) { ?>
					$('#site-top-bar').addClass("hidden");
					$('.site-header').addClass("sticky");
					<?php if ( (isset($shopkeeper_theme_options['sticky_header_logo'])) && (trim($shopkeeper_theme_options['sticky_header_logo']) != "" ) ) { ?>
						$('.site-logo').attr('src', '<?php echo esc_url($shopkeeper_theme_options['sticky_header_logo']); ?>');
					<?php } ?>
				<?php } ?>

			} else {

				<?php if ( (isset($shopkeeper_theme_options['sticky_header'])) && (trim($shopkeeper_theme_options['sticky_header']) == "1" ) ) { ?>
					$('#site-top-bar').removeClass("hidden");
					$('.site-header').removeClass("sticky");
					<?php if ( (isset($shopkeeper_theme_options['sticky_header_logo'])) && (trim($shopkeeper_theme_options['sticky_header_logo']) != "" ) ) { ?>
						$('.site-logo').attr('src', original_logo);
					<?php } ?>
				<?php } ?>

			}

		});

	});

</script>
