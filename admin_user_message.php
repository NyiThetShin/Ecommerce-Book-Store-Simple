<?php  

include "ecommerce_db.php";
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Message</title>

    <style>
        .box-container{
            width:100%;
            height:50vh;
            display:flex;
            justify-content:center;

        }
        .box{
            width:300px;
            padding:20px;
            border:1px solid black;
            box-shadow:2px 2px 2px black;
            margin-right:20px;
        }
        .delete{
            width:100px;
            padding:5px;
            border-radius:5px;
            text-decoration:none;
            color:black;
            border:1px solid black;
        }
        
    .box-container{
      width:100%;
      display:flex;
      flex-wrap:wrap;
      justify-content:center;
     
    }
    .box{
       margin-bottom:20px;
       padding:20px;
    }

    .logout{
      width:100px;
      padding:3px 5px;
      text-decoration:none;
      cursor:pointer;
      border:1px solid black;
     
    }
    .box-container_admin{
    width: 100%;
    display: flex;
    justify-content: space-around;
    padding:5px;
     background: linear-gradient(50deg,black,white);
     margin-bottom:10px;
     
}
.sub_one_admin{
    width: 45%;
    display: flex;
    
}
.sub_one_admin h3{
    width: 200px;
    padding:2px;
    font-size: 25px;
    color:white;
}
.sub_one_admin span{
    color: blue;
}
.sub_one_admin a {
    width: 100px;
    padding:2px;
    text-decoration: none;
    color: white;
    margin-right: 5px;

}
.sub_two_admin{
    width: 45%;
    display:flex;
    justify-content:end;
}
.sub_two_admin p {
    width:100px;
    padding:10px;
    margin-right:20px;
     border-bottom: 2px solid black;
   box-shadow: 2px 2px 2px black; 
   text-align:center;
}
.profile_info {
    width: 350px;
    border: 1px solid black;
    border-radius: 10px;
    box-shadow: 2px 2px 2px blue;
    text-align: center;
    position: absolute;
    right:1rem;
    top:5rem;
    display:none;
}
.active {
  display:block;
}
.profile_info span {
    color: red;
}
    </style>

</head>

<?php 

        if(isset($_GET['delete'])){
            $dl_id = $_GET['delete'];
            mysqli_query($db,"DELETE FROM `message` WHERE id = '$dl_id'") or die('query failed');
            header('location:admin_user_message.php');
        }

?>



<body>
    <?php  include "admin_header.php"?>
    <div class="box-container">
        <?php 
        
        $select_message = mysqli_query($db,"SELECT * FROM `message`") or die('query failed');
        if(mysqli_num_rows($select_message) > 0) {
            while($fetch_message = mysqli_fetch_assoc($select_message)){
        ?>
            <div class="box">
                <p>User Id : <?php  echo $fetch_message['user_id'] ?></p>
                <p>User Name : <?php echo  $fetch_message['name'] ?></p>
                <p>User Email : <?php  echo $fetch_message['email'] ?></p>
                <p>User Number : <?php  echo $fetch_message['number'] ?></p>
                <p>Message : <?php  echo $fetch_message['message'] ?></p>
                <a href="admin_user_message.php?delete=<?php echo $fetch_message['id']?>" class="delete" onclick="return confirm('are you sure you want to delete!')">Delete</a>
            </div>


        <?php


            }
        }else{
            echo " <p>no message here!</p>";
        }
        
        
        
        
        ?>

       
    </div>
</body>
</html>