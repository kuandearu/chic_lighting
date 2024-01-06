<?php
    require_once("../component/connect.php");

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_products = "SELECT * FROM products WHERE id = '$delete_id'";
        $result = $conn->query($delete_products);
        if($result->num_rows > 0){
            while($fetch_products = $result->fetch_assoc()){
                unlink("../img/" . $fetch_products['mainImg']);
                unlink("../img/" . $fetch_products['subImg1']);
                unlink("../img/" . $fetch_products['subImg2']);
                unlink("../img/" . $fetch_products['subImg3']);
                unlink("../img/" . $fetch_products['subImg4']);

                $delete = "DELETE FROM products WHERE id = '$delete_id'";
                $conn->query($delete);
                header('Location: ../admin/products.php');
            }
        }
    }
?>