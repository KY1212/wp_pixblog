<?php
/*
*
* Template Name: index.php
*
*/
?>
<?php get_header(); ?>
<div class="wrap indexPage">
  <main class="container">
    <!-- サブループ -->
    <?php
      $the_query = subLoop(5);
      $counter = '';
      if ($the_query->have_posts()) :
      while ($the_query->have_posts()) : $the_query->the_post();
        ++$counter;
    ?>
    <?php if ($counter <= 1) : ?>
      <div class="jumbotron">
        <a href="<?php the_permalink(); ?>">
          <div class="titleWrap">
          <!-- 投稿日時 -->
          <p class="date"><?php the_time('Y.m.d'); ?></p>
          <!-- 記事タイトル -->
          <p class="description"><?php the_title(); ?></p>
        </div>
      </a>
    </div>
    <div class="postWrap">
      <?php else: ?>
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
      <?php endif;?>
      <?php endwhile; endif;
        wp_reset_postdata();
      ?>
        </div>
      <p class="readmore">
      <a href="<?php echo content_url(); ?>/article" class="btn">
        read more
      </a>
    </p>
  </main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>