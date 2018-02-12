<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Platinum_2016
 * @since Platinum-2016 1.0
 */

get_header(); ?>
	
	<main id="main" class="site-main" role="main">
	    <div class="wrap full-width">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/page/content', 'page-timeline' );
		endwhile;
		?>
	    </div>
	</main><!-- .site-main -->
	
	

<?php get_footer(); ?>
