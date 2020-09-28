</div>
  <footer class="footerIndex">
    <div class="inner">
      <p class="image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer_logo.png" alt="PIXTECH BLOG">
      </p>
      <div class="links">
        <p>
          <a href="<?php echo content_url(); ?>/article">
            記事一覧
          </a>
        </p>
        <p>
          <a href="<?php echo content_url(); ?>/admin">
            運営者情報
          </a>
        </p>
        <p>
          <a href="<?php echo content_url(); ?>/contact_form">
            お問い合わせ
          </a>
        </p>
      </div>
      <p class="copylight">
        ©︎ 2019 PIXEL HEARTS.inc
      </p>
    </div>
  </footer>
  <?php
		wp_footer();
	?>
</body>
</html>