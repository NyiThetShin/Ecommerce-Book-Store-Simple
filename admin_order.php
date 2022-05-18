<?php 


include "ecommerce_db.php";
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:ecommerce_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <style>
        .box-container{
            width:100%;
            height:50vh;
            display:flex;
            justify-content:center;
           
            padding:20px;
        }
        .box{
            width:300px;
            padding:10px;
            border-radius:10px;
            box-shadow:2px 2px 2px black;
            margin-right:20px;
            border:1px solid black;
        }
        .update{
            width:100px;
            padding:5px;
            border-radius:5px;
            margin-top:5px;

        }
        .delete{
            width:100px;
            text-decoration:none;
            border:1px solid black;
            padding:5px;
            margin-top:5px;
            border-radius:5px;
            color:black;
        }
        .update:hover,.delete:hover{
            background-color:black;
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
        
        if(isset($_POST['update_btn'])){
            $hden_id = $_POST['hden_id'];
            $status = $_POST['status'];
            $upd_query = mysqli_query($db,"UPDATE  `orders` SET payment_status= '$status' WHERE id = '$hden_id'") or die('query failed');
            $message[] = "updated successfully!";
        }
        
        if(isset($_GET['delete'])){
            $del_id = $_GET['delete'];
             mysqli_query ($db,"DELETE FROM  `orders` WHERE id = '$del_id'") or die('query failed');
             header('location:admin_order.php');
        }
        
        
        ?>

<body>
    <?php  include "admin_header.php"?>
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
    <div class="box-container">

              <?php 
    
     $select_order = mysqli_query($db,"SELECT * FROM `orders`") or die('query failed');
     if (mysqli_num_rows($select_order) > 0) {
         while($fetch_order = mysqli_fetch_assoc($select_order)) {

    ?>

            <div class="box">
                <p>User Id : <?php echo $fetch_order['user_id'] ?> </p>
                <p>User Name : <?php echo $fetch_order['name'] ?> </p>
                <p>User Number : <?php echo $fetch_order['number'] ?> </p>
                <p>User Email : <?php echo $fetch_order['email'] ?> </p>
                 <p>User Address : <?php echo $fetch_order['address'] ?> </p>
                  <p>Total Products : <?php echo $fetch_order['total_products'] ?> </p>
                   <p>Total Price : <?php echo $fetch_order['total_price'] ?> </p>
                    <p>Method : <?php echo $fetch_order['method'] ?> </p>
                    <form action="admin_order.php" method="post" >
                        <input type="hidden" value="<?php echo $fetch_order['id']?>" name="hden_id">
                             <select name="status" id="status" >
                                 <option value="" selected disabled><?php echo $fetch_order['payment_status']?></option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select><br>
                            <input type="submit" value="Update" name="update_btn" class="update">
                            <a href="admin_order.php?delete=<?php  echo $fetch_order['id']?>"  class="delete"onclick="return confirm('are you sure you want to delete!')">Delete</a>
                    </form>
            </div>




    <?php 
    
         }
     }else{
             echo "<p>no ordered yet!</p>";
         }
    
    
    ?>
    </div>
  

   
    
</body>
</html>