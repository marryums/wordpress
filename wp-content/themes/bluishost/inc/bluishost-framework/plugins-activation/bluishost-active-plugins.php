<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme ecohost for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

require_once BLUISHOST_DIR_PATH_FRAM . 'plugins-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'bluishost_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function bluishost_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'                  => esc_html__( 'Bluishost Core', 'bluishost' ), // The plugin name
            'slug'                  => 'bluishost-core', // The plugin slug (typically the folder name)
            'version'               => '1.0',
            'source'                => BLUISHOST_DIR_PATH_FRAM . 'plugins/bluishost-core.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__( 'One Click Demo Importer', 'bluishost' ), // The plugin name
            'slug'                  => 'one-click-demo-import', // The plugin slug (typically the folder name)
            'version'               => '1.0',
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__( 'WPBakery Page Builder', 'bluishost'), // The plugin name
            'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
            'version'               => '',
            'source'                => 'https://themelooks.biz/activation-plugins/js_composer.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'      => esc_html__( 'Redux Framework', 'bluishost'),
            'slug'      => 'redux-framework',
            'version'   => '',
            'required'  => true
        ),
        array(
            'name'      => esc_html__( 'CMB2', 'bluishost'),
            'slug'      => 'cmb2',
            'version'   => '',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Contact Form 7', 'bluishost'),
            'slug'      => 'contact-form-7',
            'version'   => '',
            'required'  => true
        ),
        array(
            'name'      => esc_html__( 'WooCommerce', 'bluishost'),
            'slug'      => 'woocommerce',
            'version'   => '',
            'required'  => false
        ),
        array(
            'name'      => esc_html__( 'WHMCS Bridge', 'bluishost'),
            'slug'      => 'whmcs-bridge',
            'version'   => '',
            'required'  => false
        ),
        array(
            'name'      => esc_html__('Mega Menu', 'bluishost'),
            'slug'      => 'megamenu',
            'version'   => '',
            'required'  => false
        ),
        array(
            'name'      => esc_html__('All In One Seo Pack', 'bluishost'),
            'slug'      => 'all-in-one-seo-pack',
            'version'   => '',
            'required'  => false
        ),
        array(
            'name'      => esc_html__('Classic Editor', 'bluishost'),
            'slug'      => 'classic-editor',
            'version'   => '',
            'required'  => false
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'bluishost',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.


    );

    tgmpa( $plugins, $config );
}