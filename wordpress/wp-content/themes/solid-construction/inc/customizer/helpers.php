<?php

/**
 * Function to register control and setting
 */
function solid_construction_register_option( $wp_customize, $option ) {
	// Initialize Setting.
	$wp_customize->add_setting( $option['name'], array(
		'sanitize_callback'    => $option['sanitize_callback'],
		'default'              => isset( $option['default'] ) ? $option['default'] : '',
		'transport'            => isset( $option['transport'] ) ? $option['transport'] : 'refresh',
		'theme_supports'       => isset( $option['theme_supports'] ) ? $option['theme_supports'] : '',
	) );

	$control = array(
		'label'    => $option['label'],
		'section'  => $option['section'],
		'settings' => $option['name'],
	);

	if ( isset( $option['active_callback'] ) ) {
		$control['active_callback'] = $option['active_callback'];
	}

	if ( isset( $option['priority'] ) ) {
		$control['priority'] = $option['priority'];
	}

	if ( isset( $option['choices'] ) ) {
		$control['choices'] = $option['choices'];
	}

	if ( isset( $option['type'] ) ) {
		$control['type'] = $option['type'];
	}

	if ( isset( $option['input_attrs'] ) ) {
		$control['input_attrs'] = $option['input_attrs'];
	}

	if ( isset( $option['description'] ) ) {
		$control['description'] = $option['description'];
	}

	if ( isset( $option['custom_control'] ) ) {
		$wp_customize->add_control( new $option['custom_control']( $wp_customize, $option['name'], $control ) );
	} else {
		$wp_customize->add_control( $option['name'], $control );
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Solid Construction 1.2
 * @see solid_construction_customize_register()
 *
 * @return void
 */
function solid_construction_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Solid Construction 1.2
 * @see solid_construction_customize_register()
 *
 * @return void
 */
function solid_construction_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Function to reset date with respect to condition
 */
function solid_construction_reset_data() {
	if ( get_theme_mod( 'solid_construction_reset_all_settings' ) ) {
		remove_theme_mods();

		return;
	}

	if ( get_theme_mod( 'solid_construction_reset_typography' ) ) {
		//Reset Font Family Options
		$font_family_options = solid_construction_font_family_options();

		foreach ( $font_family_options as $key => $value ) {
			 remove_theme_mod( $key );
		}

		remove_theme_mod( 'solid_construction_reset_typography' );
	}
}
add_action( 'customize_save_after', 'solid_construction_reset_data' );

/**
 * Alphabetically sort theme options sections
 *
 * @param  wp_customize object $wp_customize wp_customize object.
 */
function solid_construction_sort_sections_list( $wp_customize ) {
	foreach ( $wp_customize->sections() as $section_key => $section_object ) {
		if ( false !== strpos( $section_key, 'solid_construction_' ) && 'solid_construction_reset_all' !== $section_key && 'solid_construction_important_links' !== $section_key ) {
			$options[] = $section_key;
		}
	}

	sort( $options );

	$priority = 1;
	foreach ( $options as  $option ) {
		$wp_customize->get_section( $option )->priority = $priority++;
	}
}
add_action( 'customize_register', 'solid_construction_sort_sections_list' );

/**
 * Returns an array of visibility options for featured sections
 *
 * @since Solid Construction 1.0
 */
function solid_construction_section_visibility_options() {
	$options = array(
		'disabled'    => esc_html__( 'Disabled', 'solid-construction' ),
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'solid-construction' ),
		'entire-site' => esc_html__( 'Entire Site', 'solid-construction' ),
	);

	return apply_filters( 'solid_construction_section_visibility_options', $options );
}

/**
 * Returns an array of color schemes registered for catchresponsive.
 *
 * @since Solid Construction 1.0
 */
function solid_construction_get_pagination_types() {
	$pagination_types = array(
		'default' => esc_html__( 'Default(Older Posts/Newer Posts)', 'solid-construction' ),
		'numeric' => esc_html__( 'Numeric', 'solid-construction' ),
	);

	return apply_filters( 'solid_construction_get_pagination_types', $pagination_types );
}

/**
 * Generate a list of all available post array
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function solid_construction_generate_post_array( $post_type = 'post' ) {
	$output = array();
	$posts = get_posts( array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => false,
		'posts_per_page'   => -1,
		)
	);

	$output['0']= esc_html__( '-- Select --', 'solid-construction' );

	foreach ( $posts as $post ) {
		/* translators: 1: post id. */
		$output[ $post->ID ] = ! empty( $post->post_title ) ? $post->post_title : sprintf( __( '#%d (no title)', 'solid-construction' ), $post->ID );
	}

	return $output;
}

/**
 * Generate a list of all available taxonomy
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function solid_construction_generate_taxonomy_array( $taxonomy = 'category' ) {
	$output = array();
	$taxonomy = get_categories( array( 'taxonomy' => $taxonomy ) );

	$output['0']= esc_html__( '-- Select --', 'solid-construction' );

	foreach ( $taxonomy as $tax ) {
		$output[ $tax->term_id ] = ! empty($tax->name ) ?$tax->name : sprintf( __( '#%d (no title)', 'solid-construction' ), $tax->term_id );
	}

	return $output;
}
