-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 sep 2020 om 09:33
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `framework`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `uuid` varchar(40) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(200) NOT NULL,
  `hash_date` datetime DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tb_users`
--

INSERT INTO `tb_users` (`uuid`, `username`, `password`, `email`, `role`, `status`, `hash`, `hash_date`, `timestamp`) VALUES
('21a91163-1aed-4e34-aac9-9b821809d01e', 'Jeroen', '$2y$10$I8tnJTsJ9x5q/GqORX3FjOCOxj.JEvryR8AsBC6oK/Zpxx7wHSfNe', 'jpmwilmes@gmail.com', '1,5', 1, '59d5f7ab4d1f8ca995bd8ce38aff8df96a2c5c6adf31d082d3811c6b99ed927e', '2019-12-04 21:35:18', '2019-12-01 12:21:27'),
('db561338-b818-4f02-bb1a-cc612fa04883', 'vista', '$2y$10$T37NLVBLh9bK.n/tGePsn.Uep9tbATiZ0tzZL15zUpKVXBOKFnPNC', 'test@vistacollege.nl', '1', 1, '2da3da59a61ff9235097a166c514f65fcbaf047d4ca7d7d52de659954e664a0b', '2020-07-10 08:56:28', '2020-07-09 06:56:28');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `username` (`username`),
  ADD KEY `password` (`password`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
