<?php 
include('../component/connect.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}
    if(isset($_POST['add_product'])){
        $name = $_POST['txtName'];
        $price = $_POST['txtPrice'];
        $detail = $_POST['details'];

        $image_01 = $_FILES['image_1']['name'];
        $image_01_size = $_FILES['image_1']['size'];
        $image_01_tmp_name = $_FILES['image_1']['tmp_name'];
        $image_01_folder = "../img/ .'$image_01'";

        $image_02 = $_FILES['image_2']['name'];
        $image_02_size = $_FILES['image_2']['size'];
        $image_02_tmp_name = $_FILES['image_2']['tmp_name'];
        $image_02_folder = "../img/ .'$image_02'";

        $image_03 = $_FILES['image_3']['name'];
        $image_03_size = $_FILES['image_3']['size'];
        $image_03_tmp_name = $_FILES['image_3']['tmp_name'];
        $image_03_folder = "../img/ .'$image_03'";

        $image_04 = $_FILES['image_4']['name'];
        $image_04_size = $_FILES['image_4']['size'];
        $image_04_tmp_name = $_FILES['image_4']['tmp_name'];
        $image_04_folder = "../img/ .'$image_04'";

        $image_05 = $_FILES['image_5']['name'];
        $image_05_size = $_FILES['image_5']['size'];
        $image_05_tmp_name = $_FILES['image_5']['tmp_name'];
        $image_05_folder = "../img/ .'$image_05'";

        if(!empty($name) && !empty($detail) && !empty($price) && !empty($image_01) &&
            !empty($image_02) && !empty($image_03) && !empty($image_04) && !empty($image_05)){
            $select_products = "SELECT * FROM products WHERE name = '$name'";
            $result = $conn->query($select_products);

            if($result->num_rows > 0){
                echo "<script>alert('Product is already existed')</script>";
            }else{
                if($image_01_size > 20000000 or $image_02_size > 20000000
                or $image_03_size > 20000000 or $image_04_size > 20000000
                or $image_05_size > 20000000){
                    echo "<script>alert('Image size is too large')</script>";
                }else{
                    move_uploaded_file($image_01_tmp_name, $image_01_folder);
                    move_uploaded_file($image_02_tmp_name, $image_02_folder);
                    move_uploaded_file($image_03_tmp_name, $image_03_folder);
                    move_uploaded_file($image_04_tmp_name, $image_04_folder);
                    move_uploaded_file($image_05_tmp_name, $image_05_folder);
                    $insert_product = "INSERT INTO products(name, details, price, mainImg, subImg1, subImg2, subImg3, subImg4)
                    VALUES('$name', '$detail', '$price' , '$image_01', '$image_02', '$image_03', '$image_04', '$image_05')";
                    $conn->query($insert_product);
                    header('Location: ../admin/products.php');
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>


<body>
<?php include("../component/admin_header.php") ?>

<section class="add-products">
        <h1 class = "heading">Add Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="flexing">
                <div class="inputBox">
                    <span>Product Name (required)</span>
                    <input type="text" required placeholder="Enter Product Name" name="txtName" maxlength="1000" class="box">
                </div>
                    <span>Price (required)</span>
                    <input type="text" required placeholder="Enter Price" name="txtPrice"  
                    class="box">
                </div>
                <div class="inputBox">
                    <span>Main Image (required)</span>
                    <input type="file" name="image_1" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>SubImage 1 (required)</span>
                    <input type="file" name="image_2" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>SubImage 2 (required)</span>
                    <input type="file" name="image_3" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>SubImage 3 (required)</span>
                    <input type="file" name="image_4" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>SubImage 4 (required)</span>
                    <input type="file" name="image_5" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>Product details</span>
                    <textarea name="details" class="box" placeholder="Enter product details"
                    required maxlength="350" cols="30" rows="10"></textarea>
                </div>
                <input type="submit" value="Add product" name="add_product" class="btn">
            </div>
        </form>
    </section>

    <section class = "show-products">
        <div class = "box-container">
            <?php 
                $show_product = "SELECT * FROM products";
                $result = $conn->query($show_product);
                if($result->num_rows > 0){
                    while($fetch_product = $result->fetch_assoc()){
                    ?>
                    <div class="box">
                        <img src="../img/<?=$fetch_product['mainImg'];?>">
                        <div class = "name"><?=$fetch_product['name'];?></div>
                        <div class = "price"><?=$fetch_product['price'];?></div>
                        <div class = "details"><?=$fetch_product['details'];?></div>
                        <div class = "flex-btn">
                            <a href="../admin/update_product.php?update=<?=$fetch_product['id'];?>"
                            class="option-btn">Update</a>
                            <a href="../admin/deleteproduct.php?delete=<?=$fetch_product['id'];?>"
                            class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
                        </div>
                    </div>    
                    <?php
                    }
                }else{
                    echo "<p class ='empty'>No products has been added</p>";
                }
            ?>
        </div>
    </section>
</body>
</html>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>