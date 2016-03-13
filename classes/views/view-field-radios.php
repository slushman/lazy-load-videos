<?php

/**
 * Provides the markup for a set of radios
 *
 * $atts:
 *	class
 *	description 	Description of the set for the legend tag
 * 	id
 * 	name
 * 	selections 		The individual items to create radios
 * 		label 		The text label of this item
 * 		value 		The value of this item
 *  value 			The saved value
 *  wrap-tag 		Optional tag name to wrap each radio in, ie: 'p', 'span', 'li', etc
 *
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Lazy_Load_Videos
 * @subpackage Lazy_Load_Videos/classes/views
 */

?><fieldset role="radiogroup" class="wrap-radios"><?php

if ( ! empty( $atts['description'] ) ) {

	?><legend class="description"><?php esc_html_e( $atts['description'], 'lazy-load-videos' ); ?></legend><?php

}

foreach ( $atts['selections'] as $selection ) {

	if ( is_array( $selection ) ) {

		$label = $selection['label'];
		$value = $selection['value'];

	} else {

		$label = $selection;
		$value = strtolower( $selection );

	}

	if ( ! empty( $atts['wrap-tag'] ) ) {

		echo '<' . esc_attr( $atts['wrap-tag'] ) . '>';

	}

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>">
		<input aria-role="radio"
			<?php checked( $value, $atts['value'], true ); ?>
			class="<?php echo esc_attr( $atts['class'] ); ?>"
			id="<?php echo esc_attr( $atts['id'] ); ?>"
			name="<?php echo esc_attr( $atts['name'] ); ?>"
			type="radio"
			value="<?php echo esc_attr( $value ); ?>" /> <?php

			esc_html_e( $label, 'lazy-load-videos' );

	?></label><?php

	if ( ! empty( $atts['wrap-tag'] ) ) {

		echo '</' . esc_attr( $atts['wrap-tag'] ) . '>';

	}

} // foreach

?></fieldset>
