<?php
/**
 * Header Media Options
 *
 * @package Solid_Construction
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'solid-construction' );

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_header_media_option',
			'default'           => 'exclude-home-page-post',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'solid-construction' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'solid-construction' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'solid-construction' ),
				'entire-site'            => esc_html__( 'Entire Site', 'solid-construction' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'solid-construction' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'solid-construction' ),
				'disable'                => esc_html__( 'Disabled', 'solid-construction' ),
			),
			'label'             => esc_html__( 'Enable on', 'solid-construction' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'solid-construction' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'solid-construction' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_header_media_url',
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'solid-construction' ),
			'section'           => 'header_image',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'solid-construction' ),
			'section'           => 'header_image',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_header_url_target',
			'sanitize_callback' => 'solid_construction_sanitize_checkbox',
			'label'             => esc_html__( 'Check to Open Link in New Window/Tab', 'solid-construction' ),
			'section'           => 'header_image',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'solid_construction_header_media_options' );
