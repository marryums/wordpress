<?php 
/**
 * Contact address section Element
 */
class WPBakeryShortCode_social_icon extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// BLUISHOST helper class
		$this->helper = new bluishost_helper() ;
		
		// bluishost social icon maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_social_icon_maping' ) );
		
		// bluishost feature shortcode
		add_shortcode( 'bluishostsocialicon', array( $this, 'bluishost_social_icon_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_social_icon_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Social Icon", "bluishost" ),
		  "base" => "bluishostsocialicon",
		  "class" => "",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(

		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Icon Alignment', "bluishost" ),
				'param_name' 	=> 'alignment',
				'value' 		=> array( 
					esc_html__( 'Default', 'bluishost' )   => 'none',
					esc_html__( 'Left', 'bluishost' ) => 'left',
					esc_html__( 'Right', 'bluishost' ) => 'right',
					esc_html__( 'Center', 'bluishost' ) => 'center',
				),
				'description' 	=> esc_html__( 'Choose your contact info style', "bluishost" ),
				'std' 			=> 'left'
			),
			array(
              	"type"        	=> "checkbox",
              	"heading"     	=> esc_html__( "Social Label", "bluishost" ),
              	"param_name"  	=> "sociallabel",
              	"admin_label" 	=> true,
              	"value"       	=> array( 'Show label'=>'show' ),
              	"std"         	=> " ",
              	"description" 	=> esc_html__( "Select checkbox to show social label", "bluishost" ),
            ),
			array(
				"type"		 	=> "param_group",
				"param_name" 	=> "socials",
				"heading" 	 	=> esc_html__( "Set social icon", "bluishost" ),
				"dependency"  	=> array(
					"element" 	=> "info_style",
					"value"   	=> "one",
				),
				"params" 	 	=> array(

					array(
						"type" 			=> "iconpicker",
						"heading" 		=> esc_html__( "Font Awesome Icon", "bluishost" ),
						"param_name" 	=> "icon_fontawesome",
						"settings" 		=> array(
						"emptyIcon" 	=> false, // default true, display an "EMPTY" icon?
						"type" 			=> "fontawesome",
						"iconsPerPage"  => 200, // default 100, how many icons per/page to display
						),
						"dependency" 	=> array(
							"element" => "icontype",
							"value"   => "fontawesome",
						),
						"description" 	=> esc_html__( "Select icon from library.", "bluishost" ),
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Social Url", "bluishost" ),
						"param_name" 	=> "socialurl",
						"description" 	=> esc_html__( "Set social url.", "bluishost" )
					),
				)
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
				"heading" 		=> esc_html__( " Icon Hover Color", "bluishost" ),
				"param_name" 	=> "iconhvcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', "bluishost" ),
				'param_name' 	=> 'animation',
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
		) );
		
	}
	
	// Shortcode and markup
	public function bluishost_social_icon_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'sociallabel'  	   => '',
				'alignment'  	   => '',
				'socials'  	   	   => '',
				'iconcolor' 	   => '',
				'iconhvcolor' 	   => '',
				'css' 	   		   => '',
				'animation' 	   => '',
				'el_class' 	   	   => '',
			),
		$atts
		) );
		
		// Uniq ID 
		$uniqId = uniqId('socialicon').'-'.rand(1, 9999);
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		$socials = vc_param_group_parse_atts( $socials );

		$Css = '';

		// Number Color
		if( $iconcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .share-icons li a{color:'.esc_attr( $iconcolor ).';}';
		}

	    if( $alignment ) {
	    	$alignment = $alignment;
	    }else{
	    	$alignment = '';
	    }

	    // Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostsocialicon', $atts );
		
		ob_start();
		
		?>
	
		<div id="<?php echo esc_attr( $uniqId ); ?>" class="contact-content text-<?php echo esc_attr( $alignment.$animation.$css_class.$el_class ); ?>">
			<?php
				if( $socials ) {
	        		echo '<ul class="contact-social-icons share-icons list-inline" data-animate="fadeInUp" data-delay=".7">';
	        	  
	            		if( $sociallabel ) {
	            			echo '<li><span>Social</span></li>';
	            		}
	            		foreach ( $socials as $social ) {

	            			if( !empty( $social['socialurl'] ) ) {

	            				echo '<li><a href="'. esc_url( $social['socialurl'] ) .'" target="_blank"><i class="fa '.esc_attr( $social['icon_fontawesome'] ).'"></i></a></li>';
	            			}
	            			
	            		}
	        		echo '</ul>';
	        	}
				
			?>	
		</div>

		<?php

		if($Css){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}

}

$sectheading = new WPBakeryShortCode_social_icon();
?>