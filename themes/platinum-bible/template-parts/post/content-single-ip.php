<?php
/**
 * Template part for displaying IP posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="hero header" style="background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>);">
		<div class="wrap">
			<header>
				<span><?php the_field('ip_id'); ?></span>
			    <h1><?php the_title(); ?></h1>
			</header>
		</div>
	</section>
	<section class="content-block lt_grey_bg">
	    <div class="wrap row">
			<div class="col-sm-12 col-md-8 col-lg-9">
			    
			    <?php 
			        if( have_rows('log_lines') ){
			    ?>
			    <h2 class="red_text">Logline</h2>
			    <?php    
					    while ( have_rows('log_lines') ) : the_row();
					        if(get_sub_field('log_line_active')) {
						        the_sub_field('log_line_text');
					        }
					    endwhile;
					}
			    ?>
			    
			    <h2 class="red_text">Synopsis</h2>
			    <?php the_content(); ?>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-3">
			    <ul class="sidebar accordion">
			        <li>
				        <a href="#" class="accordion-toggle"><i class="fas fa-angle-right"></i>Stats</a>
				        <article class="accordion-content">
							<ul class="lines stats">
								<li class="commas"><strong>Genres: </strong> 
									<?php 
									    $cats =get_the_terms( $post, 'ip_cats' );
									    foreach ( $cats as $cat ):
									        echo '<span>' . $cat->name . '</span>';
									    endforeach;
									 ?>
								</li>
								<li class="commas"><strong>Location in Multiverse: </strong> 
								<?php
									$universes = get_field('ip_universes');
									if( $universes ): 
									    foreach( $universes as $post):  
									        setup_postdata($post);  
									        echo '<span>' . get_the_title() . ' ' . get_field('symbol') . '</span>';  
									    endforeach;  
									    wp_reset_postdata(); 
									endif;
								?>							
								</li>
								<li><strong>Timeline: </strong> 
								<?php
									$timeline = the_field('ip_timeline');
								?>							
								</li>
							</ul>
				        </article>
			        </li>
		      <?php $characters = get_field('ip_characters');
					if( $characters  ): ?>
			        
			        <li>
				        <a href="#" class="accordion-toggle"><i class="fas fa-angle-right"></i>Characters</a>
				        <article class="accordion-content">
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
		      <?php $stories = get_field('ip_stories');
					if( $stories  ): ?>
			        
			        <li>
				        <a href="#" class="accordion-toggle"><i class="fas fa-angle-right"></i>Stories</a>
				        <article class="accordion-content">
							<ul>
								<?php
							    foreach( $stories  as $post):  
							        setup_postdata($post);  
							        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title(). '</a></li>';  
							    endforeach;  
							    wp_reset_postdata(); 
								?>							
							</ul>
				        </article>
			        </li>
			  <?php endif; ?>
		      <?php  if( have_rows('ip_scripts') ): ?>
			        
			        <li>
				        <a href="#" class="accordion-toggle"><i class="fas fa-angle-right"></i>Scripts</a>
				        <article class="accordion-content">
							<ul class="lines">
							    <?php    
								while ( have_rows('ip_scripts') ) : the_row(); 
								$file = get_sub_field('ip_script_file');
								?>
	                            <li>
	                                 <a href="<?php echo $file['url']; ?>" class="dl_link" target="_blank"><?php echo $file['title']; ?></a>
	                                 <?php if (get_sub_field('ip_script_author')) {  echo 'by ' .get_sub_field('ip_script_author'); } ?>
								</li>
								<?php endwhile; ?>
							</ul>
				        </article>
			        </li>
			  <?php endif; ?>
	
			    </ul><!-- sidebar accordion -->
			</div>
	    </div>
	</section>
	    <?php 
			$avalanche = get_field('avalanche');
			if( $avalanche ) { ?>
	<section class="content-block dk_grey_bg">
	    <div class="wrap">
	    
	     <header>
		     <h1 class="white_text">Avalanche</h1>
		 </header>
	    
			<ul class="carousel">
				<?php 
				foreach( $avalanche as $image ): 
			        $content = '<li>';
			            $content .= '<a class="gallery_image" href="'. $image['url'] .'">';
			                 $content .= '<img src="'. $image['sizes']['medium_large'] .'" alt="'. $image['alt'] .'" />';
			            $content .= '</a>';
			        $content .= '</li>';
				    if ( function_exists('slb_activate') ){
				        $content = slb_activate($content);
				    }  
					echo $content; 
				endforeach; ?>
	        </ul>
	    </div>
	</section>
	<?php } ?>  
	
	
		<?php 
		$dev_art = get_field('ip_development_art');
		if( $dev_art ) { ?>
	
	<section class="content-block md_grey_bg">
	    <div class="wrap">
	    
	     <header>
		     <h1>Development Art</h1>
		 </header>
			<ul class="carousel">
				<?php 
				foreach( $dev_art as $image ): 
			        $content = '<li>';
			            $content .= '<a class="gallery_image" href="'. $image['url'] .'">';
			                 $content .= '<img src="'. $image['sizes']['medium_large'] .'" alt="'. $image['alt'] .'" />';
			            $content .= '</a>';
			        $content .= '</li>';
				    if ( function_exists('slb_activate') ){
				        $content = slb_activate($content);
				    }  
					echo $content; 
				endforeach; ?>
	        </ul>
	    </div>
	</section>
	<?php } ?>
    <?php 
		$comics = get_field('ip_comic_books');
		if( $comics ) { 
			
			
		?>
<!-- 	<pre><?php print_r($comics ); ?></pre> -->
	
		<section class="content-block xdk_grey_bg">
	    <div class="wrap">
	    
	     <header>
		     <h1 class="red_text">Comics</h1>
		 </header>
	    
			<ul class="comics">
				    <?php foreach( $comics as $image ): 
				        $icon =  $image['icon'];
				        $thumbnail = get_field('cover_image', $image['id']);
				        if($thumbnail){ $icon  = $thumbnail['url']; }				        
				    ?>
				    <li>
				        <a href="<?php echo $image['url']; ?>">
					         <img src="<?php echo $icon ?>" alt="<?php echo $image['title']; ?>"/>
				        </a>
				    </li>
				<?php endforeach; ?>
	        </ul>
	    </div>
	</section>
	<?php } ?>     
    <?php 
		if( have_rows('ip_treatments')) { 
			
	?>	
	<section class="content-block lt_grey_bg">
	    <div class="wrap">
	    
		     <header>
			     <h1>Treatments</h1>
			 </header>
	    
			<div class="treatments accordion">
			    <?php    
				while ( have_rows('ip_treatments') ) : the_row(); 
				?>
                <article>  
               		 <header class="accordion-toggle">
               		     
               		     <h1><i class="fas fa-angle-right"></i><?php the_sub_field('treatment_title'); ?></h1>
               		     <h2><?php the_sub_field('treatment_author'); ?> | <?php the_sub_field('treatment_date'); ?></h2>
               		 </header>
               		 <div class="accordion-content">
               		     <div class="inner">
	               		 <?php the_sub_field('treatment_content'); ?>
	               		 </div>
               		 </div>
				</article>
				<?php endwhile; ?>
	        </div>
	    </div>
	</section>
	<?php } ?>
</article>
