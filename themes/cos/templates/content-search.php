<article class="article">
  <?php
	if ( has_post_thumbnail() ) {
		echo '<span class="article__pic">';
		echo '<a href="';
		the_permalink();
		echo '">';
		the_post_thumbnail('post-thumbnails');
		echo '</a></span>';
	}
	?>
  <div class="article__box">
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php get_template_part('templates/entry-meta'); ?>
  </div>
</article>
