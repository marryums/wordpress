<?php 
/**
 * Bluishost Section Element
 */
class WPBakeryShortCode_section extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		$this->helper = new bluishost_helper();
		
		// Bluishost section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_section_maping' ) );
		
		// Bluishost Section shortcode
		add_shortcode( 'bluishostection', array( $this, 'bluishost_section_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_section_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
			"name" 						=> esc_html__( "Bluishost Section", "bluishost" ),
			"base" 						=> "bluishostection",
			"icon"  					=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
			"content_element" 			=> true,
			"show_settings_on_create" 	=> false,
			"is_container"				=> true,
			"category"					=> esc_html__( "Bluishost", "bluishost" ),
			"params" 					=> array(
				// add params same as with any other content element
				array(
					"type" 			=> "css_editor",
					"heading" 		=> esc_html__( "Design Settings Options", "bluishost" ),
					"param_name" 	=> "css"
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Background Pattern", "bluishost" ),
					"param_name" 	=> "bgpattern",
					"value" 		=> array(
            			"" 			=> "true"
            		)
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=>	esc_html__( " Patter Background Color", "bluishost" ),
					"param_name" 	=> "ptbgcolor",
					"dependency" 	=> array(
						"element" 	=> "bgpattern",
						"value" 	=> "true"
					)
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
					)
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=>	esc_html__( " Patter Gradient Color One", "bluishost" ),
					"param_name" 	=> "ptgrcolor01",
					"dependency" 	=> array(
						"element" 	=> "bgpattern",
						"value" 	=> "true"
					)
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=>	esc_html__( " Patter Gradient Color Two", "bluishost" ),
					"param_name" 	=> "ptgrcolor02",
					"dependency" 	=> array(
						"element" 	=> "bgpattern",
						"value" 	=> "true"
					)
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Background Rotate", "bluishost" ),
					"param_name" 	=> "bgrotate",
					"value" 		=> array(
            			"" 			=> "true"
            		)
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Rotate Background Color", "bluishost" ),
					"param_name" 	=> "rotatebgcolor",
					"dependency" 	=> array(
						"element" 	=> "bgrotate",
						"value" 	=> "true"
					)
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Video Background", "bluishost" ),
					"param_name" 	=> "videobg",
				),
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Video ID", "bluishost" ),
					"param_name" 	=> "videoid",
					'dependency' 	=> array(
						'element' 	=> 'videobg',
						'not_empty' => true,
					),
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Parallax", "bluishost" ),
					"param_name" 	=> "parallax",
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Background Bottom Position", "bluishost" ),
					"param_name" 	=> "bgposbotm",
				),
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Active Overlay", "bluishost" ),
					"param_name" 	=> "overlay",
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Background Overlay Color", "bluishost" ),
					"param_name" 	=> "overlaycolor",
				),
				array(
					'type' 			=> 'floatnumber',
					'holder' 		=> 'div',
					'class' 		=> 'text-class',
					'heading' 		=> esc_html__( 'Background Opacity', 'bluishost' ),
					'param_name' 	=> 'bgopacity',
					'step'			=> '0.1',
					'max'			=> '1',
					'admin_label' 	=> false,
					'weight' 		=> 0,
				),
				array(
					'type' 			=> 'animation_style',
					'heading' 		=> esc_html__( 'Animation Style', 'bluishost' ),
					'param_name' 	=> 'animation',
					'description' 	=> esc_html__( 'Choose your animation style', 'bluishost' ),
					'admin_label' 	=> false,
					'weight' 		=> 0,
				),
				array(
					'type'			=>	'textfield',
					'heading'		=>	esc_html__('Extra Class Name', 'bluishost'),
					'param_name'	=>	'el_class',
					'group'			=>	esc_html__('Extra Class', 'bluishost'),
					'description'	=>	esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "bluishost"),
				),

			),
			"js_view" => 'VcColumnView'
		) );
		
		
	}
	
	// Shortcode and markup
	public function bluishost_section_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'css'  		   => '',
				'bgpattern'     => '',
				'ptbgcolor'     => '',
				'ptimage'     => '',
				'ptgrcolor01'     => '',
				'ptgrcolor02'     => '',
				'bgrotate'     => '',
				'rotatebgcolor'=> '',
				'overlay'  	   => '',
				'overlaycolor' => '',
				'bgopacity'    => '',
				'bgposbotm'    => '',
				'parallax'     => '',
				'animation'    => '',
				'el_class'     => '',
			),
		$atts
		) );
		
		// Font settings
		$animation  = $this->getCSSAnimation( $animation );
		
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostection', $atts );

		$uniqID = uniqid( 'bluishost-section' ).'-'.rand( 1, 9999 );
		$Css = '';

		// Background Rotate
		if( $bgrotate ) {
			$rotation = ' bg-light bg-rotate position-relative';
		}else{
			$rotation = ' pt-175 pb-175';
		}

		// Background Pattern
		if( $bgpattern ) {
			$pattern = 'section-gradient';
		}else{
			$pattern = '';
		}

		$ptimage = wp_get_attachment_image_src( $ptimage, 'full' );

		if( $rotatebgcolor ) {
			$Css .= '#'.esc_attr( $uniqID ).'.bg-light:before {background-color:'.esc_attr( $rotatebgcolor ).';}';
		}


		// Section Background Pattern
		if( $bgpattern ) {
			if( $ptimage || $ptbgcolor || $ptgrcolor01 || $ptgrcolor02 ) {
				$Css .= '#'.esc_attr( $uniqID ).'.section-gradient {background:'.esc_attr($ptbgcolor).';background-image: url('.esc_url($ptimage[0]).');background-image: url('.esc_url($ptimage[0]).'),-webkit-linear-gradient(top, '.esc_attr($ptgrcolor01).' 0%,'.esc_attr($ptgrcolor02).' 100%);background-image: url('.esc_url($ptimage[0]).'),linear-gradient(to bottom, '.esc_attr($ptgrcolor01).' 0%,'.esc_attr($ptgrcolor01).', '.esc_attr($ptgrcolor02).' 100%);}';
			}
		}
		
		// Overlay
		if( $overlay ){
			$bgoverlay = ' bg--overlay';
			
			// section  Css
			if( $overlaycolor || $bgopacity ){
				
				$Css .= '#'.esc_attr( $uniqID ).'.bg--overlay:before {background-color:'.esc_attr( $overlaycolor ).';opacity:'.esc_attr( $bgopacity ).';}';

			}
		}else{
			$bgoverlay = '';
		}
		
		//Parallax
		if( $parallax ){
			$Css .= '#'.esc_attr( $uniqID ).'{background-attachment:fixed!important;}';
		}
		//Background bottom position
		if( $bgposbotm ){
			$Css .= '#'.esc_attr( $uniqID ).'{background-position:bottom!important;}';
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}else{
			$el_class = '';
		}

		ob_start();		
		?>
        <div id="<?php echo esc_attr( $uniqID ); ?>" class="bluishost--section <?php echo esc_attr( $pattern.$rotation.$css_class.$bgoverlay.$animation.$el_class ); ?>">
            <div class="container">
			<?php
				echo do_shortcode( $content );
			?>
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

$sectheading = new WPBakeryShortCode_section();


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_bluishostection extends WPBakeryShortCodesContainer {
		
    }

}

?>