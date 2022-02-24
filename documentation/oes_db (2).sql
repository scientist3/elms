-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2021 at 06:39 PM
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
-- Database: `oes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl`
--

CREATE TABLE `exam_tbl` (
  `e_id` int(11) NOT NULL COMMENT 'ID',
  `e_name` varchar(100) NOT NULL COMMENT 'Stores Examination name',
  `e_reg_start` datetime NOT NULL,
  `e_reg_end` datetime NOT NULL,
  `e_exam_start` datetime NOT NULL,
  `e_exam_end` datetime NOT NULL,
  `e_doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `e_dou` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `e_created_by` int(11) NOT NULL,
  `e_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_tbl`
--

INSERT INTO `exam_tbl` (`e_id`, `e_name`, `e_reg_start`, `e_reg_end`, `e_exam_start`, `e_exam_end`, `e_doc`, `e_dou`, `e_created_by`, `e_status`) VALUES
(10, 'Test 1', '2021-10-01 09:00:00', '2021-10-06 09:00:00', '2021-10-15 10:00:00', '2021-10-15 10:30:00', '2021-09-30 18:40:00', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `option_tbl`
--

CREATE TABLE `option_tbl` (
  `o_id` int(11) NOT NULL,
  `o_q_id` int(11) NOT NULL,
  `o_value` varchar(200) NOT NULL,
  `o_correct` varchar(200) NOT NULL,
  `o_doc` datetime NOT NULL,
  `o_dou` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `o_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `option_tbl`
--

INSERT INTO `option_tbl` (`o_id`, `o_q_id`, `o_value`, `o_correct`, `o_doc`, `o_dou`, `o_status`) VALUES
(2, 2, 'PHP is a programming language.', '1', '2021-09-06 16:00:26', '2021-09-06 14:02:12', 1),
(3, 2, 'PHP is arts book.', '0', '2021-09-06 16:00:26', '2021-09-06 14:02:12', 1),
(4, 2, 'PHP is a keyboard type.', '0', '2021-09-06 16:00:26', '2021-09-06 14:02:12', 1),
(52, 18, 'Test Option 1', '0', '0000-00-00 00:00:00', '2021-10-01 16:05:32', 1),
(53, 18, 'Test Option 2', '0', '0000-00-00 00:00:00', '2021-10-01 16:05:32', 1),
(54, 18, 'Test Option 3', '1', '0000-00-00 00:00:00', '2021-10-01 16:05:32', 1),
(55, 18, 'Test Option 4', '0', '0000-00-00 00:00:00', '2021-10-01 16:05:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_tbl`
--

CREATE TABLE `question_tbl` (
  `q_id` int(11) NOT NULL,
  `q_e_id` int(11) NOT NULL COMMENT 'Exam Id',
  `q_question` varchar(1000) NOT NULL,
  `q_doc` datetime NOT NULL,
  `q_dou` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `q_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_tbl`
--

INSERT INTO `question_tbl` (`q_id`, `q_e_id`, `q_question`, `q_doc`, `q_dou`, `q_status`) VALUES
(18, 10, 'Test Question 1', '2021-10-01 21:10:32', '2021-10-01 16:05:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `responses_tbl`
--

CREATE TABLE `responses_tbl` (
  `r_id` int(11) NOT NULL,
  `r_u_id` int(11) NOT NULL COMMENT 'Student Id',
  `r_q_id` int(11) NOT NULL COMMENT 'Question Id',
  `r_o_id` int(11) NOT NULL COMMENT 'Selected Option ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_tbl`
--

CREATE TABLE `student_exam_tbl` (
  `se_id` int(11) NOT NULL,
  `se_u_id` int(11) NOT NULL COMMENT 'Student id',
  `se_e_id` int(11) NOT NULL COMMENT 'Exam id',
  `se_applied_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'When applied for the exam',
  `se_attempted` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Whether attempted the exam or not',
  `se_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Student', 1),
(3, 'Teacher', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `u_id` int(11) NOT NULL,
  `u_user_role` int(11) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_username` varchar(11) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_password` varchar(500) NOT NULL,
  `u_mobile` int(11) NOT NULL,
  `u_adress` varchar(11) NOT NULL,
  `u_picture` varchar(11) NOT NULL,
  `u_user_approval` tinyint(4) NOT NULL,
  `u_doc` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_dou` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`u_id`, `u_user_role`, `u_name`, `u_username`, `u_email`, `u_password`, `u_mobile`, `u_adress`, `u_picture`, `u_user_approval`, `u_doc`, `u_dou`, `u_status`) VALUES
(1, 1, 'Admin', 'admin', 'admin@oes.com', '21232f297a57a5a743894a0e4a801fc3', 0, '', '', 1, '2021-09-14 03:44:45', '2021-09-14 03:44:45', 1),
(2, 2, 'Student', 'student', 'student@oes.com', 'cd73502828457d15655bbd7a63fb0bc8', 0, '', '', 1, '2021-09-14 03:45:44', '2021-09-14 03:45:44', 1),
(3, 3, 'Teacher', 'teacher', 'teacher@oes.com', '8d788385431273d11e8b43bb78f3aa41', 0, '', '', 1, '2021-09-14 03:58:15', '2021-09-14 03:58:15', 1),
(4, 2, 'Student 1', 'student1', 'student1@oes.com', 'student1', 0, '', '', 1, '2021-09-14 03:46:21', '2021-09-14 03:46:21', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `option_tbl`
--
ALTER TABLE `option_tbl`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `o_q_id` (`o_q_id`);

--
-- Indexes for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD PRIMARY KEY (`q_id`),
  ADD KEY `q_e_id` (`q_e_id`);

--
-- Indexes for table `responses_tbl`
--
ALTER TABLE `responses_tbl`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `r_u_id` (`r_u_id`,`r_q_id`,`r_o_id`),
  ADD KEY `responses_tbl_ibfk_1` (`r_q_id`),
  ADD KEY `responses_tbl_ibfk_2` (`r_o_id`);

--
-- Indexes for table `student_exam_tbl`
--
ALTER TABLE `student_exam_tbl`
  ADD PRIMARY KEY (`se_id`),
  ADD KEY `se_u_id` (`se_u_id`),
  ADD KEY `se_e_id` (`se_e_id`);

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
  ADD KEY `u_user_role` (`u_user_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `option_tbl`
--
ALTER TABLE `option_tbl`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `question_tbl`
--
ALTER TABLE `question_tbl`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `responses_tbl`
--
ALTER TABLE `responses_tbl`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_exam_tbl`
--
ALTER TABLE `student_exam_tbl`
  MODIFY `se_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role_tbl`
--
ALTER TABLE `user_role_tbl`
  MODIFY `ur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD CONSTRAINT `question_tbl_ibfk_1` FOREIGN KEY (`q_e_id`) REFERENCES `exam_tbl` (`e_id`) ON DELETE CASCADE;

--
-- Constraints for table `responses_tbl`
--
ALTER TABLE `responses_tbl`
  ADD CONSTRAINT `responses_tbl_ibfk_1` FOREIGN KEY (`r_q_id`) REFERENCES `question_tbl` (`q_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_tbl_ibfk_2` FOREIGN KEY (`r_o_id`) REFERENCES `option_tbl` (`o_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_tbl_ibfk_3` FOREIGN KEY (`r_u_id`) REFERENCES `user_tbl` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_exam_tbl`
--
ALTER TABLE `student_exam_tbl`
  ADD CONSTRAINT `student_exam_tbl_ibfk_1` FOREIGN KEY (`se_u_id`) REFERENCES `user_tbl` (`u_id`),
  ADD CONSTRAINT `student_exam_tbl_ibfk_2` FOREIGN KEY (`se_e_id`) REFERENCES `exam_tbl` (`e_id`);

--
-- Constraints for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD CONSTRAINT `user_tbl_ibfk_1` FOREIGN KEY (`u_user_role`) REFERENCES `user_role_tbl` (`ur_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
