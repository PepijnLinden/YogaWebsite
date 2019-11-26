<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head class="no-js">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
	<?php endif; ?>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
    <div class="site-inner">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_attr_e( 'Skip to content', 'greydove' ); ?></a>

        <header id="masthead" class="site-header" role="banner">

        <?php if( greydove_social_search_check() == 1 ) : ?>
         <div class="header-links">
            <div class="container">
	           <?php greydove_social_icons_output(); ?>
            </div>
         </div><!-- .header-link -->
        <?php endif; ?>

        <div class="site-header-main">
            <div class="site-branding container">
            
            	<div class="row">
            		<div class="col-9 align-self-center">


	                <?php if( function_exists( 'the_custom_logo' ) ) : ?> 
					<?php if ( has_custom_logo() ) : 
						?>
						<div class="site-logo"><?php the_custom_logo(); ?></div>
					<?php endif; ?>
				<?php endif; ?>

				<?php	
	                if( is_front_page() && is_home() ) : ?>
	                    <h1 class="site-title">
	                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	                            <?php bloginfo( 'name' ); ?>
	                        </a>
	                    </h1>
	                <?php else : ?>
	                    <p class="site-title">
	                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	                            <?php bloginfo( 'name' ); ?>
	                        </a>
	                    </p>
	                <?php endif;
	                $greydove_description = get_bloginfo( 'description', 'display' );
	                if( $greydove_description || is_customize_preview() ) :
	                ?>
	                    <p class="site-description"><?php echo esc_html( $greydove_description ); ?></p>
	                <?php endif; ?>
            		</div>
            		<div class="col-3 align-self-center">
		                <button id="menu-toggle" class="menu-toggle toggled-on" aria-expanded="true" aria-controls="site-navigation social-navigation"><span class="screen-reader-text"><?php esc_attr_e( 'Menu', 'greydove' ) ?></span></button>
		                
	                    <?php if( get_theme_mod( 'greydove_search_icon_handle', 1 ) ) : ?>
	                        <span class="btn-search fa fa-search icon-button-search"></span>
	                    <?php endif; ?>

            		</div>
            	</div>

            </div><!-- .site-branding -->

            <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <div class="menu-wrapper">
                <div id="site-header-menu" class="site-header-menu clearfix">

                        <nav id="site-navigation" class="main-navigation container" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'greydove' ); ?>">
				            <?php
				            wp_nav_menu( array(
					            'theme_location' => 'primary',
					            'menu_class'     => 'primary-menu',
					            'fallback_cb'    =>  false
				            ) );
				            ?>
                        </nav><!-- .main-navigation -->
                </div><!-- .site-header-menu -->
            </div><!-- .menu-wrapper -->
            <?php endif; ?>

        </div><!-- .site-header-main -->


	    <?php if( is_front_page() || is_home() ) : if( has_custom_header() ) : ?>
	        <!-- Header Image -->
	        <div class="header-image">
			<img src="<?php header_image() ?>">
	        </div>
	    <?php endif; endif; ?>
	
	</header>

        <div id="content" class="site-content container">