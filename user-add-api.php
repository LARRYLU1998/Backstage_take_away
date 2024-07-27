<?php
$dir = __DIR__ . '/uploads/'; # 存放檔案的資料夾
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';

# 回應給用戶端的欄位 (格式 JSON)
$output = [
  'success' => false,
  'postData' => $_POST, # 除錯用
  'error' => '',
  'code' => 0, # 除錯或追踪程式碼
  'file' => ''
];

$exts = [   # 檔案類型的篩選
  'image/jpeg' => '.jpg',
  'image/png' =>  '.png',
  'image/webp' => '.webp',
];

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
# 確保有上傳檔案，並且有 avatar 欄位，並且沒有錯誤
if (!empty($_FILES) and !empty($_FILES['avatar']) and $_FILES['avatar']['error'] == 0) {
  # 如果類型有對應到副檔名
  $type = $_FILES['avatar']['type'];
  if (!empty($exts[$type])) {
    $ext = $exts[$type]; # 副檔名
    $f = sha1($_FILES['avatar']['name'] . uniqid()); # 隨機的主檔名
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dir . $f . $ext)) {
      $output['file'] = $f . $ext;
    }
  }
}



if (!empty($_POST['name'])) {
  $sql = "INSERT INTO `user`(
    `name`, `email`, 
    `pic`, `address_detail`
    ) VALUES (
      ?, ?, ?,
      ?, ?
    )";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $_POST['name'],
    // $_POST['account'],
    $_POST['email'],
    $output['file'],
    $_POST['address_detail'],
  ]);

  $output['success'] = boolval($stmt->rowCount());
}

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
