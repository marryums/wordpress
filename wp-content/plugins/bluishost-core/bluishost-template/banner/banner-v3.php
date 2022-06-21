<?php 
$slidertype = get_post_meta( $id, '_bluishost_slider-type', true );
	
	$sliders = get_post_meta( $id, '_bluishost_slider-group-options', true );
	
	$genbg 	 			= get_post_meta( $id, '_bluishost_slider-genbg', true );
	$videobg 			= get_post_meta( $id, '_bluishost_slider-videobg', true );
	$activegenbgov 		= get_post_meta( $id, '_bluishost_slider-genbgov', true );
	$genoverlaycolor 	= get_post_meta( $id, '_bluishost_slider_genoverlaycolor', true );
	$genoverlayopacity 	= get_post_meta( $id, '_bluishost_slider_genoverlayopacity', true );
	$sliderTextColor 	= get_post_meta( $id, '_bluishost_slider-slidTextColor', true );
	$sliderBgColor 	    = get_post_meta( $id, '_bluishost_slider-slidBgColor', true );
	$sliderbtnColor 	= get_post_meta( $id, '_bluishost_slider-slidBtnTextColor', true );
	$sliderbtnBgColor 	= get_post_meta( $id, '_bluishost_slider-slidBtnBgColor', true );
	$sliderbtnBorderColor = get_post_meta( $id, '_bluishost_slider-sliderbtnBorderColor', true );
	
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
		$genbgov = ' ';
	}
	
	//  Genarel link behaviour
	if( $linkbehaviour != 'samepage' ){
		$linkbehaviour = '_blank';
	}else{
		$linkbehaviour = '';
	}
	// General Overlay color and opacity
	if( $genoverlaycolor || $genoverlayopacity ){
		
		$Css .= '#banner.main-banner.'.esc_attr( $uniqClass ).' .bg--img__inner.bg--overlay:before{background-color:'.esc_attr( $genoverlaycolor ).';opacity:'.esc_attr( $genoverlayopacity ).';}';
		
	}
	// Slider General Text color
	if( $sliderTextColor || $sliderBgColor ){
		
		$Css .= '.bg-secondary:before{background-color:'.esc_attr( $sliderBgColor ).'!important;}';
		$Css .= '.bg-primary:before{background-color:'.esc_attr( $sliderBgColor ).'!important;}';
		$Css .= '#banner.'.esc_attr( $uniqClass ).' .banner-content h2{color:'.esc_attr( $sliderTextColor ).';}';
		$Css .= '#banner.'.esc_attr( $uniqClass ).' .banner-content p{color:'.esc_attr( $sliderTextColor ).';}';
	}
	// Slider General button color
	if( $sliderbtnColor || $sliderbtnBgColor || $sliderbtnBorderColor ){
		//$sliderbtnColor
		$Css .= '#banner.'.esc_attr( $uniqClass ).' .btn-transparent{background-color:'.esc_attr( $sliderbtnBgColor ).';color:'.esc_attr( $sliderbtnColor ).';border-color:'.esc_attr( $sliderbtnBorderColor ).';}';
	}
	// Slider General button hover color
	if( $slidBtnhovTextColor || $slidBtnhovBgColor || $sliderbtnhovBorderColor ){
		//$sliderbtnColor
		$Css .= '#banner.'.esc_attr( $uniqClass ).' .btn-transparent:hover{background-color:'.esc_attr( $slidBtnhovBgColor ).';color:'.esc_attr( $slidBtnhovTextColor ).';border-color:'.esc_attr( $sliderbtnhovBorderColor ).';}';
	}
	
	// tubular js for Video background enqueue 
	if( $videobg ){
		wp_enqueue_script( 'tubular' );
	}
	
	
	ob_start();
	

if( is_iterable( $sliders ) ) :

	foreach( $sliders as $slider ) :

		$sliderTitle01 = isset( $slider['_bluishost_slider-title-one'] ) ? $slider['_bluishost_slider-title-one'] : '';
		$sliderTitle02 = isset( $slider['_bluishost_slider-title-two'] ) ? $slider['_bluishost_slider-title-two'] : '';
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
<!-- Banner -->
<section class="main-banner banner--3 section-gradient position-relative">
    <div class="banner-shape shape_1"></div>
    <div class="banner-shape shape_2"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12">
                <!-- Banner content -->
                <div class="banner-content text-white">
                    <h2 data-animate="fadeInUp" data-delay="1.4">You are at the <br>center of security</h2>
                    <p data-animate="fadeInUp" data-delay="1.5">Sed ut perspiciatis unde omnis iste natus error sit voluptatem ccusantium doloremque laudantium, totam rem aperiam inventore.</p>
                    <ul class="list-inline" data-animate="fadeInUp" data-delay="1.6">
                        <li><a class="btn btn-transparent btn-square" href="#">Check Features</a></li>
                        <li><a class="btn btn-transparent btn-square btn-icon" href="#"><img src="img/play-btn.svg" class="svg" alt=""> Watch video</a></li>
                    </ul>
                </div>
                <!-- End of Banner content -->
            </div>
            <div class="col-lg-6 col-12">
                <div class="banner-image">
                    <img data-rjs="3" src="img/home-3/banner--3.gif" alt="">
                    <img data-rjs="3" class="animate-icon animate-icon_1" src="img/home-3/animated.png" alt="">
                    <img data-rjs="3" class="animate-icon animate-icon_2" src="img/home-3/animated.png" alt="">
                    <img data-rjs="3" class="animate-icon animate-icon_3" src="img/home-3/animated.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of Banner -->