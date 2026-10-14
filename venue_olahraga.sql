-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2026 at 01:51 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venue_olahraga`
--
CREATE DATABASE IF NOT EXISTS `venue_olahraga` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `venue_olahraga`;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `level_member` enum('Basic','Gold','VIP') NOT NULL DEFAULT 'Basic',
  `tanggal_bergabung` date NOT NULL DEFAULT (curdate()),
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `password`, `no_telepon`, `alamat`, `level_member`, `tanggal_bergabung`, `created_at`, `updated_at`) VALUES
(3, 'Budi Santoso', 'budi@example.com', '$2y$10$placeholderhash', '081311122233', 'Sukabumi', 'Gold', '2026-10-07', '2026-10-07 15:53:25', '2026-10-08 01:22:43'),
(4, 'MUHAMMAD ZIKRIL SYAWAL', 'zikrilsyawal10@gmail.com', '$2y$10$wr4wmZt19yAjCkhAQ2GbJu1NVn/bYPzyJhFSCav7bXU9inOJTTqd.', '081264027335', 'permata buah batu', 'VIP', '2026-10-08', '2026-10-07 23:53:18', '2026-10-08 01:13:53'),
(6, 'lutfiharki', 'lutfiharki@gmail.com', '$2y$10$TerLv19yOCFAOdgMbNEjEezvLPbsxA35jklb14BlGFzh1OfTsJO0O', '081264027334', 'permata buah batu', 'Basic', '2026-10-08', '2026-10-08 00:58:29', '2026-10-08 01:10:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
