<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Kids Campus
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	}
?>
<a class="skip-link screen-reader-text" href="#kc_content_wrap">
<?php esc_html_e( 'Skip to content', 'kids-campus' ); ?>
</a>
<?php
$kids_campus_show_hdr_contact_info_part 	= get_theme_mod('kids_campus_show_hdr_contact_info_part', false);
$kids_campus_show_hdr_slider_section 	  		= get_theme_mod('kids_campus_show_hdr_slider_section', false);
$kids_campus_show_services_3col_area 	= get_theme_mod('kids_campus_show_services_3col_area', false);
$kids_campus_show_welcome_page_section	        = get_theme_mod('kids_campus_show_welcome_page_section', false);
$kids_campus_show_hdr_social_area        = get_theme_mod('kids_campus_show_hdr_social_area', false);
?>
<div id="sitelayout" <?php if( get_theme_mod( 'kids_campus_boxlayout' ) ) { echo 'class="boxlayout"'; } ?>>
<?php
if ( is_front_page() && !is_home() ) {
	if( !empty($kids_campus_show_hdr_slider_section)) {
	 	$inner_cls = '';
	}
	else {
		$inner_cls = 'siteinner';
	}
}
else {
$inner_cls = 'siteinner';
}
?>

<div class="site-header <?php echo esc_attr($inner_cls); ?>"> 
  <div class="container"> 
    
    <?php if( $kids_campus_show_hdr_contact_info_part != ''){ ?> 
        <div class="hdr_cotactinfo">
             <?php 
               $kids_campus_hdr_phoneno = get_theme_mod('kids_campus_hdr_phoneno');
               if( !empty($kids_campus_hdr_phoneno) ){ ?> 
                 <span class="phno">
                   <i class="fas fa-phone-volume fa-rotate-310"></i>
				   <strong><?php echo esc_html($kids_campus_hdr_phoneno); ?></strong>
                 </span>
               <?php } ?>  
                            
             <?php
               $kids_campus_hdr_email_id = get_theme_mod('kids_campus_hdr_email_id');
               if( !empty($kids_campus_hdr_email_id) ){ ?> 
                 <span> <i class="far fa-envelope"></i>
                 <a href="<?php echo esc_url('mailto:'.get_theme_mod('kids_campus_hdr_email_id')); ?>"><?php echo esc_html(get_theme_mod('kids_campus_hdr_email_id')); ?></a></span>
               <?php } ?>
        </div> 
    <?php } ?>   
    
  
      <div class="logo">
        <?php kids_campus_the_custom_logo(); ?>
           <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
      </div><!-- logo -->
        
     
	  <?php if( $kids_campus_show_hdr_social_area != ''){ ?> 
       <div class="hdr_rightcol">
             <div class="hdr_social">                                                
               <?php $kids_campus_hdrfb_link = get_theme_mod('kids_campus_hdrfb_link');
                if( !empty($kids_campus_hdrfb_link) ){ ?>
                <a title="facebook" class="fab fa-facebook-f" target="_blank" href="<?php echo esc_url($kids_campus_hdrfb_link); ?>"></a>
               <?php } ?>
            
               <?php $kids_campus_hdrtwitt_link = get_theme_mod('kids_campus_hdrtwitt_link');
                if( !empty($kids_campus_hdrtwitt_link) ){ ?>
                <a title="twitter" class="fab fa-twitter" target="_blank" href="<?php echo esc_url($kids_campus_hdrtwitt_link); ?>"></a>
               <?php } ?>
        
              <?php $kids_campus_hdrgplus_link = get_theme_mod('kids_campus_hdrgplus_link');
                if( !empty($kids_campus_hdrgplus_link) ){ ?>
                <a title="google-plus" class="fab fa-google-plus" target="_blank" href="<?php echo esc_url($kids_campus_hdrgplus_link); ?>"></a>
              <?php }?>
        
              <?php $kids_campus_hdrlinked_link = get_theme_mod('kids_campus_hdrlinked_link');
                if( !empty($kids_campus_hdrlinked_link) ){ ?>
                <a title="linkedin" class="fab fa-linkedin" target="_blank" href="<?php echo esc_url($kids_campus_hdrlinked_link); ?>"></a>
              <?php } ?>                  
           </div><!--end .hdr_social--> 
            </div><!--.hdr_rightcol -->
       <?php } ?>
                 
      <div class="clear"></div> 
    <div class="header-nav">
       <div class="toggle">
         <a class="toggleMenu" href="#"><?php esc_html_e('Menu','kids-campus'); ?></a>
       </div><!-- toggle --> 
         <div class="site_primary_menu">                   
            <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
         </div><!--.site_primary_menu -->
         <div class="clear"></div>  
   </div><!--.header-nav -->
  <div class="clear"></div> 
  </div><!-- .container --> 
    
  </div><!--.site-header --> 
  
<?php 
if ( is_front_page() && !is_home() ) {
if($kids_campus_show_hdr_slider_section != '') {
	for($i=1; $i<=3; $i++) {
	  if( get_theme_mod('kids_campus_hdr_slider_pagbox'.$i,false)) {
		$slider_Arr[] = absint( get_theme_mod('kids_campus_hdr_slider_pagbox'.$i,true));
	  }
	}
?> 
<div class="slider_sections">                
<?php if(!empty($slider_Arr)){ ?>
<div id="slider" class="nivoSlider">
<?php 
$i=1;
$slidequery = new WP_Query( array( 'post_type' => 'page', 'post__in' => $slider_Arr, 'orderby' => 'post__in' ) );
while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
?>
<?php if(!empty($image)){ ?>
<img src="<?php echo esc_url( $image ); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php }else{ ?>
<img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider-default.jpg" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php } ?>
<?php $i++; endwhile; ?>
</div>   

<?php 
$j=1;
$slidequery->rewind_posts();
while( $slidequery->have_posts() ) : $slidequery->the_post(); ?>                 
    <div id="slidecaption<?php echo esc_attr( $j ); ?>" class="nivo-html-caption">     
      <div class="custominfo">       
    	<h2><?php the_title(); ?></h2>
    	<?php the_excerpt(); ?>
		<?php
        $kids_campus_hdr_slider_readbtntext = get_theme_mod('kids_campus_hdr_slider_readbtntext');
        if( !empty($kids_campus_hdr_slider_readbtntext) ){ ?>
            <a class="slide_morebtn" href="<?php the_permalink(); ?>"><?php echo esc_html($kids_campus_hdr_slider_readbtntext); ?></a>
        <?php } ?>
       </div><!-- .custominfo -->                    
    </div>   
<?php $j++; 
endwhile;
wp_reset_postdata(); ?>  
<div class="clear"></div>  
<div class="sectiontop"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="1920.000000pt" height="94.000000pt" viewBox="0 0 1920.000000 94.000000" preserveAspectRatio="xMidYMid meet"><g class="pattern" transform="translate(0.000000,94.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M11080 884 c-142 -184 -359 -320 -585 -370 -106 -23 -312 -23 -415 0 -41 9 -86 19 -101 22 -22 5 -29 -1 -62 -54 -51 -82 -167 -205 -250 -263 -130 -91 -288 -139 -458 -139 -158 0 -377 57 -535 139 l-71 37 -72 -33 c-114 -52 -211 -74 -328 -74 -129 -1 -210 19 -338 81 -118 58 -208 124 -298 219 l-65 69 -78 -24 c-172 -55 -366 -66 -509 -29 -134 35 -273 123 -345 219 l-42 56 -67 -65 c-126 -122 -263 -206 -401 -242 -97 -26 -272 -24 -374 5 -156 44 -325 140 -453 257 l-62 56 -68 -39 c-163 -94 -287 -126 -483 -126 -123 1 -160 5 -241 26 -128 35 -250 88 -366 161 -52 32 -95 57 -97 55 -1 -1 -15 -28 -30 -59 -60 -121 -164 -207 -310 -256 -76 -25 -92 -27 -256 -27 -122 0 -195 5 -241 16 l-66 15 -84 -100 c-154 -184 -344 -313 -529 -359 -167 -41 -375 -12 -552 78 -76 38 -195 121 -251 173 l-47 44 -84 -36 c-191 -83 -339 -117 -511 -117 -231 0 -438 85 -604 248 -54 53 -144 167 -153 193 -3 8 -32 6 -101 -7 l-97 -19 0 -307 0 -308 9600 0 9600 0 0 235 c0 129 -2 235 -5 235 -2 0 -20 -11 -40 -24 -37 -26 -113 -46 -169 -46 -49 0 -185 27 -252 50 -31 11 -62 20 -68 20 -6 0 -29 -26 -51 -57 -95 -134 -255 -272 -388 -334 -282 -131 -632 -50 -925 216 l-62 57 -113 -46 c-443 -179 -826 -126 -1103 153 -38 38 -85 94 -104 125 l-35 56 -55 -8 c-87 -11 -219 -5 -290 13 -91 23 -196 76 -256 129 l-52 45 -36 -59 c-124 -201 -346 -303 -626 -286 -89 5 -197 22 -259 40 -11 4 -29 -15 -61 -62 -58 -88 -250 -278 -322 -321 -239 -140 -483 -145 -753 -17 -96 46 -198 112 -282 183 l-51 44 -69 -34 c-307 -155 -656 -165 -949 -28 -240 113 -482 332 -637 578 -29 45 -55 82 -58 83 -4 0 -26 -25 -49 -56z"/></g></svg></div> 
</div><!--end .slider_sections -->     
<?php } ?>
<?php } } ?>
       
        
<?php if ( is_front_page() && ! is_home() ) {
 if( $kids_campus_show_services_3col_area != ''){ ?>  
  <div id="page_services_section">
     <div class="container">        
       <?php 
        for($n=1; $n<=3; $n++) {    
        if( get_theme_mod('kids_campus_page_for_services_col'.$n,false)) {      
            $queryvar = new WP_Query('page_id='.absint(get_theme_mod('kids_campus_page_for_services_col'.$n,true)) );		
            while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>     
            <div class="page_three_box <?php if($n % 3 == 0) { echo "last_column"; } ?>">                                       
                <?php if(has_post_thumbnail() ) { ?>
                <div class="page_img_box"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a></div>        
                <?php } ?>
                <div class="page_content">              	
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?> 
                </div>                      
            </div>
            <?php endwhile;
            wp_reset_postdata();                                  
        } } ?>                                 
    <div class="clear"></div>  
   </div><!-- .container -->
</div><!-- #page_services_section -->               
                	      
<?php } ?>



<?php if( $kids_campus_show_welcome_page_section != ''){ ?>  
<section id="welcome_sections">
<div class="container">                               
<?php 
if( get_theme_mod('kids_campus_welcome_page_section',false)) {     
$queryvar = new WP_Query('page_id='.absint(get_theme_mod('kids_campus_welcome_page_section',true)) );			
    while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>     
     <div class="welcome_imagebx"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a></div>    
     <div class="welcome_contentbox">   
     <h3><?php the_title(); ?></h3>   
     <?php the_content(); ?>     
    </div>                                          
    <?php endwhile;
     wp_reset_postdata(); ?>                                    
    <?php } ?>                                 
<div class="clear"></div>                       
</div><!-- container -->
</section><!-- #welcome_sections-->
<?php } ?>
<?php } ?>