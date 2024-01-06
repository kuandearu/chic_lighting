<?php 
    if(isset($message)){
        foreach ($message as $mes ) {
           echo '
           <div class="message">
            <span>' . $mes .'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            '; 
        }
    }
?>

<header class="header">
    <section class="flex">
    <a href="dashboard.php" class="logo">Admin <span>Panel</span> </a>

    <nav class="navbar">
    <a href="dashboard.php">Home</a>
    <a href="products.php">Products</a>
    <a href="placed_orders.php">Orders</a>
    <a href="admin_accounts.php">Admins</a>
    <a href="user_accounts.php">Users</a>
    <a href="messages.php">Messages</a>
    </nav>
    <i ></i>
    <div class="icons">
        <div id="menu-btn" class="fa fa-reorder"></div>
        <div id="user-btn" class="fa fa-user"></div>
    </div>

<div class="profile">
    <?php 
        $select_profile = $conn->query("select * from `admins` where id = '$admin_id'");
        $fetch_profile = $select_profile->fetch_assoc();
        

    ?>
    <p><?= $fetch_profile['name'];?></p>
    <a href="update_profile.php" class="btn">Update Profile</a>
    <div class="flex-btn">
        <a href="../component/admin_login.php" class="option-btn">Login</a>
        <a href="admin_register.php" class="option-btn">Register</a>
    </div>
    <a href="../component/admin_logout.php" onclick="return confirm('Do you want to log out?');" class="delete-btn">Logout</a>

</div>

    </section>
</header>