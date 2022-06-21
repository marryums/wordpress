<?php 
/**
 * @Packge     : Bluishost
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}


	// Remove template single related product from after summery 
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	/****************
		Shop Page
	****************/

	// Shop Page Product per page 
	add_filter( 'loop_shop_per_page', 'bluishost_loop_shop_per_page', 20 );
	function bluishost_loop_shop_per_page( $cols ) {

	  // Return the number of products you wanna show per page.
	  
		if( bluishost_opt( 'bluishost_woo_product_perpage' ) ){
			$num = bluishost_opt( 'bluishost_woo_product_perpage' );
		}else{
			$num = 10;
		}
	  
	  $cols = esc_html( $num );
	  return $cols;
	}

	// Show / Hide shop page title
	add_filter( 'woocommerce_show_page_title' , 'bluishost_hide_woo_page_title' );
	function bluishost_hide_woo_page_title() {
		
		if( bluishost_opt('bluishost_woo_shoptitle_switch') == false ){
			return false;
		}else{
			return true;
		}
		
	}
	
	// Override woocommerce_after_shop_loop_item_title hook

	
	add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
	function woo_custom_breadrumb_home_url() {
		return '';
	}
	
	
	//  WooCommerce Breadcrumb
	add_filter( 'woocommerce_breadcrumb_defaults', 'bluishost_woocommerce_breadcrumbs' );
	function bluishost_woocommerce_breadcrumbs() {
		$homeUrl = site_url('/');
		return array(
				'wrap_before' => '<ul class="custom-breadcrumb karla list-unstyled m-0" data-animate="fadeInUp" data-delay="1.4"><li class="breadcrumb-item"><a href="' . esc_url( get_home_url('/') ) . '">' . esc_attr( 'Home', 'bluishost' ) . '</a></li>',
				'wrap_after'  => '</ul>',
				'before'      => '<li class="active breadcrumb-item">',
				'after'       => '</li>',
				'home'        => '',
			);
	}
	
	// woo related products posts per page number
	add_filter( 'woocommerce_output_related_products_args', 'bluishost_related_products_args' );
	  function bluishost_related_products_args( $args ) {
		$args['posts_per_page'] = esc_html( bluishost_opt('bluishost_woo_relproduct_num') ); // 4 related products
		
		return $args;
	}

	// Check cart, checkout, my account page
	function bluishost_is_ccap(){
		if( is_bluishost_woocommerce_activated() ){
			if( is_cart() || 
			is_checkout() || 
			is_account_page() ){
				return true;
			}
		}else{
			return false;
		}

	}
	
?>