-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 03, 2023 lúc 09:10 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `chic_lighting`
--
CREATE DATABASE IF NOT EXISTS `chic_lighting` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chic_lighting`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70'),
(2, 'admin1', '4297f44b13955235245b2497399d7a93'),
(3, 'admin2', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `mainImg` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 0, 'demo 1', 'toancoi@gmail.com', '0987654321', 'test message data in message table');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
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
  PRIMARY KEY (`id`),
  KEY `order_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(5, 1, 'demo 1', '0987654311', 'demo1@gmail.com', 'debit card', 'no 1, street 1, City 1, State 1, Country 1 - 424162', '0Hunter Fan Company 50272 Donegan Ceiling Fan, 44, Noble Bronze Finish (1) -Portage Bay 50251 Hugger 52 (4) -', 460, '2023-10-03', 'pending'),
(6, 1, 'demo 1', '0988777666', 'demo1@gmail.com', 'cash on delevery', 'no 1, street 1, City 1, State 1, Country 1 - 124578', '0Kichler Cylinders 12 Outdoor Wall Sconce in Black, 2-Light Exterior Wall Light (5) -Home Accents Holiday 200 LED Dome Icicle Lights (2) -Metal Brass Finish Floor Lamp (2) -', 922, '2023-10-03', 'completed');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `mainImg`, `subImg1`, `subImg2`, `subImg3`, `subImg4`) VALUES
(14, 'Hunter Fan Company 50272 Donegan Ceiling Fan, 44, Noble Bronze Finish', '•	Material Type: Steel Resin Aluminum Plastic Glass\r\n•	Included Components: Motor Blades Light Kit Bulbs\r\n', 180, '50272_1.jpg', '50272_2.jpg', '50272_3.jpg', '50272_4.jpg', '50272_1.jpg'),
(16, 'Portage Bay 50251 Hugger 52\" Matte Black West Hill Ceiling Fan with Bowl Light Kit', '•	LOW CEILINGS: No problem, this ceiling fan measures 11.5 inches from ceiling to bottom of light fixture\r\n•	LIGHT: Frosted cased white light kit with 1 E26/A15 bulb. Dimmable 100% to 10% and 600 lumens (200 degree beam angle)\r\n•	5 BLADES: Dual finish fan blades (52 inches) Matte Black on side A - Siberian Walnut on side B\r\n•	QUIET, REVERSIBLE MOTOR: ', 70, '50251_1.jpg', '50251_2.jpg', '50251_3.jpg', '50251_4.jpg', '50251_1.jpg'),
(17, 'Kichler Cylinders 12 Outdoor Wall Sconce in Black, 2-Light Exterior Wall Light', 'Safety rating: ETL and safety listing: Damp. Extension/Depth-7 inch Backplate/Canopy Width-5inch Backplate/Canopy Length-4.75 inch Height from Center of Wall Opening-6 inch\r\nFinish: black\r\nHeight: 12.00 inches Width: 4.75 inches\r\nNumber of Lights: 2, Bulb Type: BR30, Bulb(s) Included: No\r\n', 78, 'Cylinder12_1.jpg', 'Cylinder12_2.jpg', 'Cylinder12_3.jpg', 'Cylinder12_4.jpg', 'Cylinder12_1.jpg'),
(18, 'Twinkly Strings – App-Controlled Decoration LED Christmas Lights with 250 RGB+W', 'Create the ultimate lighting decorations with smart, addressable LED lights Twinkly Strings and explore virtually unlimited ways to transform your space with light and color\r\nEnjoy setup in a matter of seconds via Bluetooth and Wi-Fi, manage your lights with the free Twinkly app', 125, 'String_1.jpg', 'String_2.jpg', 'String_3.jpg', 'String_4.jpg', 'String_1.jpg'),
(19, 'Eve Flare - Portable Smart LED Lamp with Apple HomeKit Technology', 'Eve Flare requires iPhone or iPad with the latest version of iOS/iPadOS.\r\nBeautiful ambience lighting in any color and for any space you want – controlled via your iPhone, iPad, Apple Watch, Siri, on-board button or HomeKit scene.\r\nSet the perfect outdoor atmosphere in your garden or on the balcony – thanks to IP65 water resistance.', 100, 'Smart_1.jpg', 'Smart_2.jpg', 'Smart_3.jpg', 'Smart_4.jpg', 'Smart_1.jpg'),
(20, 'Home Accents Holiday 200 LED Dome Icicle Lights', 'Links to up to 15 other sets for wide coverage LEDs offer bright light and reliability for seasonal fun\r\nIdeal for lighting both indoor and outdoor scenes Cool white color completes your winter holidays\r\n200 cool white LEDs add liveliness to your holiday setup\r\n', 23, 'Holiday_1.jpg', 'Holiday_2.jpg', 'Holiday_3.jpg', 'Holiday_4.jpg', 'Holiday_1.jpg'),
(21, '6 Branch Chrome Shallow Cut Glass Chandelier', 'H:52 x W:75 x D7:5cm. Length of chain: approx. 100cm (Adjustable)\r\nBulb Spec: SES E14 MAX 40W per bulb. (Bulbs not included)', 339, 'Shallow_1.jpg', 'Shallow_2.jpg', 'Shallow_3.jpg', 'Shallow_4.jpg', 'Shallow_1.jpg'),
(22, 'Edda Matt Black Table Lamp', 'Edda Matt Black Table Lamp With figured Faux Marble Shade\r\nDomed Art Deco delight in matt black and faux white marble – creating a delicious ambient light.\r\n\r\nDimensions & Specifications:\r\nH46 x W30 x D30cm\r\nLight bulb not included. Requires 1 x E27', 535, 'table_1.jpg', 'table_2.jpg', 'table_3.jpg', 'table_4.jpg', 'table_1.jpg'),
(23, 'Metal Brass Finish Floor Lamp', 'Metal Brass Finish Floor Lamp\r\n\r\nDimensions & Specifications:\r\nH:156 x L:44 x W:30cm\r\nMetal, PVC. Bulb E27 (not supplied)', 243, 'floor_1.jpg', 'floor_2.jpg', 'floor_3.jpg', 'floor_4.jpg', 'floor_1.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'toancoi', 'demo1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 'demo', 'demo2@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `mainImg` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_link` (`user_id`),
  KEY `product_id_link` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `product_id_link` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_id_link` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
