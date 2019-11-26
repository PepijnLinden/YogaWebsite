<?php
/**
 * Displays an optional post thumbnail.
 *
 * @since GreyDove 2.0
 */
function greydove_post_thumbnail() {
	if( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if( is_singular() ) : ?>

		<div class="entry-thumbnail">
			<?php the_post_thumbnail('large'); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<a class="entry-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail( 'large', array(
				'alt'       =>  the_title_attribute( 'echo=0' )
			) ); ?>
		</a>

	<?php endif; // End is_singular()
}

/**
 * Displays the optional excerpt.
 *
 * @since GreyDove 2.0
 */
function greydove_excerpt( $class = 'entry-summary' ) {
    $class = esc_attr( $class );

    if( ! is_single() ) : ?>
        <div class="<?php echo $class; ?>">
            <?php the_excerpt(); ?>
        </div>
    <?php endif;
}

/**
 * Prints HTML with meta information
 * Includes post author, date, and edit link
 * @since GreyDove 2.0
 */
function greydove_entry_meta() {

    greydove_entry_author();
    echo ' <span class="sep"></span> ';
    greydove_entry_date();

    edit_post_link(
	    sprintf(
	    /* translators: %s: Name of current post */
		    __( 'Edit<span class="screen-reader-text"> "%s"', 'greydove' ),
		    get_the_title()
	    ),
	    ' <i class="fa fa-edit"></i> <span class="edit-link">',
	    '</span>'
    );


}

/**
 * Prints HTML with post author information
 *
 * @since GreyDove 2.0
 */

function greydove_entry_author() {

    $author_id  =   get_the_author_meta( 'ID' );
    $author_url =   get_author_posts_url( $author_id );

	printf( 
		'<span class="author-info"><i class="fa fa-user"></i> <a href="%1$s">%2$s</a></span>', 
		esc_url( $author_url ), 
		esc_html( get_the_author_meta( 'display_name', $author_id ) ) 
	);

}

/**
 * Prints HTML with post date information
 *
 * @since GreyDove 2.0
 */
function greydove_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="posted-on"><i class="fa fa-calendar"></i> %1$s</span>',
		$time_string
	);
}

/**
 * Prints HTML with archive pagination links
 *
 * @since GreyDove 2.0
 */
function greydove_page_navigation() {

	$linkargs = array(
		'mid_size' => 2,
		'prev_text' => __('Previous', 'greydove'),
		'next_text' => __('Next', 'greydove'),
	);

	the_posts_pagination($linkargs);
}

/**
 * Prints HTML with meta information in footer
 * Includes post category, tags, and read more link on index pages
 *
 * @since GreyDove 2.0
 */
function greydove_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'greydove' );

	// Get Categories for posts.
    $categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
    $tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
    if( ( $categories_list || $tags_list ) || get_edit_post_link() ) :

        echo '<footer class="entry-footer clearfix">';

        if( 'post' === get_post_type() && is_singular() ) {

            if( $categories_list || $tags_list ) {

                    echo '<span class="cat-tags-links">';

	                // Make sure there's more than one category before displaying.
                    if( $categories_list ) {
                        echo '<span class="cat-links">' . '<span class="cat-icon"><i class="fa fa-folder-open"></i></span>' . '<span class="screen-reader-text">' . esc_html__( 'Categories', 'greydove' ) . '</span>' . $categories_list . '</span>';
                    }

		          if ( $tags_list ) {
			          echo '<span class="tags-links">' . '<span class="tags-icon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>' . '<span class="screen-reader-text">' . esc_html__( 'Tags', 'greydove' ) . '</span>' . $tags_list . '</span>';
		          }

                    echo '</span>';

                }

        }

        if( 'post' === get_post_type() && !is_singular() ) {
			   echo '<p class="read-more pull-right btn btn-sm"><a href="'. esc_url( get_the_permalink() ) .'">' . esc_html__( 'Read more', 'greydove' ) .' <i class="fa fa-chevron-right"></i></a></p>';
        	   
        }
        	
        echo '</footer>';

    endif;
}

/**
 * Define custom replacement for the excerpt more trim text
 *
 * @since GreyDove 2.0
 */
function greydove_custom_excerpt_more() {
	return '...';
}
add_filter( 'excerpt_more', 'greydove_custom_excerpt_more' );