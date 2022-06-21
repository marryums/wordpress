<?php 
/**
 * Bluishost Facilities Element
 */
class WPBakeryShortCode_our_facilities extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_facilities_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostfacilities', array( $this, 'bluishost_facilities_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_facilities_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  	"name" => __( "Facilities", "bluishost" ),
		  	"base" => "bluishostfacilities",
		  	"class" => "",
		  	"icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  	"category" => __( "Bluishost", "bluishost"),
		  	"params" => array(
			  	
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
		            'std'			=> 'fontawesome'
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
						'element' 	=> 'icontype',
						'value'   	=> 'fontawesome',
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
		                'element' 	=> 'icontype',
		                'value'   	=> 'openiconic',
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
		                'element' 	=> 'icontype',
		                'value'   	=> 'typicons',
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
		                'element' 	=> 'icontype',
		                'value'   	=> 'entypo',
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
		                'element' 	=> 'icontype',
		                'value'   	=> 'linecons',
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
		                'element' 	=> 'icontype',
		                'value'   	=> 'monosocial',
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
		                'element' 	=> 'icontype',
		                'value'   	=> 'material',
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
						'element' 	=> 'icontype',
						'value'   	=> 'imageicon',
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
					"description" 	=> esc_html__( "Set feature descriptions.", "bluishost" )
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
					"heading" 		=> esc_html__( " Title Color", "bluishost" ),
					"param_name" 	=> "titlecolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Description Color", "bluishost" ),
					"param_name" 	=> "descolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Image / Icon Background Color", "bluishost" ),
					"param_name" 	=> "iconbgcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Image / Icon Hover Background Color", "bluishost" ),
					"param_name" 	=> "iconbghvcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Description Background Color", "bluishost" ),
					"param_name" 	=> "desbgcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Description Background Hover Color", "bluishost" ),
					"param_name" 	=> "desbghvcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
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
	public function bluishost_facilities_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'title'  		   	=> '',
				'description'  	   	=> '',
				'icontype'    	   	=> 'fontawesome',
				'icon_fontawesome' 	=> '',
				'icon_openic'		=> '',
				'icon_typicons'		=> '',
				'icon_entypo'		=> '',
				'icon_linecons'		=> '',
				'icon_monosocial'	=> '',
				'icon_material'		=> '',
				'icon_image'		=> '',
				'icon_size'			=> '60',
				'iconcolor'  	   	=> '',
				'titlecolor'  	   	=> '',
				'descolor'  		=> '',
				'iconbgcolor'  		=> '',
				'iconbghvcolor'  	=> '',
				'desbgcolor'  		=> '',
				'desbghvcolor'  	=> '',
				'animation' 	   	=> '',
				'css' 	   		   	=> '',
				'el_class'		   	=> ''
			),
		$atts
		) );
		
		// uniq id
		$uniqId = uniqid('facilities').'-'.rand( 1, 9999 );
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostfacilities', $atts );

		// Font type and settings
		vc_icon_element_fonts_enqueue( $icontype );

		$facilityiconarr = array(
            'awesome'       =>  $icon_fontawesome, 
            'openic'        =>  $icon_openic, 
            'entypo'        =>  $icon_entypo, 
            'typicons'      =>  $icon_typicons, 
            'linecons'      =>  $icon_linecons, 
            'monosocial'    =>  $icon_monosocial, 
            'material'      =>  $icon_material, 
            'img'           => !empty( $icon_image) ? $icon_image : '' 
        );

        $facility_icon_val = $this->helper->bluishost_font_icon_process($icontype, $facilityiconarr);
		
		// Font type and settings
		$Css = '';

		//Icon Font Size
		if( $icon_size ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-why-choose .why-choose-icon i{font-size:'.esc_attr( $icon_size ).'px;}';
		}
		//Icon Color
		if( $iconcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.single-why-choose .why-choose-icon i{color:'.esc_attr( $iconcolor ).';}';
		}

		// Title Color
		if( $titlecolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-why-choose .why-choose-text h3{color:'.esc_attr( $titlecolor ).'!important;}';
		}
		// Content Color
		if( $descolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-why-choose .why-choose-text p{color:'.esc_attr( $descolor ).'!important;}';
		}

		// Icon / Image Background Color
		if( $iconbgcolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-why-choose{background-color:'.esc_attr( $iconbgcolor ).'!important;}';
		}

		// Icon / Image Background Hover Color
		if( $iconbghvcolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-why-choose:hover{background-color:'.esc_attr( $iconbghvcolor ).'!important;}';
		}

		// Description Background Color
		if( $desbgcolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-why-choose .why-choose-text{background-color:'.esc_attr( $desbgcolor ).'!important;}';
		}

		// Description Background Hover Color
		if( $desbghvcolor ){
			$Css .= '#'.esc_attr( $uniqId ).'.single-why-choose .why-choose-text:hover{background-color:'.esc_attr( $desbghvcolor ).'!important;}';
		}

		if( $el_class ) {
			$el_class = ''.$el_class;
		}else{
			$el_class = '';
		}
	
		ob_start();
		?>

		<div id="<?php echo esc_attr( $uniqId ); ?>" class="single-why-choose d-flex align-items-center <?php echo esc_attr( $css_class.$el_class.$animation ); ?>">
			<div class="why-choose-icon" data-animate="fadeInUp" data-delay=".1">
				<?php 
				
					if( $facility_icon_val ) {
						echo wp_kses_post( $facility_icon_val );
					}
				?>
			</div>
			<div class="why-choose-text">
                <div class="why-choose-text-inner">
                	<?php 
                		if( $title ){
							echo '<h3 data-animate="fadeInUp" data-delay=".2">'.esc_html( $title ).'</h3>';
						}

						if( $description ){
							echo '<p data-animate="fadeInUp" data-delay=".3">'.wp_kses_post( $description ).'</p>';
						}
                	?>
                </div>
            </div>
		</div>

		<?php
		
		if( $Css ){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
	
	}
	
}

$sectheading = new WPBakeryShortCode_our_facilities();
?>