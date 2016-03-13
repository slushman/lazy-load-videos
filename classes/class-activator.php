<?php

/**
 * Fired during plugin activation
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since 		1.0.0
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 * @author 		Slushman <chris@slushman.com>
 */
class Lazy_Load_Videos_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-video.php';
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-tax-taxonomyname.php';

		Lazy_Load_Videos_CPT_Video::new_cpt_video();
		//Lazy_Load_Videos_Tax_TaxonomyName::new_taxonomy_taxonomyname();

		flush_rewrite_rules();

		$opts 		= array();
		$options 	= Lazy_Load_Videos_Admin::get_options_list();

		foreach ( $options as $option ) {

			$opts[ $option[0] ] = $option[2];

		}

		update_option( 'lazy-load-videos-options', $opts );

	} // activate()

} // class
