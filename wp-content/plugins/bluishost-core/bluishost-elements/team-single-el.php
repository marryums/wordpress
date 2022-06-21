<?php 
/**
 * Bluishost Team Element
 */
class WPBakeryShortCode_team_singleel extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Helper class
		$this->helper = new bluishost_helper();
		
		// Feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_teammember_maping' ) );
		
		// Feature shortcode
		add_shortcode( 'bluishostteammember', array( $this, 'bluishost_teammember_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_teammember_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => esc_html__( "Team Member", "bluishost" ),
		  "base" => "bluishostteammember",
		  "class" => "",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => esc_html__( "Bluishost", "bluishost"),
		  "params" => array(
		 
			//
			array(
				"type" => "attach_image",
				"holder" => "div",
				"heading" => esc_html__( "Image", "bluishost" ),
				"param_name" => "img",
				"description" => esc_html__( "Set service image.", "bluishost" ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Name", "bluishost" ),
				"param_name" => "name",
				"description" => esc_html__( "Set feature title.", "bluishost" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Expert In", "bluishost" ),
				"param_name" => "expertin",
				"description" => esc_html__( "Set title url.", "bluishost" )
			),
			array(
				"type" => "param_group",
				'param_name' => 'teamsocial',
				'heading' => esc_html__('Member Social Media',"bluishost"),
				'params' => array(
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Font Awesome Icon', "bluishost" ),
						'param_name' => 'icon',
						'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'fontawesome',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'description' => esc_html__( 'Select icon from library.', "bluishost" ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('URL',"bluishost"),
						'param_name' => 'url',
					),
				)
					
			),
			//
			array(
				"type" => "css_editor",
				"heading" => esc_html__("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Title Color", "bluishost" ),
				"param_name" => "titlecolor",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Expert In Color", "bluishost" ),
				"param_name" => "expertcolor",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Icon Color", "bluishost" ),
				"param_name" => "iconcolor",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Primary Color", "bluishost" ),
				"param_name" => "primcolor",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"		 => "colorpicker",
				"heading"	 => esc_html__( "Secondary Color", "bluishost" ),
				"param_name" => "seccolor",
				"group"		 => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => esc_html__( 'Animation Style', "bluishost" ),
				'param_name' => 'animation',
				'description' => esc_html__( 'Choose your animation style', "bluishost" ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Animation Time Delay", 'bluishost' ),
				"param_name" => "timedelay",
				"group"		=> esc_html__( "Design Option", "bluishost" ),
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function bluishost_teammember_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'img'  	   	   => '',
				'name'  	   => '',
				'expertin'     => '',
				'teamsocial'   => '',
				'titlecolor'   => '',
				'expertcolor'  => '',
				'iconcolor'    => '',
				'primcolor'    => '',
				'seccolor'     => '',
				'animation'    => '',
				'timedelay'    => '',
				'css' 	   	   => '',
			),
		$atts
		) );

		$uniqId = uniqid( 'single-team' );
				
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		if( $animation ) {
			$animation = $animation;
		}else{
			$animation = 'fadeInUp';
		}

		if( $timedelay ) {
			$timedelay = $timedelay;
		}else{
			$timedelay = '.3';
		}

		$Css = '';
		// Title Color
		if( $titlecolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .member-info h4{color:'.esc_attr( $titlecolor ).';}';
		}
		// Expert Color
		if( $expertcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .member-info span{color:'.esc_attr( $expertcolor ).';}';
		}
		// Expert Color
		if( $iconcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .member-info ul li a i.fa{color:'.esc_attr( $iconcolor ).';}';
		}
		// Primary Color
		if( $primcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .bg-dark:before{background-color:'.esc_attr( $primcolor ).';}';
		}
		// Secondary Color
		if( $seccolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .bg-dark{background-color:'.esc_attr( $seccolor ).'!important;}';
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostteammember', $atts );
		
		$imgurl = wp_get_attachment_image_src( $img , 'full' );
		
		ob_start();
		?>
		<div id="<?php echo esc_attr( $uniqId ); ?>" class="single-member" data-animate="<?php echo esc_attr( $animation ); ?>" data-delay="<?php echo esc_attr( $timedelay ); ?>">
			
			<?php 
			if( !empty( $imgurl[0] ) ){
				echo bluishost_img_tag(
					array(
						'url' 		=> esc_url( $imgurl[0] ),
					)
				);
			}
			?>
			<div class="member-info bg-dark bg-rotate">
				<?php
				// 
				if( !empty( $name ) ){
					echo '<h4>'.esc_html( $name ).'</h4>';
				}
				//
				if( !empty( $expertin ) ){
					echo '<span>'.esc_html( $expertin ).'</span>';
				}
									
				$teamsocial = vc_param_group_parse_atts( $teamsocial );
				
				// Team Social
				if( is_array( $teamsocial ) && count( $teamsocial ) > 0 ):
				?>
				<ul class="list-unstyled text-right">
					<?php 
					$html = '';
					foreach( $teamsocial as $social ){
						$html .= '<li><a href="'.esc_url( $social['url'] ).'"><i class="fa '.esc_attr( $social['icon'] ).'"></i></a></li>';
					}
					echo wp_kses_post( $html );
					?>
				</ul>
				<?php 
				endif;
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

$sectheading = new WPBakeryShortCode_team_singleel();
?>