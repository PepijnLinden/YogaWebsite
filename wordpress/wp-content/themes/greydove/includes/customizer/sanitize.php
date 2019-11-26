<?php
/**
 * The theme customizer settings registration
 * Customizer registered in theme-customizer.php in the includes folder 
 * Individual settings defined in files in the includes>customizer folder 
 *
 * @since GreyDove 2.0
 */

/**
 * Sanitize customizer settings input
 * Checkbox sidebar layout option sanitization
 */
if( ! function_exists( 'greydove_layout_option_sanitize' ) ) :
function greydove_layout_option_sanitize( $value ) {

	if( ! in_array( $value, array( 'right-sidebar', 'left-sidebar', 'no-sidebar' ) ) ) {
		$value = 'no-sidebar';
	}

	return $value;
}
endif;

/**
 * Sanitize customizer settings input
 * Checkbox value sanitization 
 */
if( ! function_exists( 'greydove_checkbox_sanitize' ) ) :
function greydove_checkbox_sanitize( $value ) {

	if( ! in_array( $value, array( 0, 1 ) ) ) {
		$value = 1;
	}

	return $value;
}
endif;