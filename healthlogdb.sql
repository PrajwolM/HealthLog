-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2024 at 07:17 AM
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
-- Database: `healthlogdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `userName` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`userName`, `password`) VALUES
('admin', '1234'),
('prajwol', 'prajwol'),
('admin', 'admin0');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointmentId` int(11) NOT NULL,
  `did` varchar(10) NOT NULL,
  `pid` varchar(10) NOT NULL,
  `appointmentDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointmentId`, `did`, `pid`, `appointmentDate`) VALUES
(1, 'D0822', 'P001', '2024-09-25'),
(2, 'D0822', 'P002', '2024-09-26'),
(3, 'D0822', 'P001', '2024-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `doctorinfo`
--

CREATE TABLE `doctorinfo` (
  `did` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `specialization` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorinfo`
--

INSERT INTO `doctorinfo` (`did`, `name`, `surname`, `gender`, `specialization`) VALUES
('D0822', 'Ranchod', 'Chanchad', 'Male', 'Liver Transplant'),
('D0833', 'Samad', 'Chanchad', 'Male', 'Kidney Transplant'),
('D0833', 'hera', 'Chanchad', 'Male', ' ECG'),
('D0867', 'King', 'Red', 'Male', 'Opthalmology');

-- --------------------------------------------------------

--
-- Table structure for table `doctorlogin`
--

CREATE TABLE `doctorlogin` (
  `did` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorlogin`
--

INSERT INTO `doctorlogin` (`did`, `password`) VALUES
('D0822', 'doctor'),
('D0833', 'doctor2'),
('D0855', 'doctor4'),
('D0866', 'doctor5'),
('D0867', 'doctor6');

-- --------------------------------------------------------

--
-- Table structure for table `doctorpatient`
--

CREATE TABLE `doctorpatient` (
  `did` varchar(10) NOT NULL,
  `pid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorpatient`
--

INSERT INTO `doctorpatient` (`did`, `pid`) VALUES
('D0822', 'P002'),
('D0833', 'P002'),
('D0822', 'P001');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inquiryId` int(4) NOT NULL,
  `iname` varchar(50) NOT NULL,
  `iemail` varchar(50) NOT NULL,
  `icontact` varchar(10) NOT NULL,
  `inquiry` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiryId`, `iname`, `iemail`, `icontact`, `inquiry`) VALUES
(1, 'Queen', 'p.mdr79@gmail.com', '0466854022', 'Is this Credible.'),
(2, 'King', 'p.mdr79@gmail.com', '0466854022', 'Is this Credible.');

-- --------------------------------------------------------

--
-- Table structure for table `patientinfo`
--

CREATE TABLE `patientinfo` (
  `pid` varchar(10) NOT NULL,
  `pName` varchar(50) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `pGender` varchar(20) NOT NULL,
  `pDOB` date NOT NULL,
  `pAllergies` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientinfo`
--

INSERT INTO `patientinfo` (`pid`, `pName`, `phoneNumber`, `pGender`, `pDOB`, `pAllergies`) VALUES
('P001', 'Maharaja Prasad', '9865329865', 'Male', '2014-09-15', 1),
('P002', 'Maharani Prasad', '6932581471', 'Male', '2014-09-16', 1),
('P003', 'Prince Prasad', '4561237896', 'Male', '2014-09-12', 0),
('P004', 'Princess Prasad', '5427989631', 'Male', '2014-09-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patienttest`
--

CREATE TABLE `patienttest` (
  `tid` varchar(10) NOT NULL,
  `pid` varchar(10) NOT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patienttest`
--

INSERT INTO `patienttest` (`tid`, `pid`, `complete`) VALUES
('T001', 'P001', 0),
('T001', 'P002', 1),
('T002', 'P002', 1),
('T003', 'P002', 0),
('T002', 'P001', 1),
('T003', 'P001', 1),
('T004', 'P001', 1),
('T005', 'P001', 0),
('T001', 'P003', 0),
('T002', 'P003', 1),
('T003', 'P003', 1),
('T004', 'P003', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `tid` varchar(10) NOT NULL,
  `tName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`tid`, `tName`) VALUES
('T001', 'Blood Sugar Test'),
('T002', 'Blood Test'),
('T003', 'Urine Analysis Test'),
('T004', 'Stool Test'),
('T005', 'Viral Test'),
('T006', 'MRI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointmentId`),
  ADD KEY `dpa1` (`did`),
  ADD KEY `dpa2` (`pid`);

--
-- Indexes for table `doctorinfo`
--
ALTER TABLE `doctorinfo`
  ADD KEY `fk1` (`did`);

--
-- Indexes for table `doctorlogin`
--
ALTER TABLE `doctorlogin`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `doctorpatient`
--
ALTER TABLE `doctorpatient`
  ADD KEY `dp1` (`did`),
  ADD KEY `dp2` (`pid`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inquiryId`);

--
-- Indexes for table `patientinfo`
--
ALTER TABLE `patientinfo`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `patienttest`
--
ALTER TABLE `patienttest`
  ADD KEY `pt1` (`pid`),
  ADD KEY `pt2` (`tid`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inquiryId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `dpa1` FOREIGN KEY (`did`) REFERENCES `doctorinfo` (`did`),
  ADD CONSTRAINT `dpa2` FOREIGN KEY (`pid`) REFERENCES `patientinfo` (`pid`);

--
-- Constraints for table `doctorinfo`
--
ALTER TABLE `doctorinfo`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`did`) REFERENCES `doctorlogin` (`did`);

--
-- Constraints for table `doctorpatient`
--
ALTER TABLE `doctorpatient`
  ADD CONSTRAINT `dp1` FOREIGN KEY (`did`) REFERENCES `doctorinfo` (`did`),
  ADD CONSTRAINT `dp2` FOREIGN KEY (`pid`) REFERENCES `patientinfo` (`pid`);

--
-- Constraints for table `patienttest`
--
ALTER TABLE `patienttest`
  ADD CONSTRAINT `pt1` FOREIGN KEY (`pid`) REFERENCES `patientinfo` (`pid`),
  ADD CONSTRAINT `pt2` FOREIGN KEY (`tid`) REFERENCES `tests` (`tid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
