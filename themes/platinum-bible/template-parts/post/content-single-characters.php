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
    <section class="content-block lt_grey_bg">
        <div class="wrap row">
			<div class="col-sm-12 col-md-8 col-lg-9">
				<header>
					<?php the_title( '<h1 class="entry-title left-align">', '</h1>' ); ?>
				</header>
				<?php the_content(); ?>
	        </div>
	        <div class="col-sm-12 col-md-4 col-lg-3">
	             <?php the_post_thumbnail(); ?>
	             <ul class="sidebar accordion">
	                 <li>
	                      <ul class="lines">
			                 
			                 <?php if(get_field('character_real_name')) { ?>
			                 <li><strong>Real Name:</strong> <?php the_field('character_real_name'); ?></li>
			                 <?php } ?>
			                 
			                 <?php if(get_field('character_occupation')) { ?>
			                 <li><strong>Occupation:</strong> <?php the_field('character_occupation'); ?></li>
			                 <?php } ?>
			                 
			                 <?php if(get_field('character_base')) { ?>
			                 <li><strong>Base of Operations:</strong> <?php the_field('character_base'); ?></li>
			                 <?php } ?>
			                 
							<?php
								$universes = get_field('character_universe');
								if( $universes ): 
						    ?>
							    <li class="commas"><strong>Location(s) in Multiverse: </strong> 
						    <?php
								    foreach( $universes as $post):  
								        setup_postdata($post);  
								        echo '<span>' . get_the_title() . ' ' . get_field('symbol') . '</span>';  
								    endforeach;  
								    wp_reset_postdata();
								     
							?>
							    </li>
							<?php
								endif;
							?>							
							
							<?php
								$ip = get_field('associated_ips');
								if( $ip ): 
						    ?>
							    <li class="commas"><strong>Associated IPs: </strong> 
						    <?php
								    foreach( $ip as $post):  
								        setup_postdata($post);  
								        echo '<span>' . get_the_title() . '</span>';  
								    endforeach;  
								    wp_reset_postdata(); 
							?>
							    </li>
							<?php
								endif;
							?>
							
							<?php
								$teams = get_field('group_affiliations');
								if( $teams  ): 
						    ?>
							    <li class="commas"><strong>Teams: </strong> 
						    <?php
								    foreach( $teams as $post):  
								        setup_postdata($post);  
								        echo '<span>' . get_the_title() . '</span>';  
								    endforeach;  
								    wp_reset_postdata(); 
							?>
							    </li>
							<?php
								endif;
							?>							
														
					        </ul>
			        </li>
					
					<?php $relatives = get_field('character_relatives');
						if( $relatives  ): ?>
			        
			        <li>
				        <a href="#" class="accordion-toggle"><i class="fas fa-angle-right"></i>Known Relatives</a>
				        <article class="accordion-content">
							<ul>
								<?php
							    foreach( $relatives  as $post):  
							        setup_postdata($post);  
							        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title(). '</a></li>';  
							    endforeach;  
							    wp_reset_postdata(); 
								?>							
							</ul>
				        </article>
			        </li>
			        <?php endif; ?>

			        <?php $associates = get_field('character_associates');
						if( $associates  ): ?>
			        
			        <li>
				        <a href="#" class="accordion-toggle"><i class="fas fa-angle-right"></i>Known Associates</a>
				        <article class="accordion-content">
							<ul>
								<?php
							    foreach( $associates  as $post):  
							        setup_postdata($post);  
							        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title(). '</a></li>';  
							    endforeach;  
							    wp_reset_postdata(); 
								?>							
							</ul>
				        </article>
			        </li>
			        <?php endif; ?>
					
			        <?php $counterpart = get_field('known_counterparts');
						if( $counterpart ): ?>
			        
			        <li>
				        <a href="#" class="accordion-toggle"><i class="fas fa-angle-right"></i>Known Counterparts</a>
				        <article class="accordion-content">
							<ul>
								<?php
							    foreach( $counterpart as $post):  
							        setup_postdata($post);  
							        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title(). '</a></li>';  
							    endforeach;  
							    wp_reset_postdata(); 
								?>							
							</ul>
				        </article>
			        </li>
			        <?php endif; ?>
	             </ul>
	        </div>
	    </div>
    </section>
	
		<?php 
		$art = get_field('character_artwork');
		if( $art ) { ?>
	
	<section class="content-block md_grey_bg">
	    <div class="wrap full-width">
	    
	     <header>
		     <h1>Character Artwork</h1>
		 </header>

			 <div class="grid">
				<?php 
				foreach( $art as $image ): 
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

</article><!-- #post-## -->
