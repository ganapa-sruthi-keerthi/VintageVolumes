-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 12:18 PM
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


-- Droping the table first
DROP TABLE tblbooks;

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` text NOT NULL,
  `price` int(11) NOT NULL,
  `isbn` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--Creates the books with 30 book entrires
INSERT INTO 'tblbooks' ('id','title','author','price','isbn') VALUES
(1,'Php programming with mysql','Don Gosselin',1500,'9780538745840'),
(2,'System analysis and design in a changing world','Jhon w.Satzinger',1650,'9781111534158'),
(3,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(4,'Php programming with mysql','Don Gosselin',800,'9780538745840'),
(5,'System analysis and design in a changing world','Jhon w.Satzinger',950,'9781111534158'),
(6,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(7,'Php programming with mysql','Don Gosselin',900,'9780538745840'),
(8,'System analysis and design in a changing world','Jhon w.Satzinger',550,'9781111534158'),
(9,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(10,'Php programming with mysql','Don Gosselin',1200,'9780538745840'),
(11,'System analysis and design in a changing world','Jhon w.Satzinger',250,'9781111534158'),
(12,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(13,'Php programming with mysql','Don Gosselin',1200,'9780538745840'),
(14,'System analysis and design in a changing world','Jhon w.Satzinger',750,'9781111534158'),
(15,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(16,'Php programming with mysql','Don Gosselin',1300,'9780538745840'),
(17,'System analysis and design in a changing world','Jhon w.Satzinger',350,'9781111534158'),
(18,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(19,'Php programming with mysql','Don Gosselin',1400,'9780538745840'),
(20,'System analysis and design in a changing world','Jhon w.Satzinger',1250,'9781111534158'),
(21,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(22,'Php programming with mysql','Don Gosselin',2100,'9780538745840'),
(23,'System analysis and design in a changing world','Jhon w.Satzinger',1450,'9781111534158'),
(24,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(25,'Php programming with mysql','Don Gosselin',1600,'9780538745840'),
(26,'System analysis and design in a changing world','Jhon w.Satzinger',1550,'9781111534158'),
(27,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');
(28,'Php programming with mysql','Don Gosselin',1100,'9780538745840'),
(29,'System analysis and design in a changing world','Jhon w.Satzinger',850,'9781111534158'),
(30,'Pro C# with .NET5 foundational Principals and Practises In Programming','Andre Torelsen',1000,'9781484269381');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
