-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 09:06 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easygo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `email`, `password`, `created_at`) VALUES
(1, 'faddal ibrahim', 'faddalibrahim@gmail.com', 'whatever', '2020-01-18 03:55:35'),
(2, 'Mufti Menk', 'mufti.menk@ashesi.edu.gh', '$2y$10$GloGEQlvy.ZZZSGb5Rp6du4FSd2aZEpxVt88EsaGIqkYxiU/71kZW', '2020-01-18 04:13:58'),
(3, 'fullname', 'fullname@email.com', '$2y$10$PgcfLDI8CMiqg8NYgxDqH.IZzwm4vHEsJ2UfDeg/tPEnuRvlzN.I2', '2020-01-18 05:19:17'),
(4, 'adwoa', 'adwoabohr@email.com', '$2y$10$9td1ovBqDuEAOvhQqcVGUusbiQuPYGtgW7EY9FB5j1IEsvemSGyi2', '2020-01-23 06:17:00'),
(5, 'bengal', 'bengal@sylla.com', '$2y$10$.gtULQTdkYPOp/oqeGzMgOFHTmnXjq5PmLNplp4lyBazDqT9E./ry', '2020-01-23 06:18:11'),
(6, 'ofui', 'ofui@ofui.com', '$2y$10$uzW1U5jRG9wnuslpMkxiZONiJSv5NBSZNvihVIlVNY4FZRNPsgPSG', '2020-01-23 06:19:49'),
(7, 'sed ', 'selorm10@gmail.com', '$2y$10$hLX2DvyBM7Pdj9qkDS7Ot.KdgjiWYsG1hsBPZsuLqLanteiaUSop6', '2020-01-23 16:22:01'),
(8, 'faddal', 'faddal@email.com', '$2y$10$XDHtZEzrOE3BPvLZxyk/muIRLrGHvzkoW4DqDlQ5fhgWjJdrfUgBy', '2020-01-26 18:59:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
