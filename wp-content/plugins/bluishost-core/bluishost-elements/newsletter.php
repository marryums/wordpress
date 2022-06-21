<?php 
/**
 * Bluishost testimonial section elements
 */
class WPBakeryShortCode_bluishost_newsletter extends WPBakeryShortCode {
	
	public $helper, $subscribe;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;

		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_newsletter_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostnewsletter', array( $this, 'bluishost_newsletter_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_newsletter_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Newsletter", "bluishost" ),
		  "base" => "bluishostnewsletter",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(	
		  
		  	array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Title", "bluishost" ),
				"param_name" => "title",
			),	
			array(
				"type" 		 => "textarea",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Description", "bluishost" ),
				"param_name" => "description",
			),	
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Email Placeholder", "bluishost" ),
				"param_name" => "placeholder",
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Button Level", "bluishost" ),
				"param_name" => "btnlevel",
			),
			//
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Title Color", "bluishost" ),
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
				"heading" 		=> esc_html__( "Button Level Color", "bluishost" ),
				"param_name" 	=> "btncolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Level Hover Color", "bluishost" ),
				"param_name" 	=> "btnhvcolor",
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
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Border Color", "bluishost" ),
				"param_name" 	=> "btnbdcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
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
	
	// Shortcode and markup
	public function bluishost_newsletter_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'title' 		=> '',
				'description' 	=> '',
				'placeholder' 	=> '',
				'btnlevel' 		=> '',
				'titlecolor' 	=> '',
				'descolor' 		=> '',
				'btncolor' 		=> '',
				'btnhvcolor' 	=> '',
				'btnbgcolor' 	=> '',
				'btnbghvcolor' 	=> '',
				'btnbdcolor' 	=> '',
				'css' 	  		=> '',
				'animation' 	=> '',
				'el_class' 	  	=> '',
			),
			$atts
		) );
		
		// Unique ID
		$uniqID = uniqid( 'bhnewsletter' ).'-'.rand(1, 9999);

		// Title Color
		if( $titlecolor ) {
			$css .= '#'.esc_attr( $uniqID ).' .news-letter-title h2{color:'.esc_attr( $titlecolor ).';}';
		}
		// Description Color
		if( $descolor ) {
			$css .= '#'.esc_attr( $uniqID ).' .news-letter-title p{color:'.esc_attr( $descolor ).';}';
		}
		// Button Level Color
		if( $btncolor ) {
			$css .= '#'.esc_attr( $uniqID ).' .subscribe-form input[type=submit]{color:'.esc_attr( $btncolor ).';}';
		}
		// Button Level Color
		if( $btnhvcolor ) {
			$css .= '#'.esc_attr( $uniqID ).' .subscribe-form input[type=submit]:hover{color:'.esc_attr( $btnhvcolor ).';}';
		}
		// Button Background Color
		if( $btnbgcolor ) {
			$css .= '#'.esc_attr( $uniqID ).' .newsletter .btn-primary{background-color:'.esc_attr( $btnbgcolor ).';}';
		}
		// Button Background Hover Color
		if( $btnbghvcolor ) {
			$css .= '#'.esc_attr( $uniqID ).' .newsletter .btn-primary:hover{background-color:'.esc_attr( $btnbghvcolor ).';}';
		}
		// Button Border Color
		if( $btnbdcolor ) {
			$css .= '#'.esc_attr( $uniqID ).' .subscribe-form input:not([type=submit]){border-color:'.esc_attr( $btnbdcolor ).';}';
		}
		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}

		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostnewsletter', $atts );

		ob_start();
		?>	
        <!-- Subscribe -->
        <div id="<?php echo esc_attr( $uniqID ); ?>" class="mt-70<?php echo esc_attr( $animation.$css_class.$el_class ); ?>">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="news-letter-title" data-animate="fadeInUp" data-delay=".1">
                    	<?php 
                    		if( !empty( $title ) ) {
                    			echo '<h2>'. esc_html( $title ) .'</h2>';
                    		}

                    		if( !empty( $description ) ) {
                    			echo '<p>'. esc_html( $description ) .'</p>';
                    		}
                    	?>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div data-animate="fadeInUp" data-delay=".3">
                        <div class="newsletter">
                        	<form class="parsley-validate position-relative subscribe-form" action="#" method="post" id="subscribe_submit">
	                            <input class="form-control" type="email" id="sectsubscribe_email" name="sectsubscribe_email" placeholder="<?php echo esc_html( $placeholder ); ?>" autocomplete="off" required>
	                            <input type="submit" class="btn btn-primary" name="sectsubscribe" value="<?php esc_html_e( 'Subscribe', 'bluishost' ) ?>">
	                        	<div id="alertsubscribemessage"></div>
	                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		if( $css ){
			echo $this->helper->bluishost_inline_css( $css );
		}
		$html = ob_get_clean();
		
		return $html;
		
	
	}


}

$sectheading = new WPBakeryShortCode_bluishost_newsletter();

?>