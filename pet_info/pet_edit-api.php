<?php
// require __DIR__."/parts/admin-required.php";
$dir = __DIR__ . '/uploads/'; # 存放檔案的資料夾
require __DIR__ . "/parts/pdo-connect.php";
header("Content-Type: application/json");

# 回應給用戶端的欄位（格式json）
$output = [
  "success" => false,
  "postData" => $_POST,   # 除錯用
  "error" => "",
  "code " => 0,   # 除錯或追蹤程式碼用
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

if (!empty($_POST["pet_id"]) and !empty($_POST["name"])) {
  $isPass = true;

  // TODO: 檢查資料格式
  if (mb_strlen($_POST["name"]) < 2) {
    $isPass = false;
    $output["error"] = "姓名請填2個字以上";
  }
  // if (mb_strlen($_POST["tag"]) < 2) {
  //   $isPass = false;
  //   $output["error"] = "請填2個字以上";
  // }

  if ($isPass) {
    // 避免 SQL injection
    $sql = "UPDATE `pet_info` SET 
              `name`=?,
              `personality_type`=?,
              `tag`=?,
              `age`=?,
              `type`=?,
              `sex`=?,
              `adopted`=?,
              `pet_pic1`=?
            WHERE `pet_id`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $_POST['name'],
      $_POST['personality_type'],
      $_POST['tag'],
      $_POST['age'],
      $_POST['type'],
      $_POST['sex'],
      $_POST['adopted'],
      $output['file'],
      $_POST['pet_id']
    ]);


    $output["success"] = boolval($stmt->rowCount());
  }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
