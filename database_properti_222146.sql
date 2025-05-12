-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 02:03 AM
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
(4, 'agen', 'agen', '941730a7089d81c58c743a7577a51640', 'agen', 'agen', '2025-05-04 20:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `cicilan_222146`
--

CREATE TABLE `cicilan_222146` (
  `id_cicilan_222146` int(11) NOT NULL,
  `id_transaksi_222146` int(11) NOT NULL,
  `jumlah_cicilan_222146` int(11) NOT NULL,
  `nilai_cicilan_222146` decimal(15,2) NOT NULL,
  `interval_cicilan_222146` int(11) NOT NULL COMMENT 'Dalam hari',
  `status_222146` varchar(20) DEFAULT 'pending',
  `created_at_222146` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cicilan_222146`
--

INSERT INTO `cicilan_222146` (`id_cicilan_222146`, `id_transaksi_222146`, `jumlah_cicilan_222146`, `nilai_cicilan_222146`, `interval_cicilan_222146`, `status_222146`, `created_at_222146`) VALUES
(6, 30, 6, 70500000.00, 30, 'pending', '2025-05-11 23:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `detail_cicilan_222146`
--

CREATE TABLE `detail_cicilan_222146` (
  `id_detail_cicilan_222146` int(11) NOT NULL,
  `id_cicilan_222146` int(11) NOT NULL,
  `angsuran_ke_222146` int(11) NOT NULL,
  `jumlah_222146` decimal(15,2) NOT NULL,
  `tanggal_jatuh_tempo_222146` date NOT NULL,
  `status_222146` varchar(20) DEFAULT 'pending',
  `bukti_pembayaran_222146` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran_222146` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_cicilan_222146`
--

INSERT INTO `detail_cicilan_222146` (`id_detail_cicilan_222146`, `id_cicilan_222146`, `angsuran_ke_222146`, `jumlah_222146`, `tanggal_jatuh_tempo_222146`, `status_222146`, `bukti_pembayaran_222146`, `tanggal_pembayaran_222146`) VALUES
(82, 6, 1, 70500000.00, '2025-06-11', 'lunas', 'cicilan_1747007975_36.jpg', '2025-05-12 07:59:35'),
(83, 6, 2, 70500000.00, '2025-07-11', 'lunas', 'cicilan_1747007980_60.jpg', '2025-05-12 07:59:40'),
(84, 6, 3, 70500000.00, '2025-08-10', 'lunas', 'cicilan_1747007984_properti.jpg', '2025-05-12 07:59:44'),
(85, 6, 4, 70500000.00, '2025-09-09', 'lunas', 'cicilan_1747007989_properti2.jpg', '2025-05-12 07:59:49'),
(86, 6, 5, 70500000.00, '2025-10-09', 'lunas', 'cicilan_1747007993_properti3.jpeg', '2025-05-12 07:59:53'),
(87, 6, 6, 70500000.00, '2025-11-08', 'lunas', 'cicilan_1747007998_properti3.jpeg', '2025-05-12 07:59:58');

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

--
-- Dumping data for table `pembayaran_222146`
--

INSERT INTO `pembayaran_222146` (`id_pembayaran_222146`, `id_transaksi_222146`, `jumlah_222146`, `bukti_pembayaran_222146`, `tanggal_pembayaran_222146`) VALUES
(12, 30, 470000000.00, 'bukti_30_60.jpg', '2025-05-11 23:52:31');

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
(6, 'tes', '0854', 'tes', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', '2025-04-27 12:32:41'),
(10, 'hoho', '3003', 'hoho', 'hoho', '$2y$10$QrJlIM1/L4mnMZsDLfBRduBv/asXc/zrBNEism/eBLA9uaMjNeRmW', '2025-05-04 21:51:03'),
(11, 'hoho', '3434', 'ohoh', 'hohoo', '74d181ce69fa53e60fb588719cc404e1', '2025-05-04 21:51:40'),
(12, 'udin', '54354', 'udin', 'udin', '6bec9c852847242e384a4d5ac0962ba0', '2025-05-06 15:16:16');

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
(4, 'Cluster Anggrek - Type 45/90', 'Jl. Perintis', 350000000.00, 4, '45', '90', '3', '2', '1205202501353336.jpg', 'Rumah asri dengan taman belakang', '081234567891', 'Tersedia'),
(5, 'Cluster Mawar - Type 36/72', 'Jl. Perintis', 280000000.00, 4, '36', '72', '2', '1', '1205202501363045.jpg', 'Lokasi strategis, 5 menit ke tol', '082112345678', 'Tersedia'),
(6, 'Cluster Melati - Type 60/100', 'Jl. Perintis', 470000000.00, 4, '60', '100', '3', '2', '1205202501372454.jpg', 'Rumah hook dengan akses dua jalan', '081345678902', 'Tersedia'),
(7, 'Cluster Teratai - Type 40/84', 'Jl. Perintis', 320000000.00, 4, '40', '84', '2', '1', '1205202501383460.jpg', 'Cocok untuk keluarga kecil', '083245671122', 'Tersedia'),
(8, 'Cluster Cempaka - Type 75/120', 'Jl. Perintis', 580000000.00, 4, '75', '120', '4', '2', '1205202501394075.jpeg', 'Dilengkapi garasi & taman depan', '082176543210', 'Tersedia'),
(9, 'Cluster Flamboyan - Type 50/96', 'Jl. Perintis', 390000000.00, 4, '50', '96', '3', '2', '12052025014039100.jpeg', 'Dilengkapi kitchen set dan pagar', '083122334455', 'Tersedia'),
(10, 'Cluster Lavender - Type 45/84', 'Jl. Perintis', 350000000.00, 4, '45', '84', '3', '1', '12052025014132properti3.jpeg', 'Lokasi elite dan tenang', '082156789034', 'Tersedia'),
(11, 'Cluster Seruni - Type 30/60', 'Jl. Perintis', 240000000.00, 4, '30', '60', '1', '1', '1205202501431736.jpg', 'Rumah murah dengan fasilitas umum lengkap', '081212345670', 'Tersedia'),
(12, 'Cluster Bougenville - Type 65/120', 'Jl. Perintis', 530000000.00, 4, '65', '120', '4', '2', '12052025014402properti2.jpg', 'Bonus pagar keliling dan toren air', '081334567891', 'Tersedia'),
(13, 'Cluster Alamanda - Type 50/90', 'Jl. Perintis', 410000000.00, 4, '50', '90', '3', '2', '12052025014440properti3.jpeg', 'Siap huni, lingkungan bersih dan aman', '083212345678', 'Tersedia');

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
  `status_222146` enum('pending','dikonfirmasi','batal','lunas') DEFAULT 'pending',
  `tanggal_transaksi_222146` timestamp NOT NULL DEFAULT current_timestamp(),
  `metode_pembayaran_222146` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_222146`
--

INSERT INTO `transaksi_222146` (`id_transaksi_222146`, `id_pengguna_222146`, `id_properti_222146`, `status_222146`, `tanggal_transaksi_222146`, `metode_pembayaran_222146`) VALUES
(30, 6, 6, 'lunas', '2025-05-11 23:52:28', 'cicilan');

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
-- Indexes for table `cicilan_222146`
--
ALTER TABLE `cicilan_222146`
  ADD PRIMARY KEY (`id_cicilan_222146`),
  ADD KEY `cicilan_222146_ibfk_1` (`id_transaksi_222146`);

--
-- Indexes for table `detail_cicilan_222146`
--
ALTER TABLE `detail_cicilan_222146`
  ADD PRIMARY KEY (`id_detail_cicilan_222146`),
  ADD KEY `detail_cicilan_222146_ibfk_1` (`id_cicilan_222146`);

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
-- AUTO_INCREMENT for table `cicilan_222146`
--
ALTER TABLE `cicilan_222146`
  MODIFY `id_cicilan_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_cicilan_222146`
--
ALTER TABLE `detail_cicilan_222146`
  MODIFY `id_detail_cicilan_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `pembayaran_222146`
--
ALTER TABLE `pembayaran_222146`
  MODIFY `id_pembayaran_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengguna_222146`
--
ALTER TABLE `pengguna_222146`
  MODIFY `id_pengguna_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `properti_222146`
--
ALTER TABLE `properti_222146`
  MODIFY `id_properti_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rating_222146`
--
ALTER TABLE `rating_222146`
  MODIFY `id_rating_222146` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_222146`
--
ALTER TABLE `transaksi_222146`
  MODIFY `id_transaksi_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cicilan_222146`
--
ALTER TABLE `cicilan_222146`
  ADD CONSTRAINT `cicilan_222146_ibfk_1` FOREIGN KEY (`id_transaksi_222146`) REFERENCES `transaksi_222146` (`id_transaksi_222146`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_cicilan_222146`
--
ALTER TABLE `detail_cicilan_222146`
  ADD CONSTRAINT `detail_cicilan_222146_ibfk_1` FOREIGN KEY (`id_cicilan_222146`) REFERENCES `cicilan_222146` (`id_cicilan_222146`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran_222146`
--
ALTER TABLE `pembayaran_222146`
  ADD CONSTRAINT `pembayaran_222146_ibfk_1` FOREIGN KEY (`id_transaksi_222146`) REFERENCES `transaksi_222146` (`id_transaksi_222146`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `transaksi_222146_ibfk_1` FOREIGN KEY (`id_pengguna_222146`) REFERENCES `pengguna_222146` (`id_pengguna_222146`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_222146_ibfk_2` FOREIGN KEY (`id_properti_222146`) REFERENCES `properti_222146` (`id_properti_222146`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
