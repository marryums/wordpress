<?php 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
	//  Call Header
	get_header();

	/**
	 * 404 page
	 * @Hook bluishost_fof
	 * @Hooked bluishost_fof_cb
	 *
	 */

	do_action( 'bluishost_fof' );

	 // Call Footer
	 get_footer();
?>