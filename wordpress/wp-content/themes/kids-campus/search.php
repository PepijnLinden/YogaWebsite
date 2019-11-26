<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Kids Campus
 */

get_header(); ?>

<div class="container">
     <div class="kc_content_wrap">
        <div class="kc_content_left">
            <div class="default_post_style">
				<?php if ( have_posts() ) : ?>
                    <header>
                        <h1 class="entry-title"><?php /* translators: %s: search term */ 
						printf( esc_attr__( 'Search Results for: %s', 'kids-campus' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', 'search' ); ?>
                    <?php endwhile; ?>
                    <?php the_posts_pagination(); ?>
                <?php else : ?>
                    <?php get_template_part( 'no-results' ); ?>
                <?php endif; ?>                  
            </div><!-- default_post_style -->
        </div> <!-- .kc_content_left-->        
       <?php get_sidebar();?>       
        <div class="clear"></div>
    </div><!-- site-aligner -->
</div><!-- container -->

<?php get_footer(); ?>