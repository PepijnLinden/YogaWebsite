<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Solid_Construction
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php solid_construction_archive_image(); ?>

		<div class="entry-container">
			<?php if ( is_sticky() ) { ?>
			<span class="sticky-label"><?php esc_html_e( 'Featured', 'solid-construction' ); ?></span>
			<?php } ?>

			<header class="entry-header">
				<?php
				$show_meta    = get_theme_mod( 'solid_construction_archive_meta_show', 'show-meta' );

				if ( 'post' === get_post_type() ) :
					if ( 'show-meta' === $show_meta ) : ?>
					<div class="entry-meta">
						<?php solid_construction_entry_meta(); ?>

					</div><!-- .entry-meta -->
					<?php endif;

					if ( is_singular() ) :
						the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;



				endif; ?>
			</header><!-- .entry-header -->


			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		</div> <!-- .entry-container -->
	</div> <!-- .hentry-inner -->
</article><!-- #post-<?php //the_ID(); ?> -->
