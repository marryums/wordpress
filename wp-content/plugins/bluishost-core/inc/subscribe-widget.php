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
 
class bluishost_subscribe_widget extends WP_Widget {

function __construct() {

parent::__construct(
// Base ID of your widget
'bluishost_subscribe_widget', 

// Widget name will appear in UI
esc_html__( 'Bluishost :: Subscribe', 'bluishost' ), 

// Widget description
array( 'description' => esc_html__( 'Add subscribe widget form', 'bluishost' ), ) 
);

}
// This is where the action happens
public function widget( $args, $instance ) {
$title 		= apply_filters( 'widget_title', $instance['title'] );
$shortDesc 	= apply_filters( 'widget_shortdesc', $instance['shortdesc'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
?>
	
	<div class="subscribe-form form-style--3">
		<form action="#" method="post" id="footer_subscribe_submit">
			<input type="email" name="footersubscribe_email" id="footersubscribe_email" class="form-control" autocomplete="off" placeholder="<?php esc_attr_e( 'Your E-mail Address', 'bluishost' ); ?>" required>
			<button type="submit"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) ?>img/rocket.svg" alt=""></button>
			<div id="alert-footermessage"></div>
		</form>
	</div>

  <?php
  //Footer Subscribe Widget Start
  if( $shortDesc ){
    echo '<div class="subscribe-text ">';
    echo '<p data-animate="fadeInUp" data-delay=".8">'.esc_html( $shortDesc ).'</p>';
    echo '</div>';
  }

	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Subscribe', 'bluishost' );
}	
if ( isset( $instance[ 'shortdesc' ] ) ) {
	$shortDesc = $instance[ 'shortdesc' ];
}else {
	$shortDesc = '';
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'shortdesc' ); ?>"><?php _e( 'Short Descriptions:' ,'bluishost'); ?></label> 
<textarea class="widefat" id="<?php echo $this->get_field_id( 'shortdesc' ); ?>" name="<?php echo $this->get_field_name( 'shortdesc' ); ?>"><?php echo esc_attr( $shortDesc ); ?></textarea>
</p>

<?php 
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['shortdesc'] = ( ! empty( $new_instance['shortdesc'] ) ) ? strip_tags( $new_instance['shortdesc'] ) : '';

return $instance;
}
} // Class quickfix_subscribe_widget ends here

// Register and load the widget
function bluishost_subscribe_load_widget() {
	register_widget( 'bluishost_subscribe_widget' );
}
add_action( 'widgets_init', 'bluishost_subscribe_load_widget' );

// // Subscribe JS File Enqueue
// add_action( 'wp_enqueue_scripts', 'bluishost_subscribe_core_enqueue' );
 
// // Minapress Section subscribe ajax callback function
// add_action( 'wp_ajax_bluishost_subscribe_ajax', 'bluishost_subscribe_ajax' );
// add_action( 'wp_ajax_nopriv_bluishost_subscribe_ajax', 'bluishost_subscribe_ajax' );


// //Subscribe JS File Enqueue
// function bluishost_subscribe_core_enqueue(){
//   wp_enqueue_script( 'subscribe-main', KRIPDOM_PLUGINURL. 'js/subscribe.js', array('jquery'), '1.0', true );
   
//   wp_localize_script(
//     'subscribe-main',
//     'subscribeajax',
//     array(
//        'action_url' => admin_url( 'admin-ajax.php' )
//     )
//   );
   
// }


// function bluishost_subscribe_ajax( ){
     
//   $apiKey = bluishost_opt('bluishost_subscribe_apikey');
//   $listid = bluishost_opt('bluishost_subscribe_listid');

  

   
//    $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

//    $result = $MailChimp->post("lists/{$listid}/members",[
//      'email_address'    => $_POST['footersubscribe_email'],
//      'status'        => 'subscribed',
//    ]);
   

//   if ($MailChimp->success()) {
//     if( $result['status'] == 'subscribed' ){
//         echo '<div class="alert alert-success" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'bluishost').'</div>';
//     }
//   }elseif( $result['status'] == '400' ) {
//     echo '<div class="alert alert-danger" role="alert">'.esc_html__('This Email address is already exists.', 'bluishost').'</div>';
//   }else{
//     echo '<div class="alert alert-danger" role="alert">'.esc_html__('Sorry something went wrong.', 'bluishost').'</div>';
//   }

//     wp_die();       
// }