<?php
/**
 * The template for displaying news content
 *
 * @package Solid_Construction
 */
?>

<?php
$enable_content = get_theme_mod( 'solid_construction_news_option', 'disabled' );

if ( ! solid_construction_check_section( $enable_content ) ) {
	// Bail if news content is disabled.
	return;
}

	$news_posts = solid_construction_get_posts( 'news' );

	if ( empty( $news_posts ) ) {
		return;
	}

	$title     = 'News';

?>

<div class="news-section section">
	<div class="wrapper">
			<div class="section-heading-wrapper">
				<?php if ( '' !== $title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->

		<div class="section-content-wrapper layout-three">

			<?php
				foreach ( $news_posts as $post ) {
					setup_postdata( $post );

					// Include the news content template.
					get_template_part( 'template-parts/news/content', 'news' );
				}

				wp_reset_postdata();
			
			?>

			<?php
				$target = get_theme_mod( 'solid_construction_news_target' ) ? '_blank': '_self';
				$link   = get_theme_mod( 'solid_construction_news_link', '#' );
				$text   = get_theme_mod( 'solid_construction_news_text', esc_html__( 'View All', 'solid-construction' ) );

				if ( $text ) :
			?>
			<p class="view-all-button">
				<span class="more-button"><a class="more-link" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a></span>
			</p>
			<?php endif; ?>

		</div><!-- .news-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #news-section -->
