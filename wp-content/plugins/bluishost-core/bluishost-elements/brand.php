<?php 
/**
 * Brand section Element
 */
class WPBakeryShortCode_bluishost_brand extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// BLUISHOST helper class
		$this->helper = new bluishost_helper() ;
		
		// bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_brand_maping' ) );
		
		// bluishost feature shortcode
		add_shortcode( 'bluishostbrand', array( $this, 'bluishost_brand_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_brand_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" 			=> esc_html__( "Brand", "bluishost" ),
		  "base" 			=> "bluishostbrand",
		  "class" 			=> "",
		  "icon"  			=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" 		=> esc_html__( "Bluishost", "bluishost"),
		  "params" 			=> array(

		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Brand Style', 'bluishost' ),
				'description'	=> esc_html__( 'Select brand style', 'bluishost' ),
				'param_name' 	=> 'styletype',
				"group"		 	=> esc_html__( "Brand", "bluishost" ),
				'value'         => array(
	                esc_html__( 'Default', 'bluishost' )  			=> 'styleone',
	                esc_html__( 'Brand Style O1', 'bluishost' )  	=> 'styleone',
	                esc_html__( 'Brand Style O2', 'bluishost' )   	=> 'styletwo',
	            	),
	            'std'			=> 'styleone'
			),
		  	array(
				"type"		 	=> "param_group",
				'param_name' 	=> 'brands',
				"group"		 	=> esc_html__( "Brand", "bluishost" ),
				'heading' 	 	=> esc_html__( 'Set brand image', 'bluishost' ),
				'params' 	 	=> array(

						array(
							"type" 			=> "attach_image",
							"holder" 		=> "div",
							"heading" 		=> esc_html__( "Brand Image", "bluishost" ),
							"param_name" 	=> "brndimage",
							"description" 	=> esc_html__( "Set brand image.", "bluishost" ),
						),
				),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array( 'styleone' ),
				),
			),
			array(
				'type'		 	=> 'param_group',
				'param_name' 	=> 'brands02',
				'group'		 	=> esc_html__( 'Brand', 'bluishost' ),
				'heading' 	 	=> esc_html__( 'Set brand image', 'bluishost' ),
				'params' 	 	=> array(

					array(
						'type' 			=> 'attach_image',
						'holder' 		=> 'div',
						'heading' 		=> esc_html__( 'Brand Image', 'bluishost' ),
						'param_name' 	=> 'brndimage02',
						'description' 	=> esc_html__( 'Set brand image.', 'bluishost' ),
					),
				
				),
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array('styletwo'),
				),
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Background Color', 'bluishost' ),
				'param_name' 	=> 'bgcolor',
				'dependency' 	=> array(
					'element' 	=> 'styletype',
					'value'   	=> array('styletwo'),
				),
				'group'		 	=> esc_html__( 'Brand', 'bluishost' ),
			),
			array(
				'type' 		 	=> 'css_editor',
				'heading' 	 	=> esc_html__('Design Settings Options', 'bluishost'),
				'param_name' 	=> 'css',
				'group'		 	=> esc_html__( 'Design Option', 'bluishost' ),
			),
			array(
				"type" 			=> "checkbox",
				"holder" 		=> "div",
				"heading" 		=> esc_html__( "Border Hide", 'bluishost' ),
				"description" 	=> esc_html__( "Select border hide ( Default select show ).", "bluishost" ),
				"param_name" 	=> "border",
				"dependency" 	=> array(
					"element" => "styletype",
					"value"   => "styleone",
				),
				"std"			=> true,
				"group"			=> esc_html__( 'Design Option', 'bluishost' ),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', 'bluishost' ),
				'param_name' 	=> 'animation',
				'description' 	=> esc_html__( 'Choose your animation style', 'bluishost' ),
				'admin_label' 	=> false,
				'weight' 		=> 0,
				"group"			=> esc_html__( 'Design Option', 'bluishost' ),
			),
			array(
				'type'			=>	'textfield',
				'heading'		=>	esc_html__('Extra Class Name', 'bluishost'),
				'param_name'	=>	'el_class',
				'group'			=>	esc_html__('Extra Class', 'bluishost'),
				'description'	=>	esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'bluishost'),
			),
		  )
		) );
	}
	
	// Shortcode and markup
	public function bluishost_brand_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'styletype'    	=> 'styleone',
				'brands'    	=> '',
				'brands02'    	=> '',
				'border'    	=> 'true',
				'border_color'  => '',
				'bgcolor'    	=> '',
				'css'    		=> '',
				'el_class'    	=> '',
				'animation'    	=> '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = uniqid( 'feature' ).'-'.rand( 1, 9999 ); 
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		if( $animation ) {
			$animation = $animation;
		}else{
			$animation = 'fadeInUp';
		}
		
		$brands 	= vc_param_group_parse_atts( $brands );
		$brands02 	= vc_param_group_parse_atts( $brands02 );

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}

		$Css = '';

		if( $bgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.brands .single-brand-icon{background-color:'.esc_attr( $bgcolor ).'!important;}';
		}

		if( $border) {
			$Css .= '#'.esc_attr( $uniqId ).' .our-clients li img{border:none!important;}';
		}

		if( $border_color ) {
			$Css .= '#'.esc_attr( $uniqId ).' .our-clients li img{border-color:'.esc_attr( $border_color ).'!important;}';
		}

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostbrand', $atts );
		
		ob_start();

		//var_dump($styletype);
		?>
		<div id="<?php echo esc_attr( $uniqId ) ?>" class="brands <?php echo esc_attr( $css_class ) ?>">
		<?php
			$i = '0.1';
			if( $styletype == 'styleone' ) {
				
				echo '<ul class="our-clients list-unstyled d-md-flex justify-content-md-between mb-0">';
				foreach( $brands as $brand ) {
					if( ! empty( $brand ) ) {
						$brndimage = wp_get_attachment_image_src( $brand['brndimage'], true );
						echo '<li data-animate="'. esc_attr( $animation ) .'" data-delay="'. esc_attr( $i ) .'"><img src="'. esc_url( $brndimage[0] ) .'" alt=""></li>';
						$i =(  $i + '.1' );
					}
				}
				echo '</ul>';
				
			}else{
				// if( $brands02 ){
					echo '<div class="row">';
						foreach( $brands02 as $brand02 ) {
							if( ! empty( $brand02 ) ) {
								$brndimage02 = wp_get_attachment_image_src( $brand02['brndimage02'], true );
								echo '<div class="col-lg-3 col-sm-6">';
									echo '<div class="single-brand-icon '.esc_attr($el_class).'">';
										echo '<div class="brand-logo-inner" data-animate="'. esc_attr( $animation ) .'" data-delay="'. esc_attr( $i ) .'"><img src="'. esc_url( $brndimage02[0] ) .'" alt=""></div>';
									echo '</div>';
								echo '</div>';
								$i =(  $i + '.1' );
							}
							
						}
					echo '</div>';
				// }
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

$sectheading = new WPBakeryShortCode_bluishost_brand();