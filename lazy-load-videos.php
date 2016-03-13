<?php

/**
 * The plugin bootstrap file
 *
 * @link 				http://slushman.com
 * @since 				1.0.0
 * @package 			Lazy_Load_Videos
 *
 * @wordpress-plugin
 * Plugin Name: 		Lazy Load Videos
 * Plugin URI: 			http://slushman.com/lazy-load-videos/
 * Description: 		Displays an image instead of an embedded video. Loads and plays the video when the user clicks on it.
 * Version: 			1.0.0
 * Author: 				Slushman
 * Author URI: 			http://slushman.com/
 * License: 			GPL-2.0+
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 		lazy-load-videos
 * Domain Path: 		/assets/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

// Used for referring to the plugin file or basename
if ( ! defined( 'LAZY_LOAD_VIDEOS_FILE' ) ) {
	define( 'LAZY_LOAD_VIDEOS_FILE', plugin_basename( __FILE__ ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in classes/class-activator.php
 */
function activate_Lazy_Load_Videos() {

	require_once plugin_dir_path( __FILE__ ) . 'classes/class-activator.php';

	Lazy_Load_Videos_Activator::activate();

} // activate_Lazy_Load_Videos()

/**
 * The code that runs during plugin deactivation.
 * This action is documented in classes/class-deactivator.php
 */
function deactivate_Lazy_Load_Videos() {

	require_once plugin_dir_path( __FILE__ ) . 'classes/class-deactivator.php';

	Lazy_Load_Videos_Deactivator::deactivate();

} // deactivate_Lazy_Load_Videos()

register_activation_hook( __FILE__, 'activate_Lazy_Load_Videos' );
register_deactivation_hook( __FILE__, 'deactivate_Lazy_Load_Videos' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'classes/class-lazy-load-videos.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Lazy_Load_Videos() {

	$plugin = new Lazy_Load_Videos();
	$plugin->run();

} // run_Lazy_Load_Videos()

run_Lazy_Load_Videos();
