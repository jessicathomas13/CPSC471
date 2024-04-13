-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 02:09 AM
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
  `Name` varchar(250) NOT NULL,
  `Nationality` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`Name`, `Nationality`) VALUES
('Arthur Conan Doyle', 'United Kingdom'),
('Jane Austen', 'United Kingdom'),
('Robert Louis Stevenson', 'Scotland');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` varchar(100) NOT NULL,
  `Genre` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `AuthorName` varchar(250) NOT NULL,
  `PublisherName` varchar(100) NOT NULL,
  `bookIMG` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `Genre`, `Title`, `AuthorName`, `PublisherName`, `bookIMG`) VALUES
('2314', 'Adventure', 'Treasure Island', 'Robert Louis Stevenson', 'Simon & Schuster', 'treasureisland.jpg'),
('3794', 'Romance', 'Pride and Prejudice', 'Jane Austen', 'Dover Publications', 'pride-and-prejudice.jpg'),
('4516', 'Mystery', 'A Study in Scarlet', 'Arthur Conan Doyle', 'East India Publishing Company ', 'AStudyinScarlet-01.jpg');

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
  `EventID` int(100) NOT NULL,
  `BranchID` int(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `BranchID`, `Date`, `Description`) VALUES
(2332, 32, '04-20-24', 'Calligraphy class');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `BookID` varchar(100) NOT NULL,
  `Cardno` int(100) NOT NULL,
  `BranchID` int(100) NOT NULL,
  `Loan date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Return date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`BookID`, `Cardno`, `BranchID`, `Loan date`, `Return date`) VALUES
('2314', 56, 32, '2024-04-12 02:09:45', '2024-04-19 02:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `Name` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`Name`, `Address`, `Phone`) VALUES
('Dover Publications', '1325 Franklin Ave, Ste 250, Garden City, NY 11530', '+1 (516) 742-50'),
('East India Publishing Company ', 'Ottawa, ON, Canada.', '+1 (613) 567-463'),
('jojoisugly', '333', '+1(402) 268-4024'),
('Simon & Schuster', '166 King Street East, Suite 300. Toronto, ON', '+1 (647) 427-88');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Cardno` int(100) NOT NULL,
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
(56, 32, 'jj', 'enjkbd', '37283000', 'lol', 1),
(38493, 32, 'abc', 'dkjwkblw', '37882773', 'abc123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`EmpID`),
  ADD KEY `Branchid3` (`BranchID`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `author` (`AuthorName`),
  ADD KEY `publisher` (`PublisherName`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`BranchID`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`Catalog Name`),
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
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `BRANCH` (`BranchID`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`Loan date`),
  ADD KEY `loan_branch_id` (`BranchID`),
  ADD KEY `loan_book_id` (`BookID`),
  ADD KEY `cardno` (`Cardno`);

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
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `author` FOREIGN KEY (`AuthorName`) REFERENCES `author` (`Name`),
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
  ADD CONSTRAINT `cardno` FOREIGN KEY (`Cardno`) REFERENCES `user` (`Cardno`),
  ADD CONSTRAINT `loan_book_id` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `loan_branch_id` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `branchid` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
