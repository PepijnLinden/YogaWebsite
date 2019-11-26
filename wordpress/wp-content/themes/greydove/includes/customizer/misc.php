<?php
/**
 * The theme customizer settings registration
 * Only a part of the customizer defined here
 * Customizer registered in theme-customizer.php in the includes folder 
 * Individual settings defined in files in the includes>customizer folder 
 *
 * @since GreyDove 2.0
 */

function greydove_misc_options( $wp_customizer ) {

	/**
	 * GreyDove Misc Options Section
	 */
	$wp_customizer->add_section( 'greydove_misc_section', array(
		'title'                 =>  esc_html__( 'Misc Settings', 'greydove' ),
		'panel'                 =>  'greydove_panel'
	) );

	/**
	 * Search Icon Show or Disable
	 */
	$wp_customizer->add_setting( 'greydove_search_icon_handle', array(
		'default'               =>  1,
		'sanitize_callback'     =>  'greydove_checkbox_sanitize',
		'transport'             =>  'refresh'
	) );
	$wp_customizer->add_control(
		new WP_Customize_Control(
			$wp_customizer,
			'greydove_search_icon_input',
			array(
				'label'         =>  esc_html__( 'Show Search Icon', 'greydove' ),
				'section'       =>  'greydove_misc_section',
				'settings'      =>  'greydove_search_icon_handle',
				'type'          =>  'checkbox'
			)
		)
	);

	/**
	 * Show Author Bio
	 */
	$wp_customizer->add_setting( 'greydove_author_bio', array(
		'default'               =>  1,
		'sanitize_callback'     =>  'greydove_checkbox_sanitize',
		'transport'             =>  'refresh'
	) );
	$wp_customizer->add_control(
		new WP_Customize_Control(
			$wp_customizer,
			'greydove_author_bio_input',
			array(
				'label'         =>  esc_html__( 'Show Author Description in Posts', 'greydove' ),
				'section'       =>  'greydove_misc_section',
				'settings'      =>  'greydove_author_bio',
				'type'          =>  'checkbox'
			)
		)
	);

}