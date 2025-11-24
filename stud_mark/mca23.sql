-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2025 at 10:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mca23`
--

-- --------------------------------------------------------

--
-- Table structure for table `reg_stud`
--

CREATE TABLE `reg_stud` (
  `username` varchar(20) NOT NULL,
  `roll_no` int(20) UNSIGNED NOT NULL,
  `address` varchar(50) NOT NULL,
  `phno` varchar(11) DEFAULT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_stud`
--

INSERT INTO `reg_stud` (`username`, `roll_no`, `address`, `phno`, `password`) VALUES
('adwait', 10, 'trivandrum', '8912345678', '123');

-- --------------------------------------------------------

--
-- Table structure for table `stud`
--

CREATE TABLE `stud` (
  `roll_no` int(10) UNSIGNED NOT NULL,
  `mark1` int(11) DEFAULT NULL,
  `mark2` int(11) DEFAULT NULL,
  `mark3` int(11) DEFAULT NULL,
  `mark4` int(11) DEFAULT NULL,
  `mark5` int(11) DEFAULT NULL,
  `mark6` int(11) DEFAULT NULL,
  `totalmarks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stud`
--

INSERT INTO `stud` (`roll_no`, `mark1`, `mark2`, `mark3`, `mark4`, `mark5`, `mark6`, `totalmarks`) VALUES
(10, 90, 13, 11, 44, 21, 67, 246);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`username`, `password`) VALUES
('Bindu1', '@Bindu123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reg_stud`
--
ALTER TABLE `reg_stud`
  ADD PRIMARY KEY (`roll_no`),
  ADD UNIQUE KEY `roll_no` (`roll_no`);

--
-- Indexes for table `stud`
--
ALTER TABLE `stud`
  ADD PRIMARY KEY (`roll_no`),
  ADD UNIQUE KEY `unique_roll` (`roll_no`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stud`
--
ALTER TABLE `stud`
  ADD CONSTRAINT `fk_roll` FOREIGN KEY (`roll_no`) REFERENCES `reg_stud` (`roll_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
