<?php
/**
 * Functions file for the theme
 * Including the various files with the theme functions
 *
 * @since GreyDove 2.0
 */

// Include the files
include( get_template_directory() . '/includes/setup.php' );
include( get_template_directory() . '/includes/widgets.php' );
include( get_template_directory() . '/includes/template-tags.php' );
include( get_template_directory() . '/includes/enqueue.php' );

include( get_template_directory() . '/includes/theme-customizer.php' );
include( get_template_directory() . '/includes/customizer/sanitize.php' );
include( get_template_directory() . '/includes/customizer/default.php' );
include( get_template_directory() . '/includes/customizer/layout.php' );
include( get_template_directory() . '/includes/customizer/misc.php' );
include( get_template_directory() . '/includes/customizer/social.php' );


/**
 * Hooks for the theme setup, customizer, enqueue & widgets
 * Functions defined within the includes folder
 *
 */
add_action( 'after_setup_theme', 'greydove_theme_setup' );
add_action( 'widgets_init', 'greydove_widgets_init' );
add_action( 'wp_enqueue_scripts', 'greydove_theme_enqueue' );
add_action( 'customize_register', 'greydove_customize_register' );