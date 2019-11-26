<?php
/**
 * @package Kids Campus
 * Setup the WordPress core custom header feature.
 *
 * @uses kids_campus_header_style()

 */
function kids_campus_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'kids_campus_custom_header_args', array(		
		'default-text-color'     => 'ffffff',
		'width'                  => 1400,
		'height'                 => 250,
		'wp-head-callback'       => 'kids_campus_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'kids_campus_custom_header_setup' );

if ( ! function_exists( 'kids_campus_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see kids_campus_custom_header_setup().
 */
function kids_campus_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.site-header{
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
			background-position: center top;
		}
		.logo h1 a { color:#<?php echo esc_html(get_header_textcolor()); ?>;}
	<?php endif; ?>	
	</style>
    
    <?php
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
    <style type="text/css">		
		.logo h1,
		.logo p{
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
    </style>
    
	<?php        
} 
endif; // kids_campus_header_style 