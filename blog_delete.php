<?php
require __DIR__ . '/parts/pdo-connect.php';

$blog_id = isset($_GET['blog_id']) ? intval($_GET['blog_id']) : 0;

if (!empty($blog_id)) {
  $sql = "DELETE FROM blog WHERE blog_id=$blog_id";
  $pdo->query($sql);
}

$backTo = 'page.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
  $backTo = $_SERVER['HTTP_REFERER'];
}

header("Location: $backTo");
