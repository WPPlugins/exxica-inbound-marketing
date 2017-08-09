<?php

/**
 * The plugin bootstrap file
 *
 * @link              http://exxica.com
 * @since             1.0.0
 * @package           Exxica_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Exxica Inbound Marketing
 * Plugin URI:        http://exxica.com/
 * Description:       A plugin to automatically create inbound marketing links.
 * Version:           1.0.2
 * Author:            Gaute Rønningen | EXXICA AS
 * Author URI:        http://exxica.com/
 * License:           http://exxica.com/license
 * Text Domain:       exxica-inbound-marketing
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-exxica-inbound-marketing-activator.php
 */
function activate_exxica_inbound_marketing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-exxica-inbound-marketing-activator.php';
	Exxica_Inbound_Marketing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-exxica-inbound-marketing-deactivator.php
 */
function deactivate_exxica_inbound_marketing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-exxica-inbound-marketing-deactivator.php';
	Exxica_Inbound_Marketing_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_exxica_inbound_marketing' );
register_deactivation_hook( __FILE__, 'deactivate_exxica_inbound_marketing' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-exxica-inbound-marketing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_exxica_inbound_marketing() {

	$plugin = new Exxica_Inbound_Marketing();
	$plugin->run();

}
run_exxica_inbound_marketing();
