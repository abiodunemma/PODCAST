<?php 
include_once 'db/session.php';
include_once 'db/connect.php';


if(isset($_POST['loginBtn'])) {




    //collect from database
    $user = $_POST['username'];
    $password = $_POST['password'];





    //check if user exist in the datta base
    $sqlQuery = "SELECT * FROM users WHERE username = :username";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':username' => $user));


    while($row = $statement->fetch()){
      $id = $row['id'];
      $hashed_password = $row['password'];
      $username = $row['username'];

      if(password_verify($password, $hashed_password)){
       
        $_SESSION['username'] = $username;

  
      

        header('location: index.php');
      
      
      }else{
        $result ="<p style ='color: red;'>The pasword or the username is wrong
        </p>";
      }
      }

  }else{
  
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
  <title>login
    
  </title>
</head>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');



</style>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<body>
    <main class="container">
        <h2>Login
            
        </h2>
        <form action="" method="POST">
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