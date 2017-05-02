<?php

/* --------------------------------------------------------------------------
 * ビジュアルエディタ用CSS
 ---------------------------------------------------------------------------*/
add_editor_style('css/base.css');
add_editor_style('css/blue.css');
add_editor_style('css/contents.css');
 
function custom_editor_settings( $initArray ) {
    $initArray['body_class'] = 'editor-area';
    return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );


/* --------------------------------------------------------------------------
 * head内不要なタグの消去
 ---------------------------------------------------------------------------*/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head','adjacent_posts_rel_link_wp_head',10);
remove_action('wp_head', 'feed_links_extra', 3);
remove_filter( 'pre_term_description', 'wp_filter_kses' );

/* --------------------------------------------------------------------------
 * 画像挿入時の不要な属性を削除
 ---------------------------------------------------------------------------*/
function remove_img_attr($html) {
  $html = preg_replace('/ (width|height)."\d*"/', '', $html); // width・heightを削除
  $html = preg_replace('/ class=".+"/', '', $html); // 不要なclassを削除
  return $html;
}
add_filter('get_image_tag', 'remove_img_attr');


/* --------------------------------------------------------------------------
 * 投稿整形
 ---------------------------------------------------------------------------*/
remove_filter('the_content', 'convert_chars');
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');

/* --------------------------------------------------------------------------
 * 投稿画面のカテゴリ新規追加とよく使うものを削除
 ---------------------------------------------------------------------------*/
function hide_category_add() {
   global $pagenow;
   global $post_type;//投稿タイプで切り分けたいときに使う
   if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php')){
       echo '<style type="text/css">
       #category-adder{display:none;}
       #category-tabs{display:none;}
       </style>';
   }
}
add_action( 'admin_head', 'hide_category_add' );

/* --------------------------------------------------------------------------
 * スラッグ名からIDを取得する
 ---------------------------------------------------------------------------*/
function get_ids_from_slugs($slugs){
  $slugs = preg_split("/,¥s?/", $slugs);
  $ids = array();
  foreach($slugs as $page_slug){
    $page = get_page_by_path($page_slug);
    array_push($ids, $page->ID);
  }
  return implode(",", $ids);
}

/* --------------------------------------------------------------------------
 * 権限によるメニューの出しわけ設定。プラグイン「Capability Manager」と併用。
 ---------------------------------------------------------------------------*/
function userrole_menus() {
    $current_user = wp_get_current_user();

      remove_menu_page( 'edit.php' ); 
  // remove_menu_page( 'index.php' );                  // ダッシュボード
  // remove_menu_page( 'edit.php' );                   // 投稿
  // remove_menu_page( 'upload.php' );                 // メディア
  // remove_menu_page( 'edit.php?post_type=page' );    // 固定ページ
  // remove_menu_page( 'edit.php?post_type=homeslides' );    // 固定ページ
  // remove_menu_page( 'admin.php?page=theme_options' );    // 固定ページ
  // remove_menu_page( 'edit-comments.php' );          // コメント
  // remove_menu_page( 'themes.php' );                 // 外観
  // remove_menu_page( 'users.php' );                  // ユーザー
  // remove_menu_page( 'tools.php' );                  // ツール
  // remove_menu_page( 'options-general.php' );        // 設定
    if( $current_user->roles[0] == "administrator" ){  // 特権管理者の場合はメニューの削除をしない
    }else if($current_user->roles[0] == "author") { // 投稿者の場合、メニューを削除する
      remove_menu_page( 'themes.php' ); 
      remove_menu_page( 'tools.php' ); 
      remove_menu_page( 'options-general.php' ); 
      remove_menu_page( 'edit.php?post_type=homeslides' ); 
      remove_menu_page( 'edit.php?post_type=tinymcetemplates' ); 
      remove_menu_page( 'edit.php?post_type=cfs' );
    }
}

/* テキストエディタを削除。ビジュアルエディタのみに。 
====================================================*/
add_action('admin_menu', 'userrole_menus');
function admin_css() {
    $current_user = wp_get_current_user();
    if($current_user->roles[0] == "author") { 
      echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo("template_directory").'/admin.css">';
      vertionnone();
      add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 70 );
      add_action('admin_head', 'my_admin_head');
    }
}
add_action('admin_head', 'admin_css');


/* --------------------------------------------------------------------------
 * バージョン更新を非表示にする
 ---------------------------------------------------------------------------*/
function vertionnone(){
  add_filter('pre_site_transient_update_core', '__return_zero');
  // APIによるバージョンチェックの通信をさせない
  remove_action('wp_version_check', 'wp_version_check');
  remove_action('admin_init', '_maybe_update_core');
}

/* --------------------------------------------------------------------------
 * フッターWordPressリンクをメールリンクに
 ---------------------------------------------------------------------------*/
function custom_admin_footer() {
 echo '<a href="mailto:xxx@zzz">hotlineへお問い合わせ</a>';
 }
add_filter('admin_footer_text', 'custom_admin_footer');


/* --------------------------------------------------------------------------
 * 管理バーの項目を非表示
 ---------------------------------------------------------------------------*/
function remove_admin_bar_menu( $wp_admin_bar ) {
 $wp_admin_bar->remove_menu( 'wp-logo' ); // WordPressシンボルマーク
 //$wp_admin_bar->remove_menu('my-account'); // マイアカウント
 }

// 管理バーのヘルプメニューを非表示にする
function my_admin_head(){
 echo '<style type="text/css">#contextual-help-link-wrap{display:none;}</style>';
 }

/* --------------------------------------------------------------------------
 * ダッシュボードウィジェット非表示
 ---------------------------------------------------------------------------*/
function example_remove_dashboard_widgets() {
   if (!current_user_can('level_10')) { //level10以下のユーザーの場合ウィジェットをunsetする
     global $wp_meta_boxes;
     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況
     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
   }
 }
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');