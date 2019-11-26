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
		</div> <!-- .site-header-main -->
	</div> <!-- .wrapper -->
</div> <!-- .site-identity -->
