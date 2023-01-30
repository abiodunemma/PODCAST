<?php 
include_once 'db/connect.php';
include_once 'db/function.php';
include_once 'db/session.php';
include_once 'navbar.php';

if(isset($_GET['get_id'])){
    $get_id = $_GET['get_id'];
}else {
    $get_id = '';
    
}
?>





  <!DOCTYPE HTML>
<html>
<head>
  <title>view podcast</title>
  <link rel="stylesheet"  href="css/navbar.css">
  <link rel="stylesheet"  href="css/home.css">
<section class="all-posts">

  <div class="heading"><h1>All podcast</h1> </div>
  <div class="box-container">

<section class="all-posts">
    <div class="box">
<center>
   
<?php 
$select_podcast = $conn->prepare("SELECT *  FROM `podcast` WHERE id = ? LIMIT
1");
$select_podcast->execute([$get_id]);
if($select_podcast->rowCount() > 0){
while($fetch_podcast = $select_podcast->fetch(PDO::FETCH_ASSOC)){

?>
<h3>WHERE IS THE PODCAT IMAGE GENERATED OR INSERTED</h3>
 <h5><?= $fetch_podcast['heading']; ?></h5>
<img src="img/<?= $fetch_podcast['image']; ?>" alt="" class="image">
<img src="pod/<?= $fetch_podcast['audio']; ?>" alt="" class="audio">
<h3><?= $fetch_podcast['username'];?></h3>
<h4> enjoy listening</h4>
</center>
    </div>
<?php
}
}else {
    echo '<p class="empty">podcast is missing!</p>';
}
?>
</center>
</section>
<?php  include_once 'db/alert.php'; ?>