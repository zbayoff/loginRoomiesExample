-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2018 at 03:06 AM
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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` smallint(6) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_password`) VALUES
(26, 'Garcias', '$2y$10$hFKgv.GDlqQjrqC3VDOUieY9y'),
(27, 'Happy Hauler', '$2y$10$oKaV3D1UDDsYh6a7YaER8.VLZ'),
(28, 'KRamers', '$2y$10$SMbvVAu.RT4SOTVLzVrt5eJV0'),
(29, 'the dodds', '$2y$10$LKRgNS8tk/GyqT8DnIuVmujQv'),
(30, 'dsadsa', '$2y$10$UpB0urvIoiVVPDgAlzonhudzh'),
(31, 'woohoos', '$2y$10$f9lktMCDba2.9t/GJyWDqeDLK'),
(32, 'zaba', '$2y$10$52kh1rx.ngLRUkftVTjRjO60C'),
(33, 'sharks', '$2y$10$/gjmo3bTAbeFSh6eGiMe3OiCd'),
(34, 'shrodes', '$2y$10$Cd6qQACLa1RjxL5y8p4HK.RhKeIn.2UUkMv0hOBg22MBBLUUDIJbO'),
(35, '285 HOT', '$2y$10$29slXj0dWmvA0jnTCkEOtuWsGzzRB9DtIm5BDmUZQtSK7ZY.Kk0d.'),
(36, 'FREDSFATHERS', '$2y$10$Op/jNfK0pTrL/kAqVxJG4OCdSMz1el7sO8oDtLba4UtiSIZzp93yO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
