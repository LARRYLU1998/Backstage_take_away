<?php
require __DIR__ . '/parts/pdo-connect.php';
header('Content-Type: application/json');

# 回應給用戶端的欄位 (格式 JSON)
$output = [
  'success' => false,
  'postData' => $_POST, # 除錯用
  'error' => '',
  'code' => 0, # 除錯或追踪程式碼
];


if (!empty($_POST['adopt_id'])) {
  $isPass = true;

  if (mb_strlen($_POST['pet_id']) < 1) {
    $isPass = false;
    $output['error'] = '姓名請填三個字以上';
  }

  if ($isPass) {
    $sql = "UPDATE `online_virtual_adoption_form` SET 
      `pet_id`=?,
      `user_id`=?,
      `donation_method`=?,
      `amount`=?,
      `payment`=?,
      `donation`=?,
      `donate_address`=?



    WHERE `adopt_id`=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $_POST['pet_id'],
      $_POST['user_id'],
      $_POST['donation_method'],
      $_POST['amount'],
      $_POST['payment'],
      $_POST['donation'],
      $_POST['donate_address'],
      $_POST['adopt_id'],
    ]);

    $output["success"] = boolval($stmt->rowCount());
  }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
