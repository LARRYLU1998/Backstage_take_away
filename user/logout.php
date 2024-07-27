<?php
session_start();

// 設定登出訊息
$_SESSION['logout_message'] = "您已成功登出！";

unset($_SESSION['admin']);

header('Location: index_.php');
