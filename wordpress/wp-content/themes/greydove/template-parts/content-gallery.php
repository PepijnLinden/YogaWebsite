<?php
/**
 * The template part for displaying the Gallery post type
 *
 * @since GreyDove 2.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
		<?php the_title( sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <div class="entry-info">
			<?php greydove_entry_meta(); ?>
        </div>
    </header>

    <div class="entry-content">

        <?php if( has_block( 'gallery' ) ) : ?>
	        <?php the_content(); ?>        
        <?php elseif( get_post_gallery() ) : ?>
	        <div class="entry-gallery">
	            <?php echo wp_kses_post(get_post_gallery( get_the_ID(), true )); ?>
	        </div>
	        <?php greydove_excerpt(); ?>
	   <?php endif; ?>

    </div><!-- .entry-content -->

	<?php greydove_entry_footer(); ?>

</article>