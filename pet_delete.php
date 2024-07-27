<?php
// require __DIR__ . "/parts/admin-required.php";
require __DIR__ . "/parts/pdo-connect.php";

$pet_id = isset($_GET["pet_id"]) ? intval($_GET["pet_id"]) : "0";

if (!empty($pet_id)) {
  $sql = "DELETE FROM pet_info WHERE pet_id = $pet_id";
  $pdo->query($sql);
}

$backTo = "pet_list.php";
if (!empty($_SERVER["HTTP_REFERER"])) {
  $backTo = $_SERVER["HTTP_REFERER"];
}

header("Location: $backTo");
