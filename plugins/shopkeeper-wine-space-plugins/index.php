<?php  

/*
  Plugin Name: Shopkeeper Wine Space Shortcodes
  Description: Shopkeeper Wine Space Shortcodes
  Author: Pierre CHARLES
  Version: 1.0.0
 */


	/*
		Template for adding a shortcode page to a plugin. Steps:
		
		1. Include this file.
		2. Add [shopkeeper_wine_space_menu_shortcode] shortcode to a page of the site.
		3. Navigate to the page on the front end.
		
		Be sure to change the name of the shortcode and the function names below.
		
		Add all "preheader" code to the preheader section. This is code that will process before the wp_head call and should include form processing, etc.
		
		All frontend code should go in the page template section. We use output buffering to capture anything echo'd here and return it to the shortcode to be swapped into the shortcode space.
	*/
	
	/*
		Preheader
	*/
	function my_page_preheader()
	{
		if(!is_admin())
		{
			global $post, $current_user;
			if(!empty($post->post_content) && strpos($post->post_content, "[shopkeeper_wine_space_menu_shortcode]") !== false)
			{
				/*
					Preheader operations here.
				*/				
			}
		}
	}
	add_action("wp", "my_page_preheader", 1);	
	
	/*
		Shortcode Wrapper
	*/
	function shopkeeper_wine_space_menu_shortcode($atts, $content=null, $code="")
	{			
		ob_start();					
		?>
		<!-- HTML STYLE PART -->

		<div class="ev-nav">
			<nav class="ev-nav-content">
				<a href="javascript:void(0);" class="mobile-menu-trigger"> | | |</a>
				<?php
				$menu_name = 'main-navigation';

				$main_menu = array();
				$previousItem = null;

				if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
					$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
				
					$menu_items = wp_get_nav_menu_items($menu->term_id);
				
					foreach ( (array) $menu_items as $key => $menu_item ) {
						if (!isset( $main_menu[ $menu_item->ID ])) {
							if ($menu_item->menu_item_parent != 0) {
								if ($main_menu[$menu_item->menu_item_parent]['id'] == $menu_item->menu_item_parent) {
									// LEVEL 2
									$main_menu[$menu_item->menu_item_parent]['sub-items'][$menu_item->ID] = array(
										'id' => $menu_item->ID,
										'title' => $menu_item->title,
										'url' => $menu_item->url,
										'classes' => $menu_item->classes,
										'sub-items' => [],
										'background' => $menu_item->attr_title,
									);
									$previousItem = array('level1_id' => $menu_item->menu_item_parent, 'level2_id' => $menu_item->ID,);
								} else if ($previousItem && $main_menu[$previousItem['level1_id']]['sub-items'][$previousItem['level2_id']]['id'] == $menu_item->menu_item_parent) {
									// LEVEL 3
									$main_menu[$previousItem['level1_id']]['sub-items'][$previousItem['level2_id']]['sub-items'][$menu_item->ID] = array(
										'id' => $menu_item->ID,
										'title' => $menu_item->title,
										'url' => $menu_item->url,
										'classes' => $menu_item->classes,
										'sub-items' => [],
										'background' => $menu_item->attr_title,
									);
								}
							} else {
								// LEVEL 1
								$main_menu[$menu_item->ID]['id'] = $menu_item->ID;
								$main_menu[$menu_item->ID]['title'] = $menu_item->title;
								$main_menu[$menu_item->ID]['url'] = $menu_item->url;
								$main_menu[$menu_item->ID]['classes'] = $menu_item->classes;
								$main_menu[$menu_item->ID]['sub-items'] = [];
								$main_menu[$menu_item->ID]['background'] = $menu_item->attr_title;
							}
						}
						
					}
				}
			?>
			
			<ul class="menu menu-bar">
			<?php foreach ( $main_menu as $itemKey => $item ) { ?>
				<?php if(count($item['sub-items']) == 0) { ?>
					<li>
						<a
							href="<?php print_r($item['url']) ?>"
							class="menu-link menu-bar-link <?php if (in_array('ev-menu-link-highlight', $item['classes'])) { echo 'ev-menu-link-highlight'; } ?>"
						>
							<?php print_r($item['title']) ?>
						</a>
					</li>
				<?php } else { ?>
					<!-- MULTI-LEVEL DROPDOWN -->
					<?php if (in_array('ev-menu-multi-level', $item['classes'])) { ?>
						<li>
							<a href="javascript:void(0);" class="menu-link menu-bar-link <?php if (in_array('ev-menu-link-highlight', $item['classes'])) { echo 'ev-menu-link-highlight'; } ?>"
								aria-haspopup="true">
								<?php print_r($item['title']) ?>
							</a>
							<ul class="mega-menu mega-menu-multi-level">
							<?php foreach ( $item['sub-items'] as $subItemKey => $subItem ) { ?>
								<li>
									<a href="javascript:void(0);" class="menu-link mega-menu-link" aria-haspopup="true"><?php print_r($subItem['title']) ?></a>
									<ul class="menu menu-list">
										<?php foreach ( $subItem['sub-items'] as $subSubItemKey => $subSubItem ) { ?>
											<?php if (in_array('ev-menu-link-highlight', $subSubItem['classes'])) { ?>
												<li class="ev-menu-link-highlight-break"></li>
											<?php } ?>
											<li>
												<a
													class="menu-link menu-list-link <?php if (in_array('ev-menu-link-highlight', $subSubItem['classes'])) { echo 'ev-menu-link-highlight'; } ?>"
													href="<?php print_r($subSubItem['url']); ?>"
												>
													<?php print_r($subSubItem['title']); ?>
												</a>
											</li>
										<?php } ?>
									</ul>
								</li>
							<?php } ?>
							<li class="mobile-menu-back-item">
								<a href="javascript:void(0);" class="menu-link mobile-menu-back-link"> </a>
							</li>
							</ul>
						</li>
					<?php } ?>
					<!-- MULTI COLUMN DROPDOWN -->
					<?php if (in_array('ev-menu-multi-column', $item['classes'])) { ?>
						<li>
							<a
								href="javascript:void(0);"
								class="menu-link menu-bar-link <?php if (in_array('ev-menu-link-highlight', $item['classes'])) { echo 'ev-menu-link-highlight'; } ?>"
								aria-haspopup="true">
								<?php print_r($item['title']) ?>
							</a>
							<ul class="mega-menu mega-menu-flat-column <?php print_r(implode(" ", $item['classes'])) ?>">
							<?php foreach ( $item['sub-items'] as $subItemKey => $subItem ) { ?>
								<li class="<?php print_r(implode(" ", $subItem['classes'])) ?>">
									<a href="<?php print_r($subItem['url']) ?>" class="menu-link mega-menu-link mega-menu-header"><?php print_r($subItem['title']) ?></a>	
									<ul class="menu menu-list">
										<?php foreach ( $subItem['sub-items'] as $subSubItemKey => $subSubItem ) { ?>
											<li><a class="menu-link menu-list-link" href="<?php print_r($subSubItem['url']); ?>"><?php print_r($subSubItem['title']); ?></a></li>
										<?php } ?>
									</ul>
								</li>
							<?php } ?>
							<li class="mobile-menu-back-item">
								<a href="javascript:void(0);" class="menu-link mobile-menu-back-link"> </a>
							</li>
							</ul>
						</li>
					<?php } ?>
					<!-- IMAGES DROPDOWN -->
					<?php if (in_array('ev-menu-images', $item['classes'])) { ?>
						<li>
							<a
								href="javascript:void(0);"
								class="menu-link menu-bar-link <?php if (in_array('ev-menu-link-highlight', $item['classes'])) { echo 'ev-menu-link-highlight'; } ?>"
								aria-haspopup="true">
								<?php print_r($item['title']) ?>
							</a>
							<ul class="mega-menu mega-menu-flat-column <?php print_r(implode(" ", $item['classes'])) ?>">
							<?php foreach ( $item['sub-items'] as $subItemKey => $subItem ) { ?>
								<li class="mega-menu-content">
									<a href="<?php print_r($subItem['url']) ?>" class="menu-link menu-list-link menu-list-link-image">
										<img src="<?php print_r($subItem['background']) ?>">
										<small><?php print_r($subItem['title']) ?></small>
									</a>
								</li>
							<?php } ?>
							<li class="mobile-menu-back-item">
								<a href="javascript:void(0);" class="menu-link mobile-menu-back-link"> </a>
							</li>
							</ul>
						</li>
					<?php } ?>
				<?php } ?>
			<?php } ?>	
			<li class="mobile-menu-header">
				<a href="#" class="">
					<span></span>
				</a>
			</li>
		</ul>
		</nav>
		</div>

		<!-- CSS STYLE PART -->
		<style rel="stylesheet">

			.ev-nav nav.ev-nav-content ul,
			.ev-nav nav.ev-nav-content li {
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.ev-nav nav.ev-nav-content a {
				display: block;
				text-decoration: none;
			}
			.ev-nav nav.ev-nav-content a:hover,
			.ev-nav nav.ev-nav-content a:visited {
				text-decoration: none;
			}

			.ev-nav nav.ev-nav-content a.ev-menu-link-highlight {
				color: #baa571;
			}

			.mega-menu.mega-menu-multi-level ul li a.ev-menu-link-highlight {
				font-weight: 800;
			}

			.mega-menu.mega-menu-multi-level ul li.ev-menu-link-highlight-break {
				display: none;
			}

			.menu-bar {
				background: #ffffff;
				display: flex;
			}

			.menu-link {
				padding: 1rem;
				background: #ffffff;
				color: #000000;
				transition: background 0.2s, color 0.2s;
				position: relative;
				z-index: 1;
			}
			.menu-link[aria-haspopup="true"] {
				padding-right: 40px;
			}
			.menu-link[aria-haspopup="true"]:after {
				content: "⌄";
				font-size: 0.8rem;
				position: absolute;
				right: 1rem;
				transform: translateY(-0.2rem);
			}
			.mega-menu-link,
			.menu-list-link {
				padding: 0.4rem 0.5rem 0.4rem 0.5rem;
			}

			.menu-list-link.menu-list-link-image {
				line-height: 0;
				padding: 0;
			}
			.menu-list-link.menu-list-link-image small {
				background: #baa571;
				text-align: center;
				font-size: 1em;
    			font-weight: bold;
				padding: 1em 0px;
				color: #000000;
				width: 100%;
				display: block;
			}

			.menu-list-link.menu-list-link-image img {
				width: 100%;
			}

			a.menu-link.menu-list-link:hover {
				color: #baa571;
				background: none;
			}
			.mega-menu-header {
				font-size: 1rem;
				font-weight: bold;
				color: #baa571;
				cursor: default;
			}
			.mega-menu {
				background: #ffffff !important;
				z-index: 1000000;
			}
			.mega-menu-multi-level {
				flex-direction: column;
			}

			@media all and (min-width: 951px) {
				.ev-nav {
					/* margin-top: 50px; */
					background: #ffffff;
				}
				.ev-nav > nav.ev-nav-content {
					max-width: 950px;
					margin: 0 auto;
				}
				.menu [aria-haspopup="true"] ~ ul {
					display: none;
				}

				.menu-bar {
					position: relative;
					flex-direction: row;
    				justify-content: center;
				}

				.ev-nav nav.ev-nav-content li a.menu-bar-link {
					display: inline-block;
					padding: 1rem 20px 1rem 15px;
					text-transform: uppercase;
					font-weight: 800;
					font-size: 0.8rem;
				}

				.menu-link[aria-haspopup="true"]:after {
					right: 5px;
				}

				.menu-bar > li > [aria-haspopup="true"]:after {
					color: #baa571;
				}
				.menu-bar > li > [aria-haspopup="true"]:hover:after {
					color: #baa571;
				}
				.menu-bar > li > [aria-haspopup="true"]:hover ~ ul {
					display: flex;
					flex-wrap: wrap;
					transform-origin: top;
					animation: dropdown 0.2s ease-out;
					-webkit-box-shadow: 0px 24px 24px 0px rgba(0,0,0,0.3); 
					box-shadow: 0px 24px 24px 0px rgba(0,0,0,0.3);
				}
				.menu-bar > li > [aria-haspopup="true"] ~ ul:hover {
					display: flex;
					flex-wrap: wrap;
					-webkit-box-shadow: 0px 24px 24px 0px rgba(0,0,0,0.3); 
					box-shadow: 0px 24px 24px 0px rgba(0,0,0,0.3);
				}
				.menu-bar > li:focus-within > [aria-haspopup="true"] ~ ul {
					display: flex;
					background: none;
				}
				.menu-bar > li > [aria-haspopup="true"]:focus,
				.menu-bar > li:focus-within > [aria-haspopup="true"],
				.menu-bar > li:hover > a {
					background: #000000;
					color: #ffffff;
				}
				.mega-menu {
					position: absolute;
					top: 100%;
					left: 0;
					width: 100%;
				}
				.mega-menu:hover {
					display: flex;
				}
				.mega-menu a:hover {
					color: #baa571;
				}
				.mega-menu-multi-level > li {
					width: 33.33333333%;
				}
				.mega-menu-multi-level > li > [aria-haspopup="true"] ~ ul {
					left: 33.33333333%;
					width: 33.33333333%;
				}
				.mega-menu-multi-level > li > [aria-haspopup="true"] ~ ul ul {
					width: 100%;
					left: 100%;
				}
				.mega-menu-multi-level li:hover > [aria-haspopup="true"] ~ ul {
					display: block;
					transform-origin: left;
					animation: flyout 0.2s ease-out;
				}
			
				.mega-menu-multi-level li:hover > [aria-haspopup="true"] ~ ul,
				.mega-menu-multi-level li:focus-within > [aria-haspopup="true"] ~ ul {
					display: flex;
					width: calc((100% / 3) * 2);
					flex-direction: row;
					flex-wrap: wrap;
					background: #FFFFFF;
					align-content: flex-start;
					justify-content: flex-start;
					align-items: flex-start;
				}
				.mega-menu.mega-menu-multi-level ul li {
					width: calc(100% / 3);
				}

				.mega-menu.mega-menu-multi-level ul li.ev-menu-link-highlight-break {
					flex-grow: 1;
    				width: 100%;
					display: block;
				}

				.mega-menu-multi-level li:hover > [aria-haspopup="true"],
				.mega-menu-multi-level li:focus-within > [aria-haspopup="true"],
				.mega-menu-multi-level li:hover > a,
				.mega-menu-multi-level li:focus-within > a {
					background: #f2f2f2;
					color: #000000;
				}
				.mega-menu-multi-level [aria-haspopup="true"] ~ ul,
				.mega-menu-multi-level [aria-haspopup="true"] {
					border-left: 1px solid #f0f0f0;
				}
				.mega-menu-multi-level [aria-haspopup="true"] ~ ul:hover,
				.mega-menu-multi-level [aria-haspopup="true"]:hover {
					display: block;
				}
				.mega-menu-multi-level [aria-haspopup="true"] ~ ul {
					position: absolute;
					top: 0;
					height: 100%;
				}
				.mega-menu-flat-column > * {
					flex: 1;
				}

				ul.mega-menu.mega-menu-flat-column.ev-menu-images > li {
					background-color: #000;
				}
				ul.mega-menu.mega-menu-flat-column.ev-menu-images > li a:hover {
					opacity: 1;
				}
				ul.mega-menu.mega-menu-flat-column.ev-menu-images > li a:hover > img {
					opacity: 0.7;
					-webkit-transition: all 0.3s;
    				transition: all 0.3s;
				}
				
				ul.mega-menu.mega-menu-flat-column.ev-column-2 > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-2 > li.ev-column-2-force-2 > ul > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-3 > li.ev-column-3-force-2 > ul > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-4 > li.ev-column-4-force-2 > ul > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-2 > ul > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-2 > ul > li {
					width: calc(100% / 2);
					flex: none;
				}

				ul.mega-menu.mega-menu-flat-column.ev-column-2 > li.ev-column-2-force-2 {
					width: calc((100% / 2) * 2);
				}

				ul.mega-menu.mega-menu-flat-column.ev-column-3 > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-4 > li.ev-column-4-force-3 > ul > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-3 > ul > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-3 > ul > li {
					width: calc(100% / 3);
					flex: none;
				}

				ul.mega-menu.mega-menu-flat-column.ev-column-3 > li.ev-column-3-force-2 {
					width: calc((100% / 3) * 2);
				}

				ul.mega-menu.mega-menu-flat-column.ev-column-4 > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-4 > ul > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-4 > ul > li {
					width: calc(100% / 4);
					flex: none;
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-4 > li.ev-column-4-force-2 {
					width: calc((100% / 4) * 2);
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-4 > li.ev-column-4-force-3 {
					width: calc((100% / 4) * 3);
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li,
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-5 > ul > li {
					width: calc(100% / 5);
					flex: none;
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-2 {
					width: calc((100% / 5) * 2);
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-3 {
					width: calc((100% / 5) * 3);
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-4 {
					width: calc((100% / 5) * 4);
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li {
					width: calc(100% / 6);
					flex: none;
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-2 {
					width: calc((100% / 6) * 2);
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-3 {
					width: calc((100% / 6) * 3);
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-4 {
					width: calc((100% / 6) * 4);
				}
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-5 {
					width: calc((100% / 6) * 5);
				}

				ul.mega-menu.mega-menu-flat-column.ev-column-2 > li.ev-column-2-force-2 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-3 > li.ev-column-3-force-2 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-4 > li.ev-column-4-force-2 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-4 > li.ev-column-4-force-3 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-2 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-3 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-5 > li.ev-column-5-force-4 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-2 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-3 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-4 > ul,
				ul.mega-menu.mega-menu-flat-column.ev-column-6 > li.ev-column-6-force-5 > ul {
					flex-direction: row;
				}

				.menu-bar > li.mega-menu-flat-column:hover > [aria-haspopup="true"] ~ ul,
				.menu-bar > li.mega-menu-flat-column:focus-within > [aria-haspopup="true"] ~ ul {
					display: flex;
					background: #FFFFFF;
					flex-wrap: wrap;
					flex-direction: row;
				}

				.mega-menu-flat-column ul.menu.menu-list {
					display: inline-flex;
					flex-direction: column;
					flex-wrap: wrap;
				}

				.mobile-menu-trigger,
				.mobile-menu-header,
				.mobile-menu-back-item {
					display: none !important;
				}
			}

			@media all and (max-width: 950px) {
				.menu-link {
					padding: 0.4rem 0.5rem 0.4rem 0.5rem;
					border-bottom: 1px solid #bba57021;
				}

				.mobile-menu-trigger,
				.mobile-menu-header,
				.mobile-menu-back-item {
					display: block;
				}

				.mobile-menu-trigger {
					background: #ffffff;
					color: #000000;
					border: 0;
					padding: 10px;
					font-size: 1.2em;
					text-align: center;
				}

				.mobile-menu-header {
					order: -1;
					background: #baa571;
					margin-bottom: 1em !important;
				}

				.mobile-menu-header a {
					padding: 1.4em;
					background: #baa571;
					color: #ffffff;
					visibility: visible;
				}

				.menu-bar {
					flex-direction: column;
					position: fixed;
					z-index: 10000000000;
					top: 0;
					left: -100%;
					height: 100vh;
					width: 350px;
					max-width: 350px;
					max-width: 90%;
					overflow-x: hidden;
					transition: left 0.3s;
					box-shadow: 1px 0px 2px 0px rgba(0, 0, 0, 0.25);
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul {
					display: flex;
					flex-direction: column;
					background: #ffffff;
					position: absolute;
					left: 100%;
					top: 0;
					max-height: 100vh;
					min-height: calc(100vh);
					width: 100%;
					transition: left 0.3s;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul > li > [aria-haspopup="true"] {
					font-size: 1em;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul > li > [aria-haspopup="true"] ~ ul a {
					padding-left: 40px;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul > li > [aria-haspopup="true"] ~ ul > li > [aria-haspopup="true"] ~ ul a {
					padding-left: 80px;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul [aria-haspopup="true"] {
					color: #000000;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul [aria-haspopup="true"]:after {
					content: "+";
					background: none;
					font-size: 1em;
					font-weight: normal;
					height: 20px;
					line-height: 1;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul [aria-haspopup="true"] ~ ul {
					max-height: 0px;
					transform-origin: top;
					transform: scaleY(0);
					transition: max-height 0.1s;
				}

				.mega-menu-content {
					padding: 1rem;
				}

				.mobile-menu-back-item {
					order: -1;
				}

				.mobile-menu-back-item a {
					background: #baa571;
					color: #000000;
					max-height: calc(1.4em + 40px);
					margin-top: calc(0px - (1.4em + 40px));
					pointer-events: none;
				}

				.mobile-menu-back-item a:before {
					content: "<";
					width: 14px;
					height: 12px;
					margin-right: 10px;
					display: block;
				}

				.mobile-menu-trigger:focus ~ ul {
					left: 0;
				}

				.menu-bar:hover,
				.menu-bar:focus-within {
					left: 0;
				}

				.menu-bar > li > [aria-haspopup="true"]:focus ~ ul {
					left: 0;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul {
					margin-top: calc(1.4em + 40px);
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul:hover,
				.menu-bar > li > [aria-haspopup="true"] ~ ul:focus-within {
					left: 0;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul [aria-haspopup="true"]:focus ~ ul {
					max-height: 500px;
					animation: dropdown 0.3s forwards;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul li:focus-within > [aria-haspopup="true"] ~ ul {
					max-height: 500px;
					transform: scaleY(1);
				}

				.menu-bar > li:focus-within ~ .mobile-menu-header a {
					visibility: hidden;
				}

				.menu-list-link.menu-list-link-image {
					line-height: 0;
					font-size: 1em;
					padding: 0;
				}

				.menu-list-link.menu-list-link-image small {
					text-align: left;
					color: #000000;
					width: 100%;
					display: block;
					font-size: 1em;
					text-align: left;
					font-weight: normal;
					padding: 1em;
					background: none;
				}

				.menu-list-link.menu-list-link-image img {
					display: none;
				}
			}

			@media all and (max-width: 950px) and (hover: none) {
				.mobile-menu-trigger:hover ~ ul {
					left: 0;
				}

				.menu-bar > li > [aria-haspopup="true"]:hover ~ ul {
					left: 0;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul:hover {
					left: 0;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul [aria-haspopup="true"]:hover ~ ul {
					max-height: 500px;
					animation: dropdown 0.3s forwards;
				}

				.menu-bar > li > [aria-haspopup="true"] ~ ul [aria-haspopup="true"] ~ ul:hover {
					max-height: 500px;
					transform: scaleY(1);
				}

				.menu-bar > li:hover ~ .mobile-menu-header a {
					visibility: hidden;
				}
			}

			/* @keyframes dropdown {
				0% {
					opacity: 0;
					transform: scaleY(0);
				}
				50% {
					opacity: 1;
				}
				100% {
					transform: scaleY(1);
				}
				}
			@keyframes flyout {
				0% {
					opacity: 0;
					transform: scaleX(0);
				}
				100% {
					opacity: 1;
					transform: scaleX(1);
				}
			} */
		</style>

		<!-- JAVASCRIPT PART -->
		<script>
			(function() {
				document.querySelector('.ev-main-menu .ev-main-menu-item.toggle-menu').addEventListener('click', (event) => {
					document.querySelector('.ev-main-menu .ev-main-menu-item.exo-menu').classList.toggle('display');
				});
			})();
		</script>
		<?php
		$temp_content = ob_get_contents();
		ob_end_clean();
		return $temp_content;			
	}
	add_shortcode("shopkeeper_wine_space_menu_shortcode", "shopkeeper_wine_space_menu_shortcode");