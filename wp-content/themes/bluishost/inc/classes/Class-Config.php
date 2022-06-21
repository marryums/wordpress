<?php 
/**
 * @Packge 	   : Bluishost
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	// Final Class
	final class Bluishost {

		// Theme Version
		private $bluishost_version = '1.0';

		// Minimum WordPress Version required
		private $min_wp = '4.0';

		// Minimum PHP version required 
		private $min_php = '5.6.25';

		// Theme init
		public function init(){
			
			$this->setup();
		}

		// Theme setup
		private function setup(){
			
			// Create enqueue class instance
			$enqueu = new bluishost_Enqueue();
			$enqueu->scripts = $this->enqueue() ;
			$enqueu->bluishost_scripts_enqueue_init() ;

		}
		// Theme Support
		public function support(){
			// content width
	        $GLOBALS['content_width'] = apply_filters( 'bluishost_content_width', 751 );

	        
	        // text domain for translation.
	        load_theme_textdomain( 'bluishost', BLUISHOST_DIR_PATH . '/languages' );
	        
	        // support title tage
	        add_theme_support( 'title-tag' );
	        
	        // support logo
	        add_theme_support( 'custom-logo' );
	        
	        //  support post format
	        add_theme_support( 'post-formats', array( 'video','audio' ) );
	        
	        // support post-thumbnails
	        add_theme_support( 'post-thumbnails', array( 'post' ) );
			
			// Custom post thumbnails size
			add_image_size( 'bluishost_post_widget_thumb', 80, 100, true );
			// Custom data center thumbnails size
			add_image_size( 'bluishost_post_datacenter_thumb', 100, 80, true );

	        // support custom background 
	        add_theme_support( 'custom-background' );
	        
	        // support custom header
	        add_theme_support( 'custom-header' );
	        
	        // support automatic feed links
	        add_theme_support( 'automatic-feed-links' );

	        // support widget refersh
	        add_theme_support( 'customize-selective-refresh-widgets' );
	        
	        // support html5
	        add_theme_support( 'html5' );
			
			// woocommerce support
			add_theme_support('woocommerce');

			// Add support for full & wide align images
			add_theme_support('align-wide');

			// woo product gallery zoom, lightbox, slider support
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
	                
	        // register nav menu
	        register_nav_menus( array(
	            'primary-menu'   => esc_html__( 'Primary Menu', 'bluishost' ),
	            'footer-menu'    => esc_html__( 'Footer Menu', 'bluishost' ),
	        ) );

			// editor style
			// Add support for editor styles.
			add_theme_support( 'editor-styles' );
	        add_editor_style( array( 'assets/css/editor-style.css',$this->google_font() ) );

		} // end support method

		// enqueue theme style and script
		private function enqueue(){

			$cssPath = BLUISHOST_DIR_CSS_URI;
			$jsPath  = BLUISHOST_DIR_JS_URI;
			$apiKey	 = bluishost_opt('bluishost_map_apikey');
			
			$bootRtl = array();
			
			if( is_rtl() ){
				$bootRtl = 	array(
					'handler'		=> 'bootstrap-rtl',
					'file' 			=> $cssPath.'bootstrap.rtl.min.css',
					'dependency' 	=> array(),
					'version' 		=> '3.3.7',
				);
			}

			$megamenuStyle = array();

			if ( function_exists( 'max_mega_menu_is_enabled' ) ) {
				$megamenuStyle = array(
					'handler'		=> 'bluishost-mega-menu',
					'file' 			=> $cssPath.'mega-menu.css',
					'dependency' 	=> array(),
					'version' 		=> '1.0.0',
				);
			}

			$defaultSubment = array();

			if ( !function_exists( 'max_mega_menu_is_enabled' ) ) {
				$defaultSubment = array(
					'handler'		=> 'bluishost-menu',
					'file' 			=> $jsPath.'menu.js',
					'dependency' 	=> array( 'jquery' ),
					'version' 		=> '2.2.0',
					'in_footer' 	=> true
				);
			}
						
			$scripts = array(
				'style' => array(
					array(
						'handler'		=> 'google-font',
						'file' 			=> $this->google_font(),
					),
					array(
						'handler'		=> 'fontawesome-all',
						'file' 			=> $cssPath.'fontawesome-all.min.css',
						'dependency' 	=> array(),
						'version' 		=> '5.0.6',
					),
					array(
						'handler'		=> 'font-awesome',
						'file' 			=> $cssPath.'font-awesome.min.css',
						'dependency' 	=> array(),
						'version' 		=> '4.7.0',
					),
					array(
						'handler'		=> 'bootstrap',
						'file' 			=> $cssPath.'bootstrap.min.css',
						'dependency' 	=> array(),
						'version' 		=> '3.3.7',
					),
					$bootRtl,
					array(
						'handler'		=> 'swiper',
						'file' 			=> $cssPath.'swiper.min.css',
						'dependency' 	=> array(),
						'version' 		=> '2.2.0',
					),
					array(
						'handler'		=> 'magnific-popup',
						'file' 			=> $cssPath.'magnific-popup.min.css',
						'dependency' 	=> array(),
						'version' 		=> '2.2.0',
					),
					array(
						'handler'		=> 'animate',
						'file' 			=> $cssPath.'animate.min.css',
						'dependency' 	=> array(),
						'version' 		=> '2.2.0',
					),
					array(
						'handler'		=> 'owl-carousel',
						'file' 			=> $cssPath.'owl.carousel.min.css',
						'dependency' 	=> array(),
						'version' 		=> '2.3.4',
					),
					array(
						'handler'		=> 'bluishost-main',
						'file' 			=> $cssPath.'style.css',
						'dependency' 	=> array(),
						'version' 		=> $this->bluishost_version,
					),
					array(
						'handler'		=> 'bluishost-responsive',
						'file' 			=> $cssPath.'responsive.css',
						'dependency' 	=> array(),
						'version' 		=> $this->bluishost_version,
					),
					$megamenuStyle,
					array(
						'handler'		=> 'bluishost-style',
						'file' 			=> get_stylesheet_uri(),
					),
				),
				'scripts' => array(
					array(
						'handler'		=> 'bootstrap-bundle',
						'file' 			=> $jsPath.'bootstrap.bundle.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '3.7.3',
						'in_footer' 	=> true,
					),
					array(
						'handler'		=> 'swiper',
						'file' 			=> $jsPath.'swiper.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.4.2',
						'in_footer' 	=> true,
					),

					array(
						'handler'		=> 'maps-googleapis',
						'register'		=> true,
						'file' 			=> '//maps.googleapis.com/maps/api/js?key='.$apiKey,
					),
					array(
						'handler'		=> 'magnific-popup',
						'file' 			=> $jsPath.'jquery.magnific-popup.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '3.3.7',
						'in_footer' 	=> true,
					),
					array(
						'handler'		=> 'isotope',
						'file' 			=> $jsPath.'isotope.pkgd.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '3.0.6',
						'in_footer' 	=> true,
					),
					array(
						'handler'		=> 'parsley',
						'file' 			=> $jsPath.'parsley.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0.4',
						'in_footer' 	=> true
					),

					array(
						'handler'		=> 'waypoints',
						'file' 			=> $jsPath.'jquery.waypoints.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '4.0.1',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'owl-carousel',
						'file' 			=> $jsPath.'owl.carousel.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '2.3.4',
						'in_footer' 	=> true
					),

					array(
						'handler'		=> 'tubular',
						'file' 			=> $jsPath.'jquery.tubular.1.0.js',
						'dependency' 	=> array( 'jquery' ),
						'register'		=> true,
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					
					array(
						'handler'		=> 'menu-script',
						'file' 			=> $jsPath.'menu.js',
						'dependency' 	=> array( 'jquery' ),
						'register'		=> true,
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					
					array(
						'handler'		=> 'bluishost-sticky',
						'file' 			=> $jsPath.'sticky.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					$defaultSubment,
					array(
						'handler'		=> 'bluishost-script',
						'file' 			=> $jsPath.'main.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '3.0.2',
						'in_footer' 	=> true
					),
				)
			);

				
			return $scripts;

		} // end enqueu method 

		// Google Font  
		private function google_font(){

			$font_families = array(
				'Poppins:400,400i,500,700',
				'Karla:400'
			);

			$familyArgs = array(
				'family' => htmlentities( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin, latin-text' ),
			);

			$fontUrl = add_query_arg( $familyArgs, '//fonts.googleapis.com/css' );

			return esc_url_raw( $fontUrl );

		} //End google_font method

	} // End SSD_Host Class
?>