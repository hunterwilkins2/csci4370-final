-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 29, 2021 at 04:26 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `FinalSatellite`
--

-- --------------------------------------------------------

--
-- Table structure for table `Companies`
--

CREATE TABLE `Companies` (
  `company_id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Companies`
--

INSERT INTO `Companies` (`company_id`, `company_name`, `password`, `address`) VALUES
(1, 'Yamin\'s Test Company', '5f4dcc3b5aa765d61d8327deb882cf99', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `Orbit`
--

CREATE TABLE `Orbit` (
  `orbital_id` int(11) NOT NULL,
  `satellite_id` int(10) UNSIGNED NOT NULL,
  `launch_date` date NOT NULL,
  `launch_latitude` float NOT NULL,
  `launch_longitude` float NOT NULL,
  `altitude` float NOT NULL,
  `inclination` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Orbit`
--

INSERT INTO `Orbit` (`orbital_id`, `satellite_id`, `launch_date`, `launch_latitude`, `launch_longitude`, `altitude`, `inclination`) VALUES
(3, 387, '2021-11-29', 242, 232, 23, 23);

-- --------------------------------------------------------

--
-- Table structure for table `Pending`
--

CREATE TABLE `Pending` (
  `pid` int(11) UNSIGNED NOT NULL,
  `satellite_id` int(10) UNSIGNED NOT NULL,
  `pending_date` date NOT NULL,
  `pending_latitude` float NOT NULL,
  `pending_longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pending`
--

INSERT INTO `Pending` (`pid`, `satellite_id`, `pending_date`, `pending_latitude`, `pending_longitude`) VALUES
(130, 386, '2021-11-29', 234, 24);

-- --------------------------------------------------------

--
-- Table structure for table `Satellites`
--

CREATE TABLE `Satellites` (
  `satellite_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `satellite_name` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `types` enum('In-Orbit','Pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Satellites`
--

INSERT INTO `Satellites` (`satellite_id`, `company_id`, `satellite_name`, `model`, `types`) VALUES
(1, 1, 'Cool Test Satellite', '3213z4', 'Pending'),
(2, 1, 'MOCI', 'tz3024', 'In-Orbit'),
(385, 1, 'Yamin Test', 'z3044', 'Pending'),
(386, 1, 'Yamin Test', 'z3044', 'Pending'),
(387, 1, 'Yamin Test', 'tz2042', 'In-Orbit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Companies`
--
ALTER TABLE `Companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `Orbit`
--
ALTER TABLE `Orbit`
  ADD PRIMARY KEY (`orbital_id`),
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
  MODIFY `company_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Orbit`
--
ALTER TABLE `Orbit`
  MODIFY `orbital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Pending`
--
ALTER TABLE `Pending`
  MODIFY `pid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `Satellites`
--
ALTER TABLE `Satellites`
  MODIFY `satellite_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orbit`
--
ALTER TABLE `Orbit`
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