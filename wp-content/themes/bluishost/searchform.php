<?php 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
/**
 * @Packge    : Bluishost
 * @version   : 1.0
 * @Author    : ThemeLooks
 * @Author URI: https://www.themelooks.com/
 */
?>

<div class="search-form clearfix" data-animate="fadeInUp" data-delay=".1">
	<form class="parsley-validate" action="<?php echo esc_url( home_url('/') ); ?>" method="get">
		<input type="search" name="s" placeholder="<?php esc_html_e( 'I’m Looking For', 'bluishost' ); ?>" class="form-control" required>
		<button type="submit"><i class="fas fa-search"></i></button>
	</form>
</div>