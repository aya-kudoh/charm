<?php get_header(); ?>
<?php get_sidebar(); ?>

<div class="page-php">
  <?php if(have_posts()): while(have_posts()):the_post(); ?>

    <h1 class="page-title"><?php the_title(); ?></h1>
    <div class="page-p"><p><?php the_content(); ?></p></div>

  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
