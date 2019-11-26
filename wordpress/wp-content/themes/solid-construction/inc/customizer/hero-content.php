<?php
/**
 * Hero Content Options
 *
 * @package Solid_Construction
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'solid_construction_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'solid-construction' ),
			'panel' => 'solid_construction_theme_options',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'choices'           => solid_construction_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'solid-construction' ),
			'section'           => 'solid_construction_hero_content_options',
			'type'              => 'select',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'solid_construction_sanitize_post',
			'active_callback'   => 'solid_construction_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'solid-construction' ),
			'section'           => 'solid_construction_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_hero_content_show',
			'default'           => 'full-content',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'active_callback'   => 'solid_construction_is_hero_content_active',
			'choices'           => solid_construction_content_show(),
			'label'             => esc_html__( 'Display Content', 'solid-construction' ),
			'section'           => 'solid_construction_hero_content_options',
			'type'              => 'select',
		)
	);
}
add_action( 'customize_register', 'solid_construction_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'solid_construction_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Solid Construction 1.0
	*/
	function solid_construction_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'solid_construction_hero_content_visibility' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( solid_construction_check_section( $enable ) );
	}
endif;
