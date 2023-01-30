<?php 
include_once 'db/connect.php';
include_once 'db/function.php';
include_once 'navbar.php';


if(isset($_POST['updateProfileBtn'])){

  $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?
  LIMIT 1");
  $select_user->execute([$user_id]);
  $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
    
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
       $email = $_POST['email'];
       $email = filter_var($email, FILTER_SANITIZE_STRING);
   
       if(!empty($username)){
        $update_username = $conn->prepare("UPDATE `users` SET username = ? WHERE id = ?
        ");
        $update_username->execute([$username, $user_id]);
        $success_msg[] = 'username updated!';
       }
       if(!empty($email)){
        $verify_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $verify_email->execute(([$email]));
        if($verify_email->rowCount() > 0){
             $warning_msg[] = 'Email already taken!';
        }else{
           $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE
           id = ?");
           $update_email->execute([$email, $user_id]);
           $success_msg [] = 'Email update!';
        }
       }
   
     $image = $_FILES['image']['name'];
       $image = filter_var($image, FILTER_SANITIZE_STRING);
       $ext = pathinfo($image, PATHINFO_EXTENSION);
       $rename = create_unique_id().'.'.$ext;
      $image_size = $_FILES['image']['size'];
       $image_tmp_name = $_FILES['image']['tmp_name'];
       $image_folder = 'image/' .$rename;
if(!empty($image)){
  if($image_size > 200000000){
 $warning_msg[] = 'image size is too large!';
}else {
    $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id
    = ?");
    $update_image->execute([$rename, $user_id]);
    move_uploaded_file($image_tmp_name, $image_folder);
    if($fetch_user['image'] != ''){
        unlink('image/'.$fetch_user['image']);
    }
    $success_msg[] = 'Image updated!';
}
}
$prev_password = $fetch_user['password'];

$old_password = password_hash($_POST['old_password'], PASSWORD_DEFAULT);
$old_password = filter_var($old_password, FILTER_SANITIZE_STRING);

$empty_old = password_verify('', $old_password);

$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
$new_password = filter_var($new_password, FILTER_SANITIZE_STRING);

$empty_new = password_verify('', $new_password);

$c_password = password_verify($_POST['c_password'], $new_password);
$c_password = filter_var($c_password, FILTER_SANITIZE_STRING);

if($empty_old != 1){
    $verify_old_password = password_verify($old_password, $prev_password);
    if($verify_old_password == 1 ){
      if($c_password ==1){
         if($empty_new != 1){
        $success_msg [] = 'working ';
         }else {
            $warning_msg[] = 'please new password!';
         }
      }else {
        $warning_msg [] = 'onfirm password not match!';
      }
    }else{
        $warning_msg[] = 'old password not matched!';
    }
}

}

if(isset($_POST['delete_image'])){
    $select_old_pic = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT
    1");
    $select_old_pic->execute([$user_id]);
    $fetch_old_pic = $select_old_pic->fetch(PDO::FETCH_ASSOC);

    if($fetch_old_pic['image'] == ''){
        $warning_msg[] = 'Image already delected!';
    }else {
        $update_old_pic = $conn->prepare("UPDATE `users` SET image = ? WHERE id 
        = ?");
        $update_old_pic->execute(['', $user_id]);
        if($fetch_old_pic['image'] != ''){
            unlink('img/'.$fetch_old_pic['image']);
        }
        $success_msg[] = 'Image delected!';
    }
}


   


?>



<!DOCTYPE html>
<html lang="en" dir="ltr"> 
<head>
    <meta charset="utf-8">
  <title>login</title>
</head>
<link rel="stylesheet" href="css/navbar.css">

<style>


body{
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background: linear-gradient(125deg,#778beb,#f8a5c2);

}
 .box{
     width: 300px;
     padding: 40px;
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%,-50%);
     background: linear-gradient(125deg,#778beb,#f8a5c2);
     text-align: center;
     border:1px solid white;
     border-radius:20px;
 }
 .box h1{
     color: white;
     text-transform: uppercase;
     font-weight: 500;
        }

        box input[type = "email"],.box input[type = "email"]
{
    border:0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 14px 10px;
    width: 200px;
    outline: none;
    color: white;
    border-radius: 100px;
    transition: 0.25s;
 }

.box input[type = "text"],.box input[type = "password"]
{
    border:0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 14px 10px;
    width: 200px;
    outline: none;
    color: white;
    border-radius: 100px;
    transition: 0.25s;
 }
  .box input[type = "text"]:focus,.box input[type = "password"]:focus{
   width: 280px;
   border-color: #2ecc71;
 }
 .box input[type = "email"]:focus,.box input[type = "email"]:focus{
   width: 280px;
   border-color: #2ecc71;
 }

.box input[type =  "submit"]{
    border:0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #2ecc71;
    padding: 14px 40px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    cursor: pointer;
}
.box input[type = "submit"]:hover{
  background: #2ecc71;
}

</style>
<body>


<form class="box" action="" method="post" enctype="multipart/form-data">
     <h1>profile edit</h1>

   
     <input type="text" name="email" placeholder="<?= $fetch_profile['email'] ?>" id="emailField" value=""  >    
     <input type="text" name="username" id="" value="" placeholder="<?= $fetch_profile['username'] ?>" >
     <input type="text" name=" old_password" placeholder="password"  value=""  >    
     <input type="text" name="new_password" placeholder="new password"  value="" >    
     <input type="text" name="c_password" placeholder="new password"  value=""  >  
     <input type="hidden" name="hidden_id"   value="" required>
     <?php if($fetch_profile['image'] != ''){ ?>
        <img src= "image/ <?= $fetch_profile['image']; ?>" alt="">
        <input type="submit" name="delete_image" value="delete image" onclick="return confirm('delect this  image?');">
        <?php }; ?>
    <input type="file" name="image" accept="image/*"  >
    <input type="submit" name="updateProfileBtn" value="Update Profile ">
    </form>


</body>
<?php include_once 'db/alert.php'; ?>
</html>


