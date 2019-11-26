<?php
/**
 * Template part for displaying Recent Posts in the front page template
 *
 * @package Solid_Construction
 */
?>
<div class="recent-blog-content-wrapper section">
	<div class="wrapper">
		<?php
		$post_title = 'Recent Posts'; ?>

			<div class="section-heading-wrapper">
				<?php if ( '' !== $post_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $post_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
			
		<div class="section-content-wrapper layout-three">
			<?php
			$recent_posts = new WP_Query( array(
				'ignore_sticky_posts' => true,
			) );

			/* Start the Loop */
			while ( $recent_posts->have_posts() ) :
				$recent_posts->the_post();

				get_template_part( 'template-parts/content/content', get_post_format() );

			endwhile;

			wp_reset_postdata();
			?>
		</div><!-- .section-content-wrap -->

		<p class="more-recent-posts"><span class="more-button"><a class="more-link" href="<?php the_permalink( get_option( 'page_for_posts' ) ); ?>"><?php esc_html_e( 'More Posts', 'solid-construction' ); ?></a><span></p>
	</div> <!-- .wrapper -->
</div> <!-- .recent-blog-content-wrapper -->
