<?php
//查看session工具
session_start();

header('Content-Type: application/json');

echo json_encode($_SESSION);
