-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 12:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branchmajors`
--

CREATE TABLE `branchmajors` (
  `BranchMajorID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `BranchID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branchmajors`
--

INSERT INTO `branchmajors` (`BranchMajorID`, `CourseID`, `BranchID`) VALUES
(1, 101, 1),
(2, 102, 1),
(3, 103, 2),
(4, 104, 2),
(5, 105, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branchmajors`
--
ALTER TABLE `branchmajors`
  ADD PRIMARY KEY (`BranchMajorID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `BranchID` (`BranchID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branchmajors`
--
ALTER TABLE `branchmajors`
  MODIFY `BranchMajorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branchmajors`
--
ALTER TABLE `branchmajors`
  ADD CONSTRAINT `branchmajors_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `branchmajors_ibfk_2` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
