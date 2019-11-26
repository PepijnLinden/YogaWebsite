<?php
/**
 * Components functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Solid Construction Classic
 */

/**
 * Solid Construction classic only works with parent theme Solid Construction 1.1 or later.
 */
$my_theme = wp_get_theme('solid-construction');
if ( version_compare( $my_theme->get( 'Version' ), '1.1', '<' ) ) {
	require trailingslashit( get_stylesheet_directory() ) . '/back-compat.php';
	return; 
}

/**
 * Loads the child theme textdomain.
 */
function solid_construction_classic_setup() {
	load_child_theme_textdomain( 'solid-construction-classic', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'solid_construction_classic_setup' );


/**
 * Enqueue scripts and styles.
 */
function solid_construction_classic_scripts() {
	/* If using a child theme, auto-load the parent theme style. */
	if ( is_child_theme() ) {
		wp_enqueue_style( 'solid-construction-classic-style', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'style.css' );
	}

	/* Always load active theme's style.css. */
	wp_enqueue_style( 'solidconstructionclassic-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'solid_construction_classic_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function solid_construction_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Navigation classic or modern
	$classes[] = 'navigation-classic';

	// Header classic or modern
	$classes[] = 'header-classic';

	// Site content classic
	$classes[] = 'content-classic';

	// Adds a class with respect to layout selected.
	$layout  = solid_construction_get_theme_layout();
	$sidebar = solid_construction_get_sidebar_id();

	if ( 'no-sidebar-full-width' === $layout ) {
		$classes[] = 'no-sidebar full-width-layout';
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$classes[] = 'two-columns-layout content-left';
		}
	}

	// Adds a class of fluid layout to blogs.
	$classes[] = 'fluid-layout';

	$header_image = solid_construction_featured_overall_image();

	if ( '' == $header_image ) {
		$classes[] = 'no-header-media-image';
	}

	$header_text_enabled = solid_construction_has_header_media_text();

	if ( ! $header_text_enabled ) {
		$classes[] = 'no-header-media-text';
	}

	return $classes;
}
add_filter( 'body_class', 'solid_construction_body_classes' );

/**
 * Remove parent theme social menu on primary and add on header right
 */
function solid_construction_remove_parent_theme_menu_locations()
{
	unregister_nav_menu( 'social-primary' );
	register_nav_menu( 'social-header-right', esc_html__( 'Social on Header Right', 'solid-construction-classic' ) );

}
add_action( 'after_setup_theme', 'solid_construction_remove_parent_theme_menu_locations', 20 );

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_classic_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'solid_construction_important_links' );
	// Important Links.
	class Solid_Construction_Classic_Important_Links extends WP_Customize_Control {
		public $type = 'important-links';

		public function render_content() {
			// Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links.
			$important_links = array(
				'theme_instructions' => array(
					'link'  => esc_url( 'https://catchthemes.com/theme-instructions/solid-construction-classic/' ),
					'text'  => esc_html__( 'Theme Instructions', 'solid-construction-classic' ),
					),
				'support' => array(
					'link'  => esc_url( 'https://catchthemes.com/support/' ),
					'text'  => esc_html__( 'Support', 'solid-construction-classic' ),
					),
				'changelog' => array(
					'link'  => esc_url( 'https://catchthemes.com/changelogs/solid-construction-classic-theme/' ),
					'text'  => esc_html__( 'Changelog', 'solid-construction-classic' ),
					),
				'facebook' => array(
					'link'  => esc_url( 'https://www.facebook.com/catchthemes/' ),
					'text'  => esc_html__( 'Facebook', 'solid-construction-classic' ),
					),
				'twitter' => array(
					'link'  => esc_url( 'https://twitter.com/catchthemes/' ),
					'text'  => esc_html__( 'Twitter', 'solid-construction-classic' ),
					),
				'gplus' => array(
					'link'  => esc_url( 'https://plus.google.com/+Catchthemes/' ),
					'text'  => esc_html__( 'Google+', 'solid-construction-classic' ),
					),
				'pinterest' => array(
					'link'  => esc_url( 'http://www.pinterest.com/catchthemes/' ),
					'text'  => esc_html__( 'Pinterest', 'solid-construction-classic' ),
					),
			);

			foreach ( $important_links as $important_link ) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . $important_link['text'] . ' </a></p>'; // WPCS: XSS OK.
			}
		}
	}
	$wp_customize->add_section( 'solid_construction_classic_important_links', array(
		'priority' => 999,
		'title'    => esc_html__( 'Important Links', 'solid-construction-classic' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'solid_construction_classic_important_links', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Solid_Construction_Classic_Important_Links( $wp_customize, 'solid_construction_classic_important_links', array(
		'label'   => esc_html__( 'Important Links', 'solid-construction-classic' ),
		'section' => 'solid_construction_classic_important_links',
	) ) );
	//Important Links End
}
add_action( 'customize_register', 'solid_construction_classic_customize_register', 20 );