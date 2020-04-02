-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Kwi 2020, 18:52
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `testingdatabase`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konto`
--

CREATE TABLE `konto` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `konto`
--

INSERT INTO `konto` (`id`, `nazwa`) VALUES
(1, 'admin'),
(2, 'wykladowca'),
(3, 'student');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `id` int(11) NOT NULL,
  `wykladowca_id` int(11) NOT NULL,
  `uczelnia_id` int(11) NOT NULL,
  `grupa_id` int(11) NOT NULL,
  `tresc` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `odpA` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `odpB` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `odpC` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `odpD` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczelnie`
--

CREATE TABLE `uczelnie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `adres` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `typ_konta` int(11) NOT NULL,
  `Imie` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `uczelnia_id` int(6) NOT NULL,
  `nr_indeksu` int(6) DEFAULT NULL,
  `grupa_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `typ_konta`, `Imie`, `Nazwisko`, `email`, `uczelnia_id`, `nr_indeksu`, `grupa_id`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Admin', 'Admin', 'admin@gmail.com', 1, NULL, NULL),
(2, 'wykladowca', '098f6bcd4621d373cade4e832627b4f6', 2, 'Jan', 'Kowalski', 'Jan.Kowalski@unilodz.pl', 1, NULL, NULL),
(3, 'student', '098f6bcd4621d373cade4e832627b4f6', 3, 'Adam', 'Nowak', 'Adam.Nowak@unilodz.pl', 1, 123456, 1),
(4, 'wykladowca2', 'test', 2, 'Kamil', 'Krawczyk', 'Kamil.Krawczyk@unilodz.com', 1, NULL, NULL),
(5, 'wykladowca3', 'test', 2, 'Krzysztof', 'Kowalski', 'Krzysztof.Kowalski@unilodz.pl', 2, NULL, NULL),
(6, 'login', 'test', 2, 'Mateusz', 'Wypych', 'mafdsadas.pl', 1, NULL, NULL),
(7, 'Mateusz.Wypych', 'test', 2, 'Mateusz', 'Wypych', 'mafdsadas.pl', 1, NULL, NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `konto`
--
ALTER TABLE `konto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uczelnie`
--
ALTER TABLE `uczelnie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `konto`
--
ALTER TABLE `konto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `pytania`
--
ALTER TABLE `pytania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `uczelnie`
--
ALTER TABLE `uczelnie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
