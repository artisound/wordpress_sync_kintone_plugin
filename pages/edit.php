<?php
  if($_POST) {
    echo json_encode($_POST);
    exit();
  }
  $params = json_decode(json_encode($_GET));
  $app_id = $params->app_id;

  echo '<div class="notice notice-success is_dismissible"><p>登録完了</p></div>';

  $options = new stdClass();
  $options->domain   = get_option('sync_kintone_domain');
  $options->username = get_option('sync_kintone_username');
  $options->password = get_option('sync_kintone_password');

  // $app_setting = $wpdb->prepare( 
  //   "
  //     SELECT sum(meta_value) 
  //     FROM $wpdb->postmeta 
  //     WHERE meta_key = %s
  //   ", 
  //   $meta_key
  // ) );
?>


<div
  class="wrap"
  id="edit_view"
  data-domain="<?= $options->domain; ?>"
  data-username="<?= $options->username; ?>"
  data-password="<?= $options->password; ?>"
>
  <div class="plugin-header">
    <h1 class="wp-heading-inline"><?= $app_id ? '編集' : '新規作成'; ?></h1>
  </div>

  <form id="edit_form" ref="form" action="<?= home_url('/wp-admin'); ?>/admin.php?page=<?= EDIT_PAGE; ?>" method="post">

    <table class="">
      <tbody>
        <tr class="form-field form-required">
          <th scope="row"><label for="app_id">アプリID</label></th>
          <td>
            <input
              id="domain"
              type="number"
              min="1"
              value="<?= $options->domain; ?>"
              placeholder="99"
              v-model="test"
            >
          </td>
          <td>
            <button
              type="button"
              class="button button-primary"
              id="get_kintone"
            >アプリ情報を取得</button>
          </td>
        </tr>
        <tr class="form-field form-required">
          <td>
            <tr class="form-field form-required">
              <th scope="row"><label for="wp_action">アクション</label></th>
              <td>
                <select id="wp_action">
                  <option value="ユーザー登録時">ユーザー登録時</option>
                  <option value="ユーザー登録時">ユーザー登録時</option>
                  <option value="ユーザー登録時">ユーザー登録時</option>
                  <option value="ユーザー登録時">ユーザー登録時</option>
                </select>
              </td>
            </tr>
          </td>
        </tr>
      </tbody>
    </table>


    <table class="widefat" id="field-table" style="max-width:1000px;margin-bottom:10px;">
      <thead>
        <tr>
          <th>#</th>
          <th>wordpress<br>カスタムフィールド</th>
          <th></th>
          <th>kintone<br>フィールドコード</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <button type="button" class="button-secondary" id="add_row">行を追加</button>


    <button type="button" class="button button-primary" value="保存">保存</button>
  </form>


  <input type="hidden" id="str_input" value="aaa">
</div>
