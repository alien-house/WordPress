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
    <?php get_template_part('templates/gnav'); ?>
    <?php get_template_part('templates/breadcrumb'); ?>
    <!-- CONTENTS -->
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3 main-contents">
              <article class="main-post post">
                <?php include Wrapper\template_path(); ?>
              </article>
            </div>
            <div class="col-sm-3 col-sm-pull-9 side">
              <?php if (Setup\display_sidebar()) : ?>
                  <?php include Wrapper\sidebar_path(); ?>
              <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /CONTENTS -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
