<?php 
/**
 * @Packge     : Bluishost
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( 'Direct script access denied.' );
    }

// Post Category
function bluishost_post_cats(){
	
	$cats = get_the_category();
	$categories = '';
    if( $cats ){

    	$categories .= '<li>';
        $categories .= '<i class="fas fa-folder-open"></i>';
        
        foreach( $cats as $cat ){
           $categories .= '<a href="'.esc_url( get_category_link( $cat->term_id ) ).'">'.esc_html( $cat->name ).'</a>';
        }

        $categories .= '</li>';
    }
	
	return $categories;
	
}

// Post Tags
function bluishost_post_tags(){
	
	$tags = get_the_tags();
	
	$getTags = '';
	
	if( $tags ){

		$getTags .= '<li>';
		$getTags .= '<i class="fas fa-tags"></i>';

		foreach( $tags as $tag ){
			$getTags .= '<a href="'.esc_url( get_tag_link( $tag->term_id ) ).'">'.esc_html( $tag->name ).'</a>';
		}

		$getTags .= '</li>';
	}
	
	return $getTags;
	
	
}

// Bluishost comment template callback
function bluishost_comment_callback( $comment, $args, $depth ) {
    
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>

    <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? 'main-comment single-comment clearfix' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment--item">
    <?php endif; ?>
	
		<div class="single-comment clearfix" data-animate="fadeInUp" data-delay=".2">
			<div class="comment-author float-left">
				<?php
					if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 60 ); 
				?>
			</div>
			<div class="comment-content">

				<h4><?php comment_author_link(); ?><span> <?php printf( __('(%1$s)', 'bluishost'), get_comment_date(),  get_comment_time() ); ?></span></h4>

				<?php comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 1, 'max_depth' => 5, 'reply_text' => '<i class="fas fa-reply"></i>Reply' ) ) ); ?>

				<?php comment_text(); ?>

				<span><?php edit_comment_link( esc_html__( '(Edit)', 'bluishost' ), '  ', '' ); ?></span>

	            <?php if ( $comment->comment_approved == '0' ) : ?>
	             <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'bluishost' ); ?></em>
	              <br />
	            <?php endif; ?>
			</div>
		</div>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php  
}

// Section Title
function bluishost_section_title( $args = array() ){
	
	$default = array(
		'wrapper_class' => '',
		'title' 		=> '',
		'sub_title'		=> ''
	);
	
	
	$args = wp_parse_args( $args , $default );
	
	if( $args['title'] || $args['sub_title']  ){
		echo '<div class="section--title mb--80 '.esc_attr( $args['wrapper_class'] ).'">';
			if( $args['title'] ){
				echo '<h2 class="h2">'.esc_html( $args['title'] ).'</h2>';
			}
			//
			if( $args['sub_title'] ){
				echo '<p>'.esc_html( $args['sub_title'] ).'</p>';
			}
		echo '</div>';
	}
}

// social media
if ( ! function_exists( 'bluishost_social' ) ) {
	function bluishost_social( $args = array() ){

		$default = array(
			'wrapper_before' 	=> '',
			'wrapper_after' 	=> '',
			'after_ul_start' 	=> '',
			'ul_class'  		=> '',
			'li_class'  		=> '',
			'a_class'     		=> ''
		);

		$class = wp_parse_args( $args, $default );

		$liststart = '<li data-animate="fadeInUp" data-delay=".35">';
		$listend   = '</li>';

		if( $class['ul_class'] ){
		   $ul_class = 'class="'.esc_attr( $class['ul_class'] ).'"';
		}else{
		   $ul_class = ''; 
		}

		if( $class['li_class'] ){
			$li_class = 'class="'.esc_attr( $class['li_class'] ).'"';
		}else{
		   $li_class = ''; 
		}
		// 
		if( $class['a_class'] ){
		  $aclass = 'class="'.esc_attr( $class['a_class'] ).'"';
		}else{
		   $aclass = ''; 
		}
		// After ul start
		if( $class['after_ul_start'] ){
		  $after_ul_start = $class['after_ul_start'];
		}else{
		   $after_ul_start = ''; 
		}

		// Social Media Icon

		$icons = array(
			
			array(
				'url'  => bluishost_opt('bluishost_facebook_link'),
				'icon' => 'fab fa-facebook-f',
			),
			array(
				'url'  => bluishost_opt('bluishost_twitter_link'),
				'icon' => 'fab fa-twitter',
			),
			array(
				'url'  => bluishost_opt('bluishost_google_link'),
				'icon' => 'fab fa-google-plus-g',
			),
			array(
				'url'  => bluishost_opt('bluishost_youtube_link'),
				'icon' => 'fab fa-youtube',
			),
			array(
				'url'  => bluishost_opt('bluishost_instagram_link'),
				'icon' => 'fab fa-instagram',
			),
			array(
				'url'  => bluishost_opt('bluishost_vimeo_link'),
				'icon' => 'fab fa-vimeo-v',
			),
			array(
				'url'  => bluishost_opt('bluishost_linkedin_link'),
				'icon' => 'fab fa-linkedin-in',
			),
			array(
				'url'  => bluishost_opt('bluishost_linkedin_link'),
				'icon' => 'fas fa-rss',
			),
			array(
				'url'  => bluishost_opt('bluishost_behance_link'),
				'icon' => 'fab fa-behance',
			),
			array(
				'url'  => bluishost_opt('bluishost_pinterest_link'),
				'icon' => 'fab fa-pinterest-p',
			),
			array(
				'url'  => bluishost_opt('bluishost_dribbble_link'),
				'icon' => 'fab fa-dribbble',
			),
			array(
				'url'  => bluishost_opt('bluishost_github_link'),
				'icon' => 'fab fa-github',
			)

		);

		// Array Filtering 
		$findUrlKey = array_column( $icons, 'url' );
		$filterEmpty = array_filter( $findUrlKey );
		//
		$html  = '';
		
		if( count( $filterEmpty ) > 0 ){
			
			$html  .= $liststart;
			// Wrapper Before Block
			if( $class['wrapper_before'] && $class['wrapper_after'] ){
				$html .= wp_kses_post( $class['wrapper_before'] );
			}
			
				$html .= '<span>'.esc_html__( 'Follow Us', 'bluishost' ).'<i>'.esc_html__( ':', 'bluishost' ).'</i></span>';

				foreach( $icons as $icon ){

				
					if( !empty( $icon['url'] ) && !empty( $icon['icon'] ) ){

						$html .= '<a href="'.esc_url( $icon['url'] ).'" '.wp_kses_post( $aclass ).' target="_blank"><i class="'.esc_attr( $icon['icon'] ).'"></i></a>';

					}
					
				}
					
			// Wrapper After Block
			if( $class['wrapper_before'] && $class['wrapper_after'] ){
				$html .= wp_kses_post( $class['wrapper_after'] );
			}

			$html  .= $listend;
		
		}
		
		return $html;

	}
}

// social media
if ( ! function_exists( 'bluishost_footer_social' ) ) {
	function bluishost_footer_social( $args = array() ){

		$default = array(
			'wrapper_before' 	=> '',
			'wrapper_after' 	=> '',
			'after_ul_start' 	=> '',
			'ul_class'  		=> '',
			'li_class'  		=> '',
			'a_class'     		=> ''
		);

		$class = wp_parse_args( $args, $default );

		$liststart = '<li data-animate="fadeInUp" data-delay=".35">';
		$listend   = '</li>';

		if( $class['ul_class'] ){
		   $ul_class = 'class="'.esc_attr( $class['ul_class'] ).'"';
		}else{
		   $ul_class = ''; 
		}

		if( $class['li_class'] ){
			$li_class = 'class="'.esc_attr( $class['li_class'] ).'"';
		}else{
		   $li_class = ''; 
		}
		// 
		if( $class['a_class'] ){
		  $aclass = 'class="'.esc_attr( $class['a_class'] ).'"';
		}else{
		   $aclass = ''; 
		}
		// After ul start
		if( $class['after_ul_start'] ){
		  $after_ul_start = $class['after_ul_start'];
		}else{
		   $after_ul_start = ''; 
		}

		// Social Media Icon

		$icons = array(
			
			array(
				'url'  => bluishost_opt('bluishost_facebook_link'),
				'icon' => 'fab fa-facebook-f',
			),
			array(
				'url'  => bluishost_opt('bluishost_twitter_link'),
				'icon' => 'fab fa-twitter',
			),
			array(
				'url'  => bluishost_opt('bluishost_google_link'),
				'icon' => 'fab fa-google-plus-g',
			),
			array(
				'url'  => bluishost_opt('bluishost_youtube_link'),
				'icon' => 'fab fa-youtube',
			),
			array(
				'url'  => bluishost_opt('bluishost_instagram_link'),
				'icon' => 'fab fa-instagram',
			),
			array(
				'url'  => bluishost_opt('bluishost_vimeo_link'),
				'icon' => 'fab fa-vimeo-v',
			),
			array(
				'url'  => bluishost_opt('bluishost_linkedin_link'),
				'icon' => 'fab fa-linkedin-in',
			),
			array(
				'url'  => bluishost_opt('bluishost_linkedin_link'),
				'icon' => 'fas fa-rss',
			),
			array(
				'url'  => bluishost_opt('bluishost_behance_link'),
				'icon' => 'fab fa-behance',
			),
			array(
				'url'  => bluishost_opt('bluishost_pinterest_link'),
				'icon' => 'fab fa-pinterest-p',
			),
			array(
				'url'  => bluishost_opt('bluishost_dribbble_link'),
				'icon' => 'fab fa-dribbble',
			),
			array(
				'url'  => bluishost_opt('bluishost_github_link'),
				'icon' => 'fab fa-github',
			)

		);

		// Array Filtering 
		$findUrlKey = array_column( $icons, 'url' );
		$filterEmpty = array_filter( $findUrlKey );
		//
		$html  = '';
		
		if( count( $filterEmpty ) > 0 ){
			
			
			// Wrapper Before Block
			if( $class['wrapper_before'] && $class['wrapper_after'] ){
				$html .= wp_kses_post( $class['wrapper_before'] );
			}
			
				$html .= '<span>'.esc_html__( 'Follow Us', 'bluishost' ).'<i>'.esc_html__( ':', 'bluishost' ).'</i></span>';

				foreach( $icons as $icon ){

				
					if( !empty( $icon['url'] ) && !empty( $icon['icon'] ) ){
						$html  .= $liststart;
						$html .= '<a href="'.esc_url( $icon['url'] ).'" '.wp_kses_post( $aclass ).' target="_blank"><i class="'.esc_attr( $icon['icon'] ).'"></i></a>';
						$html  .= $listend;
					}
					
				}
					
			// Wrapper After Block
			if( $class['wrapper_before'] && $class['wrapper_after'] ){
				$html .= wp_kses_post( $class['wrapper_after'] );
			}
		
		}
		
		return $html;

	}
}

// Header Social Media
if ( ! function_exists( 'bluishost_header_social' ) ) {
	function bluishost_header_social( $args = array() ){

		$default = array(
			'wrapper_before' 	=> '',
			'wrapper_after' 	=> '',
			'after_ul_start' 	=> '',
			'ul_class'  		=> '',
			'li_class'  		=> '',
			'a_class'     		=> ''
		);

		$class = wp_parse_args( $args, $default );

		if( $class['ul_class'] ){
		   $ul_class = 'class="'.esc_attr( $class['ul_class'] ).'"';
		}else{
		   $ul_class = ''; 
		}

		if( $class['li_class'] ){
			$li_class = 'class="'.esc_attr( $class['li_class'] ).'"';
		}else{
		   $li_class = ''; 
		}
		// 
		if( $class['a_class'] ){
		  $aclass = 'class="'.esc_attr( $class['a_class'] ).'"';
		}else{
		   $aclass = ''; 
		}
		// After ul start
		if( $class['after_ul_start'] ){
		  $after_ul_start = $class['after_ul_start'];
		}else{
		   $after_ul_start = ''; 
		}

		// Social Media Icon

		$icons = array(
			
			array(
				'url'  => bluishost_opt('bluishost_facebook_link'),
				'icon' => 'fa fa-facebook-f',
			),
			array(
				'url'  => bluishost_opt('bluishost_twitter_link'),
				'icon' => 'fab fa-twitter',
			),
			array(
				'url'  => bluishost_opt('bluishost_google_link'),
				'icon' => 'fab fa-google-plus-g',
			),
			array(
				'url'  => bluishost_opt('bluishost_youtube_link'),
				'icon' => 'fab fa-youtube',
			),
			array(
				'url'  => bluishost_opt('bluishost_instagram_link'),
				'icon' => 'fab fa-instagram',
			),
			array(
				'url'  => bluishost_opt('bluishost_vimeo_link'),
				'icon' => 'fab fa-vimeo-v',
			),
			array(
				'url'  => bluishost_opt('bluishost_linkedin_link'),
				'icon' => 'fab fa-linkedin-in',
			),
			array(
				'url'  => bluishost_opt('bluishost_linkedin_link'),
				'icon' => 'fas fa-rss',
			),
			array(
				'url'  => bluishost_opt('bluishost_behance_link'),
				'icon' => 'fab fa-behance',
			),
			array(
				'url'  => bluishost_opt('bluishost_pinterest_link'),
				'icon' => 'fab fa-pinterest-p',
			),
			array(
				'url'  => bluishost_opt('bluishost_dribbble_link'),
				'icon' => 'fab fa-dribbble',
			),
			array(
				'url'  => bluishost_opt('bluishost_github_link'),
				'icon' => 'fab fa-github',
			)

		);

		// Array Filtering 
		$findUrlKey = array_column( $icons, 'url' );
		$filterEmpty = array_filter( $findUrlKey );
		//
		$html  = '';
		
		if( count( $filterEmpty ) > 0 ){
			
			// Wrapper Before Block
			if( $class['wrapper_before'] && $class['wrapper_after'] ){
				$html .= wp_kses_post( $class['wrapper_before'] );
			}
			$html .= '<ul '.$ul_class.'>';
				foreach( $icons as $icon ){

					if( !empty( $icon['url'] ) && !empty( $icon['icon'] ) ){

						$html .= '<li><a href="'.esc_url( $icon['url'] ).'" '.wp_kses_post( $aclass ).' target="_blank"><i class="'.esc_attr( $icon['icon'] ).'"></i></a></li>';

					}
					
				}
			$html .= '</ul>';
					
			// Wrapper After Block
			if( $class['wrapper_before'] && $class['wrapper_after'] ){
				$html .= wp_kses_post( $class['wrapper_after'] );
			}
		
		}
		
		return $html;

	}
}

?>