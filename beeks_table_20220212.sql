-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2022 at 10:03 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netloftc_beeks`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_image1` mediumtext NOT NULL,
  `item_image2` mediumtext NOT NULL,
  `item_image3` mediumtext NOT NULL,
  `Pump_Maker` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Pump_Type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Part` varchar(500) CHARACTER SET utf8 NOT NULL,
  `Position_Number` varchar(100) CHARACTER SET utf8 NOT NULL,
  `PN_1` varchar(100) CHARACTER SET utf8 NOT NULL,
  `PN_2` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Identified_Part` varchar(500) CHARACTER SET utf8 NOT NULL,
  `Notes` varchar(500) CHARACTER SET utf8 NOT NULL,
  `Pricing_Notes` varchar(500) CHARACTER SET utf8 NOT NULL,
  `Stock` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Job_Number` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Data_Source` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Owner` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
