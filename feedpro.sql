-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2018 at 06:39 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feeds`
--

CREATE TABLE `tbl_feeds` (
  `feedID` int(12) NOT NULL,
  `feedName` varchar(50) NOT NULL,
  `crudeProtein` float NOT NULL,
  `crudeFiber` float NOT NULL,
  `crudeFat` float NOT NULL,
  `Calcium` float NOT NULL,
  `Moisture` float NOT NULL,
  `Phosphorous` float NOT NULL,
  `maximumInclusion` float NOT NULL,
  `costPerKilo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feeds`
--

INSERT INTO `tbl_feeds` (`feedID`, `feedName`, `crudeProtein`, `crudeFiber`, `crudeFat`, `Calcium`, `Moisture`, `Phosphorous`, `maximumInclusion`, `costPerKilo`) VALUES
(4, 'Coconut Residue', 5.1, 31.9, 38.3, 0.6, 4.8, 0.6, 40, 19),
(5, 'Water spinach', 28, 12, 3.8, 1.24, 5.32, 0.41, 0, 12.75),
(6, 'Sweet potato leaves', 19.4, 10.2, 3.07, 1.79, 4.97, 0.24, 50, 12.75),
(7, 'Cassava leaves', 14.7, 10.7, 0.8, 0.84, 10, 0.76, 40, 12.75),
(8, 'Banana pseudo stem', 12.3, 20.5, 0.5, 1.16, 5, 0.01, 0, 19),
(9, 'Duckweed fern', 24, 9.1, 3.3, 0.4, 14, 0.9, 0, 8.3),
(10, 'Lead tree leaves', 27.8, 10.4, 4.4, 0.54, 10, 0.29, 10, 8.3),
(11, 'Taro leaves', 7.67, 20, 3, 2, 14, 0.8, 80, 16.65),
(12, 'Madre de agua leaves', 18.21, 12.5, 2.66, 5, 11.56, 0.41, 0, 9.5),
(13, 'Water hyacinth leaves', 21.6, 17.1, 2.1, 1.6, 10.5, 0.5, 0, 16.65),
(14, 'Rice bran D1 (cono)', 11, 7, 12, 1, 13, 1.54, 25, 12.5),
(15, 'Rice bran D2 (kiskis)', 8, 18, 4, 1, 13, 1.54, 25, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedsused`
--

CREATE TABLE `tbl_feedsused` (
  `feedsUsedID` int(12) NOT NULL,
  `feedID` int(12) NOT NULL,
  `logID` int(12) NOT NULL,
  `percent` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feedsused`
--

INSERT INTO `tbl_feedsused` (`feedsUsedID`, `feedID`, `logID`, `percent`) VALUES
(1, 4, 14, 10),
(2, 7, 14, 25),
(3, 4, 14, 20),
(4, 9, 14, 25),
(5, 12, 14, 30),
(6, 8, 8, 20),
(7, 7, 8, 20),
(8, 9, 8, 20),
(9, 12, 8, 20),
(10, 6, 8, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedtime`
--

CREATE TABLE `tbl_feedtime` (
  `feedTimeID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `time` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `isActive` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feedtime`
--

INSERT INTO `tbl_feedtime` (`feedTimeID`, `userID`, `time`, `description`, `isActive`) VALUES
(16, 5, '05:14:00', 'Feed Time', 1),
(17, 5, '11:13:00', 'Feed Time', 1),
(18, 5, '00:13:00', 'Feed Time', 0),
(19, 5, '05:19:00', 'Feed Time', 1),
(52, 4, '22:56:00', 'Feed Time', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `logID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `weight` float NOT NULL,
  `comment` text NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`logID`, `userID`, `date`, `weight`, `comment`, `cost`) VALUES
(1, 4, '2018-01-28 18:07:43', 23.6, 'I dunno what to say\r\n', 9.88),
(2, 5, '2018-01-28 18:07:44', 21, 'Ill take this chance and just hold me by.', 10.56),
(3, 4, '2018-01-28 18:07:44', 22, 'Hashimite miyoka.', 11),
(4, 5, '2018-01-28 18:07:44', 21, 'Google Map\r\n', 9),
(5, 4, '2018-01-28 18:08:51', 20, 'Mozilla Map\r\n', 9.88),
(6, 4, '2018-01-28 18:08:51', 23, 'Micheal Learns to rock', 12.56),
(7, 5, '2018-01-28 18:08:51', 16.3, 'When you say nothing at all', 12.45),
(8, 4, '2018-01-28 18:07:45', 17, 'I\'m on my way. Driving at 90 down those country lanes, singing to tiny dancers and i miss the way you make me feel like it is real and we watch the sun set over the castle on the hill.', 10.45),
(9, 5, '2018-01-28 18:07:45', 18, 'Samoka ani oi katolgon na kai ko', 9.23),
(10, 4, '2018-01-28 18:09:26', 10, 'I dunno how many times does this music loops over', 10.1),
(11, 1, '2018-01-28 18:07:45', 22, 'Browse,Structure,SQL,Search,Inser', 10),
(12, 4, '2018-01-28 18:09:26', 25, 'Loko to ahh', 13),
(13, 6, '2018-01-28 18:07:46', 34, 'asdf  asdf asdf', 11),
(14, 4, '2018-01-28 18:09:27', 31, 'asd asdf asdf', 11.88),
(15, 5, '2018-01-28 18:09:27', 33, 'Get me some meat.', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notificationID` int(10) NOT NULL,
  `userID` int(12) NOT NULL,
  `type` varchar(100) NOT NULL,
  `seen` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`notificationID`, `userID`, `type`, `seen`) VALUES
(1, 3, 'update', 0),
(2, 2, 'insert', 0),
(3, 2, 'update', 0),
(4, 5, 'insert', 0),
(5, 5, 'update', 0),
(6, 5, 'update', 0),
(7, 5, 'update', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(12) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` int(2) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `img` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `fname`, `lname`, `username`, `password`, `isActive`, `userType`, `img`, `date`) VALUES
(1, 'Admin', 'Admin', 'admin', '1619d7adc23f4f633f11014d2f22b7d8', 1, 'Admin', '2135587952.jpg', '2018-01-22 18:15:30'),
(2, 'Kaori', 'Miyazono', 'violinist', '1619d7adc23f4f633f11014d2f22b7d8', 1, 'Admin', NULL, '2018-01-22 18:41:55'),
(3, 'Chaprel John', 'Villegas', 'legend', '1619d7adc23f4f633f11014d2f22b7d8', 1, 'User', NULL, '2018-01-22 19:04:17'),
(4, 'Kaori', 'Miazono', 'kaori', '1619d7adc23f4f633f11014d2f22b7d8', 1, 'User', NULL, '2018-01-23 04:27:32'),
(5, 'Meliodass', 'Dragon', 'deadly', '1619d7adc23f4f633f11014d2f22b7d8', 1, 'User', NULL, '2018-01-28 04:48:25'),
(6, 'Ban', 'Fox', 'sevensin', '1619d7adc23f4f633f11014d2f22b7d8', 0, 'User', NULL, '2017-12-28 05:23:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_feeds`
--
ALTER TABLE `tbl_feeds`
  ADD PRIMARY KEY (`feedID`);

--
-- Indexes for table `tbl_feedsused`
--
ALTER TABLE `tbl_feedsused`
  ADD PRIMARY KEY (`feedsUsedID`);

--
-- Indexes for table `tbl_feedtime`
--
ALTER TABLE `tbl_feedtime`
  ADD PRIMARY KEY (`feedTimeID`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logID`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notificationID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_feeds`
--
ALTER TABLE `tbl_feeds`
  MODIFY `feedID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_feedsused`
--
ALTER TABLE `tbl_feedsused`
  MODIFY `feedsUsedID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_feedtime`
--
ALTER TABLE `tbl_feedtime`
  MODIFY `feedTimeID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notificationID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
