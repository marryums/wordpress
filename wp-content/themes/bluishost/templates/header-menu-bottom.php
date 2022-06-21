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

// Page Title Area Start

$headerActive = bluishost_meta( 'slide_header_active' );

if(  $headerActive && 
( is_page_template( 'template-builder.php' ) || 
is_page() ) ){
	
	if( $headerActive  != 'noheader' ){
		
		if( $headerActive  == 'page_header' ){
			
			get_template_part( 'templates/page', 'header' );
			
		}elseif( $headerActive  == 'slider' ){
			
			if( bluishost_meta( 'slider-shortcode' ) ){
				
				$slug = bluishost_meta( 'slider-shortcode' );
										
				$postId = get_page_by_path( $slug, OBJECT , 'bluishost_slider' );
					
				$shortcode = '[slider id="'. esc_html( $postId->ID ) .'"]';
				
				echo do_shortcode( $shortcode );
			}
			
		}else{
			
			if( bluishost_meta( 'slider-customshortcode' ) ){
				echo do_shortcode( bluishost_meta( 'slider-customshortcode' ) );
			}
			
		}
	}

}else{
	get_template_part( 'templates/page', 'header' );
	
}

?>