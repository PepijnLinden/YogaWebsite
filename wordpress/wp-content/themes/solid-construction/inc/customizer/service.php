<?php
/**
 * Services options
 *
 * @package Solid_Construction
 */

/**
 * Add services content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_services_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_services_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Solid_Construction_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options for Solid Construction Theme, go %1$shere%2$s', 'solid-construction' ),
                '<a href="javascript:wp.customize.section( \'solid_construction_services\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'ect_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'solid_construction_services', array(
			'title' => esc_html__( 'Services', 'solid-construction' ),
			'panel' => 'solid_construction_theme_options',
		)
	);

	solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_service_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Solid_Construction_Note_Control',
            'active_callback'   => 'solid_construction_is_ect_service_inactive',
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Content Type Enabled', 'solid-construction' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'solid_construction_services',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_services_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'active_callback'   => 'solid_construction_is_ect_service_active',
			'choices'           => solid_construction_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'solid-construction' ),
			'section'           => 'solid_construction_services',
			'type'              => 'select',
		)
	);

    solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_services_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Solid_Construction_Note_Control',
            'active_callback'   => 'solid_construction_is_services_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'solid-construction' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'solid_construction_services',
            'type'              => 'description',
        )
    );

    solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_services_number',
			'default'           => 6,
			'sanitize_callback' => 'solid_construction_sanitize_number_range',
			'active_callback'   => 'solid_construction_is_services_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'solid-construction' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'solid-construction' ),
			'section'           => 'solid_construction_services',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_services_show',
			'default'           => 'hide-content',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'active_callback'   => 'solid_construction_is_services_active',
			'choices'           => solid_construction_content_show(),
			'label'             => esc_html__( 'Display Content', 'solid-construction' ),
			'section'           => 'solid_construction_services',
			'type'              => 'select',
		)
	);

	$number = get_theme_mod( 'solid_construction_services_number', 6 );

	//loop for services post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		solid_construction_register_option( $wp_customize, array(
				'name'              => 'solid_construction_services_cpt_' . $i,
				'sanitize_callback' => 'solid_construction_sanitize_post',
				'active_callback'   => 'solid_construction_is_services_active',
				'label'             => esc_html__( 'Services', 'solid-construction' ) . ' ' . $i ,
				'section'           => 'solid_construction_services',
				'type'              => 'select',
                'choices'           => solid_construction_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_services_text',
			'default'           => esc_html__( 'View All', 'solid-construction' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'solid_construction_is_services_active',
			'label'             => esc_html__( 'Button Text', 'solid-construction' ),
			'section'           => 'solid_construction_services',
			'type'              => 'text',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_services_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'solid_construction_is_services_active',
			'label'             => esc_html__( 'Button Link', 'solid-construction' ),
			'section'           => 'solid_construction_services',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_services_target',
			'sanitize_callback' => 'solid_construction_sanitize_checkbox',
			'active_callback'   => 'solid_construction_is_services_active',
			'label'             => esc_html__( 'Check to Open Link in New Window/Tab', 'solid-construction' ),
			'section'           => 'solid_construction_services',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'solid_construction_services_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'solid_construction_is_services_active' ) ) :
	/**
	* Return true if services content is active
	*
	* @since Solid Construction 0.1
	*/
	function solid_construction_is_services_active( $control ) {
		$enable = $control->manager->get_setting( 'solid_construction_services_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( solid_construction_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'solid_construction_is_ect_service_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_ect_service_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'solid_construction_is_ect_service_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_ect_service_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

