<?php
/**
 * The template part for displaying single posts
 * @since GreyDove 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">','</h1>' ); ?>

		<?php greydove_post_thumbnail();  ?>

		<div class="entry-info">
			<?php greydove_entry_meta(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php

		the_content();

		wp_link_pages( array(
			'before'        =>  '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'greydove' ) . '</span>',
			'after'         =>  '</div>',
			'link_before'   =>  '<span>',
			'link_after'    =>  '</span>',
			'pagelink'      => '<span class="screen-reader-text">' . __( 'Page', 'greydove' ) . ' </span>%',
			'separator'     => '<span class="screen-reader-text">, </span>',
		) );

		?>
	</div><!-- .entry-content -->

	<?php

    greydove_entry_footer();

	if( '' !== get_the_author_meta( 'description' ) ) {
		get_template_part( 'template-parts/biography' );
	}

	?>
</article>
