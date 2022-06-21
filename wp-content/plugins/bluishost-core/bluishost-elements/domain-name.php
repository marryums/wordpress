<?php 
/**
 * Bluishost domain name section elements
 */
class WPBakeryShortCode_domainname extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_domainname_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostdomainname', array( $this, 'bluishost_domainname_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_domainname_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Domain Name", "bluishost" ),
		  "base" => "bluishostdomainname",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(	
		  	array(
				"type"		 => "param_group",
				'param_name' => 'domainheading',
				'heading' 	 => esc_html__( 'Domain Heading', 'bluishost' ),
				'params' 	 => array(
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Heading", "bluishost" ),
						"param_name" => "heading",
					),
				)
			),	
			array(
				"type"		 => "param_group",
				'param_name' => 'domaininfo',
				'heading' 	 => esc_html__( 'Domain Informatin', 'bluishost' ),
				'params' 	 => array(
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Domain Name", "bluishost" ),
						"param_name" => "dname",
					),
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Extension Normal", "bluishost" ),
						"param_name" => "exnormal",
					),
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Extension Bold", "bluishost" ),
						"param_name" => "exbold",
					),
					array(
						'type' 			=> 'iconpicker',
						'heading' 		=> esc_html__( 'Icon', "bluishost" ),
						'param_name' 	=> 'icon_fontawesome',
						'settings' 		=> array(
						'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
						'type' 			=> 'fontawesome',
						'iconsPerPage'  => 200, // default 100, how many icons per/page to display
						),
						'dependency' 	=> array(
							'element' => 'icontype',
							'value'   => 'fontawesome',
						),
						'description' 	=> esc_html__( 'Select icon from library.', "bluishost" ),
					),
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Status", "bluishost" ),
						"param_name" => "status",
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
						"heading" 	 => esc_html__( "Price", "bluishost" ),
						"param_name" => "price",
					),
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Duration", "bluishost" ),
						"param_name" => "duration",
					),
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Purchase Text", "bluishost" ),
						"param_name" => "purchtext",
					),
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Purchase Url", "bluishost" ),
						"param_name" => "purchurl",
					),
				)
			),	
			array(
				"type" 		 	=> "textfield",
				"holder" 	 	=> "div",
				"heading" 	 	=> esc_html__( "More Button Text", "bluishost" ),
				"param_name" 	=> "morebtntxt",
			),
			array(
				"type" 		 	=> "textfield",
				"holder" 	 	=> "div",
				"heading" 	 	=> esc_html__( "More Button Url", "bluishost" ),
				"param_name" 	=> "morebtnurl",
			),
			array(
				"type" 			=> "css_editor",
				"heading" 		=> esc_html__("Design Settings Options", "bluishost"),
				"param_name" 	=> "css",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Text Position', "bluishost" ),
				'param_name' 	=> 'textpos',
				'value' 		=> array( 'Default' => 'none' ,'Right' => 'text-right', 'Center' => 'text-center', 'Left' => 'text-left'  ),
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Heading Color", "bluishost" ),
				"param_name" 	=> "hdcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Heading Background Color", "bluishost" ),
				"param_name" 	=> "hdbgcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Text Color", "bluishost" ),
				"param_name" 	=> "textcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Extension & Price Color", "bluishost" ),
				"param_name" 	=> "expricecolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Button Leve Color", "bluishost" ),
				"param_name" 	=> "btntxtcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " More Button Text Color", "bluishost" ),
				"param_name" 	=> "morbtntxtcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " More Button Background Color", "bluishost" ),
				"param_name" 	=> "morbtnbgcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " More Button Text Hover Color", "bluishost" ),
				"param_name" 	=> "morbtntxthvcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " More Button Background Hover Color", "bluishost" ),
				"param_name" 	=> "morbtnbghvcolor",
				"group"			=> esc_html__( "Design Option", "bluishost" ),
			),
			//
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
	public function bluishost_domainname_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'domainheading'  	=> '',
				'domaininfo' 	 	=> '',
				'morebtntxt' 	 	=> '',
				'morebtnurl' 	 	=> '',
				'textpos' 	 	 	=> '',
				'hdcolor' 	 	 	=> '',
				'hdbgcolor' 	 	=> '',
				'textcolor' 	 	=> '',
				'expricecolor'	 	=> '',
				'btntxtcolor' 	 	=> '',
				'morbtntxtcolor' 	=> '',
				'morbtnbgcolor'	 	=> '',
				'morbtntxthvcolor' 	=> '',
				'morbtnbghvcolor'	=> '',
				'css'			 	=> '',
				'animation'	     	=> '',
				'el_class'		 	=> '',
			),
		$atts
		) );
		
		$uniqID = uniqID('dmname').'-'.rand( 1, 9999 );
		
		$Css = '';

		// Heading and Background Color
		if( $hdcolor || $hdbgcolor ) {
			$Css .= '#'.esc_attr( $uniqID ).' .domain-table .thead-dark th{color:'. esc_attr( $hdcolor ) .';background-color:'. esc_attr( $hdbgcolor ) .';border-color:'. esc_attr( $hdbgcolor ) .'; }';
		}
		// Extension Color
		if( $textcolor ) {
			$Css .= '#'.esc_attr( $uniqID ).' .domain-table tbody td{color:'. esc_attr( $textcolor ) .'; }';
		}
		// Price Color
		if( $expricecolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .domain-table tbody span{color:'.esc_attr( $expricecolor ).'!important;}';
		}
		// Button Text Color
		if( $btntxtcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .domain-table tbody a{color:'.esc_attr( $btntxtcolor ).'!important;}';
		}
		// Button Color
		if( $morbtntxtcolor || $morbtnbgcolor || $morbtntxthvcolor || $morbtnbghvcolor ){
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary{color:'.esc_attr( $morbtntxtcolor ).';background-color:'.esc_attr( $morbtnbgcolor ).';border-color:'. esc_attr( $morbtnbgcolor ) .'}';
			$Css .= '#'.esc_attr( $uniqID ).' .btn-primary:hover{color:'.esc_attr( $morbtntxthvcolor ).';background-color:'.esc_attr( $morbtnbghvcolor ).';border-color:'. esc_attr( $morbtnbghvcolor ) .'}';
		}

		if( $textpos ) {
			$textpos = $textpos;
		}else{
			$textpos = 'text-center';
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
				
		$domainheading = vc_param_group_parse_atts( $domainheading );
		$domaininfo = vc_param_group_parse_atts( $domaininfo );
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostdomainname', $atts );
		
		ob_start();
		?>	

		<div id="<?php echo esc_attr( $uniqID ); ?>" class="domainnames <?php echo esc_attr( $textpos.$css_class.$el_class.$animation ); ?>">
	        <div class="table-responsive-md">
	            <table class="domain-table table table-bordered table-hover" data-animate="fadeInUp" data-delay=".1">
	            	<?php if( $domainheading ) : ?>
	                <thead class="thead-dark">
	                    <tr>
	                    	<?php
	                    	foreach ($domainheading as $heading) {
	                    		echo '<th>'. esc_html( $heading['heading'] ) .'</th>';
	                    	}
	                    	?>
	                    </tr>
	                </thead>
	                <?php 
	                endif;

	                if( $domaininfo ) :
	                ?>
	                <tbody class="karla">
	                	<?php
                    	foreach ($domaininfo as $domain) {

                    		$dname = isset( $domain['dname'] ) ? $domain['dname'] : '';
                    		$exnormal = isset( $domain['exnormal'] ) ? $domain['exnormal'] : '';
                    		$exbold = isset( $domain['exbold'] ) ? $domain['exbold'] : '';
                    		$status = isset( $domain['status'] ) ? $domain['status'] : '';

                    		if( $exbold) {
                    			$extension = '<span>'. $exbold .'</span>';
                    		}else{
                    			$extension = $exnormal ;
                    		}

                    		$currency = isset( $domain['currency'] ) ? $domain['currency'] : '';
                    		$price = isset( $domain['price'] ) ? $domain['price'] : '';
                    		$duration = isset( $domain['duration'] ) ? $domain['duration'] : '';
                    		$purchurl = isset( $domain['purchurl'] ) ? $domain['purchurl'] : '';
                    		$purchtext = isset( $domain['purchtext'] ) ? $domain['purchtext'] : '';

                    		echo '<tr>';
                    		echo '<td>'. esc_html( $dname ) . wp_kses_post( $extension ) .'</td>';
                    		echo '<td><i class="'. esc_html( $domain['icon_fontawesome'] ) .'"></i> '. esc_html( $status ) .'</td>';
                    		echo '<td><span>'. esc_html( $currency ) . esc_html( $price ) .'</span>'. esc_html( $duration ) .'</td>';
                    		echo '<td><a href="'. esc_url( $purchurl  ) .'">'. esc_html( $purchtext ) .' <i class="fas fa-caret-right"></i></a></td>';
                    		echo '</tr>';
                    	}
                    	?>
	                </tbody>
	            	<?php endif; ?>
	            </table>
	        </div>
	        <?php 
	        	if( !empty( $morebtnurl ) ) {
	        		echo '<a href="'. esc_url( $morebtnurl ) .'" class="btn btn-primary" data-animate="fadeInUp" data-delay=".1">'. esc_html( $morebtntxt ) .'</a>';
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

$domainsearch = new WPBakeryShortCode_domainname();
?>