-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Okt 27. 22:29
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `adatb_helyfoglalas`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allomas`
--

CREATE TABLE `allomas` (
  `allomasazonosito` varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL,
  `nev` varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL,
  `varos` varchar(32) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `felhasznalonev` tinytext CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `email` tinytext CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `jelszo` tinytext CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `vezeteknev` tinytext CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `keresztnev` tinytext CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `szerep` tinytext CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT 'Nincs szerepe'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_hungarian_ci COMMENT='Minden felhasználónak egyedi neve van, ez regisztációkor ell';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_jegyei`
--

CREATE TABLE `felhasznalo_jegyei` (
  `jegyazonosito` int(16) NOT NULL,
  `jaratazonosito` char(16) NOT NULL,
  `felhasznalonev` tinytext CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jaratazonosito`
--

CREATE TABLE `jaratazonosito` (
  `jaratazonosito` char(16) NOT NULL,
  `tipus` varchar(64) NOT NULL,
  `induloallomas` varchar(128) NOT NULL,
  `celallomas` varchar(128) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp(),
  `idopont` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jegy`
--

CREATE TABLE `jegy` (
  `jegyazonosito` int(16) NOT NULL,
  `ar` int(16) NOT NULL DEFAULT 0,
  `elerhetodarab` int(16) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allomas`
--
ALTER TABLE `allomas`
  ADD PRIMARY KEY (`allomasazonosito`);

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`felhasznalonev`(64));

--
-- A tábla indexei `felhasznalo_jegyei`
--
ALTER TABLE `felhasznalo_jegyei`
  ADD PRIMARY KEY (`jegyazonosito`);

--
-- A tábla indexei `jaratazonosito`
--
ALTER TABLE `jaratazonosito`
  ADD PRIMARY KEY (`jaratazonosito`);

--
-- A tábla indexei `jegy`
--
ALTER TABLE `jegy`
  ADD PRIMARY KEY (`jegyazonosito`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalo_jegyei`
--
ALTER TABLE `felhasznalo_jegyei`
  MODIFY `jegyazonosito` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jegy`
--
ALTER TABLE `jegy`
  MODIFY `jegyazonosito` int(16) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
