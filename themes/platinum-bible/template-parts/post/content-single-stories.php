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
<section class="content-block">
	<div class="wrap row">
	    <div class="col-sm-12 col-md-8 col-lg-9">
			<header>
				<?php $link = get_field('story_link_to_ip'); ?>
			    <h1 class="entry-title left-align"><a href="<?php echo $link["url"]; ?>" title="<?php echo $link["title"]; ?>"><?php the_title(); ?></a></h1>
			    <p class="credit">by <?php the_field('story_credit') ?></p>
			</header><!-- .entry-header -->
				<?php the_post_thumbnail(); ?>
				<?php the_content(); ?>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-3">
			    <ul class="sidebar">
		      <?php $characters = get_field('story_characters');
					if( $characters  ): ?>
			        
			        <li>
				        <a href="#"></i>Characters</a>
				        <article>
							<ul>
								<?php
							    foreach( $characters  as $post):  
							        setup_postdata($post);  
							        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title(). '</a></li>';  
							    endforeach;  
							    wp_reset_postdata(); 
								?>							
							</ul>
				        </article>
			        </li>
			  <?php endif; ?>
				<?php
					$universes = get_field('story_universe');
					if( $universes ): 
					    echo '<li class="commas"><strong>Location in Multiverse: </strong>';
					    foreach( $universes as $post):  
					        setup_postdata($post);  
					        echo '<span>' . get_the_title() . ' ' . get_field('symbol') . '</span>';  
					    endforeach;  
					    wp_reset_postdata(); 
					    echo "</li>";
					endif;
				?>							
			  
			    </ul>
	    </div>
	</div>    
</section>

<?php 
	$story_artwork = get_field('story_artwork');
	if( $story_artwork ) { ?>


<section class="md_grey_bg content-block">
     <div class="wrap full-width">
         <header>
             <h1>Artwork</h1>
         </header>

		 <div class="grid">
			<?php 
			foreach( $story_artwork as $image ): 
		        $content = '<div class="grid-item md-border-color">';
		            $content .= '<a class="gallery_image" href="'. $image['url'] .'">';
		                 $content .= '<img src="'. $image['sizes']['medium_large'] .'" alt="'. $image['alt'] .'" />';
		            $content .= '</a>';
		        $content .= '</div>';
			    if ( function_exists('slb_activate') ){
			        $content = slb_activate($content);
			    }  
				echo $content; 
			endforeach; ?>
		 </div>		 
	</div>
</section>
<?php } ?>



	
<?php if( have_rows('story_episodes') ): ?>	
<section class="content-block">
    <div class="wrap">
		<div class="col-sm-12 col-md-8 col-lg-9">
		    <header>
		        <h1 class="left-align">Arcs &amp; Episodes</h1>
		    </header>
	<?php while ( have_rows('story_episodes') ) : the_row(); ?>
		  <article class="text-doc">
	      <h2><?php the_sub_field('story_episode_title'); ?></h2>
	      
	      <?php 
	      //Get comic book asset
	      $comic_obj = get_sub_field('story_episode_comic');
	      if($comic_obj) {
	      $comic_id = $comic_obj['ID'];
	      $url = wp_get_attachment_url($comic_id);
	      $cover_image = get_field('cover_image', $comic_id);
	      echo '<figure>';
	      echo '<a href="' . $url .'"><img src="' . $cover_image['sizes']['medium'] . '"></a>';
	      echo '<figcaption>';
	      echo '<strong>' . $comic_obj['title'] . '</strong>'. $comic_obj['description'];
	      echo '</figcaption>';
	      echo '</figure>';
	      }
	      ?>

	      <?php the_sub_field('story_episode_content'); ?>
	      </article>
	<?php endwhile; ?>
		 </div>
    </div>
</section>    	
	<?php endif; ?>	
</article><!-- #post-## -->
