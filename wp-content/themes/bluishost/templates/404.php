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

if( bluishost_opt( 'bluishost_fof_bgoverlay' ) ){
	$overlay = 'bg--overlay';
}else{
	$overlay = '';
}

?>
<section class="not-found-title text-center position-relative <?php echo esc_attr( $overlay ); ?>">
	<div class="container">
		<?php
		//
		$img = bluishost_opt('bluishost_fof_img', 'url');
		if( $img ){
			echo bluishost_img_tag(
				array(
					'url'	=> esc_url( $img ),
					'data-animate'	=> 'shake',
					'data-delay'	=> '1',
				)
			);
		}

		$errorText = esc_html__( 'Oops ! 404 Error', 'bluishost' );
		if( bluishost_opt( 'bluishost_fof_text' ) ){
			$errorText = bluishost_opt( 'bluishost_fof_text' );
		}
		//Heading
		echo bluishost_heading_tag(
			array(
				'tag'	      	=> 'h2',
				'data-animate'	=> 'fadeInUp',
				'data-delay'  	=> '1.2',
				'text' 	 	  	=> esc_html( $errorText ),
			)
		);

		//Home icon with text
		echo bluishost_anchor_tag(
			array(
				'url' 	 		=> esc_url( site_url( '/' ) ),
				'text' 	 		=> wp_kses_post( '<i class="fas fa-home"></i> '.__('Go to Home', 'bluishost') ),
				'class'	 		=> 'karla',
				'data-animate'	=> 'fadeInUp',
				'data-delay'	=> '1.5',
			)
		);

		?>
	</div>
	<img class="svg" src="<?php echo esc_url( BLUISHOST_DIR_IMG_URI.'not-fournd-bg1.svg' ) ?>" alt="<?php esc_html_e( 'Layer One', 'bluishost' ) ?>">
    <img class="svg" src="<?php echo esc_url( BLUISHOST_DIR_IMG_URI.'not-fournd-bg2.svg' ) ?>" alt="<?php esc_html_e( 'Layer Two', 'bluishost' ) ?>">
    <img class="svg" src="<?php echo esc_url( BLUISHOST_DIR_IMG_URI.'not-fournd-bg3.svg' ) ?>" alt="<?php esc_html_e( 'Layer Three', 'bluishost' ) ?>">
</section>		
<!-- 404 content -->
<section class="not-found-content pt-120">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-8 col-md-10">
				<?php
					// Wrong text block
					$wrongText = wp_kses_post( __( 'The page you are looking for was moved, removed, renamed or might be never exist.', 'bluishost' ) );

					if( bluishost_opt('bluishost_fof_desc') ){
						$wrongText = bluishost_opt('bluishost_fof_desc');
					}

    				echo bluishost_heading_tag(
    					array(
    						'tag'	      => 'h3',
    						'class'	 	  => 'karla text-center',
    						'data-animate'=> 'fadeInUp',
							'data-delay'  => '.1',
							'text' 	 	  => esc_html( $wrongText ),
						)
    				);

				?>
                <div class="fof-wrap">
					<?php 
					// Search Form
					get_search_form();
					?>
				</div>
			</div>
		</div>
	</div>
</section>