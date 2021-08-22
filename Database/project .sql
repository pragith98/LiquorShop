-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2020 at 05:01 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `cart_user_id` int(3) NOT NULL,
  `cart_product_id` int(3) NOT NULL,
  `cart_quentity` int(3) NOT NULL,
  `cart_total_price` int(10) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `cart_user_id` (`cart_user_id`),
  KEY `cart_product_id` (`cart_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notifi_id` int(3) NOT NULL AUTO_INCREMENT,
  `notifi_cust_id` int(3) NOT NULL,
  `notifi_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notifi_notice` varchar(50) NOT NULL,
  `notifi_status` varchar(20) NOT NULL,
  PRIMARY KEY (`notifi_id`),
  KEY `notifi_cust_id` (`notifi_cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(3) NOT NULL AUTO_INCREMENT,
  `order_user_id` int(3) NOT NULL,
  `order_product_id` int(3) NOT NULL,
  `order_quentity` int(2) NOT NULL,
  `order_total_price` int(10) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` varchar(20) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `order_user_id` (`order_user_id`),
  KEY `order_product_id` (`order_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(3) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_price` int(6) NOT NULL,
  `product_size` int(4) NOT NULL,
  `product_abv` varchar(5) NOT NULL,
  `product_description` varchar(800) NOT NULL,
  `product_image` varchar(500) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_brand`, `product_category`, `product_price`, `product_size`, `product_abv`, `product_description`, `product_image`) VALUES
(19, 'CHIVAS REGAL EXTRA', 'Chivas', 'Whiskey', 13100, 750, '40%', 'Selectively matured in Olorosso sherry casks, the Chivas Regal Extra has intense flavours coupled with a deep amber colour. The blended Scotch has aromas of pear and melon, cinnamon, milk chocolate, creamy toffee, with a dash of ginger. On the palate, one can taste sweet pears, cinnamon, and notes of vanilla with a rich, smooth finish.', 'Chivas-Regal-Extra.png'),
(20, 'DEWARS SPECIAL RESERVE 12 YEARS', 'Dewars', 'Whiskey', 11600, 750, '40%', 'Imported', 'Dewars-Special-Reserve-12-Years.png'),
(21, 'DEWARS WHITE LABEL WHISKEY', 'Dewars', 'Whiskey', 6700, 750, '40%', 'First crafted in 1899 and blended with 40 different scotch whiskies, the Dewarâ€™s White Label has a uniquely refreshing taste that makes it a perfect accompaniment to food. With notes of honey, peach, and citrus â€“ the whisky has a unique smoothness', 'Dewars-White-Label-Whisky.png'),
(22, 'GLENLIVET 12 YEARS', 'Glenlivet', 'Whiskey', 16800, 750, '40%', 'Made with the classic Glenlivet style â€“ first matured in traditional oak and then in American Oak casks, the Glenlivet 12 has a distinct smoothness coupled with summery aromas. The whisky has a well balanced palate and strong notes of pineapple.', 'Glenlivet-12-Years.png'),
(23, 'GLENLIVET FOUNDERS RESERVE', 'Glenlivet', 'Whiskey', 13000, 750, '40%', 'Inspired by the distillation methods of the founder George Smith, the Glenlivet Founders Reserve is crafted to emulate the first 1824 Glenlivet. Manufactured in copper stills designed by the founder, and matured in traditional oak casks, the Founderâ€™s Reserve has aromas of citrus and sweet oranges. Hints of orange, peat, toffee apple, and vanilla can be noticed on the palate.', 'Glenlivet-Founders-Reserve.png');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stock_product_id` int(10) NOT NULL,
  `stock_product_quentity` int(5) NOT NULL,
  PRIMARY KEY (`stock_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_first_name` varchar(30) NOT NULL,
  `user_last_name` varchar(30) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(10) NOT NULL,
  `user_nic` char(10) NOT NULL,
  `user_address_no` varchar(5) NOT NULL,
  `user_address_street` varchar(30) NOT NULL,
  `user_address_town` varchar(30) NOT NULL,
  `user_tp` char(10) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_nic` (`user_nic`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_first_name`, `user_last_name`, `user_name`, `user_password`, `user_nic`, `user_address_no`, `user_address_street`, `user_address_town`, `user_tp`, `user_email`) VALUES
(1, 'admin', 'admin', 'Admin', 'admin', '981982207v', '333', 'Matale', 'Matale', '0715408871', 'lakshanxp@hotmail.com'),
(6, 'test', 'user', 'user', 'user', '962323232v', '10', 'lake side', 'kandy', '0711111111', 'inne@gedara.com'),
(7, 'Pragith', 'Thilakarathna', 'pragith', '123', '887439873v', '10', 'main road', 'Matale', '094398549v', 'lakshanxp@hotmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cart_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`notifi_cust_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`stock_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
