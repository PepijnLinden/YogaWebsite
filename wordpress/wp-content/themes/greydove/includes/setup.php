<?php
/**
 * Set up the theme default settings & supports
 *
 * @since GreyDove 2.0
 */
 
function greydove_theme_setup() {

	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since GreyDove 2.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 360,
		'flex-height' => true,
	) );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable custom header
	 */

	add_theme_support( 'custom-header', apply_filters( 'greydove_header_args', array(
		'default-text-color'     => '#000',
		'width'                  => 1800,
		'height'                 => 300,
		'flex-height'            => true,
		'wp-head-callback'       => 'greydove_header_style',
	) ) );

	$defaults = array(
		'default-color'          => '#D0CFC6',
		'default-repeat'         => 'no-repeat',
		'default-position-x'     => 'center',
		'wp-head-callback'       => '_custom_background_cb',
	);

	// Add support for custom background
	add_theme_support( 'custom-background', $defaults );

	// Add support for screen reader text
	add_theme_support( 'screen-reader-text' );

	// Add support for Syndicate RSS Feeds 
	add_theme_support( 'automatic-feed-links' );

	// Add support for HTML5
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'gallery', 'caption' ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	/**
	 * Enable post format supports
	 * Formats: gallery, video, audio
	 * @since GreyDove 2.0
	 */
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );


	/**
	 * Register navigation menu
	 * Theme supports one nav menu in the header
	 * @since GreyDove 2.0
	 */
	register_nav_menu(
		'primary',
		__( 'Primary Menu', 'greydove' )
	);

	/**
	 * Enable editor styles
	 * Custom styling in editor to resemble the site front-end
	 * @since GreyDove 2.0
	 */
	add_editor_style( get_template_directory_uri() . '/assets/css/editor-style.css' );

	/**
	 * Define the content width
	 * @since GreyDove 2.0
	 */
	if ( ! isset( $content_width ) ) $content_width = 1200;

}

/**
 * Add custom CSS class to body
 * @since GreyDove 2.0
 */
function greydove_body_classes( $classes ) {

	// Adds custom-background-image class when custom background image used.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	return $classes;
}
add_filter( 'body_class', 'greydove_body_classes' );