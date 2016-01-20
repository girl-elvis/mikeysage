<?php 

if(is_home() || is_front_page() ) {
    $content = '<div class="row homemain"><div class="home-image col-sm-9" >';
        $content .= '<h1>';
    
    $content .=  get_template_part('templates/carousel'); 
    $content .= '</h1>';
    $content .=   get_the_post_thumbnail( $post_id = null, $size = 'full' );
    $content .= '</div><div class="intro col-sm-3"><aside>';
    $content .= get_field('intro_text') . '</aside></div></div>';
    
    if (has_nav_menu('home-menu')) :
      $content .= wp_nav_menu( array( 'theme_location' => 'home-menu', 'walker' => new wp_bootstrap_navwalker() ,  'echo'=> false, 'container_class' => 'home-menu row') );
    endif;
  }
echo $content;

?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
