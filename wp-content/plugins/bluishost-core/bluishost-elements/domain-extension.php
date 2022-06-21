<?php 
/**
 * Bluishost domain extension section elements
 */
class WPBakeryShortCode_domainextension extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_domainextension_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostdomainextension', array( $this, 'bluishost_domainextension_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_domainextension_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Domain Extension", "bluishost" ),
		  "base" => "bluishostdomainextension",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(	
		  	array(
			"type"		 => "param_group",
			'param_name' => 'extensions',
			'heading' 	 => esc_html__( 'Extensions', 'bluishost' ),
			'params' 	 => array(
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Extension", "bluishost" ),
					"param_name" => "extension",
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Currency", "bluishost" ),
					"param_name" => "currency",
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Price", "bluishost" ),
					"param_name" => "price",
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Duration", "bluishost" ),
					"param_name" => "duration",
				),
				
			)
				
			),	
			array(
				"type" => "css_editor",
				"heading" => esc_html__("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Extension Color", "bluishost" ),
				"param_name" 	=> "extcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Extension Border Color", "bluishost" ),
				"param_name" 	=> "bordercolor",
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
				"heading" 		=> esc_html__( " Price Color", "bluishost" ),
				"param_name" 	=> "pricecolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Border Color", "bluishost" ),
				"param_name" 	=> "bgbdcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Background Color", "bluishost" ),
				"param_name" 	=> "bgcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			//
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
	public function bluishost_domainextension_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'extensions'     => '',
				'extcolor' 	 	 => '',
				'bordercolor' 	 => '',
				'textcolor'		 => '',
				'pricecolor'	 => '',
				'bgbdcolor'	 	 => '',
				'bgcolor'	 	 => '',
				'css' 	 		 => '',
				'animation' 	 => '',
				'el_class' 	 	 => '',
			),
		$atts
		) );
		
		$uniqID = uniqID('ext').'-'.rand( 1, 9999 );
		
		$Css = '';

		// Extension Color
		if( $extcolor ) {
			$Css .= '#'.esc_attr( $uniqID ).' .domain-price li > span{color:'. esc_attr( $extcolor ) .'; }';
		}
		// Extension Border Color
		if( $bordercolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .domain-price li > span:before{background:'.esc_attr( $bordercolor ).'!important;}';
		}
		// Text Color
		if( $textcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .domain-price li > p{color:'.esc_attr( $textcolor ).'!important;}';
		}
		// Text Color
		if( $pricecolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .domain-price p span{color:'.esc_attr( $pricecolor ).'!important;}';
		}
		// Border Color
		if( $bgbdcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .domain-price li{border-color:'.esc_attr( $bgbdcolor ).'!important;}';
		}
		// Background Color
		if( $bgcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .domain-price li{background-color:'.esc_attr( $bgcolor ).'!important;}';
		}

		// Animation settings
		$animation  = $this->getCSSAnimation( $animation );
				
		$extensions = vc_param_group_parse_atts( $extensions );

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostdomainextension', $atts );
		
		ob_start();
		?>
                <!-- Domain Extensions Start -->
                <div id="<?php echo esc_attr( $uniqID ); ?>" class="domain--ext <?php echo esc_attr( $css_class.$animation.$el_class ); ?>">
                	<?php if( $extensions ) { ?>
	                    <ul class="domain-price list-unstyled d-md-flex justify-content-md-between">
							<?php 
							$i = '0.1';
							foreach( $extensions as $extension ){
								echo '<li data-animate="fadeInUp" data-delay="'. esc_attr( $i ) .'">';
								if( $extension['extension'] ) {
									echo '<span>'.esc_html( $extension['extension'] ).'</span>';
								}
								if( $extension['currency'] && $extension['price'] ) {
									echo '<p>'. esc_html__( 'Starting From', 'bluishost' ) .' <br><span>'.esc_html( $extension['currency'] ).esc_html( $extension['price'] ).'</span>'. esc_html( $extension['duration'] ).'</p>';
								}
								echo '</li>';
								$i = ( $i + '.1' );
							}
							?>
	                    </ul>
                    <?php } ?>
                </div>
                <!-- Domain Extensions End -->
		<?php

		if( $Css ){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	}
	
	
}

$domainsearch = new WPBakeryShortCode_domainextension();

?>