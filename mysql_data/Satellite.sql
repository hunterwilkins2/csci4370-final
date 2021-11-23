-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 23, 2021 at 02:12 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: ` Satellite`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(3) UNSIGNED NOT NULL,
  `company_name` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `password`, `location`) VALUES
(1, 'Yamin\'s Test Company', '5f4dcc3b5aa765d61d8327deb882cf99', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `In-Orbit Satellite`
--

CREATE TABLE `In-Orbit Satellite` (
  `satelite_id` int(3) UNSIGNED NOT NULL,
  `orbital_location` varchar(20) NOT NULL,
  `epoch` int(11) NOT NULL,
  `launch_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `In-Orbit Satellite`
--

INSERT INTO `In-Orbit Satellite` (`satelite_id`, `orbital_location`, `epoch`, `launch_date`) VALUES
(2, 'In space', 32323113, '2019-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `Pending Launch Satellite`
--

CREATE TABLE `Pending Launch Satellite` (
  `satelite_id` int(3) UNSIGNED NOT NULL,
  `launch_location` varchar(20) NOT NULL,
  `pending_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pending Launch Satellite`
--

INSERT INTO `Pending Launch Satellite` (`satelite_id`, `launch_location`, `pending_date`) VALUES
(1, 'Test Location', '2023-03-04'),
(1, 'Test Location', '2023-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `satelite`
--

CREATE TABLE `satelite` (
  `satelite_id` int(3) UNSIGNED NOT NULL,
  `company_id` int(3) UNSIGNED NOT NULL,
  `satelite_name` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `satelite`
--

INSERT INTO `satelite` (`satelite_id`, `company_id`, `satelite_name`, `model`) VALUES
(1, 1, 'Cool Test Satelite', '3213z4'),
(2, 1, 'MOCI', 'tz3024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `In-Orbit Satellite`
--
ALTER TABLE `In-Orbit Satellite`
  ADD KEY `satelite_id` (`satelite_id`);

--
-- Indexes for table `Pending Launch Satellite`
--
ALTER TABLE `Pending Launch Satellite`
  ADD KEY `satelite_id` (`satelite_id`);

--
-- Indexes for table `satelite`
--
ALTER TABLE `satelite`
  ADD PRIMARY KEY (`satelite_id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satelite`
--
ALTER TABLE `satelite`
  MODIFY `satelite_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `In-Orbit Satellite`
--
ALTER TABLE `In-Orbit Satellite`
  ADD CONSTRAINT `in-orbit satellite_ibfk_1` FOREIGN KEY (`satelite_id`) REFERENCES `satelite` (`satelite_id`);

--
-- Constraints for table `Pending Launch Satellite`
--
ALTER TABLE `Pending Launch Satellite`
  ADD CONSTRAINT `pending launch satellite_ibfk_1` FOREIGN KEY (`satelite_id`) REFERENCES `satelite` (`satelite_id`);

--
-- Constraints for table `satelite`
--
ALTER TABLE `satelite`
  ADD CONSTRAINT `satelite_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);