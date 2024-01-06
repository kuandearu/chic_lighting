<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:./user_login.php');
}

include '../component/wishlist_cart.php';

if(isset($_POST['delete'])){
    $cart_id = $_POST['cart_id'];
    $clear_cart = $conn->query("delete from `cart` where id='$cart_id'");
    $message[] = 'item deleted!';

}

if(isset($_GET['delete_all'])){
    $delete_all = $_GET['delete_all'];
    $clear_all_cart = $conn->query("delete from `cart` where user_id ='$user_id'");
    $message[] = 'all cart deleted!';

}

if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $update_qty = $conn->query("UPDATE `cart` SET quantity = '$qty' WHERE id = '$cart_id'");
    $message[] = 'cart quantity updated';
 }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 

<!-- cart section  -->

<setion class="wishlist">
    <h1 class="heading">Your cart</h1>

    <div class="box-container">
        <?php 
        $total = 0;
            $select_cart = $conn->query("select * from `cart` where user_id = '$user_id'");
            if($select_cart->num_rows >0){
                while($fetch_cart = $select_cart->fetch_assoc()){

        ?>

        <form action="" method="post" class="box">
            <input type="hidden" name="cart_id" value="<?=$fetch_cart['id']; ?>">
            <img src="../img/<?=$fetch_cart['mainImg'] ?>" class="image" alt="">
            <div class="name"><?= $fetch_cart['name']?></div>
            <a href="quick_view.php?pid=<?= $fetch_cart['product_id']; ?>" class="fas fa-eye"></a>
            <div class="flex1">
                <input type="number" name="qty" class="qty" min="1" max="99" value="<?=$fetch_cart['quantity'];?>" onkeypress="if(this.value.length == 2) return false;">
                <button type="submit" class="fas fa-edit" name="update_qty"></button>
            </div>
            <div class="prices">
                <div class="price">$<span><?= $fetch_cart['price']?></span>/-</div>
            
            <!-- total price of product after multiple number of produts -->
            <div class="sub-total">Total price: $<span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']) ?></span></div></div>
            <input type="submit" name="delete" onclick="return confirm('Delete this from cart?');" value="delete" class="btn">

        </form>

        <?php 
                $total += $sub_total;
                }
            }else{
                echo '<p class="empty">Your cart is empty!</p>';
            }
        ?>
    </div>

    <div class="cart-total">
        <p class="grant-total">Grant total : $<span><?= $total;?></span></p>
        <a href="./shop.php" class="option-btn">Continue shopping</a>
        <a href="./cart.php?delete_all" class="delete-btn <?=($total >1)?'':'disabled';?>" 
        onclick="return confirm('Clear all products in cart?');">Empty cart</a>
        <a href="./checkout.php" class="btn <?=($total >1)?'':'disabled';?>">Check out</a>

    </div>

</setion>


<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>