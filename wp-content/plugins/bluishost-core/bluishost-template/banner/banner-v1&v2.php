<section id="banner" class="main-banner bg-primary bg-rotate position-relative <?php echo esc_attr( $uniqClass ); ?>">
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

            		if( !empty( $sliderTitle01 ) || !empty( $sliderTitle02 ) ) {
            			echo '<h2 data-animate="fadeInUp" data-delay="1.2">'. esc_html( $sliderTitle01 ) .' <span>'. esc_html( $sliderTitle02 ) .'</span></h2>';
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
</section>
<div id="arrow-target"></div>