<?php
/**
 * The theme customizer settings registration
 * Only a part of the customizer defined here
 * Customizer registered in theme-customizer.php in the includes folder 
 * Individual settings defined in files in the includes>customizer folder 
 *
 * @since GreyDove 2.0
 */

function greydove_social_icons( $wp_customize ) {

	/**
	 * Social Settings Section
	 */
	$wp_customize->add_section( 'greydove_social_section', array(
		'title'                 =>  esc_html__( 'Social Settings', 'greydove' ),
		'panel'                 =>  'greydove_panel'
	) );

	/**
	 * Facebook Social Handle Setting
	 */
	$wp_customize->add_setting( 'greydove_facebook_handle', array(
		'default'               =>  '',
		'transport'             =>  'refresh',
        array(
	        'sanitize_callback'     =>  'esc_url_raw',
        )
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'greydove_facebook_social_input',
			array(
				'label'         =>  esc_html__( 'Facebook', 'greydove' ),
				'section'       =>  'greydove_social_section',
				'settings'      =>  'greydove_facebook_handle',
				'type'          =>  'url'
			)
		)
	);

	/**
	 * Twitter Social Handle Setting
	 */
	$wp_customize->add_setting( 'greydove_twitter_handle', array(
		'default'               =>  '',
		'transport'             =>  'refresh',
		array(
			'sanitize_callback'     =>  'esc_url_raw',
		)
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'greydove_twitter_social_input',
			array(
				'label'         =>  esc_html__( 'Twitter', 'greydove' ),
				'section'       =>  'greydove_social_section',
				'settings'      =>  'greydove_twitter_handle',
				'type'          =>  'url'
			)
		)
	);

	/**
	 * Google Plus Social Handle Setting
	 */
	$wp_customize->add_setting( 'greydove_google_plus_handle', array(
		'default'               =>  '',
		'transport'             =>  'refresh',
        array(
	        'sanitize_callback'     =>  'esc_url_raw',
        )
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'greydove_google_plus_social_input',
			array(
				'label'         =>  esc_html__( 'Google Plus', 'greydove' ),
				'section'       =>  'greydove_social_section',
				'settings'      =>  'greydove_google_plus_handle',
				'type'          =>  'url'
			)
		)
	);

	/**
	 * Linkedin Social Handle Setting
	 */
	$wp_customize->add_setting( 'greydove_linkedin_handle', array(
		'default'               =>  '',
		'transport'             =>  'refresh',
		array(
			'sanitize_callback'     =>  'esc_url_raw',
		)
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'greydove_linkedin_social_input',
			array(
				'label'         =>  esc_html__( 'Linkedin', 'greydove' ),
				'section'       =>  'greydove_social_section',
				'settings'      =>  'greydove_linkedin_handle',
				'type'          =>  'url'
			)
		)
	);

	/**
	 * Instagram Social Handle Setting
	 */
	$wp_customize->add_setting( 'greydove_instagram_handle', array(
		'default'               =>  '',
		'transport'             =>  'refresh',
		array(
			'sanitize_callback'     =>  'esc_url_raw',
		)
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'greydove_instagram_social_input',
			array(
				'label'         =>  esc_html__( 'Instagram', 'greydove' ),
				'section'       =>  'greydove_social_section',
				'settings'      =>  'greydove_instagram_handle',
				'type'          =>  'url'
			)
		)
	);


	/**
	 * Pinterest Social Handle Setting
	 */
	$wp_customize->add_setting( 'greydove_pinterest_handle', array(
		'default'               =>  '',
		'transport'             =>  'refresh',
		array(
			'sanitize_callback'     =>  'esc_url_raw',
		)
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'greydove_pinterest_social_input',
			array(
				'label'         =>  esc_html__( 'Pinterest', 'greydove' ),
				'section'       =>  'greydove_social_section',
				'settings'      =>  'greydove_pinterest_handle',
				'type'          =>  'url'
			)
		)
	);

	/**
	 * Email Social Handle Setting
	 */
	$wp_customize->add_setting( 'greydove_email_handle', array(
		'default'               =>  '',
		'transport'             =>  'refresh',
		array(
			'sanitize_callback' => 'sanitize_email'
		)
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'greydove_email_social_input',
			array(
				'label'         =>  esc_html__( 'Email', 'greydove' ),
				'section'       =>  'greydove_social_section',
				'settings'      =>  'greydove_email_handle',
				'type'          =>  'email'
			)
		)
	);

}

/**
 * Prints HTML for social icons
 *
 * @since GreyDove 2.0
 */

function greydove_social_icons_output() {
	$greydove_facebook_handle       =   get_theme_mod( 'greydove_facebook_handle' );
	$greydove_twitter_handle        =   get_theme_mod( 'greydove_twitter_handle' );
	$greydove_google_plus_handle    =   get_theme_mod( 'greydove_google_plus_handle' );
	$greydove_linkedin_handle       =   get_theme_mod( 'greydove_linkedin_handle' );
	$greydove_instagram_handle      =   get_theme_mod( 'greydove_instagram_handle' );
	$greydove_pinterest_handle      =   get_theme_mod( 'greydove_pinterest_handle' );
	$greydove_email_handle          =   get_theme_mod( 'greydove_email_handle' );

	if( $greydove_facebook_handle || $greydove_twitter_handle || $greydove_google_plus_handle || $greydove_linkedin_handle || $greydove_instagram_handle || $greydove_pinterest_handle || $greydove_email_handle ) : ?>
		<div class="social-links">
			<?php if( $greydove_facebook_handle ) : ?>
				<a href="<?php echo esc_url( $greydove_facebook_handle ); ?>" target="_blank"><span class="fa fa-facebook"></span></a>
			<?php endif; ?>

			<?php if( $greydove_twitter_handle ) : ?>
				<a href="<?php echo esc_url( $greydove_twitter_handle ); ?>" target="_blank"><span class="fa fa-twitter"></span></a>
			<?php endif; ?>

			<?php if( $greydove_google_plus_handle ) : ?>
				<a href="<?php echo esc_url( $greydove_google_plus_handle ); ?>" target="_blank"><span class="fa fa-google-plus"></span></a>
			<?php endif; ?>

			<?php if( $greydove_linkedin_handle ) : ?>
				<a href="<?php echo esc_url( $greydove_linkedin_handle ); ?>" target="_blank"><span class="fa fa-linkedin"></span></a>
			<?php endif; ?>

			<?php if( $greydove_instagram_handle ) : ?>
				<a href="<?php echo esc_url( $greydove_instagram_handle ); ?>" target="_blank"><span class="fa fa-instagram"></span></a>
			<?php endif; ?>

			<?php if( $greydove_pinterest_handle ) : ?>
				<a href="<?php echo esc_url( $greydove_pinterest_handle ); ?>" target="_blank"><span class="fa fa-pinterest"></span></a>
			<?php endif; ?>

			<?php if( $greydove_email_handle ) : ?>
			<a href="<?php echo esc_url( 'mailto:' . sanitize_email($greydove_email_handle ) ); ?>" title="<?php echo esc_attr( sanitize_email($greydove_email_handle) ); ?>"><span class="fa fa-envelope"></span></a>
			<?php endif; ?>
		</div>
	<?php
    else :
	    return null;
	endif;
}

/**
 * Function to check if any social link present
 *
 * @since GreyDove 2.0
 */

function greydove_social_search_check() {
	$greydove_facebook_handle       =   get_theme_mod( 'greydove_facebook_handle' );
	$greydove_twitter_handle        =   get_theme_mod( 'greydove_twitter_handle' );
	$greydove_google_plus_handle    =   get_theme_mod( 'greydove_google_plus_handle' );
	$greydove_linkedin_handle       =   get_theme_mod( 'greydove_linkedin_handle' );
	$greydove_instagram_handle      =   get_theme_mod( 'greydove_instagram_handle' );
	$greydove_pinterest_handle      =   get_theme_mod( 'greydove_pinterest_handle' );
	$greydove_email_handle          =   get_theme_mod( 'greydove_email_handle' );

	if( $greydove_facebook_handle || $greydove_twitter_handle || $greydove_google_plus_handle || $greydove_linkedin_handle || $greydove_instagram_handle || $greydove_pinterest_handle || $greydove_email_handle ) :
		return 1;
	else :
		return 0;
	endif;

}