<?php 
include_once 'db/connect.php';
include_once 'db/function.php';

error_reporting(0);

if(isset($_POST['submit'])){

 $id = create_unique_id();
 
 $username = $_POST['username'];
 $username = filter_var($username, FILTER_SANITIZE_STRING);


    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);


    $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
  
    $c_password= password_verify($_POST['c_password'], $password);
    $c_password = filter_var($c_password, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);

    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = create_unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'image/' .$rename;

 if(!empty($image)){
     if($image_size > 2000000){
        $warning_msg[] = 'Image size is too large!';
    }else{
    move_uploaded_file($image_tmp_name, $image_folder);
    }
    }else {
      $rename = '';
    }

$verify_email =  $conn->prepare("SELECT * FROM `users` WHERE email = ?");
$verify_email->execute([$email]);

if($verify_email->rowCount() > 0){
  $warning_msg[] = 'Email already taken!';
}else {
  if($c_password == 1){
    $insert_user = $conn->prepare("INSERT INTO `users`(id, username,email,
    password, image) VALUES(?,?,?,?,?)");
    $insert_user->execute([$id, $username, $email, $password, $rename]);
    move_uploaded_file($image, $image_folder);
    $success_msg []= 'registered successfully';
  }else {
    $warning_msg[] = 'confirm password dont match';
  }
}
}
    
?>






<!DOCTYPE HTML>
<html>
<head>
  <title>Regrister</title>
  <style>
body{
      margin: 0;
      padding: 0;
      background: blueviolet;
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

<body>

  <div class="signup-form">
    <form clas="" action="" method="POST">
    <h1>Register</h1>
    <input type="email" placeholder=" Email" name="email" value=" " class="txtb" required>
    <input type="text" placeholder="Username"  name="username" value="" class="txtb"  required>
    <input type="password" placeholder="Password" name="password" value="" class="txtb" required >
    <input type="password" placeholder=" confim your Password" name="c_password" value="" class="txtb" required >
    <input type="file" required name="image" accept="image/*">
    <input type="submit" name="submit" value="register now" class="sigup-btn">
    <a href="login.php">Already Have one ?.Login</a>
    </form>
 </div>
</body>
 <?php include 'db/alert.php'; ?>

</html>