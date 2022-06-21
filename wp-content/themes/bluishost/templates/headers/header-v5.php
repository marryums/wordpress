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

$email01    = bluishost_opt( 'bluishost_header_top_mail_one' );
$email02    = bluishost_opt( 'bluishost_header_top_mail_two' );
$number01   = bluishost_opt( 'bluishost_header_top_number_one' );
$number02   = bluishost_opt( 'bluishost_header_top_number_two' );

//Remove ' ' , '-', ' - ' from email one
$replace = array(' ','-',' - ','(',')');
$with = array('','','','','');
$emailurl01 = str_replace( $replace, $with, $email01 );

//Remove ' ' , '-', ' - ' from email two
$replace = array(' ','-',' - ','(',')');
$with = array('','','','','');
$emailurl02 = str_replace( $replace, $with, $email02 );

//Remove ' ' , '-', ' - ' from phone number one
$replace = array(' ','-',' - ','(',')');
$with = array('','','','','');
$numberurl01 = str_replace( $replace, $with, $number01 );

//Remove ' ' , '-', ' - ' from phone number two
$replace = array(' ','-',' - ','(',')');
$with = array('','','','','');
$numberurl02 = str_replace( $replace, $with, $number02 );
?>

<header class="header header-with--topbar header-with--av">
    <?php if( bluishost_opt( 'bluishost_enable_header_top_info' ) ) { ?>
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="top-contacts">
                            <?php
                                if( ! empty( $email01 ) || ! empty( $email02 ) || !empty( $number01 ) || !empty( $number01 ) ) {
                                    echo '<ul class="list-unstyled list-inline mb-0">';
                                        if( ! empty( $email01 ) || ! empty( $email02 ) ) {
                                            echo '<li>';
                                                echo '<a href="'. esc_html__( 'mailto:', 'bluishost' ) .esc_attr( $emailurl01 ) .'">'. esc_html( $email01 ) .'</a>';
                                            if( $email02 ) {
                                                echo ', <a href="'. esc_html__( 'mailto:', 'bluishost' ) . esc_attr( $emailurl02 ) .'">'. esc_html( $email02 ) .'</a>';
                                            }
                                            '</li>';
                                        }
                                        // Tel Number
                                        if( !empty( $number01 ) || !empty( $number01 ) ) {
                                            echo '<li>';
                                                echo '<a href="'. esc_html__( 'tel:', 'bluishost' ) .esc_attr( $numberurl01 ).'">'. esc_html( $number01 ) .'</a>';
                                                if( !empty( $number02 ) ) {
                                                    echo ', <a href="'. esc_html__( 'tel:', 'bluishost' ) .esc_attr( $numberurl02 ).'">'. esc_html( $number02 ) .'</a>';
                                                }
                                            echo '</li>';
                                        }
                                    echo '</ul>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <?php 
                            if( bluishost_opt( 'bluishost_enable_header_top_social' ) ) {
                                echo '<div class="social-icon text-right">';
                                    if( function_exists( 'bluishost_header_social' ) ) {
                                    echo bluishost_header_social( 
                                        array(
                                            'ul_class'          => 'list-unstyled list-inline mb-0'
                                        )
                                    );
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Advertisement Start -->
    <?php if( bluishost_opt( 'bluishost_enable_header_add_img' ) && bluishost_opt( 'bluishost_add_img_upload', 'url' ) ) { ?>
        <div class="advertisement">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a href="<?php echo esc_url( bluishost_opt( 'bluishost_add_img_url') ) ?>">
                            <img src="<?php echo esc_url( bluishost_opt( 'bluishost_add_img_upload', 'url' ) ) ?>" alt="<?php esc_attr__( 'logo', 'bluishost' ) ?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Advertisement End -->
    <div class="header-absoulate">
        <div class="main-header">
        
        	<!-- Header Topbar Start -->
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
                    <?php 
                        if( !empty( bluishost_opt( 'bluishost_enable_client_area_btn' ) ) && !empty( bluishost_opt( 'bluishost_header_btntext' ) ) ) : ?>
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
                    if( !empty( bluishost_opt( 'bluishost_enable_client_area_btn' ) ) && !empty( bluishost_opt( 'bluishost_header_btntext' ) ) ) {
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
                            <!-- Register button -->
                            <div class="register-button" data-animate="fadeInDown" data-delay="1">
                                <a class="btn btn-transparent btn-block" href="<?php echo esc_url( bluishost_opt( 'bluishost_header_btnurl' ) ) ?>">    <?php echo wp_kses_post( $getIcon ); ?>
                                    <span class="d-none d-sm-inline-block"><?php echo esc_html( bluishost_opt( 'bluishost_header_btntext' ) ) ?></span>
                                </a>
                            </div>
                            <!-- End of Register button -->
                        </div>
                    <?php } ?> 
                </div>
            </div>
        </div>
    </div>
</header>