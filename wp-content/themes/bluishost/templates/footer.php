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

if( bluishost_opt( 'bluishost_footercol_switch' ) ){
	$col = bluishost_opt( 'bluishost_footercol_switch' );
}else{
	$col = '4';
}

$footer_layout = get_post_meta( get_the_ID(), '_bluishost_footer_layout_switcher', true );
if( $footer_layout ) {
	$footer_versions = get_post_meta( get_the_ID(), '_bluishost_footer_custom_layout', true );
}else{
	$footer_versions = bluishost_opt( 'bluishost_footer_style' );
}

if( $footer_versions == '1'){
	$footer_vr_class = ' main-footer--2 footer-gradient mt-0';
}elseif( $footer_versions == '2'){
	$footer_vr_class = ' bg-rotate position-relative';
}else{
	$footer_vr_class = ' text-white main-footer--3 mt-0';
}

if( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) {
	$widgetActive = '1';
	
	if( class_exists( 'ReduxFramework' ) ) {
		$widgetActive = bluishost_opt('bluishost_footerwidget_switch');
	}
}else{
	$widgetActive = '';
}

if( $widgetActive ){
	$footer_widget_activation = ' footer-widget-enabled';
} else {
	$footer_widget_activation = ' footer-widget-disabled';
}

// Widget Wrapper
$colStert ='<div class="col-lg-'.esc_attr( $col ).' col-sm-6">';
$colEnd   ='</div>';
?>

<footer class="main-footer <?php echo esc_attr( $footer_widget_activation.$footer_vr_class ); ?> ">
	<?php 
	// Footer Widgets Start
	if( $widgetActive ):
	?>
	<div class="top-footer">
		<div class="container">
			<div class="row">
				<?php 
				// Footer Widget Start
				// Footer widget 1
				if( is_active_sidebar( 'footer-1' ) ){
					echo wp_kses_post( $colStert  );
						dynamic_sidebar( 'footer-1' );
					echo wp_kses_post( $colEnd  );
				}
				// Footer widget 2
				if( is_active_sidebar( 'footer-2' ) ){
					echo wp_kses_post( $colStert  );
						dynamic_sidebar( 'footer-2' );
					echo wp_kses_post( $colEnd  );
				}
				// Footer widget 3
				if( is_active_sidebar( 'footer-3' ) ){
					echo wp_kses_post( $colStert  );
						dynamic_sidebar( 'footer-3' );
					echo wp_kses_post( $colEnd  );
				}
				// Footer widget 4
				if( is_active_sidebar( 'footer-4' ) ){
					echo wp_kses_post( $colStert  );
						dynamic_sidebar( 'footer-4' );
					echo wp_kses_post( $colEnd  );
				}
				?>
			</div>
		</div>
	</div>
	<?php 
	endif;
	// Footer Widgets End
	?>
	
	<div class="bottom-footer position-relative">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-5 order-last order-md-first">
					<div class="copyright-text" data-animate="fadeInDown" data-delay=".7">
						<?php 
						$copyRight = sprintf( 'Copyright &copy; %s <a href="%s">Bluishost</a>. All Rights Reserved.', date('Y') ,'#' );

						if( bluishost_opt('bluishost_copyright_text') ){
							$copyRight = bluishost_opt('bluishost_copyright_text');
						}
						//
						if( $copyRight ){
							echo bluishost_paragraph_tag(
								array(
									'text' 	 => wp_kses_post( $copyRight ),
								)
							);
						}
						?>
					</div>
				</div>

				
				<?php
				// Header Nav Links
				if( has_nav_menu('footer-menu') ){
					echo '<div class="col-md-7 order-first order-md-last">';
					echo '<div class="menu-footer-menu-container" data-animate="fadeInDown" data-delay=".75">';
						$args = array(
							'theme_location' => 'footer-menu',
							'container'		 => false,
							'menu_class' 	 => 'footer-menu text-md-right list-inline',
							'depth' 		 => '3',
							'fallback_cb' 	 => 'bluishost_bootstrap_navwalker::fallback',
							'walker' 		 => new bluishost_bootstrap_navwalker(),
						);
						wp_nav_menu( $args );
					echo '</div>';
					echo '</div>';
				}
				?>
				
			</div>
		</div>

		<?php 
			if( function_exists('bluishost_back_to_top') ){
				echo bluishost_back_to_top();
			}
		?>

	</div>
</footer>