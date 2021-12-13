-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2021 at 04:38 PM
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
-- Table structure for table `Satellites`
--

DROP TABLE IF EXISTS `Satellites`;
CREATE TABLE `Satellites` (
  `satellite_id` int UNSIGNED NOT NULL,
  `company_id` int UNSIGNED NOT NULL,
  `satellite_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `model` varchar(20) NOT NULL,
  `type` enum('In-Orbit','Pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Satellites`
--

INSERT INTO `Satellites` (`satellite_id`, `company_id`, `satellite_name`, `model`, `type`) VALUES
(14, 6, 'StarLink 84', 'TinTin', 'Pending'),
(15, 6, 'Transporter 2', 'Falcon 9', 'Pending'),
(16, 6, 'Inspiration4', 'Falcon Heavy', 'Pending'),
(17, 6, 'Crew 6', 'Falcon Heavy', 'Pending'),
(18, 6, 'StarLink 34', 'TinTin', 'In-Orbit'),
(19, 6, 'StarLink 42', 'V1.0 with Lazers', 'In-Orbit'),
(21, 6, 'Dreamer', 'Falcon 9', 'In-Orbit'),
(22, 7, 'Orion', 'Thor Delta', 'Pending'),
(23, 7, 'USA 193', 'Vanguard', 'Pending'),
(24, 7, 'ISS', 'Zvezda', 'In-Orbit'),
(25, 7, 'Hubble Telescope', 'Lockhead Perkin', 'In-Orbit'),
(26, 8, 'Sputnik 1', 'OKB 1', 'In-Orbit'),
(27, 8, 'Soyuz', 'Energia', 'In-Orbit'),
(28, 8, 'Kosmos 2549', 'Soyuz 2 1b', 'Pending'),
(29, 8, 'Arktika M 1', 'Fregat', 'Pending'),
(30, 8, 'Ekspress AMu3', 'Proton M', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Satellites`
--
ALTER TABLE `Satellites`
  ADD PRIMARY KEY (`satellite_id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Satellites`
--
ALTER TABLE `Satellites`
  MODIFY `satellite_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Satellites`
--
ALTER TABLE `Satellites`
  ADD CONSTRAINT `Satellites_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `Companies` (`company_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
