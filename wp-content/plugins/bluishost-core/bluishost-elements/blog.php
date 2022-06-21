<?php 
/**
 * Bluishost Section Blog Element
 */
class WPBakeryShortCode_bluishost_blog extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Bluishost helper class
		$this->helper = new bluishost_helper() ;
		
		// Bluishost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'bluishost_blog_maping' ) );
		
		// Bluishost feature shortcode
		add_shortcode( 'bluishostblog', array( $this, 'bluishost_blog_shortcode' ) );
		
	}
	
	// vc Param
	public function bluishost_blog_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
			"name" 			=> esc_html__( "Blog", 'bluishost' ),
			"base" 			=> "bluishostblog",
			"class" 		=> "",
			"icon"  		=> BLUISHOST_PLUGDIRURI .'bluishost-elements/img/logoicon.png',
			"category" 		=> esc_html__( "Bluishost", 'bluishost'),
			"params" 		=> array(
			
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Blog Style', 'bluishost' ),
					'description'	=> esc_html__( 'Select blog style', 'bluishost' ),
					'param_name' 	=> 'styletype',
					'value'         => array(
		                esc_html__( 'Default', 'bluishost' )  			=> 'styleone',
		                esc_html__( 'Blog Style O1', 'bluishost' )  	=> 'styleone',
		                esc_html__( 'Blog Style O2', 'bluishost' )   => 'styletwo',
		            	),
		            'std'			=> 'styleone',
				),
				array(
					"type" 			=> "textfield",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Post Per Page", 'bluishost' ),
					"param_name" 	=> "postperpage",
				),
				array(
					"type" 			=> "textfield",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Word Visible", 'bluishost' ),
					"param_name" 	=> "showword",
				),
			  	array(
					"type" 			=> "dropdown",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Column", 'bluishost' ),
					"param_name" 	=> "col",
					"value" 		=> array(  
						'Default Column' 	=> '3',
						'Column 2' 			=> '6',
						'Column 3' 			=> '4',
						'Column 4' 			=> '3',
						'Column 6' 			=> '2',
					),
				),
				array(
					"type" 			=> "dropdown",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Button Style", 'bluishost' ),
					"param_name" 	=> "btn_style",
					"value" 		=> array(
						esc_html__( "Style One" ) 	=> 'btn_one',
						esc_html__( "Style Two" ) 	=> 'btn_two',

					),
					"dependency" 	=> array(
						"element" => "styletype",
						"value"   => "styleone",
					),
					"std"			=> 'btn_one'
				),
				array(
					"type" 			=> "checkbox",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Meta Show / Hide", 'bluishost' ),
					"description" 	=> esc_html__( "Select blog meta show / hide ( Default select show ).", "bluishost" ),
					"param_name" 	=> "blogmeta",
				),
				array(
					"type" 			=> "checkbox",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Category Show / Hide", 'bluishost' ),
					"description" 	=> esc_html__( "Select blog category show / hide ( Default select show ).", "bluishost" ),
					"param_name" 	=> "blogcat",
					"dependency" 	=> array(
						"element" => "styletype",
						"value"   => "styletwo",
					),
				),
				array(
					"type" 			=> "dropdown",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Link Target", 'bluishost' ),
					"param_name" 	=> "link_target",
					"value"			=> array(
						'Self' 	=> '_self',
						'Blank' => '_blank'
					)
				),
				array(
					"type" 			=> "css_editor",
					"heading" 		=> esc_html__("Design Settings Options", "bluishost"),
					"param_name" 	=> "css",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "attach_image",
					"heading" 		=> esc_html__("Pattern Image", "bluishost"),
					"param_name" 	=> "blogpattern",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
					"dependency" 	=> array(
						"element" 	=> "styletype",
						"value"   	=> "styletwo",
					),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Title Color", "bluishost" ),
					"param_name" 	=> "titlecolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Title Hover hvColor", "bluishost" ),
					"param_name" 	=> "titlehvcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "textfield",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Title Font Size", 'bluishost' ),
					"param_name" 	=> "fontsize",
					"description"	=> esc_html__( "Don't need to use ( px ). Default setting ( px ).", "bluishost" ),
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "dropdown",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Font Weight", 'bluishost' ),
					"param_name" 	=> "font_weight",
					"value"			=> array(
						'100' => '100',
						'200' => '200',
						'300' => '300',
						'400' => '400',
						'500' => '500',
						'600' => '600',
						'700' => '700',
						'800' => '800',
						'900' => '900'
					),
					"std"	  => '500',
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "textfield",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Content Font Size", 'bluishost' ),
					"param_name" 	=> "contfontsize",
					"description"	=> esc_html__( "Don't need to use ( px ). Default setting ( px ).", "bluishost" ),
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "textfield",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Post Meta Font Size", 'bluishost' ),
					"param_name" 	=> "metafontsize",
					"description"	=> esc_html__( "Don't need to use ( px ). Default setting ( px ).", "bluishost" ),
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Excerpt Color", "bluishost" ),
					"param_name" 	=> "excerptcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Button Color", "bluishost" ),
					"param_name" 	=> "buttoncolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Button Hover Color", "bluishost" ),
					"param_name" 	=> "buttonhvcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> esc_html__( "Post Background Color", "bluishost" ),
					"param_name" 	=> "postbgcolor",
					"group"			=> esc_html__( "Design Option", "bluishost" ),
				),
				array(
					'type' 			=> 'animation_style',
					'heading' 		=> esc_html__( 'Animation Style', 'bluishost' ),
					'param_name' 	=> 'animation',
					'description' 	=> esc_html__( 'Choose your animation style', 'bluishost' ),
					'admin_label' 	=> false,
					'weight' 		=> 0,
					"group"			=> esc_html__( "Design Option", 'bluishost' ),
				),
				array(
					'type'			=>	'textfield',
					'heading'		=>	esc_html__('Extra Class Name', 'bluishost'),
					'param_name'	=>	'el_class',
					'group'			=>	esc_html__('Extra Class', 'bluishost'),
					'description'	=>	esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "bluishost"),
				),
		  	)
		));
			
	}
	
	// Shortcode and markup
	public function bluishost_blog_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'styletype'  		=> 'styleone',
				'col'  		   		=> '',
				'postperpage'  		=> '',
				'showword'     		=> '',
				'seebtntext'   		=> __( 'See More', 'bluishost' ),
				'seebtnurl'    		=> '',
				'link_target'  		=> '_self',
				'blogmeta'     		=> '',
				'btn_style'     	=> 'btn_one',
				'blogcat'  			=> '',
				'titlecolor'  		=> '',
				'titlehvcolor'  	=> '',
				'fontsize'  		=> '',
				'font_weight'  		=> '500',
				'contfontsize'  	=> '15',
				'metafontsize'  	=> '14',
				'excerptcolor'  	=> '',
				'buttoncolor'  		=> '',
				'buttonhvcolor'  	=> '',
				'postbgcolor'  		=> '',
				'blogpattern'  		=> '',
				'css'   	   		=> '',
				'animation'    		=> '',
				'el_class'     		=> '',
			),
		$atts
		) );

		// uniq id
		$uniqId = uniqid('blog').'-'.rand(1,9999);

		// Column
		if( $col ){
			$col = $col;
		}else{
			$col = '4';
		}
		//
		
		// 
		if( $postperpage ){
			$postperpage = $postperpage;
		}else{
			$postperpage = '3';
		}	
		//
		if( $showword ){
			$showword = $showword;
		}else{
			$showword = '19';
		}

		// Blog Pattern
		$blogpattern = wp_get_attachment_image_src( $blogpattern, 'full' );
		if( $blogpattern ) {
			$bgpattern = 'data-bg-img='.esc_attr( $blogpattern[0] ).';';
		}else{
			$bgpattern = '';
		}

		// Extra Class
		if( $el_class ) {
			$el_class = ' '.$el_class;
		}else{
			$el_class = '';
		}

		$Css = '';

		
		// Title Color
		if( $titlecolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .post-content h3 a {color:'.esc_attr( $titlecolor ).'!important;}';
		}
		
		// Title Hover Color
		if( $titlehvcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .post-content h3 a:hover {color:'.esc_attr( $titlehvcolor ).'!important;}';
		}
		// Excerpt Color
		if( $excerptcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .post-content p {color:'.esc_attr( $excerptcolor ).'!important;}';
		}
		// Button Color
		if( $buttoncolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .post-content > a {color:'.esc_attr( $buttoncolor ).'!important;}';
		}
		
		// Button Hover Color
		if( $buttonhvcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).' .post-content > a:hover {color:'.esc_attr( $buttonhvcolor ).'!important;}';
		}
		// Read More Text Color
		if( $buttoncolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.bluishost_blog .single-post.post-style--2 .post-hover .post-hover-inner a{color:'.esc_attr( $buttoncolor ).'!important;}';
		}
		// Blog Post Backgroudn
		if( $postbgcolor ) {
			$Css .= '#'.esc_attr( $uniqId ).'.bluishost_blog .blog-bg{background-color:'.esc_attr( $postbgcolor ).'!important;}';
			$Css .= '#'.esc_attr( $uniqId ).'.bluishost_blog .post-content{background-color:'.esc_attr( $postbgcolor ).'!important;}';
		}

		if( $fontsize ) {
			$Css .= '#'.esc_attr( $uniqId ).'.bluishost_blog .post-content h3{font-size:'.esc_attr( $fontsize ).'px!important;}';
		}

		if( $font_weight ) {
			$Css .= '#'.esc_attr( $uniqId ).'.bluishost_blog .post-content h3{font-weight:'.esc_attr( $font_weight ).'!important;}';
		}

		if( $contfontsize ) {
			$Css .= '#'.esc_attr( $uniqId ).'.bluishost_blog .post-content p{font-size:'.esc_attr( $contfontsize ).'px!important;}';
		}

		if( $metafontsize ) {
			$Css .= '#'.esc_attr( $uniqId ).'.bluishost_blog .post-content p.post-info{font-size:'.esc_attr( $metafontsize ).'px!important;}';
		}

		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'bluishostfeatures', $atts );
		
		ob_start();
		?>
        <!-- Latest Posts -->
        <div id="<?php echo esc_attr( $uniqId ); ?>" class="bluishost_blog <?php echo esc_attr( $animation ); ?>">
	        <div class="row justify-content-center">
				<?php
					$i = '.1';
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => esc_html( $postperpage ),
					);
					$query = new WP_Query( $args );
					if( $query->have_posts() ):
					while( $query->have_posts() ): $query->the_post();
				?>
	            
	            <!-- Single Post -->
	            <?php if( $styletype == 'styleone' ) : ?>
		            <div class="col-lg-<?php echo esc_attr( $col ); ?> col-md-6 pb-30">
		                <div class="single-post <?php echo esc_attr( $el_class ) ?>" data-animate="fadeInUp" data-delay="<?php echo $i; ?>">
		                	<?php
		                		if( has_post_thumbnail() ) {
		                			echo '<a href="'. esc_url( get_the_permalink() ) .'">';
		                			the_post_thumbnail( 'full' );
		                			echo '</a>';
		                		}
		                	?>
		                    <div class="post-content">
		                    	<?php 
		                    	if( $blogmeta ) {
		                    		echo '<p class="post-info">';
										if( get_the_date() ):
										esc_html_e( 'Posted on', 'bluishost' ) ?> <a href="<?php echo esc_url( bluishost_blog_date_permalink() ); ?>"><?php echo esc_html( get_the_date() ); ?></a>
										<?php 
										endif;

										if( get_the_author() ):
										esc_html_e( 'by', 'bluishost' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php the_author(); ?></a>
										<?php
										endif;
		                        	echo '</p>';
		                    	}
		                        
		                        if( get_the_title() ) {
		                        	the_title( '<h3><a href="'. get_the_permalink() .'">', '</a></h3>' );
		                        }

		                        if( function_exists('bluishost_excerpt_length') ) {
		                        	echo bluishost_excerpt_length( esc_html( $showword ) );
		                        }

		                        if( $btn_style == 'btn_one' ) {
		                        	echo '<a href="'. esc_url( get_the_permalink() ) .'">'. esc_html( 'Reading Continue', 'bluishost' ) .'<i class="fas fa-caret-right"></i></a>';
		                        } else {
		                        	echo '<a href="'. esc_url( get_the_permalink() ) .'">'. esc_html( 'Reading Continue', 'bluishost' ) .'<i class="fas fa-angle-right"></i></a>';
		                        }
		                        ?>
		                        
		                    </div>
		                </div>
		            </div>

				<?php 
					else :
				?>
				<div class="col-md-<?php echo esc_attr( $col ); ?> col-12">
	                <div class="single-post post-style--2 blog-shape <?php echo esc_attr( $el_class ) ?>" <?php echo wp_kses_post( $bgpattern ); ?> data-animate="fadeInUp" data-delay="<?php echo esc_html($i); ?>">
	                    <div class="post-content">
	                    	<?php 
	                    		if( $blogcat ) {
	                    			$categories = get_the_category();
		                    		if ( ! empty( $categories ) ) {
									    echo '<span class="post-cat">'.esc_html( $categories[0]->name ).'</span>';   
									}
	                    		}
	                    		
	                        	if( get_the_title() ) {
		                        	the_title( '<h3><a href="'. get_the_permalink() .'">', '</a></h3>' );
		                        }
	                        	
	                        	if( $blogmeta ) {
	                        		echo '<p class="post-info">';

		                        	if( get_the_author() ):
									esc_html_e( 'Posted  by', 'bluishost' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php the_author(); ?></a>
									<?php
									endif; 

									if( get_the_date() ):
									esc_html_e( 'on', 'bluishost' ) ?> <a href="<?php echo esc_url( bluishost_blog_date_permalink() ); ?>"><?php echo esc_html( get_the_date('M j, Y') ); ?></a>
									<?php 
									endif;
								echo '</p>';
	                        	}

								if( function_exists('bluishost_excerpt_length') ) {
		                        	echo bluishost_excerpt_length( esc_html( $showword ) );
		                        }
							?>
	                    </div>
	                    <?php if( get_the_post_thumbnail_url() ) :  ?>
		                    <div class="post-hover">
		                        <div class="post-hover-inner" data-bg-img="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>">
		                            <a href="<?php the_permalink(); ?>"><?php esc_html_e( '+ Read More', 'bluishost' ); ?></a>
		                        </div>
		                    </div>
	                	<?php endif; ?>
	                </div>
	            </div>
				<?php
					endif;
					$i = $i + .2;
					endwhile;
					wp_reset_postdata();
					endif;
				?>
			</div>
		</div>
        <!-- Gallery Section End -->
		<?php
		
		if( $Css ){
			echo $this->helper->bluishost_inline_css( $Css );
		}

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_bluishost_blog();