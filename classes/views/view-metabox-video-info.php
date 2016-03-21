<?php

/**
 * Displays the video info metabox
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Lazy_Load_Videos
 * @subpackage Lazy_Load_Videos/classes/views
 */

wp_nonce_field( $this->plugin_name, 'nonce_lazy_load_videos_video_info' );

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'video-url';
$atts['label'] 			= 'Video URL';
$atts['name'] 			= 'video-url';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'url';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . 'view-field-text.php' );

?></p><?php



$atts 					= array();
$atts['aria'] 			= esc_html__( 'Click Behavior', 'lazy-load-videos' );
$atts['blank'] 			= esc_html__( 'What should happen?', 'lazy-load-videos' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'click-behavior';
$atts['label'] 			= 'Click Behavior';
$atts['name'] 			= 'click-behavior';
$atts['selections'][] 	= array( 'value' => 'swap', 	'label' => esc_html__( 'Swap in place', 'lazy-load-videos' ) );
$atts['selections'][] 	= array( 'value' => 'popup', 	'label' => esc_html__( 'Pop-up Window', 'lazy-load-videos' ) );
$atts['selections'][] 	= array( 'value' => 'modal', 	'label' => esc_html__( 'Modal Window', 'lazy-load-videos' ) );
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . 'view-field-select.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'This overrides the video height in the plugin settings.';
$atts['id'] 			= 'video-height';
$atts['label'] 			= 'Video Height';
$atts['name'] 			= 'video-height';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'number';
$atts['value'] 			= $this->options['video-height'];

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . 'view-field-text.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'This overrides the video width in the plugin settings.';
$atts['id'] 			= 'video-width';
$atts['label'] 			= 'Video Width';
$atts['name'] 			= 'video-width';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'number';
$atts['value'] 			= $this->options['video-width'];

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . 'view-field-text.php' );

?></p>
