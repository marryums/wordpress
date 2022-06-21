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

?>
<!-- Post Item Start -->
<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-details' ); ?>>

	<?php 

	/**
	 * Blog Post thumbnail
	 * @Hook  bluishost_blog_posts_thumb
	 *
	 * @Hooked bluishost_blog_posts_thumb_cb
	 * 
	 *
	 */
	do_action( 'bluishost_blog_posts_thumb' );

	/**
	 * Blog Post Meta
	 * @Hook  bluishost_blog_posts_meta
	 *
	 * @Hooked bluishost_blog_posts_meta_cb
	 * 
	 *
	 */
	do_action( 'bluishost_blog_posts_meta' );
	
	/**
	 * Blog single page content 
	 * Post social share
	 * @Hook  bluishost_blog_posts_content
	 *
	 * @Hooked bluishost_blog_posts_content_cb
	 * 
	 *
	 */
	do_action( 'bluishost_blog_posts_content' );
	?>
</div>
<?php 
/**
 * Blog single post meta category, tag, next - previous link, comments form
 * and biography
 * @Hook  bluishost_blog_single_meta
 * 
 * @Hooked bluishost_blog_single_meta_cb
 * 
 *
 */
do_action( 'bluishost_blog_single_meta' );

?>