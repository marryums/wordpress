<?php 
/**
 * Bluishost feature  Element
 */
class WPBakeryShortCode_bluishost_feature_group extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_feature_group_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostfeaturegroup', array( $this, 'bluishost_feature_group_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_feature_group_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" 		=> esc_html__( "Feature Group", "bluishost" ),
		  "base" 		=> "bluishostfeaturegroup",
		  "class" 		=> "",
		  "icon"  		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Bluishost", "bluishost" ),
		  "params" 		=> array(

		  	array(
				"type" 			=> "attach_image",
				"holder" 		=> "div",
				"heading" 		=> esc_html__( "Image One", "bluishost" ),
				"param_name" 	=> "imgone",
				"description" 	=> esc_html__( "Set image one.", "bluishost" ),
			),
			array(
				"type" 			=> "attach_image",
				"holder" 		=> "div",
				"heading" 		=> esc_html__( "Image Two", "bluishost" ),
				"param_name" 	=> "imgtwo",
				"description" 	=> esc_html__( "Set image two.", "bluishost" ),
			),
			array(
				"type" 			=> "attach_image",
				"holder" 		=> "div",
				"heading" 		=> esc_html__( "Image Three", "bluishost" ),
				"param_name" 	=> "imgthree",
				"description" 	=> esc_html__( "Set image three.", "bluishost" ),
			),
			array(
				"type"		 	=> "param_group",
				'param_name' 	=> 'features_group',
				"group"		 	=> esc_html__( "Feature Group", "bluishost" ),
				'heading' 	 	=> esc_html__( 'Set Feature Group', 'bluishost' ),
				'params' 	 	=> array(

					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Icon Type', 'bluishost' ),
						'param_name' 	=> 'icontype',
						'value'         => array(
			                esc_html__( 'Fontawesome', 'bluishost' )  => 'fontawesome',
			                esc_html__( 'Openiconic', 'bluishost' )   => 'openiconic',
			                esc_html__( 'Typicons', 'bluishost' )     => 'typicons',
			                esc_html__( 'Entypo', 'bluishost' )       => 'entypo',
			                esc_html__( 'Linecons', 'bluishost' )     => 'linecons',
			                esc_html__( 'Monosocial', 'bluishost' )   => 'monosocial',
			                esc_html__( 'Material', 'bluishost' )     => 'material',
			                esc_html__( 'Image', 'bluishost' )        => 'imageicon',
			            ),
			            'std'			=> 'fontawesome',
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
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Title", "bluishost" ),
						"param_name" 	=> "title",
						"description" 	=> esc_html__( "Set feature title.", "bluishost" )
					),
					array(
						"type" 			=> "textarea",
						"heading" 		=> esc_html__( "Descriptions", "bluishost" ),
						"param_name" 	=> "description",
						"description" 	=> esc_html__( "Set feature descriptions.", "bluishost" )
					),
				),
				
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
				"heading" 		=>	esc_html__( " Title Color", "bluishost" ),
				"param_name" 	=> "titlecolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Description Color", "bluishost" ),
				"param_name" 	=> "desccolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				'dependency' 	=> array(
	                'element' 	=> 'styletype',
	                'value'   	=> 'styleone',
	            ),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', "bluishost" ),
				'param_name' 	=> 'animation',
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				'description' 	=> esc_html__( 'Choose your animation style', "bluishost" ),
				'admin_label' 	=> false,
				'weight' 		=> 0,
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Delay Time", "bluishost" ),
				"param_name" 	=> "delaytime",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"description" 	=> esc_html__( "Set feature title.", "bluishost" )
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
	public function bluishost_feature_group_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'imgone'  		   	=> '',
				'imgtwo'  		   	=> '',
				'imgthree'  		=> '',
				'features_group'	=> '',
				'iconcolor' 	   	=> '',
				'titlecolor' 	   	=> '',
				'desccolor' 	   	=> '',
				'bordercolor' 	   	=> '',
				'bgcolor' 	   		=> '',
				'delaytime' 	   	=> '',
				'animation' 	   	=> '',
				'el_class' 	   	   	=> '',
				'css' 	   		   	=> '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = uniqid( 'featuregroup' ).'-'.rand( 1, 9999 );

		$features_group = vc_param_group_parse_atts( $features_group );

		$css = '';

		// Title Color
		if( $titlecolor ){
			$css .= '#'.esc_attr( $uniqId ).' .single-feature--4 .feature-text h3{color:'.esc_attr( $titlecolor ).';}';
		}

		// Icon Color
		if( $iconcolor ) {
			$css .= '#'.esc_attr( $uniqId ).' .single-feature--4 i{color:'.esc_attr( $iconcolor ).';}';
			$css .= '#'.esc_attr( $uniqId ).' .single-feature--4 svg path{fill:'.esc_attr( $iconcolor ).';}';
		}
		
		// Description Color
		if( $desccolor ){
			$css .= '#'.esc_attr( $uniqId ).' .single-feature--4 .feature-text p{color:'.esc_attr( $desccolor ).';}';
		}
	
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		if( $delaytime ) {
			$delaytime = $delaytime;
		}else{
			$delaytime = '.1';
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}

		$imgone 	= wp_get_attachment_image_src( $imgone, 'full' );
		$imgtwo 	= wp_get_attachment_image_src( $imgtwo, 'full' );
		$imgthree 	= wp_get_attachment_image_src( $imgthree, 'full' );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostfeaturegroup', $atts );
		
		ob_start();
		?>
		<div id="<?php echo esc_attr( $uniqId ); ?>" class="blhostfeaturesgroup <?php echo esc_attr( $css_class.$el_class.$animation ); ?>">
			<div class="row justify-content-center">
				<div class="col-lg-5">
	                <div class="feature-image--4">
	                    <div class="feature-img-inner">
	                    	<?php 
	                    		if( ! empty( $imgone ) ) {
	                    			echo '<img src="'. esc_url( $imgone[0] ) .'" alt="">';
	                    		}

	                    		if( ! empty( $imgtwo ) ) {
	                    			echo '<img src="'. esc_url( $imgtwo[0] ) .'" alt="" data-animate="fadeInDown" data-delay="1.1">';
	                    		}

	                    		if( ! empty( $imgthree ) ) {
	                    			echo '<img src="'. esc_url( $imgthree[0] ) .'" alt="" data-animate="fadeInLeft" data-delay="1.3">';
	                    		}
	                    	?>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-7">
	                    <!-- Single Feature -->
	                <?php 
	                	if( $features_group ) :
	                		foreach( $features_group as $feature ) :

	                			// Font type and settings
								vc_icon_element_fonts_enqueue( $feature['icontype'] );

								$featureiconarr = array(
						            'awesome'       =>  $feature['icon_fontawesome'],
						            'openic'        =>  $feature['icon_openic'],
						            'entypo'        =>  $feature['icon_entypo'],
						            'typicons'      =>  $feature['icon_typicons'],
						            'linecons'      =>  $feature['icon_linecons'],
						            'monosocial'    =>  $feature['icon_monosocial'],
						            'material'      =>  $feature['icon_material'],
						            'img'           => !empty( $feature['icon_image'] ) ? $feature['icon_image'] : '' 
						        );

						        $feature_icon_val = $this->helper->bluishost_font_icon_process( $feature['icontype'], $featureiconarr );
	                ?>
	                    <div class="single-feature--4 media" data-animate="fadeInUp" data-delay=".1">
	                    	<div class="feature-icon">
		                        <?php 
		                        	if( $feature_icon_val ){
										echo wp_kses_post( $feature_icon_val );
									}
		                        ?>
		                    </div>
	                        <div class="feature-text media-body">
	                        	<?php 
	                        		if( ! empty( $feature['title'] ) ) {
	                        			echo bluishost_heading_tag(
	                        				array(
	                        					'tag'		=> 'h3',
	                        					'text'		=> esc_html( $feature['title'] )
	                        				)
	                        			);
	                        		}

	                        		if( ! empty( $feature['description'] ) ) {
	                        			echo bluishost_paragraph_tag(
	                        				array(
	                        					'text'		=> esc_html( $feature['description'] )
	                        				)
	                        			);
	                        		}
	                        	?>
	                        </div>
	                    </div>
	                    <!-- End of Single Feature -->
	                <?php 
	                		endforeach;
	                	endif; 
	                ?>
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

$sectheading = new WPBakeryShortCode_bluishost_feature_group();