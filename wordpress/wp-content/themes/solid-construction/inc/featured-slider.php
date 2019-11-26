<?php
/**
 * The template for displaying the Slider
 *
 * @package Solid_Construction
 */

if ( ! function_exists( 'solid_construction_featured_slider' ) ) :
	/**
	 * Add slider.
	 *
	 * @uses action hook solid_construction_before_content.
	 *
	 * @since Solid Construction Pro 1.0
	 */
	function solid_construction_featured_slider() {
		if ( solid_construction_is_slider_displayed() ) {

			$output = '
				<div class="slider-content-wrapper section">
					<div class="wrapper">
						<div class="section-content-wrap content-left">
							<div class="cycle-slideshow"
							    data-cycle-log="false"
							    data-cycle-pause-on-hover="true"
							    data-cycle-swipe="true"
							    data-cycle-auto-height=container
							    data-cycle-fx="fade"
								data-cycle-speed="1000"
								data-cycle-timeout="4000"
								data-cycle-loader="true"
								data-cycle-pager="#featured-slider-pager"
								data-cycle-prev="#featured-slider-prev"
        						data-cycle-next="#featured-slider-next"
								data-cycle-slides="> .post-slide"
								>';

			if ( ! get_theme_mod( 'solid_construction_slider_disable_pager' ) ) {
				$output .= '
								<div class="controllers">
									<!-- prev/next links -->
									<div id="featured-slider-prev" class="cycle-prev fa fa-angle-left" aria-label="Previous" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Previous Slide', 'solid-construction' ) . '</span></div>

									<!-- empty element for pager links -->
									<div id="featured-slider-pager" class="cycle-pager"></div>

									<div id="featured-slider-next" class="cycle-next fa fa-angle-right" aria-label="Next" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Next Slide', 'solid-construction' ) . '</span></div>

								</div><!-- .controllers -->';
			}
							// Select Slider
				$output .= solid_construction_post_page_category_slider();

			$output .= '
							</div><!-- .cycle-slideshow -->
						</div><!-- .section-content-wrap -->
					</div><!-- .wrapper -->';

			$output .= '
				</div><!-- .slider-content-wrapper -->';

			echo $output; // WPCS: XSS OK.
		} // End if().
	}
	endif;
add_action( 'solid_construction_slider', 'solid_construction_featured_slider', 10 );

if ( ! function_exists( 'solid_construction_post_page_category_slider' ) ) :
	/**
	 * This function to display featured posts/page/category slider
	 *
	 * @param $options: solid_construction_theme_options from customizer
	 *
	 * @since Solid Construction Pro 1.0
	 */
	function solid_construction_post_page_category_slider() {
		$quantity     = get_theme_mod( 'solid_construction_slider_number', 2 );
		$no_of_post   = 0; // for number of posts
		$post_list    = array();// list of valid post/page ids
		$show_content = get_theme_mod( 'solid_construction_featured_slider_show', 'excerpt' );
		$output       = '';

		$args = array(
			'post_type'           => 'any',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1, // ignore sticky posts
		);

		//Get valid number of posts
			for ( $i = 1; $i <= $quantity; $i++ ) {
				$post_id = '';

					$post_id = get_theme_mod( 'solid_construction_slider_page_' . $i );

				if ( $post_id && '' !== $post_id ) {
					$post_list = array_merge( $post_list, array( $post_id ) );

					$no_of_post++;
				}
			}

			$args['post__in'] = $post_list;

		if ( ! $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;

		$loop = new WP_Query( $args );

		while ( $loop->have_posts() ) :
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			if ( 0 === $loop->current_post ) {
				$classes = 'post post-' . esc_attr( get_the_ID() ) . ' hentry slides displayblock';
			} else {
				$classes = 'post post-' . esc_attr( get_the_ID() ) . ' hentry slides displaynone';
			}

			// Default value if there is no featurd image or first image.
			$image_url = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-1920x820.jpg';

			if ( has_post_thumbnail() ) {
				$image_url = get_the_post_thumbnail_url( get_the_ID(), 'solid-construction-slider' );
			} else {
				// Get the first image in page, returns false if there is no image.
				$first_image_url = solid_construction_get_first_image( get_the_ID(), 'solid-construction-slider', '', true );

				// Set value of image as first image if there is an image present in the page.
				if ( $first_image_url ) {
					$image_url = $first_image_url;
				}
			}

			$more_tag_text = get_theme_mod( 'solid_construction_excerpt_more_text',  esc_html__( 'Continue Reading', 'solid-construction' ) );

			$output .= '
			<div class="post-slide">
				<article class="' . $classes . '">';
					$output .= '
					<div class="slider-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
								<img src="' . esc_url( $image_url ) . '" class="wp-post-image" alt="' . $title_attribute . '">
							</a>
					</div><!-- .slider-image -->
					<div class="entry-container">';

					$output .= the_title( '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2></header>', false );

					if ( 'excerpt' === $show_content ) {
						$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div>';
					} elseif ( 'full-content' === $show_content ) {
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
					}

					$output .= '
					</div><!-- .entry-container -->
				</article><!-- .slides -->
			</div><!-- .post-slide -->';
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // solid_construction_post_page_category_slider.


if ( ! function_exists( 'solid_construction_is_slider_displayed' ) ) :
	/**
	 * Return true if slider image is displayed
	 *
	 */
	function solid_construction_is_slider_displayed() {
		$enable_slider = get_theme_mod( 'solid_construction_slider_option', 'disabled' );

		return solid_construction_check_section( $enable_slider );
	}
endif; // solid_construction_is_slider_displayed.
