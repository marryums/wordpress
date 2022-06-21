<?php 
/**
 * Bluishost video section elements
 */
class WPBakeryShortCode_bluishost_video extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_video_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostvideo', array( $this, 'bluishost_video_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_video_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Video", "bluishost" ),
		  "base" => "bluishostvideo",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(
		  
			  	array(
					'heading'    => esc_html__( 'Choose Style', 'bluishost' ),
					'type'       => 'dropdown',
					'param_name' => 'video_style',
					'value'		 => array( 'Select Style' => '', 'Style 1' => 'style-1', 'Style 2' => 'style-2' ),
				),
				array(
					"type" 		  => "attach_image",
					"holder" 	  => "div",
					"heading" 	  => esc_html__( "Background Image", "bluishost" ),
					"param_name"  => "img",
					"description" => esc_html__( "Set service image.", "bluishost" ),
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Icon Type', 'bluishost' ),
					'param_name' 	=> 'icontype',
					'value'         => array(
		                esc_html__( 'Fontawesome', 'cloudvpnet' )  => 'fontawesome',
		                esc_html__( 'Openiconic', 'cloudvpnet' )   => 'openiconic',
		                esc_html__( 'Typicons', 'cloudvpnet' )     => 'typicons',
		                esc_html__( 'Entypo', 'cloudvpnet' )       => 'entypo',
		                esc_html__( 'Linecons', 'cloudvpnet' )     => 'linecons',
		                esc_html__( 'Monosocial', 'cloudvpnet' )   => 'monosocial',
		                esc_html__( 'Material', 'cloudvpnet' )     => 'material',
		                esc_html__( 'Image', 'cloudvpnet' )        => 'imageicon',
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
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"heading" 	  => esc_html__( "Text", "bluishost" ),
					"param_name"  => "text",
					"description" => esc_html__( "Set text.", "bluishost" ),
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"heading" 	  => esc_html__( "Video Url", "bluishost" ),
					"param_name"  => "videourl",
					"description" => esc_html__( "Set video url.", "bluishost" ),
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
					"heading" 		=> esc_html__( " Icon Color", "bluishost" ),
					"param_name" 	=> "iconcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( " Text Color", "bluishost" ),
					"param_name" 	=> "textcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type"			=> "colorpicker",
					"heading"		=> esc_html( "Background Color", "bluishost" ),
					"param_name"	=> "bgcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
					"dependency" 	=> array(
				        "element" => "video_style",
				        "value"   => "style-2"
				    )
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
		));
		
		
	}
	
	// Shortcode and markup
	public function bluishost_video_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'video_style'		=> '',
				'img'     			=> '',
				'icontype'      	=> '',
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
				'icon_size'			=> '70',
				'text' 				=> '',
				'videourl' 			=> '',
				'iconcolor' 		=> '',
				'textcolor' 		=> '',
				'bgcolor' 			=> '',
				'animation' 		=> '',
				'css' 	   			=> '',
				'el_class' 	   		=> '',
			),
			$atts
		) );

		//Uniqid
		$uniqID = uniqid( 'bsvideo' ).'-'.rand(1, 9999);
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		if( $animation ) {
			$animation = $animation;
		}else{
			$animation = 'fadeInUp';
		}

		// Icon Style 
		if( $iconcolor ){
			$iconstyle = 'style="color:'.$iconcolor.';"';
		}else{
			$iconstyle = '';
		}

		// Icon Style 
		if( $textcolor ){
			$textcolor = ' style=color:'.$textcolor.';';
		}
		
		// Font type and settings
		vc_icon_element_fonts_enqueue( $icontype );

		$videoiconarr = array(
            'awesome'       =>  $icon_fontawesome,
            'openic'        =>  $icon_openic,
            'entypo'        =>  $icon_entypo,
            'typicons'      =>  $icon_typicons,
            'linecons'      =>  $icon_linecons,
            'monosocial'    =>  $icon_monosocial,
            'material'      =>  $icon_material,
            'img'           => !empty( $icon_image) ? $icon_image : '' 
        );

        $video_icon_val = $this->helper->bluishost_font_icon_process($icontype, $videoiconarr);

		if( $videourl ) {
			$videourl = $videourl;
		}else{
			$videourl = 'https://www.youtube.com/watch?v=wb49-oV0F78';
		}

		if( $video_style != 'style-1' ) {
			$wrrapdiv = 'why-us-video-sticky-tape ';
		}else{
			$wrrapdiv = ' ';
		}

		$Css = '';
		if( $bgcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .sticky-tape:before, .sticky-tape:after{background-color:'.esc_attr( $bgcolor ).'!important;}';
		}

		//Icon Font Size
		if( $icon_size ) {
			$Css .= '#'.esc_attr( $uniqID ).' .youtube-popup i{font-size:'.esc_attr( $icon_size ).'px;}';
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostvideo', $atts );
		
		$imgurl = wp_get_attachment_image_src( $img , 'full' );
		ob_start();
		?>	
		<div id="<?php echo esc_attr( $uniqID ); ?>" class="why-us-video <?php echo esc_attr( $wrrapdiv ) ?>text-center text-white position-relative<?php echo esc_attr( $css_class.$el_class ); ?>" data-animate="<?php echo esc_attr( $animation ) ?>" data-delay=".1">

            <?php
            if( $video_style != 'style-1' ) {
				echo '<div class="sticky-tape">';
			}

        	if( $imgurl[0] ) {
        		echo '<img src="'. esc_url( $imgurl[0] ) .'" alt="">';
        	}
            ?>
            <p>
                <?php
	                if( ! empty( $videourl ) ) {
	                	echo '<a class="youtube-popup" href="'.esc_url( $videourl ).'">';
		            	// Video Icon/Image
						if( $video_icon_val ){
							echo wp_kses_post( $video_icon_val );
						}
						
						echo '</a>';

						if( $text ) {
							echo '<span'. esc_attr( $textcolor ) .'>'. esc_html( $text  ) .'</span>';
						}
	                }
	            ?>
            </p>
            <?php 
            if( $video_style != 'style-1' ) {
				echo '</div>';
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

$sectheading = new WPBakeryShortCode_bluishost_video();

?>