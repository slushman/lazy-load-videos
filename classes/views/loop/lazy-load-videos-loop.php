<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Lazy_Load_Videos
 * @subpackage Lazy_Load_Videos/classes/loop-views
 */

/**
 * lazy-load-videos-before-loop hook
 *
 * @hooked 		loop_wrap_start 		15
 */
do_action( 'lazy-load-videos-before-loop', $args );

foreach ( $items as $item ) {

	$meta = get_post_custom( $item->ID );

	/**
	 * lazy-load-videos-before-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		loop_content_wrap_begin 		10
	 * @hooked 		loop_content_link_begin 		15
	 */
	do_action( 'lazy-load-videos-before-loop-content', $item, $meta );

		/**
		 * lazy-load-videos-loop-content hook
		 *
		 * @param 		object  	$item 		The post object
		 *
		 * @hooked		loop_content_image 			10
		 */
		do_action( 'lazy-load-videos-loop-content', $item, $meta );

	/**
	 * lazy-load-videos-after-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		loop_content_link_end 		10
	 * @hooked 		loop_content_wrap_end 		90
	 */
	do_action( 'lazy-load-videos-after-loop-content', $item, $meta );

} // foreach

/**
 * lazy-load-videos-after-loop hook
 *
 * @hooked 		loop_wrap_end 			10
 */
do_action( 'lazy-load-videos-after-loop', $args );
