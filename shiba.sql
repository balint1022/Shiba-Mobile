-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 14. 09:22
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `shiba`
--
CREATE DATABASE IF NOT EXISTS `shiba` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shiba`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(11) NOT NULL,
  `felhasznalo_nev` varchar(100) NOT NULL,
  `jelszo` varchar(100) NOT NULL,
  `letrehozva` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `felhasznalo_nev`, `jelszo`, `letrehozva`) VALUES
(6, 'admin', '$2y$10$pPCR9aAMSVF/ttfIk.cm.ekrhmMYVHFqArWsLBIOfQd3N79eredWC', '2024-03-27 17:50:00'),
(7, 'teszt123', '$2y$10$CZ8mTUWEYUXAWpjoUc5Si.eJ0yupLlg9UG42N4I18OPWBWTX4JIjS', '2024-03-27 18:15:04');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hirlevel`
--

CREATE TABLE `hirlevel` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kosar`
--

CREATE TABLE `kosar` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `mennyiseg` int(50) NOT NULL,
  `telefontipus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelesek`
--

CREATE TABLE `rendelesek` (
  `id` int(11) NOT NULL,
  `rendeles_id` int(11) NOT NULL,
  `rendelo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelesi_adatok`
--

CREATE TABLE `rendelesi_adatok` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cim` varchar(100) NOT NULL,
  `varos` varchar(25) NOT NULL,
  `orszag` varchar(50) NOT NULL,
  `iranyitoszam` int(10) NOT NULL,
  `rendeles_datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `telefontipus`
--

CREATE TABLE `telefontipus` (
  `id` int(11) NOT NULL,
  `nev` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `telefontipus`
--

INSERT INTO `telefontipus` (`id`, `nev`) VALUES
(1, 'iPhone 11'),
(2, 'iPhone SE 2'),
(3, 'iPhone 12'),
(4, 'iPhone 13'),
(5, 'iPhone SE 3'),
(6, 'iPhone 14'),
(7, 'iPhone 15'),
(8, 'Samsung Galaxy S20'),
(9, 'Samsung Galaxy S21'),
(10, 'Samsung Galaxy S22 '),
(11, 'Samsung Galaxy S23');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `ar` int(100) NOT NULL,
  `kep` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`id`, `nev`, `ar`, `kep`) VALUES
(1, 'Fekete Pulóveres Shiba Telefontok ', 4800, 'img\\tok\\tok1.jpg'),
(2, 'Piros Shiba Telefontok ', 8000, 'img\\tok\\tok2.jpg'),
(3, 'Piros Kabátos Shiba Telefontok ', 6400, 'img\\tok\\tok3.jpg'),
(4, 'Japán Virág témájú Shiba Telefontok Változat 1', 8000, 'img\\tok\\tok4.jpg'),
(5, 'Japán Virág témájú Shiba Telefontok Változat 2', 8000, 'img\\tok\\tok5.jpg'),
(6, 'Kék Vízparti Shiba Telefontok', 8000, 'img\\tok\\tok6.jpg'),
(7, 'Rózsaszín Japán Virágos Shiba Telefontok Változat 1', 6400, 'img\\tok\\tok7.jpg'),
(8, 'Rózsaszín Japán Virágos Shiba Telefontok Változat 2', 8000, 'img\\tok\\tok8.jpg');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hirlevel`
--
ALTER TABLE `hirlevel`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kosar`
--
ALTER TABLE `kosar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kosar_ibfk_1` (`felhasznalo_id`),
  ADD KEY `kosar_ibfk_2` (`termek_id`),
  ADD KEY `telefontipus_id` (`telefontipus_id`);

--
-- A tábla indexei `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendelesek_ibfk_2` (`rendelo_id`),
  ADD KEY `rendeles_id` (`rendeles_id`);

--
-- A tábla indexei `rendelesi_adatok`
--
ALTER TABLE `rendelesi_adatok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `telefontipus`
--
ALTER TABLE `telefontipus`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `hirlevel`
--
ALTER TABLE `hirlevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kosar`
--
ALTER TABLE `kosar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT a táblához `rendelesi_adatok`
--
ALTER TABLE `rendelesi_adatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT a táblához `telefontipus`
--
ALTER TABLE `telefontipus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `termekek`
--
ALTER TABLE `termekek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kosar`
--
ALTER TABLE `kosar`
  ADD CONSTRAINT `kosar_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kosar_ibfk_2` FOREIGN KEY (`termek_id`) REFERENCES `termekek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kosar_ibfk_3` FOREIGN KEY (`telefontipus_id`) REFERENCES `telefontipus` (`id`);

--
-- Megkötések a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD CONSTRAINT `rendelesek_ibfk_2` FOREIGN KEY (`rendelo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rendelesek_ibfk_3` FOREIGN KEY (`rendeles_id`) REFERENCES `rendelesi_adatok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
