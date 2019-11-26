<?php
/**
 * The template for displaying portfolio content
 *
 * @package Solid_Construction
 */
?>

<?php
$enable_content = get_theme_mod( 'solid_construction_portfolio_option', 'disabled' );

if ( ! solid_construction_check_section( $enable_content ) ) {
	// Bail if portfolio content is disabled.
	return;
}

$type = get_theme_mod( 'solid_construction_portfolio_type', 'demo' );

	$portfolio_posts = solid_construction_get_posts( 'portfolio' );

	if ( empty( $portfolio_posts ) ) {
		return;
	}

	$title     = get_option( 'jetpack_portfolio_title', esc_html__( 'Portfolio', 'solid-construction' ) );
	$sub_title = get_option( 'jetpack_portfolio_content' );

?>

<div class="portfolio-section section">
	<div class="wrapper">
		<?php if ( '' !== $title || '' !== $sub_title ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( '' !== $title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( '' !== $sub_title ) : ?>
					<div class="section-description">
						<?php echo wp_kses_post( $sub_title ); ?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper layout-five">

			<?php
				$i = 1;
				foreach ( $portfolio_posts as $post ) {
					setup_postdata( $post );
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php
									$thumbnail = 'solid-construction-portfolio';

									if ( 1 === $i ) {
										$thumbnail = 'solid-construction-portfolio-first';
									}

									if ( has_post_thumbnail() ) {
										the_post_thumbnail( $thumbnail );
									}
									else {
										$image = '<img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-340x340.jpg"/>';

										if (  'solid-construction-portfolio-first' === $thumbnail ) {
											$image = '<img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-1024x1024.jpg"/>';
										}

										// Get the first image in page, returns false if there is no image.
										$first_image = solid_construction_get_first_image( $post->ID, $thumbnail, '' );

										// Set value of image as first image if there is an image present in the page.
										if ( $first_image ) {
											$image = $first_image;
										}

										echo $image;
									}
									?>
								</a>
							</div><!-- .post-thumbnail -->

							<?php the_title( '<div class="entry-container"><header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2></header></div><!-- .entry-container -->' ); ?>
						</div> <!-- .hentry-inner -->
					</article> <!-- .article -->
					<?php
					$i++;
				}

				wp_reset_postdata();
			?>

			<?php
				$target = get_theme_mod( 'solid_construction_portfolio_target' ) ? '_blank': '_self';
				$link   = get_theme_mod( 'solid_construction_portfolio_link', '#' );
				$text   = get_theme_mod( 'solid_construction_portfolio_text', esc_html__( 'View All', 'solid-construction' ) );

				if ( $text ) :
			?>
			<p class="view-all-button">
				<span class="more-button"><a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a></span>
			</p>
			<?php endif; ?>
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- .portfolio-section -->
