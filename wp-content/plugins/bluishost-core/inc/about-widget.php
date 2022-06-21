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
*Creating About Widget
***************************************/
 
class bluishost_about_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'bluishost_about_widget', 


// Widget name will appear in UI
esc_html__( 'Bluishost :: About Us', 'bluishost' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer About Content', 'bluishost' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
$title 		= apply_filters( 'widget_title', $instance['title'] );
$image 		= apply_filters( 'widget_image', $instance['image'] );
$imageurl 	= apply_filters( 'widget_logourl', $instance['imageurl'] );
$textarea 	= apply_filters( 'widget_textarea', $instance['textarea'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

    
?>
	
	<?php 
		if( $imageurl  ){
			$imageurl = $imageurl;
		}else{
			$imageurl = '';
		}
		
		if( $image ){
			echo '<div class="widget-title" data-animate="fadeInUp" data-delay=".0">';
			echo '<a href="'.esc_url( $imageurl ).'"><img src="'. esc_url( $image ) .'" alt="'.bluishost_image_alt( $image ).'"></a>';
			echo '</div>';
		}
		
		echo '<div class="footer-about">';
			if( $textarea ){
				echo '<p>'.wp_kses_post( $textarea ).'</p>';
			}
		echo '</div>';
	?>

<?php
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'About', 'bluishost' );
}
//	image
if ( isset( $instance[ 'image' ] ) ) {
	$image = $instance[ 'image' ];
}else {
	$image = '';
}
//	image Url
if ( isset( $instance[ 'imageurl' ] ) ) {
	$imageurl = $instance[ 'imageurl' ];
}else {
	$imageurl = '';
}
//	Text Area
if ( isset( $instance[ 'textarea' ] ) ) {
	$textarea = $instance[ 'textarea' ];
}else {
	$textarea = '';
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image', 'bluishost' ); ?>:</label>
	<div class="bluishost-media-container">
		<div class="bluishost-media-inner">
			<?php $img_style = ( $image != '' ) ? '' : 'style="display:none;"'; ?>
			<img id="<?php echo $this->get_field_id( 'image' ); ?>-preview" src="<?php echo esc_attr( $image ); ?>" <?php echo $img_style; ?> />
			<?php $no_img_style = ( $image != '' ) ? 'style="display:none;"' : ''; ?>
			<span class="bluishost-no-image" id="<?php echo $this->get_field_id( 'image' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'No image selected', 'bluishost' ); ?></span>
		</div>
	
	<input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_attr( $image ); ?>" class="bluishost-media-url" />

	<input type="button" value="<?php echo _e( 'Remove', 'bluishost' ); ?>" class="button bluishost-media-remove" id="<?php echo $this->get_field_id( 'image' ); ?>-remove" <?php echo $img_style; ?> />

	<?php $button_text = ( $image != '' ) ? __( 'Change Image', 'bluishost' ) : __( 'Select Image', 'bluishost' ); ?>
	<input type="button" value="<?php echo $button_text; ?>" class="button bluishost-media-upload" id="<?php echo $this->get_field_id( 'image' ); ?>-button" />
	<br class="clear">
	</div>
</p>
<p>
<label for="<?php echo $this->get_field_id( 'imageurl' ); ?>"><?php _e( 'Image URL:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'imageurl' ); ?>" name="<?php echo $this->get_field_name( 'imageurl' ); ?>" type="text" value="<?php echo esc_attr( $imageurl ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'textarea' ); ?>"><?php _e( 'Text Area:' ,'bluishost'); ?></label> 
<textarea class="widefat" id="<?php echo $this->get_field_id( 'textarea' ); ?>" name="<?php echo $this->get_field_name( 'textarea' ); ?>"><?php echo esc_attr( $textarea ); ?></textarea>
</p>


<!-- Widgets - Media Upload Css -->
<style>
.bluishost-media-container {
	width: 98%;
}

.bluishost-media-inner {
	border: 1px solid #ddd;
	padding: 10px;
	text-align: center;
	border-radius: 2px;
	margin-bottom: 10px;
}

.widget-description img,
.bluishost-media-inner img {
	max-width: 100%;
	height: auto;
}

.bluishost-media-url {
	display: none;
}

.bluishost-media-remove {
	float: left;
	width: 48%;
}

.bluishost-media-upload {
	float: right;
	width: 48%;
}
</style>

<script>
jQuery(function($){
    'use strict';
	/**
	 *
	 * About Widget Logo upload
	 *
	 */
	$( function(){
	    // Upload / Change Image
    function wpshed_image_upload( button_class ) {
        
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        $( 'body' ).on( 'click', button_class, function(e) {

            var button_id           = '#' + $( this ).attr( 'id' ),
                self                = $( button_id),
                send_attachment_bkp = wp.media.editor.send.attachment,
                button              = $( button_id ),
                id                  = button.attr( 'id' ).replace( '-button', '' );

            _custom_media = true;

            wp.media.editor.send.attachment = function( props, attachment ){

                if ( _custom_media ) {

                    $( '#' + id + '-preview'  ).attr( 'src', attachment.url ).css( 'display', 'block' );
                    $( '#' + id + '-remove'  ).css( 'display', 'inline-block' );
                    $( '#' + id + '-noimg' ).css( 'display', 'none' );
                    $( '#' + id ).val( attachment.url ).trigger( 'change' );  

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );

                }
            }

            wp.media.editor.open( button );

            return false;
        });
    }
    wpshed_image_upload( '.bluishost-media-upload' );

    // Remove Image
    function wpshed_image_remove( button_class ) {

        $( 'body' ).on( 'click', button_class, function(e) {

            var button              = $( this ),
                id                  = button.attr( 'id' ).replace( '-remove', '' );

            $( '#' + id + '-preview' ).css( 'display', 'none' );
            $( '#' + id + '-noimg' ).css( 'display', 'block' );
            button.css( 'display', 'none' );
            $( '#' + id ).val( '' ).trigger( 'change' );

        });
    }
    wpshed_image_remove( '.bluishost-media-remove' );
	
	});
});
</script>
<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	
	$allowhtml = array(
		'span' 	 => array(),
		'class'  => array(),
		'strong' => array(),
		'i' => array(
			'class' => array()
		),
	);
	
$instance = array();
$instance['title'] 	  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['image']  	  = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
$instance['imageurl']  = ( ! empty( $new_instance['imageurl'] ) ) ? strip_tags( $new_instance['imageurl'] ) : '';
$instance['textarea'] = ( ! empty( $new_instance['textarea'] ) ) ? strip_tags( $new_instance['textarea'] ) : '';

return $instance;
}
} // Class Fotka_subscribe_widget ends here


// Register and load the widget
function bluishost_about_load_widget() {
	register_widget( 'bluishost_about_widget' );
}
add_action( 'widgets_init', 'bluishost_about_load_widget' );