-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2020 at 08:12 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ProjectDatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `Finalise`
--

CREATE TABLE `Finalise` (
  `ID` int(11) NOT NULL,
  `Grade` int(11) NOT NULL,
  `Feedback` varchar(2000) NOT NULL,
  `Image` blob NOT NULL,
  `ImageType` varchar(30) NOT NULL,
  `StudentFrom` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `StudentTo` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Finalise`
--

INSERT INTO `Finalise` (`ID`, `Grade`, `Feedback`, `Image`, `ImageType`, `StudentFrom`, `StudentTo`) VALUES
(121, 1, 'dsfasdfdsafas', '', '', '000000001', '000000002'),
(122, 7, 'vjgg', '', '', '000000001', '000000003');

-- --------------------------------------------------------

--
-- Table structure for table `Saved`
--

CREATE TABLE `Saved` (
  `ID` int(11) NOT NULL,
  `Grade` varchar(10) NOT NULL,
  `Feedback` varchar(2000) NOT NULL,
  `StudentFrom` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `StudentTo` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Saved`
--

INSERT INTO `Saved` (`ID`, `Grade`, `Feedback`, `StudentFrom`, `StudentTo`) VALUES
(19, '7', 'vjgg', '000000001', '000000003');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(9) NOT NULL,
  `UserEmail` varchar(250) NOT NULL,
  `UserPassword` varchar(250) NOT NULL,
  `UserGroup` int(11) NOT NULL,
  `UserGrade` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`ID`, `UserID`, `UserEmail`, `UserPassword`, `UserGroup`, `UserGrade`) VALUES
(1, '000000000', 'lc8884l@gre.ac.uk', '4c93008615c2d041e33ebac605d14b5b', 0, NULL),
(11, '000000001', 'adsf@gre.ac.uk', '0cc175b9c0f1b6a831c399e269772661', 1, 3),
(12, '000000002', 'dsfs@gre.ac.uk', '0cc175b9c0f1b6a831c399e269772661', 1, 4),
(13, '000000003', 'chchd@gre.ac.uk', '0cc175b9c0f1b6a831c399e269772661', 1, 3.5),
(20, '000000004', 'dfjnjdf@gre.ac.uk', '0cc175b9c0f1b6a831c399e269772661', 2, 3),
(21, '000000005', 'dsjkfh@gre.ac.uk', '0cc175b9c0f1b6a831c399e269772661', 2, 9),
(24, '000000006', 'dsfkjh@gre.ac.uk', '0cc175b9c0f1b6a831c399e269772661', 2, 3),
(27, '000000008', 'jdhfk@gre.ac.uk', '0cc175b9c0f1b6a831c399e269772661', 3, 4),
(28, '000000009', 'dskjfh@gre.ac.uk', '0cc175b9c0f1b6a831c399e269772661', 3, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Finalise`
--
ALTER TABLE `Finalise`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Saved`
--
ALTER TABLE `Saved`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Finalise`
--
ALTER TABLE `Finalise`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `Saved`
--
ALTER TABLE `Saved`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
