<?php

require __DIR__ . '/parts/pdo-connect.php';

$reservation_id = isset($_GET['reservation_id']) ? intval($_GET['reservation_id']) : 0;

if (!empty($reservation_id)) {
  $sql = "DELETE FROM reserve_system WHERE reservation_id=$reservation_id";
  $pdo->query($sql);
}

$backTo = 'reserveList.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
  $backTo = $_SERVER['HTTP_REFERER'];
}

header("Location: $backTo"); 


