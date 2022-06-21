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

	/**
	 *
	 * Before Wrapper
	 *
	 * @Preloader
	 *
	 */
	add_action( 'bluishost_preloader', 'bluishost_site_preloader', 10 );

	/**
	 * Header
	 *
	 * @Header Menu
	 * @Header Bottom
	 * 
	 */

	add_action( 'bluishost_header', 'bluishost_header_cb', 10 );

	/**
	 * Hook for footer
	 *
	 */
	add_action( 'bluishost_footer', 'bluishost_footer_area', 10 );

	/**
	 * Hook for Blog, single, page, search, archive pages wrapper.
	 */
	add_action( 'bluishost_wrp_start', 'bluishost_wrp_start_cb', 10 );
	add_action( 'bluishost_wrp_end', 'bluishost_wrp_end_cb', 10 );

	/**
	 * Hook for Blog, single, search, archive pages column.
	 */
	add_action( 'bluishost_blog_col_start', 'bluishost_blog_col_start_cb', 10 );
	add_action( 'bluishost_blog_col_end', 'bluishost_blog_col_end_cb', 10 );

	/**
	 * Hook for post or page items wrapper.
	 */
	add_action( 'bluishost_post_items_wrp_start', 'bluishost_post_items_wrp_start_cb', 10 );
	add_action( 'bluishost_post_items_wrp_end', 'bluishost_post_items_wrp_end_cb', 10 );

	/**
	 * Hook for blog posts thumbnail.
	 */
	add_action( 'bluishost_blog_posts_thumb', 'bluishost_blog_posts_thumb_cb', 10 );

	/**
	 * Hook for blog posts title.
	 */
	add_action( 'bluishost_blog_posts_title', 'bluishost_blog_posts_title_cb', 10 );

	/**
	 * Hook for blog posts meta.
	 */
	add_action( 'bluishost_blog_posts_meta', 'bluishost_blog_posts_meta_cb', 10 );

	/**
	 * Hook for blog posts excerpt.
	 */
	add_action( 'bluishost_blog_posts_excerpt', 'bluishost_blog_posts_excerpt_cb', 10 );

	/**
	 * Hook for blog posts content.
	 */
	add_action( 'bluishost_blog_posts_content', 'bluishost_blog_posts_content_cb', 10 );

	/**
	 * Hook for blog sidebar.
	 */
	add_action( 'bluishost_blog_sidebar', 'bluishost_blog_sidebar_cb', 10 );
	
	/**
	 * Hook for blog single post social share option.
	 */
	add_action( 'bluishost_blog_posts_share', 'bluishost_blog_posts_share_cb', 10 );
	
	/**
	 * Hook for blog single post meta category, tag, next - previous link and comments form.
	 */
	add_action( 'bluishost_blog_single_meta', 'bluishost_blog_single_meta_cb', 10 );
	
	/**
	 * Hook for page content.
	 */
	add_action( 'bluishost_page_content', 'bluishost_page_content_cb', 10 );
	
	/**
	 * Hook for page sidebar.
	 */
	add_action( 'bluishost_page_sidebar', 'bluishost_page_sidebar_cb', 10 );
	
	/**
	 * Hook for 404 page.
	 */
	add_action( 'bluishost_fof', 'bluishost_fof_cb', 10 );

?>