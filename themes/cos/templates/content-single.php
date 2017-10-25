
<?php while (have_posts()) : the_post(); ?>

  <header class="main-post-header">
      <h1><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
  </header>
  
  <div class="eye-img">
    <?php
    if ( has_post_thumbnail() ) {
      the_post_thumbnail('post-image');
    }
    ?>
  </div>

  <?php the_content(); ?>

  <hr class="double">
      
  <div class="page-nav">
    <?php if ( get_previous_post()): ?>
       <div class="btn btn-blue alignleft"><?php previous_post_link('%link','前の記事へ'); ?></div>
    <?php endif; ?>
    <?php if (get_next_post()): ?>
      <div class="btn btn-blue alignright"><?php next_post_link('%link','次の記事へ'); ?></div>
    <?php endif; ?>
     
  </div>

<?php endwhile; ?>
