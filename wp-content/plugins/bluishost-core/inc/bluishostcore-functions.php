<?php 
 /**
  * @version    1.0
  * @package    SSDHostloud Theme Core Plugin
  * @author     Themelooks <support@themelooks.com>
  *
  * Websites: http://www.themelooks.com
  *
  */

// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit ( 'Direct access denied.' );
}


// Slider Post Type
$args = array(
  'publicly_queryable' => false,
  'menu_icon'      => 'dashicons-editor-insertmore',
    'supports'       => array( 'title' )
);

$args = array(
    'post_type'   => 'bluishost_slider',
    'plural_name'   => 'Sliders',
    'singular_name' => 'Slider',
    'args'        => $args,
);

$type = new Voip_Posttype( $args );


// Gallery Post Type
$gallery = array(
  'publicly_queryable' => true,
  'menu_icon' => 'dashicons-screenoptions',
    'supports' => array( 'title','thumbnail','editor' )
);

$gallery = array(
    'post_type' => 'gallery',
  'plural_name'   => 'Gallery',
    'singular_name' => 'Gallery',
    'args'      => $gallery,
);

$type = new Voip_Posttype( $gallery );

$args = array(
    'taxname'     => 'tab',
  'plural_name'   => 'Tabs',
  'singular_name' => 'Tab',
);
$type->voip_register_taxonomy( $args );

$tagsArgs = array(
    'taxname'     => 'gallery_tag',
  'plural_name'   => 'Tags',
  'singular_name' => 'Tag',
  'taxargs'     => array(
    'hierarchical' => false,
  )
);
$type->voip_register_taxonomy( $tagsArgs );

// Services Post Type
$Services = array(
  'rewrite'            => array( 'slug' => 'services' ),
  'publicly_queryable' => true,
  'menu_icon'      => 'dashicons-screenoptions',
    'supports'       => array( 'title','editor','excerpt', 'thumbnail' )
);

$Services = array(
    'post_type'   => 'bluishost_services',
  'plural_name'   => 'Services',
    'singular_name' => 'Service',
    'args'        => $Services,
);

$type = new Voip_Posttype( $Services );
// Service category
$tagsArgs = array(
    'taxname'     => 'services_cat',
  'plural_name'   => 'Categories',
  'singular_name' => 'Category',

);
$type->voip_register_taxonomy( $tagsArgs );

// Svg Support
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

// svg support
function bluishost_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'bluishost_mime_types' );

// Single Template
add_filter( 'single_template', 'bluishost_template_redirect' );
function bluishost_template_redirect( $single_template ){
  
  global $post;
    
  if( $post->post_type == 'gallery' ){
    $single_template = BLUISHOST_PLUGIN_TEMP . 'single-gallery.php';
  }
  if( $post->post_type == 'bluishost_services' ){
    $single_template = BLUISHOST_PLUGIN_TEMP . 'single-bluishost_services.php';
  }
  
  return $single_template;
}

// Archive Template
add_filter( 'archive_template', 'bluishost_archive_template' );
function bluishost_archive_template( $archive_template ){
  
  global $post;
    
  if( $post ){
    if( $post->post_type == 'gallery' ){
      $archive_template = BLUISHOST_PLUGIN_TEMP . 'archive-gallery.php';
    }
    if( $post->post_type == 'bluishost_services' ){
      $archive_template = BLUISHOST_PLUGIN_TEMP . 'archive-bluishost_services.php';
    }
  }
  return $archive_template;
}


// Subscribe JS File Enqueue
add_action( 'wp_enqueue_scripts', 'bluishost_subscribe_core_enqueue' );
 
// Minapress Section subscribe ajax callback function
add_action( 'wp_ajax_bluishost_subscribe_ajax', 'bluishost_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_bluishost_subscribe_ajax', 'bluishost_subscribe_ajax' );


//Subscribe JS File Enqueue
function bluishost_subscribe_core_enqueue(){
  wp_enqueue_script( 'subscribe-main', BLUISHOST_PLUGINURL. 'js/subscribe.js', array('jquery'), '1.0', true );
   
  wp_localize_script(
    'subscribe-main',
    'subscribeajax',
    array(
       'action_url' => admin_url( 'admin-ajax.php' ),
       'security'   => wp_create_nonce('bluishost')
    )
  );
   
}


function bluishost_subscribe_ajax( ){
     
  $apiKey = bluishost_opt('bluishost_subscribe_apikey');
  $listid = bluishost_opt('bluishost_subscribe_listid');

   
    $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

    if( !empty($apiKey) && !empty($listid) ) {
        if( wp_verify_nonce( $_POST['security'], 'bluishost' ) ) {
          if( $_POST['sectsubscribe_email'] ) {
            $result = $MailChimp->post("lists/{$listid}/members",[
              'email_address'    => $_POST['sectsubscribe_email'],
              'status'           => 'subscribed',
            ]);
          }
        
          if( $_POST['footersubscribe_email'] ) {
              $result = $MailChimp->post("lists/{$listid}/members",[
              'email_address'    => $_POST['footersubscribe_email'],
              'status'           => 'subscribed',
            ]);
          }
          
      
        if ($MailChimp->success()) {
          if( $result['status'] == 'subscribed' ){
              echo '<div class="alert alert-success" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'bluishost').'</div>';
          }
        }elseif( $result['status'] == '400' ) {
          echo '<div class="alert alert-danger" role="alert">'.esc_html__('This Email address is already exists.', 'bluishost').'</div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">'.esc_html__('Sorry something went wrong.', 'bluishost').'</div>';
        }
      } else {
        echo '<div class="alert alert-danger" role="alert">'.esc_html__('You are not allowed.', 'bluishost').'</div>';
      }
    } else {
      echo '<div class="alert alert-danger" role="alert">'.esc_html__('Api key or list id missing.', 'bluishost').'</div>';
    }

    wp_die();       
}

// Mega Menu Auto Style
if ( !function_exists( 'max_mega_menu_is_enabled' ) ) {
  function megamenu_add_theme_bluishost_1543743849($themes) {
    $themes["bluishost_1543743849"] = array(
      'title' => 'Bluishost',
      'container_background_from' => 'rgba(255, 255, 255, 0)',
      'container_background_to' => 'rgba(34, 34, 34, 0)',
      'menu_item_background_hover_from' => 'rgba(34, 34, 34, 0)',
      'menu_item_background_hover_to' => 'rgba(34, 34, 34, 0)',
      'menu_item_spacing' => '44px',
      'menu_item_link_padding_left' => '0px',
      'menu_item_link_padding_right' => '0px',
      'panel_background_from' => 'rgb(255, 255, 255)',
      'panel_background_to' => 'rgb(255, 255, 255)',
      'panel_border_color' => 'rgb(51, 51, 51)',
      'panel_header_border_color' => '#555',
      'panel_padding_top' => '10px',
      'panel_padding_bottom' => '10px',
      'panel_font_size' => '14px',
      'panel_font_color' => 'rgb(255, 255, 255)',
      'panel_font_family' => 'inherit',
      'panel_second_level_font_color' => 'rgb(3, 27, 78)',
      'panel_second_level_font_color_hover' => 'rgb(46, 90, 232)',
      'panel_second_level_text_transform' => 'uppercase',
      'panel_second_level_font' => 'inherit',
      'panel_second_level_font_size' => '14px',
      'panel_second_level_font_weight' => 'bold',
      'panel_second_level_font_weight_hover' => 'bold',
      'panel_second_level_text_decoration' => 'none',
      'panel_second_level_text_decoration_hover' => 'none',
      'panel_second_level_border_color' => 'rgba(255, 255, 255, 0)',
      'panel_third_level_font_color' => '#666',
      'panel_third_level_font_color_hover' => '#666',
      'panel_third_level_text_transform' => 'uppercase',
      'panel_third_level_font' => 'inherit',
      'panel_third_level_font_size' => '14px',
      'panel_third_level_font_weight' => 'bold',
      'flyout_width' => '180px',
      'flyout_menu_background_from' => 'rgb(255, 255, 255)',
      'flyout_menu_background_to' => 'rgb(255, 255, 255)',
      'flyout_padding_top' => '10px',
      'flyout_padding_bottom' => '10px',
      'flyout_link_padding_left' => '20px',
      'flyout_link_padding_right' => '20px',
      'flyout_link_padding_top' => '5px',
      'flyout_link_padding_bottom' => '5px',
      'flyout_link_height' => '18px',
      'flyout_background_from' => 'rgb(255, 255, 255)',
      'flyout_background_to' => 'rgb(255, 255, 255)',
      'flyout_background_hover_from' => 'rgb(255, 255, 255)',
      'flyout_background_hover_to' => 'rgb(255, 255, 255)',
      'flyout_link_size' => '13px',
      'flyout_link_color' => 'rgb(94, 123, 151)',
      'flyout_link_color_hover' => 'rgb(46, 90, 232)',
      'flyout_link_family' => 'inherit',
      'responsive_breakpoint' => '991px',
      'line_height' => '40px',
      'transitions' => 'on',
      'mobile_columns' => '1',
      'toggle_background_from' => 'rgba(255, 255, 255, 0)',
      'toggle_background_to' => 'rgba(255, 255, 255, 0)',
      'mobile_background_from' => 'rgb(255, 255, 255)',
      'mobile_background_to' => 'rgb(255, 255, 255)',
      'mobile_menu_item_link_font_size' => '14px',
      'mobile_menu_item_link_color' => 'rgb(3, 27, 78)',
      'mobile_menu_item_link_text_align' => 'left',
      'mobile_menu_item_link_color_hover' => 'rgb(46, 90, 232)',
      'mobile_menu_item_background_hover_from' => 'rgb(255, 255, 255)',
      'mobile_menu_item_background_hover_to' => 'rgb(255, 255, 255)',
      'custom_css' => '/** Push menu onto new line **/ 
      #{$wrap} { 
          clear: both; 
      }',
    );
    return $themes;
  }
  add_filter("megamenu_themes", "megamenu_add_theme_bluishost_1543743849");
}