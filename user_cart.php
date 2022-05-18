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
    <title>Cart</title>
    <link rel="stylesheet" href="user_style.css">
    <style>
        .box{
    position: relative;
}
.close{
    width: 50px;
    padding:10px 0;
    border-radius: 50%;
    cursor: pointer;
    position: absolute;
    top:0.5rem;
    right:0.3rem;
    color:red;
}
img{
    width:200px;
    height:250px;
}
.styling_total{
    color:red;
}
.sub_total{
    padding:5px;
    border:1px solid black;
    margin-top:5px;
    background: linear-gradient(45deg,black,white);
}
.all_delete{
    width: 100%;
    display: flex;
    justify-content: center;
    padding:5px;
}
.del_al{
    width:150px;
    padding:5px;
    border-radius: 10px;
    background-color: rgb(135, 91, 20);
    text-align: center;
    color:white;
}
.total_amount{
    width: 100%;
    text-align: center;
    padding:10px;
    border: 1px solid black;
    border-radius: 5px;
}
.g_t{
    color: red;
}
.c_s  {
    background-color: rgb(53, 53, 75);
    padding:5px 10px;
    border-radius: 5px;
    
}
.c_s a {
    color:white;
}
.checkout{
     background-color: red;
    padding:5px 10px;
    border-radius: 5px;
}

    </style>
</head>
<?php 

    if(isset($_POST['update'])){
        $quantity = $_POST['quantity'];
        $update_id = $_POST['id'];
        mysqli_query($db,"UPDATE `cart` SET quantity = '$quantity' WHERE id = '$update_id' ") or die('query failed');
        $message[] = 'cart quantity updated!';
    }
    if(isset($_GET['delete'])){
        $del_id = $_GET['delete'];
        mysqli_query($db,"DELETE FROM `cart` WHERE id='$del_id'");
    }
     if(isset($_GET['delete_all'])){
            mysqli_query($db,"DELETE FROM `cart` WHERE user_id='$user_id'");
            header('locatin:user_cart.php');
        }

?>
<body>
    <?php include "user_header.php" ?>
    <section class="show_product">
    <h1 class="latest_product">Latest Products</h1>
    <div class="box-container">
            <?php 
                $grand_total = 0;
                $select_cart = mysqli_query($db,"SELECT * FROM `cart`") or die('query failed');
                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>
                <div class="box">
                    <button class="close"><a href="user_cart.php?delete=<?php echo $fetch_cart['id']?> " onclick="return confirm('are you sure you want to delete')">X</a></button>
                    <img src="<?php echo$fetch_cart['image']?>" alt="" >
                    <div class="name"><?php echo $fetch_cart['name']?></div>
                    <div class="price"><?php echo $fetch_cart['price']?></div>
                    <form action="user_cart.php" method="post">
                        <input type="hidden" value="<?php echo $fetch_cart['id']?>" name="id">
                        <input type="number" min="1" name="quantity" value="<?php echo $fetch_cart['quantity']?>">
                        <input type="submit" value="Update" name="update">
                    </form>
                    <div class="sub_total">Total Price : <span class="styling_total"> <?php echo $sub_total=  $fetch_cart['quantity'] * $fetch_cart['price'] ?> </span></div>
                   
                </div>
                    

            <?php
                 $grand_total += $sub_total;
                }
            }else {
                echo "<p>Sorry,There is no any product!</p>";
            }
            
            ?>  
    </div>

    <div class="all_delete">
            <a href="user_cart.php?delete_all" class="del_al <?php echo ($grand_total > 1)? '' : 'disabled' ;?>" onclick="return confirm('Do you want to delte all item?')" >Delete All</a>
    </div>
    <div class="total_amount">
        <p>Grand Total : <span class="g_t"> <?php echo $grand_total?> </span> </p>
        <button class="c_s"><a href="user_shop.php">Continue Shopping</a></button>
        <button class="checkout"><a href="checkout.php" style="color:white">CheckOut</a></button>
    </div>
   
</section>


<script src="user_javascript.js"></script>
</body>
</html>