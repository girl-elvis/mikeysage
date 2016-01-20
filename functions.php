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





//Add settings field to general settings.

// add_settings_field( 'myprefix_setting-id', 'This is the setting title', 'myprefix_setting_callback_function', 'general', 'myprefix_settings-section-name', array( 'label_for' => 'myprefix_setting-id' ) );

$tagline_setting = new new_general_setting();



class new_general_setting {

    function new_general_setting( ) {

        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );

    }

    function register_fields() {

        register_setting( 'general', 'tagline2', 'esc_attr' );

        add_settings_field('tagline2', '<label for="tagline2">'.__('Tagline 2' , 'tagline2' ).'</label>' , array(&$this, 'fields_html') , 'general' );

    }

    function fields_html() {

        $value = get_option( 'tagline2', '' );

        echo '<input type="text" id="tagline2" name="tagline2" value="' . $value . '" />';

    }

}




// Make jpeg quality 100%

add_filter( 'jpeg_quality', 'tgm_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'tgm_image_full_quality' );
/**
 * Filters the image quality for thumbnails to be at the highest ratio possible.
 *
 * Supports the new 'wp_editor_set_quality' filter added in WP 3.5.
 *
 * @since 1.0.0
 *
 * @param int $quality  The default quality (90).
 * @return int $quality Amended quality (100).
 */
function tgm_image_full_quality( $quality ) {
    return 100;
}


// Add menu to home page

function add_homemenu($content) {



  if(is_home() || is_front_page() ) {

    $content = "<div class='blogdesc'>" . get_bloginfo('description') . "</div>" ;
    $content .= '<div class="row homemain">';


    

    $content .= '<div class="home-image  col-xs-12 col-sm-9" >';

    $content .=   get_new_royalslider(1); 

    $content .= '</div> <div class="intro  col-xs-12 col-sm-3"><aside>';

    $content .= get_field('intro_text') . '</aside></div></div>';

    




    if (has_nav_menu('home-menu')) :

      $content .= "<div class='home-menu row'> ";

      $content .= wp_nav_menu( array( 'theme_location' => 'home-menu',  'echo'=> false, 'container' => false ) );

      $content .= "</div>";

    endif;

  }



  return $content;

  echo wp_nav_menu( array( 'theme_location' => 'home-menu', 'walker' => new wp_bootstrap_navwalker() ,  'echo'=> false, 'container_class' => 'home-menu row') );

    

}

add_filter('the_content', 'add_homemenu');





add_filter('nav_menu_css_class' , 'special_nav_class' , 90 , 2);



//add classes to menus

function special_nav_class($classes, $item){

    $menu_locations = get_nav_menu_locations();

    if ( has_term($menu_locations['home-menu'], 'nav_menu', $item) ||  has_term($menu_locations['sitemap'], 'nav_menu', $item)  ) {

  // if ( 'home-menu' === $args->theme_location ) {

         if (0 == $item->menu_item_parent) { //makes sure not added to sub-menus

           $classes[] = " col-xs-6 col-sm-3";

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









function remove_images(){

    $posts = get_posts( array( 

      'post_type'      => 'post', 

      'posts_per_page' => 500, 

      'offset'         => 0, 

  ) );



  foreach( $posts as $post ):

      // Update each post with your reg-ex content filter:

      $pid = wp_update_post( array( 

          'ID'           => $post->ID,

          'post_content' => preg_replace( "/<img[^>]+\>/i", "", $post->post_content, -1 )

      ) );

      // Show the update process:

      printf( '<p>Post with ID: %d was %s updated</p>', 

          $post->ID, 

          ( 0 < $pid ) ? '' : 'NOT' 

      );     

  endforeach;

}

//add_action( 'after_setup_theme', 'remove_images' ); 



// TEMP MAKE H3 IN RS WHITE

add_action('wp_head','hook_css');



function hook_css() {

echo "<style>

@media only screen and (min-width : 319px) {

	.main .row.homemain {display: block;}

	.rsSBlock h3 {color: #fff;margin-top:0; margin-top: 0.3em;

font-size: 1.1em; margin-bottom: 0.3em;}

.home-image .rsSBlock, .intro .rsSBlock {width: 94% !important;	}

 }

 @media only screen and (min-width : 480px) {   

   	 .main .row.homemain {display: flex;}

	.home-image .rsSBlock, .intro .rsSBlock {width: 100% !important;	}

	.rsSBlock h3 {color: #fff; margin-top: 20px; font-size:21px} 

} 

	.intro aside {height:auto;} .blogdesc {background: #CB9CC6 none repeat scroll 0% 0%;

padding: 10px 0px;

margin: 10px 0px;

text-align: center;} </style>";

}

