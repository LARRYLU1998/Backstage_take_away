<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';

$resultId = isset($_GET["result_id"]) ? intval ($_GET["result_id"]) : 0;

if(!empty($resultId)){
  $sql = "DELETE FROM psycological_test_result WHERE result_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$resultId]);
}

$backTo = 'hearttest_result.php';
if(!empty($_SERVER['HTTP_REFERER'])){
  $backTo = $_SERVER['HTTP_REFERER'];
}

header("Location: $backTo");
?>
