<?php

/* --------------------------------------------------------------------------
 * ショートコード
 ---------------------------------------------------------------------------*/
/* お知らせ一覧取得
====================================================*/
function show_news() {
  ob_start();
  get_template_part('lib/news'); 
  return ob_get_clean();
}
add_shortcode('news', 'show_news');

/* ブログ情報取得
====================================================*/
//ex.[bloginfo key='template_url']
function bloginfo_shortcode( $atts ) {
  foreach ($atts as $key => $value){
    return get_bloginfo($value);
  }
}
add_shortcode('bloginfo', 'bloginfo_shortcode');

/* 歯科情報取得
====================================================*/
function dentalinfo_shortcode( $atts ) {
  foreach ($atts as $key => $value){
    $dental = get_option( 'dental_setting' );
    return $dental[$value];
  }
}
add_shortcode('dentalinfo', 'dentalinfo_shortcode');

/* phpテンプレート呼び出し 
====================================================*/
function tmp_shortcode( $atts ) {
  foreach ($atts as $key => $value){
    ob_start();
    get_template_part('./lib/'.$value);
    return ob_get_clean();
  }
}
add_shortcode('tmp', 'tmp_shortcode');

/* 投稿画面からテンプレート呼び出し
====================================================*/
function short_php($params = array()) {
  extract(shortcode_atts(array(
    'file' => 'default'
  ), $params));
  ob_start();
  include(get_theme_root() . '/' . get_template() . "/$file.php");
  return ob_get_clean();
}
add_shortcode('php_include', 'short_php');

/* 医院情報取得 ex.[clinicinfo key='clinic']
====================================================*/
function clinic_shortcode($params = array()) {
    $options = get_option( 'dental_theme_options' );
    extract(shortcode_atts(array(
        'key' => '',
    ), $params));
    return $options[$key];
}
add_shortcode('clinicinfo', 'clinic_shortcode');