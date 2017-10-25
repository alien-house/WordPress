<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


//アイキャッチ画像を有効にする
function post_ogp($id) {
	$noImg = 'images/eye_logo.jpg';
	//アイキャッチ画像を取得
	$eyeImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');

	if ($eyeImg){
		//アイキャッチ画像があれば優先
		echo $eyeImg[0];
	} else {
		//エントリーに属する画像を取得
		$query = 'post_parent=' . $id . '&post_type=attachment&post_mime_type=image';
		$postImg = get_children($query);

		if (!empty($postImg)){
			//最初にアップロードされた画像IDを取得
			$keys = array_keys($postImg);
			$num = $keys[sizeOf($keys)-1];

			//画像IDからサムネイルを取得
			$thumb = wp_get_attachment_image_src($num, 'medium');

			echo clean_url($thumb[0]);
		} else {
			echo get_bloginfo('template_directory') . '/' . $noImg;
		}
	}
}

remove_action ('wp_head', 'print_emoji_detection_script', 7);
remove_action ('wp_print_styles', 'print_emoji_styles');



/* --------------------------------------------------------------------------
 * 投稿整形
 ---------------------------------------------------------------------------*/
remove_filter('the_content', 'convert_chars');
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');


/* --------------------------------------------------------------------------
 * bodyにクラス
 ---------------------------------------------------------------------------*/
add_filter('body_class', 'my_class_names');
function my_class_names($classes) {
	$classes = array();
	$classes[] = 'under';
	return $classes;
}

/* --------------------------------------------------------------------------
 * 月別アーカイブ
 ---------------------------------------------------------------------------*/
function post_get_archives( $postname = 'post', $args = '') {
  global $wpdb, $wp_locale;
  $defaults = array(
    'limit' => '',
    'format' => 'html',
    'before' => '',
    'after' => '',
    'show_post_count' => false,
    'echo' => 1,
    'yearorder' => 'DESC',
    'monthorder' => 'DESC', 
    'post_type' => $postname,
  );
  $r = wp_parse_args( $args, $defaults );
  extract( $r, EXTR_SKIP );

  if ( '' != $limit ) {
    $limit = absint($limit);
    $limit = ' LIMIT '.$limit;
  }
  if ( (strtoupper($yearorder) != 'ASC') && (strtoupper($yearorder) != 'DESC') )
    $yearorder = 'DESC';
  if ( (strtoupper($monthorder) != 'ASC') && (strtoupper($monthorder) != 'DESC') )
    $monthorder = 'ASC';
  $whereName = "WHERE post_type = '$postname' AND post_status = 'publish'";
  $where = apply_filters('getarchives_where', $whereName, $r );
  $join = apply_filters('getarchives_join', "", $r);
  $output = '';
  $query = "
    SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts
    FROM $wpdb->posts $join $where
    GROUP BY YEAR(post_date), MONTH(post_date)
    ORDER BY YEAR(post_date) $yearorder, MONTH(post_date) $monthorder
    $limit";
  $key = md5($query);
  $cache = wp_cache_get( 'post_get_archives', 'general' );
  if ( !isset( $cache[ $key ] ) ) {
    $arcresults = $wpdb->get_results($query);
    $cache[ $key ] = $arcresults;
    wp_cache_add( 'post_get_archives', $cache, 'general' );
  } else {
    $arcresults = $cache[ $key ];
  }
  if ( $arcresults ) {
    $afterafter = $after;
    $outputs = $posts = array();
     foreach ( (array) $arcresults as $arcresult ) {
       $url = get_month_link( $arcresult->year, $arcresult->month );
       $text = '<i class="icon-icon_arrow snav-list__item--icon-arrow" aria-hidden="true"></i>'.$arcresult->year.'年'.monthNone($wp_locale->get_month($arcresult->month)).'月';
       if ( $show_post_count ){
         $after = ' ('.$arcresult->posts.')' . $afterafter;
         $posts[$arcresult->year] += $arcresult->posts;
      }
       $outputs[$arcresult->year] .= get_archives_link($url, $text, $format, $before, $after);
     }
    $output = implode('', $outputs);
  }
  if ( $echo )
    echo $output;
  else
    return $output;
}
function monthNone($text){
  $resultsText = str_replace( "月", "", $text);
  return $resultsText;
}

/* --------------------------------------------------------------------------
 * タイプ取得
 ---------------------------------------------------------------------------*/
function get_post_type_query() {
  if ( is_archive() ) {
    $postype = get_query_var( 'post_type' );
    if($postype){
      return $postype;
    }else{
      return get_post_type();
    }
  }
  return get_post_type();
}


/* --------------------------------------------------------------------------
 * ナビ
 ---------------------------------------------------------------------------*/

class Cos_Walker extends Walker_Nav_Menu{
  function start_el(&$output, $item, $depth, $args) {
    global $wp_query;

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';
    
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $type_check = !empty($post_type_check) ? strpos( $item->url, $post_type_check ) !== false : false;
    $current = $type_check || $id_check ? ' current-menu-item ' : '';
    $current_classe .= $current;
      if($current_classe){
        $class_names = $current_classe;
      }else{
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
      }
    $class_names = ' class="' . esc_attr( $class_names ) .'"';

    $output .= $indent . '<li ' . $value . $class_names .'>';
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )    ? ' rel="'    . esc_attr( $item->xfn    ) .'"' : '';
    $attributes .= ! empty( $item->url )    ? ' href="'   . esc_attr( $item->url    ) .'"' : '';
    $icons .= ! empty( $item->classes )    ? ' <i  class="icon-' . esc_attr( $item->classes[0] ) .'" aria-hidden="true"></i>' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $icons;
    $item_output .= "<span>".$item->title."</span>";
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


/* --------------------------------------------------------------------------
 * SVGをアップできるように
 ---------------------------------------------------------------------------*/
function my_ext2type($ext2types) {
    array_push($ext2types, array('image' => array('svg', 'svgz')));
    return $ext2types;
}
add_filter('ext2type', 'my_ext2type');
  
function my_mime_types($mimes){
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'my_mime_types');
  
function my_mime_to_ext($mime_to_ext) {
    $mime_to_ext['image/svg+xml'] = 'svg';
    return $mime_to_ext;
}
add_filter('getimagesize_mimes_to_exts', 'my_mime_to_ext');



/* --------------------------------------------------------------------------
 * ブログ情報取得
 ---------------------------------------------------------------------------*/
//ex.[bloginfo key='template_url']
function bloginfo_shortcode( $atts ) {
  foreach ($atts as $key => $value){
    return get_bloginfo($value);
  }
}
add_shortcode('bloginfo', 'bloginfo_shortcode');