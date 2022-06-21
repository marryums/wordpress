<?php 
/**
 * Bluishost single reason section elements
 */
class WPBakeryShortCode_bluishost_singel_reason extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost reason section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_singel_reason_maping' ) );
		
		// Bluishost reason shortcode
		add_shortcode( 'bluishostsinglereason', array( $this, 'bluishost_singel_reason_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_singel_reason_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Single Reason", "bluishost" ),
		  "base" => "bluishostsinglereason",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(
			  	array(
				"type"		 => "param_group",
				'param_name' => 'reasons',
				"group"		 => esc_html__( "Reason", "bluishost" ),
				'heading' 	 => esc_html__( 'Set reasons', 'bluishost' ),
				'params' 	 => array(
					array(
						"type" 		  => "textfield",
						"holder" 	  => "div",
						"heading" 	  => esc_html__( "Title", "bluishost" ),
						"param_name"  => "title",
						"description" => esc_html__( "Set title.", "bluishost" ),
					),
					array(
						"type" 		  => "textfield",
						"holder" 	  => "div",
						"heading" 	  => esc_html__( "Description", "bluishost" ),
						"param_name"  => "description",
						"description" => esc_html__( "Set description.", "bluishost" ),
					)
				),
			),
			array(
				"type" 		  => "textfield",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Button Text", "bluishost" ),
				"param_name"  => "btntxt",
				"description" => esc_html__( "Set title.", "bluishost" ),
				"group"		 => esc_html__( "Reason", "bluishost" ),
			),
			array(
				"type" 		  => "textfield",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Button Url", "bluishost" ),
				"param_name"  => "btnurl",
				"description" => esc_html__( "Set title.", "bluishost" ),
				"group"		 => esc_html__( "Reason", "bluishost" ),
			),
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
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
				"heading" 		=> esc_html__( "Button Text Color", "bluishost" ),
				"param_name" 	=> "btntxtcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Text Hover Color", "bluishost" ),
				"param_name" 	=> "btntxthvcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Background Color", "bluishost" ),
				"param_name" 	=> "btnbgcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Background Hover Color", "bluishost" ),
				"param_name" 	=> "btnbghvcolor",
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


		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function bluishost_singel_reason_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'reasons' 			=> '',
				'btntxt' 			=> '',
				'btnurl' 			=> '',
				'titlecolor' 		=> '',
				'descolor' 			=> '',
				'btntxtcolor' 		=> '',
				'btntxthvcolor' 	=> '',
				'btnbgcolor' 		=> '',
				'btnbghvcolor' 		=> '',
				'animation' 		=> '',
				'timedelay' 		=> '',
				'css' 	   			=> '',
			),
		$atts
		) );

		//Uniqid
		$uniqID = uniqid( 'bsreason' ).'-'.rand(1, 9999);
		
		$reasons = vc_param_group_parse_atts( $reasons );
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		$Css = '';

		//Title Color
		if( $titlecolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .single-reason h3{color:'.esc_attr( $titlecolor ).'!important;}';
		}
		//Title Color
		if( $descolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .single-reason p{color:'.esc_attr( $descolor ).'!important;}';
		}
		//Button Color
		if( $btntxtcolor || $btnbgcolor || $btntxthvcolor || $btnbghvcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary{color:'.esc_attr( $btntxtcolor ).';}';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary:hover{color:'.esc_attr( $btntxthvcolor ).';}';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary{background-color:'.esc_attr( $btnbgcolor ).';}';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary:hover{background-color:'.esc_attr( $btnbghvcolor ).';}';
		}


		if( $animation ) {
			$animation = $animation;
		}else{
			$animation = 'fadeInUp';
		}

		if( $btntxt ) {
			$btntxt = $btntxt;
		}else{
			$btntxt = 'Purchase Now';
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostsinglereason', $atts );

		ob_start();
		?>
		<div id="<?php echo esc_attr( $uniqID ) ?>" class="all-reason<?php echo esc_attr( $css_class ) ?>">
			<div class="row">
	            <?php
	            	$i = '.3';
	            	if( $reasons ) {
	            		foreach ($reasons as $reason) {
	            			echo '<div class="col-sm-6">';
	            			echo '<div class="single-reason" data-animate="'. esc_attr( $animation ) .'" data-delay="'. esc_attr( $i ) .'">';
	            			echo '<h3>'. esc_html( $reason['title'] ) .'</h3>';
	            			echo '<p>'. esc_html( $reason['description'] ) .'</p>';
	            			echo '</div>';
	            			echo '</div>';
	            			$i = ( $i + 0.1 );
	            		}
	            	}
	            ?>
	            <!-- End of Single reason -->
	        </div>
	        <?php 
	        	if( $btnurl ) {
	        		echo '<a href="'. esc_url( $btnurl ) .'" class="btn btn-primary" data-animate="fadeInUp" data-delay=".7">'. esc_html( $btntxt ) .'</a>';
	        	}
	        ?>
        </div>

        <?php
        	if( $Css ){
				echo $this->helper->bluishost_inline_css( $Css );
			}

		$html = ob_get_clean();
		
		return $html;
		
	}
	
}

$sectheading = new WPBakeryShortCode_bluishost_singel_reason();

?>