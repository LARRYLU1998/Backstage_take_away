<?php
require __DIR__ . '/parts/pdo-connect.php';
header('Content-Type: application/json');

# 回應給用戶端的欄位 (格式 JSON)
$output = [
  'success' => false,
  'postData' => $_POST, # 除錯用
  'error' => '欄位資料不足',
  'code' => 0, # 除錯或追踪程式碼
];


if (!empty($_POST['email']) and !empty($_POST['password'])) {

  # 確認帳號對不對
  $sql = "SELECT * FROM user WHERE email=?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $_POST['email']
  ]);
  $row = $stmt->fetch();
  if (!empty($row)) {
    # 帳號是對的
    if (password_verify($_POST['password'], $row['password'])) {
      # 密碼是對的
      $_SESSION['admin'] = [
        'user_id' => $row['user_id'],
        'name' => $row['name'],
        'account' => $row['account'],
        'email' => $row['email'],
        'password' => $row['password'],
        'confirm_password' => $row['confirm_password'],
        'address_detail' => $row['address_detail'],
      ];
      $output['success'] = true;
      $output['error'] = '';
      $output['code'] = 200;
    } else {
      # 密碼是錯的
      $output['code'] = 420;
    }
  } else {
    # 帳號是錯的
    $output['code'] = 400;
  }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);