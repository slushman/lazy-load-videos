<?php

/**
 * Shared methods
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 */

class Lazy_Load_Videos_Shared {

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 		The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @var 		string 			$plugin_name 			The name of this plugin.
	 * @var 		string 			$version 				The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

	} // __construct()

	/**
	 * Returns a cache name based on the attributes.
	 *
	 * @param 	array 		$args 			The WP_Query args
	 * @param   string 		$cache 			Optional cache name
	 *
	 * @return 	string 						The cache name
	 */
	private function get_cache_name( $args, $cache = '' ) {

		if ( empty( $args ) ) { return ''; }

		$return = $this->plugin_name . '_Lazy_Load_Videos';

		if ( ! empty( $cache ) ) {

			$return = $this->plugin_name . $cache . '_Lazy_Load_Videos';

		}

		if ( ! empty( $args['taxonomyname'] ) ) {

			$return = $this->plugin_name . $cache . $args['taxonomyname'] . '_Lazy_Load_Videos';

		}

		return $return;

	} // get_cache_name()

	/**
	 * Returns a post object of employee posts
	 *
	 * Check for cache first, if it exists, returns that
	 * If not, gets the ordered posts, collects their IDS,
	 * sets those as post__not_in for the unordered posts.
	 * Gets the unordered posts. Merges both into one array
	 *
	 * @param 	array 		$params 			An array of optional parameters
	 * @param 	string 		$cache 				String to create a new cache of posts
	 *
	 * @return 	object 		A post object
	 */
	public function query( $params = array(), $cache = '' ) {

		$return 	= '';
		$cache_name = $this->get_cache_name( $params, $cache );
		$return 	= wp_cache_get( $cache_name, $this->plugin_name . '_posts' );

		if ( false === $return ) {

			// get posts
			// If empty, display none-found-msg
			// If not, set cache, the return




			$options 				= get_option( $this->plugin_name . '-options' );
			$posts 					=
			$ordered 				= $this->get_ordered_Lazy_Load_Videos( $params );
			$ordered_ids 			= $this->get_ids( $ordered );
			$params['post__not_in'] = $ordered_ids;
			$unordered 				= $this->get_unordered_Lazy_Load_Videos( $params );

			if ( is_wp_error( $ordered )
				&& empty( $ordered )
				&& is_wp_error( $unordered )
				&& empty( $unordered ) ) {

				$options 	= get_option( $this->plugin_name . '-options' );
				$return 	= $options['none-found-message'];

			} else {

				if ( empty( $ordered->posts ) && ! empty( $unordered->posts ) ) {

					$query = $unordered->posts;

				} elseif ( ! empty( $ordered->posts ) && empty( $unordered->posts ) ) {

					$query = $ordered->posts;

				} else {

					$query = array_merge( $ordered->posts, $unordered->posts );

				}

				wp_cache_set( $cache_name, $query, $this->plugin_name . '_posts', 5 * MINUTE_IN_SECONDS );

				$return = $query;

			}

		}

		return $return;

	} // query()

	/**
	 * Sets the args array for a WP_Query call
	 *
	 * @param 	array 		$params 		Array of shortcode parameters
	 * @return 	array 						An array of parameters for WP_Query
	 */
	private function set_args( $params ) {

		if ( empty( $params ) ) { return; }

		$args = array();

		$args['no_found_rows']				= true;
		$args['order'] 						= $params['order'];
		$args['post_type'] 					= 'posttypename';
		$args['post_status'] 				= 'publish';
		$args['posts_per_page'] 			= absint( $params['quantity'] );
		$args['update_post_term_cache'] 	= false;

		unset( $params['order'] );
		unset( $params['quantity'] );
		unset( $params['listview'] );
		unset( $params['singleview'] );

		if ( empty( $params ) ) { return $args; }

		if ( ! empty( $params['taxonomyname'] ) ) {

			$args['tax_query'][0]['field'] 		= 'slug';
			$args['tax_query'][0]['taxonomy'] 	= 'taxonomyname';
			$args['tax_query'][0]['terms'] 		= $params['taxonomyname'];

			unset( $args['taxonomyname'] );

		}

		$args = wp_parse_args( $params, $args );

		return $args;

	} // set_args()

} // class
