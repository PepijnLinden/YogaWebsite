<?php
/**
 * Featured Slider Options
 *
 * @package Solid_Construction
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'solid_construction_featured_slider', array(
			'panel' => 'solid_construction_theme_options',
			'title' => esc_html__( 'Featured Slider', 'solid-construction' ),
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'choices'           => solid_construction_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'solid-construction' ),
			'section'           => 'solid_construction_featured_slider',
			'type'              => 'select',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_slider_number',
			'default'           => '2',
			'sanitize_callback' => 'solid_construction_sanitize_number_range',

			'active_callback'   => 'solid_construction_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'solid-construction' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of items', 'solid-construction' ),
			'section'           => 'solid_construction_featured_slider',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_slider_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'active_callback'   => 'solid_construction_is_slider_active',
			'choices'           => solid_construction_content_show(),
			'label'             => esc_html__( 'Display Content', 'solid-construction' ),
			'section'           => 'solid_construction_featured_slider',
			'type'              => 'select',
		)
	);

	$slider_number = get_theme_mod( 'solid_construction_slider_number', 2 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		solid_construction_register_option( $wp_customize, array(
				'name'              =>'solid_construction_slider_page_' . $i,
				'sanitize_callback' => 'solid_construction_sanitize_post',
				'active_callback'   => 'solid_construction_is_slider_active',
				'label'             => esc_html__( 'Page', 'solid-construction' ) . ' # ' . $i,
				'section'           => 'solid_construction_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'solid_construction_slider_options' );


/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Solid Construction 1.0
 */
function solid_construction_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'solid-construction' ),
		'full-content' => esc_html__( 'Full Content', 'solid-construction' ),
		'hide-content' => esc_html__( 'Hide Content', 'solid-construction' ),
	);
	return apply_filters( 'solid_construction_content_show', $options );
}

/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Solid Construction 1.0
 */
function solid_construction_meta_show() {
	$options = array(
		'show-meta' => esc_html__( 'Show Meta', 'solid-construction' ),
		'hide-meta' => esc_html__( 'Hide Meta', 'solid-construction' ),
	);
	return apply_filters( 'solid_construction_content_show', $options );
}

/** Active Callback Functions */

if( ! function_exists( 'solid_construction_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Solid Construction 1.0
	*/
	function solid_construction_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'solid_construction_slider_option' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected
		return ( solid_construction_check_section( $enable ) );
	}
endif;