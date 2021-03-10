-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 07:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `dvdactors`
--

CREATE TABLE `dvdactors` (
  `actorID` int(5) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dvdactors`
--

INSERT INTO `dvdactors` (`actorID`, `fname`, `lname`) VALUES
(1, 'Aamir ', 'Khan'),
(2, 'Kareena ', 'Kapoor'),
(3, 'Boman ', 'Irani'),
(4, 'Leonardo ', 'DiCaprio'),
(5, 'Tom ', 'Hardy'),
(6, 'Matthew ', 'McConaughey'),
(7, 'Anne ', 'Hathaway'),
(8, 'Elizabeth ', 'Debicki'),
(9, 'Robert', 'Pattinson');

-- --------------------------------------------------------

--
-- Table structure for table `dvdtitles`
--

CREATE TABLE `dvdtitles` (
  `uid` varchar(15) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dvdtitles`
--

INSERT INTO `dvdtitles` (`uid`, `title`, `price`) VALUES
('B004C6UFZS', '3 Idiots', 100.00),
('B00RZ463BE', 'Interstellar', 200.00),
('B075RWLQWC', 'Inception', 200.00),
('B08PQLVX74', 'Tenet', 70.00);

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE `relation` (
  `uid` varchar(15) NOT NULL,
  `actorID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`uid`, `actorID`) VALUES
('B004C6UFZS', 1),
('B004C6UFZS', 2),
('B004C6UFZS', 3),
('B00RZ463BE', 6),
('B00RZ463BE', 7),
('B075RWLQWC', 4),
('B075RWLQWC', 5),
('B08PQLVX74', 8),
('B08PQLVX74', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dvdactors`
--
ALTER TABLE `dvdactors`
  ADD PRIMARY KEY (`actorID`);

--
-- Indexes for table `dvdtitles`
--
ALTER TABLE `dvdtitles`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD KEY `uid` (`uid`),
  ADD KEY `actorID` (`actorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dvdactors`
--
ALTER TABLE `dvdactors`
  MODIFY `actorID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `dvdtitles` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relation_ibfk_2` FOREIGN KEY (`actorID`) REFERENCES `dvdactors` (`actorID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
