<?php 


include "ecommerce_db.php";

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


if(isset($_POST['register'])){
  $name = mysqli_real_escape_string($db,$_POST['user_name']);
  $email = mysqli_real_escape_string($db,$_POST['user_email']);
  $password = mysqli_real_escape_string($db,$_POST['user_password']);
  $cpassword = mysqli_real_escape_string($db,$_POST['confirm_password']);
  $type =  mysqli_real_escape_string($db,$_POST['user_type']);
  

  $select_result= mysqli_query($db,"SELECT * FROM `register` WHERE email='$email' AND password='$password'") or die('query failed!');

  if(mysqli_num_rows($select_result) > 0){
    $message[] ='user already exists!';
  }else {
    mysqli_query($db," INSERT INTO register (name,password,email,user_type) VALUES ('$name','$password','$email', '$type' ) " );
    $message[] ='register successfully !';
    header("location:ecommerce_login.php");
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
          <div><button class="close_btn" onclick="this.parentElement.remove()">close</button></div>
          
    </div>
        
        
        ';
      }
    }

    ?>








 


    <div class="container">
        <div class="sub_container">
            <form action="ecommerce_register.php" method="post">
                <div class="User_name">
                    <label for="user_name">UserName:</label><br>
                    <input type="text" name="user_name" placeholder="Enter your Name" id="user_name">
                </div>
                  <div class="User_email">
                    <label for="user_email">UserEmail:</label><br>
                    <input type="email" name="user_email" placeholder="Enter your Email" id="user_email">
                </div>
                  <div class="User_password">
                    <label for="user_password">UserPassword:</label><br>
                    <input type="password" name="user_password" placeholder="Enter UserName" id="user_password">
                </div>
                  <div class="Confirm_password">
                    <label for="confirm_password">Confirm Password:</label><br>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password">
                </div>
                  <div class="User_type">
                    <label for="user_type">UserType:</label>
                   <select name="user_type" id="User_type">
                     <option value="user">User</option>
                     <option value="admin">Admin</option>
                   </select>
                </div>
                <div class="register_ctn">
                  <button type="submit" name="register">Register</button><span> already account?<a href="ecommerce_login.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>


</body>
</html>