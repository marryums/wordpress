<?php 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
/**
 * @Packge    : SinGara
 * @version   : 1.0
 * @Author    : ThemeLooks
 * @Author URI: https://www.themelooks.com/
 */

// demo import file
function bluishost_import_files() {
	
	$demoImg = '<img src="'.trailingslashit( BLUISHOST_DEMO_DIR_URI ) .'screen-image.png" alt="Demo Preview Imgae" />';
	
  return array(
    array(
      'import_file_name'             => 'SinGara Demo',
      'local_import_file'            => trailingslashit( BLUISHOST_DEMO_DIR_PATH ) . 'bluishost-demo.xml',
      'local_import_widget_file'     => trailingslashit( BLUISHOST_DEMO_DIR_PATH ) . 'bluishost-widgets-demo.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( BLUISHOST_DEMO_DIR_PATH ) . 'redux_options_demo.json',
          'option_name' => 'bluishost_opt',
        ),
      ),
      'import_notice' => $demoImg,
    ),
		
	
  );
}
add_filter( 'pt-ocdi/import_files', 'bluishost_import_files' );
	
// demo import setup
function bluishost_after_import_setup() {
	// Assign menus to their locations.
	$main_menu   = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
			'footer-menu'  => $footer_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home V1' );
	$blog_page_id  = get_page_by_title( 'Blog Sidebar Right' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'bluishost_after_import_setup' );

//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function bluishost_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'bluishost' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'bluishost' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'bluishost-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'bluishost_import_plugin_page_setup' );

// Enqueue scripts
function bluishost_demo_import_custom_scripts(){
	
	
	if( isset( $_GET['page'] ) && $_GET['page'] == 'bluishost-demo-import' ){
		// style
		wp_enqueue_style( 'bluishost-demo-import', BLUISHOST_DEMO_DIR_URI.'css/bluishost-demo-import.css', array(), '1.0', false );
	}
	
	
}
add_action( 'admin_enqueue_scripts', 'bluishost_demo_import_custom_scripts' );



?>