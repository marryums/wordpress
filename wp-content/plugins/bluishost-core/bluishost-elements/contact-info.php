<?php 
/**
 * Contact address section Element
 */
class WPBakeryShortCode_contact_information extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// BLUISHOST helper class
		$this->helper = new bluishost_helper() ;
		
		// bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_information_maping' ) );
		
		// bluishost feature shortcode
		add_shortcode( 'bluishostinformation', array( $this, 'bluishost_information_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_information_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Contact Information", "bluishost" ),
		  "base" => "bluishostinformation",
		  "class" => "",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(

		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Contact Infor Style', "bluishost" ),
				'param_name' 	=> 'info_style',
				'value' 		=> array( 
					esc_html__( 'Default', 'bluishost' )   => 'none',
					esc_html__( 'Style One', 'bluishost' ) => 'one',
					esc_html__( 'Style Two', 'bluishost' ) => 'two',
				),
				'description' 	=> esc_html__( 'Choose your contact info style', "bluishost" ),
				'std'			=> 'one'
			),
			array(
			"type"		 => "param_group",
			'param_name' => 'infoes_two',
			'heading' 	 => esc_html__( 'Set schedule', 'bluishost' ),
			'dependency' => array(
				'element' 	=> 'info_style',
				'value'   	=> 'two',
			),
			'params' 	 => array(

				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Icon Type', "bluishost" ),
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
				),
				array(
					'type' 			=> 'iconpicker',
					'heading' 		=> esc_html__( 'Font Awesome Icon', "bluishost" ),
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
					'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
				),
	            array(
	                'type' 			=> 'iconpicker',
	                'heading' 		=> esc_html__( 'Openiconic Icon', "bluishost" ),
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
	                'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
	            ),
	            array(
	                'type' 			=> 'iconpicker',
	                'heading' 		=> esc_html__( 'Typicons', "bluishost" ),
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
	                'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
	            ),
	            array(
	                'type' 			=> 'iconpicker',
	                'heading' 		=> esc_html__( 'Entypo', "bluishost" ),
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
	                'heading' 		=> esc_html__( 'Linecons', "bluishost" ),
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
	                'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
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
	                'heading' 		=> esc_html__( 'Material', "bluishost" ),
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
	                'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
	            ),
				array(
					'type' 			=> 'attach_image',
					'holder' 		=> 'div',
					'heading' 		=> esc_html__( 'Image', 'bluishost' ),
					'param_name' 	=> 'info_image',
					'description' 	=> esc_html__( 'Set Info image image.', 'bluishost' ),
					'dependency' 	=> array(
						'element' => 'icontype',
						'value'   => 'imageicon',
					),
				),
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Info One", "bluishost" ),
					"param_name" 	=> "info-one",
					"description" 	=> esc_html__( "Set info one.", "bluishost" ),
					"dependency"  	=> array(
						"element" 	=> "info_style",
						"value"   	=> "two",
					),
				),
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Info Two", "bluishost" ),
					"param_name" 	=> "info-two",
					"description" 	=> esc_html__( "Set info two.", "bluishost" ),
					"dependency"  	=> array(
						"element" 	=> "info_style",
						"value"   	=> "two",
					),
				),
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Email One", "bluishost" ),
					"param_name" 	=> "email01",
					"description" 	=> esc_html__( "Set email.", "bluishost" ),
					"dependency"  	=> array(
						"element" 	=> "info_style",
						"value"   	=> "two",
					),
				),
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Email Two", "bluishost" ),
					"param_name" 	=> "email02",
					"description" 	=> esc_html__( "Set email.", "bluishost" ),
					"dependency"  	=> array(
						"element" 	=> "info_style",
						"value"   	=> "two",
					),
				),
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Tel Number One", "bluishost" ),
					"param_name" 	=> "number01",
					"description" 	=> esc_html__( "Set number.", "bluishost" ),
					"dependency"  	=> array(
						"element" 	=> "info_style",
						"value"   	=> "two",
					),
				),
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Tel Number Two", "bluishost" ),
					"param_name" 	=> "number02",
					"description" 	=> esc_html__( "Set number.", "bluishost" ),
					"dependency"  	=> array(
						"element" 	=> "info_style",
						"value"   	=> "two",
					),
				),
			)),
		  	array(
              	"type"        => "checkbox",
              	"heading"     => esc_html__( "Show Label", "bluishost" ),
              	"param_name"  => "label",
              	"admin_label" => true,
              	"value"       => array( 'Show label'=>'show' ),
              	"std"         => " ",
              	"description" => esc_html__( "Select checkbox to show label", "bluishost" ),
              	"dependency"  => array(
					"element" 	=> "info_style",
					"value"   	=> "one",
				), 
            ),
		  	array(
				"type" 		  	=> "textfield",
				"heading" 	  	=> esc_html__( "Address", "bluishost" ),
				"param_name" 	=> "address",
				"description" 	=> esc_html__( "Set address.", "bluishost" ),
				"dependency"  	=> array(
					"element" 	=> "info_style",
					"value"   	=> "one",
				),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Email One", "bluishost" ),
				"param_name" 	=> "email01",
				"description" 	=> esc_html__( "Set email.", "bluishost" ),
				"dependency"  	=> array(
					"element" 	=> "info_style",
					"value"   	=> "one",
				),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Email Two", "bluishost" ),
				"param_name" 	=> "email02",
				"description" 	=> esc_html__( "Set email.", "bluishost" ),
				"dependency"  	=> array(
					"element" 	=> "info_style",
					"value"   	=> "one",
				),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Tel Number One", "bluishost" ),
				"param_name" 	=> "number01",
				"description" 	=> esc_html__( "Set number.", "bluishost" ),
				"dependency"  	=> array(
					"element" 	=> "info_style",
					"value"   	=> "one",
				),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Tel Number Two", "bluishost" ),
				"param_name" 	=> "number02",
				"description" 	=> esc_html__( "Set number.", "bluishost" ),
				"dependency"  	=> array(
					"element" 	=> "info_style",
					"value"   	=> "one",
				),
			),
			array(
				"type" 			=> "css_editor",
				"heading" 		=> esc_html__("Design Settings Options", "bluishost"),
				"param_name" 	=> "css",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Heading Color", "bluishost" ),
				"param_name" 	=> "headcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Text Color", "bluishost" ),
				"param_name" 	=> "textcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Icon Color", "bluishost" ),
				"param_name" 	=> "iconcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', "bluishost" ),
				'param_name' 	=> 'animation',
				'description' 	=> esc_html__( 'Choose your animation style', "bluishost" ),
				'admin_label' 	=> false,
				'weight' 		=> 0,
				"group"			=> esc_html__( "Design Option", "bluishost" ),
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
	public function bluishost_information_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'info_style'  	   => 'one',
				'infoes_two'  	   => '',
				'label'  		   => '',
				'address'  		   => '',
				'email01'  		   => '',
				'email02'  	   	   => '',
				'number01'  	   => '',
				'number02'  	   => '',
				'headcolor' 	   => '',
				'textcolor' 	   => '',
				'iconcolor' 	   => '',
				'css' 	   		   => '',
				'animation' 	   => '',
				'el_class' 	   	   => '',
			),
		$atts
		) );
		
		// Uniq ID 
		$uniqId = uniqId('continfo').'-'.rand(1, 9999);
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		$infoes_two = vc_param_group_parse_atts( $infoes_two );

		$Css = '';
		// Title Color
		if( $headcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .contact-info li span{color:'.esc_attr( $headcolor ).';}';
		}
		// Text Color
		if( $textcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .contact-info li{color:'.esc_attr( $textcolor ).';}';
			$Css .= '#'.esc_attr( $uniqId ).' .contact-info li a{color:'.esc_attr( $textcolor ).';}';
		}
		// Number Color
		if( $iconcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .share-icons li a{color:'.esc_attr( $iconcolor ).';}';
		}

		//Remove ' ' , '-', ' - ' from email one
	    $replace = array(' ','-',' - ','(',')');
	    $with = array('','','','','');
	    $emailurl01 = str_replace( $replace, $with, $email01 );

	    //Remove ' ' , '-', ' - ' from email two
	    $replace = array(' ','-',' - ','(',')');
	    $with = array('','','','','');
	    $emailurl02 = str_replace( $replace, $with, $email02 );

		//Remove ' ' , '-', ' - ' from phone number one
	    $replace = array(' ','-',' - ','(',')');
	    $with = array('','','','','');
	    $numberurl01 = str_replace( $replace, $with, $number01 );

	    //Remove ' ' , '-', ' - ' from phone number two
	    $replace = array(' ','-',' - ','(',')');
	    $with = array('','','','','');
	    $numberurl02 = str_replace( $replace, $with, $number02 );

	    if( $label != 'show' ){
	    	$pd0 = ' class="pl-0"';
	    }else{
	    	$pd0 = '';
	    }

	    // Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostaddress', $atts );
		
		ob_start();
		
		?>
	
		<div id="<?php echo esc_attr( $uniqId ); ?>" class="contact-info-wrap <?php echo esc_attr( $animation.$css_class.$el_class ); ?>">
			<?php
				if( $info_style != 'two' ) {

					echo '<ul class="contact-info karla list-unstyled">';
						// Address
						if( !empty( $address ) ) {
							echo '<li data-animate="fadeInUp" data-delay=".1"'.$pd0.'>';
								if( ! empty( $label ) ) {
									echo '<span>'. esc_html__( 'Address', 'bluishost' ) .'</span>';
								}
								echo '<p>'.wp_kses_post( $address ).'</p>';
							echo '</li>';
						}

						// Tel Email Address
						if( !empty( !empty( $email01 ) || !empty( $email02 ) ) ) {
							echo '<li data-animate="fadeInUp" data-delay=".3"'.$pd0.'>';
								if( ! empty( $label ) ) {
									echo '<span>'. esc_html__( 'Email', 'bluishost' ) .'</span>';
								}
								echo '<a href="'. esc_html__( 'mailto:', 'bluishost' ) . esc_attr( $emailurl01 ) .'">'. esc_html( $email01 ) .'</a>';
								if( $email02 ) {
									echo ', <br> <a href="'. esc_html__( 'mailto:', 'bluishost' ) . esc_attr( $emailurl02 ) .'">'. esc_html( $email02 ) .'</a>';
								}
							echo '</li>';
						}

						// Tel Number
						if( !empty( $number01 ) || !empty( $number01 ) ) {
							echo '<li data-animate="fadeInUp" data-delay=".5"'.$pd0.'>';
								if( ! empty( $label ) ) {
									echo '<span>'. esc_html__( 'Phone', 'bluishost' ) .'</span>';
								}
								echo '<a href="'. esc_html__( 'tel:', 'bluishost' ) .esc_attr( $numberurl01 ).'">'. esc_html( $number01 ) .'</a>';
								if( !empty( $number02 ) ) {
									echo ', <br><a href="'. esc_html__( 'tel:', 'bluishost' ) .esc_attr( $numberurl02 ).'">'. esc_html( $number02 ) .'</a>';
								}
							echo '</li>';
						}
					echo '</ul>';
				}else{
					echo '<div class="row">';
						if( count($infoes_two) > 0  ) {
							foreach( $infoes_two as $info_two ){

								// Icon Load   
								vc_icon_element_fonts_enqueue( $info_two['icontype'] );

								$info_two_icons = array(
						            'awesome'       =>  $info_two['icon_fontawesome'], 
						            'openic'        =>  $info_two['icon_openic'], 
						            'entypo'        =>  $info_two['icon_entypo'], 
						            'typicons'      =>  $info_two['icon_typicons'], 
						            'linecons'      =>  $info_two['icon_linecons'], 
						            'monosocial'    =>  $info_two['icon_monosocial'], 
						            'material'      =>  $info_two['icon_material'], 
						            'img'           => !empty( $info_two['info_image'] ) ? $info_two['info_image'] : '' 
						        );

						        $info_two_icon_val = $this->helper->bluishost_font_icon_process($info_two['icontype'], $info_two_icons);

						        $styleMail01 = isset( $info_two['email01'] ) ? $info_two['email01'] : '';
						        $styleMail02 = isset( $info_two['email02'] ) ? $info_two['email02'] : '';
						        $styleNum01 = isset( $info_two['number01'] ) ? $info_two['number01'] : '';
						        $styleNum02 = isset( $info_two['number02'] ) ? $info_two['number02'] : '';

						        //Remove ' ' , '-', ' - ' from email one
							    $replace = array(' ','-',' - ','(',')');
							    $with = array('','','','','');
							    $emailurl01 = str_replace( $replace, $with, $styleMail01 );

							    //Remove ' ' , '-', ' - ' from email two
							    $replace = array(' ','-',' - ','(',')');
							    $with = array('','','','','');
							    $emailurl02 = str_replace( $replace, $with, $styleMail02 );

								//Remove ' ' , '-', ' - ' from phone number one
							    $replace = array(' ','-',' - ','(',')');
							    $with = array('','','','','');
							    $numberurl01 = str_replace( $replace, $with, $styleNum01 );

							    //Remove ' ' , '-', ' - ' from phone number two
							    $replace = array(' ','-',' - ','(',')');
							    $with = array('','','','','');
							    $numberurl02 = str_replace( $replace, $with, $styleNum02 );

								echo '<div class="col-xl-3 col-md-6 col-12">';
				                    echo '<ul class="list-unstyled contact-info karla">';
				                    	if( ! empty( $info_two_icon_val ) ){
					                        echo '<li data-animate="fadeInUp" data-delay=".1">';
			                            		echo wp_kses_post( $info_two_icon_val );
					                        echo '</li>';
				                        }
				                        if( ! empty( $info_two['info-one'] ) ){
				                        	echo '<li data-animate="fadeInUp" data-delay=".3">'. wp_kses_post( $info_two['info-one'] ) .'</li>';
				                        }
				                        if( ! empty( $info_two['info-two'] ) ){
				                        	echo '<li data-animate="fadeInUp" data-delay=".5">'. wp_kses_post( $info_two['info-two'] ) .'</li>';
				                        }
				                        if( ! empty( $styleMail01 ) ){
				                        	echo '<li data-animate="fadeInUp" data-delay=".3"><a href="'. esc_html__( 'mailto:', 'bluishost' ) . esc_attr( $emailurl01 ) .'">'. esc_html( $styleMail01 ) .'</a></li>';
				                        }
				                        if( ! empty( $styleMail02 ) ){
				                        	echo '<li data-animate="fadeInUp" data-delay=".5"><a href="'. esc_html__( 'mailto:', 'bluishost' ) . esc_attr( $emailurl02 ) .'">'. esc_html( $styleMail02 ) .'</a></li>';
				                        }
				                        if( ! empty( $numberurl01 ) ){
				                        	echo '<li data-animate="fadeInUp" data-delay=".5"><a href="'. esc_html__( 'tel:', 'bluishost' ) .esc_attr( $numberurl01 ).'">'. esc_html( $numberurl01 ) .'</a></li>';
				                        }
				                        if( ! empty( $styleNum02 ) ){
				                        	echo '<li data-animate="fadeInUp" data-delay=".5"><a href="'. esc_html__( 'tel:', 'bluishost' ) .esc_attr( $numberurl02 ).'">'. esc_html( $styleNum02 ) .'</a></li>';
				                        }

				                    echo '</ul>';
				                echo '</div>';
							}
						}
		            echo '</div>';
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

$sectheading = new WPBakeryShortCode_contact_information();
?>