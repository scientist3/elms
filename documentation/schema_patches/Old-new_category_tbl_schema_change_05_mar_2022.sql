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
CREATE TABLE `employee_leave_ms_db`.`category_tbl` ( 
    `c_id` INT NOT NULL AUTO_INCREMENT , 
    `c_name` VARCHAR(200) NOT NULL , 
    `c_status` TINYINT(1) NOT NULL DEFAULT '1' , 
    PRIMARY KEY (`c_id`)) ENGINE = InnoDB COMMENT = 'Stored the faculty category.';

--
-- Dumping data for table `user_tbl`
--

-- INSERT INTO `category_tbl` (`c_id`, `c_name`, `c_status`) VALUES (NULL, 'OM', '1'), (NULL, 'SC', '1'), (NULL, 'ST', '1'), (NULL, 'OBC', '1'), (NULL, 'RBA', '1'), (NULL, 'PWD', '1'), (NULL, 'EWS', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
