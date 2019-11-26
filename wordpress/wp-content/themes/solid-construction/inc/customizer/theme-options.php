<?php
/**
 * Theme Options
 *
 * @package Solid_Construction
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'solid_construction_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'solid-construction' ),
		'priority' => 130,
	) );

	// Breadcrumb Option.
	$wp_customize->add_section( 'solid_construction_breadcrumb_options', array(
		'description'   => esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance.', 'solid-construction' ),
		'panel'         => 'solid_construction_theme_options',
		'title'         => esc_html__( 'Breadcrumb', 'solid-construction' ),
	) );

	solid_construction_register_option( $wp_customize, array(
			'name'              =>'solid_construction_breadcrumb_option',
			'default'           => 1,
			'sanitize_callback' => 'solid_construction_sanitize_checkbox',
			'label'             => esc_html__( 'Check to enable Breadcrumb', 'solid-construction' ),
			'section'           => 'solid_construction_breadcrumb_options',
			'type'              => 'checkbox',
	    )
	);
    // Breadcrumb Option End

	// Layout Options
	$wp_customize->add_section( 'solid_construction_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'solid-construction' ),
		'panel' => 'solid_construction_theme_options',
		)
	);

	/* Default Layout */
	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'solid-construction' ),
			'section'           => 'solid_construction_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'solid-construction' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'solid-construction' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'solid-construction' ),
			'section'           => 'solid_construction_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'solid-construction' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'solid-construction' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'solid_construction_excerpt_options', array(
		'panel' => 'solid_construction_theme_options',
		'title' => esc_html__( 'Excerpt Options', 'solid-construction' ),
	) );

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_excerpt_length',
			'default'           => '25',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 55 words', 'solid-construction' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'solid-construction' ),
			'section'  => 'solid_construction_excerpt_options',
			'type'     => 'number',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading', 'solid-construction' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'solid-construction' ),
			'section'           => 'solid_construction_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'solid_construction_search_options', array(
		'panel'     => 'solid_construction_theme_options',
		'title'     => esc_html__( 'Search Options', 'solid-construction' ),
	) );

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_search_text',
			'default'           => esc_html__( 'Search ...', 'solid-construction' ),
			'sanitize_callback' => 'wp_kses_data',
			'label'             => esc_html__( 'Search Text', 'solid-construction' ),
			'section'           => 'solid_construction_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'solid_construction_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'solid-construction' ),
		'panel'       => 'solid_construction_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'solid-construction' ),
	) );

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_front_page_category',
			'sanitize_callback' => 'solid_construction_sanitize_category_list',
			'custom_control'    => 'Solid_Construction_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'solid-construction' ),
			'section'           => 'solid_construction_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Pagination Options.
	$wp_customize->add_section( 'solid_construction_pagination_options', array(
		'panel'       => 'solid_construction_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'solid-construction' ),
	) );

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'choices'           => solid_construction_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'solid-construction' ),
			'section'           => 'solid_construction_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'solid_construction_scrollup', array(
		'panel'    => 'solid_construction_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'solid-construction' ),
	) );

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_disable_scrollup',
			'sanitize_callback' => 'solid_construction_sanitize_checkbox',
			'label'             => esc_html__( 'Disable Scroll Up', 'solid-construction' ),
			'section'           => 'solid_construction_scrollup',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'solid_construction_theme_options' );