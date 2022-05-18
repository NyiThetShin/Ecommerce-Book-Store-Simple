<?php 

session_start();
include "ecommerce_db.php" ;
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:ecommerce_login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="user_style.css">
    <style>
        .message_form{
    width: 500px;
    padding:7px;
    
}
.message_form {
    text-align:center;
    position:relative;
    width:500px;
    border:1px solid black;
    margin:0 auto;
    margin-top:20px;
    border-radius:10px;
    box-shadow:2px 2px 2px black;
}
.message_form h1{
    width: 100%;
    text-align: center;
    font-size: 25px;
}
.message_name,.message_email,.message_number{
    width: 80%;
    padding:4px;
    border-radius: 5px;
    margin-bottom:10px;
}
.message_form textarea {
    width:80%;
    padding:5px;
    border-radius:5px;
}
.message_sent{
    display: block;
    width: 100px;
    padding:4px;
    border-radius: 5px;
    text-align: center;
    position: absolute;
    left:50%;
    transform:translateX(-50%)
}
    </style>
</head>
<?php 
$fillInfo ="";
 if(isset($_POST['send'])){

     $name = $_POST['name'];
     $email = $_POST['email'];
     $number = $_POST['number'];
     $msg= $_POST['message'];
     if($name === "" AND $email === "" AND $number === "" AND $msg ===""){
        
         header('location:user_contact.php');
     }else{
          $select_data = mysqli_query ($db,"SELECT * FROM `message` WHERE name='$name' AND email = '$email' AND message= '$msg'") or die('query failed');
            if(mysqli_num_rows($select_data) > 0 ){
                $message[] = "your message already send!";
            }else {
                $insert_data = mysqli_query ($db,"INSERT INTO `message` (user_id,name,email,number,message) VALUES ('$user_id','$name','$email','$number','$msg')") or die('query failed');
                $message[] = "your message is successfully sent!";
            }
     }
   
 }

?>
<body>
    <?php include "user_header.php" ?>
  
    <form action="user_contact.php" method="post" class="message_form" >
        <h1>Say Something!</h1>
        <input type="text" name="name" placeholder = "Enter your name" class="message_name">
         <input type="email" name="email" placeholder = "Enter your email" class="message_email">
          <input type="number" name="number" placeholder = "Enter your number" class="message_number"> 
           <textarea name="message" placeholder = "Enter your message"></textarea>
        <input type="submit" name="send" value="Send Message" class="message_sent">
    </form>


<script src="user_javascript.js">
   
</script>
</body>
</html>