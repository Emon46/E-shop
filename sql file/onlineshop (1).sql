-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2019 at 03:36 PM
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
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `shopusers`
--

DROP TABLE IF EXISTS `shopusers`;
CREATE TABLE IF NOT EXISTS `shopusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `cardnumber` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopusers`
--

INSERT INTO `shopusers` (`id`, `fullname`, `email`, `username`, `cardnumber`, `password`, `usertype`) VALUES
(1, 'zxc', 'hremon331046@gmail.com', '1234', '12345', '$2y$10$EMob8selBbXfjYV8veWDmOTCUKsB7canAkeITC.p.xI.6l5NIYJsO', 'customer'),
(2, 'zxc', 'emon@gmail.com', 'emon', '12345', '$2y$10$m5nm4txlq11omcpTSmvCTu4T2v3I89i9kDnhZ/fs2Akw8hy00Jm2S', 'customer'),
(3, 'GigaTech', 'gigatech@gmail.com', 'GigaTech', '67890', '$2y$10$m5nm4txlq11omcpTSmvCTu4T2v3I89i9kDnhZ/fs2Akw8hy00Jm2S', 'supplier'),
(4, 'admin', 'admin@gmail.com', 'admin', '123456789', '$2y$10$FZnGaADYMGKDfjTNzkcdPeCuKqnTIVQCdmAySR4TyyaUXeaF//OJC', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
