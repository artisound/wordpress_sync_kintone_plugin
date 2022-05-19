<?php
  /** ******************************************
   * 設定登録処理
   ****************************************** */
  if(!empty($_POST)) {
    $post = $_POST;
    $return = array();
    foreach($post as $key => $value) {
      $return[] = update_option($key, $value);
    }
  }

  $options = new stdClass();
  $options->domain   = get_option('sync_kintone_domain');
  $options->username = get_option('sync_kintone_username');
  $options->password = get_option('sync_kintone_password');
?>
<div class="plugin-header">
  <h1 class="wp-heading-inline">初期設定</h1>
</div>
<form id="init_form" action="admin.php?page=<?= INIT_PAGE; ?>" method="post">
  <table class="form-table">
    <tbody>
      <tr class="form-field form-required">
        <th scope="row"><label for="domain">ドメイン</label></th>
        <td><input name="sync_kintone_domain" type="text" id="domain" value="<?= $options->domain; ?>" placeholder="example.cybozu.com"></td>
      </tr>
      <tr class="form-field form-required">
        <th scope="row"><label for="username">ユーザー名</label></th>
        <td><input name="sync_kintone_username" type="text" id="username" value="<?= $options->username; ?>"></td>
      </tr>
      <tr class="form-field form-required">
        <th scope="row"><label for="password">パスワード</label></th>
        <td><input name="sync_kintone_password" type="password" id="password" value="<?= $options->password; ?>"></td>
      </tr>
    </tbody>
  </table>

  <div class="buttons">
    <button type="submit" class="button button-primary" value="保存">保存</button>
  </div>
</form>