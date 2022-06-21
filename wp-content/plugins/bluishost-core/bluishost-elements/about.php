<?php 
/**
 * Bluishost Section About Element
 */
class WPBakeryShortCode_bluishost_about extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_about_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostabout', array( $this, 'bluishost_about_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_about_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "About", 'bluishost' ),
		  "base" => "bluishostabout",
		  "class" => "",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", 'bluishost'),
		  "params" => array(
			

			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Title", 'bluishost' ),
				"param_name" => "title",
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Sub Title", 'bluishost' ),
				"param_name" => "subtitle",
			),
			array(
			    "type" => "textarea_html",
			    "class" => "",
			    "heading" => __( "Description", "bluishost" ),
			    "param_name" => "content",
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Button Text", 'bluishost' ),
				"param_name" => "btntext",
			),
		  	array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Button Url", 'bluishost' ),
				"param_name" => "btnurl",
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => esc_html__( "Link Target", 'bluishost' ),
				"param_name" => "link_target",
				"value"	=> array(
					'Self' 	=> '_self',
					'Blank' => '_blank'
				)
			),
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( "Title Color", "bluishost" ),
				"param_name" => "titlecolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( "Text Color", "bluishost" ),
				"param_name" => "textcolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( "Button Text Color", "bluishost" ),
				"param_name" => "btncolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( "Button Text Hover Color", "bluishost" ),
				"param_name" => "btnhvcolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( "Button Background Color", "bluishost" ),
				"param_name" => "btnbgcolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( "Button Background Hover Color", "bluishost" ),
				"param_name" => "btnbghvcolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => __( 'Animation Style', 'bluishost' ),
				'param_name' => 'animation',
				'description' => __( 'Choose your animation style', 'bluishost' ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> __( "Design Option", 'bluishost' ),
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
	public function bluishost_about_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'title'  		  => '',
				'subtitle'  	  => '',
				'btntext'   	  => __( 'View More Details', 'bluishost' ),
				'btnurl'    	  => '',
				'link_target'  	  => '_self',
				'titlecolor'  	  => '',
				'textcolor'  	  => '',
				'btncolor'  	  => '',
				'btnhvcolor'  	  => '',
				'btnbgcolor'  	  => '',
				'btnbghvcolor'    => '',
				'css'  			  => '',
				'el_class'  	  => '',
				'animation'    	  => '',
			),
		$atts
		) );

		$uniqID = uniqid( 'blsabout' ).'-'.rand( 1, 9999 );

		$Css = '';

		//Title Color
		if( $titlecolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .about-us-title.text-left h1{color:'.esc_attr( $titlecolor ).'!important;}';
		}
		//Content Color
		if( $textcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .about-us-title.text-left span{color:'.esc_attr( $textcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).'.bhabout p{color:'.esc_attr( $textcolor ).'!important;}';
		}	
		//Button Color
		if( $btncolor || $btnhvcolor || $btnbgcolor || $btnbghvcolor ) {
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary{color:'.esc_attr( $btncolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary:hover{color:'.esc_attr( $btnhvcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary{background-color:'.esc_attr( $btnbgcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary:hover{background-color:'.esc_attr( $btnbghvcolor ).'!important;}';
		}

		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostabout', $atts );

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
		
		ob_start();
		?>

		<div id="<?php echo esc_attr( $uniqID ); ?>" class="bhabout <?php echo esc_attr( $css_class. $animation. $el_class ) ?>">
			<?php
	   		// Section title
	        if( $title || $subtitle ) {
	       	 echo '<div class="about-us-title text-left">';
	       	 	if( !empty( $title ) ) {
	       	 		echo bluishost_heading_tag( 
		       		array(
						'text' 	 		=> esc_html( $title ),
						'data-animate'	=> 'fadeInUp',
						'data-delay'	=> '.1',
				    ) );
	       	 	}
	       	 	if( !empty( $subtitle ) ) {
	       	 		echo bluishost_span_tag( 
		       		array(
						'text' 	 		=> esc_html( $subtitle ),
						'data-animate'	=> 'fadeInUp',
						'data-delay'	=> '.2',
				    ) );
	       	 	}
	       	 echo '</div>';
	        }

	       	if( !empty( $content ) ) {
	       		echo bluishost_paragraph_tag( 
	       		array(
					'text' 	 		=> wp_kses_post( $content ),
					'id' 	 		=> '',
					'data-animate'	=> 'fadeInUp',
					'data-delay'	=> '.4',
			    ) );
	       	}

	       	if( !empty( $btnurl ) ) {
	       	echo bluishost_anchor_tag( 
	       		array(
	       			'url' 	 		=> esc_url( $btnurl ),
					'text' 	 		=> esc_html( $btntext ),
					'class'  		=> 'btn btn-primary mt-2',
					'id' 	 		=> '',
					'data-animate'	=> 'fadeInUp',
					'data-delay'	=> '.6',
			    ) );
	       	}
	       ?>
	   	</div>
        <!-- End of Section title -->
		<?php

		if( $Css ){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
	
	}
	
}

$sectheading = new WPBakeryShortCode_bluishost_about();

?>