<?php 
include('../component/connect.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_POST['update'])){
    $update_id = $_GET['update'];
    $name = $_POST['txtName'];
    $price = $_POST['txtPrice'];
    $detail = $_POST['details'];

    $old_image_01 = $_POST['old_image_01'];
    $image_01 = $_FILES['image_1']['name'];
    $image_01_size = $_FILES['image_1']['size'];
    $image_01_tmp_name = $_FILES['image_1']['tmp_name'];
    $image_01_folder = "../img/ .'$image_01'";

    $old_image_02 = $_POST['old_image_02'];
    $image_02 = $_FILES['image_2']['name'];
    $image_02_size = $_FILES['image_2']['size'];
    $image_02_tmp_name = $_FILES['image_2']['tmp_name'];
    $image_02_folder = "../img/ .'$image_02'";

    $old_image_03 = $_POST['old_image_03'];
    $image_03 = $_FILES['image_3']['name'];
    $image_03_size = $_FILES['image_3']['size'];
    $image_03_tmp_name = $_FILES['image_3']['tmp_name'];
    $image_03_folder = "../img/ .'$image_03'";

    $old_image_04 = $_POST['old_image_04'];
    $image_04 = $_FILES['image_4']['name'];
    $image_04_size = $_FILES['image_4']['size'];
    $image_04_tmp_name = $_FILES['image_4']['tmp_name'];
    $image_04_folder = "../img/ .'$image_04'";

    $old_image_05 = $_POST['old_image_05'];
    $image_05 = $_FILES['image_5']['name'];
    $image_05_size = $_FILES['image_5']['size'];
    $image_05_tmp_name = $_FILES['image_5']['tmp_name'];
    $image_05_folder = "../img/ .'$image_05'";
    

    if(!empty($name) && !empty($detail)  && !empty($price) && !empty($image_01) &&
        !empty($image_02) && !empty($image_03) && !empty($image_04) && !empty($image_05)){
            if($image_01_size > 20000000 or $image_02_size > 20000000
                or $image_03_size > 20000000 or $image_04_size > 20000000
                or $image_05_size > 20000000){
                    echo "<script>alert('Image size is too large!')</script>";
        }else{
            move_uploaded_file($image_01_tmp_name, $image_01_folder);
            move_uploaded_file($image_02_tmp_name, $image_02_folder);
            move_uploaded_file($image_03_tmp_name, $image_03_folder);
            move_uploaded_file($image_04_tmp_name, $image_04_folder);
            move_uploaded_file($image_05_tmp_name, $image_05_folder);

            unlink("../img/" . $old_image_01);
            unlink("../img/" . $old_image_02);
            unlink("../img/" . $old_image_03);
            unlink("../img/" . $old_image_04);
            unlink("../img/" . $old_image_05);

            $update_product = "UPDATE `products` SET name = '$name',
                                                   details =  '$detail',  
                                                   price = '$price',
                                                   mainImg = '$image_01', 
                                                   subImg1 = '$image_02', 
                                                   subImg2 = '$image_03', 
                                                   subImg3 = '$image_04',
                                                   subImg4 = '$image_05' 
                                                   WHERE id =  '$update_id'";
            $conn->query($update_product);
            header('Location: ../admin/products.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>


<body>
<?php include("../component/admin_header.php"); ?>
    
    <section class = "update-product">
        <?php
            require_once("../component/connect.php");

                $update_id = $_GET['update'];
                $show_product = "SELECT * FROM products WHERE id = '$update_id'";
                $result = $conn->query($show_product);
                if($result->num_rows > 0){
                    while($fetch_product = $result->fetch_assoc()){
        ?>
        <h1 class = "heading">Update Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name = "old_image_01" value = "<?=$fetch_product['mainImg'];?>">
            <input type="hidden" name = "old_image_02" value = "<?=$fetch_product['subImg1'];?>">
            <input type="hidden" name = "old_image_03" value = "<?=$fetch_product['subImg2'];?>">
            <input type="hidden" name = "old_image_04" value = "<?=$fetch_product['subImg3'];?>">
            <input type="hidden" name = "old_image_05" value = "<?=$fetch_product['subImg4'];?>">
        <div class="flexing">
                <div class="inputBox">
                    <span>Update product Name</span>
                    <input type="text"  placeholder="Enter Product Name" name="txtName" 
                    maxlength="10000" class="box" value = "<?=$fetch_product['name'];?>">
                </div>
                <div class="inputBox">
                    <span>Update price</span>
                    <input type="text"  placeholder="Enter Price" name="txtPrice"  
                    class="box" value = "<?=$fetch_product['price'];?>">
                </div>
                <div class="inputBox">
                    <span>Update main Image</span>
                    <input type="file" name="image_1" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" 
                     value = "<?=$fetch_product['mainImg']; ?>">
                </div>
                <div class="inputBox">
                    <span>Update sub Image 1</span>
                    <input type="file" name="image_2" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" 
                    value = "<?=$fetch_product['subImg1']; ?>">
                </div>
                <div class="inputBox">
                    <span>Update sub Image 2</span>
                    <input type="file" name="image_3" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" 
                    value = "<?=$fetch_product['subImg2']; ?>">
                </div>
                <div class="inputBox">
                    <span>Update sub Image 3</span>
                    <input type="file" name="image_4" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" 
                    value = "<?=$fetch_product['subImg3']; ?>">
                </div>
                <div class="inputBox">
                    <span>Update sub Image 4</span>
                    <input type="file" name="image_5" class="box"
                    accept="image/jpg, image/jpeg, image/png, image/webp" 
                    value = "<?=$fetch_product['subImg4']; ?>">
                </div>
                <div class="inputBox">
                    <span>Update Details</span>
                    <textarea name="details" class="box" placeholder="Enter product details"
                    maxlength="9999999" cols="30" rows="10"
                    value = "<?=$fetch_product['details'];?>"></textarea>
                </div>
                <input type="submit" value="Update Product" name="update" class="btn">
                <a class="option-btn" href="../admin/products.php">Go back</a>
        </form>
        <?php  
                }
                }else{
                    echo "<p>No product has been added yet!";
                }
        ?>
    </section>
</body>
</html>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>