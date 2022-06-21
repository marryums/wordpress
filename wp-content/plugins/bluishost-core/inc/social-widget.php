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
*Creating social widget
***************************************/
 
class bluishost_social_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'bluishost_social_widget', 


// Widget name will appear in UI
esc_html__( 'Bluishost :: FOLLOW US :', 'bluishost' ), 

// Widget description
array( 'description' => esc_html__( 'Add social widget', 'bluishost' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
$title 	= apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
    
	//
	if( bluishost_footer_social() ):

		echo '<div class="social-links">';
		echo '<ul class="list-unstyled list-inline">';
			echo bluishost_footer_social();
		echo '</ul>';
		echo '</div>';

	endif;

	
	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'FOLLOW US', 'bluishost' );
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p><?php echo sprintf( __( 'To set social link follow us on widget go to social from Bluishost Options or <a href="%s" target="_blank">Click Here</a>.', 'bluishost' ), admin_url('?page=Bluishost&tab=9') ); ?></p>

<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

return $instance;
}
} // Class bluishost_social_widget ends here


// Register and load the widget
function bluishost_social_load_widget() {
	register_widget( 'bluishost_social_widget' );
}
add_action( 'widgets_init', 'bluishost_social_load_widget' );