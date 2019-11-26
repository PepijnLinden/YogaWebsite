<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Solid_Construction
 */
?>
<div class="review-slide">
	<div class="hentry-wrap">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'solid-construction-testimonial' ); ?>
				</div>
			<?php endif; ?>

			<div class="entry-container">
				<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>

				<?php if ( $position ) : ?>
					<header class="entry-header">
						<?php
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
					
						if ( $position ) {
						echo '<div class="entry-meta"><span class="position">' . esc_html( $position ) . '</span></div>';
						}
						?>
					</header>
				<?php endif;?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			</div><!-- .entry-container -->
		</article>
	</div><!-- .hentry-wrap -->
</div><!-- review-slide -->
