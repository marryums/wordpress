<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
/**
 * @Packge    : Bluishost
 * @version   : 1.0
 * @Author    : ThemeLooks
 * @Author URI: https://www.themelooks.com/
 * Template Name: Template WHMCS
 */
 
get_header();
	// enqueuue whmcs page css
	wp_enqueue_style( 'bluishost-whmcs' );
	
	//
    echo '<div id="bluishostWhmcsPage" class="whmcs--bridge">';
        if( have_posts() ){
            while( have_posts() ){
                the_post();
                
                the_content();
            }

        }
    echo '</div>';

get_footer();
?>