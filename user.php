<?php
session_start();

if (isset($_SESSION["user"])) {
  include __DIR__ . '/user-login.php';
} else {
  include __DIR__ . '/user-nologin.php';
}

