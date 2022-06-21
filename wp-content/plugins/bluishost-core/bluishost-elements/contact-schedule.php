<?php 
/**
 * Contact Schedule section Element
 */
class WPBakeryShortCode_contact_schedule extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// BLUISHOST helper class
		$this->helper = new bluishost_helper() ;
		
		// bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_schedule_maping' ) );
		
		// bluishost feature shortcode
		add_shortcode( 'bluishostshcedule', array( $this, 'bluishost_schedule_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_schedule_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Contact Schedule", "bluishost" ),
		  "base" => "bluishostshcedule",
		  "class" => "",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(

		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Alignment', "bluishost" ),
				'param_name' 	=> 'alignment',
				'value' 		=> array( 
					'Default' 	=> 'none' ,
					'Left' 		=> 'text-left',  
					'Center' 	=> 'text-center', 
					'Right' 	=> 'text-right',
				),
				'description' 	=> esc_html__( 'Choose your alignment', "bluishost" ),
			),
		  	array(
				"type" => "textfield",
				"heading" => __( "Title", "bluishost" ),
				"param_name" => "title",
				"description" => __( "Set schedule title.", "bluishost" )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Country Name", "bluishost" ),
				"param_name" => "ctname",
				"description" => __( "Set country name.", "bluishost" )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Sub Title", "bluishost" ),
				"param_name" => "subtitle",
				"description" => __( "Set sub title.", "bluishost" )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Tel Number", "bluishost" ),
				"param_name" => "telnumber",
				"description" => __( "Set sub title.", "bluishost" )
			),
		  	array(
			"type"		 => "param_group",
			'param_name' => 'schedules',
			'heading' 	 => esc_html__( 'Set schedule', 'bluishost' ),
			'params' 	 => array(

				array(
					"type" => "textfield",
					"heading" => __( "Schedule Title", "bluishost" ),
					"param_name" => "sctitle",
					"description" => __( "Set counter title.", "bluishost" )
				),
				array(
					"type" => "textfield",
					"heading" => __( "Schedule Description", "bluishost" ),
					"param_name" => "scdescrip",
					"description" => __( "Set counter number.", "bluishost" )
				),
			)),
			array(
				"type" => "css_editor",
				"heading" => __("Design Settings Options", "bluishost"),
				"param_name" => "css",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( " Title Color", "bluishost" ),
				"param_name" => "titlecolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( " Text Color", "bluishost" ),
				"param_name" => "textcolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( " Number Color", "bluishost" ),
				"param_name" => "numbercolor",
				"group"		=> __( "Design Option", "bluishost" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => __( 'Animation Style', "bluishost" ),
				'param_name' => 'animation',
				'description' => __( 'Choose your animation style', "bluishost" ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> __( "Design Option", "bluishost" ),
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
	public function bluishost_schedule_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'alignment'  	   => '',
				'title'  		   => '',
				'ctname'  	   	   => '',
				'subtitle'  	   => '',
				'telnumber'  	   => '',
				'schedules'  	   => '',
				'titlecolor' 	   => '',
				'textcolor' 	   => '',
				'numbercolor' 	   => '',
				'animation' 	   => '',
				'css' 	   		   => '',
				'el_class' 	   	   => '',
			),
		$atts
		) );
		
		// Uniq ID 
		$uniqId = uniqId('counter').'-'.rand(1, 9999);
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		$schedules = vc_param_group_parse_atts( $schedules );

		$Css = '';
		// Title Color
		if( $titlecolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.contact-content h2{color:'.esc_attr( $titlecolor ).';}';
			$Css .= '#'.esc_attr( $uniqId ).'.contact-content ul li span{color:'.esc_attr( $titlecolor ).';}';
		}
		// Text Color
		if( $textcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.contact-content p{color:'.esc_attr( $textcolor ).';}';
			$Css .= '#'.esc_attr( $uniqId ).'.contact-content ul li{color:'.esc_attr( $textcolor ).';}';
		}
		// Number Color
		if( $numbercolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.contact-content a{color:'.esc_attr( $numbercolor ).';}';
		}

		if( $ctname ) {
			$country = ' <span>'. $ctname .'</span>';
		}else{
			$country = '';
		}

		// Alignment
		if( $alignment ) {
			$alignment = $alignment;
		}else{
			$alignment = '';
		}

		//Remove ' ' , '-', ' - ' from phone number
	    $replace = array(' ','-',' - ','(',')');
	    $with = array('','','','','');
	    $telnumber = str_replace( $replace, $with, $telnumber );

	    // Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostshcedule', $atts );
		
		ob_start();
		
		?>
	
		<div id="<?php echo esc_attr( $uniqId ); ?>" class="contact-content <?php echo esc_attr( $animation.$css_class.$el_class.$alignment ); ?>">
			<?php  
			if( !empty( $title ) ) {
				echo '<h2 data-animate="fadeInUp" data-delay=".1">'. esc_html( $title ) . wp_kses_post( $country ).'</h2>';
			}

			if( $subtitle ) {
				echo '<p data-animate="fadeInUp" data-delay=".3">'. esc_html( $subtitle ) .' <a href="tel:'.esc_attr( $telnumber ) .'">' . esc_html( $telnumber ) . '</a></p>';
			}

			if( $schedules ) {
			?>
            <ul class="list-unstyled contact-info karla" data-animate="fadeInUp" data-delay=".5">
            	<?php  
            		foreach ( $schedules as $sched ) {
            			$sectitle = isset( $sched['sctitle'] ) ? $sched['sctitle'] : '';

            			if( !empty( $sectitle ) || !empty( $sched['scdescrip'] ) ) {

            				echo '<li><span>'. esc_html( $sectitle ) .'</span> '. esc_html( $sched['scdescrip'] ) .'</li>';
            			}
            			
            		}
            	?>
            </ul>
        	<?php } ?>
		</div>
		<?php

		if($Css){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_contact_schedule();
?>