-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 07:28 PM
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
  `Password` varchar(100) NOT NULL,
  `EmailID` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Name`, `EmpID`, `BranchID`, `Password`, `EmailID`) VALUES
('john', 33, 32, 'loll', '');

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
('Bram Stoker', 'Ireland'),
('E.B. White', 'United States'),
('Frank Herbert', 'United States'),
('George Orwell', 'United Kingdom'),
('Jane Austen', 'United Kingdom'),
('Ramez Elmasri', 'Egypt'),
('Robert Louis Stevenson', 'Scotland'),
('Simon Thompson', 'United Kingdom');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` varchar(100) NOT NULL,
  `Genre` varchar(250) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `AuthorName` varchar(250) NOT NULL,
  `PublisherName` varchar(100) NOT NULL,
  `bookIMG` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BranchID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `Genre`, `Title`, `AuthorName`, `PublisherName`, `bookIMG`, `BranchID`) VALUES
('1098', 'Science Fiction', '1984', 'George Orwell', 'Penguin Books', 'george-orwell-1984.jpg', 0),
('2314', 'Adventure', 'Treasure Island', 'Robert Louis Stevenson', 'Simon & Schuster', 'treasureisland.jpg', 0),
('3237', 'Children\'s Literature', 'Charlotte\'s Web', 'E.B. White', 'HarperCollins', 'charlotte-web.jpg', 0),
('3794', 'Romance', 'Pride and Prejudice', 'Jane Austen', 'Dover Publications', 'pride.jpg', 0),
('4516', 'Mystery', 'A Study in Scarlet', 'Arthur Conan Doyle', 'East India Publishing Company ', 'AStudyinScarlet-01.jpg', 0),
('5928', 'Computer Science', 'Haskell: The Craft of Functional Programming', 'Simon Thompson', 'Addison Wesley', 'haskell.jpg', 0),
('6831', 'Science Fiction', 'Dune', 'Frank Herbert', 'Penguin Books', 'dune.jpg', 0),
('7182', 'Computer Science', 'Fundamentals of Database Systems', 'Ramez Elmasri', 'Pearson', 'fundamentals.jpg', 0),
('8293', 'Horror', 'Dracula', 'Bram Stoker', 'Simon & Schuster', 'dracula.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `BranchID` int(100) NOT NULL,
  `Branch Name` varchar(100) NOT NULL,
  `Address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BranchID`, `Branch Name`, `Address`) VALUES
(32, 'Louise Riley Library', '1904 14 Ave NW, Calgary'),
(33, 'Nose Hill Library', '1530 Northmount Dr NW, Calgary'),
(34, 'Central Library', '800 3 St SE, Calgary'),
(35, 'Memorial Park Library', '1221 2 St SW, Calgary');

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `Catalog Name` varchar(100) NOT NULL,
  `BranchID` int(100) NOT NULL,
  `BookID` varchar(100) NOT NULL,
  `Num_of_copies` int(250) NOT NULL,
  `Book Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`Catalog Name`, `BranchID`, `BookID`, `Num_of_copies`, `Book Location`) VALUES
('Calgary Public Library Catalog', 32, '4516', 2, 'G-6');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(100) NOT NULL,
  `EventName` varchar(250) NOT NULL,
  `BranchID` int(100) NOT NULL,
  `Date` timestamp(4) NULL DEFAULT NULL,
  `Description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `BranchID`, `Date`, `Description`) VALUES
(2332, 'Calligraphy class', 32, '2024-04-18 13:00:00.0000', 'Dive into the art of calligraphy at our library event! Discover the beauty of brushstrokes and lettering techniques with expert guidance. Join us for a creative journey into this timeless craft!'),
(3926, 'Gimme 10 Minutes: A Staged Reading', 34, '2024-05-25 20:00:00.0000', 'Celebrate the art of the ten-minute play! Enjoy dynamic short performances of new works from playwrights and theatre artists in this staged reading showcase.'),
(4372, 'How We Gather Matters - Official Book Launch', 35, '2024-05-09 23:00:00.0000', 'Welcome to the Official Book Launch of \"How We Gather Matters\" by Leor Rotchild. Join us for an exciting, family-friendly event filled with insightful discussions.'),
(6821, 'Game Night: Pictionary', 33, '2024-05-15 23:00:00.0000', 'Come join us for a fun evening filled with games, laughter, and good company. It\'s the perfect opportunity to unwind and enjoy some friendly competition.');

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
('2314', 56, 32, '2024-04-11 05:40:00', '2024-04-20 05:40:00');

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
('Addison Wesley', '1900 E Lake Ave Glenview, IL', '+1 (250) 380-6850'),
('Dover Publications', '1325 Franklin Ave, Ste 250, Garden City, NY 11530', '+1 (516) 742-50'),
('East India Publishing Company ', 'Ottawa, ON, Canada.', '+1 (613) 567-463'),
('HarperCollins', '195 Broadway, New York, NY 10007', '+1 (844) 327-5757'),
('Pearson', '176 Yonge St, 6th floor. Toronto, ON', '+1 (800) 361-6128'),
('Penguin Books', '320 Front Street West, Suite 1400 Toronto, Ontario', '+1 (416) 364-4449'),
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
  `Status` int(1) NOT NULL,
  `EmailID` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Cardno`, `BranchID`, `Name`, `Address`, `Phone no.`, `Password`, `Status`, `EmailID`) VALUES
(56, 32, 'jj', 'enjkbd', '37283000', 'lol', 1, ''),
(38493, 32, 'abc', 'dkjwkblw', '37882773', 'abc123', 1, '');

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
  ADD KEY `publisher` (`PublisherName`),
  ADD KEY `BranchID` (`BranchID`);

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
  ADD KEY `branchid2` (`BranchID`),
  ADD KEY `book_ID` (`BookID`);

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
  ADD CONSTRAINT `book_ID` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `branchid2` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`BranchID`);

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
