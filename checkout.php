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
    <title>Checkout</title>
    <link rel="stylesheet" href="user_style.css">
    <style>

    </style>
</head>
<?php 

    if(isset($_POST['final_check'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $number = $_POST['number'];
        $method = $_POST['method'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $placed_on = date('d-M-Y');
        $cart_total= 0;
        $cart_products[] = '';
        $select_query = mysqli_query($db,"SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_query) > 0){
            while($fetch_query = mysqli_fetch_assoc($select_query)){
                $cart_products[] = $fetch_query['name'];
                $sub_total = ($fetch_query['price'] * $fetch_query['quantity']);
                $cart_total += $sub_total;
            }
        }
        $total_products = implode(',',$cart_products); // a little confused this line that it --> implode method 
        $order_query = mysqli_query($db,"SELECT * FROM `orders` WHERE user_id = '$user_id' AND name='name' AND number = '$number' AND email = '$email' AND method ='$method' AND address = '$address' AND total_products= '$total_products' AND total_price ='$cart_total' AND placed_on = '$placed_on'  ") or die('query failed');
        if($cart_total == 0){
            $message[] = 'there haven\'t any item ';
        }else{
            if(mysqli_num_rows($order_query) > 0){
                $message[] = 'your order is already have!';
            }else{
                mysqli_query($db,"INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES ('$user_id' , '$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on')") or die('query failed');
                $message[] = "your order information is successfully !";
                mysqli_query($db,"DELETE FROM `cart` WHERE user_id = '$user_id'");
            }
        }
    }
?>
<body>
    <?php  include "user_header.php"?>
    <div class="checkout_bg">
        <h1>Checkout Product</h1>
    </div>
    <section>
        <div class="box-container">
            <?php 
                $grand_total = 0;
                $select_cart = mysqli_query($db,"SELECT * FROM  `cart` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_cart) > 0){
                   while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                       $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                       $grand_total += $total_price;
            ?>
            <div class="box">
                <p><?php echo $fetch_cart['name']?> <span class="price_qu">($<?php echo $fetch_cart['price']?> x <?php echo $fetch_cart['quantity']?>)</span></p>
            </div>
                    
            <?php
                   }
                }else{
                    echo "<p>your cart is empty</p>";
                }
                
            ?>
            

        </div>
        <div class="total"><div id="total">Grand Total : <span class="final_total">$<?php echo $grand_total ?></span></div></div>
    </section>
   
    <section class="checkout_main">
        <h1>PLACE YOUR ORDER</h1>
        <form action="checkout.php" method="post" class="formControl">

        <div class="input_main_ctn">
            <div class="input_sub_one">
               <span>your name:</span> <br>
                <input type="text" name="name" placeholder="Enter your name" required><br>
                  <span>your email:</span><br>
                <input type="email" name="email" placeholder="Enter your email" required><br>
                
                  <span>your city:</span><br>
                <input type="text" name="city" placeholder="Enter your city" required><br>
            </div>
            <div class="input_sub_two">
                <span>your number:</span><br>
                <input type="number" name="number" placeholder="Enter your number" required><br>
                <span>Payment method:</span><br>
                <select name="method" class="optional" >
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paypal">paypal</option>
                    <option value="visa">visa</option>
                </select><br>
                <span>your address:</span><br>
                <input type="text" name="address" placeholder="e.g. street name"  required><br>
                <span>your country:</span><br>
                <input type="text" name="country" placeholder="e.g. myanmar"  required><br>
            </div>
           
        </div>
                 <input type="submit" value="Checkout" name="final_check" id="final_check">
        </form>
      
    </section>



    <script src="user_javascript.js"></script>
</body>
</html>