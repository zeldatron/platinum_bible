<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Platinum_2016
 * @since Platinum-2016 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area col-sm-12 col-md-4 col-lg-3" role="complementary">
		<section class="widget stats">		
		    <h2 class="widget-title">Character Stats</h2>		
		        <ul>
					<?php if(!empty(get_field('character_real_name'))) { ?>
					<li>
					    <strong>Real Name: </strong><?php the_field('character_real_name'); ?>
					</li>
					<?php } ?>
					
					<?php if(!empty(get_field('character_occupation'))) { ?>
					<li>
					    <strong>Occupation: </strong><?php the_field('character_occupation'); ?>
					</li>
					<?php } ?>
					
					
					<?php if(!empty(get_field('character_base'))) { ?>
					<li>
					    <strong>Base of Operations: </strong><?php the_field('character_base'); ?>
					</li>
					<?php } ?>
										
					
					<?php if(!empty(get_field('character_relatives'))) { ?>
					<li>
					    <strong>Known Relatives: </strong>					   
					     <?php  $the_query = new WP_Query( array( 'post_type' => 'characters', 'post__in' => get_field('character_relatives'))); ?>

							<!-- the loop -->
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<span><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a><?php if(!empty(get_the_excerpt())) { ?><span><?php the_excerpt(); ?></span><?php } ?></span>
							<?php endwhile; ?>
							<!-- end of the loop -->
						
							<?php wp_reset_postdata(); ?>

					</li>
					<?php } ?>
					
					<?php if(!empty(get_field('character_associates'))) { ?>
					<li>
					    <strong>Known Associates: </strong>					   
					     <?php  $the_query = new WP_Query( array( 'post_type' => 'characters', 'post__in' => get_field('character_associates'))); ?>

							<!-- the loop -->
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<span>
									<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
									<?php if(!empty(get_the_excerpt())) { ?>
									<span><?php the_excerpt(); ?></span>
									<?php } ?>
								</span>
							<?php endwhile; ?>
							<!-- end of the loop -->
						
							<?php wp_reset_postdata(); ?>
					</li>
					<?php } ?>
					
					<?php if(!empty(get_field('character_universe'))) { ?>
					<li>
					    <strong>Universes: </strong>					   
					     <?php  $the_query = new WP_Query( array('post_type' => 'universes', 'post__in' => get_field('character_universe'))); ?>

							<!-- the loop -->
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<span><?php echo get_field('symbol') ." <em>(" . get_the_title() . ")</em>"; ?></span>
							<?php endwhile; ?>
							<!-- end of the loop -->
							<?php wp_reset_postdata(); ?>
					</li>
					<?php } ?>
					
					
					<?php  $character_id = get_the_ID(); ?>
					<?php  $the_query = new WP_Query( array('post_type' => 'teams')); ?>
					
					<li>
					    <strong>Teams: </strong>					   
						<!-- the loop -->
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
							$members = get_field('team_characters');
							if (in_array($character_id, $members)) {
								echo "<span>" . get_the_title() . "</span>";
							}
														
						?>
						<?php endwhile; ?>
						<!-- end of the loop -->
						<?php wp_reset_postdata(); ?>
							
					</li>
				</ul>
		</section>		

	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
