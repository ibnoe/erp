-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2015 at 10:35 PM
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
(9, '5001', 'Random Expenses', '0.00', '0000-00-00', 'C', 3, 5),
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
-- Table structure for table `cx_branch`
--

CREATE TABLE IF NOT EXISTS `cx_branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` text NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cx_branch`
--

INSERT INTO `cx_branch` (`branch_id`, `branch_name`, `branch_address`, `company_id`) VALUES
(1, 'Head Office', '', 1),
(2, 'Banani Branch', '', 1),
(3, 'Gulshan Branch', '', 1);

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
-- Table structure for table `cx_fiscal_year`
--

CREATE TABLE IF NOT EXISTS `cx_fiscal_year` (
  `fiscal_year_id` int(11) NOT NULL AUTO_INCREMENT,
  `fiscal_year` year(4) NOT NULL,
  PRIMARY KEY (`fiscal_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_fiscal_year`
--

INSERT INTO `cx_fiscal_year` (`fiscal_year_id`, `fiscal_year`) VALUES
(1, 2015);

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
  `item_id` int(11) NOT NULL,
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `cx_items`
--

INSERT INTO `cx_items` (`item_id`, `item_type_id`, `parent_item_id`, `item_name`, `has_subitem`, `entry_by`, `created_at`, `updated_at`) VALUES
(23, 1, 0, 'Software', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, 23, 'Website Development', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 1, 0, 'Labor', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 2, 0, 'Beverage', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 2, 26, 'Cola', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 2, 27, 'Coke 250 ml', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 3, 0, 'Furniture', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 4, 0, 'Wood', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 4, 0, 'Glue', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 4, 0, 'Office Supplies', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 4, 32, 'Tissue Paper', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 3, 29, 'Dining Table', 0, 1, '0000-00-00 00:00:00', '2015-01-21 20:25:32');

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_bill_of_materials`
--

CREATE TABLE IF NOT EXISTS `cx_item_bill_of_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `parent_item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `cx_item_bill_of_materials`
--

INSERT INTO `cx_item_bill_of_materials` (`id`, `item_id`, `cost`, `quantity`, `total`, `parent_item_id`) VALUES
(13, 31, '30.00', 2, '60.00', 34),
(14, 30, '100.00', 3, '300.00', 34),
(15, 25, '100.00', 5, '500.00', 34);

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_details`
--

CREATE TABLE IF NOT EXISTS `cx_item_details` (
  `item_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `cx_item_details`
--

INSERT INTO `cx_item_details` (`item_details_id`, `item_id`, `unit_id`, `item_code`, `item_option_id`) VALUES
(12, 24, 1, '1001', 5),
(13, 25, 1, '1003', 1),
(14, 28, 2, '2001', 3),
(15, 30, 2, '4005', 2),
(16, 31, 2, '5009', 2),
(17, 33, 2, '6000', 6),
(18, 34, 2, '8090', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_inventory`
--

CREATE TABLE IF NOT EXISTS `cx_item_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_account` int(11) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `on_hand` int(11) DEFAULT NULL,
  `total_value` decimal(10,2) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cx_item_inventory`
--

INSERT INTO `cx_item_inventory` (`id`, `asset_account`, `reorder_level`, `on_hand`, `total_value`, `item_id`) VALUES
(5, 1, 10, NULL, NULL, 28),
(6, 1, 10, NULL, NULL, 34);

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_options`
--

CREATE TABLE IF NOT EXISTS `cx_item_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type_id` int(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cx_item_options`
--

INSERT INTO `cx_item_options` (`option_id`, `item_type_id`, `option_name`) VALUES
(1, 1, 'This service is used in assemblies or is performed by a subcontractor or partner'),
(2, 4, 'The item is used in assembles or is purchased for a specific customer''s job'),
(3, 2, 'Regular Inventory Part'),
(4, 3, 'Regular Inventory Assemblies'),
(5, 1, 'Regular Service Item'),
(6, 4, 'Regular Non Inventory Part');

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_purchase`
--

CREATE TABLE IF NOT EXISTS `cx_item_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cost` decimal(10,2) NOT NULL,
  `account_to_debit` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `cx_item_purchase`
--

INSERT INTO `cx_item_purchase` (`id`, `cost`, `account_to_debit`, `item_id`) VALUES
(11, '100.00', 9, 25),
(12, '10.00', 11, 28),
(13, '50.00', 11, 30),
(14, '20.00', 11, 31),
(15, '860.00', 11, 34);

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_sales`
--

CREATE TABLE IF NOT EXISTS `cx_item_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `account_to_credit` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `cx_item_sales`
--

INSERT INTO `cx_item_sales` (`id`, `price`, `account_to_credit`, `item_id`) VALUES
(15, '5000.00', 15, 24),
(16, '100.00', 15, 25),
(17, '20.00', 15, 28),
(18, '100.00', 15, 30),
(19, '30.00', 15, 31),
(20, '25.00', 9, 33),
(21, '2500.00', 15, 34);

-- --------------------------------------------------------

--
-- Table structure for table `cx_item_types`
--

CREATE TABLE IF NOT EXISTS `cx_item_types` (
  `item_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`item_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cx_item_types`
--

INSERT INTO `cx_item_types` (`item_type_id`, `item_type_name`, `description`) VALUES
(1, 'Service', 'Services you charge for or purchase. Examples include specialized labor, consulting hours, and professional fees.'),
(2, 'Inventory part', 'Goods you purchase, track as inventory, and resell.'),
(3, 'Inventory assembly', 'Use for Inventory item that you assemble from other inventory items and then sell. Assembled goods you build or purchase, track as inventory, and resell. Note: this software cannot track the costs associated with the manufacturing process itself. In other words, the cost of a built assembly item depends only on the cost of its components. '),
(4, 'Non-inventory part', 'Use for Goods you buy to use in Assemblies but don''t track');

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
  `is_hidden` tinyint(1) NOT NULL,
  `class_method` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cx_menus`
--

INSERT INTO `cx_menus` (`menu_id`, `menu_name`, `menu_link`, `section_id`, `action_id`, `is_hidden`, `class_method`) VALUES
(1, 'New Item', 'items/add', 1, 1, 0, 'items-add'),
(2, 'Show Items', 'items/show', 1, 2, 0, 'items-show'),
(3, 'Edit Item', 'items/edit/{id}', 1, 3, 1, 'items-edit'),
(4, 'Delete Item', 'item/remove/{id}', 1, 4, 1, 'items-remove');

-- --------------------------------------------------------

--
-- Table structure for table `cx_modules`
--

CREATE TABLE IF NOT EXISTS `cx_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_modules`
--

INSERT INTO `cx_modules` (`module_id`, `module_name`) VALUES
(1, 'Product');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cx_permissions`
--

INSERT INTO `cx_permissions` (`permission_id`, `role_id`, `menu_id`) VALUES
(1, 2, 1),
(5, 2, 2),
(6, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cx_purchase_order`
--

CREATE TABLE IF NOT EXISTS `cx_purchase_order` (
  `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_date` date NOT NULL,
  `fob_date` date DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `brach_id` int(11) NOT NULL,
  `fiscal_year_id` int(11) NOT NULL,
  `entry_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `purchase_order_status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cx_purchase_order_line`
--

CREATE TABLE IF NOT EXISTS `cx_purchase_order_line` (
  `po_line_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `po_id` int(11) NOT NULL,
  PRIMARY KEY (`po_line_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cx_sections`
--

INSERT INTO `cx_sections` (`section_id`, `section_name`, `parent_module_id`) VALUES
(1, 'Product Item', 1),
(2, 'Purchase Order', 2);

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
('01c77a9f5e3d4ef5754842ab03434f05', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421828122, ''),
('1453e9c14a4c24a52345908947b17adf', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421783283, ''),
('33c8deff8ef23c10d65cc7d23ebc11c1', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421828122, ''),
('36e5e0f8ed36d141813cb0eefb68ceff', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421650210, 'a:6:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:4:{i:0;a:3:{s:10:"section_id";s:1:"1";s:9:"action_id";s:1:"1";s:12:"class_method";s:9:"items-add";}i:1;a:3:{s:10:"section_id";s:1:"1";s:9:"action_id";s:1:"2";s:12:"class_method";s:10:"items-show";}i:2;a:3:{s:10:"section_id";s:1:"1";s:9:"action_id";s:1:"3";s:12:"class_method";s:10:"items-edit";}i:3;a:3:{s:10:"section_id";s:1:"1";s:9:"action_id";s:1:"4";s:12:"class_method";s:12:"items-remove";}}}'),
('3d5c65ef3d9878438fd9b1f7d4b32f43', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421692582, ''),
('48c4c6d3f9338d1752f52344a29fac60', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421850510, ''),
('4c1fe7d49e0b1a495ff9f67bef8ceadd', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421871032, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('5b936eeb26a9da9bbe345ee6ccf69259', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421783283, ''),
('65f25f1d091ce05f837f9904a24f0e4b', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421863711, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('6b89cd2f15a9265d2deeb6c72a5c9cbc', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421783052, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('7077fa3eb63f12e72c12bd86c281e84f', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421610001, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('71adc48520ea1aaa90d4bf1707884640', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421672100, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('846ed32e6810d3d7d354406ef840600a', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421860039, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('8d1823b9ced95be59ceced31e2a18229', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421871753, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('8d4338e7756c6ca7548e683cca622db2', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421692564, ''),
('93cfa03c207d5b34dbfcb764d9b66ad5', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421661414, 'a:6:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:12:"items-remove";}}'),
('9480f09fbb3c03ddefa9705a03113342', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421543298, ''),
('958cd3453f152aa1a6a4aef0baf5e728', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421783904, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('975a3dc68a024afac760e179b76a7900', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421605710, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('9fe032da9005502104d80ed76d973a53', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421543298, ''),
('a273b2fc5464473960b90f1e134e73f0', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421863947, ''),
('a4c07225a0736cd2ede875cfade6eee1', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421573363, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('ae28c1b4ee3037f713a1e2967e8ce50f', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421850236, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('afa8c8aa46408683a8531d7d629981f3', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421538281, ''),
('bcee537eb7ea10c43472f764db63fae8', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421544743, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('c35d8bbce5620617a186d5da99a9a90d', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421784872, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}'),
('c41fe5897f1d98f7b37b168c37b39f3f', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421850509, ''),
('c650a21609a46de14feadcc52464aab1', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421581296, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('c746067cbe6026e123dc3ebb49094bb8', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421692564, ''),
('cb4ca4b79550219b72188a546276e473', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421675178, ''),
('ccb66d53e0b538fa6394d8782db7bbc4', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421863947, ''),
('de404b5c1a78b991493ad4c38523fc6a', '192.168.100.6', 'Mozilla/5.0 (Linux; Android 4.4.4; Nexus 7 Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.93 Safa', 1421544583, ''),
('df6e30673a9570b3c6db4323df0beb7c', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421538281, ''),
('eee61840c39a414076e8a67c249532fc', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421675178, ''),
('f2047fe1f999a73d3e19a1ded4120585', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421537880, 'a:5:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:10:"left_menus";a:2:{s:8:"Purchase";a:2:{i:0;a:2:{s:8:"menuName";s:28:"Submit Inventory Requisition";s:8:"menuLink";s:20:"purchase/requisition";}i:1;a:2:{s:8:"menuName";s:24:"View Purchase Requsition";s:8:"menuLink";s:25:"purchase/view/requisition";}}s:18:"Product Management";a:2:{i:0;a:2:{s:8:"menuName";s:12:"Add Category";s:8:"menuLink";s:12:"category/add";}i:1;a:2:{s:8:"menuName";s:13:"Category List";s:8:"menuLink";s:13:"category/show";}}}}'),
('fd7dd250d86e25698a09c00aa782789d', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:36.0) Gecko/20100101 Firefox/36.0', 1421828105, 'a:7:{s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"2";s:9:"user_name";s:12:"Mahbub Ahmed";s:9:"branch_id";s:1:"1";s:11:"branch_name";s:11:"Head Office";s:10:"left_menus";a:1:{s:7:"Product";a:2:{i:0;a:2:{s:8:"menuName";s:8:"New Item";s:8:"menuLink";s:9:"items/add";}i:1;a:2:{s:8:"menuName";s:10:"Show Items";s:8:"menuLink";s:10:"items/show";}}}s:11:"permissions";a:3:{i:0;s:9:"items-add";i:1;s:10:"items-show";i:2;s:10:"items-edit";}}');

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
-- Table structure for table `cx_tag_branch_items`
--

CREATE TABLE IF NOT EXISTS `cx_tag_branch_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_item_branch` (`item_id`,`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `cx_tag_branch_items`
--

INSERT INTO `cx_tag_branch_items` (`id`, `item_id`, `branch_id`) VALUES
(22, 34, 1),
(18, 34, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cx_units`
--

CREATE TABLE IF NOT EXISTS `cx_units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cx_units`
--

INSERT INTO `cx_units` (`unit_id`, `unit_name`, `entry_by`) VALUES
(1, 'N/A', 1),
(2, 'Pcs', 1);

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
(1, 'srijon00@yahoo.com', '$2y$10$odRf8JHVH1Sn4TUDB13i..OJP5EKVn7uqVIqlUHVcfG2Rq/KXPcQa', 1, 2, 1, '2015-01-21 21:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `cx_vendors`
--

CREATE TABLE IF NOT EXISTS `cx_vendors` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_address` text NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cx_vendors`
--

INSERT INTO `cx_vendors` (`vendor_id`, `branch_id`, `vendor_name`, `vendor_address`, `entry_by`) VALUES
(1, 1, 'Dell Computers', 'This is a question not really about "programming" (is not specific to any language or database), but more of design and architecture.', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
