<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

}else{
    $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>
    
<?php include '../component/user_header.php';?>

<!-- category section  -->
<h1 class="heading">Product Category</h1>
<section class="products">
    <div class="box-container">
        <?php
            $category = $_GET['category'];
            $select_products = $conn->query("SELECT * FROM `products` where name like '%" . $category . "%'");
            $check = $select_products->num_rows;
            if($check >0) {
                while($fetch_products = $select_products->fetch_assoc()){
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['mainImg']; ?>">
            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
            <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
            <img src="../img/<?= $fetch_products['mainImg']; ?>">
            <div class="name"><?= $fetch_products['name']; ?></div>
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
        ?>
    </div>
</section>



<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>