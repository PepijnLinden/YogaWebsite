<?php
/**
 * Display Breadcrumb
 *
 * @package Solid_Construction
 */
?>

<?php

if ( ! get_theme_mod( 'solid_construction_breadcrumb_option', 1 ) ) {
	return false;
}

	solid_construction_breadcrumb();
