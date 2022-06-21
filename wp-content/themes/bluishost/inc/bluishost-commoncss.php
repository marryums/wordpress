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
 

// enqueue css
function bluishost_common_custom_css(){
    
    wp_enqueue_style( 'color-schemes', get_template_directory_uri().'/assets/css/color-schemes.css' );

		// main color
        $mainColor     = bluishost_opt( 'bluishost_unlimited-color' );
        $CustomCssOpt  = bluishost_opt( 'bluishost_css_editor' );

		if( $CustomCssOpt ){
			$CustomCssOpt = $CustomCssOpt;
		}else{
			$CustomCssOpt = '';
		}
		
		// page header media settings
		if( bluishost_meta( 'slide_header_active' ) == 'page_header' && bluishost_meta( 'page_header_settings' ) == 'global' ){
			// Global Settings
			$pagehederbgcolor 	= '';
			$pagehedertextcolor = '';
			$pagehederovcolor = bluishost_opt( 'bluishost_allHeader_ovbg' );
			$pagehederovopct  = bluishost_opt( 'bluishost_allHeader_ovopacity' );

			$bodyBgGrColor01 = bluishost_opt( 'bluishost_body_gradient_color_01' );
			$bodyBgGrColor02 = bluishost_opt( 'bluishost_body_gradient_color_02' );
			$bodyBgPattern   = bluishost_opt( 'bluishost_body_pattern', 'background-image');
			$bodybgcolor  	= bluishost_opt( 'bluishost_body_color', 'background-color');

			$footerBgGrColor01 = bluishost_opt( 'bluishost_footer_gradient_color_01' );
			$footerBgGrColor02 = bluishost_opt( 'bluishost_footer_gradient_color_02' );
			$footerBgPattern   = bluishost_opt( 'bluishost_footer_pattern', 'background-image');
			$footerbgcolor  	= bluishost_opt( 'bluishost_footer_color', 'background-color');
		}else{
			// Page Settings
			$pagehederbgcolor 	= bluishost_meta( 'header-bgcolor' );
			$pagehedertextcolor = bluishost_meta( 'header-textcolor' );
			$pagehederovcolor 	= bluishost_meta( 'header_overlaycolor' );
			$pagehederovopct  	= bluishost_meta( 'header_overlayopacity' );
			$bodyBgGrColor01 = bluishost_meta( 'body_gradient_color_one' );
			$bodyBgGrColor02 = bluishost_meta( 'body_gradient_color_two' );
			$bodyBgPattern   = bluishost_meta( 'body-patternbg');
			$bodybgcolor  	= bluishost_meta( 'body_bg_color', 'background-color');

			$footerBgGrColor01 = bluishost_meta( 'footer_gradient_color_one' );
			$footerBgGrColor02 = bluishost_meta( 'footer_gradient_color_two' );
			$footerBgPattern   = bluishost_meta( 'footer-patternbg');
			$footerbgcolor  	= bluishost_meta( 'footer_bg_color', 'background-color');
		}

		// Footer Setting 
		$footer_layout = get_post_meta( get_the_ID(), '_bluishost_footer_layout_switcher', true );

		if( $footer_layout == true ) {
			$footer_widget_title_color = bluishost_meta( 'footer_widget_title_color' );
			$footer_widget_color = bluishost_meta( 'footer_widget_color' );
			$footer_widget_anchor_color = bluishost_meta( 'footer_widget_anchor_color' );
			$footer_widget_anchor_hover_color = bluishost_meta( 'footer_widget_anchor_hover_color' );
		}else{
			$footer_widget_title_color = bluishost_opt( 'bluishost_footer_widget_title_color' );
			$footer_widget_color = bluishost_opt( 'bluishost_footer_widget_color' );
			$footer_widget_anchor_color = bluishost_opt( 'bluishost_footer_widget_icon_color' );
			$footer_widget_anchor_hover_color = bluishost_opt( 'bluishost_footer_widget_hov_color' );
		}

		// Page Background Image Overlay & Opacity
		$pagehederbgcolor 	= bluishost_meta( 'header-bgcolor' );

		// 404 page Options
		$fofovopct  = bluishost_opt( 'bluishost_fof_ovopacity' );

		$footeroverlay 	= bluishost_opt( 'bluishost_footer_widget_ovcolor' );
		$footerovopct  	= bluishost_opt( 'bluishost_footer_widget_ovopct' );
		
		
        $customcss ="
			a,
			.btn-transparent:hover,
			.header-menu ul ul li:hover > a, 
			.header-menu ul ul li > a:hover, 
			.header-menu ul ul li.active > a,
			.header-menu ul ul li a:before, 
			.header-menu ul ul li.active a:before, 
			.header-menu ul ul li:hover > a:before,
			.sticking .header-menu > ul > li:hover > a, 
			.header-menu > ul > li.active > a,
			.sticking .header-menu > ul > li.active > a,
			.sticking .btn-transparent,
			.review-info i,
			.post-content h3 a:hover,
			.post-content > a:hover,
			.back-to-top,
			.domain-price li > span,
			.contact-info li a:hover,
			.more-post li a:not(.disabled):hover,
			.sidebar-list li a:hover,
			.sidebar-list li a:hover i,
			.post-detail-content h2,
			.comment-content h4 a:hover,
			.comment-content > a:hover,
			.happy-counter li span,
			.post-author-info h4 a:hover,
			.ColorSwitcher__control,
			.sticking .header-menu #menu-button,
			.main-header.sticking .logo h2 a,
			.post-info a:hover,
			.domain-table tbody a:hover,
			aside .footer-posts h4 a:hover, 
			aside .footer-posts .sidebar-list li a:hover,
			.widget_categories ul li a:hover,
			.widget_archive ul li a:hover,
			.post-detail-content .post-info + h2,
			.woocommerce .star-rating span,
			.widget_product_categories ul li a:hover, .woocommerce-widget-layered-nav ul li a:hover {
				color: {$mainColor};
			}

			.bg-dark:before,
			.bg-primary:before,
			.title-bg-dark,
			.main-footer,
			.main-footer:before,
			.goDown,
			.sticking .header-menu > ul > li > a:after, 
			.sticking .header-menu > ul > li.active > a:after, 
			.sticking .header-menu > ul > li:hover > a:after,
			.sticking .btn-transparent:hover,
			.section-title h2:before,
			.single-pricing-plan p:before,
			.single-pricing-plan .popular,
			.swiper-pagination-bullet-active,
			.why-us-video:before,
			.preLoader,
			.single-home-feature h3:before,
			.bg-secondary:before,
			.sticky-tape:before, .sticky-tape:after,
			.domain-price li > span:before,
			.domain-table .thead-dark th,
			.search-form button:focus, 
			.search-form button:active, 
			.search-form button:hover,
			.widget-title:before,
			.tag-list li a:hover,
			.btn-primary:hover,
			.not-found-title,
			.back-to-top:hover,
			.woocommerce span.onsale,
			.search-form button:focus, 
			.search-form button:active, 
			.search-form button:hover, 
			.woocommerce-product-search button:hover, 
			.woocommerce-product-search button:focus, 
			.woocommerce-product-search button:active,
			.widget-title:before, .widget.woocommerce h2:before {
				background-color: {$mainColor};
			}

			.woocommerce .widget_shopping_cart .buttons a:hover, .woocommerce.widget_shopping_cart .buttons a:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, 
			.woocommerce .widget_shopping_cart .buttons a, .woocommerce.widget_shopping_cart .buttons a, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
			.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover, .product--details-tab-nav ul li a:hover, .product--details-tab-nav ul li.active a {
				background-color: {$mainColor};
			}

			.main-header.bg-secondary,
			.title-bg-dark,
			.tagcloud a:hover {
				background-color: {$mainColor}!important;
			}


			.btn-primary, .btn-primary:focus, .btn-primary.focus, .btn-primary.disabled, .btn-primary:disabled, 
			.btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, 
			.show > .btn-primary.dropdown-toggle, .btn-primary:not(:disabled):not(.disabled):active:focus, 
			.btn-primary:not(:disabled):not(.disabled).active:focus, .show > .btn-primary.dropdown-toggle:focus{
				background-color: {$mainColor}!important;
			}


			.form-control:focus,
			.sticking .btn-transparent,
			.subscribe-wrap form input:not([type=submit]),
			.domain-table .thead-dark th,
			.search-form button:focus, 
			.search-form button:active, 
			.search-form button:hover,
			.not-found-content form input[type=text]:focus,
			.subscribe-form input:not([type=submit]),
			.domain-checker input[type=submit],
			.contact-form input:focus,
			.contact-page-form input:not([type=checkbox]):not([type=submit]):focus,
			.woocommerce .woocommerce-ordering select:focus, 
			.woocommerce div.product form.cart .variations select:focus,
			.woocommerce-product-search input:focus,
			.search-form button:focus, 
			.search-form button:active, 
			.search-form button:hover, 
			.woocommerce-product-search button:hover, 
			.woocommerce-product-search button:focus, 
			.woocommerce-product-search button:active,
			.product--details-tab-nav ul,
			.pagination li a,
			.pagination li span,
			.woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus {
				border-color: {$mainColor};
			}

			.pricing-plans .row > div:nth-child(odd) .single-pricing-plan .popular:before,
			.header-menu .submenu-button:before,
			.header-menu #menu-button.menu-opened:before, 
			.header-menu .submenu-button.submenu-opened:before {
				border-top-color: {$mainColor};
			}

			.single-home-feature svg path,
			.single-feature svg path {
				fill: {$mainColor} !important;
			}
			
			.single-pricing-plan .popular:before,
			.single-feature {
				border-bottom-color: {$mainColor};
			}

			/* WHMCS Bridge */
			.whmcs--bridge #home-banner .btn.transfer,
			.whmcs--bridge .announcement-single > h3 > a,
			.whmcs--bridge .header-lined h1, 
			.whmcs--bridge .header-lined .breadcrumb > li > a:hover, 
			.whmcs--bridge .header-lined .breadcrumb > li.active {
				color: {$mainColor};
			}
			
			.whmcs--bridge .btn-primary,
			.whmcs--bridge #header .top-nav > li.primary-action > a,
			.whmcs--bridge .navbar-main,
			.whmcs--bridge .navbar-main .navbar-collapse,
			.whmcs--bridge #home-banner .btn.search,
			.whmcs--bridge .home-shortcuts,
			.whmcs--bridge #order-standard_cart .view-cart-items-header,
			.whmcs--bridge #order-standard_cart .empty-cart .btn {
				background-color: {$mainColor};
			}
			
			.whmcs--bridge .btn-primary,
			.whmcs--bridge .btn-success,
			.whmcs--bridge #order-standard_cart .view-cart-items {
				border-color: {$mainColor};
			}

			/* Page Header */
			.title-bg-dark.bg--overlay:before {
				background-color: {$pagehederovcolor};
				opacity: {$pagehederovopct};
			}

			.page-title h2, .page-title .custom-breadcrumb li a, .page-title .custom-breadcrumb li{
				color: {$pagehedertextcolor}!important;
			}

			/* 404 Page */
			.not-found-title.bg--overlay:before {
				opacity: {$fofovopct}
			}

			body {
			    background: {$bodybgcolor};
			    background-image: url({$bodyBgPattern});
			    background-image: url({$bodyBgPattern}), 
			    -webkit-linear-gradient(left, {$bodyBgGrColor01} 0%,{$bodyBgGrColor02} 100%);
			    background-image: url({$bodyBgPattern}), 
			    linear-gradient(to right, {$bodyBgGrColor01} 0%,{$bodyBgGrColor01}, {$bodyBgGrColor02} 100%);
			}

			.footer-widget .widget-title {
				color : {$footer_widget_title_color};
			}

			.footer-posts p, .footer-contacts ul li address, .footer-contacts ul li span, .footer-widget .textwidget p, .footer-form .col-submit, caption {
				color : {$footer_widget_color};
			}

			.footer-posts li:not(:last-child){
				border-color: {$footer_widget_color};
			}

			.footer-posts h4 a, .footer-posts p a, .footer-contacts ul li a, .footer-contacts ul li address, .footer-contacts ul li:last-child a {
				color : {$footer_widget_anchor_color};
			}

			.footer-posts h4 a:hover, .footer-posts p a:hover, .footer-contacts ul li a:hover, .footer-contacts ul li:last-child a:hover {
				color : {$footer_widget_anchor_hover_color};
			}

			.footer-gradient {
				background: {$footerbgcolor};
			    background-image: url({$footerBgPattern});
			    background-image: -webkit-linear-gradient(top, {$footerBgGrColor01} 0%,{$footerBgGrColor02} 100%);
			    background-image: url({$footerBgPattern}),linear-gradient(to bottom, {$footerBgGrColor02} 0%,{$footerBgGrColor02}, {$footerBgGrColor01} 100%);
			}
			
            {$CustomCssOpt}
        ";
	   
		if( !empty( bluishost_opt('bluishost_sticky_headermenu_bgcolor','background-color') ) ) {
			$bluishost_sticky_headermenu_bgcolor = bluishost_opt('bluishost_sticky_headermenu_bgcolor','background-color');
			$customcss .= "
				.sticky-wrapper .main-header.sticking {
					background-color: {$bluishost_sticky_headermenu_bgcolor} !important;
				}
			";
		}
		if( !empty( bluishost_opt('bluishost_header_menu_active_color') ) ) {
			$bluishost_header_menu_active_color = bluishost_opt('bluishost_header_menu_active_color');
			$customcss .= "
			.header-menu > ul > li.active > a:after {
					background-color: {$bluishost_header_menu_active_color} !important;
				}
			";
		}
		if( !empty( bluishost_opt('bluishost_sticky_header_menu_active_color') ) ) {
			$bluishost_sticky_header_menu_active_color = bluishost_opt('bluishost_sticky_header_menu_active_color');
			$customcss .= "
			.main-header.sticking .header-menu > ul > li.active > a:after {
					background-color: {$bluishost_sticky_header_menu_active_color} !important;
				}
			";
		}
    wp_add_inline_style( 'color-schemes', $customcss );
    
}
add_action( 'wp_enqueue_scripts', 'bluishost_common_custom_css', 50 );