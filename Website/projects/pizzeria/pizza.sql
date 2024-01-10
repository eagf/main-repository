-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 sep 2023 om 09:25
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
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellijnen`
--

CREATE TABLE `bestellijnen` (
  `bestelId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `bestelPrijs` decimal(10,2) NOT NULL,
  `bestelPromotieprijs` decimal(10,2) NOT NULL,
  `productAantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelId` int(11) NOT NULL,
  `klantId` int(11) NOT NULL,
  `bestelDatumTijd` varchar(255) NOT NULL,
  `bestelInfo` varchar(255) NOT NULL,
  `bestelPromo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int(11) NOT NULL,
  `klantNaam` varchar(255) NOT NULL,
  `klantVoornaam` varchar(255) NOT NULL,
  `klantStraat` varchar(255) NOT NULL,
  `klantHuisnummer` int(11) NOT NULL,
  `plaatsId` int(11) NOT NULL,
  `klantTelefoonnummer` int(11) NOT NULL,
  `klantEmail` varchar(255) NOT NULL,
  `klantWachtwoord` varchar(255) NOT NULL,
  `klantInfo` varchar(255) NOT NULL,
  `klantPromo` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `plaatsen`
--

CREATE TABLE `plaatsen` (
  `plaatsId` int(11) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `woonplaats` varchar(255) NOT NULL,
  `isLeverbaar` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `plaatsen`
--

INSERT INTO `plaatsen` (`plaatsId`, `postcode`, `woonplaats`, `isLeverbaar`) VALUES
(1, '9000', 'Gent', 1),
(2, '8000', 'Brugge', 0),
(3, '9300', 'Aalst', 1),
(4, '2300', 'Turnhout', 0),
(5, '3500', 'Hasselt', 0),
(6, '2000', 'Antwerpen', 0),
(7, '3800', 'St-Truiden', 0),
(8, '8800', 'Roeselare', 0),
(9, '9800', 'Deinze', 1),
(10, '8810', 'Lichtervelde', 0),
(11, '2200', 'Herentals', 0),
(12, '8500', 'Kortrijk', 0),
(13, '3700', 'Tongeren', 0),
(14, '8400', 'Oostende', 0),
(15, '3600', 'Genk', 0),
(16, '8490', 'Jabbeke', 0),
(17, '8320', 'Assebroek', 0),
(18, '8730', 'Oedelem', 0),
(19, '2950', 'Kapellen', 0),
(20, '2140', 'Borgerhout', 0),
(21, '2110', 'Wijnegem', 0),
(22, '2100', 'Deurne', 0),
(23, '3920', 'Lommel', 0),
(24, '3680', 'Maaseik', 0),
(25, '3630', 'Maasmechelen', 0),
(26, '3150', 'Haacht', 0),
(27, '3000', 'Leuven', 0),
(28, '3300', 'Tienen', 0),
(32, '9030', 'Mariakerke', 1),
(33, '9031', 'Drongen', 1),
(34, '9032', 'Wondelgem', 1),
(35, '9040', 'Sint-Amandsberg', 1),
(36, '9041', 'Oostakker', 1),
(37, '9042', 'Desteldonk', 1),
(40, '9050', 'Gentbrugge', 1),
(43, '9051', 'Sint-Denijs-Westrem', 1),
(44, '9052', 'Zwijnaarde', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `productId` int(11) NOT NULL,
  `productNaam` varchar(255) NOT NULL,
  `productPrijs` decimal(10,2) NOT NULL,
  `productPromotieprijs` decimal(10,2) NOT NULL,
  `productSamenstelling` varchar(255) NOT NULL,
  `productBeschikbaarheid` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`productId`, `productNaam`, `productPrijs`, `productPromotieprijs`, `productSamenstelling`, `productBeschikbaarheid`) VALUES
(1, 'Pizza Hawaï', 12.00, 10.00, 'Tomatensaus, Ham, Ananas, Kaas', b'1'),
(2, 'Pizza Calzone', 13.00, 11.00, 'Tomatensaus, Ham, Ricotta kaas, Mozzarella kaas', b'1'),
(3, 'Pizza BBQ Chicken', 14.00, 12.00, 'BBQ-saus, Gegrilde kip, Rode ui, Kaas', b'1'),
(4, 'Pizza Quattro Stagioni', 12.00, 10.00, 'Tomatensaus, Ham, Champignons, Artisjokken, Olijven, Kaas', b'1'),
(5, 'Pizza Quattro Formaggi', 14.00, 12.00, 'Witte saus, Gorgonzola kaas, Mozzarella kaas, Parmezaanse kaas, Ricotta kaas', b'1'),
(6, 'Pizza Pepperoni', 13.00, 11.00, 'Tomatensaus, Pepperoni, Kaas', b'1'),
(7, 'Chickenfingers', 4.50, 3.50, 'Kip, Paneermeel, Kruiden', b'1'),
(8, 'Lookbroodjes', 5.00, 4.00, 'Brood, Knoflook, Boter, Kruiden', b'1'),
(9, 'Coleslaw', 3.20, 2.20, 'Witte kool, Wortelen, Mayonaise, Azijn, Suiker, Zout', b'1');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  ADD PRIMARY KEY (`bestelId`,`productId`),
  ADD KEY `productId` (`productId`);

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelId`),
  ADD KEY `klantId` (`klantId`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`),
  ADD KEY `plaatsId` (`plaatsId`);

--
-- Indexen voor tabel `plaatsen`
--
ALTER TABLE `plaatsen`
  ADD PRIMARY KEY (`plaatsId`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT voor een tabel `plaatsen`
--
ALTER TABLE `plaatsen`
  MODIFY `plaatsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellijnen`
--
ALTER TABLE `bestellijnen`
  ADD CONSTRAINT `bestellijnen_ibfk_1` FOREIGN KEY (`bestelId`) REFERENCES `bestellingen` (`bestelId`),
  ADD CONSTRAINT `bestellijnen_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `producten` (`productId`);

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`);

--
-- Beperkingen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD CONSTRAINT `klanten_ibfk_1` FOREIGN KEY (`plaatsId`) REFERENCES `plaatsen` (`plaatsId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
