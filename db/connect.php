<?php 
$dsn = "mysql:host=localhost; dbname=podcast";
$user = "root";
$password = "";


try{
    $db = new PDO($dsn, $user, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn = new PDO($dsn, $user, $password);



}catch (PDOException $ex){
    echo "<script>alert('connection failed')</script>";
}















?>