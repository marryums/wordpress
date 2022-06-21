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

$gridOpt	= bluishost_blog_grid();

$colStert = '<div class="col-md-6" data-animate="fadeInUp" data-delay=".1">';
$colEnd   = '</div>';

	if( $gridOpt != '2' && $gridOpt != '3' ){
		$gridOpt = '12';
	}elseif( $gridOpt != '1' && $gridOpt != '3' ){
		$gridOpt = '6';
	}else{
		$gridOpt = '4';
	}

	$colStert = '<div class="col-md-'.esc_attr( $gridOpt ).'" data-animate="fadeInUp" data-delay=".1">';
	$colEnd   = '</div>';

// Post Item Start

echo wp_kses_post( $colStert ); // Column start for blog grid
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?> data-animate="fadeInUp" data-delay=".1">
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
	 * Blog Post title
	 * @Hook  bluishost_blog_posts_title
	 *
	 * @Hooked bluishost_blog_posts_title_cb
	 * 
	 *
	 */
	do_action( 'bluishost_blog_posts_title' );
	
	/**
	 * Blog Excerpt With read more button
	 * @Hook  bluishost_blog_posts_excerpt
	 *
	 * @Hooked bluishost_blog_posts_excerpt_cb
	 * 
	 *
	 */
	do_action( 'bluishost_blog_posts_excerpt' );

	?>
</div>
<?php 
// Post Item End
echo wp_kses_post( $colEnd ); // Column end for blog grid
?>