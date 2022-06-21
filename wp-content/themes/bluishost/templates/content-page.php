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
<div id="page-<?php the_ID(); ?>" <?php post_class( 'page--item' ); ?>>
	<?php 

	/**
	 * page content 
	 * Comments Template
	 * @Hook  bluishost_page_content
	 *
	 * @Hooked bluishost_page_content_cb
	 * 
	 *
	 */
	do_action( 'bluishost_page_content' );

	?>
</div>