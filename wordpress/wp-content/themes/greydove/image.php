<?php

/**
 * The template for displaying image attachments
 *
 * @since GreyDove 2.0
 */

get_header(); ?>

<?php
/**
 * GreyDove Layout Options
 */
$greydove_site_layout    =   get_theme_mod( 'greydove_layout_options_setting' );
$greydove_layout_class   =   'col-md-8 col-sm-12';

if( $greydove_site_layout == 'left-sidebar' && is_active_sidebar( 'primary' ) ) :
	$greydove_layout_class = 'col-md-8 col-sm-12  order-md-2';
elseif( $greydove_site_layout == 'no-sidebar' || !is_active_sidebar( 'primary' ) ) :
	$greydove_layout_class = 'col-md-10 col-sm-12 align-self-center';
endif;

?>

	<div id="primary" class="content-area row">
		<main id="main" class="site-main <?php echo esc_attr($greydove_layout_class); ?>" role="main">

			<?php
			// Start the loop
			while( have_posts() ) : the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


					<div id="image-navigation" class="navigation image-navigation">
						<div class="nav-links">
							<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'greydove' ) ); ?></div>
							<div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'greydove' ) ); ?></div>
						</div><!-- .nav-links -->
					</div><!-- .image-navigation -->

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">','</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<div class="entry-attachment">
							<?php
							/**
							 * Filter the default greydove image attachment size.
							 *
							 * @since GreyDove 2.0
							 *
							 * @param string $image_size Image size. Default 'large'.
							 */
							$greydove_image_size =   apply_filters( 'greydove_attachment_size', 'large' );

							echo wp_get_attachment_image( get_the_ID(), $greydove_image_size );

							?>

							<div class="caption-text"><?php the_excerpt(); ?></div>


						</div><!-- .entry-attachment -->

						<?php
						the_content();
						wp_link_pages( array(
							'before'        =>  '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'greydove' ) . '</span>',
							'after'         =>  '</div>',
							'link_before'   =>  '<span>',
							'link_after'    =>  '</span>',
							'pagelink'      => '<span class="screen-reader-text">' . __( 'Page', 'greydove' ) . ' </span>%',
							'separator'     => '<span class="screen-reader-text">, </span>',
						) );
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php
						// Retrieve attachment metadata.
						$greydove_metadata   =   wp_get_attachment_metadata();
						if( $greydove_metadata ) {
							printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
								esc_html_x( 'Full size', 'Used before full size attachment link.', 'greydove' ),
								esc_url( wp_get_attachment_url() ),
								absint( $greydove_metadata['width'] ),
								absint( $greydove_metadata['height'] )
							);
						}
						?>

						<?php
						edit_post_link(
							sprintf(
							/* translators: %s: Name of current post */
								__( 'Edit<span class="screen-reader-text"> "%s"', 'greydove' ),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer>
				</article>


				<?php

				the_post_navigation( array(
					'prev_text'     =>  _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent Post Link', 'greydove' ),
				) );

				// If comments are open or we have at least one comment, load up the comment template.
				if( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// End the loop.
			endwhile;
			?>

		</main><!-- .site-main -->
		<?php get_sidebar(); ?>
	</div><!-- content-area -->

<?php get_footer(); ?>