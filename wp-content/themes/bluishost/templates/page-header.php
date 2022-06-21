<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
} 
/**
 * @Packge     : Bluishost
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
    // Overlay 
	
	if( bluishost_meta( 'slide_header_active' ) == 'page_header' && bluishost_meta( 'page_header_settings' ) == 'pageset' ) {
		$bgoverlay 	= bluishost_meta( 'header_overlay' );
	}else{
		$bgoverlay 	= bluishost_opt( 'bluishost_allHeader_overlay' );
	}

    if( $bgoverlay ){
    	$overlay = ' bg--overlay';
    }else{
    	$overlay = '';
    }

    // Background Image
    $bg = '';
    $page_bg_img = '';
    if( get_header_image() ){
    	$page_bg_img = ' page-title-img';
 		$bg = bluishost_data_bg_attr( get_header_image() );
    }else{
    	if( bluishost_meta( 'slide_header_active' ) == 'page_header' && bluishost_meta( 'page_header_settings' ) == 'pageset' ){
    		$bg = bluishost_data_bg_attr( bluishost_meta( 'header_bgimg' ) );
    	}
    }

    $globalHeader = 'title-bg-dark'.' ';

    $class = 'class="'.esc_attr( $globalHeader.$page_bg_img.$overlay ).'"';

// Page Header Area Start
if( !is_404() ){ ?>
<section <?php echo wp_kses_post( $class.$bg ); ?> >
    <div class="container">
        <?php 
		// Page Header Title	
		echo '<div class="page-title text-white text-center">';	
		if(  is_bluishost_woocommerce_activated() && is_shop() ){
			echo '<h2 data-animate="fadeInUp" data-delay="1.2">';
				woocommerce_page_title();
			echo '</h2>';
			
		}else{

			if ( is_archive() ){
				the_archive_title('<h2 data-animate="fadeInUp" data-delay="1.2">', '</h2>');
			}elseif ( is_home() ){
				echo '<h2 data-animate="fadeInUp" data-delay="1.2">'.esc_html__( 'Blog', 'bluishost' ).'</h2>';
			}elseif(is_search()){
				echo '<h2 data-animate="fadeInUp" data-delay="1.2">'.esc_html__( 'Search Result', 'bluishost' ).'</h2>';
			} else{
				$posttitle_position = bluishost_opt('bluishost_blog_posttitle_position');
				$postTitlePos = false;
				$bluishost_single_blog_title_tag = bluishost_opt("bluishost_blog_posttitle_tag");
				if( is_single() ){

					if( $posttitle_position && $posttitle_position != '1' ){

						$postTitlePos = true;
					}
				}

				if( $postTitlePos != true ){
					if( class_exists('ReduxFramework') ) {
						if( $bluishost_single_blog_title_tag  == 'h2' ) {
							the_title( '<h2 data-animate="fadeInUp" data-delay="1.2">', '</h2>' );
						}else{
							echo bluishost_heading_tag( array(
								"tag"			=> esc_attr( $bluishost_single_blog_title_tag ),
								"text"			=> esc_html( get_the_title() ) ,
								"data-animate"	=> "",	
								"data-delay"	=> "",
							) );
						}
					}else{
						the_title( '<h2 data-animate="fadeInUp" data-delay="1.2">', '</h2>' );
					}
					
				}
				
			}
		}

    	// Page Header Breadcrumb
    	if( bluishost_opt( 'bluishost_enable_breadcrumb' ) ){
	    	echo bluishost_breadcrumbs(
	    		array(
	    			'breadcrumbs_classes' => 'custom-breadcrumb karla list-unstyled m-0',
	    		)
	    	);
    	}
    	?>
		</div>
    </div>
</section>
<?php } ?>