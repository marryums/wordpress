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
?>

<header class="header">
    <div class="header-absoulate">
        <div class="main-header">
        	<div class="container">
        		<div class="row">
        			<div class="col-xl-3 col-lg-2 col-md-3 col-sm-5 col-6">
        				<?php
        				// Header Logo
        				if( bluishost_theme_logo() ){
        					echo '<div class="logo" data-animate="fadeInDown" data-delay=".5">';
        						echo bluishost_theme_logo();
        					echo '</div>';
        				}
        				?>
        			</div>
        			<!-- Header Navbar Start -->
                    <?php if( bluishost_opt( 'bluishost_enable_client_area_btn' )) : ?>
                        <div class="col-xl-7 col-lg-8 col-md-6 col-sm-3 col-3">
                    <?php else : ?>
                        <div class="col-xl-9 col-lg-10 col-md-9 col-sm-7 col-6">
                    <?php endif; ?>
                        <nav data-animate="fadeInDown" data-delay=".75">
                            <!-- Header-menu -->
                            <div class='header-menu'>

                                <?php  
                                    //Main Menu Links Start
                                    if( has_nav_menu( 'primary-menu' ) ) {
                                        
                                        $scrollmenuargs = array(
                                            'theme_location' => 'primary-menu',
                                            'menu_class'     => '',
                                            'container'      => '',
                                            'depth'          => 3,
                                            'fallback_cb'    => 'bluishost_Bootstrap_Navwalker::fallback',
                                            'walker'         => new Bluishost_Bootstrap_Navwalker(),
                                        );
                                        wp_nav_menu( $scrollmenuargs ); 
                                    }
                                ?>
                                <!-- Header Nav Links End -->
                            </div>
                        </nav>
                    </div>

                    <?php 
                    if( bluishost_opt( 'bluishost_enable_client_area_btn' ) && !empty( bluishost_opt( 'bluishost_header_btntext' ) ) ) { 
                        $logbtnimgicon = bluishost_opt( 'bluishost_logbtn_imgicon' );
                        $logbtnicon    = bluishost_opt( 'bluishost_logbtn_icon' );
                        $getIcon = '';

                        // Button Icon
                        if( is_array( $logbtnimgicon ) && empty( $logbtnimgicon['url'] )) {
                            $getIcon = '<i class="fas '.esc_attr( $logbtnicon ).'"></i>';
                        } else {
                            $getIcon = bluishost_img_tag(
                                array(
                                    'url' => esc_url( $logbtnimgicon['url'] ),
                                    
                                )
                            );
                        }
                    ?>

                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-3">
                            <!-- Client area button -->
                            <div class="register-button" data-animate="fadeInDown" data-delay="1">
                                <a class="btn btn-transparent btn-block" href="<?php echo esc_url( bluishost_opt( 'bluishost_header_btnurl' ) ) ?>">    <?php echo wp_kses_post( $getIcon ); ?>
                                    <span class="d-none d-sm-inline-block"><?php echo esc_html( bluishost_opt( 'bluishost_header_btntext' ) ) ?></span>
                                </a>
                            </div>
                            <!-- End of Client area button -->
                        </div>
                    <?php } ?> 
                </div>
            </div>
        </div>
    </div>
</header>