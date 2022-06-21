<?php 
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
 get_header();
 

	if( !is_product() ){
		$sidebar = bluishost_opt('bluishost_woo_shoppage_sidebar');
	}else{
		$sidebar = bluishost_opt('bluishost_woo_singlepage_sidebar');
	}
 
 ?>
 
    <section id="products" class="pt-120">
        <div class="container">
            <div class="row">
				<?php 
					if( $sidebar == '1' ){
						echo '<div class="col-lg-12">';
					}else{
						echo '<div class="col-lg-8 '.esc_attr( bluishost_pull_right( $sidebar ,'2' ) ).' ">';
					}
				?>
				
				<?php 
					if( have_posts() ){
						echo "<div class='woo-content-wrap'>";
						
						// Woocommerce Content
						woocommerce_content();
						
						echo "</div>";
					}else{
						get_template_part( 'templates/content', 'none' );
					}
				
					if( is_product() ){
						woocommerce_output_related_products();
					}
				?>
				
				</div>
				
				<?php
					// sidebar
					if( $sidebar != '1' ){
						get_sidebar( 'woo' );
					}
				?>
			
			</div>
		</div>
	</section>

<?php
	// Woocommerce Section End
	get_footer();
?>