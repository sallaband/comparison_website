-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2017 at 06:42 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(12) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_pass` varchar(35) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_doj` date NOT NULL,
  `user_dob` date NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_country` varchar(150) NOT NULL,
  `user_state` varchar(150) NOT NULL,
  `user_city` varchar(150) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_mobile` varchar(12) NOT NULL,
  `user_salary` float NOT NULL,
  `user_datacat` varchar(255) NOT NULL,
  `user_datacity` varchar(100) NOT NULL,
  `user_type` int(1) NOT NULL COMMENT '0- admin, 1- sub admin, 2- telecallers, 3- marketing',
  `user_lastlogin` datetime NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_code`, `user_id`, `user_pass`, `user_fname`, `user_lname`, `user_doj`, `user_dob`, `user_gender`, `user_address`, `user_country`, `user_state`, `user_city`, `user_email`, `user_mobile`, `user_salary`, `user_datacat`, `user_datacity`, `user_type`, `user_lastlogin`, `user_ip`, `user_status`) VALUES
(1, 'A0001', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '', '2017-03-09', '2017-03-09', 'M', '123 street, abc road', '', '', '', 'admin@admin.com', '9876543210', 0, '', '', 0, '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_type` int(11) NOT NULL COMMENT '0) city, 1) state',
  `cat_parent` int(11) NOT NULL DEFAULT '0',
  `cat_slug` varchar(255) NOT NULL,
  `cat_home` int(11) NOT NULL,
  `cat_status` tinyint(4) NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_type`, `cat_parent`, `cat_slug`, `cat_home`, `cat_status`, `create_date`) VALUES
(1, 'FiltersCamera Accessories', 0, 10, 'filterscamera-accessories', 0, 1, '2017-07-11 12:34:08'),
(2, 'Battery ChargersCamera Accessories', 0, 10, 'battery-chargerscamera-accessories', 0, 0, '2017-07-21 00:12:01'),
(3, 'Sports & Action Cameras', 0, 7, 'sports-action-cameras', 0, 1, '2017-07-11 12:35:51'),
(4, 'Digital Photo FramesShop', 0, 0, 'digital-photo-framesshop', 0, 1, '2017-07-11 12:34:58'),
(5, 'Camera Bags & CasesCamera Accessories', 0, 10, 'camera-bags-casescamera-accessories', 0, 1, '2017-07-11 12:33:23'),
(6, 'Digital Cameras', 0, 7, 'digital-cameras', 0, 1, '2017-07-21 00:00:28'),
(7, 'Cameras', 0, 0, 'cameras', 0, 1, '2017-07-11 12:29:18'),
(8, 'Shop Camera Accessories', 0, 10, 'shop-camera-accessories', 0, 1, '2017-07-11 12:32:44'),
(9, 'Tripods & HeadsCamera Accessories', 0, 10, 'tripods-headscamera-accessories', 0, 1, '2017-07-11 12:33:06'),
(10, 'Camera Accessories', 0, 7, 'camera-accessories', 0, 1, '2017-07-11 12:35:51'),
(11, 'LensesShop', 0, 0, 'lensesshop', 0, 1, '2017-07-11 12:35:51'),
(12, 'Shop Cameras', 0, 7, 'shop-cameras', 0, 1, '2017-07-11 12:35:51'),
(13, 'DSLR''s Cameras', 0, 7, 'dslrs-cameras', 1, 1, '2017-07-21 00:12:01'),
(14, 'Flash GunsCamera Accessories', 0, 10, 'flash-gunscamera-accessories', 0, 1, '2017-07-11 12:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `customfields`
--

CREATE TABLE IF NOT EXISTS `customfields` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `c_label` varchar(50) NOT NULL,
  `c_value` varchar(50) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customfields`
--

INSERT INTO `customfields` (`c_id`, `p_id`, `c_label`, `c_value`) VALUES
(3, 7, '772', '7712'),
(4, 7, '882', '8812'),
(5, 7, '99', '991'),
(6, 5, 'Camera', '15MP'),
(7, 5, 'Front Camera', '8Mp'),
(8, 3, 'Camera', '8MP'),
(9, 3, 'Front Camera', '5MP');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `p_title` varchar(100) NOT NULL,
  `p_slug` varchar(100) NOT NULL,
  `p_size` varchar(50) NOT NULL,
  `p_weight` varchar(50) NOT NULL,
  `p_processor` varchar(255) NOT NULL,
  `p_battery` varchar(100) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_image` varchar(100) NOT NULL,
  `p_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `cat_id`, `p_title`, `p_slug`, `p_size`, `p_weight`, `p_processor`, `p_battery`, `p_price`, `p_image`, `p_status`) VALUES
(3, 13, 'Nexus 5X', 'nexus-5x', '5.2', '136 g', '1.44 GHz, Quad Core, Qualcomm Snapdragon 808', '2700 mAH', 50, 'img-3nexus5x.jpg', 1),
(4, 13, 'Nexus 6P', 'nexus-6p', '5.7', '178 g', '1.55 GHz, Octa Core, Qualcomm Snapdragon 810 ', '3450 mAH', 0, 'img-4nexus6p.jpg', 1),
(5, 13, 'Nexus 5', 'nexus-5', '4.9', '130 g', '2.3 GHz, Quad Core, Qualcomm Snapdragon 800', '2300 mAH', 100, 'img-5nexus5.jpg', 1),
(6, 13, 'Nexus 6', 'nexus-6', '6', '184 g', '2.7 GHz, Quad Core, Qualcomm Snapdragon 805', '3220 mAH', 0, 'img-6nexus6.jpg', 1),
(7, 6, '11', '11', '22', '33', '44', '55', 66, '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
