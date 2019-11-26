<?php
/**
 * Solid Construction Classic back compat functionality
 *
 * Prevents Solid Construction Classic from running if the parent theme version is
 * prior to 1.1
 * since this theme is not meant to be backward compatible beyond that and
 * relies on functions and markup changes introduced in 1.1.
 *
 * @since Solid Construction Classic 1.0
 */

/**
 * Prevent switching to Solid Construction Classic on old versions of Parent theme.
 *
 * Switches to the default theme.
 *
 * @since Solid Construction Classic 1.0
 */
function solid_construction_classic_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'solid_construction_classic_upgrade_notice' );
}
add_action( 'after_switch_theme', 'solid_construction_classic_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * @since Solid Construction Classic 1.0
 */
function solid_construction_classic_upgrade_notice() {
	$my_theme = wp_get_theme('solid-construction');
	$message = sprintf( __( 'Solid Construction Classic requires at least Solid Construction version 1.1. You are running version %s. Please upgrade and try again.', 'solid-construction-classic' ), $my_theme->get( 'Version' ) );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on Solid Construction versions prior to 1.1.
 *
 * @since Solid Construction Classic 1.0
 */
function solid_construction_classic_customize() {
	$my_theme = wp_get_theme('solid-construction');
	wp_die(
		sprintf( __( 'Solid Construction Classic requires at least Solid Construction version 1.1. You are running version %s. Please upgrade and try again.', 'solid-construction-classic' ), $my_theme->get( 'Version' ) ), '', array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'solid_construction_classic_customize' );

/**
 * Prevents the Theme Preview from being loaded on Solid Construction versions prior to * 1.1.
 *
 * @since Solid Construction Classic 1.0
 *
 * @global string $wp_version WordPress version.
 */
function solid_construction_classic_preview() {
	$my_theme = wp_get_theme('solid-construction');
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Solid Construction Classic requires at least Solid Construction version 1.1. You are running version %s. Please upgrade and try again.', 'solid-construction-classic' ), $my_theme->get( 'Version' ) ) );
	}
}
add_action( 'template_redirect', 'solid_construction_classic_preview' );
