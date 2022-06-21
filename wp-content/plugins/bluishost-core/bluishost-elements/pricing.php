<?php 
/**
 * Bluishost pricing Element
 */
class WPBakeryShortCode_bluishost_pricing extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_price_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostprice', array( $this, 'bluishost_pricint_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_price_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => esc_html__( "Pricing Table", "bluishost" ),
		  "base" => "bluishostprice",
		  "class" => "",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => esc_html__( "Bluishost", "bluishost"),
		  "params" => array(

		  	array(
		  		"type"		=> "dropdown",
		  		"heading"	=> esc_html__( "Style Type", "bluishost" ),
		  		"param_name"	=> "styletype",
		  		'value'         => array(
	                esc_html__( 'Default', 'bluishost' )  		=> 'styleone',
	                esc_html__( 'Style One', 'bluishost' )  	=> 'styleone',
	                esc_html__( 'Style Two', 'bluishost' )   	=> 'styletwo',
	            	),
	            'std'			=> 'styleone',
		  	),
		  	array(
				"type" => "checkbox",
				"heading" => esc_html__( "Active", "bluishost" ),
				"param_name" => "active",
				"description" => esc_html__( "Set pricing table active.", "bluishost" ),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styletwo' ),
				)
			),
		  	array(
				"type" => "checkbox",
				"heading" => esc_html__( "Popular", "bluishost" ),
				"param_name" => "popular",
				"description" => esc_html__( "Set pricing table ribbon.", "bluishost" ),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styleone' ),
				)
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Popular Text", "bluishost" ),
				"param_name" => "populartext",
				"description" => esc_html__( "Set ribbon text.", "bluishost" ),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styleone' ),
				)
			),
  			array(
				"type" => "textfield",
				"heading" => esc_html__( "Title", "bluishost" ),
				"param_name" => "title",
				"description" => esc_html__( "Set pricing table title.", "bluishost" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Sub Title", "bluishost" ),
				"param_name" => "subtitle",
				"description" => esc_html__( "Set pricing table sub title.", "bluishost" )
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
	            'dependency'	=> array(
	            	'element'	=> 'styletype',
	            	'value'		=> array( 'styletwo' )
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
				'param_name' 	=> 'icon_image',
				'description' 	=> esc_html__( 'Set image.', 'bluishost' ),
				'dependency' 	=> array(
					'element' => 'icontype',
					'value'   => 'imageicon',
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Currency", "bluishost" ),
				"param_name" => "currency",
				"description" => esc_html__( "Set Currency.", "bluishost" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Price", "bluishost" ),
				"param_name" => "price",
				"description" => esc_html__( "Set price.", "bluishost" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Duration", "bluishost" ),
				"param_name" => "duration",
				"description" => esc_html__( "Set duration.", "bluishost" )
			),
			array(
				"type" => "param_group",
				'param_name' => 'featuresgroup',
				'heading' => esc_html__('Pricing Features',"bluishost"),
				'params' => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => esc_html__( "Feature", "bluishost" ),
						"param_name" => "feature",
					),
				)
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Button Text", "bluishost" ),
				"param_name" => "btntext",
				"description" => esc_html__( "Set button text.", "bluishost" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Button Url", "bluishost" ),
				"param_name" => "btnurl",
				"description" => esc_html__( "Set button url.", "bluishost" )
			),
			
			array(
				"type" => "css_editor",
				"heading" => esc_html__("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => esc_html__( 'Animation Style', "bluishost" ),
				'param_name' => 'animation',
				'description' => esc_html__( 'Choose your animation style', "bluishost" ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Animation Time Delay", "bluishost" ),
				"param_name" => "timedelay",
				"description" => esc_html__( "Set animation time delay.", "bluishost" ),
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Text Primary Color", "bluishost" ),
				"param_name" => "txprcolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Text Secondary Color", "bluishost" ),
				"param_name" => "txsccolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Background Primary Color", "bluishost" ),
				"param_name" => "bgprcolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"		=> "styletype",
					"value"			=> "styleone"
				)
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Background Secondary Color", "bluishost" ),
				"param_name" => "bgsccolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "styleone"
				)
			),
			// Gradient and Simple Color Start
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Background Color", "bluishost" ),
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

			// Gradient and Simple Hover Color Start
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Background Hover Color", "bluishost" ),
				"param_name" 	=> "bg_hv_color",
				"value"			=> array(
					esc_html__("Simple Background Hover Color","bluishost")		=> 'simple_hv',
					esc_html__("Gradient Background Hover Color","bluishost")	=> 'gradient_hv',
				),
				"std"  			=> "simple_hv",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
				"dependency" 	=> array(
                    'element' => 'styletype',
                    'value'   => 'styletwo',
                ),	
			),
			array(
				"type" 				=> "colorpicker",
				"heading" 			=> esc_html__( "Background Hover Color", "bluishost" ),
				"param_name" 		=> "simple_bg_hv_color",
				"dependency"		=> array(
					"element"			=> "bg_hv_color",
					"value"				=> array("simple_hv")	
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color Start From", "bluishost" ),
				"param_name" 		=> "bg_gradient_hv_start",
				"dependency"		=> array(
					"element"			=> "bg_hv_color",
					"value"				=> array("gradient_hv")	
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color End To", "bluishost" ),
				"param_name" 		=> "bg_gradient_hv_end",
				"dependency"		=> array(
					"element"			=> "bg_hv_color",
					"value"				=> array("gradient_hv")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			// Gradient and Simple Hover Color End
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Button Text Color", "bluishost" ),
				"param_name" => "btntxtcolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Button Hover Text Color", "bluishost" ),
				"param_name" => "btntxthvcolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Button Background Color", "bluishost" ),
				"param_name" => "btnbgcolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "styleone"
				)
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Button Background Hover Color", "bluishost" ),
				"param_name" => "btnbghvcolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "styleone"
				)
			),
			// Button Gradient and Simple Color Start
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Button Background Color", "bluishost" ),
				"param_name" 	=> "btn_bg_color",
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
				"param_name" 		=> "btn_simple_bg_color",
				"dependency"		=> array(
					"element"			=> "btn_bg_color",
					"value"				=> array("simple")	
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color Start From", "bluishost" ),
				"param_name" 		=> "btn_bg_gradient_start",
				"dependency"		=> array(
					"element"			=> "btn_bg_color",
					"value"				=> array("gradient")	
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color End To", "bluishost" ),
				"param_name" 		=> "btn_bg_gradient_end",
				"dependency"		=> array(
					"element"			=> "btn_bg_color",
					"value"				=> array("gradient")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			// Button Gradient and Simple Color End

			// Button Gradient and Simple Hover Color Start
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Button Background Hover Color", "bluishost" ),
				"param_name" 	=> "btn_bg_hv_color",
				"value"			=> array(
					esc_html__("Simple Background Hover Color","bluishost")		=> 'simple_hv',
					esc_html__("Gradient Background Hover Color","bluishost")	=> 'gradient_hv',
				),
				"std"  			=> "simple_hv",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
				"dependency" 	=> array(
                    'element' => 'styletype',
                    'value'   => 'styletwo',
                ),	
			),
			array(
				"type" 				=> "colorpicker",
				"heading" 			=> esc_html__( "Background Hover Color", "bluishost" ),
				"param_name" 		=> "btn_simple_bg_hv_color",
				"dependency"		=> array(
					"element"			=> "btn_bg_hv_color",
					"value"				=> array("simple_hv")	
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color Start From", "bluishost" ),
				"param_name" 		=> "btn_bg_gradient_hv_start",
				"dependency"		=> array(
					"element"			=> "btn_bg_hv_color",
					"value"				=> array("gradient_hv")	
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color End To", "bluishost" ),
				"param_name" 		=> "btn_bg_gradient_hv_end",
				"dependency"		=> array(
					"element"			=> "btn_bg_hv_color",
					"value"				=> array("gradient_hv")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),	
			),
			// Button Gradient and Simple Hover Color End
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Border Color", "bluishost" ),
				"param_name" => "bordercolor",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
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
	public function bluishost_pricint_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'styletype'  	   => 'styleone',
				'active'  		   => '',
				'title'  		   => '',
				'subtitle'  	   => '',
				'currency'  	   => '',
				'price'  	   	   => '',
				'duration'  	   => '',
				'featuresgroup'    => '',
				'btntext'    	   => '',
				'btnurl'    	   => '',
				'active'    	   => '',
				'popular'    	   => '',
				'populartext'      => '',
				'icontype'    	   	=> 'fontawesome',
				'feature_image'     => '',
				'icon_fontawesome' 	=> '',
				'icon_openic'		=> '',
				'icon_typicons'		=> '',
				'icon_entypo'		=> '',
				'icon_linecons'		=> '',
				'icon_monosocial'	=> '',
				'icon_material'		=> '',
				'icon_image'		=> '',
				'animation' 	    => '',
				'timedelay' 	    => '',
				'css' 	   		    => '',
				'el_class' 	   		=> '',
				'txprcolor' 	    => '',
				'txsccolor' 	    => '',
				'bgprcolor' 	    => '',
				'bgsccolor' 	    => '',
				'bg_color' 	    		=> '',
				'simple_bg_color' 	    => '',
				'bg_gradient_start' 	=> '',
				'bg_gradient_end' 	    => '',
				'bg_hv_color' 	    	=> '',
				'simple_bg_hv_color' 	=> '',
				'bg_gradient_hv_start' 	=> '',
				'bg_gradient_hv_end' 	=> '',
				'btn_bg_color' 			=> '',
				'btn_simple_bg_color' 		=> '',
				'btn_bg_gradient_start' 	=> '',
				'btn_bg_gradient_end' 		=> '',
				'btn_bg_hv_color'		=> '',
				'btn_simple_bg_hv_color'	=> '',
				'btn_bg_gradient_hv_start'  => '',
				'btn_bg_gradient_hv_end'	=> '',
				'btntxtcolor' 	    => '',
				'btntxthvcolor'     => '',
				'btnbgcolor'        => '',
				'btnbghvcolor'      => '',
				'bordercolor'       => '',
			),
		$atts
		) );
		
		$uniqID = uniqid( 'bstable' ).'-'.rand(1, 9999);

		$Css = '';

		// Text Primary Color
		if( $txprcolor ) {
			$Css .= '#'.esc_attr( $uniqID ).'.single-pricing-plan h3{color:'. esc_attr( $txprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single-pricing-plan ul + span{color:'. esc_attr( $txprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .pt_header h2{color:'. esc_attr( $txprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .pt_header:after{background-color:'. esc_attr( $txprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .pt_body svg path{fill:'. esc_attr( $txprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .pt_body .pt_price{color:'. esc_attr( $txprcolor ) .'; }';
		}
		// Text Secondary Color
		if( $txsccolor ) {
			$Css .= '#'.esc_attr( $uniqID ).'.single-pricing-plan p{color:'. esc_attr( $txsccolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single-pricing-plan ul li{color:'. esc_attr( $txsccolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single-pricing-plan ul + span sub{color:'. esc_attr( $txsccolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .pt_body .pt_feature{color:'. esc_attr( $txsccolor ) .'; }';
		}
		// Background Primary Color
		if( $bgprcolor ) {
			$Css .= '#'.esc_attr( $uniqID ).' .bg-dark:before{background-color:'. esc_attr( $bgprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single-pricing-plan p:before{background-color:'. esc_attr( $bgprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single-pricing-plan .popular{background-color:'. esc_attr( $bgprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4.dark{background-color:'. esc_attr( $bgprcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4{background-color:'. esc_attr( $bgprcolor ) .'; }';
		}
		// Background Secondary Color
		if( $bgsccolor ) {
			$Css .= '#'.esc_attr( $uniqID ).'.single-pricing-plan{background-color:'. esc_attr( $bgsccolor ) .'; }';
		}
		// Button
		if( $btntxtcolor || $btntxthvcolor || $btnbgcolor || $btnbghvcolor || $bordercolor ) {
			$Css .= '#'.esc_attr( $uniqID ).' .btn-transparent{color:'. esc_attr( $btntxtcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-transparent:hover{color:'. esc_attr( $btntxthvcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient{color:'. esc_attr( $btntxtcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient:hover{color:'. esc_attr( $btntxtcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-transparent{background-color:'. esc_attr( $btnbgcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-transparent:hover{background-color:'. esc_attr( $btnbghvcolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-transparent{border-color:'. esc_attr( $bordercolor ) .'; }';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient{border-color:'. esc_attr( $bordercolor ) .'; }';
		}

		//Simple and Gradient Background Color
		if( $bg_color == 'gradient' ){
			if(  !empty($bg_gradient_start) || !empty($bg_gradient_end) ){
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4{ background: -webkit-linear-gradient(top, '.esc_attr( $bg_gradient_start ).' 0%,'.esc_attr( $bg_gradient_end ).' 100%);}';
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4{ background: linear-gradient(to bottom, '.esc_attr( $bg_gradient_start ).' 0%,'.esc_attr( $bg_gradient_end ).' 100%);}';
			}
		}else{
			if( !empty( $simple_bg_color ) ) {
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4.dark{background:'.esc_attr( $simple_bg_color ).'!important;}';
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4{background:'.esc_attr( $simple_bg_color ).'!important;}';

			}
		}

		//Simple and Gradient Background Hover Color
		if( $bg_hv_color == 'gradient_hv' ){
			if(  !empty($bg_gradient_hv_start) || !empty($bg_gradient_hv_end) ){
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4:after{ background: linear-gradient(to right, '.esc_attr( $bg_gradient_hv_start ).' 0%,'.esc_attr( $bg_gradient_hv_end ).' 100%)!important;}';
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4:after{ background: -webkit-linear-gradient(bottom, '.esc_attr( $bg_gradient_hv_start ).' 0%,'.esc_attr( $bg_gradient_hv_end ).' 100%)!important;}';
			}
		}else{
			if( !empty( $simple_bg_hv_color ) ) {
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4:hover{background:'.esc_attr( $simple_bg_hv_color ).'!important;}';

			}
		}

		//Button Simple and Gradient Background Color
		if( $btn_bg_color == 'gradient' ){
			if(  !empty($btn_bg_gradient_start) || !empty($btn_bg_gradient_end) ){
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .btn-gradient{ background: linear-gradient(to right, '.esc_attr( $btn_bg_gradient_start ).' 0%,'.esc_attr( $btn_bg_gradient_end ).' 100%);}';
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .btn-gradient{ background: -webkit-linear-gradient(left, '.esc_attr( $btn_bg_gradient_start ).' 0%,'.esc_attr( $btn_bg_gradient_end ).' 100%);}';
			}
		}else{
			if( !empty( $btn_simple_bg_color ) ) {
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .btn-gradient{background:'.esc_attr( $btn_simple_bg_color ).'!important;}';

			}
		}

		//Button Simple and Gradient Background Hover Color
		if( $btn_bg_hv_color == 'gradient_hv' ){
			if(  !empty($btn_bg_gradient_hv_start) || !empty($btn_bg_gradient_hv_end) ){
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .btn-gradient:hover{ background: linear-gradient(to right, '.esc_attr( $btn_bg_gradient_hv_start ).' 0%,'.esc_attr( $btn_bg_gradient_hv_end ).' 100%)!important;}';
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .btn-gradient:hover{ background: -webkit-linear-gradient(left, '.esc_attr( $btn_bg_gradient_hv_start ).' 0%,'.esc_attr( $btn_bg_gradient_hv_end ).' 100%)!important;}';
			}
		}else{
			if( !empty( $btn_simple_bg_hv_color ) ) {
				$Css .= '#'.esc_attr( $uniqID ).'.single_pricing_table--4 .btn-gradient:hover{background:'.esc_attr( $btn_simple_bg_hv_color ).'!important;}';

			}
		}
	
		$features = vc_param_group_parse_atts( $featuresgroup );
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		if( $animation ) {
			$animation = $animation;
		}else{
			$animation = 'fadeInUp';
		}

		if( $timedelay ) {
			$timedelay = $timedelay;
		}else{
			$timedelay = '.1';
		}

		vc_icon_element_fonts_enqueue( $icontype );

		if ( $active ) {
			$active = ' active';
		} else {
			$active = '';
		}

		$priciconarr = array(
            'awesome'       =>  $icon_fontawesome,
            'openic'        =>  $icon_openic,
            'entypo'        =>  $icon_entypo,
            'typicons'      =>  $icon_typicons,
            'linecons'      =>  $icon_linecons,
            'monosocial'    =>  $icon_monosocial,
            'material'      =>  $icon_material,
            'img'           => !empty( $icon_image) ? $icon_image : '' 
        );

        $price_icon_val = $this->helper->bluishost_font_icon_process($icontype, $priciconarr);

        // Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostprice', $atts );
		

		ob_start();
		?>
			<!-- Pricing Item Start -->
		<?php if ( $styletype == 'styleone' ) : ?>
			<div id="<?php echo esc_attr( $uniqID ); ?>" class="single-pricing-plan text-center <?php echo esc_attr( $css_class.$el_class ); ?>" data-animate="<?php echo esc_attr( $animation ); ?>" data-delay="<?php echo esc_attr( $timedelay ); ?>">

				<?php 
				// Popular Text
				if( $populartext ){
					$populartext = $populartext;
				}else{
					$populartext = __( 'Popular Sale', 'bluishost' );
				}
				// Popular
				if( $popular ){
					echo '<span class="popular">'.esc_html( $populartext ).'</span>';
				}
				
				// Pricing Title
				if( $title ){
					echo '<h3>'.esc_html( $title ).'</h3>';
				}
				// Pricing SubTitle
				if( $subtitle ) {
					echo '<p>'. wp_kses_post( $subtitle ) .'</p>';
				}

				//  features
				if( $features ):
				echo '<ul class="karla list-unstyled text-left">';
					foreach( $features as $feature ):
				
						if( !empty( $feature['feature'] ) ){
							echo '<li>'.wp_kses_post( $feature['feature'] ).'</li>';
						}

					endforeach;
				echo '</ul>';
				endif;

				if( $price ){
					$durationSet = '';
					$currencySet = '';

					if( $currency ){
						$currencySet = '<sup>'.$currency.'</sup>';
					}

					if( $duration ){
						$durationSet = '<sub class="karla">'.$duration.'</sub>';
					}

					echo '<span class="text-left">'.wp_kses_post( $currencySet ).esc_html( $price ).wp_kses_post( $durationSet ).'</span>';
				}

				// Button 
				if( $btntext && $btnurl ){
					echo '<div class="purchase bg-dark bg-rotate position-relative">';
						echo '<a href="'.esc_url( $btnurl ).'" class="btn btn-transparent">'.esc_html( $btntext ).'</a>';
					echo '</div>';	
				}

				?>
			</div>
		<?php else : ?>
			<div id="<?php echo esc_attr( $uniqID ); ?>" class="single_pricing_table--4 text-center <?php echo esc_attr( $active.$css_class.$el_class ); ?>" data-animate="<?php echo esc_attr( $animation ); ?>" data-delay="<?php echo esc_attr( $timedelay ); ?>">
				
				<div class="pt_header">
					<?php 
						if( $title ){
							echo '<h2>'.esc_html( $title ).'</h2>';
						}
						// Pricing SubTitle
						if( $subtitle ) {
							echo '<p>'. wp_kses_post( $subtitle ) .'</p>';
						}
					?>
				</div>

				<div class="pt_body">
                    <?php 
                        // feature Icon
                        echo '<div class="pt-icon">';
							if( $price_icon_val ){
								echo wp_kses_post( $price_icon_val );
							}
						echo '</div>';
                    ?>
                    <div class="pt_feature karla">
						<?php
							//  features
							if( $features ):
							echo '<ul class="list-unstyled mb-0">';
								foreach( $features as $feature ):
							
									if( !empty( $feature['feature'] ) ){
										echo '<li>'.wp_kses_post( $feature['feature'] ).'</li>';
									}

								endforeach;
							echo '</ul>';
							endif;
						?>
					</div>
					<div class="pt_price">
						<?php
							if( $price ){

								if( $currency ){
									echo '<small>'. esc_html( $currency ) .'</small>';
								}

								echo '<span>'.esc_html( $price ).'</span>';

								if( $duration ){
									echo '<small>'.esc_html( $duration ).'</small>';
								}
							}
						?>
					</div>
				</div>
				<div class="pt_footer">
					<?php 
					// Button 
					if( $btntext && $btnurl ){
						echo '<a href="'.esc_url( $btnurl ).'" class="btn btn-gradient">'.esc_html( $btntext ).'</a>';
					}
					?>
				</div>
			</div>
		<?php
		endif;

		if( $Css ){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	}
	
}

$sectheading = new WPBakeryShortCode_bluishost_pricing();