-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 feb 2024 om 16:19
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libeer-vastgoed-db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `adressen`
--

CREATE TABLE `adressen` (
  `adresID` int(11) NOT NULL,
  `land` varchar(100) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `gemeente` varchar(100) DEFAULT NULL,
  `straat` varchar(100) DEFAULT NULL,
  `nr` varchar(10) DEFAULT NULL,
  `bus` varchar(10) DEFAULT NULL,
  `adresOpAanvraag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `adressen`
--

INSERT INTO `adressen` (`adresID`, `land`, `postcode`, `gemeente`, `straat`, `nr`, `bus`, `adresOpAanvraag`) VALUES
(1, 'België', '1000', 'Brussel', 'Hoofdstraat', '1', '', 0),
(2, 'België', '2000', 'Antwerpen', 'Zijstraat', '20', '1A', 0),
(3, 'België', '3000', 'Leuven', 'Markt', '10', '', 1),
(4, 'België', '4000', 'Luik', 'Parklaan', '333', 'B', 0),
(5, 'België', '5000', 'Namen', 'Kanaalweg', '58', '', 0),
(46, 'test', 'test', 'test', 'test', 'test', 'test', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afbeeldingen`
--

CREATE TABLE `afbeeldingen` (
  `afbeeldingID` int(11) NOT NULL,
  `pandID` int(11) DEFAULT NULL,
  `afbeeldingURL` varchar(255) DEFAULT NULL,
  `beschrijving` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `afbeeldingen`
--

INSERT INTO `afbeeldingen` (`afbeeldingID`, `pandID`, `afbeeldingURL`, `beschrijving`) VALUES
(6, 1, './assets/img/panden/image1.jpg', 'Hoofdafbeelding van het pand'),
(7, 2, './assets/img/panden/image2.jpg', 'Hoofdafbeelding van het pand'),
(8, 3, './assets/img/panden/image3.jpg', 'Hoofdafbeelding van het pand'),
(9, 4, './assets/img/panden/image4.png', 'Hoofdafbeelding van het pand'),
(10, 5, './assets/img/panden/image5.jpg', 'Hoofdafbeelding van het pand'),
(11, 1, './assets/img/panden/apartment4.png', 'Modern appartement met een stijlvol interieur'),
(12, 1, './assets/img/panden/apartment5.png', 'Gezellig appartement dicht bij de stad'),
(13, 1, './assets/img/panden/apartment6.png', 'Appartement met een panoramisch uitzicht'),
(14, 1, './assets/img/panden/apartment2.png', 'Appartement met een groot terras'),
(15, 1, './assets/img/panden/apartment3.png', 'Appartement in een rustige buurt'),
(16, 2, './assets/img/panden/villa2.png', 'Luxe villa met een privézwembad'),
(17, 2, './assets/img/panden/villa3.png', 'Ruime villa met een prachtige tuin'),
(18, 2, './assets/img/panden/villa4.png', 'Villa met uitzicht op zee'),
(19, 2, './assets/img/panden/villa5.png', 'Villa gelegen in een exclusieve wijk'),
(20, 2, './assets/img/panden/villa6.png', 'Moderne villa met high-tech voorzieningen'),
(21, 3, './assets/img/panden/bungalow2.png', 'Knusse bungalow in een natuurrijke omgeving'),
(22, 3, './assets/img/panden/bungalow3.png', 'Bungalow met een grote tuin'),
(23, 3, './assets/img/panden/bungalow4.png', 'Bungalow dicht bij het strand'),
(24, 3, './assets/img/panden/bungalow5.png', 'Bungalow met een sfeervolle inrichting'),
(25, 3, './assets/img/panden/bungalow6.png', 'Bungalow in een rustige buurt'),
(26, 4, './assets/img/panden/loft2.jpg', 'Industriële loft met veel ruimte'),
(27, 4, './assets/img/panden/loft3.png', 'Loft met een uniek design'),
(28, 4, './assets/img/panden/loft4.png', 'Loft in een historisch gebouw'),
(29, 4, './assets/img/panden/loft5.png', 'Loft met een fantastisch uitzicht'),
(30, 4, './assets/img/panden/loft6.png', 'Loft met een moderne uitstraling'),
(31, 5, './assets/img/panden/landhuis2.png', 'Landhuis met veel privacy en ruimte'),
(32, 5, './assets/img/panden/landhuis3.png', 'Landhuis met een klassieke charme'),
(33, 5, './assets/img/panden/landhuis4.png', 'Landhuis dicht bij het bos'),
(34, 5, './assets/img/panden/landhuis5.png', 'Landhuis met een grote vijver'),
(35, 5, './assets/img/panden/landhuis6.png', 'Landhuis met een ruim balkon'),
(67, 47, './assets/img/panden/image_1708589025_4217.webp', ''),
(68, 47, './assets/img/panden/image_1708589025_9974.png', ''),
(69, 47, './assets/img/panden/image_1708589025_6148.png', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `kamers`
--

CREATE TABLE `kamers` (
  `kamerID` int(11) NOT NULL,
  `pandID` int(11) DEFAULT NULL,
  `kamerNaam` varchar(100) DEFAULT NULL,
  `kamerOppervlakte` decimal(10,2) DEFAULT NULL,
  `kamerDetail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `kamers`
--

INSERT INTO `kamers` (`kamerID`, `pandID`, `kamerNaam`, `kamerOppervlakte`, `kamerDetail`) VALUES
(1, 1, 'Woonkamer', 30.00, 'Ruime woonkamer met veel natuurlijk licht.'),
(2, 1, 'Keuken', 15.00, 'Moderne keuken met inbouwapparatuur.'),
(3, 1, 'Slaapkamer', 20.00, 'Hoofdslaapkamer met aangrenzende badkamer.'),
(4, 2, 'Woonkamer', 25.00, 'Gezellige woonkamer met open haard.'),
(5, 2, 'Keuken', 10.00, 'Compacte keuken met moderne voorzieningen.'),
(6, 3, 'Slaapkamer', 18.00, 'Slaapkamer met balkon.'),
(7, 3, 'Badkamer', 8.00, 'Badkamer met bad en aparte douche.'),
(8, 4, 'Eetkamer', 20.00, 'Ruime eetkamer, ideaal voor diners.'),
(9, 4, 'Bureau', 12.00, 'Kantoorruimte met ingebouwde boekenkasten.'),
(10, 5, 'Garage', 35.00, 'Grote garage met ruimte voor twee auto\'s.'),
(66, 47, 'test', 12.00, 'test: kamer details');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `panddetails`
--

CREATE TABLE `panddetails` (
  `pandDetailID` int(11) NOT NULL,
  `isNieuw` tinyint(1) DEFAULT NULL,
  `isOpbrengsteigendom` tinyint(1) DEFAULT NULL,
  `isExclusiefVastgoed` tinyint(1) DEFAULT NULL,
  `isBeleggingsvastgoed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `panddetails`
--

INSERT INTO `panddetails` (`pandDetailID`, `isNieuw`, `isOpbrengsteigendom`, `isExclusiefVastgoed`, `isBeleggingsvastgoed`) VALUES
(1, 1, 0, 0, 1),
(2, 0, 1, 0, 0),
(3, 0, 0, 1, 0),
(4, 1, 0, 0, 0),
(5, 0, 0, 0, 1),
(6, 0, 0, 0, 0),
(7, 0, 0, 0, 0),
(8, 0, 0, 0, 0),
(9, 0, 0, 0, 0),
(10, 0, 0, 0, 0),
(11, 0, 0, 0, 0),
(12, 0, 0, 0, 0),
(13, 0, 0, 0, 0),
(14, 0, 0, 0, 0),
(15, 0, 0, 0, 0),
(16, 0, 0, 0, 0),
(17, 0, 0, 0, 0),
(18, 0, 0, 0, 0),
(19, 0, 0, 0, 0),
(21, 0, 0, 0, 0),
(22, 0, 0, 0, 0),
(23, 0, 0, 0, 0),
(24, 0, 0, 0, 0),
(25, 0, 0, 0, 0),
(26, 0, 0, 0, 0),
(27, 0, 0, 0, 0),
(28, 0, 0, 0, 0),
(29, 0, 0, 0, 0),
(30, 0, 0, 0, 0),
(31, 0, 0, 0, 0),
(32, 0, 0, 0, 0),
(33, 0, 0, 0, 0),
(34, 0, 0, 0, 0),
(35, 0, 0, 0, 0),
(36, 0, 1, 0, 0),
(37, 0, 0, 0, 0),
(38, 0, 0, 0, 0),
(39, 0, 0, 0, 0),
(40, 0, 0, 0, 0),
(41, 0, 0, 0, 0),
(42, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `panden`
--

CREATE TABLE `panden` (
  `pandID` int(11) NOT NULL,
  `titel` varchar(255) DEFAULT NULL,
  `tekst` text DEFAULT NULL,
  `pandDetailID` int(11) DEFAULT NULL,
  `status` enum('Te koop','Te huur') DEFAULT NULL,
  `adresID` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `subtype` varchar(100) DEFAULT NULL,
  `aanvullingSubtype` varchar(255) DEFAULT NULL,
  `bouwjaar` year(4) DEFAULT NULL,
  `brutoVloeroppervlakte` decimal(10,2) DEFAULT NULL,
  `grondoppervlakte` decimal(10,2) DEFAULT NULL,
  `aantalSlaapkamers` int(11) DEFAULT NULL,
  `prijs` decimal(10,2) DEFAULT NULL,
  `kadastraalInkomen` decimal(10,2) DEFAULT NULL,
  `registratierechtenBTW` enum('21%','6%','Registratierechten') DEFAULT NULL,
  `vrijOp` date DEFAULT NULL,
  `wettelijkeInfoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `panden`
--

INSERT INTO `panden` (`pandID`, `titel`, `tekst`, `pandDetailID`, `status`, `adresID`, `type`, `subtype`, `aanvullingSubtype`, `bouwjaar`, `brutoVloeroppervlakte`, `grondoppervlakte`, `aantalSlaapkamers`, `prijs`, `kadastraalInkomen`, `registratierechtenBTW`, `vrijOp`, `wettelijkeInfoID`) VALUES
(1, 'Charmant appartement', 'Een gezellig appartement in het hart van de stad.', 1, 'Te koop', 1, 'Appartement', 'Standaard', 'Geen', '1990', 75.00, 0.00, 2, 250000.00, 500.00, '21%', '2024-06-01', 1),
(2, 'Moderne villa', 'Ruime en moderne villa met een grote tuin.', 2, 'Te koop', 2, 'Villa', 'Luxe', 'Moderne villa', '2005', 200.00, 1500.00, 4, 750000.00, 2000.00, '21%', '2024-07-01', 2),
(3, 'Gezellige bungalow', 'Een comfortabele bungalow in een rustige buurt.', 1, 'Te huur', 3, 'Bungalow', 'Standaard', 'Geen', '1985', 90.00, 500.00, 3, 1200.00, 300.00, '21%', '2024-08-01', 3),
(4, 'Stadsloft', 'Moderne loft in een levendige buurt.', 2, 'Te huur', 4, 'Loft', 'Standaard', 'Geen', '2015', 100.00, 0.00, 1, 1500.00, 400.00, '21%', '2024-09-01', 4),
(5, 'Landhuis', 'Prachtig landhuis omringd door natuur.', 1, 'Te koop', 5, 'Huis', 'Landhuis', 'Cottage style', '1970', 250.00, 3000.00, 5, 850000.00, 2500.00, '21%', '2024-10-01', 5),
(47, 'test', 'test', 42, 'Te koop', 46, 'test', 'test', 'test', '1992', 87.00, 102.00, 3, 300000.00, 15000.00, '21%', '2024-08-13', 43);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wettelijkeinformatie`
--

CREATE TABLE `wettelijkeinformatie` (
  `wettelijkeInfoID` int(11) NOT NULL,
  `epcIndex` decimal(10,2) DEFAULT NULL,
  `energieLabel` char(1) DEFAULT NULL,
  `stedenbouwkundigeVergunning` tinyint(1) DEFAULT NULL,
  `verkavelingsvergunning` tinyint(1) DEFAULT NULL,
  `voorkooprecht` tinyint(1) DEFAULT NULL,
  `stedenbouwkundigeBestemming` varchar(255) DEFAULT NULL,
  `dagvaardingEnHerstelvordering` tinyint(1) DEFAULT NULL,
  `effectiefOverstromingsgevoelig` tinyint(1) DEFAULT NULL,
  `mogelijkOverstromingsgevoelig` tinyint(1) DEFAULT NULL,
  `afgebakendOverstromingsgebied` tinyint(1) DEFAULT NULL,
  `afgebakendeOeverzone` tinyint(1) DEFAULT NULL,
  `risicozoneVoorOverstromingen` tinyint(1) DEFAULT NULL,
  `overstromingskansPerceel` decimal(10,2) DEFAULT NULL,
  `overstromingskansGebouw` decimal(10,2) DEFAULT NULL,
  `erfgoed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `wettelijkeinformatie`
--

INSERT INTO `wettelijkeinformatie` (`wettelijkeInfoID`, `epcIndex`, `energieLabel`, `stedenbouwkundigeVergunning`, `verkavelingsvergunning`, `voorkooprecht`, `stedenbouwkundigeBestemming`, `dagvaardingEnHerstelvordering`, `effectiefOverstromingsgevoelig`, `mogelijkOverstromingsgevoelig`, `afgebakendOverstromingsgebied`, `afgebakendeOeverzone`, `risicozoneVoorOverstromingen`, `overstromingskansPerceel`, `overstromingskansGebouw`, `erfgoed`) VALUES
(1, 150.00, 'B', 1, 0, 0, 'Woongebied', 0, 1, 0, 0, 0, 1, 0.20, 0.10, 0),
(2, 200.00, 'A', 1, 1, 0, 'Handelsgebied', 0, 0, 1, 0, 0, 0, 0.00, 0.00, 0),
(3, 175.00, 'C', 0, 0, 1, 'Industriegebied', 1, 1, 1, 0, 0, 1, 0.50, 0.40, 0),
(4, 100.00, 'A', 1, 0, 0, 'Gemengd gebied', 0, 0, 0, 1, 1, 0, 0.10, 0.20, 1),
(5, 220.00, 'D', 0, 1, 1, 'Landbouwgebied', 1, 1, 0, 1, 1, 0, 0.30, 0.30, 0),
(43, 120.00, 'A', NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `adressen`
--
ALTER TABLE `adressen`
  ADD PRIMARY KEY (`adresID`);

--
-- Indexen voor tabel `afbeeldingen`
--
ALTER TABLE `afbeeldingen`
  ADD PRIMARY KEY (`afbeeldingID`),
  ADD KEY `pandID` (`pandID`);

--
-- Indexen voor tabel `kamers`
--
ALTER TABLE `kamers`
  ADD PRIMARY KEY (`kamerID`),
  ADD KEY `pandID` (`pandID`);

--
-- Indexen voor tabel `panddetails`
--
ALTER TABLE `panddetails`
  ADD PRIMARY KEY (`pandDetailID`);

--
-- Indexen voor tabel `panden`
--
ALTER TABLE `panden`
  ADD PRIMARY KEY (`pandID`),
  ADD KEY `pandDetailID` (`pandDetailID`),
  ADD KEY `adresID` (`adresID`),
  ADD KEY `wettelijkeInfoID` (`wettelijkeInfoID`);

--
-- Indexen voor tabel `wettelijkeinformatie`
--
ALTER TABLE `wettelijkeinformatie`
  ADD PRIMARY KEY (`wettelijkeInfoID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `adressen`
--
ALTER TABLE `adressen`
  MODIFY `adresID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT voor een tabel `afbeeldingen`
--
ALTER TABLE `afbeeldingen`
  MODIFY `afbeeldingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT voor een tabel `kamers`
--
ALTER TABLE `kamers`
  MODIFY `kamerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT voor een tabel `panddetails`
--
ALTER TABLE `panddetails`
  MODIFY `pandDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT voor een tabel `panden`
--
ALTER TABLE `panden`
  MODIFY `pandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT voor een tabel `wettelijkeinformatie`
--
ALTER TABLE `wettelijkeinformatie`
  MODIFY `wettelijkeInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `afbeeldingen`
--
ALTER TABLE `afbeeldingen`
  ADD CONSTRAINT `afbeeldingen_ibfk_1` FOREIGN KEY (`pandID`) REFERENCES `panden` (`pandID`);

--
-- Beperkingen voor tabel `kamers`
--
ALTER TABLE `kamers`
  ADD CONSTRAINT `kamers_ibfk_1` FOREIGN KEY (`pandID`) REFERENCES `panden` (`pandID`);

--
-- Beperkingen voor tabel `panden`
--
ALTER TABLE `panden`
  ADD CONSTRAINT `panden_ibfk_1` FOREIGN KEY (`pandDetailID`) REFERENCES `panddetails` (`pandDetailID`),
  ADD CONSTRAINT `panden_ibfk_2` FOREIGN KEY (`adresID`) REFERENCES `adressen` (`adresID`),
  ADD CONSTRAINT `panden_ibfk_3` FOREIGN KEY (`wettelijkeInfoID`) REFERENCES `wettelijkeinformatie` (`wettelijkeInfoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
