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
    <title>Quick View</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 

    <section class="quick-view">
        <?php
            $pid = $_GET['pid'];
            $select_products = $conn->query("SELECT * FROM `products` where id = '$pid'");
            $print = $conn->query("SELECT name,price,details FROM `products` where id = '$pid'");
            $check = $select_products->num_rows;
            $printf = $print->num_rows;

            $file = "description.docx";
            $open_file = fopen($file, "w");

            if($check >0) {
                while($fetch_products = $select_products->fetch_assoc()){
                    while($getDesc = $print->fetch_assoc()){
                        fwrite($open_file,implode("\n", $getDesc) . "\n");
                    }
                
        ?>
        <h1 class="heading">Quick View</h1>
        <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['mainImg']; ?>">
            <div class="main-img">
                <div class="big-img">
                    <img src="../img/<?= $fetch_products['mainImg']; ?>">
                </div>
                <div class="small-img">
                <img src="../img/<?= $fetch_products['subImg1']; ?>">
                <img src="../img/<?= $fetch_products['subImg2']; ?>">
                <img src="../img/<?= $fetch_products['subImg3']; ?>">
                <img src="../img/<?= $fetch_products['subImg4']; ?>">
                </div>
            </div>

            <div class="content">
                <div class="name"><?= $fetch_products['name']; ?></div>
                <div class="flex">
                    <div class="price"><span>$</span><?= $fetch_products['price']; ?><span>/-</span></div>
                    <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                </div>
                
                <div class="details">
                    <?= $fetch_products['details'];?>
                </div>

                <div class="flex-btn">
                <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                <input type="submit" value="add to wishlist" class="btn" name="add_to_wishlist">
                
            </div>
            <a href="./description.docx" download="decsription.doc" class="option-btn">Download the description</a>
        </form>

        <?php
                }
            }else{
                echo '<p class="empty"> No products found!</p>';
            }
        ?>

    </section>




<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/change_img.js"></script>
</body>
</html>