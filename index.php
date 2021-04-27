
<?php get_header(); ?>
<?php get_sidebar(); ?>

<!-- main -->
  <main>
    <div class="latest-post">
      <h2 class="post-title">最新の投稿</h2>
       <div class="latest-post-box">
         <ul>
            <?php
              $args = array(
                'posts_per_page' => 6 // 表示件数の指定
              );
              $posts = get_posts( $args );
              foreach ( $posts as $post ): // ループの開始
              setup_postdata( $post ); // 記事データの取得
            ?>
              <li>
                <div class="front-page-img"><?php echo wp_get_attachment_image(get_post_meta($post->ID, 'image', true),''); ?></div>
                <a class="front-page-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                <?php the_field('review'); ?>
              </li>
            <?php
              endforeach; // ループの終了
              wp_reset_postdata(); // 直前のクエリを復元する
            ?>
            </ul>
       </div>
      <h2 class="post-title">人気の投稿</h2>
      <div class="container">

      <div class="container-postboxs">
        <div class="swiper-container">
        <div class="swiper-wrapper">
          <?php
          $args = array(
            'wpp_start' => '',
             'wpp_end' => '',
              'post_html' => '<div class="swiper-slide">
              <li class="container-list">{thumb}{tags} {title} <span class="wpp-meta post-stats">{stats}</span></li></div>',
          );

          wpp_get_mostpopular($args);
          ?>
      </div>
      <!-- Add Pagination -->
      <div class="swiper-pagination"></div>
      <!-- Add Arrows -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- スライドショー -->
    <script>
      var appendNumber = 4;
      var prependNumber = 1;
      var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        centeredSlides: true,
        spaceBetween: 30,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
      document.querySelector('.prepend-2-slides').addEventListener('click', function (e) {
        e.preventDefault();
        swiper.prependSlide([
          '<div class="swiper-slide">Slide ' + (--prependNumber) + '</div>',
          '<div class="swiper-slide">Slide ' + (--prependNumber) + '</div>'
        ]);
      });
      document.querySelector('.prepend-slide').addEventListener('click', function (e) {
        e.preventDefault();
        swiper.prependSlide('<div class="swiper-slide">Slide ' + (--prependNumber) + '</div>');
      });
      document.querySelector('.append-slide').addEventListener('click', function (e) {
        e.preventDefault();
        swiper.appendSlide('<div class="swiper-slide">Slide ' + (++appendNumber) + '</div>');
      });
      document.querySelector('.append-2-slides').addEventListener('click', function (e) {
        e.preventDefault();
        swiper.appendSlide([
          '<div class="swiper-slide">Slide ' + (++appendNumber) + '</div>',
          '<div class="swiper-slide">Slide ' + (++appendNumber) + '</div>'
        ]);
      });
    </script>
      </div>
  </main>
  <!-- main end -->
  </div>
 <?php get_footer(); ?>
</body>
</html>
