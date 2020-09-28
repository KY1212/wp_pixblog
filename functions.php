<?php
// style.cssを読み込む
function read_enqueue_styles() {
  wp_enqueue_style(
    'reset-style',
    get_stylesheet_directory_uri().'/assets/css/reset.css'
  );
  wp_enqueue_style(
    'main-style',
    get_stylesheet_directory_uri().'/assets/css/style.css'
  );
  wp_enqueue_script(
    'jquery',
    '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js',
    array(),'3.4.1',true
  );
  wp_enqueue_script(
    'main-style',
    get_theme_file_uri().'/assets/js/hamburger.js',
    array('jquery'),true
  );
}
add_action( 'wp_enqueue_scripts', 'read_enqueue_styles' );

// rel="prev"とrel=“next"表示の削除
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

// WordPressバージョン表示の削除
remove_action('wp_head', 'wp_generator');

// 絵文字表示のための記述削除（絵文字を使用しないとき）
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// アイキャッチ画像の有効化
add_theme_support('post-thumbnails');

function add_files() {
	// WordPress本体のjquery.jsを読み込まない
	wp_deregister_script('jquery');

	// jQueryの読み込み
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', "", "20160608", false );
	wp_enqueue_script( './assets/js/hamburger.js' );
}
add_action( 'wp_enqueue_scripts', 'add_files' );

//サイドバーにウィジェット追加
function widgetsidebar_init() {
  register_sidebar(array(
  'name'=>'サイドバー',
  'id' => 'side-widget',
  'before_widget'=>'
  <div id="%1$s" class="%2$s sidebar-wrapper">',
  'after_widget'=>'</div>',
  'before_title' => '<h5 class="sidebar-title">',
  'after_title' => '</h5>'
  ));
  }
  add_action( 'widgets_init', 'widgetsidebar_init' );

  function my_script_init() {
    wp_enqueue_style( 'style-name', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true );
  }
  add_action( 'wp_enqueue_scripts', 'my_script_init' );

//Pagenation
function pagination($pages = '', $range = 2) {
  $showItems = ($range * 2)+1;

  global $paged;
  if (empty($paged)) {
      $paged = 1;
  }

  if ($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if (!$pages) {
          $pages = 1;
      }
  }

  if (1 != $pages) {
    echo '<ul class="list">';
      if ($paged > 1) {
        echo "<a href='".get_pagenum_link($paged - 1)."'><li><i class='fas fa-angle-left arrow'></i></a>";
      }

      for ($i=1; $i <= $pages; $i++) {
          if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showItems)) {
            echo ($paged == $i)? 
            "<li class='page'><a href='".get_pagenum_link($i)."'>".$i."</a></li>":
            "<li class='page'><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
          }
      }

      if ($paged < $pages) {
          echo "<a href='".get_pagenum_link($paged + 1)."'><li><i class='fas fa-angle-right arrow'></i></a>";
      }
      echo '</ul>';
  }
}

//subloop
function subLoop($number = -1, $paged = "") {
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => $number,
    'no_found_rows' => false,
    'paged' => $paged,
  );

  $the_query = new WP_Query($args);

  return $the_query;
}

//タグ
function tagLoop() {
  $tags = get_the_tags();
  $tagCounter = "";
  if ($tags) {
    foreach ($tags as $tag) {
      ++$tagCounter;
      $tagLink = get_tag_link($tag->term_id);
      if ($tagCounter > 3) {
        break;
      }
      echo '<li class="tag"><a href="'.$tagLink.'">' . $tag->name . '</a></li>';
    }
  }
}

