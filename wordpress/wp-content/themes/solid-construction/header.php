<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Solid_Construction
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'solid-construction' ); ?></a>

		<header id="masthead" class="site-header">
				<?php get_template_part( 'template-parts/header/header', 'top' ); ?>

				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

				<?php get_template_part( 'template-parts/header/site', 'navigation' ); ?>
		</header><!-- #masthead -->

		<div class="below-site-header">

			<div class="site-overlay"><span class="screen-reader-text"><?php esc_html_e( 'Site Overlay', 'solid-construction' ); ?></span></div>

			<?php get_template_part( 'template-parts/slider/content', 'display' ); ?>

			<?php get_template_part( 'template-parts/header/header', 'media' ); ?>

			<?php get_template_part( 'template-parts/featured-content/display', 'featured' ); ?>

			<?php get_template_part( 'template-parts/services/display', 'services' ); ?>

			<?php get_template_part( 'template-parts/hero-content/content', 'hero' ); ?>

			<?php get_template_part( 'template-parts/portfolio/display', 'portfolio' ); ?>

			<?php get_template_part( 'template-parts/testimonials/display', 'testimonial' ); ?>

			<?php get_template_part( 'template-parts/news/display', 'news' ); ?>

			<div id="content" class="site-content">
				<div class="wrapper">
