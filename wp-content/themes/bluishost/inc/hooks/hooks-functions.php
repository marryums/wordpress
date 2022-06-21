<?php 
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	// Before wrapper Preloader
	if( !function_exists('bluishost_site_preloader') ){
		function bluishost_site_preloader(){
			if( bluishost_opt('bluishost_display_preloader') ):
			?>
			 <div class="preLoader">
		        <span class="spin"></span>
		    </div>
			<?php
			endif;
		}
	}

	// Header menu hook function
	if( !function_exists( 'bluishost_header_cb' ) ){
		function bluishost_header_cb(){
			$header_layout = get_post_meta( get_the_ID(), '_bluishost_header_layout_switcher', true );
			
			if( $header_layout ) {
				$header_versions = get_post_meta( get_the_ID(), '_bluishost_header_custom_layout', true );
			}else{
				$header_versions = bluishost_opt( 'bluishost_header_version' );
			}
			
			if( $header_versions == '1' ) {
			    get_template_part( 'templates/headers/header', 'v1' );
			}elseif( $header_versions == '2' ){
			    get_template_part( 'templates/headers/header', 'v2' );
			}elseif( $header_versions == '3' ){
			    get_template_part( 'templates/headers/header', 'v3' );
			}elseif( $header_versions == '4' ){
				get_template_part( 'templates/headers/header', 'v4' );
			}elseif( $header_versions == '5' ){
				get_template_part( 'templates/headers/header', 'v5' );
			}elseif( $header_versions == '6' ){
				get_template_part( 'templates/headers/header', 'v6' );
			}elseif( $header_versions == '7' ){
				get_template_part( 'templates/headers/header', 'v7' );
			}elseif( $header_versions == '8' ){
				get_template_part( 'templates/headers/header', 'v8' );
			}else{
				get_template_part( 'templates/headers/header', 'v1' );
			}
			get_template_part( 'templates/header-menu', 'bottom' );
		}
	}

	// Footer area hook function
	if( !function_exists( 'bluishost_footer_area' ) ){
		function bluishost_footer_area(){
			get_template_part( 'templates/footer' );
		}
	}

	// Footer back to top hook function
	if( !function_exists( 'bluishost_back_to_top' ) ){
		function bluishost_back_to_top(){

			$footer_layout = get_post_meta( get_the_ID(), '_bluishost_footer_back_to_top_button_switcher', true );
			if( $footer_layout == '1' ) {
				if( bluishost_meta( 'back_to_top' ) == '1' ) {
					echo bluishost_anchor_tag(
						array(
							'url'			=> '#',
							'class'			=> 'back-to-top',
							'data-animate'	=> 'fadeInDown',
							'data-delay'	=> '.95',
							'text'			=> '<i class="fas fa-arrow-up"></i>'
						)
					);
				}elseif( bluishost_meta( 'back_to_top' ) == '2' ){
					echo bluishost_anchor_tag( 
						array(
							'url'			=> '#',
							'class'			=> 'back-to-top back-top--3',
							'text'			=> bluishost_img_tag(
								array(
									'url'		=> esc_url( BLUISHOST_DIR_IMG_URI.'back_top.svg' ),
									'alt'		=> esc_attr( bluishost_image_alt() )
								)
							)
						)
					);
				}elseif( bluishost_meta( 'back_to_top' ) == '3' ){
					echo bluishost_anchor_tag( 
						array(
							'url'			=> '#',
							'class'			=> 'back-to-top back-top--2 light',
							'text'			=> '<i class="fas fa-arrow-up"></i>',
							'data-animate'	=> 'fadeInDown',
							'data-delay'	=> '.95'
						) 
					);
				}else{
					echo bluishost_anchor_tag(
						array(
							'url'			=> '#',
							'class'			=> 'back-to-top',
							'data-animate'	=> 'fadeInDown',
							'data-delay'	=> '.95',
							'text'			=> '<i class="fas fa-arrow-up"></i>'
						)
					);
				}

			}
		}
	}

	// Blog, single, page, search, archive pages wrapper start hook function.
	if( !function_exists('bluishost_wrp_start_cb') ){
		function bluishost_wrp_start_cb(){
			echo '<section class="pt-120"><div class="container"><div class="row">';
		}
	}
	// Blog, single, page, search, archive pages wrapper end hook function.
	if( !function_exists('bluishost_wrp_end_cb') ){
		function bluishost_wrp_end_cb(){
			echo '</div></div></section>';
		}
	}

	// Blog, single, search, archive pages column start hook function.
	if( !function_exists('bluishost_blog_col_start_cb') ){
		function bluishost_blog_col_start_cb(){

			$sidebarOpt = bluishost_opt( 'bluishost_blog_sidebar' );
			$pageSidbar  = bluishost_opt( 'bluishost_page_layoutopt' );
			$pageSidbarPos  = bluishost_opt( 'bluishost_page_sidebar' );
			$gridOpt	 = bluishost_blog_grid();
			
			if( !is_page() ){
				$pullRight  = bluishost_pull_right( $sidebarOpt , '2' );

				if( $sidebarOpt != '1' ){
					$col = '8'.$pullRight;
				}else{

					if( !is_single() && $gridOpt != '1' ){
						$col = '12';
					}else{
						$col = '12';
					}

				}
			}else{

				$pullRight  = bluishost_pull_right( $pageSidbarPos , '2' );

				$defaultcol = '12';

				if( !bluishost_is_ccap() ) {

					if( $pageSidbar != '1' && $pageSidbarPos != '1' ){
						$col = '8'.$pullRight;
					}else{

						$col = $defaultcol;
					}

				}else{
					$col = $defaultcol;
				}
				
			}


			echo '<div class="col-lg-'.esc_attr( $col ).'">';
		}
	}
	// Blog, single, search, archive pages column end hook function.
	if( !function_exists('bluishost_blog_col_end_cb') ){
		function bluishost_blog_col_end_cb(){
			echo '</div>';
		}
	}

	// post or page items wrapper hook function.
	if( !function_exists('bluishost_post_items_wrp_start_cb') ){
		function bluishost_post_items_wrp_start_cb(){
			$gridOpt = bluishost_blog_grid();

			$postwrap   = '';
			$postinner  = '';
			if( !is_single() && $gridOpt != '1' ){
				$postwrap   = 'blog';
				$postinner  = '<div class="row isotope">';
			}elseif( is_single() ){
				$postwrap   = 'single-post-page';
			} else {
				$postwrap   = 'row isotope';
			}
			echo '<div class="'.esc_attr( $postwrap ).'">'.$postinner;
		}
	}


	// post or page items wrapper hook function.
	if( !function_exists('bluishost_post_items_wrp_end_cb') ){
		function bluishost_post_items_wrp_end_cb(){
			$gridOpt = bluishost_blog_grid();

			if( !is_single() && $gridOpt != '1' ){
				echo '</div>';
				// Pagination
				get_template_part( 'templates/pagination' );
				echo '</div>';
			}else{
				echo '</div>';
			}
		}
	}


	// Blog post thumbnail hook function.
	if( !function_exists('bluishost_blog_posts_thumb_cb') ){
		function bluishost_blog_posts_thumb_cb(){

			// Thumbnail Show
			if( has_post_thumbnail() ){

				if( !is_single() ){
					$wraperStart = '<a href="'.esc_url( get_the_permalink() ).'">';
				}else{
					$wraperStart = '<div class="post-image">';
				}
				
				if( !is_single() ){
					$wraperEnd = '</a>';
				}else{
					$wraperEnd = '</div>';
				}
				
				$html = '';
				$html .= $wraperStart;
				$html .= bluishost_img_tag(
					array(
						'url' => esc_url( get_the_post_thumbnail_url() ),
					)
				);
				$html .= $wraperEnd;

				echo wp_kses_post( $html );

			}

			// Thumbnail check and video and audio thumb show
			if( !is_single() && !has_post_thumbnail() ){
				$html = '';
				if( has_post_format( array( 'video' ) ) ){
					
					$html .= '<div class="blog-post-video">';
					$html .= bluishost_embedded_media( array( 'video', 'iframe' ) );
					$html .= '</div>';

				}else{

					if( has_post_format( array( 'audio' ) ) ){
						
						$html .= '<div class="blog-post-audio">';
						$html .= bluishost_embedded_media( array( 'audio', 'iframe' ) );
						$html .= '</div>';
					}
				}
				
				echo apply_filters( 'bluishost_post_embedded_media' ,$html );

			}
		}
	}

	// Blog post title hook function.
	if( !function_exists('bluishost_blog_posts_title_cb') ){
		function bluishost_blog_posts_title_cb(){
			if( get_the_title() ){

				$html = '';
				$html .= '<h3><a href="'.esc_url( get_the_permalink() ).'">'.esc_html( get_the_title() ).'</a></h3>';
				echo wp_kses_post( $html );

			}
		}
	}

	// Blog posts meta hook function.
	if( !function_exists('bluishost_blog_posts_meta_cb') ){
		function bluishost_blog_posts_meta_cb(){
			$postmeta = 'post-content';
			if( is_single() ){
				$postmeta = 'post-detail-content';
			}
		?>

			<div class="<?php echo esc_attr( $postmeta ) ?>">
				<p class="post-info">
					<?php 
					if( get_the_date() ):
					esc_html_e( 'Posted on', 'bluishost' ) ?> <a href="<?php echo esc_url( bluishost_blog_date_permalink() ); ?>"><?php echo esc_html( get_the_date() ); ?></a>
					<?php 
					endif;

					if( get_the_author() ):
					esc_html_e( 'by', 'bluishost' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php the_author(); ?></a>
					<?php endif; ?>
				</p>
			<?php 	

		}
	}

	// Blog posts excerpt hook function.
	if( !function_exists('bluishost_blog_posts_excerpt_cb') ){
		function bluishost_blog_posts_excerpt_cb(){

			// Post excerpt
			echo bluishost_excerpt_length( bluishost_opt('bluishost_blog_postExcerpt') );

			// Link Pages
			bluishost_link_pages();
			?>
			
			<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Reading Continue', 'bluishost' ); ?><i class="fas fa-caret-right"></i></a>

			</div>
			<?php
		}
	}

	// Blog posts content hook function.
	if( !function_exists('bluishost_blog_posts_content_cb') ){
		function bluishost_blog_posts_content_cb(){

			if( bluishost_opt('bluishost_blog_posttitle_position') == '2' && get_the_title() ){
				echo bluishost_heading_tag( array(
					"data-animate"	=> "fadeInUp",
					"data-delay"	=> ".15",
					"text"			=> esc_html( get_the_title() ),
					"tag"			=> bluishost_opt("bluishost_blog_posttitle_tag"),
					"class"			=> "single-blog-post-title"	
				) );
			}
			the_content();
			
			// Link Pages
			bluishost_link_pages();
			?>
			</div>
			<?php
		}
	}

	// Page content hook function.
	if( !function_exists('bluishost_page_content_cb') ){
		function bluishost_page_content_cb(){
			?>
			<div class="post--content clearfix">
				<?php 
				the_content();

				// Link Pages
				bluishost_link_pages();
				?>
			</div>
			<?php
			// comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
	}

	// Blog page sidebar hook function.
	if( !function_exists('bluishost_blog_sidebar_cb') ){
		function bluishost_blog_sidebar_cb(){

			$sidebar = bluishost_opt( 'bluishost_blog_sidebar' );

			if( $sidebar != '1' ){
				get_sidebar();
			}			
		}
	}


	// Page sidebar hook function.
	if( !function_exists('bluishost_page_sidebar_cb') ){
		function bluishost_page_sidebar_cb(){

			if( ! bluishost_is_ccap() ) {
				$sidebar = bluishost_opt( 'bluishost_page_sidebar' );
				$pageSidebar = bluishost_opt( 'bluishost_page_layoutopt' );
				if( $pageSidebar != '1' ){
					if( $pageSidebar != '3' ){
						if( $sidebar != '1' ){
							get_sidebar('page');
						}
					}else{
						if( $sidebar != '1' ){

							get_sidebar();
						}
					}

				}
			}
			
		}
	}


	// Blog single post  social share hook function.
	if( !function_exists('bluishost_blog_posts_share_cb') ){
		function bluishost_blog_posts_share_cb(){
			if( function_exists('bluishost_social_sharing_buttons') ){
				bluishost_social_sharing_buttons();
			}			
		}
	}

	/**
	 * Blog single post meta category, tag, next-previous link, comments form and biography hook function.
	 */
	if( !function_exists('bluishost_blog_single_meta_cb') ){
		function bluishost_blog_single_meta_cb(){
			
			$cats 	  = bluishost_post_cats();		
			$tags 	  = bluishost_post_tags();
			$shareBox = bluishost_opt( 'bluishost_hide_shareBox' );
			
			if( $tags || $shareBox ){
				echo '<div class="tag-cat-soc" data-animate="fadeInUp" data-delay=".1">';
					echo '<div class="row align-items-center">';
						echo '<div class="col-md-8 col-sm-7">';
							echo '<ul class="tag-cat karla list-unstyled">';
							// single post tag
							echo wp_kses_post( $cats );
							echo wp_kses_post( $tags );
							echo '</ul>';
						echo '</div>';
				
						/**
						 * Blog single Post social Share 
						 * @Hook  bluishost_blog_posts_share
						 *
						 * @Hooked bluishost_blog_posts_share_cb
						 * 
						 *
						 */
						if( $shareBox ){
							echo '<div class="col-md-4 col-sm-5">';
								do_action( 'bluishost_blog_posts_share' );
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			}
			?>

				<ul class="more-post list-unstyled clearfix" data-animate="fadeInUp" data-delay=".2">
					<li><?php echo get_next_post_link( '%link', '<i class="fas fa-arrow-left"></i> Newer Post', true ); ?></li>

					<li><?php echo get_previous_post_link( '%link', 'Older Post <i class="fas fa-arrow-right"></i>', true ); ?></li>
				</ul>

				<?php
				// Author biography
				if( '' !== get_the_author_meta('description') ){
					get_template_part( 'templates/biography' );
				}
				// comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
	
		}
	}
	// Blog 404 page hook function.
	if( !function_exists('bluishost_fof_cb') ){
		function bluishost_fof_cb(){
			get_template_part( 'templates/404' );			
		}
	}