<?php 
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 * Template Name: Blog Right Sidebar
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	//  Call Header
	get_header();

	/**
	 * 
	 * Hook for Blog, single, page, search, archive pages
	 * wrapper start with wrapper div, container, row.
	 *
	 * Hook bluishost_wrp_start
	 *
	 * @Hooked bluishost_wrp_start_cb
	 *  
	 */
	do_action( 'bluishost_wrp_start' );

?>
	<div class="col-lg-4">
	 	<aside class="aside">
	    	<?php dynamic_sidebar( 'bluishost-post-sidebar' ) ?> 
	    </aside>       
	</div>
	<div class="col-lg-8">

<?php
	/**
	 * 
	 * Hook for post or page items wrapper start.
	 *
	 * Hook bluishost_post_items_wrp_start
	 *
	 * @Hooked bluishost_post_items_wrp_start_cb
	 *  
	 */
	do_action( 'bluishost_post_items_wrp_start' );

	$args = array(
		'post_type'    => 'post',
		'posts_per_page' => -6,
		'post_status'  => 'publish'
	);

	$query = new WP_Query( $args );

	if( $query->have_posts() ){
		while( $query->have_posts() ){
			$query->the_post();
			// Post Contant
			get_template_part( 'templates/content', get_post_format() );
		}
		// Reset Data
		wp_reset_postdata();
	}else{
		get_template_part( 'templates/content', 'none' );
	}

	/**
	 * 
	 * Hook for post or page items wrapper end.
	 *
	 * Hook bluishost_post_items_wrp_end
	 *
	 * @Hooked bluishost_post_items_wrp_end_cb
	 *  
	 */
	do_action( 'bluishost_post_items_wrp_end' );

	?>

	</div>

	<?php 
 	
 	/**
	 * Hook for Blog, single, page, search, archive pages
	 * wrapper end with wrapper div, container, row.
 	 *
 	 * Hook bluishost_wrp_end
 	 * @Hooked  bluishost_wrp_end_cb
 	 *
 	 */
 	do_action( 'bluishost_wrp_end' );
 	
	 // Call Footer
	 get_footer();
?>