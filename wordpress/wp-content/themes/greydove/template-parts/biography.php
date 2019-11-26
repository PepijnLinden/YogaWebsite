<?php
/**
 * The template part for displaying an Author biography
 *
 * @since GreyDove 2.0
 */
?>

<?php
/**
 * GreyDove Layout Options
 */
$greydove_authorbio    =   get_theme_mod( 'greydove_author_bio' );
if (! $greydove_authorbio ) return;
?>


<div class="entry-author-info clearfix">
	<div class="author-avatar">
		<?php
		/**
		* Filter the GreyDove author bio avatar size.
		*
		* @since GreyDove 2.0
		*
		* @param int $size The avatar height and width size in pixels.
		*/

		$greydove_author_avatar_size = apply_filters( 'greydove_author_bio_avatar_size', 80 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $greydove_author_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<p class="author-title">
			<?php echo wp_kses_post(get_the_author_posts_link()); ?>
		</p>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->
