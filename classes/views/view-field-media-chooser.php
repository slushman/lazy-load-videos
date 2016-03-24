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

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php echo wp_kses( $atts['label'], array( 'code' => array() ) ); ?>: </label><?php

}

?><div id="image-preview" style="background-image:url(<?php echo esc_url( $atts['value'] ) ?>);"></div>
<input
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	data-id="url-image"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>"
	type="url"
	value="<?php echo esc_attr( $atts['value'] ); ?>" />
<a href="#" class="" id="choose-image"><?php echo wp_kses( $atts['label-choose'], array( 'code' => array() ) ); ?></a>
<a href="#" class="hide" id="remove-image"><?php echo wp_kses( $atts['label-remove'], array( 'code' => array() ) ); ?></a><?php

if ( ! empty( $atts['description'] ) ) {

	?><p class="description"><?php echo wp_kses( $atts['description'], array( 'code' => array() ) ); ?></p><?php

}