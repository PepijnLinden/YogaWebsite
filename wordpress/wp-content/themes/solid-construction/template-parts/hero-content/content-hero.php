<?php
/**
 * The template used for displaying hero content
 *
 * @package Solid_Construction
 */
?>

<?php
$enable_section = get_theme_mod( 'solid_construction_hero_content_visibility', 'disabled' );

if ( ! solid_construction_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}
get_template_part( 'template-parts/hero-content/post-type', 'hero' );

