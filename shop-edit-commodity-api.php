<?php
require __DIR__ . '/parts/pdo-connect.php';
$dir = __DIR__ . '/uploads/'; # 存放檔案的資料夾
header('Content-Type: application/json');



$output = [
  'success' => false,
  'postDate' => $_POST,
  'error' => '',
  'code' => 0,
  'file' => ""
];
$exts = [   # 檔案類型的篩選
  'image/jpeg' => '.jpg',
  'image/png' =>  '.png',
  'image/webp' => '.webp',
];

  $output['file']=$_POST['pic'];

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

if (!empty($_POST['commodity_id']) && !empty($_POST['name'])) {
  $isPass = true;


  if (mb_strlen($_POST['name']) < 3) {
    $isPass = false;
    $output['error'] = '請輸入完整商品名稱';
  }
  if (mb_strlen($_POST['brand_name']) < 3) {
    $isPass = false;
    $output['error'] = '請輸入完整品牌名稱';
  }
  if (mb_strlen($_POST['price']) < 2) {
    $isPass = false;
    $output['error'] = '請輸入商品價格';
  }

  if ($isPass) {
    $sql = "UPDATE `commodity` SET 
          `name`=?,
          `brand_name`=?,
          `price`=?,
          `pic`=?,
          `type`=?,
          `species`=? 
        WHERE `commodity_id`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $_POST['name'],
      $_POST['brand_name'],
      $_POST['price'],
      $output['file'],
      $_POST['type'],
      $_POST['species'],
      $_POST['commodity_id']
    ]);

    $output['success'] = boolval($stmt->rowCount());
  }
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
