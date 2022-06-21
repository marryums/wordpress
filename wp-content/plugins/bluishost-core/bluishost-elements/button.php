<?php
/**
 * Bluishost Button Element
 */
class WPBakeryShortCode_button extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// bizdrone helper class
		$this->helper = new bluishost_helper() ;
		
		// bizdrone feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_button_maping' ) );
		
		// bizdrone feature shortcode
		add_shortcode( 'bluishostbutton', array( $this, 'bluishost_button_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_button_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => esc_html__( "Button", "bluishost" ),
		  "base" => "bluishostbutton",
		  "class" => "",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => esc_html__( "Bluishost", "bluishost"),
		  "params" => array(

		  	array(
				"type"          => "textfield",
				"heading"       => esc_html__( "Text", "bluishost" ),
                "param_name"    => "btn_text",
                "holder"        => "div",
				"description"   => esc_html__( "Set Button Text.", "bluishost" )
			),
		  	array(
				"type"          => "textfield",
				"heading"       => esc_html__( "URL ( Link )", "bluishost" ),
                "param_name"    => "btn_url",
                "holder"        => "div",
				"description"   => esc_html__( "Set Button URL.", "bluishost" )
			),
			array(
				"type"          => "dropdown",
				"heading"       => esc_html__( "Style", "bluishost" ),
                "param_name"    => "btn_style",
                "std"    		=> "1",
				"holder"        => "div",
				"value"			=> array(
					esc_html("Mordern","bluishost")     => "mordern",
                    esc_html("Clasic","bluishost")      => "classic",
                    esc_html("Flat","bluishost")     	=> "flat",
                    esc_html("Outline","bluishost")     => "outline",
				),
				"description"   => esc_html__( "Set Button Style.", "bluishost" )
			),
			array(
				"type"          => "dropdown",
				"heading"       => esc_html__( "Shape", "bluishost" ),
                "param_name"    => "btn_shape",
                "std"    		=> "rounded",
				"holder"        => "div",
				"value"			=> array(
					esc_html("Rounded","bluishost")     => "rounded",
                    esc_html("Round","bluishost")     	=> "round",
                    esc_html("Square","bluishost")     	=> "square",
				),
				"description"   => esc_html__( "Set Button Style.", "bluishost" )
			),
		  	array(
				"type"          => "dropdown",
				"heading"       => esc_html__( "Button Link Behavior", "bluishost" ),
                "param_name"    => "btn_target",
                "holder"        => "div",
                "std"           => "_blank",
                "value"         => array(
                    esc_html("Same Page","bluishost")     => "_self",
                    esc_html("New Tab","bluishost")       => "_target"
                ),
				"description"   => esc_html__( "Set Button Link Behavior.", "bluishost" )
            ),
            array(
                "type"          => "checkbox",
                "holder"        => "div",
				"heading"       => esc_html__( "Add Icon?", "bluishost" ),
                "param_name"    => "icon_enable",
				"description"   => esc_html__( "Put icon In Button.", "bluishost" )
            ),
            array(
				"type"          => "dropdown",
				"heading"       => esc_html__( "Icon Alignment", "bluishost" ),
                "param_name"    => "icon_pos",
                "std"           => "left",
                "holder"        => "div",
                "value"         => array(
                    esc_html__("Left","bluishost")    => "left",
                    esc_html__("Right","bluishost")    => "right"
                ),
                "description"   => esc_html__( "Set Icon Alignment.", "bluishost" ),
                "dependency"    => array(
                    "element"    => "icon_enable",   
                    "value"     => array("true") 
                )
            ),
            array(
				"type"          => "dropdown",
				"holder"        => "div",
				"heading"       => esc_html__( "Icon library", 'bluishost' ),
				"param_name"    => "buttonicontype",
				"description"   => esc_html__('Select Icon Type','bluishost'),
				"std"           => "fontawesome",
				"value"         => array(
					esc_html__( 'Fontawesome', 'bluishost' )  => 'fontawesome',
					esc_html__( 'Openiconic', 'bluishost' )   => 'openiconic',
					esc_html__( 'Typicons', 'bluishost' )     => 'typicons',
					esc_html__( 'Entypo', 'bluishost' )       => 'entypo',
					esc_html__( 'Linecons', 'bluishost' )     => 'linecons',
					esc_html__( 'Monosocial', 'bluishost' )   => 'monosocial',
					esc_html__( 'Material', 'bluishost' )     => 'material',
					esc_html__( 'Image Icon', 'bluishost' )   => 'imageicon',
                ),
                "dependency"    => array(
                    "element"    => "icon_enable",   
                    "value"     => array("true") 
                )
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Font Awesome Icon', "bluishost" ),
				'param_name' 	=> 'button_icon_fontawe',
				'value'         => 'fa fa-adjust',
				'settings' 		=> array(
					'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
					'type' 			=> 'fontawesome',
					'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'fontawesome',
				),
				'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Openiconic Icon', "bluishost" ),
				'param_name' 	=> 'button_icon_openic',
				'value'         => 'vc-oi vc-oi-dial',
				'settings' 		=> array(
					'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
					'type' 			=> 'openiconic',
					'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'openiconic',
				),
				'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Typicons', "bluishost" ),
				'param_name' 	=> 'button_icon_typicons',
				'value'         => 'typcn typcn-adjust-brightness',
				'settings' 		=> array(
					'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
					'type' 			=> 'typicons',
					'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'typicons',
				),
				'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Entypo', "bluishost" ),
				'param_name' 	=> 'button_icon_entypo',
				'value'         => 'entypo-icon entypo-icon-note',
				'settings' 		=> array(
					'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
					'type' 			=> 'entypo',
					'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'entypo',
				),
				'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Linecons', "bluishost" ),
				'param_name' 	=> 'button_icon_linecons',
				'value'         => 'vc_li vc_li-heart',
				'settings' 		=> array(
					'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
					'type' 			=> 'linecons',
					'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'linecons',
				),
				'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Monosocial', "bluishost" ),
				'param_name' 	=> 'button_icon_monosocial',
				'value'         => 'vc-mono vc-mono-fivehundredpx',
				'settings' 		=> array(
					'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
					'type' 			=> 'monosocial',
					'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'monosocial',
				),
				'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Material', "bluishost" ),
				'param_name' 	=> 'button_icon_material',
				'value'         => 'vc-material vc-material-cake',
				'settings' 		=> array(
					'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
					'type' 			=> 'material',
					'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'material',
				),
				'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
			),
			array(
				'type' 			=> 'attach_image',
				'heading' 		=> esc_html__( 'Image Icon', "bluishost" ),
				'param_name' 	=> 'imageicon',
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'imageicon',
				),
				'description' 	=> esc_html__( 'Select Image icon.', "bluishost" ),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Image Type', "bluishost" ),
				'param_name' 	=> 'imagetype',
				'std'			=> 'svg',
				'value'			=> array(
					esc_html__('SVG','bluishost')			=> 'svg',
					esc_html__('PNG/JPEG Image','bluishost')	=> 'nimg',
				), 
				'dependency' 	=> array(
					'element' => 'buttonicontype',
					'value'   => 'imageicon',
				),
				'description' 	=> esc_html__( 'Select Image Type.', "bluishost" ),
			),
			array(
				"type"          => "css_editor",
				"heading"       => esc_html__("Design Settings Options", "bluishost"),
				"param_name"    => "css",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
            ),
            array(
				"type"          => "colorpicker",
				"heading"       => esc_html__( "Text Color", "bluishost" ),
				"param_name"    => "btn_color",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
            array(
				"type"          => "colorpicker",
				"heading"       => esc_html__( "Background Color", "bluishost" ),
				"param_name"    => "btn_bg_color",
				"dependency"	=> array(
					"element"		=> "btn_style",
					"value"			=> array("mordern","classic","outline"),
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"          => "colorpicker",
				"heading"       => esc_html__( "Text Hover Color", "bluishost" ),
				"param_name"    => "btn_hover_color",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"          => "colorpicker",
				"heading"       => __( "Background Hover Color", "bluishost" ),
				"param_name"    => "btn_hover_bg_color",
				"group"		    => __( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"		=> "btn_style",
					"value"			=> array("mordern","classic","outline"),
				),
			),
			array(
				"type"          => "colorpicker",
				"heading"       => esc_html__( "Border Color", "bluishost" ),
				"param_name"    => "btn_border_color",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"		=> "btn_style",
					"value"			=> array("outline","classic","mordern"),
				),
			),
			array(
				"type"          => "colorpicker",
				"heading"       => esc_html__( "Border Hover Color", "bluishost" ),
				"param_name"    => "btn_hover_border_color",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"		=> "btn_style",
					"value"			=> array( "mordern", "classic" ),
				),
			),
			array(
				'type'          => 'animation_style',
				'heading'       => esc_html__( 'Animation Style', "bluishost" ),
				'param_name'    => 'animation',
				'description'   => esc_html__( 'Choose your animation style', "bluishost" ),
				'admin_label'   => false,
				'weight'        => 0,
				"group"		    => esc_html__( "Design Option", "bluishost" ),
            ),
            array(
				'type'			=>	'textfield',
				'heading'		=>	esc_html__('Extra Class Name', 'bluishost'),
				'param_name'	=>	'el_class',
				'group'			=>	esc_html__('Extra Class & ID', 'bluishost'),
				'description'	=>	esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "bluishost"),
			),
			array(
				'type'			=>	'textfield',
				'heading'		=>	esc_html__('Extra ID Name', 'bluishost'),
				'param_name'	=>	'el_id',
				'group'			=>	esc_html__('Extra Class & ID', 'bluishost'),
				'description'	=>	esc_html__("If you wish to style particular content element differently, then use this field to add a id name and then refer to it in your css file.", "bluishost"),
			)
		  )
		) );
		
	}
	
	// Shortcode and markup
	public function bluishost_button_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'btn_text'		            => '',		
				'btn_url'	                => '',			
				'btn_style'		            => 'outline',	
				'btn_shape'		            => '',	
				'btn_target' 	            => '_blank',
				'icon_enable' 	            => '',
				'icon_pos' 	                => 'left',
				'buttonicontype'			=> 'fontawesome',
				'button_icon_fontawe'		=> '',
				'button_icon_openic'		=> '',
				'button_icon_entypo'		=> '',
				'button_icon_typicons'		=> '',
				'button_icon_linecons'		=> '',
				'button_icon_monosocial'	=> '',
				'button_icon_material'		=> '',
				'imageicon'					=> '',
				'imagetype'					=> 'svg',
				'css' 	   		            => '',
				'btn_color' 	            => '',
				'btn_border_color' 	        => '',
				'btn_hover_border_color' 	=> '',
				'btn_bg_color' 	            => '',
				'btn_hover_color' 	        => '',
				'btn_hover_bg_color' 	    => '',
				'animation' 	            => '',
				'el_class' 	   	            => '',
				'el_id'  	            	=> '',
			),
		$atts
        ) );

        vc_icon_element_fonts_enqueue($buttonicontype);
		$iconarr = array(
			'awesome'       => $button_icon_fontawe, 
			'openic'        => $button_icon_openic, 
			'entypo'        => $button_icon_entypo, 
			'typicons'      => $button_icon_typicons, 
			'linecons'      => $button_icon_linecons, 
			'monosocial'    => $button_icon_monosocial, 
			'material'      => $button_icon_material, 
			'img'           => !empty( $imageicon ) ? $imageicon : '' , 
		);

		if ( $btn_shape== "rounded" ) {

			$btn_shape_class = ' rounded';

		} elseif( $btn_shape== "round" ) {
			$btn_shape_class = ' round';
		} else {
			$btn_shape_class = ' square';
		}

        $icon_val = $this->helper->bluishost_font_icon_process($buttonicontype, $iconarr, $imagetype);
        
        if( $icon_enable == true ){
            if( $icon_pos == 'left' ){
                $icon =  '<span class="float-left">'.wp_kses_post( $icon_val ).'</span>';
            }else{
                $icon =  '<span class="float-right">'.wp_kses_post( $icon_val ).'</span>';
            }
        }else{
            $icon = '';
        }
		
		// Uniq ID 
		$uniqClass = uniqId('bluishostbutton');
        
        // Extra class
		if( $el_class ) {
			$el_class = ' '.$el_class;
        }

		// Extra Id
		if( $el_id ) {
			$el_id = 'id='. $el_id;
		}

        // Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		if( $animation ) {
			$animation = $animation;
		}else{
			$animation = '';
		}

        $Css = '';
        
        //Button Color
		if( $btn_color ){
			if( $btn_style == 'mordern' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn-primary{color:'.esc_attr( $btn_color ).'!important;}';
			}
			if( $btn_style == 'classic' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style02{color:'.esc_attr( $btn_color ).'!important;}';
			}
			if( $btn_style == 'outline' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style04{color:'.esc_attr( $btn_color ).'!important;}';
			}
			if( $btn_style == 'flat' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style03{color:'.esc_attr( $btn_color ).'!important;}';
			}
		}

		//Button Hover Color
		if( $btn_hover_color ){
			if( $btn_style == 'classic' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style02:hover{color:'.esc_attr( $btn_hover_color ).'!important;}';
			}
			if( $btn_style == 'outline' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style04:hover{color:'.esc_attr( $btn_hover_color ).'!important;}';
			}
			if( $btn_style == 'mordern' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn-primary:hover{color:'.esc_attr( $btn_hover_color ).'!important;}';
			}
			if( $btn_style == 'flat' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style03:hover{color:'.esc_attr( $btn_hover_color ).'!important;}';
			}
		}
        
        //Button Border Color
		if( $btn_border_color ){
			if( $btn_style == 'classic' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style02{border-color:'.esc_attr( $btn_border_color ).'!important;}';
			}
			if( $btn_style == 'outline' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style04 {outline-color:'.esc_attr( $btn_border_color ).'!important;}';
			}
			if( $btn_style == 'mordern' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn-primary {border-color:'.esc_attr( $btn_border_color ).'!important;}';
			}
		}

		//Button Hover Border Color
		if( $btn_hover_border_color ){
			if( $btn_style == 'mordern' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn-primary:hover {border-color:'.esc_attr( $btn_hover_border_color ).'!important;}';
			}
			if( $btn_style == 'classic' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style02:hover{border-color:'.esc_attr( $btn_hover_border_color ).'!important;}';
			}
		}
		
		//Button Background Color
        if( $btn_bg_color ){
        	if( $btn_style == 'mordern' ) {
        		$Css .= '.'.esc_attr( $uniqClass ).' .btn-primary {background-color:'.esc_attr( $btn_bg_color ).'!important;}';
        	}
		}

		//Button Background Hover Color
		if( $btn_hover_bg_color ){
			if( $btn_style == 'outline' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style04:hover{box-shadow:inset 0 0 0 2em'.esc_attr( $btn_hover_bg_color ).'!important;}';
			}
			if( $btn_style == 'mordern' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn-primary:hover {background-color:'.esc_attr( $btn_hover_bg_color ).'!important;}';
			}
			if( $btn_style == 'classic' ) {
				$Css .= '.'.esc_attr( $uniqClass ).' .btn.style02:hover {background-color:'.esc_attr( $btn_hover_bg_color ).'!important;}';
			}
		}
        
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostbutton', $atts );
		
		ob_start();

		?>
        <div <?php echo wp_kses_post( $el_id ); ?> class="bluishost-button <?php echo esc_attr( $uniqClass.$css_class.$el_class.$animation ); ?>">
			<?php 
				if(  $btn_style == 'mordern' ) {

					if( !empty( $btn_text ) ){
						echo bluishost_anchor_tag( array(
							"text"		=> esc_html( $btn_text ).wp_kses_post( $icon ),
							"class"		=> "btn btn-primary style01".esc_attr( $btn_shape_class ),
							"url"		=> esc_url( $btn_url ),
							"target"	=> esc_attr( $btn_target )	
						) );
					}
 
				} elseif(  $btn_style == 'classic' ) {

					if( !empty( $btn_text ) ){
						echo bluishost_anchor_tag( array(
							"text"		=> esc_html( $btn_text ).wp_kses_post( $icon ),
							"class"		=> "btn btn-transparent btn-square style02".esc_attr( $btn_shape_class ),
							"url"		=> esc_url( $btn_url ),
							"target"	=> esc_attr( $btn_target )	
						) );
					}

				} elseif( $btn_style == 'flat' ) {

					if( !empty( $btn_text ) ){
						echo bluishost_anchor_tag( array(
							"text"		=> esc_html( $btn_text ).wp_kses_post( $icon ),
							"class"		=> "btn btn-transparent btn-square style03".esc_attr( $btn_shape_class ),
							"url"		=> esc_url( $btn_url ),
							"target"	=> esc_attr( $btn_target )	
						) );
					}

				} else {
					if( !empty( $btn_text ) ){
						echo bluishost_anchor_tag( array(
							"text"		=> esc_html( $btn_text ).wp_kses_post( $icon ),
							"class"		=> "btn btn-transparent btn-square style04".esc_attr( $btn_shape_class ),
							"url"		=> esc_url( $btn_url ),
							"target"	=> esc_attr( $btn_target )	
						) );
					}
				}
			?>
        </div>
        <?php 
        
		if($Css){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
	}
}

$button = new WPBakeryShortCode_button();