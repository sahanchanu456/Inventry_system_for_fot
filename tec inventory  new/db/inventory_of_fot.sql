-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 11, 2020 at 08:06 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_of_fot`
--

-- --------------------------------------------------------

--
-- Table structure for table `brocken_report`
--

DROP TABLE IF EXISTS `brocken_report`;
CREATE TABLE IF NOT EXISTS `brocken_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `reporter_id` varchar(11) NOT NULL,
  `barcode_no` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `if_job_done` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` varchar(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dispose_good`
--

DROP TABLE IF EXISTS `dispose_good`;
CREATE TABLE IF NOT EXISTS `dispose_good` (
  `barcode_no` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `purchased_invoice_no` varchar(20) NOT NULL,
  `model_no` varchar(20) NOT NULL,
  `purchased_date` date NOT NULL,
  `serial_no` varchar(50) NOT NULL,
  `purchased_company` varchar(5) NOT NULL,
  `purchased_price` float NOT NULL,
  `inventory_page_no` int(11) NOT NULL,
  `last_department` varchar(5) NOT NULL,
  `fixed_asset_code` varchar(20) NOT NULL,
  `store_book_page_no` int(11) NOT NULL,
  `GRN_no` varchar(5) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dispose_date` date NOT NULL,
  PRIMARY KEY (`barcode_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `user_id` varchar(20) NOT NULL,
  `barcode_no` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`barcode_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `good`
--

DROP TABLE IF EXISTS `good`;
CREATE TABLE IF NOT EXISTS `good` (
  `barcode_no` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `serial_number` varchar(50) NOT NULL,
  `model_no` varchar(20) NOT NULL,
  `invoice_no` varchar(20) NOT NULL,
  `warranty` float NOT NULL,
  `date` date NOT NULL,
  `purchesed_companty` varchar(5) NOT NULL,
  `inventory_page_no` int(11) NOT NULL,
  `current_department` varchar(5) DEFAULT NULL,
  `fix_asset_code` varchar(20) NOT NULL,
  `store_book_page_no` int(11) NOT NULL,
  `GRN_no` varchar(5) NOT NULL,
  `buyer_job_possession` varchar(20) DEFAULT NULL,
  `buyer_department` varchar(5) NOT NULL,
  `current_state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`barcode_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_and_lecture_hall_time_table`
--

DROP TABLE IF EXISTS `lab_and_lecture_hall_time_table`;
CREATE TABLE IF NOT EXISTS `lab_and_lecture_hall_time_table` (
  `hall_id` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `Sunday` varchar(20) NOT NULL,
  `Monday` varchar(20) NOT NULL,
  `Tuesday` varchar(20) NOT NULL,
  `Wednesday` varchar(20) NOT NULL,
  `Thursday` varchar(20) NOT NULL,
  `Friday` varchar(20) NOT NULL,
  `Saturday` varchar(20) NOT NULL,
  PRIMARY KEY (`hall_id`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecture_hall_and_lab`
--

DROP TABLE IF EXISTS `lecture_hall_and_lab`;
CREATE TABLE IF NOT EXISTS `lecture_hall_and_lab` (
  `id` varchar(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `department` varchar(5) NOT NULL,
  `wich_flow` int(1) NOT NULL,
  `what_building` varchar(20) DEFAULT NULL,
  `lecture_hall_or_lab` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE IF NOT EXISTS `model` (
  `model_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `subcategory_id` varchar(5) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_item_request`
--

DROP TABLE IF EXISTS `new_item_request`;
CREATE TABLE IF NOT EXISTS `new_item_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `requester_id` varchar(20) NOT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `model_no` varchar(20) DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `did_seen` int(1) NOT NULL DEFAULT 0,
  `confirm` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permanent_moved_good`
--

DROP TABLE IF EXISTS `permanent_moved_good`;
CREATE TABLE IF NOT EXISTS `permanent_moved_good` (
  `barcode_no` varchar(20) NOT NULL,
  `send_date` datetime NOT NULL,
  `sender_id` varchar(5) NOT NULL,
  `sender_department` varchar(5) NOT NULL,
  `sender_note` varchar(255) NOT NULL,
  `sender_reason` varchar(50) NOT NULL,
  `receiver_id` varchar(5) NOT NULL,
  `receiver_department` varchar(5) NOT NULL,
  `confirm_received` int(1) NOT NULL,
  `receiver_reason` varchar(50) NOT NULL,
  `receiver_note` varchar(255) NOT NULL,
  PRIMARY KEY (`barcode_no`,`send_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_to_wellamadama`
--

DROP TABLE IF EXISTS `return_to_wellamadama`;
CREATE TABLE IF NOT EXISTS `return_to_wellamadama` (
  `barcode_no` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `purchased_invoice_no` varchar(20) NOT NULL,
  `model_no` varchar(20) NOT NULL,
  `purchased_date` date NOT NULL,
  `serial_no` varchar(50) NOT NULL,
  `purchased_company` varchar(5) NOT NULL,
  `purchased_price` float NOT NULL,
  `inventory_page_no` int(11) NOT NULL,
  `last_department` varchar(5) NOT NULL,
  `fixed_asset_code` varchar(20) NOT NULL,
  `store_book_page_no` int(11) NOT NULL,
  `GRN_no` varchar(5) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `returned_date` date NOT NULL,
  PRIMARY KEY (`barcode_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_requirement_item`
--

DROP TABLE IF EXISTS `service_requirement_item`;
CREATE TABLE IF NOT EXISTS `service_requirement_item` (
  `barcode_no` varchar(20) NOT NULL,
  `problem` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `requester_id` varchar(5) NOT NULL,
  `requester_note` varchar(255) DEFAULT NULL,
  `AR_confirm` varchar(10) DEFAULT NULL,
  `AR_note` varchar(255) DEFAULT NULL,
  `service_provider_id` varchar(5) DEFAULT NULL,
  `service_provider_confirm` varchar(10) DEFAULT NULL,
  `sevice_provider_note` varchar(255) DEFAULT NULL,
  `if_job_done` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`barcode_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sold_good`
--

DROP TABLE IF EXISTS `sold_good`;
CREATE TABLE IF NOT EXISTS `sold_good` (
  `barcode_no` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `purchased_invoice_no` varchar(20) NOT NULL,
  `model_no` varchar(20) NOT NULL,
  `purchased_date` date NOT NULL,
  `serial_no` varchar(50) NOT NULL,
  `purchased_company` varchar(5) NOT NULL,
  `purchased_price` float NOT NULL,
  `inventory_page_no` int(11) NOT NULL,
  `last_department` varchar(5) NOT NULL,
  `fixed_asset_code` varchar(20) NOT NULL,
  `store_book_page_no` int(11) NOT NULL,
  `GRN_no` varchar(5) NOT NULL,
  `reason` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sold_date` date NOT NULL,
  `sold_price` float NOT NULL,
  PRIMARY KEY (`barcode_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `job_possession` varchar(20) NOT NULL,
  `department_id` varchar(5) NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_verification` int(1) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `registered_date` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year` year(4) NOT NULL,
  `registered_date` datetime NOT NULL,
  `department` varchar(5) NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_verification` int(1) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `subcategory_id` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `maincategory_id` varchar(5) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_moved_good`
--

DROP TABLE IF EXISTS `temporary_moved_good`;
CREATE TABLE IF NOT EXISTS `temporary_moved_good` (
  `barcode_no` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `day_the_end_of_mvement` date DEFAULT NULL,
  `move_to_wich_department` varchar(5) NOT NULL,
  `whome` varchar(5) NOT NULL,
  `for_what` varchar(255) NOT NULL,
  `confirm_moved` varchar(10) DEFAULT NULL,
  `receiver_id` varchar(5) DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`barcode_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
