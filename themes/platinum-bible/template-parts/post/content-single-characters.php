<?php
/**
 * The template part for displaying character posts
 *
 * @package WordPress
 * @subpackage Platinum_2016
 * @since Platinum-2016 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<section class="row">
		<div class="col-xs-12 col-md-4"><?php the_post_thumbnail(); ?></div>
		<div class="col-xs-12 col-md-8"><?php platinum2016_excerpt(); ?></div>
	</section>
	<section>
		<h1>Full Biography</h1>
		<?php the_content(); ?>
	</section>
	<?php if( !empty(get_field('character_artwork'))) { ?>
	<section>
	    <h1>Artwork</h1>
		<?php 
		$image_ids = get_field('character_artwork', false, false);
		$shortcode = '[' . 'gallery ids="' . implode(',', $image_ids) . '"]';
		echo do_shortcode( $shortcode );
		
		?>
	</section>
	<?php } ?>

	<footer class="entry-footer">
<!-- 		<?php platinum2016_entry_meta(); ?> -->
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'platinum2016' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
