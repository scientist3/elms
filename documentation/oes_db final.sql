-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2021 at 02:04 PM
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
(10, 'Test 1 Updated', '2021-11-03 09:00:00', '2021-11-05 09:00:00', '2021-11-06 10:00:00', '2021-11-06 10:30:00', '2021-10-30 18:40:00', '2021-10-31 00:10:00', 1, 1),
(11, 'Algo12', '2021-10-05 09:00:00', '2021-10-06 18:05:00', '2021-10-19 10:00:00', '2021-10-19 10:30:00', '2021-10-05 18:40:00', '2021-10-06 00:10:00', 1, 1),
(13, 'Going One', '2021-10-06 09:00:00', '2021-10-07 09:00:00', '2021-10-07 14:55:00', '2021-10-07 15:24:00', '2021-10-06 18:40:00', '2021-10-07 15:23:50', 1, 1),
(14, 'Going 2', '2021-10-29 09:00:00', '2021-11-01 10:00:00', '2021-11-02 09:00:00', '2021-11-02 09:30:00', '2021-10-30 18:40:00', '2021-10-31 00:10:00', 1, 1),
(15, 'New Exam', '2021-10-24 23:06:00', '2021-10-31 09:00:00', '2021-10-31 17:46:00', '2021-10-31 18:15:00', '2021-10-30 18:40:00', '2021-10-31 00:10:00', 1, 1),
(16, 'algorith', '2021-11-01 09:00:00', '2021-11-02 09:27:00', '2021-11-14 10:00:00', '2021-11-14 10:30:00', '2021-10-30 18:40:00', '2021-10-31 00:10:00', 1, 1);

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
(56, 19, 'Test Option 1 Q2', '0', '0000-00-00 00:00:00', '2021-10-01 17:19:56', 1),
(57, 19, 'Test Option 2 Q2', '1', '0000-00-00 00:00:00', '2021-10-01 17:19:56', 1),
(58, 19, 'Test Option 3 Q2', '0', '0000-00-00 00:00:00', '2021-10-01 17:19:56', 1),
(59, 19, 'Test Option4 Q2', '0', '0000-00-00 00:00:00', '2021-10-01 17:19:56', 1),
(60, 18, 'Test Option 1', '1', '0000-00-00 00:00:00', '2021-10-03 04:21:42', 1),
(61, 18, 'Test Option 2', '0', '0000-00-00 00:00:00', '2021-10-03 04:21:42', 1),
(62, 18, 'Test Option 3', '0', '0000-00-00 00:00:00', '2021-10-03 04:21:42', 1),
(63, 18, 'Test Option 4', '0', '0000-00-00 00:00:00', '2021-10-03 04:21:42', 1),
(64, 20, 'Test Option 1 Q3', '0', '0000-00-00 00:00:00', '2021-10-04 05:28:32', 1),
(65, 20, 'Test Option 2 Q3', '1', '0000-00-00 00:00:00', '2021-10-04 05:28:32', 1),
(66, 20, 'Test Option 3 Q3', '0', '0000-00-00 00:00:00', '2021-10-04 05:28:32', 1),
(78, 22, '1', '0', '0000-00-00 00:00:00', '2021-10-06 03:49:50', 1),
(79, 22, '2', '0', '0000-00-00 00:00:00', '2021-10-06 03:49:50', 1),
(80, 22, '3', '0', '0000-00-00 00:00:00', '2021-10-06 03:49:50', 1),
(81, 22, '4', '0', '0000-00-00 00:00:00', '2021-10-06 03:49:50', 1),
(82, 22, '5', '1', '0000-00-00 00:00:00', '2021-10-06 03:49:50', 1),
(83, 23, 'dfgds', '0', '0000-00-00 00:00:00', '2021-10-06 08:53:50', 1),
(84, 23, 'dfgsd', '1', '0000-00-00 00:00:00', '2021-10-06 08:53:50', 1),
(85, 23, 'sdfgdf', '0', '0000-00-00 00:00:00', '2021-10-06 08:53:50', 1),
(86, 24, 'o1', '0', '0000-00-00 00:00:00', '2021-10-08 02:12:09', 1),
(87, 24, 'o2', '1', '0000-00-00 00:00:00', '2021-10-08 02:12:09', 1),
(88, 25, 'q1op1', '0', '0000-00-00 00:00:00', '2021-10-29 17:35:36', 1),
(89, 25, 'q1op2', '1', '0000-00-00 00:00:00', '2021-10-29 17:35:36', 1),
(90, 25, 'q1op3', '0', '0000-00-00 00:00:00', '2021-10-29 17:35:36', 1),
(91, 26, 'q2op1', '0', '0000-00-00 00:00:00', '2021-10-29 17:35:57', 1),
(92, 26, 'q2op2', '0', '0000-00-00 00:00:00', '2021-10-29 17:35:57', 1),
(93, 26, 'q3op3', '1', '0000-00-00 00:00:00', '2021-10-29 17:35:57', 1),
(94, 27, 'language', '0', '0000-00-00 00:00:00', '2021-10-31 12:58:31', 1),
(95, 27, 'machine', '0', '0000-00-00 00:00:00', '2021-10-31 12:58:31', 1),
(96, 27, 'fan', '0', '0000-00-00 00:00:00', '2021-10-31 12:58:31', 1),
(97, 27, 'programing language', '1', '0000-00-00 00:00:00', '2021-10-31 12:58:31', 1),
(98, 28, 'sdfhak', '0', '0000-00-00 00:00:00', '2021-10-31 13:02:26', 1),
(99, 28, 'sdhfdshk', '1', '0000-00-00 00:00:00', '2021-10-31 13:02:26', 1),
(100, 28, 'dfksdhfk', '0', '0000-00-00 00:00:00', '2021-10-31 13:02:26', 1);

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
(18, 10, 'Test Question 1', '2021-10-03 09:10:41', '2021-10-03 03:40:41', 1),
(19, 10, 'Test Question 2', '2021-10-01 22:10:56', '2021-10-01 17:19:56', 1),
(20, 10, 'Test Question 3', '2021-10-04 10:10:32', '2021-10-04 05:28:32', 1),
(22, 11, 'Question 1 Updated', '2021-10-06 09:10:50', '2021-10-06 03:49:50', 1),
(23, 13, 'sdfgd', '2021-10-06 14:10:50', '2021-10-06 08:53:50', 1),
(24, 14, 'q1', '2021-10-08 07:10:09', '2021-10-08 02:12:09', 1),
(25, 15, 'q1', '2021-10-29 23:10:36', '2021-10-29 17:35:36', 1),
(26, 15, 'q1', '2021-10-29 23:10:57', '2021-10-29 17:35:57', 1),
(27, 16, 'what is php', '2021-10-31 18:10:31', '2021-10-31 12:58:31', 1),
(28, 16, 'ksdjfhsdahk', '2021-10-31 18:10:26', '2021-10-31 13:02:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `response_tbl`
--

CREATE TABLE `response_tbl` (
  `r_id` int(11) NOT NULL,
  `r_e_id` int(11) NOT NULL COMMENT 'Exam id',
  `r_u_id` int(11) NOT NULL COMMENT 'Student Id',
  `r_q_id` int(11) NOT NULL COMMENT 'Question Id',
  `r_o_id` int(11) NOT NULL COMMENT 'Selected Option ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `response_tbl`
--

INSERT INTO `response_tbl` (`r_id`, `r_e_id`, `r_u_id`, `r_q_id`, `r_o_id`) VALUES
(1, 10, 2, 19, 58),
(2, 10, 2, 18, 60),
(8, 10, 3, 19, 57),
(9, 10, 3, 18, 63);

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_tbl`
--

CREATE TABLE `student_exam_tbl` (
  `se_id` int(11) NOT NULL,
  `se_u_id` int(11) NOT NULL COMMENT 'Student id',
  `se_e_id` int(11) NOT NULL COMMENT 'Exam id',
  `se_applied_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'When applied for the exam',
  `se_approved` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Approved or Not',
  `se_approved_by` int(11) DEFAULT NULL COMMENT 'Approved By',
  `se_attempted` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Whether attempted the exam or not',
  `se_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_exam_tbl`
--

INSERT INTO `student_exam_tbl` (`se_id`, `se_u_id`, `se_e_id`, `se_applied_date`, `se_approved`, `se_approved_by`, `se_attempted`, `se_status`) VALUES
(1, 2, 10, '2021-10-01 17:32:30', 1, NULL, 0, 1),
(2, 3, 10, '2021-10-01 17:32:30', 1, NULL, 0, 1),
(3, 3, 13, '2021-10-07 06:01:35', 1, 1, 0, 1),
(4, 3, 14, '2021-10-07 06:01:35', 1, 1, 0, 1),
(5, 2, 15, '2021-10-29 17:41:28', 1, 1, 0, 1),
(10, 2, 14, '2021-10-31 07:40:02', 1, NULL, 0, 1);

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
(2, 2, 'Student 1', 'student1', 'student1@oes.com', 'cd73502828457d15655bbd7a63fb0bc8', 0, '', '', 1, '2021-10-05 14:50:26', '2021-10-05 14:50:26', 1),
(3, 2, 'Student 2', 'teacher', 'student2@oes.com', 'cd73502828457d15655bbd7a63fb0bc8', 0, '', '', 1, '2021-10-06 06:08:12', '2021-10-06 06:08:12', 1),
(4, 2, 'Student 3', 'student3', 'student3@oes.com', 'cd73502828457d15655bbd7a63fb0bc8', 0, '', '', 1, '2021-10-05 14:50:36', '2021-10-05 14:50:36', 1),
(5, 3, 'Teacher 1', 'teacher1', 'teacher1@oes.com', '41c8949aa55b8cb5dbec662f34b62df3', 0, '', '', 1, '2021-10-05 14:51:46', '2021-10-05 14:51:46', 1);

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
-- Indexes for table `response_tbl`
--
ALTER TABLE `response_tbl`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `r_u_id` (`r_u_id`,`r_q_id`,`r_o_id`),
  ADD KEY `responses_tbl_ibfk_1` (`r_q_id`),
  ADD KEY `responses_tbl_ibfk_2` (`r_o_id`),
  ADD KEY `r_e_id` (`r_e_id`);

--
-- Indexes for table `student_exam_tbl`
--
ALTER TABLE `student_exam_tbl`
  ADD PRIMARY KEY (`se_id`),
  ADD KEY `se_u_id` (`se_u_id`),
  ADD KEY `se_e_id` (`se_e_id`),
  ADD KEY `se_approved_by` (`se_approved_by`);

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
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `option_tbl`
--
ALTER TABLE `option_tbl`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `question_tbl`
--
ALTER TABLE `question_tbl`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `response_tbl`
--
ALTER TABLE `response_tbl`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_exam_tbl`
--
ALTER TABLE `student_exam_tbl`
  MODIFY `se_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role_tbl`
--
ALTER TABLE `user_role_tbl`
  MODIFY `ur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `option_tbl`
--
ALTER TABLE `option_tbl`
  ADD CONSTRAINT `option_tbl_ibfk_1` FOREIGN KEY (`o_q_id`) REFERENCES `question_tbl` (`q_id`) ON DELETE CASCADE;

--
-- Constraints for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD CONSTRAINT `question_tbl_ibfk_1` FOREIGN KEY (`q_e_id`) REFERENCES `exam_tbl` (`e_id`) ON DELETE CASCADE;

--
-- Constraints for table `response_tbl`
--
ALTER TABLE `response_tbl`
  ADD CONSTRAINT `response_tbl_ibfk_1` FOREIGN KEY (`r_q_id`) REFERENCES `question_tbl` (`q_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_tbl_ibfk_2` FOREIGN KEY (`r_o_id`) REFERENCES `option_tbl` (`o_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_tbl_ibfk_3` FOREIGN KEY (`r_u_id`) REFERENCES `user_tbl` (`u_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_tbl_ibfk_4` FOREIGN KEY (`r_e_id`) REFERENCES `exam_tbl` (`e_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_exam_tbl`
--
ALTER TABLE `student_exam_tbl`
  ADD CONSTRAINT `student_exam_tbl_ibfk_1` FOREIGN KEY (`se_u_id`) REFERENCES `user_tbl` (`u_id`),
  ADD CONSTRAINT `student_exam_tbl_ibfk_2` FOREIGN KEY (`se_e_id`) REFERENCES `exam_tbl` (`e_id`),
  ADD CONSTRAINT `student_exam_tbl_ibfk_3` FOREIGN KEY (`se_approved_by`) REFERENCES `user_tbl` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD CONSTRAINT `user_tbl_ibfk_1` FOREIGN KEY (`u_user_role`) REFERENCES `user_role_tbl` (`ur_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
