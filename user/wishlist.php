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
    $wishlist_id = $_POST['wishlist_id'];
    $clear_wishlist = $conn->query("delete from `wishlist` where id='$wishlist_id'");
    $message[] = 'item deleted!';

}

if(isset($_GET['delete_all'])){
    $delete_all = $_GET['delete_all'];
    $clear_all = $conn->query("delete from `wishlist` where user_id ='$user_id'");
    $message[] = 'all wishlist deleted!';

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

<!-- wishlist section  -->

<setion class="wishlist">
<h1 class="heading">Your wishlist</h1>

    <div class="box-container">
        <?php 
        $total = 0;
            $select_wishlist = $conn->query("select * from `wishlist` where user_id = '$user_id'");
            if($select_wishlist->num_rows >0){
                while($fetch_wishlist = $select_wishlist->fetch_assoc()){
                    $total += $fetch_wishlist['price'];

        ?>

        <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?=$fetch_wishlist['product_id'];?>">
            <input type="hidden" name="name" value="<?=$fetch_wishlist['name'];?>">
            <input type="hidden" name="price" value="<?=$fetch_wishlist['price'];?>">
            <input type="hidden" name="image" value="<?=$fetch_wishlist['mainImg'];?>">
            <input type="hidden" name="wishlist_id" value="<?=$fetch_wishlist['id']; ?>">
            <img src="../img/<?=$fetch_wishlist['mainImg'] ?>" class="image" alt="">
            <div class="name"><?= $fetch_wishlist['name']?></div>
            <a href="quick_view.php?pid=<?= $fetch_wishlist['product_id']; ?>" class="fas fa-eye"></a>
            <div class="flex">
                <div class="price">$<span><?= $fetch_wishlist['price']?></span>/-</div>
                <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <input type="submit" name="add_to_cart" id="" value="add to cart" class="btn">
            <input type="submit" name="delete" onclick="return confirm('Delete this from wishlist?');" value="delete" class="btn">

        </form>

        <?php 
                }
            }else{
                echo '<p class="empty">Your wishlist is empty!</p>';
            }
        ?>
    </div>

    <div class="wishlist-total">
        <p class="grant-total">Grant total : $<span><?= $total;?></span></p>
        <a href="./shop.php" class="option-btn">Continue shopping</a>
        <a href="./wishlist.php?delete_all" class="delete-btn <?=($total >1)?'':'disabled';?>" 
        onclick="return confirm('Clear all products in wishlist?');">Empty wishlist</a>

    </div>

</setion>

<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>