-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2018 at 03:05 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roomietest`
--

-- --------------------------------------------------------

--
-- Table structure for table `user2group`
--

CREATE TABLE `user2group` (
  `group2user_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `group_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user2group`
--

INSERT INTO `user2group` (`group2user_id`, `user_id`, `group_id`) VALUES
(11, 36, 26),
(12, 36, 27),
(13, 37, 28),
(14, 37, 29),
(15, 39, 30),
(16, 40, 31),
(17, 40, 32),
(18, 40, 33),
(19, 41, 34),
(24, 43, 34),
(25, 43, 31),
(26, 44, 34),
(27, 45, 34),
(28, 45, 35),
(29, 46, 34),
(30, 46, 34),
(31, 46, 35),
(32, 46, 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user2group`
--
ALTER TABLE `user2group`
  ADD PRIMARY KEY (`group2user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user2group`
--
ALTER TABLE `user2group`
  MODIFY `group2user_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user2group`
--
ALTER TABLE `user2group`
  ADD CONSTRAINT `user2group_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `user2group_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
