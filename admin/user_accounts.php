<?php 
include('../component/connect.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_order = $conn->query("DELETE FROM `orders` WHERE user_id = $delete_id");
    $delete_cart = $conn->query("DELETE FROM `cart` WHERE user_id = $delete_id");
    $delete_wishlist = $conn->query("DELETE FROM `wishlist` WHERE user_id = $delete_id");
    $delete_messeages = $conn->query("DELETE FROM `messages` WHERE user_id = $delete_id");
    $delete_users = $conn->query("DELETE FROM `users` WHERE id = $delete_id");
    
    header('location: user_accounts.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    
<?php include '../component/admin_header.php'?>
<!-- user accounts section -->

<section class="accounts">
    
    <h1 class="heading">user accounts</h1>

    <div class="box-container">

        <?php
            $select_account = $conn->query("SELECT * FROM `users`");
            $check = $select_account->num_rows;
            if($check > 0){
                while($fetch_accounts = $select_account->fetch_assoc()){           
        ?>
        <div class="box">
            <p>user id: <span><?= $fetch_accounts['id']?></span></p>
            <p>username: <span><?= $fetch_accounts['name']?></span></p>
            <a href="../admin/user_accounts.php?delete=<?=$fetch_accounts['id'];?>" 
            class="delete-btn" onclick="return confirm('Delete this account?');">Delete</a>
        </div>
        <?php
             }

            }else{
                echo '<p class="empty">no accounts availabale</p>';
            }
        ?>
    </div>
</section>



</body>
</html>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>