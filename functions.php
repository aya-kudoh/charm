<?php
//メニューバー
add_theme_support('menus');

register_nav_menus(
   array(
     'plece_global' => 'グローバル')
 );

//ウィジェット
register_sidebar(
  array(
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',

  )
);

//javascriptの読み込み
function my_scripts_method() {
	wp_enqueue_script(
		'custom_script',
		get_template_directory_uri() . '/index.js',
	);
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

// 投稿アーカイブの設定
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'post-all'; // ページ名
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

//デフォルト「投稿」→「ブログ」。
function change_post_menu_label() {

	global $menu;
	global $submenu;
	$menu[5][0] = 'ブログ';
	$submenu['edit.php'][5][0] = 'ブログ一覧';
	$submenu['edit.php'][10][0] = '新しいブログ';
	$submenu['edit.php'][16][0] = 'タグ';

}

function change_post_object_label() {

	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'ブログ';
	$labels->singular_name = 'ブログ';
	$labels->add_new = _x('追加', 'ブログ');
	$labels->add_new_item = 'ブログの新規追加';
	$labels->edit_item = 'ブログの編集';
	$labels->new_item = '新規ブログ';
	$labels->view_item = 'ブログを表示';
	$labels->search_items = 'ブログを検索';
	$labels->not_found = '記事が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';

}

add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );


//アイキャッチ画像を有効にする。
function set_user_profile()
{
global $profileuser;

//性別
echo '<tr><th><label>性別</label></th>
<td>
<input type="radio" name="gender" value="男性"'.(($profileuser->gender == '男性') ? 'checked' : "").'>男性<br>
<input type="radio" name="gender" value="女性"'.(($profileuser->gender == '女性') ? 'checked' : "").'>女性<br>
<td></tr>';

//年齢のテキストボックスを追加
echo '<tr><th><label for="pr">年齢</label></th><td><input type="text" name="age" value="'.esc_html($profileuser->age).'" />  歳</td></tr>';
}
add_action('show_password_fields', 'set_user_profile');

function update_user_profile($user_id)
{
update_user_meta($user_id, 'gender', $_POST['gender']);
update_user_meta($user_id, 'age', $_POST['age']);
}
add_action('profile_update', 'update_user_profile', 10, 2);

//ユーザーを削除したらユーザーメタ情報も削除
function delete_user_profile($user_id){
  delete_user_meta($user_id, 'user_tuika');
}
add_action('delete_user', 'delete_user_profile');

//タグ一覧取得
function mytagsc() {
  ob_start();?>
<div class="mytags">
<ul>
<?php
$tags = get_tags('orderby=name&order=ASC');
$orderby = apply_filters( 'get_terms_orderby', $orderby, $args );
if ($tags) {
foreach($tags as $tag) { ?>
<li><a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name. '('.$tag->count.')'; ?></a></li>
<?php } ?>
<?php } ?>
</ul>
</div>
<?php
return ob_get_clean();
}
add_shortcode('mytag', 'mytagsc');

// 管理画面の投稿一覧をログイン中のユーザーの投稿のみに制限する(管理者以外)
function pre_get_author_posts( $query ) {
    if ( is_admin() && !current_user_can('administrator') && $query->is_main_query()
            && ( !isset($_GET['author']) || $_GET['author'] == get_current_user_id() )) {
        $query->set( 'author', get_current_user_id() );
        unset($_GET['author']);
    }
}
add_action( 'pre_get_posts', 'pre_get_author_posts' );
function count_author_posts( $counts, $type = 'post', $perm = '' ) {
  if ( !is_admin() || current_user_can('administrator') ) {
    return $counts;
  }
  global $wpdb;
  if ( ! post_type_exists( $type ) )
    return new stdClass;
  $cache_key = _count_posts_cache_key( $type, $perm ) . '_author'; // 2
  $counts = wp_cache_get( $cache_key, 'counts' );
  if ( false !== $counts ) {
    return $counts;
  }
  $query = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s";
  $query .= $wpdb->prepare( " AND ( post_author = %d )", get_current_user_id() );
  $query .= ' GROUP BY post_status';

  $results = (array) $wpdb->get_results( $wpdb->prepare( $query, $type ), ARRAY_A );
  $counts = array_fill_keys( get_post_stati(), 0 );
  foreach ( $results as $row ) {
    $counts[ $row['post_status'] ] = $row['num_posts'];
  }
  $counts = (object) $counts;
  wp_cache_set( $cache_key, $counts, 'counts' );
  return $counts;
}
add_filter( 'wp_count_posts', 'count_author_posts', 10, 3 );

//人気投稿のスライドショーに画像を出力させる
add_filter( 'wpp_parse_custom_content_tags', 'add_wpp_content_tags', 10, 2 );
function add_wpp_content_tags( $html, $post_id ) {
  if ( false !== strpos( $html, '{tags}' ) ) {
    $tags_html = '';
    $terms = get_the_terms( $post_id, 'post_tag' );
    // if ( $terms ) {
    //   $tags_html = '<span class="post-tags">';
    //   foreach ( $terms as $term ) {
    //     $tags_html .= $term->name . ', ';
    //   }
    //   $tags_html = rtrim( $tags_html, ', ');
    //   $tags_html .= '</span>';
    // }
    $tags_html = "test";
    //ページ
    $fields = get_field('image',$post_id);
    // $tags_html = print_r($fields, true);
    $tags_html = '<img class="container-img" src="'. $fields['sizes']['thumbnail']. '" >';
    $html = str_replace( '{tags}', $tags_html, $html );
  }
  return $html;
}
//ページャー
function pagination( $pages = '', $range = 2 ) {
  $showitems = ( $range * 2 ) + 1; //表示するページ数（５ページを表示）

  global $paged; //現在のページ値
  if ( empty( $paged ) )$paged = 1; //デフォルトのページ

  if ( $pages == '' ) {
          global $wp_query;
          $pages = $wp_query->max_num_pages; //全ページ数を取得
          if ( !$pages ) //全ページ数が空の場合は、１とする
          {
                  $pages = 1;
          }
  }

  if ( 1 != $pages ) //全ページが１でない場合はページネーションを表示する
  {
          echo "<div class=\"pagenation\">\n";
          echo "<ul>\n";
          //Prev：現在のページ値が１より大きい場合は表示
          if ( $paged > 1 )echo "<li class=\"prev\"><a href='" . get_pagenum_link( $paged - 1 ) . "'>Prev</a></li>\n";

          for ( $i = 1; $i <= $pages; $i++ ) {
                  if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
                          //三項演算子での条件分岐
                          echo( $paged == $i ) ? "<li class=\"active\">" . $i . "</li>\n": "<li><a href='" . get_pagenum_link( $i ) . "'>" . $i . "</a></li>\n";
                  }
          }
          //Next：総ページ数より現在のページ値が小さい場合は表示
          if ( $paged < $pages )echo "<li class=\"next\"><a href=\"" . get_pagenum_link( $paged + 1 ) . "\">Next</a></li>\n";
          echo "</ul>\n";
          echo "</div>\n";
  }
}
