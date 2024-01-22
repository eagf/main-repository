-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 02:27 PM
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
-- Database: `broodjesbar`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(5) NOT NULL,
  `datumtijd` datetime NOT NULL,
  `gebrid` int(5) NOT NULL,
  `broodid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `datumtijd`, `gebrid`, `broodid`) VALUES
(1, '2023-08-01 12:30:09', 1, 1),
(2, '2023-08-01 12:30:09', 1, 5),
(3, '2023-08-02 12:44:53', 1, 8),
(4, '2023-08-01 12:56:42', 1, 4),
(5, '2023-08-01 12:58:08', 1, 2),
(6, '2023-08-01 12:58:44', 1, 8),
(7, '2023-08-01 12:59:17', 1, 8),
(8, '2023-08-01 13:13:08', 1, 11),
(9, '2023-08-01 13:13:27', 1, 11),
(10, '2023-08-01 13:46:26', 1, 1),
(11, '2023-08-01 13:47:39', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `broodjes`
--

CREATE TABLE `broodjes` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Omschrijving` varchar(500) NOT NULL,
  `Prijs` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `broodjes`
--

INSERT INTO `broodjes` (`ID`, `Naam`, `Omschrijving`, `Prijs`) VALUES
(1, 'Kaas', 'Broodje met jonge kaas', '1.90'),
(2, 'Ham', 'Broodje met natuurham', '1.90'),
(3, 'Kaas en ham', 'Broodje met kaas en ham', '2.10'),
(4, 'Fitness kip', 'kip natuur, yoghurtdressing, perzik, tuinkers, tomaat en komkommer', '3.50'),
(5, 'Broodje Sombrero', 'kip natuur, andalousesaus, rode paprika, maïs, sla, komkommer, tomaat, ei en ui ', '3.70'),
(6, 'Broodje americain-tartaar', 'americain, tartaarsaus, ui, komkommer, ei en tuinkers ', '3.50'),
(7, 'Broodje Indian kip', 'kip natuur, ananas, tuinkers, komkommer en curry dressing', '4.00'),
(8, 'Grieks broodje', 'feta, tuinkers, komkommer, tomaat en olijventapenade', '3.90'),
(9, 'Tonijntino', 'tonijn pikant, ui, augurk, martinosaus en (tabasco)', '2.60'),
(10, 'Wrap exotisch', 'kip natuur, cocktailsaus, sla, tomaat, komkommer, ei en ananas', '3.70'),
(11, 'Wrap kip/spek', 'Kip natuur, spek, BBQ saus, sla, tomaat en komkommer', '4.00');

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(5) NOT NULL,
  `naam` varchar(75) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wachtwoord` varchar(30) NOT NULL,
  `geblokkeerd` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `naam`, `email`, `wachtwoord`, `geblokkeerd`) VALUES
(1, 'Jan Janssens', 'jan@gmail.be', 'jan', 0),
(2, 'Ben Willems', 'ben@gmail.be', 'ben', 1),
(3, 'Doe', 'jane@doe.be', 'test', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `broodjes`
--
ALTER TABLE `broodjes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `broodjes`
--
ALTER TABLE `broodjes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
