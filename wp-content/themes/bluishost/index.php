<?php 
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
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

	/**
	 * 
	 * Hook for Blog, single, search, archive pages
	 * column start.
	 *
	 * Hook bluishost_blog_col_start
	 *
	 * @Hooked bluishost_blog_col_start_cb
	 *  
	 */
	do_action( 'bluishost_blog_col_start' );

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

	if( have_posts() ){
		while( have_posts() ){
			the_post();
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

	/**
	 * 
	 * Hook for Blog, single, search, archive pages
	 * column end.
	 *
	 * Hook bluishost_blog_col_end
	 *
	 * @Hooked bluishost_blog_col_end_cb
	 *  
	 */
	do_action( 'bluishost_blog_col_end' );

	/**
	 * 
	 * Hook for Blog, single blog, search, archive pages sidebar.
	 *
	 * Hook bluishost_blog_sidebar
	 *
	 * @Hooked bluishost_blog_sidebar_cb
	 *  
	 */
	do_action( 'bluishost_blog_sidebar' );
 	
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