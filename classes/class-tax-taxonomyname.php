<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines a taxonomy and other related functionality.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 * @author		Slushman <chris@slushman.com>
 */
class Lazy_Load_Videos_Tax_TaxonomyName {

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
	 * Constructor
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

	} // __construct()

	/**
	 * Creates a new taxonomy for a custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	public static function new_taxonomy_taxonomy_name() {

		$plural 	= 'TaxonomyNames';
		$single 	= 'TaxonomyName';
		$tax_name 	= 'TaxonomyName';
		$cpt_name 	= 'posttypename';

		$opts['hierarchical']							= TRUE;
		//$opts['meta_box_cb'] 							= '';
		$opts['public']									= TRUE;
		$opts['query_var']								= $tax_name;
		$opts['show_admin_column'] 						= FALSE;
		$opts['show_in_nav_menus']						= TRUE;
		$opts['show_tag_cloud'] 						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		//$opts['update_count_callback'] 					= '';

		$opts['capabilities']['assign_terms'] 			= 'edit_posts';
		$opts['capabilities']['delete_terms'] 			= 'manage_categories';
		$opts['capabilities']['edit_terms'] 			= 'manage_categories';
		$opts['capabilities']['manage_terms'] 			= 'manage_categories';

		$opts['labels']['add_new_item'] 				= esc_html__( "Add New {$single}", 'lazy-load-videos' );
		$opts['labels']['add_or_remove_items'] 			= esc_html__( "Add or remove {$plural}", 'lazy-load-videos' );
		$opts['labels']['all_items'] 					= esc_html__( $plural, 'lazy-load-videos' );
		$opts['labels']['choose_from_most_used'] 		= esc_html__( "Choose from most used {$plural}", 'lazy-load-videos' );
		$opts['labels']['edit_item'] 					= esc_html__( "Edit {$single}" , 'lazy-load-videos');
		$opts['labels']['menu_name'] 					= esc_html__( $plural, 'lazy-load-videos' );
		$opts['labels']['name'] 						= esc_html__( $plural, 'lazy-load-videos' );
		$opts['labels']['new_item_name'] 				= esc_html__( "New {$single} Name", 'lazy-load-videos' );
		$opts['labels']['not_found'] 					= esc_html__( "No {$plural} Found", 'lazy-load-videos' );
		$opts['labels']['parent_item'] 					= esc_html__( "Parent {$single}", 'lazy-load-videos' );
		$opts['labels']['parent_item_colon'] 			= esc_html__( "Parent {$single}:", 'lazy-load-videos' );
		$opts['labels']['popular_items'] 				= esc_html__( "Popular {$plural}", 'lazy-load-videos' );
		$opts['labels']['search_items'] 				= esc_html__( "Search {$plural}", 'lazy-load-videos' );
		$opts['labels']['separate_items_with_commas'] 	= esc_html__( "Separate {$plural} with commas", 'lazy-load-videos' );
		$opts['labels']['singular_name'] 				= esc_html__( $single, 'lazy-load-videos' );
		$opts['labels']['update_item'] 					= esc_html__( "Update {$single}", 'lazy-load-videos' );
		$opts['labels']['view_item'] 					= esc_html__( "View {$single}", 'lazy-load-videos' );

		$opts['rewrite']['ep_mask']						= EP_NONE;
		$opts['rewrite']['hierarchical']				= FALSE;
		$opts['rewrite']['slug']						= esc_html__( $tax_name, 'lazy-load-videos' );
		$opts['rewrite']['with_front']					= FALSE;

		$opts = apply_filters( 'lazy-load-videos-taxonomy-taxonomy-name-options', $opts );

		register_taxonomy( $tax_name, $cpt_name, $opts );

	} // new_taxonomy_taxonomy_name()

} // class
