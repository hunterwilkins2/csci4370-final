-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2021 at 11:38 AM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Satellite`
--

-- --------------------------------------------------------

--
-- Table structure for table `Companies`
--

DROP TABLE IF EXISTS `Companies`;
CREATE TABLE IF NOT EXISTS `Companies` (
  `company_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Companies`
--

INSERT INTO `Companies` (`company_id`, `company_name`, `password`, `address`) VALUES
(1, 'Yamin\'s Test Company', '5f4dcc3b5aa765d61d8327deb882cf99', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `In-Orbit`
--

DROP TABLE IF EXISTS `In-Orbit`;
CREATE TABLE IF NOT EXISTS `In-Orbit` (
  `oid` int NOT NULL,
  `satellite_id` int UNSIGNED NOT NULL,
  `launch_date` date NOT NULL,
  `launch_latitude` float NOT NULL,
  `launch_longitude` float NOT NULL,
  `altitude` float NOT NULL,
  `inclination` float NOT NULL,
  PRIMARY KEY (`oid`),
  KEY `satellite_id` (`satellite_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `In-Orbit`
--

INSERT INTO `In-Orbit` (`oid`, `satellite_id`, `launch_date`, `launch_latitude`, `launch_longitude`, `altitude`, `inclination`) VALUES
(0, 2, '2019-04-04', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Pending`
--

DROP TABLE IF EXISTS `Pending`;
CREATE TABLE IF NOT EXISTS `Pending` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `satellite_id` int UNSIGNED NOT NULL,
  `pending_date` date NOT NULL,
  `pending_latitude` float NOT NULL,
  `pending_longitude` float NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `satellite_id` (`satellite_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Pending`
--

INSERT INTO `Pending` (`pid`, `satellite_id`, `pending_date`, `pending_latitude`, `pending_longitude`) VALUES
(1, 1, '2023-03-04', 0, 0),
(2, 1, '2023-03-04', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Satellites`
--

DROP TABLE IF EXISTS `Satellites`;
CREATE TABLE IF NOT EXISTS `Satellites` (
  `satellite_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` int UNSIGNED NOT NULL,
  `satellite_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `model` varchar(20) NOT NULL,
  `type` enum('In-Orbit','Pending') NOT NULL,
  PRIMARY KEY (`satellite_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Satellites`
--

INSERT INTO `Satellites` (`satellite_id`, `company_id`, `satellite_name`, `model`, `type`) VALUES
(1, 1, 'Cool Test Satelite', '3213z4', 'Pending'),
(2, 1, 'MOCI', 'tz3024', 'In-Orbit');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `In-Orbit`
--
ALTER TABLE `In-Orbit`
  ADD CONSTRAINT `in-orbit satellite_ibfk_1` FOREIGN KEY (`satellite_id`) REFERENCES `Satellites` (`satellite_id`);

--
-- Constraints for table `Pending`
--
ALTER TABLE `Pending`
  ADD CONSTRAINT `pending launch satellite_ibfk_1` FOREIGN KEY (`satellite_id`) REFERENCES `Satellites` (`satellite_id`);

--
-- Constraints for table `Satellites`
--
ALTER TABLE `Satellites`
  ADD CONSTRAINT `Satellites_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `Companies` (`company_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
