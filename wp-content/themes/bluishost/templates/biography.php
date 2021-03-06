<?php 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
/**
 *
 * @Packge      Bluishost
 * @Author      ThemeLooks
 * @Author URL  https//www.themelooks.com
 * @version     1.0
 *
 */
?>
<div class="post-author" data-animate="fadeInUp" data-delay=".3">
	<?php 
	// show avatar
	$avatar = get_avatar( get_the_author_meta( 'ID' ),100 );
	if( $avatar  ){
		echo wp_kses_post( $avatar );
	}
	?>
	<div class="post-author-info">
		<h4><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></h4>
		<p><?php esc_html( the_author_meta('description') ); ?></p>
		<?php  
			if( function_exists('bluishost_biography_social_link') ){

				bluishost_biography_social_link();

			}
		?>
	</div>
</div>