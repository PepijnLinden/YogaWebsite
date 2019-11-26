<?php
/**
 * The theme customizer settings registration
 * Only a part of the customizer defined here
 * Customizer registered in theme-customizer.php in the includes folder 
 * Individual settings defined in files in the includes>customizer folder 
 *
 * @since GreyDove 2.0
 */

function greydove_layout_options( $wp_customize ) {

	$wp_customize->add_section( 'greydove_layout_section', array(
		'title'                 =>  esc_html__( 'Layout Settings', 'greydove' ),
		'panel'                 =>  'greydove_panel'
	) );

	$wp_customize->add_setting( 'greydove_layout_options_setting', array(
		'default'               =>  'right-sidebar',
		'sanitize_callback'     =>  'greydove_layout_option_sanitize',
		'transport'             =>  'refresh'
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'layout_options_input',
			array(
				'label'         =>  esc_html__( 'Site Layout', 'greydove' ),
				'section'       =>  'greydove_layout_section',
				'settings'      =>  'greydove_layout_options_setting',
				'type'          =>  'radio',
				'choices'       =>  array(
					'left-sidebar'      =>  esc_html__( 'Sidebar Left', 'greydove' ),
					'right-sidebar'     =>  esc_html__( 'Sidebar Right', 'greydove' ),
					'no-sidebar'        =>  esc_html__( 'No Sidebar', 'greydove' )
				)
			)
		)
	);

}