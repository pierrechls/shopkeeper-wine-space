<?php

$header_width = ( 'full' === Shopkeeper_Opt::getOption( 'header_width', 'custom' ) ) ? 'full-header-width' : 'custom-header-width';
$header_alignment = ( '1' === Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) ) ? 'align_left' : 'align_right';

?>

<header id="masthead" class="site-header default <?php echo esc_attr($header_width); ?>" role="banner">
    <div class="row">
        <div class="site-header-wrapper">

            <div class="site-branding">
                <?php shopkeeper_get_logo(); ?>
            </div>

            <div class="menu-wrapper">

			<?php
				$menuLocations = get_nav_menu_locations();
				$menuID = $menuLocations['main-navigation']; // Get the *primary* menu ID
				$primaryNav = wp_get_nav_menu_items($menuID);
				foreach ( $primaryNav as $navItem ) {

					//echo '<li class="'.$navItem->classes[0].'"><a href="'.$navItem->url.'" title="'.$navItem->title.'">'.$navItem->title.'</a></li>';

				}
								
?>

<div class="content">
  
  
  </div>


            <!-- <div class="menu-wrapper">
                <?php if( !wp_is_mobile() ) { ?>
                    <?php shopkeeper_get_menu( 'show-for-large main-navigation default-navigation ' . $header_alignment, 'main-navigation', 1 ); ?>
                <?php } ?>

                <div class="site-tools">
                    <?php echo shopkeeper_get_header_tool_icons(); ?>
                </div>
            </div> -->

        </div>
    </div>
	 




</header>
