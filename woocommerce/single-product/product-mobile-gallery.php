 
 <?php
 
    global $post, $product, $shopkeeper_theme_options;

    
    $modal_class = "fresco zoom";
	$zoom_class = "";

	if ( (isset($shopkeeper_theme_options['product_gallery_zoom'])) && ($shopkeeper_theme_options['product_gallery_zoom'] == "1" ) ) {
		$zoom_class = "easyzoom el_zoom";
	}	

//Featured

$featured_image_title 				= esc_html( get_the_title( get_post_thumbnail_id() ) );
$featured_image_src 				= wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
$featured_image_data_src			= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_single' );
$featured_image_data_src_original 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$featured_image_link  				= has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : wc_placeholder_img_src();

$featured_attachment_meta 			= wp_get_attachment(get_post_thumbnail_id());

$post_custom_values 	= get_post_custom( $post->ID );
$page_product_youtube 	= isset($post_custom_values['page_product_youtube']) ? esc_attr( $post_custom_values['page_product_youtube'][0]) : '';
$embed_code 			= wp_oembed_get( $page_product_youtube );


?>

<div class="swiper-container mobile_gallery">
	
    <div class="swiper-wrapper">
       
        <div class="swiper-slide">
			
			<?php if ( has_post_thumbnail() ) { ?>
				<img src="<?php echo esc_url($featured_image_src[0]); ?>" data-src="<?php echo esc_url($featured_image_data_src[0]); ?>" alt="<?php echo $featured_image_title; ?>" class="swiper-lazy wp-post-image">
            <?php } else { ?>
            	<img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" data-src="<?php echo esc_url(wc_placeholder_img_src()); ?>" class="swiper-lazy">
            <?php } ?>
            
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
	                	       
    	</div><!-- /.swiper-slide -->
		
		<?php
        
		// Gallery
        
        $attachment_ids = $product->get_gallery_image_ids();
        
        if ( $attachment_ids ) {
            
            foreach ( $attachment_ids as $attachment_id ) {
    
                $gallery_image_title       			= esc_attr( get_the_title( $attachment_id ) );
                $gallery_image_src         			= wp_get_attachment_image_src( $attachment_id, 'medium' );
				$gallery_image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
				$gallery_image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
				$gallery_image_link        			= wp_get_attachment_url( $attachment_id );
			    
			    $gallery_attachment_meta			= wp_get_attachment($attachment_id);
				
				?>

                <div class="swiper-slide">

                    <img src="<?php echo esc_url($gallery_image_src[0]); ?>" data-src="<?php echo esc_url($gallery_image_data_src[0]); ?>" alt="<?php echo esc_html($gallery_image_title); ?>" class="swiper-lazy">
                    
                    <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    
                </div><!-- /.swiper-slide -->
                
            	<?php
			
            }
            
        }

		// Youtube Video

		if ( $page_product_youtube ) : ?>
			
			<div class="swiper-slide video">
				<a 	data-fresco-group="mobile-gallery" 
					class="<?php echo $modal_class; ?>" 
					href="<?php echo esc_url($page_product_youtube); ?>"
				>
					<i class="spk-icon spk-icon-video-player"></i>
				</a>
			</div>

		<?php endif; ?>
            
	</div> <!-- end swiper-wrapper -->

</div> <!-- end mobile_gallery -->


<div class="swiper-container mobile_gallery_thumbs">
	
    <div class="swiper-wrapper">
       
        <?php if ( $attachment_ids ) {

        	if ( has_post_thumbnail() ) {
            
                $featured_image_src    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
                $bg_img = '<div class="swiper-slide" style="background-image: url('.$featured_image_src[0] . '); "></div> ';
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $bg_img, $post->ID );

            } else {

                $bg_placeholder = '<div class="swiper-slide" style="background-image: url('.wc_placeholder_img_src() . '); "></div> ';
                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $bg_placeholder, $post->ID );

            }

	        $attachment_ids = $product->get_gallery_image_ids();

	            if ( $attachment_ids ) {
	            
	                foreach ( $attachment_ids as $attachment_id ) {

	                    $image          = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
	                    $image_src      = wp_get_attachment_image_src( $attachment_id, 'thumbnail')  ;                 

	                    $bg_img = '<div class="swiper-slide" style="background-image: url('.$image_src[0] . '); "></div> ';

	                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $bg_img, $post->ID );
	                    
	                }

	            }

	            // Youtube Video

	            if ( $page_product_youtube  ) {
	               
	                echo '<div class="swiper-slide youtube"><i class="spk-icon spk-icon-video-player"></i></div>';
	            }
            }

         ?> 

    </div> <!-- end mobile gallery -->

</div> <!-- mobile_gallery_thumbs -->


