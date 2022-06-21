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
*Creating Latest News Widget
***************************************/
 
class bluishost_latest_news_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'bluishost_latest_news_widget', 


// Widget name will appear in UI
esc_html__( 'Bluishost :: Latest News / Recent News', 'bluishost' ), 

// Widget description
array( 'description' => esc_html__( 'Add Latest News/Recent News/Latest Blog Content', 'bluishost' ), ) 
);

}


// This is where the action happens
public function widget( $args, $instance ) {
$title 		= apply_filters( 'widget_title', $instance['title'] );
$post_number= apply_filters( 'widget_post_number', $instance['post_number'] );
$show_date 	= apply_filters( 'widget_show_date', $instance['show_date'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];  

?>
<div class="footer-posts">
	<div class="footer-posts">
	    <ul class="sidebar-list list-unstyled">
			<?php

				$argss = array(
					'post_type'		=> 'post',
					'posts_per_page'=> $post_number,
				);

				$loop = new WP_Query( $argss );
				
				$i = '3';
				if( $loop->have_posts() ){

					while( $loop->have_posts() ) : $loop->the_post(); ?>
								
						<li data-animate="fadeInUp" data-delay=".<?php echo esc_attr( $i ) ?>">
							
							<?php if( $show_date ){ ?>
							<p><?php esc_html_e( 'Posted on', 'bluishost' ) ?> <a href="<?php echo esc_url( bluishost_blog_date_permalink() ); ?>"><?php echo get_the_date( 'F m, Y' ); ?></a></p>
							<?php } ?>
							<h4>
							<a href="<?php echo esc_url(the_permalink()) ?>"><?php esc_html( the_title() ) ?></a>
							</h4>
						</li>

					<?php
					$i++;
					endwhile;
					wp_reset_postdata();
							
				}
			?>
		</ul>
	</div>
</div>
<?php

echo $args['after_widget'];
}
		
//Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Recent News', 'bluishost' );
}
//Post Limit
if ( isset( $instance[ 'post_number' ] ) ) {
	$post_number = $instance[ 'post_number' ];
}else {
	$post_number = esc_html__( 2 );
}


//	Show Date
if ( isset( $instance[ 'show_date' ] ) ) {
	$show_date = $instance[ 'show_date' ];
}else {
	$show_date = '';
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'bluishost'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Number of posts to show: ' ,'bluishost'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo esc_attr( $post_number ); ?>" />
</p>

<p>
<input class="widefat" id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" type="checkbox" <?php checked( $show_date, 'on' );  ?> />
<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ,'bluishost'); ?></label> 
</p>

<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {	
$instance = array();
$instance['title'] 	  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['post_number'] = ( ! empty( $new_instance['post_number'] ) ) ? strip_tags( $new_instance['post_number'] ) : '';
$instance['show_date'] = ( ! empty( $new_instance['show_date'] ) ) ?  $new_instance['show_date']  : '';

return $instance;
}
} // Class bluishost_subscribe_widget ends here


// Register and load the widget
function bluishost_latest_news_load_widget() {
	register_widget( 'bluishost_latest_news_widget' );
}
add_action( 'widgets_init', 'bluishost_latest_news_load_widget' );