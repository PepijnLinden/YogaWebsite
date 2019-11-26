<?php
/**
 * The template for displaying services content
 *
 * @package Solid_Construction
 */
?>

<?php
$enable_content = get_theme_mod( 'solid_construction_services_option', 'disabled' );

if ( ! solid_construction_check_section( $enable_content ) ) {
	// Bail if services content is disabled.
	return;
}
	$services_posts = solid_construction_get_posts( 'services' );

	if ( empty( $services_posts ) ) {
		return;
	}

	$title     = get_option( 'ect_service_title', esc_html__( 'Services', 'solid-construction' ) );
	$sub_title = get_option( 'ect_service_content' );

?>

<div class="services-section section">
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
				foreach ( $services_posts as $post ) {
					setup_postdata( $post );

					// Include the services content template.
					get_template_part( 'template-parts/services/content', 'services' );
				}

				wp_reset_postdata();
			?>

			<?php
				$target = get_theme_mod( 'solid_construction_services_target' ) ? '_blank': '_self';
				$link   = get_theme_mod( 'solid_construction_services_link', '#' );
				$text   = get_theme_mod( 'solid_construction_services_text', esc_html__( 'View All', 'solid-construction' ) );

				if ( $text ) :
			?>
			<p class="view-all-button">
				<span class="more-button"><a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a></span>
			</p>
			<?php endif; ?>

		</div><!-- .services-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #services-section -->
