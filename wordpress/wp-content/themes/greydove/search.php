<?php get_header(); ?>

<?php
/**
 * GreyDove Layout Options
 */
$greydove_site_layout    =   get_theme_mod( 'greydove_layout_options_setting' );
$greydove_layout_class   =   'col-md-8 col-sm-12';

if( $greydove_site_layout == 'left-sidebar' && is_active_sidebar( 'primary' ) ) :
	$greydove_layout_class = 'col-md-8 col-sm-12 order-md-2';
elseif( $greydove_site_layout == 'no-sidebar' || !is_active_sidebar( 'primary' ) ) :
	$greydove_layout_class = 'col-md-10 col-sm-12';
endif;

?>

	<div id="primary" class="content-area row">
		<main id="main" class="site-main <?php echo esc_attr($greydove_layout_class); ?>" role="main">

			<?php
			if( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
                        <?php
                        /* translators: %s: search query */
                        printf( esc_html__( 'Search Results for: %s', 'greydove') , '<span>' . esc_html( get_search_query() ) . '</span>' );
                        ?>
                    </h1>
				</header>

				<?php
				// Start the loop
				while( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					// End the loop
				endwhile;

				greydove_page_navigation();

			else :
			get_template_part( 'template-parts/content', 'none' );
			?>
			<?php endif; ?><!-- have_post() -->

		</main><!-- .site-main -->
		<?php get_sidebar(); ?>
	</div><!-- content-area -->

<?php get_footer(); ?>