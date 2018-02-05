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
<section class="hero header" style="background: url(<?php the_post_thumbnail_url( 'full' ); ?>) no-repeat center center">
	<header>
	    <h1><span><?php the_field('ip_id'); ?></span><?php the_title(); ?></h1>
	</header>
</section>
<section class="content-block lt_grey_bg">
    <div class="wrap row">
		<div class="col-sm-12 col-md-8 col-lg-9">
		    
		    <?php 
		        if( have_rows('log_lines') ){
		    ?>
		    <h2>Logline</h2>
		    <?php    
				    while ( have_rows('log_lines') ) : the_row();
				        if(get_sub_field('log_line_active')) {
					        the_sub_field('log_line_text');
				        }
				    endwhile;
				}
		    ?>
		    
		    <h2>Synopsis</h2>
		    <?php the_content(); ?>
		</div>
		<div class="col-sm-12 col-md-4 col-lg-3">
		    <ul class="sidebar accordion">
		        <li>
			        <a href="#" class="accordion-toggle">Stats</a>
			        <article class="accordion-content">
						<ul class="stats">
							<li><strong>Genres: </strong> 
								<?php 
								    $cats =get_the_terms( $post, 'ip_cats' );
								    foreach ( $cats as $cat ):
								        echo '<span>' . $cat->name . '</span>';
								    endforeach;
								 ?>
							</li>
							<li><strong>Location in Metaverse: </strong> 
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
			        <a href="#" class="accordion-toggle">Characters</a>
			        <article class="accordion-content">
						<ul>
							<?php
						    foreach( $characters  as $post):  
						        setup_postdata($post);  
						        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title(). '</span></li>';  
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
			        <a href="#" class="accordion-toggle">Stories</a>
			        <article class="accordion-content">
						<ul>
							<?php
						    foreach( $stories  as $post):  
						        setup_postdata($post);  
						        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title(). '</span></li>';  
						    endforeach;  
						    wp_reset_postdata(); 
							?>							
						</ul>
			        </article>
		        </li>
		  <?php endif; ?>
	      <?php  if( have_rows('ip_scripts') ): ?>
		        
		        <li>
			        <a href="#" class="accordion-toggle">Scripts</a>
			        <article class="accordion-content">
						<ul>
						    <?php    
							while ( have_rows('ip_scripts') ) : the_row(); 
							$file = get_sub_field('ip_script_file');
							?>
                            <li>
                                 <a href="<?php echo $file['url']; ?>" class="dl_link"><?php echo $file['title']; ?></a>
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
<section class="content-block m_grey_bg">
    <div class="wrap">
    
     <header>
	     <h1>Development Art</h1>
	 </header>
    
    <?php 
		$dev_art = get_field('ip_development_art');
		if( $dev_art ): ?>
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
    <?php endif; ?>     
    </div>
</section>

</article>
