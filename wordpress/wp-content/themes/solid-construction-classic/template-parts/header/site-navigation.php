<div id="header-navigation-area" class="nav-search-wrap">
	<div class="wrapper">
		<div id="site-header-menu" class="site-primary-menu layout-two">
			<nav id="site-navigation" class="main-navigation menu-wrapper">
				<div class="menu-toggle-wrapper">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<i class="fa fa-bars" aria-hidden="true"></i>
						<i class="fa fa-times" aria-hidden="true"></i>
						<span class="menu-label"><?php esc_html_e( 'Menu', 'solid-construction-classic' ); ?></span>
					</button>
				</div>

				<div class="menu-inside-wrapper">
					<?php
					wp_nav_menu( array(
						'theme_location'  => 'menu-1',
						'menu_id'         => 'primary-menu',
						'container_class' => 'primary-menu-container',
					) );
					?>
				</div> <!-- .menu-inside-wrapper -->
			</nav><!-- #site-navigation -->

			<div id="social-search-wrapper" class="menu-wrapper">
				<?php get_template_part( 'template-parts/header/top', 'search' ); ?>
			</div> <!-- #social-search-wrapper -->
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
			</div>
		</div> <!-- .site-header-menu -->
	</div> <!-- .wrapper -->
</div><!-- .nav-search-wrap -->
