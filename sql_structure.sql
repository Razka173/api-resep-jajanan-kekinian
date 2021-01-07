-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 01:57 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resepjaj_resepjajanankekinian`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses_level` varchar(20) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bahan_resep`
--

CREATE TABLE `bahan_resep` (
  `id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `takaran` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `resep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bahan_resep_users`
--

CREATE TABLE `bahan_resep_users` (
  `id` int(11) NOT NULL,
  `bahan_id` int(11) DEFAULT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `takaran` varchar(255) NOT NULL,
  `resep_users_id` int(11) NOT NULL,
  `is_approve` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `balasan`
--

CREATE TABLE `balasan` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `isi` text COLLATE utf32_unicode_ci NOT NULL,
  `diskusi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `id` int(11) NOT NULL,
  `isi` text COLLATE utf32_unicode_ci NOT NULL,
  `resep_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `disukai` int(11) NOT NULL DEFAULT '0',
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `nama` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `waktu_memasak` varchar(25) COLLATE utf32_unicode_ci NOT NULL,
  `porsi` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `harga` decimal(19,2) DEFAULT NULL,
  `favorit` int(11) NOT NULL DEFAULT '0',
  `dilihat` int(11) NOT NULL DEFAULT '0',
  `gambar` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resep_users`
--

CREATE TABLE `resep_users` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama_resep` varchar(255) NOT NULL,
  `waktu_memasak` varchar(25) NOT NULL,
  `porsi` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `favorit` int(11) NOT NULL DEFAULT '0',
  `dilihat` int(11) NOT NULL DEFAULT '0',
  `gambar` varchar(255) DEFAULT NULL,
  `is_approve` int(11) DEFAULT NULL,
  `id_approve` int(11) DEFAULT NULL,
  `is_migrated` int(11) DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `step_resep`
--

CREATE TABLE `step_resep` (
  `id` int(11) NOT NULL,
  `nomor_step` int(11) NOT NULL,
  `intruksi` text COLLATE utf32_unicode_ci NOT NULL,
  `resep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `step_resep_users`
--

CREATE TABLE `step_resep_users` (
  `id` int(11) NOT NULL,
  `nomor_step` int(11) NOT NULL,
  `intruksi` text NOT NULL,
  `resep_users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahan_resep`
--
ALTER TABLE `bahan_resep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_resep_bahan` (`resep_id`),
  ADD KEY `FK_bahanresep_bahan` (`bahan_id`);

--
-- Indexes for table `bahan_resep_users`
--
ALTER TABLE `bahan_resep_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_bahan` (`bahan_id`),
  ADD KEY `FK_id_resep_users` (`resep_users_id`);

--
-- Indexes for table `balasan`
--
ALTER TABLE `balasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_diskusi_balasan` (`diskusi_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_bookmark` (`user_id`),
  ADD KEY `FK_resep_bookmark` (`resep_id`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_resep_diskusi` (`resep_id`),
  ADD KEY `FK_user_diskusi` (`user_id`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resep_users`
--
ALTER TABLE `resep_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_users` (`id_users`) USING BTREE;

--
-- Indexes for table `step_resep`
--
ALTER TABLE `step_resep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_resep_step` (`resep_id`);

--
-- Indexes for table `step_resep_users`
--
ALTER TABLE `step_resep_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_resep_users` (`resep_users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bahan_resep`
--
ALTER TABLE `bahan_resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bahan_resep_users`
--
ALTER TABLE `bahan_resep_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balasan`
--
ALTER TABLE `balasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resep_users`
--
ALTER TABLE `resep_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `step_resep`
--
ALTER TABLE `step_resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `step_resep_users`
--
ALTER TABLE `step_resep_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_resep`
--
ALTER TABLE `bahan_resep`
  ADD CONSTRAINT `FK_bahanresep_bahan` FOREIGN KEY (`bahan_id`) REFERENCES `bahan` (`id`),
  ADD CONSTRAINT `FK_resep_bahan` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`id`);

--
-- Constraints for table `bahan_resep_users`
--
ALTER TABLE `bahan_resep_users`
  ADD CONSTRAINT `FK_id_resep` FOREIGN KEY (`resep_users_id`) REFERENCES `resep_users` (`id`);

--
-- Constraints for table `balasan`
--
ALTER TABLE `balasan`
  ADD CONSTRAINT `FK_diskusi_balasan` FOREIGN KEY (`diskusi_id`) REFERENCES `diskusi` (`id`);

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `FK_resep_bookmark` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`id`),
  ADD CONSTRAINT `FK_user_bookmark` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `FK_resep_diskusi` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`id`),
  ADD CONSTRAINT `FK_user_diskusi` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `resep_users`
--
ALTER TABLE `resep_users`
  ADD CONSTRAINT `FK_id_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `step_resep`
--
ALTER TABLE `step_resep`
  ADD CONSTRAINT `FK_resep_step` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`id`);

--
-- Constraints for table `step_resep_users`
--
ALTER TABLE `step_resep_users`
  ADD CONSTRAINT `FK_id_resep_users` FOREIGN KEY (`resep_users_id`) REFERENCES `resep_users` (`id`);

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
