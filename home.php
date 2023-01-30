<?php 
include_once 'db/connect.php';
include_once 'db/function.php';
include_once 'db/session.php';
include_once 'navbar.php';

?>






<!DOCTYPE HTML>
<html>
<head>
  <title>Home page</title>
  <link rel="stylesheet"  href="css/navbar.css">
  <link rel="stylesheet"  href="css/home.css">
<section class="all-posts">

  <div class="heading"><h1>All podcast</h1> </div>
  <div class="box-container">

<?php
$select_podcast = $conn->prepare("SELECT * FROM `podcast`");
$select_podcast->execute();
if($select_podcast->rowCount() > 0){
  while($fetch_podcast = $select_podcast->fetch(PDO::FETCH_ASSOC)){
  
    $podcast_id = $fetch_podcast['id'];

  $verify_podcast = $conn->prepare("SELECT * FROM `podcast`  WHERE ID = ? LIMIT 1");
  $verify_podcast->execute([$podcast_id]);

?>
<div class="box">
  <img src="img/<?= $fetch_podcast['image']; ?>" alt="" class="image">
<h3 class="title"><?= $fetch_podcast['heading']; ?></h3>
<h3 class="title"><?= $fetch_podcast['username']; ?></h3>
<a href="view_pod.php?get_id=<?= $podcast_id; ?>" class="inline_btn">view podcast</a>
</div>

<?php 

}
}else{
  echo '<p class="empty">no podcast added yet!</p>';
}
?>

  </div>
  
</section>
<?php

include_once 'db/alert.php';
