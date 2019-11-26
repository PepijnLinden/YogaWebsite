<?php
/**
 * News options
 *
 * @package Solid_Construction
 */

/**
 * Add news content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_news_options( $wp_customize ) {

    $wp_customize->add_section( 'solid_construction_news', array(
			'title' => esc_html__( 'News', 'solid-construction' ),
			'panel' => 'solid_construction_theme_options',
		)
	);

	// Add color scheme setting and control.
	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_news_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'choices'           => solid_construction_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'solid-construction' ),
			'section'           => 'solid_construction_news',
			'type'              => 'select',
		)
	);

    solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_news_number',
			'default'           => 3,
			'sanitize_callback' => 'solid_construction_sanitize_number_range',
			'active_callback'   => 'solid_construction_is_news_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'solid-construction' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'solid-construction' ),
			'section'           => 'solid_construction_news',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_news_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'active_callback'   => 'solid_construction_is_news_active',
			'choices'           => solid_construction_content_show(),
			'label'             => esc_html__( 'Display Content', 'solid-construction' ),
			'section'           => 'solid_construction_news',
			'type'              => 'select',
		)
	);

	$number = get_theme_mod( 'solid_construction_news_number', 3 );

	//loop for news post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		solid_construction_register_option( $wp_customize, array(
				'name'              => 'solid_construction_news_page_' . $i,
				'sanitize_callback' => 'solid_construction_sanitize_post',
				'active_callback'   => 'solid_construction_is_news_active',
				'label'             => esc_html__( 'News Page', 'solid-construction' ) . ' ' . $i ,
				'section'           => 'solid_construction_news',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_news_text',
			'default'           => esc_html__( 'View All', 'solid-construction' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'solid_construction_is_news_active',
			'label'             => esc_html__( 'Button Text', 'solid-construction' ),
			'section'           => 'solid_construction_news',
			'type'              => 'text',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_news_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'solid_construction_is_news_active',
			'label'             => esc_html__( 'Button Link', 'solid-construction' ),
			'section'           => 'solid_construction_news',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_news_target',
			'sanitize_callback' => 'solid_construction_sanitize_checkbox',
			'active_callback'   => 'solid_construction_is_news_active',
			'label'             => esc_html__( 'Check to Open Link in New Window/Tab', 'solid-construction' ),
			'section'           => 'solid_construction_news',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'solid_construction_news_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'solid_construction_is_news_active' ) ) :
	/**
	* Return true if news content is active
	*
	* @since Solid Construction 1.0
	*/
	function solid_construction_is_news_active( $control ) {
		$enable = $control->manager->get_setting( 'solid_construction_news_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( solid_construction_check_section( $enable ) );
	}
endif;
