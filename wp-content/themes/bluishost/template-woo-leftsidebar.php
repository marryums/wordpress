<?php 
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 * Template Name: Shop Left Sidebar
 */
 
 get_header();
 ?>
 
    <section id="products" class="pt-120 woocommerce">
        <div class="container">
            <div class="row">
				<div class="col-lg-8 order-first">
					<div class="products row MasonryRow">
						<?php 
		                    $blogposts = new WP_Query( array(
		                        'post_type'         => 'product',
		                        'paged'             => get_query_var('paged') ? get_query_var('paged') : 1
		                    ) );
		                    // Woocommerce content
		                    if( $blogposts->have_posts() ){
		                        while( $blogposts->have_posts() ){
		                            $blogposts->the_post();
		                            
		                            wc_get_template_part( 'content', 'product' );
		                           
		                        }    
		                        wp_reset_postdata();
		                    }else{
		                        get_template_part( 'templates/content', 'none' );
		                    }
		                ?>
					</div>
					<div class="row">
	                    <div class="col-sm-12 posts--pager">
	                        <nav class="blog-page--pagination woocommerce-pagination">
	                            <div class="post-nav">
	                            <?php
	                                $total_pages = $blogposts->max_num_pages;

	                                if ($total_pages > 1){

	                                    $current_page = max(1, get_query_var('paged'));

	                                    echo paginate_links(array(
	                                        'base'      => get_pagenum_link(1) . '%_%',
	                                        'format'    => 'page/%#%',
	                                        'current'   => $current_page,
	                                        'total'     => $total_pages,
	                                        'prev_text'    => '<i class="fa fa-long-arrow-left"></i>',
	                                        'next_text'    => '<i class="fa fa-long-arrow-right"></i>',
	                                        'type'         => 'list' 
	                                    ));
	                                }
	                            ?>
	                            </div>
	                        </nav>
	                    </div>
	                </div>
				</div>
				
				<?php
					// sidebar
						get_sidebar( 'woo' );
				?>
			
			</div>
		</div>
	</section>

<?php
	// Woocommerce Section End
	get_footer();
?>