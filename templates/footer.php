<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php   if (has_nav_menu('sitemap')) :
        wp_nav_menu(['theme_location' => 'sitemap',  'menu_class' => 'nav row', 'container_class'=> 'footermenu']);
      endif; ?>

  </div>
</footer>
