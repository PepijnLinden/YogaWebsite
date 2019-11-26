<?php
/**
 * Function registering scripts and styles for the theme
 *
 * @since GreyDove 2.0
 */

function greydove_theme_enqueue() {

	wp_register_style(
		'greydove-gfonts',
		'https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Noto+Serif:400,400i,700,700i'
	);
	wp_register_style(
		'bootstrap',
		get_template_directory_uri() . '/assets/css/bootstrap.min.css',
		false,
		'4.1.3'
	);
	wp_register_style(
		'fontawesome',
		get_template_directory_uri() . '/assets/css/fontawesome.min.css',
		false,
		'4.7.0'
	);
	wp_register_style(
		'greydove-style',
		get_stylesheet_uri()
	);

	wp_enqueue_style( 'greydove-gfonts' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'fontawesome' );
	wp_enqueue_style( 'greydove-style' );

	wp_register_script(
		'skip-link-focus-fix',
		get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js',
		array(), '1.0', true
	);

	wp_register_script(
		'jquery-bootstrap',
		get_template_directory_uri() . '/assets/js/bootstrap.min.js',
		array( 'jquery' ),
		'3.3.7', true
	);

	wp_register_script(
		'greydove-main-js',
		get_template_directory_uri() . '/assets/js/main.js',
		array( 'jquery' ),
		'1.0', true
	);

	wp_localize_script( 'greydove-main-js', 'greydove_screenReaderText', array(
		'expand'   => __( 'expand child menu', 'greydove' ),
		'collapse' => __( 'collapse child menu', 'greydove' ),
	) );

	wp_enqueue_script( 'skip-link-focus-fix' );
	wp_enqueue_script( 'jquery-bootstrap' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'greydove-main-js' );
}