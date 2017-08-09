<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://exxica.com
 * @since      1.0.0
 *
 * @package    Exxica_Inbound_Marketing_Public
 * @subpackage Exxica_Inbound_Marketing_Public/public
 * @author     Gaute Rønningen <gaute@exxica.com>
 */
class Exxica_Inbound_Marketing_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->plugin_name.'-public', plugin_dir_url( __FILE__ ) . 'js/exxica-inbound-marketing-public.js', array( 'jquery' ), $this->version, FALSE );
		
		// Generate inbound links to use in JS
		$inbounds = array();
		$args = array(
			'post_type' => array( 'page', 'post', 'landing', 'house', 'cabin' ),
			'meta_query' => array(
				array(
					'key' => 'inbound_csv',
					'value' => '',
					'compare' => '!='
				)
			)
		);

		$the_query = new WP_Query( $args ); 
		if($the_query->have_posts()) : while($the_query->have_posts()) : $the_query->the_post();
			$inbound_csv = get_post_meta( $the_query->post->ID, 'inbound_csv', true );
			$inbounds[] = array(
				'ID' => $the_query->post->ID,
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'inbound' => (($inbound_csv !== "") ? preg_split("/\;/", $inbound_csv) : "no_links")
			);
		endwhile; endif;
		wp_reset_postdata();

		wp_localize_script( $this->plugin_name.'-public', 'ExxicaInbound', array(
				'links'          	=> 		$inbounds,
			)
		);
	}
}