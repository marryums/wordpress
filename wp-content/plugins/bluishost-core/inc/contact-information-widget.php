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
*Creating Contact Information Widget
***************************************/
 
class bluishost_contact_info_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'bluishost_contact_info_widget', 

// Widget name will appear in UI
esc_html__( 'Bluishost :: Contact Us', 'bluishost' ),

// Widget description
array( 'description' => esc_html__( 'Add footer Contact Information content', 'bluishost' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
$title 		= apply_filters( 'widget_title', $instance['title'] );
// $textarea   = apply_filters( 'widget_textarea', $instance['textarea'] );
$mobile01 	= apply_filters( 'widget_mobile01', $instance['mobile01'] );
$mobile02 	= apply_filters( 'widget_mobile01', $instance['mobile02'] );
$email 		= apply_filters( 'widget_email', $instance['email'] );
$address 	= apply_filters( 'widget_address', $instance['address'] );
$social 	= apply_filters( 'widget_address', $instance['social'] );


//Remove ' ' , '-', ' - ' from phone link
$replace = array(' ','-',' - ');
$with = array('','','');
$mobile01url = str_replace( $replace, $with, $mobile01 );

//Remove ' ' , '-', ' - ' from phone link
$replace = array(' ','-',' - ');
$with = array('','','');
$mobile02url = str_replace( $replace, $with, $mobile02 );

//Remove ' ' , '-', ' - ' from address link
$email = is_email( $email );
$replace = array(' ','-',' - ');
$with = array('','','');

$emailurl = str_replace( $replace, $with, $email );

//before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

    
?>
<div class="footer-contacts">
	<?php 
		
		if( !empty(  $mobile01 ) || !empty(  $mobile02 ) || !empty(  $email ) || !empty(  $working_hour ) || !empty(  $working_hour ) ){
	?>
		
		<ul class="list-unstyled">
			<?php
				if( $mobile01 || $mobile02 ){
			?>
				<li data-animate="fadeInUp" data-delay=".2">
					<span><?php esc_html_e( 'Telephone', 'bluishost' ) ?><i><?php esc_html_e( ':', 'bluishost' ) ?></i></span>
					<a href="<?php echo esc_html( 'tel:'.$mobile01url ); ?>"><?php echo esc_html( $mobile01 ) ?></a>
					<?php 
						if( $mobile02 ){
							echo ',';
					?>
					<a href="<?php echo esc_html( 'tel:'.$mobile02url ) ?>"><?php echo esc_html( $mobile02 ); ?></a>
					<?php } ?>
				</li>
			<?php
				}
			?>

			<?php
			if( $email ){
				echo '<li data-animate="fadeInUp" data-delay=".25">';
				echo '<span>'. esc_html__( 'E-mail', 'bluishost' ) .'<i>'. esc_html__( ':', 'bluishost' ) .'</i></span>';
				echo '<a href="'. esc_html( 'mailto:'.$emailurl ) .'">'. esc_html( $email ) .'</a>';
				echo '</li>';
			}
			
			if( $address ){
				echo '<li data-animate="fadeInUp" data-delay=".3">';
				echo '<span>'. esc_html__( 'Address', 'bluishost' ) .'<i>'. esc_html__( ':', 'bluishost' ) .'</i></span>';
				echo '<address>'. esc_html( $address ) .'</address>';
				echo '</li>';
			}

			if( $social ){
				echo bluishost_social();
			}
			

			?>
			
		</ul>

	<?php	
		}
	?>
</div>
<?php
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {

//Title	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Contact Us', 'bluishost' );
}

//Mobile 01
if ( isset( $instance[ 'mobile01' ] ) ) {
	$mobile01 = $instance[ 'mobile01' ];
}else {
	$mobile01 = '';
}

//Mobile 02
if ( isset( $instance[ 'mobile02' ] ) ) {
	$mobile02 = $instance[ 'mobile02' ];
}else {
	$mobile02 = '';
}

//E-mail
if ( isset( $instance[ 'email' ] ) ) {
	$email = $instance[ 'email' ];
}else {
	$email = '';
}

//Address
if ( isset( $instance[ 'address' ] ) ) {
	$address = $instance[ 'address' ];
}else {
	$address = '';
}

//Social
if ( isset( $instance[ 'social' ] ) ) {
	$social = $instance[ 'social' ];
}else {
	$social = '';
}


// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'mobile01' ); ?>"><?php _e( 'Mobile One:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'mobile01' ); ?>" name="<?php echo $this->get_field_name( 'mobile01' ); ?>" type="text" value="<?php echo esc_attr( $mobile01 ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'mobile02' ); ?>"><?php _e( 'Mobile Two:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'mobile02' ); ?>" name="<?php echo $this->get_field_name( 'mobile02' ); ?>" type="text" value="<?php echo esc_attr( $mobile02 ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />
</p>

<p>
<input class="widefat" id="<?php echo $this->get_field_id( 'social' ); ?>" name="<?php echo $this->get_field_name( 'social' ); ?>" type="checkbox" <?php checked( $social, 'on' );  ?> />
<label for="<?php echo $this->get_field_id( 'social' ); ?>"><?php _e( 'Display Social Icon?' ,'bluishost'); ?></label> 
</p>

<p><?php echo sprintf( __( 'To set social link follow us on widget go to social from Bluishost Options or <a href="%s" target="_blank">Click Here</a>.', 'bluishost' ), admin_url('?page=Bluishost&tab=9') ); ?></p>

<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	
$instance = array();
$instance['title'] 	= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['mobile01']  = ( ! empty( $new_instance['mobile01'] ) ) ? strip_tags( $new_instance['mobile01'] ) : '';
$instance['mobile02']  = ( ! empty( $new_instance['mobile02'] ) ) ? strip_tags( $new_instance['mobile02'] ) : '';
$instance['email'] 	= ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
$instance['address'] 	= ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
$instance['social'] 	= ( ! empty( $new_instance['social'] ) ) ? strip_tags( $new_instance['social'] ) : '';

return $instance;
}
} // Class bluishost_subscribe_widget ends here


// Register and load the widget
function bluishost_contact_info_load_widget() {
	register_widget( 'bluishost_contact_info_widget' );
}
add_action( 'widgets_init', 'bluishost_contact_info_load_widget' );