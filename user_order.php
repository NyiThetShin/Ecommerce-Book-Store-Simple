<?php 
    include "ecommerce_db.php";
    session_start();
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
    <title>Order</title>
    <link rel="stylesheet" href="user_style.css">
    <style>
        .box{
            position:relative;

        }
        .delete_item{
    width: 50px;
    padding:5px 0px;
    border-radius: 50%;
    position: absolute;
    top:0.5rem;
    right:0.5rem;
    cursor:pointer;
}
    </style>
</head>
<body>
    <?php  include "user_header.php"?>

    <section>
         <h1 class="title">placed orders</h1>
         <div class="box-container">
             <?php 
             
             $select_order = mysqli_query($db,"SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed ');
             if(mysqli_num_rows($select_order) > 0){
                 while($fetch_order = mysqli_fetch_assoc($select_order)){
             ?>
             <div class="box">
                 <p>Placed On : <span><?php echo $fetch_order['placed_on'] ?></span></p>
                 <p>name : <span><?php echo $fetch_order['name'] ?></span></p>
                 <p>number : <span><?php echo $fetch_order['number'] ?></span></p>
                 <p>email : <span><?php echo $fetch_order['email'] ?></span></p>
                 <p>address : <span><?php echo $fetch_order['address'] ?></span></p>
                 <p>payment method : <span><?php echo $fetch_order['method'] ?></span></p>
                 <p>total_products : <span><?php echo $fetch_order['total_products'] ?></span></p>
                 <p>total_price : <span><?php echo $fetch_order['total_price'] ?></span></p>
                 <p>payment status : <span><?php echo $fetch_order['payment_status'] ?></span></p>
             </div>
             <?php 
                    }
             }else {
                        echo '<p>no orders placed yet !</p>';
                    }
             ?>
         </div>
    </section>










    <script src="user_javascript.js"></script>
</body>
</html>