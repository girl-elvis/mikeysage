<article <?php post_class(); ?>>
  <header>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php //get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php //the_excerpt(); 

    //$image_name = 'thumbnail';
		    	
				if( has_post_thumbnail() ) {
					echo '<a href="' . get_permalink() . '">';
					the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
					echo '</a>';
				} else { ?>
				
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/default-250x160.png" alt="<?php the_title(); ?>" />
				
				<?php } ?>


    
  </div>

  
</article>
