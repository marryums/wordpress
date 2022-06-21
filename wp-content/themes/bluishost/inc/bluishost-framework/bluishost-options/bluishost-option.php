<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "bluishost_opt";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    function WP_ReFilesystem( $args = false, $context = false, $allow_relaxed_file_ownership = false ) {
        if ( file_exists( get_template_directory() . '/info-html.html' ) ) {
            Redux_Functions::initWpFilesystem();

            global $wp_filesystem;

            $sampleHTML = $wp_filesystem->get_contents( get_template_directory(). '/info-html.html' );
        }
    }
	
	$alowhtml = array(
		'p' => array(
			'class' => array()
		),
		'span' => array()
	);

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Bluishost Options', 'bluishost' ),
        'page_title'           => esc_html__( 'Bluishost Options', 'bluishost' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS 
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'bluishost' ),
            'content' => wp_kses( __( '<p>This is the tab content, HTML is allowed.</p>', 'bluishost' ), $alowhtml )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'bluishost' ),
            'content' => wp_kses( __( '<p>This is the tab content, HTML is allowed.</p>', 'bluishost' ), $alowhtml )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = wp_kses( __('<p>This is the sidebar content, HTML is allowed.</p>', 'bluishost' ), $alowhtml );
    Redux::setHelpSidebar( $opt_name, $content );

    // -> START General Fields

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'bluishost' ),
        'id'               => 'bluishost_general',
        'customizer_width' => '450px',
        'icon'             => 'el el-cog',
        'fields'           => array()
        
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'bluishost' ),
        'id'               => 'bluishost_generalss',
        'subsection'       => true,
        'icon'             => '',
        'fields'           => array(
            
            array(
                'id'       => 'bluishost_display_preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Preloader', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to Display Preloader.', 'bluishost' ),
                'default'  => true,
            ),
            array(
                'id'       => 'bluishost_body_gradient_switcher',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Body Gradient Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to Display body gradient.', 'bluishost' ),
                'default'  => false,
            ),
            array(
                'id'       => 'bluishost_body_gradient_color_01',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Gradient Color One', 'bluishost' ),
                'subtitle' => esc_html__( 'Select body gradient color one', 'bluishost' ),
                'required' => array( 'bluishost_body_gradient_switcher', 'equals', true ),
                'default'  => true,
            ),
            array(
                'id'       => 'bluishost_body_gradient_color_02',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Gradient Color Two', 'bluishost' ),
                'subtitle' => esc_html__( 'Select body gradient color two.', 'bluishost' ),
                'required' => array( 'bluishost_body_gradient_switcher', 'equals', true ),
                'default'  => true,
            ),
            array(
                'id'       => 'bluishost_body_color_switcher',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Body Background Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to set body color.', 'bluishost' ),
                'default'  => false,
            ),
            array(
                'id'       => 'bluishost_body_color',
                'type'     => 'background',
                'title'    => esc_html__( 'Body Background Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set body background color.', 'bluishost' ),
                'background-image'      => false,
                'background-color'      => true,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'required' => array( 'bluishost_body_color_switcher', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_body_pattern_switcher',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Body Pattern', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to Display body pattern.', 'bluishost' ),
                'default'  => false,
            ),
            array(
                'id'       => 'bluishost_body_pattern',
                'type'     => 'background',
                'title'    => esc_html__( 'Body Background Pattern', 'bluishost' ),
                'subtitle' => esc_html__( 'Set body background pattern.', 'bluishost' ),
                'background-image'      => true,
                'background-color'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'required' => array( 'bluishost_body_pattern_switcher', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_display_banner_bcktotop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Banner Back To Top Button', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch on to display banner back to top button.', 'bluishost' ),
                'default'  => true,
            ),
            array(
                'id'       => 'bluishost_display_bcktotop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Back To Top Button', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to Display back to top button.', 'bluishost' ),
                'default'  => true,
            ),
            array(
                'id'          => 'bluishost_bluishost_body_fonts',
                'type'        => 'typography', 
                'title'       => esc_html__('Body Typography', 'bluishost'),
                'google'      => true, 
                'font-backup' => true,
                'output'      => array( 'body', 'p' ),
                'units'       =>'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'bluishost'),
                'text-align'  => false,
                'line-height' => false,
                'font-backup' => false,
                'color'       => false,
                'font-size'   => false,
                'subsets'     => false,
                'line-height' => false,
                'default'     => array(
                    'font-family' => 'Roboto', 
                    'google'      => true,
                ),
            ),
            array(
                'id'          => 'bluishost_bluishost_header_fonts',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading Typography', 'bluishost'),
                'google'      => true, 
                'font-backup' => true,
                'output'      => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'bluishost'),
                'text-align'  => false,
                'line-height' => false,
                'font-backup' => false,
                'color'       => false,
                'font-size'   => false,
                'subsets'     => false,
                'line-height' => false,
                'default'     => array(
                    'font-family' => 'Roboto', 
                    'google'      => true,

                ),
            ),
            array(
                'id'       => 'bluishost_unlimited-color',
                'type'     => 'color',
                'title'    => esc_html__('Custom Theme Color', 'bluishost'), 
                'subtitle' => esc_html__('Pick a unlimited mian color for the theme (default: #3f5efb).', 'bluishost'),
                'default'  => '#3f5efb',
                'validate' => 'color'
            ),
			array(
                'id'       => 'bluishost_map_apikey',
                'type'     => 'text',
                'title'    => __( 'API Key', 'bluishost' ),
                'subtitle' => __( 'Set your google map api key', 'bluishost' )              
            ),
         
        )
    ) );
    
    /* End General Fields */

    /* Admin Lebel Fields */
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Admin Label', 'bluishost' ),
        'id'                => 'bluishost_admin_label',
        'customizer_width'  => '450px',
        'icon'              => '',
        'subsection'        => true,
        'fields'            => array(
            
            array(
                'title'     => esc_html__( 'Admin Login Logo', 'bluishost' ),
                'subtitle'  => esc_html__( 'It belongs to the back-end of your website to log-in to admin panel.', 'bluishost' ),
                'id'        => 'bluishost_admin_login_logo',
                'type'      => 'media',
            ),
            array(
                'title'     => esc_html__( 'Custom CSS For admin', 'bluishost' ),
                'subtitle'  => esc_html__( 'Any CSS your write here will run in admin.', 'bluishost' ),
                'id'        => 'bluishost_theme_admin_custom_css',
                'type'      => 'ace_editor',
                'mode'      => 'css',
                'theme'     => 'chrome',
                'full_width'=> true,
            ),
        ),
    ) );
    /* End General Fields */

    // -> START HEADER
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'bluishost' ),
        'id'               => 'bluishost_header',
        'customizer_width' => '450px',
        'icon'             => 'el el-credit-card',
        'fields'           => array()
        
    ) );

    // -> START HEADER LAYOUT
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Layout', 'bluishost'),
        'id'         => 'bluishost_header_option',
        'icon'       => '',
        'subsection' => true,
        'fields'     => array(
  
            array(
                'id'       => 'bluishost_header_version',
                'type'     => 'image_select',
                'title'    => __('Header Layout', 'bluishost'), 
                'subtitle' => __('Select header layout.', 'bluishost'),
                'options'  => array(

                    '1'      => array(
                        'alt'   => esc_html__( 'Header One', 'bluishost' ), 
                        'img'   => get_template_directory_uri().'/assets/img/header-1.png'
                    ),
                    '2'      => array(
                        'alt'   => esc_html__( 'Header Two', 'bluishost' ),  
                        'img'   => get_template_directory_uri().'/assets/img/header-2.png'
                    ),
                    '3'      => array(
                        'alt'   => esc_html__( 'Header Three', 'bluishost' ),  
                        'img'   => get_template_directory_uri().'/assets/img/header-3.png'
                    ),
                    '4'      => array(
                        'alt'   => esc_html__( 'Header Four', 'bluishost' ),  
                        'img'   => get_template_directory_uri().'/assets/img/header-4.png'
                    ),
                    '5'      => array(
                        'alt'   => esc_html__( 'Header Five', 'bluishost' ),  
                        'img'   => get_template_directory_uri().'/assets/img/header-5.png'
                    ),
                    '6'      => array(
                        'alt'   => esc_html__( 'Header Six', 'bluishost' ),  
                        'img'   => get_template_directory_uri().'/assets/img/header-6.png'
                    ),
                    '7'      => array(
                        'alt'   => esc_html__( 'Header Seven', 'bluishost' ),  
                        'img'   => get_template_directory_uri().'/assets/img/header-7.png'
                    ),
                    '8'      => array(
                        'alt'   => esc_html__( 'Header Eight', 'bluishost' ),  
                        'img'   => get_template_directory_uri().'/assets/img/header-8.png'
                    )
                ),
                'default' => '1'
            ),
            array(
                'id'       => 'bluishost_header_translate',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Header Translate Button', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch on to display header Translate Option.', 'bluishost' ),
                'default'  => false,
                'required' => array( 'bluishost_header_top', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_header_translatetext',
                'type'     => 'text',
                'required' => array( 'bluishost_header_translate', 'equals', true  ),
                'title'    => esc_html__( 'Header Translate Button Shortcode', 'bluishost' ),
                'subtitle' => esc_html__( 'Set translate button shortcode.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_header_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Header Social', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch on to display header social media.', 'bluishost' ),
                'default'  => false,
                'required' => array( 'bluishost_header_top', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_enable_client_area_btn',
                'type'     => 'switch',
                'title'    => esc_html__( 'Client Area Button', 'bluishost' ),
                'subtitle' => esc_html__( 'Hide / Show client area button ( Default settings show ).', 'bluishost' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'bluishost_logbtn_imgicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Client Area Button Image Icon', 'bluishost' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload header login button icon ( recommendation png format ).', 'bluishost' ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ), 
            array(
                'id'       => 'bluishost_logbtn_icon',
                'type'     => 'select',
                'title'    => esc_html__('Client Area Button Icon', 'bluishost'), 
                'subtitle' => esc_html__('Select font awesome icon.', 'bluishost'),
                'options'  => bluishost_fa_icons(),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_header_btntext',
                'type'     => 'text',
                'title'    => esc_html__( 'Client Area Button Text', 'bluishost' ),
                'subtitle' => esc_html__( 'Set client area button text.', 'bluishost' ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_header_btnurl',
                'type'     => 'text',
                'title'    => esc_html__( 'Client Area Button Url', 'bluishost' ),
                'subtitle' => esc_html__( 'Set client area button url.', 'bluishost' ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            // Normal Color
            array(
                'id'       => 'bluishost_clientarea_color',
                'output'   => array( '.sticky-wrapper .main-header .register-button .btn' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Client Area Text Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set color.', 'bluishost' ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_clientarea_hvcolor',
                'output'   => array( '.sticky-wrapper .register-button .btn:hover' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Client Area Text Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set hover color.', 'bluishost' ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array( 
                'id'       => 'bluishost_border_color',
                'type'     => 'border',
                'title'    => __('Client Area Border Color', 'bluishost'),
                'subtitle' => __('Set border color', 'bluishost'),
                'output'   => array( '.sticky-wrapper .main-header .register-button .btn' ),
                'default'  => array(
                    'border-style'  => 'solid', 
                    'border-top'    => '1px', 
                    'border-right'  => '1px', 
                    'border-bottom' => '1px', 
                    'border-left'   => '1px'
                ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array( 
                'id'       => 'bluishost_border_hvcolor',
                'type'     => 'border',
                'title'    => __('Client Area Hover Border Color', 'bluishost'),
                'subtitle' => __('Set hover border color', 'bluishost'),
                'output'   => array( '.sticky-wrapper .register-button .btn:hover' ),
                'default'  => array(
                    'border-style'  => 'solid', 
                    'border-top'    => '1px', 
                    'border-right'  => '1px', 
                    'border-bottom' => '1px', 
                    'border-left'   => '1px'
                ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_clientarea_bgcolor',
                'type'     => 'background',
                'output'   => array( '.sticky-wrapper .main-header .register-button .btn' ),
                'title'    => esc_html__( 'Client Area Background Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set background color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            //Hover Color
            array(
                'id'       => 'bluishost_clientarea_bghvcolor',
                'type'     => 'background',
                'output'   => array( '.sticky-wrapper .register-button .btn:hover' ),
                'title'    => esc_html__( 'Client Area Hover Background Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set hover background color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            //Hover Color
            array(
                'id'       => 'bluishost_clientarea_stickycolor',
                'output'   => array( '.sticky-wrapper .main-header.sticking .btn-transparent' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Client Area Sticky Text Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky text color.', 'bluishost' ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_clientarea_stickyhvcolor',
                'output'   => array( '.sticky-wrapper .main-header.sticking .btn-transparent:hover' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Client Area Sticky Hover Text Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky hover text color.', 'bluishost' ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array( 
                'id'       => 'bluishost_border_stickycolor',
                'type'     => 'border',
                'title'    => __('Client Area Sticky Border Color', 'bluishost'),
                'subtitle' => __('Set sticky border color', 'bluishost'),
                'output'   => array( '.sticky-wrapper .main-header.sticking .btn-transparent' ),
                'default'  => array(
                    'border-style'  => 'solid', 
                    'border-top'    => '1px', 
                    'border-right'  => '1px', 
                    'border-bottom' => '1px', 
                    'border-left'   => '1px'
                ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array( 
                'id'       => 'bluishost_border_stickyhvcolor',
                'type'     => 'border',
                'title'    => __('Client Area Sticky Border Hover Color', 'bluishost'),
                'subtitle' => __('Set sticky border hover color', 'bluishost'),
                'output'   => array( '.sticky-wrapper .main-header.sticking .btn-transparent:hover' ),
                'default'  => array(
                    'border-style'  => 'solid', 
                    'border-top'    => '1px', 
                    'border-right'  => '1px', 
                    'border-bottom' => '1px', 
                    'border-left'   => '1px'
                ),
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_clientarea_bgstickycolor',
                'type'     => 'background',
                'output'   => array( '.sticky-wrapper .sticking .btn-transparent' ),
                'title'    => esc_html__( 'Client Area Sticky Background', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky background color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_clientarea_bgstickyhvcolor',
                'type'     => 'background',
                'output'   => array( '.sticky-wrapper .sticking .btn-transparent:hover' ),
                'title'    => esc_html__( 'Client Area Sticky Background Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky background hover color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'required' => array( 'bluishost_enable_client_area_btn', 'equals', true  ),
            ),
        ),
    ) );

    // -> START HEADER TOP INFO
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Top', 'bluishost'),
        'id'         => 'bluishost_header_top_option',
        'icon'       => '',
        'subsection' => true,
        'fields'     => array(    

            array(
                'id'       => 'bluishost_enable_header_top_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Top Info', 'bluishost' ),
                'subtitle' => esc_html__( 'Hide / Show header top info ( Default settings show ).', 'bluishost' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'        => 'bluishost_header_top_mail_one',
                'type'      => 'text',
                'title'     => esc_html__( 'Mail Address One', 'bluishost' ),
                'subtitle'  => esc_html__( 'Set mail address one', 'bluishost' ),
                'required' => array( 'bluishost_enable_header_top_info', 'equals', true  ),
            ),
            array(
                'id'        => 'bluishost_header_top_mail_two',
                'type'      => 'text',
                'title'     => esc_html__( 'Mail Address Two', 'bluishost' ),
                'subtitle'  => esc_html__( 'Set mail address two', 'bluishost' ),
                'required' => array( 'bluishost_enable_header_top_info', 'equals', true  ),
            ),
            array(
                'id'        => 'bluishost_header_top_number_one',
                'type'      => 'text',
                'title'     => esc_html__( 'Mobile Number One', 'bluishost' ),
                'subtitle'  => esc_html__( 'Set mobile number one', 'bluishost' ),
                'required' => array( 'bluishost_enable_header_top_info', 'equals', true  ),
            ),
            array(
                'id'        => 'bluishost_header_top_number_two',
                'type'      => 'text',
                'title'     => esc_html__( 'Mobile Number One', 'bluishost' ),
                'subtitle'  => esc_html__( 'Set mobile number two', 'bluishost' ),
                'required' => array( 'bluishost_enable_header_top_info', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_header_top_color',
                'output'   => array( '.header-top a' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Header Top Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header top color.', 'bluishost' ),
                'default'  => '#fff',
                'required' => array( 'bluishost_enable_header_top_info', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_header_top_bgcolor',
                'type'     => 'background',
                'output'   => array( '.header-top' ),
                'title'    => esc_html__( 'Header Top Background Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header top background color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'default'  => array(
                    'background-color' => '#0138ea',
                ),
                'required' => array( 'bluishost_enable_header_top_info', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_enable_header_top_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Social Icon', 'bluishost' ),
                'subtitle' => esc_html__( 'Hide / Show header social icon ( Default settings show ).', 'bluishost' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
                'required' => array( 'bluishost_enable_header_top_info', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_header_top_icon_color',
                'output'   => array( '.social-icon.text-right > ul.list-unstyled.list-inline.mb-0 > li a' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Header Top Icon Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header top icon color.', 'bluishost' ),
                'required' => array( 'bluishost_enable_header_top_social', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_header_top_icon_hover_color',
                'output'   => array( '.social-icon.text-right > ul.list-unstyled.list-inline.mb-0 > li a:hover' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Header Top Icon Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header top icon hover color.', 'bluishost' ),
                'required' => array( 'bluishost_enable_header_top_social', 'equals', true  ),
            ),
            array( 
                'id'       => 'bluishost_header_top_icon_bdcolor',
                'type'     => 'border',
                'title'    => __('Icon Border Color', 'bluishost'),
                'subtitle' => __('Set icon border color.', 'bluishost'),
                'output'   => array('.header-top .social-icon li a'),
                'required' => array( 'bluishost_enable_header_top_social', 'equals', true  ),
                'default'  => array(
                    'border-color'  => '#2e5ae8', 
                    'border-style'  => 'solid', 
                    'border-top'    => '2px', 
                    'border-right'  => '2px', 
                    'border-bottom' => '2px', 
                    'border-left'   => '2px'
                )
            ),
            array(
                'id'       => 'bluishost_header_top_icon_bgcolor',
                'type'     => 'background',
                'output'   => array( '.social-icon.text-right > ul.list-unstyled.list-inline.mb-0 > li a' ),
                'title'    => esc_html__( 'Header Top Icon Background Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header top icon background color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),
            array(
                'id'       => 'bluishost_header_top_bghv_color',
                'type'     => 'background',
                'output'   => array( '.social-icon.text-right > ul.list-unstyled.list-inline.mb-0 > li a:hover' ),
                'title'    => esc_html__( 'Header Top Background Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header top background hover color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),

        ),

    ) );

    // -> START HEADER ADVERTISEMENT
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Advertisement', 'bluishost'),
        'id'         => 'bluishost_header_add_option',
        'icon'       => '',
        'subsection' => true,
        'fields'     => array(    

            array(
                'id'       => 'bluishost_enable_header_add_img',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Top Info', 'bluishost' ),
                'subtitle' => esc_html__( 'Hide / Show header top info ( Default settings show ).', 'bluishost' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'        => 'bluishost_add_img_upload',
                'type'      => 'media',
                'title'     => esc_html__( 'Upload Advertisement Image', 'bluishost' ),
                'subtitle'  => esc_html__( 'Set advertisement image', 'bluishost' ),
                'required' => array( 'bluishost_enable_header_add_img', 'equals', true  ),
            ),
            array( 
                'id'       => 'bluishost_add_img_url',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Image Url', 'bluishost' ),
                'subtitle' => esc_html__( 'Input your advertisement image url ', 'bluishost' ),
                'required' => array( 'bluishost_enable_header_add_img', 'equals', true  ),
            ),
        ),
    ) );

    // -> START HEADER LOGO
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo', 'bluishost'),
        'id'         => 'bluishost_header_logo',
        'icon'       => '',
        'subsection' => true,
        'fields'     => array(    

            array(
                'id'       => 'bluishost_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Site Logo', 'bluishost' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for header ( recommendation png format ).', 'bluishost' ),
            ),  
            array(
                'id'       => 'bluishost_sticky_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Sticky Logo', 'bluishost' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for sticky header ( recommendation png format ).', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_site_logo_dimensions',
                'type'     => 'dimensions',
                'output'   => array( '.logo img' ),
                'units'    => array('em','px','%'),
                'title'    => __('Logo Dimensions (Width/Height).', 'bluishost'),
                'subtitle' => __('Set logo dimensions to choose width, height, and unit.', 'bluishost'),
                'default'  => array(
                    'Width'   => '100', 
                    'Height'  => '50'
                ),
            ),
            array(
                'id'       => 'bluishost_site_logomargin_dimensions',
                'type'     => 'spacing',
                'mode'           => 'margin',
                'output'   => array( '.logo' ),
                'units_extended' => 'false',
                'units'    => array('em','px' ),
                'title'    => __('Logo Top and Bottom Margin.', 'bluishost'),
                'left'     => false,
                'right'    => false,
                'subtitle' => __('Set logo top and bottom margin.', 'bluishost'),
                'default'            => array(
                    'margin-top'     => '0px',
                    'margin-bottom'  => '0px',
                    'units'           => 'px' 
                )
            ),
            array( 
                'id'       => 'bluishost_site_title',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Text Logo', 'bluishost' ),
                'subtitle' => esc_html__( 'Write your logo text use as logo ( You can use span tag for text color ).', 'bluishost' ),
                'default'  => wp_kses( __( 'Bluishost', 'bluishost' ), $alowhtml ),
            ),
        ),
    ) );

    // -> START HEADER MENU
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Menu', 'bluishost'),
        'id'         => 'bluishost_header_menu_option',
        'icon'       => '',
        'subsection' => true,
        'fields'     => array(    

            array(
                'id'       => 'bluishost_headermenu_bgcolor',
                'type'     => 'background',
                'output'   => array( '.sticky-wrapper .main-header' ),
                'title'    => esc_html__( 'Header Menu Background', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header menu background color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),
            array(
                'id'       => 'bluishost_sticky_headermenu_bgcolor',
                'type'     => 'background',
                'title'    => esc_html__( 'Sticky header Menu Background', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky header menu background color.', 'bluishost' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'default'  => array(
                    'background-color' => '#fff',
                ),
            ),
            array(
                'id'       => 'bluishost_header_menu_color',
                'output'   => array( '.header-menu > ul > li > a' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header menu color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_header_hov_menu_color',
                'output'   => array( 'color' => '.header-menu > ul > li > a:hover', 'background-color'   => '.header-menu > ul > li:hover > a:after' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header menu hover color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_header_menu_active_color',
                'output'   => array( '.header-menu > ul > li.current-menu-item > a', '.header-menu > ul > li.current-menu-ancestor.current-menu-parent > a' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Active Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header menu active color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_header_submenu_color',
                'output'   => array( '.header-menu ul ul li a' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Sub Menu Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header sub menu color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_header_submenu_hover_color',
                'output'   => array( '.header-menu ul ul li a:hover','.header-menu ul ul li:hover > a:before' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Sub Menu Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header sub menu hover color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_header_submenu_active_color',
                'output'   => array( '.header-menu ul ul li.active > a','.header-menu ul ul li.active a:before' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Active Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set header submenu active color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_sticky_header_menu_color',
                'type'     => 'color',
                'output'   => array( '.sticking .header-menu > ul > li > a' ),
                'title'    => esc_html__( 'Sticky Menu Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky header menu color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_sticky_header_menuhov_color',
                'type'     => 'color',
                'output'   => array( '.sticking .header-menu > ul > li > a:hover', '.sticking .header-menu > ul > li > a:focus', '.sticking .header-menu > ul > li.active > a', '.sticking .header-menu > ul > li.active > a', '.sticking .header-menu > ul > li.open > a' ),
                'title'    => esc_html__( 'Sticky Menu Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky header menu hover color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_sticky_header_menu_active_color',
                'output'   => array( '.main-header.sticking .header-menu > ul > li.current-menu-item > a', '.main-header.sticking .header-menu > ul > li.current-menu-ancestor.current-menu-parent > a' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Sticky Header Menu Active Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky header menu active color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_sticky_header_submenu_color',
                'type'     => 'color',
                'output'   => array( '.sticking .header-menu ul ul li a'),
                'title'    => esc_html__( 'Sticky Sub Menu Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky header sub menu color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_sticky_header_submenu_hover_color',
                'type'     => 'color',
                'output'   => array( '.sticking .header-menu ul ul li a:hover','.sticking .header-menu ul ul li:hover > a:before' ),
                'title'    => esc_html__( 'Sticky Sub Menu Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set sticky header sub menu hover color.', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_sticky_header_submenu_active_color',
                'output'   => array( '.main-header.sticking .header-menu ul ul li.active > a','.main-header.sticking .header-menu ul ul li.active a:before' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Sticky Header Submenu Active Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set Sticky header submenu active color.', 'bluishost' ),
            ),
        ),
    ) );
    
    /* End Header */ 
    
    // -> START Page Header
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Header', 'bluishost'),
        'id'         => 'bluishost_pageheader_option',
        'icon'       => 'el el-credit-card',
        'fields'     => array(    
            array(
                'id'       => 'bluishost_allHeader_bg',
                'type'     => 'background',
				'output'   => array( '.title-bg-dark' ),
                'title'    => esc_html__( 'Common Header Background', 'bluishost' ),
                'subtitle' => esc_html__( 'Set common header background.', 'bluishost' ),
				'default'  => array(
					'background-color' => '#2e5ae8'
				)
            ),
            array(
                'id'       => 'bluishost_allHeader_overlay',
                'type'     => 'checkbox',
                'output'   => array( '.title-bg-dark .bg--overlay .page-title-img' ),
                'title'    => esc_html__( 'Page Header Overlay', 'bluishost' ),
                'subtitle' => esc_html__( 'Check this check box to use overlay.', 'bluishost' ),
            ),                   
            array(
                'id'       => 'bluishost_allHeader_ovbg',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Header Overlay Background', 'bluishost' ),
                'subtitle' => esc_html__( 'Set overlay background.', 'bluishost' ),
            ),                                      
            array(
                'id' => 'bluishost_allHeader_ovopacity',
                'type' => 'slider',
                'title' => esc_html__('Overlay Opacity', 'bluishost'),
                'subtitle' => esc_html__('Set overlay opacity.', 'bluishost'),
                "default" => .5,
                "min" => 0,
                "step" => .1,
                "max" => 1,
                'resolution' => 0.1,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'bluishost_allHeader_textcolor',
                'type'     => 'color',
				'output'   => array( '.page-title h2', '.page-title .custom-breadcrumb li a', '.page-title .custom-breadcrumb li' ),
                'title'    => esc_html__( 'Page Header Text Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set page header text color.', 'bluishost' ),
            ),  
            array(
                'id'       => 'bluishost_enable_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb Hide/Show', 'bluishost' ),
                'subtitle' => esc_html__( 'Hide / Show breadcrumb from all page and post ( Default settings hide ).', 'bluishost' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ), 
            array(
                'id'       => 'bluishost_allHeader_dividercolor',
                'type'     => 'color',
                'output'   => array( '.custom-breadcrumb li.active::before' ),
                'title'    => esc_html__( 'Breadcrumb divider Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set breadcrumb divider color.', 'bluishost' ),
            ),           
        ),

    ) );
    
    /* End Header */    
    
    // -> START Blog Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'bluishost' ),
        'id'         => 'bluishost_blog_page',
        'icon'  => 'el el-blogger',
        'fields'     => array(
      
            array(
                'id'       => 'bluishost_blog_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select blog layout', 'bluishost' ),
                'subtitle' => esc_html__( 'Choose your blog sidebar layout ', 'bluishost' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'bluishost_blog_grid',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Blog Post Column', 'bluishost' ),
                'subtitle' => esc_html__( 'Choose your blog post column.', 'bluishost' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),

                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'bluishost_blog_postExcerpt',
                'type'     => 'text',
                'title'    => esc_html__( 'Blog Posts Excerpt', 'bluishost' ),
                'subtitle' => esc_html__( 'How many word you want to show per post in blog ', 'bluishost' ),
                'default'  => '30',
            ), 
            array(
                'id'       => 'bluishost_blog_posttitle_position',
                'type'     => 'button_set',
                'title'    => esc_html__('Single post title display position', 'bluishost'),
                'subtitle' => esc_html__('Set single post title display position.', 'bluishost'),
                //Must provide key => value pairs for options
                'options' => array(
                    '1' => esc_html__( 'On Header', 'bluishost' ), 
                    '2' => esc_html__( 'Below Post Thumbnail', 'bluishost' )
                 ), 
                'default' => '1'
            ),
            array(
                'id'       => 'bluishost_blog_posttitle_tag',
                'type'     => 'select',
                'title'    => esc_html__('Single post title tag', 'bluishost'),
                'subtitle' => esc_html__('Set single post title tag.', 'bluishost'),
                //Must provide key => value pairs for options
                'options' => array(
                    'h1' => esc_html__( 'H1', 'bluishost' ), 
                    'h2' => esc_html__( 'H2', 'bluishost' ),
                    'h3' => esc_html__( 'H3', 'bluishost' ),
                    'h4' => esc_html__( 'H4', 'bluishost' ),
                    'h5' => esc_html__( 'H5', 'bluishost' ),
                    'h6' => esc_html__( 'H6', 'bluishost' ),
                 ), 
                'default' => 'h2',
            ),
            array(
                'id'       => 'bluishost_blog_posttitle_tag_color',
                'type'     => 'color',
                'title'    => esc_html__('Single post title tag color', 'bluishost'),
                'subtitle' => esc_html__('Set single post title tag color.', 'bluishost'),
                'output'   => array(".single-blog-post-title, .page-title h1,.page-title h2,.page-title h3, .page-title h4 ,.page-title h5 , .page-title h6")
            ),
			array(
				'id'       => 'bluishost_blog_pagination',
				'type'     => 'button_set',
				'title'    => esc_html__('Blog Pagination Settings', 'bluishost'),
				'subtitle' => esc_html__('Set blog pagination.', 'bluishost'),
				//Must provide key => value pairs for options
				'options' => array(
					'1' => esc_html__( 'Number Pagination', 'bluishost' ), 
					'2' => esc_html__( 'Link Pagination', 'bluishost' )
				 ), 
				'default' => '2'
			),
			array(
				'id'       => 'bluishost_blog_widget_title_color',
				'type'     => 'color',
				'title'    => esc_html__('Blog Widget Title Color', 'bluishost'),
				'subtitle' => esc_html__('Set Blog Widget Title Color.', 'bluishost'),
				'output'   => array("color" => ".blog aside .sidebar-widget h3" ) 
			),
			array(
				'id'       => 'bluishost_blog_widget_title_underline_color',
				'type'     => 'color',
				'title'    => esc_html__('Blog Widget Title Underline Color', 'bluishost'),
				'subtitle' => esc_html__('Set Blog Widget Title Underline Color.', 'bluishost'),
				'output'   => array("background-color" => ".blog aside .sidebar-widget h3:before" ) 
			),
            array(
                'id'       => 'bluishost_hide_shareBox',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'social share box show/hide', 'bluishost' ),
                'subtitle' => esc_html__( 'Uncheck to hide social share-box in single post view', 'bluishost' ),
                'default'  => '0'// 1 = on | 0 = off
            ),
                   
        ),
    ) );
    
    /* End blog Page */    
    
    // -> START Page Option

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page', 'bluishost' ),
        'id'         => 'bluishost_page_page',
        'icon'  => 'el el-file',
        'fields'     => array(
			array(
				'id'       => 'bluishost_page_layoutopt',
				'type'     => 'button_set',
				'title'    => esc_html__('Page Sidebar Settings', 'bluishost'),
				'subtitle' => esc_html__('Set page sidebar.', 'bluishost'),
				//Must provide key => value pairs for options
				'options' => array(
					'1' => esc_html__( 'No sidebar', 'bluishost' ), 
					'2' => esc_html__( 'Page Sidebar', 'bluishost' ), 
					'3' => esc_html__( 'Blog Sidebar', 'bluishost' )
				 ), 
				'default' => '2'
			),
            array(
                'id'       => 'bluishost_page_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Page layout', 'bluishost' ),
                'subtitle' => esc_html__( 'Choose your page sidebar layout ', 'bluishost' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),

                ),
                'default'  => '3'
            ),

        ),
    ) );
    
    /* End Page option */
    
    // -> START Woo Page Option

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Woocommerce Page', 'bluishost' ),
        'id'         => 'bluishost_woo_page_page',
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'       => 'bluishost_woo_shoppage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Set Shop Page Sidebar.', 'bluishost' ),
                'subtitle' => esc_html__( 'Choose shop page sidebar', 'bluishost' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'bluishost_woo_singlepage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Single Page sidebar', 'bluishost' ),
                'subtitle' => esc_html__( 'Choose product single page sidebar.', 'bluishost' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'bluishost_woo_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Column', 'bluishost' ),
                'subtitle' => esc_html__( 'Set your woocommerce product column.', 'bluishost' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '12' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '6' => array(
                        'alt' => '2 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '3 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '4 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    ),

                ),
                'default'  => '4'
            ),
			array(
                'id'       => 'bluishost_woo_product_perpage',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Per Page', 'bluishost' ),
				'default' => '10'
            ),
			array(
                'id'       => 'bluishost_woo_shoptitle_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Shop page title on/off', 'bluishost' ),
                'subtitle' => esc_html__( 'Use switch to show or hide WooCommerce shop page title .', 'bluishost' ),
                'default'  => false,
            ),
			array(
                'id'       => 'bluishost_woo_relproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products number', 'bluishost' ),
                'subtitle' => esc_html__( 'Set how many related products you want to show in single product page.', 'bluishost' ),
                'default'  => 3,
            ),


        ),
    ) );
    
    /* End Woo Page option */
    
    // -> START 404 Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page', 'bluishost' ),
        'id'         => 'bluishost_404_page',
        'icon'       => 'el el-ban-circle',
        'fields'     => array(
            array(
                'id'       => 'bluishost_fof_text',
                'type'     => 'text',
                'title'    => esc_html__( '404 Text', 'bluishost' ),
                'subtitle' => esc_html__( 'Set 404 text ', 'bluishost' ),
                'default'  => esc_html__( 'Ooops 404 Error !', 'bluishost' ),                
            ),
            array(
                'id'       => 'bluishost_fof_desc',
                'type'     => 'text',
                'title'    => esc_html__( '404 Description', 'bluishost' ),
                'subtitle' => esc_html__( 'Set 404 description text ', 'bluishost' ),
                'default'  => wp_kses_post( __( 'Either something went wrong or the page dosen&rsquo;t exist anymore.', 'bluishost' ) )            
            ),
            array(
                'id'       => 'bluishost_fof_img',
                'type'     => 'media',
                'title'    => esc_html__( 'Image', 'bluishost' ),
                'subtitle' => esc_html__( 'Set image', 'bluishost' ),               
            ),
            array(
                'id'       => 'bluishost_fof_background',
                'type'     => 'background',
                'output'   => array( '.not-found-title' ),
                'title'    => esc_html__( '404 Background', 'bluishost' ),
                'subtitle' => esc_html__( '404 page background with image, color, etc.', 'bluishost' ),
                'default'  => array(
                    'background-color' => '#2e5ae8',
                ),
            ),
            array(
                'id'       => 'bluishost_fof_bgoverlay',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Background Overlay', 'bluishost' ),
                'subtitle' => esc_html__( 'Set background ovelay.', 'bluishost' ),
            ),
			array(
                'id'       => 'bluishost_fof_overlay_color',
                'type'     => 'background',
                'output'   => array( '.not-found-title.bg--overlay:before' ),
                'title'    => esc_html__( 'Overlay Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set overlay color.', 'bluishost' ),
				'background-image' 		=> false,
				'background-size' 		=> false,
				'background-attachment' => false,
				'background-repeat' 	=> false,
				'background-position' 	=> false,
				'preview' 				=> false,
                'default'  => array(
                    'background-color' => '#303030',
                ),
            ),
			array(
				'id' => 'bluishost_fof_ovopacity',
				'type' => 'slider',
				'title' => esc_html__('Overlay Opacity', 'bluishost'),
				'subtitle' => esc_html__('set overlay opacity.', 'bluishost'),
				"default" => .5,
				"min" => 0,
				"step" => .1,
				"max" => 1,
				'resolution' => 0.1,
				'display_value' => 'text'
			),
            array(
                'id'       => 'bluishost_fof_text_color',
                'type'     => 'color',
                'output'   => array( '.not-found-title h2, a.karla' ),
                'title'    => esc_html__('404 Text Color', 'bluishost'), 
                'subtitle' => esc_html__('Pick a text color', 'bluishost'),
                'default'  => '#fffff',
                'validate' => 'color'
            ),

            array(
                'id'       => 'bluishost_fof_desc_color',
                'type'     => 'color',
                'output'   => array( '.row.justify-content-center h3' ),
                'title'    => esc_html__('404 Description Color', 'bluishost'), 
                'subtitle' => esc_html__('Pick a description color', 'bluishost'),
                'default'  => '#7884ac',
                'validate' => 'color'
            ),
        ),
    ) );
    
    /* End 404 Page */
    
    // -> START Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Subscribe', 'bluishost' ),
        'id'         => 'bluishost_subscribe_page',
        'icon'       => 'el el-eject',
        'fields'     => array(
            array(
                'id'       => 'bluishost_subscribe_apikey',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp API Key', 'bluishost' ),
                'subtitle' => esc_html__( 'Set mailchimp api key.', 'bluishost' )              
            ),
            array(
                'id'       => 'bluishost_subscribe_listid',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp List ID', 'bluishost' ),
                'subtitle' => esc_html__( 'Set mailchimp list id.', 'bluishost' )              
            ),

        ),
    ) );
    
    /* End Page */
    

    // -> START Contact Page   
    
    // -> START Social Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'bluishost' ),
        'id'         => 'bluishost_social_media',
        'icon'  => 'el el-globe',
        'fields'     => array(
            array(
                'id'       => 'bluishost_facebook_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'bluishost' ),
                'subtitle' => esc_html__( 'Add Facebook URL', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_twitter_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'bluishost' ),
                'subtitle' => esc_html__( 'Add Twitter URL', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_google_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Plus', 'bluishost' ),
                'subtitle' => esc_html__( 'Add google plus URL', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_youtube_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'bluishost' ),
                'subtitle' => esc_html__( 'Add youtube URL', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_instagram_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'bluishost' ),
                'subtitle' => esc_html__( 'Add Instagram URL', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_vimeo_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Vimeo', 'bluishost' ),
                'subtitle' => esc_html__( 'Add vimeo plus URL', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_linkedin_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Linkedin', 'bluishost' ),
                'subtitle' => esc_html__( 'Add linkedin plus URL', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_rss_link',
                'type'     => 'text',
                'title'    => esc_html__( 'rss', 'bluishost' ),
                'subtitle' => esc_html__( 'Add rss URL', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_behance_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Behance', 'bluishost' ),
                'subtitle' => esc_html__( 'Add behance plus URL', 'bluishost' ),
            ),          
            array(
                'id'       => 'bluishost_pinterest_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'bluishost' ),
                'subtitle' => esc_html__( 'Add pinterest plus URL', 'bluishost' ),
            ),          
            array(
                'id'       => 'bluishost_dribbble_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Dribbble', 'bluishost' ),
                'subtitle' => esc_html__( 'Add dribbble plus URL', 'bluishost' ),
            ),          
            array(
                'id'       => 'bluishost_github_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Github', 'bluishost' ),
                'subtitle' => esc_html__( 'Add github URL', 'bluishost' ),
            ), 
        ),
    ) );
    
    /* End social Media */

    
    // -> START Footer Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'bluishost' ),
        'id'         => 'bluishost_footer_section',
        'icon'  => 'el el-photo',
        'fields'     => array( 
            
            array(
                'id'       => 'bluishost_display_bcktotop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Back To Top Button', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to Display back to top button.', 'bluishost' ),
                'default'  => true,
            ),
            array(
                'id'       => 'bluishost_back_to_top',
                'type'     => 'select',
                'title'    => esc_html__('Back to Top', 'bluishost'),
                'subtitle' => esc_html__('Select Back to Top.', 'bluishost'),
                //Must provide key => value pairs for options
                'options'   => array(
                    '1'         => esc_html__('Style One','bluishost'),
                    '2'         => esc_html__('Style Two','bluishost'),
                    '3'         => esc_html__('Style Three','bluishost'),
                ),
                'default' => '1',
                'required' => array( 'bluishost_display_bcktotop', 'equals', true  ),
            ),
            array(
                'id'       => 'bluishost_footer_gradient_color_switcher',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show / Hide Footer Gradient Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to set footer gradient color.', 'bluishost' ),
                'default'  => false,
            ),
            array(
                'id'       => 'bluishost_footer_gradient_color_01',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Gradient Color One', 'bluishost' ),
                'subtitle' => esc_html__( 'Select footer gradient color one', 'bluishost' ),
                'required' => array( 'bluishost_footer_gradient_color_switcher', 'equals', true ),
                'default'  => true,
            ),
            array(
                'id'       => 'bluishost_footer_gradient_color_02',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Gradient Color Two', 'bluishost' ),
                'subtitle' => esc_html__( 'Select footer gradient color two.', 'bluishost' ),
                'required' => array( 'bluishost_footer_gradient_color_switcher', 'equals', true ),
                'default'  => true,
            ),
            array(
                'id'       => 'bluishost_footer_color_switcher',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Footer Background Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to set footer color.', 'bluishost' ),
                'default'  => false,
            ),
            array(
                'id'       => 'bluishost_footer_pattern_switcher',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Footer Pattern', 'bluishost' ),
                'subtitle' => esc_html__( 'Switch On to Display footer pattern.', 'bluishost' ),
                'default'  => false,
            ),
            array(
                'id'       => 'bluishost_footer_pattern',
                'type'     => 'background',
                'title'    => esc_html__( 'Footer Background Pattern', 'bluishost' ),
                'subtitle' => esc_html__( 'Set footer background pattern.', 'bluishost' ),
                'background-image'      => true,
                'background-color'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'required' => array( 'bluishost_footer_pattern_switcher', 'equals', true  ),
            ),

            array(
                'id'       => 'bluishost_footer_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Footer Layout', 'bluishost' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => 'Footer Style One',
                        'img' => get_template_directory_uri().'/assets/img/footer_style_1.png'
                    ),
                    '2' => array(
                        'alt' => 'Footer Style Two',
                        'img' => get_template_directory_uri().'/assets/img/footer_style_2.png'
                    ),
                    '3' => array(
                        'alt' => 'Footer Style Three',
                        'img' => get_template_directory_uri().'/assets/img/footer_style_3.png'
                    ),

                ),
                'default'  => '2'
            ),    
            array(
                'id'       => 'bluishost_footerwidget_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Widget Enabled/Disabled', 'bluishost' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'bluishost_footercol_switch',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Widget Column', 'bluishost' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '3 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),

                    '3' => array(
                        'alt' => '4 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    ),

                ),
                'default'  => '3'
            ), 
            array(
                'id'       => 'bluishost_footer_widget_background',
                'type'     => 'background',
                'output'   => array( '.main-footer','.main-footer:before' ),
                'title'    => esc_html__( 'Footer widget background color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set footer widget background color.', 'bluishost' ),
                'background-size'       => false,
                'background-image'      => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),  
            array(
                'id'       => 'bluishost_footer_widget_title_color',
                'type'     => 'color',
                'output'   => array( '.footer-widget .widget-title' ),
                'title'    => esc_html__( 'Footer widget title color', 'bluishost' ),
            ),  
            array(
                'id'       => 'bluishost_footer_widget_color',
                'type'     => 'color',
                'output'   => array( '.footer-posts p', '.footer-contacts ul li span', 'caption' ),
                'title'    => esc_html__( 'Footer widget color', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_footer_widget_icon_color',
                'type'     => 'color',
                'output'   => array( '.footer-posts h4 a', '.footer-posts p a','.footer-contacts ul li a, .footer-contacts ul li address', '.footer-contacts ul li:last-child a' ),
                'title'    => esc_html__( 'Footer widget anchor color', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_footer_widget_hov_color',
                'type'     => 'color',
                'output'   => array( '.footer-posts h4 a:hover', '.footer-posts p a:hover', '.footer-contacts ul li a:hover', '.footer-contacts ul li:last-child a:hover' ),
                'title'    => esc_html__( 'Footer widget anchor hover color', 'bluishost' ),
            ),
            array(
                'id'       => 'bluishost_copyright_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Copyright', 'bluishost' ),
                'subtitle' => esc_html__( 'Add Copyright ', 'bluishost' ),
                'default'  => sprintf( __('&copy; Copyright %s <a href="%s">Bluishost</a>. All Rights Reserved. Design With <i class="fa fa-heart"></i> by ThemeLooks','bluishost'),date('Y') ,'#' ),
            ),
            array(
                'id'       => 'bluishost_footer_copyright_bg',
                'type'     => 'background',
                'output'   => array( '.bottom-footer' ),
                'title'    => esc_html__( 'Footer copyright background color', 'bluishost' ),
                'background-size'       => false,
                'background-image'      => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),
            array(
                'id'       => 'bluishost_footer_copyright_color',
                'type'     => 'color',
                'output'   => array( '.bottom-footer p:last-child' ),
                'title'    => esc_html__( 'Footer Copyright Text Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set footer copyright text color', 'bluishost' )
            ),
            array(
                'id'       => 'bluishost_footer_copyright_acolor',
                'type'     => 'color',
                'output'   => array( '.copyright-text a, .copyright-text a:hover' ),
                'title'    => esc_html__( 'Footer Copyright Ancor Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set footer copyright ancor color', 'bluishost' )
            ),
            array(
                'id'       => 'bluishost_menu_color',
                'type'     => 'color',
                'output'   => array( '.footer-menu li a' ),
                'title'    => esc_html__( 'Footer Menu Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set footer menu color', 'bluishost' )
            ),
            array(
                'id'       => 'bluishost_menu_hover_color',
                'type'     => 'color',
                'output'   => array( '.footer-menu li a:hover' ),
                'title'    => esc_html__( 'Footer Menu Hover Color', 'bluishost' ),
                'subtitle' => esc_html__( 'Set footer menu hover color', 'bluishost' )
            ),
            
        ),
    ) );
    
    /* End Footer Media */
    
    // -> START Custom Css
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Css', 'bluishost' ),
        'id'         => 'bluishost_custom_css_section',
        'icon'  => 'el el-css',
        'fields'     => array(    
            array(
                'id'       => 'bluishost_css_editor',
                'type'     => 'ace_editor',
                'title'    => __('CSS Code', 'bluishost'),
                'subtitle' => __('Paste your CSS code here.', 'bluishost'),
                'mode'     => 'css',
                'theme'    => 'monokai',
            )
        ),
    ) );
    
    /* End custom css */

    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>'.esc_html__( 'The compiler hook has run!', 'bluishost' ).'</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = esc_html__( 'your custom error message', 'bluishost' );
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = esc_html__( 'your custom warning message', 'bluishost' );
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'bluishost' ),
                'desc'   => wp_kses( __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'bluishost' ), $alowhtml),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'bluishost' );

            return $defaults;
        }
    }