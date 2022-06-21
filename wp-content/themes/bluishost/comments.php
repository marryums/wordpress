<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}
/**
 * @Packge     : Bluishost
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
if ( post_password_required() ) 
{
    return;
}

if ( have_comments() ) : ?>
	<div class="post-comments">
        <h3 class="widget-title" data-animate="fadeInUp" data-delay=".1"><?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'bluishost' ), number_format_i18n( get_comments_number() ) ); ?></h3>
		
        <?php the_comments_navigation(); ?>
            <div class="main-comment-form">
                <?php
                    wp_list_comments( array(
                        'style'       => 'div',
                        'short_ping'  => true,
                        'avatar_size' => 30,
                        'callback'    => 'bluishost_comment_callback'
                    ) );
                ?>
            </div><!-- .comment-list -->
        <?php the_comments_navigation(); ?>
	</div>
    <?php endif; // Check for have_comments()

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bluishost' ); ?></p>
    <?php endif; 

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? "required='required'" : '' );
	$fields =  array(
	  'author' =>'<div class="row half-gutters mb-0"><div class="col-md-4"><input class="form-control" type="text" name="author" placeholder="'. esc_html__( 'Name', 'bluishost' ) .'" value="'. esc_attr( $commenter['comment_author'] ).'" data-animate="fadeInUp" data-delay=".3" '.$aria_req.'></div>',
	  'email' =>'<div class="col-md-4"><input class="form-control" type="email" name="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) .'" placeholder="'. esc_html__( 'E-mail', 'bluishost' ) .'" data-animate="fadeInUp" data-delay=".4" '.$aria_req.'></div>',
	  'url' =>'<div class="col-md-4"><input class="form-control" type="url" name="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'. esc_html__( 'Website', 'bluishost' ) .'" data-animate="fadeInUp" data-delay=".5"></div></div>' );
	
    $subTitle = '<p>'.wp_kses_post( __( 'What&rsquo;s happening in your mind about this post !', 'bluishost' ) ).'</p>';

	$args=array(
    	'comment_field'         =>'<div class="position-relative"><textarea class="form-control" name="comment" placeholder="'. esc_html__( 'Write your text', 'bluishost' ) .'" required data-animate="fadeInUp" data-delay=".2"></textarea></div>',
        'class_form'            =>'karla',
    	'title_reply'           => esc_html__( 'Leave A Comment', 'bluishost' ),
    	'title_reply_before'    =>'<h3 class="widget-title" data-animate="fadeInUp" data-delay=".1">',
    	'title_reply_after'     =>'</h3>'.$subTitle,
        'label_submit'          => esc_html__( 'Post Comment', 'bluishost' ),
        'class_submit'          => 'btn btn-default',
    	'submit_button'         => '<button type="submit" name="%1$s" id="%2$s" class="%3$s btn btn-primary" data-animate="fadeInUp" data-delay=".6">%4$s</button>',
    	'fields'                =>$fields,
	
	);
	
    comment_form( $args );
    // .comments-area
?>