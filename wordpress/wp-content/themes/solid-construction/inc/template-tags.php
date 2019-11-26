<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Solid_Construction
 */

if ( ! function_exists( 'solid_construction_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function solid_construction_posted_by() {
		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			__( '<span class="author-label">By </span>%s', 'solid-construction' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		if ( ! post_password_required() && comments_open() && get_comments_number() ) {
			echo '<span class="comments-link"><i class="fa fa-comment"></i>';
			comments_popup_link( '', '1', '%', 'comments-num', esc_html__( 'Comments off', 'solid-construction' ) );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'solid_construction_entry_category' ) ) :
	/**
	 * Prints HTML with meta information for the category.
	 */
	function solid_construction_entry_category( $echo = true ) {
		$output          = '';
		$categories_list ='';

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( ' ' );
		} elseif ( 'ect-service' === get_post_type() ) {
			$categories_list = get_the_term_list( get_the_ID(), 'ect-service-type', '', ' ' );
		} elseif ( 'jetpack-portfolio' === get_post_type() ) {
			$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ' ' );
		} elseif ( 'featured-content' === get_post_type() ) {
			$categories_list = get_the_term_list( get_the_ID(), 'featured-content-type', '', ' ' );
		}

		if ( $categories_list && ! is_wp_error( $categories_list ) ) {
			/* translators: 1: list of categories. */
			$output = sprintf( '<span class="cat-links">%1$s%2$s</span>',
				sprintf( _x( '<span class="cat-in">In</span><span class="cat-text screen-reader-text">Categories</span>', 'Used before category names.', 'solid-construction' ) ),
				$categories_list
			); // WPCS: XSS OK.
		}

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
endif;

if ( ! function_exists( 'solid_construction_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function solid_construction_entry_meta() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( __( '<span class="posted-at">Posted at</span>', 'solid-construction' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		solid_construction_entry_category();

		if ( ! post_password_required() && comments_open() && get_comments_number() ) {
			echo '<span class="comments-link"><i class="fa fa-comment"></i>';
			comments_popup_link( '', '1', '%', 'comments-num', esc_html__( 'Comments off', 'solid-construction' ) );
			echo '</span>';
		}
	}
endif;


if ( ! function_exists( 'solid_construction_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function solid_construction_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ' ' );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="cat-text screen-reader-text">Categories</span>', 'Used before category names.', 'solid-construction' ) ),
					$categories_list
				); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list();
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="tags-text screen-reader-text">Tags</span>', 'Used before tag names.', 'solid-construction' ) ),
					$tags_list
				); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'solid-construction' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'solid-construction' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'solid_construction_author_bio' ) ) :
	/**
	 * Prints HTML with meta information for the author bio.
	 */
	function solid_construction_author_bio() {
		if ( '' !== get_the_author_meta( 'description' ) ) {
			get_template_part( 'template-parts/biography' );
		}
	}
endif;

if ( ! function_exists( 'solid_construction_header_title' ) ) :
	/**
	 * Display Header Media Title
	 */
	function solid_construction_header_title() {
		if ( is_front_page() ) {
			echo wp_kses_post( get_theme_mod( 'solid_construction_header_media_title' ) );
		} elseif ( is_singular() ) {
			the_title();
		} elseif ( is_404() ) {
			esc_html_e( 'Oops! That page can&rsquo;t be found.', 'solid-construction' );
		} elseif ( is_search() ) {
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'solid-construction' ), '<span>' . get_search_query() . '</span>' );
		} elseif( is_home() && ! is_front_page() ) {
			single_post_title( '', true );
		} else {
			the_archive_title();
		}
	}
endif;

if ( ! function_exists( 'solid_construction_header_text' ) ) :
	/**
	 * Display Header Media Text
	 */
	function solid_construction_header_text() {
		if ( is_front_page() ) {
			$header_media_text = get_theme_mod( 'solid_construction_header_media_text' );

			echo wp_kses_post( $header_media_text );
		} elseif ( is_404() ) {
			esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'solid-construction' );
		} elseif( is_search() ) {
			// No Header Media Text.
		} else {
			the_archive_description();
		}
	}
endif;


if ( ! function_exists( 'solid_construction_single_image' ) ) :
	/**
	 * Display Single Page/Post Image
	 */
	function solid_construction_single_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( $post) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;
				$metabox_feat_img = get_post_meta( $parent,'solid-construction-featured-image', true );
			} else {
				$metabox_feat_img = get_post_meta( $page_id,'solid-construction-featured-image', true );
			}
		}

		if ( empty( $metabox_feat_img ) || ( !is_page() && !is_single() ) ) {
			$metabox_feat_img = 'default';
		}

		$featured_image = 'disabled';

		if ( ( 'disabled' == $metabox_feat_img  || ! has_post_thumbnail() || ( 'default' == $metabox_feat_img && 'disabled' == $featured_image ) ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $metabox_feat_img ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $metabox_feat_img;
				$featured_image = $metabox_feat_img;
			}

			?>
			<div class="post-thumbnail <?php echo esc_attr( $class ); ?>">
                <?php the_post_thumbnail( $featured_image ); ?>
	        </div>
	   	<?php
		}
	}
endif;

if ( ! function_exists( 'solid_construction_archive_image' ) ) :
	/**
	 * Display Post Archive Image
	 */
	function solid_construction_archive_image() {
		if ( ! has_post_thumbnail() ) {
			// Bail if there is no featured image.
			return;
		}

		?>
		<div class="post-thumbnail archive-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div><!-- .post-thumbnail -->
		<?php
	}
endif; // solid_construction_archive_image.
