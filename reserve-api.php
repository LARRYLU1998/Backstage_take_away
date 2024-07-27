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

if (!empty($_POST["user_id"])) {


    $isPass = true;


    $time = null;
    if (!empty($_POST['time'])) {
        $t = strtotime($_POST['time']);     // 取得 timestamp
        if ($t !== false) {
            $time = date('Y-m-d  H:i:s', $t);
        }
    }

    if ($isPass) {
        // 避免 SQL injection
        $sql = "INSERT INTO `reserve_system`(
                `user_id`, `pet_id`, `time`
                ) VALUES (
                    ?, ?, ?   
                )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['user_id'],
            $_POST['pet_id'],
            $time
        ]);

        $output["success"] = boolval($stmt->rowCount());
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
