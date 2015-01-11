-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2015 at 12:06 AM
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
-- Table structure for table `cx_account_groups`
--

CREATE TABLE IF NOT EXISTS `cx_account_groups` (
  `acc_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `acc_group_name` varchar(200) NOT NULL,
  `grand_parent` int(11) NOT NULL,
  `acc_group_type` int(11) NOT NULL,
  `show_ledger` int(11) NOT NULL,
  PRIMARY KEY (`acc_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `cx_account_groups`
--

INSERT INTO `cx_account_groups` (`acc_group_id`, `parent_id`, `acc_group_name`, `grand_parent`, `acc_group_type`, `show_ledger`) VALUES
(1, 0, 'Assets', 0, 1, 0),
(2, 0, 'Liabilities', 0, 1, 0),
(3, 0, 'Owners Equity', 0, 1, 0),
(4, 0, 'Revenue', 0, 1, 0),
(5, 0, 'Expenses', 0, 1, 0),
(6, 0, 'COGS', 0, 1, 0),
(7, 4, 'Sales', 4, 2, 0),
(8, 1, 'Current Asset', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cx_account_group_type`
--

CREATE TABLE IF NOT EXISTS `cx_account_group_type` (
  `account_group_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_group_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`account_group_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cx_account_group_type`
--

INSERT INTO `cx_account_group_type` (`account_group_type_id`, `account_group_type_name`) VALUES
(1, 'System'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `cx_account_heads`
--

CREATE TABLE IF NOT EXISTS `cx_account_heads` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_code` varchar(50) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `op_balance` decimal(10,2) NOT NULL,
  `op_date` date NOT NULL,
  `balance_dc` varchar(2) NOT NULL,
  `account_type` int(11) NOT NULL,
  `parent_group` int(11) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `cx_account_heads`
--

INSERT INTO `cx_account_heads` (`acc_id`, `account_code`, `account_name`, `op_balance`, `op_date`, `balance_dc`, `account_type`, `parent_group`) VALUES
(1, '1001', 'Cash Register Drawer(s) Funds', '200.00', '0000-00-00', 'D', 1, 8),
(2, '1002', 'Undeposited Cash', '100.00', '0000-00-00', 'D', 1, 11),
(3, '1003', 'Petty Cash', '0.00', '0000-00-00', 'D', 1, 11),
(4, '4001', 'General', '0.00', '0000-00-00', 'D', 1, 12),
(5, '4002', 'Payroll', '0.00', '0000-00-00', 'D', 1, 12),
(6, '4003', 'Raw Materials', '100.00', '0000-00-00', 'D', 3, 14),
(7, '4004', 'Products', '290.00', '0000-00-00', 'D', 3, 16),
(8, '4007', 'Services', '50.00', '0000-00-00', 'D', 3, 16),
(9, '5001', 'Sales Discounts (Contra-Revenue Account)', '0.00', '0000-00-00', 'C', 3, 16),
(10, '5002', 'Sales Returns and Allowances (Contra-Revenue Account)', '110.00', '0000-00-00', 'C', 3, 16),
(11, '2001', 'Dutch Bangla Bank Ltd', '500.00', '0000-00-00', 'D', 2, 6),
(12, '2003', 'Microsoft Corporation', '3000.00', '2014-03-01', 'D', 4, 16),
(13, '1011', 'Brac Bank', '5000.00', '2014-03-10', 'D', 2, 10),
(14, '5023', 'Merchandise Inventory', '0.00', '0000-00-00', 'D', 3, 17),
(15, '3034', 'Software Sale', '200.00', '0000-00-00', 'C', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cx_account_head_types`
--

CREATE TABLE IF NOT EXISTS `cx_account_head_types` (
  `account_head_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_head_type_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`account_head_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cx_account_head_types`
--

INSERT INTO `cx_account_head_types` (`account_head_type_id`, `account_head_type_name`) VALUES
(1, 'Cash Account'),
(2, 'Bank Account'),
(3, 'Normal Account'),
(4, 'Party Account'),
(5, 'Contra Account');

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
-- Table structure for table `cx_bill_of_materials`
--

CREATE TABLE IF NOT EXISTS `cx_bill_of_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `parent_item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `cx_cheques`
--

CREATE TABLE IF NOT EXISTS `cx_cheques` (
  `cheque_id` int(11) NOT NULL AUTO_INCREMENT,
  `cheque_number` int(11) NOT NULL,
  `cheque_date` date NOT NULL,
  `cheque_type` int(11) NOT NULL,
  `cheque_status` int(11) NOT NULL,
  `dr_id` int(11) NOT NULL,
  `cr_id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  PRIMARY KEY (`cheque_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `cx_cheques`
--

INSERT INTO `cx_cheques` (`cheque_id`, `cheque_number`, `cheque_date`, `cheque_type`, `cheque_status`, `dr_id`, `cr_id`, `entry_id`) VALUES
(26, 12345, '2014-03-10', 1, 1, 41, 42, 35),
(27, 4567, '2014-03-11', 1, 1, 41, 43, 35),
(28, 2343, '2014-03-01', 1, 1, 43, 46, 37),
(29, 234, '2014-03-11', 1, 1, 43, 47, 37),
(32, 2333, '2014-03-10', 2, 1, 46, 50, 41),
(33, 23344, '2014-03-06', 2, 1, 47, 50, 41);

-- --------------------------------------------------------

--
-- Table structure for table `cx_cheque_status`
--

CREATE TABLE IF NOT EXISTS `cx_cheque_status` (
  `cheque_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `cheque_status_name` varchar(30) NOT NULL,
  PRIMARY KEY (`cheque_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cx_cheque_status`
--

INSERT INTO `cx_cheque_status` (`cheque_status_id`, `cheque_status_name`) VALUES
(1, 'In Hand'),
(2, 'Waiting for Clearing'),
(3, 'Bounced');

-- --------------------------------------------------------

--
-- Table structure for table `cx_cheque_type`
--

CREATE TABLE IF NOT EXISTS `cx_cheque_type` (
  `cheque_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `cheque_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`cheque_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cx_cheque_type`
--

INSERT INTO `cx_cheque_type` (`cheque_type_id`, `cheque_type_name`) VALUES
(1, 'Cheque Payment '),
(2, 'Cheque Receive');

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
-- Table structure for table `cx_credit_entry`
--

CREATE TABLE IF NOT EXISTS `cx_credit_entry` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `cr_amount` decimal(10,2) NOT NULL,
  `entry_id` int(11) NOT NULL,
  PRIMARY KEY (`cr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `cx_credit_entry`
--

INSERT INTO `cx_credit_entry` (`cr_id`, `acc_id`, `cr_amount`, `entry_id`) VALUES
(42, 13, '500.00', 35),
(43, 11, '250.00', 35),
(44, 2, '200.00', 36),
(45, 8, '300.00', 36),
(46, 13, '34.00', 37),
(47, 11, '3444.00', 37),
(50, 12, '37799.00', 41),
(51, 3, '500.00', 42),
(52, 9, '500.00', 43),
(53, 13, '200.00', 44),
(54, 11, '600.00', 44),
(63, 15, '5000.00', 53),
(64, 14, '3000.00', 54),
(65, 12, '500.00', 55),
(66, 3, '2500.00', 56);

-- --------------------------------------------------------

--
-- Table structure for table `cx_debit_entry`
--

CREATE TABLE IF NOT EXISTS `cx_debit_entry` (
  `dr_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `dr_amount` decimal(10,2) NOT NULL,
  `entry_id` int(11) NOT NULL,
  PRIMARY KEY (`dr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `cx_debit_entry`
--

INSERT INTO `cx_debit_entry` (`dr_id`, `acc_id`, `dr_amount`, `entry_id`) VALUES
(41, 12, '750.00', 35),
(42, 13, '500.00', 36),
(43, 12, '3478.00', 37),
(46, 13, '3344.00', 41),
(47, 11, '34455.00', 41),
(48, 13, '500.00', 42),
(49, 1, '500.00', 43),
(50, 1, '500.00', 44),
(51, 5, '300.00', 44),
(60, 12, '5000.00', 53),
(61, 4, '3000.00', 54),
(62, 14, '500.00', 55),
(63, 12, '2500.00', 56);

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
-- Table structure for table `cx_entries`
--

CREATE TABLE IF NOT EXISTS `cx_entries` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_type_id` int(11) NOT NULL,
  `voucher_number` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `trans_date` date NOT NULL,
  `narration` varchar(255) NOT NULL,
  `entry_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `verified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `cx_entries`
--

INSERT INTO `cx_entries` (`entry_id`, `entry_type_id`, `voucher_number`, `num`, `trans_date`, `narration`, `entry_by`, `status`, `verified_by`) VALUES
(35, 2, 'PMT-2014-000001', 1, '2014-03-10', 'For Service Rendered', 1, 0, NULL),
(36, 1, 'JRL-2014-000001', 1, '2014-03-10', '', 1, 1, 1),
(37, 2, 'PMT-2014-000002', 2, '2014-03-10', 'sadasd', 1, 0, NULL),
(39, 3, 'RCT-2014-000001', 1, '2014-03-10', 'Boom Crush', 1, 0, NULL),
(41, 3, 'RCT-2014-000002', 2, '2014-03-10', 'Boom Crush', 1, 0, NULL),
(42, 1, 'JRL-2014-000002', 2, '2014-03-03', 'Transfered Fund', 1, 1, 1),
(43, 1, 'JRL-2014-000003', 3, '2014-03-10', 'Sold', 1, 0, NULL),
(44, 1, 'JRL-2014-000004', 4, '2014-03-12', 'Testing Journal Entry', 1, 0, NULL),
(53, 4, 'INV-2014-000001', 1, '2014-03-15', 'Product Sold TO Bill Gates', 1, 1, 1),
(54, 1, 'JRL-2014-000005', 5, '2014-03-15', 'Product Sold TO Bill Gates', 1, 0, NULL),
(55, 5, 'PH-2014-000001', 1, '2014-03-15', 'Bought Goods From Microsoft Corporation', 1, 1, 1),
(56, 2, 'PMT-2014-000003', 3, '2014-03-22', 'ABC...', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cx_entry_type`
--

CREATE TABLE IF NOT EXISTS `cx_entry_type` (
  `entry_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_name` varchar(30) NOT NULL,
  PRIMARY KEY (`entry_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cx_entry_type`
--

INSERT INTO `cx_entry_type` (`entry_type_id`, `entry_name`) VALUES
(1, 'Journal'),
(2, 'Payment'),
(3, 'Receive'),
(4, 'Sales'),
(5, 'Purchase');

-- --------------------------------------------------------

--
-- Table structure for table `cx_information`
--

CREATE TABLE IF NOT EXISTS `cx_information` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) DEFAULT NULL,
  `time_zone` varchar(20) DEFAULT NULL,
  `date_format` varchar(20) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_information`
--

INSERT INTO `cx_information` (`info_id`, `company_name`, `time_zone`, `date_format`, `currency`) VALUES
(1, NULL, NULL, NULL, NULL);

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
-- Table structure for table `cx_items`
--

CREATE TABLE IF NOT EXISTS `cx_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type_id` int(11) NOT NULL,
  `parent_item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `has_subitem` int(11) NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_details`
--

CREATE TABLE IF NOT EXISTS `cx_item_details` (
  `item_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  PRIMARY KEY (`item_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_inventory`
--

CREATE TABLE IF NOT EXISTS `cx_item_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_account` int(11) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `on_hand` int(11) NOT NULL,
  `total_value` decimal(10,2) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_purchase`
--

CREATE TABLE IF NOT EXISTS `cx_item_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description_purchase` text NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `cogs_account` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_sales`
--

CREATE TABLE IF NOT EXISTS `cx_item_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description_sales` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `income_account` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tax_code_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_types`
--

CREATE TABLE IF NOT EXISTS `cx_item_types` (
  `item_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`item_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cx_item_types`
--

INSERT INTO `cx_item_types` (`item_type_id`, `item_type_name`, `description`) VALUES
(1, 'Service', 'Services you charge for or purchase. Examples include specialized labor, consulting hours, and professional fees.'),
(2, 'Inventory part', 'Goods you purchase, track as inventory, and resell.'),
(3, 'Inventory assembly', 'Use for Inventory item that you assemble from other inventory items and then sell. Assembled goods you build or purchase, track as inventory, and resell. Note: this software cannot track the costs associated with the manufacturing process itself. In other words, the cost of a built assembly item depends only on the cost of its components. '),
(4, 'Non-inventory part', 'Goods you buy but don''t track (such as office supplies), or materials you buy for a specific job that you charge back to your customer.'),
(5, 'Fixed asset', 'An asset you do not expect to convert to cash during one year of normal operations. A fixed asset is usually something that is necessary for the operation of your business—such as a truck, cash register, or computer.');

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
-- Table structure for table `cx_pay_rec`
--

CREATE TABLE IF NOT EXISTS `cx_pay_rec` (
  `pay_rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_from` varchar(150) NOT NULL,
  `entry_id` int(11) NOT NULL,
  PRIMARY KEY (`pay_rec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `cx_pay_rec`
--

INSERT INTO `cx_pay_rec` (`pay_rec_id`, `to_from`, `entry_id`) VALUES
(17, 'Mustaque Ahmed', 27),
(18, 'Mustaque Ahmed', 28),
(19, 'Mustaque Ahmed', 29),
(20, 'sad', 33),
(21, 'Bill Gates', 34),
(22, 'Bill Gates', 35),
(23, 'asdasd', 37),
(24, 'Bill Gates', 38),
(25, 'Bill Gates', 39),
(26, 'Bill Gates', 40),
(27, 'Bill Gates', 41),
(28, 'Ovi', 56);

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
('8e01a705bbd13deff21b7870d9ede201', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1421016966, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('c73e147f9c264e065c1f05d5ae3064b8', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1421017490, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}');

-- --------------------------------------------------------

--
-- Table structure for table `cx_show_ledger_status`
--

CREATE TABLE IF NOT EXISTS `cx_show_ledger_status` (
  `show_ledger_status_id` varchar(1) NOT NULL,
  `show_ledger_status` varchar(10) NOT NULL,
  PRIMARY KEY (`show_ledger_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cx_show_ledger_status`
--

INSERT INTO `cx_show_ledger_status` (`show_ledger_status_id`, `show_ledger_status`) VALUES
('0', 'Show'),
('1', 'Don''t Show');

-- --------------------------------------------------------

--
-- Table structure for table `cx_units`
--

CREATE TABLE IF NOT EXISTS `cx_units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_user`
--

CREATE TABLE IF NOT EXISTS `cx_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` text NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_user`
--

INSERT INTO `cx_user` (`user_id`, `user_name`, `user_email`, `user_password`, `role_id`) VALUES
(1, 'Mahbub Ahmed', 'srijon00@yahoo.com', 'caneflex:d0e23f5dedeb21109759f015e99564652daba331:caneflex', 1);

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
(1, 'srijon00@yahoo.com', '$2y$10$odRf8JHVH1Sn4TUDB13i..OJP5EKVn7uqVIqlUHVcfG2Rq/KXPcQa', 1, 2, 1, '2015-01-11 23:59:32');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
