-- phpMyAdmin SQL Dump
-- version 5.0.4deb2~bpo10+1+focal1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2021 at 11:53 AM
-- Server version: 10.5.9-MariaDB-1:10.5.9+maria~bionic
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodiadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`) VALUES
(1, 'Foods', 'Main Food for Breakfast & Lunch or Dinner'),
(2, 'Drinks', 'Main Drinks for Foods'),
(3, 'Snacks', 'A snack is a small portion of food generally eaten between meals.'),
(4, 'Desserts', 'Dessert is a course that concludes a meal. The course consists of sweet foods, such as confections, and possibly a beverage such as dessert wine and liqueur.');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `fax` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `google` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `title`, `description`, `address`, `phone`, `fax`, `email`, `logo`, `facebook`, `twitter`, `google`, `linkedin`, `youtube`) VALUES
(1, 'PT Galatia Expressindo', 'PT Galatia Expressindo', 'Ujum Menteng Bussines Centre Blok C&amp;amp;amp;#45;22 Jl Sri Sultan Hamengkubuwono Jakarta 13960', '+6221 4680 2245', '', 'info@galatiaexpessindo.co.id', 'ProductLogo.jpg', '#', '#', '#', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` varchar(10) NOT NULL,
  `cust_joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `cust_fullname` varchar(100) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `cust_address` text NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_joined`, `cust_fullname`, `cust_phone`, `cust_address`, `cust_city`, `cust_desc`) VALUES
('CS-001', '2021-07-10 04:56:11', 'Agah Nata', '+6288888888', 'Jl.Taman Sawangan Residence Blok A, no.1', 'Depok', ''),
('CS-002', '2021-07-10 04:56:11', 'Angel Lewis', '+6299999999', 'Jl. Pembangunan No.49', 'Jakarta', ''),
('CS-003', '2021-07-10 04:56:11', 'Nora Blake', '+6277777777', 'Jl. Soekarno Hatta 45', 'Jakarta', ''),
('CS-004', '2021-07-10 04:56:11', 'Benjamin Gonzales', '+6299999999', 'Jl. Taman Melati Blok C, No. 11', 'Depok', ''),
('CS-005', '2021-07-12 07:00:39', 'Haylet Williams', '+66666666', 'Jl. Bung Karno, no 21', 'Jakarta', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` varchar(10) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_price` decimal(15,2) NOT NULL,
  `item_stock` int(11) NOT NULL,
  `item_image` varchar(100) NOT NULL,
  `item_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `cat_id`, `item_name`, `item_price`, `item_stock`, `item_image`, `item_desc`) VALUES
('FD-001', 1, 'Nasi Goreng Pedas', '20000.00', 0, 'nasi-goreng-pedas.jpeg', 'Resep nasi goreng super pedas istimewa.'),
('FD-002', 1, 'Mie Ayam Bakso', '15000.00', 0, 'mie-ayam-bakso.jpg', 'Mie ayam bakso merupakan olahan mie ayam yang dibuat dengan menambahkan bakso ke dalam resepnya.'),
('FD-003', 1, 'Creamy Mie Bakso', '15000.00', 0, 'creamy-mie-bakso.jpg', 'Creamy Mie Bakso. This mie bakso Indonesian meatball soup is quick and easy to make.'),
('FD-004', 1, 'Salad Sayur Mayonaise', '15000.00', 0, 'salad-sayur-mayonaise.jpg', 'Salad Sayur ini sering dijumpai di Resto Masakan Jepang.'),
('DN-001', 2, 'Manggo jelly milk ice', '20000.00', 0, 'manggo-jelly-milk-ice.jpg', 'Minuman spesial dari nutrijel mangga.'),
('DN-002', 2, 'Es thai tea', '15000.00', 0, 'es-thai-tea.jpg', 'Thai ice tea dgn susu bubuk creamer.'),
('DN-003', 2, 'Es jeruk sirup melon', '15000.00', 0, 'es-jeruk-sirup-melon.jpg', 'Es jeruk melon dgn Nata De Coco.'),
('DN-004', 2, 'King manggo thai', '15000.00', 0, 'king-manggo-thai.jpg', 'Sari buah mangga aseli & whipped cream bubuk.'),
('SN-001', 3, 'Snack Mi Lidi Mih Iteung', '15000.00', 50, 'Mi-Lidi-Mih-Iteung.jpg', 'Produk satu ini memadukan pasta dan bumbu rempah berlimpah spesial Banjar untuk menghasilkan camilan bertekstur renyah dan garing.'),
('SN-002', 3, 'Snack Lay’s Nori Seaweed Flavor', '10000.00', 50, 'Lays-Nori-Seaweed-Flavor.jpg', 'Lay’s adalah merek chiki keluaran Indofood yang digemari banyak orang. '),
('SN-003', 3, 'Snack Cheetos Puffs BBQ Steak Flavor', '15000.00', 50, 'Cheetos-Puffs-BBQ-Steak-Flavor.jpg', 'Cheetos Puffs BBQ Steak Flavor terbuat dari jagung yang diolah menjadi bentuk stik yang tidak hanya renyah, tetapi juga gurih dan nikmat.'),
('SN-004', 3, 'Snack Ei Salted Egg Crispy Chicken Skin', '15000.00', 50, 'Ei-Salted-Egg-Crispy-Chicken-Skin.jpg', 'Produk ini terbuat dari kulit ayam garing yang diberi bumbu telur asin. '),
('DS-001', 4, 'Japanese Fluffy Pancake', '20000.00', 50, 'japanese-fluffy-pancake.jpg', 'Pancake (panekuk) identik dinikmati sebagai menu sarapan di negara-negara barat. '),
('DS-002', 4, 'Ragusa Es Italia', '20000.00', 0, 'ragusa-es-italia.jpg', 'es krim legendaris yang sudah eksis di Jakarta sejak tahun 1932, Ragusa Es Italia'),
('FD-005', 1, 'Es thai tea', '1000.00', 1, 'no_image.jpg', 'Described');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notif_time` datetime NOT NULL DEFAULT current_timestamp(),
  `notif_msg` varchar(100) NOT NULL,
  `notif_read` tinyint(1) NOT NULL,
  `notif_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notif_time`, `notif_msg`, `notif_read`, `notif_desc`) VALUES
(1, '2021-07-08 04:13:42', 'Current Order status is \"Completed\"', 0, 'Order using Cash on Delivery (COD).'),
(2, '2021-07-08 06:04:08', 'Current Order status is \"Awaiting Payment\"', 0, 'The order has not yet been paid.  a customer selects a payment method like Pay by invoice (Online Transfer).'),
(3, '2021-07-08 06:08:34', 'Current Order status is \"Canceled\"', 0, 'This status means the order has been manually cancelled.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(10) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(100) NOT NULL,
  `cust_id` varchar(10) NOT NULL,
  `order_sales` decimal(15,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `order_status`, `cust_id`, `order_sales`) VALUES
('PO-001', '2021-07-12 16:20:15', 'Pending Payment', 'CS-002', '55000.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_det`
--

CREATE TABLE `order_det` (
  `order_id` varchar(10) NOT NULL,
  `item_id` varchar(10) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_det`
--

INSERT INTO `order_det` (`order_id`, `item_id`, `item_qty`, `price`) VALUES
('PO-001', 'FD-001', 2, '40000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `user_login` varchar(50) DEFAULT NULL,
  `user_fullname` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_pass` varchar(50) DEFAULT NULL,
  `user_joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `user_login`, `user_fullname`, `user_email`, `user_pass`, `user_joined`, `user_status`) VALUES
(1, 'admin', 'administrator', 'admin@example.com', '21232f297a57a5a743894a0e4a801fc3', '2018-08-30 03:00:00', 1),
(2, 'nath4n', 'Agah Nata', 'admin@foodia.com', '21232f297a57a5a743894a0e4a801fc3', '2018-09-05 19:33:03', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`,`cat_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_det`
--
ALTER TABLE `order_det`
  ADD PRIMARY KEY (`order_id`,`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
