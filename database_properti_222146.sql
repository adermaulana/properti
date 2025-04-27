-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 03:15 PM
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
  `nama_222146` varchar(255) NOT NULL,
  `username_admin_222146` varchar(50) NOT NULL,
  `password_admin_222146` varchar(255) NOT NULL,
  `email_admin_222146` varchar(100) NOT NULL,
  `created_at_admin_222146` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_222146`
--

INSERT INTO `admin_222146` (`id_admin_222146`, `nama_222146`, `username_admin_222146`, `password_admin_222146`, `email_admin_222146`, `created_at_admin_222146`) VALUES
(4, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '2025-04-20 15:13:09');

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
  `alamat_222146` text NOT NULL,
  `created_at_222146` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agen_222146`
--

INSERT INTO `agen_222146` (`id_agen_222146`, `nama_agen_222146`, `username_222146`, `password_222146`, `kontak_222146`, `alamat_222146`, `created_at_222146`) VALUES
(4, 'agenda', 'agenda', 'd0dbdfd8edf8dd1608405055c26adc94', 'agenda', 'agenda', '2025-04-27 12:40:54');

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
  `no_hp_222146` varchar(20) NOT NULL,
  `alamat_222146` text NOT NULL,
  `username_222146` varchar(50) NOT NULL,
  `password_222146` varchar(255) NOT NULL,
  `created_at_222146` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna_222146`
--

INSERT INTO `pengguna_222146` (`id_pengguna_222146`, `nama_222146`, `no_hp_222146`, `alamat_222146`, `username_222146`, `password_222146`, `created_at_222146`) VALUES
(6, 'tes', '0854', 'tes', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', '2025-04-27 12:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `properti_222146`
--

CREATE TABLE `properti_222146` (
  `id_properti_222146` int(11) NOT NULL,
  `nama_properti_222146` varchar(100) NOT NULL,
  `lokasi_222146` varchar(255) NOT NULL,
  `harga_222146` decimal(15,2) NOT NULL,
  `id_agen_222146` int(11) DEFAULT NULL,
  `luas_bangunan_222146` varchar(50) NOT NULL,
  `luas_tanah_222146` varchar(50) NOT NULL,
  `kamar_tidur_222146` varchar(50) NOT NULL,
  `kamar_mandi_222146` varchar(50) NOT NULL,
  `foto_222146` varchar(255) NOT NULL,
  `deskripsi_222146` text NOT NULL,
  `nomor_telepon_222146` varchar(50) NOT NULL,
  `status_222146` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properti_222146`
--

INSERT INTO `properti_222146` (`id_properti_222146`, `nama_properti_222146`, `lokasi_222146`, `harga_222146`, `id_agen_222146`, `luas_bangunan_222146`, `luas_tanah_222146`, `kamar_tidur_222146`, `kamar_mandi_222146`, `foto_222146`, `deskripsi_222146`, `nomor_telepon_222146`, `status_222146`) VALUES
(1, 'udin', '23', 24000.00, 4, '23', '23', '43', '2', '27042025150334Screenshot (3).png', 'dw', 'das', 'Tersedia');

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
  ADD PRIMARY KEY (`id_agen_222146`);

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
  ADD UNIQUE KEY `username_222146` (`username_222146`);

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
  MODIFY `id_admin_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `agen_222146`
--
ALTER TABLE `agen_222146`
  MODIFY `id_agen_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran_222146`
--
ALTER TABLE `pembayaran_222146`
  MODIFY `id_pembayaran_222146` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna_222146`
--
ALTER TABLE `pengguna_222146`
  MODIFY `id_pengguna_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `properti_222146`
--
ALTER TABLE `properti_222146`
  MODIFY `id_properti_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
