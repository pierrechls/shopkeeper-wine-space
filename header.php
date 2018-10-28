<?php
	global $shopkeeper_theme_options, $woocommerce, $wp_version;
?>

<!DOCTYPE html>

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


    <!-- ******************************************************************** -->
    <!-- * Custom Header JavaScript Code ************************************ -->
    <!-- ******************************************************************** -->

    <?php if ( (isset($shopkeeper_theme_options['header_js'])) && ($shopkeeper_theme_options['header_js'] != "") ) : ?>
        <?php echo $shopkeeper_theme_options['header_js']; ?>
    <?php endif; ?>


    <!-- ******************************************************************** -->
    <!-- * WordPress wp_head() ********************************************** -->
    <!-- ******************************************************************** -->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( (isset($shopkeeper_theme_options['smooth_transition_between_pages'])) && ($shopkeeper_theme_options['smooth_transition_between_pages'] == "1" ) ) {
		include(locate_template('header-loader.php'));
	}
	?>

	<div id="st-container" class="st-container">

			<div class="ev-menu">
				<div class="ev-menu-header">
					<a href="<?php echo get_site_url(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/header/logo.png" alt="Logo <?php echo str_replace(' ', '-', strtolower(bloginfo('name'))); ?>" /></a>
					<p class="website-slogan"><?php bloginfo('description'); ?></p>
				</div>
				<div class="ev-menu-content">
					<nav class="ev-products-navigation main-navigation default-navigation <?php if ( (isset($header_alignment)) ) echo esc_html($header_alignment); ?>" role="navigation">
							<?php
									$walker = new rc_scm_walker;
									wp_nav_menu(array(
											'theme_location'  => 'main-navigation',
											'fallback_cb'     => false,
											'container'       => false,
											'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
											'walker' 		  => new rc_scm_walker
									));
							?>
					</nav><!-- .ev-products-navigation -->

					<nav class="ev-pages-navigation main-navigation default-navigation <?php if ( (isset($header_alignment)) ) echo esc_html($header_alignment); ?>" role="navigation">
							<?php
									$walker = new rc_scm_walker;
									wp_nav_menu(array(
											'menu'  => 'pages-menu',
											'fallback_cb'     => false,
											'container'       => false,
											'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
											'walker' 		  => new rc_scm_walker
									));
							?>
					</nav><!-- .ev-pages-navigation -->

					<nav class="ev-social-navigation main-navigation default-navigation <?php if ( (isset($header_alignment)) ) echo esc_html($header_alignment); ?>" role="navigation">
							<?php
									wp_nav_menu(array(
											'menu'  => 'social-menu',
											'fallback_cb'     => false,
											'container'       => false,
											'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
											'walker' 		  => new Social_Icons_Walker_Nav_Menu
									));
							?>
					</nav><!-- .ev-social-navigation -->

					<nav class="ev-legal-navigation main-navigation default-navigation <?php if ( (isset($header_alignment)) ) echo esc_html($header_alignment); ?>" role="navigation">
							<?php
									$walker = new rc_scm_walker;
									wp_nav_menu(array(
											'menu'  => 'legal-menu',
											'fallback_cb'     => false,
											'container'       => false,
											'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
											'walker' 		  => new rc_scm_walker
									));
							?>
					</nav><!-- .ev-pages-navigation -->

					<div style="clear:both"></div>
				</div>
			</div>

			<div id="ev-menu-toggle">
				<a href="#" id="toggle-menu-close"><img class="close-menu-icon" src="<?php bloginfo('stylesheet_directory'); ?>/images/header/menu-close.svg" alt="close-menu" /></a>

				<div class="ev-menu-toogle-menu-element">
					<?php
							wp_nav_menu(array(
									'theme_location'  => 'main-navigation',
									'fallback_cb'     => false,
									'container'       => false,
									'items_wrap'      => '<ul class="ev-accordion %1$s">%3$s</ul>',
									'walker' 		  => new rc_scm_walker
							));
					?>
				</div>

				<div class="ev-menu-toogle-menu-element">
					<?php
							$walker = new rc_scm_walker;
							wp_nav_menu(array(
									'menu'  => 'pages-menu',
									'fallback_cb'     => false,
									'container'       => false,
									'items_wrap'      => '<ul class="ev-accordion %1$s">%3$s</ul>',
									'walker' 		  => new rc_scm_walker
							));
					?>
				</div>

				<div class="ev-menu-toogle-menu-element">
					<?php
							$walker = new rc_scm_walker;
							wp_nav_menu(array(
									'menu'  => 'legal-menu',
									'fallback_cb'     => false,
									'container'       => false,
									'items_wrap'      => '<ul class="ev-accordion %1$s">%3$s</ul>',
									'walker' 		  => new rc_scm_walker
							));
					?>
				</div>

				<div class="ev-menu-toogle-menu-element ev-menu-social">
					<?php
							wp_nav_menu(array(
									'menu'  => 'social-menu',
									'fallback_cb'     => false,
									'container'       => false,
									'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
									'walker' 		  => new Social_Icons_Walker_Nav_Menu
							));
					?>
				</div>
			</div>

				<?php
					$flashMessageActived = get_field('wine-space-settings-flash-message-active', 'option');
				?>

        <div class="st-content <?php if($flashMessageActived) { echo 'ev-flash-message-actived'; } ?>">

					<?php
						if ($flashMessageActived) {
					?>
							<div class="ev-website-flash-message-info-alert"><?php the_field('wine-space-settings-flash-message-content', 'option'); ?></div>
					<?php
						}
					?>

            <?php

			$header_sticky_class = "";
			$header_transparency_class = "";
			$transparency_scheme = "";

			if ( (isset($shopkeeper_theme_options['sticky_header'])) && ($shopkeeper_theme_options['sticky_header'] == "1" ) ) {
				$header_sticky_class = "sticky_header";
			}

			if ( (isset($shopkeeper_theme_options['main_header_transparency'])) && ($shopkeeper_theme_options['main_header_transparency'] == "1" ) ) {
				$header_transparency_class = "transparent_header";
			}

			if ( (isset($shopkeeper_theme_options['main_header_transparency_scheme'])) ) {
				$transparency_scheme = $shopkeeper_theme_options['main_header_transparency_scheme'];
			}

			$page_id = "";
			if ( is_single() || is_page() ) {
				$page_id = get_the_ID();
			} else if ( is_home() ) {
				$page_id = get_option('page_for_posts');
			} else if (class_exists('WooCommerce') && is_shop()) {
				$page_id = get_option( 'woocommerce_shop_page_id' );
			}

			if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit") ) {
				$header_transparency_class = "transparent_header";
				$transparency_scheme = get_post_meta( $page_id, 'page_header_transparency', true );
			}

			if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) == "no_transparency") ) {
				$header_transparency_class = "";
				$transparency_scheme = "";
			}

			if (class_exists('WooCommerce'))
            {
                if ( is_product_category() && is_woocommerce() )
                {
                	if ( $shopkeeper_theme_options['shop_category_header_transparency_scheme'] == 'inherit' )
                	{
                		// do nothing, inherit
                	}
                	else if ( $shopkeeper_theme_options['shop_category_header_transparency_scheme'] == 'no_transparency' )
                	{
                		$header_transparency_class = "";
						$transparency_scheme = "";
                	}
                	else
                	{
                        $header_transparency_class = "transparent_header";
                        $transparency_scheme = $shopkeeper_theme_options['shop_category_header_transparency_scheme'];
                	}
                }
            }

			/*if ( is_shop() ) {
				$header_transparency_class = "";
			}*/

			?>
            <div id="page_wrapper" class="<?php echo $header_sticky_class; ?> <?php echo $header_transparency_class; ?> <?php echo $transparency_scheme; ?>">

                <?php do_action( 'before' ); ?>

                <?php

				$header_max_width_style = "100%";
				if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "custom") ) {
					$header_max_width_style = $shopkeeper_theme_options['header_max_width']."px";
				} else {
					$header_max_width_style = "100%";
				}

				?>

                <div class="top-headers-wrapper">

                    <?php if ( (isset($shopkeeper_theme_options['top_bar_switch'])) && ($shopkeeper_theme_options['top_bar_switch'] == "1" ) ) : ?>
                        <?php include(locate_template('header-topbar.php')); ?>
                    <?php endif; ?>

                    <?php if ( isset($shopkeeper_theme_options['main_header_layout']) ) : ?>

						<?php if ( $shopkeeper_theme_options['main_header_layout'] == "1" || $shopkeeper_theme_options['main_header_layout'] == "11" ) : ?>
							<?php include(locate_template('header-default.php')); ?>
                        <?php elseif ( $shopkeeper_theme_options['main_header_layout'] == "2" || $shopkeeper_theme_options['main_header_layout'] == "22" ) : ?>
                        	<?php include(locate_template('header-centered-2menus.php')); ?>
                        <?php elseif ( $shopkeeper_theme_options['main_header_layout'] == "3" ) : ?>
                        	<?php include(locate_template('header-centered-menu-under.php')); ?>
						<?php endif; ?>

                    <?php else : ?>

                    	<?php include(locate_template('header-default.php')); ?>

                    <?php endif; ?>

                </div>
