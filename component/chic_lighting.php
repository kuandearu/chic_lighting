<?php 
    require_once("../component/connect.php");
    if($conn->error){
        echo "Connected error!" . $conn->error;
    }else{
        echo "Connected successfully!";

        $sql_create1 = "CREATE TABLE IF NOT EXISTS `admins` (
            `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(50) NOT NULL,
            `password` varchar(100) NOT NULL,
            PRIMARY KEY (`id`)
          )";
    
        $sql_create2 = "CREATE TABLE IF NOT EXISTS `cart` (
            `id` int(100) NOT NULL AUTO_INCREMENT,
            `user_id` int(100) NOT NULL,
            `product_id` int(100) NOT NULL,
            `name` varchar(255) NOT NULL,
            `price` int(10) NOT NULL,
            `quantity` int(10) NOT NULL,
            `image` varchar(100) NOT NULL,
            PRIMARY KEY (`id`)
          )";
    
        $sql_create3 = "CREATE TABLE IF NOT EXISTS `contact` (
            `id` int(100) NOT NULL AUTO_INCREMENT,
            `user_id` int(100) NOT NULL,
            `name` varchar(100) NOT NULL,
            `email` varchar(100) NOT NULL,
            `phone` varchar(12) NOT NULL,
            `message` varchar(500) NOT NULL,
            PRIMARY KEY (`id`)
          )";
    
        $sql_create4 = "CREATE TABLE IF NOT EXISTS `orders` (
            `id` int(100) NOT NULL AUTO_INCREMENT,
            `user_id` int(100) NOT NULL,
            `name` varchar(100) NOT NULL,
            `number` varchar(10) NOT NULL,
            `email` varchar(100) NOT NULL,
            `method` varchar(50) NOT NULL,
            `address` varchar(100) NOT NULL,
            `total_products` varchar(1000) NOT NULL,
            `total_price` int(100) NOT NULL,
            `placed_on` date NOT NULL DEFAULT current_timestamp(),
            `payment_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            PRIMARY KEY (`id`)
          )";
    
        $sql_create5 = "CREATE TABLE IF NOT EXISTS `products` (
            `id` int(100) NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL,
            `details` varchar(500) NOT NULL,
            `price` int(10) NOT NULL,
            `mainImg` varchar(100) NOT NULL,
            `subImg1` varchar(100) NOT NULL,
            `subImg2` varchar(100) NOT NULL,
            `subImg3` varchar(100) NOT NULL,
            `subImg4` varchar(100) NOT NULL,
            PRIMARY KEY (`id`)
          )"; 
        
        $sql_create6 = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int(100) NOT NULL AUTO_INCREMENT,
            `name` varchar(20) NOT NULL,
            `email` varchar(50) NOT NULL,
            `password` varchar(50) NOT NULL,
            PRIMARY KEY (`id`)
          )";
    
        $sql_create7 = "CREATE TABLE IF NOT EXISTS `wishlist` (
            `id` int(100) NOT NULL AUTO_INCREMENT,
            `user_id` int(100) NOT NULL,
            `product_id` int(100) NOT NULL,
            `name` varchar(100) NOT NULL,
            `price` int(100) NOT NULL,
            `mainImg` varchar(100) NOT NULL,
            PRIMARY KEY (`id`)
          )";

        $insert = "INSERT INTO `admins` (`id`, `name`, `password`) VALUES
        (1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b'),
        (2, 'admin1', '827ccb0eea8a706c4c34a16891f84e7b');";

        $conn->query($sql_create1);
        $conn->query($sql_create2);
        $conn->query($sql_create3);
        $conn->query($sql_create4);
        $conn->query($sql_create5);
        $conn->query($sql_create6);
        $conn->query($sql_create7);
        echo "<br>Create table successfully!";
        $conn->query($insert);
        echo "<br>Insert data successfully!";
    }
    

?>