<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Platinum_2016
 * @since Platinum-2016 1.0
 */

get_header(); ?>

<div id="primary" class="content-area row">
	<main id="main" class="site-main col-xs-12 col-sm-12 col-md-8 col-lg-9" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			$post_type = get_post_type();
			$suffix = "";
			if($post_type) {
				$suffix = '-' . $post_type;
			}
			
			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single' . $suffix );

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

<?php get_sidebar($post_type); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
