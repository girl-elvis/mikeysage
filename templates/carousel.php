<?php
//echo "post is" . $post->ID ;

$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' =>'any', 'post_parent' => $post->ID, 'orderby'=> 'menu_order', 'order'=> "ASC" ); 

$attachments = get_posts( $args );

if ( $attachments ) {
	
	foreach ( $attachments as $attachment ) {
		$sliderimages[] = $attachment->ID;
		
	}
}

?>

<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
    <div class='carousel-outer'>
        <!-- Wrapper for slides -->
        <div class='carousel-inner'>

<?php
foreach ($sliderimages as $index => $slide) {
	echo "<div class='item";
	if ($index == 0) {
      echo " active"; //Make first slide "active"
 	}
	echo " '>";

	echo wp_get_attachment_image( $slide, 'slide' ) ;
    echo "<div class='container'><div class='carousel-caption'><h4>" ;
    echo get_post_field('post_excerpt', $slide); // caption
    echo "</h4><p class='lead'></p></div></div></div>" ;
}
?>


          
        </div>
            
        <!-- Controls -->
        <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
            <span class='glyphicon glyphicon-arrow-left'></span>
        </a>
        <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
            <span class='glyphicon glyphicon-arrow-right'></span>
        </a>
    </div>
    
    <!-- Indicators -->
    <ol class='carousel-indicators mCustomScrollbar'>

<?php
foreach ($sliderimages as $index => $thumb) {
	echo "<li data-target='#carousel-custom' data-slide-to='" . $index . "' " ;
	if ($index == 0) {
      echo "class='active'"; //Make first slide "active"
 	}
	echo " ></li>";
	//echo wp_get_attachment_image( $thumb, 'slidethumb' ) . "" ;
}
?>

    </ol>
</div>
