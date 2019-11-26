<?php
/**
 * Customizer functionality
 *
 * @package Solid_Construction
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Solid Construction 1.0
 *
 * @see solid_construction_header_style()
 */
function solid_construction_custom_header_and_background() {
	$default_background_color = '#eeeeee';
	$default_text_color       = '#000000';

	/**
	 * Filter the arguments used when adding 'custom-background' support in Solid Construction.
	 *
	 * @since Solid Construction 0.1
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'solid_construction_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Solid Construction.
	 *
	 * @since Solid Construction 0.1
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'solid_construction_custom_header_args', array(
		'default-image'      	 => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
		'default-text-color'     => $default_text_color,
		'width'                  => 1920,
		'height'                 => 820,
		'flex-height'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'solid_construction_header_style',
		'video'                  => true,
	) ) );

	$default_headers_args = array(
		'main' => array(
			'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/header-thumb.jpg',
			'url'           => get_stylesheet_directory_uri() . '/assets/images/header.jpg',
		),
	);

	register_default_headers( $default_headers_args );
}
add_action( 'after_setup_theme', 'solid_construction_custom_header_and_background' );
