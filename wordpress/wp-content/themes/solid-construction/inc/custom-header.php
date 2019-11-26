<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Solid_Construction
 */

// For registration of custom-header, check customizer/header-background-color.php


if ( ! function_exists( 'solid_construction_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see solid_construction_custom_header_setup().
	 */
	function solid_construction_header_style() {
		$header_text_color = get_header_textcolor();

		$header_image = solid_construction_featured_overall_image();

	    if ( $header_image ) : ?>
	        <style type="text/css" rel="header-image">
	            .custom-header:before {
	                background-image: url( <?php echo esc_url( $header_image ); ?>);
					background-position: center top;
					background-repeat: no-repeat;
					background-size: cover;
	            }
	        </style>
	    <?php
	    endif;

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( '#ff6b08' === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

if ( ! function_exists( 'solid_construction_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own solid_construction_featured_image(), and that function will be used instead.
	 *
	 * @since Solid Construction 1.0
	 */
	function solid_construction_featured_image() {
		$thumbnail = is_front_page() ? 'solid-construction-header-inner' : 'solid-construction-slider';

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

			if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {
				$image = wp_get_attachment_image_src( (int) $jetpack_options['featured-image'], $thumbnail );
				return $image['0'];
			} else {
				return false;
			}
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) || is_post_type_archive( 'featured-content' ) || is_post_type_archive( 'ect-service' ) ) {
			$option = '';

			if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
				$option = 'jetpack_portfolio_featured_image';
			} elseif ( is_post_type_archive( 'featured-content' ) ) {
				$option = 'featured_content_featured_image';
			} elseif ( is_post_type_archive( 'ect-service' ) ) {
				$option = 'ect_service_featured_image';
			}

			$featured_image = get_option( $option );

			if ( '' !== $featured_image ) {
				$image = wp_get_attachment_image_src( (int) $featured_image, $thumbnail );
				return $image[0];
			} else {
				return get_header_image();
			}
		} elseif ( is_header_video_active() && has_header_video() ) {
			return true;
		} else {
			return get_header_image();
		}
	} // solid_construction_featured_image
endif;

if ( ! function_exists( 'solid_construction_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own solid_construction_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Solid Construction 1.0
	 */
	function solid_construction_featured_page_post_image() {
		if ( is_home() && $blog_id = get_option('page_for_posts') ) {
		    return get_the_post_thumbnail_url( $blog_id, $thumbnail );
		} elseif ( ! has_post_thumbnail() || is_front_page() ) {
			return solid_construction_featured_image();
		}

		$thumbnail = is_front_page() ? 'solid-construction-header-inner' : 'solid-construction-slider';

		return get_the_post_thumbnail_url( get_the_id(), $thumbnail );
	} // solid_construction_featured_page_post_image
endif;

if ( ! function_exists( 'solid_construction_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own solid_construction_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Solid Construction 1.0
	 */
	function solid_construction_featured_overall_image() {
		global $post, $wp_query;
		$enable = get_theme_mod( 'solid_construction_header_media_option', 'exclude-home-page-post' );

		// Get Page ID outside Loop
		$page_id = absint( $wp_query->get_queried_object_id() );

		$page_for_posts = absint( get_option( 'page_for_posts' ) );

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() ) {
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'solid-construction-header-image', true );

			if ( 'disable' === $individual_featured_image || ( 'default' === $individual_featured_image && 'disable' === $enable ) ) {
				return;
			} elseif ( 'enable' == $individual_featured_image && 'disable' === $enable ) {
				return solid_construction_featured_page_post_image();
			}
		}

		// Check Homepage
		if ( 'homepage' === $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return solid_construction_featured_image();
			}
		} elseif ( 'exclude-home' === $enable ) {
			// Check Excluding Homepage
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return false;
			} else {
				return solid_construction_featured_image();
			}
		} elseif ( 'exclude-home-page-post' === $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return false;
			} elseif ( is_singular() ) {
				return solid_construction_featured_page_post_image();
			} else {
				return solid_construction_featured_image();
			}
		} elseif ( 'entire-site' === $enable ) {
			// Check Entire Site
			return solid_construction_featured_image();
		} elseif ( 'entire-site-page-post' === $enable ) {
			// Check Entire Site (Post/Page)
			if ( is_singular() || ( is_home() && $page_for_posts === $page_id ) ) {
				return solid_construction_featured_page_post_image();
			} else {
				return solid_construction_featured_image();
			}
		} elseif ( 'pages-posts' === $enable ) {
			// Check Page/Post
			if ( is_singular() ) {
				return solid_construction_featured_page_post_image();
			}
		}

		return false;
	} // solid_construction_featured_overall_image
endif;

if ( ! function_exists( 'solid_construction_header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * @since Solid Construction 1.0
	 */
	function solid_construction_header_media_text() {
		if ( ! solid_construction_has_header_media_text() ) {
			// Bail early if header media text is disabled
			return false;
		}
		?>
		<div class="custom-header-content">

			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<?php solid_construction_header_title(); ?>
					</h1>
				</header>
				<div class="entry-summary">
					<?php solid_construction_header_text(); ?>

					<?php if ( is_front_page() && $header_media_url = get_theme_mod( 'solid_construction_header_media_url', '' ) ) : ?>
					<span class="more-button"><a href="<?php echo esc_url( $header_media_url ); ?>" target="<?php echo get_theme_mod( 'solid_construction_header_url_target' ) ? '_blank' : '_self'; ?>" class="more-link"><?php echo esc_html( get_theme_mod( 'solid_construction_header_media_url_text' ) ); ?><span class="screen-reader-text"><?php echo wp_kses_post( get_theme_mod( 'solid_construction_header_media_title' ) ); ?></span></a></span>
					<?php endif; ?>
				</div>
			</div> <!-- entry-container -->

			<?php get_template_part( 'template-parts/header/breadcrumb' ); ?>

		</div> <!-- .custom-header-content -->
		<?php
	} // solid_construction_header_media_text.
endif;

if ( ! function_exists( 'solid_construction_has_header_media_text' ) ):
	/**
	 * Return Header Media Text fro front page
	 *
	 * @since Solid Construction 0.1
	 */
	function solid_construction_has_header_media_text() {
		if ( ( is_singular() && ! is_front_page() ) || is_archive() || is_search() || is_404() ) {
			// Header media text is true for single but not front page, archive, search and 404 pages.
			return true;
		}


		$header_media_title    = get_theme_mod( 'solid_construction_header_media_title' );
		$header_media_text     = get_theme_mod( 'solid_construction_header_media_text' );
		$header_media_url      = get_theme_mod( 'solid_construction_header_media_url', '' );
		$header_media_url_text = get_theme_mod( 'solid_construction_header_media_url_text' );

		if ( is_front_page() && ! $header_media_title && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) {
			// Header Media text Disabled
			return false;
		}

		return true;
	} // solid_construction_has_header_media_text.
endif;
