-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 03 aug 2023 om 13:33
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
-- Database: `cursusphp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `naam` varchar(50) NOT NULL,
  `prijs` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `modules`
--

INSERT INTO `modules` (`id`, `naam`, `prijs`) VALUES
(1, 'Programmatielogica', 75),
(2, 'Computers en netwerken', 130),
(4, 'SQL', 99.9),
(5, 'Objectgeoriënteerde principes', 85),
(6, 'Javascript / DOM', 140),
(7, 'JQuery', 120),
(8, 'UML', 90),
(9, 'PHP', 140),
(11, 'XHTML/CSS', 120);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personen`
--

CREATE TABLE `personen` (
  `id` int(10) UNSIGNED NOT NULL,
  `familienaam` varchar(50) NOT NULL,
  `voornaam` varchar(30) NOT NULL,
  `geboortedatum` date NOT NULL,
  `geslacht` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `personen`
--

INSERT INTO `personen` (`id`, `familienaam`, `voornaam`, `geboortedatum`, `geslacht`) VALUES
(1, 'Peeters', 'Bram', '1976-01-19', 'M'),
(2, 'Van Dessel', 'Rudy', '1969-10-05', 'M'),
(3, 'Vereecken', 'Marie', '1981-05-23', 'V'),
(4, 'Maes', 'Eveline', '1983-08-16', 'V'),
(5, 'Vangeel', 'Joke', '1976-05-22', 'V'),
(6, 'Van Heule', 'Pieter', '1968-03-02', 'M'),
(7, 'Naessens', 'Katleen', '1984-05-12', 'V'),
(8, 'Sleeuwaert', 'Koen', '1957-02-25', 'M');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `punten`
--

CREATE TABLE `punten` (
  `moduleID` int(255) NOT NULL,
  `persoonID` int(255) NOT NULL,
  `punt` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `personen`
--
ALTER TABLE `personen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `personen`
--
ALTER TABLE `personen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
