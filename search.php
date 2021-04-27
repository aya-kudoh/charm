<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php if ( have_posts() ) : ?>

<main>
<!-- <h1><?//php printf( __( '検索結果: %s', 'altitude' ), '<span>' . get_search_query() . '</span>' ); ?></h1> -->


       <?php while ( have_posts() ) : the_post(); ?>
               <?//php get_template_part( 'content', 'search' ); ?>
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


       <?php else : ?>


該当なし

       <?php endif; ?>

</main>
 <?php get_footer(); ?>
