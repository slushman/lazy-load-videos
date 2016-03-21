<?php
/**
 * Globally-accessible functions
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 */

/**
 * Returns the requested SVG
 *
 * @param 	string 		$svg 		The name of the icon to return
 * @param 	string 		$link 		URL to link from the SVG
 *
 * @return 	mixed 					The SVG code
 */
function lazy_load_videos_get_svg( $svg ) {

	if ( empty( $svg ) ) { return; }

	$list = Lazy_Load_Videos_Public::get_svg_list();

	return $list[$svg];

} // lazy_load_videos_get_svg()

/**
 * Returns the path to a template file
 *
 * Looks for the file in these directories, in this order:
 * 		Current theme
 * 		Parent theme
 * 		Current theme employees folder
 * 		Parent theme employees folder
 * 		Current theme templates folder
 * 		Parent theme templates folder
 * 		Current theme views folder
 * 		Parent theme views folder
 * 		This plugin
 *
 * To use a custom list template in a theme, copy the
 * file from classes/views into a folder in your theme. The
 * folder can be named "employees", "templates", or "views".
 * Customize the files as needed, but keep the file name as-is. The
 * plugin will automatically use your custom template file instead
 * of the ones included in the plugin.
 *
 * @param 	string 		$name 			The name of a template file
 * @param 	string 		$location 		The subfolder containing the view
 *
 * @return 	string 						The path to the template
 */
function lazy_load_videos_get_template( $name, $location = '' ) {

	$template = '';

	$locations[] = "{$name}.php";
	$locations[] = "/lazy-load-videos/{$name}.php";
	$locations[] = "/templates/{$name}.php";
	$locations[] = "/views/{$name}.php";

	/**
	 * Filter the locations to search for a template file
	 *
	 * @param 	array 		$locations 			File names and/or paths to check
	 */
	$locations 	= apply_filters( 'lazy-load-videos-template-paths', $locations );
	$template 	= locate_template( $locations, TRUE );

	if ( empty( $template ) ) {

		if ( empty( $location ) ) {

			$template = plugin_dir_path( __FILE__ ) . 'views/' . $name . '.php';

		} else {

			$template = plugin_dir_path( __FILE__ ) . 'views/' . $location . '/' . $name . '.php';

		}

	}

	return $template;

} // lazy_load_videos_get_template()
