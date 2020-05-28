-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 05:51 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrd`
--

-- --------------------------------------------------------

--
-- Table structure for table `studentregistrations_history`
--

CREATE TABLE `studentregistrations_history` (
  `id` int(11) NOT NULL,
  `studentregistration_id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'login university id',
  `firstname` varchar(125) DEFAULT NULL,
  `middlename` varchar(125) DEFAULT NULL,
  `lastname` varchar(125) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `email_id` varchar(125) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `pincode` int(11) DEFAULT NULL,
  `course` varchar(125) DEFAULT NULL,
  `country` varchar(125) NOT NULL,
  `state` varchar(125) NOT NULL,
  `distric` varchar(125) NOT NULL,
  `bankName` varchar(125) DEFAULT NULL,
  `accountNo` varchar(50) DEFAULT NULL,
  `ifscCode` varchar(20) DEFAULT NULL,
  `gate_neet` varchar(225) DEFAULT NULL,
  `highest_qulification` varchar(225) DEFAULT NULL,
  `aadhar` varchar(225) NOT NULL,
  `bankMandate` varchar(225) DEFAULT NULL,
  `publication` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentregistrations_history`
--

INSERT INTO `studentregistrations_history` (`id`, `studentregistration_id`, `institute_id`, `user_id`, `firstname`, `middlename`, `lastname`, `mobile`, `email_id`, `gender`, `address`, `dob`, `pincode`, `course`, `country`, `state`, `distric`, `bankName`, `accountNo`, `ifscCode`, `gate_neet`, `highest_qulification`, `aadhar`, `bankMandate`, `publication`, `created_at`, `modified_by`, `modified_date`, `status`) VALUES
(1, 2, 4, 4, 'abha', NULL, 'sharma', '9643198264', 'abhasharma10@gmail.com', 'female', 'new ashok nagar delhi', '2020-04-01', NULL, NULL, 'INDIA', '12', '12', NULL, NULL, NULL, '1587996609_378_file_experience.pdf', '1587996609_378_file_experience.pdf', '1234-5678-1234', '1587996609_378_file_experience.pdf', '1587996609_378_file_experience.pdf', '2020-05-07 12:07:35', 2, '2020-05-07 17:37:35', 1),
(2, 12, 2, 4, 'skybag', 'kumar', 'singh', '9891621564', 'skybag@gmail.com', 'male', 'new delhi palam colony. kkkkk', '2020-05-03', NULL, NULL, 'INDIA', '36', '36', NULL, NULL, NULL, '1589201946_11.docx', '1589201946_11.docx', '1234-1234-1238', '1589201946_11.docx', '1589208772_Amresh.doc', '2020-05-11 14:52:52', 2, '2020-05-11 20:22:52', 1),
(3, 11, 2, 4, 'kartik', 'kumark', 'singh0', '9891789411', 'kart@gmail.com', 'male', 'new delhi palam colony.', '2020-05-02', NULL, NULL, 'INDIA', '8', '8', NULL, NULL, NULL, '1589190250_11.docx', '1589190250_11.docx', '1234-1234-1234', '1589190250_11.docx', '1589190250_11.docx', '2020-05-11 14:54:46', 2, '2020-05-11 20:24:46', 1),
(4, 4, 4, 4, 'aaaa', 'kumar', 'aaaa', '9891621648', 'aaa@gmail.com', 'male', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2020-05-01', NULL, NULL, 'INDIA', '7', '79', NULL, NULL, NULL, NULL, '1589022280_1.pdf', '1234-1234-1234', '1589022280_1.pdf', NULL, '2020-05-11 15:30:09', 2, '2020-05-11 21:00:09', 2),
(5, 8, 4, 4, 'Chandan', 'kumar', 'singh', '9891621888', 'chandan@gmail.com', 'male', 'new delhi palam colony.', '2020-05-01', NULL, NULL, 'INDIA', '36', '36', NULL, NULL, NULL, NULL, '1589189234_11.docx', '1234-1234-1234', '1589189234_11.docx', NULL, '2020-05-11 15:49:30', 2, '2020-05-11 21:19:30', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentregistrations_history`
--
ALTER TABLE `studentregistrations_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentregistrations_history`
--
ALTER TABLE `studentregistrations_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
