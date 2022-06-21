<?php 
/**
 * Bluishost Section Heading Element
 */
class WPBakeryShortCode_sectheading extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		$this->helper = new bluishost_helper();
		
		add_action( 'vc_before_init' , array( $this, 'bluishost_heading_maping' ) );
		
		add_shortcode( 'bluishostsectheading', array( $this, 'bluishost_heading_shortcode' ) );

	}
	
	// vc Param
	public function bluishost_heading_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" 			=> esc_html__( "Section Heading", "bluishost" ),
		  "base" 			=> "bluishostsectheading",
		  "class" 			=> "",
		  "icon"  			=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" 		=> esc_html__( "Bluishost", "bluishost"),
		  "params" 			=> array(
		  
		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Heading Style', 'bluishost' ),
				'description'	=> esc_html__( 'Select heading style', 'bluishost' ),
				'param_name' 	=> 'styletype',
				'value'         => array(
	                esc_html__( 'Default', 'bluishost' )  			=> 'styleone',
	                esc_html__( 'Heading Style O1', 'bluishost' )  	=> 'styleone',
	                esc_html__( 'Heading Style O2', 'bluishost' )   => 'styletwo',
	                esc_html__( 'Heading Style O3', 'bluishost' )   => 'stylethree',
	            	),
	            'std'			=> 'styleone'
			),
		  	array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Heading", "bluishost" ),
				"holder" 		=> "div",
				"param_name" 	=> "heading",
				"description" 	=> esc_html__( "Set section heading.", "bluishost" )
			),
		  	array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Sub Heading", "bluishost" ),
				"holder" 		=> "div",
				"param_name" 	=> "subheading",
				"description" 	=> esc_html__( "Set section sub heading.", "bluishost" )
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Margin Type", "bluishost" ),
				"holder" 		=> "div",
				"value" 		=> array(
					'Default' 		=> 'default',
					'Custom Margin' => 'custom',
				),
				"param_name" 	=> "margtype",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type' 		   	=> 'floatnumber',
				'holder' 	   	=> 'div',
				'heading' 	   	=> esc_html__( 'Margin Top', "bluishost" ),
				'param_name'   	=> 'margintop',
				'step'		   	=> '1',
				'admin_label'  	=> false,
				'weight' 	   	=> 0,
				"group"		   	=> esc_html__( "Design Option", "bluishost" ),
				'dependency' 	=> array(
					'element' 		=> 'margtype',
					'value'   		=> 'custom',
				),
			),
			array(
				'type' 			=> 'floatnumber',
				'holder' 		=> 'div',
				'heading' 		=> esc_html__( 'Margin Bottom', "bluishost" ),
				'param_name' 	=> 'marginbottom',
				'step'			=> '1',
				'admin_label' 	=> false,
				'weight' 		=> 0,
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				'dependency' 	=> array(
					'element' 		=> 'margtype',
					'value'   		=> 'custom',
				),
			),
			array(
				"type" 			=> "dropdown",
				"param_name" 	=> "alignment",
				"heading" 		=> esc_html__( "Text Align", "bluishost" ),
				"description"	=> esc_html__( "Select Heading alignment", "bluishost" ),
				"holder" 		=> "div",
				"value" 		=> array(
					'Default' 		=> 'default',
					'Left' 			=> 'start',
					'Right' 		=> 'end',
					'Center' 		=> 'center',
				),
				"dependency" 	=> array(
					'element' 		=> 'styletype',
					'value'   		=> 'styleone',
				),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', 'bluishost' ),
				'param_name' 	=> 'titleanimation',
				'description' 	=> esc_html__( 'Choose your animation style', 'bluishost' ),
				'admin_label' 	=> false,
				'weight' 		=> 0,
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Title Animation Time Delay', 'bluishost' ),
				'param_name'	=> 'heading_duration',
				'description'	=> esc_html__( 'Set title animation time delay', 'bluishost' ),
				'group'			=> esc_html__( 'Design Option', 'bluishost' )
			),
			array(
				'type' 		   	=> 'divider',
				'holder' 	   	=> 'div',
				'heading' 	   	=> esc_html__( '', "bluishost" ),
				'divvider_title' => esc_html__( 'Section Heading Typography Settings', "bluishost" ),
				'param_name'   	=> 'secthfontsettings',
				"group"		   	=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
			  'type' 			=> 'bluishost_font_container',
			  'param_name' 		=> 'fontsettings',
			  "heading" 		=> esc_html__("Section Heading Typography", "bluishost"),
			  'settings'		=>array(
				 'fields'		=>array(
						'field_size' 				=> 'xs-4',
						'letter_spacing',
						'font_size',
						'line_height',
						'color',
						'font_size_description' 	=> esc_html__( 'Enter font size.', "bluishost" ),
						'line_height_description' 	=> esc_html__( 'Enter line height.', "bluishost" ),
						'color_description' 		=> esc_html__( 'Select color for your element.', "bluishost" ),
					),
				),
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"description" 	=> esc_html__( "Default set font-size 36px, other auto.", "bluishost" ),
			),
			array(
				'type' 		   	 => 'divider',
				'holder' 	   	 => 'div',
				'heading' 	   	 => esc_html__( '', "bluishost" ),
				'divvider_title' => esc_html__( 'Section Sub Heading Typography Settings', "bluishost" ),
				'param_name'   	 => 'sectsubhfontsettings',
				"group"		   	 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
			  'type' 			=> 'bluishost_font_container',
			  'param_name'  	=> 'subfontsettings',
			  "heading" 		=> esc_html__("Section Sub Heading Typography", "bluishost"),
			  'settings'		=>array(
				 'fields'		=>array(
						'field_size' 				=> 'xs-4',
						'letter_spacing',
						'font_size',
						'line_height',
						'color',
						'text_align_description' 	=> esc_html__('Select text alignment.',"bluishost"),
						'font_size_description' 	=> esc_html__('Enter font size.',"bluishost"),
						'line_height_description' 	=> esc_html__('Enter line height.',"bluishost"),
						'color_description' 		=> esc_html__('Select color for your element.',"bluishost"),
					),
				),
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"description" 	=> esc_html__( "Default set font-size 14px, other auto.", "bluishost" ),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', 'bluishost' ),
				'param_name' 	=> 'subtitleanimation',
				'description' 	=> esc_html__( 'Choose your animation style', 'bluishost' ),
				'admin_label' 	=> false,
				'weight' 		=> 0,
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Sub Heading Animation Time Delay', 'bluishost' ),
				'param_name'	=> 'sub_duration',
				'description'	=> esc_html__( 'Set sub heading animation time delay', 'bluishost' ),
				'group'			=> esc_html__( 'Design Option', 'bluishost' )
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Border Color", "bluishost" ),
				"param_name" 	=> "bordercolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', "bluishost" ),
				'param_name' 	=> 'headinganimation',
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
		));	
	}
	
	// Shortcode and markup
	public function bluishost_heading_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'styletype'  		=> 'styleone',
				'heading'  			=> '',
				'subheading'  		=> '',
				'fontsettings'  	=> '',
				'subfontsettings'  	=> '',
				'bordercolor'  		=> '',
				'margtype'  		=> '',
				'margintop'  		=> '',
				'marginbottom'  	=> '',
				'alignment' 		=> '',
				'headinganimation' 	=> '',
				'headingtextalign' 	=> '',
				'titleAnimation' 	=> '',
				'heading_duration' 	=> '',
				'subtitleAnimation' => '',
				'sub_duration' 		=> '',
				'el_class' 			=> '',
			),
		$atts
		) );
		
		$uniqID = uniqID('heading');
		
		// Font settings
		$style 		= $this->helper->bluishost_fontcontainer( $fontsettings );
		$substyle 	= $this->helper->bluishost_fontcontainer( $subfontsettings );
		$animation  = $this->getCSSAnimation( $headinganimation );
		$titleAnimation  	= $this->getCSSAnimation( $titleAnimation );
		$subtitleAnimation  = $this->getCSSAnimation( $subtitleAnimation );
				
		
		// Title Style attr
		if( !empty( $style['style'] ) ){
			$styleattr = $style['style'];
		}else{
			$styleattr = '';
		}
		// Sub title Style attr
		if( !empty( $substyle['style'] ) ){
			$substyle = $substyle['style'];
		}else{
			$substyle = '';
		}
		
		// Text Align
		if( $alignment ){
			$divalign = esc_attr( $alignment );
		}else{
			$divalign = esc_attr( 'center');
		}

		if( $alignment == 'start' ) {
			$textalign = esc_attr( ' text-left' );
		}elseif ($alignment == 'end') {
			$textalign = esc_attr( ' text-right' );
		}else{
			$textalign = esc_attr( ' text-center' );
		}
		
		// Section Title Margin
		$margstyle = '';
		$mbclass   = '';
		if( $margtype != 'custom' ){
			$mbclass = ' mb--68 ';
		}else{
			$margstyle = 'style="margin-top:'.esc_attr( $margintop ).'px;margin-bottom:'.esc_attr( $marginbottom ).'px;"';
		}
		
		// Custom css
		$Css = '';
		if( $bordercolor ){
			
			$Css .= '#'.esc_attr( $uniqID ).' .section-title h2:before{background-color:'.esc_attr( $bordercolor ).';}';
			$Css .= '#'.esc_attr( $uniqID ).' .section-title.style--3 p:after{background-color:'.esc_attr( $bordercolor ).';}';
		
		}

		//Heading
		if( $titleAnimation ){
			$titleAnimation = $titleAnimation;
		}else{
			$titleAnimation = 'fadeInUp';
		}

		if( $heading_duration ){
			$heading_duration = $heading_duration;
		}else{
			$heading_duration = '.1';
		}

		//Sub Heading
		if( $subtitleAnimation ){
			$subtitleAnimation = $subtitleAnimation;
		}else{
			$subtitleAnimation = 'fadeInUp';
		}

		if( $sub_duration ){
			$sub_duration = $sub_duration;
		}else{
			$sub_duration = '.2';
		}

		// Extra Class 
		if( $el_class ) {
			$el_class = ''.$el_class;
		}else{
			$el_class = '';
		}
		
		ob_start();
		
		$html  = '';
		$html = '<div id="'.esc_attr( $uniqID ).'" class="'.esc_attr( $mbclass.$animation.$margstyle.$el_class ).'">';
		if ( $styletype == 'styleone' ) {

			$html .= '<div class="justify-content'.esc_attr( $divalign ).'">';
			$html .= '<div class="section-title'.esc_attr( $textalign ).'">';
			if( $heading ){
				$html .= '<h2 data-animate="'.esc_attr( $titleAnimation ).'" data-delay="'. esc_attr( $heading_duration ) .'"'.$styleattr.'>'.esc_html( $heading ).'</h2>';
			}

			if( $subheading ){
				$html .= '<p data-animate="'.esc_attr( $subtitleAnimation ).'" data-delay="'. esc_attr( $sub_duration ) .'"'.$substyle.'>'.esc_html( $subheading ).'</p>';
			}
			$html .= '</div>';
			$html .= '</div>';

		} elseif( $styletype == 'styletwo' ) {

			$html .= '<div class="section-title style--3 text-white">';
                $html .= '<div class="row d-flex align-items-center">';
                    $html .= '<div class="col-lg-5">';
                    if( $heading ){
                        $html .= '<h2 data-animate="'.esc_attr( $titleAnimation ).'" data-delay="'. esc_attr( $heading_duration ) .'"'.$styleattr.'>'.esc_html( $heading ).'</h2>';
                    }
                    $html .= '</div>';
                    $html .= '<div class="col-lg-6">';
                    if( $subheading ){
                        $html .= '<p data-animate="'.esc_attr( $subtitleAnimation ).'" data-delay="'. esc_attr( $sub_duration ) .'"'.$substyle.'>'.esc_html( $subheading ).'</p>';
                    }
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';

		} else {

			$html .= '<div class="section-title text-center section-title--3 text-white">';
			if ( $heading ) {
				$html .= '<h2 data-animate="'.esc_attr( $titleAnimation ).'"'.$styleattr.'>'.esc_html( $heading ).'</h2>';
			}

			if( $subheading ) {
				$html .= '<p data-animate="'.esc_attr( $subtitleAnimation ).'" data-delay="'. esc_attr( $sub_duration ) .'"'.$substyle.'>'.esc_html( $subheading ).'</p>'; 
			}
  
            $html .= '</div>';

		}
		$html .= '</div>';
		
		
		echo $html;
		
		if( $Css ){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		
		$gethtml = ob_get_clean();
		
		return $gethtml;
		
	
	}
	
	
	
}

$sectheading = new WPBakeryShortCode_sectheading();