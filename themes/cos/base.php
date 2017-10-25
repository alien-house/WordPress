<?php
use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>
<!doctype html>

<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
  
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php if (!is_front_page()) {
      get_template_part('templates/gnav');
      get_template_part('templates/breadcrumb'); 
    }?>
    <?php include Wrapper\template_path(); ?>
    <?php if (Setup\display_sidebar()) : ?>
      <div class="sidebar">
        <?php include Wrapper\sidebar_path(); ?>
      </div><!-- /.sidebar -->
    <?php endif; ?>

  <?php
    do_action('get_footer');
    get_template_part('templates/footer');
    wp_footer();
  ?>
  </body>
</html>
