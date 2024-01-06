<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:./user_login.php');
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 
<section class = "show-orders">
    <h1 class = "heading1">Your orders</h1>
    <div class="box-container">
        <?php
            $show_order = "SELECT * FROM orders WHERE user_id = '$user_id'";
            $result = $conn->query($show_order);
            if($result->num_rows > 0){
                while($fetch_orders = $result->fetch_assoc()){
            ?>
            <div class = "box">
                <p>Placed on: <span><?=$fetch_orders['placed_on']?></span></p>
                <p>Name: <span><?=$fetch_orders['name']?></span></p>
                <p>Number: <span><?=$fetch_orders['number']?></span></p>
                <p>Email: <span><?=$fetch_orders['email']?></span></p>
                <p>Address: <span><?=$fetch_orders['address']?></span></p>
                <p>Your order: <span><?=$fetch_orders['total_products']?></span></p>
                <p>Total price: <span><?=$fetch_orders['total_price']?></span></p>
                <p>Payment Status: <span style = "color:<?php if($fetch_orders
                ['payment_status'] == 'pending'){echo 'red';}else{echo'green';}?>">
                <?=$fetch_orders['payment_status']?></span></p>  
            </div>
            <?php    
                }
            }else{
                echo '<p class = "empty">Your order is empty</p>';
            }
        ?>
    </div>
</section>



<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>