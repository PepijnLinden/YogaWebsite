<?php
/**
 *Kids Campus About Theme
 *
 * @package Kids Campus
 */

//about theme info
add_action( 'admin_menu', 'kids_campus_abouttheme' );
function kids_campus_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'kids-campus'), __('About Theme Info', 'kids-campus'), 'edit_theme_options', 'kids_campus_guide', 'kids_campus_mostrar_guide');   
} 

//Info of the theme
function kids_campus_mostrar_guide() { 	
?>
<div class="wrap-GT">
	<div class="gt-left">
   		   <div class="heading-gt">
			  <h3><?php esc_html_e('About Theme Info', 'kids-campus'); ?></h3>
		   </div>
          <p><?php esc_html_e('Kids Campus is a fresh and lively, vibrant and colorful, visually spacious and stimulating, youthful and attractive, creative and delightful, charming and easy to use kindergarten WordPress theme. This theme is perfect for making preschool, kindergartens, professional child care centers and other child related websites. It can also be used for college, school education, nursery, daycare, coaching institute, secondary and primary school, afterschool activities clubs and similar educational organizations. This theme is one of the professionally designed website template that can help you create a beautiful kindergarten website in an instant.','kids-campus'); ?></p>
<div class="heading-gt"> <?php esc_html_e('Theme Features', 'kids-campus'); ?></div>
 

<div class="col-2">
  <h4><?php esc_html_e('Theme Customizer', 'kids-campus'); ?></h4>
  <div class="description"><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'kids-campus'); ?></div>
</div>

<div class="col-2">
  <h4><?php esc_html_e('Responsive Ready', 'kids-campus'); ?></h4>
  <div class="description"><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'kids-campus'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('Cross Browser Compatible', 'kids-campus'); ?></h4>
<div class="description"><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'kids-campus'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('E-commerce', 'kids-campus'); ?></h4>
<div class="description"><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'kids-campus'); ?></div>
</div>
<hr />  
</div><!-- .gt-left -->
	
<div class="gt-right">			
        <div>				
            <a href="<?php echo esc_url( kids_campus_live_demo ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'kids-campus'); ?></a> | 
            <a href="<?php echo esc_url( kids_campus_theme_doc ); ?>" target="_blank"><?php esc_html_e('Documentation', 'kids-campus'); ?></a>
        </div>		
</div><!-- .gt-right-->
<div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>