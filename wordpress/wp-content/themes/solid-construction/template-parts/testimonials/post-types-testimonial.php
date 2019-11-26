<?php
/**
 * The template for displaying testimonial items
 *
 * @package Solid_Construction
 */
?>

<?php
$number = get_theme_mod( 'solid_construction_testimonial_number', 4 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$type = get_theme_mod( 'solid_construction_testimonial_type', 'demo' );

$post_list  = array();// list of valid post/page ids

$no_of_post = 0; // for number of posts

	$args['post_type'] = 'jetpack-testimonial';

	for ( $i = 1; $i <= $number; $i++ ) {
		$post_id = '';

			$post_id =  get_theme_mod( 'solid_construction_testimonial_cpt_' . $i );

		if ( $post_id && '' !== $post_id ) {
			// Polylang Support.
			if ( class_exists( 'Polylang' ) ) {
				$post_id = pll_get_post( $post_id, pll_current_language() );
			}

			$post_list = array_merge( $post_list, array( $post_id ) );

			$no_of_post++;
		}
	}

	$args['post__in'] = $post_list;

if ( 0 === $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;
$loop     = new WP_Query( $args );

$slider_select = 1;

	$layouts = 1;

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		get_template_part( 'template-parts/testimonials/content', 'testimonial' );

		$i = absint( $loop->current_post + 1 );

		//end and start testimonial-slider-wrap div based on logic
		if ( 0 === ( $i % $layouts ) && $i < $no_of_post && $slider_select ) : ?>
			</div><!-- .testimonial-slider-wrap -->

			<div class="testimonial-slider-wrap">
		<?php
		endif;
	endwhile;
	wp_reset_postdata();
endif;
