<?php    
/**
 *Kids Campus Theme Customizer
 *
 * @package Kids Campus
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kids_campus_customize_register( $wp_customize ) {	
	
	function kids_campus_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function kids_campus_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}  
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	 //Panel for section & control
	$wp_customize->add_panel( 'kids_campus_panel_section', array(
		'priority' => null,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options Panel', 'kids-campus' ),		
	) );
	
	//Layout Options
	$wp_customize->add_section('kids_campus_layout_option',array(
		'title' => __('Site Layout Options','kids-campus'),			
		'priority' => 1,
		'panel' => 	'kids_campus_panel_section',          
	));		
	
	$wp_customize->add_setting('kids_campus_boxlayout',array(
		'sanitize_callback' => 'kids_campus_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'kids_campus_boxlayout', array(
    	'section'   => 'kids_campus_layout_option',    	 
		'label' => __('Check to Box Layout','kids-campus'),
		'description' => __('If you want to box layout please check the Box Layout Option.','kids-campus'),
    	'type'      => 'checkbox'
     )); //Layout Section 
	
	$wp_customize->add_setting('kids_campus_color_scheme',array(
		'default' => '#0f9fbc',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'kids_campus_color_scheme',array(
			'label' => __('Color Scheme','kids-campus'),			
			'description' => __('More color options in PRO Version','kids-campus'),
			'section' => 'colors',
			'settings' => 'kids_campus_color_scheme'
		))
	);
	
	//Header Contact info
	$wp_customize->add_section('kids_campus_hdr_contact_info',array(
		'title' => __('Header Contact info','kids-campus'),				
		'priority' => null,
		'panel' => 	'kids_campus_panel_section',
	));	
	
	$wp_customize->add_setting('kids_campus_hdr_phoneno',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('kids_campus_hdr_phoneno',array(	
		'type' => 'text',
		'label' => __('Add phone number here','kids-campus'),
		'section' => 'kids_campus_hdr_contact_info',
		'setting' => 'kids_campus_hdr_phoneno'
	));	
	
	
	$wp_customize->add_setting('kids_campus_hdr_email_id',array(
		'sanitize_callback' => 'sanitize_email'
	));
	
	$wp_customize->add_control('kids_campus_hdr_email_id',array(
		'type' => 'text',
		'label' => __('Add email address here.','kids-campus'),
		'section' => 'kids_campus_hdr_contact_info'
	));	
	
		

	
	$wp_customize->add_setting('kids_campus_show_hdr_contact_info_part',array(
		'default' => false,
		'sanitize_callback' => 'kids_campus_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'kids_campus_show_hdr_contact_info_part', array(
	   'settings' => 'kids_campus_show_hdr_contact_info_part',
	   'section'   => 'kids_campus_hdr_contact_info',
	   'label'     => __('Check To show This Section','kids-campus'),
	   'type'      => 'checkbox'
	 ));//Show Header Contact Info
	
	
	 //Header Social icons
	$wp_customize->add_section('kids_campus_hdr_social_area',array(
		'title' => __('Header social icons','kids-campus'),
		'description' => __( 'Add social icons link here to display icons in header.', 'kids-campus' ),			
		'priority' => null,
		'panel' => 	'kids_campus_panel_section', 
	));
	
	$wp_customize->add_setting('kids_campus_hdrfb_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'	
	));
	
	$wp_customize->add_control('kids_campus_hdrfb_link',array(
		'label' => __('Add facebook link here','kids-campus'),
		'section' => 'kids_campus_hdr_social_area',
		'setting' => 'kids_campus_hdrfb_link'
	));	
	
	$wp_customize->add_setting('kids_campus_hdrtwitt_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('kids_campus_hdrtwitt_link',array(
		'label' => __('Add twitter link here','kids-campus'),
		'section' => 'kids_campus_hdr_social_area',
		'setting' => 'kids_campus_hdrtwitt_link'
	));
	
	$wp_customize->add_setting('kids_campus_hdrgplus_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('kids_campus_hdrgplus_link',array(
		'label' => __('Add google plus link here','kids-campus'),
		'section' => 'kids_campus_hdr_social_area',
		'setting' => 'kids_campus_hdrgplus_link'
	));
	
	$wp_customize->add_setting('kids_campus_hdrlinked_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('kids_campus_hdrlinked_link',array(
		'label' => __('Add linkedin link here','kids-campus'),
		'section' => 'kids_campus_hdr_social_area',
		'setting' => 'kids_campus_hdrlinked_link'
	));
	
	$wp_customize->add_setting('kids_campus_show_hdr_social_area',array(
		'default' => false,
		'sanitize_callback' => 'kids_campus_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'kids_campus_show_hdr_social_area', array(
	   'settings' => 'kids_campus_show_hdr_social_area',
	   'section'   => 'kids_campus_hdr_social_area',
	   'label'     => __('Check To show This Section','kids-campus'),
	   'type'      => 'checkbox'
	 ));//Show Header Social icons area
		
	
	// Header Slider Section		
	$wp_customize->add_section( 'kids_campus_hdr_slider_options', array(
		'title' => __('Header Slider Section', 'kids-campus'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 850 pixel.','kids-campus'), 
		'panel' => 	'kids_campus_panel_section',           			
    ));
	
	$wp_customize->add_setting('kids_campus_hdr_slider_pagbox1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kids_campus_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('kids_campus_hdr_slider_pagbox1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider first:','kids-campus'),
		'section' => 'kids_campus_hdr_slider_options'
	));	
	
	$wp_customize->add_setting('kids_campus_hdr_slider_pagbox2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kids_campus_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('kids_campus_hdr_slider_pagbox2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider second:','kids-campus'),
		'section' => 'kids_campus_hdr_slider_options'
	));	
	
	$wp_customize->add_setting('kids_campus_hdr_slider_pagbox3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kids_campus_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('kids_campus_hdr_slider_pagbox3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider third:','kids-campus'),
		'section' => 'kids_campus_hdr_slider_options'
	));	// Slider Section Options	
	
	$wp_customize->add_setting('kids_campus_hdr_slider_readbtntext',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('kids_campus_hdr_slider_readbtntext',array(	
		'type' => 'text',
		'label' => __('Add slider Read more button name here','kids-campus'),
		'section' => 'kids_campus_hdr_slider_options',
		'setting' => 'kids_campus_hdr_slider_readbtntext'
	)); // Slider Read More Button Text
	
	$wp_customize->add_setting('kids_campus_show_hdr_slider_section',array(
		'default' => false,
		'sanitize_callback' => 'kids_campus_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'kids_campus_show_hdr_slider_section', array(
	    'settings' => 'kids_campus_show_hdr_slider_section',
	    'section'   => 'kids_campus_hdr_slider_options',
	     'label'     => __('Check To Show This Section','kids-campus'),
	   'type'      => 'checkbox'
	 ));//Show Header Slider Section	
	 
	 
	 // Kids Three Services Section
	$wp_customize->add_section('kids_campus_services_3col_area', array(
		'title' => __('Kids Services Section','kids-campus'),
		'description' => __('Select pages from the dropdown for services section','kids-campus'),
		'priority' => null,
		'panel' => 	'kids_campus_panel_section',          
	));	
	
	$wp_customize->add_setting('kids_campus_page_for_services_col1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kids_campus_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'kids_campus_page_for_services_col1',array(
		'type' => 'dropdown-pages',			
		'section' => 'kids_campus_services_3col_area',
	));		
	
	$wp_customize->add_setting('kids_campus_page_for_services_col2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kids_campus_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'kids_campus_page_for_services_col2',array(
		'type' => 'dropdown-pages',			
		'section' => 'kids_campus_services_3col_area',
	));
	
	$wp_customize->add_setting('kids_campus_page_for_services_col3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kids_campus_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'kids_campus_page_for_services_col3',array(
		'type' => 'dropdown-pages',			
		'section' => 'kids_campus_services_3col_area',
	));
	
	
	$wp_customize->add_setting('kids_campus_show_services_3col_area',array(
		'default' => false,
		'sanitize_callback' => 'kids_campus_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'kids_campus_show_services_3col_area', array(
	   'settings' => 'kids_campus_show_services_3col_area',
	   'section'   => 'kids_campus_services_3col_area',
	   'label'     => __('Check To Show This Section','kids-campus'),
	   'type'      => 'checkbox'
	 ));//Show Kids Services Area	 
	 
	 
	 // Welcome Page Section 
	$wp_customize->add_section('kids_campus_welcomepage_area', array(
		'title' => __('Welcome Section','kids-campus'),
		'description' => __('Select Pages from the dropdown for welcome section','kids-campus'),
		'priority' => null,
		'panel' => 	'kids_campus_panel_section',          
	));		
	
	$wp_customize->add_setting('kids_campus_welcome_page_section',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kids_campus_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'kids_campus_welcome_page_section',array(
		'type' => 'dropdown-pages',			
		'section' => 'kids_campus_welcomepage_area',
	));		
	
	$wp_customize->add_setting('kids_campus_show_welcome_page_section',array(
		'default' => false,
		'sanitize_callback' => 'kids_campus_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'kids_campus_show_welcome_page_section', array(
	    'settings' => 'kids_campus_show_welcome_page_section',
	    'section'   => 'kids_campus_welcomepage_area',
	    'label'     => __('Check To Show This Section','kids-campus'),
	    'type'      => 'checkbox'
	));//Show Aboutus Section 
	 
		 
}
add_action( 'customize_register', 'kids_campus_customize_register' );

function kids_campus_custom_css(){ 
?>
	<style type="text/css"> 					
        a, .recentpost_listing h2 a:hover,
        #sidebar ul li a:hover,	
		.site_primary_menu ul li a:hover, 
	    .site_primary_menu ul li.current-menu-item a,
	    .site_primary_menu ul li.current-menu-parent a.parent,
	    .site_primary_menu ul li.current-menu-item ul.sub-menu li a:hover,				
        .recentpost_listing h3 a:hover,       
		.hdr_social a:hover,       						
        .postmeta a:hover,
		#sidebar ul li::before,
		.page_three_box h3 a,		
        .button:hover,		
		.welcome_contentbox h3 span       				
            { color:<?php echo esc_html( get_theme_mod('kids_campus_color_scheme','#0f9fbc')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,		
        .nivo-controlNav a.active,				
        .learnmore,
		.nivo-caption .slide_morebtn:hover,
		a.blogreadmore,
		.welcome_contentbox .btnstyle1,													
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,
		.site-header.siteinner,
		.footer-wrapper,
        .toggle a	
            { background-color:<?php echo esc_html( get_theme_mod('kids_campus_color_scheme','#0f9fbc')); ?>;}
			
		
		.tagcloud a:hover,
		.hdr_social a:hover,
		.welcome_contentbox p,
		h3.widget-title::after,		
		blockquote	        
            { border-color:<?php echo esc_html( get_theme_mod('kids_campus_color_scheme','#0f9fbc')); ?>;}
			
	    .footerbottom .pattern        
            { fill:<?php echo esc_html( get_theme_mod('kids_campus_color_scheme','#0f9fbc')); ?>;}								
		
         	
    </style> 
<?php                
}
         
add_action('wp_head','kids_campus_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kids_campus_customize_preview_js() {
	wp_enqueue_script( 'kids_campus_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '19062019', true );
}
add_action( 'customize_preview_init', 'kids_campus_customize_preview_js' );