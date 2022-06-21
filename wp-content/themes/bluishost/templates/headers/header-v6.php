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

<header class="header header-with--topbar">
    <!-- Topbar Logo Center -->
    <?php if( bluishost_opt( 'bluishost_enable_header_top_info' ) ) { ?>
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6 order-lg-first">
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
                    <div class="col-lg-2 col-12 order-md-first">
                        <div class="header-top-logo">
                            <?php
                                // Header Logo
                                if( bluishost_theme_logo() ){
                                    echo '<div class="logo" data-animate="fadeInDown" data-delay=".5">';
                                        echo bluishost_theme_logo();
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                    <?php if( bluishost_opt( 'bluishost_enable_header_top_social' ) ) { ?>
                        <div class="col-lg-5 col-md-6">
                            <div class="social-icon text-right">
                                <?php 
                                    echo bluishost_header_social(
                                        array(
                                            'ul_class'          => 'list-unstyled list-inline mb-0',
                                        )
                                    );
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php 
        }
    ?>
    <!-- Full Width Menu -->
    <div class="header-absoulate">
        <div class="main-header menu-full">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <nav data-animate="fadeInDown" data-delay=".75">
                            <!-- Header-menu -->
                            <div class='header-menu'>
                                 <?php
                                    // Main Menu Links Start
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
                </div>
            </div>
        </div>
    </div>
</header>