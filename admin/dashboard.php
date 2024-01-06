<?php 
include('../component/connect.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:../component/admin_login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>


<body>
    
<?php include ('../component/admin_header.php'); ?>

<!-- admin Dashboard section  -->
<section class="dashboard">

    <h1 class="heading">Dashboard</h1>

    <div class="box-container">
        <div class="box">
            <h3>Welcome!</h3>
            <?php echo '<p>'.$fetch_profile['name'] .'</p>' ?>
            <a href="update_profile.php" class="btn">Update profile</a>
        </div>
        <!-- show pending orders and price  -->
        <div class="box">
        <?php 
            $total_pendings =0;
            $select_pendings = $conn -> query("select  * from `orders` where payment_status ='pending'");
            while($check = $select_pendings->fetch_assoc()){
                $total_pendings += $check['total_price'];
            }
        ?>
            <h3> <span>$</span><?php echo $total_pendings; ?><span>/-</span> </h3>
            <p>total pendings</p>
            <a href="pending_orders.php" class="btn">See orders</a>
        </div>
        <!-- show completed orders and price  -->
        <div class="box">
        <?php 
            $total_completes =0;
            $select_completes = $conn -> query("select  * from `orders` where payment_status ='completed'");
            while($check = $select_completes->fetch_assoc()){
                $total_completes += $check['total_price'];
            }
        ?>
            <h3> <span>$</span><?php echo $total_completes; ?><span>/-</span> </h3>
            <p>total completes</p>
            <a href="completed_orders.php" class="btn">See orders</a>
        </div>
        <!-- show all orders  -->
        <div class="box">
            <?php 
            $select_orders = $conn->query("select * from `orders`");
            $count_orders = $select_orders->num_rows;
            ?>
            <h3><?php echo $count_orders; ?></h3>
            <p>total orders</p>
            <a href="placed_orders.php" class="btn">See orders</a>
        </div>
        <!-- show total of products  -->
        <div class="box">
            <?php 
            $select_products = $conn->query("select * from `products`");
            $count_products = $select_products->num_rows;
            ?>
            <h3><?php echo $count_products; ?></h3>
            <p>total products</p>
            <a href="products.php" class="btn">See products</a>
        </div>
        <!-- show all users account  -->
        <div class="box">
            <?php 
            $select_users = $conn->query("select * from `users`");
            $count_users = $select_users->num_rows;
            ?>
            <h3><?php echo $count_users; ?></h3>
            <p>User accounts</p>
            <a href="user_accounts.php" class="btn">See users</a>
        </div>
        <!-- show all admins account  -->
        <div class="box">
            <?php 
            $select_admins = $conn->query("select * from `admins`");
            $count_admins = $select_admins->num_rows;
            ?>
            <h3><?php echo $count_admins; ?></h3>
            <p>Admin accounts</p>
            <a href="admin_accounts.php" class="btn">see admins</a>
        </div>

        <div class="box">
            <?php 
            $select_messages = $conn->query("select * from `messages`");
            $count_messages = $select_messages->num_rows;
            ?>
            <h3><?php echo $count_messages; ?></h3>
            <p>Messages count</p>
            <a href="messages.php" class="btn">See messages</a>
        </div>
    </div>

</section>



</body>
</html>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>