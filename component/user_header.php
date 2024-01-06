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
    <a href="home.php" class="logo"><span>C</span>hic Lighting & Design</a>

    <nav class="navbar">
    <a href="./home.php">Home</a>
    <a href="./shop.php">Shop</a>
    <a href="./orders.php">Orders</a>
    <a href="./about.php">About</a>
    <a href="./contact.php">Contact</a>
    
    
    </nav>
    <i ></i>
    <div class="icons">
        <?php
            $count_wishlist_items = $conn->query("SELECT * FROM `wishlist` WHERE user_id = '$user_id'");
            $total_wishlist_items = $count_wishlist_items->num_rows;

            $count_cart_items = $conn->query("SELECT * FROM `cart` WHERE user_id = '$user_id'");
            $total_cart_items = $count_cart_items->num_rows;
        ?>
        <div id="menu-btn" class="fa fa-reorder"></div>
        <a href="./search_page.php"><i class="fas fa-search"></i></a>
        <a href="./wishlist.php"><i class="fas fa-heart"><span>(<?= $total_wishlist_items; ?>)</span></i></a>
        <a href="./cart.php"><i class="fas fa-shopping-cart"><span>(<?= $total_cart_items; ?>)</span></i></a>
        <div id="user-btn" class="fa fa-user"></div>
    </div>

<div class="profile">
    <?php 
        $select_profile = $conn->query("select * from `users` where id = '$user_id'");
        $check = $select_profile->num_rows;
        if($check > 0 ){
            $fetch_profile = $select_profile->fetch_assoc();
    ?>
    <p><?= $fetch_profile['name'];?></p>
    <a href="./update_user.php" class="btn">Update Profile</a>
    <a href="../component/user_logout.php" onclick="return confirm('Do you want to log out?');" class="delete-btn">Logout</a>
        <?php
        }else{
        ?>
        <p>please login first!</p>
        <div class="flex-btn">
        <a href="./user_login.php" class="option-btn">Login</a>
        <a href="./user_register.php" class="option-btn">Register</a>
    </div>
        <?php
        }
        ?>
</div>

    </section>
</header>