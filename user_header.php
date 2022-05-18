    <?php 

    if(isset($message)){
        foreach($message as $message){
            echo '
        <div class="alert">
            <div class="message">'.$message.'</div>
            <button class="close_btn">Close</button>
        </div>
            ';
        }
    }


?>
    
    <section class="header_info">
        <nav class="header_1">
            <div class="sub_one">
                <p>Facebook</p>
                <p>Twitter</p>
                <p>Instagram</p>
                <p>LinkedIn</p>
            </div>
            <div class="sub_two">
                
                <a href="ecommerce_login.php"> New Login</a>
                <a href="ecommerce_register.php">Register</a>
            </div>
        </nav>
       
    </section>
    <section class="menu_bar">
        <nav class="header_2">
            <div class="logo">
                <h1>Book Store</h1>
            </div>
            <div class="menu_item">
                <a href="user_home.php">Home</a>
                <a href="user_about.php">About</a>
                <a href="user_shop.php">Shop</a>
                <a href="user_contact.php">Contact</a>
                <a href="user_order.php">Orders</a>
            </div>
            <div class="profile">
                <?php 
                
                $select_qua = mysqli_query ($db,"SELECT * FROM `cart`  WHERE user_id= '$user_id'") or die('query failed');

                $number_quantity = mysqli_num_rows($select_qua);
                
                
                ?>
                <a href="search.php"><input type="search" placeholder="Search item.."></a>
                <p class="user_profile">Profile</p>
                <p class="cart"><a href="user_cart.php">Cart</a> (<span><?php echo $number_quantity?></span>)</p>
            </div>
        </nav>
    </section>
    <div class="user_info">
        <p>UserName:<span><?php echo $_SESSION['user_name']?></span></p>
        <p>Email :<span><?php echo $_SESSION['user_email']?></span></p>
        <a href="admin_logout.php" style="border:1px solid black;padding:2px;margin:5px;">Logout</a>
    </div>
