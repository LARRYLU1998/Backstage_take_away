<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
header('Content-Type: application/json');

# 回應給用戶端的欄位 (格式 JSON)
$output = [
  'success' => false,
  'postData' => $_POST, # 除錯用
  'error' => '',
  'code' => 0, # 除錯或追踪程式碼
];


if (!empty($_POST['sid']) and !empty($_POST['name'])) {
  $isPass = true;


  // TODO: 檢查資料的格式
  if (mb_strlen($_POST['name']) < 3) {
    $isPass = false;
    $output['error'] = '姓名請填三個字以上';
  }

  # 檢查 email 格式
  if (!empty($_POST['email']) and !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $isPass = false;
    $output['error'] = 'Email 請符合格式';
  }

  $birthday = null;
  if (!empty($_POST['birthday'])) {
    $t = strtotime($_POST['birthday']); # 取得 timestamp
    if ($t !== false) {
      $birthday = date('Y-m-d', $t);
    }
  }


  if ($isPass) {
    # 避免 SQL injection
    $sql = "UPDATE `address_book` SET 
      `name`=?,
      `email`=?,
      `mobile`=?,
      `birthday`=?,
      `address`=?
    WHERE `sid`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $_POST['name'],
      $_POST['email'],
      $_POST['mobile'],
      $birthday,
      $_POST['address'],
      $_POST['sid'],
    ]);

    $output['success'] = boolval($stmt->rowCount());
  }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
