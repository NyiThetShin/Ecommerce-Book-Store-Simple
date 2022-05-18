<?php  

include "ecommerce_db.php";
session_start();
if(!isset($_SESSION['admin_id'])){
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
    <!-- Custom css -->
   
    <title>Product</title>

    <style>
        body{
            width:100%;
            height:100vh;
        }
            .add_product_ctn{
                width:100%;
                height:50vh;
                display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:center;
               
            }
            .admin_product_form{
                width:500px;
                border:1px solid black;
                text-align:center;
                padding:20px;
                box-shadow:2px 2px 2px black;
            }
            input{
                width:200px;
                margin-bottom:20px;
                border-radius:10px;
                padding:3px;
            }
            button{
                width:200px;
                padding:5px;
                border-radius:5px;

            }
            button:hover{
                background-color:gray;
                color:white;
            }
            a{
                text-decoration:none;
                border:1px solid black;
                padding:5px;
                border-radius:5px;
                
            }
            .sub_product_ctn{
                width:300px;
                 text-align:center;
                padding:5px;
                border:1px solid black;
                margin-top:20px;
                margin-right:30px;
            }
            .sub_product_ctn img{

                width:200px;
                height:250px;
                
            }
            .show_product{
                width:100%;
                margin-bottom:100px;
                display:flex;
                justify-content:center;
                flex-wrap:wrap;
            }
            
            .price{
                color:red;
            }
            .update_item{
                width:100%;
                min-height:100vh;
                background:gray;
                position:absolute;
                top:0;
                left:0;
                right:0;
               display:none;
            }
            
            .pop_up{
                width:100%;
                height:100vh;
                display:flex;
                flex-direction:column;
                justify-content:center;
                align-items:center;
                background-color:rgba(0,0,0,0.7);
                position:fixed;
                top:0;
                left:0;
                right:0;
              
                z-index:1500;
            }
            .last_form{
                width:400px;
                
                display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:center;
                aligin-items:center;
                border:1px solid black;
                background:white;
                padding:50px;
                border-radius:10px;
            }
            .last_form img {
                width:200px;
                height:200px;
                margin:20px;
            }
            .update{
                display:inline-block;
            }
            .cancel{
                display:inline-block;
                margin-left:20px;
                 margin-top:10px;

            }
            .update:hover,.cancel:hover{
                background:black;
                color:white;
               
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
        if(isset($_POST['add_product'])){

                $name = mysqli_real_escape_string($db, $_POST['name']);
                $price = $_POST['price'];
                $image = $_FILES['image']['name'];
                $image_size = $_FILES['image']['size'];
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_folder = 'uploaded_image/'.$image;

                $select_product_name = mysqli_query($db, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

                if(mysqli_num_rows($select_product_name) > 0){
                    $message[] = 'product name already added';
                }else{
                    $add_product_query = mysqli_query($db, "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

                    if($add_product_query){
                        if($image_size > 2000000){
                            $message[] = 'image size is too large';
                        }else{
                            move_uploaded_file($image_tmp_name, $image_folder);
                            $message[] = 'product added successfully!';
                        }
                    }else{
                        $message[] = 'product could not be added!';
                    }
                }
}
            ?>
  <body>
<?php  include "admin_header.php"?>

<section class="add_product_ctn">

   <h1 class="title">shop products</h1>

   <form action="admin_product.php" method="post" enctype="multipart/form-data" class="admin_product_form">
       <h1>Add Product</h1>
       <input type="text" name="name" placeholder="Product Name">
       <input type="number" name="price" placeholder="Product Price">
       <input type="file" name="image" placeholder="Product Image">
       <input type="submit" name="add_product" value="Add Product">
   </form>

</section>
<?php 
// Delete Action
if(isset($_GET['delete'])){
    $del_product_id = $_GET['delete'];
    $select_image = mysqli_query($db,"SELECT image FROM `products` WHERE id = '$del_product_id'");
    $fetch_image = mysqli_fetch_assoc($select_image);
    unlink('uploaded_image/'.$fetch_image['image']);
    $del_query = mysqli_query($db,"DELETE FROM `products` WHERE id = '$del_product_id'");
    // header('location:admin_product.php');
}
?>
<section class="show_product">
    <?php 
    
    $select_product = mysqli_query($db,"SELECT * FROM `products` ") or die('query_failed');
    
     
    if(mysqli_num_rows($select_product) > 0) {
        
         while( $fetch_product = mysqli_fetch_assoc($select_product)){
    ?>

     <div class="sub_product_ctn">
       

         
        <img src="uploaded_image/<?php  echo$fetch_product['image']?>" alt="" name="old_image">
        <p><?php echo $fetch_product['name']?></p>
        <p class="price">$<?php echo $fetch_product['price']?></p>
        <a href="admin_product.php?update=<?php echo $fetch_product['id'];?>" class="update">Update</a>
         <a href="admin_product.php?delete=<?php echo $fetch_product['id'];?>" class="delete">Delete</a>
   </div>


    <?php 
             }
    }
    ?>
    


</section>


    <?php 
    
            // if(isset($_POST['update_product'])){
            //     $update_p_id = $_POST['update_p_id'];
            //     $update_name = $_POST['name'];
            //     $update_price = $_POST['price'];

                
            //  mysqli_query($db, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');


            //     $update_image = $_FILES['image']['name'];
            //     $update_image_size = $_FILES['image']['size'];
            //     $update_image_tmpname = $_FILES['image']['tmp_name'];
            //     $update_folder = 'uploaded_image/'.$update_image;
            //     $update_old_image = $_POST['update_old_image'];
            //     if(!empty($update_image)){
            //       if($update_image_size > 2000000){
            //           $message[] = "image is too large";
            //       }else{
            //           mysqli_query($db,"UPDATE `products` SET image='$update_image' WHERE id = '$update_p_id'") or die('query failed');
            //           move_uploaded_file($update_image_tmpname,$update_folder);
            //         //   unlink('uploaded_image/'.$update_old_image);
            //       }
            //     }
            //     // header("location:admin_product.php");
            // }
    ?>



  <!-- <section class="update_item">

    <?php 

    if(isset($_GET['update'])){
        $update_id = $_GET['update'];
        $select_update = mysqli_query($db,"SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
        if(mysqli_num_rows($select_product) > 0){
             while($fetch_update = mysqli_fetch_assoc($select_update)){

     ?>
        <form action="admin_product.php" method="post" enctype="multipart/form-data" class="last_form">

         <input type="hidden" value="<?php echo $fetch_product['id'] ?>" name="update_p_id" >
         <input type="hidden" value="<?php echo $fetch_product['image'] ?>" name="update_old_image">


        <img src="<?php echo $fetch_update['image'] ?>" alt="">
        <input type="text" name="name" value="<?php echo $fetch_update['name']?>">
        <input type="number" name="price" value="<?php echo $fetch_update['price']?>">
        <input type="file" name="image" accept="image/jpg,image/jpeg,image/png">
        <input type="submit" name="update_product" value="update Product">      
        <input type="reset" name="close_btn" value="Cancel" id="cancel_btn">
        </form>    
     <?php

               }
          }
    }else {

    }

    ?>

  </section> -->
 



<?php 

    if(isset($_POST['last_up'])){
        $last_id = $_POST['ned_id'];
        $last_name = $_POST['name'];
        $last_price = $_POST['price'];
        mysqli_query($db, "UPDATE `products` SET name = '$last_name', price = '$last_price' WHERE id = '$last_id'") or die('query failed');

        $last_image = $_FILES['image']['name'];
        $last_image_size = $_FILES['image']['size'];
        $last_image_tmp_name = $_FILES['image']['tmp_name'];
        $last_folder = 'uploaded_image/'.$last_image;
        $old_image = $_POST['old_image'];
        if(!empty($last_image)){
            if($last_image_size > 2000000) {
                $message[] = "image is too large";
            }else{
                 $last_query  = mysqli_query($db,"UPDATE `products` SET image='$last_image' WHERE id = '$last_id'") or die('query failed');
               move_uploaded_file($last_image_tmp_name , $last_folder)  ;
               unlink('uploaded_image/'.$old_image);
               
            }
        }
           
       header('location:admin_product.php');
    }
?>
  <?php 
  
    if(isset($_GET['update'])){
        $ned_pd_id = $_GET['update'];
        $select_query = mysqli_query($db,"SELECT * FROM `products` WHERE id = '$ned_pd_id'");
        if(mysqli_num_rows($select_query) > 0) {
            while( $fetch_ned_pd = mysqli_fetch_assoc($select_query)){
                ?>

    <section class="pop_up">
            <form action="admin_product.php" method="post" enctype="multipart/form-data" class="last_form">
                <input type="hidden" value="<?php echo $fetch_ned_pd['id']?>" name="ned_id">
                <input type="hidden" value="<?php echo $fetch_ned_pd['image']?>" name="old_image">

                <img src="uploaded_image/<?php echo  $fetch_ned_pd['image']?>" alt="">
                <input type="text" value="<?php  echo$fetch_ned_pd['name']?>" name="name">
                <input type="number" value="<?php  echo$fetch_ned_pd['price']?>" name="price">
                <input type="file" name="image" accept="image/jpg,image/jpeg,image/png" >
               
                <input type="submit" name='last_up' class="update" value="Update">
                <input type="reset" name="cancel" class="cancel" value="Cancel">
         


            </form>
  </section>


                <?php
            }
        }
    }else{
        echo '<script>document.queryselector(".pop_up").style.display= "none";</script>';
    }
  
  ?>
  
  
    <script>

        let update_btn = document.querySelector('.update');
        let popUp = document.querySelector('.pop_up');
        update_btn.addEventListener('click',() => {
            popUp.style.display = "block";
        })
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>