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
?>

        <?php 
        /**
         * Footer Area
         *
         * @Footer
         * @Back To Top Button
         *
         * @Hook bluishost_footer
         *
         * @Hooked  bluishost_footer_area 10
         * @Hooked bluishost_back_to_top 20 
         *
         */
		if( !is_page_template( 'template-comingsoon.php' ) || !is_404() ){
			do_action( 'bluishost_footer' );
		}
        ?>
        
    </div>
    <!-- Wrapper End -->
    
    <?php wp_footer(); ?>
</body>
</html>