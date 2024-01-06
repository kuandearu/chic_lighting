<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

include '../component/wishlist_cart.php';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 
<!-- shop section  -->

<h1 class="heading">All products</h1>
    <div class="home-products">
        <?php 
            $result = $conn->query("SELECT * FROM `products` limit 9");
            if($result->num_rows > 0){
                while($fetch_product = $result->fetch_assoc()){
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_product['mainImg']; ?>">
                    <img src="../img/<?=$fetch_product['mainImg'];?>">
                    <div class = "details"></div>
                        <div class="name"><?=$fetch_product['name'];?></div>
                        <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                        <a href="./quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                        <div class="flex">
                        <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                    </div>
                    <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                </form>   
                <?php
                }
            }else{
                echo "<p class ='empty'>No products has been added</p>";
            }
        ?>
    </div>



<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>