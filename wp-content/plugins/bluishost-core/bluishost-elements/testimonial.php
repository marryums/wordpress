<?php 
/**
 * Bluishost testimonial section elements
 */
class WPBakeryShortCode_bluishost_testimonial extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper();
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_testimonial_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishosttestimonial', array( $this, 'bluishost_testimonial_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_testimonial_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Testimonial", "bluishost" ),
		  "base" => "bluishosttestimonial",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(
		
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Testimonial Style', 'bluishost' ),
				'description'	=> esc_html__( 'Select testimonial style', 'bluishost' ),
				'param_name' 	=> 'styletype',
				"group"		 	=> esc_html__( "Testimonial", "bluishost" ),
				'value'         => array(
	                esc_html__( 'Default', 'bluishost' )  				=> 'styleone',
	                esc_html__( 'Testimonial Style O1', 'bluishost' )  	=> 'styleone',
	                esc_html__( 'Testimonial Style O2', 'bluishost' )   => 'styletwo',
	                esc_html__( 'Testimonial Style O3', 'bluishost' )   => 'stylethree',
	            	),
	            'std'			=> 'styleone',
			),
			// Testmonial One
		  	array(
				"type"		 => "param_group",
				'param_name' => 'testimonials',
				"group"		 => esc_html__( "Testimonial", "bluishost" ),
				'heading' 	 => esc_html__( 'Set Testimonial', 'bluishost' ),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styleone' ),
				),
				'params' 	 => array(
					
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Name", "bluishost" ),
						"param_name" => "name",
					),	
					array(
						"type" 		  => "textfield",
						"heading" 	  => esc_html__( "Designation/Address", "bluishost" ),
						"param_name"  => "designation",
						"description" => esc_html__( "Set designation.", "bluishost" )
					),
					array(
						"type" 		 => "textarea",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Description", "bluishost" ),
						"param_name" => "description",
					),	
							
				)
			),
			// Testmonial Two
			array(
				"type"		 => "param_group",
				'param_name' => 'testimonialtwo',
				"group"		 => esc_html__( "Testimonial", "bluishost" ),
				'heading' 	 => esc_html__( 'Set Testimonial', 'bluishost' ),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styletwo' ),
				),
				'params' 	 => array(
					
					array(
						"type" 		 => "attach_image",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Client Image", "bluishost" ),
						"param_name" => "image",
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
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Name", "bluishost" ),
						"param_name" => "name",
					),
					array(
						"type" 		  => "textfield",
						"heading" 	  => esc_html__( "Designation/Address", "bluishost" ),
						"param_name"  => "designation",
						"description" => esc_html__( "Set designation.", "bluishost" )
					),
					array(
						"type" 		 => "textarea",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Description", "bluishost" ),
						"param_name" => "description",
					),	
							
				)
			),
			// Testimonial Three
			array(
				"type"		 => "param_group",
				'param_name' => 'testimonialthree',
				"group"		 => esc_html__( "Testimonial", "bluishost" ),
				'heading' 	 => esc_html__( 'Set Testimonial', 'bluishost' ),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'stylethree' ),
				),
				'params' 	 => array(
					
					array(
						"type" 		 => "attach_image",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Client Image", "bluishost" ),
						"param_name" => "image",
					),
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Name", "bluishost" ),
						"param_name" => "name",
					),
					array(
						"type" 		  => "textfield",
						"heading" 	  => esc_html__( "Designation/Address", "bluishost" ),
						"param_name"  => "designation",
						"description" => esc_html__( "Set designation.", "bluishost" )
					),
					array(
						"type" 		 => "textarea",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Description", "bluishost" ),
						"param_name" => "description",
					),	
							
				)
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Pagination / Navigation', 'bluishost' ),
				'description'	=> esc_html__( 'Select pagination / nevigation', 'bluishost' ),
				'param_name' 	=> 'pgnavtype',
				"group"		 	=> esc_html__( "Testimonial", "bluishost" ),
				'value'         => array(
	                esc_html__( 'Default', 'bluishost' )  		=> 'pagination',
	                esc_html__( 'Pagination', 'bluishost' )  	=> 'pagination',
	                esc_html__( 'Navigation', 'bluishost' )   	=> 'navigation',
	            	),
	            'std'			=> 'pagination',
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Pagination / Navigation Background Type", "bluishost" ),
				"param_name" 	=> "panabgtype",
				"value" 		=> array(
        			esc_html__( "Normal", "bluishost" ) 		=> "normal",
        			esc_html__( "Gradient", "bluishost" )		=> "gradient"
        		),
        		"dependency" 	=> array(
					"element" 	=> "styletype",
					"value" 	=> "stylethree"
				),
				"group"		 => esc_html__( "Testimonial", "bluishost" ),
				"std"			=> 'normal',
			),
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "checkbox",
				"heading" 		=> esc_html__( "Background Pattern", "bluishost" ),
				"param_name" 	=> "bgpattern",
				"value" 		=> array(
        			"" 			=> "true"
        		),
        		"dependency" 	=> array(
					"element" 	=> "styletype",
					"value" 	=> "styletwo"
				),
				"group"		 	=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "attach_image",
				"holder" 		=> "div",
				"heading" 		=> esc_html__( "Pattern Image", "bluishost" ),
				"param_name" 	=> "ptimage",
				"description" 	=> esc_html__( "Set pattern image.", "bluishost" ),
				"dependency" 	=> array(
					"element" 	=> "bgpattern",
					"value" 	=> "true"
				),
				"group"		 	=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Icon Color", "bluishost" ),
				"param_name" => "iconcolor",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value" 	=> array( "styleone", "styletwo" )
				),
				"group"		 	=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Title Color", "bluishost" ),
				"param_name" => "titlecolor",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Designation / Address Color", "bluishost" ),
				"param_name" => "desicolor",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Text Color", "bluishost" ),
				"param_name" => "textcolor",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Primary Color", "bluishost" ),
				"param_name" => "primarybg",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value" 	=> "styleone"
				),
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Secondary Color", "bluishost" ),
				"param_name" => "secondarybg",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value" 	=> "styleone"
				),
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Background Color", "bluishost" ),
				"param_name" => "bgcolor",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value" 	=> array( "styletwo", "stylethree" )
				),
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "pagination Border Color", "bluishost" ),
				"param_name" 	=> "pgbdcolor",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value" 	=> "styletwo"
				),
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "pagination Icon Color", "bluishost" ),
				"param_name" 	=> "pgiconcolor",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value" 	=> array( "styletwo", "stylethree" )
				),
				"group"		 => esc_html__( "Design Option", "bluishost" ),
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
                    'value'   => 'stylethree',
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
                    'value'   => 'stylethree',
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
				'type' 		  => 'animation_style',
				'heading' 	  => esc_html__( 'Animation Style', 'bluishost' ),
				'param_name'  => 'animation',
				'description' => esc_html__( 'Choose your animation style', 'bluishost' ),
				'admin_label' => false,
				'weight' 	  => 0,
				"group"		  => esc_html__( "Design Option", "bluishost" ),
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
	public function bluishost_testimonial_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'styletype'  		=> 'styleone',
				'testimonials'  	=> '',
				'testimonialtwo'  	=> '',
				'testimonialthree'  => '',
				'icontype'    	   	=> 'fontawesome',
				'pgnavtype'    	   	=> 'pagination',
				'feature_image'     => '',
				'icon_fontawesome' 	=> '',
				'icon_openic'		=> '',
				'icon_typicons'		=> '',
				'icon_entypo'		=> '',
				'icon_linecons'		=> '',
				'icon_monosocial'	=> '',
				'icon_material'		=> '',
				'bgpattern'			=> '',
				'ptimage'			=> '',
				'panabgtype'		=> 'normal',
				'bgcolor'			=> '',
				'titlecolor'    	=> '',
				'desicolor'    	    => '',
				'iconcolor'    		=> '',
				'textcolor'     	=> '',
				'primarybg'     	=> '',
				'secondarybg'   	=> '',
				'pgbdcolor'   		=> '',
				'pgiconcolor'   	=> '',
				'pagination'    	=> '',
				'btn_bg_color' 			=> '',
				'btn_simple_bg_color' 		=> '',
				'btn_bg_gradient_start' 	=> '',
				'btn_bg_gradient_end' 		=> '',
				'btn_bg_hv_color'		=> '',
				'btn_simple_bg_hv_color'	=> '',
				'btn_bg_gradient_hv_start'  => '',
				'btn_bg_gradient_hv_end'	=> '',
				'animation' 		=> '',
				'css' 	   			=> '',
				'el_class' 	   		=> '',
			),
		$atts
		) );
		
		// Uniq ID
		$uniqID = uniqid( 'bhtestimonial' ).'-'.rand( 1, 9999 );

		$Css = '';

		// Icon Color
		if( $iconcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider .review-info i{color:'.esc_attr( $iconcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider--2 .single-review .review-text{color:'.esc_attr( $iconcolor ).'!important;}';
		}
		// Titel Color
		if( $titlecolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider .review-info h4{color:'.esc_attr( $titlecolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider--2 .single-review .review-info h3{color:'.esc_attr( $titlecolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider--3 .single-review .review-info h4{color:'.esc_attr( $titlecolor ).'!important;}';
		}
		
		// Designation / Address Color
		if( $desicolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider--3 .single-review .review-info span{color:'.esc_attr( $desicolor ).'!important;}';
		}
		//Text Color
		if( $textcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .review-info span{color:'.esc_attr( $textcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .single-review p{color:'.esc_attr( $textcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider--3 .single-review .review-content p{color:'.esc_attr( $textcolor ).'!important;}';
		}
		//Primary Background Color
		if( $primarybg ){
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider .swiper-slide:before, .review-info i:after{background-color:'.esc_attr( $primarybg ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .review-info i{color:'.esc_attr( $primarybg ).'!important;}';
		}
		//Secondary Background Color
		if( $secondarybg ){
			$Css .= '#'.esc_attr( $uniqID ).' .single-review{background-color:'.esc_attr( $secondarybg ).'!important;}';
		}

		// Background Color
		if( $bgcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider--2 .single-review .review-text{background-color:'.esc_attr( $bgcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .review-slider--3 .single-review .single-review-inner{background-color:'.esc_attr( $bgcolor ).'!important;}';
		}

		// Pattern Image
		if( $bgpattern ) {
			$ptimage = wp_get_attachment_image_src( $ptimage, 'full' );
			if( $ptimage ) {
				$Css .= '#'.esc_attr( $uniqID ).' .review-slider--2 .single-review .review-text{background-image: url('.esc_url($ptimage[0]).')!important;}';
			}
		}

		// Pagination Border Color
		if( $pgbdcolor ) {
			$Css .= '#'.esc_attr( $uniqID ). '.review-controls .carousel-control{border-color:'.esc_attr( $pgbdcolor ).'!important;}';
		}

		// Pagination Icon Color
		if( $pgiconcolor ) {
			$Css .= '#'.esc_attr( $uniqID ).'.review-controls .carousel-control svg .cls-1{fill:'.esc_attr( $pgiconcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .prev-review.prev-review--3 i, .next-review.next-review--3 i{color:'.esc_attr( $pgiconcolor ).'!important;}';
		}

		//Button Simple and Gradient Background Color
		if( $btn_bg_color == 'gradient' ){
			if(  !empty($btn_bg_gradient_start) || !empty($btn_bg_gradient_end) ){
				$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient{ background: linear-gradient(to right, '.esc_attr( $btn_bg_gradient_start ).' 0%,'.esc_attr( $btn_bg_gradient_end ).' 100%);}';
				$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient{ background: -webkit-linear-gradient(left, '.esc_attr( $btn_bg_gradient_start ).' 0%,'.esc_attr( $btn_bg_gradient_end ).' 100%);}';
			}
		}else{
			if( !empty( $btn_simple_bg_color ) ) {
				$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient{background:'.esc_attr( $btn_simple_bg_color ).'!important;}';

			}
		}

		//Button Simple and Gradient Background Hover Color
		if( $btn_bg_hv_color == 'gradient_hv' ){
			if(  !empty($btn_bg_gradient_hv_start) || !empty($btn_bg_gradient_hv_end) ){
				$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient:hover{ background: linear-gradient(to right, '.esc_attr( $btn_bg_gradient_hv_start ).' 0%,'.esc_attr( $btn_bg_gradient_hv_end ).' 100%)!important;}';
				$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient:hover{ background: -webkit-linear-gradient(left, '.esc_attr( $btn_bg_gradient_hv_start ).' 0%,'.esc_attr( $btn_bg_gradient_hv_end ).' 100%)!important;}';
			}
		}else{
			if( !empty( $btn_simple_bg_hv_color ) ) {
				$Css .= '#'.esc_attr( $uniqID ).' .btn-gradient:hover{background:'.esc_attr( $btn_simple_bg_hv_color ).'!important;}';

			}
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}

		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishosttestimonial', $atts );
		
		$testimonials 		= vc_param_group_parse_atts( $testimonials );
		$testimonialtwo 	= vc_param_group_parse_atts( $testimonialtwo );
		$testimonialthree 	= vc_param_group_parse_atts( $testimonialthree );
		
		ob_start();
		?>	

			<!-- Testimonial Slider Start -->
			
				<?php if ( $styletype == 'styleone' ) { ?>
					<div id="<?php echo esc_attr( $uniqID ); ?>" class="review-slider-wrap<?php echo esc_attr( $animation.$css_class ); ?>" data-animate="fadeInUp" data-delay=".4">

		                <div class="swiper-container review-slider <?php echo esc_attr($el_class) ?>">
		                    <div class="swiper-wrapper">

		                    	<?php 
								// Testimonial Item Start
								if( $testimonials ):
								foreach( $testimonials as $testimonial ):				
								?>
								<div class="swiper-slide bg-dark bg-rotate single-review">
									<?php  
									if( !empty( $testimonial['name'] ) || !empty( $testimonial['designation'] ) ):
									?>
									<div class="review-info">
										<i class="fas fa-quote-left float-left"></i>
										<?php
										// name
										if( !empty( $testimonial['name'] ) ){
											echo '<h4>'.esc_html( $testimonial['name'] ).'</h4>';
										}
										// Designation
										if( !empty( $testimonial['designation'] ) ){
											echo '<span>'.esc_html( $testimonial['designation'] ).'</span>';
										}
										?>
									</div>
									<?php
									endif;

									if( !empty( $testimonial['description'] ) ){
										echo '<p>'. esc_html( $testimonial['description'] ) .'</p>';
									}
									?>
								</div>
								
								<?php 
								endforeach;
								endif;
								// Testimonial Item End
								?>
		                        
		                    </div>
		                </div>
	            	</div>
	            	<?php
		                if( $pgnavtype	== 'navigation' ){
		                    
		            ?>
		            <div class="row">   
		                <div class="col-12">
		                    <ul id="<?php echo esc_attr( $uniqID ); ?>" class="review-controls nav justify-content-center" data-animate="fadeInUp" data-delay=".3">
		                        <li class="prev-review carousel-control d-flex align-items-center justify-content-center">
		                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/prev_icon.svg" alt="" class="svg">
		                        </li>
		                        <li class="next-review carousel-control d-flex align-items-center justify-content-center">
		                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/next_icon.svg" alt="" class="svg">
		                        </li>
		                    </ul>
		                </div>
		            </div>
		            <!-- Review slider pagination -->
		            <?php 
		                }else{
		                    echo '<div class="swiper-pagination review-pagination"></div>';
		                }
		            ?>
	            <?php }elseif( $styletype == 'styletwo' ) { ?>

	            	<div id="<?php echo esc_attr( $uniqID ); ?>" class="review-slider-wrap<?php echo esc_attr( $animation.$css_class ); ?>" data-animate="fadeInUp" data-delay=".4">
	            		<div class="swiper-container review-slider--2 <?php echo esc_attr($el_class) ?>" data-animate="fadeInUp" data-delay=".3">
		                    <div class="swiper-wrapper text-center">
		                        <!-- Single review -->
		                        <?php 

								// Testimonial Item Start
								if( $testimonialtwo ):
								foreach( $testimonialtwo as $testimonial02 ):				

		                        	vc_icon_element_fonts_enqueue( $testimonial02['icontype'] );
							
							        $testmonialiconarr = array(
							            'awesome'       =>  $testimonial02['icon_fontawesome'], 
							            'openic'        =>  $testimonial02['icon_openic'], 
							            'entypo'        =>  $testimonial02['icon_entypo'], 
							            'typicons'      =>  $testimonial02['icon_typicons'], 
							            'linecons'      =>  $testimonial02['icon_linecons'], 
							            'monosocial'    =>  $testimonial02['icon_monosocial'], 
							            'material'      =>  $testimonial02['icon_material'] 
							        );

							        $testmonial_icon_val = $this->helper->bluishost_font_icon_process($testimonial02['icontype'], $testmonialiconarr);

							        $clientimg_url = wp_get_attachment_image_src($testimonial02['image'],"full");
		                        ?>
		                        <div class="swiper-slide single-review">
		                            <div class="review-text">
		                                <?php 
		                                	echo wp_kses_post($testmonial_icon_val);

		                                	if( !empty( $testimonial02['description'] ) ){
												echo '<p>'. esc_html( $testimonial02['description'] ) .'</p>';
											}
		                                ?>
		                            </div>
		                            <div class="review-info">
		                                <?php  
		                                if( !empty( $clientimg_url[0] ) ) {
		                                	echo '<img src="'. esc_url( $clientimg_url[0] ) .'" alt="">';
		                                }

		                                if( !empty( $testimonial02['name'] ) ){
											echo '<h3>'. esc_html( $testimonial02['name'] ) .'</h3>';
										}

										if( !empty( $testimonial02['designation'] ) ){
											echo '<span>'. esc_html( $testimonial02['designation'] ) .'</span>';
										}
		                                ?>
		                            </div>
		                        </div>
		                        <?php 
		                        	endforeach;
		                        endif;
		                        ?>
		                        <!-- End of Single review -->
		                    </div>
		                </div>
	            	</div>
	            	 <!-- Review slider navigation -->
		            <?php
		                if( $pgnavtype	== 'navigation' ){
		                    
		            ?>
		            <div class="row">   
		                <div class="col-12">
		                    <ul id="<?php echo esc_attr( $uniqID ); ?>" class="review-controls nav justify-content-center" data-animate="fadeInUp" data-delay=".3">
		                        <li class="prev-review carousel-control d-flex align-items-center justify-content-center">
		                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/prev_icon.svg" alt="" class="svg">
		                        </li>
		                        <li class="next-review carousel-control d-flex align-items-center justify-content-center">
		                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/next_icon.svg" alt="" class="svg">
		                        </li>
		                    </ul>
		                </div>
		            </div>
		            <!-- Review slider pagination -->
		            <?php 
		                }else{
		                    echo '<div class="swiper-pagination review-pagination"></div>';
		                }
		            ?>

                <?php } else { ?>

                	<div id="<?php echo esc_attr( $uniqID ); ?>" class="review-slider-wrap <?php echo esc_attr( $animation.$css_class ); ?>">
	                    <div class="swiper-container review-slider--3<?php echo esc_attr( $el_class ) ?>">
	                        <div class="swiper-wrapper">
	                        	<!-- Single review -->
	                        	<?php 
	                        		if ( $testimonialthree ) :
	                        			foreach( $testimonialthree as $testimonial03 ) :
	                        				$clientimg_url = wp_get_attachment_image_src($testimonial03['image'],"full");

	                        	?>
	                            <div class="swiper-slide single-review">
	                                <div class="container">
	                                    <div class="row justify-content-center">
	                                        <div class="col-lg-7">
	                                            <div class="single-review-inner">
	                                                <div class="review-image">
	                                                    <?php
	                                                    	if( !empty( $clientimg_url[0] ) ) {
							                                	echo '<img src="'. esc_url( $clientimg_url[0] ) .'" alt="">';
							                                }
	                                                    ?>
	                                                </div>
	                                                <div class="review-content">
	                                                    <div class="review-info">
	                                                    	<?php 
	                                                    		if( !empty( $testimonial03['name'] ) ){
																	echo '<h4>'. esc_html( $testimonial03['name'] ) .'</h4>';
																}

																if( !empty( $testimonial03['designation'] ) ){
																	echo '<span>'. esc_html( $testimonial03['designation'] ) .'</span>';
																}
	                                                    	?>
	                                                    </div>
	                                                    <?php 
	                                                    	if( !empty( $testimonial03['description'] ) ){
																echo '<p>'. esc_html( $testimonial03['description'] ) .'</p>';
															}
	                                                    ?>
	                                                </div>
	                                                
	                                            </div>
	                
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <?php 
	                            		endforeach;
	                            	endif;
	                            ?>
                            	<!-- End of Single review -->
	                        </div>
	                    </div>
	                    <!-- Review slider pagination Start -->
	                    <?php
			                if ( $pgnavtype	== 'navigation' ) {

			                	if( $panabgtype == 'gradient' ) {
			                		$buttonclass = 'btn-gradient';
			                	}else{
			                		$buttonclass = '';
			                	}
			                    
			            ?>
			                    <div class="prev-review prev-review--3 <?php echo esc_attr( $buttonclass ); ?>">
			                        <i class="fas fa-angle-left"></i>
			                        <i class="fas fa-angle-left"></i>
			                    </div>
			                    <div class="next-review next-review--3 <?php echo esc_attr( $buttonclass ); ?>">
			                        <i class="fas fa-angle-right"></i>
			                        <i class="fas fa-angle-right"></i>
			                    </div>
		                    <?php
		                    }else{
			                    echo '<div class="swiper-pagination review-pagination"></div>';
			                }
	                	 ?>
	                    <!-- Review slider pagination End -->
	                </div>

            <?php 
            } 

            if( $Css ){
				echo $this->helper->bluishost_inline_css( $Css );
			}

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_bluishost_testimonial();