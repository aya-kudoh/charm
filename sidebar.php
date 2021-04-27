<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0">
    <title>charme</title>
    <link rel="stylesheet" href="stylesheet.css">
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="index.js"></script>
  </head>
  <body>
<!-- side bar -->
<div class="wrap">
  <div class="side-bar">
    <div class="login">
      <h2 class="side-bar-title">ログイン</h2>
      <?php echo do_shortcode('[swpm_login_form]'); ?>
    </div>

    <div class="serch">
      <h2 class="side-bar-title">検索</h2>
      <?php get_search_form(); ?>
    </div>

    <div class="category">
      <h2 class="side-bar-title">記事を探す</h2>
      <ul class="sidebar-menu">
        <li><div class="main_menu">メイクアップ</div>
          <ul class="sub_menu">
            <li><a href="#">ファンデーション</a></li>
            <li><a href="#">下地</a></li>
            <li><a href="#">パウダー</a></li>
            <li><a href="#">アイシャドウ</a></li>
            <li><a href="#">リップ</a></li>
          </ul>
        </li>
        <li><div class="main_menu">スキンケア</div>
          <ul class="sub_menu">
            <li><a href="#">化粧水</a></li>
            <li><a href="#">下地</a></li>
            <li><a href="#">クリーム</a></li>
          </ul>
        </li>
        <li><div class="main_menu">ブランド</div>
          <ul class="sub_menu">
            <li><a href="#">Dior</a></li>
            <li><a href="#">シャネル</a></li>
            <li><a href="#">ポールアンドジョー</a>
            <li><a href="#">ちふれ</a></li>
        </li>
      </ul>
    </div>
  </div>
<!-- side bar end -->
