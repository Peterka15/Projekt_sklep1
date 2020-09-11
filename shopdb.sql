-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Wrz 2020, 17:11
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
-- Baza danych: `shopdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `Id_Klienta` int(11) NOT NULL,
  `Login` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`Id_Klienta`, `Login`, `Password`) VALUES
(1, 'user1', 'abc'),
(2, 'user2', 'qwe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `idPracownika` int(11) NOT NULL,
  `Imię` varchar(45) DEFAULT NULL,
  `Nazwisko` varchar(45) DEFAULT NULL,
  `Stanowisko` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `haslo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`idPracownika`, `Imię`, `Nazwisko`, `Stanowisko`, `login`, `haslo`) VALUES
(223, 'Adam', 'Kot', 'Kierownik', 'akot', '333'),
(321, 'Jan', 'Kowalski', 'Sprzedawca', 'jkow', '12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `idProduktu` int(11) NOT NULL,
  `Nazwa` varchar(45) DEFAULT NULL,
  `Cena` int(11) DEFAULT NULL,
  `Ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`idProduktu`, `Nazwa`, `Cena`, `Ilosc`) VALUES
(138, 'Myszka', 100, 10),
(324, 'Klawiatura', 160, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_zamowienia`
--

CREATE TABLE `produkty_zamowienia` (
  `idZamowienia` int(11) NOT NULL,
  `idProduktu` int(11) NOT NULL,
  `cena` int(11) DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty_zamowienia`
--

INSERT INTO `produkty_zamowienia` (`idZamowienia`, `idProduktu`, `cena`, `ilosc`) VALUES
(1, 138, 100, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `idZamowienia` int(11) NOT NULL,
  `data` date NOT NULL,
  `idPracownika` int(11) NOT NULL,
  `Id_Klienta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`idZamowienia`, `data`, `idPracownika`, `Id_Klienta`) VALUES
(1, '0000-00-00', 223, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`Id_Klienta`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`idPracownika`);

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
  ADD KEY `fk_Produkty_zamowienia_Produkty_idx` (`idProduktu`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`idZamowienia`),
  ADD KEY `fk_Zamowienia_Pracownicy_idx` (`idPracownika`),
  ADD KEY `fk_Zamowienia_Klienci_idx` (`Id_Klienta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `Id_Klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `idPracownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `idProduktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `produkty_zamowienia`
--
ALTER TABLE `produkty_zamowienia`
  ADD CONSTRAINT `fk_Produkty_zamowienia_Produkty` FOREIGN KEY (`idProduktu`) REFERENCES `produkty` (`idProduktu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produkty_zamowienia_Zamowienia` FOREIGN KEY (`idZamowienia`) REFERENCES `zamowienia` (`idZamowienia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `fk_Zamowienia_Klienci` FOREIGN KEY (`Id_Klienta`) REFERENCES `klienci` (`Id_Klienta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Zamowienia_Pracownicy1` FOREIGN KEY (`idPracownika`) REFERENCES `pracownicy` (`idPracownika`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
