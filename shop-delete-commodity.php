<?php

require __DIR__ . '/parts/pdo-connect.php'; #獲取資料庫連線資料

$commodity_id = isset($_GET['commodity_id']) ? intval($_GET['commodity_id']) : 0;

if(!empty($commodity_id)) {
    $sql = "DELETE FROM commodity WHERE commodity_id=$commodity_id";
    $pdo->query($sql);
}

$backTo = 'shop-edit.php';
if (! empty($_SERVER['HTTP_REFERER'])) {
    $backTo = $_SERVER['HTTP_REFERER'];
}

header("Location: $backTo");