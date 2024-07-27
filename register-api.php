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


$sql = "INSERT INTO `user`(
    `name`,`password`,`email`,`pic`,`address_detail`
    ) VALUES(?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['password'],
    $_POST['email'],
    $output['file'],
    $_POST['address_detail']
]);

$output['success'] = boolval($stmt->rowCount());


header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
