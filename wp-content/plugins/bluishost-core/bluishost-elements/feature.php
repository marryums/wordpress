<?php 
/**
 * Bluishost feature  Element
 */
class WPBakeryShortCode_bluishost_feature extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_feature_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostfeatures', array( $this, 'bluishost_feature_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_feature_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" 		=> esc_html__( "Feature", "bluishost" ),
		  "base" 		=> "bluishostfeatures",
		  "class" 		=> "",
		  "icon"  		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Bluishost", "bluishost" ),
		  "params" 		=> array(

		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Feature Style', 'bluishost' ),
				'description'	=> esc_html__( 'Select feature style', 'bluishost' ),
				'param_name' 	=> 'styletype',
				'value'         => array(
	                esc_html__( 'Default', 'bluishost' )  			=> 'styleone',
	                esc_html__( 'Feature Style O1', 'bluishost' )  	=> 'styleone',
	                esc_html__( 'Feature Style O2', 'bluishost' )   	=> 'styletwo',
	            	),
	            'std'			=> 'styleone',
			),
		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Icon Position', "bluishost" ),
				'param_name' 	=> 'iconpos',
				'value' 		=> array( 'Default' => 'none' ,'Right' => 'text-right', 'Center' => 'text-center', 'Left' => 'text-left'  ),
				'description' 	=> esc_html__( 'Choose your animation style', "bluishost" ),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styleone' ),
				)
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Offset Column', 'bluishost' ),
				'description'	=> esc_html__( 'Select offset column', 'bluishost' ),
				'param_name' 	=> 'offset',
				'value'         => array(
	                esc_html__( 'Default', 'bluishost' )  			=> '',
	                esc_html__( 'Offset Column 01', 'bluishost' )  	=> 'offset-md-1',
	                esc_html__( 'Offset Column 02', 'bluishost' )  	=> 'offset-md-2',
	                esc_html__( 'Offset Column 03', 'bluishost' )  	=> 'offset-md-3',
	                esc_html__( 'Offset Column 04', 'bluishost' )  	=> 'offset-md-4',
	                esc_html__( 'Offset Column 05', 'bluishost' )  	=> 'offset-md-5',
	                esc_html__( 'Offset Column 06', 'bluishost' )  	=> 'offset-md-6',
	            	),
	            'std'			=> '',
	            'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styletwo' ),
				)
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
				'type'			=> 'floatnumber',
				'heading'		=> esc_html__( 'Icon Size', 'bluishost' ),
				'param_name'	=> 'icon_size',
				'step'		   	=> '1',
				'admin_label'  	=> false,
				'weight' 	   	=> 0,
				'description'	=> esc_html__( 'Set icon font size ( px )', 'bluishost' ),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Title", "bluishost" ),
				"param_name" 	=> "title",
				"description" 	=> esc_html__( "Set feature title.", "bluishost" )
			),
			array(
				"type" 			=> "textarea",
				"heading" 		=> esc_html__( "Descriptions", "bluishost" ),
				"param_name" 	=> "description",
				"description" 	=> esc_html__( "Set feature descriptions.", "bluishost" ),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styleone' ),
				)
			),
			array(
				"type" 			=> "css_editor",
				"heading" 		=> esc_html__("Design Settings Options", "bluishost"),
				"param_name" 	=> "css",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Icon Color", "bluishost" ),
				"param_name" 	=> "iconcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=>	esc_html__( " Title Color", "bluishost" ),
				"param_name" 	=> "titlecolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Description Color", "bluishost" ),
				"param_name" 	=> "desccolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				'dependency' 	=> array(
	                'element' 	=> 'styletype',
	                'value'   	=> 'styleone',
	            ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Bottom Border Color", "bluishost" ),
				"param_name" 	=> "bordercolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				'dependency' 	=> array(
	                'element' 	=> 'styletype',
	                'value'   	=> 'styleone',
	            ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Background Color", "bluishost" ),
				"param_name" 	=> "bgcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				'dependency' 	=> array(
	                'element' 	=> 'styletype',
	                'value'   	=> 'styletwo',
	            ),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', "bluishost" ),
				'param_name' 	=> 'animation',
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				'description' 	=> esc_html__( 'Choose your animation style', "bluishost" ),
				'admin_label' 	=> false,
				'weight' 		=> 0,
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Delay Time", "bluishost" ),
				"param_name" 	=> "delaytime",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"description" 	=> esc_html__( "Set feature title.", "bluishost" )
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
	public function bluishost_feature_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'styletype'  		=> 'styleone',
				'offset'  			=> '',
				'title'  		   	=> '',
				'description'  	   	=> '',
				'iconpos'    	   	=> '',
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
				'icon_size'			=> '30',
				'iconcolor' 	   	=> '',
				'titlecolor' 	   	=> '',
				'desccolor' 	   	=> '',
				'bordercolor' 	   	=> '',
				'bgcolor' 	   		=> '',
				'delaytime' 	   	=> '',
				'animation' 	   	=> '',
				'el_class' 	   	   	=> '',
				'css' 	   		   	=> '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = uniqid( 'feature' ).'-'.rand( 1, 9999 );
		
		// array variable define
		$titlestl = $descstl = array();

		if( $offset ) {
			$offset = $offset;
		}else{
			$offset = '';
		}
		
		// Title Color
		if( $titlecolor ){
			$titlestl[] = 'color:'.esc_attr( $titlecolor ).';';
		}

		$Css = '';
		// Icon Font Size
		if( $icon_size ) {
			$Css .= '#'.esc_attr( $uniqId ).'.blhostfeatures .single-feature-item.feature-style--3 i{font-size:'.esc_attr( $icon_size ).'px;}';
		}
		// Icon Color
		if( $iconcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.blhostfeatures .single-feature-item.feature-style--3 i{color:'.esc_attr( $iconcolor ).';}';
		}
		// Background Color
		if( $bgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.blhostfeatures .single-feature-item.feature-style--3{background-color:'.esc_attr( $bgcolor ).';}';
		}
		
		$titletags = $this->helper->bluishost_style_tag( $titlestl );
		
		// Description Color
		if( $desccolor ){
			$descstl[] = 'color:'.esc_attr( $desccolor ).';';
		}
		$desctags = $this->helper->bluishost_style_tag( $descstl );
		
		// Icon Style 
		if( $iconcolor ){
			$iconstyle = 'style="color:'.$iconcolor.';"';
			
		}else{
			$iconstyle = '';
		}

		if( $iconpos ) {
			$iconpos = $iconpos;
		}else{
			$iconpos = '';
		}
	
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		if( $delaytime ) {
			$delaytime = $delaytime;
		}else{
			$delaytime = '.1';
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}

		// Font type and settings
		vc_icon_element_fonts_enqueue( $icontype );

		$featureiconarr = array(
            'awesome'       =>  $icon_fontawesome,
            'openic'        =>  $icon_openic,
            'entypo'        =>  $icon_entypo,
            'typicons'      =>  $icon_typicons,
            'linecons'      =>  $icon_linecons,
            'monosocial'    =>  $icon_monosocial,
            'material'      =>  $icon_material,
            'img'           => !empty( $icon_image) ? $icon_image : '' 
        );

        $feature_icon_val = $this->helper->bluishost_font_icon_process($icontype, $featureiconarr);
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostfeatures', $atts );
		
		ob_start();
		?>
		<div id="<?php echo esc_attr( $uniqId ); ?>" class="feature-items<?php echo esc_attr( $css_class.$animation ); ?>">

			<?php  if( $styletype == 'styleone' ) { ?>

				<div class="single-feature <?php echo esc_attr( $el_class.$iconpos ); ?>" data-animate="fadeInUp" data-delay="<?php echo esc_attr( $delaytime ); ?>">
					<?php 
					// feature Icon
					if( $feature_icon_val ){
						echo wp_kses_post( $feature_icon_val );
					}
					//Feature Description
					if( $description || $title ){
						//
						echo '<div class="feature--content">';
							// Feature title
							if( $title ){
								echo '<h3 '.$titletags.'>'.esc_html( $title ).'</h3>';
							}
							//
							if( $description ){
								echo '<p '.$desctags.'>'.wp_kses_post( $description ).'</p>';
							}
							
						echo '</div>';
					}
					?>
				</div>

			<?php }else{ ?>

				<div class="<?php echo esc_attr( $offset ) ?> col-md-8">
                    <div class="single-feature-item feature-style--2 <?php echo esc_attr( $el_class ) ?>" data-animate="fadeInUp" data-delay="<?php echo esc_attr( $delaytime ); ?>">
                        <?php 
                        	// feature Icon / Image
							if( $feature_icon_val ){
								echo wp_kses_post( $feature_icon_val );
							}

							if( $title ){
								echo '<span '.$titletags.'>'.esc_html( $title ).'</span>';
							}
                        ?>
                    </div>
                </div>

			<?php } ?>
		</div>
		<?php
		
		if( $Css ){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_bluishost_feature();