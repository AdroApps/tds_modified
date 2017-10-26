-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 05:34 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tds_modified`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_info`
--

CREATE TABLE `agent_info` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `auditor_id` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `service_charges` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_employees`
--

CREATE TABLE `client_employees` (
  `emp_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `pan` varchar(255) NOT NULL,
  `aadhar` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_employees`
--

INSERT INTO `client_employees` (`emp_id`, `client_id`, `pan`, `aadhar`, `emp_name`, `status`, `created_date`) VALUES
(7, 48, 'GPCTV7864Y', '345262357264', 'Suman Nari', 1, '2017-10-23 02:32:48'),
(8, 48, 'VNMGR365T', '892398126342', 'Priya Adula', 1, '2017-10-23 02:32:48'),
(9, 48, 'BVGTH657G', '649735743245', 'Sharath Achampet', 1, '2017-10-23 02:32:48'),
(10, 48, 'DVNTJ5624D', '298143859462', 'Vinay Kumar Reddy', 1, '2017-10-23 02:32:48'),
(11, 48, 'IFVSC8421O', '942028936537', 'Servesh Kinnera', 1, '2017-10-23 02:32:48'),
(12, 48, 'SPCBE339M', '427807693476', 'Praveen Nooli', 1, '2017-10-23 02:32:48'),
(13, 48, 'YGFHE94365', '853272349213', 'Swathi Kakarla', 1, '2017-10-23 02:32:48'),
(15, 48, 'AMEPC3594K', '234567899876', 'Rajesh Pasumarthi', 1, '2017-10-23 02:32:48'),
(27, 48, 'WEWWDDWDWD', '344433343343', 'afasfadf', 1, '2017-10-24 05:10:36'),
(28, 24, 'Ajkuiwerew', '9820130213213123', 'sdfjnjw', 1, '2017-10-26 04:53:03'),
(29, 24, 'Ajkddwerew', '3243253253452523', 'dgdfgd', 1, '2017-10-26 04:57:54'),
(30, 24, '3e3sfdrsdr', '2342343243242343', 'drsdfsd', 1, '2017-10-26 04:58:35'),
(31, 24, '435fdg4353', '3454353333333333', 'dfgd', 1, '2017-10-26 04:59:17'),
(32, 24, 'wq4ewdsfda', 'r3r3242342342423', 'xfsdfs', 1, '2017-10-26 05:00:15'),
(33, 48, 'dsuh7hjsh8', 'sdjfhd8ysfnjsdhf', 'hjhjk', 1, '2017-10-26 05:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `client_info`
--

CREATE TABLE `client_info` (
  `client_info_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `auditor_id` int(11) NOT NULL,
  `tan` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `service_charges` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_info`
--

INSERT INTO `client_info` (`client_info_id`, `client_id`, `auditor_id`, `tan`, `client_name`, `assigned_to`, `city`, `area`, `service_charges`, `created_date`) VALUES
(3, 48, 24, '1248451515', 'TCS', 53, 'Hyderabadi', 'Vidyanagar', '650', '2017-10-23 07:04:33'),
(4, 0, 24, '9832989833', 'Facebook', 0, 'Hyderabad', 'Hitech City', '900', '2017-10-22 04:55:50'),
(5, 52, 24, '9832989833', 'Facebook', 51, 'Hyderabad', 'Hitech City', '900', '2017-10-23 07:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `file_uploads_info`
--

CREATE TABLE `file_uploads_info` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `quarter_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_uploads_info`
--

INSERT INTO `file_uploads_info` (`file_id`, `file_name`, `quarter_id`, `user_id`, `created_date`) VALUES
(1, 'modified-pnv-seal.png', 7, 48, '2017-10-12 02:54:04'),
(2, 'anv-barrel-flag.png', 8, 48, '2017-10-18 05:34:11'),
(3, 'Employees.csv', 9, 48, '2017-10-23 02:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quarter_info`
--

CREATE TABLE `quarter_info` (
  `quarter_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `financial_year` varchar(255) NOT NULL,
  `quarter` varchar(255) NOT NULL,
  `authorised_person_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quarter_info`
--

INSERT INTO `quarter_info` (`quarter_id`, `client_id`, `financial_year`, `quarter`, `authorised_person_name`, `status`, `total_amount`, `created_date`) VALUES
(8, 48, '2017-2018', 'Q1', 'sruthi', '', 650, '2017-10-15 03:33:11'),
(11, 48, '2017-2018', 'Q2', 'fsfsq', '', 46400, '2017-10-23 02:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'superadmin'),
(2, 'auditor'),
(3, 'client'),
(4, 'author'),
(5, 'agent');

-- --------------------------------------------------------

--
-- Table structure for table `tds_info`
--

CREATE TABLE `tds_info` (
  `tds_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `quarter_id` int(11) NOT NULL,
  `salary1` int(11) NOT NULL,
  `month1` varchar(255) NOT NULL,
  `tdsamount1` int(11) NOT NULL,
  `salary2` int(11) NOT NULL,
  `month2` varchar(255) NOT NULL,
  `tdsamount2` int(11) NOT NULL,
  `salary3` int(11) NOT NULL,
  `month3` varchar(255) NOT NULL,
  `tdsamount3` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tds_info`
--

INSERT INTO `tds_info` (`tds_id`, `client_id`, `emp_id`, `quarter_id`, `salary1`, `month1`, `tdsamount1`, `salary2`, `month2`, `tdsamount2`, `salary3`, `month3`, `tdsamount3`, `total_amount`, `created_date`) VALUES
(7, 48, 3, 8, 0, 'January', 0, 0, 'Febuary', 0, 0, 'March', 0, 0, '2017-10-15 03:33:11'),
(8, 48, 4, 8, 0, 'January', 0, 0, 'Febuary', 0, 0, 'March', 0, 0, '2017-10-15 03:33:11'),
(22, 48, 3, 11, 0, 'April', 0, 0, 'May', 0, 0, 'June', 0, 0, '2017-10-23 02:41:00'),
(23, 48, 4, 11, 0, 'April', 0, 0, 'May', 0, 0, 'June', 0, 0, '2017-10-23 02:41:00'),
(24, 48, 7, 11, 0, 'April', 0, 0, 'May', 0, 0, 'June', 0, 0, '2017-10-23 02:41:00'),
(25, 48, 8, 11, 0, 'April', 0, 0, 'May', 0, 0, 'June', 0, 0, '2017-10-23 02:41:00'),
(26, 48, 9, 11, 0, 'April', 0, 0, 'May', 0, 1220, 'June', 0, 0, '2017-10-23 02:41:00'),
(27, 48, 10, 11, 1200, 'April', 120, 14550, 'May', 120, 0, 'June', 5000, 5240, '2017-10-23 02:41:00'),
(28, 48, 11, 11, 12000, 'April', 120, 34540, 'May', 12220, 12330, 'June', 1220, 13560, '2017-10-23 02:41:00'),
(29, 48, 12, 11, 12450, 'April', 20, 100, 'May', 1240, 12220, 'June', 11240, 12500, '2017-10-23 02:41:00'),
(30, 48, 13, 11, 0, 'April', 1200, 12440, 'May', 122, 12330, 'June', 1220, 2542, '2017-10-23 02:41:00'),
(31, 48, 14, 11, 67890, 'April', 5604, 12000, 'May', 1220, 14000, 'June', 1204, 8028, '2017-10-23 02:41:00'),
(32, 48, 15, 11, 14440, 'April', 1440, 12220, 'May', 1220, 12220, 'June', 1220, 3880, '2017-10-23 02:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emailId` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userid`, `username`, `password`, `emailId`, `phone_number`, `name`, `role_id`, `created_by`, `created_date`, `status`) VALUES
(1, 'superadmin', '186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae', 'superadmin@gmail.com', 1234567890, 'admin', 1, 0, '2017-10-02 13:11:06', 1),
(21, 'sruthi', 'f806dda5b31703a5e05a5f27ea0f5d168ccb16de3fde30db761aa2e39cff0e2e', 'sruthii@gmail.com', 1234567890, 'sruthi', 2, 1, '2017-10-03 02:53:40', 1),
(23, 'srsa', 'cc8844298c08e2fb7ba75080b9fad6fbd23d63bf3534c713e87ad87cee8f5b57', 'sr@gmail.com', 2147483647, 'sr', 2, 1, '2017-10-04 12:34:53', 1),
(24, 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'test@gmail.com', 1298979787, 'test', 2, 1, '2017-10-04 12:53:26', 1),
(25, 'test1', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', 'test1@gmail.com', 2147483647, 'sruthi', 2, 1, '2017-10-04 12:54:54', 1),
(48, 'tcs', '06b5472c16feae4ceaadcf836ff6fc198328b7d8a1ebf2b4c93f68003b2e0500', 'tcs@gmail.com', 2147483453, 'TCS', 3, 24, '2017-10-05 06:00:10', 1),
(51, 'author', '636485868971eac5aca33c4a0e1800a8a11d980bcf0e3776b31002e2c5db91b2', 'author@gmail.com', 1579746455, 'author', 4, 24, '2017-10-22 04:47:06', 1),
(52, 'FB', '57bf4c11f5b2fa031b8c770616c8da1766033bf7b7eaab148a58914a11f93091', 'fb@gmail.com', 1203839366, 'Facebook', 3, 24, '2017-10-22 04:56:50', 1),
(53, 'author1', '1d0e1b1bd678143a050f6cb90e6ebdfd2927c81b1321e1fc01f2e2490f1459c7', 'author1@gmail.com', 0, 'author1', 4, 24, '2017-10-22 05:05:22', 1),
(54, 'author3', '10967e2c53ac645db3c79a38cec93ba27316ece0aa06843198db1e17ed94648a', 'author3@gmail.com', 0, 'author3', 4, 24, '2017-10-25 04:04:28', 1),
(59, 'author2', '13be2a79c6805bd917d9a288f9f70d9178e2ff7b2d7b2d314590c35d92b28991', 'author2@gmail.com', 1234567899, 'author2', 4, 24, '2017-10-25 04:17:17', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_info`
--
ALTER TABLE `agent_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_employees`
--
ALTER TABLE `client_employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `client_info`
--
ALTER TABLE `client_info`
  ADD PRIMARY KEY (`client_info_id`);

--
-- Indexes for table `file_uploads_info`
--
ALTER TABLE `file_uploads_info`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `quarter_info`
--
ALTER TABLE `quarter_info`
  ADD PRIMARY KEY (`quarter_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tds_info`
--
ALTER TABLE `tds_info`
  ADD PRIMARY KEY (`tds_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `user_info_fk0` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_info`
--
ALTER TABLE `agent_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_employees`
--
ALTER TABLE `client_employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `client_info`
--
ALTER TABLE `client_info`
  MODIFY `client_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `file_uploads_info`
--
ALTER TABLE `file_uploads_info`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quarter_info`
--
ALTER TABLE `quarter_info`
  MODIFY `quarter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tds_info`
--
ALTER TABLE `tds_info`
  MODIFY `tds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_fk0` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
