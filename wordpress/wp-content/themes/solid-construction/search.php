<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Solid_Construction
 */

get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="archive-content-wrap">

				<?php if ( have_posts() ) : ?>

					<div id="infinite-post-wrap" class="section-content-wrapper layout-three">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content/content', 'search' );

						endwhile;
						?>
					</div> <!-- .section-content-wrapper -->

					<?php
					solid_construction_content_nav();

				else :

					get_template_part( 'template-parts/content/content', 'none' );

				endif; ?>
			</div><!-- .archive-content-wrap -->
		</main><!-- #main -->
	</section><!-- #primary -->
<?php
get_sidebar();
get_footer();
