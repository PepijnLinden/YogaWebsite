<?php
/**
 * The template part for displaying content
 *
 * @since GreyDove 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">

		<?php the_title( sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	    <?php greydove_post_thumbnail();  ?>

        <div class="entry-info">
            <?php greydove_entry_meta(); ?>
        </div>
    </header>

    <div class="entry-content">
        <?php
        greydove_excerpt();
        ?>
    </div><!-- .entry-content -->

	<?php greydove_entry_footer(); ?>

</article>
