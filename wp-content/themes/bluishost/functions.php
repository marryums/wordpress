<?php
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */

	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	/**
	 *
	 * Define constant
	 *
	 */

	// Base URI
	if( !defined( 'BLUISHOST_DIR_URI' ) )
		define( 'BLUISHOST_DIR_URI', get_template_directory_uri().'/' );

	// Assist URI
	if( !defined( 'BLUISHOST_DIR_ASSIST_URI' ) )
		define( 'BLUISHOST_DIR_ASSIST_URI', BLUISHOST_DIR_URI.'assets/' );

	// Images File URI
	if( !defined( 'BLUISHOST_DIR_IMG_URI' ) )
		define( 'BLUISHOST_DIR_IMG_URI', BLUISHOST_DIR_ASSIST_URI.'img/' );

	// Css File URI
	if( !defined( 'BLUISHOST_DIR_CSS_URI' ) )
		define( 'BLUISHOST_DIR_CSS_URI', BLUISHOST_DIR_ASSIST_URI .'css/' );

	// Js File URI
	if( !defined( 'BLUISHOST_DIR_JS_URI' ) )
		define( 'BLUISHOST_DIR_JS_URI', BLUISHOST_DIR_ASSIST_URI .'js/' );

	// Base Directory
	if( !defined( 'BLUISHOST_DIR_PATH' ) )
		define( 'BLUISHOST_DIR_PATH', get_parent_theme_file_path().'/' );

	//Inc Folder Directory
	if( !defined( 'BLUISHOST_DIR_PATH_INC' ) )
		define( 'BLUISHOST_DIR_PATH_INC', BLUISHOST_DIR_PATH.'inc/' );

	//Inc Folder Directory
	if( !defined( 'BLUISHOST_REDUX_DIR_PATH_INC' ) )
		define( 'BLUISHOST_REDUX_DIR_PATH_INC', BLUISHOST_DIR_URI.'inc/redux-custom-field/assist/' );

	//Bluishost framework Folder Directory
	if( !defined( 'BLUISHOST_DIR_PATH_FRAM' ) )
		define( 'BLUISHOST_DIR_PATH_FRAM', BLUISHOST_DIR_PATH_INC.'bluishost-framework/' );

	//Classes Folder Directory
	if( !defined( 'BLUISHOST_DIR_PATH_CLASSES' ) )
		define( 'BLUISHOST_DIR_PATH_CLASSES', BLUISHOST_DIR_PATH_INC.'classes/' );

	//Hooks Folder Directory
	if( !defined( 'BLUISHOST_DIR_PATH_HOOKS' ) )
		define( 'BLUISHOST_DIR_PATH_HOOKS', BLUISHOST_DIR_PATH_INC.'hooks/' );

	//Demo Data Folder Directory Path
	if( !defined( 'BLUISHOST_DEMO_DIR_PATH' ) )
		define( 'BLUISHOST_DEMO_DIR_PATH', BLUISHOST_DIR_PATH_FRAM.'demo-data/' );

	//Demo Data Folder Directory URI
	if( !defined( 'BLUISHOST_DEMO_DIR_URI' ) )
		define( 'BLUISHOST_DEMO_DIR_URI', BLUISHOST_DIR_URI.'inc/bluishost-framework/demo-data/' );

	add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );


	/**
	 * Include File
	 *
	 */

	require_once( BLUISHOST_DIR_PATH_INC . 'bluishost-breadcrumbs.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'bluishost-widgets-reg.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'wp_bootstrap_navwalker.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'bluishost-functions.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'bluishost-commoncss.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'support-functions.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'redux-custom-field/fa-icons.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'redux-custom-field/bluishost-option-slide-add-field.php' );

	require_once( BLUISHOST_DIR_PATH_INC . 'wp-html-helper.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'wp_bootstrap_pagination.php' );
	require_once( BLUISHOST_DIR_PATH_INC . 'bluishost-woo-functions.php' );
	require_once( BLUISHOST_DIR_PATH_FRAM . 'bluishost-meta/bluishost-config.php' );
	require_once( BLUISHOST_DIR_PATH_FRAM . 'plugins-activation/bluishost-active-plugins.php' );
	require_once( BLUISHOST_DIR_PATH_FRAM . 'bluishost-options/bluishost-option.php' );
	require_once( BLUISHOST_DIR_PATH_CLASSES . 'Class-Enqueue.php' );
	require_once( BLUISHOST_DIR_PATH_CLASSES . 'Class-Config.php' );
	require_once( BLUISHOST_DIR_PATH_HOOKS . 'hooks.php' );
	require_once( BLUISHOST_DIR_PATH_HOOKS . 'hooks-functions.php' );


	// Bluishost theme support
	add_action( 'after_setup_theme', 'bluishost_themesupport' );
	function bluishost_themesupport(){
		global $bluishost;
		$bluishost['bluishostobj'] = new Bluishost();
		$bluishostobj = $bluishost['bluishostobj'];
		$bluishostobj->support();
	}

	// Bluishost theme init
	add_action( 'init', 'bluishost_init' );
	function bluishost_init(){
		global $bluishost;
		$bluishost['bluishostobj'] = new Bluishost();
		$bluishostobj = $bluishost['bluishostobj'];
		$bluishostobj->init();
	}

