<?php
/**
 * Portfolio options
 *
 * @package Solid_Construction
 */

/**
 * Add portfolio content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_portfolio_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_portfolio_jetpack_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Solid_Construction_Note_Control',
			'label'             => sprintf( esc_html__( 'For all Portfolio Options for Solid Construction Theme, go %1$shere%2$s', 'solid-construction' ),
				'<a href="javascript:wp.customize.section( \'solid_construction_portfolio\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'solid_construction_portfolio', array(
			'title' => esc_html__( 'Portfolio', 'solid-construction' ),
			'panel' => 'solid_construction_theme_options',
		)
	);

	 solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_testimonials_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Solid_Construction_Note_Control',
            'active_callback'   => 'solid_construction_is_ect_portfolio_inactive',
            'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Content Type Enabled', 'solid-construction' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'solid_construction_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'active_callback'   => 'solid_construction_is_ect_portfolio_active',
			'choices'           => solid_construction_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'solid-construction' ),
			'section'           => 'solid_construction_portfolio',
			'type'              => 'select',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Solid_Construction_Note_Control',
			'active_callback'   => 'solid_construction_is_portfolio_active',
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'solid-construction' ),
				 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'solid_construction_portfolio',
			'type'              => 'description',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_portfolio_number',
			'default'           => 5,
			'sanitize_callback' => 'solid_construction_sanitize_number_range',
			'active_callback'   => 'solid_construction_is_portfolio_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'solid-construction' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'solid-construction' ),
			'section'           => 'solid_construction_portfolio',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'solid_construction_portfolio_number', 5 );

	//loop for portfolio post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		solid_construction_register_option( $wp_customize, array(
				'name'              => 'solid_construction_portfolio_cpt_' . $i,
				'sanitize_callback' => 'solid_construction_sanitize_post',
				'active_callback'   => 'solid_construction_is_portfolio_active',
				'label'             => esc_html__( 'Portfolio', 'solid-construction' ) . ' ' . $i ,
				'section'           => 'solid_construction_portfolio',
				'type'              => 'select',
				'choices'           => solid_construction_generate_post_array( 'jetpack-portfolio' ),
			)
		);
	} // End for().

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_portfolio_text',
			'default'           => esc_html__( 'View All', 'solid-construction' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'solid_construction_is_portfolio_active',
			'label'             => esc_html__( 'Button Text', 'solid-construction' ),
			'section'           => 'solid_construction_portfolio',
			'type'              => 'text',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_portfolio_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'solid_construction_is_portfolio_active',
			'label'             => esc_html__( 'Button Link', 'solid-construction' ),
			'section'           => 'solid_construction_portfolio',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_portfolio_target',
			'sanitize_callback' => 'solid_construction_sanitize_checkbox',
			'active_callback'   => 'solid_construction_is_portfolio_active',
			'label'             => esc_html__( 'Check to Open Link in New Window/Tab', 'solid-construction' ),
			'section'           => 'solid_construction_portfolio',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'solid_construction_portfolio_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'solid_construction_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio content is active
	*
	* @since Solid Construction 0.1
	*/
	function solid_construction_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'solid_construction_portfolio_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( solid_construction_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'solid_construction_is_ect_portfolio_active' ) ) :
    /**
    * Return true if portfolio is active
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'JetPack' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'solid_construction_is_ect_portfolio_inactive' ) ) :
    /**
    * Return true if portfolio is inactive
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'JetPack' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;