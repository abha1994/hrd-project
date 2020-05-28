-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 07:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

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
-- Table structure for table `pfms_details`
--

CREATE TABLE `pfms_details` (
  `pfms_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `official_lang_name` varchar(50) NOT NULL,
  `gender` int(2) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `address_3` text NOT NULL,
  `mobile_no` bigint(10) NOT NULL,
  `countrycd` int(6) NOT NULL,
  `statecd` int(6) NOT NULL,
  `districtcd` int(6) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `ifsc_code` varchar(11) NOT NULL,
  `account_no` int(11) NOT NULL,
  `aadhar_no` int(12) NOT NULL,
  `pin_code` int(6) NOT NULL,
  `scheme_code` int(1) NOT NULL,
  `payment_amount` int(6) NOT NULL,
  `payment_from_date` date NOT NULL,
  `payemnt_to_date` date NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pfms_details`
--
ALTER TABLE `pfms_details`
  ADD PRIMARY KEY (`pfms_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pfms_details`
--
ALTER TABLE `pfms_details`
  MODIFY `pfms_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
