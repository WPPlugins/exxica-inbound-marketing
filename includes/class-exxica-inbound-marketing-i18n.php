<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://exxica.com
 * @since      1.0.0
 *
 * @package    Exxica_Inbound_Marketing_i18n
 * @subpackage Exxica_Inbound_Marketing_i18n/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Exxica_Inbound_Marketing_i18n
 * @subpackage Exxica_Inbound_Marketing_i18n/includes
 * @author     Gaute Rønningen <gaute@exxica.com>
 */
class Exxica_Inbound_Marketing_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'exxica-inbound-marketing',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
