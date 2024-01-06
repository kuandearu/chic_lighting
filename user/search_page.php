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
    <title>Search Page</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 

<!-- search form section  -->

<section class="search-form">
<form action="" method="post">
    <input type="text" class="box" maxlength="100" placeholder="search here ..." required name="search_box">
    <button type="submit" class="fas fa-search" name="search-btn"></button>
</form>
</section>


<section class="search-product" style="padding-top:0; min-height:100vh;">

    <div class="box-container">
    
        <?php
            if(isset($_POST['search_box']) || isset($_POST['search_btn'])){
                $search_box = $_POST['search_box'];
                $select_products = $conn->query("SELECT * FROM `products` WHERE name LIKE '%" . $search_box . "%'");
                $check = $select_products->num_rows;
                if($check >0) {
                    while($fetch_products = $select_products->fetch_assoc()){
            ?>
            <form action="" method="post" class="box">
                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_products['mainImg']; ?>">
                         <!-- kiem tra lai link dan file  -->
                         <img src="../img/<?=$fetch_products['mainImg'];?>">
                        <!-- KT  -->
                        <div class = "details"></div>
                            <div class="name"><?=$fetch_products['name'];?></div>
                            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                            <a href="./quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                            <div class="flex">
                            <div class="price"><span>$</span><?= $fetch_products['price']; ?><span>/-</span></div>
                            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                        </div>
                        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                    </form>

            <?php
                    }
                }else{
                    echo '<p class="empty"> No products found!</p>';
                }
            }
        ?>
    </div>
</section>

<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>