<?php use Roots\Sage\Titles; ?>

<div class="page-header">

<?php 
if ( is_category() ) {
	$title = '<div class="col-sm-3"><h1>' .  Titles\title()  . '</h1></div>';
} else{
	$title = '<h1><?= Titles\title(); ?></h1>';
}
echo $title;
  if ( $category_description = category_description() )
			echo '<h2 class="archive-meta col-sm-9">' . $category_description . '</h2>';

?>

</div>
