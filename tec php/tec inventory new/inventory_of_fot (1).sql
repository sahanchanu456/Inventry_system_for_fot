-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 27, 2021 at 06:42 AM
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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`) VALUES
('id', 'name', 'des'),
('TBL01', 'Table', 'Wooden Table');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `description`) VALUES
('ET', 'et deprtment', 'Department of ET'),
('FINANCE', 'finance department', 'department of finance'),
('ADM', 'Administration', 'Administration Department'),
('dept1', 'department 1', 'department');

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
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_item_id` varchar(250) NOT NULL,
  `feedback_user_id` varchar(250) NOT NULL,
  `feedback_user_state` varchar(50) NOT NULL,
  `feedback_feed` varchar(800) NOT NULL,
  `feedback_date` date NOT NULL DEFAULT current_timestamp(),
  `feedback_tital` varchar(800) NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback_item_id`, `feedback_user_id`, `feedback_user_state`, `feedback_feed`, `feedback_date`, `feedback_tital`) VALUES
(38, '6', 'ad01', 'Admin', '                        Nice Item', '2021-01-20', 'Good'),
(37, '6', 'ad01', 'Admin', '                        Nice Item', '2021-01-20', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(200) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(250) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(800) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `serial_number` varchar(50) NOT NULL,
  `model_id` varchar(20) NOT NULL,
  `catagory` varchar(200) NOT NULL,
  `sub_catagory` varchar(200) NOT NULL,
  `invoice_no` varchar(20) NOT NULL,
  `warranty` date NOT NULL,
  `date` date NOT NULL,
  `purchesed_companty` varchar(50) NOT NULL,
  `inventory_page_no` int(11) NOT NULL,
  `current_department` varchar(5) DEFAULT NULL,
  `GRN_no` varchar(255) NOT NULL,
  `move_sate` varchar(20) DEFAULT NULL,
  `owner_department` varchar(5) NOT NULL,
  `current_state` varchar(50) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `qr` varchar(800) NOT NULL,
  `add_user` varchar(250) NOT NULL,
  `depreciation` int(50) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `barcode`, `name`, `description`, `price`, `serial_number`, `model_id`, `catagory`, `sub_catagory`, `invoice_no`, `warranty`, `date`, `purchesed_companty`, `inventory_page_no`, `current_department`, `GRN_no`, `move_sate`, `owner_department`, `current_state`, `image`, `pdf`, `qr`, `add_user`, `depreciation`) VALUES
(6, '2343', 'item03', 'Electric item', 1000, 'i1000023', 'm12', 'ch01', 'wchair01', '96', '2022-08-24', '2021-01-20', 'ewiz', 5, 'ET', '002', 'NO', 'ET', 'GOOD', 'img/item/itemdownload (1).jpg', 'pdf/pdfPDF Test.pdf', 'img/qr/ch01_wchair01_m12_ET_item02.png', 'ad01', 7),
(7, 'TBL01/wchair01/m12/ET/item04', 'item04', 'abcde', 4000, '12345', 'm12', 'TBL01', 'wchair01', '234', '2022-10-21', '2021-01-21', 'e wis', 2, 'ET', '456', 'NO', 'ADM', 'GOOD', 'img/item/itemCLASS.jpg', 'pdf/pdfLecture8 - Class Diagrams.pdf', 'img/qr/TBL01_wchair01_m12_ET_item04.png', 'ad01', 10),
(8, 'TBL01/wchair01/m12/ET/item04', 'item04', 'abcde', 4000, '12345', 'm12', 'TBL01', 'wchair01', '234', '2022-10-21', '2021-01-21', 'e wis', 2, 'ET', '456', 'NO', 'ADM', 'GOOD', 'img/item/itemCLASS.jpg', 'pdf/pdfLecture8 - Class Diagrams.pdf', 'img/qr/TBL01_wchair01_m12_ET_item04.png', 'ad01', 10);

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
-- Table structure for table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `maintenance_id` int(200) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(800) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `user_state` varchar(200) NOT NULL,
  `maintenance_note` varchar(600) NOT NULL,
  `apprue_user_id` varchar(200) DEFAULT 'not yet',
  `apprue_user_state` varchar(250) DEFAULT 'not yet',
  `apprue_user_note` varchar(700) DEFAULT 'not yet',
  `state` varchar(250) NOT NULL DEFAULT 'not yet',
  `add_date` date NOT NULL DEFAULT current_timestamp(),
  `apprue_date` date DEFAULT NULL,
  `department` varchar(200) NOT NULL,
  PRIMARY KEY (`maintenance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`maintenance_id`, `item_id`, `user_id`, `user_state`, `maintenance_note`, `apprue_user_id`, `apprue_user_state`, `apprue_user_note`, `state`, `add_date`, `apprue_date`, `department`) VALUES
(19, '6', 'ad01', 'Admin', '                        Wheel broken', 'No', 'No', 'No', 'New', '2021-01-20', NULL, 'ET');

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

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `name`, `subcategory_id`, `description`) VALUES
('m123', 'damro chair', 'ch123', 'damro new chair'),
('m12', 'olitrone chair', 'ch124', 'damro wood chair');

-- --------------------------------------------------------

--
-- Table structure for table `move`
--

DROP TABLE IF EXISTS `move`;
CREATE TABLE IF NOT EXISTS `move` (
  `move_id` int(200) NOT NULL AUTO_INCREMENT,
  `item_id` int(200) DEFAULT NULL,
  `item_name` varchar(150) NOT NULL,
  `current_department` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `return_date` date DEFAULT NULL,
  `requestdepartment_approve` int(1) NOT NULL DEFAULT 0,
  `move_type` varchar(50) DEFAULT NULL,
  `move_department` varchar(200) DEFAULT NULL,
  `description` varchar(700) DEFAULT NULL,
  `ownerdepartment_approve` int(1) NOT NULL DEFAULT 0,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`move_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `move`
--

INSERT INTO `move` (`move_id`, `item_id`, `item_name`, `current_department`, `quantity`, `request_date`, `return_date`, `requestdepartment_approve`, `move_type`, `move_department`, `description`, `ownerdepartment_approve`, `status`) VALUES
(1, 123, 'chair', 'dsd', 1, '2020-11-27 19:10:26', '2020-11-25', 0, 'ddd', 'dd', 'dd', 1, 'delivering'),
(2, NULL, 'chair', 'ict', 1, '2020-12-16 11:01:10', '2020-12-15', 0, 'Temporary', '{user_department}', 'kyfyfjytf', 1, 'delivering'),
(3, NULL, 'chair', 'et', 1, '2020-12-16 11:03:12', '2020-12-26', 0, 'Permanent', 'ICT', 'hk jhj bj', 1, 'delivering'),
(9, NULL, 'guyoiyoihhugyg6fgt', 'ICT', 0, '2021-01-20 13:43:14', '2021-01-21', 0, 'Permanent', '{user_department}', 'hkh k,kgj hfhgh', 1, 'delivering'),
(10, NULL, 'putu', 'ICT', 0, '2021-01-20 18:27:59', '2021-01-13', 0, 'Temporary', 'ET', 'test', 1, 'delivering'),
(11, NULL, 'putu', 'ICT', 0, '2021-01-20 20:13:10', '2021-01-22', 0, 'Permanent', 'ET', 'ghg hjkh hvh', 1, 'delivering'),
(12, NULL, 'motre', 'ICT', 0, '2021-01-20 20:26:59', '2021-01-21', 0, 'Temporary', 'ICT', 'test', 1, 'delivering');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_item_request`
--

INSERT INTO `new_item_request` (`request_id`, `requester_id`, `item_name`, `model_no`, `problem`, `date`, `did_seen`, `confirm`) VALUES
(1, 'tg/2017/252', 'sfsg', 'sgsg', 'sggg', '2020-12-15 09:14:27', 0, 0),
(2, 'tg/2017/252', 'putu', 'kushan', 'lii ewa bA', '2021-01-19 12:26:08', 0, 0);

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
  `job_position` varchar(20) NOT NULL,
  `department_id` varchar(10) NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_verification` int(1) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `registered_date` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `job_position`, `department_id`, `telephone`, `email`, `email_verification`, `state`, `registered_date`, `password`, `image`) VALUES
('ad01', 'pawan sandeepa', 'Admin', 'ICT', 717985631, 'foruniversity@gmail.com', 1, 'WorKing', '2020-12-12 00:00:00', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffslide34.jpg'),
('TO01', 'Surendra Perera', 'TO', 'ICT', 717985631, 'surendrar@gmail.com', 1, 'WorKing', '2021-01-20 03:43:16', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffOIP (2).jpg'),
('DH01', 'Subhash Jayasinghe', 'Head', 'ICT', 717985631, 'subhash@gmail.com', 1, 'WorKing', '2021-01-20 03:47:39', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffR379ec6ac644f36b446582a0df3a889b3.jpg'),
('TO02', 'Richard Siriwardana', 'TO', 'ET', 717985631, 'richard@gmail.com', 1, 'WorKing', '2021-01-20 03:44:28', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffR379ec6ac644f36b446582a0df3a889b3.jpg'),
('AB01', 'Rebeca Jayawardana', 'AB', 'FINANCE', 717985631, 'rebeca@gmail.com', 1, 'WorKing', '2021-01-20 03:40:26', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffOIP.jpg'),
('WDN01', 'Chamari Thapattu', 'Warden', 'ICT', 717985631, 'chamari@gmail.com', 1, 'WorKing', '2021-01-20 03:49:53', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffcad7ecb9255bf44a12739af346f8b52d--jade-weber-photo-instagram.jpg'),
('SVY01', 'Kumara Pathirana', 'Servei', 'ICT', 717985632, 'kumara@gmail.com', 1, 'WorKing', '2021-01-20 03:51:20', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffLatest-Cool-Boys-Profile-25.jpg'),
('ad03', 'new admin', 'Admin', 'ADM', 717985631, 'iufhiuef@gmail.com', 1, 'Retire', '2021-01-21 03:50:52', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffslide40.jpg'),
('jdhf', 'pawan', 'Admin', 'ADM', 717985631, 'iufhiuef@gmail.com', 1, 'Retire', '2021-01-21 03:52:45', '827ccb0eea8a706c4c34a16891f84e7b', 'img/user/staffslide39.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year` year(4) NOT NULL,
  `registered_date` datetime NOT NULL DEFAULT current_timestamp(),
  `department_id` varchar(10) NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_verification` int(1) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `year`, `registered_date`, `department_id`, `telephone`, `email`, `email_verification`, `password`, `image`) VALUES
('tg/2017/255', 'pawan2 sandeepa2', 2017, '2021-01-19 01:11:14', 'ET', 717985631, 'ddpawansandeepa@gmail.com', 1, '827ccb0eea8a706c4c34a16891f84e7b', ''),
('tg/2017/252', 'pawan sandeepa', 2017, '2021-01-19 01:15:02', 'ICT', 717985631, 'ddpawansandeepa@gmail.com', 1, '3f088ebeda03513be71d34d214291986', ''),
('tg/2017/258', 'vitha gobbaya', 2017, '2021-01-19 17:38:00', 'ICT', 717985631, 'foruniversity@gmail.com', 1, '3f088ebeda03513be71d34d214291986', 'img/user/uservlcsnap-2019-10-18-17h49m52s578.png'),
('tg/2017/259', 'pawan2 sandeepa2', 2017, '2021-01-20 11:01:27', 'ICT', 717985631, 'foruniversity@gmail.com', 1, '3f088ebeda03513be71d34d214291986', 'img/user/userBMI calculator.png');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `subcategory_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `maincategory_id` varchar(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `name`, `maincategory_id`, `description`) VALUES
('wchair01', 'Wooden chair type 02', 'id', 'wooden chair with arms');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `address`, `telephone`, `email`, `note`) VALUES
('sup2', 'sahan chamika', 'kamburupitiya', '123-4567891', 'sahan@dsjk', ''),
('sup3', 'sdsd', 'dsds', '123-4567891', 'adad@dsjk', '');

-- --------------------------------------------------------

--
-- Table structure for table `surver_data`
--

DROP TABLE IF EXISTS `surver_data`;
CREATE TABLE IF NOT EXISTS `surver_data` (
  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `surve_ Id` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `item_department` varchar(300) NOT NULL,
  `model_name` varchar(200) NOT NULL,
  `main_catagory` varchar(100) NOT NULL,
  `catagory` varchar(100) NOT NULL,
  `move_state` varchar(100) NOT NULL,
  `warranty` varchar(100) NOT NULL,
  `add_user` varchar(100) NOT NULL,
  `move_department` varchar(100) NOT NULL,
  `current_department` varchar(100) NOT NULL,
  `current_state` varchar(100) NOT NULL,
  PRIMARY KEY (`temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surver_data`
--

INSERT INTO `surver_data` (`temp_id`, `surve_ Id`, `date`, `item_id`, `item_name`, `item_department`, `model_name`, `main_catagory`, `catagory`, `move_state`, `warranty`, `add_user`, `move_department`, `current_department`, `current_state`) VALUES
(14, '', '2021-01-20', '', '', '', '', '', '', '', '', '', '', 'IT', 'good'),
(15, '', '2021-01-20', '', '', '', '', '', '', '', '', '', '', 'IT', 'good'),
(13, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(12, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(11, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(10, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(9, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(8, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(7, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(6, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(5, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(4, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(3, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(2, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'ict', 'return to wellamadama'),
(1, '0', '2021-01-20', '346', 'keybode', 'it', '', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'IT', 'disposed'),
(16, '', '2021-01-20', '', '', '', '', '', '', '', '', '', '', 'IT', 'good'),
(17, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(18, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(19, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(22, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(23, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(24, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(25, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(26, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(27, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(28, '', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(38, '202101209', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(39, '202101209', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(37, '202101209', '2021-01-20', '346', 'keybode', 'it', '353454', 'computer', 'electronic', 'no', '2020-12-02', 'fdgfg', 'it', 'BST', '0'),
(40, '202101203', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0'),
(41, '202101203', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0'),
(42, '202101203', '2021-01-20', '', '', '', '', '', '', '', '', '', '', 'ictdep', '0'),
(43, '202101203', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0'),
(44, '202101203', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0'),
(45, '202101203', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0'),
(46, '202101203', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', 'return to wellamadama'),
(47, '202101203', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0'),
(48, '202101203', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0'),
(49, '202101205', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0'),
(50, '202101205', '2021-01-20', '6', 'item02', 'ET', 'm12', 'ch01', 'wchair01', 'NO', '2022-08-24', 'ad01', 'ET', 'ictdep', '0');

-- --------------------------------------------------------

--
-- Table structure for table `surver_data_tempory`
--

DROP TABLE IF EXISTS `surver_data_tempory`;
CREATE TABLE IF NOT EXISTS `surver_data_tempory` (
  `temp_id` int(100) NOT NULL AUTO_INCREMENT,
  `surve_id` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `item_department` varchar(300) NOT NULL,
  `model_id` varchar(200) NOT NULL,
  `main_catagory` varchar(100) NOT NULL,
  `catagory` varchar(100) NOT NULL,
  `move_state` varchar(100) NOT NULL,
  `warranty` varchar(100) NOT NULL,
  `add_user` varchar(100) NOT NULL,
  `move_department` varchar(100) NOT NULL,
  `current_department` varchar(100) NOT NULL,
  `current_state` varchar(100) NOT NULL,
  PRIMARY KEY (`temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_information`
--

DROP TABLE IF EXISTS `survey_information`;
CREATE TABLE IF NOT EXISTS `survey_information` (
  `surve_Id` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `survey_oficer_name_01` varchar(200) NOT NULL,
  `survey_oficer_name_02` varchar(200) NOT NULL,
  `hope_to_end` date NOT NULL,
  `survey_user` varchar(100) NOT NULL,
  PRIMARY KEY (`surve_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_information`
--

INSERT INTO `survey_information` (`surve_Id`, `start_date`, `survey_oficer_name_01`, `survey_oficer_name_02`, `hope_to_end`, `survey_user`) VALUES
('202101201', '2021-01-20', 'vithakshana', 'Wickramasekara', '2021-01-07', 'staf01'),
('202101202', '2021-01-20', 'vithakshana', 'Wickramasekara', '2021-01-07', 'staf01'),
('202101203', '2021-01-20', 'vithakshana', 'wickramasekara', '2021-01-14', 'staf01'),
('202101204', '2021-01-20', 'vithakshana', 'wickramasekara', '2021-01-07', 'staf01'),
('202101205', '2021-01-20', 'vithakshana', 'wickramasekara', '2021-01-08', 'staf01');

-- --------------------------------------------------------

--
-- Table structure for table `temporary_moved_item`
--

DROP TABLE IF EXISTS `temporary_moved_item`;
CREATE TABLE IF NOT EXISTS `temporary_moved_item` (
  `move_id` int(200) NOT NULL,
  `item_id` int(200) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`item_id`,`move_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temporary_moved_item`
--

INSERT INTO `temporary_moved_item` (`move_id`, `item_id`, `description`) VALUES
(9, 54656, NULL),
(9, 1, NULL),
(9, 2, NULL),
(11, 3, NULL),
(10, 3, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
