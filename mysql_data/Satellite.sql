-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2021 at 06:00 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `Satellite`
--

-- --------------------------------------------------------

--
-- Table structure for table `Companies`
--

DROP TABLE IF EXISTS `Companies`;
CREATE TABLE `Companies` (
  `company_id` int UNSIGNED NOT NULL,
  `company_name` varchar(20) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Companies`
--

INSERT INTO `Companies` (`company_id`, `company_name`, `password`, `address`) VALUES
(1, 'Yamin\'s Test Company', '5f4dcc3b5aa765d61d8327deb882cf99', 'Test'),
(5, 'Test company', '$2y$10$zdbuRXDqnyBwwxYI8emXVussMuwLRkMouwa4erJDY5gActjYaS3hK', '123 Apple Street');

-- --------------------------------------------------------

--
-- Table structure for table `In-Orbit`
--

DROP TABLE IF EXISTS `In-Orbit`;
CREATE TABLE `In-Orbit` (
  `oid` int NOT NULL,
  `satellite_id` int UNSIGNED NOT NULL,
  `launch_date` date NOT NULL,
  `launch_latitude` float NOT NULL,
  `launch_longitude` float NOT NULL,
  `altitude` float NOT NULL,
  `inclination` float NOT NULL
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
CREATE TABLE `Pending` (
  `pid` int NOT NULL,
  `satellite_id` int UNSIGNED NOT NULL,
  `pending_date` date NOT NULL,
  `pending_latitude` float NOT NULL,
  `pending_longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(1, 1, 'Cool Test Satelite', '3213z4', 'Pending'),
(2, 1, 'MOCI', 'tz3024', 'In-Orbit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Companies`
--
ALTER TABLE `Companies`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_name` (`company_name`);

--
-- Indexes for table `In-Orbit`
--
ALTER TABLE `In-Orbit`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `satellite_id` (`satellite_id`) USING BTREE;

--
-- Indexes for table `Pending`
--
ALTER TABLE `Pending`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `satellite_id` (`satellite_id`) USING BTREE;

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
-- AUTO_INCREMENT for table `Companies`
--
ALTER TABLE `Companies`
  MODIFY `company_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Pending`
--
ALTER TABLE `Pending`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Satellites`
--
ALTER TABLE `Satellites`
  MODIFY `satellite_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
