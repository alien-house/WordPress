
<article class="aligncontainer">
  <?php
	if ( has_post_thumbnail() ) {
		echo '<a href="';
		the_permalink();
		echo '">';
		the_post_thumbnail('post-thumbnails', array( 'class' => 'alignleft post-archives_img' ));
		echo '</a>';
	}
	?>
    <h1 class="title--post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php get_template_part('templates/entry-meta'); ?>
    <div class="btn btn-blue btn--post"><a href="<?php the_permalink(); ?>">詳細を見る</a></div>
</article>
<hr>

