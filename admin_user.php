<?php 

include "ecommerce_db.php";
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location:ecommerce_login.php");
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <style>
        .box-container{
            width:100%;
            height:30vh;
            display:flex;
            justify-content:center;
            
        }
        .box{
            width:300px;
            padding:10px;
            border:1px solid black;
            box-shadow:2px 2px 2px black;
            margin-right:10px;
        }
        .delete{
            width:100px;
            padding:5px;
            border:1px solid black;
            color:black;
            border-radius:5px;
            text-decoration:none;
        }
        .delete:hover{
            background:black;
            color:white;
            
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
            $del_user = $_GET['delete'];
            mysqli_query($db,"DELETE FROM `register` WHERE id ='$del_user'") or die('query failed');
            header("location:admin_user.php");
        }


?>
<body>
        <?php  include "admin_header.php"?>
<div class="box-container">
     <?php 
    
    $select_user = mysqli_query($db,"SELECT * FROM `register`") or die('query failed');
    if(mysqli_num_rows($select_user) > 0){
        while($fetch_user = mysqli_fetch_assoc($select_user)){

    ?>

            <div class="box">
                 <h3>User Id: <?php echo $fetch_user['id']?></h3>
                <h3>User Name: <?php echo $fetch_user['name']?></h3>
                 <h3>User Email: <?php echo $fetch_user['email']?></h3>
                  <h3>User Type: <span style="color:<?php if($fetch_user['user_type'] == "admin"){echo 'red';}?>"><?php echo $fetch_user['user_type'] ?></span></h3>
                  <a href="admin_user.php?delete=<?php echo $fetch_user['id'] ?>" class="delete" onclick="return confirm('are you sure you want to delete this user!')">Delete</a>
            </div>



    <?php 


        }
    }else{
        echo "<p>no user!</p>";
    }
    
    
    
    ?>
    
</div>
   



</body>
</html>