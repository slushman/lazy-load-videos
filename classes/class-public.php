<?php

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
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 * @author 		Slushman <chris@slushman.com>
 */
class Lazy_Load_Videos_Public {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options 		The plugin options.
	 */
	private $options;

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

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

		$this->set_options();
		$this->set_meta();

	} // __construct()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/lazy-load-videos-public.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/lazy-load-videos-public.js', array( 'jquery' ), $this->version, true );

	} // enqueue_scripts()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( 'posttypename' !== $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

	/**
	 * Processes shortcode employeelist
	 *
	 * @param 	array 	$atts 		Shortcode attributes
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function shortcode_shortcodename( $atts = array() ) {

		ob_start();

		$defaults['department'] 	= '';
		$defaults['loop-template'] 	= $this->plugin_name . '-loop';
		$defaults['order'] 			= 'ASC';
		$defaults['quantity'] 		= 100;
		$defaults['show'] 			= '';
		$args						= shortcode_atts( $defaults, $atts, 'shortcodename' );
		$shared 					= new Lazy_Load_Videos_Shared( $this->plugin_name, $this->version );
		$items 						= $shared->query( $args );

		if ( is_array( $items ) || is_object( $items ) ) {

			include Lazy_Load_Videos_get_template( $args['loop-template'], 'loop' );

		} else {

			echo $items;

		}

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode_shortcodename()

} // class
