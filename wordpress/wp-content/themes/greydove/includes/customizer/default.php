<?php
/**
 * The theme customizer default settings
 * Customizer registered in theme-customizer.php in the includes folder 
 * Individual settings defined in files in the includes>customizer folder 
 *
 * @since GreyDove 2.0
 */
 
function greydove_customizer_default_settings( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         =   'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  =   'postMessage';

	if( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname', array(
			'selector'              =>  '.site-title a',
			'container_inclusive'   =>  false,
			'render_callback'       =>  'greydove_customize_partial_blogname'
		)   );
		$wp_customize->selective_refresh->add_partial(
			'blogdescription', array(
			'selector'              =>  '.site-description',
			'container_inclusive'   =>  false,
			'render_callback'       =>  'greydove_customize_partial_blogdescription'
		)   );
	}

}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since GreyDove 2.0
 * @see greydove_customize_register()
 *
 * @return void
 */
function greydove_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since GreyDove 2.0
 * @see greydove_customize_register()
 *
 * @return void
 */
function greydove_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Output CSS style to hide text when header text hidden.
 *
 * @since GreyDove 2.0
 */
function greydove_header_style() {

	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="header-css">
		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}