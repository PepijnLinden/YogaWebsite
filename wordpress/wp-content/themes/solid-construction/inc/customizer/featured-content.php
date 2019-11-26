<?php
/**
 * Featured Content options
 *
 * @package Solid_Construction
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_featured_content_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_content_jetpack_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Solid_Construction_Note_Control',
			'label'             => sprintf( esc_html__( 'For all Featured Content Options for Solid Construction Theme, go %1$shere%2$s', 'solid-construction' ),
				'<a href="javascript:wp.customize.section( \'solid_construction_featured_content\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'ect_featured_content',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'solid_construction_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'solid-construction' ),
			'panel' => 'solid_construction_theme_options',
		)
	);

	solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_featured_content_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Solid_Construction_Note_Control',
            'active_callback'   => 'solid_construction_is_ect_featured_content_inactive',
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'solid-construction' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'solid_construction_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_content_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'active_callback'   => 'solid_construction_is_ect_featured_content_active',
			'choices'           => solid_construction_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'solid-construction' ),
			'section'           => 'solid_construction_featured_content',
			'type'              => 'select',
		)
	);

	$type = 'featured-content';

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_content_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Solid_Construction_Note_Control',
			'active_callback'   => 'solid_construction_is_featured_content_active',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'solid-construction' ),
				 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'solid_construction_featured_content',
			'type'              => 'description',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'solid_construction_sanitize_number_range',
			'active_callback'   => 'solid_construction_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'solid-construction' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'solid-construction' ),
			'section'           => 'solid_construction_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_content_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'solid_construction_sanitize_select',
			'active_callback'   => 'solid_construction_is_featured_content_active',
			'choices'           => solid_construction_content_show(),
			'label'             => esc_html__( 'Display Content', 'solid-construction' ),
			'section'           => 'solid_construction_featured_content',
			'type'              => 'select',
		)
	);

	$number = get_theme_mod( 'solid_construction_featured_content_number', 3 );

	//loop for featured content
	for ( $i = 1; $i <= $number ; $i++ ) {
		
		solid_construction_register_option( $wp_customize, array(
				'name'              => 'solid_construction_featured_content_cpt_' . $i,
				'sanitize_callback' => 'solid_construction_sanitize_post',
				'active_callback'   => 'solid_construction_is_featured_content_active',
				'label'             => esc_html__( 'Featured Content #', 'solid-construction' ) . ' ' . $i ,
				'section'           => 'solid_construction_featured_content',
				'type'              => 'select',
				'choices'           => solid_construction_generate_post_array( 'featured-content' ),
			)
		);
	} // End for().

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_content_text',
			'default'           => esc_html__( 'View All', 'solid-construction' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'solid_construction_is_featured_content_active',
			'label'             => esc_html__( 'Button Text', 'solid-construction' ),
			'section'           => 'solid_construction_featured_content',
			'type'              => 'text',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_content_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'solid_construction_is_featured_content_active',
			'label'             => esc_html__( 'Button Link', 'solid-construction' ),
			'section'           => 'solid_construction_featured_content',
		)
	);

	solid_construction_register_option( $wp_customize, array(
			'name'              => 'solid_construction_featured_content_target',
			'sanitize_callback' => 'solid_construction_sanitize_checkbox',
			'active_callback'   => 'solid_construction_is_featured_content_active',
			'label'             => esc_html__( 'Check to Open Link in New Window/Tab', 'solid-construction' ),
			'section'           => 'solid_construction_featured_content',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'solid_construction_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'solid_construction_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since Solid Construction 0.1
	*/
	function solid_construction_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'solid_construction_featured_content_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( solid_construction_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'solid_construction_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'solid_construction_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
