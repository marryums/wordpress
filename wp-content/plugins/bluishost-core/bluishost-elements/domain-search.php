<?php
/**
 * Bluishost domain search section elements
 */
class WPBakeryShortCode_domainsearch extends WPBakeryShortCode {

	public $helper;

	function __construct(){

		// Bluishost helper class
		$this->helper = new bluishost_helper() ;

		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_domainsearch_maping' ) );

		// Bluishost feature shortcode
		add_shortcode( 'ssdhostdomainsearch', array( $this, 'bluishost_domainsearch_shortcode' ) );

	}

	// vc Param
	public function bluishost_domainsearch_maping(){

		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

		vc_map( array(
		  "name" => __( "Domain Search Form", "bluishost" ),
		  "base" => "ssdhostdomainsearch",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(

		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Domain Search Style', 'bluishost' ),
				'description'	=> esc_html__( 'Select domain search style', 'bluishost' ),
				'param_name' 	=> 'styletype',
				'value'         => array(
	                esc_html__( 'Default', 'bluishost' )  			=> 'styleone',
	                esc_html__( 'Domain Search Style O1', 'bluishost' )  	=> 'styleone',
	                esc_html__( 'Domain Search Style O2', 'bluishost' )   	=> 'styletwo',
	                esc_html__( 'Domain Search Style O3', 'bluishost' )   	=> 'stylethree',
	            	),
	            'std'			=> 'styleone',
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Title", "bluishost" ),
				"param_name" => "title",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value"   	=> array( "styletwo", "stylethree" ),
				)
			),
			array(
				"type" 		 => "textarea",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Description", "bluishost" ),
				"param_name" => "description",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value"   	=> array( "stylethree" ),
				)
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Search Action Url", "bluishost" ),
				"param_name" => "search_url",
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Placeholder", "bluishost" ),
				"param_name" => "placeholder",
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Button Text", "bluishost" ),
				"param_name" => "btntext",
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value"   	=> array( "stylethree" ),
				)
			),
			array(
				"type"			=> "param_group",
				"heading"		=> esc_html__( "Domain Extension", "bluishost" ),
				"param_name"	=> "extension",
				"params"		=> array(

					array(
						"type"		=> "textfield",
						"heading"	=> esc_html__( "Extension", "bluishost" ),
						"param_name"	=> "dom_extension"
					),

				),
				"dependency" 	=> array(
					"element" 	=> "styletype",
					"value"   	=> array( "stylethree" ),
				)
			),
			array(
				"type" 			=> "css_editor",
				"heading" 		=> esc_html__("Design Settings Options", "bluishost"),
				"param_name" 	=> "css",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type"			=> "attach_image",
				"heading"		=> esc_html__( "Pattern Image", "bluishost" ),
				"param_name"	=> "dompattern",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "styletwo"
				)
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Title Color", "bluishost" ),
				"param_name" 	=> "titlecolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> array("styletwo","stylethree")
				)
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Description Color", "bluishost" ),
				"param_name" 	=> "desccolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "stylethree"
				)
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Extension Color", "bluishost" ),
				"param_name" 	=> "extencolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "stylethree"
				)
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Title Border Color", "bluishost" ),
				"param_name" 	=> "titlebdcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "styletwo"
				)
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Search Field Border Color", "bluishost" ),
				"param_name" 	=> "fieldbdcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "styletwo"
				)
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Placeholder Color", "bluishost" ),
				"param_name" 	=> "placeholdercolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Color", "bluishost" ),
				"param_name" 	=> "subbuttoncolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "styletwo"
				)
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Background Color", "bluishost" ),
				"param_name" 	=> "bgcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"	=> "styletype",
					"value"		=> "styletwo"
				)
			),
			// Button Gradient and Simple Color Start
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Button Background Color", "bluishost" ),
				"param_name" 	=> "btn_bg_color",
				"value"			=> array(
					esc_html__("Simple Background Color","bluishost")		=> 'simple',
					esc_html__("Gradient Background Color","bluishost")	    => 'gradient',
				),
				"std"  			=> "simple",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
				"dependency" 	=> array(
                    'element' => 'styletype',
                    'value'   => 'stylethree',
                ),
			),
			array(
				"type" 				=> "colorpicker",
				"heading" 			=> esc_html__( "Background Color", "bluishost" ),
				"param_name" 		=> "simple_bg_color",
				"dependency"		=> array(
					"element"			=> "btn_bg_color",
					"value"				=> array("simple")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color Start From", "bluishost" ),
				"param_name" 		=> "bg_gradient_start",
				"dependency"		=> array(
					"element"			=> "btn_bg_color",
					"value"				=> array("gradient")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color End To", "bluishost" ),
				"param_name" 		=> "bg_gradient_end",
				"dependency"		=> array(
					"element"			=> "btn_bg_color",
					"value"				=> array("gradient")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			// Button Gradient and Simple Color End

			// Button Gradient and Simple Hover Color Start
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Button Background Hover Color", "bluishost" ),
				"param_name" 	=> "btn_bg_hv_color",
				"value"			=> array(
					esc_html__("Simple Background Hover Color","bluishost")		=> 'simple_hv',
					esc_html__("Gradient Background Hover Color","bluishost")	=> 'gradient_hv',
				),
				"std"  			=> "simple_hv",
				"group"		    => esc_html__( "Design Option", "bluishost" ),
				"dependency" 	=> array(
                    'element' => 'styletype',
                    'value'   => 'stylethree',
                ),
			),
			array(
				"type" 				=> "colorpicker",
				"heading" 			=> esc_html__( "Background Hover Color", "bluishost" ),
				"param_name" 		=> "simple_bg_hv_color",
				"dependency"		=> array(
					"element"			=> "btn_bg_hv_color",
					"value"				=> array("simple_hv")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color Start From", "bluishost" ),
				"param_name" 		=> "bg_gradient_hv_start",
				"dependency"		=> array(
					"element"			=> "btn_bg_hv_color",
					"value"				=> array("gradient_hv")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 				=> "colorpicker",
				"edit_field_class"	=>	"vc_col-sm-6",
				"heading" 			=> esc_html__( "Gradient Color End To", "bluishost" ),
				"param_name" 		=> "bg_gradient_hv_end",
				"dependency"		=> array(
					"element"			=> "btn_bg_hv_color",
					"value"				=> array("gradient_hv")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			// Button Gradient and Simple Hover Color End
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Background Color", "bluishost" ),
				"param_name" 	=> "btnbgcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"		=> array(
					"element"			=> "styletype",
					"value"				=> array("styleone", "styletwo")
				),
				"group"		    => esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Background Hover Color", "bluishost" ),
				"param_name" 	=> "btnbghvcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
				"dependency"	=> array(
					"element"		=> "styletype",
					"value"			=> array( "styleone", "styletwo" ),
				)
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Text Color", "bluishost" ),
				"param_name" 	=> "btntextcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Text Hover Color", "bluishost" ),
				"param_name" 	=> "btntexthvcolor",
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
	public function bluishost_domainsearch_shortcode( $atts, $content = null ){

		extract( shortcode_atts(
			array(
				'styletype'     	=> 'styleone',
				'title'     		=> '',
				'description'     	=> '',
				'search_url'     	=> '',
				'placeholder' 		=> '',
				'btntext' 			=> esc_html__( 'Search', 'bluishost' ),
				'extension' 		=> '',
				'dompattern' 		=> '',
				'titlecolor' 		=> '',
				'desccolor' 		=> '',
				'extencolor' 		=> '',
				'titlebdcolor' 		=> '',
				'fieldbdcolor' 		=> '',
				'placeholdercolor' 	=> '',
				'subbuttoncolor' 	=> '',
				'bgcolor' 			=> '',
				'btn_bg_color' 		=> '',
				'simple_bg_color' 	=> '',
				'bg_gradient_start' => '',
				'bg_gradient_end' 	=> '',
				'btn_bg_hv_color'	=> '',
				'simple_bg_hv_color'=> '',
				'bg_gradient_hv_start' => '',
				'bg_gradient_hv_end'=> '',
				'btnbgcolor' 		=> '',
				'btntextcolor' 		=> '',
				'btnbghvcolor' 		=> '',
				'btntexthvcolor' 	=> '',
				'css' 	 			=> '',
				'animation' 	 	=> '',
				'el_class' 	 		=> '',
			),
		$atts
		) );

		$uniqId = uniqId('domainsearch');

		$extension = vc_param_group_parse_atts( $extension );

		// Animation settings
		$animation  = $this->getCSSAnimation( $animation );

		if( $animation ) {
			$animation = $animation;
		}else{
			$animation = 'fadeInUp';
		}

		if( $placeholder ){
			$placeholder = esc_html( $placeholder );
		}else{
			$placeholder = esc_html__( 'Search Your Domain name', 'bluishost' );
		}

		$dompattern = wp_get_attachment_image_src( $dompattern, 'full' );
		if( $dompattern ) {
			$dompattern = 'data-bg-img='.esc_url( $dompattern[0] ).';';
		}else{
			$dompattern = '';
		}

		$css = '';

		//Search Input Fields Background Color
		if( $btnbgcolor || $btntextcolor || $btnbghvcolor || $btntexthvcolor || $bgcolor || $titlecolor || $desccolor || $extencolor || $titlebdcolor || $fieldbdcolor || $placeholdercolor || $subbuttoncolor ){
			$css .= '#'.esc_attr( $uniqId ).' .btn-primary{background-color:'.esc_attr( $btnbgcolor ).';border-color:'.esc_attr( $btnbgcolor ).';color:'.esc_attr( $btntextcolor ).';}';
			$css .= '#'.esc_attr( $uniqId ).' .btn-primary:hover{background-color:'.esc_attr( $btnbghvcolor ).';border-color:'.esc_attr( $btnbghvcolor ).';color:'.esc_attr( $btntexthvcolor ).';}';
			$css .= '#'.esc_attr( $uniqId ).' .domain-search-inner{background-color:'.esc_attr( $bgcolor ).';}';
			$css .= '#'.esc_attr( $uniqId ).' .section-title.text-white h2{color:'.esc_attr( $titlecolor ).'!important;}';
			$css .= '#'.esc_attr( $uniqId ).' .section-title.section-title--3 h2{color:'.esc_attr( $titlecolor ).'!important;}';
			$css .= '#'.esc_attr( $uniqId ).' .section-title.section-title--3.text-white p{color:'.esc_attr( $desccolor ).'!important;}';
			$css .= '#'.esc_attr( $uniqId ).' .domain-extension.text-white li{color:'.esc_attr( $extencolor ).'!important;}';
			$css .= '#'.esc_attr( $uniqId ).' .section-title.text-white h2:before{background-color:'.esc_attr( $titlebdcolor ).'!important;}';
			$css .= "#".esc_attr( $uniqId )." .domain-search-form input[type='text']{border-color:".esc_attr( $fieldbdcolor )."!important;}";
			$css .= "#".esc_attr( $uniqId )." .domain-search-form input[type='text']::placeholder{color:".esc_attr( $placeholdercolor )."!important;}";
			$css .= "#".esc_attr( $uniqId )." .domain-search-form button[type=submit]{color:".esc_attr( $subbuttoncolor )."!important;}";
			$css .= "#".esc_attr( $uniqId )." .btn-gradient{color:".esc_attr( $subbuttoncolor )."!important;}";
		}

		//Simple and Gradient Background Color
		if( $btn_bg_color == 'gradient' ){
			if(  !empty($bg_gradient_start) || !empty($bg_gradient_end) ){
				$css .= '#'.esc_attr( $uniqId ).' .domain-search-form .btn-gradient{ background: linear-gradient(to right, '.esc_attr( $bg_gradient_start ).' 0%,'.esc_attr( $bg_gradient_end ).' 100%);}';
				$css .= '#'.esc_attr( $uniqId ).' .domain-search-form .btn-gradient{ background: -webkit-linear-gradient(left, '.esc_attr( $bg_gradient_start ).' 0%,'.esc_attr( $bg_gradient_end ).' 100%);}';
			}
		}else{
			if( !empty( $simple_bg_color ) ) {
				$css .= '#'.esc_attr( $uniqId ).' .domain-search-form .btn-gradient{background:'.esc_attr( $simple_bg_color ).'!important;}';

			}
		}

		//Simple and Gradient Background Hover Color
		if( $btn_bg_hv_color == 'gradient_hv' ){
			if(  !empty($bg_gradient_hv_start) || !empty($bg_gradient_hv_end) ){
				$css .= '#'.esc_attr( $uniqId ).' .domain-search-form .btn-gradient:hover{ background: linear-gradient(to right, '.esc_attr( $bg_gradient_hv_start ).' 0%,'.esc_attr( $bg_gradient_hv_end ).' 100%)!important;}';
				$css .= '#'.esc_attr( $uniqId ).' .domain-search-form .btn-gradient:hover{ background: -webkit-linear-gradient(left, '.esc_attr( $bg_gradient_hv_start ).' 0%,'.esc_attr( $bg_gradient_hv_end ).' 100%)!important;}';
			}
		}else{
			if( !empty( $simple_bg_hv_color ) ) {
				$css .= '#'.esc_attr( $uniqId ).' .domain-search-form .btn-gradient:hover{background:'.esc_attr( $simple_bg_hv_color ).'!important;}';

			}
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostfeatures', $atts );

		ob_start();

		if( $styletype == 'styleone' ) {
		?>
		<section id="<?php echo esc_attr( $uniqId ); ?>" class="blusihost-domain-search<?php echo esc_attr( $css_class.$el_class ); ?>">
			<div class="domain-checker">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-6 col-lg-8">
							<form action="<?php echo esc_url( $search_url ); ?>" method="post">
								<div class="input-group" data-animate="<?php echo esc_attr( $animation ); ?>" data-delay="1.6">
									<input type="text" name="domain" class="form-control" placeholder="<?php echo esc_html($placeholder); ?>" data-parsley-required-message="<?php esc_html_e( 'Please enter domain name', 'bluishost' ); ?>" required />
									<div class="input-group-append">
										<input class="btn btn-primary btn-outline-secondary" type="submit" value="<?php esc_html_e( 'Search Now', 'bluishost' ); ?>">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php } elseif( $styletype == 'stylethree' ) { ?>
		<section id="<?php echo esc_attr( $uniqId ); ?>" class="pt-120 pb-120 <?php echo esc_attr( $css_class.$el_class ); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <!-- Section Title -->
                        <div class="section-title text-center section-title--3 text-white">
                        	<?php
                        		if( ! empty( $title ) ) {
                        			echo bluishost_heading_tag(
                        				array(
                        					'tag'			=> 'h2',
                        					'text'			=> esc_html( $title ),
                        					'data-animate'	=> 'fadeInUp'
                        				)
                        			);
                        		}

                        		if( ! empty( $description ) ) {
                        			echo bluishost_paragraph_tag(
                        				array(
                        					'text'			=> esc_html( $description ),
                        					'data-animate'	=> 'fadeInUp',
                        					'data-delay'	=> '.2'
                        				)
                        			);
                        		}
                        	?>
                        </div>
                        <!-- End of Section Title -->

                        <!-- Domain Search Form -->
                        <div class="domain-search-form domain-search-form--2 dark">
                            <form action="<?php echo esc_url( $search_url ); ?>" method="POST" data-animate="fadeInUp" data-delay=".3">
                                <input type="text" name="domain" placeholder="<?php echo esc_html($placeholder); ?>">
                                <button class="btn-gradient" type="submit"><?php echo esc_html( $btntext ) ?></button>
                            </form>
                        </div>
                        <!-- End Of Domain Search Form -->
                        <div class="domain-extension text-white text-center mt-4" data-animate="fadeInUp" data-delay=".4">
                        	<?php
                        		if( is_array( $extension ) ) :
                        	?>
                            <ul class="list-inline list-unstyled mb-0">
                            	<?php
                            		foreach( $extension as $ext ) :
                            			if( ! empty( $ext['dom_extension'] ) )
                            			echo '<li>'. esc_html( $ext['dom_extension'] ) .'</li>';
                            		endforeach;
                            	?>
                            </ul>
                        	<?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </section>
		<?php }else{ ?>
			<section id="<?php echo esc_attr( $uniqId ); ?>" class="blusihost-domain-search<?php echo esc_attr( $css_class.$el_class ); ?>">
				<div class="domain-search">
		            <div class="container">
		                <div  class="domain-search-inner domain-bg" <?php echo esc_attr( $dompattern ); ?>>
		                    <div class="row">
		                        <div class="col-12">
	                            	<?php
		                            	if( !empty( $title ) ) {
		                            		echo '<div class="section-title text-center text-white">';
		                            			echo '<h2 data-animate="fadeInUp" data-delay=".1">'.esc_html( $title ).'</h2>';
		                            		echo '</div>';
		                            	}
	                            	?>
		                            <div class="domain-search-form karla">
		                                <form action="<?php echo esc_url( $search_url ); ?>" method="POST" data-animate="fadeInUp" data-delay=".3">
		                                    <input  type="text" name="domain" placeholder="<?php echo esc_html($placeholder); ?>">
		                                    <button type="submit"><i class="fa fa-search"></i></button>
		                                </form>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
			</section>
		<?php
			}

		if( $css ){
			echo $this->helper->bluishost_inline_css( $css );
		}

		$html = ob_get_clean();

		return $html;

	}

}

$domainsearch = new WPBakeryShortCode_domainsearch();