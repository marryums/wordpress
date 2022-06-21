<?php 
/**
 * Bluishost Pricing Filter  Element
 */
class WPBakeryShortCode_pricingfilter extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper();
		
		// Bluishost pricing section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_pricingfilter_maping' ) );
		
		// Bluishost pricing shortcode
		add_shortcode( 'bluishostpricingfilter', array( $this, 'bluishost_pricingfilter_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_pricingfilter_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" 		=> esc_html__( "Pricing Table Filter", "bluishost" ),
		  "base" 		=> "bluishostpricingfilter",
		  "class" 		=> "",
		  "icon"  		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Bluishost", "bluishost"),
		  "params" 		=> array(		
				array(
					"type" 		 	=> "dropdown",
					"holder" 	 	=> "div",
					"heading" 	 	=> esc_html__( "Column", "bluishost" ),
					"value"      	=> array( 'Column 2' => '6', 'Column 3' => '4', 'Column 4' => '3' ),
					"group"		 	=> esc_html__( "Pricing Table Settings", "bluishost" ),
					"param_name" 	=> "column",
				),
				array(
					"type"		 => "param_group",
					'param_name' => 'pricingtablesset',
					"group"		 => esc_html__( "Pricing Table Settings", "bluishost" ),
					'heading' 	 => esc_html__( 'Pricing Table Settings', 'bluishost' ),
					'params' 	 => array(
						array(
							"type" 		 => "textfield",
							"holder" 	 => "div",
							"heading" 	 => esc_html__( "Tab Name", "bluishost" ),
							"param_name" => "tabname",
						),	
						array(
							"type"		 => "param_group",
							'param_name' => 'pricingtabls',
							'heading' 	 => esc_html__( 'Pricing Tables', 'bluishost' ),
							'params' 	 => array(
								array(
									"type" 		 => "textfield",
									"holder" 	 => "div",
									"heading" 	 => esc_html__( "Title", "bluishost" ),
									"param_name" => "title",
								),
								array(
									"type" 		 => "textfield",
									"holder" 	 => "div",
									"heading" 	 => esc_html__( "Currency", "bluishost" ),
									"param_name" => "currency",
								),	
								array(
									"type" 		 => "textfield",
									"holder" 	 => "div",
									"heading" 	 => esc_html__( "price", "bluishost" ),
									"param_name" => "price",
								),
								array(
									"type" 		 => "textfield",
									"holder" 	 => "div",
									"heading" 	 => esc_html__( "Duration", "bluishost" ),
									"param_name" => "duration",
								),	
								array(
									"type" 		 => "checkbox",
									"holder" 	 => "div",
									"heading" 	 => esc_html__( "Active", "bluishost" ),
									"param_name" => "active",
								),
								array(
									"type"		 => "param_group",
									'param_name' => 'features',
									'heading' 	 => esc_html__( 'Features', 'bluishost' ),
									'params' 	 => array(
										array(
											"type" 		 => "textfield",
											"holder" 	 => "div",
											"heading" 	 => esc_html__( "Feature", "bluishost" ),
											"param_name" => "feature",
										),
										
									)
									
								),
								array(
									"type" 		 => "textfield",
									"holder" 	 => "div",
									"heading" 	 => esc_html__( "Button Text", "bluishost" ),
									"param_name" => "buttontext",
								),
								array(
									"type" 		 => "textfield",
									"holder" 	 => "div",
									"heading" 	 => esc_html__( "Button Url", "bluishost" ),
									"param_name" => "btnurl",
								),	

							),
													
						),
									
					)
					
				),
				array(
					'type' 		 	=> 'css_editor',
					'heading' 	 	=> esc_html__('Design Settings Options', 'bluishost'),
					'param_name' 	=> 'css',
					'group'		 	=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Filter Tab Text Color", "bluishost" ),
					"param_name" 	=> "filtercolor",
					"description"	=> esc_html__( "Set filter tab text color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Filter Tab Background Color", "bluishost" ),
					"param_name" 	=> "filtertabgcolor",
					"description"	=> esc_html__( "Set filter tab background color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Filter Tab Active Text Color", "bluishost" ),
					"param_name" 	=> "filtertabactxtcolor",
					"description"	=> esc_html__( "Set filter tab active text color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Filter Tab Active Background Color", "bluishost" ),
					"param_name" 	=> "filtertabacbgcolor",
					"description"	=> esc_html__( "Set filter tab active background color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Title Color", "bluishost" ),
					"param_name" 	=> "titlecolor",
					"description"	=> esc_html__( "Set title color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Title Hover Color", "bluishost" ),
					"param_name" 	=> "titlehvcolor",
					"description"	=> esc_html__( "Set title hover color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Price Color", "bluishost" ),
					"param_name" 	=> "pricecolor",
					"description"	=> esc_html__( "Set price color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Price Hover Color", "bluishost" ),
					"param_name" 	=> "pricehvcolor",
					"description"	=> esc_html__( "Set price hover color color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Price Border Color", "bluishost" ),
					"param_name" 	=> "pricebdcolor",
					"description"	=> esc_html__( "Set price border color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Price Background Color", "bluishost" ),
					"param_name" 	=> "pricebgcolor",
					"description"	=> esc_html__( "Set price background color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Price Hover Background Color", "bluishost" ),
					"param_name" 	=> "pricehvbgcolor",
					"description"	=> esc_html__( "Set price hover background color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Feature Color", "bluishost" ),
					"param_name" 	=> "featurecolor",
					"description"	=> esc_html__( "Set feature color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Feature Hover Color", "bluishost" ),
					"param_name" 	=> "featurehvcolor",
					"description"	=> esc_html__( "Set feature hover color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Button Background Color", "bluishost" ),
					"param_name" 	=> "buttonbgcolor",
					"description"	=> esc_html__( "Set button background color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Button Hover Background Color", "bluishost" ),
					"param_name" 	=> "btnhvbgcolor",
					"description"	=> esc_html__( "Set button hover background color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Button Text Color", "bluishost" ),
					"param_name" 	=> "btntextcolor",
					"description"	=> esc_html__( "Set button text color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Button Hover Text Color", "bluishost" ),
					"param_name" 	=> "btnhvtextcolor",
					"description"	=> esc_html__( "Set button hover text color", "bluishost" ),
					"group"			=> esc_html__( 'Design Option', 'bluishost' ),
				),
				
				array(
					"type"		 	=> "colorpicker",
					"heading"	 	=> esc_html__( "Border Color", "bluishost" ),
					"param_name" 	=> "bordercolor",
					"description"	=> esc_html__( "Set border color", "bluishost" ),
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
	public function bluishost_pricingfilter_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'column' 		   		=> '3',
				'pricingtablesset' 		=> '',
				'css' 			   		=> '',
				'filtercolor' 			=> '',
				'filtertabgcolor' 		=> '',
				'filtertabactxtcolor' 	=> '',
				'filtertabacbgcolor' 	=> '',
				'titlecolor' 			=> '',
				'titlehvcolor' 			=> '',
				'pricecolor' 			=> '',
				'pricehvcolor' 			=> '',
				'pricebdcolor' 			=> '',
				'pricebgcolor' 			=> '',
				'pricehvbgcolor'   		=> '',
				'featurecolor' 	   		=> '',
				'featurehvcolor' 	   	=> '',
				'buttonbgcolor' 	   	=> '',
				'btnhvbgcolor' 			=> '',
				'btntextcolor' 			=> '',
				'btnhvtextcolor' 		=> '',
				'bordercolor' 			=> '',
				'animation' 			=> '',
				'el_class' 				=> '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = uniqid( 'pricing_filter' ).'-'.rand( 1, 9999 );
							
		$pricingtablesset = vc_param_group_parse_atts( $pricingtablesset );

		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}

		$Css = '';

		// Filter Tab Text Color
		if( $filtercolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .pricing-filter ul.pricing_nav li a{color:'.esc_attr( $filtercolor ).'!important;}';
		}

		// Filter Tab Background Color
		if( $filtertabgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .pricing-filter ul.pricing_nav li a{background-color:'.esc_attr( $filtertabgcolor ).'!important;}';
		}
 
		// Filter Tab Active Text Color
		if( $filtertabactxtcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .pricing-filter .pricing_nav .nav-item a.active{color:'.esc_attr( $filtertabactxtcolor ).'!important;}';
		}

		// Filter Tab Active Background Color
		if( $filtertabacbgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .pricing-filter .pricing_nav .nav-item a.active:after{background-color:'.esc_attr( $filtertabacbgcolor ).'!important;}';
		}

		// Title Color
		if( $titlecolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table .pt_header h2 {color:'.esc_attr( $titlecolor ).';}';
		}
		// Title Hover Color
		if( $titlehvcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table:hover .pt_header h2 {color:'.esc_attr( $titlehvcolor ).';}';
		}

		// Price Color
		if( $pricecolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table .pt_header .pt_price {color:'.esc_attr( $pricecolor ).';}';
		}

		// Price Hover Color
		if( $pricehvcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table:hover .pt_price, .single_pricing_table:hover .btn {color:'.esc_attr( $pricehvcolor ).';}';
		}

		// Price Border Color
		if( $pricebdcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table .pt_header .pt_price {border-color:'.esc_attr( $pricebdcolor ).';}';
		}

		// Price Background Color
		if( $pricebgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table .pt_header .pt_price {background-color:'.esc_attr( $pricebgcolor ).';}';
		}

		// Price Background Hover Color
		if( $pricehvbgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table:hover .pt_price, .single_pricing_table:hover .btn {background-color:'.esc_attr( $pricehvbgcolor ).';}';
		}

		// Price Feature Color
		if( $featurecolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table .pt_feature ul li {color:'.esc_attr( $featurecolor ).';}';
		}

		// Price Feature Hover Color
		if( $featurehvcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table:hover .pt_feature ul li {color:'.esc_attr( $featurehvcolor ).';}';
		}

		// Button Background Color
		if( $buttonbgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table .btn {background-color:'.esc_attr( $buttonbgcolor ).';}';
		}

		// Button Background Hover Color
		if( $btnhvbgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table:hover .btn {background-color:'.esc_attr( $btnhvbgcolor ).';}';
		}

		// Button Text Color 
		if( $btntextcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table .btn {color:'.esc_attr( $btntextcolor ).';}';
		}

		// Button Text Hover Color
		if( $btnhvtextcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table:hover .btn {color:'.esc_attr( $btnhvtextcolor ).';}';
		}

		// Border Color
		if( $bordercolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .single_pricing_table {border-color:'.esc_attr( $bordercolor ).';}';
		}

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostpricingfilter', $atts );
		
		ob_start();
		
		?>
		<div id="<?php echo esc_attr( $uniqId ) ?>" class="bluishost-pricing-filter">
			<div class="row justify-content-center">
				<div class="col">
					<div class="pricing-filter" data-animate="fadeInUp" data-delay=".2">
						<ul class="pricing_nav nav nav-tabs justify-content-center" role="tablist">
							<?php 
							$html = '';
							$i = 0;
							foreach( $pricingtablesset as $tab ){
								$active = '';
								if( $i == 0 ){
									$active = 'active';
								}

								if( !empty( $tab['tabname'] ) ){
									$html .= '<li class="nav-item"><a class="'.esc_attr( $active ).'" href="#'.esc_attr( sanitize_title( $tab['tabname'] ) ).'" role="tab" data-toggle="tab">'.esc_html( $tab['tabname'] ).'</a></li>';
								}
								$i++;
							}
											
							echo $html;
							?>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="tab-content">
				<?php 
				if( is_array( $pricingtablesset ) ):
					$i = 0;
					foreach( $pricingtablesset as $pricingtable ):
					$active = '';
					if( $i == 0 ){
						$active = ' active';
					}
					
					$pricingtabls = vc_param_group_parse_atts( $pricingtable['pricingtabls'] );
				?>
				<div class="tab-pane show fade <?php echo esc_attr( $active ); ?>" id="<?php echo esc_attr( sanitize_title( $pricingtable['tabname'] ) ); ?>" role="tabpanel">

					<div class="row justify-content-center">
						<?php 
						foreach( $pricingtabls as $pricingtabl ):
						$tblactive = '';
						if( !empty( $pricingtabl['active'] ) ){
							$tblactive = ' active';
						}
						
						?>
						<div class="col-lg-<?php echo esc_attr( $column ); ?> col-md-6 col-12">
							<div class="pricing--content <?php echo esc_attr( $tblactive ); ?>">
								<div class="single_pricing_table text-center" data-animate="fadeInUp" data-delay=".2">
									
									<div class="pt_header">
										<?php 
											// Price
											if( !empty( $pricingtabl['price'] ) || !empty( $pricingtabl['duration'] ) ) {
												echo '<div class="pt_price">';
													if( !empty( $pricingtabl['price'] ) ){
														echo '<span>'. esc_html( $pricingtabl['currency'] ). esc_html( $pricingtabl['price'] ).'</span>';
													}
													//
													if( !empty( $pricingtabl['duration'] ) ){
														echo '<small>'.esc_html( $pricingtabl['duration'] ).'</small>';
													}
												echo '</div>';
											}

											// Title
											if( !empty( $pricingtabl['title'] ) ){
												echo '<h2>'.esc_html( $pricingtabl['title'] ).'</h2>';
											}
										?>
									</div>
									<?php 
									if( !empty( $pricingtabl['features'] ) ):
										$features = vc_param_group_parse_atts( $pricingtabl['features'] );
									?>
										<div class="pt_body">
											<div class="pt_feature karla">
												<ul>
													<?php 
														foreach( $features as $feature ){
															echo '<li>'.$feature['feature'].'</li>';
														}
													?>
												</ul>
											</div>
										</div>
										<?php 
										if( !empty( $pricingtabl['buttontext'] ) && !empty( $pricingtabl['btnurl'] ) ):
										?>
										<div class="pt_footer">
		                                    <a class="btn btn-transparent btn-square" href="<?php echo esc_url( $pricingtabl['btnurl'] ); ?>"><?php echo esc_html( $pricingtabl['buttontext'] ); ?></a>
										</div>
									<?php 
										endif;
									endif;
									?>
								</div>
							</div>
						</div>
						<?php 
						endforeach;
						?>
					</div>
				</div>
				<?php 
					$i++;
					endforeach;
				endif;
				?>
			</div>
		</div>
		<?php
		
		if($Css){
			echo $this->helper->bluishost_inline_css( $Css );
		}

		$html = ob_get_clean();
		
		return $html;
		
	}
	
}

$sectheading = new WPBakeryShortCode_pricingfilter();
?>