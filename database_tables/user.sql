-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 09:07 PM
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verified` tinyint(1) NOT NULL,
  `token` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `created_at`, `verified`, `token`) VALUES
(1, 'testing', 'testing@testing.com', '$2y$10$7A.2mx949VkGo6DhgtIsCeu9VPHiqRb1GqzxxBCr5H5vmv.jwHz3y', '2020-01-23 12:37:25', 0, ''),
(2, 'faddal ibrahim', 'faddalibrahim@gmail.com', '$2y$10$TCHTbYLOoxIbyXFTtUlwMuOlGsXatFEOo0C/JB0CIH1p5cxYqutvW', '2020-01-27 15:06:36', 0, ''),
(3, 'namefull', 'namefull@email.com', '$2y$10$uvm4TvCOeewOVRl4ubpop.GA2JsLoM8ZNpFGFp8uSpsesKVM6bD2G', '2020-01-25 13:29:08', 0, ''),
(4, 'tester', 'tester@tester.com', '$2y$10$h9aDsEQQul/zVAR9ROtR1u6aMpmEkM2ZEluEQ/NMs3ivAo1dLu7lm', '2020-01-26 17:25:21', 0, ''),
(5, 'mohammed', 'mohammedd@gmail.com', '$2y$10$RZ/gz8o6d4Ff/kHhtqhrk.S4IYtQ6Hc8A94W9ci35RWFr2Hg00x2i', '2020-01-26 18:52:27', 0, ''),
(6, 'user', 'user@easygo.com', '$2y$10$pHg3ir6yvfjqkpP7nayDvexHlJRQwAl3fcozkOnZyRK.BgfhDxe1m', '2020-01-27 15:22:15', 0, ''),
(50, 'mufti', 'codewiz2019@gmail.com', '$2y$10$Qayq.2jGJY.1jkou8FUouu8rvClk4Apg1BR2y6UN8DJ70CFcJSygi', '2020-01-28 17:45:54', 1, '2b646ea5e5c7eba8d46486e7e875d5b8db1c835080fc984d34ca698b7f4f781adae3266e5d25464f076e755437b051af7e5c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
