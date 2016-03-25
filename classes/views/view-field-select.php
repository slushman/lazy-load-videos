<?php

/**
 * Provides the markup for a select field
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

?><select
	aria-label="<?php echo wp_kses( $atts['aria'], array( 'code' => array() ) ); ?>"
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"><?php

if ( ! empty( $atts['blank'] ) ) {

	?><option value><?php echo wp_kses( $atts['blank'], array( 'code' => array() ) ); ?></option><?php

}

if ( ! empty( $atts['selections'] ) ) {

	foreach ( $atts['selections'] as $selection ) {

		if ( is_array( $selection ) ) {

			$label = $selection['label'];
			$value = $selection['value'];

		} else {

			$label = $selection;
			$value = sanitize_title( $selection );

		}

		?><option value="<?php echo esc_attr( $value ); ?>" <?php

			selected( $atts['value'], $value ); ?>><?php

			echo wp_kses( $label, array( 'code' => array() ) );

		?></option><?php

	} // foreach

}

?></select>
<p class="description"><?php echo wp_kses( $atts['description'], array( 'code' => array() ) ); ?></p>