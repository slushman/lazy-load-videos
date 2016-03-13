<?php

/**
 * Provides the markup for a media chooser field
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Lazy_Load_Videos
 * @subpackage Lazy_Load_Videos/classes/views
 */

if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'lazy-load-videos' ); ?>: </label><?php

}

?><div id="image-preview" style="background-image:url(<?php echo esc_url( $atts['value'] ) ?>);"></div>
<input
	data-id="url-image"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	type="hidden"
	value="<?php echo esc_attr( $atts['value'] ); ?>" />
<a href="#" class="" id="choose-image"><?php esc_html_e( $atts['label-choose'], 'lazy-load-videos' ); ?></a>
<a href="#" class="hide" id="remove-image"><?php esc_html_e( $atts['label-remove'], 'lazy-load-videos' ); ?></a><?php

if ( ! empty( $atts['description'] ) ) {

	?><p class="description"><?php esc_html_e( $atts['description'], 'lazy-load-videos' ); ?></p><?php

}