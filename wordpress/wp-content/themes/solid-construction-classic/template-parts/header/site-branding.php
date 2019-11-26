<div id="header-content">
	<div class="wrapper">
		<div class="site-header-main layout-two">
			<div class="site-branding">
				<?php
				if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
				    the_custom_logo();
				?>

				<?php endif; // has_custom_logo check. ?>

				<div class="site-identity">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>

					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div>
			</div><!-- .site-branding -->
			<div class="site-header-right">
				<?php if ( has_nav_menu( 'social-header-right' ) ) : ?>
						<nav id="social-header-right" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Header Right Social Links Menu', 'solid-construction-classic' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'social-header-right',
									'container'       => 'div',
									'container_class' => 'menu-social-container',
									'depth'           => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>',
								) );
							?>
						</nav><!-- #social-secondary-navigation -->
				<?php endif; ?>
			</div> <!-- .sidebar-header-right -->
		</div> <!-- .site-header-main -->
	</div> <!-- .wrapper -->
</div> <!-- .site-identity -->
