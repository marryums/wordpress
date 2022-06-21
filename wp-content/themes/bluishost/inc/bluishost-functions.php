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

 // theme option callback
function bluishost_opt( $id = null, $url = null ){
    global $bluishost_opt;
    
    if( $id && $url ){
        
        if( isset( $bluishost_opt[$id][$url] ) && $bluishost_opt[$id][$url] ){
            return $bluishost_opt[$id][$url];
        }
        
    }else{
        
        if( isset( $bluishost_opt[$id] )  && $bluishost_opt[$id] ){
            return $bluishost_opt[$id];
        } 
    }
	
}

// custom meta id callback
function bluishost_meta( $id = '' ){
    
    $value = get_post_meta( get_the_ID(), '_bluishost_'.$id, true );
    
    return $value;
}

// Append custom css to redux framework
if (!function_exists('bluishost_redux_custom_css')):
    // This is your option name where all the Redux data is stored.
    $opt_name = 'bluishost_opt';
    function bluishost_redux_custom_css(){
        wp_register_style('bluishost-redux-custom',
            BLUISHOST_REDUX_DIR_PATH_INC . 'bluishost-redux-admin.css', array('redux-admin-css'),
            time(), 'all');
        wp_enqueue_style('bluishost-redux-custom');
    }
endif;
add_action('redux/page/' . $opt_name . '/enqueue', 'bluishost_redux_custom_css');

// Blog Date Permalink
function bluishost_blog_date_permalink(){
	
	$year  = get_the_time('Y'); 
    $month_link = get_the_time('m');
    $day   = get_the_time('d');

    $link = get_day_link( $year, $month_link, $day);
    
    return $link; 
}
// Blog Excerpt Length
if ( ! function_exists( 'bluishost_excerpt_length' ) ) {
	function bluishost_excerpt_length( $limit = 30 ) {

		$excerpt = explode( ' ', get_the_excerpt() );
		
		// $limit null check
		if( !null == $limit ){
			$limit = $limit;
		}else{
			$limit = 30;
		}
		
		
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice ).' ...';
		} else {
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice );
		}
		
		$excerpt = '<p>'.preg_replace('`\[[^\]]*\]`','',$excerpt).'</p>';
		return $excerpt;

	}
}
// Comment number and Link
if ( ! function_exists( 'bluishost_posted_comments' ) ) :
    function bluishost_posted_comments(){
        
        $comments_num = get_comments_number();
        if( comments_open() ){
            if( $comments_num == 0 ){
                $comments = esc_html__('No Comments','bluishost');
            } elseif ( $comments_num > 1 ){
                $comments= $comments_num . esc_html__(' Comments','bluishost');
            } else {
                $comments = esc_html__( '1 Comment','bluishost' );
            }
            $comments = '<a href="' . esc_url( get_comments_link() ) . '">'. $comments .'</a>';
        } else {
            $comments = esc_html__( 'Comments are closed', 'bluishost' );
        }
        
        return $comments;
    }
endif;
//audio format iframe match 
function bluishost_iframe_match(){   
    $audio_content = bluishost_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}

//Post embedded media
function bluishost_embedded_media( $type = array() ){
    
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );
        
    if( in_array( 'audio' , $type) ){
    
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }
        
    }else{
        
        if( count( $embed ) > 0 ){

            $output = $embed[0];
        }else{
           $output = ''; 
        }
        
    }
    
    return $output;
   
}
// WP post link pages
function bluishost_link_pages(){
    
    wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bluishost' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'bluishost' ) . ' </span>%',
    'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}

// theme logo
function bluishost_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array( 
            'href' => array()
        ),
        'span' => array(),
        'i'    => array( 
            'class' => array() 
        )
    );
    $siteUrl = home_url('/');
    // site logo
    if( !bluishost_opt('bluishost_site_title') && bluishost_opt('bluishost_site_logo', 'url' )  ){

        $stickyLogo = '';
        if( bluishost_opt( 'bluishost_sticky_site_logo', 'url' ) ){
           
        $siteLogo = '
        <img src="'.esc_url( bluishost_opt('bluishost_site_logo', 'url' ) ).'" class="non-sticky-logo" alt="'.esc_attr__( 'logo', 'bluishost' ).'" />
        <img src="'.esc_url( bluishost_opt('bluishost_sticky_site_logo', 'url' ) ).'" class="sticky-logo" alt="'.esc_attr__( 'logo', 'bluishost' ).'" />
        ';

        }else{
            $siteLogo = '<img src="'.esc_url( bluishost_opt('bluishost_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'bluishost' ).'" />';
        }


        return '<a href="'.esc_url( $siteUrl ).'">'.wp_kses_post( $siteLogo ).'</a>';
        
         
    }elseif( bluishost_opt('bluishost_site_title') ){
        return '<h2><a class="text-logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( bluishost_opt('bluishost_site_title'), $allowhtml ).'</a></h2>';   
    }else{
        return '<h2><a class="text-logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// Blog grid  callback
function bluishost_blog_grid( ){
    
    $grid = bluishost_opt( 'bluishost_blog_grid' );

    if( $grid ){
        return $grid;
    }else{
        return;
    }
    
}
// Blog pull right class callback
function bluishost_pull_right( $id = '', $condation = null ){
    
    if( $id == $condation ){
        return ' '.'order-last';
    }else{
        return;
    }
    
}
// wp kses allow html
function bluishost_wp_kses_allow( $data = '' ){
    
    $allow = array(
        'a' => array(
            'href' => array()
        ),
        'span' => array(),
        'br'   => array(),
        'strong'   => array(),
    
    
    );
    
    return wp_kses( $data, $allow );
    
}
// Data Background image attr
function bluishost_data_bg_attr( $imgUrl = '' ){
        
    return 'data-bg-img="'.esc_url( $imgUrl ).'"';
    
}
// image alt tag
function bluishost_image_alt( $url = '' ){

    if( $url != '' ){
        // attachment id by url 
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag 
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
    
            $alt = str_replace( '-', ' ', $filename['filename'] );
            
            return $alt;
        }
   
    }else{
       return; 
    }

}

// Change Default Categories Widget Counter Markup
function bluishost_add_span_cat_count($links) {
    $links = str_replace('</a> (', '<span>(', $links);
    $links = str_replace(')', ')</span></a>', $links);
    return wp_kses_post( $links );
}
add_filter('wp_list_categories', 'bluishost_add_span_cat_count');

// Change Default Archive Widget Counter & Year Markup
function bluishost_add_span_archive_count($links) {
    $links = str_replace( '(', '<span>(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('get_archives_link', 'bluishost_add_span_archive_count');


// Flat Content wysiwyg output with meta key and post id
function bluishost_get_textareahtml_output( $content ) {
    
	global $wp_embed;

	$content = $wp_embed->autoembed( $content );
	$content = $wp_embed->run_shortcode( $content );
	$content = wpautop( $content );
	$content = do_shortcode( $content );

	return $content;
}

// 
// Woocommerce Check
if ( ! function_exists( 'is_bluishost_woocommerce_activated' ) ) {
	function is_bluishost_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

// VC Animation 
if( class_exists( 'WPBakeryShortCode' ) ){
	class Clsvwpbshortcode extends WPBakeryShortCode{
		
		 function __construct() {}
		
	}

}
function bluishost_animation_class( $animation ){
	
	if( class_exists('Clsvwpbshortcode') ){
		$obj = new Clsvwpbshortcode();
		return $animation_classes = $obj->getCSSAnimation( $animation );
	}else{
		return;
	}
	

}

// Slider list ( Shortcode ) select Options
function bluishost_get_slider_shortcode_options( $field ) {
    $args = $field->args( 'get_post_type' );
	
	
    $args = is_array( $args ) ? $args : array();

    $args = wp_parse_args( $args, array( 'post_type' => 'post' ) );

    $postType = $args['post_type'];

	//

	$args = array(
		'post_type'        => $postType,
		'post_status'      => 'publish',
	);

	$posts_array = get_posts( $args );	

	// Initate an empty array
	$term_options = array();
		
		foreach( $posts_array as $post ){
			
			$term_options[ $post->post_name ] = $post->post_title;
			
		}
	
    return $term_options;

}

//
function bluishost_blog_social_class( $class ){
	
	$tags = bluishost_post_tags();
	
	if( !$tags ){
		$setNewClass = 'bluishost--center text-center';
	}else{
		$setNewClass = $class;
	}
	  
	return $setNewClass;
}
add_filter( 'blog_social_class', 'bluishost_blog_social_class', 10, 1 );

/**
 * Admin Custom Login Logo
 */
function bluishost_custom_login_logo() {
    $logo = ! empty(bluishost_opt( 'bluishost_admin_login_logo', 'url' ) ) ? bluishost_opt( 'bluishost_admin_login_logo', 'url' ) : '' ;
    if(isset($logo) && !empty($logo))
        echo '<style type="text/css">body.login div#login h1 a { background-image:url('.esc_url( $logo ).'); }</style>';
}
add_action( 'login_enqueue_scripts', 'bluishost_custom_login_logo' );

/**
 * Admin Custom css
 */
add_action( 'admin_enqueue_scripts', 'bluishost_admin_styles' );
function bluishost_admin_styles() {

    $bluishost_admin_custom_css = ! empty( bluishost_opt( 'bluishost_theme_admin_custom_css' ) ) ? cloudvpnet_opt( 'bluishost_theme_admin_custom_css' ) : '';
    
    if ( ! empty( $cloudvpnet_admin_custom_css ) ) {
        $bluishost_admin_custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $bluishost_admin_custom_css);
        echo '<style rel="stylesheet" id="bluishost-admin-custom-css" >';
                echo esc_html( $bluishost_admin_custom_css );
        echo '</style>';

    }
}


function bluishost_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'bluishost-block-editor-style', get_theme_file_uri( '/assets/css/editor-style.css' ), array(), '20190328' );
	// Add custom fonts.
	wp_enqueue_style( 'bluishost-fonts', bluishost_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'bluishost_block_editor_styles' );

function bluishost_fonts_url(){

    $font_families = array(
        'Poppins:400,400i,500,700',
        'Karla:400'
    );

    $familyArgs = array(
        'family' => urlencode( implode( '|', $font_families ) )
    );

    $fontUrl = add_query_arg( $familyArgs, '//fonts.googleapis.com/css' );

    return esc_url_raw( $fontUrl );

} //End google_font method