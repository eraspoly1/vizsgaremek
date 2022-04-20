-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Ápr 20. 21:14
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vizsgaremek`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allatok`
--

CREATE TABLE `allatok` (
  `id` int(11) NOT NULL,
  `fajta` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `allatok`
--

INSERT INTO `allatok` (`id`, `fajta`) VALUES
(1, 'Nyúl'),
(2, 'Kutya'),
(3, 'Macska'),
(4, 'Hal'),
(7, 'Fajta'),
(8, 'Kecske');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `arak`
--

CREATE TABLE `arak` (
  `id` int(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `allat_id` int(11) NOT NULL,
  `rendelo_id` int(11) NOT NULL,
  `szolgaltatas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `arak`
--

INSERT INTO `arak` (`id`, `ar`, `allat_id`, `rendelo_id`, `szolgaltatas_id`) VALUES
(1, 9200, 1, 2, 3),
(2, 12000, 4, 1, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(128) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo` varchar(128) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tipus` varchar(3) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `felhasznalonev`, `email`, `jelszo`, `tipus`) VALUES
(1, 'janedoe', 'janedoe@example.com', '$2y$10$wDzfEi1u8XbCVNUWGvww0uvdQvRUBiOdr0iAiEEsM6OOgWXz9ahli', '1'),
(3, 'gjakab', 'exopet@exopet.hu', '$2y$10$aO1trjig4Go2cdYEIzeX6.xBgNgSMbpimOXf9wl9t3Bo8yVzx9pJa', '3');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `nyitvatartasok`
--

CREATE TABLE `nyitvatartasok` (
  `id` int(11) NOT NULL,
  `nap` tinyint(4) NOT NULL,
  `nyitas` time NOT NULL,
  `zaras` time NOT NULL,
  `rendelo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `nyitvatartasok`
--

INSERT INTO `nyitvatartasok` (`id`, `nap`, `nyitas`, `zaras`, `rendelo_id`) VALUES
(1, 1, '08:00:00', '19:00:00', 2),
(2, 2, '08:00:00', '19:00:00', 2),
(3, 1, '10:00:00', '16:00:00', 1),
(4, 4, '10:00:00', '18:00:00', 1),
(5, 5, '11:00:00', '15:00:00', 2),
(6, 2, '15:24:00', '21:24:00', 1),
(8, 3, '08:00:00', '12:00:00', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orvosok`
--

CREATE TABLE `orvosok` (
  `id` int(11) NOT NULL,
  `elotag` varchar(3) COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'dr.',
  `vnev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `knev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `rendelo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `orvosok`
--

INSERT INTO `orvosok` (`id`, `elotag`, `vnev`, `knev`, `email`, `rendelo_id`) VALUES
(1, 'dr.', 'Brunen', 'Anna Róza', 'brunen@exopet.hu ', 2),
(2, 'dr.', 'Barna', 'Réka Fanni', 'barna@gmail.com', 2),
(3, 'dr', 'Fekete', 'Krisztina', 'exopet@exopet.hu1', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelok`
--

CREATE TABLE `rendelok` (
  `id` int(11) NOT NULL,
  `nev` varchar(120) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `irsz` smallint(6) NOT NULL,
  `telepules` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `utca` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `telefon` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `rendelok`
--

INSERT INTO `rendelok` (`id`, `nev`, `irsz`, `telepules`, `utca`, `telefon`, `email`) VALUES
(1, 'Rákosligeti Állatorvosi Rendelőintézet', 1172, 'Budapest', 'XX u. 2. (Ferihegyi út – XX.utca sarok)', '+3612578719', 'info@kisallatkorhaz.hu'),
(2, 'Exo-Pet Állatgyógyászati Centrum', 1074, 'Budapest', 'Hernád utca 46.', '+3615858666', 'exopet@exopet.hu'),
(10, 'Pestimrei Kisállat Központ', 1188, 'Budapest', 'Kisfaludy u. 62/a', '+3612945617', 'kisallatkozpont@gmail.com'),
(12, 'Focus Vet Clinic', 1125, 'Budapest', 'Tündér u. 4/b', '+36204144144', 'info@focus-vet.hu'),
(14, 'Kis Vakond Állatorvosi rendelő', 1111, 'Budapest', 'Balzac utca 43.', '+36201234567', 'kisvakond@kisvakond.hu'),
(15, 'Lőrinci Állatorvosi Rendelő', 1181, 'Budapest', 'Wlassics Gyula u. 58', '+36-305345914', 'info@kisallatdoki.hu'),
(16, 'Felsőzöldmáli Állatorvosi Rendelő', 1025, 'Budapest', 'Felsőzöldmáli út 114.', '+3613355611', 'info@allatorvosi-rendelo.hu'),
(17, 'Vöröskő Állatorvosi Rendelő', 1126, 'Budapest', 'Vöröskő utca 8', '+361234567', 'vorosko@vorosko.hu'),
(18, 'Vet-Art Állatorvosi Rendelők', 1082, 'Budapest', 'Horváth Mihály tér 11.', '+3613330948', 'info@vertart.hu'),
(19, 'MURMUCZOK ÁLLATGYÓGYÁSZATI CENTRUM', 1184, 'Budapest', 'Lenkei u. 3.', '+36 30/ 538-4736', 'info@murmuczok.hu');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szolgaltatasok`
--

CREATE TABLE `szolgaltatasok` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `leiras` text COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `szolgaltatasok`
--

INSERT INTO `szolgaltatasok` (`id`, `nev`, `leiras`) VALUES
(1, 'EKG-vizsgálatok', 'A különböző szívbetegségek pontos megállapításához, a megfelelő gyógyszeres kezelés meghatározásához elengedhetetlen a keringési szervek részletes vizsgálata, melyek alapja a részletes kórelőzmény és fizikális vizsgálat, az EKG és a szívultrahang.'),
(3, 'Nyulak kombinált oltása (Pestorin Mormyx)', 'Myxomatosis, RHD-1'),
(4, 'Ultrahang vizsgálat', 'Segítségével a belső szervek alakja, nagysága, szerkezete láthatóvá válik, így a kóros eltérések nagy biztonsággal megállapíthatóak.'),
(5, 'Teljes körű labor', 'Teljes körű laboratóriumi vérvizsgálat, minőségi, mennyiségi vérkép, biokémiai vizsgálatok, babesiosis megállapítása.'),
(7, 'Ivartalanítás Nyúl', 'Bak');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `velemenyek`
--

CREATE TABLE `velemenyek` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `velemeny` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `rendelo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `velemenyek`
--

INSERT INTO `velemenyek` (`id`, `felhasznalo_id`, `velemeny`, `rendelo_id`) VALUES
(2, 1, 'Remek rendelő.', 1),
(7, 1, 'Szuper volt minden.', 2),
(9, 1, 'Klasszocska', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allatok`
--
ALTER TABLE `allatok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `arak`
--
ALTER TABLE `arak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allat_id` (`allat_id`),
  ADD KEY `rendelo_id` (`rendelo_id`),
  ADD KEY `szolgaltatas_id` (`szolgaltatas_id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `nyitvatartasok`
--
ALTER TABLE `nyitvatartasok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendelo_id` (`rendelo_id`);

--
-- A tábla indexei `orvosok`
--
ALTER TABLE `orvosok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendelo_id` (`rendelo_id`);

--
-- A tábla indexei `rendelok`
--
ALTER TABLE `rendelok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `szolgaltatasok`
--
ALTER TABLE `szolgaltatasok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendelo_id` (`rendelo_id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `allatok`
--
ALTER TABLE `allatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `arak`
--
ALTER TABLE `arak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `nyitvatartasok`
--
ALTER TABLE `nyitvatartasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `orvosok`
--
ALTER TABLE `orvosok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `rendelok`
--
ALTER TABLE `rendelok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `szolgaltatasok`
--
ALTER TABLE `szolgaltatasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `arak`
--
ALTER TABLE `arak`
  ADD CONSTRAINT `arak_ibfk_1` FOREIGN KEY (`allat_id`) REFERENCES `allatok` (`id`),
  ADD CONSTRAINT `arak_ibfk_2` FOREIGN KEY (`rendelo_id`) REFERENCES `rendelok` (`id`),
  ADD CONSTRAINT `arak_ibfk_3` FOREIGN KEY (`szolgaltatas_id`) REFERENCES `szolgaltatasok` (`id`);

--
-- Megkötések a táblához `nyitvatartasok`
--
ALTER TABLE `nyitvatartasok`
  ADD CONSTRAINT `nyitvatartasok_ibfk_1` FOREIGN KEY (`rendelo_id`) REFERENCES `rendelok` (`id`);

--
-- Megkötések a táblához `orvosok`
--
ALTER TABLE `orvosok`
  ADD CONSTRAINT `orvosok_ibfk_1` FOREIGN KEY (`rendelo_id`) REFERENCES `rendelok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
