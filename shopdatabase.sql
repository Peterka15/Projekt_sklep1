-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Wrz 2020, 23:06
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shopdatabase`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `user_id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `idProduktu` int(11) NOT NULL,
  `nazwa` varchar(45) DEFAULT NULL,
  `cena` float DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL,
  `zarchiwizowany` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`idProduktu`, `nazwa`, `cena`, `ilosc`, `zarchiwizowany`) VALUES
(80, 'Monitor', 21, 16, 0),
(81, 'Monitor', 150, 1, 0),
(82, 'Monitor', 12, 0, 0),
(83, 'zapałki', 120, 2, 1),
(84, 'zapałki', 120, 20, 1),
(85, 'Monitor', 120, 32, 0),
(86, '10', 333, 0, 0),
(87, 'zapałki', 333, 0, 0),
(88, 'Kaczka', 1000, 88, 1),
(89, 'Kamień', 120, 8, 0),
(90, 'kokos', 130, 211, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_zamowienia`
--

CREATE TABLE `produkty_zamowienia` (
  `idZamowienia` int(11) NOT NULL,
  `idProduktu` int(11) NOT NULL,
  `cena` int(11) DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL,
  `nazwa` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty_zamowienia`
--

INSERT INTO `produkty_zamowienia` (`idZamowienia`, `idProduktu`, `cena`, `ilosc`, `nazwa`) VALUES
(70, 87, 333, 10, 'zapałki'),
(71, 86, 333, 3, '10'),
(71, 89, 120, 2, 'Kamień'),
(72, 82, 12, 3, 'Monitor'),
(72, 90, 130, 11, 'kokos'),
(73, 80, 21, 4, 'Monitor'),
(73, 81, 150, 2, 'Monitor');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `user_id` int(11) NOT NULL,
  `imie` varchar(45) NOT NULL,
  `nazwisko` varchar(45) NOT NULL,
  `rola` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `haslo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`user_id`, `imie`, `nazwisko`, `rola`, `login`, `haslo`) VALUES
(1, 'Janusz', 'Tracz', 'Admin', 'admin', 'admin'),
(2, 'Adam', 'Ryba', 'User', 'user', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `idZamowienia` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`idZamowienia`, `data`, `user_id`) VALUES
(60, '2020-09-30 15:14:34', 1),
(61, '2020-09-30 15:24:40', 1),
(62, '2020-09-30 16:02:38', 1),
(63, '2020-09-30 16:03:03', 1),
(64, '2020-09-30 16:03:52', 1),
(65, '2020-09-30 16:08:38', 2),
(66, '2020-09-30 16:09:24', 1),
(67, '2020-09-30 16:11:05', 1),
(68, '2020-09-30 16:38:44', 2),
(69, '2020-09-30 21:31:32', 1),
(70, '2020-09-30 22:34:38', 1),
(71, '2020-09-30 22:49:27', 2),
(72, '2020-09-30 22:56:35', 1),
(73, '2020-09-30 22:59:47', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`user_id`,`produkt_id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`idProduktu`);

--
-- Indeksy dla tabeli `produkty_zamowienia`
--
ALTER TABLE `produkty_zamowienia`
  ADD PRIMARY KEY (`idZamowienia`,`idProduktu`),
  ADD KEY `fk_Produkty_zamowienia_Produkty1_idx` (`idProduktu`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`idZamowienia`),
  ADD KEY `fk_Zamowienia_Pracownicy1_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `idProduktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `idZamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `produkty_zamowienia`
--
ALTER TABLE `produkty_zamowienia`
  ADD CONSTRAINT `fk_Produkty_zamowienia_Produkty1` FOREIGN KEY (`idProduktu`) REFERENCES `produkty` (`idProduktu`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Produkty_zamowienia_Zamowienia1` FOREIGN KEY (`idZamowienia`) REFERENCES `zamowienia` (`idZamowienia`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `fk_Zamowienia_Pracownicy1` FOREIGN KEY (`user_id`) REFERENCES `uzytkownicy` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
