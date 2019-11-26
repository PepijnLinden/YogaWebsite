<?php
/**
 * The template part for displaying the Image post type
 * In future: upgrade to get_embedded_media() 

 *
 * @since GreyDove 2.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

    <div class="entry-content">
        <?php the_content(); ?>
    </div><!-- .entry-content -->

	<?php greydove_entry_footer();	?>
</article>
