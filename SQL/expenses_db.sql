-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2020 at 09:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expenses_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `expsenses`
--

CREATE TABLE `expsenses` (
  `ID` int(10) NOT NULL COMMENT 'The id of the transaction',
  `UserID` int(10) NOT NULL COMMENT 'The corresponding user id',
  `ExpenseDate` date DEFAULT NULL COMMENT 'The expense date',
  `ExpenseItem` varchar(200) DEFAULT NULL COMMENT 'The name of the expense',
  `ExpenseCost` float DEFAULT NULL COMMENT 'The expense cost',
  `CurrDateTime` timestamp NULL DEFAULT current_timestamp() COMMENT 'Timestamp of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expsenses`
--

INSERT INTO `expsenses` (`ID`, `UserID`, `ExpenseDate`, `ExpenseItem`, `ExpenseCost`, `CurrDateTime`) VALUES
(1, 1, '2020-03-08', 'Notebooks', 150, '2020-03-29 15:15:52'),
(3, 1, '2020-03-06', 'Bread', 70, '2020-03-29 19:28:04'),
(4, 1, '2020-03-09', 'Milk', 60, '2020-03-29 19:28:17'),
(5, 1, '2020-03-27', 'Noodles', 60, '2020-03-29 19:28:46'),
(6, 1, '2020-03-01', 'Chocolates', 300, '2020-03-29 19:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL COMMENT 'Serial number',
  `FullName` varchar(200) DEFAULT NULL COMMENT 'Full name of user',
  `Email` varchar(200) DEFAULT NULL COMMENT 'Email id of user',
  `PhoneNum` bigint(10) DEFAULT NULL COMMENT 'Phone number of user',
  `Password` varchar(200) DEFAULT NULL COMMENT 'MD5 Hash of user password',
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Timestamp of user registration'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FullName`, `Email`, `PhoneNum`, `Password`, `RegDate`) VALUES
(1, 'Aninda Ghosh', 'aninda.ghosh99@gmail.com', 9619784868, 'ec0e2603172c73a8b644bb9456c1ff6e', '2020-03-25 11:36:19'),
(2, 'Aninda Ghosh', 'aa5842@srmist.edu.in', 9619784868, 'ec0e2603172c73a8b644bb9456c1ff6e', '2020-03-26 08:37:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expsenses`
--
ALTER TABLE `expsenses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expsenses`
--
ALTER TABLE `expsenses`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'The id of the transaction', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Serial number', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
