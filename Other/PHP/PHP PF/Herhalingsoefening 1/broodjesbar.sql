-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 aug 2023 om 15:38
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

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
-- Tabelstructuur voor tabel `besteldebroodjes`
--

CREATE TABLE `besteldebroodjes` (
  `ID` int(255) NOT NULL,
  `gebruikersID` int(255) NOT NULL,
  `broodjesID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `broodjes`
--

CREATE TABLE `broodjes` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Omschrijving` varchar(500) NOT NULL,
  `Prijs` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Gegevens worden geëxporteerd voor tabel `broodjes`
--

INSERT INTO `broodjes` (`ID`, `Naam`, `Omschrijving`, `Prijs`) VALUES
(1, 'Kaas', 'Broodje met jonge kaas', 1.90),
(2, 'Ham', 'Broodje met natuurham', 1.90),
(3, 'Kaas en ham', 'Broodje met kaas en ham', 2.10),
(4, 'Fitness kip', 'kip natuur, yoghurtdressing, perzik, tuinkers, tomaat en komkommer', 3.50),
(5, 'Broodje Sombrero', 'kip natuur, andalousesaus, rode paprika, maïs, sla, komkommer, tomaat, ei en ui ', 3.70),
(6, 'Broodje americain-tartaar', 'americain, tartaarsaus, ui, komkommer, ei en tuinkers ', 3.50),
(7, 'Broodje Indian kip', 'kip natuur, ananas, tuinkers, komkommer en curry dressing', 4.00),
(8, 'Grieks broodje', 'feta, tuinkers, komkommer, tomaat en olijventapenade', 3.90),
(9, 'Tonijntino', 'tonijn pikant, ui, augurk, martinosaus en (tabasco)', 2.60),
(10, 'Wrap exotisch', 'kip natuur, cocktailsaus, sla, tomaat, komkommer, ei en ananas', 3.70),
(11, 'Wrap kip/spek', 'Kip natuur, spek, BBQ saus, sla, tomaat en komkommer', 4.00);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `ID` int(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `emailadres` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `geblokkeerd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`ID`, `naam`, `emailadres`, `wachtwoord`, `geblokkeerd`) VALUES
(1, 'Elias Ferket', 'elias.ferket@vdabcampus.be', 'wachtwoord123', 0),
(25, 'bob', 'bob@gmail.com', 'bob', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `besteldebroodjes`
--
ALTER TABLE `besteldebroodjes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `besteldebroodjes_ibfk_1` (`gebruikersID`),
  ADD KEY `besteldebroodjes_ibfk_2` (`broodjesID`);

--
-- Indexen voor tabel `broodjes`
--
ALTER TABLE `broodjes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `besteldebroodjes`
--
ALTER TABLE `besteldebroodjes`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT voor een tabel `broodjes`
--
ALTER TABLE `broodjes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
