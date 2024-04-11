-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 02:22 AM
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
-- Database: `cpsc471`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Name` varchar(100) DEFAULT NULL,
  `EmpID` int(11) NOT NULL,
  `BranchID` int(11) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Name`, `EmpID`, `BranchID`, `Password`) VALUES
('john', 33, 32, 'loll');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `BookID` varchar(100) NOT NULL,
  `AuthorName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` varchar(100) NOT NULL,
  `Genre` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `PublisherName` varchar(100) NOT NULL,
  `bookIMG` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `Genre`, `Title`, `PublisherName`, `bookIMG`) VALUES
('2314', 'Adventure', 'Treasure Island', 'Simon & Schuster', 'treasureisland.jpg'),
('4516', 'Mystery', 'A Study in Scarlet', 'East India Publishing Company ', 'AStudyinScarlet-01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `BranchID` int(100) NOT NULL,
  `Branch Name` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BranchID`, `Branch Name`, `Address`) VALUES
(32, 'calgary library', 'knjwrkr');

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `BranchID` int(100) NOT NULL,
  `Catalog Name` varchar(100) NOT NULL,
  `Book Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `copy`
--

CREATE TABLE `copy` (
  `Book id` varchar(100) NOT NULL,
  `BranchID` int(100) NOT NULL,
  `No. of copies` int(100) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `Event ID` int(100) NOT NULL,
  `BranchID` int(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `BookID` varchar(100) NOT NULL,
  `Cardno` int(100) NOT NULL,
  `Branch ID` int(100) NOT NULL,
  `Loan date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Return date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`BookID`, `Cardno`, `Branch ID`, `Loan date`, `Return date`) VALUES
('2314', 56, 32, '2024-04-02 23:54:57', '2024-04-24 23:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `Name` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`Name`, `Address`, `Phone`) VALUES
('East India Publishing Company ', 'Ottawa, ON, Canada.', '+1 613-567-4634'),
('Simon & Schuster', '166 King Street East, Suite 300. Toronto, ON', '+1 (647) 427-88');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Cardno` varchar(100) NOT NULL,
  `BranchID` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Phone no.` varchar(15) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Cardno`, `BranchID`, `Name`, `Address`, `Phone no.`, `Password`, `Status`) VALUES
('38493', 32, 'abc', 'dkjwkblw', '37882773', 'abc123', 1),
('56', 32, 'jj', 'enjkbd', '37283000', 'lol', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `Branchid3` (`BranchID`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD KEY `bookid` (`BookID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `Publisher` (`PublisherName`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`BranchID`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD KEY `branchid2` (`BranchID`);

--
-- Indexes for table `copy`
--
ALTER TABLE `copy`
  ADD KEY `bid` (`Book id`),
  ADD KEY `br id` (`BranchID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD KEY `BRANCH` (`BranchID`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD KEY `b` (`BookID`),
  ADD KEY `cardno` (`Cardno`),
  ADD KEY `branch ID` (`Branch ID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Cardno`),
  ADD KEY `branchid` (`BranchID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `Branchid3` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`);

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `bookid` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `publisher` FOREIGN KEY (`PublisherName`) REFERENCES `publisher` (`Name`);

--
-- Constraints for table `catalog`
--
ALTER TABLE `catalog`
  ADD CONSTRAINT `branchid2` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`);

--
-- Constraints for table `copy`
--
ALTER TABLE `copy`
  ADD CONSTRAINT `bid` FOREIGN KEY (`Book id`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `br id` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `BRANCH` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`);

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `b` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `branch ID` FOREIGN KEY (`Branch ID`) REFERENCES `branch` (`BranchID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `branchid` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
