<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Kids Campus
 */
 
?>

<div class="footer-wrapper">

           <div class="container ftrfx">           
          <?php if ( is_active_sidebar( 'footer-widget-column-1' ) ) : ?>
                <div class="widget-column-1">  
                    <?php dynamic_sidebar( 'footer-widget-column-1' ); ?>
                </div>
           <?php endif; ?>
          
          <?php if ( is_active_sidebar( 'footer-widget-column-2' ) ) : ?>
                <div class="widget-column-2">  
                    <?php dynamic_sidebar( 'footer-widget-column-2' ); ?>
                </div>
           <?php endif; ?>
           
           <?php if ( is_active_sidebar( 'footer-widget-column-3' ) ) : ?>
                <div class="widget-column-3">  
                    <?php dynamic_sidebar( 'footer-widget-column-3' ); ?>
                </div>
           <?php endif; ?>           
           
           <div class="clear"></div>
      </div><!--end .container--> 
           



         
         <div class="footerbottom"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="1920.000000pt" height="94.000000pt" viewBox="0 0 1920.000000 94.000000" preserveAspectRatio="xMidYMid meet"><g class="pattern" transform="translate(0.000000,94.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M11080 884 c-142 -184 -359 -320 -585 -370 -106 -23 -312 -23 -415 0 -41 9 -86 19 -101 22 -22 5 -29 -1 -62 -54 -51 -82 -167 -205 -250 -263 -130 -91 -288 -139 -458 -139 -158 0 -377 57 -535 139 l-71 37 -72 -33 c-114 -52 -211 -74 -328 -74 -129 -1 -210 19 -338 81 -118 58 -208 124 -298 219 l-65 69 -78 -24 c-172 -55 -366 -66 -509 -29 -134 35 -273 123 -345 219 l-42 56 -67 -65 c-126 -122 -263 -206 -401 -242 -97 -26 -272 -24 -374 5 -156 44 -325 140 -453 257 l-62 56 -68 -39 c-163 -94 -287 -126 -483 -126 -123 1 -160 5 -241 26 -128 35 -250 88 -366 161 -52 32 -95 57 -97 55 -1 -1 -15 -28 -30 -59 -60 -121 -164 -207 -310 -256 -76 -25 -92 -27 -256 -27 -122 0 -195 5 -241 16 l-66 15 -84 -100 c-154 -184 -344 -313 -529 -359 -167 -41 -375 -12 -552 78 -76 38 -195 121 -251 173 l-47 44 -84 -36 c-191 -83 -339 -117 -511 -117 -231 0 -438 85 -604 248 -54 53 -144 167 -153 193 -3 8 -32 6 -101 -7 l-97 -19 0 -307 0 -308 9600 0 9600 0 0 235 c0 129 -2 235 -5 235 -2 0 -20 -11 -40 -24 -37 -26 -113 -46 -169 -46 -49 0 -185 27 -252 50 -31 11 -62 20 -68 20 -6 0 -29 -26 -51 -57 -95 -134 -255 -272 -388 -334 -282 -131 -632 -50 -925 216 l-62 57 -113 -46 c-443 -179 -826 -126 -1103 153 -38 38 -85 94 -104 125 l-35 56 -55 -8 c-87 -11 -219 -5 -290 13 -91 23 -196 76 -256 129 l-52 45 -36 -59 c-124 -201 -346 -303 -626 -286 -89 5 -197 22 -259 40 -11 4 -29 -15 -61 -62 -58 -88 -250 -278 -322 -321 -239 -140 -483 -145 -753 -17 -96 46 -198 112 -282 183 l-51 44 -69 -34 c-307 -155 -656 -165 -949 -28 -240 113 -482 332 -637 578 -29 45 -55 82 -58 83 -4 0 -26 -25 -49 -56z"/></g></svg></div>
<div class="clear"></div>
 
        <div class="footer-copyright"> 
            <div class="container">
                <div class="powerby">
				  <?php bloginfo('name'); ?> - <?php esc_html_e('Proudly Powered by WordPress','kids-campus'); ?>               
                </div>
                        	
                <div class="design-by"><?php esc_html_e('Theme by Grace Themes','kids-campus'); ?></div>
                <div class="clear"></div>
                                
             </div><!--end .container-->             
        </div><!--end .footer-copyright-->  
                     
     </div><!--end #footer-wrapper-->
</div><!--#end sitelayout-->

<?php wp_footer(); ?>
</body>
</html>