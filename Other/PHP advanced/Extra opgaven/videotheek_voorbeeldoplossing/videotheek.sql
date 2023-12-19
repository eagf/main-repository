-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 jul 2021 om 08:30
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videotheek`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `exemplaren`
--

CREATE TABLE `exemplaren` (
  `exemplaarId` int(11) NOT NULL,
  `aanwezig` tinyint(4) NOT NULL DEFAULT 0,
  `filmId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `exemplaren`
--

INSERT INTO `exemplaren` (`exemplaarId`, `aanwezig`, `filmId`) VALUES
(1, 1, 2),
(2, 0, 1),
(3, 0, 2),
(4, 1, 2),
(6, 1, 1),
(10, 1, 10),
(12, 0, 8),
(13, 1, 7),
(14, 1, 9),
(15, 0, 8),
(19, 1, 13),
(20, 1, 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `films`
--

CREATE TABLE `films` (
  `filmId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `films`
--

INSERT INTO `films` (`filmId`, `title`) VALUES
(1, 'John Wick'),
(2, 'Safe House'),
(7, 'Casino Royal'),
(8, 'Inception'),
(9, 'Interstellar'),
(10, 'Bambi'),
(13, 'Beauty and the Beast');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userId`, `username`, `password`) VALUES
(4, 'videotheek', '$2y$10$.T/VoWWzkJ/cpxS29l1BYusnZI3UlbbtSJHi08G12hI12G9mzl7Pi');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `exemplaren`
--
ALTER TABLE `exemplaren`
  ADD PRIMARY KEY (`exemplaarId`);

--
-- Indexen voor tabel `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`filmId`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `exemplaren`
--
ALTER TABLE `exemplaren`
  MODIFY `exemplaarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `films`
--
ALTER TABLE `films`
  MODIFY `filmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
