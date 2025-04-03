-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 10:09 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tygodniowyharmonogrampracy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `harmonogram`
--

CREATE TABLE `harmonogram` (
  `Pracownik_id` int(11) NOT NULL,
  `Firma` varchar(100) NOT NULL,
  `Opis` varchar(200) NOT NULL,
  `Data` date NOT NULL,
  `Godzina` time NOT NULL,
  `ID_Uslugi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harmonogram`
--

INSERT INTO `harmonogram` (`Pracownik_id`, `Firma`, `Opis`, `Data`, `Godzina`, `ID_Uslugi`) VALUES
(3, 'AutoTech Warszawa', 'Montaz GPS w samochodzie osobowym', '2025-04-01', '08:00:00', 98123),
(5, 'MotoFix Plock', 'Demontaz starego systemu GPS', '2025-04-01', '10:00:00', 77862),
(11, 'CarService Janki', 'Serwis systemu GPS', '2025-04-02', '11:00:00', 67549),
(14, 'SpeedAuto Radom', 'Montaz nowego GPS', '2025-04-02', '12:00:00', 93276),
(12, 'AutoPlus Kraków', 'Aktualizacja oprogramowania GPS', '2025-04-03', '10:00:00', 98770),
(6, 'DriveSafe Szczecin', 'Diagnostyka systemu GPS', '2025-04-03', '12:00:00', 31223),
(5, 'MotoFix Plock', 'Naprawa uszkodzonego modulu GPS', '2025-04-04', '09:30:00', 99911),
(10, 'CarService Janki', 'Serwis GPS w samochodzie dostawczym', '2025-04-04', '10:00:00', 77801),
(15, 'SpeedAuto Radom', 'Montaz nowego systemu sledzenia GPS', '2025-04-04', '12:00:00', 45623),
(13, 'AutoTech Warszawa', 'Demontaz starego GPS', '2025-04-05', '08:00:00', 21130),
(9, 'AutoPlus Kraków', 'Serwis i konserwacja GPS', '2025-04-05', '10:00:00', 66234),
(1, 'DriveSafe Szczecin', 'Instalacja modulu GPS w ciezarowce', '2025-04-06', '07:30:00', 91342),
(4, 'MotoFix Plock', 'Montaz nowego systemu GPS', '2025-04-06', '08:00:00', 88142),
(11, 'CarService Janki', 'Serwis i aktualizacja GPS', '2025-04-07', '10:00:00', 54221),
(8, 'SpeedAuto Radom', 'Diagnostyka GPS i testy', '2025-04-07', '12:00:00', 91231),
(2, 'AutoTech Zgorzelec', 'Konserwacja systemu GPS', '2025-04-08', '08:45:00', 88510),
(10, 'AutoPlus Stargard', 'Montaz i kalibracja GPS', '2025-04-09', '10:00:00', 61731),
(8, 'DriveSafe Bialystok', 'Serwis systemu sledzenia GPS', '2025-04-10', '12:00:00', 41619),
(9, 'MotoFix Opole', 'Naprawa GPS po awarii', '2025-04-11', '08:00:00', 14923),
(7, 'CarService Gniezno', 'Testowanie i diagnostyka GPS', '2025-04-12', '10:00:00', 13713),
(1, 'MotoFix Lublin', 'Instalacja modulu GPS w ciezarowce', '2025-04-13', '11:00:00', 11229),
(4, 'SpeedAuto Poznan', 'Montaz GPS w samochodzie osobowym', '2025-04-14', '09:00:00', 63421);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `ID` int(11) NOT NULL,
  `Imię` varchar(50) NOT NULL,
  `Nazwisko` varchar(50) NOT NULL,
  `Data_urodzenia` date NOT NULL,
  `Specjalizacja` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pracownicy`
--

INSERT INTO `pracownicy` (`ID`, `Imię`, `Nazwisko`, `Data_urodzenia`, `Specjalizacja`) VALUES
(1, 'Adam', 'Kowalski', '1985-03-12', 'Montaz GPS'),
(2, 'Oliwia', 'Nowak', '1990-07-24', 'Demontaz GPS'),
(3, 'Piotr', 'Tomaszewski', '1988-05-18', 'Serwis GPS'),
(4, 'Tomasz', 'Kaczmarek', '1995-09-30', 'Montaz GPS'),
(5, 'Anna', 'Lewandowska', '1983-11-22', 'Instalacja oprogramowania'),
(6, 'Lena', 'Piotrowska', '1989-02-15', 'Konserwacja systemów'),
(7, 'Marek', 'Urban', '1992-06-10', 'Serwis GPS'),
(8, 'Patrycja', 'Adamczyk', '1987-08-25', 'Demontaz GPS'),
(9, 'Dagmara', 'Borkowska', '1994-04-13', 'Diagnostyka systemów'),
(10, 'Bartosz', 'Kowalczyk', '1991-12-05', 'Montaz GPS'),
(11, 'Grzegorz', 'Mazur', '1986-10-08', 'Serwis GPS'),
(12, 'Karolina', 'Mazurek', '1982-01-17', 'Montaz GPS'),
(13, 'Dariusz', 'Jankowski', '1996-03-29', 'Demontaz GPS'),
(14, 'Sebastian', 'Wróbel', '1993-07-21', 'Serwis GPS'),
(15, 'Joanna', 'Piotrowska', '1997-05-14', 'Konserwacja systemów');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
