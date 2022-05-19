<?php
/*
Plugin Name: kintone連携プラグイン
Plugin URI: http://www.example.com/plugin
Description: WordPressで実行した処理をkintoneに同期します。
Author: K.Nishizoe
Version: 0.1
*/
?>

<input type="hidden" id="plugin_url" value="<?= plugin_dir_url( __FILE__ ); ?>">

<?php
define('INIT_PAGE', 'sync_kintone_init');
define('LIST_PAGE', 'sync_kintone_list');
define('EDIT_PAGE', 'sync_kintone_edit');
$plugin_url = plugin_dir_url( __FILE__ );


/** ************************************************
 * 初回有効時
 ************************************************ */
function sk_plugin_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'sync_kintone';
    if($wpdb->get_var("SHOW TABLES LIKE '".$table_name."'") != $table_name) {
        create_table_init();
    }
}
register_activation_hook( __FILE__, 'sk_plugin_activate' );


/** ************************************************
 * テーブル生成
 ************************************************ */
function create_table_init() {
  global $wpdb;
  $data_db_version= '1.0';

  $table_name = $wpdb->prefix . 'sync_kintone';
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE ".$table_name." (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `from` varchar(32) CHARACTER SET utf8 NOT NULL,
    `to` int(11) NOT NULL,
    `app_id` int(11) NOT NULL,
    INDEX (app_id),
    PRIMARY KEY (id)
  ) ".$charset_collate.";";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

  add_option( 'data_db_version', $data_db_version );
}


//設定ページを追加するためにadmin_menuをフックする
add_action( 'admin_menu', function (){
  global $plugin_url;
  wp_enqueue_style('sk_style', $plugin_url . 'css/style.css' );

  wp_enqueue_script('kintone-api', $plugin_url . 'js/kintone_api.js');
  wp_enqueue_script('axios', 'https://cdn.jsdelivr.net/npm/axios@0.27.2/dist/axios.min.js');

	add_menu_page(
		'kintone同期', //ページタイトル
		'kintone接続設定', //設定メニューに表示されるメニュータイトル
		'administrator',			//権限
		INIT_PAGE,		//設定ページのURL。options-general.php?page=sample_setup_page
		'init_view',		//設定ページのHTMLをはき出す関数の定義
    'not_setting_function',
	);
  add_submenu_page(
    INIT_PAGE,
    '連携アプリ一覧',
    '連携アプリ一覧',
    'administrator',
    LIST_PAGE,
    'list_view'
  );
  add_submenu_page(
    INIT_PAGE,
    '新規追加',
    '新規追加',
    'administrator',
    EDIT_PAGE,
    'edit_view'
  );
});

//アクションフックで呼ぶ関数
function not_setting_function() {

}

// 設定ページのHTML
function init_view() {
  global $plugin_url;
  wp_enqueue_script('v-init', $plugin_url . 'js/v-init.js');
  require('pages/init.php');
}


// 連携アプリ一覧ページのHTML
function list_view() {
  global $plugin_url;
  wp_enqueue_script('v-list', $plugin_url . 'js/v-list.js');
	require('pages/list.php');
}


// 新規追加ページのHTML
function edit_view() {
  global $plugin_url;
  wp_enqueue_script('v-edit', $plugin_url . 'js/v-edit.js');
	require('pages/edit.php');
}