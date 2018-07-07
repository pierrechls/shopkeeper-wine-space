<?php
get_header(); ?>

<style>

	/***********************/
	/* CONTENT LINKS STYLE */
	/***********************/

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

	.ev-flash-message-actived #page_wrapper.sticky_header .content-area, #page_wrapper.transparent_header .content-area {
			margin-top: 4rem;
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

	#primary{
		background-color: #FFFFFF;
		padding: 0;
		min-height: 100vh;
	}

	#primary #main {
    margin-top: 2rem;
	}

	h1.actus-title {
		color: #FFF;
		margin: 0.5rem auto 4rem 2rem;
		font-size: 2.5rem;
	}

	h3.region-title {
		padding: 0 5rem 0 3rem;
	}

	.masonry {
	    column-count: 4;
	    column-gap: 1rem;
	    padding: 2rem 2rem;
	}

	.item {
	    display: inline-block;
	    padding: 1rem;
	    margin: 0;
	    width: 100%;
	    min-height: 2rem;
	}

	.item a, .item a:hover {
	    color: #000000;
	}

	.item h5.actu-title {
		color: #000000;
		font-size: 1.3rem;
		margin: 0;
		text-transform: capitalize;
	}

	.item p.actu-date {
		font-size: 1.5rem;
		color: #000000;
		margin: 0 auto;
		font-style: italic;
	}

	.item .actu-more {
	    margin: 2rem auto 2.3rem auto;
	}

	.item .actu-more a{
		text-transform: uppercase;
		font-weight: 600;
		font-size: 1rem;
	}

	p.no-actu {
		position: absolute;
	    font-weight: 600;
	    padding: 1.5rem;
	    width: 20rem;
	    top: 30%;
	    left: 50%;
	    margin-left: -10rem;
	    text-align: center;
	    color: #000000;
	    text-transform: inherit;
	}

	@media only screen and (max-width: 60em){

		.masonry {
		    column-count: 1;
		}

		h1.actus-title {
			margin: 8rem auto 4rem 2rem;
    	}

	}

</style>

<div id="primary" class="content-area">

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
								<h1 class="title-content-page-slider"><?php the_title(); ?></h1>
								<!--<div class="description-content-page-slider"> HERE THE PAGE DESCRIPTION </div>-->
							</div>
						</div>
				</div>

			</div>
			<div class="ev-breadcrumb"><?php custom_breadcrumbs(); ?></div>
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

		<main id="main" class="site-main" role="main">

			<div style="color:#000000 !important;">

			<?php

				$argsDomaines = array(
					'posts_per_page' => -1,
					'post_type'      => 'domaine',
					'orderby'=> 'title',
					'order' => 'ASC'
				);

				$allDomaines = new WP_Query( $argsDomaines );

				if ( $allDomaines->have_posts() ) :

			?>

				<?php

					$allRegions = [];
					$firstDomaine = $allDomaines->posts[0];
					$domaineCat = get_field_object( "region-du-domaine", $firstDomaine->ID );
					$allRegions = $domaineCat['choices'];

					?>

					<?php

						foreach ($allRegions as $region) { ?>

							<h3 class="region-title"><?php echo $region; ?></h3>

						    <div class="masonry">

						    <?php

						    while ( $allDomaines->have_posts() ) : $allDomaines->the_post();

						    	$hide = get_field( "hide-into-domaines-page", get_the_ID() );

						    	if(!$hide){

						    		$domainCat = get_field_object( "region-du-domaine", get_the_ID() );

						    		$domaineCatValue = $domainCat['value'];
									$domaineCatLabel = $domainCat['choices'][ $domaineCatValue ];

									if($domaineCatLabel === $region) {

									?>
										<div class="item">
											<h5 class="actu-title">
												<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
											</h5>
										</div>
									<?php
									}
						    	}

							endwhile;

							?>

						    </div>

						    <?php

						}

					?>

			<?php

				else :

			?>

					<p class="no-actu">Désolé, le site <?php echo get_bloginfo('name' ); ?> n'a pas encore de domaines.</p>

			<?php

				endif;

			?>

			</div>

		</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
