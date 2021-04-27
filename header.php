<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="index.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/swiper.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css"> -->
    <?php wp_head(); ?>
  </head>
  <body>
    <header>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/header-logo.png" alt=""></a>
      <?php wp_nav_menu(); ?>
    </header>
