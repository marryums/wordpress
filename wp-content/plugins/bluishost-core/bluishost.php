<?php
/**
 * Plugin Name: Bluishost Core
 * Description: This is a helper plugin of bluishost theme
 * Version:     1.9
 * Author:      Themelooks
 * Author URI:  https://themelooks.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: bluishost
 */
     // Blocking direct access
    if( ! defined( 'ABSPATH' ) ) {
        exit();
    }

    require_once "BluishostBase.php";

    register_activation_hook( __FILE__,'bluishost_admin_notice_activation_hook' );

    function bluishost_admin_notice_activation_hook(  ){
        set_transient( 'bluishost-admin-notice', 'yes', 0 );
    }

    function bluishost_plugin_activated_notices( ) {
        if( get_transient( 'bluishost-admin-notice' ) ){
            printf('<div class="notice notice-warning is-dismissible"><h3>Warning!</h3><p><strong>'.esc_html__('Please activate your license to get full access to the theme, import demo data, core features, updates, premium support, etc.','bluishost').'</strong></p><p><a class="button button-primary" href="'.admin_url('/admin.php?page=bluishost_licence').'">'.esc_html__('Active License','bluishost').'</a></p></div>');
        }
    }
    add_action('admin_notices','bluishost_plugin_activated_notices');

	class Bluishost_Core_Plugin {
        public $plugin_file=__FILE__;
        public $responseObj;
        public $licenseMessage;
        public $showMessage=false;
        public $slug="bluishost_licence";
        function __construct() {
            add_action( 'admin_print_styles', [ $this, 'SetAdminStyle' ] );
            require_once plugin_dir_path( __FILE__ ) . 'demo-data/demo-import.php';
    	    $licenseKey=get_option("Bluishost_lic_Key","");
    	    $liceEmail=get_option( "Bluishost_lic_email","");
    	    if(BluishostBase::CheckWPPlugin($licenseKey,$liceEmail,$this->licenseMessage,$this->responseObj,__FILE__)){
                add_action( 'admin_menu', [$this,'ActiveAdminMenu']);
                add_action('admin_enqueue_scripts',[ $this, 'bluishostadminyesbasescripts']);
                require_once "bluishost-core.php";
                delete_transient( 'bluishost-admin-notice' );
    		    add_action( 'admin_post_Bluishost_el_deactivate_license', [ $this, 'action_deactivate_license' ] );
    	    }else{
    	        if(!empty($licenseKey) && !empty($this->licenseMessage)){
    	           $this->showMessage=true;
                }
    		    update_option("Bluishost_lic_Key","") || add_option("Bluishost_lic_Key","");
                add_action( 'admin_post_Bluishost_el_activate_license', [ $this, 'action_activate_license' ] );
                add_action('admin_enqueue_scripts',[ $this, 'bluishostadminnobasescripts']);
                add_action( 'admin_menu', [$this,'InactiveMenu']);
    	    }
        }
    	function SetAdminStyle() {
    		wp_register_style( "BluishostLic", plugins_url("assets/css/style.css",$this->plugin_file),10);
    		wp_enqueue_style( "BluishostLic" );
    	}
        function ActiveAdminMenu(){
    	    add_menu_page (  "Bluishost Licensing", "Bluishost Licensing", 'activate_plugins', $this->slug, [$this,"Activated"], plugins_url('bluishost-core/img/favicon.png'));
        }
        function InactiveMenu() {
    	    add_menu_page( "Bluishost Licensing", "Bluishost Licensing", 'activate_plugins', $this->slug,  [$this,"LicenseForm"], plugins_url('bluishost-core/img/favicon.png') );

        }
        function bluishostadminyesbasescripts( ) {
            if( isset( $_GET['page'] ) && $_GET['page'] == 'bluishost-demo-import' ){
                wp_enqueue_script( 'bluishostbase-script', plugin_dir_url( __FILE__ ) . '/assets/js/bluishostbase.js', array('jquery'), '1.0', true );
                wp_localize_script( 'bluishostbase-script', 'bluishostbase', array(
                    'basevalue'     => '100'
                ) );
            }
        }
        function bluishostadminnobasescripts( ) {
            if( isset( $_GET['page'] ) && $_GET['page'] == 'bluishost-demo-import' ){
                wp_enqueue_script( 'bluishostbase-script', plugin_dir_url( __FILE__ ) . '/assets/js/bluishostbase.js', array('jquery'), '1.0', true );
                wp_localize_script( 'bluishostbase-script', 'bluishostbase', array(
                    'basevalue'     => '110'
                ) );
            }
        }
        function action_activate_license(){
        		check_admin_referer( 'el-license' );
        		$licenseKey=!empty($_POST['el_license_key'])?$_POST['el_license_key']:"";
                $licenseEmail=!empty($_POST['el_license_email'])?$_POST['el_license_email']:"";
        		update_option("Bluishost_lic_Key",$licenseKey) || add_option("Bluishost_lic_Key",$licenseKey);
        		update_option("Bluishost_lic_email",$licenseEmail) || add_option("Bluishost_lic_email",$licenseEmail);
        		wp_safe_redirect(admin_url( 'admin.php?page='.$this->slug));
        	}
        function action_deactivate_license() {
    	    check_admin_referer( 'el-license' );
    	    if(BluishostBase::RemoveLicenseKey(__FILE__,$message)){
                update_option("Bluishost_lic_Key","") || add_option("Bluishost_lic_Key","");
                deactivate_plugins( '/bluishost-core/bluishost.php' );
                wp_safe_redirect(admin_url( 'plugins.php' ));
    	    } else {
    	        wp_safe_redirect(admin_url( 'admin.php?page='.$this->slug));
    	    }
        }
        function Activated(){
            ?>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="Bluishost_el_deactivate_license"/>
                <div class="el-license-container">
                    <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php esc_html_e('Bluishost License Info','bluishost'); ?></h3>
                    <hr>
                    <ul class="el-license-info">
                    <li>
                        <div>
                            <span class="el-license-info-title"><?php esc_html_e('Status','bluishost'); ?></span>

    			            <?php if ( $this->responseObj->is_valid ) : ?>
                                <span class="el-license-valid"><?php esc_html_e('Valid','bluishost'); ?></span>
    			            <?php else : ?>
                                <span class="el-license-valid"><?php esc_html_e('Invalid','bluishost'); ?></span>
    			            <?php endif; ?>
                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="el-license-info-title"><?php esc_html_e('License Type','bluishost'); ?></span>
    			            <?php echo $this->responseObj->license_title; ?>
                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="el-license-info-title"><?php esc_html_e('License Expired on','bluishost'); ?></span>
    			            <?php echo $this->responseObj->expire_date; ?>
                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="el-license-info-title"><?php esc_html_e('Support Expired on','bluishost'); ?></span>
    			            <?php echo $this->responseObj->support_end; ?>
                        </div>
                    </li>
                        <li>
                            <div>
                                <span class="el-license-info-title"><?php esc_html_e('Your License Key','bluishost'); ?></span>
                                <span class="el-license-key"><?php echo esc_attr( substr($this->responseObj->license_key,0,9)."XXXXXXXX-XXXXXXXX".substr($this->responseObj->license_key,-9) ); ?></span>
                            </div>
                        </li>
                    </ul>
                    <div class="el-license-active-btn">
    				    <?php wp_nonce_field( 'el-license' ); ?>
    				    <?php submit_button('Deactivate'); ?>
                    </div>
                </div>
            </form>
    	<?php
        }

        function LicenseForm() {
    	    ?>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        	    <input type="hidden" name="action" value="Bluishost_el_activate_license"/>
        	    <div class="el-license-container">
        		    <h3 class="el-license-title"> <?php _e("Bluishost Licensing","bluishost");?></h3>
        		    <hr>
                    <?php
                    if(!empty($this->showMessage) && !empty($this->licenseMessage)){
                        ?>
                        <div class="notice notice-error is-dismissible">
                            <p><?php echo _e($this->licenseMessage,"bluishost"); ?></p>
                        </div>
                        <?php
                    }
                    ?>
        		    <p><?php _e("Enter your license key here, to activate the product, and get full feature updates and premium support.","bluishost");?></p>
                    <div class="license-wrapper">
                        <div class="single-license-wrapper">
                            <h3><?php _e("Regular License","bluishost");?></h3>
                            <ol>
                                <li><?php echo esc_html__('Login To Your ',"bluishost").'<a href="'.esc_url( 'https://account.envato.com/' ).'">'.esc_html__('Envato Account','bluishost').'</a>'; ?></li>
                                <li><?php echo esc_html__('Download your License certificate & purchase code (text) from here ','bluishost').'<a target="_blank" href="'.esc_url( 'https://themeforest.net/downloads' ).'">'.esc_html__('themeforest.net/downloads','bluishost').'</a>'; ?>
                                <?php echo esc_html__('(Check out the ',"bluishost").'<a target="_blank" href="'.esc_url( 'http://prntscr.com/gja0gk' ).'">'.esc_html__('Screenshot','bluishost').'</a>'; ?></li>
                                <li><?php _e("Get Your License Key","bluishost");?></li>
                            </ol>
                        </div>
                        <div class="membership-license-wrapper">
                            <h3><?php _e("Extended License","bluishost");?></h3>
                            <ol>
                                <li><?php echo esc_html__('Login To Your ',"bluishost").'<a href="'.esc_url( 'https://account.envato.com/' ).'">'.esc_html__('Envato Account','bluishost').'</a>'; ?></li>
                                <li><?php echo esc_html__('Download your License certificate & purchase code (text) from here ','bluishost').'<a target="_blank" href="'.esc_url( 'https://themeforest.net/downloads' ).'">'.esc_html__('themeforest.net/downloads','bluishost').'</a>'; ?>
                                <?php echo esc_html__('(Check out the ',"bluishost").'<a target="_blank" href="'.esc_url( 'http://prntscr.com/gja0gk' ).'">'.esc_html__('Screenshot','bluishost').'</a>'; ?></li>
                                <li><?php _e("Get Your License Key","bluishost");?></li>
                            </ol>
                        </div>
                    </div>
                    <hr/>
        		    <div class="el-license-field">
        			    <label for="el_license_key"><?php _e("License code","bluishost");?></label>
        			    <input type="text" class="regular-text code" name="el_license_key" size="50" placeholder="xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx" required="required">
        		    </div>
                    <div class="el-license-field">
                        <label for="el_license_key"><?php _e("Email Address","bluishost");?></label>
                        <?php
                            $purchaseEmail   = get_option( "bluishost_lic_email", get_bloginfo( 'admin_email' ));
                        ?>
                        <input type="text" class="regular-text code" name="el_license_email" size="50" value="<?php echo $purchaseEmail; ?>" placeholder="" required="required">
                        <div><small><?php _e("We will send update news of this product by this email address, don't worry, we hate spam","bluishost");?></small></div>
                    </div>
        		    <div class="el-license-active-btn">
        			    <?php wp_nonce_field( 'el-license' ); ?>
        			    <?php submit_button('Activate'); ?>
        		    </div>
        	    </div>
            </form>
    	    <?php
        }
    }

    new Bluishost_Core_Plugin();