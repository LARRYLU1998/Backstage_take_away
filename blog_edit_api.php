<?php
$dir = __DIR__ . '/uploads/'; # 存放檔案的資料夾
require __DIR__ . '/parts/pdo-connect.php';

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

$output['file'] = $_POST['pic'];

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


if (!empty($_POST['pet_id'])) {

  $sql = "UPDATE `blog` SET
  `pet_id`=?,`content`= ?,`pic`=?
  WHERE `blog_id`= ? ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $_POST['pet_id'],
    $_POST['content'],
    $output['file'],
    $_POST['blog_id']
  ]);

  $output['success'] = boolval($stmt->rowCount());
}

header('Content-Type: application/json');

echo json_encode($output, JSON_UNESCAPED_UNICODE);
