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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` smallint(6) NOT NULL,
  `fName` varchar(256) NOT NULL,
  `lName` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fName`, `lName`, `email`, `password`) VALUES
(24, 'sasasa', 'sasasa', 'asas@yahho.com', '$2y$10$EhzCQc.1RB/byGTGxa10pOHXA'),
(26, 'Zachyyyy', 'Bayoffyyyyy', 'zbayoffyyyy100@yahoo.com', '$2y$10$8c./ew2AwbelfsuZ6jS9xepZO'),
(27, 'zarkary', 'barkoff', 'zark@fafa.com', '$2y$10$z5x8cd6tP9AdRdnW1kuTRuvkD'),
(29, 'Zach', 'Bayoff', 'zbayoff100@yahoo.com', '$2y$10$uxV4OYZ6z1KTA2aPrcw8wOSt8'),
(30, 'Bard', 'Bayoff', 'bbayoff@gmail.com', '$2y$10$9aF5MDbCuM2v42ioydLuTufrg'),
(31, 'brian', 'cannon', 'bcannon@gmail.com', '$2y$10$V0t0VSootUyxkM/Q3wBKkONbp'),
(32, 'Dodd', 'frenk', 'ddd@gmail.com', '$2y$10$9ygh8TjUCyPdhBs6SPtiB.2Nb'),
(33, 'phobie', 'marshin', 'pm@dsaa.com', '$2y$10$Y3YhjjHAH7qOfswt0gnXgecW.'),
(34, 'dadad', 'dsadasdsa', 'adasda@dadas.com', '$2y$10$fMrrFKem601NsmB8wyeOpuF07'),
(35, 'molly', 'haggie', 'sdasd@dasd.com', '$2y$10$A7INQk3ylXkzo4Mh7kIhOesL0'),
(36, 'george', 'garcia', 'gg@gmail.com', '$2y$10$2r4QE.xRPmvel2B8BtzEVeMKQ'),
(37, 'anne', 'kramer', 'ack@gmail.com', '$2y$10$qiWIZ7Cz.SXGlvjSsPSIHOhQx'),
(38, 'docky', 'wocky', 'dockwock@yahoo.com', '$2y$10$VH/4S/bKwQqvCwPyn.SQSOKZy'),
(39, 'for', 'gor', 'forgor@gmail.com', '$2y$10$H2OJEdmPvB6BrluYIg23lOSyT'),
(40, 'Zlake', 'Blake', 'zb@gmail.com', '$2y$10$VUzSmgAegrbCPdJrO3y/NeJUr'),
(41, 'sara', 'schroeder', 'ss@dad.com', '$2y$10$Jro7xOQvx0a7RHQJn5ekEegZB'),
(42, 'harold', 'henry', 'hh@sdasdsa.com', '$2y$10$qK8634LfqGDFEZc6RzXreezk6'),
(43, 'warren', 'noone', 'wnoo@dsadsad.com', '$2y$10$5lQRlLZnHMkYTDs.fb9i7O4kF'),
(44, 'quintin', 'gash', 'qgash@sadasda.com', '$2y$10$N1hOhA/jx.YhVYy/e4wCM.s0Q'),
(45, 'doug', 'earhardt', 'dg@dsadsad.com', '$2y$10$jCtjPj0qPAG..1MdBOX5GO4/Q'),
(46, 'brad', 'gilbert', 'bg@yaho.com', '$2y$10$/inJSDmNDC36s5hEPi1FsufFc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
