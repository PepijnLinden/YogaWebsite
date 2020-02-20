<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Kids Campus
 */

get_header(); ?>

<div class="container">
    <div id="kc_content_wrap">
        <div class="kc_content_left">
            <header class="page-header">
                <h1 class="entry-title"><?php esc_html_e( '404 Not Found', 'kids-campus' ); ?></h1>                
            </header><!-- .page-header -->
            <div class="page-content">
                <p><?php esc_html_e( 'Looks like you have taken a wrong turn.....<br />Don\'t worry... it happens to the best of us.', 'kids-campus' ); ?></p>  
            </div><!-- .page-content -->
        </div><!-- kc_content_left-->   
        <?php get_sidebar();?>       
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>