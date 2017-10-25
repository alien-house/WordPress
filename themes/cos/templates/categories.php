<section class="categories">
  <div class="categories_box">
    <?php
    $categories = get_categories('exclude=2,6,10,11,12,7,8,9,15,1,19&order=asc');

    foreach($categories as $category) :
    	$cat_link = get_category_link($category->cat_ID);
    	echo '<div class="categories__catebox"><h3><a href="' . $cat_link . '" class="inline-link">' . $category->cat_name . '</a></h3><ul>';
    	query_posts('showposts=5&cat=' . $category->cat_ID);
    		while(have_posts()) :
    			the_post();
    			echo '<li><a href="'. get_the_permalink() .'">' . get_the_title() . '</a></li>';
    		endwhile;
    	wp_reset_query();
    	echo '</ul>';
    	echo '</div>';
    endforeach;
    ?>
  </div>
</section>
