<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			    $post_type = get_post_type();
				$suffix = "";
				
				if($post_type) {
				    $suffix = '-' . $post_type; 
				    get_template_part( 'template-parts/post/content', 'single' . $suffix );
				} else {
				    get_template_part( 'template-parts/post/content', get_post_format());
				}
			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
