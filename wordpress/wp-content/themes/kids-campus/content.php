<?php
/**
 * @package Kids Campus
 */
?>
 <div class="recentpost_listing">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>        
         <?php if (has_post_thumbnail() ){ ?>
			<div class="post-thumb">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
		<?php } ?> 
        
        <header class="entry-header">           
            <h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
            <?php if ( 'post' == get_post_type() ) : ?>
                <div class="blog_postmeta">
                    <div class="post-date"><?php echo get_the_date(); ?></div><!-- post-date --> 
                    <?php if( get_theme_mod( 'kids_campus_hide_postcategory' ) == '') { ?> 
                      <span class="blogpost_cat"><?php the_category( __( ', ', 'kids-campus' ));?></span>
                   <?php } ?>                                             
                </div><!-- .blog_postmeta -->
            <?php endif; ?>
        </header><!-- .entry-header -->
          
        <?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
           	<?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more &rarr;','kids-campus'); ?></a>         
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'kids-campus' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'kids-campus' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
        <div class="clear"></div>
    </article><!-- #post-## -->
</div>