<?php 
/**
 * Counter section Element
 */
class WPBakeryShortCode_counter extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// BLUISHOST helper class
		$this->helper = new bluishost_helper() ;
		
		// bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_counter_maping' ) );
		
		// bluishost feature shortcode
		add_shortcode( 'bluishostcounter', array( $this, 'bluishost_counter_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_counter_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Counter", "bluishost" ),
		  "base" => "bluishostcounter",
		  "class" => "",
		  "icon"  => BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" => __( "Bluishost", "bluishost"),
		  "params" => array(

		  	array(
			"type"		 => "param_group",
			'param_name' => 'counters',
			"group"		 => esc_html__( "Counter", "bluishost" ),
			'heading' 	 => esc_html__( 'Set counter', 'bluishost' ),
			'params' 	 => array(

				array(
					"type" => "textfield",
					"heading" => __( "Title", "bluishost" ),
					"param_name" => "title",
					"description" => __( "Set counter title.", "bluishost" )
				),
				array(
					"type" => "textfield",
					"heading" => __( "Count Number", "bluishost" ),
					"param_name" => "number",
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
	public function bluishost_counter_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'counters'  	   => '',
				'title'  		   => '',
				'number'  	   	   => '',
				'titlecolor' 	   => '',
				'numbercolor' 	   => '',
				'css' 	   		   => '',
				'animation' 	   => '',
				'el_class' 	   	   => '',
			),
		$atts
		) );
		
		// Uniq ID 
		$uniqId = uniqId('counter').'-'.rand(1, 9999);
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		$counters = vc_param_group_parse_atts( $counters );

		$Css = '';
		// Title Color
		if( $titlecolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .happy-counter li p{color:'.esc_attr( $titlecolor ).';}';
		}
		// Number Color
		if( $numbercolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .happy-counter li span{color:'.esc_attr( $numbercolor ).';}';
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostcounter', $atts );
		

		ob_start();
		
		?>
	
			<div id="<?php echo esc_attr( $uniqId ); ?>" class="counter--item <?php echo esc_attr( $animation.$css_class.$el_class ); ?>">
				<ul class="happy-counter list-unstyled clearfix">
					<?php 
					foreach( $counters as $count ) {
						if(  $count['number'] || $count['title'] ) {
							echo '<li>';
							if( $count['number'] ){
								echo '<span data-count="'.esc_attr(  $count['number'] ).'">0</span>';
							}
							// title
							if( $count['title'] ){
								echo '<p>'.esc_html( $count['title'] ).'</p>';
							}
							echo '</li>';
						}
					}
					?>
				</ul>
			</div>
		<?php

		if($Css){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_counter();
?>