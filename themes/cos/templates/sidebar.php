
<?php 
 if(is_page()):?>
  <section class="side-module">
  <?php 
    $page_parent = $post->ancestors[count($post->ancestors) - 1]; 
    echo '<h1><a href="'.get_page_link($page_parent).'">'.get_the_title($page_parent).'</a></h1>'; 
    if(!$page_parent){
      $page_parent = $post->ID;
    }
    $page_childs = get_posts( 'numberposts=-1&order=ASC&orderby=menu_order&post_type=page&post_parent='.$page_parent ); 
    if ( $page_childs ) { 
      foreach ( $page_childs as $page_child ) {
        $page_child_id = $page_child->ID; 
          echo '<ul class="side-nav">';
          echo '<li><a href="'.get_permalink($page_child_id).'">'. get_the_title($page_child_id).'</a></li>'; // 子ページのタイトルを表示
          // foreach ( $page_grandsons as $page_grandson ) { // 孫ページのループ
          //   $page_grandson_id = $page_grandson->ID; // 孫ページのIDを取得
          //   echo '<li><a href="'. get_page_link($page_grandson_id).'">'.get_the_title($page_grandson_id).'</a></li>'; // 孫ページの情報を表示
          // }
          echo '</ul>';

          //*孫が入らなければ消してもいいけど、どうだろう。
        $page_grandsons = get_posts( 'numberposts=-1&order=ASC&orderby=menu_order&post_type=page&post_parent='.$page_parent ); 
        if ( $page_grandsons ) {
        }
      }
    }
  ?>
  </section>
<?php endif; ?>


<?php //投稿記事の場合
if(is_single() || get_post_type_query() == 'post'): ?>
<?php 
  $cat = get_post_taxonomies($post->ID); 
  $cat_name =$cat[0]; 
?> 
<section class="side-module">
  <h1>カテゴリー</h1>
  <ul class="side-nav">
    <?php
        $cat_all = get_terms( $cat_name, "hide_empty=false,fields=all&get=all" );
        foreach($cat_all as $value):
     ?>
    <li><a href="<?php echo get_category_link($value->term_id); ?>"><?php echo $value->name;?></a></li>
    <?php endforeach; ?>
  </ul>
</section>
<section class="side-module">
  <h1>アーカイブ</h1>
  <ul class="side-nav">
    <?php post_get_archives(get_post_type_query()); ?>
  </ul>
</section>
<?php endif; ?>


<ul class="side-bnr">
    <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/dist/images/bnr01_blog.png"></a></li>
</ul>


