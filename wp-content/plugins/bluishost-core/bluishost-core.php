<?php

// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit ( 'Direct access denied.' );
}

// Define Constant
define( 'BLUISHOST_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'BLUISHOST_PLUGIN_TEMP', dirname( __FILE__ ).'/bluishost-template/' );

define( 'BLUISHOST_PLUGINURL', plugin_dir_url( __FILE__) );



// load textdomain
load_plugin_textdomain( 'bluishost', false, basename( dirname( __FILE__ ) ) . '/languages' );


//include file.
require_once dirname( __FILE__ ) . '/inc/class-post-type.php';
require_once dirname( __FILE__ ) . '/inc/bluishostcore-functions.php';
require_once dirname( __FILE__ ) . '/inc/slider.php';
require_once dirname( __FILE__ ) . '/inc/MailChimp.php';
require_once dirname( __FILE__ ) . '/inc/bluishostcore-social-share.php';
require_once dirname( __FILE__ ) . '/cmb2-ext/cmb2ext-init.php';
require_once dirname( __FILE__ ) . '/inc/about-widget.php';
require_once dirname( __FILE__ ) . '/inc/contact-form-widget.php';
require_once dirname( __FILE__ ) . '/inc/contact-information-widget.php';
require_once dirname( __FILE__ ) . '/inc/social-widget.php';
require_once dirname( __FILE__ ) . '/inc/subscribe-widget.php';
require_once dirname( __FILE__ ) . '/inc/latest-news-widget.php';

//Add a meta box to the 'pages' post type
function bluishost_shortcode() {

	add_meta_box(
		'shoetcode_meta_box', //unique ID
		esc_html__('Shortcode','bluishost'), //Name shown in the backend
		'bluishost_shortcode_meta_box', //function to output the meta box
		'bluishost_slider', //post type this box will attach to
		'side', //position (side,advanced, normal etc)
		'high' //priority (high, default, low etc)
	);

}
add_action( 'add_meta_boxes','bluishost_shortcode' );


//defines the output for our pages meta box
function bluishost_shortcode_meta_box( $post ){
//create nonce
wp_nonce_field( 'shortcode_meta_box','shortcode_meta_box_nonce' );

//collect related pages (if we already have some)


    $data = '[slider id=&quot;'. esc_html( get_the_ID() ) .'&quot;]';


echo '<input type="text" readonly name="shortcode_meta" value="'.esc_attr( $data ).'" />';

}

//
add_filter( 'manage_edit-bluishost_slider_columns', 'bluishost_edit_bluishost_slider_columns' ) ;

function bluishost_edit_bluishost_slider_columns( $columns ) {

	$columns = array(
		'cb' 		 => '<input type="checkbox" />',
		'title' 	 => esc_html__( 'Slider Name', 'bluishost' ),
		'shortcode'  => esc_html__( 'Shortcode', 'bluishost' ),
		'date'		 => esc_html__( 'Date', 'bluishost' )
	);

	return $columns;
}

add_action( 'manage_bluishost_slider_posts_custom_column', 'bluishost_manage_slider_columns', 10, 2 );

function bluishost_manage_slider_columns( $column, $post_id ) {

	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'shortcode' :
			echo '<code>'.esc_html( '[slider id="'.$post_id.'"]' ).'</code>';
			break;
		default :
			break;
	}
}

// Visual Composer Constant

define('BLUISHOST_PLUGDIRURI', plugin_dir_url( __FILE__ ) );
define('BLUISHOST_PLUGVPATHTEMPDIR', dirname( __FILE__ ) );
define('BLUISHOST_ELEMENTS', dirname( __FILE__ ).'/bluishost-elements/' );

// Elements File include
function bluishost_wpb_elements_inc(){

	// Check is visual composer active
	if( defined( 'WPB_VC_VERSION' ) ){
	// Visual Composer Custom Param Shortcode
	require_once( BLUISHOST_PLUGVPATHTEMPDIR  . '/bluishost-vc-shortcode-param/bluishost-vc-adons.php' );
	// Visual Composer helper function
	require_once( BLUISHOST_PLUGVPATHTEMPDIR . '/vc-include/class-vc-helper.php' );

	// VC Elements Include
	require_once( BLUISHOST_ELEMENTS . 'about.php' );
	require_once( BLUISHOST_ELEMENTS . 'bluishost-section.php' );
	require_once( BLUISHOST_ELEMENTS . 'blog.php' );
	require_once( BLUISHOST_ELEMENTS . 'brand.php' );
	require_once( BLUISHOST_ELEMENTS . 'button.php' );
	require_once( BLUISHOST_ELEMENTS . 'counter.php' );
	require_once( BLUISHOST_ELEMENTS . 'contact-info.php' );
	require_once( BLUISHOST_ELEMENTS . 'contact-schedule.php' );
	require_once( BLUISHOST_ELEMENTS . 'contact-form.php' );
	require_once( BLUISHOST_ELEMENTS . 'domain-extension.php' );
	require_once( BLUISHOST_ELEMENTS . 'domain-search.php' );
	require_once( BLUISHOST_ELEMENTS . 'domain-name.php' );
	require_once( BLUISHOST_ELEMENTS . 'feature.php' );
	require_once( BLUISHOST_ELEMENTS . 'feature-group.php' );
	require_once( BLUISHOST_ELEMENTS . 'map.php' );
	require_once( BLUISHOST_ELEMENTS . 'newsletter.php' );
	require_once( BLUISHOST_ELEMENTS . 'pricing.php' );
	require_once( BLUISHOST_ELEMENTS . 'pricing-filter.php' );
	require_once( BLUISHOST_ELEMENTS . 'section-heading.php' );
	require_once( BLUISHOST_ELEMENTS . 'service.php' );
	require_once( BLUISHOST_ELEMENTS . 'single-reason.php' );
	require_once( BLUISHOST_ELEMENTS . 'testimonial.php' );
	require_once( BLUISHOST_ELEMENTS . 'team-single-el.php' );
	require_once( BLUISHOST_ELEMENTS . 'video.php' );
	require_once( BLUISHOST_ELEMENTS . 'social-icon.php' );
	require_once( BLUISHOST_ELEMENTS . 'facilities.php' );

	} // End Check visual composer

}
add_action( 'init', 'bluishost_wpb_elements_inc', 9 );