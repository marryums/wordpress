<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( get_template_directory() . '/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/cmb2/init.php';
} elseif ( file_exists( get_template_directory() . '/CMB2/init.php' ) ) {
	require_once get_template_directory() . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function bluishost_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function bluishost_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function bluishost_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function bluishost_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo esc_html( $field->escaped_value() ); ?></p>
		<p class="description"><?php echo esc_attr( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function bluishost_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'bluishost_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function bluishost_register_metabox() {
	$prefix = '_bluishost_';
	$prefixpage = '_bluishostpage_';
    
    /********************************\
        page layout select meta 
    \********************************/
    
	$bluishost_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_layout_section',
		'title'         => esc_html__( 'Page Layout', 'bluishost' ),
        'context' => 'side',
        'priority' => 'high',
		'object_types'  => array( 'page' ), // Post type
	) );

	$bluishost_meta->add_field( array(
		'id'         => $prefix . 'custom_page_layout',
		'type'       => 'radio',
		'desc'       => esc_html__( 'Set page layout container,container fluid,fullwidth or both. It\'s work only in template builder page.', 'bluishost' ),
        'options' => array(
            '1' => 'Container',
            '2' => 'Container Fluid',
            '3' => 'Fullwidth',
        ),
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Top and Bottom Padding', 'bluishost' ),
		'id'   => $prefix . 'custom_page_padding',
		'type' => 'own_slider',
		'min'         => '0',
		'max'         => '500',
		'step'        => '1',
		'default'     => '0', // start value
		'value_label' => 'Value:',
        'desc' => esc_html__( 'Set page content wrapper top and bottom padding.', 'bluishost' ),
	));
    /********************************\
        Custom Page Settings 
    \********************************/
	$bluishost_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'sliderPageheader_section',
		'title'         => esc_html__( 'Custom Page Settings', 'bluishost' ),
		'object_types'  => array( 'page' ), // Post type
		'tabs'      	=> array(
			'general' 	=> array(
				'label' => __( 'General', 'bluishost' ),
				'icon'  => 'dashicons-admin-generic', // Dashicon
			),
			'headerSetting'  	=> array(
				'label' => __( 'Header Settings', 'bluishost' ),
				'icon'  => 'dashicons-editor-insertmore', // Dashicon
			),
			'footerSetting'  	=> array(
				'label' => __( 'Footer Settings', 'bluishost' ),
				'icon'  => 'dashicons-editor-insertmore', // Dashicon
			)
		),
		'closed'		=> true,
		'tab_style'   	=> 'default',
	) );

	/********************************\
        General Settings 
    \********************************/

	$bluishost_meta->add_field( array(
        'name'             => esc_html__( 'Slider/Page Header Active', 'bluishost' ),
        'desc'             => 'Select an option',
        'id'               => $prefix . 'slide_header_active',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => 'page_header',
        'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
        'options'          => array(
            'noheader'     => esc_html__( 'No Header', 'bluishost' ),
            'slider'       => esc_html__( 'Slider', 'bluishost' ),
            'page_header'  => esc_html__( 'Page Header', 'bluishost' ),
            'customslider' => esc_html__( 'Custom Slider', 'bluishost' ),
        ),
    ) );
	$bluishost_meta->add_field(  array(
        'name'           => esc_html__( 'Custom Slider', 'bluishost' ),
        'desc'           => esc_html__( 'Set custom slider shortcode.', 'bluishost' ),
        'classes'        => 'slider-customShortcode',
        'id'             => $prefix . 'slider-customshortcode',
        'type'           => 'text',
        'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
    ) );
	// Slider Select 
	$bluishost_meta->add_field(  array(
        'name'           => esc_html__( 'Slider', 'bluishost' ),
        'desc'           => esc_html__( 'Set slider.', 'bluishost' ),
        'classes'        => 'slider-settings',
        'id'             => $prefix . 'slider-shortcode',
        'type'           => 'select',
        'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
        // Use a callback to avoid performance hits on pages where this field is not displayed (including the front-end).
        'options_cb'     => 'bluishost_get_slider_shortcode_options',
        // Same arguments you would pass to `get_terms`.
        'get_post_type' => array(
            	'post_type'   => 'bluishost_slider',
            ),
    ) );
	$bluishost_meta->add_field( array(
        'name'             => esc_html__( 'Page Header Settings', 'bluishost' ),
        'desc'             => 'Select page header settings type. Global settings set from theme options.',
        'id'               => $prefix . 'page_header_settings',
        'type'             => 'select',
        'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
        'classes'          => 'pageset page-header-settings',
        'show_option_none' => false,
        'default'          => 'global',
        'options'          => array(
            'pageset'       => esc_html__( 'Page Settings', 'bluishost' ),
            'global'        =>  esc_html__( 'Global Settings', 'bluishost' ),
        ),
    ) );

	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Header Background Color', 'bluishost' ),
		'id'   => $prefix . 'header-bgcolor',
		'type' => 'colorpicker',
		'classes' => 'pageset page-setting',
		'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Background Image', 'bluishost' ),
		'desc' => esc_html__( 'Set background image.', 'bluishost' ),
		'id'   => $prefix . 'header_bgimg',
        'classes' => 'pageset page-setting',
		'type' => 'file',
		'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Overlay', 'bluishost' ),
		'desc' => esc_html__( 'Set overlay.', 'bluishost' ),
		'id'   => $prefix . 'header_overlay',
        'classes' => 'pageset page-setting',
		'type' => 'checkbox',
		'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Overlay Color', 'bluishost' ),
		'desc' => esc_html__( 'Set overlay color.', 'bluishost' ),
		'id'   => $prefix . 'header_overlaycolor',
        'classes' => 'pageset page-setting',
		'type' => 'colorpicker',
		'default' => '#000000',
		'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Overlay Opacity', 'bluishost' ),
		'desc' => esc_html__( 'Set overlay opacity.', 'bluishost' ),
		'id'   => $prefix . 'header_overlayopacity',
        'classes' => 'pageset page-setting',
		'type' => 'own_slider',
		'min'         => '0',
		'max'         => '1',
		'step'        => '0.1',
		'default'     => '0', // start value
		'value_label' => 'Value:',
        'desc' => esc_html__( 'Default opacity 0.5', 'bluishost' ),
        'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Header Text Color', 'bluishost' ),
		'id'   => $prefix . 'header-textcolor',
		'classes' => 'pageset page-setting',
		'type' => 'colorpicker',
		'tab'  			   => 'general',
		'render_row_cb'    => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));

	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Display Body Gradient Color', 'bluishost'),
		'id'	  		=> $prefix . 'body_gradient_color_trigger',
		'desc'        	=> esc_html__('Switch On Display Body Gradient Color','bluishost'),
		'type'    		=> 'switch',
		'default'    	=> 0,
		'label'    		=> array('on'=> 'Show', 'off'=> 'Hide'), //default On, Off
		'tab'  			=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Body Gradient Color One', 'bluishost'),
		'id'	  		=> $prefix . 'body_gradient_color_one',
		'desc'        	=> esc_html__('Set Body Gradient Color One','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Body Gradient Color Two', 'bluishost'),
		'id'	  		=> $prefix . 'body_gradient_color_two',
		'desc'        	=> esc_html__('Set Body Gradient Color Two','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Display Body Background Color', 'bluishost'),
		'id'	  		=> $prefix . 'body_bg_trigger',
		'desc'        	=> esc_html__('Switch On Display Body Background','bluishost'),
		'type'    		=> 'switch',
		'default'    	=> 0,
		'label'    		=> array('on'=> 'Show', 'off'=> 'Hide'), //default On, Off
		'tab'  			=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Body Background Color', 'bluishost'),
		'id'	  		=> $prefix . 'body_bg_color',
		'desc'        	=> esc_html__('Set Body Background Color','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Display Body Pattern', 'bluishost'),
		'id'	  		=> $prefix . 'body_pattern_trigger',
		'desc'        	=> esc_html__('Switch On Display Body Pattern','bluishost'),
		'type'    		=> 'switch',
		'default'    	=> 0,
		'label'    		=> array('on'=> 'Show', 'off'=> 'Hide'), //default On, Off
		'tab'  			=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Body Pattern', 'bluishost' ),
		'id'   => $prefix . 'body-patternbg',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));

	/********************************\
        Header Settings 
    \********************************/

	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Header Layout Switcher', 'bluishost'),
		'id'	  		=> $prefix . 'header_layout_switcher',
		'desc'        	=> esc_html__('Show Means Custom Layout Settings and Hide Means Global Layout Settings. If You Select Hide Then It Will Control From Theme Option ( Default Setting Hide ).','bluishost'),
		'type'    		=> 'switch',
		'default'    	=> 1,
		'label'    		=> array('on'=> 'Show', 'off'=> 'Hide'), //default On, Off
		'tab'  			=> 'headerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(	
	    'name' 			=> __('Header Layout', 'bluishost'),
	    'desc' 			=> __('Select header layout.', 'bluishost'),
	    'id'      		=> $prefix . 'header_custom_layout',
	    'type' 			=> 'image_select',
	    'tab'  			=> 'headerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	    'options' 		=> array(
	        '1' 		=> array('alt' => 'Full Width', 'img' => get_template_directory_uri().'/assets/img/header-1.png'),
	        '2' 	=> array('alt' => 'Sidebar Left', 'img' => get_template_directory_uri().'/assets/img/header-2.png'),
	        '3' => array('alt' => 'Sidebar Right', 'img' => get_template_directory_uri().'/assets/img/header-3.png'),
	        '4' => array('alt' => 'Both Sidebars', 'img' => get_template_directory_uri().'/assets/img/header-4.png'),
	        '5' => array('alt' => 'Both Sidebars', 'img' => get_template_directory_uri().'/assets/img/header-5.png'),
	        '6' => array('alt' => 'Both Sidebars', 'img' => get_template_directory_uri().'/assets/img/header-6.png'),
	        '7' => array('alt' => 'Both Sidebars', 'img' => get_template_directory_uri().'/assets/img/header-7.png'),
	        '8' => array('alt' => 'Both Sidebars', 'img' => get_template_directory_uri().'/assets/img/header-8.png'),
	    ),
	    'default' => '1',    
	) );

	/********************************\
        Footer Settings
    \********************************/

    $bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer Layout Switcher', 'bluishost'),
		'id'	  		=> $prefix . 'footer_layout_switcher',
		'desc'        	=> esc_html__('Show Means Custom Layout Settings and Hide Means Global Layout Settings. If You Select Hide Then It Will Control From Theme Option ( Default Setting Hide ).','bluishost'),
		'type'    		=> 'switch',
		'default'    	=> 0,
		'label'    		=> array('on'=> 'Show', 'off'=> 'Hide'), //default On, Off
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(	
	    'name' 			=> __('Footer Layout', 'bluishost'),
	    'desc' 			=> __('Select footer layout.', 'bluishost'),
	    'id'      		=> $prefix . 'footer_custom_layout',
	    'type' 			=> 'image_select',
	    'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	    'options' 		=> array(
	        '1' 		=> array('alt' => 'Footer Style One', 'img' => get_template_directory_uri().'/assets/img/footer_style_1.png'),
	        '2' 	=> array('alt' => 'Footer Style Two', 'img' => get_template_directory_uri().'/assets/img/footer_style_2.png'),
	        '3' 	=> array('alt' => 'Footer Style Three', 'img' => get_template_directory_uri().'/assets/img/footer_style_3.png'),
	    ),
	    'default' => '2', 
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer Back to Top Button Switcher', 'bluishost'),
		'id'	  		=> $prefix . 'footer_back_to_top_button_switcher',
		'desc'        	=> esc_html__('Show footer back to top button  ( Default Setting Hide ).','bluishost'),
		'type'    		=> 'switch',
		'default'    	=> 0,
		'label'    		=> array('on'=> 'Show', 'off'=> 'Hide'), //default On, Off
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Back to Top Style', 'bluishost' ),
		'id'   => $prefix . 'back_to_top',
		'type' => 'select',
		'options'	=> array(
			'1'			=> esc_html__('Style One','bluishost'),
			'2'			=> esc_html__('Style Two','bluishost'),
			'3'			=> esc_html__('Style Three','bluishost'),
		),
		'tab'  		=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer Widget Title Color', 'bluishost'),
		'id'	  		=> $prefix . 'footer_widget_title_color',
		'desc'        	=> esc_html__('Set Footer Widget Title Color','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer widget color', 'bluishost'),
		'id'	  		=> $prefix . 'footer_widget_color',
		'desc'        	=> esc_html__('Set Footer Text Color','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer Widget Anchor Color', 'bluishost'),
		'id'	  		=> $prefix . 'footer_widget_anchor_color',
		'desc'        	=> esc_html__('Set Footer Widget Anchor Color','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer Widget Anchor Hover Color', 'bluishost'),
		'id'	  		=> $prefix . 'footer_widget_anchor_hover_color',
		'desc'        	=> esc_html__('Set Footer Widget Anchor Hover Color','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer Gradient Color One', 'bluishost'),
		'id'	  		=> $prefix . 'footer_gradient_color_one',
		'desc'        	=> esc_html__('Set Footer Gradient Color One','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer Gradient Color Two', 'bluishost'),
		'id'	  		=> $prefix . 'footer_gradient_color_two',
		'desc'        	=> esc_html__('Set Footer Gradient Color Two','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name'        	=> esc_html__('Footer Background Color', 'bluishost'),
		'id'	  		=> $prefix . 'footer_bg_color',
		'desc'        	=> esc_html__('Set Footer Background Color','bluishost'),
		'type'    		=> 'colorpicker',
		'tab'  			=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Footer Background Pattern', 'bluishost' ),
		'id'   => $prefix . 'footer-patternbg',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
		'tab'  		=> 'footerSetting',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));

    /***************************************************************\
                            Post type meta
    \***************************************************************/
    
    
    /******************\
      Slider section 
    \******************/


   $slider_meta = new_cmb2_box( array(
		'id'           => $prefix . 'slider-extra_info',
		'title'        => __( 'Slider Info' ,'bluishost' ),
		'object_types' => array( 'bluishost_slider', ), // Post type
		'tabs'      => array(
			'general' => array(
				'label' => __( 'General', 'bluishost' ),
				'icon'  => 'dashicons-admin-generic', // Dashicon
			),
			'slider1'  => array(
				'label' => __( 'Slider One', 'bluishost' ),
				'icon'  => 'dashicons-admin-settings', // Dashicon
			),
			'slider2'  => array(
				'label' => __( 'Slider Two', 'bluishost' ),
				'icon'  => 'dashicons-admin-settings', // Dashicon
			),
			'slider3'  => array(
				'label' => __( 'Slider Three', 'bluishost' ),
				'icon'  => 'dashicons-admin-settings', // Dashicon
			)
		),
		'closed'	=> true,
		'tab_style'   => 'default',
	) );

    
	
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Slider Version', 'bluishost' ),
		'id'   => $prefix . 'slider-version',
		'type' => 'select',
		'options'	=> array(
			'1'			=> esc_html__('Slider One','bluishost'),
			'2'			=> esc_html__('Slider Two','bluishost'),
			'3'			=> esc_html__('Slider Three','bluishost'),
		),
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
		'name' => esc_html__( 'General Background Image', 'bluishost' ),
		'id'   => $prefix . 'slider-genbg',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
		'name' => esc_html__( 'General Video Background', 'bluishost' ),
		'desc' => esc_html__( 'Set youtube video id.', 'bluishost' ),
		'id'   => $prefix . 'slider-videobg',
		'classes' => '',
		'type' => 'text',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));	
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Overlay', 'bluishost' ),
		'desc' => esc_html__( 'Set overlay.', 'bluishost' ),
		'id'   => $prefix . 'slider-genbgov',
        'classes' => '',
		'type' => 'checkbox',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Overlay Color', 'bluishost' ),
		'desc' => esc_html__( 'Set overlay color.', 'bluishost' ),
		'id'   => $prefix . 'slider_genoverlaycolor',
        'classes' => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Overlay Opacity', 'bluishost' ),
		'desc' => esc_html__( 'Set overlay opacity.', 'bluishost' ),
		'id'   => $prefix . 'slider_genoverlayopacity',
        'classes' => '',
		'type' => 'own_slider',
		'min'         => '0',
		'max'         => '1',
		'step'        => '0.1',
		'default'     => '0', // start value
		'value_label' => 'Value:',
        'desc' => esc_html__( 'Default opacity 0.5', 'bluishost' ),
        'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));

	$slider_meta->add_field( array(
		'name' => esc_html__( 'Background Color', 'bluishost' ),
		'id'   => $prefix . 'slider-slidBgColor',
		'desc' => esc_html__( 'Set banner background color.', 'bluishost' ),
		'classes'     => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));

	$slider_meta->add_field( array(
		'name' => esc_html__( 'Text Color', 'bluishost' ),
		'id'   => $prefix . 'slider-slidTextColor',
		'desc' => esc_html__( 'Set banner text color.', 'bluishost' ),
		'classes'     => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	// Button media options
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Button Text Color', 'bluishost' ),
		'id'   => $prefix . 'slider-slidBtnTextColor',
		'desc' => esc_html__( 'Set banner button text color.', 'bluishost' ),
		'classes'     => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Button Background Color', 'bluishost' ),
		'id'   => $prefix . 'slider-slidBtnBgColor',
		'desc' => esc_html__( 'Set banner button background color.', 'bluishost' ),
		'classes'     => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Button Border Color', 'bluishost' ),
		'id'   => $prefix . 'slider-sliderbtnBorderColor',
		'desc' => esc_html__( 'Set banner button border color.', 'bluishost' ),
		'classes'     => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	// Button hover media options
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Button Hover Text Color', 'bluishost' ),
		'id'   => $prefix . 'slider-slidBtnhovTextColor',
		'desc' => esc_html__( 'Set banner button hover text color.', 'bluishost' ),
		'classes'     => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Button Hover Background Color', 'bluishost' ),
		'id'   => $prefix . 'slider-slidBtnhovBgColor',
		'desc' => esc_html__( 'Set banner button hover background color.', 'bluishost' ),
		'classes'     => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
		'name' => esc_html__( 'Button Hover Border Color', 'bluishost' ),
		'id'   => $prefix . 'slider-sliderbtnhovBorderColor',
		'desc' => esc_html__( 'Set banner button hover border color.', 'bluishost' ),
		'classes'     => '',
		'type' => 'colorpicker',
		'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
	));
	$slider_meta->add_field( array(
        'name'             => esc_html__( 'Button Link Behaviour', 'bluishost' ),
        'id'               => $prefix . 'slider-linkbehaviour',
        'type'             => 'select',
        'classes'          => '',
        'default'          => 'samepage',
        'options'          => array(
            'samepage'     => esc_html__( 'Same Page', 'bluishost' ),
            'newtab'       => esc_html__( 'New Tab', 'bluishost' ),
        ),
        'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
    ));
    $slider_meta->add_field( array(
        'name'             => esc_html__( 'Slider Dots', 'bluishost' ),
        'id'               => $prefix . 'slider-dots',
        'type'             => 'select',
        'classes'          => '',
        'default'          => 'false',
        'options'          => array(
            'true'     => esc_html__( 'Enable', 'bluishost' ),
            'false'    => esc_html__( 'Disable', 'bluishost' ),
        ),
        'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
    ));
    $slider_meta->add_field( array(
        'name'             => esc_html__( 'Slider Navs', 'bluishost' ),
        'id'               => $prefix . 'slider-navs',
        'type'             => 'select',
        'classes'          => '',
        'default'          => 'false',
        'options'          => array(
            'true'     => esc_html__( 'Enable', 'bluishost' ),
            'false'    => esc_html__( 'Disable', 'bluishost' ),
        ),
        'tab'  		=> 'general',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
    ));



	// Slider One Group
	$group_field_id = $slider_meta->add_field( array(
		'id'          => $prefix . 'sliderone-group-options',
        'classes'     => '',
		'type'        => 'group',
		'repeatable' => true,
		// 'description' => esc_html__( 'Add Slider', 'bluishost' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Slider {#}', 'bluishost' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Slider', 'bluishost' ),
			'remove_button' => esc_html__( 'Remove Slider', 'bluishost' ),
			'sortable'      => false, // beta
			'closed'     => false, // true to have the groups closed by default
		),
		'tab'  		=> 'slider1',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_group_row_cb' ),
	) );

    // Slider Content group
    $slider_meta->add_group_field( $group_field_id, array(
		'name' 		=> esc_html__( 'Title Tag', 'bluishost' ),
		'id'   		=> $prefix . 'slider-title-tag',
		'classes' 	=> '',
		'type' 		=> 'select',
		'options' 	=> array(
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',

		),
		'default' 	=> 'h2'
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Title', 'bluishost' ),
		'id'   => $prefix . 'slider-title-one',
		'classes' => '',
		'type' => 'textarea_small',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Descriptions', 'bluishost' ),
		'id'   => $prefix . 'slider-descriptions',
		'classes' => '',
		'type' => 'textarea_small',
	) );
	
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button One Text', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton01-text',
		'classes' => '',
		'type' => 'text',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button One Url', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton01-url',
		'classes' => '',
		'type' => 'text',
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Two Text', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton02-text',
		'classes' => '',
		'type' => 'text',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Two Url', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton02-url',
		'classes' => '',
		'type' => 'text',
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Banner Image', 'bluishost' ),
		'id'   => $prefix . 'slider-img',
		'classes' => '',
		'type' => 'file',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Image Position', 'bluishost' ),
		'id'   => $prefix . 'slider-imgpos',
		'classes' => '',
		'type' => 'select',
		'options' => array(
			'order-last' => 'Right',
			'order-first'  => 'Left',
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name'	=> esc_html__( 'Text Alignment', 'bluishost' ),
		'id'	=> $prefix . 'slider-textalign',
		'classes'	=> '',
		'type'	=> 'select',
		'options'	=> array(
			'left'	=> esc_html__( 'Left', 'bluishost' ),
			'right'	=> esc_html__( 'Right', 'bluishost' ),
			'center'=> esc_html__( 'Center', 'bluishost' ),
		),
	) );

	// Slider Two Group
	$group_field_id = $slider_meta->add_field( array(
		'id'          => $prefix . 'sliderthree-group-options',
        'classes'     => '',
		'type'        => 'group',
		'repeatable' => true,
		//'description' => esc_html__( 'Add Slider Three', 'bluishost' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Slider {#}', 'bluishost' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Slider', 'bluishost' ),
			'remove_button' => esc_html__( 'Remove Slider', 'bluishost' ),
			'sortable'      => false, // beta
			'closed'     => false, // true to have the groups closed by default
		),
		'tab'  		=> 'slider2',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_group_row_cb' ),
	) );

    // Slider Content group
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Title', 'bluishost' ),
		'id'   => $prefix . 'slider-title-one',
		'classes' => '',
		'type' => 'textarea_small',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Descriptions', 'bluishost' ),
		'id'   => $prefix . 'slider-descriptions',
		'classes' => '',
		'type' => 'textarea_small',
	) );
	
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button One Text', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton01-text',
		'classes' => '',
		'type' => 'text',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button One Url', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton01-url',
		'classes' => '',
		'type' => 'text',
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button One Image Icon Enable/Disable', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton01-imgicon-trigger',
		'classes' => 'btnone-icon-trigger',
		'type' => 'select',
		'default'	=> 'no',
		'options'	=> array(
			"yes"		=> esc_html__('Enable','bluishost'),
			"no"		=> esc_html__('Disable','bluishost'),
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button One Image Icon Image', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton01-imgicon',
		'classes' => 'btnone-imgicon',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Two Text', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton02-text',
		'classes' => '',
		'type' => 'text',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Two Url', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton02-url',
		'classes' => '',
		'type' => 'text',
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Two Image Icon Enable/Disable', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton02-imgicon-trigger',
		'classes' => 'btntwo-icon-trigger',
		'type' => 'select',
		'options'	=> array(
			"yes"		=> esc_html__('Enable','bluishost'),
			"no"		=> esc_html__('Disable','bluishost'),
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Two Image Icon Image', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton02-imgicon',
		'classes' => 'btntwo-imgicon',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Banner Image', 'bluishost' ),
		'id'   => $prefix . 'slider-img',
		'classes' => '',
		'type' => 'file',
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Banner Image Two', 'bluishost' ),
		'id'   => $prefix . 'slider-img-two',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Banner Image Three', 'bluishost' ),
		'id'   => $prefix . 'slider-img-three',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Banner Image Four', 'bluishost' ),
		'id'   => $prefix . 'slider-img-four',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Image Position', 'bluishost' ),
		'id'   => $prefix . 'slider-imgpos',
		'classes' => '',
		'type' => 'select',
		'options' => array(
			'order-last' => 'Right',
			'order-first'  => 'Left',
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name'	=> esc_html__( 'Text Alignment', 'bluishost' ),
		'id'	=> $prefix . 'slider-textalign',
		'classes'	=> '',
		'type'	=> 'select',
		'options'	=> array(
			'left'	=> esc_html__( 'Left', 'bluishost' ),
			'right'	=> esc_html__( 'Right', 'bluishost' ),
			'center'=> esc_html__( 'Center', 'bluishost' ),
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name'	=> esc_html__( 'Gradient Color One', 'bluishost' ),
		'id'	=> $prefix . 'slider-gradient-color-one',
		'classes'	=> '',
		'type'	=> 'colorpicker',
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name'	=> esc_html__( 'Gradient Color Two', 'bluishost' ),
		'id'	=> $prefix . 'slider-gradient-color-two',
		'classes'	=> '',
		'type'	=> 'colorpicker',
	) );

	// Slider Three Group
	$group_field_id = $slider_meta->add_field( array(
		'id'          => $prefix . 'sliderfour-group-options',
        'classes'     => '',
		'type'        => 'group',
		'repeatable' => true,
		//'description' => esc_html__( 'Add Slider Three', 'bluishost' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Slider {#}', 'bluishost' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Slider', 'bluishost' ),
			'remove_button' => esc_html__( 'Remove Slider', 'bluishost' ),
			'sortable'      => false, // beta
			'closed'     => false, // true to have the groups closed by default
		),
		'tab'  		=> 'slider3',
		'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_group_row_cb' ),
	) );

    // Slider Content group
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Title', 'bluishost' ),
		'id'   => $prefix . 'slider-title-one',
		'classes' => '',
		'type' => 'textarea_small',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Descriptions', 'bluishost' ),
		'id'   => $prefix . 'slider-descriptions',
		'classes' => '',
		'type' => 'textarea_small',
	) );
	
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button One Text', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton01-text',
		'classes' => '',
		'type' => 'text',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button One Url', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton01-url',
		'classes' => '',
		'type' => 'text',
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Two Text', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton02-text',
		'classes' => '',
		'type' => 'text',
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Two Url', 'bluishost' ),
		'id'   => $prefix . 'sliderbutton02-url',
		'classes' => '',
		'type' => 'text',
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Banner Image One', 'bluishost' ),
		'id'   => $prefix . 'slider-img-one',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		)
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Banner Image Two', 'bluishost' ),
		'id'   => $prefix . 'slider-img-two',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Banner Image Three', 'bluishost' ),
		'id'   => $prefix . 'slider-img-three',
		'classes' => '',
		'type' => 'file',
		'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','bluishost') // Change upload button text. Default: "Add or Upload File"
		),
	) );
    $slider_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Image Position', 'bluishost' ),
		'id'   => $prefix . 'slider-imgpos',
		'classes' => '',
		'type' => 'select',
		'options' => array(
			'order-last' => 'Right',
			'order-first'  => 'Left',
		),
	) );
	$slider_meta->add_group_field( $group_field_id, array(
		'name'	=> esc_html__( 'Text Alignment', 'bluishost' ),
		'id'	=> $prefix . 'slider-textalign',
		'classes'	=> '',
		'type'	=> 'select',
		'options'	=> array(
			'left'	=> esc_html__( 'Left', 'bluishost' ),
			'right'	=> esc_html__( 'Right', 'bluishost' ),
			'center'=> esc_html__( 'Center', 'bluishost' ),
		),
	) );

	
	
   	/****************************\
      Pricing Post type 
    \****************************/
    
	$bluishost_meta = new_cmb2_box( array(
		'id'            => $prefix . 'pricing_meta',
		'title'         => esc_html__( 'Pricing Info', 'bluishost' ),
		'object_types'  => array( 'pricing' ), // Post type
        'closed'        => true
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Small Title', 'bluishost' ),
		'id'   => $prefix . 'pricing-smalltitle',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Currency', 'bluishost' ),
		'id'   => $prefix . 'pricing-currency',
		'type' => 'text_small',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Price', 'bluishost' ),
		'id'   => $prefix . 'pricing-tblprice',
		'type' => 'text_small',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Duration', 'bluishost' ),
		'id'   => $prefix . 'pricing-duration',
		'type' => 'text_small',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Sales Price Title', 'bluishost' ),
		'id'   => $prefix . 'pricing-salespricetitle',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Sales Price', 'bluishost' ),
		'id'   => $prefix . 'pricing-salesprice',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Features', 'bluishost' ),
		'id'   => $prefix . 'pricing-features',
		'type' => 'text',
		'repeatable' => true
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Button Label', 'bluishost' ),
		'id'   => $prefix . 'pricing-btnlabel',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Button Url', 'bluishost' ),
		'id'   => $prefix . 'pricing-btnurl',
		'type' => 'text',
	));
    
   	/****************************\
      SSL Pricing Post type 
    \****************************/
    
	$bluishost_meta = new_cmb2_box( array(
		'id'            => $prefix . 'sslpricing_meta',
		'title'         => esc_html__( 'Pricing Info', 'bluishost' ),
		'object_types'  => array( 'sslpricing' ), // Post type
        'closed'        => true
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Small Title', 'bluishost' ),
		'id'   => $prefix . 'sslpricing-smalltitle',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Currency', 'bluishost' ),
		'id'   => $prefix . 'sslpricing-currency',
		'type' => 'text_small',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Price', 'bluishost' ),
		'id'   => $prefix . 'sslpricing-tblprice',
		'type' => 'text_small',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Duration', 'bluishost' ),
		'id'   => $prefix . 'sslpricing-duration',
		'type' => 'text_small',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Sales Price Title', 'bluishost' ),
		'id'   => $prefix . 'sslpricing-salespricetitle',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Sales Price', 'bluishost' ),
		'id'   => $prefix . 'sslpricing-salesprice',
		'type' => 'text',
	));
	
	// Feature Group Group
	$group_field_id = $bluishost_meta->add_field( array(
		'id'          => $prefix . 'features-group-options',
		'type'        => 'group',
		'description' => esc_html__( 'Add Features', 'bluishost' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Features {#}', 'bluishost' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Feature', 'bluishost' ),
			'remove_button' => esc_html__( 'Remove Feature', 'bluishost' ),
			'sortable'      => false, // beta
			'closed'     => true, // true to have the groups closed by default
            
		),
	) );

    // Slider Content group
    $bluishost_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Title Bold', 'bluishost' ),
		'id'   => $prefix . 'slider-title-bold',
		'type' => 'text',
	) );
    $bluishost_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Title Normal', 'bluishost' ),
		'id'   => $prefix . 'slider-title-normal',
		'type' => 'text',
	) );
	
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Button Label', 'bluishost' ),
		'id'   => $prefix . 'sslpricing-btnlabel',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Button Url', 'bluishost' ),
		'id'   => $prefix . 'sslpricing-btnurl',
		'type' => 'text',
	));
	

   
	/****************************\
      Gallery Post type
    \****************************/
    
	$bluishost_meta = new_cmb2_box( array(
		'id'            => $prefix . 'gallery_meta',
		'title'         => esc_html__( 'Gallery Info', 'bluishost' ),
		'object_types'  => array( 'gallery' ), // Post type
        'closed'        => true
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Sub Title', 'bluishost' ),
		'id'   => $prefix . 'gallery-sub-title',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Client Name', 'bluishost' ),
		'id'   => $prefix . 'clientname',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Project Done', 'bluishost' ),
		'id'   => $prefix . 'project-done',
		'type' => 'text_date',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'URL', 'bluishost' ),
		'id'   => $prefix . 'gallery-url',
		'type' => 'text_url',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Live Preview Button Text', 'bluishost' ),
		'id'   => $prefix . 'live-preview',
		'type' => 'text',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Show Share Icons', 'bluishost' ),
		'id'   => $prefix . 'show-share-icon',
		'type' => 'checkbox',
	));
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Display Related Project', 'bluishost' ),
		'id'   => $prefix . 'display-more-project',
		'type' => 'checkbox',
	));
	$bluishost_meta = new_cmb2_box( array(
		'id'            => $prefix . 'img_gallery_meta',
		'title'         => esc_html__( 'Upload Gallery Images', 'bluishost' ),
		'object_types'  => array( 'gallery' ), // Post type
        'closed'        => false,
		'context' => 'side',
        'priority' => 'low',
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'gallery', 'bluishost' ),
		'id'   => $prefix . 'gallery',
		'type' => 'file_list',
	));
	
	/****************************\
      Service Post type
    \****************************/
    
	$bluishost_meta = new_cmb2_box( array(
		'id'            => $prefix . 'services_meta',
		'title'         => esc_html__( 'Service Icon', 'bluishost' ),
		'context'       => 'side',
		'priority'      => 'low',
		'object_types'  => array( 'bluishost_services' ), // Post type
        'closed'        => false
	) );
	$bluishost_meta->add_field( array(
		'name' => esc_html__( 'Icon', 'bluishost' ),
		'id'   => $prefix . 'service-icon',
		'type' => 'text',
	));
	      
}