<?php
/**
 * The template part for displaying story posts
 *
 * @package WordPress
 * @subpackage Platinum_2016
 * @since Platinum-2016 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php $link = get_field('story_link_to_ip'); ?>
	    <h1 class="entry-title"><a href="<?php echo $link["url"]; ?>" title="<?php echo $link["title"]; ?>"><?php the_title(); ?></a></h1>
	    <p class="credit">by <?php the_field('story_credit') ?></p>
	</header><!-- .entry-header -->
	<section class="row">
		<div class="col-xs-12"><?php the_post_thumbnail(); ?></div>
	</section>
	<section>
		<?php the_content(); ?>
	</section>
	<?php if( get_field('story_artwork')) { ?>
	<section>
	    <h1>Artwork</h1>
		<?php 
		$image_ids = get_field('story_artwork', false, false);
		$shortcode = '[' . 'gallery ids="' . implode(',', $image_ids) . '"]';
		echo do_shortcode( $shortcode );
		
		?>
	</section>
	<?php } ?>

	<?php if( have_rows('story_episodes') ): ?>	
		<section>
		    <h1>Arcs &amp; Episodes</h1>
	<?php while ( have_rows('story_episodes') ) : the_row(); ?>
		  <article>
	      <h2><?php the_sub_field('story_episode_title'); ?></h2>
	      <?php the_sub_field('story_episode_content'); ?>
	      
	      <?php 
	      //Get comic book asset
	      $comic_obj = get_sub_field('story_episode_comic');
	      $comic_id = $comic_obj['ID'];
	      $url = wp_get_attachment_url($comic_id);
	      $cover_image = get_field('cover_image', $comic_id);
	     
	      echo '<a href="' . $url .'"><img src="' . $cover_image['sizes']['medium'] . '"></a>';
	      echo '<h3>' . $comic_obj['title'] . '</h3>';
	      echo '<p>' . $comic_obj['description'] . '</p>';
	      ?>
	      </article>
	<?php endwhile; ?>
		</section>
	<?php endif; ?>	
	
	
	
	
	
	

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
