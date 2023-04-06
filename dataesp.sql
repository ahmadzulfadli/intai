-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2023 at 01:21 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataesp`
--

-- --------------------------------------------------------

--
-- Table structure for table `arah`
--

CREATE TABLE `arah` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `arah`
--

INSERT INTO `arah` (`id`, `nama`) VALUES
(1, 'Aman'),
(2, 'Utara'),
(3, 'Selatan'),
(4, 'Barat'),
(5, 'Timur');

-- --------------------------------------------------------

--
-- Table structure for table `data_intai`
--

CREATE TABLE `data_intai` (
  `id` int NOT NULL,
  `data_dbmax1` int NOT NULL,
  `data_dbmax2` int NOT NULL,
  `data_dbmax3` int NOT NULL,
  `data_dbmax4` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int NOT NULL,
  `arah_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_intai`
--

INSERT INTO `data_intai` (`id`, `data_dbmax1`, `data_dbmax2`, `data_dbmax3`, `data_dbmax4`, `timestamp`, `status_id`, `arah_id`) VALUES
(1, 32, 23, 32, 23, '2023-03-26 07:54:02', 1, 2),
(2, 20, 20, 30, 40, '2023-03-26 08:01:25', 1, 1),
(13, 57, 60, 58, 57, '2023-03-27 07:35:36', 1, 1),
(14, 74, 79, 79, 78, '2023-03-27 07:40:16', 1, 1),
(15, 51, 48, 47, 53, '2023-03-27 07:42:17', 1, 1),
(16, 149, 149, 149, 149, '2023-03-27 07:43:18', 1, 1),
(17, 49, 47, 47, 54, '2023-03-27 07:45:19', 1, 1),
(18, 54, 53, 48, 60, '2023-03-27 07:46:19', 1, 1),
(19, 59, 56, 59, 46, '2023-03-28 05:53:49', 1, 1),
(20, 62, 60, 63, 52, '2023-03-28 05:54:49', 1, 1),
(21, 63, 62, 70, 88, '2023-03-28 05:55:49', 1, 1),
(22, 49, 47, 48, 53, '2023-03-28 06:06:17', 1, 1),
(23, 59, 55, 64, 76, '2023-03-28 06:07:17', 1, 1),
(24, 50, 49, 48, 55, '2023-03-28 06:09:18', 1, 1),
(25, 49, 47, 47, 47, '2023-03-28 06:11:18', 1, 1),
(26, 46, 45, 44, 46, '2023-03-28 06:12:19', 1, 1),
(27, 47, 45, 46, 48, '2023-03-29 04:10:51', 1, 1),
(28, 60, 56, 56, 56, '2023-03-29 04:17:56', 1, 1),
(29, 56, 55, 49, 60, '2023-03-29 04:19:57', 1, 1),
(30, 61, 58, 51, 72, '2023-03-29 04:20:57', 1, 1),
(31, 58, 58, 46, 65, '2023-03-29 04:22:57', 1, 1),
(32, 48, 47, 54, 58, '2023-03-29 05:06:56', 1, 1),
(33, 52, 54, 54, 56, '2023-03-29 05:16:08', 1, 1),
(34, 71, 67, 86, 92, '2023-03-29 05:17:08', 1, 1),
(35, 55, 49, 53, 62, '2023-03-29 05:18:08', 1, 1),
(36, 66, 69, 88, 92, '2023-03-29 05:21:09', 1, 1),
(37, 62, 61, 74, 89, '2023-03-29 05:23:09', 1, 1),
(38, 55, 52, 53, 64, '2023-03-29 05:24:09', 1, 1),
(39, 65, 62, 70, 67, '2023-03-29 05:25:10', 1, 1),
(40, 86, 70, 95, 83, '2023-03-29 05:26:10', 1, 1),
(41, 69, 61, 77, 77, '2023-03-29 05:29:10', 1, 1),
(42, 149, 148, 145, 138, '2023-03-29 05:30:10', 1, 1),
(43, 65, 61, 77, 74, '2023-03-29 05:31:42', 1, 1),
(44, 53, 51, 55, 65, '2023-04-03 04:15:03', 1, 1),
(45, 55, 52, 65, 86, '2023-04-03 04:16:03', 1, 1),
(46, 50, 47, 51, 59, '2023-04-03 04:18:12', 1, 1),
(47, 47, 45, 50, 56, '2023-04-03 04:19:12', 1, 1),
(48, 51, 50, 52, 59, '2023-04-03 04:20:12', 1, 1),
(49, 53, 51, 57, 66, '2023-04-03 04:22:12', 1, 1),
(50, 50, 51, 52, 64, '2023-04-03 04:23:12', 1, 1),
(51, 48, 46, 50, 50, '2023-04-03 04:24:13', 1, 1),
(52, 49, 49, 51, 51, '2023-04-03 04:25:13', 1, 1),
(53, 48, 41, 49, 45, '2023-04-03 04:26:13', 1, 1),
(54, 49, 40, 50, 48, '2023-04-03 04:27:13', 1, 1),
(55, 45, 43, 46, 48, '2023-04-04 05:21:43', 1, 1),
(56, 48, 46, 49, 51, '2023-04-04 05:23:12', 1, 1),
(57, 48, 45, 49, 50, '2023-04-04 05:24:13', 1, 1),
(58, 48, 46, 48, 50, '2023-04-04 05:25:15', 1, 1),
(59, 48, 45, 49, 50, '2023-04-04 05:26:16', 1, 1),
(60, 48, 46, 52, 53, '2023-04-04 05:27:17', 1, 1),
(61, 49, 46, 49, 51, '2023-04-04 05:28:18', 1, 1),
(62, 49, 46, 48, 50, '2023-04-04 05:29:20', 1, 1),
(63, 48, 45, 48, 50, '2023-04-04 05:30:21', 1, 1),
(64, 48, 46, 48, 51, '2023-04-04 05:31:22', 1, 1),
(65, 48, 46, 48, 50, '2023-04-04 05:32:23', 1, 1),
(66, 48, 46, 49, 52, '2023-04-04 05:33:25', 1, 1),
(67, 48, 46, 49, 51, '2023-04-04 05:34:26', 1, 1),
(68, 48, 46, 49, 52, '2023-04-04 05:35:27', 1, 1),
(69, 48, 46, 49, 52, '2023-04-04 05:36:28', 1, 1),
(70, 49, 46, 49, 52, '2023-04-04 05:37:30', 1, 1),
(71, 47, 45, 48, 52, '2023-04-04 05:38:31', 1, 1),
(72, 48, 46, 48, 51, '2023-04-04 05:39:32', 1, 1),
(73, 49, 46, 51, 56, '2023-04-04 05:40:34', 1, 1),
(74, 47, 45, 48, 51, '2023-04-04 05:41:37', 1, 1),
(75, 48, 46, 49, 51, '2023-04-04 05:42:36', 1, 1),
(76, 47, 44, 48, 50, '2023-04-04 05:43:37', 1, 1),
(77, 47, 45, 48, 50, '2023-04-04 05:44:39', 1, 1),
(78, 47, 45, 48, 52, '2023-04-04 05:45:40', 1, 1),
(79, 49, 46, 50, 56, '2023-04-04 05:46:41', 1, 1),
(80, 47, 45, 48, 50, '2023-04-04 05:48:44', 1, 1),
(81, 47, 44, 47, 49, '2023-04-04 05:49:46', 1, 1),
(82, 47, 45, 48, 48, '2023-04-04 05:50:46', 1, 1),
(83, 47, 45, 47, 49, '2023-04-04 05:51:47', 1, 1),
(84, 47, 45, 48, 49, '2023-04-04 05:52:49', 1, 1),
(85, 47, 45, 47, 49, '2023-04-04 05:53:50', 1, 1),
(86, 47, 45, 48, 49, '2023-04-04 05:54:51', 1, 1),
(87, 48, 45, 49, 50, '2023-04-04 05:55:52', 1, 1),
(88, 46, 44, 47, 48, '2023-04-04 05:57:55', 1, 1),
(89, 46, 44, 47, 48, '2023-04-04 05:58:56', 1, 1),
(90, 47, 45, 47, 50, '2023-04-04 05:59:57', 1, 1),
(91, 47, 46, 49, 53, '2023-04-04 06:00:59', 1, 1),
(92, 48, 45, 49, 52, '2023-04-04 06:02:03', 1, 1),
(93, 47, 45, 48, 50, '2023-04-04 06:03:01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `nama`) VALUES
(1, 'Aman'),
(2, 'Bahaya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arah`
--
ALTER TABLE `arah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_intai`
--
ALTER TABLE `data_intai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `arah_id` (`arah_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arah`
--
ALTER TABLE `arah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_intai`
--
ALTER TABLE `data_intai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_intai`
--
ALTER TABLE `data_intai`
  ADD CONSTRAINT `data_intai_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `data_intai_ibfk_2` FOREIGN KEY (`arah_id`) REFERENCES `arah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
