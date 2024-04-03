-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2019 at 04:29 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `contact` decimal(11,0) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `email`, `contact`, `profile_image`) VALUES
(1, 'admin', 'admin', 'Administrator', '', '0', ''),
(2, 'abrar15', '12345', 'Abrar Siddique 1', 'abrar.zong@gmail.com', '3062555956', 'abc1.jpg'),
(3, 'Abrar', '12345', 'Abrar Siddique', 'abrar.zong@gmail.com', '3062555956', 'abc2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `id` int(11) NOT NULL,
  `camp` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`id`, `camp`) VALUES
(1, 'SPORTS CLUB'),
(2, 'IT CLUB');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `election_date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`id`, `description`, `election_date`) VALUES
(2, 'Start From 8 AM till 5 PM', '2018-12-19'),
(4, '2018', '2019-01-10'),
(5, '2019', '2019-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `nominees`
--

CREATE TABLE `nominees` (
  `id` int(11) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `description` varchar(50) NOT NULL,
  `pos` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `course` varchar(60) NOT NULL,
  `year` varchar(3) NOT NULL,
  `stud_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nominees`
--

INSERT INTO `nominees` (`id`, `camp`, `description`, `pos`, `name`, `course`, `year`, `stud_id`) VALUES
(1, 'SPORTS CLUB', '', 'President', 'Zuckerberg, Mark M.', 'BSIT', 'IV', '10006'),
(2, 'SPORTS CLUB', '2019', 'President', 'Gates, Bill M.', 'BEE', 'III', '10003'),
(4, 'SPORTS CLUB', '2018', 'Vice-President', 'Cruz, Juan D.', 'BSF', 'III', '10002'),
(5, 'SPORTS CLUB', '', 'Secretary', 'Winslet, Kate L.', 'COE', 'III', '10005'),
(6, 'SPORTS CLUB', '', 'Secretary', 'Guivara, Jake S.', 'BEE', 'II', '10004'),
(10, 'IT CLUB', 'Start From 8 AM till 5 PM', 'Chancellor', 'Abrar Siddique', 'BSIT', 'IV', '12330');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `pos` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `camp`, `pos`) VALUES
(1, 'SPORTS CLUB', 'President'),
(2, 'SPORTS CLUB', 'Vice-President'),
(3, 'SPORTS CLUB', 'Secretary'),
(4, 'IT CLUB', 'Chancellor');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `course` varchar(60) NOT NULL,
  `year` varchar(2) NOT NULL,
  `stud_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `name`, `course`, `year`, `stud_id`) VALUES
(1, 'Victor T. Grammer', 'BSIT', 'IV', '1004'),
(2, 'Brandon R. Hellwig', 'COE', 'II', '1002'),
(4, 'Anthony J. Rasmussen', 'MIT', '14', '1001'),
(5, 'abrar siddique', 'BSIT', 'IV', '12330');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `pos` varchar(60) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `camp`, `pos`, `candidate_id`, `voters_id`) VALUES
(21, 'SPORTS CLUB', 'President', 0, 5),
(22, 'SPORTS CLUB', 'Vice-President', 0, 5),
(23, 'SPORTS CLUB', 'Secretary', 0, 5),
(24, 'SPORTS CLUB', 'President', 2, 1),
(25, 'SPORTS CLUB', 'Vice-President', 0, 1),
(26, 'SPORTS CLUB', 'Secretary', 0, 1),
(27, 'SPORTS CLUB', 'Secretary', 5, 4),
(28, 'IT CLUB', 'Chancellor', 0, 1),
(37, 'IT CLUB', 'Chancellor', 0, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nominees`
--
ALTER TABLE `nominees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nominees`
--
ALTER TABLE `nominees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
