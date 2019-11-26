<?php

if( ! is_active_sidebar( 'primary' ) ) {
	return;
}

/**
 * GreyDove Layout Options
 */
$greydove_site_layout    =   get_theme_mod( 'greydove_layout_options_setting' );

if( $greydove_site_layout == 'no-sidebar' ) {
	return;
}elseif( $greydove_site_layout == 'left-sidebar' ) {
	$greydove_order = ' order-md-1';
}else {
	$greydove_order = '';
}

?>

<aside id="secondary" class="sidebar widget-area col-lg-4 col-md-4 col-sm-12<?php echo esc_attr($greydove_order); ?>" role="complementary">
	<?php dynamic_sidebar( 'primary' ); ?>
</aside><!-- .sidebar .widget-area -->
