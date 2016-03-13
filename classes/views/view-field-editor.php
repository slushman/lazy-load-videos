<?php

/**
 * Provides the markup for any WP Editor field
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Lazy_Load_Videos
 * @subpackage Lazy_Load_Videos/classes/views
 */

// wp_editor( $content, $editor_id, $settings = array() );

wp_editor( $atts['value'], $atts['id'], $atts['settings'] );

?><span class="description"><?php esc_html_e( $atts['description'], 'lazy-load-videos' ); ?></span>