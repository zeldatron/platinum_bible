<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
   <div class="wrap row">
        <div class="col-sm-12 col-md-8 col-lg-9">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/page/content', 'page' );

	endwhile; // End of the loop.
	?>
	    </div>
       	
       	
       	<div class="col-sm-12 col-md-4 col-lg-3">
	    	<?php get_sidebar(); ?>

	    </div>

	<div>
</main><!-- #main -->

<?php get_footer();
