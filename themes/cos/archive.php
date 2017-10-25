<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php get_template_part('templates/page', 'header'); ?>
<?php 
  $terms = get_the_terms($post->ID, "category");
  $term_name = $terms[0]->name;
?> 
<?php if(is_category()): ?>
<div class="category-title">カテゴリ： <?= $term_name; ?></div>
<hr>
<?php endif; ?>
<section class="post-archives">
<?php while (have_posts()) : the_post(); ?>
	<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>
</section>
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
