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


if (!empty($_POST['reservation_id'])) {
  $isPass = true;


  // TODO: 檢查資料的格式
  if (mb_strlen($_POST['pet_id']) < 1) {
    $isPass = false;
    $output['error'] = '姓名請填三個字以上';
  }


  $time = null;
  if (!empty($_POST['time'])) {
    $t = strtotime($_POST['time']); # 取得 timestamp
    if ($t !== false) {
      $time = date('Y-m-d  H:i:s', $t);
    }
  }


  if ($isPass) {
    # 避免 SQL injection
    $sql = "UPDATE `reserve_system` SET 
      `user_id`=?,
      `pet_id`=?,
      `time`=?


    WHERE `reservation_id`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $_POST['user_id'],
      $_POST['pet_id'],
      $_POST['time'],
      $_POST['reservation_id'],
    ]);

    $output['success'] = boolval($stmt->rowCount());
  }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
