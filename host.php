<?php 
include_once 'db/connect.php';
include_once 'db/function.php';
include_once 'db/session.php';


include_once 'navbar.php';

if(isset($_POST['post'])){
    $id = create_unique_id();
   

    $user_id = $_POST['user_id'];
    $user_id = filter_var($user_id, FILTER_SANITIZE_STRING);

    $main_id = $_POST['main_id'];
    $main_id = filter_var($main_id, FILTER_SANITIZE_STRING); 

    $heading = $_POST['heading'];
    $heading = filter_var($heading, FILTER_SANITIZE_STRING); 

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = create_unique_id().'.'.$ext;
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'img/' .$rename;

    $audio = $_FILES['audio']['name'];
    $audio = filter_var($audio, FILTER_SANITIZE_STRING);
    $ext = pathinfo($audio, PATHINFO_EXTENSION);
    $rename_audio = create_unique_id().'.'.$ext;
    $audio_tmp_name = $_FILES['audio']['tmp_name'];
    $audio_size = $_FILES['audio']['size'];
    $audio_folder = 'pod/' .$rename_audio;

    if($image_size > 2000000){

        $warning_msg[] = 'Image size is too large!';
    }else{

     
     
$select_main = $conn->prepare("SELECT * FROM `mains` WHERE ID = ? LIMIT 1");
$select_main->execute([$main_id]);
$fetch_main = $select_main->fetch(PDO::FETCH_ASSOC);
        
  $verify_main = $conn->prepare("SELECT * FROM `mains` WHERE user_id =? 
  ");
  $verify_main->execute([$user_id]);

  $verify_podcast = $conn->prepare("SELECT * FROM `podcast` WHERE user_id = ? AND main_id = ?
  ");
  $verify_podcast->execute([$user_id, $main_id]);

$select_user =  $conn->prepare("SELECT * FROM `users` WHERE ID = ? LIMIT 1");
$select_user->execute([$user_id]);
$fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);


$insert_podcast= $conn->prepare("INSERT INTO `podcast` (id, user_id, main_id, heading, image, username, audio) 
VALUES(?,?,?,?,?,?,?)");
$insert_podcast->execute([$id, $user_id, $main_id,$heading,$rename, $fetch_user['username'], $rename_audio ]);
$success_msg[] = 'podcast created!';
move_uploaded_file($image_tmp_name, $image_folder);

move_uploaded_file($audio_tmp_name, $audio_folder);


    }
}


    













?>



<!DOCTYPE HTML>
<html>
<head>
  <title>Regrister</title>
  <link rel="stylesheet"  href="css/navbar.css">

  <style>
body{
      margin: 0;
      padding: 0;
      background: turquoise;
  }
.signup-form{
  width: 300px;
  padding: 20px;
  text-align: center;
  background: url(19.png);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  overflow: hiden;
}
.signup-form h1{
  margin-top: 100px;
  font-family: 'permanant Marker', cursive;
  color: #fff;
  font-size: 40px;
}
.signup-form input{
    display: block;
    width: 100%;
    padding: 0 16px;
    height: 44px;
    text-align: center;
    box-sizing: border-box;
    outline: none;
    border: none;
    font-family: "montserrat",sans-serif;
}
.txtb{
    margin: 20px 0;
    background: rgba(255,255,255,.5);
     border-radius: 6px;
}
.signup-btn{
    margin-top: 60px;
    margin-bottom: 20px;
    background: #487eb0;
    color: #fff;
    border-radius: 44px;
    cursor: pointer;
    transition: 0.8s;
}
.signup-btn:hover{
    transform: scale(0.96);
}
.signup-form a{
   text-decoration: none;
   color: ffff;
   font-family: "montserrat",sans-serif;
   font-size: 14px;
   padding: 10px;
   transition: 0.8s;
   display: block;
}
.signup-form a:hover{
     background: rgba(0,0,0,.3);
 }

</style>
</head>

<?php 

$select_user =  $conn->prepare("SELECT * FROM `users`");
$select_user->execute();
$fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);


  
$select_main = $conn->prepare("SELECT * FROM `mains`");
$select_main->execute();
$fetch_main = $select_main->fetch(PDO::FETCH_ASSOC);


?>

 
  <div class="signup-form">
    <form clas="" action="" method="POST" enctype="multipart/form-data">
    <h3><?= $fetch_profile['username']; ?> upload podcast where </h3>


    <input type="hidden"   name= "user_id"  value="<?= $fetch_profile['id']; ?>" class="txtb" >
    <input type="hidden"   name= "user_username"  value="<?= $fetch_profile['username']; ?>" class="txtb" >
    <input type="hidden"   name= "main_id"  value="<?= $fetch_main['id']; ?>" class="txtb" >
    <input type="text" placeholder="heading"  name="heading" value="" class="txtb"  required><h5>upload images</h5>
    <input type="file"   name="image"  required accept="image/*" class="txtb" > <h5>upload podcast file</h5>
    <input type="file"   name="audio"  required accept="audio/*" class="txtb" >
    <input type="submit" name="post" value="upload podcastnow" class="sigup-btn">
    </form>

 </body>

 <?php include 'db/alert.php'; ?>

</html>