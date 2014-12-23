-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2014 at 07:42 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cane_accounts`
--

CREATE TABLE IF NOT EXISTS `cane_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(250) NOT NULL,
  `op_balance` decimal(10,0) DEFAULT NULL,
  `op_balance_dc` varchar(50) NOT NULL,
  `op_date` date NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `acc_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `cane_accounts`
--

INSERT INTO `cane_accounts` (`id`, `account_name`, `op_balance`, `op_balance_dc`, `op_date`, `parent_id`, `acc_type`) VALUES
(1, 'Cash', '0', 'D', '2012-12-25', NULL, 1),
(2, 'Sales', '0', 'C', '2012-12-25', NULL, NULL),
(3, 'Purchase', '0', 'D', '2012-12-25', NULL, NULL),
(4, 'Cost of Goods Sold', '0', 'D', '2012-12-25', NULL, NULL),
(5, 'Sales Return', '0', 'D', '2012-12-25', NULL, NULL),
(6, 'Capital', '0', 'C', '2012-12-25', NULL, NULL),
(7, 'Widthdraw', '0', 'D', '2012-12-25', NULL, NULL),
(8, 'Purchase Return', '0', 'C', '2012-12-25', NULL, NULL),
(9, 'Received With Cheque', '0', 'D', '2012-12-25', NULL, 5),
(10, 'Received Cheque Dishonor', '0', 'D', '2012-12-25', NULL, 6),
(11, 'Received Cheque Cancelled', '0', 'D', '2012-12-25', NULL, NULL),
(12, 'Income From Other Sources', '0', 'C', '2012-12-25', NULL, NULL),
(13, 'Paid with Cheque', '0', 'D', '2012-12-25', NULL, NULL),
(14, 'Canceled Paid Cheque', '0', 'D', '2012-12-25', NULL, NULL),
(15, 'Paid Cheque Dishonor', '0', 'D', '2012-12-25', NULL, NULL),
(16, 'Investment', '0', 'D', '2012-12-25', NULL, NULL),
(17, 'Additional Captial', '0', 'C', '2012-12-25', NULL, NULL),
(18, 'Sales Rebate', '0', 'D', '2012-12-25', NULL, NULL),
(23, 'Dutch Bangla Bank-Mr. X', '10000', 'D', '0000-00-00', 1, 2),
(24, 'Computer Source', '6000', 'D', '2014-01-15', 3, 3),
(25, 'Microsft Corporation', '-3000', 'D', '2013-01-14', 4, 3),
(26, 'Brac Bank-Mr. AX', '5600', 'D', '2014-03-19', 2, 2),
(27, 'Boom', '-1000', 'D', '2014-02-28', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cane_account_types`
--

CREATE TABLE IF NOT EXISTS `cane_account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cane_account_types`
--

INSERT INTO `cane_account_types` (`id`, `label`) VALUES
(1, 'cash'),
(2, 'bank'),
(3, 'party account'),
(5, 'cheque'),
(6, 'dishonored cheque'),
(7, 'Expense Accounts');

-- --------------------------------------------------------

--
-- Table structure for table `cane_admin`
--

CREATE TABLE IF NOT EXISTS `cane_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `admin_name` varchar(300) NOT NULL,
  `admin_email` varchar(300) NOT NULL,
  `admin_pass` varchar(300) NOT NULL,
  `admin_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_status` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cane_admin`
--

INSERT INTO `cane_admin` (`admin_id`, `level`, `admin_name`, `admin_email`, `admin_pass`, `admin_last_login`, `admin_status`) VALUES
(1, 1, 'Mahbub', 'srijon00@yahoo.com', 'd0e23f5dedeb21109759f015e99564652daba331', '2014-12-23 13:41:52', 1),
(3, 1, 'Asim', 'asim4200@yahoo.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2013-01-06 05:32:54', 1),
(4, 1, 'Mr. Kaif', 'kaiftrade@yahoo.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2013-03-28 06:21:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_admin_level`
--

CREATE TABLE IF NOT EXISTS `cane_admin_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(155) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cane_admin_level`
--

INSERT INTO `cane_admin_level` (`level_id`, `level_name`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'Sales Person');

-- --------------------------------------------------------

--
-- Table structure for table `cane_bank`
--

CREATE TABLE IF NOT EXISTS `cane_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cane_bank`
--

INSERT INTO `cane_bank` (`bank_id`, `bank_name`, `account_name`, `account_number`) VALUES
(1, 'Dutch Bangla Bank', 'Mr. X', '23344559'),
(2, 'Brac Bank', 'Mr. AX', '2394586');

-- --------------------------------------------------------

--
-- Table structure for table `cane_brand`
--

CREATE TABLE IF NOT EXISTS `cane_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(300) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `cane_brand`
--

INSERT INTO `cane_brand` (`brand_id`, `brand_name`) VALUES
(14, 'Samsungs'),
(15, 'BMW'),
(16, 'Square Pharma'),
(17, 'BMW'),
(18, 'BMWs'),
(19, 'MyOne');

-- --------------------------------------------------------

--
-- Table structure for table `cane_category`
--

CREATE TABLE IF NOT EXISTS `cane_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(300) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `cane_category`
--

INSERT INTO `cane_category` (`category_id`, `category_name`) VALUES
(18, 'Mouse'),
(19, 'XBox'),
(25, 'Monkey'),
(26, 'Goal'),
(28, 'sd'),
(29, 'Medicine'),
(31, 'New Category'),
(32, 'Wasching Machine'),
(33, 'Waching Machine'),
(34, 'Bangla');

-- --------------------------------------------------------

--
-- Table structure for table `cane_cheques`
--

CREATE TABLE IF NOT EXISTS `cane_cheques` (
  `cheque_id` int(11) NOT NULL AUTO_INCREMENT,
  `cheque_number` varchar(255) NOT NULL,
  `cheque_date` date NOT NULL,
  `bank_name` varchar(200) DEFAULT NULL,
  `top_journal` int(11) DEFAULT NULL,
  `bottom_journal` int(11) DEFAULT NULL,
  `cheque_type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`cheque_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cane_cheques`
--

INSERT INTO `cane_cheques` (`cheque_id`, `cheque_number`, `cheque_date`, `bank_name`, `top_journal`, `bottom_journal`, `cheque_type`, `status`) VALUES
(1, '654321', '2013-01-16', '23', 8, 9, 2, 3),
(2, '12345', '2013-01-15', 'National Bank', 28, NULL, 1, 4),
(3, '7878', '2013-01-16', '26', 30, 31, 2, 1),
(4, '654321', '2013-01-16', '23', 32, 33, 2, 3),
(5, '9090', '2013-06-25', '23', 53, 54, 2, 3),
(6, '12345', '2013-01-15', 'National Bank', 57, 58, 1, 4),
(7, '7878', '2013-01-16', '26', 59, 60, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cane_cheque_status`
--

CREATE TABLE IF NOT EXISTS `cane_cheque_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cane_cheque_status`
--

INSERT INTO `cane_cheque_status` (`id`, `name`) VALUES
(1, 'Cleared'),
(2, 'Cheque In Hand'),
(3, 'Dishonered'),
(4, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `cane_cheque_type`
--

CREATE TABLE IF NOT EXISTS `cane_cheque_type` (
  `cheque_id` int(11) NOT NULL AUTO_INCREMENT,
  `cheque_type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cheque_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cane_cheque_type`
--

INSERT INTO `cane_cheque_type` (`cheque_id`, `cheque_type_name`) VALUES
(1, 'Receipt'),
(2, 'Payment');

-- --------------------------------------------------------

--
-- Table structure for table `cane_entries`
--

CREATE TABLE IF NOT EXISTS `cane_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `dr_side` int(11) NOT NULL,
  `cr_side` int(11) NOT NULL,
  `parent_voucher` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `cane_entries`
--

INSERT INTO `cane_entries` (`id`, `amount`, `dr_side`, `cr_side`, `parent_voucher`) VALUES
(7, '196750.00', 3, 24, 7),
(8, '191750.00', 24, 13, 8),
(9, '191750.00', 13, 23, 9),
(10, '11000.00', 1, 2, 10),
(11, '9950.00', 4, 3, 10),
(12, '11000.00', 1, 2, 11),
(13, '9950.00', 4, 3, 11),
(14, '11000.00', 24, 2, 12),
(15, '9950.00', 4, 3, 12),
(16, '500.00', 1, 24, 13),
(17, '11000.00', 24, 2, 14),
(18, '9950.00', 4, 3, 14),
(19, '11000.00', 24, 2, 15),
(20, '9950.00', 4, 3, 15),
(21, '1000.00', 1, 24, 16),
(22, '47500.00', 24, 8, 17),
(23, '47500.00', 8, 3, 18),
(24, '9950.00', 3, 4, 19),
(25, '11000.00', 5, 1, 19),
(26, '9500.00', 3, 4, 20),
(27, '10500.00', 5, 24, 20),
(28, '60000.00', 9, 24, 21),
(29, '5000.00', 3, 25, 22),
(30, '5000.00', 25, 13, 23),
(31, '5000.00', 13, 26, 24),
(32, '191750.00', 15, 24, 25),
(33, '191750.00', 23, 15, 26),
(34, '60000.00', 26, 9, 27),
(35, '100.00', 3, 24, 28),
(36, '529.00', 24, 8, 29),
(37, '529.00', 8, 3, 30),
(38, '1200.00', 3, 24, 31),
(39, '2000.00', 3, 24, 32),
(40, '1464.00', 3, 24, 33),
(41, '100.00', 24, 8, 34),
(42, '100.00', 8, 3, 35),
(43, '100.00', 24, 8, 36),
(44, '100.00', 8, 3, 37),
(45, '1000.00', 3, 24, 38),
(46, '100.00', 3, 24, 39),
(47, '1100.00', 24, 8, 40),
(48, '1100.00', 8, 3, 41),
(49, '50.00', 24, 8, 42),
(50, '50.00', 8, 3, 43),
(51, '10.00', 24, 8, 44),
(52, '10.00', 8, 3, 45),
(53, '187225.00', 24, 13, 46),
(54, '187225.00', 13, 23, 47),
(55, '1000.00', 24, 2, 48),
(56, '182.44', 4, 3, 48),
(57, '60000.00', 24, 11, 49),
(58, '60000.00', 11, 9, 50),
(59, '187225.00', 15, 24, 51),
(60, '187225.00', 23, 15, 52),
(61, '6250.00', 3, 25, 54),
(62, '315448.00', 3, 25, 55),
(63, '11121.00', 3, 25, 56),
(64, '1164.00', 3, 25, 57),
(65, '120.00', 25, 8, 58),
(66, '120.00', 8, 3, 59),
(67, '276.00', 24, 8, 60),
(68, '276.00', 8, 3, 61),
(69, '400.00', 3, 24, 62),
(70, '714.00', 24, 8, 63),
(71, '714.00', 8, 3, 64),
(72, '2300.00', 1, 2, 65),
(73, '2223.64', 4, 3, 65),
(74, '2300.00', 1, 2, 66),
(75, '2223.64', 4, 3, 66),
(76, '2300.00', 1, 2, 67),
(77, '2223.64', 4, 3, 67),
(78, '2300.00', 1, 2, 68),
(79, '2223.64', 4, 3, 68),
(80, '0.00', 1, 2, 69),
(81, '0.00', 4, 3, 69),
(82, '0.00', 1, 2, 70),
(83, '0.00', 4, 3, 70),
(84, '2300.00', 1, 2, 71),
(85, '2223.64', 4, 3, 71),
(86, '0.00', 1, 2, 72),
(87, '0.00', 4, 3, 72),
(88, '2300.00', 1, 2, 73),
(89, '2223.64', 4, 3, 73),
(90, '2300.00', 1, 2, 74),
(91, '2223.64', 4, 3, 74),
(92, '2300.00', 1, 2, 75),
(93, '2223.64', 4, 3, 75),
(94, '18400.00', 1, 2, 76),
(95, '17789.12', 4, 3, 76),
(96, '2300.00', 1, 2, 77),
(97, '2223.64', 4, 3, 77),
(98, '2300.00', 1, 2, 78),
(99, '2223.64', 4, 3, 78),
(100, '2300.00', 1, 2, 79),
(101, '2223.64', 4, 3, 79),
(102, '11500.00', 1, 2, 80),
(103, '11118.20', 4, 3, 80),
(104, '2300.00', 1, 2, 81),
(105, '2223.64', 4, 3, 81),
(106, '2300.00', 1, 2, 82),
(107, '2223.64', 4, 3, 82),
(108, '0.00', 1, 2, 83),
(109, '0.00', 4, 3, 83),
(110, '2300.00', 1, 2, 84),
(111, '2223.64', 4, 3, 84),
(112, '0.00', 1, 2, 85),
(113, '0.00', 4, 3, 85),
(114, '2300.00', 1, 2, 86),
(115, '2223.64', 4, 3, 86),
(116, '2300.00', 1, 2, 87),
(117, '2223.64', 4, 3, 87),
(118, '0.00', 1, 2, 88),
(119, '0.00', 4, 3, 88),
(120, '2300.00', 1, 2, 89),
(121, '2223.64', 4, 3, 89),
(122, '0.00', 1, 2, 90),
(123, '0.00', 4, 3, 90),
(124, '2300.00', 1, 2, 91),
(125, '2223.64', 4, 3, 91),
(126, '2300.00', 1, 2, 92),
(127, '2223.64', 4, 3, 92),
(128, '2300.00', 1, 2, 93),
(129, '2223.64', 4, 3, 93),
(130, '2300.00', 1, 2, 94),
(131, '2223.64', 4, 3, 94),
(132, '0.00', 1, 2, 95),
(133, '0.00', 4, 3, 95),
(134, '2300.00', 1, 2, 96),
(135, '2223.64', 4, 3, 96),
(136, '0.00', 1, 2, 97),
(137, '0.00', 4, 3, 97),
(138, '2300.00', 1, 2, 98),
(139, '2223.64', 4, 3, 98),
(140, '2300.00', 1, 2, 99),
(141, '2223.64', 4, 3, 99),
(142, '2300.00', 1, 2, 100),
(143, '2223.64', 4, 3, 100),
(144, '2300.00', 1, 2, 101),
(145, '2223.64', 4, 3, 101),
(146, '2300.00', 24, 2, 102),
(147, '2223.64', 4, 3, 102),
(148, '2300.00', 24, 2, 104),
(149, '2223.64', 4, 3, 104),
(150, '2300.00', 24, 2, 105),
(151, '2223.64', 4, 3, 105),
(152, '336863.00', 25, 1, 106),
(153, '2000.00', 1, 27, 107),
(154, '3000.00', 27, 1, 108),
(155, '2000.00', 3, 27, 109),
(156, '45000.00', 24, 8, 110),
(157, '45000.00', 8, 3, 111),
(158, '144.00', 3, 25, 112),
(159, '144.00', 3, 25, 113),
(160, '144.00', 25, 8, 114),
(161, '144.00', 8, 3, 115);

-- --------------------------------------------------------

--
-- Table structure for table `cane_entry_types`
--

CREATE TABLE IF NOT EXISTS `cane_entry_types` (
  `id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cane_entry_types`
--

INSERT INTO `cane_entry_types` (`id`, `name`) VALUES
(1, 'Receipt'),
(2, 'Payment'),
(3, 'Purchase'),
(4, 'Journal'),
(5, 'Purchase Return'),
(6, 'Sales Return'),
(7, 'Expenses');

-- --------------------------------------------------------

--
-- Table structure for table `cane_party`
--

CREATE TABLE IF NOT EXISTS `cane_party` (
  `party_id` int(11) NOT NULL AUTO_INCREMENT,
  `party_name` varchar(150) NOT NULL,
  `party_contact` varchar(50) NOT NULL,
  PRIMARY KEY (`party_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cane_party`
--

INSERT INTO `cane_party` (`party_id`, `party_name`, `party_contact`) VALUES
(3, 'Computer Source', '0171923456'),
(4, 'Microsft Corporation', '0167304343'),
(5, 'Boom', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `cane_payment`
--

CREATE TABLE IF NOT EXISTS `cane_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_invoice` varchar(255) NOT NULL,
  `payment_num` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cane_payment`
--

INSERT INTO `cane_payment` (`payment_id`, `payment_invoice`, `payment_num`, `payment_date`, `payment_type_id`) VALUES
(1, 'PMT-PC-2013-000001', 1, '2013-01-14', 2),
(2, 'PMT-PC-2013-000002', 2, '2013-01-14', 2),
(3, 'PMT-PC-2013-000003', 3, '2013-06-23', 2),
(4, 'PMT-PC-2014-000001', 1, '2014-02-28', 1),
(5, 'PMT-PC-2014-000002', 2, '2014-02-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_payment_types`
--

CREATE TABLE IF NOT EXISTS `cane_payment_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cane_payment_types`
--

INSERT INTO `cane_payment_types` (`id`, `payment_name`) VALUES
(1, 'cash'),
(2, 'cheque');

-- --------------------------------------------------------

--
-- Table structure for table `cane_products`
--

CREATE TABLE IF NOT EXISTS `cane_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_item` varchar(200) NOT NULL,
  `unit_name` varchar(50) DEFAULT NULL,
  `sku_number` varchar(100) DEFAULT NULL,
  `buy_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `is_serial_available` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `cane_products`
--

INSERT INTO `cane_products` (`product_id`, `category_id`, `brand_id`, `product_item`, `unit_name`, `sku_number`, `buy_price`, `selling_price`, `in_stock`, `is_serial_available`) VALUES
(12, 18, 15, 'USB', '', NULL, '1567.86', '500.00', 180, 2),
(13, 29, 16, 'Napa Syrup', '', NULL, '0.00', '20.00', 0, 2),
(14, 19, 14, '360DDS', 'Pcss', '12345', '12.00', '5000.00', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_product_serials`
--

CREATE TABLE IF NOT EXISTS `cane_product_serials` (
  `serial_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_serial` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_warranty` varchar(150) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  PRIMARY KEY (`serial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `cane_product_serials`
--

INSERT INTO `cane_product_serials` (`serial_id`, `product_serial`, `product_id`, `product_warranty`, `purchase_id`) VALUES
(25, '44', 11, '365', 16),
(26, '33', 11, '365', 16);

-- --------------------------------------------------------

--
-- Table structure for table `cane_purchase`
--

CREATE TABLE IF NOT EXISTS `cane_purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_voucher` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `party_id` int(11) NOT NULL,
  `party_invoice` varchar(100) NOT NULL,
  `purchase_total` decimal(10,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `cane_purchase`
--

INSERT INTO `cane_purchase` (`purchase_id`, `purchase_voucher`, `num`, `party_id`, `party_invoice`, `purchase_total`, `purchase_date`, `entry_by`) VALUES
(16, 'PUR-PC-2014-000001', 1, 4, '2050', '6250.00', '2014-02-24', 1),
(17, 'PUR-PC-2014-000002', 2, 4, '23424', '315448.00', '2014-02-24', 1),
(18, 'PUR-PC-2014-000003', 3, 4, '2030', '11121.00', '2014-02-24', 1),
(19, 'PUR-PC-2014-000004', 4, 4, '203', '1164.00', '2014-02-24', 1),
(20, 'PUR-PC-2014-000005', 5, 3, '2345', '400.00', '2014-02-25', 1),
(21, 'PUR-PC-2014-000006', 6, 5, '234234', '2000.00', '2014-02-28', 1),
(22, 'PUR-PC-2014-000007', 7, 4, '', '144.00', '2014-12-17', 1),
(23, 'PUR-PC-2014-000008', 8, 4, '1243535', '144.00', '2014-12-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_purchase_details`
--

CREATE TABLE IF NOT EXISTS `cane_purchase_details` (
  `p_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `p_product_id` int(11) NOT NULL,
  `p_unit_price` decimal(10,2) NOT NULL,
  `p_quantity` int(11) NOT NULL,
  PRIMARY KEY (`p_details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `cane_purchase_details`
--

INSERT INTO `cane_purchase_details` (`p_details_id`, `purchase_id`, `p_product_id`, `p_unit_price`, `p_quantity`) VALUES
(24, 16, 11, '250.00', 25),
(25, 17, 12, '5633.00', 56),
(26, 18, 11, '337.00', 33),
(27, 19, 11, '388.00', 3),
(28, 20, 11, '20.00', 20),
(29, 21, 11, '20.00', 100),
(30, 22, 14, '12.00', 12),
(31, 23, 12, '12.00', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cane_purchase_return`
--

CREATE TABLE IF NOT EXISTS `cane_purchase_return` (
  `p_return_id` int(11) NOT NULL AUTO_INCREMENT,
  `party_id` int(11) NOT NULL,
  `return_against_invoice` varchar(150) DEFAULT NULL,
  `return_total_amount` decimal(10,2) NOT NULL,
  `return_date` date NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`p_return_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cane_purchase_return`
--

INSERT INTO `cane_purchase_return` (`p_return_id`, `party_id`, `return_against_invoice`, `return_total_amount`, `return_date`, `entry_by`) VALUES
(8, 4, '3244', '120.00', '2014-02-24', 1),
(9, 3, '23423', '276.00', '2014-02-24', 1),
(10, 3, '', '714.00', '2014-02-25', 1),
(11, 3, '234', '45000.00', '2014-03-01', 1),
(12, 4, '133', '144.00', '2014-12-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_purchase_return_details`
--

CREATE TABLE IF NOT EXISTS `cane_purchase_return_details` (
  `p_return_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_return_id` int(11) NOT NULL,
  `return_product_id` int(11) NOT NULL,
  `return_unit_price` decimal(10,2) NOT NULL,
  `return_quantity` int(11) NOT NULL,
  PRIMARY KEY (`p_return_details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cane_purchase_return_details`
--

INSERT INTO `cane_purchase_return_details` (`p_return_details_id`, `p_return_id`, `return_product_id`, `return_unit_price`, `return_quantity`) VALUES
(8, 8, 11, '10.00', 12),
(9, 9, 11, '23.00', 12),
(10, 10, 11, '34.00', 21),
(11, 11, 12, '9000.00', 5),
(12, 12, 12, '12.00', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cane_receipt`
--

CREATE TABLE IF NOT EXISTS `cane_receipt` (
  `receipt_id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_invoice` varchar(200) NOT NULL,
  `receipt_num` int(11) NOT NULL,
  `receipt_date` date NOT NULL,
  `receipt_type_id` int(11) NOT NULL,
  PRIMARY KEY (`receipt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cane_receipt`
--

INSERT INTO `cane_receipt` (`receipt_id`, `receipt_invoice`, `receipt_num`, `receipt_date`, `receipt_type_id`) VALUES
(1, 'RPT-PC-2013-000001', 1, '2013-01-14', 1),
(2, 'RPT-PC-2013-000002', 2, '2013-01-14', 1),
(3, 'RPT-PC-2013-000003', 3, '2013-01-14', 2),
(4, 'RPT-PC-2014-000001', 1, '2014-02-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_receipt_types`
--

CREATE TABLE IF NOT EXISTS `cane_receipt_types` (
  `receipt_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`receipt_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cane_receipt_types`
--

INSERT INTO `cane_receipt_types` (`receipt_type_id`, `description`) VALUES
(1, 'Cash'),
(2, 'Cheque'),
(3, 'In Bank Account');

-- --------------------------------------------------------

--
-- Table structure for table `cane_rep_delivery`
--

CREATE TABLE IF NOT EXISTS `cane_rep_delivery` (
  `rep_delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `rep_delivery_invoice` varchar(255) NOT NULL,
  `rep_delivery_num` int(11) NOT NULL,
  `rep_delivery_date` date NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(100) NOT NULL,
  `prepared_by` int(11) NOT NULL,
  PRIMARY KEY (`rep_delivery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cane_rep_delivery`
--

INSERT INTO `cane_rep_delivery` (`rep_delivery_id`, `rep_delivery_invoice`, `rep_delivery_num`, `rep_delivery_date`, `customer_name`, `customer_contact`, `prepared_by`) VALUES
(1, 'RPD-PC-2013-000001', 1, '2013-01-18', 'Computer Source', '0171923456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_rep_delivery_products`
--

CREATE TABLE IF NOT EXISTS `cane_rep_delivery_products` (
  `rep_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `previous_product_id` int(11) NOT NULL,
  `previous_product_serial` varchar(255) NOT NULL,
  `sales_invoice` varchar(200) NOT NULL,
  `new_product_id` int(11) NOT NULL,
  `new_product_serial` varchar(255) NOT NULL,
  `acc_rec` decimal(10,2) NOT NULL,
  `acc_pay` decimal(10,2) NOT NULL,
  `parent_delivery_id` int(11) NOT NULL,
  PRIMARY KEY (`rep_items_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cane_rep_delivery_products`
--

INSERT INTO `cane_rep_delivery_products` (`rep_items_id`, `previous_product_id`, `previous_product_serial`, `sales_invoice`, `new_product_id`, `new_product_serial`, `acc_rec`, `acc_pay`, `parent_delivery_id`) VALUES
(1, 11, '2278', 'INV-PC-2013-000003', 11, '2278', '0.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_sales`
--

CREATE TABLE IF NOT EXISTS `cane_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `sale_type` int(11) NOT NULL,
  `party_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_mobile` varchar(150) DEFAULT NULL,
  `sold_by` int(11) NOT NULL,
  `sold_date` date NOT NULL,
  `sold_time` varchar(120) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `amount_received` decimal(10,2) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `sales_return` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `cane_sales`
--

INSERT INTO `cane_sales` (`id`, `invoice_number`, `number`, `sale_type`, `party_id`, `customer_name`, `customer_mobile`, `sold_by`, `sold_date`, `sold_time`, `total_amount`, `amount_received`, `balance`, `sales_return`) VALUES
(1, 'INV-PC-2013-000001', 1, 1, NULL, 'Charlie Sheen', '01827343234', 1, '2013-01-14', '01:21:33 PM', '11000.00', '11000.00', '0', 1),
(2, 'INV-PC-2013-000002', 2, 1, NULL, 'Charlie Sheen', '0182423434', 1, '2013-01-14', '01:25:16 PM', '11000.00', '11000.00', '0', 0),
(3, 'INV-PC-2013-000003', 3, 2, 3, NULL, NULL, 1, '2013-01-14', '01:27:30 PM', '11000.00', '500.00', '10500.00', 0),
(4, 'INV-PC-2013-000004', 4, 2, 3, NULL, NULL, 1, '2013-01-14', '01:38:49 PM', '11000.00', '1000.00', '10000.00', 0),
(5, 'INV-PC-2013-000005', 5, 2, 3, NULL, NULL, 1, '2013-01-14', '01:40:57 PM', '11000.00', '1000.00', '10000.00', 1),
(6, 'INV-PC-2014-000001', 1, 2, 3, NULL, NULL, 1, '2014-02-23', '06:52:42 PM', '1000.00', '1000.00', '0.00', 0),
(7, 'INV-PC-2014-000002', 2, 1, NULL, 'Mahbub', '01719349818', 1, '2014-02-26', '07:41:26 AM', '2300.00', '2300.00', '0', 0),
(8, 'INV-PC-2014-000003', 3, 1, NULL, 'Mustaque Ahmed', '01718349818', 1, '2014-02-26', '07:43:28 AM', '2300.00', '2300.00', '0', 0),
(9, 'INV-PC-2014-000004', 4, 1, NULL, 'Mustaque Ahmed', '01672095631', 1, '2014-02-26', '07:48:50 AM', '2300.00', '2300.00', '0', 0),
(10, 'INV-PC-2014-000005', 5, 1, NULL, 'Saifun Nahar', '01672095631', 1, '2014-02-26', '07:50:12 AM', '2300.00', '2300.00', '0', 0),
(11, 'INV-PC-2014-000006', 6, 1, NULL, 'Mustaque Ahmed', '01719349818', 1, '2014-02-26', '07:51:21 AM', '2300.00', '2300.00', '0', 0),
(12, 'INV-PC-2014-000007', 7, 1, NULL, '', '', 1, '1970-01-01', '07:52:47 AM', '0.00', '0.00', '0', 0),
(13, 'INV-PC-2014-000007', 7, 1, NULL, '', '', 1, '1970-01-01', '07:54:18 AM', '0.00', '0.00', '0', 0),
(14, 'INV-PC-2014-000007', 7, 1, NULL, 'Mustaque', '01719349818', 1, '2014-02-26', '07:55:05 AM', '2300.00', '2300.00', '0', 0),
(15, 'INV-PC-2014-000008', 8, 1, NULL, '', '', 1, '1970-01-01', '08:02:03 AM', '0.00', '0.00', '0', 0),
(16, 'INV-PC-2014-000008', 8, 1, NULL, 'Mahbub Ahmed', '01719349818', 1, '2014-02-26', '08:02:18 AM', '2300.00', '2300.00', '0', 0),
(17, 'INV-PC-2014-000009', 9, 1, NULL, 'asd', '3244', 1, '2014-02-26', '08:03:25 AM', '2300.00', '2300.00', '0', 0),
(18, 'INV-PC-2014-000010', 10, 1, NULL, 'asd', '324', 1, '2014-02-26', '08:04:27 AM', '2300.00', '2300.00', '0', 0),
(19, 'INV-PC-2014-000011', 11, 1, NULL, 'Mahbub Ahmed', '01719349818', 1, '2014-02-26', '08:06:51 AM', '18400.00', '18400.00', '0', 0),
(20, 'INV-PC-2014-000012', 12, 1, NULL, 'asd', 'asd', 1, '2014-02-26', '08:19:29 AM', '2300.00', '2300.00', '0', 0),
(21, 'INV-PC-2014-000013', 13, 1, NULL, 'sdf', 'sdf', 1, '2014-02-26', '08:21:14 AM', '2300.00', '2300.00', '0', 0),
(22, 'INV-PC-2014-000014', 14, 1, NULL, 'Mahbub Ahmed', '01719349818', 1, '2014-02-26', '10:25:20 AM', '2300.00', '2300.00', '0', 0),
(23, 'INV-PC-2014-000015', 15, 1, NULL, 'Mustaque Ahmed', '01719349818', 1, '2014-02-26', '10:28:09 AM', '11500.00', '11500.00', '0', 0),
(24, 'INV-PC-2014-000016', 16, 1, NULL, 'sf', 'sdf', 1, '2014-02-26', '10:31:55 AM', '2300.00', '2300.00', '0', 0),
(25, 'INV-PC-2014-000017', 17, 1, NULL, 'asd', 'ad', 1, '2014-02-26', '10:32:30 AM', '2300.00', '2300.00', '0', 0),
(26, 'INV-PC-2014-000018', 18, 1, NULL, '', '', 1, '1970-01-01', '10:34:54 AM', '0.00', '0.00', '0', 0),
(27, 'INV-PC-2014-000018', 18, 1, NULL, 'ad', 'ad', 1, '2014-02-26', '10:35:01 AM', '2300.00', '2300.00', '0', 0),
(28, 'INV-PC-2014-000019', 19, 1, NULL, '', '', 1, '1970-01-01', '10:37:50 AM', '0.00', '0.00', '0', 0),
(29, 'INV-PC-2014-000019', 19, 1, NULL, 'sdf', 'sdf', 1, '2014-02-26', '10:38:02 AM', '2300.00', '2300.00', '0', 0),
(30, 'INV-PC-2014-000020', 20, 1, NULL, 'Mahbub AHmed', '0181231232', 1, '2014-02-26', '10:38:55 AM', '2300.00', '2300.00', '0', 0),
(31, 'INV-PC-2014-000021', 21, 1, NULL, '', '', 1, '1970-01-01', '10:39:47 AM', '0.00', '0.00', '0', 0),
(32, 'INV-PC-2014-000021', 21, 1, NULL, 'sdf', 'dsf', 1, '2014-02-26', '10:39:58 AM', '2300.00', '2300.00', '0', 0),
(33, 'INV-PC-2014-000022', 22, 1, NULL, '', '', 1, '1970-01-01', '10:42:12 AM', '0.00', '0.00', '0', 0),
(34, 'INV-PC-2014-000022', 22, 1, NULL, 'asd', 'asd', 1, '2014-02-26', '10:42:32 AM', '2300.00', '2300.00', '0', 0),
(35, 'INV-PC-2014-000023', 23, 1, NULL, 'asd', 'ad', 1, '2014-02-26', '10:43:37 AM', '2300.00', '2300.00', '0', 0),
(36, 'INV-PC-2014-000024', 24, 1, NULL, 'sdf', 'sdf', 1, '2014-02-26', '10:44:11 AM', '2300.00', '2300.00', '0', 0),
(37, 'INV-PC-2014-000025', 25, 1, NULL, 'asd', 'asd', 1, '2014-02-26', '10:46:47 AM', '2300.00', '2300.00', '0', 0),
(38, 'INV-PC-2014-000026', 26, 1, NULL, '', '', 1, '1970-01-01', '10:47:22 AM', '0.00', '0.00', '0', 0),
(39, 'INV-PC-2014-000026', 26, 1, NULL, 'asd', 'asd', 1, '2014-02-26', '10:47:30 AM', '2300.00', '2300.00', '0', 0),
(40, 'INV-PC-2014-000027', 27, 1, NULL, '', '', 1, '1970-01-01', '10:48:23 AM', '0.00', '0.00', '0', 0),
(41, 'INV-PC-2014-000027', 27, 1, NULL, 'asd', 'asd', 1, '2014-02-26', '10:48:32 AM', '2300.00', '2300.00', '0', 0),
(42, 'INV-PC-2014-000028', 28, 1, NULL, 'Mahbub AHmed', '01719349818', 1, '2014-02-26', '12:08:52 PM', '2300.00', '2300.00', '0', 0),
(43, 'INV-PC-2014-000029', 29, 1, NULL, 'sad', '23434', 1, '2014-02-27', '09:14:24 AM', '2300.00', '2300.00', '0', 0),
(44, 'INV-PC-2014-000030', 30, 1, NULL, 'asdasd', 'sadasd', 1, '2014-02-27', '09:17:14 AM', '2300.00', '2300.00', '0', 0),
(45, 'INV-PC-2014-000031', 31, 2, 3, NULL, NULL, 1, '2014-02-27', '09:21:02 AM', '2300.00', '2300.00', '0.00', 0),
(46, 'INV-PC-2014-000032', 32, 2, 0, NULL, NULL, 1, '2014-02-27', '10:59:09 AM', '2300.00', '2300.00', '0.00', 0),
(47, 'INV-PC-2014-000033', 33, 2, 3, NULL, NULL, 1, '2014-02-27', '11:05:52 AM', '2300.00', '2300.00', '0.00', 0),
(48, 'INV-PC-2014-000034', 34, 2, 3, NULL, NULL, 1, '2014-02-27', '11:08:07 AM', '2300.00', '2300.00', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cane_sales_details`
--

CREATE TABLE IF NOT EXISTS `cane_sales_details` (
  `sales_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buy_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`sales_details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `cane_sales_details`
--

INSERT INTO `cane_sales_details` (`sales_details_id`, `sales_id`, `product_id`, `buy_price`, `selling_price`, `quantity`) VALUES
(1, 1, 11, '9500.00', '10500.00', 1),
(2, 1, 12, '450.00', '500.00', 1),
(3, 2, 11, '9500.00', '10500.00', 1),
(4, 2, 12, '450.00', '500.00', 1),
(5, 3, 11, '9500.00', '10500.00', 1),
(6, 3, 12, '450.00', '500.00', 1),
(7, 4, 11, '9500.00', '10500.00', 1),
(8, 4, 12, '450.00', '500.00', 1),
(9, 5, 11, '9500.00', '10500.00', 1),
(10, 5, 12, '450.00', '500.00', 1),
(11, 6, 12, '91.22', '500.00', 2),
(12, 7, 11, '2223.64', '2300.00', 1),
(13, 8, 11, '2223.64', '2300.00', 1),
(14, 9, 11, '2223.64', '2300.00', 1),
(15, 10, 11, '2223.64', '2300.00', 1),
(16, 11, 11, '2223.64', '2300.00', 1),
(17, 14, 11, '2223.64', '2300.00', 1),
(18, 16, 11, '2223.64', '2300.00', 1),
(19, 17, 11, '2223.64', '2300.00', 1),
(20, 18, 11, '2223.64', '2300.00', 1),
(21, 19, 11, '2223.64', '2300.00', 1),
(22, 19, 11, '2223.64', '2300.00', 1),
(23, 19, 11, '2223.64', '2300.00', 1),
(24, 19, 11, '2223.64', '2300.00', 1),
(25, 19, 11, '2223.64', '2300.00', 1),
(26, 19, 11, '2223.64', '2300.00', 1),
(27, 19, 11, '2223.64', '2300.00', 1),
(28, 19, 11, '2223.64', '2300.00', 1),
(29, 20, 11, '2223.64', '2300.00', 1),
(30, 21, 11, '2223.64', '2300.00', 1),
(31, 22, 11, '2223.64', '2300.00', 1),
(32, 23, 11, '2223.64', '2300.00', 1),
(33, 23, 11, '2223.64', '2300.00', 1),
(34, 23, 11, '2223.64', '2300.00', 1),
(35, 23, 11, '2223.64', '2300.00', 1),
(36, 23, 11, '2223.64', '2300.00', 1),
(37, 24, 11, '2223.64', '2300.00', 1),
(38, 25, 11, '2223.64', '2300.00', 1),
(39, 27, 11, '2223.64', '2300.00', 1),
(40, 29, 11, '2223.64', '2300.00', 1),
(41, 30, 11, '2223.64', '2300.00', 1),
(42, 32, 11, '2223.64', '2300.00', 1),
(43, 34, 11, '2223.64', '2300.00', 1),
(44, 35, 11, '2223.64', '2300.00', 1),
(45, 36, 11, '2223.64', '2300.00', 1),
(46, 37, 11, '2223.64', '2300.00', 1),
(47, 39, 11, '2223.64', '2300.00', 1),
(48, 41, 11, '2223.64', '2300.00', 1),
(49, 42, 11, '2223.64', '2300.00', 1),
(50, 43, 11, '2223.64', '2300.00', 1),
(51, 44, 11, '2223.64', '2300.00', 1),
(52, 45, 11, '2223.64', '2300.00', 1),
(53, 46, 11, '2223.64', '2300.00', 1),
(54, 47, 11, '2223.64', '2300.00', 1),
(55, 48, 11, '2223.64', '2300.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_sales_p_serials`
--

CREATE TABLE IF NOT EXISTS `cane_sales_p_serials` (
  `sold_serials_id` int(11) NOT NULL AUTO_INCREMENT,
  `sold_product_serial` varchar(255) NOT NULL,
  `warranty` varchar(100) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `sold_details_id` int(11) NOT NULL,
  PRIMARY KEY (`sold_serials_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `cane_sales_p_serials`
--

INSERT INTO `cane_sales_p_serials` (`sold_serials_id`, `sold_product_serial`, `warranty`, `purchase_id`, `sold_details_id`) VALUES
(2, '2149', '365', 7, 3),
(3, '2278', '365', 7, 5),
(4, '3803', '365', 7, 7),
(5, '817', '45', 18, 12),
(6, '814', '45', 18, 13),
(7, '928', '45', 18, 14),
(8, 'Mango', '365', 16, 15),
(9, 'Banana', '365', 16, 16),
(10, '23423444', '365', 16, 17),
(11, '23423433', '365', 16, 18),
(12, '234234', '365', 16, 19),
(13, 'vsdf', '34', 16, 20),
(14, '122ss', '45', 20, 21),
(15, 'gdf', '234', 16, 22),
(16, 'sasd', '34', 16, 23),
(17, '847', '45', 18, 24),
(18, '843', '45', 18, 25),
(19, '864', '45', 18, 26),
(20, '588', '45', 18, 27),
(21, '903', '45', 18, 28),
(22, '970', '45', 18, 29),
(23, '647', '45', 18, 30),
(24, 'da33', '45', 20, 31),
(25, '822', '45', 18, 32),
(26, '600', '45', 18, 33),
(27, '662', '45', 18, 34),
(28, '4420', '34', 18, 35),
(29, '737', '45', 18, 36),
(30, '860', '45', 18, 37),
(31, '845', '45', 18, 38),
(32, '2805', '34', 18, 39),
(33, '617', '45', 18, 40),
(34, '606', '45', 18, 41),
(35, '990', '45', 18, 42),
(36, '896', '45', 18, 43),
(37, '3441', '34', 18, 44),
(38, '553', '45', 18, 45),
(39, '4988', '34', 18, 46),
(40, '3258', '34', 18, 47),
(41, '4659', '34', 18, 48),
(42, '4888', '34', 18, 49),
(43, '608', '45', 18, 50),
(44, 'wdb', '234', 16, 51),
(45, '787', '45', 18, 52),
(46, '2932', '34', 18, 53),
(47, '2666', '34', 18, 54),
(48, '4902', '34', 18, 55);

-- --------------------------------------------------------

--
-- Table structure for table `cane_sales_return`
--

CREATE TABLE IF NOT EXISTS `cane_sales_return` (
  `sales_return_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_return_invoice` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `against_sales_invoice` varchar(255) NOT NULL,
  `sales_return_total` decimal(10,2) NOT NULL,
  `sales_return_date` date NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`sales_return_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cane_sales_return`
--

INSERT INTO `cane_sales_return` (`sales_return_id`, `sales_return_invoice`, `num`, `against_sales_invoice`, `sales_return_total`, `sales_return_date`, `entry_by`) VALUES
(1, 'SR-PC-2013-000001', 1, 'INV-PC-2013-000001', '11000.00', '2013-01-14', 1),
(2, 'SR-PC-2013-000002', 2, 'INV-PC-2013-000005', '10500.00', '2013-01-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_sales_return_details`
--

CREATE TABLE IF NOT EXISTS `cane_sales_return_details` (
  `s_return_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_return_id` int(11) NOT NULL,
  `return_product_id` int(11) NOT NULL,
  `return_unit_cost` decimal(10,2) NOT NULL,
  `return_unit_price` decimal(10,2) NOT NULL,
  `return_quantity` int(11) NOT NULL,
  PRIMARY KEY (`s_return_details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cane_sales_return_details`
--

INSERT INTO `cane_sales_return_details` (`s_return_details_id`, `sales_return_id`, `return_product_id`, `return_unit_cost`, `return_unit_price`, `return_quantity`) VALUES
(1, 1, 11, '9500.00', '10500.00', 1),
(2, 1, 12, '450.00', '500.00', 1),
(3, 2, 11, '9500.00', '10500.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_voucher`
--

CREATE TABLE IF NOT EXISTS `cane_voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` varchar(200) DEFAULT NULL,
  `narration` varchar(255) DEFAULT NULL,
  `trans_date` date NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `cane_voucher`
--

INSERT INTO `cane_voucher` (`voucher_id`, `voucher_number`, `narration`, `trans_date`, `entry_by`) VALUES
(7, 'PUR-PC-2013-000001', 'Purchased Goods', '2013-01-14', 1),
(8, 'PMT-PC-2013-000001', 'Payment for purchased goods', '2013-01-14', 1),
(9, 'Journal', 'Transfered Balance From Bank to Paid with Cheque Account', '2013-01-18', 1),
(10, 'INV-PC-2013-000001', 'Product Sold On Cash', '2013-01-14', 1),
(11, 'INV-PC-2013-000002', 'Product Sold On Cash', '2013-01-14', 1),
(12, 'INV-PC-2013-000003', 'Sold Product to Party', '2013-01-14', 1),
(13, 'RPT-PC-2013-000001', 'INV-PC-2013-000003', '2013-01-14', 1),
(14, 'INV-PC-2013-000004', 'Sold Product to Party', '2013-01-14', 1),
(15, 'INV-PC-2013-000005', 'Sold Product to Party', '2013-01-14', 1),
(16, 'RPT-PC-2013-000002', 'INV-PC-2013-000005', '2013-01-14', 1),
(17, 'Journal', 'Returned Purchased Goods', '2013-01-14', 1),
(18, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2013-01-14', 1),
(19, 'SR-PC-2013-000001', 'Sales Return', '2013-01-14', 1),
(20, 'SR-PC-2013-000002', 'Sales Return', '2013-01-14', 1),
(21, 'RPT-PC-2013-000003', 'Previous Sales', '2013-01-14', 1),
(22, 'PUR-PC-2013-000002', 'Purchased Goods', '2013-01-14', 1),
(23, 'PMT-PC-2013-000002', 'Purchased Goods', '2013-01-14', 1),
(24, 'Journal', 'Transfered Balance From Bank to Paid with Cheque Account', '2013-01-17', 1),
(25, 'Journal', 'Paid Cheque Was Dishonored', '2013-01-18', 1),
(26, 'Journal', 'Transfered Balance To Bank From Paid Cheque Dishonor', '2013-01-18', 1),
(27, 'Journal', 'Balance Transfer To Bank Account', '2013-01-18', 1),
(28, 'PUR-PC-2013-000003', 'Purchased Goods', '2013-05-18', 1),
(29, 'Journal', 'Returned Purchased Goods', '2013-05-19', 1),
(30, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2013-05-19', 1),
(31, 'PUR-PC-2013-000004', 'Purchased Goods', '2013-05-19', 1),
(32, 'PUR-PC-2013-000005', 'Purchased Goods', '2013-05-19', 1),
(33, 'PUR-PC-2013-000006', 'Purchased Goods', '2013-05-19', 1),
(34, 'Journal', 'Returned Purchased Goods', '2013-05-19', 1),
(35, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2013-05-19', 1),
(36, 'Journal', 'Returned Purchased Goods', '2013-05-19', 1),
(37, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2013-05-19', 1),
(38, 'PUR-PC-2013-000007', 'Purchased Goods', '2013-05-19', 1),
(39, 'PUR-PC-2013-000008', 'Purchased Goods', '2013-05-19', 1),
(40, 'Journal', 'Returned Purchased Goods', '2013-05-19', 1),
(41, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2013-05-19', 1),
(42, 'Journal', 'Returned Purchased Goods', '2013-06-19', 1),
(43, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2013-06-19', 1),
(44, 'Journal', 'Returned Purchased Goods', '2013-06-19', 1),
(45, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2013-06-19', 1),
(46, 'PMT-PC-2013-000003', 'Paid BIll', '2013-06-23', 1),
(47, 'Journal', 'Transfered Balance From Bank to Paid with Cheque Account', '2013-06-26', 1),
(48, 'INV-PC-2014-000001', 'Sold Product to Party', '2014-02-23', 1),
(49, 'Journal', 'Canceled Received Cheque', '2014-02-23', 1),
(50, 'Journal', 'Adjusted Balance- Received Cheque Cancelled and Received With Cheque', '2014-02-23', 1),
(51, 'Journal', 'Paid Cheque Was Dishonored', '2014-02-23', 1),
(52, 'Journal', 'Transfered Balance To Bank From Paid Cheque Dishonor', '2014-02-23', 1),
(53, 'PUR-PC-2014-000001', 'Purchased Goods', '2014-02-24', 1),
(54, 'PUR-PC-2014-000001', 'Purchased Goods', '2014-02-24', 1),
(55, 'PUR-PC-2014-000002', 'Purchased Goods', '2014-02-24', 1),
(56, 'PUR-PC-2014-000003', 'Purchased Goods', '2014-02-24', 1),
(57, 'PUR-PC-2014-000004', 'Purchased Goods', '2014-02-24', 1),
(58, 'Journal', 'Returned Purchased Goods', '2014-02-24', 1),
(59, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2014-02-24', 1),
(60, 'Journal', 'Returned Purchased Goods', '2014-02-24', 1),
(61, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2014-02-24', 1),
(62, 'PUR-PC-2014-000005', 'Goods Purchased', '2014-02-25', 1),
(63, 'Journal', 'Returned Purchased Goods', '2014-02-25', 1),
(64, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2014-02-25', 1),
(65, '000003', 'Product Sold On Cash', '2014-02-26', 1),
(66, '000004', 'Product Sold On Cash', '2014-02-26', 1),
(67, '000005', 'Product Sold On Cash', '2014-02-26', 1),
(68, '000006', 'Product Sold On Cash', '2014-02-26', 1),
(69, '000007', 'Product Sold On Cash', '1970-01-01', 1),
(70, '000007', 'Product Sold On Cash', '1970-01-01', 1),
(71, '000007', 'Product Sold On Cash', '2014-02-26', 1),
(72, '000008', 'Product Sold On Cash', '1970-01-01', 1),
(73, '000008', 'Product Sold On Cash', '2014-02-26', 1),
(74, '000009', 'Product Sold On Cash', '2014-02-26', 1),
(75, '000010', 'Product Sold On Cash', '2014-02-26', 1),
(76, '000011', 'Product Sold On Cash', '2014-02-26', 1),
(77, '000012', 'Product Sold On Cash', '2014-02-26', 1),
(78, '000013', 'Product Sold On Cash', '2014-02-26', 1),
(79, '000014', 'Product Sold On Cash', '2014-02-26', 1),
(80, '000015', 'Product Sold On Cash', '2014-02-26', 1),
(81, '000016', 'Product Sold On Cash', '2014-02-26', 1),
(82, '000017', 'Product Sold On Cash', '2014-02-26', 1),
(83, '000018', 'Product Sold On Cash', '1970-01-01', 1),
(84, '000018', 'Product Sold On Cash', '2014-02-26', 1),
(85, '000019', 'Product Sold On Cash', '1970-01-01', 1),
(86, '000019', 'Product Sold On Cash', '2014-02-26', 1),
(87, '000020', 'Product Sold On Cash', '2014-02-26', 1),
(88, '000021', 'Product Sold On Cash', '1970-01-01', 1),
(89, '000021', 'Product Sold On Cash', '2014-02-26', 1),
(90, '000022', 'Product Sold On Cash', '1970-01-01', 1),
(91, '000022', 'Product Sold On Cash', '2014-02-26', 1),
(92, '000023', 'Product Sold On Cash', '2014-02-26', 1),
(93, '000024', 'Product Sold On Cash', '2014-02-26', 1),
(94, '000025', 'Product Sold On Cash', '2014-02-26', 1),
(95, '000026', 'Product Sold On Cash', '1970-01-01', 1),
(96, '000026', 'Product Sold On Cash', '2014-02-26', 1),
(97, '000027', 'Product Sold On Cash', '1970-01-01', 1),
(98, '000027', 'Product Sold On Cash', '2014-02-26', 1),
(99, '000028', 'Product Sold On Cash', '2014-02-26', 1),
(100, '000029', 'Product Sold On Cash', '2014-02-27', 1),
(101, 'INV-PC-2014-000030', 'Product Sold On Cash', '2014-02-27', 1),
(102, 'INV-PC-2014-000031', 'Sold Product to Party', '2014-02-27', 1),
(103, 'INV-PC-2014-000032', 'Sold Product to Party', '2014-02-27', 1),
(104, 'INV-PC-2014-000033', 'Sold Product to Party', '2014-02-27', 1),
(105, 'INV-PC-2014-000034', 'Sold Product to Party', '2014-02-27', 1),
(106, 'PMT-PC-2014-000001', 'Paid', '2014-02-28', 1),
(107, 'RPT-PC-2014-000001', 'asd', '2014-02-28', 1),
(108, 'PMT-PC-2014-000002', '', '2014-02-28', 1),
(109, 'PUR-PC-2014-000006', 'Purchased Goods', '2014-02-28', 1),
(110, 'Journal', 'Returned Purchased Goods', '2014-03-01', 1),
(111, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2014-03-01', 1),
(112, 'PUR-PC-2014-000007', 'Goods Purchased', '2014-12-17', 1),
(113, 'PUR-PC-2014-000008', 'Goods Purchased', '2014-12-17', 1),
(114, 'Journal', 'Returned Purchased Goods', '2014-12-17', 1),
(115, 'Journal', 'Transfered Balance To Purchase From Purchase Return', '2014-12-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cane_warranty`
--

CREATE TABLE IF NOT EXISTS `cane_warranty` (
  `warranty_id` int(11) NOT NULL AUTO_INCREMENT,
  `warranty_invoice` varchar(255) NOT NULL,
  `warranty_num` int(11) NOT NULL,
  `generated_date` date NOT NULL,
  `entry_by` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(50) NOT NULL,
  PRIMARY KEY (`warranty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cane_warranty`
--

INSERT INTO `cane_warranty` (`warranty_id`, `warranty_invoice`, `warranty_num`, `generated_date`, `entry_by`, `customer_name`, `customer_contact`) VALUES
(1, 'CMP-PC-2013-000001', 1, '2013-01-18', 1, 'Computer Source', '0171923456');

-- --------------------------------------------------------

--
-- Table structure for table `cane_warranty_items`
--

CREATE TABLE IF NOT EXISTS `cane_warranty_items` (
  `warr_id` int(11) NOT NULL AUTO_INCREMENT,
  `on_warranty_serial` varchar(255) NOT NULL,
  `parent_warranty_id` int(11) NOT NULL,
  `problem_solved` int(11) NOT NULL,
  PRIMARY KEY (`warr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
