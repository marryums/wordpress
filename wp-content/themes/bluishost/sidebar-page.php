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

if ( ! is_active_sidebar( 'bluishost-page-sidebar' ) ) {
	return;
}

// Blog Page Sidebar Start
?>

 <div class="col-lg-4">
 	<aside class="aside">
    	<?php dynamic_sidebar( 'bluishost-page-sidebar' ) ?> 
    </aside>       
</div>