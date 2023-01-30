<?php 
  include_once 'db/session.php';
 include_once 'db/connect.php';
 include_once 'db/function.php';

 



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Side Navigation Bar</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
  
<?php 
if($main_id != ''){

}
?>
<?php
if($main_id != ''){
    $select_pod = $conn->prepare("SELECT * FROM `main` WHERE id = ?
    LIMIT 1");
    $select_pod->execute([$main_id]);
    if($select_pod->rowCount() > 0){
        $fetch_pod = $select_pod->fetch(PDO::FETCH_ASSOC);
     
        
   
?>
<div class="wrapper">
    <div class="sidebar">
        <h2>menu</h2>
        <ul>
            dncnncnnc
        <h2><?= $fetch_pod['id']; ?></h2>
      
        <?php if($fetch_pod['id'] !=''){ ?>
          <img src="image/<?= $fetch_pod['id']; ?>" alt="">
    <?php }; ?>

            <li><a href="home.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="about.php"><i class="fas fa-address-card"></i>About</a></li>
            <li><a href="host.php"><i class="fas fa-project-diagram"></i>host</a></li>
            <li><a href="update.php"><i class="fas fa-blog"></i>update Profile</a></li>
            <li><a href="session.php"><i class="fas fa-address-book"></i>podcast</a></li>
            <li><a href="logout.php"><i class="fas fa-map-pin"></i>Logout</a></li>
            </ul> 
  <?php  }else{ ?>
    <div class="wrapper">
    <div class="sidebar">

 <p>plese login or register!</p>
 <a href="index.php">65565</a>
 <a href="signup.php">fg</a>
    </div>
        <?php ;} ?>
 
        <div class="social_media">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <?php }; ?>
      </div>
    </div>

      </div>
    </div>
</div>

</body>
<?php include_once 'db/connect.php';?>
</html>
