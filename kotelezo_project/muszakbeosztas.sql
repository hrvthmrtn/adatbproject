-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2023. Nov 25. 14:18
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `muszakbeosztas`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `keszit`
--

CREATE TABLE `keszit` (
  `id` int(11) NOT NULL,
  `muszakbeszotas_id` int(11) NOT NULL,
  `felelos_operator` int(11) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `keszit`
--

INSERT INTO `keszit` (`id`, `muszakbeszotas_id`, `felelos_operator`, `datum`) VALUES
(4, 19, 11, '2023-11-21 21:54:15'),
(5, 20, 11, '2023-11-24 15:54:37'),
(6, 21, 11, '2023-11-24 15:55:06'),
(7, 22, 11, '2023-11-24 15:57:23'),
(8, 23, 11, '2023-11-24 16:17:03'),
(9, 24, 11, '2023-11-24 16:17:27'),
(10, 25, 11, '2023-11-24 16:20:40'),
(11, 26, 11, '2023-11-24 16:22:27'),
(12, 27, 11, '2023-11-24 16:29:03'),
(13, 28, 11, '2023-11-24 16:29:53'),
(14, 29, 11, '2023-11-24 16:30:50'),
(15, 30, 11, '2023-11-24 16:31:32'),
(16, 31, 11, '2023-11-24 16:32:54'),
(17, 32, 11, '2023-11-24 16:34:52'),
(18, 33, 11, '2023-11-24 16:35:21'),
(19, 34, 11, '2023-11-24 16:39:03'),
(20, 35, 11, '2023-11-24 16:40:03'),
(21, 36, 11, '2023-11-24 16:43:34'),
(22, 37, 11, '2023-11-24 16:44:16'),
(23, 38, 11, '2023-11-24 16:44:55'),
(24, 39, 11, '2023-11-24 16:46:08'),
(25, 40, 11, '2023-11-24 16:46:45'),
(26, 41, 11, '2023-11-24 16:57:36'),
(27, 42, 11, '2023-11-24 16:58:10'),
(28, 43, 11, '2023-11-24 16:59:37'),
(29, 44, 11, '2023-11-24 17:00:41'),
(30, 45, 11, '2023-11-24 17:01:36'),
(31, 46, 11, '2023-11-24 17:02:04'),
(32, 47, 11, '2023-11-24 17:02:36'),
(33, 48, 11, '2023-11-24 17:03:33'),
(34, 49, 11, '2023-11-24 17:03:48'),
(35, 50, 11, '2023-11-24 17:04:17'),
(36, 51, 11, '2023-11-24 17:04:37'),
(37, 52, 11, '2023-11-24 17:08:23'),
(38, 53, 11, '2023-11-24 17:08:52'),
(39, 54, 11, '2023-11-24 17:09:19'),
(40, 55, 11, '2023-11-24 17:09:48'),
(41, 56, 11, '2023-11-24 17:10:58');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `munkasok`
--

CREATE TABLE `munkasok` (
  `dolgozo_azonosito` int(11) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `elotag` varchar(255) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `munkakori_beosztas` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `munkasok`
--

INSERT INTO `munkasok` (`dolgozo_azonosito`, `jelszo`, `elotag`, `nev`, `munkakori_beosztas`) VALUES
(11, '$2y$10$qwEzJ58xNSI8vcOIUnXYduGD9j3zpOlNu4AXQGi/Y4Vigubs3uI/y', 'admin', 'admin', 1),
(18, '$2y$10$/N8AMkJ3RCtycTHe67f06eyi3JPAQTCqVN5lh2BbALQKziNHK/eO2', 'kovacskati', 'Kovács Katalin', 0),
(19, '$2y$10$4i4Hj2sYSyORU7bfFg1wFeqIyXykMs2pTNUITdYrUD29hc.Sno5ZC', 'vargagabi', 'Varga Gábor', 0),
(20, '$2y$10$5IdtdIBiBWp148Efk5.wu.VxvW9GyD/eMukc5xyrwrk8iIdXHNp4q', 'tothpeter', 'Tóth Péter', 0),
(21, '$2y$10$Xqkjzu85/5q50asaM28aYOEFTYMGRkdNGsmvUXihC0LRDi5COa0w2', 'nagyeszter', 'Nagy Eszter', 0),
(22, '$2y$10$RwrbFpMDLlfi4Qk.ebcGMetmYYmCO0HamcdrjMs0ilSGDxSF5i9Gu', 'horvathbence', 'Horváth Bence', 0),
(23, '$2y$10$lH.YkaLctAMDXIZBUHdcXuBR5KcvUslh58fyu8rmsOYBzhkjH5ar.', 'szaboistvan', 'Szabó István', 0),
(24, '$2y$10$eFt75.WoqI1/w2c5CS8ubuZdJuAAk8OkB2DzlBPJ6bg.DXrVDE6qC', 'kisseva', 'Kiss Éva', 0),
(25, '$2y$10$RSYqZyJmBPyDes7qlpepduCrtHasvyOqlQfn1xs3pVQPQMWP1nLYa', 'molnarzoltan', 'Molnár Zoltán', 0),
(26, '$2y$10$p9tB/GHZA/uNyvdCjY3uCe.um7KuaTUqX06Gb6xv0KnNgPTAxHvcS', 'farkasorsolya', 'Farkas Orsolya', 0),
(27, '$2y$10$G9hiSGe0Eat6RP8FS9u7XefkEEwkgfD2liL7B3kfqs/Iq0CEh0.se', 'pappmate', 'Papp Máté', 0),
(28, '$2y$10$tyusIBFgmkFT0zpKM7uu5.4Sw2fb6UdWjVJlGcXmjuHtBCIB.sMDS', 'takacsanna', 'Takács Anna', 0),
(29, '$2y$10$/0mJcbnt.sZ58aMd8not.u16Tic1V5XxlbDpSgRcdPKulYuqAeVwy', 'baloghjanos', 'Balogh János', 0),
(30, '$2y$10$P7gauliTgLxExz8VHyU19ezHtOtz7pOm1uqMPp79yOZcsaz2oLYdO', 'simonnora', 'Simon Nóra', 0),
(31, '$2y$10$wtPaCjeffAojn93B.xvHKOUgFbb5gQBaZf39ct9D1itXy3ZnCSt26', 'feketegergo', 'Fekete Gergő', 0),
(32, '$2y$10$WPQpdF2Jwhov3f02Gc75B.HImfIcdj5.dL.c.iEhjHNQsPUohnucW', 'lukacsjudit', 'Lukács Judit', 0),
(33, '$2y$10$gtYY.lrXh/FLMaZ3HAf38O23r03ZjMRQ1ZfYT3gO2RKTlvOnZULBu', 'kovacstamas', 'Kovács Tamás', 0),
(34, '$2y$10$9QOqT.hsV7ca3ON8VB.qveljzL0Y1Hay.LnoOj0p48S84kyHbOARi', 'vargazsuzsa', 'Varga Zsuzsa', 0),
(35, '$2y$10$QBQaqqfq4GFnjLXQIM2XgOPZHB98PkJ22zb0.KeUbLFM.ue6oIkFi', 'lakatosistvan', 'Lakatos István', 0),
(36, '$2y$10$XN8UB0HAyMi3qtgiBSJ5t.svMkrZ9FaYUBLZQ5hEwposV8P9.3cv.', 'csehnikolett', 'Cseh Nikolett', 0),
(37, '$2y$10$ah57cmrZZCbGNamaAAvYOOF2P2VAmFpoGdOigH23t/JyyyPL5MpNS', 'pinterdavid', 'Pintér Dávid', 0),
(38, '$2y$10$s84QztQGeuonx9baezvfLeQ6jluTnwXm2LNNMYMO5Wgv1B.Jgi7su', 'birocsilla', 'Bíró Csilla', 0),
(39, '$2y$10$mIRnK2Q/.jw7S7bleJHD7uqVzyMiBWHGO2r84HDSAgNhgz6JXaXqm', 'szentgyorgyiadam', 'Szentgyörgyi Ádám', 0),
(40, '$2y$10$JIAXR7wdkfscc7V5MJjAP.WC4itsmk8cPIlBZWAuBxU.g02uWVQfS', 'angyaldalma', 'Angyal Dalma', 0),
(41, '$2y$10$/tetWC7NSR97qb8DZXThb.AYzA3dRtyUqMJhUoGZTjlrYFxs9RCAi', 'kovacsgabor', 'Kovács Gábor', 0),
(42, '$2y$10$5i299NELCoyC/9cgI1xMFegXe129501qcOSoa3UA5Gph4P7O9VgwC', 'nagyildiko', 'Nagy Ildikó', 0),
(43, '$2y$10$VCAQ1M.4aKHUWlCYxGirSOvSSgKrqDBGGVzQdLmbPNbGCcOreeRIG', 'kovacsandras', 'Kovács András', 0),
(44, '$2y$10$ij3BCMn3soQ8TOm094qcpeNgLayHNpAISfwx15cf7Xj8V82xkw90W', 'szaboerika', 'Szabó Erika', 0),
(45, '$2y$10$rg86.IITKBdX39CVUKxsHORrZR4lzuPRi1U6zSGMooFmwLGf2VJbS', 'tothgergo', 'Tóth Gergő', 0),
(46, '$2y$10$znUYaIlR6D4xLg3OmNyMN.pP0kM8dNPM.tdZQmMwL0nxly/xWc3aK', 'nagypetra', 'Nagy Petra', 0),
(47, '$2y$10$VwioAqT/sooLI0bCfOeWJ.mLxl8uz6bdg7TyciAbHDJWfxuclZCG2', 'kisstamas', 'Kiss Tamás', 0),
(48, '$2y$10$MMw2MOJaV9fRWLsBd7OKsuXeJdV6qzWcGDD8Gx23CPlFqNomMncmi', 'molnardora', 'Molnár Dóra', 0),
(49, '$2y$10$YhEUZX9qutyD8QtsnBAyXOMG2Lga04ptkasprOmO2ky0KLC.wlSCC', 'vargabence', 'Varga Bence', 0),
(50, '$2y$10$QXPoSFEeMg832txZmOga3OJAr9i1BR0nGi4L3MuZLgkHf3VQ56mXC', 'horvathzsuza', 'Horváth Zsuzsa', 0),
(51, '$2y$10$NHpJgcFc1rQmPEcGc8bL/uOMWyXnOTDbokindw196ySYGCf3iKWbe', 'feketejanos', 'Fekete János', 0),
(52, '$2y$10$63D3EyZiFjxe1RpjNhwE1OzIOT6lQemIEBiyMvXibBsHry7pWJysG', 'pappeszter', 'Papp Eszter', 0),
(53, '$2y$10$vI6l8EX1xDpf4Vdi2huaDu5RdN.XHpwrGg0T9Zvjx/0s20DMDeDNO', 'birogabor', 'Bíró Gábor', 0),
(54, '$2y$10$UZQTcVfNgzatZfdBhQrmpeWAwf3nVYNuBRnVY6O.Sn20zeXgZ4QI.', 'lakatosanna', 'LakatosAnna', 0),
(55, '$2y$10$FKdURqiNUcUwR0bhAypx/urvkWw3ECEE8MKysGhIJGtC9tzOrF3W2', 'takacsmate', 'Takács Máté', 0),
(56, '$2y$10$ql8y17EVwqCKfIVy9qxESutLfC3QDfiWpWAa0DHrQyMQcnm9YQvJq', 'gyorgyiistvan', 'Györgyi István', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `muszakbeosztasok`
--

CREATE TABLE `muszakbeosztasok` (
  `id` int(11) NOT NULL,
  `dolgozo_azonosito` int(11) NOT NULL,
  `reszleg_azonosito` int(11) DEFAULT NULL,
  `munkaoraszam` int(11) DEFAULT NULL,
  `datum` date NOT NULL,
  `muszakbeosztas` int(11) NOT NULL,
  `feladatkor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `muszakbeosztasok`
--

INSERT INTO `muszakbeosztasok` (`id`, `dolgozo_azonosito`, `reszleg_azonosito`, `munkaoraszam`, `datum`, `muszakbeosztas`, `feladatkor`) VALUES
(20, 18, 6, 10, '2023-12-01', 1, 'diabetológia'),
(21, 19, 7, 8, '2023-12-01', 1, 'műtős'),
(22, 20, 8, 12, '2023-12-02', 2, 'szülés levezetés'),
(23, 21, NULL, NULL, '2023-12-03', 3, NULL),
(24, 22, NULL, NULL, '2023-12-04', 4, NULL),
(25, 23, 11, 8, '2023-12-04', 2, 'idegrendszeri probléma kezelése'),
(26, 24, 13, 10, '2023-12-05', 1, 'betegek vizsgálata'),
(27, 25, NULL, NULL, '2023-12-05', 3, NULL),
(28, 26, 15, 8, '2023-12-07', 2, 'betegek kezelése'),
(29, 27, 16, 12, '2023-12-07', 2, 'akut betegségek kezelése'),
(30, 28, NULL, NULL, '2023-12-08', 4, NULL),
(31, 29, 18, 8, '2023-12-08', 1, 'beérkezett műtéti minták vizsgálata'),
(32, 30, 19, 10, '2023-12-09', 2, 'speciális talpbetét receptre írása'),
(33, 31, NULL, NULL, '2023-12-10', 3, NULL),
(34, 33, 22, 12, '2023-12-09', 1, 'bőrgyógyászati bajok kezelése'),
(35, 34, 23, 8, '2023-12-11', 2, 'a beteg hormonrendszer vizsgálata'),
(36, 35, 24, 8, '2023-12-09', 2, 'mozgásszervi betegek kezelése'),
(37, 36, NULL, NULL, '2023-12-10', 3, NULL),
(38, 37, 26, 12, '2023-12-11', 1, 'érrendszeri betegek vizsgálata'),
(39, 38, 27, 8, '2023-12-10', 2, 'bőrbetegek kezelése'),
(40, 39, NULL, NULL, '2023-12-11', 4, NULL),
(41, 40, NULL, NULL, '2023-12-12', 4, NULL),
(42, 41, 30, 8, '2023-12-11', 1, 'krónikus betegek kezelése'),
(43, 42, 31, 8, '2023-12-12', 1, 'fogkőleszedés'),
(44, 43, 14, 8, '2023-12-06', 2, 'gyomorbetegek kezelése'),
(45, 44, 6, 12, '2023-12-04', 2, 'belgyógyászati betegek kezelése'),
(46, 45, 22, 8, '2023-12-20', 1, 'bőrbetegek kezelése'),
(47, 46, 15, 12, '2023-12-15', 2, 'pszichiátriai betegek kezelése'),
(48, 26, 17, 12, '2023-12-14', 1, 'kardiológiai betegek kezelése'),
(49, 52, NULL, NULL, '2023-12-14', 3, NULL),
(50, 32, 21, 12, '2023-12-18', 1, 'pulmonológiai feladatok ellátása'),
(51, 43, NULL, NULL, '2023-12-22', 4, NULL),
(52, 45, 22, 12, '2023-12-19', 1, 'bőrbetegek kezelése'),
(53, 55, 23, 8, '2023-12-27', 2, 'endokrinilógiai betegek kezelése'),
(54, 40, 31, 8, '2023-12-22', 1, 'fogkőleszedés'),
(55, 32, 27, 12, '2023-12-23', 1, 'dermatológiai betegek kezelése'),
(56, 24, 23, 12, '2023-12-27', 1, 'endokrinilógiai betegek kezelése');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reszlegek`
--

CREATE TABLE `reszlegek` (
  `reszleg_azonosito` int(11) NOT NULL,
  `reszleg_neve` varchar(255) NOT NULL,
  `reszleg_helye` varchar(255) NOT NULL,
  `reszleg_vezetoje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `reszlegek`
--

INSERT INTO `reszlegek` (`reszleg_azonosito`, `reszleg_neve`, `reszleg_helye`, `reszleg_vezetoje`) VALUES
(6, 'Belgyógyászati Klinika', '6725 Szeged, Kálvári sgt. 57.', 18),
(7, 'Sebészeti Klinika', '6725 Szeged, Semmelweis u. 8', 19),
(8, 'Szülészeti és Nőgyógyászati Klinika', '6725 Szeged, Semmelweis u. 1', 20),
(9, 'Neurológiai Klinika', '6725 Szeged, Semmelweis utca 6.', 21),
(11, 'SZTE Szent-Györgyi Albert Klinikai Központ Fül-orr-gégészeti és Fej-nyaksebészeti Klinika', '6725 Szeged, Tisza Lajos krt. 111.', 23),
(12, 'Szemészeti Klinika', '6720 Szeged, Tisza Lajos krt. 97.', 22),
(13, 'Onkoterápiás Klinika', '6720 Szeged, Korányi fasor 12.', 24),
(14, 'Urológiai Klinika', '6725 Szeged, Kálvária sugárút 57.', 25),
(15, 'Pszichiátriai Klinika', '6720 Szeged, Dugonics tér 13.', 26),
(16, 'Gyermekgyógyászati Klinika', '6720 Szeged, Korányi fasor 14-15', 27),
(17, 'Kardiológia Szakambulancia', '6725 Szeged, Semmelweis u. 8.', 28),
(18, 'Laboratóriumi Medicina Intézet', '6725 Szeged, Semmelweis utca 6.', 29),
(19, 'Ortopédiai Klinika', '6725 Szeged, Semmelweis u. 6.', 30),
(20, 'Gasztroenterologiai Osztály', '6722 Szeged, Boldogasszony sgt 15.', 31),
(21, 'Pulmonológiai Ambulancia', '6727 Szeged, Temesvári krt. 35-36.', 32),
(22, 'Bőrgyógyászati és Allergológiai Klinika', '6720 Szeged, Korányi fasor 6.', 33),
(23, 'Endokrinológia Ambulancia', '6725 Szeged, Kálvária sgt. 57., D épület 1. emelet', 34),
(24, 'Reumatológiai Klinika', '6725 Szeged Kálvária sgt. 57. C. ép.fsz.', 35),
(25, 'Infektológiai Klinika', '6725 Szeged, Állomás u. 1-3.', 36),
(26, 'Hematológia Osztály', '6725 Szeged, Semmelweis u. 8.', 37),
(27, 'Dermatológia', '6720 Szeged, Korányi fasor 6.', 38),
(28, 'Nephrológiai Osztály', '6725 Szeged, Semmelweis u. 8.', 39),
(29, 'Központi Fizioterápiás és Rehabilitációs Részleg', '6725 Szeged, Semmelweis u. 1.', 40),
(30, 'Geriátriai és Krónikus Belgyógyászati Osztály', '6725 Szeged, Kálvária sgt. 57., H épület földszint', 41),
(31, 'Fogászati és Szájsebészeti Klinika', '6720 Szeged, Tisza Lajos körút 64-66.', 42);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `keszit`
--
ALTER TABLE `keszit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `munkabeosztas` (`muszakbeszotas_id`),
  ADD KEY `operator` (`felelos_operator`);

--
-- A tábla indexei `munkasok`
--
ALTER TABLE `munkasok`
  ADD PRIMARY KEY (`dolgozo_azonosito`);

--
-- A tábla indexei `muszakbeosztasok`
--
ALTER TABLE `muszakbeosztasok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dolgozo` (`dolgozo_azonosito`),
  ADD KEY `reszleg_fk` (`reszleg_azonosito`);

--
-- A tábla indexei `reszlegek`
--
ALTER TABLE `reszlegek`
  ADD PRIMARY KEY (`reszleg_azonosito`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `keszit`
--
ALTER TABLE `keszit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT a táblához `munkasok`
--
ALTER TABLE `munkasok`
  MODIFY `dolgozo_azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT a táblához `muszakbeosztasok`
--
ALTER TABLE `muszakbeosztasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT a táblához `reszlegek`
--
ALTER TABLE `reszlegek`
  MODIFY `reszleg_azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `keszit`
--
ALTER TABLE `keszit`
  ADD CONSTRAINT `operator` FOREIGN KEY (`felelos_operator`) REFERENCES `munkasok` (`dolgozo_azonosito`);

--
-- Megkötések a táblához `muszakbeosztasok`
--
ALTER TABLE `muszakbeosztasok`
  ADD CONSTRAINT `dolgozo` FOREIGN KEY (`dolgozo_azonosito`) REFERENCES `munkasok` (`dolgozo_azonosito`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reszleg_fk` FOREIGN KEY (`reszleg_azonosito`) REFERENCES `reszlegek` (`reszleg_azonosito`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
