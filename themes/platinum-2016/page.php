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

<div id="primary" class="content-area row">
	<main id="main" class="site-main col-xs-12 col-sm-12 col-md-8 col-lg-9" role="main">
		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );

		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>


<?php get_sidebar(); ?>
</div><!-- .content-area -->

<?php get_footer(); ?>
