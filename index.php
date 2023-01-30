 <?php 
include_once 'db/session.php';
include_once 'db/connect.php';
include_once 'db/function.php';

if(isset($_POST['loginBtn'])) {

    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = filter_var ($password, FILTER_SANITIZE_STRING);

    $verify_username = $conn->prepare("SELECT * FROM `users` WHERE username = ?
    LIMIT 1");
        $verify_username->execute([$username]);

        if($verify_username->rowCount() > 0){
            $fetch = $verify_username->fetch(PDO::FETCH_ASSOC);
            $verify_password = password_verify($password, $fetch['password']);
            if($verify_password == 1){
               setcookie('user_id', $fetch['id'], time() + 60*60*24*30, '/');
               header('location: profile.php');
               $success_msg [] = 'welcome back';
            }else{
                $warning_msg[] = 'Incorect password';
            }

        }else {
            $warning_msg [] = 'Incorect email!';
        }


  
  }



   
 
    
 

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" ></script>
    
    <link rel="stylesheet" href="css/index.css">
<head>
    <meta charset="utf-8">
  <title>login</title>
</head>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');



</style>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<body>
    <main class="container">
        <h2>Login</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <input type="text" name="username" value=""
                    placeholder="Enter Your Username" required>
                <div class="underline"></div>
            </div>
            <div class="input-field">
                <input type="password" name="password"  value=""
                    placeholder="Enter Your Password" required>
                <div class="underline"></div>
            </div>

            
            <input type="submit"  name="loginBtn" value="Signin">

        </form>

        <div class="footer">
            <span>Or Connect With Social Media</span>
            <div class="social-fields">
                <div class="social-field twitter">
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                        Sign in with Twitter
                    </a>
                </div>
                <div class="social-field facebook">
                    <a href="signup.php">
                        <i class="fab fa-facebook-f"></i>
                        Sign up
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
<?php  include_once 'db/alert.php';?>
</html>

