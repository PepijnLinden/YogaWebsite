<?php
/**
 * Function to register widgetized sidebar
 * Intialized after the theme setup in functions.php
 * Sidebar --- primary
 *
 * @since GreyDove 2.0
 */

function greydove_widgets_init() {
	register_sidebar( array(
		'name'              =>  esc_html__( 'Sidebar', 'greydove' ),
		'id'                =>  'primary',
		'description'       =>  esc_html__( 'Add widgets here to appear in your sidebar.', 'greydove' ),
		'before_widget'     =>  '<section id="%1$s" class="widget %2$s">',
		'after_widget'      =>  '</section>',
		'before_title'      =>  '<h4 class="widget-title">',
		'after_title'       =>  '</h4>'
	) );
}