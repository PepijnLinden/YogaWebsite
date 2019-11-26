<?php
/**
 * The template for displaying featured content
 *
 * @package Solid_Construction
 */
?>

<?php
$enable_content = get_theme_mod( 'solid_construction_featured_content_option', 'disabled' );

if ( ! solid_construction_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

	$featured_posts = solid_construction_get_posts( 'featured_content' );

	if ( empty( $featured_posts ) ) {
		return;
	}

	$title     = get_option( 'featured_content_title', esc_html__( 'Contents', 'solid-construction' ) );
	$sub_title = get_option( 'featured_content_content' );
?>

<div class="featured-content-section section">
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

		<div class="section-content-wrapper layout-three">

			<?php
				foreach ( $featured_posts as $post ) {
					setup_postdata( $post );

					// Include the featured content template.
					get_template_part( 'template-parts/featured-content/content', 'featured' );
				}

				wp_reset_postdata();
			
			?>

			<?php
				$target = get_theme_mod( 'solid_construction_featured_content_target' ) ? '_blank': '_self';
				$link   = get_theme_mod( 'solid_construction_featured_content_link', '#' );
				$text   = get_theme_mod( 'solid_construction_featured_content_text', esc_html__( 'View All', 'solid-construction' ) );

				if ( $text ) :
			?>
			<p class="view-all-button">
				<span class="more-button"><a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a></span>
			</p>
			<?php endif; ?>

		</div><!-- .featured-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
