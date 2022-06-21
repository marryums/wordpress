<?php 
/**
 * Bluishost Service Element
 */
class WPBakeryShortCode_service extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_service_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostservice', array( $this, 'bluishost_service_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_service_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  	"name" 			=> __( "Service", "bluishost" ),
		  	"base" 			=> "bluishostservice",
		  	"class" 		=> "",
		  	"icon"  		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  	"category" 		=> __( "Bluishost", "bluishost"),
		  	"params" 		=> array(

		  		array(
			  		"type"				=> "dropdown",
			  		"heading"			=> esc_html__( "Style Type", "bluishost" ),
			  		"param_name"		=> "styletype",
			  		'value'         	=> array(
		                esc_html__( 'Default', 'bluishost' )  		=> 'styleone',
		                esc_html__( 'Style One', 'bluishost' )  	=> 'styleone',
		                esc_html__( 'Style Two', 'bluishost' )   	=> 'styletwo',
		            	),
		            'std'				=> 'styleone',
			  	),
			  	array(
					'heading'    => esc_html__( 'Choose Style', 'bluishost' ),
					'type'       => 'radio_image_select',
					'param_name' => 'service_style',
					'simple_mode'		=> false,
					'options'    => array(
						'left'	 => array(
							'tooltip'	=> esc_attr__('Left','bluishost'),
							'src'		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/left.png'
						),
						'center' => array(
							'tooltip'	=> esc_attr__('Center','bluishost'),
							'src'		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/centre.png'
						),
						'right' => array(
							'tooltip'	=> esc_attr__('Right','bluishost'),
							'src'		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/right.png'
						)
					),
					'default'			=> 'left'
				),
			  	array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Icon Type', 'bluishost' ),
					'param_name' 	=> 'icontype',
					'value'         => array(
		                esc_html__( 'Fontawesome', 'bluishost' )  => 'fontawesome',
		                esc_html__( 'Openiconic', 'bluishost' )   => 'openiconic',
		                esc_html__( 'Typicons', 'bluishost' )     => 'typicons',
		                esc_html__( 'Entypo', 'bluishost' )       => 'entypo',
		                esc_html__( 'Linecons', 'bluishost' )     => 'linecons',
		                esc_html__( 'Monosocial', 'bluishost' )   => 'monosocial',
		                esc_html__( 'Material', 'bluishost' )     => 'material',
		                esc_html__( 'Image', 'bluishost' )        => 'imageicon',
		            ),
		            'std'			=> 'fontawesome',
		            "dependency" 	=> array(
						'element' 	=> 'styletype',
						'value'   	=> array( 'styleone' ),
					)
				),
				array(
					'type' 			=> 'iconpicker',
					'heading' 		=> esc_html__( 'Font Awesome Icon', 'bluishost' ),
					'param_name' 	=> 'icon_fontawesome',
					'settings' 		=> array(
						'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
						'type' 			=> 'fontawesome',
						'iconsPerPage'  => 200, // default 100, how many icons per/page to display
					),
					'value' 		=> 'fa fa-adjust',
					'dependency' 	=> array(
						'element' => 'icontype',
						'value'   => 'fontawesome',
					),
					'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
				),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Openiconic Icon', 'bluishost' ),
		            'param_name' 	=> 'icon_openic',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'openiconic',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-oi vc-oi-dial',
		            'dependency' 	=> array(
		                'element' => 'icontype',
		                'value'   => 'openiconic',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Typicons', 'bluishost' ),
		            'param_name' 	=> 'icon_typicons',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'typicons',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'typcn typcn-adjust-brightness',
		            'dependency' 	=> array(
		                'element' => 'icontype',
		                'value'   => 'typicons',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Entypo', 'bluishost' ),
		            'param_name' 	=> 'icon_entypo',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'entypo',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'entypo-icon entypo-icon-note',
		            'dependency' 	=> array(
		                'element' => 'icontype',
		                'value'   => 'entypo',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Linecons', 'bluishost' ),
		            'param_name' 	=> 'icon_linecons',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'linecons',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc_li vc_li-heart',
		            'dependency' 	=> array(
		                'element' => 'icontype',
		                'value'   => 'linecons',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Monosocial', 'bluishost' ),
		            'param_name' 	=> 'icon_monosocial',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'monosocial',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-mono vc-mono-fivehundredpx',
		            'dependency' 	=> array(
		                'element' => 'icontype',
		                'value'   => 'monosocial',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Material', 'bluishost' ),
		            'param_name' 	=> 'icon_material',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'material',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-material vc-material-cake',
		            'dependency' 	=> array(
		                'element' => 'icontype',
		                'value'   => 'material',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
				array(
					'type' 			=> 'attach_image',
					'holder' 		=> 'div',
					'heading' 		=> esc_html__( 'Image', 'bluishost' ),
					'param_name' 	=> 'serv_image',
					'description' 	=> esc_html__( 'Set image.', 'bluishost' ),
					'dependency' 	=> array(
						'element' => 'icontype',
						'value'   => 'imageicon',
					),
				),

				//
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Front Icon Type', 'bluishost' ),
					'param_name' 	=> 'front_icontype',
					'value'         => array(
		                esc_html__( 'Fontawesome', 'bluishost' )  => 'front_fontawesome',
		                esc_html__( 'Openiconic', 'bluishost' )   => 'front_openiconic',
		                esc_html__( 'Typicons', 'bluishost' )     => 'front_typicons',
		                esc_html__( 'Entypo', 'bluishost' )       => 'front_entypo',
		                esc_html__( 'Linecons', 'bluishost' )     => 'front_linecons',
		                esc_html__( 'Monosocial', 'bluishost' )   => 'front_monosocial',
		                esc_html__( 'Material', 'bluishost' )     => 'front_material',
		                esc_html__( 'Image', 'bluishost' )        => 'front_imageicon',
		            ),
		            'std'			=> 'front_fontawesome',
		            "dependency" 	=> array(
						'element' 	=> 'styletype',
						'value'   	=> array( 'styletwo' ),
					)
				),
				array(
					'type' 			=> 'iconpicker',
					'heading' 		=> esc_html__( 'Font Awesome Icon', 'bluishost' ),
					'param_name' 	=> 'front_icon_fontawesome',
					'settings' 		=> array(
						'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
						'type' 			=> 'fontawesome',
						'iconsPerPage'  => 200, // default 100, how many icons per/page to display
					),
					'value' 		=> 'fa fa-adjust',
					'dependency' 	=> array(
						'element' => 'front_icontype',
						'value'   => 'front_fontawesome',
					),
					'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
				),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Openiconic Icon', 'bluishost' ),
		            'param_name' 	=> 'front_icon_openic',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'openiconic',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-oi vc-oi-dial',
		            'dependency' 	=> array(
		                'element' => 'front_icontype',
		                'value'   => 'front_openiconic',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Typicons', 'bluishost' ),
		            'param_name' 	=> 'front_icon_typicons',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'typicons',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'typcn typcn-adjust-brightness',
		            'dependency' 	=> array(
		                'element' => 'front_icontype',
		                'value'   => 'front_typicons',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Entypo', 'bluishost' ),
		            'param_name' 	=> 'front_icon_entypo',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'entypo',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'entypo-icon entypo-icon-note',
		            'dependency' 	=> array(
		                'element' => 'front_icontype',
		                'value'   => 'front_entypo',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Linecons', 'bluishost' ),
		            'param_name' 	=> 'front_icon_linecons',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'linecons',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc_li vc_li-heart',
		            'dependency' 	=> array(
		                'element' => 'front_icontype',
		                'value'   => 'front_linecons',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Monosocial', 'bluishost' ),
		            'param_name' 	=> 'front_icon_monosocial',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'monosocial',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-mono vc-mono-fivehundredpx',
		            'dependency' 	=> array(
		                'element' => 'front_icontype',
		                'value'   => 'front_monosocial',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Material', 'bluishost' ),
		            'param_name' 	=> 'front_icon_material',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'material',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-material vc-material-cake',
		            'dependency' 	=> array(
		                'element' => 'front_icontype',
		                'value'   => 'front_material',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
				array(
					'type' 			=> 'attach_image',
					'holder' 		=> 'div',
					'heading' 		=> esc_html__( 'Image', 'bluishost' ),
					'param_name' 	=> 'front_image',
					'description' 	=> esc_html__( 'Set image.', 'bluishost' ),
					'dependency' 	=> array(
						'element' => 'front_icontype',
						'value'   => 'front_imageicon',
					),
				),

				//
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Back Icon Type', 'bluishost' ),
					'param_name' 	=> 'back_icontype',
					'value'         => array(
		                esc_html__( 'Fontawesome', 'bluishost' )  => 'back_fontawesome',
		                esc_html__( 'Openiconic', 'bluishost' )   => 'back_openiconic',
		                esc_html__( 'Typicons', 'bluishost' )     => 'back_typicons',
		                esc_html__( 'Entypo', 'bluishost' )       => 'back_entypo',
		                esc_html__( 'Linecons', 'bluishost' )     => 'back_linecons',
		                esc_html__( 'Monosocial', 'bluishost' )   => 'back_monosocial',
		                esc_html__( 'Material', 'bluishost' )     => 'back_material',
		                esc_html__( 'Image', 'bluishost' )        => 'back_imageicon',
		            ),
		            'std'			=> 'back_fontawesome',
		            "dependency" 	=> array(
						'element' 	=> 'styletype',
						'value'   	=> array( 'styletwo' ),
					)
				),
				array(
					'type' 			=> 'iconpicker',
					'heading' 		=> esc_html__( 'Font Awesome Icon', 'bluishost' ),
					'param_name' 	=> 'back_icon_fontawesome',
					'settings' 		=> array(
						'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
						'type' 			=> 'fontawesome',
						'iconsPerPage'  => 200, // default 100, how many icons per/page to display
					),
					'value' 		=> 'fa fa-adjust',
					'dependency' 	=> array(
						'element' => 'back_icontype',
						'value'   => 'back_fontawesome',
					),
					'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
				),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Openiconic Icon', 'bluishost' ),
		            'param_name' 	=> 'back_icon_openic',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'openiconic',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-oi vc-oi-dial',
		            'dependency' 	=> array(
		                'element' => 'back_icontype',
		                'value'   => 'back_openiconic',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Typicons', 'bluishost' ),
		            'param_name' 	=> 'back_icon_typicons',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'typicons',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'typcn typcn-adjust-brightness',
		            'dependency' 	=> array(
		                'element' => 'back_icontype',
		                'value'   => 'back_typicons',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Entypo', 'bluishost' ),
		            'param_name' 	=> 'back_icon_entypo',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'entypo',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'entypo-icon entypo-icon-note',
		            'dependency' 	=> array(
		                'element' => 'back_icontype',
		                'value'   => 'back_entypo',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Linecons', 'bluishost' ),
		            'param_name' 	=> 'back_icon_linecons',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'linecons',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc_li vc_li-heart',
		            'dependency' 	=> array(
		                'element' => 'back_icontype',
		                'value'   => 'back_linecons',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Monosocial', 'bluishost' ),
		            'param_name' 	=> 'back_icon_monosocial',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'monosocial',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-mono vc-mono-fivehundredpx',
		            'dependency' 	=> array(
		                'element' => 'back_icontype',
		                'value'   => 'back_monosocial',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
		        array(
		            'type' 			=> 'iconpicker',
		            'heading' 		=> esc_html__( 'Material', 'bluishost' ),
		            'param_name' 	=> 'back_icon_material',
		            'settings' 		=> array(
		            	'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
		            	'type' 			=> 'material',
		            	'iconsPerPage'  => 200, // default 100, how many icons per/page to display
		            ),
		            'value' 		=> 'vc-material vc-material-cake',
		            'dependency' 	=> array(
		                'element' => 'back_icontype',
		                'value'   => 'back_material',
		            ),
		            'description' 	=> esc_html__( 'Select icon from library.', 'bluishost' ),
		        ),
				array(
					'type' 			=> 'attach_image',
					'holder' 		=> 'div',
					'heading' 		=> esc_html__( 'Image', 'bluishost' ),
					'param_name' 	=> 'back_image',
					'description' 	=> esc_html__( 'Set image.', 'bluishost' ),
					'dependency' 	=> array(
						'element' => 'back_icontype',
						'value'   => 'back_imageicon',
					),
				),
				array(
					'type'			=> 'floatnumber',
					'heading'		=> esc_html__( 'Icon Size', 'bluishost' ),
					'param_name'	=> 'icon_size',
					'step'		   	=> '1',
					'admin_label'  	=> false,
					'weight' 	   	=> 0,
					'description'	=> esc_html__( 'Set icon font size ( px )', 'bluishost' ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Title", "bluishost" ),
					"param_name" => "title",
					"description" => __( "Set feature title.", "bluishost" )
				),
				array(
					"type" => "textarea",
					"heading" => __( "Descriptions", "bluishost" ),
					"param_name" => "description",
					"description" => __( "Set feature descriptions.", "bluishost" ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Button / Link Text", "bluishost" ),
					"param_name" => "linktext",
					"description" => __( "Set Button / Link Text.", "bluishost" ),
					"dependency" 	=> array(
						'element' 	=> 'styletype',
						'value'   	=> array( 'styletwo' ),
					)
				),
				array(
					"type" => "textfield",
					"heading" => __( "Button / Link URL", "bluishost" ),
					"param_name" => "linkurl",
					"description" => __( "Set Button / Link URL.", "bluishost" ),
					"dependency" 	=> array(
						'element' 	=> 'styletype',
						'value'   	=> array( 'styletwo' ),
					)
				),
				array(
					"type" => "css_editor",
					"heading" => __("Design Settings Options", "bluishost"),
					"param_name" => "css",
					"group"		=> __( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Icon Color", "bluishost" ),
					"param_name" 	=> "iconcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
					"dependency"	=> array(
						"element"		=> "styletype",
						"value"			=> "styleone"
					)
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Front Icon Color", "bluishost" ),
					"param_name" 	=> "fronticoncolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
					"dependency"	=> array(
						"element"		=> "styletype",
						"value"			=> "styletwo"
					)
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Back Icon Color", "bluishost" ),
					"param_name" 	=> "backiconcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
					"dependency"	=> array(
						"element"		=> "styletype",
						"value"			=> "styletwo"
					)
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Icon Border Color", "bluishost" ),
					"param_name" 	=> "iconbordercolor",
					"dependency"	=> array(
						"element"		=> "styletype",
						"value"			=> array( "styleone" )
					),
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Title Color", "bluishost" ),
					"param_name" 	=> "titlecolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Content Color", "bluishost" ),
					"param_name" 	=> "contentcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Button / Link Color", "bluishost" ),
					"param_name" 	=> "linkcolor",
					"dependency"	=> array(
						"element"		=> "styletype",
						"value"			=> array( "styletwo" )
					),
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Button / Link Hover Color", "bluishost" ),
					"param_name" 	=> "linkhovercolor",
					"dependency"	=> array(
						"element"		=> "styletype",
						"value"			=> array( "styletwo" )
					),
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Front Background Color", "bluishost" ),
					"param_name" 	=> "bgcolor",
					"dependency"	=> array(
						"element"		=> "styletype",
						"value"			=> array( "styletwo" )
					),
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				// Gradient and Simple Color Start
				array(
					"type" 			=> "dropdown",
					"heading" 		=> esc_html__( "Back Background Color", "bluishost" ),
					"param_name" 	=> "bg_color",
					"value"			=> array(
						esc_html__("Simple Background Color","bluishost")		=> 'simple',
						esc_html__("Gradient Background Color","bluishost")	    => 'gradient',
					),
					"std"  			=> "simple",
					"group"		    => esc_html__( "Design Option", "bluishost" ),
					"dependency" 	=> array(
	                    'element' => 'styletype',
	                    'value'   => 'styletwo',
	                ),	
				),
				array(
					"type" 				=> "colorpicker",
					"heading" 			=> esc_html__( "Background Color", "bluishost" ),
					"param_name" 		=> "simple_bg_color",
					"dependency"		=> array(
						"element"			=> "bg_color",
						"value"				=> array("simple")	
					),
					"group"		    => esc_html__( "Design Option", "bluishost" ),	
				),
				array(
					"type" 				=> "colorpicker",
					"edit_field_class"	=>	"vc_col-sm-6",
					"heading" 			=> esc_html__( "Gradient Color Start From", "bluishost" ),
					"param_name" 		=> "bg_gradient_start",
					"dependency"		=> array(
						"element"			=> "bg_color",
						"value"				=> array("gradient")	
					),
					"group"		    => esc_html__( "Design Option", "bluishost" ),	
				),
				array(
					"type" 				=> "colorpicker",
					"edit_field_class"	=>	"vc_col-sm-6",
					"heading" 			=> esc_html__( "Gradient Color End To", "bluishost" ),
					"param_name" 		=> "bg_gradient_end",
					"dependency"		=> array(
						"element"			=> "bg_color",
						"value"				=> array("gradient")
					),
					"group"		    => esc_html__( "Design Option", "bluishost" ),	
				),
				// Gradient and Simple Color End
				array(
					'type' 			=> 'animation_style',
					'heading' 		=> __( 'Animation Style', 'bluishost' ),
					'param_name' 	=> 'animation',
					'description' 	=> __( 'Choose your animation style', 'bluishost' ),
					'admin_label' 	=> false,
					'weight' 		=> 0,
					"group"			=> __( "Design Option", "bluishost" ),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Animation Time Delay', 'bluishost' ),
					'param_name'	=> 'duration',
					'description'	=> esc_html__( 'Set animation time delay ( Example : .5 )', 'bluishost' ),
					'group'			=> esc_html__( 'Design Option', 'bluishost' )
				),
				array(
					'type'			=>	'textfield',
					'heading'		=>	esc_html__('Extra Class Name', 'bluishost'),
					'param_name'	=>	'el_class',
					'group'			=>	esc_html__('Extra Class', 'bluishost'),
					'description'	=>	esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "bluishost"),
				),
		  	)
		) );
		
	}
	
	// Shortcode and markup
	public function bluishost_service_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'styletype'    				=> 'styleone',
				'service_style'    			=> '',
				'title'  		   			=> '',
				'description'  	   			=> '',
				'linktext'  	   			=> esc_html__( 'Read me', 'bluishost' ),
				'linkurl'  	   				=> '',
				'iconbordercolor'  			=> '',
				'titlecolor'  	   			=> '',
				'icontype'    	   			=> 'fontawesome',
				'feature_image'     		=> '',
				'icon_fontawesome' 			=> '',
				'icon_openic'				=> '',
				'icon_typicons'				=> '',
				'icon_entypo'				=> '',
				'icon_linecons'				=> '',
				'icon_monosocial'			=> '',
				'icon_material'				=> '',
				'serv_image'				=> '',
				'front_icontype'    	   	=> 'fontawesome',
				'front_icon_fontawesome' 	=> '',
				'front_icon_openic'			=> '',
				'front_icon_typicons'		=> '',
				'front_icon_entypo'			=> '',
				'front_icon_linecons'		=> '',
				'front_icon_monosocial'		=> '',
				'front_icon_material'		=> '',
				'front_image'				=> '',
				'back_icontype'    	   		=> 'fontawesome',
				'back_icon_fontawesome' 	=> '',
				'back_icon_openic'			=> '',
				'back_icon_typicons'		=> '',
				'back_icon_entypo'			=> '',
				'back_icon_linecons'		=> '',
				'back_icon_monosocial'		=> '',
				'back_icon_material'		=> '',
				'back_image'				=> '',
				'icon_size'					=> '60',
				'imgicon' 					=> '',
				'iconcolor'  	   			=> '',
				'fronticoncolor'  	   		=> '',
				'backiconcolor'  	   		=> '',
				'contentcolor'  			=> '',
				'linkcolor'  				=> '',
				'linkhovercolor'  			=> '',
				'bgcolor'  					=> '',
				'bg_color' 	    			=> '',
				'simple_bg_color' 	    	=> '',
				'bg_gradient_start' 		=> '',
				'bg_gradient_end' 	    	=> '',
				'bg_hv_color' 	    		=> '',
				'simple_bg_hv_color' 		=> '',
				'bg_gradient_hv_start' 		=> '',
				'bg_gradient_hv_end' 		=> '',
				'animation' 	   			=> '',
				'duration' 	   	   			=> '.1',
				'css' 	   		   			=> '',
				'el_class'		   			=> ''
			),
		$atts
		) );
		
		// uniq id
		$uniqId = 'service_'.uniqid();
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostservice', $atts );
		
		if( $animation ){
			$animation = $animation;
		}else{
			$animation = 'fadeInUp';
		}

		// Font type and settings
		vc_icon_element_fonts_enqueue( $icontype );

		$serviceiconarr = array(
            'awesome'       =>  $icon_fontawesome, 
            'openic'        =>  $icon_openic, 
            'entypo'        =>  $icon_entypo, 
            'typicons'      =>  $icon_typicons, 
            'linecons'      =>  $icon_linecons, 
            'monosocial'    =>  $icon_monosocial, 
            'material'      =>  $icon_material, 
            'img'           => !empty( $serv_image) ? $serv_image : '' 
        );

        $service_icon_val = $this->helper->bluishost_font_icon_process($icontype, $serviceiconarr);

        // Front Icon Font type and settings
		vc_icon_element_fonts_enqueue( $front_icontype );

		$fronticonarr = array(
            'awesome'       =>  $front_icon_fontawesome, 
            'openic'        =>  $front_icon_openic, 
            'entypo'        =>  $front_icon_entypo, 
            'typicons'      =>  $front_icon_typicons, 
            'linecons'      =>  $front_icon_linecons, 
            'monosocial'    =>  $front_icon_monosocial, 
            'material'      =>  $front_icon_material, 
            'img'           => !empty( $front_image) ? $front_image : '' 
        );

        $front_icon_val = $this->helper->bluishost_font_icon_process($front_icontype, $fronticonarr);

        // Back Icon Font type and settings
		vc_icon_element_fonts_enqueue( $back_icontype );

		$backiconarr = array(
            'awesome'       =>  $back_icon_fontawesome, 
            'openic'        =>  $back_icon_openic, 
            'entypo'        =>  $back_icon_entypo, 
            'typicons'      =>  $back_icon_typicons, 
            'linecons'      =>  $back_icon_linecons, 
            'monosocial'    =>  $back_icon_monosocial, 
            'material'      =>  $back_icon_material, 
            'img'           => !empty( $back_image) ? $back_image : '' 
        );

        $back_icon_val = $this->helper->bluishost_font_icon_process($back_icontype, $backiconarr);
		
		// Font type and settings
		$Css = '';
		//Service Style
		if( $service_style ) {
			$alignment = ' text-'.$service_style;
		}else{
			$alignment = ' text-left';
		}
		// Center Position
		if( $service_style == 'center' ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-home-feature h3::before {left:0; right:0; margin: auto}';
		}
		// Right Position
		if( $service_style == 'right' ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-home-feature h3::before {right:0; left:none!important}';
		}
		//Icon Font Size
		if( $icon_size ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-home-feature i, .single-home-feature i.fa{font-size:'.esc_attr( $icon_size ).'px;}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .single-service-front .service-icon i, .single-service .single-service-front .service-icon i.fa{font-size:'.esc_attr( $icon_size ).'px;}';
		}
		//Icon Color
		if( $iconcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-home-feature i.fa{color:'.esc_attr( $iconcolor ).';}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .single-service-front .service-icon i.fa{color:'.esc_attr( $iconcolor ).';}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .single-service-front .service-icon svg path{fill:'.esc_attr( $iconcolor ).';}';
		}
		
		// Front Icon Color
		if( $fronticoncolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .single-service-front .service-icon i.fa{color:'.esc_attr( $fronticoncolor ).';}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .single-service-front .service-icon svg path{fill:'.esc_attr( $fronticoncolor ).';}';
		}

		// Back Icon Color
		if( $backiconcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .single-service-back .service-hover-inner i.fa{color:'.esc_attr( $backiconcolor ).';}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .single-service-back .service-hover-inner svg path{fill:'.esc_attr( $backiconcolor ).';}';
		}

		//Icon Border Color
		if( $iconbordercolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-home-feature h3:before{background-color:'.esc_attr( $iconbordercolor ).'!important;}';
		}
		//Title Color
		if( $titlecolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-home-feature h3{color:'.esc_attr( $titlecolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service.dark h3{color:'.esc_attr( $titlecolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service h3{color:'.esc_attr( $titlecolor ).'!important;}';
		}
		//Content Color
		if( $contentcolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-home-feature p{color:'.esc_attr( $contentcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service.dark p{color:'.esc_attr( $contentcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service p{color:'.esc_attr( $contentcolor ).'!important;}';
		}

		if( $linkcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-service.dark .service-btn{color:'.esc_attr( $linkcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .service-btn{color:'.esc_attr( $linkcolor ).'!important;}';
		}

		if( $linkhovercolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-service.dark .service-btn:hover{color:'.esc_attr( $linkhovercolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .service-btn:hover{color:'.esc_attr( $linkhovercolor ).'!important;}';
		}

		if( $bgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-service.dark .single-service-front{background-color:'.esc_attr( $bgcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqId ).'.single-service .single-service-front{background-color:'.esc_attr( $bgcolor ).'!important;}';
		}

		
		//Simple and Gradient Background Color
		if( $bg_color == 'gradient' ){
			if(  !empty($bg_gradient_start) || !empty($bg_gradient_end) ){
				$Css .= '#'.esc_attr( $uniqId ).' .single-service-back{ background: -webkit-linear-gradient(top, '.esc_attr( $bg_gradient_start ).' 0%,'.esc_attr( $bg_gradient_end ).' 100%);}';
				$Css .= '#'.esc_attr( $uniqId ).' .single-service-back{ background: linear-gradient(to bottom, '.esc_attr( $bg_gradient_start ).' 0%,'.esc_attr( $bg_gradient_end ).' 100%);}';
			}
		}else{
			if( !empty( $simple_bg_color ) ) {
				$Css .= '#'.esc_attr( $uniqId ).' .single-service-back.dark{background:'.esc_attr( $simple_bg_color ).'!important;}';
				$Css .= '#'.esc_attr( $uniqId ).' .single-service-back{background:'.esc_attr( $simple_bg_color ).'!important;}';

			}
		}


		if ( $el_class ) {
			$el_class = ' '.$el_class;
		} else {
			$el_class = ' ';
		}
	
		ob_start();
		?>

		<?php if ( $styletype == 'styleone' ) : ?>

		<div id="<?php echo esc_attr( $uniqId ); ?>" class="single-home-feature <?php echo esc_attr( $alignment.$css_class.$el_class ); ?>" data-animate="<?php echo esc_attr( $animation ) ?>" data-delay="<?php echo esc_attr( $duration ); ?>">
			<?php 
			
				if( $service_icon_val ) {
					echo wp_kses_post( $service_icon_val );
				}
			
				//
				if( $title ){
					echo '<h3>'.esc_html( $title ).'</h3>';
				}
				//
				if( $description ){
					echo '<p>'.wp_kses_post( $description ).'</p>';
				}
			?>
		</div>

		<?php else : ?>
			<!-- Single Service -->
            <div id="<?php echo esc_attr( $uniqId ); ?>" class="single-service <?php echo esc_attr( $alignment.$css_class.$el_class ); ?>" data-animate="<?php echo esc_attr( $animation ) ?>" data-delay="<?php echo esc_attr( $duration ); ?>">
                <div class="single-service-inner">
                    <div class="single-service-front">
                        <div class="service-icon">
                            <?php 
                            	if ( !empty( $front_icon_val ) ) :
                            		echo wp_kses_post( $front_icon_val );
                            	endif;
                            ?>
                        </div>
                        <?php 
                        	if( $title ){
								echo '<h3>'.esc_html( $title ).'</h3>';
							}
							//
							if( $description ){
								echo '<p>'.wp_kses_post( $description ).'</p>';
							}

							if( ! empty( $linkurl ) ) {
								echo '<a href="'. esc_url( $linkurl ) .'" class="service-btn">'. esc_html( $linktext ) .' <i class="fa fa-angle-right"></i></a>';
							}
                        ?>

                        
                    </div>
                        
                    <div class="single-service-back">
                        <div class="service-hover-inner">
                            <?php
                            	if ( !empty( $back_icon_val ) ) :
                            		echo wp_kses_post( $back_icon_val );
                            	endif;

                            	if( ! empty( $linkurl ) ) {
									echo '<a href="'. esc_url( $linkurl ) .'" class="service-btn">'. esc_html( $linktext ) .' <i class="fa fa-angle-right"></i></a>';
								}
                            ?>
                        </div>
                    </div>
                </div>
            </div>
			<!-- End of Single Service -->
		<?php
		endif;

		if( $Css ){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
	
	}
	
}

$sectheading = new WPBakeryShortCode_service();