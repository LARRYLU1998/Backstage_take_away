<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';

$questionId = isset($_GET["question_id"]) ? intval ($_GET["question_id"]) : 0;

if(!empty($questionId)){
  $sql ="DELETE FROM psycological_test WHERE question_id = $questionId";
  $pdo->query($sql);
}


$backTo = 'hearttest_question.php';
if(!empty($_SERVER['HTTP_REFERER'])){
    $backTo = $_SERVER['HTTP_REFERER'];
  }
  
  header("Location: $backTo");
  ?>