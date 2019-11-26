<?php
/**
 * Template for displaying search forms in GreyDove
 * @since GreyDove 2.0
 */
?>

<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search" id="searchform_topbar" class="search-top-bar-popup search-form">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'greydove' ); ?></span>
		<input type="search" class="search-field-top-bar" id="search-field-top-bar" placeholder="<?php echo esc_html_x( 'Search &hellip;', 'placeholder', 'greydove' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit search-top-bar-submit" id="search-top-bar-submit">
        <span class="fa fa-search header-search-icon"></span>
        <span class="screen-reader-text">
            <?php echo esc_html_x( 'Search', 'submit button', 'greydove' ); ?>
        </span>
    </button>
</form>
