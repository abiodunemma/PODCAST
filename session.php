<?php 
include_once 'db/connect.php';
include_once 'db/function.php';
include_once 'db/session.php';
include_once 'navbar.php';


if(isset($_POST['create'])){
    $id = create_unique_id();

    $user_id = $_POST['user_id'];
    $user_id = filter_var($user_id, FILTER_SANITIZE_STRING);

    $about = $_POST['about'];
    $about = filter_var($about, FILTER_SANITIZE_STRING); 

    $nickname = $_POST['nickname'];
    $nickname = filter_var($nickname, FILTER_SANITIZE_STRING); 

        
  $verify_main = $conn->prepare("SELECT * FROM `mains` WHERE user_id =? 
  ");
  $verify_main->execute([$user_id]);

  
$select_user =  $conn->prepare("SELECT * FROM `users` WHERE ID = ? LIMIT 1");
$select_user->execute([$user_id]);
$fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

$verify_nickname = $conn->prepare("SELECT * FROM `mains` WHERE  nickname = ? ");
$verify_nickname->execute([$nickname]);
if($verify_nickname->rowCount() > 0){
    $warning_msg[] = 'nickname already taken';
}

$insert_main= $conn->prepare("INSERT INTO `mains` (id,user_id, about, nickname) 
VALUES(?,?,?,?)");
$insert_main->execute([$id, $user_id, $about, $nickname]);
$success_msg[] = 'session created';
header('location: home.php');

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

<?php 

$select_user =  $conn->prepare("SELECT * FROM `users`");
$select_user->execute();
$fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);




?>


<body>

  <div class="signup-form">
    <form clas="" action="" method="POST">
    <h3><?= $fetch_profile['username']; ?> book a session </h3>
    <h3><?= $fetch_profile['id']; ?> book a session </h3>
    <input type="hidden"   name= "user_id"  value="<?= $fetch_profile['id']; ?>" class="txtb" >
    <input type="text" placeholder="about"  name="about" value="" class="txtb"  required>
    <input type="text" placeholder="nickname"  name="nickname" value="" class="txtb"  required>
  
    <input type="submit" name="create" value="create now" class="sigup-btn">
    </form>

 </div>
</body>
<?php 

?>
 <?php include 'db/alert.php'; ?>

</html>