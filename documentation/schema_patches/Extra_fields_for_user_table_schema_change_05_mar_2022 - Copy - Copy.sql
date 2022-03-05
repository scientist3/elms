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
-- Table structure for table `user_tbl`
--
ALTER TABLE `user_tbl` 
  ADD `u_d_o_appointment` DATE NULL AFTER `u_picture`, 
  ADD `u_first_place_of_posting` VARCHAR(100) NULL AFTER `u_d_o_appointment`, 
  ADD `u_d_o_app_at_spc` DATE NULL AFTER `u_first_place_of_posting`, 
  ADD `u_d_o_last_promotion` DATE NULL AFTER `u_d_o_app_at_spc`, 
  ADD `u_category` VARCHAR(100) NULL AFTER `u_d_o_last_promotion`, 
  ADD `u_qualification` VARCHAR(100) NULL AFTER `u_category`, 
  ADD `u_is_head` BOOLEAN NULL DEFAULT FALSE AFTER `u_qualification`;

--
-- Dumping data for table `user_tbl`
--


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
