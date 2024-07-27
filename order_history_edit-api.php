<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
header("Content-Type: application/json");


//回應給用戶端的欄位
$output = [
  'success' => true,
  'postData' => $_POST,
  'error'  => '',
  'code' => 0,
];

$isPass = true;


//有無表單送過來 若表單不是空的就處理
if (empty($_POST['order_id']) || empty($_POST['user_id']) || empty($_POST['recipient_name']) || empty($_POST['recipient_phone']) || empty($_POST['order_date']) || empty($_POST['delivery_method']) || empty($_POST['payment_method']) || empty($_POST['status']) || empty($_POST['Invoice_no'])) {
  $isPass = false;
}


if ($isPass) {
  $sql = "UPDATE `order_history` SET
  `status` = ?
  WHERE `order_id` = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $_POST['status'],
    $_POST['order_id']
  ]);

  $output['success'] = boolval($stmt->rowCount());
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
