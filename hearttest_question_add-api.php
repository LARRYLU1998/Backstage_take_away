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
if (!empty($_POST['question_content'])) {
    $isPass = true;
} else {
    $isPass = false;
}
if (!empty($_POST['option_a'])) {
    $isPass = true;
} else {
    $isPass = false;
}
if (!empty($_POST['option_b'])) {
    $isPass = true;
} else {
    $isPass = false;
}
if (!empty($_POST['option_c'])) {
    $isPass = true;
} else {
    $isPass = false;
}
if (!empty($_POST['option_d'])) {
    $isPass = true;
} else {
    $isPass = false;
}
if (!empty($_POST['option_value_a'])) {
    $isPass = true;
} else {
    $isPass = false;
}
if (!empty($_POST['option_value_b'])) {
    $isPass = true;
} else {
    $isPass = false;
}
if (!empty($_POST['option_value_c'])) {
    $isPass = true;
} else {
    $isPass = false;
}
if (!empty($_POST['option_value_d'])) {
    $isPass = true;
} else {
    $isPass = false;
}


if ($isPass) {
    $sql = "INSERT INTO `psycological_test`(
    `question_content`, `option_a`, `option_b`, 
    `option_c`, `option_d`, `option_value_a`, `option_value_b`, `option_value_c`, `option_value_d`
  ) VALUES (
    ?,?,?,?,?,?,?,?,?     
  )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['question_content'],
        $_POST['option_a'],
        $_POST['option_b'],
        $_POST['option_c'],
        $_POST['option_d'],
        $_POST['option_value_a'],
        $_POST['option_value_b'],
        $_POST['option_value_c'],
        $_POST['option_value_d'],
    ]);

    $output['success'] = boolval($stmt->rowCount());
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
