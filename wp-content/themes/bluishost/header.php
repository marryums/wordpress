<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <?php 
    /**
     * Preloader Start
     *
     * @Hook bluishost_preloader
     *
     * @Hooked bluishost_site_preloader 10
     *
     */
    do_action( 'bluishost_preloader' );
    ?>
    
    <div class="wrapper">
    <?php 
    /**
     * Header Area Start
     * Header menu
     * 
     * @Hook bluishost_header
     *
     * @Hooked bluishost_header_cb 10
     */
	if( !is_page_template( 'template-comingsoon.php' ) ){
		do_action( 'bluishost_header' );
	}
	
    ?>