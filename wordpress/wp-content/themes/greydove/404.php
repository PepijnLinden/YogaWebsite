<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @since GreyDove 2.0
 */

get_header();
?>


	<div id="primary" class="content-area row">
		<main id="main" class="site-main col-md-8 col-sm-12" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'greydove' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'greydove' ); ?></p>
				</div>

				<?php get_search_form(); ?>
			</section>

		</main><!-- .site-main -->
		<?php get_sidebar(); ?>
	</div><!-- content-area -->

<?php get_footer(); ?>