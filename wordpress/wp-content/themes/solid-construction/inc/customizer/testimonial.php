<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Solid_Construction
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function solid_construction_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Solid_Construction_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Solid Construction Theme, go %1$shere%2$s', 'solid-construction' ),
                '<a href="javascript:wp.customize.section( \'solid_construction_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'solid_construction_testimonials', array(
            'panel'    => 'solid_construction_theme_options',
            'title'    => esc_html__( 'Testimonials', 'solid-construction' ),
        )
    );

     solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_testimonial_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Solid_Construction_Note_Control',
            'active_callback'   => 'solid_construction_is_ect_testimonial_inactive',
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with Testimonial Content Type Enabled', 'solid-construction' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'solid_construction_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_testimonial_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'solid_construction_sanitize_select',
            'active_callback'   => 'solid_construction_is_ect_testimonial_active',
            'choices'           => solid_construction_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'solid-construction' ),
            'section'           => 'solid_construction_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Solid_Construction_Note_Control',
            'active_callback'   => 'solid_construction_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'solid-construction' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'solid_construction_testimonials',
            'type'              => 'description',
        )
    );

    solid_construction_register_option( $wp_customize, array(
            'name'              => 'solid_construction_testimonial_number',
            'default'           => 4,
            'sanitize_callback' => 'solid_construction_sanitize_number_range',
            'active_callback'   => 'solid_construction_is_testimonial_active',
            'label'             => esc_html__( 'No of items', 'solid-construction' ),
            'section'           => 'solid_construction_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'solid_construction_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {
        //for CPT
        solid_construction_register_option( $wp_customize, array(
                'name'              => 'solid_construction_testimonial_cpt_' . $i,
                'sanitize_callback' => 'solid_construction_sanitize_post',
                'active_callback'   => 'solid_construction_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'solid-construction' ) . ' ' . $i ,
                'section'           => 'solid_construction_testimonials',
                'type'              => 'select',
                'choices'           => solid_construction_generate_post_array( 'jetpack-testimonial' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'solid_construction_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'solid_construction_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'solid_construction_testimonial_option' )->value();

        //return true only if previewed page on customizer matches the type of content option selected
        return ( solid_construction_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'solid_construction_is_ect_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_ect_testimonial_active( $control ) {
         return ( class_exists( 'Essential_Content_Jetpack_Testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_Testimonial' ) );
    }
endif;

if ( ! function_exists( 'solid_construction_is_ect_testimonial_inactive' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Solid Construction 0.1
    */
    function solid_construction_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_Testimonial' ) );
    }
endif;
