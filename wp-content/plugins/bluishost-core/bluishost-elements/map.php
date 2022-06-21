<?php 
/**
 * Bluishost google map section elements
 */
class WPBakeryShortCode_map extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper();
		
		// Bluishost Feature Tab Element maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_map_maping' ) );
				
		// Bluishost Feature Tab Element shortcode
		add_shortcode( 'bluishostmap', array( $this, 'bluishost_map_shortcode' ) );
		
	}
	
	
	// Feature Tab vc Param
	public function bluishost_map_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Map", "bluishost" ),
		  "base" => "bluishostmap",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(
			array(
				"type" 		  => "textfield",
				"heading" 	  => esc_html__( "Latitude", "bluishost" ),
				"param_name"  => "latitude",
				"description" => esc_html__( "Set latitude.", "bluishost" ),
				"group"		 => esc_html__( "Map", "bluishost" ),
			),
			array(
				"type" 		  => "textfield",
				"heading" 	  => esc_html__( "Longitude", "bluishost" ),
				"param_name"  => "longitude",
				"description" => esc_html__( "Set longitude.", "bluishost" ),
				"group"		 => esc_html__( "Map", "bluishost" ),
			),
			array(
				"type" 		  => "textfield",
				"heading" 	  => esc_html__( "Zoom", "bluishost" ),
				"param_name"  => "zoom",
				"description" => esc_html__( "Set zoom.", "bluishost" ),
				"group"		 => esc_html__( "Map", "bluishost" ),
			),
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
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
	
	// Feature Tab Element Shortcode and markup
	public function bluishost_map_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'latitude'		=> '37.386052',
				'longitude' 	=> '-122.083851',
				'zoom' 	   		=> '15',
				'multimarker'	=> '',
				'animation'		=> '',
				'css'			=> '',
				'el_class'		=> '',
			),
		$atts
		) );
		
		// Enqueue google map api
		wp_enqueue_script( 'maps-googleapis' );

		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostmap', $atts );

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
				
		ob_start();

		?>
        <div class="google-map<?php echo esc_attr( $animation.$css_class.$el_class ); ?>" data-animate="fadeInUp" data-delay=".1">
            <!-- Map -->
            <div class="map" data-trigger="map" data-map-options='{"latitude": "<?php echo esc_attr( $latitude ) ?>", "longitude": "<?php echo esc_attr( $longitude ) ?>", "zoom": "<?php echo esc_attr( $zoom ) ?>"}' data-marker="<?php echo get_template_directory_uri(); ?>/assets/img/marker.png"></div>

            <div class="map"></div>
            <!-- End of Map -->
        </div>
		<?php
		$html = ob_get_clean();
		
		return $html;
		
	}
	
}
$datacenterslider = new WPBakeryShortCode_map();
?>