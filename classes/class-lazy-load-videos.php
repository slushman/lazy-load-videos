<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 		1.0.0
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 * @author 		Slushman <chris@slushman.com>
 */
class Lazy_Load_Videos {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Lazy_Load_Videos_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the Lazy Load Videos and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name 	= 'lazy-load-videos';
		$this->version 		= '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_template_hooks();
		$this->define_metabox_hooks();
		$this->define_cpt_and_tax_hooks();

	} // __construct()

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Lazy_Load_Videos_Loader. Orchestrates the hooks of the plugin.
	 * - Lazy_Load_Videos_i18n. Defines internationalization functionality.
	 * - Lazy_Load_Videos_Admin. Defines all hooks for the admin area.
	 * - Lazy_Load_Videos_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-i18n.php';

		/**
		 * The class responsible for sanitizing user input
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-sanitizer.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-public.php';

		/**
		 * The class responsible for defining all actions relating to metaboxes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-metaboxes.php';

		/**
		 * The class responsible for defining all actions relating to the employee custom post type.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-video.php';

		/**
		 * The class responsible for defining all actions relating to the TaxonomyName taxonomy.
		 */
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-tax-taxonomyname.php';

		/**
		 * The class responsible for defining all actions creating the templates.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-templates.php';

		/**
		 * The class responsible for all global functions.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/global-functions.php';

		/**
		 * The class with methods shared by admin and public
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-shared.php';

		$this->loader 		= new Lazy_Load_Videos_Loader();
		$this->sanitizer 	= new Lazy_Load_Videos_Sanitize();

	} // load_dependencies()

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Lazy_Load_Videos_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Lazy_Load_Videos_i18n();

		$this->loader->action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	} // set_locale()

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Lazy_Load_Videos_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->action( 'admin_init', $plugin_admin, 'register_fields' );
		$this->loader->action( 'admin_init', $plugin_admin, 'register_sections' );
		$this->loader->action( 'admin_init', $plugin_admin, 'register_settings' );
		$this->loader->action( 'admin_menu', $plugin_admin, 'add_menu' );
		$this->loader->action( 'plugin_action_links_' . LAZY_LOAD_VIDEOS_FILE, $plugin_admin, 'link_settings' );
		$this->loader->action( 'plugin_row_meta', $plugin_admin, 'link_row_meta', 10, 2 );

	} // define_admin_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_cpt_and_tax_hooks() {

		$plugin_cpt_video = new Lazy_Load_Videos_CPT_Video( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'init', $plugin_cpt_video, 'new_cpt_video' );
		$this->loader->filter( 'manage_video_posts_columns', $plugin_cpt_video, 'video_register_columns' );
		$this->loader->action( 'manage_video_posts_custom_column', $plugin_cpt_video, 'video_column_content', 10, 2 );
		$this->loader->filter( 'manage_edit-video_sortable_columns', $plugin_cpt_video, 'video_sortable_columns', 10, 1 );
		$this->loader->action( 'request', $plugin_cpt_video, 'video_order_sorting', 10, 2 );
		$this->loader->action( 'init', $plugin_cpt_video, 'add_image_sizes' );


		//$plugin_tax_taxonomyname =new Lazy_Load_Videos_Tax_TaxonomyName( $this->get_plugin_name(), $this->get_version() );

		//$this->loader->action( 'init', $plugin_tax_taxonomyname, 'new_taxonomy_taxonomyname' );

	} // define_cpt_and_tax_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_metabox_hooks() {

		$plugin_metaboxes = new Lazy_Load_Videos_Admin_Metaboxes( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'add_meta_boxes_video', $plugin_metaboxes, 'add_metaboxes' );
		$this->loader->action( 'save_post_video', $plugin_metaboxes, 'validate_meta', 10, 2 );
		//$this->loader->action( 'edit_form_after_title', $plugin_metaboxes, 'metabox_subtitle', 10, 2 );
		$this->loader->action( 'add_meta_boxes_video', $plugin_metaboxes, 'set_meta' );
		$this->loader->filter( 'post_type_labels_video', $plugin_metaboxes, 'change_featured_image_labels', 10, 1 );

	} // define_metabox_hooks()

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Lazy_Load_Videos_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		//$this->loader->filter( 'single_template', $plugin_public, 'single_cpt_template', 11 );
		$this->loader->shortcode( 'llvideo', $plugin_public, 'shortcode_llvideo' );

		/**
		 * Action instead of template tag.
		 *
		 * do_action( 'actionname' );
		 * 		or
		 * echo apply_filters( 'actionname' );
		 *
		 * @link 	http://nacin.com/2010/05/18/rethinking-template-tags-in-plugins/
		 */
		$this->loader->action( 'llvideo', $plugin_public, 'shortcode_llvideo' );

	} // define_public_hooks()

	/**
	 * Register all of the hooks related to the templates.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_template_hooks() {

		$plugin_templates = new Lazy_Load_Videos_Templates();

		// Loop
		$this->loader->action( 'lazy-load-videos-before-loop-content', 	$plugin_templates, 'loop_content_wrap_begin', 10, 2 );

		$this->loader->action( 'lazy-load-videos-loop-content', 		$plugin_templates, 'loop_content_image', 10, 2 );

		$this->loader->action( 'lazy-load-videos-after-loop-content', 	$plugin_templates, 'loop_content_wrap_end', 90, 2 );

	} // define_template_hooks()

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();

	} // run()

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {

		return $this->plugin_name;

	} // get_plugin_name()

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 *
	 * @return    Lazy_Load_Videos_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;

	} // get_loader()

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;

	} // get_version()

} // class
