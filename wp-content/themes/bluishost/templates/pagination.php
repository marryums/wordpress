<?php 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
    //Pagination
	if( get_next_posts_link() || get_previous_posts_link() ){

		echo '<div class="posts--pager" data-animate="fadeInUp" data-delay=".1">';
		
			if( bluishost_opt( 'bluishost_blog_pagination' ) == 1 ){
				if ( function_exists('bluishost_pagination') ){
					echo '<nav class="blog-page--pagination">';
						bluishost_pagination();
					echo '</nav>';
				}

			}else{
					$older 	= esc_html__( 'Older Post', 'bluishost' ).' <i class="fas fa-arrow-right"></i>';
					$newer 	= '<i class="fas fa-arrow-left"></i> '.esc_html__( 'Newer Post', 'bluishost' );

                    echo '<ul class="more-post list-unstyled clearfix" data-animate="fadeInUp" data-delay=".1">';
						// Previous
						echo '<li>';
						if( get_previous_posts_link() ){
							previous_posts_link( $newer );
						}else{
							echo wp_kses_post( '<a>'.$newer.'</a>' );
						}
						echo '</li>';

						// next
						echo '<li>';
						if( get_next_posts_link() ){
							next_posts_link( $older );
						}else{
							echo wp_kses_post( '<a>'.$older.'</a>' );
						}
						echo '</li>';
					echo '</ul>';
			}
		echo '</div>';
	}    
?>