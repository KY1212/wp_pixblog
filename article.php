<?php
/*
*
* Template Name: article.php
*
*/
?>
<?php get_header(); ?>
<div class="wrap articlePage">
  <main class="container">
    <h3 class="headingTop">
      記事一覧
    </h3>
    <div class="postWrap">
    <!-- サブループ -->


    <?php
      $the_query = subLoop(4,$paged);
      $counter = '';
      if ($the_query->have_posts()) :
      while ($the_query->have_posts()) : $the_query->the_post();
        ++$counter;
    ?>
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