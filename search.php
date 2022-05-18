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
    <link rel="stylesheet" href="user_style.css">
    <title>Search Page</title>
    <style>
.box-container-search{
     width: 100%;
     padding: 20px;
      display: flex;
    justify-content:center;
 }
 .search_bar{
     width:100%;
     display: flex;
     justify-content: center;
     padding: 20px;
 }
 .search_input{
    width: 300px;
    padding: 5px;
    border-radius: 5px;
    font-size:18px;
}
.search_input::placeholder{
    opacity: 0.8;
}

.submit{
     width: 100px;
    border-radius: 2px;
    padding:3px 5px;
    margin-left: 20px;
}
.box_search{
    width: 300px;
    padding:10px;
    border: 1px solid black;
    text-align: center;
    border-radius: 10px;
    box-shadow:4px 4px 4px black;
    margin-right:10px;
}
.box_search img{
    width: 80%;
    margin: 0 auto;
}
.price{
    color: red;
}
.bookname{
    color: blue;
}

    </style>
</head>
<?php 

    if(isset($_POST['add_to_cart'])){
        $item_id= $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image = $_POST['image'];
        $select_query = mysqli_query ($db,"SELECT * FROM `cart` WHERE user_id = '$user_id'AND name='$name'") or die('query failed');
        if(mysqli_num_rows($select_query) > 0){
            $message [] = "your item is already added!";
        }else {
            mysqli_query($db,"INSERT INTO `cart` (id,user_id,name,price,quantity,image) VALUES ('$item_id','$user_id','$name','$price','$quantity','$image')") or die('query failed');
            $message[] = "your item is successfully added!";
        }
    }


?>
<body>
    <?php include "user_header.php"?>
    <form action="search.php" method="post" class="search_bar">
        <input type="search" name="search" placeholder="Search products.." class="search_input">
        <input type="submit" value="Search" name="submit" class="submit">
    </form>

    <div class="box-container-search">
        <?php 
        
        if(isset($_POST['submit'])){
            $search_item = $_POST['search'];
            $select_search = mysqli_query($db,"SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
            if(mysqli_num_rows($select_search) > 0){
                while($fetch_item = mysqli_fetch_assoc($select_search)){
        ?>

                    <form action="search.php" method="post">
                        <div class="box_search">
                            <img src="<?php echo $fetch_item['image'] ?>" alt=" ">
                            <p>Book name : <span class="bookname"><?php echo $fetch_item['name'] ?></span></p>
                            <p>Price - <span class="price">$<?php echo $fetch_item['price'] ?></span></p>
                            <input type="number" name="quantity" min="1" value="1">
                            <input type="hidden" value="<?php echo $fetch_item['name'] ?>" name="name">
                            <input type="hidden" value="<?php echo $fetch_item['price'] ?>" name="price">
                            <input type="hidden" value="<?php echo $fetch_item['image'] ?>" name="image">
                            <input type="hidden" value="<?php echo $fetch_item['id'] ?>" name="id">
                            <input type="submit" value="add_to_cart" name="add_to_cart">
                        </div>
                    </form>

        <?php 
                }
            }
        }
        
        ?>
    </div>



<script src="user_javascript.js"></script>
</body>
</html>

