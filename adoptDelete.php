<?php

require __DIR__ . '/parts/pdo-connect.php';

$adopt_id = isset($_GET['adopt_id']) ? intval($_GET['adopt_id']) : 0;

if (!empty($adopt_id)) {
  $sql = "DELETE FROM online_virtual_adoption_form WHERE adopt_id=$adopt_id";
  $pdo->query($sql);
}

$backTo = 'adoptList.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
  $backTo = $_SERVER['HTTP_REFERER'];
}

header("Location: $backTo");


