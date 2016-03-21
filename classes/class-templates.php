<?php

if ( ! function_exists( 'Lazy_Load_Videos_templates' ) ) {

	/**
	 * Public API for adding and removing temmplates.
	 *
	 * @return 		object 			Instance of the templates class
	 */
	function Lazy_Load_Videos_templates() {

		return Lazy_Load_Videos_Templates::this();

	} // Lazy_Load_Videos_templates()

} // check

/**
 * The public-facing functionality of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the methods for creating the templates.
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 *
 */
class Lazy_Load_Videos_Templates {

	/**
	 * Private static reference to this class
	 * Useful for removing actions declared here.
	 *
	 * @var 	object 		$_this
 	 */
	private static $_this;

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    The plugin options.
	 */
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		self::$_this = $this;

		$this->set_options();

	} // __construct()

	/**
	 * Returns an array of the featured image details
	 *
	 * @param 	int 	$postID 		Post ID
	 * @return 	array 					Array of info about the featured image
	 */
	public function get_featured_images( $postID ) {

		if ( empty( $postID ) ) { return FALSE; }

		$imageID = get_post_thumbnail_id( $postID );

		if ( empty( $imageID ) ) { return FALSE; }

		return wp_prepare_attachment_for_js( $imageID );

	} // get_featured_images()

	/**
	 * Includes the featured image template file
	 */
	public function loop_content_image( $item, $meta = array() ) {

		include Lazy_Load_Videos_get_template( 'loop-content-image', 'loop' );

	} // loop_content_image()

	/**
	 * Includes the link start template file
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_link_begin( $item, $meta = array() ) {

		include Lazy_Load_Videos_get_template( 'loop-content-link-begin', 'loop' );

	} // loop_content_link_begin()

	/**
	 * Includes the link end template file
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_link_end( $item, $meta = array() ) {

		include Lazy_Load_Videos_get_template( 'loop-content-link-end', 'loop' );

	} // loop_content_link_end()

	/**
	 * Includes the meta field template file
	 */
	public function loop_content_meta_field( $item, $meta = array() ) {

		include Lazy_Load_Videos_get_template( 'loop-content-meta-field', 'loop' );

	} // loop_content_meta_field()

	/**
	 * Includes the post title template file
	 */
	public function loop_content_title( $item, $meta = array() ) {

		include Lazy_Load_Videos_get_template( 'loop-content-title', 'loop' );

	} // loop_content_title()

	/**
	 * Includes the content wrap start template file
	 *
	 * @hooked 		lazy-load-videos-before-loop-content 		10
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_wrap_begin( $item, $meta = array() ) {

		include Lazy_Load_Videos_get_template( 'loop-content-wrap-begin', 'loop' );

	} // loop_content_wrap_begin()

	/**
	 * Includes the content wrap end template file
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_wrap_end( $item, $meta = array() ) {

		include Lazy_Load_Videos_get_template( 'loop-content-wrap-end', 'loop' );

	} // loop_content_wrap_end()

	/**
	 * Includes the list wrap start template file and sets the value of $class.
	 *
	 * If the taxonomyname shortcode attribute is used, it sets $class as the
	 * taxonomyname or taxonomynames. Otherwise, $class is blank.
	 *
	 * @param 		array 		$args 		The shortcode attributes
	 */
	public function loop_wrap_begin( $args ) {

		if ( empty( $args['taxonomyname'] ) ) {

			$class = '';

		} elseif ( is_array( $args['taxonomyname'] ) ) {

			$class = str_replace( ',', ' ', $args['taxonomyname'] );

		} else {

			$class = $args['taxonomyname'];

		}

		include Lazy_Load_Videos_get_template( 'loop-wrap-begin', 'loop' );

	} // loop_wrap_begin()

	/**
	 * Includes the list wrap end template file
	 *
	 * @param 		array 		$args 		The shortcode attributes
	 */
	public function loop_wrap_end( $args ) {

		include Lazy_Load_Videos_get_template( 'loop-wrap-end', 'loop' );

	} // loop_wrap_end()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( 'lazy-load-videos-options' );

	} // set_options()

	/**
	 * Returns a reference to this class. Used for removing
	 * actions and/or filters declared here.
	 *
	 * @see  	http://hardcorewp.com/2012/enabling-action-and-filter-hook-removal-from-class-based-wordpress-plugins/
	 * @return 	object 		This class
	 */
	static function this() {

		return self::$_this;

	} // this()

} // class
