-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2012 at 06:33 AM
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
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `pass_word` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `category_image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`) VALUES
(25, 'Laptops', 'hardware.jpg'),
(26, 'Holiday', 'ms4-20.jpeg'),
(11, 'Hardware', 'hardware.jpeg'),
(13, 'Keyboards', 'keyboard.jpeg'),
(15, 'Mobiles', 'samsung.jpeg'),
(16, 'Watches', 'watches.jpeg'),
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `product_name`, `product_desc`, `price`) VALUES
(27, 11, 31, 'microsoft-vs-apple', '599 Ã— 311 - microsoft-vs-apple. Apple''s iPad and iPhone continue to drive the company''s', 7900),
(26, 25, 29, 'IBM ThinkPad 700', '400 Ã— 400 - The Essential CIO: Insights from IBM''s Global Chie', 6000),
(25, 25, 29, 'IBM invests Sh4 billo', '500 Ã— 375 - IBM invests Sh4 billon in partnership to grow cities', 8000),
(24, 25, 30, 'Lenovo Value Line G450', '428 Ã— 297 - Lenovo Value Line G450 2949B9Q Specifications, Review and Price', 9000),
(22, 25, 30, 'Lenovo-ideapad-u110-laptop', '430 Ã— 338 - lenovo-ideapad-u110-laptop The Lenovo Ideapad U110 laptop PC', 12000),
(23, 25, 30, 'Lenovo C300 30122EQ', '558 Ã— 426 - Lenovo C300 30122EQ All in One PC Specification', 10000),
(28, 11, 31, 'Microsoft Corp. will soon', 'Microsoft Corp. will soon let users of its Hotmail service store 5 gigabytes . ', 6000),
(29, 11, 31, 'Microsoft Windows 7 Ultimate', 'Microsoft Windows 7 Ultimate SP1 32-Bit - OEM.', 6999),
(41, 15, 36, 'Nokia Lumia 800', 'NokiaLumia 800 to your loved ones this #NewYear. Get it from your nearest Nokia store\r\nNokia Maps team would like to know how you feel about Maps and Drive voice navigation. Answer the survey here: http://t.co/bot1XiUg', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `image_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`) VALUES
(130, 41, 'nokialumia20.jpeg'),
(129, 41, 'nokialumia10.jpeg'),
(128, 41, 'nokialumia0.jpeg'),
(127, 27, '2006_YAMAHA_YZF-R1SP_40.jpg'),
(126, 23, 'microsoft10.jpeg'),
(125, 27, 'History10.png'),
(124, 23, 'lenovo_new21.jpeg'),
(123, 23, 'lenovo_new40.jpeg'),
(122, 23, 'lenovo_new30.jpeg'),
(121, 23, 'lenovo_new20.jpeg'),
(120, 23, 'lenovo_new10.jpeg'),
(117, 27, 'ms10.jpeg'),
(118, 27, 'computer3.jpeg'),
(119, 27, 'hardware0.jpeg'),
(116, 26, 'ibm2-20.jpeg'),
(115, 26, 'ibm1-30.jpeg'),
(108, 29, 'new_png1.png'),
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `sub_category_name`, `sub_image_name`) VALUES
(36, 15, 'Nokia', 'nokia0.jpeg'),
(34, 19, 'KMD', 'kmd0.jpeg'),
(33, 19, '24 Carat', '24carat0.jpeg'),
(35, 15, 'Samsung', 'samsung0.jpeg'),
(32, 16, 'Networks', 'watch10.jpeg'),
(31, 11, 'Micro soft', 'computer.jpeg'),
(30, 25, 'Lenovo', 'c2.jpeg'),
(29, 25, 'IBM', 'c1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `pass_word` varchar(100) NOT NULL,
  `profile_image` varchar(200) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email_address`, `pass_word`, `profile_image`, `user_type`, `created_date`) VALUES
(1, 'shiva v efsd fsdf sd fsdfsdfdsf', 'admin@camosolutions.com', 'admin', '', 2, '2011-12-27 00:00:00'),
(2, 'shankar', 'shiva.rdry1@gmail.com', 'shiva1234', '', 1, '2011-12-27 00:00:00'),
(3, 'shiva shankar test 123', 'test@camosolutions.com', 'ff87ad09bbabaa6a45ae0bf2676a6f61c093f3a9', 'good_place1.jpg', 1, '2011-12-27 00:00:00'),
(4, 'shivareddy', 'shiva@shiva.com', 'd7e5c6fedd3a30d7cae979301f04c9492a912d0c', '', 1, '0000-00-00 00:00:00'),
(5, 'hari', 'hari@hari.com', '970b39f80971b50104f42a7a63e5377324c235c4', '', 1, '0000-00-00 00:00:00'),
(6, 'hari1', 'hari1@hari.com', '970b39f80971b50104f42a7a63e5377324c235c4', '', 1, '0000-00-00 00:00:00'),
(7, 'fsdfsd', 'ss@ss.com', '219220d1a279cf4d41b7d5d111753100c0d2d930', '', 1, '0000-00-00 00:00:00'),
(8, 'fsdfsd', 'ss22@ss.com', '219220d1a279cf4d41b7d5d111753100c0d2d930', '', 1, '0000-00-00 00:00:00'),
(9, 'sdfd', 'sd@d.com', '3495005052499922539f5de55d739af552009eeb', '', 1, '0000-00-00 00:00:00'),
(10, 'tr', 'gf@qwq.com', 'a4ca79b12e9a1aa397a7dea9b2eb2cd8d3f09d0f', '', 1, '0000-00-00 00:00:00'),
(11, 'tr', 'gf66@qwq.com', 'a4ca79b12e9a1aa397a7dea9b2eb2cd8d3f09d0f', '', 1, '0000-00-00 00:00:00'),
(12, 'tr', 'gf6336@qwq.com', 'a4ca79b12e9a1aa397a7dea9b2eb2cd8d3f09d0f', '', 1, '0000-00-00 00:00:00'),
(13, 'tr', 'gf63356@qwq.com', 'a4ca79b12e9a1aa397a7dea9b2eb2cd8d3f09d0f', '', 1, '0000-00-00 00:00:00'),
(14, 'tr', 'gf633516@qwq.com', 'a4ca79b12e9a1aa397a7dea9b2eb2cd8d3f09d0f', '', 1, '0000-00-00 00:00:00'),
(15, 'fsd', 'ss@qq.com', 'a47d0676af1c0bd9ed3cf2f96f9888ec538724ec', '', 1, '0000-00-00 00:00:00'),
(16, 'fsd', 'ss55@qq.com', 'a47d0676af1c0bd9ed3cf2f96f9888ec538724ec', '', 1, '0000-00-00 00:00:00'),
(17, 'fsd', 'ss515@qq.com', 'a47d0676af1c0bd9ed3cf2f96f9888ec538724ec', '', 1, '0000-00-00 00:00:00'),
(18, 'rama', 'rama@rama.com', '03295461946b9e80ced11bbd8a9bb33a88ae1f35', '', 1, '0000-00-00 00:00:00'),
(19, 'gggg', 'g@g.com', '2b5863168c543cbb7852321727392bc99ad15604', '', 1, '0000-00-00 00:00:00'),
(20, 'fsdfsdf', 't@t.com', 'f5cbd1fb65045f4cff4d064f278c1fb9ad2c9878', '', 1, '0000-00-00 00:00:00'),
(21, 'dsf sdf', 'ty@ret.com', 'bc69f09b44823b56c7c3ef797eb3d5eacb2ec7d6', '', 1, '0000-00-00 00:00:00'),
(22, 'fdsf', '67@d.com', 'ff87ad09bbabaa6a45ae0bf2676a6f61c093f3a9', '', 1, '2011-12-28 00:59:33'),
(23, 'fdsf', '67uu@d.com', 'ff87ad09bbabaa6a45ae0bf2676a6f61c093f3a9', '', 1, '0000-00-00 00:00:00'),
(24, 'vinay', 'vinay.kumar@camosolutions.net', 'c2ff09441de90903c34780a8543b0ab89a4825d3', '', 1, '0000-00-00 00:00:00'),
(32, 'Shiva Shankar rdry', 'shiva.rdry2@gmail.com', '036df05d2ca2e0090d78b67e04e71bac55eb05dd', '', 1, '2012-01-03 07:34:29'),
(29, 'Shiva Shankar avail', 'shiva.avail@gmail.com', 'e0fa21eb1d06c26085203004726a72a6713178e7', 'g40.jpeg', 1, '2012-01-03 07:13:41'),
(33, 'Shiva Shankar', 'shiva.rdry@gmail.com', '036df05d2ca2e0090d78b67e04e71bac55eb05dd', 'facebook4.jpeg', 1, '2012-01-04 03:21:41');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
