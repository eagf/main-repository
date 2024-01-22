-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 12:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpunten`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `moduleID` int(3) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`moduleID`, `naam`) VALUES
(1, 'Programmatielogica'),
(2, 'Computers en netwerken'),
(4, 'SQL'),
(5, 'Objectgeoriënteerde principes'),
(6, 'Javascript / DOM'),
(7, 'JQuery'),
(8, 'UML'),
(9, 'PHP'),
(11, 'XHTML/CSS');

-- --------------------------------------------------------

--
-- Table structure for table `personen`
--

CREATE TABLE `personen` (
  `persoonID` int(3) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personen`
--

INSERT INTO `personen` (`persoonID`, `naam`) VALUES
(1, 'Bram Peeters'),
(2, 'Rudy Van Dessel'),
(3, 'Marie Vereecken'),
(4, 'Eveline Maes'),
(5, 'Jole Vangeel'),
(6, 'Pieter Van Heule'),
(7, 'Katleen Naessens'),
(8, 'Koen Sleeuwaert');

-- --------------------------------------------------------

--
-- Table structure for table `punten`
--

CREATE TABLE `punten` (
  `puntID` int(3) NOT NULL,
  `moduleID` int(3) NOT NULL,
  `persoonID` int(3) NOT NULL,
  `punt` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `punten`
--

INSERT INTO `punten` (`puntID`, `moduleID`, `persoonID`, `punt`) VALUES
(1, 2, 1, 88),
(3, 7, 5, 44),
(4, 8, 1, 82);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`moduleID`);

--
-- Indexes for table `personen`
--
ALTER TABLE `personen`
  ADD PRIMARY KEY (`persoonID`);

--
-- Indexes for table `punten`
--
ALTER TABLE `punten`
  ADD PRIMARY KEY (`puntID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `moduleID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personen`
--
ALTER TABLE `personen`
  MODIFY `persoonID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `punten`
--
ALTER TABLE `punten`
  MODIFY `puntID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
