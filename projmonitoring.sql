-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 07:42 PM
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
-- Database: `projmonitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `deptno` int(11) NOT NULL,
  `deptname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptno`, `deptname`) VALUES
(1, 'Production'),
(2, 'Research & Development'),
(3, 'Arts & Design'),
(5, 'Taylor Lautner');

-- --------------------------------------------------------

--
-- Table structure for table `dependents`
--

CREATE TABLE `dependents` (
  `dname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssn` int(11) NOT NULL,
  `gender` enum('f','m','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dbdate` date NOT NULL,
  `relationship` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dependents`
--

INSERT INTO `dependents` (`dname`, `ssn`, `gender`, `dbdate`, `relationship`) VALUES
('Angelina', 2005, 'f', '1989-11-17', 'Cousin'),
('Felix', 2020, 'm', '1989-10-24', 'Brother'),
('Mikasa', 2024, 'f', '1996-02-10', 'Sister'),
('Mark', 2047, 'm', '1987-09-29', 'Husband'),
('Krosho', 2049, 'm', '1981-01-04', 'Uncle'),
('Light', 2064, 'm', '1991-02-03', 'Nephew'),
('sdkjashdask', 3333, 'other', '1988-08-18', 'grandmother');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ssn` int(11) NOT NULL,
  `lname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mint` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` enum('f','m','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` decimal(7,0) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bdate` date NOT NULL,
  `deptno` int(11) NOT NULL,
  `superssn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ssn`, `lname`, `fname`, `mint`, `sex`, `salary`, `address`, `bdate`, `deptno`, `superssn`) VALUES
(2003, 'Rodriguez', 'Maria', 'L', 'f', '8000', 'California, SA', '1976-12-19', 1, 2003),
(2005, 'Smith', 'Jonathan', 'M', 'm', '9900', 'Mackerel St. Sanj Park', '1993-07-21', 2, 2064),
(2012, 'Fritz', 'Ymir', '', 'f', '11400', 'Wall Sina', '1993-01-17', 3, 2051),
(2020, 'Sceptikeye', 'Jack', '', 'm', '10000', 'Atlanta Georgia, USA', '1987-02-26', 3, 2051),
(2024, 'Jaeger', 'Eren', '', 'm', '9500', 'Wall Sina', '1995-03-30', 2, 2064),
(2032, 'Bane', 'Magnus', '', 'm', '10400', 'Fort Santiago', '1992-01-01', 1, 2003),
(2034, 'Turner', 'Will', 'S', 'm', '11500', '4th Floor, Star Complex', '1992-12-12', 1, 2003),
(2047, 'Reiss', 'Historia', '', 'f', '12400', '7th St. Mitras', '1989-04-12', 3, 2051),
(2049, 'Leonhart', 'Annie', '', 'f', '11300', 'Wall Sina', '1995-07-26', 3, 2051),
(2051, 'Ackerman', 'Kenny', '', 'm', '12400', '6th St. Mitras', '1982-08-01', 3, 2051),
(2064, 'Penber', 'Raye', '', 'm', '10900', 'Nagasaki, Japan', '1974-12-31', 2, 2064),
(2077, 'Lightwood', 'Alexander', 'A', 'm', '10900', '2nd Floor Star Bldg', '1992-01-10', 2, 2064),
(2080, 'Canja', 'Chryzar', 'M', 'm', '8000', 'General Santos City, PH', '1995-09-27', 1, 2003),
(3088, 'Cantillan', 'Amari', 'L', 'f', '13000', '5th Prk, Bubbles', '2020-07-06', 2, NULL),
(3333, 'Cde', 'ABC', 'O', 'm', '13000', 'black eyed peas', '2005-04-05', 5, 2049),
(4545, 'Ortiz', 'Kharyl', 'P', 'f', '12000', 'Prk Tomasa', '1998-10-13', 3, 8009),
(8009, 'Cantillan', 'Darren', 'L', 'm', '12000', 'Valencia', '1999-04-01', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projno` int(11) NOT NULL,
  `projname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deptno` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projno`, `projname`, `deptno`, `status`) VALUES
(1809, 'kengkoy', 5, 1),
(4001, 'Noble Node', 3, 1),
(4003, 'Level Kiss', 2, 1),
(4010, 'Project Eskimo', 3, 0),
(4011, 'Candid Sales', 1, 0),
(89890, 'HOLY', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `workson`
--

CREATE TABLE `workson` (
  `projno` int(11) NOT NULL,
  `ssn` int(11) NOT NULL,
  `dateworked` date NOT NULL,
  `hoursworked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workson`
--

INSERT INTO `workson` (`projno`, `ssn`, `dateworked`, `hoursworked`) VALUES
(4001, 2003, '2015-10-09', 20),
(4001, 2003, '2015-10-16', 30),
(4001, 2005, '2015-10-09', 30),
(4001, 2005, '2015-10-16', 30),
(4001, 2032, '2015-10-09', 30),
(4001, 2032, '2015-10-16', 30),
(4003, 2005, '2016-03-25', 15),
(4003, 2024, '2016-03-25', 15),
(4003, 2034, '2016-03-25', 15),
(4003, 2049, '2016-03-25', 15),
(4003, 2064, '2016-03-25', 15),
(4010, 2012, '2018-11-09', 40),
(4010, 2012, '2018-11-16', 30),
(4010, 2012, '2018-11-23', 20),
(4010, 2020, '2018-11-09', 20),
(4010, 2020, '2018-11-16', 30),
(4010, 2020, '2018-11-23', 20),
(4010, 2047, '2018-11-09', 20),
(4010, 2047, '2018-11-16', 30),
(4010, 2047, '2018-11-23', 20),
(4010, 2049, '2018-11-09', 20),
(4010, 2049, '2018-11-16', 30),
(4010, 2049, '2018-11-23', 20),
(4010, 2051, '2018-11-09', 40),
(4010, 2051, '2018-11-16', 30),
(4010, 2051, '2018-11-23', 20),
(4011, 2003, '2019-05-03', 30),
(4011, 2003, '2019-05-10', 15),
(4011, 2034, '2019-05-03', 15),
(4011, 2034, '2019-05-10', 15),
(4011, 2080, '2019-05-03', 30),
(4011, 2080, '2019-05-10', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deptno`);

--
-- Indexes for table `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ssn`),
  ADD KEY `superssn` (`superssn`),
  ADD KEY `deptno` (`deptno`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projno`),
  ADD KEY `deptno` (`deptno`);

--
-- Indexes for table `workson`
--
ALTER TABLE `workson`
  ADD PRIMARY KEY (`projno`,`ssn`,`dateworked`),
  ADD KEY `workson_ibfk_2` (`ssn`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dependents`
--
ALTER TABLE `dependents`
  ADD CONSTRAINT `dependents_ibfk_1` FOREIGN KEY (`ssn`) REFERENCES `employee` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`superssn`) REFERENCES `employee` (`ssn`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`deptno`) REFERENCES `department` (`deptno`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`deptno`) REFERENCES `department` (`deptno`);

--
-- Constraints for table `workson`
--
ALTER TABLE `workson`
  ADD CONSTRAINT `workson_ibfk_1` FOREIGN KEY (`projno`) REFERENCES `projects` (`projno`),
  ADD CONSTRAINT `workson_ibfk_2` FOREIGN KEY (`ssn`) REFERENCES `employee` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
