<?php 

define( 'BLUISHOST_SHORTCODEPARMDIR', dirname( __FILE__ ).'/' );
define( 'BLUISHOST_SHORTCODEPARMCSS', plugins_url( __FILE__ ).'/css/' );
define( 'BLUISHOST_SHORTCODEPARMJS', plugins_url( __FILE__ ).'/js/' );


// Visual Composer Admin Script load
if( is_admin() ){
add_action( 'vc_backend_editor_render', 'admin_sc' );	
add_action( 'vc_frontend_editor_render', 'admin_sc' );	
}
function admin_sc( $hook ){
	
	wp_enqueue_style( 'vc-adons', plugins_url( '/css/adons.css', __FILE__ ), array(), '1.0' );
	
	wp_enqueue_style( 'image-pickerwrw', plugins_url( '/css/image-picker.css', __FILE__ ), array(), '30.3' );
			
	wp_enqueue_script( 'image-pickerwr', plugins_url( '/js/image-picker.jquery.min.js', __FILE__ ), array('jquery'), '20.0', true );
		
	wp_enqueue_script( 'vc_admin_scriptsr', plugins_url( '/js/vc_admin_scripts.js', __FILE__ ), array('jquery'), '10.0', true );
		
}
// VC Admin init hook
add_action( 'vc_build_admin_page', 'bluishost_custom_param_type' );
function bluishost_custom_param_type(){
	
	require_once( BLUISHOST_SHORTCODEPARMDIR  . 'bluishost_floatn_number.php' );
	require_once( BLUISHOST_SHORTCODEPARMDIR  . 'bluishost-font-container-param.php' );
	require_once( BLUISHOST_SHORTCODEPARMDIR  . 'imgradio.php' );
	require_once( BLUISHOST_SHORTCODEPARMDIR  . 'bluishost_divider.php' );
	require_once( BLUISHOST_SHORTCODEPARMDIR  . 'bluishost_overlay.php' );
}

?>