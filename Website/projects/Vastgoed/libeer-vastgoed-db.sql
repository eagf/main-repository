-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 dec 2024 om 15:12
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
(1, 'België', '1000', 'Brussel', 'Hoofdstraat', '1', '', NULL),
(2, 'België', '2000', 'Antwerpen', 'Zijstraat', '20', '1A', NULL),
(3, 'België', '3000', 'Leuven', 'Markt', '10', '', 1),
(4, 'België', '4000', 'Luik', 'Parklaan', '333', 'B', 0),
(5, 'België', '5000', 'Namen', 'Kanaalweg', '58', '', 0),
(7, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(8, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(9, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(10, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(11, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(12, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(13, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(14, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(15, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(18, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(19, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(20, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(21, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(22, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(24, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(26, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(27, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(28, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(29, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(30, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(31, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(32, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(33, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(34, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(35, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(36, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(37, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(38, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(39, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(40, 'testzegf', 'test', 'test', 'test', 'test', 'test', NULL),
(41, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(42, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(43, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(44, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(45, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(46, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(47, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(48, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(51, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(52, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(54, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(55, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(56, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(57, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(59, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(60, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(61, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(62, 'test', 'test', 'test', 'test', 'test', 'test', 1),
(63, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(64, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(65, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(66, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(67, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(68, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(69, 'test', 'test', 'test', 'test', 'test', 'test', 0),
(70, 'test', 'test', 'test', 'test', 'test', 'test', NULL),
(71, 'test', 'test', 'test', 'test', 'test', 'test', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afbeeldingen`
--

CREATE TABLE `afbeeldingen` (
  `afbeeldingID` int(11) NOT NULL,
  `pandID` int(11) DEFAULT NULL,
  `afbeeldingURL` varchar(255) DEFAULT NULL,
  `beschrijving` text DEFAULT NULL,
  `klein` tinyint(1) NOT NULL,
  `volgorde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `afbeeldingen`
--

INSERT INTO `afbeeldingen` (`afbeeldingID`, `pandID`, `afbeeldingURL`, `beschrijving`, `klein`, `volgorde`) VALUES
(6, 1, './assets/img/panden/image1.jpg', 'Hoofdafbeelding van het pand', 0, 1),
(7, 2, './assets/img/panden/image2.jpg', 'Hoofdafbeelding van het pand', 0, 1),
(8, 3, './assets/img/panden/image3.jpg', 'Hoofdafbeelding van het pand', 0, 1),
(9, 4, './assets/img/panden/image4.png', 'Hoofdafbeelding van het pand', 0, 1),
(10, 5, './assets/img/panden/image5.jpg', 'Hoofdafbeelding van het pand', 0, 1),
(11, 1, './assets/img/panden/apartment4.png', 'Modern appartement met een stijlvol interieur', 0, 2),
(12, 1, './assets/img/panden/apartment5.png', 'Gezellig appartement dicht bij de stad', 0, 3),
(13, 1, './assets/img/panden/apartment6.png', 'Appartement met een panoramisch uitzicht', 0, 4),
(14, 1, './assets/img/panden/apartment2.png', 'Appartement met een groot terras', 0, 5),
(15, 1, './assets/img/panden/apartment3.png', 'Appartement in een rustige buurt', 0, 6),
(16, 2, './assets/img/panden/villa2.png', 'Luxe villa met een privézwembad', 0, 2),
(17, 2, './assets/img/panden/villa3.png', 'Ruime villa met een prachtige tuin', 0, 3),
(18, 2, './assets/img/panden/villa4.png', 'Villa met uitzicht op zee', 0, 4),
(19, 2, './assets/img/panden/villa5.png', 'Villa gelegen in een exclusieve wijk', 0, 5),
(20, 2, './assets/img/panden/villa6.png', 'Moderne villa met high-tech voorzieningen', 0, 6),
(21, 3, './assets/img/panden/bungalow2.png', 'Knusse bungalow in een natuurrijke omgeving', 0, 2),
(22, 3, './assets/img/panden/bungalow3.png', 'Bungalow met een grote tuin', 0, 3),
(23, 3, './assets/img/panden/bungalow4.png', 'Bungalow dicht bij het strand', 0, 4),
(24, 3, './assets/img/panden/bungalow5.png', 'Bungalow met een sfeervolle inrichting', 0, 5),
(25, 3, './assets/img/panden/bungalow6.png', 'Bungalow in een rustige buurt', 0, 6),
(26, 4, './assets/img/panden/loft2.jpg', 'Industriële loft met veel ruimte', 0, 2),
(27, 4, './assets/img/panden/loft3.png', 'Loft met een uniek design', 0, 3),
(28, 4, './assets/img/panden/loft4.png', 'Loft in een historisch gebouw', 0, 4),
(31, 5, './assets/img/panden/landhuis2.png', 'Landhuis met veel privacy en ruimte', 0, 2),
(32, 5, './assets/img/panden/landhuis3.png', 'Landhuis met een klassieke charme', 0, 3),
(33, 5, './assets/img/panden/landhuis4.png', 'Landhuis dicht bij het bos', 0, 4),
(34, 5, './assets/img/panden/landhuis5.png', 'Landhuis met een grote vijver', 0, 5),
(35, 5, './assets/img/panden/landhuis6.png', 'Landhuis met een ruim balkon', 0, 6),
(75, 4, './assets/img/panden/image_1718029314_2221.png', 'Mooi mooi', 0, 5),
(76, 4, './assets/img/panden/image_1718029314_8792.png', 'Knap knap', 0, 6),
(140, 1, './assets/img/panden/image1_small.jpg', NULL, 1, 0),
(141, 2, './assets/img/panden/image2_small.jpg', NULL, 1, 0),
(142, 3, './assets/img/panden/image3_small.jpg', NULL, 1, 0),
(143, 4, './assets/img/panden/image4_small.png', NULL, 1, 0),
(144, 5, './assets/img/panden/image5_small.jpg', NULL, 1, 0),
(145, 1, './assets/img/panden/apartment4_small.png', NULL, 1, 0),
(146, 1, './assets/img/panden/apartment5_small.png', NULL, 1, 0),
(147, 1, './assets/img/panden/apartment6_small.png', NULL, 1, 0),
(148, 1, './assets/img/panden/apartment2_small.png', NULL, 1, 0),
(149, 1, './assets/img/panden/apartment3_small.png', NULL, 1, 0),
(150, 2, './assets/img/panden/villa2_small.png', NULL, 1, 0),
(151, 2, './assets/img/panden/villa3_small.png', NULL, 1, 0),
(152, 2, './assets/img/panden/villa4_small.png', NULL, 1, 0),
(153, 2, './assets/img/panden/villa5_small.png', NULL, 1, 0),
(154, 2, './assets/img/panden/villa6_small.png', NULL, 1, 0),
(155, 3, './assets/img/panden/bungalow2_small.png', NULL, 1, 0),
(156, 3, './assets/img/panden/bungalow3_small.png', NULL, 1, 0),
(157, 3, './assets/img/panden/bungalow4_small.png', NULL, 1, 0),
(158, 3, './assets/img/panden/bungalow5_small.png', NULL, 1, 0),
(159, 3, './assets/img/panden/bungalow6_small.png', NULL, 1, 0),
(160, 4, './assets/img/panden/loft2_small.jpg', NULL, 1, 0),
(161, 4, './assets/img/panden/loft3_small.png', NULL, 1, 0),
(162, 4, './assets/img/panden/loft4_small.png', NULL, 1, 0),
(163, 5, './assets/img/panden/landhuis2_small.png', NULL, 1, 0),
(164, 5, './assets/img/panden/landhuis3_small.png', NULL, 1, 0),
(165, 5, './assets/img/panden/landhuis4_small.png', NULL, 1, 0),
(166, 5, './assets/img/panden/landhuis5_small.png', NULL, 1, 0),
(167, 5, './assets/img/panden/landhuis6_small.png', NULL, 1, 0),
(168, 4, './assets/img/panden/image_1718029314_2221_small.png', NULL, 1, 0),
(169, 4, './assets/img/panden/image_1718029314_8792_small.png', NULL, 1, 0),
(170, 1, './assets/img/panden/image1_small.jpg', NULL, 1, 0),
(171, 2, './assets/img/panden/image2_small.jpg', NULL, 1, 0),
(172, 3, './assets/img/panden/image3_small.jpg', NULL, 1, 0),
(173, 4, './assets/img/panden/image4_small.png', NULL, 1, 0),
(174, 5, './assets/img/panden/image5_small.jpg', NULL, 1, 0),
(175, 1, './assets/img/panden/apartment4_small.png', NULL, 1, 0),
(176, 1, './assets/img/panden/apartment5_small.png', NULL, 1, 0),
(177, 1, './assets/img/panden/apartment6_small.png', NULL, 1, 0),
(178, 1, './assets/img/panden/apartment2_small.png', NULL, 1, 0),
(179, 1, './assets/img/panden/apartment3_small.png', NULL, 1, 0),
(180, 2, './assets/img/panden/villa2_small.png', NULL, 1, 0),
(181, 2, './assets/img/panden/villa3_small.png', NULL, 1, 0),
(182, 2, './assets/img/panden/villa4_small.png', NULL, 1, 0),
(183, 2, './assets/img/panden/villa5_small.png', NULL, 1, 0),
(184, 2, './assets/img/panden/villa6_small.png', NULL, 1, 0),
(185, 3, './assets/img/panden/bungalow2_small.png', NULL, 1, 0),
(186, 3, './assets/img/panden/bungalow3_small.png', NULL, 1, 0),
(187, 3, './assets/img/panden/bungalow4_small.png', NULL, 1, 0),
(188, 3, './assets/img/panden/bungalow5_small.png', NULL, 1, 0),
(189, 3, './assets/img/panden/bungalow6_small.png', NULL, 1, 0),
(190, 4, './assets/img/panden/loft2_small.jpg', NULL, 1, 0),
(191, 4, './assets/img/panden/loft3_small.png', NULL, 1, 0),
(192, 4, './assets/img/panden/loft4_small.png', NULL, 1, 0),
(193, 5, './assets/img/panden/landhuis2_small.png', NULL, 1, 0),
(194, 5, './assets/img/panden/landhuis3_small.png', NULL, 1, 0),
(195, 5, './assets/img/panden/landhuis4_small.png', NULL, 1, 0),
(196, 5, './assets/img/panden/landhuis5_small.png', NULL, 1, 0),
(197, 5, './assets/img/panden/landhuis6_small.png', NULL, 1, 0),
(198, 4, './assets/img/panden/image_1718029314_2221_small.png', NULL, 1, 0),
(199, 4, './assets/img/panden/image_1718029314_8792_small.png', NULL, 1, 0);

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
(86, 67, 'test', 0.00, 'test: kamer details');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `panden`
--

CREATE TABLE `panden` (
  `pandID` int(11) NOT NULL,
  `titel` varchar(255) DEFAULT NULL,
  `tekst` text DEFAULT NULL,
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
  `bezoekOp` varchar(255) DEFAULT NULL,
  `vrijOp` varchar(255) DEFAULT NULL,
  `wettelijkeInfoID` int(11) DEFAULT NULL,
  `homepage` tinyint(1) DEFAULT NULL,
  `isNieuw` tinyint(1) DEFAULT NULL,
  `isVerkochtVerhuurd` tinyint(1) DEFAULT NULL,
  `isOpbrengsteigendom` tinyint(1) DEFAULT NULL,
  `isExclusiefVastgoed` tinyint(1) DEFAULT NULL,
  `isBeleggingsvastgoed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `panden`
--

INSERT INTO `panden` (`pandID`, `titel`, `tekst`, `status`, `adresID`, `type`, `subtype`, `aanvullingSubtype`, `bouwjaar`, `brutoVloeroppervlakte`, `grondoppervlakte`, `aantalSlaapkamers`, `prijs`, `kadastraalInkomen`, `bezoekOp`, `vrijOp`, `wettelijkeInfoID`, `homepage`, `isNieuw`, `isVerkochtVerhuurd`, `isOpbrengsteigendom`, `isExclusiefVastgoed`, `isBeleggingsvastgoed`) VALUES
(1, 'Charmant appartement', 'Een gezellig appartement in het hart van de stad.', 'Te koop', 1, 'Appartement', 'Standaard', 'Geen', '1990', 75.00, 0.00, 2, 250000.00, 500.00, '21%', '2024-06-01', 1, 1, NULL, 1, NULL, NULL, NULL),
(2, 'Moderne villa', 'Ruime en moderne villa met een grote tuin.', 'Te koop', 2, 'Villa', 'Luxe', 'Extra informatie', '2005', 200.00, 1500.00, 4, 750000.00, 2000.00, '21%', '2024-07-01', 2, 1, NULL, 1, NULL, NULL, NULL),
(3, 'Gezellige bungalow', 'Een comfortabele bungalow in een rustige buurt.', 'Te huur', 3, 'Bungalow', 'Standaard', 'Geen', '1985', 90.00, 500.00, 3, 1200.00, 300.00, '21%', '2024-08-01', 3, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Stadsloft', 'Moderne loft in een levendige buurt.', 'Te huur', 4, 'Loft', 'Standaard', 'Geen', '2015', 100.00, 0.00, 1, 1500.00, 400.00, '21%', '2024-09-01', 4, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Landhuis', 'Prachtig landhuis omringd door natuur.', 'Te koop', 5, 'Huis', 'Landhuis', 'Extra informatie', '1970', 250.00, 3000.00, 5, 850000.00, 2500.00, '21%', '2024-10-01', 5, 1, NULL, NULL, NULL, NULL, NULL),
(67, 'test', 'test', 'Te koop', 70, 'type', '', '', '1992', 87.00, 102.00, 3, 300000.00, 15000.00, 'bezoek op', 'Onmiddellijk', 65, NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wettelijkeinformatie`
--

CREATE TABLE `wettelijkeinformatie` (
  `wettelijkeInfoID` int(11) NOT NULL,
  `epcIndex` decimal(10,2) DEFAULT NULL,
  `energieLabel` char(1) DEFAULT NULL,
  `stedenbouwkundigeVergunning` varchar(255) DEFAULT NULL,
  `stedenbouwkundigeVergunningInfo` varchar(255) NOT NULL,
  `verkavelingsvergunning` tinyint(1) DEFAULT NULL,
  `verkavelingsvergunningInfo` varchar(255) NOT NULL,
  `voorkooprecht` tinyint(1) DEFAULT NULL,
  `voorkooprechtInfo` varchar(255) NOT NULL,
  `stedenbouwkundigeBestemming` varchar(255) DEFAULT NULL,
  `dagvaardingEnHerstelvordering` tinyint(1) DEFAULT NULL,
  `effectiefOverstromingsgevoelig` tinyint(1) DEFAULT NULL,
  `mogelijkOverstromingsgevoelig` tinyint(1) DEFAULT NULL,
  `afgebakendOverstromingsgebied` tinyint(1) DEFAULT NULL,
  `afgebakendeOeverzone` tinyint(1) DEFAULT NULL,
  `risicozoneVoorOverstromingen` tinyint(1) DEFAULT NULL,
  `overstromingskansPerceel` decimal(10,2) DEFAULT NULL,
  `overstromingskansGebouw` decimal(10,2) DEFAULT NULL,
  `erfgoed` tinyint(1) DEFAULT NULL,
  `erfgoedInfo` varchar(255) NOT NULL,
  `renovatieverplichting` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `wettelijkeinformatie`
--

INSERT INTO `wettelijkeinformatie` (`wettelijkeInfoID`, `epcIndex`, `energieLabel`, `stedenbouwkundigeVergunning`, `stedenbouwkundigeVergunningInfo`, `verkavelingsvergunning`, `verkavelingsvergunningInfo`, `voorkooprecht`, `voorkooprechtInfo`, `stedenbouwkundigeBestemming`, `dagvaardingEnHerstelvordering`, `effectiefOverstromingsgevoelig`, `mogelijkOverstromingsgevoelig`, `afgebakendOverstromingsgebied`, `afgebakendeOeverzone`, `risicozoneVoorOverstromingen`, `overstromingskansPerceel`, `overstromingskansGebouw`, `erfgoed`, `erfgoedInfo`, `renovatieverplichting`) VALUES
(1, 150.00, 'B', 'Vergund', '', 0, '', 0, '', 'Woongebied', 0, 1, 0, 0, 0, 1, 0.00, 0.00, 0, '', NULL),
(2, 200.00, 'A', 'Vergund', '', 1, '', 0, '', 'Handelsgebied', 0, 0, 1, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(3, 175.00, 'C', '0', '', 0, '', 1, '', 'Industriegebied', 1, 1, 1, 0, 0, 1, 0.50, 0.40, 0, '', 0),
(4, 100.00, 'A', '1', '', 0, '', 0, '', 'Gemengd gebied', 0, 0, 0, 1, 1, 0, 0.10, 0.20, 1, '', 0),
(5, 220.00, 'D', '0', '', 1, '', 1, '', 'Landbouwgebied', 1, 1, 0, 1, 1, 0, 0.30, 0.30, 0, '', 0),
(7, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(8, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(9, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(10, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(11, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(12, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(13, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(14, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(15, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(16, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(17, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, 1, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(18, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', 1, 1, 1, 1, 1, 1, 45.00, 28.00, NULL, '', 0),
(19, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, 1, '', 0),
(20, 120.00, 'A', '1', '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(22, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(23, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(24, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(25, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(26, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(27, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(28, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(29, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(30, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(31, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(32, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(33, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(34, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(35, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(36, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(37, 120.00, 'A', '0', '', 0, '', 0, '', 'test', 0, 0, 0, 1, 1, 0, 45.00, 28.00, 0, '', 0),
(38, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(39, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(40, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(41, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(42, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(43, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(44, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 45.00, 28.00, NULL, '', 0),
(45, 120.00, 'A', '0', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 45.00, 28.00, 0, '', 0),
(47, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', 0),
(48, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', NULL),
(49, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', 1),
(50, 120.00, 'A', NULL, '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', NULL),
(51, 120.00, 'A', 'Vergund', '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', NULL),
(52, 120.00, 'A', 'Niet vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(54, 120.00, 'A', 'Vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(55, 120.00, 'A', 'Vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(56, 120.00, 'A', 'Vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(57, 120.00, 'A', 'Vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(58, 120.00, 'A', 'Vergund', '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', NULL),
(59, 120.00, 'A', 'Vergund', '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', NULL),
(60, 120.00, 'A', 'Vergund', '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', NULL),
(61, 120.00, 'A', 'Vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(62, 120.00, 'A', 'Vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(63, 120.00, 'A', 'Vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(64, 120.00, 'A', 'Vergund', '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', NULL),
(65, 120.00, 'A', 'Vergund', '', 0, '', 0, '', 'test', 0, 0, 0, 0, 0, 0, 0.00, 0.00, 0, '', NULL),
(66, 120.00, 'A', 'Vergund', '', NULL, '', NULL, '', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '', NULL);

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
-- Indexen voor tabel `panden`
--
ALTER TABLE `panden`
  ADD PRIMARY KEY (`pandID`),
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
  MODIFY `adresID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT voor een tabel `afbeeldingen`
--
ALTER TABLE `afbeeldingen`
  MODIFY `afbeeldingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT voor een tabel `kamers`
--
ALTER TABLE `kamers`
  MODIFY `kamerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT voor een tabel `panden`
--
ALTER TABLE `panden`
  MODIFY `pandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT voor een tabel `wettelijkeinformatie`
--
ALTER TABLE `wettelijkeinformatie`
  MODIFY `wettelijkeInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
  ADD CONSTRAINT `panden_ibfk_2` FOREIGN KEY (`adresID`) REFERENCES `adressen` (`adresID`),
  ADD CONSTRAINT `panden_ibfk_3` FOREIGN KEY (`wettelijkeInfoID`) REFERENCES `wettelijkeinformatie` (`wettelijkeInfoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
