<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Solid_Construction
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="entry-container">
			<header class="entry-header">

				<?php

				$show_meta    = get_theme_mod( 'solid_construction_archive_meta_show', 'show-meta' ); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
				<?php endif; ?>

				<?php if ( 'show-meta' === $show_meta ) : ?>
					<div class="entry-meta">
						<?php solid_construction_entry_meta(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
