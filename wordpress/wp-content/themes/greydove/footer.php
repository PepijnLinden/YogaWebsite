<?php
/**
 * The template for displaying the footer section
 *
 * @since GreyDove 2.0
 */
?>

        </div><!-- .site-content -->
        
        <?php
            /**
             * In case you want to disable the footer.
             */
            $greydove_footer = apply_filters( 'greydove_display_footer', true );

            if( $greydove_footer ) :
        ?>
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="site-info container">

			<?php $greydove_bloginfo_name = get_bloginfo( 'name' ); ?>
			<?php $greydove_bloginfo_description = get_bloginfo( 'description' ); ?>

			<?php if ( !empty( $greydove_bloginfo_name ) || !empty( $greydove_bloginfo_description ) ) : ?>
				<p class="site-credit">
				<?php if ( ! empty( $greydove_bloginfo_name ) ) : ?>
					<?php echo date('Y'); ?> &copy; <a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
				<?php if ( !empty( $greydove_bloginfo_description ) ) : ?>
					<span class="siteinfo-sep"></span><?php bloginfo( 'description' ); ?>
				<?php endif; ?>
				</p>
			<?php endif; ?>


			<p class="wp-credit">
                <?php echo esc_html__( 'Proudly powered by', 'greydove' ); ?>
                <a href="https://wordpress.org/"><?php echo esc_html__( 'WordPress', 'greydove' ); ?></a> <span class="theme-sep"></span>

		    <?php if( is_front_page() || is_home() ) { $greydove_rel = ' rel="designer"'; } else { $greydove_rel = ' rel="nofollow"'; } ?>

			<?php
				$greydove_themeinfo = wp_get_theme();
				echo '<a'. $greydove_rel .' href="' . esc_url($greydove_themeinfo->get( 'AuthorURI' ) ) . '">';
				echo esc_html($greydove_themeinfo->get( 'Name' )) . esc_html__(' WP Theme', 'greydove');
				echo '</a>';
			?>
			</p>
            </div>
        </footer>
        <?php 
            endif; 
        ?>

    </div><!-- site-inner -->
</div><!-- site -->

<?php
$greydove_search_icon_handle      =   get_theme_mod( 'simple_search_icon_handle', 1 );
if( $greydove_search_icon_handle ) :
?>
<div class="search-popup">
	<?php get_search_form(); ?>
     <span class="search-popup-close"><i class="fa fa-times"></i></span>
</div><!-- .search-popup -->

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>