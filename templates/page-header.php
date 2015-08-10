<?php use Roots\Sage\Titles; ?>

<div class="page-header">
  <h1><?= Titles\title(); ?></h1>
  <?php 
  if ( is_category() ) :
					if ( $category_description = category_description() )
						echo '<h2 class="archive-meta col-sm-9">' . $category_description . '</h2>';
				endif;
	?>
</div>
