<?php
/**
 * The template used for displaying page content
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
		<?php
		// check if the repeater field has rows of data
		if( have_rows('timeline') ):
		?>
		<section class="timeline-container">
			<div class="timeline-inner">
		<?php 	
		 	// loop through the rows of data
		    while ( have_rows('timeline') ) : the_row();
		?>
				<article>
					<header>
						<h1><?php the_sub_field('timeline_date'); ?></h1>
					</header>
					<div>
						<h2><?php the_sub_field('timeline_title'); ?></h2>

						<?php the_sub_field('timeline_content'); ?>
					</div>
				</article>
		<?php
		    endwhile;
		?>
			<div>
		</section>
		
		<?php
		endif;
		?>

	<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'platinum2016' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
	?>

</article><!-- #post-## -->
