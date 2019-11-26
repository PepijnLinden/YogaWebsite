<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Solid_Construction
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="archive-content-wrap">
				<?php
				if ( is_front_page() ) :
					?>
					<div class="section-heading-wrapper">
						<div class="section-title-wrapper">
							<h2 class="section-title"><?php esc_html_e( 'Recent Posts', 'solid-construction' ) ?></h2>
						</div><!-- .section-title-wrapper -->
					</div><!-- .section-heading-wrap -->
				<?php endif; ?>
				<?php
				if ( have_posts() ) : ?>

					<div id="infinite-post-wrap" class="section-content-wrapper layout-three">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content/content', get_post_format() );

							endwhile;
							?>
					</div> <!-- .section-content-wrapper -->

					<?php
					solid_construction_content_nav();

				else :

					get_template_part( 'template-parts/content/content', 'none' );

				endif; ?>
			</div> <!-- .archive-content-wrap -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
	get_sidebar();

	get_footer();
?>
