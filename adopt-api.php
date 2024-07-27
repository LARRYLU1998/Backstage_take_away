<?php
require __DIR__ . "/parts/pdo-connect.php";
header("Content-Type: application/json");

# 回應給用戶端的欄位（格式json）
$output = [
  "success" => false,
  "postData" => $_POST,   #除錯用
  "error" => "",
  "code " => 0,   #除錯或追蹤程式碼用
];

if (!empty($_POST["donation_method"])) {
  $isPass = true;

  if (mb_strlen($_POST['pet_id']) < 2) {
    $isPass = false;
    $output['error'] = '請填2個字以上';
  }

  if ($isPass) {
    // 避免 SQL injection
    $sql = "INSERT INTO `online_virtual_adoption_form`( 
          `pet_id`, `user_id`, `donation_method`, `amount`, `payment`, `donation`, `donate_address`
          ) VALUES (
          ?, ?, ?, ?, ?, ?, ?
        )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $_POST['pet_id'],
      $_POST['user_id'],
      $_POST['donation_method'],
      $_POST['amount'],
      $_POST['payment'],
      $_POST['donation'],
      $_POST['donate_address'],
    ]);

    $output["success"] = boolval($stmt->rowCount());
  }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
