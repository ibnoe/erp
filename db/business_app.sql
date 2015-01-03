-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2015 at 08:06 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `business_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cx_actions`
--

CREATE TABLE IF NOT EXISTS `cx_actions` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(20) NOT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cx_actions`
--

INSERT INTO `cx_actions` (`action_id`, `action_name`) VALUES
(1, 'Add'),
(2, 'View'),
(3, 'Edit'),
(4, 'Delete'),
(5, 'Verification');

-- --------------------------------------------------------

--
-- Table structure for table `cx_approvers`
--

CREATE TABLE IF NOT EXISTS `cx_approvers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_approvers`
--

INSERT INTO `cx_approvers` (`id`, `user_id`, `section_id`, `branch_id`) VALUES
(1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cx_branch`
--

CREATE TABLE IF NOT EXISTS `cx_branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` text NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cx_branch`
--

INSERT INTO `cx_branch` (`branch_id`, `branch_name`, `branch_address`, `company_id`) VALUES
(1, 'Head Office', '', 1),
(2, 'Banani Branch', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cx_category`
--

CREATE TABLE IF NOT EXISTS `cx_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_category`
--

INSERT INTO `cx_category` (`category_id`, `category_name`) VALUES
(1, 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `cx_company`
--

CREATE TABLE IF NOT EXISTS `cx_company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_company`
--

INSERT INTO `cx_company` (`company_id`, `company_name`, `parent_id`) VALUES
(1, 'Renaissance Group', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cx_employees`
--

CREATE TABLE IF NOT EXISTS `cx_employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_employees`
--

INSERT INTO `cx_employees` (`employee_id`, `employee_name`, `branch_id`, `company_id`) VALUES
(1, 'Mahbub Ahmed', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cx_inventory`
--

CREATE TABLE IF NOT EXISTS `cx_inventory` (
  `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`inventory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_inventory_location`
--

CREATE TABLE IF NOT EXISTS `cx_inventory_location` (
  `inventory_location_id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_location_name` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`inventory_location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_menus`
--

CREATE TABLE IF NOT EXISTS `cx_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `menu_link` varchar(150) NOT NULL,
  `section_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cx_menus`
--

INSERT INTO `cx_menus` (`menu_id`, `menu_name`, `menu_link`, `section_id`, `action_id`) VALUES
(1, 'Submit Inventory Requisition', 'purchase/requisition', 1, 1),
(2, 'View Purchase Requsition', 'purchase/view/requisition', 1, 2),
(3, 'Add Category', 'category/add', 3, 1),
(4, 'Category List', 'category/show', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cx_modules`
--

CREATE TABLE IF NOT EXISTS `cx_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cx_modules`
--

INSERT INTO `cx_modules` (`module_id`, `module_name`) VALUES
(1, 'Purchase'),
(2, 'Product Management');

-- --------------------------------------------------------

--
-- Table structure for table `cx_permissions`
--

CREATE TABLE IF NOT EXISTS `cx_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cx_permissions`
--

INSERT INTO `cx_permissions` (`permission_id`, `role_id`, `menu_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cx_products`
--

CREATE TABLE IF NOT EXISTS `cx_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit_name` varchar(50) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_product_types`
--

CREATE TABLE IF NOT EXISTS `cx_product_types` (
  `product_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`product_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cx_product_types`
--

INSERT INTO `cx_product_types` (`product_type_id`, `product_type`, `description`) VALUES
(1, 'Service', 'Services you charge for or purchase. Examples include specialized labor, consulting hours, and professional fees.'),
(2, 'Inventory part', 'Goods you purchase, track as inventory, and resell.'),
(3, 'Inventory assembly', 'Assembled goods you build or purchase, track as inventory, and resell. Note: this software cannot track the costs associated with the manufacturing process itself. In other words, the cost of a built assembly item depends only on the cost of its components.'),
(4, 'Non-inventory part', 'Goods you buy but don''t track (such as office supplies), or materials you buy for a specific job that you charge back to your customer.'),
(5, 'Fixed asset', 'An asset you do not expect to convert to cash during one year of normal operations. A fixed asset is usually something that is necessary for the operation of your business—such as a truck, cash register, or computer.');

-- --------------------------------------------------------

--
-- Table structure for table `cx_roles`
--

CREATE TABLE IF NOT EXISTS `cx_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cx_roles`
--

INSERT INTO `cx_roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Purchase Executive');

-- --------------------------------------------------------

--
-- Table structure for table `cx_sections`
--

CREATE TABLE IF NOT EXISTS `cx_sections` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(100) NOT NULL,
  `parent_module_id` int(11) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cx_sections`
--

INSERT INTO `cx_sections` (`section_id`, `section_name`, `parent_module_id`) VALUES
(1, 'Inventory Requisition', 1),
(2, 'Purchase Order', 1),
(3, 'Product Category', 2),
(4, 'Product Brand', 2),
(5, 'Product Item', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cx_sessions`
--

CREATE TABLE IF NOT EXISTS `cx_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cx_sessions`
--

INSERT INTO `cx_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('000169f0c55cb54263ee46bd98470f99', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419936831, ''),
('096c04555ceb22ebf27ca5046842bb2a', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419886388, ''),
('151f23e89299286db81a1e2e39a476ca', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419933603, ''),
('1c79e0ca77fa7cac3573b79320e3defd', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419931783, ''),
('1e3c4d63ec2d3291ae6c826ba84cae62', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419933319, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:1:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}}}}'),
('230aa823a06b9f820b9adaffd4b969dd', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419886858, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:1:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}}}'),
('2682b1bfb12cb15d7868030c17f72bba', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419851745, ''),
('28f4b533b401d704c5570f530f75d4f6', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419931626, ''),
('372b7b933b753f3a3769c99c85fac98b', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419885880, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:1:{s:8:"Purchase";a:1:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}}}}'),
('4043a803964efa3b571692689fd7d3c2', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419931866, ''),
('5352013563869ac353d6ad4534700ac9', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419887355, ''),
('5ec615ddeca417bfc0ecdee72b396936', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1419932580, ''),
('73edb89fe28ace38cd1bf5ce5b147b6a', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419936831, ''),
('76e2fbfea964c236ecfc9c871c61e0cf', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419886388, ''),
('7cd11edb4d7d6b7910b68eab66f778e2', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419891874, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:1:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}}}'),
('a502fd686e4c8478a27a0bd37e099dc5', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419957738, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:1:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}}}}'),
('ad9c590ec043cab5b28b586712ae4cd9', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419966970, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('bcc105aa16aa5727011a512f388c18ef', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1420203746, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('c67f8f9be1dbaf977c1dd43ddfb7cc9b', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1420119312, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('d7491993d92017003ae92601b4c4ea3a', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419887133, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:1:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}}}'),
('e467e844cc8f3bca8be49552e2e4ba50', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419891632, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:1:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}}}'),
('e966c0d392820ea3ee7e91bf67867471', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419866634, 'a:4:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";}'),
('ec92eea7afeb01c09442ffd689d89f62', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419934710, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:1:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}}}}'),
('fa6796dbf56927c217bd69dac314c9d1', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1419887119, '');

-- --------------------------------------------------------

--
-- Table structure for table `cx_subcategory`
--

CREATE TABLE IF NOT EXISTS `cx_subcategory` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(255) NOT NULL,
  `parent_category` int(11) NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_users`
--

CREATE TABLE IF NOT EXISTS `cx_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_password` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_status` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_users`
--

INSERT INTO `cx_users` (`user_id`, `user_email`, `user_password`, `employee_id`, `role_id`, `user_status`, `last_login`) VALUES
(1, 'srijon00@yahoo.com', '$2y$10$odRf8JHVH1Sn4TUDB13i..OJP5EKVn7uqVIqlUHVcfG2Rq/KXPcQa', 1, 2, 1, '2015-01-02 14:02:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
