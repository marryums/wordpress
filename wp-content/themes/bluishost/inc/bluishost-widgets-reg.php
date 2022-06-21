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
    
function bluishost_widgets_init() {
    // sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'bluishost' ),
        'id'            => 'bluishost-post-sidebar',
        'description'   => esc_html__( 'Add sidebar widgets here.', 'bluishost' ),
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s" data-animate="fadeInUp" data-delay=".1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'bluishost' ),
        'id'            => 'bluishost-page-sidebar',
        'description'   => esc_html__( 'Add sidebar widgets here.', 'bluishost' ),
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s" data-animate="fadeInUp" data-delay=".1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    // Woo page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Woo Page Sidebar', 'bluishost' ),
        'id'            => 'bluishost-woo-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s" data-animate="fadeInUp" data-delay=".1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
    
    // footer widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Footer One', 'bluishost' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title" data-animate="fadeInUp" data-delay=".0">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Two', 'bluishost' ),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title" data-animate="fadeInUp" data-delay=".15">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Three', 'bluishost' ),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title" data-animate="fadeInUp" data-delay=".4">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Four', 'bluishost' ),
        'id'            => 'footer-4',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title" data-animate="fadeInUp" data-delay=".19">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'bluishost_widgets_init' );