<?php 


include "ecommerce_db.php";
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>
    <link rel="stylesheet" href="ecommerce_style.css">
</head>



<?php 


if(isset($_POST['login'])){

  $email = mysqli_real_escape_string($db,$_POST['user_email']);
  $password = mysqli_real_escape_string($db,$_POST['user_password']);

  

  $select_result= mysqli_query($db,"SELECT * FROM `register` WHERE email='$email' AND password='$password'") or die('query failed!');
  if(mysqli_num_rows($select_result) > 0) {
     $item = mysqli_fetch_assoc($select_result);

      if($item['user_type'] == 'user') {
          $_SESSION['user_email'] = $item['email'];
          $_SESSION['user_name'] = $item['name'];
          $_SESSION['user_id'] = $item['id'];
          header("location:user_home.php");
      }else if($item['user_type'] == 'admin'){
           $_SESSION['admin_email'] = $item['email'];
          $_SESSION['admin_name'] = $item['name'];
          $_SESSION['admin_id'] = $item['id'];
          header("location:admin.php");
      }
  }else {
    $message[] = "incorrect email or password!";
  }
 
  



}


?>












<body>



   

      <?php 

    if(isset($message)){
      foreach($message as $message){
        echo '
        
          <div class="alert_message">

          <div class="alert">
            '.$message.'
            
          </div>
          
            <button class="close_btn" onclick="this.parentElement.remove()">close</button>
    </div>
        
        
        ';
      }
    }

    ?>








 


    <div class="container">
        <div class="sub_container">
            <form action="ecommerce_login.php" method="post">
              
                  <div class="User_email">
                    <label for="user_email">UserEmail:</label><br>
                    <input type="email" name="user_email" placeholder="Enter your Email" id="user_email">
                </div>
                  <div class="User_password">
                    <label for="user_password">UserPassword:</label><br>
                    <input type="password" name="user_password" placeholder="Enter UserName" id="user_password">
                </div>
               
             
                <div class="register_ctn">
                  <button type="submit" name="login">Login</button><span> have you not been account?<a href="ecommerce_register.php">Register</a></span>
                </div>
            </form>
        </div>
    </div>


</body>
</html>