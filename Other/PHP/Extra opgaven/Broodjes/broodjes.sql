-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 sep 2023 om 12:57
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
-- Database: `broodjes`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beleg`
--

CREATE TABLE `beleg` (
  `belegid` int(3) NOT NULL,
  `soort` varchar(30) NOT NULL,
  `prijs` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `beleg`
--

INSERT INTO `beleg` (`belegid`, `soort`, `prijs`) VALUES
(1, 'hesp', 0.35),
(2, 'kaas', 0.35),
(3, 'tomaat', 0.20),
(4, 'sla', 0.15),
(5, 'boter', 0.10),
(6, 'mayonaise', 0.10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `belegdetail`
--

CREATE TABLE `belegdetail` (
  `besteldetailid` int(3) NOT NULL,
  `belegid` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelid` int(3) NOT NULL,
  `klantid` int(3) NOT NULL,
  `datumtijd` datetime NOT NULL,
  `totaalprijs` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingendetail`
--

CREATE TABLE `bestellingendetail` (
  `besteldetailid` int(3) NOT NULL,
  `bestelid` int(3) NOT NULL,
  `broodjeid` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `broodjes`
--

CREATE TABLE `broodjes` (
  `broodjeid` int(3) NOT NULL,
  `soort` varchar(30) NOT NULL,
  `prijs` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `broodjes`
--

INSERT INTO `broodjes` (`broodjeid`, `soort`, `prijs`) VALUES
(1, 'klein grof', 1.45),
(2, 'groot grof', 1.75),
(3, 'klein wit', 1.50),
(4, 'groot wit', 1.60),
(5, 'ciabatta', 1.95);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantid` int(3) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `voornaam` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `beleg`
--
ALTER TABLE `beleg`
  ADD PRIMARY KEY (`belegid`);

--
-- Indexen voor tabel `belegdetail`
--
ALTER TABLE `belegdetail`
  ADD KEY `besteldetailid` (`besteldetailid`),
  ADD KEY `belegid` (`belegid`);

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelid`),
  ADD KEY `klantid` (`klantid`);

--
-- Indexen voor tabel `bestellingendetail`
--
ALTER TABLE `bestellingendetail`
  ADD PRIMARY KEY (`besteldetailid`),
  ADD KEY `bestelid` (`bestelid`),
  ADD KEY `broodjeid` (`broodjeid`);

--
-- Indexen voor tabel `broodjes`
--
ALTER TABLE `broodjes`
  ADD PRIMARY KEY (`broodjeid`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `beleg`
--
ALTER TABLE `beleg`
  MODIFY `belegid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `bestellingendetail`
--
ALTER TABLE `bestellingendetail`
  MODIFY `besteldetailid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `broodjes`
--
ALTER TABLE `broodjes`
  MODIFY `broodjeid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `belegdetail`
--
ALTER TABLE `belegdetail`
  ADD CONSTRAINT `belegdetail_ibfk_1` FOREIGN KEY (`besteldetailid`) REFERENCES `bestellingendetail` (`besteldetailid`),
  ADD CONSTRAINT `belegdetail_ibfk_2` FOREIGN KEY (`belegid`) REFERENCES `beleg` (`belegid`);

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`klantid`) REFERENCES `klanten` (`klantid`);

--
-- Beperkingen voor tabel `bestellingendetail`
--
ALTER TABLE `bestellingendetail`
  ADD CONSTRAINT `bestellingendetail_ibfk_1` FOREIGN KEY (`bestelid`) REFERENCES `bestellingen` (`bestelid`),
  ADD CONSTRAINT `bestellingendetail_ibfk_2` FOREIGN KEY (`broodjeid`) REFERENCES `broodjes` (`broodjeid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
