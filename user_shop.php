<?php  
  session_start();
  include "ecommerce_db.php";
  $user_id = $_SESSION['user_id'];
  if(!isset($user_id)){
    header("location:ecommerce_login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="user_style.css">
</head>
<?php 

    if(isset($_POST['add_to_cart'])){
       
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $quantity = $_POST['quantity'];
        $select_item = mysqli_query($db,"SELECT * FROM `cart` WHERE name = '$name' AND user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_item) > 0){
            $message[] = "item is already added!";
        }else {
        mysqli_query($db,"INSERT INTO `cart` (user_id,name,price,quantity,image) VALUES ('$user_id','$name','$price','$quantity','$image') ") or die('query failed');
        $message[] = "item successfully added!";
        }
       

    }

?>
<body>
    <?php include "user_header.php" ?>

    <section class="show_product">
    <h1 class="latest_product">Latest Products</h1>
    <div class="box-container">
            <?php 
            
                $select_product = mysqli_query($db,"SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_product) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_product)){
            ?>
                <div class="box">
                    <form action="" method="post"  class="form_control">
                        <input type="hidden" name="id" value="<?php echo $fetch_product['id']?>">
                        <input type="hidden" name="name" value="<?php echo $fetch_product['name']?>">
                        <input type="hidden" name="price" value="<?php echo $fetch_product['price']?>">
                        <input type="hidden" name="image" value="<?php echo $fetch_product['image']?>">
                        <img src="<?php echo $fetch_product['image'] ?>" alt="">
                        <p class="name"><?php echo $fetch_product['name']?></p>
                        <p class="price"><?php echo $fetch_product['price']?></p>
                        <input type="number" min="1" value="1" name="quantity" class="number_input"><br>
                        <input type="submit" value="add_to_cart" name="add_to_cart" class="cart_btn">
                    </form>
                </div>
                    

            <?php

                }
            }else {
                echo "<p>Sorry,There is no any product!</p>";
            }
            
            ?>  
    </div>
   
</section>






    <script src="user_javascript.js"></script>
</body>
</html>