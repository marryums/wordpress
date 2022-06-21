<?php 
/**
 * Contact form section Element
 */
class WPBakeryShortCode_contact_form extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// BLUISHOST helper class
		$this->helper = new bluishost_helper() ;
		
		// bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_form_maping' ) );
		
		// bluishost feature shortcode
		add_shortcode( 'bluishostform', array( $this, 'bluishost_form_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_form_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" 		=> esc_html__( "Contact Form", "bluishost" ),
		  "base" 		=> "bluishostform",
		  "class" 		=> "",
		  "icon"  		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Bluishost", "bluishost"),
		  "params" 		=> array(

		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Contact Form Style', "bluishost" ),
				'param_name' 	=> 'form_style',
				'value' 		=> array( 
					esc_html__( 'Default', 'bluishost' )   => 'none',
					esc_html__( 'Style One', 'bluishost' ) => 'form_one',
					esc_html__( 'Style Two', 'bluishost' ) => 'form_two',
				),
				'description' 	=> esc_html__( 'Choose your contact form style', "bluishost" ),
				'std'			=> 'form_one'
			),
		  	array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Title", "bluishost" ),
				"param_name" 	=> "title",
				"group"			=> esc_html__( "Contact Form", "bluishost" ),
				"description" 	=> esc_html__( "Set title.", "bluishost" )
			),
		  	array(
				'type' 			=> 'textarea_html',
				'heading' 	  	=> esc_html__( 'Form Shortcode', 'bluishost' ),
				'param_name'  	=> 'content',
				'group'			=> esc_html__( 'Contact Form', 'bluishost' ),
				'description' 	=> esc_html__( 'Set form shortcode ( get shortcode from contact form 7 ).', 'bluishost' )
			),
			array(
				"type" 			=> "css_editor",
				"heading" 		=> esc_html__("Design Settings Options", "bluishost"),
				"param_name" 	=> "css",
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
	public function bluishost_form_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'form_style'   	   => 'form_one',
				'title'   		   => '',
				'animation' 	   => '',
				'css' 	   		   => '',
				'el_class' 	   	   => '',

			),
		$atts
		) );
		
		// Uniq ID 
		$uniqID = uniqId('counter').'-'.rand(1, 9999);
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		if( $form_style != 'form_one' ) {
			$form_class = 'contact-form-v2';
		}else{
			$form_class = '';
		}

		$Css = '';

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostform', $atts );
		
		ob_start();
		
		?>
	
		<?php if( $content ) : ?>
	    	<div id="<?php echo esc_attr( $uniqID ); ?>" class="contact-page-form <?php echo esc_attr( $form_class.$animation.$css_class.$el_class ) ?>">
				<?php
					if( ! empty( $title ) ) {
						echo '<h3>'. esc_html( $title ) .'</h3>';
					}
					echo bluishost_get_textareahtml_output( $content );
				?>
			</div>
		<?php 
		endif;
		if($Css){
			echo $this->helper->bluishost_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	}
	
}

$sectheading = new WPBakeryShortCode_contact_form();
?>