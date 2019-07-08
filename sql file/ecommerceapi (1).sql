-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2019 at 03:35 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerceapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cardnumber` varchar(500) NOT NULL,
  `cardpassword` varchar(500) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `cardnumber`, `cardpassword`, `balance`) VALUES
(1, 'emon', '12345', '12345', 11575),
(2, 'supplier', '67890', '12345', 11475),
(3, 'ecommercesite', '123456789', '12345', 3440);

-- --------------------------------------------------------

--
-- Table structure for table `bankrecords`
--

DROP TABLE IF EXISTS `bankrecords`;
CREATE TABLE IF NOT EXISTS `bankrecords` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver` varchar(40) NOT NULL,
  `sender` varchar(40) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankrecords`
--

INSERT INTO `bankrecords` (`transaction_id`, `receiver`, `sender`, `amount`) VALUES
(1, 'sh', 'cdjh', 25),
(2, 'ghghh', 'cdjh', 25),
(3, '67890', '12345', 100),
(4, '123456789', '12345', 100),
(5, '67890', '12345', 125),
(6, '123456789', '12345', 100);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `todelivername` varchar(100) NOT NULL,
  `deliveryadress` varchar(100) NOT NULL,
  `delivertonumber` varchar(100) NOT NULL,
  `pendrive_quantity` int(11) NOT NULL,
  `mouse_quantity` int(11) NOT NULL,
  `keyboard_quantity` int(11) NOT NULL,
  `delivered` int(11) NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `todelivername`, `deliveryadress`, `delivertonumber`, `pendrive_quantity`, `mouse_quantity`, `keyboard_quantity`, `delivered`) VALUES
(22, 'testinhnae', 'sylhet', '12345', 1, 1, 1, 1),
(21, 'demo', 'demo', 'demo', 1, 2, 3, 0),
(5, 'Rd demo app', 'dfv', '12', 1, 1, 1, 1),
(23, 'testqq', 'testqq', 'testqq', 1, 2, 1, 0),
(11, 'emon', '123', '01787348478', 2, 2, 1, 1),
(12, 'emon', '123', '01787348478', 1, 1, 1, 0),
(13, 'emon', '123', '01787348478', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(40) COLLATE latin1_bin NOT NULL,
  `price_per_unit` int(11) NOT NULL,
  `quantity_available` int(11) NOT NULL,
  `brand_name` varchar(100) COLLATE latin1_bin NOT NULL,
  `supplier` varchar(100) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price_per_unit`, `quantity_available`, `brand_name`, `supplier`) VALUES
(1, 'pendrive', 40, 121, 'Samsung', 'GigaTech'),
(2, 'mouse', 25, 124, 'A4tech', 'GigaTech'),
(3, 'keyboard', 35, 117, 'A4tech', 'GigaTech');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
