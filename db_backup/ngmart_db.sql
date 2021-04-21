-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2021 at 02:56 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngmart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE `cart_tbl` (
  `cart_id` int(11) NOT NULL,
  `customerreg_id` int(50) NOT NULL,
  `ps_id` int(50) NOT NULL,
  `cart_qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories_tbl`
--

CREATE TABLE `categories_tbl` (
  `id` int(10) NOT NULL,
  `categories` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories_tbl`
--

INSERT INTO `categories_tbl` (`id`, `categories`, `image`, `status`) VALUES
(1, 'Vegies', 'vegies.jpg', 1),
(2, 'Fruits', 'download.jpeg', 1),
(3, 'Seeds', 'seeds.jpg', 1),
(4, 'Pulses', 'pulses.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customerreg_tbl`
--

CREATE TABLE `customerreg_tbl` (
  `customerreg_id` int(8) NOT NULL,
  `login_id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cust_img` varchar(50) DEFAULT NULL,
  `cust_phn_no` varchar(13) DEFAULT NULL,
  `cust_add` varchar(255) DEFAULT NULL,
  `cust_location_id` int(11) NOT NULL,
  `cust_district` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerreg_tbl`
--

INSERT INTO `customerreg_tbl` (`customerreg_id`, `login_id`, `name`, `cust_img`, `cust_phn_no`, `cust_add`, `cust_location_id`, `cust_district`) VALUES
(1, 20, 'cust', NULL, NULL, NULL, 2, 1),
(2, 21, 'Alan', NULL, NULL, NULL, 7, 10),
(3, 22, 'Divu', NULL, NULL, NULL, 1, 1),
(4, 27, 'anu', NULL, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `district_tbl`
--

CREATE TABLE `district_tbl` (
  `dist_id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district_tbl`
--

INSERT INTO `district_tbl` (`dist_id`, `district_name`) VALUES
(1, 'Kottayam'),
(2, 'Kannur'),
(3, 'Thrissur'),
(4, 'Kasargod'),
(5, 'Kollam'),
(6, 'Pathanamthitta'),
(7, 'Wayand'),
(8, 'Thiruvanthapuram'),
(9, 'Allapuzya'),
(10, 'Ernakulam'),
(11, 'Idukki'),
(12, '	Kannur'),
(13, '	Palakkad'),
(14, '	Malappuram');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tbl`
--

CREATE TABLE `inventory_tbl` (
  `inventory_id` int(11) NOT NULL,
  `inventory_ps_id` int(11) NOT NULL,
  `inventory_seller_id` int(11) NOT NULL,
  `inventory_stock` int(11) NOT NULL,
  `inventory_date` varchar(20) NOT NULL,
  `inventory_expiry_date` varchar(20) NOT NULL,
  `inventory_status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_tbl`
--

INSERT INTO `inventory_tbl` (`inventory_id`, `inventory_ps_id`, `inventory_seller_id`, `inventory_stock`, `inventory_date`, `inventory_expiry_date`, `inventory_status`) VALUES
(1, 1, 23, 30, '20-04-20 11:26:56', '20-08-24 11:26:56', 0),
(2, 1, 23, 10, '21-04-21 11:42:48', '21-04-24 11:42:48', 1),
(3, 1, 23, 20, '21-04-21 12:17:47', '21-04-24 12:17:47', 1),
(4, 1, 23, 5, '20-04-20 12:20:13', '20-08-24 12:20:13', 0),
(5, 3, 23, 10, '21-04-21 12:27:00', '21-04-24 12:27:00', 1),
(6, 4, 23, 10, '21-04-21 12:57:37', '21-04-24 12:57:37', 1),
(7, 5, 23, 20, '21-04-21 12:58:44', '21-04-24 12:58:44', 1),
(8, 6, 23, 20, '21-04-21 01:00:04', '21-04-24 01:00:04', 1),
(9, 7, 25, 30, '21-04-21 01:01:20', '21-04-24 01:01:20', 1),
(10, 8, 25, 20, '21-04-21 01:02:47', '21-04-24 01:02:47', 1),
(11, 9, 25, 20, '21-04-21 01:03:19', '21-04-24 01:03:19', 1),
(12, 10, 25, 30, '21-04-21 01:03:51', '21-04-24 01:03:51', 1),
(13, 11, 25, 20, '21-04-21 01:04:36', '21-04-24 01:04:36', 1),
(14, 12, 25, 30, '21-04-21 01:05:59', '21-04-24 01:05:59', 1),
(15, 13, 25, 20, '21-04-21 01:07:18', '21-04-24 01:07:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_tbl`
--

CREATE TABLE `location_tbl` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(40) NOT NULL,
  `location_dist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_tbl`
--

INSERT INTO `location_tbl` (`location_id`, `location_name`, `location_dist_id`) VALUES
(1, 'Pala', 1),
(2, 'Kanjirappally', 1),
(3, '	Ettumanoor', 1),
(4, 'Changanassery	', 1),
(5, 'Kaloor', 10),
(6, 'Petta', 10),
(7, 'Kadavantara', 10),
(8, 'Aluva', 10);

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE `login_tbl` (
  `login_id` int(8) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_type` varchar(8) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`login_id`, `email`, `password`, `user_type`, `status`) VALUES
(4, 'admin@gmail.com', '$2y$10$kaSJU7blJt88aZXKF0lV/eA0ybVQEU/xUtYMtasjwTItSjVHdLGOO', 'admin', 0),
(7, 'admin2@gmail.com', '$2y$10$NgsmCE2DVnq1zwZ0eUZZQ.OYFtPbQi6Tn4/n4zTpTIGBDQ0oEhwSC', 'admin', 1),
(8, 'admin3@gmail.com', '$2y$10$DOouZ4J2R7J6.ajzLgzYIeBrnXIvEaa5Wq7tWGNAdMAjTYH2kVKki', 'admin', 1),
(11, 'admin1@gmail.com', '$2y$10$whZol46ig1krOdYKi2vfdO9CSCQIYy1Z8YXDaNEZ0PCBbb6GIr5RC', 'admin', 1),
(20, 'customer@gmail.com', '$2y$10$Dai8uA4PE0maI9LdAZQPVeabm30fJGXetHGqwP/iwKSDXruwpVb5a', 'customer', 1),
(21, 'alaapi@gmail.com', '$2y$10$FG6wr5s6uKih1WcPQLgufOQQrjE07DLYQuvDVHJVEg4tEnQTKm/GS', 'customer', 1),
(22, 'divu@gmail.com', '$2y$10$qy3Mb3XP.7XJFhcK6B3pl.9CGWqj77GPgFVc0h1EjqzmwLDl0NF.u', 'customer', 1),
(23, 'seller@gmail.com', '$2y$10$9LdgMXkO8YEoNn4ndAjmmecIviYAiYluhkwumlYUvBsDHkf1XFX96', 'seller', 1),
(24, 'seller2@gmail.com', '$2y$10$kcFlSfeSF6rk9NF815sVOOhNHxgDMWRuGzm5b2y/.II8u2.dFRuHW', 'seller', 1),
(25, 'seller3@gmail.com', '$2y$10$YJZp9c9xpluK06sAzJrs.OqYxzHEg7AQjloR2QdnUPUN5FcpZCM5W', 'seller', 1),
(26, 'seller4@gmail.com', '$2y$10$5pB03Xrw9ICQJUZ1uI0PeeHsGEAtIr.rbDKvS8dUHbVkkwOmMB7NO', 'seller', 1),
(27, 'anubenoy@icloud.com', '$2y$10$j9VgCbd64sPIEXRwpF3Ffet2zbf0ev6VlOsiBEfFJzWlcYWwoCNSi', 'customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_history_tbl`
--

CREATE TABLE `order_history_tbl` (
  `id` int(11) NOT NULL,
  `order_date` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_seller_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_seller_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_seller_tbl`
--

CREATE TABLE `product_seller_tbl` (
  `ps_id` int(10) NOT NULL,
  `ps_seller_id` int(11) NOT NULL,
  `ps_product_id` int(11) NOT NULL,
  `ps_price` decimal(10,2) NOT NULL,
  `ps_image` varchar(255) NOT NULL,
  `ps_desc` varchar(255) NOT NULL,
  `ps_total_stock` int(50) NOT NULL,
  `ps_status` char(11) NOT NULL DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_seller_tbl`
--

INSERT INTO `product_seller_tbl` (`ps_id`, `ps_seller_id`, `ps_product_id`, `ps_price`, `ps_image`, `ps_desc`, `ps_total_stock`, `ps_status`) VALUES
(1, 23, 1, '40.00', 'veg1.png', 'crunchy carrots', 30, 'a'),
(2, 23, 2, '15.00', 'veg1.png', 'crunchy carrots', 15, 'a'),
(4, 23, 3, '150.00', 'Apple.jpg', 'juicy crunchy apples', 10, 'a'),
(5, 23, 4, '250.00', 'Almond-3.jpg', 'nuty almonds', 20, 'a'),
(6, 23, 5, '30.00', 'toor dal.png', 'protein rich', 20, 'a'),
(7, 25, 6, '80.00', 'veg4.png', 'Fresh vegies', 30, 'a'),
(8, 25, 7, '90.00', 'veg2.png', 'Fresh vegies', 20, 'a'),
(9, 25, 8, '150.00', 'mango.jpg', 'juicy mangoes', 20, 'a'),
(10, 25, 9, '245.00', 'mango.jpg', 'juicy mangoes', 30, 'a'),
(11, 25, 10, '355.00', 'pista.jpg', 'Right from farm', 20, 'a'),
(12, 25, 11, '15.00', 'Kala-chana.jpg', 'protein rich', 30, 'a'),
(13, 25, 12, '450.00', 'pista.jpg', 'pistachos', 20, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(11) NOT NULL,
  `prod_categories_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `prod_categories_id`, `prod_name`) VALUES
(1, 1, 'Carrot 1kg'),
(2, 1, 'Carrot 500gm'),
(3, 2, 'Apple 1kg'),
(4, 3, 'Almonds 500gm'),
(5, 4, 'Bengal Gram 500gm'),
(6, 1, 'Beans 1kg'),
(7, 1, 'Beetroot 500gm'),
(8, 2, 'Mango 500gm'),
(9, 2, 'Mango 1kg'),
(10, 3, 'Cashew 200gm'),
(11, 4, 'Amar-Gram 500gm'),
(12, 3, 'In-Shell Pistachios');

-- --------------------------------------------------------

--
-- Table structure for table `sellerreg_tbl`
--

CREATE TABLE `sellerreg_tbl` (
  `seller_id` int(8) NOT NULL,
  `seller_login_id` int(8) NOT NULL,
  `seller_name` varchar(30) NOT NULL,
  `seller_mobile_no` varchar(13) DEFAULT NULL,
  `seller_add` varchar(255) DEFAULT NULL,
  `seller_work_days` varchar(30) DEFAULT NULL,
  `seller_image` varchar(255) DEFAULT NULL,
  `time_1` varchar(30) DEFAULT NULL,
  `seller_location_id` int(11) DEFAULT NULL,
  `seller_dist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerreg_tbl`
--

INSERT INTO `sellerreg_tbl` (`seller_id`, `seller_login_id`, `seller_name`, `seller_mobile_no`, `seller_add`, `seller_work_days`, `seller_image`, `time_1`, `seller_location_id`, `seller_dist_id`) VALUES
(1, 23, 'seller_1', '8123456789', 'karikulam, koovappally po, kanjirapally, kottayam, 68651812', 'Monday-Saturday', 'a-typical-english-village-shop-at-great-bedwyn-wiltshire-england-uk-B3Y7GX.jpeg', '09:00-19:00', 1, 2),
(2, 24, 'seller_2', '8123456789', 'karikulam, koovappally po, kanjirappally, kottayam, 686518\r\n', 'Monday-Saturday', 'a-typical-english-village-shop-at-great-bedwyn-wiltshire-england-uk-B3Y7GX.jpeg', '07:00-21:00', 2, 1),
(3, 25, 'seller_3', '6789012345', 'kathrikadavu', 'Saturday-Friday', 'a-typical-english-village-shop-at-great-bedwyn-wiltshire-england-uk-B3Y7GX.jpeg', '10:00-20:00', 7, 10),
(4, 26, 'seller_4', '6785943214', 'kanjirakattu, kadayanickadu', 'Monday-Saturday', 'a-typical-english-village-shop-at-great-bedwyn-wiltshire-england-uk-B3Y7GX.jpeg', '9:00-22:59', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller_sales_tbl`
--

CREATE TABLE `seller_sales_tbl` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories_tbl`
--

CREATE TABLE `subcategories_tbl` (
  `subcat_id` int(11) NOT NULL,
  `subcat_name` varchar(100) NOT NULL,
  `subcat_img` varchar(200) NOT NULL,
  `subcat_cat_id` int(11) NOT NULL,
  `subcat_status` char(10) NOT NULL DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories_tbl`
--

INSERT INTO `subcategories_tbl` (`subcat_id`, `subcat_name`, `subcat_img`, `subcat_cat_id`, `subcat_status`) VALUES
(1, 'Apple', 'Apple.jpg', 2, 'a'),
(2, 'Mango', 'mango.jpg', 2, 'a'),
(3, 'Beans', 'veg4.png', 1, 'a'),
(4, 'Cabbage', 'veg3.png', 1, 'a'),
(5, 'Beetroot', 'veg2.png', 1, 'a'),
(6, 'Carrot', 'veg1.png', 1, 'a'),
(7, 'Almond', 'Almond-3.jpg', 3, 'a'),
(8, 'Cashew', 'CASHEW.jpg', 3, 'a'),
(9, 'Dal', 'toor dal.png\r\n', 4, 'a'),
(10, 'Gram', 'Kala-chana.jpg', 4, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

CREATE TABLE `tbl_otp` (
  `otp_id` int(11) NOT NULL,
  `login_id` int(7) NOT NULL,
  `otp_time` varchar(20) NOT NULL,
  `otp_data` varchar(10) NOT NULL,
  `otp_random` varchar(61) NOT NULL,
  `otp_attempt` int(4) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wish_tbl`
--

CREATE TABLE `wish_tbl` (
  `wish_id` int(11) NOT NULL,
  `customerreg_id` int(11) NOT NULL,
  `ps_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerreg_tbl`
--
ALTER TABLE `customerreg_tbl`
  ADD PRIMARY KEY (`customerreg_id`);

--
-- Indexes for table `district_tbl`
--
ALTER TABLE `district_tbl`
  ADD PRIMARY KEY (`dist_id`);

--
-- Indexes for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `location_tbl`
--
ALTER TABLE `location_tbl`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `order_history_tbl`
--
ALTER TABLE `order_history_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_seller_tbl`
--
ALTER TABLE `product_seller_tbl`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sellerreg_tbl`
--
ALTER TABLE `sellerreg_tbl`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `seller_sales_tbl`
--
ALTER TABLE `seller_sales_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories_tbl`
--
ALTER TABLE `subcategories_tbl`
  ADD PRIMARY KEY (`subcat_id`);

--
-- Indexes for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `wish_tbl`
--
ALTER TABLE `wish_tbl`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customerreg_tbl`
--
ALTER TABLE `customerreg_tbl`
  MODIFY `customerreg_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `district_tbl`
--
ALTER TABLE `district_tbl`
  MODIFY `dist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `location_tbl`
--
ALTER TABLE `location_tbl`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `login_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_history_tbl`
--
ALTER TABLE `order_history_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_seller_tbl`
--
ALTER TABLE `product_seller_tbl`
  MODIFY `ps_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sellerreg_tbl`
--
ALTER TABLE `sellerreg_tbl`
  MODIFY `seller_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_sales_tbl`
--
ALTER TABLE `seller_sales_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories_tbl`
--
ALTER TABLE `subcategories_tbl`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wish_tbl`
--
ALTER TABLE `wish_tbl`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
