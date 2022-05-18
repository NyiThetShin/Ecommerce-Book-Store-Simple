<section>
    <div class="box-container_admin">
        <div class="sub_one_admin">
            <h3><a href="admin.php">Admin <span>Page</span></a></h3>
            <a href="admin.php">Home</a>
            <a href="admin_product.php">Products</a>
            <a href="admin_order.php">Orders</a>
            <a href="admin_user.php">User</a>
            <a href="admin_user_message.php">Message</a>
        </div>
        <div class="sub_two_admin">
            <p class="profile">Profile</p>
        </div>
    </div>
    <div class="profile_info">
        <p>Admin Name : <span><?php echo $_SESSION['admin_name'] ?></span></p>
        <p>Admin Email : <span><?php echo $_SESSION['admin_email'] ?></span></p>
    </div>
</section>
