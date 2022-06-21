<?php 
/**
 * @Packge    : Bluishost
 * @version   : 1.0
 * @Author    : ThemeLooks
 * @Author URI: https://www.themelooks.com/
 */

add_shortcode( 'slider', 'bluishost_slider' );
function bluishost_slider( $atts, $content ){
	
    $attr = shortcode_atts(
        array(
            'id' => ''
        ),
        $atts
    );

	if( !empty( $attr['id'] ) ){
		$id = $attr['id'];
	}else{
		$id = '';
	}
	
	$Css = '';
	// Uniq Id /Class 
	$uniqClass = uniqid( 'sliderwrapper' ).'-'.rand( 1, 9999 );
	
	$slidertype = get_post_meta( $id, '_bluishost_slider-type', true );
	
	$sliderversion 		= get_post_meta( $id, '_bluishost_slider-version', true );

	if( '1' == $sliderversion ){
		$sliders = get_post_meta( $id, '_bluishost_sliderone-group-options', true );
		if( !empty( $sliders ) ){
			$sliders = $sliders;
		}else{
			$sliders = array();
		}
	}elseif( '3' == $sliderversion ){
		$sliders = get_post_meta( $id, '_bluishost_sliderfour-group-options', true );
		if( !empty( $sliders ) ){
			$sliders = $sliders;
		}else{
			$sliders = array();
		}
	}else{
		$sliders = get_post_meta( $id, '_bluishost_sliderthree-group-options', true );
		if( !empty( $sliders ) ){
			$sliders = $sliders;
		}else{
			$sliders = array();
		}
	}


	$genbg 	 			= get_post_meta( $id, '_bluishost_slider-genbg', true );
	$genbg_val 	 		= get_post_meta( $id, '_bluishost_slider-genbg', true );
	$videobg 			= get_post_meta( $id, '_bluishost_slider-videobg', true );
	$activegenbgov 		= get_post_meta( $id, '_bluishost_slider-genbgov', true );
	$genoverlaycolor 	= get_post_meta( $id, '_bluishost_slider_genoverlaycolor', true );
	$genoverlayopacity 	= get_post_meta( $id, '_bluishost_slider_genoverlayopacity', true );
	$sliderTextColor 	= get_post_meta( $id, '_bluishost_slider-slidTextColor', true );
	$sliderBgColor 	    = get_post_meta( $id, '_bluishost_slider-slidBgColor', true );
	$sliderbtnColor 	= get_post_meta( $id, '_bluishost_slider-slidBtnTextColor', true );
	$sliderbtnBgColor 	= get_post_meta( $id, '_bluishost_slider-slidBtnBgColor', true );
	$sliderbtnBorderColor = get_post_meta( $id, '_bluishost_slider-sliderbtnBorderColor', true );
	$sliderNavs 		= get_post_meta( $id, '_bluishost_slider-navs', true );
	$sliderDots 		= get_post_meta( $id, '_bluishost_slider-dots', true );
	
	$slidBtnhovTextColor  	 = get_post_meta( $id, '_bluishost_slider-slidBtnhovTextColor', true );
	$slidBtnhovBgColor 		 = get_post_meta( $id, '_bluishost_slider-slidBtnhovBgColor', true );
	$sliderbtnhovBorderColor = get_post_meta( $id, '_bluishost_slider-sliderbtnhovBorderColor', true );
	$linkbehaviour 			 = get_post_meta( $id, '_bluishost_slider-linkbehaviour', true );

	//  Genarel Background
	if( $genbg && !$videobg ){
		$genbg = 'style="background-image: url('.esc_url( $genbg ).')!important;"';
	}else{
		$genbg = '';
	}
	//  Genarel Video Background
	if( $videobg && !$genbg ){
		$videobg = 'data-bg-video="'.esc_attr( $videobg ).'"';
	}else{
		$videobg = '';
	}

	//  Genarel bg Overlay
	
	if( $activegenbgov ){
		$genbgov = ' bg--overlay';
	}else{
		$genbgov = '';
	}
	
	//  Genarel link behaviour
	if( $linkbehaviour != 'samepage' ){
		$linkbehaviour = '_blank';
	}else{
		$linkbehaviour = '';
	}
	// General Overlay color and opacity
	if( $genoverlaycolor || $genoverlayopacity ){
		if( $sliderversion == '1' ){
			$Css .= '#banner.main-banner.'.esc_attr( $uniqClass ).' .bg--img__inner.bg--overlay:before{background-color:'.esc_attr( $genoverlaycolor ).';opacity:'.esc_attr( $genoverlayopacity ).';}';
		}else{
			$Css .= '.banner--3.'.esc_attr( $uniqClass ).'.bg--overlay:before{background-color:'.esc_attr( $genoverlaycolor ).';opacity:'.esc_attr( $genoverlayopacity ).';}';
		}
	}
	// Slider General Text color
	if( $sliderTextColor || $sliderBgColor ){
		if( $sliderversion == '1' ){
			$Css .= '.bg-secondary:before{background-color:'.esc_attr( $sliderBgColor ).'!important;}';
			$Css .= '.bg-primary:before{background-color:'.esc_attr( $sliderBgColor ).'!important;}';
			$Css .= '#banner.'.esc_attr( $uniqClass ).' .banner-content h1{color:'.esc_attr( $sliderTextColor ).';}';
			$Css .= '#banner.'.esc_attr( $uniqClass ).' .banner-content p{color:'.esc_attr( $sliderTextColor ).';}';
		}else{
			$Css .= '.banner--3.'.esc_attr( $uniqClass ).'{background-color:'.esc_attr( $sliderBgColor ).'!important;}';
			$Css .= '.banner--3.'.esc_attr( $uniqClass ).' .banner-content h2{color:'.esc_attr( $sliderTextColor ).'!important;}';
			$Css .= '.banner--3.'.esc_attr( $uniqClass ).' .banner-content p{color:'.esc_attr( $sliderTextColor ).'!important;}';
		}
		
	}
	// Slider General button color
	if( $sliderbtnColor || $sliderbtnBgColor || $sliderbtnBorderColor ){
		//$sliderbtnColor
		if( $sliderversion == '1' ){
			$Css .= '#banner.'.esc_attr( $uniqClass ).' .btn-transparent{background-color:'.esc_attr( $sliderbtnBgColor ).';color:'.esc_attr( $sliderbtnColor ).';border-color:'.esc_attr( $sliderbtnBorderColor ).';}';
		}else{
			$Css .= '.banner--3.'.esc_attr( $uniqClass ).' .btn-transparent{background-color:'.esc_attr( $sliderbtnBgColor ).';color:'.esc_attr( $sliderbtnColor ).';border-color:'.esc_attr( $sliderbtnBorderColor ).';}';
		}
	}
	// Slider General button hover color
	if( $slidBtnhovTextColor || $slidBtnhovBgColor || $sliderbtnhovBorderColor ){
		//$sliderbtnColor
		if( $sliderversion == '1' ){
			$Css .= '#banner.'.esc_attr( $uniqClass ).' .btn-transparent:hover{background-color:'.esc_attr( $slidBtnhovBgColor ).';color:'.esc_attr( $slidBtnhovTextColor ).';border-color:'.esc_attr( $sliderbtnhovBorderColor ).';}';
		}else{
			$Css .= '.banner--3.'.esc_attr( $uniqClass ).' .btn-transparent:hover{background-color:'.esc_attr( $slidBtnhovBgColor ).';color:'.esc_attr( $slidBtnhovTextColor ).';border-color:'.esc_attr( $sliderbtnhovBorderColor ).';}';
		}
		
	}
	
	// tubular js for Video background enqueue 
	if( $videobg ){
		wp_enqueue_script( 'tubular' );
	}

	if(  count( $sliders ) > 1 ){
		$slider_active_class = ' owl-carousel';
	}else{
		$slider_active_class = '';
	}
	
	
	ob_start();
?>	
	
<div class="home_banner_wrapper<?php echo esc_attr( $slider_active_class ).' slider-'.esc_attr($sliderversion); ?>" data-nav="<?php echo esc_attr($sliderNavs); ?>" data-dots="<?php echo esc_attr($sliderDots); ?>" >
<?php
if( is_iterable( $sliders ) ) :

	if( $sliderversion == '1' ) :

		foreach( $sliders as $slider ) :

		$sliderTitletag = isset( $slider['_bluishost_slider-title-tag'] ) ? $slider['_bluishost_slider-title-tag'] : 'h2';
		$sliderTitle01 = isset( $slider['_bluishost_slider-title-one'] ) ? $slider['_bluishost_slider-title-one'] : '';
		$sliderDescrip = isset( $slider['_bluishost_slider-descriptions'] ) ? $slider['_bluishost_slider-descriptions'] : '';
		$sliderBtnTxt01 = isset( $slider['_bluishost_sliderbutton01-text'] ) ? $slider['_bluishost_sliderbutton01-text'] : '';
		$sliderBtnTxt02 = isset( $slider['_bluishost_sliderbutton02-text'] ) ? $slider['_bluishost_sliderbutton02-text'] : '';
		$sliderBtnUrl01 = isset( $slider['_bluishost_sliderbutton01-url'] ) ? $slider['_bluishost_sliderbutton01-url'] : '';
		$sliderBtnUrl02 = isset( $slider['_bluishost_sliderbutton02-url'] ) ? $slider['_bluishost_sliderbutton02-url'] : '';
		$sliderTextAlign = isset( $slider['_bluishost_slider-textalign'] ) ? $slider['_bluishost_slider-textalign'] : 'center';
		$sliderImgPos 	= isset( $slider['_bluishost_slider-imgpos'] ) ? $slider['_bluishost_slider-imgpos'] : '';

		// Attributeas
		if( empty( $slider['_bluishost_slider-img'] ) ){
			$rowClass = 'justify-content-center';
		}else{
			$rowClass = 'align-items-center';
		}

?>

	<div id="banner" class="main-banner bg-primary bg-rotate d-flex align-items-center position-relative <?php echo esc_attr( $uniqClass ); ?>">
		<?php 
			if( $genbg ) {
				echo '<div class="bg--img">';
				echo '<div class="bg--img__inner'.$genbgov.'" '. wp_kses_post( $genbg ) .'></div>';
				echo '</div>';
			}

			if( $videobg ) {
				echo '<div class="bg--video" '. wp_kses_post( $videobg ) .'></div>';
			}
		?>
		<div class="container">
		    <div class="row <?php echo esc_attr( $rowClass ) ?>">
		    	<?php
	    		// Slider Image
				if( !empty( $slider['_bluishost_slider-img'] ) ){
		    	?>
		    	<div class="col-lg-6 col-md-4 <?php echo esc_attr( $sliderImgPos ); ?>">
		            <div class="banner-image text-center" data-animate="fadeInUp" data-delay="1.2">
		            	<?php
		            		echo bluishost_img_tag(
								array(
									'url' 	 	=> esc_url( $slider['_bluishost_slider-img'] ),
								)
							);
		            	?>
		            </div>
		        </div>
		        <?php 
		        	}

		        // Banner Content Wrapper
		        if( !empty( $slider['_bluishost_slider-img'] ) ) {
		        	echo '<div class="col-lg-6 col-md-8">';
		        }else{
		        	echo '<div class="col-xl-8 col-lg-10">';
		        }
		        //
	            		echo '<div class="banner-content text-'. esc_attr( $sliderTextAlign ) .' text-white">';

	            		if( !empty( $sliderTitle01 )) {
	            			echo bluishost_heading_tag(
	            				array(
	            					'tag' 	 	  	=> esc_attr( $sliderTitletag ),
	            					'text'			=> wp_kses_post( $sliderTitle01 ),
	            					'data-animate'	=> 'fadeInUp',
	            					'data-delay'	=> '1.2'
	            				)
	            			);
	            		}

	            		if( !empty( $sliderDescrip ) ){
	            			echo bluishost_paragraph_tag(
	            				array(
	            					'text'			=> wp_kses_post( $sliderDescrip ),
	            					'data-animate'	=> 'fadeInUp',
	            					'data-delay'	=> '1.3'
	            				)
	            			);
	            		}

	            		if( !empty( $sliderBtnUrl01 ) || !empty( $sliderBtnUrl02 ) ){

	            			echo '<ul class="list-inline" data-animate="fadeInUp" data-delay="1.4">';

	            			if( !empty( $sliderBtnUrl01 ) ) {
	            				echo '<li>';
		            			echo bluishost_anchor_tag(
		            				array(
		            					'url'		=> esc_url( $sliderBtnUrl01 ),
		            					'text'		=> wp_kses_post( $sliderBtnTxt01 ),
		            					'class'		=> 'btn btn-transparent',
		            					'target'	=> esc_attr( $linkbehaviour )

		            				)
		            			);
		            			echo '</li>';
	            			}
	            			
	            			if( !empty( $sliderBtnUrl02 ) ) {
	            				echo '<li>';
		            			echo bluishost_anchor_tag(
		            				array(
		            					'url'		=> esc_url( $sliderBtnUrl02 ),
		            					'text'		=> wp_kses_post( $sliderBtnTxt02 ),
		            					'class'		=> 'btn btn-transparent',
		            					'target'	=> esc_attr( $linkbehaviour )

		            				)
		            			);
		            			echo '</li>';
	            			}
	            			
	            			echo '</ul>';

	            		}

	            		echo '</div>';
	            	?>
		            <!-- End of Banner content -->
		        </div>
		        <?php
		        	if( bluishost_opt( 'bluishost_display_banner_bcktotop' ) ) {
		        		echo '<span class="goDown" data-animate="fadeInUp" data-delay="1.5"><i class="fas fa-arrow-down bounce"></i></span>';
		        	}
		        ?>
		    </div>
		</div>

	</div>
	<?php 

		endforeach;
	elseif( $sliderversion == '3' ) :

		foreach( $sliders as $slider ) :

		$sliderTitletag = isset( $slider['_bluishost_slider-title-tag'] ) ? $slider['_bluishost_slider-title-tag'] : 'h2';
		$sliderTitle01 = isset( $slider['_bluishost_slider-title-one'] ) ? $slider['_bluishost_slider-title-one'] : '';
		$sliderDescrip = isset( $slider['_bluishost_slider-descriptions'] ) ? $slider['_bluishost_slider-descriptions'] : '';
		$sliderBtnTxt01 = isset( $slider['_bluishost_sliderbutton01-text'] ) ? $slider['_bluishost_sliderbutton01-text'] : '';
		$sliderBtnTxt02 = isset( $slider['_bluishost_sliderbutton02-text'] ) ? $slider['_bluishost_sliderbutton02-text'] : '';
		$sliderBtnUrl01 = isset( $slider['_bluishost_sliderbutton01-url'] ) ? $slider['_bluishost_sliderbutton01-url'] : '';
		$sliderBtnUrl02 = isset( $slider['_bluishost_sliderbutton02-url'] ) ? $slider['_bluishost_sliderbutton02-url'] : '';
		$sliderTextAlign = isset( $slider['_bluishost_slider-textalign'] ) ? $slider['_bluishost_slider-textalign'] : 'center';
		$sliderImgPos 	= isset( $slider['_bluishost_slider-imgpos'] ) ? $slider['_bluishost_slider-imgpos'] : '';

	?>

	<!-- Banner -->
        <div class="main-banner banner--4 position-relative">
            <canvas id="c"></canvas>
            <div class="container">
                <div class="row justify-content-center align-items-center">
                	<?php
                		// Banner Content Wrapper
				        if( !empty( $slider['_bluishost_slider-img-one'] ) || !empty( $slider['_bluishost_slider-img-two'] ) || !empty( $slider['_bluishost_slider-img-three'] ) ) {
				        	echo '<div class="col-lg-7">';
				        }else{
				        	echo '<div class="col-lg-10">';
				        }
				        
                	?>
                        <!-- Banner content -->
                        <div class="banner-content text-<?php echo esc_attr( $sliderTextAlign ) ?> text-white">
                            <?php 
                            	if( !empty( $sliderTitle01 )) {
			            			echo bluishost_heading_tag(
			            				array(
			            					'tag' 	 	  	=> esc_attr( $sliderTitletag ),
			            					'text'			=> wp_kses_post( $sliderTitle01 ),
			            					'data-animate'	=> 'fadeInDown',
			            					'data-delay'	=> '.5'
			            				)
			            			);
			            		}

			            		if( ! empty( $sliderDescrip ) ) {
			            			echo bluishost_paragraph_tag(
			            				array(
			            					'text'			=> esc_html( $sliderDescrip ),
			            					'data-animate'	=> 'fadeInRight',
			            					'data-delay'	=> '.7'
			            				)
			            			);
			            		}

			            		if( !empty( $sliderBtnUrl01 ) || !empty( $sliderBtnUrl02 ) ){

			            			echo '<ul class="list-inline" data-animate="fadeInUp" data-delay=".9">';

			            			if( !empty( $sliderBtnUrl01 ) ) {
			            				echo '<li>';
				            			echo bluishost_anchor_tag(
				            				array(
				            					'url'		=> esc_url( $sliderBtnUrl01 ),
				            					'text'		=> wp_kses_post( $sliderBtnTxt01 ),
				            					'class'		=> 'btn btn-transparent',
				            					'target'	=> esc_attr( $linkbehaviour )

				            				)
				            			);
				            			echo '</li>';
			            			}
			            			
			            			if( !empty( $sliderBtnUrl02 ) ) {
			            				echo '<li>';
				            			echo bluishost_anchor_tag(
				            				array(
				            					'url'		=> esc_url( $sliderBtnUrl02 ),
				            					'text'		=> wp_kses_post( $sliderBtnTxt02 ),
				            					'class'		=> 'btn btn-transparent',
				            					'target'	=> esc_attr( $linkbehaviour )

				            				)
				            			);
				            			echo '</li>';
			            			}
			            			
			            			echo '</ul>';

			            		}
                            ?>
                        </div>
                        <!-- End of Banner content -->
                    </div>
                    <?php 
                    	if( !empty( $slider['_bluishost_slider-img-one'] ) || !empty( $slider['_bluishost_slider-img-two'] ) || !empty( $slider['_bluishost_slider-img-three'] ) ) :
                    ?>
                    <div class="col-lg-5 <?php echo esc_attr( $sliderImgPos ); ?>">
                    	<div class="banner-image banner-img--4">
                    	<?php
		            		if( !empty( $slider['_bluishost_slider-img-one'] ) ){
                    			echo bluishost_img_tag( array(
                    				"url"	=> esc_url($slider['_bluishost_slider-img-one'])
                    			) );
                    		}
                    		if( !empty( $slider['_bluishost_slider-img-two'] ) ){
                    			echo bluishost_img_tag( array(
                    				"url"	=> esc_url($slider['_bluishost_slider-img-two']),
                    				"data-animate" => "fadeInRight",
                    				"data-delay" => "1",
                    			) );
                    		}
                    		if( !empty( $slider['_bluishost_slider-img-three'] ) ){
                    			echo bluishost_img_tag( array(
                    				"url"	=> esc_url($slider['_bluishost_slider-img-three']),
                    				"data-animate" => "fadeInDown",
                    				"data-delay" => "1.3",
                    			) );
                    		}
		            	?>
                        </div>
                    </div>
                	<?php endif; ?>
                </div>
            </div>
        </div>
        <!-- End of Banner -->
	
	<?php 

		endforeach;
	else:
		foreach( $sliders as $slider ) :
			$sliderTitletag = isset( $slider['_bluishost_slider-title-tag'] ) ? $slider['_bluishost_slider-title-tag'] : 'h2';
			$sliderTitle01 = isset( $slider['_bluishost_slider-title-one'] ) ? $slider['_bluishost_slider-title-one'] : '';
			$sliderDescrip = isset( $slider['_bluishost_slider-descriptions'] ) ? $slider['_bluishost_slider-descriptions'] : '';
			$sliderBtnTxt01 = isset( $slider['_bluishost_sliderbutton01-text'] ) ? $slider['_bluishost_sliderbutton01-text'] : '';
			$sliderBtnTxt02 = isset( $slider['_bluishost_sliderbutton02-text'] ) ? $slider['_bluishost_sliderbutton02-text'] : '';
			$sliderBtnUrl01 = isset( $slider['_bluishost_sliderbutton01-url'] ) ? $slider['_bluishost_sliderbutton01-url'] : '';
			$sliderBtnUrl02 = isset( $slider['_bluishost_sliderbutton02-url'] ) ? $slider['_bluishost_sliderbutton02-url'] : '';
			$sliderTextAlign = isset( $slider['_bluishost_slider-textalign'] ) ? $slider['_bluishost_slider-textalign'] : 'center';
			$sliderImgPos 	= isset( $slider['_bluishost_slider-imgpos'] ) ? $slider['_bluishost_slider-imgpos'] : '';
			$gradientCoOne 	= isset( $slider['_bluishost_slider-gradient-color-one'] ) ? $slider['_bluishost_slider-gradient-color-one'] : '#0816bf';
			$gradientCoTwo 	= isset( $slider['_bluishost_slider-gradient-color-two'] ) ? $slider['_bluishost_slider-gradient-color-two'] : '#050e7f';

			// Attributeas
			if( empty( $slider['_bluishost_slider-img'] ) ){
				$rowClass = 'justify-content-center';
			}else{
					$rowClass = 'align-items-center';
			}

			if( !empty( $genbg_val ) ){
				$bg_class = ' bg-pos';
			}else{
				$bg_class = '';
			}

			$Css .= '.banner--3.'.esc_attr( $uniqClass ).'.section-gradient {background:'.esc_attr($gradientCoOne).';background-image: url('.esc_url($genbg_val).');background-image: url('.esc_url($genbg_val).'),-webkit-linear-gradient(top, '.esc_attr($gradientCoOne).' 0%,'.esc_attr($gradientCoTwo).' 100%);background-image: url('.esc_url($genbg_val).'),linear-gradient(to bottom, '.esc_attr($gradientCoOne).' 0%,'.esc_attr($gradientCoOne).', '.esc_attr($gradientCoTwo).' 100%);}';
?>
	<!-- Banner -->
    <div class="main-banner banner--3 section-gradient position-relative <?php echo esc_attr( $uniqClass.$bg_class.$genbgov ); ?>">
    	<?php

			if( $videobg ) {
				echo '<div class="bg--video" '. wp_kses_post( $videobg ) .'></div>';
			}
		?>
        <div class="banner-shape shape_1"></div>
        <div class="banner-shape shape_2"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <!-- Banner content -->
                    <div class="banner-content text-white text-<?php echo esc_attr( $sliderTextAlign  ); ?>">
                    	<?php 
                    		if( !empty( $sliderTitle01 ) ){
                    			echo bluishost_heading_tag( array(
                    				"text"			=> wp_kses_post( $sliderTitle01 ),
                    				"tag" 	 	  	=> esc_attr( $sliderTitletag ),
                    				"data-animate"	=> "fadeInUp",
                    				"data-delay"	=> "1.4"
                    			) );
                    		}

                    		if( !empty( $sliderDescrip ) ){
                    			echo bluishost_paragraph_tag( array(
                    				"text"			=> wp_kses_post( $sliderDescrip ),
                    				"data-animate"	=> "fadeInUp",
                    				"data-delay"	=> "1.5"
                    			) );
                    		}

                    		if( !empty( $sliderBtnTxt01 ) || !empty( $sliderBtnTxt02 )){
                    			echo '<ul class="list-inline" data-animate="fadeInUp" data-delay="1.6">';
                    				if( !empty( $sliderBtnTxt01 ) ){
                    					echo '<li>';
                    					?>
                    						<a target="<?php echo esc_attr( $linkbehaviour ); ?>" class="btn btn-transparent btn-square <?php echo ( $slider['_bluishost_sliderbutton01-imgicon-trigger'] == 'yes'  ) ? 'btn-icon' : '' ?>" href="<?php echo esc_url( $sliderBtnUrl01 ); ?>">
		                    					<?php 
												if( $slider['_bluishost_sliderbutton01-imgicon-trigger'] == 'yes'  ) :
												?>
													<img src="<?php echo esc_url( $slider['_bluishost_sliderbutton01-imgicon'] ); ?>" class="svg" alt=""> 
												<?php 
													endif;
												?>
		                    					<?php echo esc_html( $sliderBtnTxt01 ); ?>
	                    					</a>
	                    				<?php	
	                    				echo '</li>';	
                    				}
                    				if( !empty( $sliderBtnTxt02 ) ){
                    					echo '<li>';
                    					?>
										<a target="<?php echo esc_attr( $linkbehaviour ); ?>" class="btn btn-transparent btn-square <?php echo ( $slider['_bluishost_sliderbutton02-imgicon-trigger'] == 'yes'  ) ? 'btn-icon' : '' ?>" href="<?php echo esc_url( $sliderBtnUrl02 ); ?>">
											<?php 
												if( $slider['_bluishost_sliderbutton02-imgicon-trigger'] == 'yes'  ) :
											?>
												<img src="<?php echo esc_url( $slider['_bluishost_sliderbutton02-imgicon'] ); ?>" class="svg" alt=""> 
											<?php 
												endif;
											?>	
											<?php echo esc_html( $sliderBtnTxt02 ); ?>
										</a>
										<?php		
	                    				echo '</li>';		
                    				}
                    			echo '</ul>';
                    		}
                    	 ?>
                        </ul>
                    </div>
                    <!-- End of Banner content -->
                </div>
                <div class="col-lg-6 col-12  <?php echo esc_attr( $sliderImgPos ) ?>">
                    <div class="banner-image">
                    	<?php 
                    		if( !empty( $slider['_bluishost_slider-img'] ) ){
                    			echo bluishost_img_tag( array(
                    				"url"	=> esc_url($slider['_bluishost_slider-img'])
                    			) );
                    		}
                    		if( !empty( $slider['_bluishost_slider-img-two'] ) ){
                    			echo bluishost_img_tag( array(
                    				"class"	=> "animate-icon animate-icon_1",
                    				"url"	=> esc_url($slider['_bluishost_slider-img-two'])
                    			) );
                    		}
                    		if( !empty( $slider['_bluishost_slider-img-three'] ) ){
                    			echo bluishost_img_tag( array(
                    				"class"	=> "animate-icon animate-icon_2",
                    				"url"	=> esc_url($slider['_bluishost_slider-img-three'])
                    			) );
                    		}
                    		if( !empty( $slider['_bluishost_slider-img-four'] ) ){
                    			echo bluishost_img_tag( array(
                    				"class"	=> "animate-icon animate-icon_3",
                    				"url"	=> esc_url($slider['_bluishost_slider-img-four'])
                    			) );
                    		}
                    	?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Banner -->
<?php 
		endforeach;
	endif; 
endif;	

	?>

</div>

	<?php

	$inlinestyle = '';
	if( $Css ):

	$inlinestyle .= '<script type="text/javascript">';
		$inlinestyle .= '( function($){
			$("head").append( "<style>'.$Css.'</style>" );
		})(jQuery);';
	$inlinestyle .= '</script>';
	
	endif;
	echo $inlinestyle;
			
$value = ob_get_clean();

return $value;
}