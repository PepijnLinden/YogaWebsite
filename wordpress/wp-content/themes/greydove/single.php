<?php get_header(); ?>

<?php
/**
 * GreyDove Layout Options
 */
$greydove_site_layout    =   get_theme_mod( 'greydove_layout_options_setting' );
$greydove_layout_class   =   'col-md-8 col-sm-12';

if( $greydove_site_layout == 'left-sidebar' && is_active_sidebar( 'primary' ) ) :
	$greydove_layout_class = 'col-md-8 col-sm-12  order-md-2';
elseif( $greydove_site_layout == 'no-sidebar' || !is_active_sidebar( 'primary' ) ) :
	$greydove_layout_class = 'col-md-10 col-sm-12';
endif;

?>

	<div id="primary" class="content-area row">
		<main id="main" class="site-main <?php echo esc_attr($greydove_layout_class); ?>" role="main">

			<?php
			// Start the loop
			while( have_posts() ) : the_post();

                // Include the single post content template.
                get_template_part( 'template-parts/content', 'single' );

                if( is_singular( 'attachment' ) ) {
	                // Parent post navigation.
                    the_post_navigation( array(
                            'prev_text'     =>  _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'greydove' ),
                    ) );
                } elseif( is_singular( 'post' ) ) {
	                // Previous/next post navigation.
                    the_post_navigation( array(
                            'next_text'     =>  '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'greydove' ) . '</span>' . '<span class="screen-reader-text">' . __( 'Next post:', 'greydove' ) . '</span> ' . '<span class="post-title">%title</span>' ,
                            'prev_text'     =>  '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'greydove' ) . '</span>' . '<span class="screen-reader-text">' . __( 'Previous post:', 'greydove' ) . '</span> ' . '<span class="post-title">%title</span>' ,
                    ) );
                }

                // If comments are open or we have at least one comment, load up the comment template.
                if( comments_open() || get_comments_number() ) {
                    comments_template();
                }

            // End the loop
			endwhile;

			?>

		</main><!-- .site-main -->
		<?php get_sidebar(); ?>
	</div><!-- content-area -->

<?php get_footer(); ?>