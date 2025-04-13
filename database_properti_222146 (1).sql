-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 07:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_properti_222146`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_222146`
--

CREATE TABLE `admin_222146` (
  `id_admin_222146` int(11) NOT NULL,
  `username_admin_222146` varchar(50) NOT NULL,
  `password_admin_222146` varchar(255) NOT NULL,
  `email_admin_222146` varchar(100) NOT NULL,
  `created_at_admin_222146` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_222146`
--

INSERT INTO `admin_222146` (`id_admin_222146`, `username_admin_222146`, `password_admin_222146`, `email_admin_222146`, `created_at_admin_222146`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '2025-04-13 04:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `agen_222146`
--

CREATE TABLE `agen_222146` (
  `id_agen_222146` int(11) NOT NULL,
  `nama_agen_222146` varchar(100) NOT NULL,
  `username_222146` varchar(255) NOT NULL,
  `password_222146` varchar(255) NOT NULL,
  `kontak_222146` varchar(50) NOT NULL,
  `email_222146` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agen_222146`
--

INSERT INTO `agen_222146` (`id_agen_222146`, `nama_agen_222146`, `username_222146`, `password_222146`, `kontak_222146`, `email_222146`) VALUES
(1, 'agen', 'agen', '941730a7089d81c58c743a7577a51640', '0853', 'agen@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_222146`
--

CREATE TABLE `pembayaran_222146` (
  `id_pembayaran_222146` int(11) NOT NULL,
  `id_transaksi_222146` int(11) DEFAULT NULL,
  `jumlah_222146` decimal(15,2) NOT NULL,
  `bukti_pembayaran_222146` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran_222146` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_222146`
--

CREATE TABLE `pengguna_222146` (
  `id_pengguna_222146` int(11) NOT NULL,
  `nama_222146` varchar(255) NOT NULL,
  `username_222146` varchar(50) NOT NULL,
  `password_222146` varchar(255) NOT NULL,
  `email_222146` varchar(100) NOT NULL,
  `created_at_222146` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna_222146`
--

INSERT INTO `pengguna_222146` (`id_pengguna_222146`, `nama_222146`, `username_222146`, `password_222146`, `email_222146`, `created_at_222146`) VALUES
(1, 'pengguna', 'pengguna', '8b097b8a86f9d6a991357d40d3d58634', 'pengguna@gmail.com', '2025-04-13 05:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `properti_222146`
--

CREATE TABLE `properti_222146` (
  `id_properti_222146` int(11) NOT NULL,
  `nama_properti_222146` varchar(100) NOT NULL,
  `alamat_222146` varchar(255) NOT NULL,
  `harga_222146` decimal(15,2) NOT NULL,
  `id_agen_222146` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_222146`
--

CREATE TABLE `rating_222146` (
  `id_rating_222146` int(11) NOT NULL,
  `id_pengguna_222146` int(11) DEFAULT NULL,
  `id_properti_222146` int(11) DEFAULT NULL,
  `nilai_222146` int(11) DEFAULT NULL CHECK (`nilai_222146` between 1 and 5),
  `komentar_222146` text DEFAULT NULL,
  `tanggal_rating_222146` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_222146`
--

CREATE TABLE `transaksi_222146` (
  `id_transaksi_222146` int(11) NOT NULL,
  `id_pengguna_222146` int(11) DEFAULT NULL,
  `id_properti_222146` int(11) DEFAULT NULL,
  `status_222146` enum('dipesan','menunggu pembayaran','selesai') DEFAULT 'dipesan',
  `tanggal_transaksi_222146` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_222146`
--
ALTER TABLE `admin_222146`
  ADD PRIMARY KEY (`id_admin_222146`),
  ADD UNIQUE KEY `username_admin_222146` (`username_admin_222146`),
  ADD UNIQUE KEY `email_admin_222146` (`email_admin_222146`);

--
-- Indexes for table `agen_222146`
--
ALTER TABLE `agen_222146`
  ADD PRIMARY KEY (`id_agen_222146`),
  ADD UNIQUE KEY `email_222146` (`email_222146`);

--
-- Indexes for table `pembayaran_222146`
--
ALTER TABLE `pembayaran_222146`
  ADD PRIMARY KEY (`id_pembayaran_222146`),
  ADD KEY `id_transaksi_222146` (`id_transaksi_222146`);

--
-- Indexes for table `pengguna_222146`
--
ALTER TABLE `pengguna_222146`
  ADD PRIMARY KEY (`id_pengguna_222146`),
  ADD UNIQUE KEY `username_222146` (`username_222146`),
  ADD UNIQUE KEY `email_222146` (`email_222146`);

--
-- Indexes for table `properti_222146`
--
ALTER TABLE `properti_222146`
  ADD PRIMARY KEY (`id_properti_222146`),
  ADD KEY `id_agen_222146` (`id_agen_222146`);

--
-- Indexes for table `rating_222146`
--
ALTER TABLE `rating_222146`
  ADD PRIMARY KEY (`id_rating_222146`),
  ADD KEY `id_pengguna_222146` (`id_pengguna_222146`),
  ADD KEY `id_properti_222146` (`id_properti_222146`);

--
-- Indexes for table `transaksi_222146`
--
ALTER TABLE `transaksi_222146`
  ADD PRIMARY KEY (`id_transaksi_222146`),
  ADD KEY `id_pengguna_222146` (`id_pengguna_222146`),
  ADD KEY `id_properti_222146` (`id_properti_222146`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_222146`
--
ALTER TABLE `admin_222146`
  MODIFY `id_admin_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agen_222146`
--
ALTER TABLE `agen_222146`
  MODIFY `id_agen_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran_222146`
--
ALTER TABLE `pembayaran_222146`
  MODIFY `id_pembayaran_222146` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna_222146`
--
ALTER TABLE `pengguna_222146`
  MODIFY `id_pengguna_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `properti_222146`
--
ALTER TABLE `properti_222146`
  MODIFY `id_properti_222146` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_222146`
--
ALTER TABLE `rating_222146`
  MODIFY `id_rating_222146` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_222146`
--
ALTER TABLE `transaksi_222146`
  MODIFY `id_transaksi_222146` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran_222146`
--
ALTER TABLE `pembayaran_222146`
  ADD CONSTRAINT `pembayaran_222146_ibfk_1` FOREIGN KEY (`id_transaksi_222146`) REFERENCES `transaksi_222146` (`id_transaksi_222146`);

--
-- Constraints for table `properti_222146`
--
ALTER TABLE `properti_222146`
  ADD CONSTRAINT `properti_222146_ibfk_1` FOREIGN KEY (`id_agen_222146`) REFERENCES `agen_222146` (`id_agen_222146`);

--
-- Constraints for table `rating_222146`
--
ALTER TABLE `rating_222146`
  ADD CONSTRAINT `rating_222146_ibfk_1` FOREIGN KEY (`id_pengguna_222146`) REFERENCES `pengguna_222146` (`id_pengguna_222146`),
  ADD CONSTRAINT `rating_222146_ibfk_2` FOREIGN KEY (`id_properti_222146`) REFERENCES `properti_222146` (`id_properti_222146`);

--
-- Constraints for table `transaksi_222146`
--
ALTER TABLE `transaksi_222146`
  ADD CONSTRAINT `transaksi_222146_ibfk_1` FOREIGN KEY (`id_pengguna_222146`) REFERENCES `pengguna_222146` (`id_pengguna_222146`),
  ADD CONSTRAINT `transaksi_222146_ibfk_2` FOREIGN KEY (`id_properti_222146`) REFERENCES `properti_222146` (`id_properti_222146`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
