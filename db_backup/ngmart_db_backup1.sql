-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2021 at 05:18 AM
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
-- Table structure for table `address_tbl`
--

CREATE TABLE `address_tbl` (
  `id` int(10) NOT NULL,
  `phone_no` int(15) NOT NULL,
  `pin_code` int(5) NOT NULL,
  `buliding_name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Dumping data for table `cart_tbl`
--

INSERT INTO `cart_tbl` (`cart_id`, `customerreg_id`, `ps_id`, `cart_qty`) VALUES
(4, 5, 9, 1),
(5, 5, 2, 1),
(6, 5, 12, 1),
(7, 5, 1, 1),
(9, 4, 4, 1),
(10, 4, 6, 1),
(11, 4, 12, 1),
(12, 4, 3, 1),
(27, 3, 10, 1),
(28, 3, 5, 3),
(29, 3, 2, 1),
(30, 3, 3, 2),
(33, 7, 2, 2),
(36, 7, 4, 1),
(37, 5, 3, 1),
(38, 5, 8, 1);

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
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerreg_tbl`
--

INSERT INTO `customerreg_tbl` (`customerreg_id`, `login_id`, `name`) VALUES
(1, 1, 'ann'),
(2, 2, 'annmary'),
(4, 10, 'cust'),
(5, 14, 'Anu Benoy'),
(6, 15, 'Saritha Robin'),
(7, 16, 'Mary Joseph');

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
(1, 'annmariya@gmail.com', '$2y$10$PXXFXXQOH2gbp0YtmcZwfO6Bfbl6IUTU0ovClqWaSyEkuzmOvryi6', 'customer', 1),
(2, 'annmary@gmail.com', '$2y$10$NgsmCE2DVnq1zwZ0eUZZQ.OYFtPbQi6Tn4/n4zTpTIGBDQ0oEhwSC', 'customer', 1),
(3, 'seller1@gmail.com', '$2y$10$LdiRJvDgyi0c1oZ.pqA/Y.CIZD/sCiYsrPWLLSl6WFUVVpQv1cLM6', 'seller', 1),
(4, 'admin@gmail.com', '$2y$10$kaSJU7blJt88aZXKF0lV/eA0ybVQEU/xUtYMtasjwTItSjVHdLGOO', 'admin', 1),
(5, 'seller2@gmail.com', '$2y$10$xD34Zf.k1x6wpz3VqN0kR.eDFr/3KptlPaiF1.K1t3semBnGrsxaS', 'seller', 1),
(7, 'admin2@gmail.com', '$2y$10$NgsmCE2DVnq1zwZ0eUZZQ.OYFtPbQi6Tn4/n4zTpTIGBDQ0oEhwSC', 'admin', 1),
(8, 'admin3@gmail.com', '$2y$10$DOouZ4J2R7J6.ajzLgzYIeBrnXIvEaa5Wq7tWGNAdMAjTYH2kVKki', 'admin', 1),
(9, 'seller@gmail.com', '$2y$10$18NTm5Wu.AOiTjJvqEdeA.9n/PWcwsRyMmK4d0jhW3jk.A68Y/bry', 'seller', 1),
(10, 'customer1@gmail.com', '$2y$10$P2pu2CGMlyjS7mZMZZKWzOU1wD8kCK4gfBOELrfj8QRudFIHJ78YW', 'customer', 1),
(11, 'admin1@gmail.com', '$2y$10$whZol46ig1krOdYKi2vfdO9CSCQIYy1Z8YXDaNEZ0PCBbb6GIr5RC', 'admin', 1),
(12, 'seller3@gmail.com', '$2y$10$zs2qxrpWxe9O8Is..m0kNe5ijVFzBSfH15RnqoeC69zTmu8k4zs0W', 'seller', 1),
(13, 'seller4@gmail.com', '$2y$10$j8KTmCpNximlNZFifkpSzOT6.U65cE9rgkmQ4pM3xFqVko50r8Sam', 'seller', 1),
(14, 'customer@gmail.com', '$2y$10$rxkUD7hkuFpsKRdyQnQPCeUWLRwAt7wt4JHzIrp6x5.0OdhPpaGLO', 'customer', 1),
(15, 'saritha@gmail.com', '$2y$10$oUtBkg6IO4p6jaUvYifDTeKsI0lhWX4Np14qVr98QXdMU.r9400.i', 'customer', 1),
(16, 'mary@gmail.com', '$2y$10$ZQi1Pt8hOtvWkVVAg6iEH.G8VTk65O4vH75TF2Lfrvc7A/n1U6VFG', 'customer', 1),
(17, 'seller5@gmail.com', '$2y$10$OXS1hNJ7Ef8ZhA2VJUUlvuHcQGEYGhWxRsgIIS6mYQnavX/NNkH7C', 'seller', 1);

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
  `seller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_seller_tbl`
--

INSERT INTO `product_seller_tbl` (`ps_id`, `seller_id`, `product_id`, `price`, `qty`, `image`, `short_desc`, `status`) VALUES
(1, 9, 1, '20.00', '50.00', 'veg1.png', 'crunchy carrots', 1),
(2, 9, 2, '10.00', '20.00', 'Apple.jpg', 'juicy crunchy apples', 1),
(3, 9, 3, '100.00', '500.00', 'pista.jpg', 'pistachos', 1),
(4, 9, 4, '30.00', '40.00', 'toor dal.png', 'protein rich', 1),
(5, 12, 5, '30.00', '10.00', 'veg2.png', 'Fresh vegies', 1),
(6, 12, 6, '20.00', '10.00', 'veg3.png', 'Fresh vegies', 1),
(7, 12, 7, '10.00', '50.00', 'Kala-chana.jpg', 'protein rich', 1),
(8, 12, 8, '40.00', '10.00', 'mango.jpg', 'juicy mangoes', 1),
(9, 9, 9, '10.00', '30.00', 'veg4.png', 'Fresh vegies', 1),
(10, 9, 10, '50.00', '80.00', 'Almond-3.jpg', 'Crunchy Nuts', 1),
(11, 12, 9, '9.00', '10.00', 'veg4.png', 'Fresh vegies', 1),
(12, 12, 11, '60.00', '30.00', 'CASHEW.jpg', 'Right from farm', 1),
(13, 9, 5, '30.00', '20.00', 'veg2.png', 'rich in iron.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `categories_id`, `name`) VALUES
(1, 1, 'Carrot'),
(2, 2, 'Apple'),
(3, 3, 'In-Shell Pistachios'),
(4, 4, 'Bengal Gram'),
(5, 1, 'Beetroot'),
(6, 1, 'Cabbage'),
(7, 4, 'Amar-Gram'),
(8, 2, 'Alphonsa Mango'),
(9, 1, 'Beans'),
(10, 3, 'Almonds'),
(11, 3, 'Cashew'),
(12, 1, 'Gram'),
(13, 2, 'Mango');

-- --------------------------------------------------------

--
-- Table structure for table `sellerreg_tbl`
--

CREATE TABLE `sellerreg_tbl` (
  `seller_id` int(8) NOT NULL,
  `login_id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `time_1` varchar(30) NOT NULL DEFAULT '09:00',
  `time_2` varchar(30) NOT NULL DEFAULT '20:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerreg_tbl`
--

INSERT INTO `sellerreg_tbl` (`seller_id`, `login_id`, `name`, `time_1`, `time_2`) VALUES
(1, 3, 'seller two', '15:06', '17:07'),
(5, 9, 'seller three', '09:00', '20:00'),
(6, 12, 'seller four', '09:00', '20:00'),
(7, 13, 'seller four', '09:00', '20:00'),
(8, 17, 'seller five', '09:00', '20:00');

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
-- Table structure for table `wish_tbl`
--

CREATE TABLE `wish_tbl` (
  `wish_id` int(11) NOT NULL,
  `customerreg_id` int(11) NOT NULL,
  `ps_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wish_tbl`
--

INSERT INTO `wish_tbl` (`wish_id`, `customerreg_id`, `ps_id`) VALUES
(1, 3, 6),
(6, 3, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_tbl`
--
ALTER TABLE `address_tbl`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `wish_tbl`
--
ALTER TABLE `wish_tbl`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_tbl`
--
ALTER TABLE `address_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customerreg_tbl`
--
ALTER TABLE `customerreg_tbl`
  MODIFY `customerreg_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `login_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `ps_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sellerreg_tbl`
--
ALTER TABLE `sellerreg_tbl`
  MODIFY `seller_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seller_sales_tbl`
--
ALTER TABLE `seller_sales_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wish_tbl`
--
ALTER TABLE `wish_tbl`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
