<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('row'); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php // get_template_part('templates/entry-meta'); ?>
    </header>


<?php if (!has_post_format( 'video')){  
        echo '<div class="project-meta" >';
        echo do_shortcode ('[gallery royalslider="2"]');
        echo '</div> <div class="entry-conten">';

      } else {
        echo '<div >';
      }

?>
    
      <?php the_content(); ?>
    </div>
    

    <div class="related"> 
          <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    </div>


   
  </article>

<?php endwhile; ?>
