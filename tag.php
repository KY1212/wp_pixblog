<?php
/*
*
* Template Name: tag.php
*
*/
?>
<?php get_header(); ?>
<div class="wrap tagPage">
  <main class="container">
    <h3 class="headingTop">
      <?php single_cat_title(); ?>
    </h3>
    <div class="postWrap">
    <?php if (have_posts()): while (have_posts()):the_post(); ?>
      <div class="post">
        <a href="<?php the_permalink(); ?>">
        <!-- サムネイル表示 -->
        <?php
          if( has_post_thumbnail() ):
            the_post_thumbnail('full');
          else :
          endif;
        ?>
        <!-- 投稿日時 -->
        <p class="date"><?php the_time('Y.m.d'); ?></p>
        <!-- 記事タイトル -->
        <p class="description"><?php the_title(); ?></p>
      </a>
      <ul class="tags" style="list-style:none;">
        <?php tagLoop(); ?>
      </ul>
      </div>
      <?php endwhile; endif;
        wp_reset_postdata();
      ?>
    </div>
    <div class="pagenation">
      <?php pagination($the_query->max_num_pages);?>
    </div>
  </main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>