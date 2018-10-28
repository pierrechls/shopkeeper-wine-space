<<<<<<< HEAD
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

	<div id="primary" class="primary-home content-area">

        <div id="content" class="site-content" role="main">

						<?php
							if( have_rows('slider') ):
						?>

							<!-- <div class="slider-ev-home-header-box-shadow"></div> -->
							<div class="slider-ev-home">
								<div class="slider-ev-siema">

									<?php
										while ( have_rows('slider') ) : the_row();
									?>
										<?php $backgroudSliderImage = get_sub_field('image');?>
										<div class="slider-ev-siema-slide-background" style="background-image: url(<?php if( $backgroudSliderImage ) { echo $backgroudSliderImage; } else { echo get_stylesheet_directory_uri() . '/images/products/products-background.png'; } ?>);">
												<img src="<?php echo get_stylesheet_directory_uri() . '/images/products/slider-image.png'; ?>" alt="espace-vin-slider-image" />
												<div class="slider-ev-siema-slide-content">
													<div class="slider-ev-siema-slide-content-center">
														<div class="description-content-page-slider">
															<p class="title-content-slider">
																<?php the_sub_field('content'); ?></br>
																<a href="<?php the_sub_field('link-url'); ?>"><?php the_sub_field('link-text'); ?></a>
															</p>
														</div>
													</div>
												</div>
										</div>
									<?php
										endwhile;
									?>

								</div>
								<div class="pagination"><ul></ul></div>
							</div>

							<script type="text/javascript">

									class SiemaWithDots extends Siema {

										addDots() {
											this.dots = document.createElement('div');
											this.dots.classList.add('dots');

											for(let i = 0; i < this.innerElements.length; i++) {
													const dot = document.createElement('button');
													dot.classList.add('dots__item');
													dot.addEventListener('click', () => {
														this.goTo(i);
													})
													this.dots.appendChild(dot);
											}
											const pagination = document.querySelector('.slider-ev-home .pagination ul');
											pagination.appendChild(this.dots);
										}

										updateDots() {
											for (let i = 0; i < this.dots.querySelectorAll('button').length; i++) {
												const addOrRemove = this.currentSlide === i ? 'add' : 'remove';
												this.dots.querySelectorAll('button')[i].classList[addOrRemove]('dots__item--active');
											}
										}
									}

								const siemaWithDots = new SiemaWithDots({
									selector: '.slider-ev-siema',
									duration: 800,
									easing: 'ease-in-out',
									perPage: 1,
									startIndex: 0,
									draggable: true,
									multipleDrag: true,
									loop: true,
									onInit: function(){
										this.addDots();
										this.updateDots();
									},
									onChange: function(){
										this.updateDots()
									},
								});

								 setInterval(function () {
									 siemaWithDots.next();
								 }, 5 * 1000);

							</script>

						<?php

							else :

						    // no rows found

							endif;

						?>

						<?php
							if( have_rows('major-products') ):
						?>
							<div id="major-product">
									<h4 class="major-product-title"><?php the_field('major-products-title'); ?></h4>
									<?php

									$products = get_field('major-products');

									if( $products ): ?>
											<div class="major-products-list row">
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

									<div class="major-product-link">
										<p><a href="<?php the_field('major-products-link'); ?>"><?php the_field('major-products-title-link'); ?></a></p>
									</div>

							</div>

						<?php

							else :

						    // no rows found

							endif;

						?>

						<div class="homepage-website-description">
						  <div class="homepage-website-description-content">
								<h1 class="content-description-title"><?php the_field('description-text-website-title'); ?></h1>
								<p class="content-description-content"><?php the_field('description-text-website-content'); ?></p>
							</div>
						  <div class="homepage-website-description-content image-cover">
									<img src="<?php echo get_stylesheet_directory_uri() . '/images/home/blank.png' ?>"/>
							</div>
						</div>

        </div><!-- #content -->

    </div><!-- #primary -->

<?php get_footer(); ?>
=======
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

	<div id="primary" class="primary-home content-area">

        <div id="content" class="site-content" role="main">

						<?php
							if( have_rows('slider') ):
						?>

							<!-- <div class="slider-ev-home-header-box-shadow"></div> -->
							<div class="slider-ev-home">
								<div class="slider-ev-siema">

									<?php
										while ( have_rows('slider') ) : the_row();
									?>
										<?php $backgroudSliderImage = get_sub_field('image');?>
										<div class="slider-ev-siema-slide-background" style="background-image: url(<?php if( $backgroudSliderImage ) { echo $backgroudSliderImage; } else { echo get_stylesheet_directory_uri() . '/images/products/products-background.png'; } ?>);">
												<img src="<?php echo get_stylesheet_directory_uri() . '/images/products/slider-image.png'; ?>" alt="espace-vin-slider-image" />
												<div class="slider-ev-siema-slide-content">
													<div class="slider-ev-siema-slide-content-center">
														<div class="description-content-page-slider">
															<p class="title-content-slider">
																<?php the_sub_field('content'); ?></br>
																<a href="<?php the_sub_field('link-url'); ?>"><?php the_sub_field('link-text'); ?></a>
															</p>
														</div>
													</div>
												</div>
										</div>
									<?php
										endwhile;
									?>

								</div>
								<div class="pagination"><ul></ul></div>
							</div>

							<script type="text/javascript">

									class SiemaWithDots extends Siema {

										addDots() {
											this.dots = document.createElement('div');
											this.dots.classList.add('dots');

											for(let i = 0; i < this.innerElements.length; i++) {
													const dot = document.createElement('button');
													dot.classList.add('dots__item');
													dot.addEventListener('click', () => {
														this.goTo(i);
													})
													this.dots.appendChild(dot);
											}
											const pagination = document.querySelector('.slider-ev-home .pagination ul');
											pagination.appendChild(this.dots);
										}

										updateDots() {
											for (let i = 0; i < this.dots.querySelectorAll('button').length; i++) {
												const addOrRemove = this.currentSlide === i ? 'add' : 'remove';
												this.dots.querySelectorAll('button')[i].classList[addOrRemove]('dots__item--active');
											}
										}
									}

								const siemaWithDots = new SiemaWithDots({
									selector: '.slider-ev-siema',
									duration: 800,
									easing: 'ease-in-out',
									perPage: 1,
									startIndex: 0,
									draggable: true,
									multipleDrag: true,
									loop: true,
									onInit: function(){
										this.addDots();
										this.updateDots();
									},
									onChange: function(){
										this.updateDots()
									},
								});

								 setInterval(function () {
									 siemaWithDots.next();
								 }, 5 * 1000);

							</script>

						<?php

							else :

						    // no rows found

							endif;

						?>

						<?php
							if( have_rows('major-products') ):
						?>
							<div id="major-product">
									<h4 class="major-product-title"><?php the_field('major-products-title'); ?></h4>
									<?php

									$products = get_field('major-products');

									if( $products ): ?>
											<div class="major-products-list row">
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

									<div class="major-product-link">
										<p><a href="<?php the_field('major-products-link'); ?>"><?php the_field('major-products-title-link'); ?></a></p>
									</div>

							</div>

						<?php

							else :

						    // no rows found

							endif;

						?>

						<div class="homepage-website-description">
						  <div class="homepage-website-description-content">
								<h1 class="content-description-title"><?php the_field('description-text-website-title'); ?></h1>
								<p class="content-description-content"><?php the_field('description-text-website-content'); ?></p>
							</div>
						  <div class="homepage-website-description-content image-cover">
									<img src="<?php echo get_stylesheet_directory_uri() . '/images/home/blank.png' ?>"/>
							</div>
						</div>

        </div><!-- #content -->

    </div><!-- #primary -->

<?php get_footer(); ?>
>>>>>>> 0663092447ab205f690af70a116de3ec6968bd9a
