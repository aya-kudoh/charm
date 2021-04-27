<?php
/*
Template Name: マイページ
*/
?>
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="index.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <?php wp_head(); ?>
  </head>
<?php get_header(); ?>
<?php get_sidebar(); ?>
  <!-- main -->
    <main>
      <div class="mypage">
        <div class="profilebox">
          <?php echo get_avatar( get_the_author_id(), 500 ); ?>
          <div class="profile">
           <span><?php	the_author_meta( 'display_name', $author) ?></span>
           <span><?php	the_author_meta( 'age', $author) ?>歳／<?php	the_author_meta( 'gender', $author) ?></span>
           <a href="http://wp1.local/wp-admin/profile.php">プロフィール編集</a>
           <?php the_author_meta( 'user_description' ); ?>
          </div>
        </div>
        <h2>－今までの投稿―</h2>
        <div class="mypage-list">
          <?php $userId = get_query_var('author'); ?>
          <?php $user = get_userdata($userId); ?>
          <?php $posts = get_posts("author=$userId&orderby=date&post_type=post&numberposts=1000"); ?>
          <?php if (!empty($posts)) { ?>
            <div class="mypage-list-item">
              <ul>
                <?php foreach( $posts as $post ) : setup_postdata($post); ?>
                <li>
                  <div><img src="<?php $image = get_field('image'); echo $image['sizes']['medium']; ?>" /></div>
                  <div ><a class="mypage-title-link" href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
                  <div><?php echo get_the_date("Y/n/j");?></div>
                </li>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
              </ul>
            </div>
          <?php } ?>
        </div>
    </main>
 <?php get_footer(); ?>

  </body>
</html>
