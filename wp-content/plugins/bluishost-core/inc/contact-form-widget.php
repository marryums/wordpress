<?php
/**
 * @version  1.0
 * @package  Bluishost
 * @author   Themelooks <support@themelooks.com>
 *
 * Websites: http://www.themelooks.com
 *
 */
 
 
/**************************************
*Creating Subscribe the widget
***************************************/
 
class bluishost_contact_form_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'bluishost_contact_form_widget', 


// Widget name will appear in UI
esc_html__( 'Bluishost :: Contact Form', 'bluishost' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer contact form', 'bluishost' ), ) 
);

}
// This is where the action happens
public function widget( $args, $instance ) {
$title 		= apply_filters( 'widget_title', $instance['title'] );
$shortcode 	= apply_filters( 'widget_shortcode', $instance['shortcode'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

	if( $shortcode ){
		echo '<div class="footer-form">';
		echo do_shortcode( $shortcode );
		echo '</div>';
	}

	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Get In Touch', 'bluishost' );
}	
if ( isset( $instance[ 'shortcode' ] ) ) {
	$shortcode = $instance[ 'shortcode' ];
}else {
	$shortcode = '';
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'shortcode' ); ?>"><?php _e( 'Shortcode:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'shortcode' ); ?>" name="<?php echo $this->get_field_name( 'shortcode' ); ?>" type="text" value="<?php echo esc_attr( $shortcode ); ?>" />
</p>

<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['shortcode'] = ( ! empty( $new_instance['shortcode'] ) ) ? strip_tags( $new_instance['shortcode'] ) : '';

return $instance;
}
}

// Register and load the widget
function bluishost_contact_form_load_widget() {
	register_widget( 'bluishost_contact_form_widget' );
}
add_action( 'widgets_init', 'bluishost_contact_form_load_widget' );