<?php
/**
 * The theme customizer settings registration
 * Customizer registered in theme-customizer.php in the includes folder 
 * Individual settings defined in files in the includes > customizer folder 
 *
 * @since GreyDove 2.0
 */

function greydove_customize_register( $wp_customize ) {

	/**
	 * GreyDove Default Customizer Settings
	 */
	greydove_customizer_default_settings( $wp_customize );

	/**
	 * GreyDove Social Options
	 */
	greydove_social_icons( $wp_customize );

	/**
	 * GreyDove Miscellaneous Options
	 */
	greydove_misc_options( $wp_customize );

	/**
     * GreyDove Theme Options Panel
     */
	$wp_customize->add_panel( 'greydove_panel', array(
        'title'         =>  esc_html__( 'Theme Options', 'greydove' ),
        'priority'      =>  40
    ) );
	greydove_layout_options( $wp_customize );

}

