<?php 
include_once 'db/connect.php';


session_start();
session_destroy();


setcookie('user_id', '', time() -1, '/');
header('Location: index.php');









include_once 'db/alert.php';


?>