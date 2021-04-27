<?php get_header(); ?>
<?php get_sidebar(); ?>
<!-- main -->
<main>
  <div class="blog-wrap">
    <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
           <!-- タイトル -->
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
           <div class="blog-archive">
             <div class="blog-excerpt">
               <!-- 画像 -->
               <img src="<?php $image = get_field('image'); echo $image['sizes']['medium']; ?>" />
               <!-- 記事抜粋 -->
               <div class="article-excerpt">
                 <?php
                   $text = mb_substr(get_field('post'),0,120,'utf-8');
                   echo $text.'...';
                ?>
               </div>
             </div>
             <!-- 評価 -->
             <?php the_field('review'); ?>
             <!-- タグ -->
             <?php the_tags('<ul class="blog-tag"><li>','</li><li>','</li></ul>'); ?>
             <!-- アイコン -->
             <div class="archive-icon">
               <a href="http://wp1.local/author/wp1/"><?php echo get_avatar( get_the_author_id(), 500 ); ?></a>
               <a href="http://wp1.local/author/wp1/"><?php	the_author_meta( 'display_name', $author) ?></a>
             </div>
             <br>
             <!-- 日付 -->
             <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
          </div>
      </article>
      <?php endwhile; ?>
    <!-- ページャー -->
    <section class="wrapbox">
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div>
        <!-- <figure class="eyecatch-image2" style="background-image: url(<?//php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>);"> <a href="<?php the_permalink(); ?>"> Image </a> </figure>
        <h3><a href="<?//php the_permalink(); ?>">
            <?//php the_title(); ?>
            </a></h3>
        <p><a href="<?//php the_permalink(); ?>"><?//php echo wp_trim_words( get_the_content(), 20, '...' ); ?></a></p> -->
    </div>
    <?php endwhile; ?>
    </section>

    <?php
    //Pagenation
    if ( function_exists( "pagination" ) ) {
            pagination( $additional_loop->max_num_pages );
    }
    ?>

    <?php else : ?>
    <div>
        <h6>記事が投稿されていません</h6>
    </div>
    <?php endif; ?>
  </div>
</main>
<!-- main end -->
 <?php get_footer(); ?>
