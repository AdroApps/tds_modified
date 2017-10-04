-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2017 at 07:13 AM
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
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `city` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `service_changes` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'superadmin', '186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae', 'superadmin@gmail.com', 1234567890, '', 1, 0, '2017-10-02 13:11:06', 1),
(21, 'sruthi', 'f806dda5b31703a5e05a5f27ea0f5d168ccb16de3fde30db761aa2e39cff0e2e', 'sruthii@gmail.com', 1234567890, 'sruthi', 2, 1, '2017-10-03 02:53:40', 1),
(23, 'srsa', 'cc8844298c08e2fb7ba75080b9fad6fbd23d63bf3534c713e87ad87cee8f5b57', 'sr@gmail.com', 2147483647, 'sr', 2, 1, '2017-10-04 12:34:53', 1),
(24, 'test', '3de740d12dc67b5b1db699424c130847782ce422cdaa4e7c33a5de0ad9de5f66', 'test@gmail.com', 1298979787, 'test', 2, 1, '2017-10-04 12:53:26', 1),
(25, 'test1', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', 'test1@gmail.com', 2147483647, 'sruthi', 2, 1, '2017-10-04 12:54:54', 1);

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
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_info`
--
ALTER TABLE `client_info`
  MODIFY `client_info_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tds_info`
--
ALTER TABLE `tds_info`
  MODIFY `tds_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
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
