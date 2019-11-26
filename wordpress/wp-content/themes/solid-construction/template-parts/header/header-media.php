<?php
/**
 * Display Header Media
 *
 * @package Solid_Construction
 */
?>

<?php
	$header_image = solid_construction_featured_overall_image();

	if ( '' == $header_image && ! solid_construction_has_header_media_text() ) {
		// Bail if all header media are disabled.
		return;
	}
?>
<div class="custom-header">
	<div class="custom-header-media">
		<?php
		if ( is_header_video_active() && has_header_video() ) {
			the_custom_header_markup();
		} elseif ( $header_image ) {
			echo '<img src="' . esc_url( $header_image ) . '"/>';
		}
		?>
	</div>

	<?php solid_construction_header_media_text(); ?>
</div><!-- .custom-header -->
