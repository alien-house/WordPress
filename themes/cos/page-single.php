<?php
/**
 * Template Name: Single Template
 */
?>
<?php while (have_posts()) : the_post(); ?>
	<?php //get_template_part('templates/page', 'header_single'); ?>
	<article class="main-post">
	<?php get_template_part('templates/content', 'page'); ?>
	</article>
<?php endwhile; ?>

