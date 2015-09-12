<?php use Roots\Sage\Titles; ?>



<?php 
if(is_home() ){
		$off = ' offscreen';
		$title = '<h1>' .  Titles\title(). '</h1>';
}else if ( is_category() ) {
	$title = '<div class="col-sm-3"><h1>' .  Titles\title()  . '</h1></div>';
} else{
	$title = '<h1>' .  Titles\title(). '</h1>';
}


echo '<div class="page-header' . $off . '">' . $title;

  if ( $category_description = category_description() )
			echo '<div class="archive-meta col-sm-9">' . $category_description . '</div>';

?>

</div>
