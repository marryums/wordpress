<?php
// Cmb 2 Admin Script
add_action( 'admin_enqueue_scripts', 'bluishost_cmb2_admin_scripts' );
function bluishost_cmb2_admin_scripts(){
	
	wp_enqueue_script( 'bluishost-admin',  plugins_url( 'js/bluishost-admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-slider' ), '1.0', true );
	
}
// Custom Field 
require_once ( BLUISHOST_PLUGIN_PATH.'cmb2-ext/custom_metafield.php');
// Slider Field 
require_once ( BLUISHOST_PLUGIN_PATH.'cmb2-ext/slider_metafield.php');

// Cmb2 Tabs
require_once ( BLUISHOST_PLUGIN_PATH.'cmb2-ext/cmb2-tabs/CMB2-Tabs.php');
