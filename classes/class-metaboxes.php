<?php
/**
 * The metabox-specific functionality of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 */

/**
 * The metabox-specific functionality of the plugin.
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 * @author 		Slushman <chris@slushman.com>
 */
class Plugin_Name_Admin_Metaboxes {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

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
	 * @var 		string 			$version 			The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$plugin_name 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

	}

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function add_metaboxes() {

		//remove_meta_box( 'postimagediv', 'employee', 'side' );

		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

		add_meta_box(
			'lazy_load_videos_video_info',
			apply_filters( $this->plugin_name . '-video-info-title', esc_html__( 'Video Info', 'lazy-load-videos' ) ),
			array( $this, 'metabox' ),
			'video',
			'normal',
			'default',
			array(
				'file' => 'video-info'
			)
		);

	} // add_metaboxes()

	/**
	 * Changes strings referencing Featured Images
	 *
	 * @see 		https://developer.wordpress.org/reference/hooks/post_type_labels_post_type/
	 *
	 * @param 		object 		$labels 		Current post type labels
	 * @return 		object 						Modified post type labels
	 */
	public function change_featured_image_labels( $labels ) {

		$labels->featured_image 		= 'Display Image';
		$labels->set_featured_image 	= 'Set display image';
		$labels->remove_featured_image 	= 'Remove display image';
		$labels->use_featured_image 	= 'Use as display image';

		return $labels;

	} // change_featured_image_labels()

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted ) {

		$nonces 		= array();
		$nonce_check 	= 0;

		$nonces[] 	= 'nonce_lazy_load_videos_video_info';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->plugin_name ) ) { $nonce_check++; }

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Calls a metabox file specified in the add_meta_box args.
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @return 	void
	 */
	public function metabox( $post, $params ) {

		if ( ! is_admin() ) { return; }
		if ( 'video' != $post->post_type ) { return; }

		include( plugin_dir_path( __FILE__ ) . 'views/view-metabox-' . $params['args']['file'] . '.php' );

	} // metabox()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( 'video' != $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Saves metabox data
	 *
	 * @since 		1.0.0
	 * @access 		public
	 *
	 * @param 		int 		$post_id 		The post ID
	 * @param 		object 		$post 			The post object
	 */
	public function validate_meta( $post_id, $post ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( 'video' != $post->post_type ) { return $post_id; }

		$nonce_check = $this->check_nonces( $_POST );

		if ( 0 < $nonce_check ) { return $post_id; }

		$metas = $this->get_metabox_fields();

		foreach ( $metas as $meta ) {

			$value 		= ( empty( $this->meta[$meta[0]][0] ) ? '' : $this->meta[$meta[0]][0] );
			$sanitizer 	= new Lazy_Load_Videos_Sanitize();

			$sanitizer->set_data( $_POST[$meta[0]] );
			$sanitizer->set_type( $meta[1] );

			$new_value = $sanitizer->clean();

			update_post_meta( $post_id, $meta[0], $new_value );

			unset( $sanitizer );

		} // foreach

	} // validate_meta()

} // class
