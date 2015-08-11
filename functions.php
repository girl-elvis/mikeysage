<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/conditional-tag-check.php', // ConditionalTagCheck class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/extras.php',                // Custom functions
  'lib/wp_bootstrap_navwalker.php', // bootstrap nav walker
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


// Add menu to home page
function add_homemenu($content) {

  if(is_home() || is_front_page() ) {
    $content = '<div class="row"><div class="home-image col-sm-9" style="background:url(';
      $fthumb =wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    $content .=  $fthumb[0];
    $content .= ' ) no-repeat; "><h1 style="color:';
    //$content .= get_field('homepage_image_text_colour'); 
    $content .= '">' . get_field('homepage_image_text');
    $content .= '</h1></div><div class="intro col-sm-3"><aside>';
    $content .= get_field('intro_text') . '</aside></div></div>';
    
    if (has_nav_menu('home-menu')) :
      $content .= wp_nav_menu( array( 'theme_location' => 'home-menu', 'walker' => new wp_bootstrap_navwalker() ,  'echo'=> false, 'container_class' => 'home-menu row') );
    endif;
  }

  return $content;
}
add_filter('the_content', 'add_homemenu');


add_filter('nav_menu_css_class' , 'special_nav_class' , 90 , 2);

//add classes to menus
function special_nav_class($classes, $item){
    $menu_locations = get_nav_menu_locations();
    if ( has_term($menu_locations['home-menu'], 'nav_menu', $item) ||  has_term($menu_locations['sitemap'], 'nav_menu', $item)  ) {
  // if ( 'home-menu' === $args->theme_location ) {
         if (0 == $item->menu_item_parent) { //makes sure not added to sub-menus
           $classes[] = "col-sm-3";
       }
     }
     return $classes;
}

// Add col to archive pages
function iwc_postclass_grid( $class = '' ) {
  if ( is_archive() ) {
    $class[] = 'col-sm-3';
  }
  return $class;
  }
    
add_filter('post_class', 'iwc_postclass_grid');  

// REMOVE "CATEGORY" from archive titles
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});
