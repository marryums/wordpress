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

// Sidebar
if( is_active_sidebar( 'bluishost-woo-sidebar' ) ){
	
	echo '<div class="col-lg-4"><aside>';
		dynamic_sidebar( 'bluishost-woo-sidebar' );
	echo '</aside></div>';
}
?>