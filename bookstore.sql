-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 10:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `ULevel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `fname`, `lname`, `email`, `password`, `ULevel`) VALUES
(1, 'Phil', 'Coulson', 'pCoulson@gmail.com', '$2y$10$ovNLXhOldz/6ldP.4EZ.2Oe9FywUtSbvcldELnjQViAr.CUKyHZRO', 'Admin'),
(2, 'Daisy', 'Jonson', 'dJonson@gmail.com', '$2y$10$L/pVqeJPthi/l5xnssoK.OmB0REygaBWt2ucsXGciv3d4JuVnEJ5S', 'Admin'),
(3, 'Leo', 'Fitz', 'lFitz', '$2y$10$0EOR3CkKOn/z6kKFezzT2etcQug73bKu7uJ1tU1QlhqrGizg7whwC', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblaorder`
--

CREATE TABLE `tblaorder` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(11) NOT NULL,
  `FName` text NOT NULL,
  `LName` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `ULevel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FName`, `LName`, `Email`, `Password`, `ULevel`) VALUES
(1, 'Kyle', 'Doe', 'KyleDoe@gmail.com', '$2y$10$psavEIbDXXDU2A3Np/H0ReIO5Cmw4rn5wV701W96pmRRYjt5b37Sy', 'admin'),
(3, 'Toby', 'Ramsey', 'TRamsey@gmail.com', '$2y$10$gnorjtGdJ/DvtjypM3vD.OR7QmzneulhFKMdGpXl/cfU5drhK694S', 'user'),
(4, 'Katlin', 'Smith', 'kSmith@hotmail.com', '$2y$10$gnorjtGdJ/DvtjypM3vD.OR7QmzneulhFKMdGpXl/cfU5drhK694S', 'user'),
(5, 'Jason', 'Wright', 'JWright@gmail.com', '$2y$10$gnorjtGdJ/DvtjypM3vD.OR7QmzneulhFKMdGpXl/cfU5drhK694S', 'pending'),
(8, 'toby', 'rams', 'rotyb@gmail', '$2y$10$ErfN5YidEkzQMR7LHtfGCuwoZthO8ZE8R.jSQJQg4pcSJNOZOer2i', 'user'),
(9, 'Toby', 'Green', 'tGreen@gmail.com', '$2y$10$Zdr7KijVYAp0e4gN3ezo3.Wmv6aFsmpReXp97eC81sWkUVOgugSTq', 'pending'),
(10, 'Jemma', 'Simmons', 'jSimmons@gmail.com', '$2y$10$B1ocjeb.6P9gSghP7KCpru.kXRJutIYtODOYO.W5nAgj5PTennG4a', 'pending'),
(11, 'Tommy', 'Egan', 'tEgan@gmail.com', '$2y$10$HYdcEUuVvStTBz2g01FqVuqW.gQMSDArczpgY8UBGKI/iY5mk87ne', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblaorder`
--
ALTER TABLE `tblaorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblaorder`
--
ALTER TABLE `tblaorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
