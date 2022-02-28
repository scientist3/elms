-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 05:21 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_leave_ms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE `department_tbl` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `dept_doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `dept_dou` datetime DEFAULT NULL,
  `dept_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`dept_id`, `dept_name`, `dept_doc`, `dept_dou`, `dept_status`) VALUES
(1, 'Computer Science', '2022-02-24 16:03:03', '0000-00-00 00:00:00', 1),
(2, 'IT', '2022-02-25 03:44:09', NULL, 1),
(3, 'New Department', '2022-02-25 04:03:54', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `designation_tbl`
--

CREATE TABLE `designation_tbl` (
  `desg_id` int(11) NOT NULL,
  `desg_name` varchar(100) NOT NULL,
  `desg_doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `desg_dou` datetime DEFAULT NULL,
  `desg_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation_tbl`
--

INSERT INTO `designation_tbl` (`desg_id`, `desg_name`, `desg_doc`, `desg_dou`, `desg_status`) VALUES
(1, 'Assistant Professor', '2022-02-24 16:04:16', NULL, 1),
(2, 'Associatate Professor', '2022-02-24 16:04:16', NULL, 1),
(3, 'Lab Bearer', '2022-02-25 17:05:17', NULL, 0),
(4, 'Lab Assistant', '2022-02-25 17:08:20', NULL, 1),
(5, 'Contractual Lecturer', '2022-02-25 17:16:47', NULL, 1),
(6, 'Local Fund ', '2022-02-25 17:16:47', NULL, 1),
(7, 'Librarian', '2022-02-25 17:16:47', NULL, 1),
(8, 'PTI', '2022-02-25 17:16:47', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `institution_tbl`
--

CREATE TABLE `institution_tbl` (
  `inst_id` int(11) NOT NULL,
  `inst_name` varchar(200) NOT NULL,
  `inst_phone_no` varchar(15) NOT NULL,
  `inst_email_id` varchar(50) NOT NULL,
  `inst_logo` varchar(200) NOT NULL,
  `inst_admin_user_id` int(11) NOT NULL,
  `inst_doc` timestamp NULL DEFAULT current_timestamp(),
  `inst_dou` datetime DEFAULT NULL,
  `inst_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution_tbl`
--

INSERT INTO `institution_tbl` (`inst_id`, `inst_name`, `inst_phone_no`, `inst_email_id`, `inst_logo`, `inst_admin_user_id`, `inst_doc`, `inst_dou`, `inst_status`) VALUES
(1, 'SP Colleges', '9797101010', 'info@spcollege.com', './uploads/institution/adminprofilepic_1.png', 1, '2022-02-24 16:05:40', '2022-02-25 01:02:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leaves_tbl`
--

CREATE TABLE `leaves_tbl` (
  `l_id` int(11) NOT NULL,
  `l_leave_type_id` int(11) NOT NULL,
  `l_user_id` int(11) NOT NULL,
  `l_applied_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `l_from_date` date NOT NULL,
  `l_to_date` date NOT NULL,
  `l_is_half_day` enum('full_day','half_day','','') DEFAULT NULL,
  `l_first_or_second_half` enum('first_half','second_half','','') DEFAULT NULL,
  `l_reason` text DEFAULT NULL,
  `l_document` varchar(200) DEFAULT NULL,
  `l_status` int(11) NOT NULL,
  `l_comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves_tbl`
--

INSERT INTO `leaves_tbl` (`l_id`, `l_leave_type_id`, `l_user_id`, `l_applied_date`, `l_from_date`, `l_to_date`, `l_is_half_day`, `l_first_or_second_half`, `l_reason`, `l_document`, `l_status`, `l_comments`) VALUES
(6, 1, 3, '2022-02-27 14:32:42', '2022-02-27', '2022-02-27', 'full_day', NULL, '', NULL, 2, NULL),
(7, 2, 3, '2022-02-27 14:32:01', '2022-03-03', '2022-03-07', 'full_day', NULL, '', NULL, 2, NULL),
(8, 2, 3, '2022-02-27 14:32:01', '2022-03-03', '2022-03-07', 'full_day', NULL, '', NULL, 3, NULL),
(9, 2, 3, '2022-02-27 14:32:01', '2022-03-03', '2022-03-04', 'full_day', NULL, '', NULL, 1, NULL),
(10, 3, 3, '2022-02-27 14:32:23', '2022-02-27', '2022-02-28', 'full_day', NULL, '', NULL, 1, NULL),
(11, 3, 2, '2022-02-27 14:32:23', '2022-02-27', '2022-02-28', 'full_day', NULL, '', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leave_status_tbl`
--

CREATE TABLE `leave_status_tbl` (
  `ls_id` int(11) NOT NULL,
  `ls_name` varchar(200) NOT NULL,
  `ls_doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `ls_dou` datetime DEFAULT NULL,
  `ls_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_status_tbl`
--

INSERT INTO `leave_status_tbl` (`ls_id`, `ls_name`, `ls_doc`, `ls_dou`, `ls_status`) VALUES
(1, 'Unchecked / Pending', '2022-02-24 16:26:46', NULL, 1),
(2, 'Approved', '2022-02-24 16:26:46', NULL, 1),
(3, 'Reject', '2022-02-24 16:26:46', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leave_type_designation_mapping_tbl`
--

CREATE TABLE `leave_type_designation_mapping_tbl` (
  `ltdm_id` int(11) NOT NULL,
  `ltdm_lt_id` int(11) NOT NULL,
  `ltdm_desg_id` int(11) NOT NULL,
  `ltdm_allowed_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Allowed Time off based on leave type and designation ';

--
-- Dumping data for table `leave_type_designation_mapping_tbl`
--

INSERT INTO `leave_type_designation_mapping_tbl` (`ltdm_id`, `ltdm_lt_id`, `ltdm_desg_id`, `ltdm_allowed_days`) VALUES
(1, 1, 1, 14),
(2, 1, 2, 14),
(3, 1, 3, 14),
(4, 1, 4, 14),
(5, 1, 5, 14),
(6, 1, 6, 14),
(7, 1, 7, 14),
(8, 1, 8, 14),
(9, 2, 1, 10),
(10, 2, 2, 10),
(11, 2, 3, 10),
(12, 2, 4, 10),
(13, 2, 5, 0),
(14, 2, 6, 0),
(15, 2, 7, 10),
(16, 2, 8, 10),
(17, 3, 1, 0),
(18, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_type_tbl`
--

CREATE TABLE `leave_type_tbl` (
  `lt_id` int(11) NOT NULL,
  `lt_name` varchar(100) NOT NULL,
  `lt_doc` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lt_dou` datetime DEFAULT NULL,
  `lt_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_type_tbl`
--

INSERT INTO `leave_type_tbl` (`lt_id`, `lt_name`, `lt_doc`, `lt_dou`, `lt_status`) VALUES
(1, 'Casual Leave', '2022-02-24 16:19:02', NULL, 1),
(2, 'Medical Leave', '2022-02-25 17:15:20', NULL, 1),
(3, 'Maternity Leave', '2022-02-25 17:15:20', NULL, 1),
(4, 'Earned Leave', '2022-02-25 17:15:20', NULL, 1),
(5, 'Study Leave', '2022-02-25 17:15:20', NULL, 1),
(6, 'Half Pay Leave', '2022-02-25 17:15:20', NULL, 1),
(7, 'Child Care Leave', '2022-02-25 17:15:20', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `title`, `description`, `email`, `phone`, `logo`, `favicon`, `language`, `site_align`, `footer_text`) VALUES
(1, 'SP College', 'MA Road, Srinagar', 'info@spcollege.edu.in', '9906323232', 'uploads/site/logo/2022-02-25/S2.jpg', 'uploads/site/logo/2022-02-25/f.png', '0', NULL, '2022©Copyright SP College');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_tbl`
--

CREATE TABLE `user_role_tbl` (
  `ur_id` int(11) NOT NULL,
  `ur_name` varchar(50) NOT NULL,
  `ur_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role_tbl`
--

INSERT INTO `user_role_tbl` (`ur_id`, `ur_name`, `ur_status`) VALUES
(1, 'Admin', 1),
(2, 'Faculty', 1),
(3, 'HOD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `u_id` int(11) NOT NULL,
  `u_user_role` int(11) NOT NULL,
  `u_desg_id` int(11) DEFAULT NULL,
  `u_dept_id` int(11) DEFAULT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_username` varchar(11) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_password` varchar(500) NOT NULL,
  `u_mobile` varchar(15) DEFAULT NULL,
  `u_adress` varchar(11) NOT NULL,
  `u_picture` varchar(200) NOT NULL,
  `u_user_approval` tinyint(4) NOT NULL,
  `u_dob` date DEFAULT NULL,
  `u_doc` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_dou` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`u_id`, `u_user_role`, `u_desg_id`, `u_dept_id`, `u_name`, `u_username`, `u_email`, `u_password`, `u_mobile`, `u_adress`, `u_picture`, `u_user_approval`, `u_dob`, `u_doc`, `u_dou`, `u_status`) VALUES
(1, 1, NULL, NULL, 'Admin', 'admin', 'admin@elms.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '', '', 0, NULL, '2022-02-25 16:34:51', '2022-02-25 16:34:51', 1),
(2, 2, 2, 1, 'Wasi', 'wasi', 'faculty@elms.com', 'd561c7c03c1f2831904823a95835ff5f', '9797101010', 'Address Upd', 'uploads/faculty/profilepic/2022-02-26/f3.png', 0, '1993-10-04', '2022-02-26 15:06:38', '2022-02-26 10:32:38', 1),
(3, 2, 1, 1, 'Asif Wani', '', 'asif@gmail.com', 'a80043e63675e5ec2089b2355f5f819d', '', '', '', 0, '1996-05-06', '2022-02-27 18:33:20', '2022-02-27 18:33:20', 1),
(5, 2, 1, 2, 'Aamir Bashir', '', 'eraamirsofi@gmail.com', 'faculty@123', '+917006939042', '', '', 0, '1991-11-01', '2022-02-27 17:53:50', '2022-02-27 12:32:50', 1),
(6, 2, 2, 3, 'Anees', '', 'eraamirsofi@gmail.com', 'faculty@123', '+917006939042', '', '', 0, '1993-10-04', '2022-02-27 16:56:38', '2022-02-27 11:32:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `designation_tbl`
--
ALTER TABLE `designation_tbl`
  ADD PRIMARY KEY (`desg_id`);

--
-- Indexes for table `institution_tbl`
--
ALTER TABLE `institution_tbl`
  ADD PRIMARY KEY (`inst_id`),
  ADD KEY `inst_admin_user_id` (`inst_admin_user_id`);

--
-- Indexes for table `leaves_tbl`
--
ALTER TABLE `leaves_tbl`
  ADD PRIMARY KEY (`l_id`),
  ADD KEY `l_leave_type_id` (`l_leave_type_id`),
  ADD KEY `l_user_id` (`l_user_id`),
  ADD KEY `l_status` (`l_status`);

--
-- Indexes for table `leave_status_tbl`
--
ALTER TABLE `leave_status_tbl`
  ADD PRIMARY KEY (`ls_id`);

--
-- Indexes for table `leave_type_designation_mapping_tbl`
--
ALTER TABLE `leave_type_designation_mapping_tbl`
  ADD PRIMARY KEY (`ltdm_id`),
  ADD KEY `ltdm_lt_id` (`ltdm_lt_id`),
  ADD KEY `ltdm_desg_id` (`ltdm_desg_id`);

--
-- Indexes for table `leave_type_tbl`
--
ALTER TABLE `leave_type_tbl`
  ADD PRIMARY KEY (`lt_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `user_role_tbl`
--
ALTER TABLE `user_role_tbl`
  ADD PRIMARY KEY (`ur_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_user_role` (`u_user_role`),
  ADD KEY `u_dept_id` (`u_dept_id`),
  ADD KEY `u_desg_id` (`u_desg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designation_tbl`
--
ALTER TABLE `designation_tbl`
  MODIFY `desg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `institution_tbl`
--
ALTER TABLE `institution_tbl`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leaves_tbl`
--
ALTER TABLE `leaves_tbl`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `leave_status_tbl`
--
ALTER TABLE `leave_status_tbl`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_type_designation_mapping_tbl`
--
ALTER TABLE `leave_type_designation_mapping_tbl`
  MODIFY `ltdm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `leave_type_tbl`
--
ALTER TABLE `leave_type_tbl`
  MODIFY `lt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role_tbl`
--
ALTER TABLE `user_role_tbl`
  MODIFY `ur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `institution_tbl`
--
ALTER TABLE `institution_tbl`
  ADD CONSTRAINT `institution_tbl_ibfk_1` FOREIGN KEY (`inst_admin_user_id`) REFERENCES `user_tbl` (`u_id`);

--
-- Constraints for table `leaves_tbl`
--
ALTER TABLE `leaves_tbl`
  ADD CONSTRAINT `leaves_tbl_ibfk_1` FOREIGN KEY (`l_leave_type_id`) REFERENCES `leave_type_tbl` (`lt_id`),
  ADD CONSTRAINT `leaves_tbl_ibfk_2` FOREIGN KEY (`l_user_id`) REFERENCES `user_tbl` (`u_id`),
  ADD CONSTRAINT `leaves_tbl_ibfk_3` FOREIGN KEY (`l_status`) REFERENCES `leave_status_tbl` (`ls_id`);

--
-- Constraints for table `leave_type_designation_mapping_tbl`
--
ALTER TABLE `leave_type_designation_mapping_tbl`
  ADD CONSTRAINT `leave_type_designation_mapping_tbl_ibfk_1` FOREIGN KEY (`ltdm_lt_id`) REFERENCES `leave_type_tbl` (`lt_id`),
  ADD CONSTRAINT `leave_type_designation_mapping_tbl_ibfk_2` FOREIGN KEY (`ltdm_desg_id`) REFERENCES `designation_tbl` (`desg_id`);

--
-- Constraints for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD CONSTRAINT `user_tbl_ibfk_1` FOREIGN KEY (`u_user_role`) REFERENCES `user_role_tbl` (`ur_id`),
  ADD CONSTRAINT `user_tbl_ibfk_2` FOREIGN KEY (`u_dept_id`) REFERENCES `department_tbl` (`dept_id`),
  ADD CONSTRAINT `user_tbl_ibfk_3` FOREIGN KEY (`u_desg_id`) REFERENCES `designation_tbl` (`desg_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
