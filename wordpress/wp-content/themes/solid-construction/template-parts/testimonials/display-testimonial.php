<?php
/**
 * The template for displaying testimonial items
 *
 * @package Solid_Construction
 */
?>

<?php
$enable = get_theme_mod( 'solid_construction_testimonial_option', 'disabled' );

if ( ! solid_construction_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

$type = get_theme_mod( 'solid_construction_testimonial_type', 'demo' );

	// Get Jetpack options for testimonial.
	$jetpack_defaults = array(
		'page-title' => esc_html__( 'Testimonials', 'solid-construction' ),
	);

	// Get Jetpack options for testimonial.
	$jetpack_options = get_theme_mod( 'jetpack_testimonials', $jetpack_defaults );

	$headline = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'solid-construction' );

	$subheadline = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';


if ( ! $headline && ! $subheadline ) {
	$classes[] = 'no-headline';
}

?>

<div class="testimonial-section section layout-one">
	<div class="wrapper">

		<?php if ( $headline || $subheadline ) : ?>
			<div class="section-heading-wrapper">
			<?php if ( $headline ) : ?>
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
				</div>
			<?php endif; ?>

			<?php if ( $subheadline ) : ?>
				<div class="section-description">
					<?php echo wp_kses_post( $subheadline ); ?>
				</div><!-- .section-description -->
			<?php endif; ?>
			</div><!-- .section-heading-wrap -->
		<?php endif; ?>

		<div class="section-content-wrapper layout-one">
			<?php $slider_select = 1;

			if ( $slider_select ) : ?>
			<div class="cycle-slideshow"
			    data-cycle-log="false"
			    data-cycle-pause-on-hover="true"
			    data-cycle-swipe="true"
			    data-cycle-auto-height=container
				data-cycle-speed="1000"
				data-cycle-timeout="4000"
				data-cycle-loader=false
				data-cycle-prev= .cycle-prev
				data-cycle-next= .cycle-next
				data-cycle-pager="#testimonial-slider-pager"
				data-cycle-slides=".testimonial-slider-wrap"
				>

				<div class="testimonial-slider-wrap">
			<?php endif; ?>
			<?php
				get_template_part( 'template-parts/testimonials/post-types', 'testimonial' );
			?>
				</div><!-- .testimonial-slider-wrap -->
			</div><!-- .cycle-slideshow -->
			<!-- prev/next links -->

			<div class="controller">
					<!-- prev link -->
					<div class="cycle-prev fa fa-angle-left" aria-label="<?php esc_attr_e( 'Previous', 'solid-construction' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Previous Slide', 'solid-construction' ); ?></span></div>

					<!-- empty element for pager links -->
					<div id="testimonial-slider-pager" class="cycle-pager"></div>

					<!-- next link -->
					<div class="cycle-next fa fa-angle-right" aria-label="<?php esc_attr_e( 'Next', 'solid-construction' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Next Slide', 'solid-construction' ); ?></span></div>
				</div><!-- #controller-->

		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- .testimonials-content-wrapper -->
