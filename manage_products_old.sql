-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2011 at 03:44 AM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manage_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `category_image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`) VALUES
(10, 'Computers', '2020-12-20-001650c1.jpeg'),
(11, 'Hardwares', 'hardware.jpeg'),
(13, 'Keyboards', 'keyboard.jpeg'),
(15, 'Mobiles', 'samsung.jpeg'),
(16, 'Watche materials', 'watches.jpeg'),
(19, 'Gold', 'gold.jpeg'),
(20, 'Silver', 'silver.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `sub_category_id` int(11) DEFAULT '0',
  `product_name` varchar(150) NOT NULL,
  `product_desc` text NOT NULL,
  `price` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `product_name`, `product_desc`, `price`) VALUES
(27, 10, 31, 'microsoft-vs-apple', '599 Ã— 311 - microsoft-vs-apple. Apple''s iPad and iPhone continue to drive the company''s', 7900),
(26, 10, 29, 'IBM ThinkPad 700', '400 Ã— 400 - The Essential CIO: Insights from IBM''s Global Chie', 6000),
(25, 10, 29, 'IBM invests Sh4 billo', '500 Ã— 375 - IBM invests Sh4 billon in partnership to grow cities', 8000),
(24, 10, 30, 'Lenovo Value Line G450', '428 Ã— 297 - Lenovo Value Line G450 2949B9Q Specifications, Review and Price', 9000),
(22, 10, 30, 'Lenovo-ideapad-u110-laptop', '430 Ã— 338 - lenovo-ideapad-u110-laptop The Lenovo Ideapad U110 laptop PC', 12000),
(23, 10, 30, 'Lenovo C300 30122EQ', '558 Ã— 426 - Lenovo C300 30122EQ All in One PC Specification', 10000),
(28, 10, 31, 'Microsoft Corp. will soon', 'Microsoft Corp. will soon let users of its Hotmail service store 5 gigabytes . Microsoft has filed an antitrust lawsuit against GoogleMicrosoft Corp. will soon let users of its Hotmail service store 5 gigabytes . Microsoft has filed an antitrust lawsuit against GoogleMicrosoft Corp. will soon let users of its Hotmail service store 5 gigabytes . Microsoft has filed an antitrust lawsuit against GoogleMicrosoft Corp. will soon let users of its Hotmail service store 5 gigabytes . Microsoft has filed an antitrust lawsuit against Google', 6000),
(29, 10, 31, 'Microsoft Windows 7 Ultimate', 'Microsoft Windows 7 Ultimate SP1 32-Bit - OEM. Product\r\nMicrosoft Windows 7 Home Premium SP1 32-Bit - OEM\r\nProduct Description For Microsoft Office Professional Plus\r\nMicrosoft Windows 7 Home Basic\r\n\r\n\r\nMicrosoft Windows 7 Ultimate SP1 32-Bit - OEM. Product Microsoft Windows 7 Home Premium SP1 32-Bit - OEM Product Description For Microsoft Office Professional Plus Microsoft Windows 7 Home Basic \r\n\r\nMicrosoft Windows 7 Ultimate SP1 32-Bit - OEM. Product Microsoft Windows 7 Home Premium SP1 32-Bit - OEM Product Description For Microsoft Office Professional Plus Microsoft Windows 7 Home Basic ', 6999),
(35, 10, 0, 'product without sub category 22 ', 'product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 product without sub category 22 ', 9809),
(34, 10, 0, 'product without sub category 1', 'product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  product without sub category 1 product without sub category 1  ', 5678);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `image_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`) VALUES
(110, 35, 'testp1.jpeg'),
(109, 34, 'testp.jpeg'),
(108, 29, 'microsoft1.jpeg'),
(107, 29, 'ms4-3.jpeg'),
(106, 29, 'ms4-2.jpeg'),
(105, 29, 'ms4-1.jpg'),
(104, 28, 'ms2-4.jpeg'),
(103, 28, 'ms2-3.jpeg'),
(102, 27, 'ms2-2.jpeg'),
(101, 28, 'ms2-1.jpeg'),
(100, 27, 'ms3.jpeg'),
(99, 27, 'ms2.jpeg'),
(98, 27, 'ms1.jpeg'),
(97, 26, 'ibm2-3.jpeg'),
(96, 26, 'ibm2-2.jpeg'),
(95, 26, 'ibm2-1.jpeg'),
(94, 25, 'ibm1-3.jpeg'),
(93, 25, 'ibm1-2.jpeg'),
(92, 25, 'ibm1-1.jpeg'),
(91, 24, 'l3-3.jpeg'),
(90, 24, 'l3-2.jpeg'),
(89, 24, 'l3-1.jpeg'),
(88, 23, 'l2-3.jpeg'),
(87, 23, 'l2-1.jpeg'),
(86, 23, 'l2.jpeg'),
(85, 22, 'l1-2.jpeg'),
(84, 22, 'l1-1.jpeg'),
(83, 22, '2020-12-19-232517c1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `sub_category_name` varchar(150) NOT NULL,
  `sub_image_name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `sub_category_name`, `sub_image_name`) VALUES
(33, 19, '24 carr', 'g1.jpeg'),
(32, 10, 'Networks', '2011-12-21-005244testp1.jpeg'),
(31, 10, 'Micro soft', 'computer.jpeg'),
(30, 10, 'Lenovo', 'c2.jpeg'),
(29, 10, 'IBM', 'c1.jpeg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
