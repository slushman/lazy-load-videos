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

/*

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'phone-office';
$atts['label'] 			= 'Office Phone';
$atts['name'] 			= 'phone-office';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . 'view-field-text.php' );

?></p><?php

*/