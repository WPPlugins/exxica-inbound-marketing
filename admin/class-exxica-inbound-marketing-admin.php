<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://exxica.com
 * @since      1.0.0
 *
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Exxica_Inbound_Marketing_Admin
 * @subpackage Exxica_Inbound_Marketing_Admin/admin
 * @author     Gaute Rønningen <gaute@exxica.com>
 */
class Exxica_Inbound_Marketing_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function add_inbound_meta_box() {
		$screens = array( 'page', 'post', 'landing', 'house', 'cabin' );

		foreach ( $screens as $screen ) {

			add_meta_box(
				'inbound_metabox',
				__( 'Inbound links', $this->plugin_name ),
				function( $post ) {
					wp_nonce_field( basename( __FILE__ ), 'inbound_metabox_nonce' );

					$attr = array(
						'q' => esc_attr( get_post_meta( $post->ID, 'inbound_csv', true )),
					);
					?>
					<p>
						<label for="on_frontpage"><?php _e( "Enter Inbound Link Words, separated by semicolon", $this->plugin_name ); ?></label><br/>
						<input type="text" style="width:100%;" name="inbound_csv" id="inbound_csv" value="<?= $attr['q'] ?>" />

						<p><?= __('Inbound Link Words are words that will connect this article to other articles throughout the site. Try to use unique words for every article on this entire site.', $this->plugin_name) ?></p>
					</p>
					<?php
				},
				$screen,
				'advanced',
				'high'
			);
		}
	}

	public function save_inbound_meta_box( $post_id ) {
		if(isset($_POST['inbound_metabox_nonce']) && !wp_verify_nonce( basename( __FILE__ ), $_POST['inbound_metabox_nonce'] ) ) {
			$inbound_csv = esc_attr($_POST['inbound_csv']);
			if(mb_substr($inbound_csv, -1) === ";") $inbound_csv = mb_substr($inbound_csv, strlen($inbound_csv) -1);
			update_post_meta( $post_id, 'inbound_csv', $inbound_csv);
		}
	}
}
