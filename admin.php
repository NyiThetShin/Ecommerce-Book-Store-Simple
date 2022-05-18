<?php 

include "ecommerce_db.php" ;
session_start();
if(!isset($_SESSION['admin_name'])){
    header("location:ecommerce_login.php");
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
    <!-- Custom Css -->
    <!-- <link rel="stylesheet" href="ecommerce_style.css"> -->


    <!-- Fontawesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Admin Page </title>
    <style>

    span{
        color:blue;
        font-size:20px;
        font-weight:500;
    }
   
  
    .profile{
        cursor: pointer;
    }
    .user_info{
        position: absolute;
        top:10%;
        right:20px;
        border:1px solid black;
        padding:3px 5px;
        box-shadow:0 2px 2px  black;
        display:none;
        transition:all 0.5s ease;
        z-index:99;
        background-color:wheat;
    }
     .active {
        display:block;
    }
    section > h1{
      width:100%;
      display:flex;
      justify-content:center;
    }
    .box{
      width:300px;
      padding:5px;
      border:1px solid black;
      border-radius:5px;
      box-shadow:0 2px 2px black;
      margin-left:50px;
      text-align:center;
    }
    .total_btn{
      width:200px;
      padding:2px 5px;
      border-radius:5px;
      border:1px solid black;
      position:relative;
      left:50%;
      transform:translateX(-50%);
      color:purple;
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



  <body>

    <?php  include "admin_header.php"?>

<!-- User Info -->

 
   
<section>
  <h1>Dashboard</h1>
  <div class="box-container">
    <div class="box">
      <?php 
      $total_pending = 0;
      $select_result = mysqli_query($db,"SELECT total_price FROM orders WHERE payment_status = 'pending'") or die('query failed');
      if(mysqli_num_rows($select_result) > 0) {
        while($fetch_item = mysqli_fetch_assoc($select_result)) {
          $total_price = $fetch_item['total_price'];
          $total_pending += $total_price;
        }

      }
      
      
      ?>
      <h1><?php echo $total_pending?>/-</h1>
      <div class="total_btn">total pendings</div>
    </div>

    <div class="box">
        <?php 
        $total_completed = 0;
        $select_payment = mysqli_query($db,"SELECT total_price FROM orders WHERE payment_status='completed'") or die('query_two failed');
        if(mysqli_num_rows($select_payment) > 0){
          while($fetch_payment = mysqli_fetch_assoc($select_payment)){
            $total_price = $fetch_payment['total_price'];
            $total_completed += $total_price;
          }
        }


      ?>
      <h1><?php echo $total_completed ?></h1>
      <div class="total_btn">completed payments</div>
    </div>

    <div class="box">
        <?php 
        $total_placed = 0;
        $select_placed = mysqli_query($db,"SELECT * FROM orders ") or die('query_two failed');
        $num_row_placed = mysqli_num_rows($select_placed);
        $total_placed += $num_row_placed;


      ?>
      <h1><?php echo $total_placed ?></h1>
      <div class="total_btn">order placed</div>
    </div>
   

        <div class="box">
        <?php 
        $total_product = 0;
        $select_product= mysqli_query($db,"SELECT * FROM products ") or die('query_two failed');
        $num_row_product = mysqli_num_rows($select_product);
        $total_product += $num_row_product;


      ?>
      <h1><?php echo $total_placed ?></h1>
      <div class="total_btn">products added</div>
    </div>



    <div class="box">
        <?php 
        $total_user = 0;
        $select_user = mysqli_query($db,"SELECT * FROM register WHERE user_type='user' ") or die('query_two failed');
        $num_row_user = mysqli_num_rows($select_user);
        $total_user += $num_row_user;


      ?>
      <h1><?php echo $total_user ?></h1>
      <div class="total_btn">normal users</div>
    </div>

    <div class="box">
        <?php 
        $total_admin = 0;
        $select_admin = mysqli_query($db,"SELECT * FROM register WHERE user_type='admin' ") or die('query_two failed');
        $num_row_admin = mysqli_num_rows($select_admin);
        $total_admin += $num_row_admin;


      ?>
      <h1><?php echo $total_admin ?></h1>
      <div class="total_btn">admin users</div>
    </div>
    <div class="box">
        <?php 
        $total_account = 0;
        $select_account = mysqli_query($db,"SELECT * FROM register  ") or die('query_two failed');
        $num_row_account = mysqli_num_rows($select_account);
        $total_account += $num_row_account;


      ?>
      <h1><?php echo $total_account ?></h1>
      <div class="total_btn">total account</div>
    </div>
    <div class="box">
        <?php 
        $total_message = 0;
        $select_message = mysqli_query($db,"SELECT * FROM `message`  ") or die('query_two failed');
        $num_row_message = mysqli_num_rows($select_message);
        $total_message += $num_row_message;


      ?>
      <h1><?php echo $total_message ?></h1>
      <div class="total_btn">total message</div>
    </div>
  </div>
</section>






  
  
  
   
  </body>

  </html>