<?php
require_once('vendor/autoload.php');

$headers = getallheaders();
if($headers['kintone_domain'] and $headers['kintone_username'] and $headers['kintone_password']) {
  $subdomain = explode('.', $headers['kintone_domain'])[0];
  $api = new \CybozuHttp\Api\KintoneApi(new \CybozuHttp\Client([
    'domain'    => 'cybozu.com',
    'subdomain' => $subdomain,
    'login'     => $headers['kintone_username'],
    'password'  => $headers['kintone_password'],
  ]));

  switch($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
      break;

    case 'get':
      if(isset($_GET['action'])) {

      } else {
        echo json_encode($api->app()->get($_GET['app_id']));
      }
  }
} else {
  
}