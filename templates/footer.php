<footer class="content-info" role="contentinfo">
  <div class="container-fluid">
  	<div class="footermenu">
    <?php   if (has_nav_menu('sitemap')) :
        wp_nav_menu(['theme_location' => 'sitemap',  'menu_class' => 'nav row', 'container'=> '']);
      endif; ?>
  </div>

		<div class="strip">
		Content © <?php bloginfo('name'); ?>. Website by <a href="http://safetycat.co.uk/" title="Safetycat">Safetycat</a>

		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		  </div>




  </div>


  
</footer>
