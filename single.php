<?php get_header(); ?>
<?php get_sidebar(); ?>
<main>
  <div class="single-page">
    <?php if(have_posts()): the_post(); ?>
    <article <?php post_class( 'article-content' ); ?>>
      <div class="article-info">
      <!--タイトル-->
      <h1 class="single-title"><?php the_title(); ?></h1>

      <!-- 画像 -->
      <img class="single-img" src="<?php $image = get_field('image'); echo $image['sizes']['medium']; ?>" />

      <br>

      <!-- 価格 -->
      <div class="single-price"><?php the_field('price'); ?></div><br>

      <!-- 投稿 -->
      <div class="single-posts"><?php the_field('post'); ?></div><br>

      <!-- 評価 -->
      <?php the_field('review'); ?><br>

      <!--タグ-->
      <div class="article-tag">
        <?php the_tags('<ul class="single-tag"><li>','</li><li>','</li></ul>'
      ); ?>
      </div>

      <br>

      <!--投稿日を取得-->
      <span class="article-date">
        <i class="far fa-clock"></i>
        <time
        datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
        <?php echo get_the_date(); ?>
        </time>
      </span>

      <!--著者を取得-->
      <div class="single-icon">
        <a href="http://wp1.local/author/wp1/"><?php echo get_avatar( get_the_author_id(), 500 ); ?></a>
        <a href="http://wp1.local/author/wp1/"><?php	the_author_meta( 'display_name', $author) ?></a>
      </div>
    </div>
    </article>

    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>​
