<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Solid_Construction
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists('solid_construction_body_classes' ) ):

function solid_construction_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Navigation classic or modern
		$classes[] = 'navigation-classic';

	// Header classic or modern
		$classes[] = 'header-modern';

	// Site content classic
		$classes[] = 'content-classic';

	// Adds a class with respect to layout selected.
	$layout  = solid_construction_get_theme_layout();
	$sidebar = solid_construction_get_sidebar_id();

	if ( 'no-sidebar-full-width' === $layout ) {
		$classes[] = 'no-sidebar full-width-layout';
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$classes[] = 'two-columns-layout content-left';
		}
	}

	// Adds a class of fluid layout to blogs.
		$classes[] = 'fluid-layout';


	$header_image = solid_construction_featured_overall_image();

	if ( '' == $header_image ) {
		$classes[] = 'no-header-media-image';
	}

	$header_text_enabled = solid_construction_has_header_media_text();

	if ( ! $header_text_enabled ) {
		$classes[] = 'no-header-media-text';
	}

	return $classes;
}
endif;
add_filter( 'body_class', 'solid_construction_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function solid_construction_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'solid_construction_pingback_header' );

/**
 * Remove first post from blog as it is already show via recent post template
 */
function solid_construction_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = get_theme_mod( 'solid_construction_front_page_category' );

		if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] = $cats;
		}
	}
}
add_action( 'pre_get_posts', 'solid_construction_alter_home' );

/**
 * Function to add Scroll Up icon
 */
function solid_construction_scrollup() {
	$disable_scrollup = get_theme_mod( 'solid_construction_disable_scrollup' );

	if ( $disable_scrollup ) {
		return;
	}

	echo '
		<div class="scrollup">
			<a href="#masthead" id="scrollup" class="fa fa-sort-asc" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'solid-construction' ) . '</span></a>
		</div>' ;
}
add_action( 'wp_footer', 'solid_construction_scrollup', 1 );

if ( ! function_exists( 'solid_construction_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * @since Personal Trainer Pro 1.0
	 */
	function solid_construction_content_nav() {
		global $wp_query;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$pagination_type = get_theme_mod( 'solid_construction_pagination_type', 'default' );

		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			the_posts_navigation();
		} elseif ( 'numeric' === $pagination_type && function_exists( 'the_posts_pagination' ) ) {
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous', 'solid-construction' ),
				'next_text'          => esc_html__( 'Next', 'solid-construction' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'solid-construction' ) . ' </span>',
			) );
		} else {
			the_posts_navigation();
		}
	}
endif; // solid_construction_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function solid_construction_check_section( $value ) {
	global $wp_query;

	// Get Page ID outside Loop
	$page_id = absint( $wp_query->get_queried_object_id() );

	// Front page displays in Reading Settings
	$page_for_posts = absint( get_option( 'page_for_posts' ) );

	return ( 'entire-site' == $value  || ( ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) && 'homepage' == $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Personal Trainer Pro 1.0
 */

function solid_construction_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field( 'post_content', $postID ) , $matches );

	if( isset( $matches[1][0] ) ) {
		//Get first image
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="pngfix wp-post-image" src="' . $first_img . '">';
	}

	return false;
}

/**
 * Return current theme layout with respect to the page template chosen, or default layout chosen including separate layout for WooCommerce
 * @return string Layout
 */
function solid_construction_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'solid_construction_default_layout', 'right-sidebar' );

		if ( is_home() || is_archive() || is_search() ) {
			$layout = get_theme_mod( 'solid_construction_homepage_archive_layout', 'no-sidebar-full-width' );
		}
	}

	return $layout;
}

function solid_construction_get_sidebar_id() {
	$sidebar = '';

	$layout = solid_construction_get_theme_layout();

	$sidebaroptions = '';

	if ( 'no-sidebar-full-content-width' === $layout || 'no-sidebar-full-width' === $layout || 'no-sidebar' === $layout ) {
		return $sidebar;
	}

		global $post, $wp_query;

		// Front page displays in Reading Settings.
		$page_on_front  = get_option( 'page_on_front' );
		$page_for_posts = get_option( 'page_for_posts' );

		// Get Page ID outside Loop.
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings.
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
			$sidebaroptions = get_post_meta( $page_id, 'solid-construction-sidebar-option', true );
		} elseif ( is_singular() ) {
			if ( is_attachment() ) {
				$parent 		= $post->post_parent;
				$sidebaroptions = get_post_meta( $parent, 'solid-construction-sidebar-option', true );

			} else {
				$sidebaroptions = get_post_meta( $post->ID, 'solid-construction-sidebar-option', true );
			}
		}


	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}
	return $sidebar;
}

/**
 * Get Featured Posts
 */
function solid_construction_get_posts( $section ) {
	$type   = 'featured-content';
	$number = get_theme_mod( 'solid_construction_featured_content_number', 3 );

	if ( 'featured_content' === $section ) {
		$type     = 'featured-content';
		$number   = get_theme_mod( 'solid_construction_featured_content_number', 6 );
		$cpt_slug = 'featured-content';
	} elseif ( 'services' === $section ) {
		$type     = 'ect-service';
		$number   = get_theme_mod( 'solid_construction_services_number', 3 );
		$cpt_slug = 'ect-service';
	} elseif ( 'portfolio' === $section ) {
		$type     = 'jetpack-portfolio';
		$number   = get_theme_mod( 'solid_construction_portfolio_number', 5 );
		$cpt_slug = 'jetpack-portfolio';
	} elseif ( 'testimonial' === $section ) {
		$type     = get_theme_mod( 'solid_construction_testimonial_type', 'demo' );
		$number   = get_theme_mod( 'solid_construction_testimonial_number', 4 );
		$cpt_slug = 'jetpack-testimonial';
	} elseif ( 'news' === $section ) {
		$type     = 'page';
		$number   = get_theme_mod( 'solid_construction_news_number', 3 );
		$cpt_slug = ''; // Event has no cpt.
	}

	$post_list  = array();
	$no_of_post = 0;

	$args = array(
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type || $cpt_slug === $type )
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'solid_construction_' . $section . '_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'solid_construction_' . $section . '_page_' . $i );
			} elseif ( $cpt_slug === $type ) {
				$post_id = get_theme_mod( 'solid_construction_' . $section . '_cpt_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';


	$args['posts_per_page'] = $no_of_post;

	if( ! $no_of_post ) {
		return;
	}

	$posts = get_posts( $args );

	return $posts;
}
