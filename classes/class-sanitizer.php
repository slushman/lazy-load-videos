<?php

/**
 * Sanitize anything
 *
 * @since 		1.0.0
 *
 * @package 	Lazy_Load_Videos
 * @subpackage 	Lazy_Load_Videos/classes
 */

class Lazy_Load_Videos_Sanitize {

	/**
	 * Constructor
	 */
	public function __construct() {

		// Nothing to see here...

	} // __construct()

	/**
	 * Cleans the data
	 *
	 * @access 	public
	 * @since 	0.1
	 *
	 * @uses 	sanitize_email()
	 * @uses 	sanitize_phone()
	 * @uses 	esc_textarea()
	 * @uses 	sanitize_text_field()
	 * @uses 	esc_url()
	 *
	 * @return  mixed         The sanitized data
	 */
	public function clean( $data, $type ) {

		$check = '';

		if ( empty( $type ) ) {

			$check = new WP_Error( 'forgot_type', __( 'Specify the data type to sanitize.', 'lazy-load-videos' ) );

		}

		if ( is_wp_error( $check ) ) {

			wp_die( $check->get_error_message(), __( 'Forgot data type', 'lazy-load-videos' ) );

		}

		$sanitized = '';

		/**
		 * Add additional santization before the default sanitization
		 */
		do_action( 'Lazy_Load_Videos_pre_sanitize', $sanitized );

		switch ( $type ) {

			case 'radio'			:
			case 'select'			: $sanitized = $this->sanitize_random( $data ); break;

			case 'date'				:
			case 'datetime'			:
			case 'datetime-local'	:
			case 'time'				:
			case 'week'				: $sanitized = strtotime( $data ); break;

			case 'number'			:
			case 'range'			: $sanitized = intval( $data ); break;

			case 'hidden'			:
			case 'month'			:
			case 'text'				: $sanitized = sanitize_text_field( $data ); break;

			case 'checkbox'			: $sanitized = ( isset( $data ) ? 1 : 0 ); break;
			case 'color' 			: $sanitized = $this->sanitize_hex_color( $data ); break;
			case 'email'			: $sanitized = sanitize_email( $data ); break;
			case 'file'				: $sanitized = sanitize_file_name( $data ); break;
			case 'tel'				: $sanitized = $this->sanitize_phone( $data ); break;
			case 'textarea'			: $sanitized = esc_textarea( $data ); break;
			case 'url'				: $sanitized = esc_url( $data ); break;

		} // switch

		/**
		 * Add additional santization after the default .
		 */
		do_action( 'Lazy_Load_Videos_post_sanitize', $sanitized );

		return $sanitized;

	} // clean()

	/**
	 * Checks a date against a format to ensure its validity
	 *
	 * @link 	http://www.php.net/manual/en/function.checkdate.php
	 *
	 * @param  	string 		$date   		The date as collected from the form field
	 * @param  	string 		$format 		The format to check the date against
	 * @return 	string 		A validated, formatted date
	 */
	private function validate_date( $date, $format = 'Y-m-d H:i:s' ) {

		$version = explode( '.', phpversion() );

		if ( ( (int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17 ) ) {

			$d = DateTime::createFromFormat( $format, $date );

		} else {

			$d = new DateTime( date( $format, strtotime( $date ) ) );

		}

		return $d && $d->format( $format ) == $date;

	} // validate_date()

	/**
	 * Validates the input is a hex color.
	 *
	 * @param 	string 		$color 			The hex color string
	 * @return 	string 						The sanitized hex color string
	 */
	private function sanitize_hex_color( $color ) {

		if ( empty( $color ) ) { return; }

		$return = '';
		$color 	= trim( $color );
		$color 	= ltrim( $color, '#' );

		if ( preg_match( '/([A-Fa-f0-9]{3}){1,2}$/', $color ) ) {

			$return = $color;

		}

		return $return;

	} // sanitize_hex_color()

	/**
	 * Validates a phone number
	 *
	 * @access 	private
	 * @since	0.1
	 * @link	http://jrtashjian.com/2009/03/code-snippet-validate-a-phone-number/
	 * @param 	string 			$phone				A phone number string
	 * @return	string|bool		$phone|FALSE		Returns the valid phone number, FALSE if not
	 */
	private function sanitize_phone( $phone ) {

		if ( empty( $phone ) ) { return FALSE; }

		if ( preg_match( '/^[+]?([0-9]?)[(|s|-|.]?([0-9]{3})[)|s|-|.]*([0-9]{3})[s|-|.]*([0-9]{4})$/', $phone ) ) {

			return trim( $phone );

		} // $phone validation

		return FALSE;

	} // sanitize_phone()

	/**
	 * Performs general cleaning functions on data
	 *
	 * @param 	mixed 	$input 		Data to be cleaned
	 * @return 	mixed 	$return 	The cleaned data
	 */
	private function sanitize_random( $input ) {

			$one	= trim( $input );
			$two	= stripslashes( $one );
			$return	= htmlspecialchars( $two );

		return $return;

	} // sanitize_random()

} // class
