-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Kwi 2018, 21:27
-- Wersja serwera: 10.1.26-MariaDB
-- Wersja PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `budget`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expcathegories`
--

CREATE TABLE `expcathegories` (
  `CathegoryID` int(11) NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses`
--

CREATE TABLE `expenses` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CathegoryID` int(11) NOT NULL,
  `PayMetID` int(11) NOT NULL,
  `Value` float NOT NULL,
  `Date` date NOT NULL,
  `Comment` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `inccathegories`
--

CREATE TABLE `inccathegories` (
  `CathegoryID` int(11) NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes`
--

CREATE TABLE `incomes` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CathegoryID` int(11) NOT NULL,
  `Value` float NOT NULL,
  `Date` date NOT NULL,
  `Comment` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `PayMetID` int(11) NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `summary`
--

CREATE TABLE `summary` (
  `ID` int(11) NOT NULL,
  `CathegoryID` int(11) NOT NULL,
  `Summary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `unactivatedusers`
--

CREATE TABLE `unactivatedusers` (
  `Token` text NOT NULL,
  `Login` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Login` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Password` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `IsAdmin` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `expcathegories`
--
ALTER TABLE `expcathegories`
  ADD PRIMARY KEY (`CathegoryID`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inccathegories`
--
ALTER TABLE `inccathegories`
  ADD PRIMARY KEY (`CathegoryID`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`PayMetID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `expcathegories`
--
ALTER TABLE `expcathegories`
  MODIFY `CathegoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT dla tabeli `expenses`
--
ALTER TABLE `expenses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT dla tabeli `inccathegories`
--
ALTER TABLE `inccathegories`
  MODIFY `CathegoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `incomes`
--
ALTER TABLE `incomes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `PayMetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
