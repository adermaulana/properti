-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 02:30 AM
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
(4, 'admin', 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin@gmail.com', '2025-04-20 15:13:09');

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
(1, 'Andi Setiawan Property', 'andisetiawan', '25d55ad283aa400af464c76d713c07ad', '081234567890', 'Jl. Sudirman No. 45, Jakarta Selatan', '2024-01-10 00:00:00'),
(2, 'Sari Indah Realty', 'sariindah', '25d55ad283aa400af464c76d713c07ad', '081345678901', 'Jl. Braga No. 78, Bandung', '2024-01-11 01:15:00'),
(3, 'Budi Hartono Estate', 'budihartono', '25d55ad283aa400af464c76d713c07ad', '081456789012', 'Jl. Pemuda No. 123, Surabaya', '2024-01-12 02:30:00'),
(4, 'Maya Property Solutions', 'mayaproperty', '25d55ad283aa400af464c76d713c07ad', '081567890123', 'Jl. Imam Bonjol No. 56, Medan', '2024-01-13 03:45:00'),
(5, 'Denny Real Estate', 'dennyrealty', '25d55ad283aa400af464c76d713c07ad', '081678901234', 'Jl. Sultan Alauddin No. 89, Makassar', '2024-01-14 05:20:00'),
(6, 'Rina Property Center', 'rinaproperty', '25d55ad283aa400af464c76d713c07ad', '081789012345', 'Jl. Pandanaran No. 34, Semarang', '2024-01-15 06:10:00'),
(7, 'Fajar Yogya Property', 'fajaryogya', '25d55ad283aa400af464c76d713c07ad', '081890123456', 'Jl. Malioboro No. 67, Yogyakarta', '2024-01-16 07:25:00'),
(8, 'Indira Bali Realty', 'indirabalirealty', '25d55ad283aa400af464c76d713c07ad', '081901234567', 'Jl. Sunset Road No. 12, Denpasar', '2024-01-17 08:40:00'),
(9, 'Reza Palembang Estate', 'rezapalembang', '25d55ad283aa400af464c76d713c07ad', '082012345678', 'Jl. Jendral Sudirman No. 45, Palembang', '2024-01-18 00:30:00'),
(10, 'Lestari Lampung Property', 'lestarilampung', '25d55ad283aa400af464c76d713c07ad', '082123456789', 'Jl. Kartini No. 78, Bandar Lampung', '2024-01-19 01:45:00'),
(11, 'Hendra Padang Realty', 'hendrapadang', '25d55ad283aa400af464c76d713c07ad', '082234567890', 'Jl. Hayam Wuruk No. 23, Padang', '2024-01-20 02:20:00'),
(12, 'Dewi Pontianak Estate', 'dewipontianak', '25d55ad283aa400af464c76d713c07ad', '082345678901', 'Jl. Diponegoro No. 56, Pontianak', '2024-01-21 04:15:00'),
(13, 'Andi Balikpapan Property', 'andibalikpapan', '25d55ad283aa400af464c76d713c07ad', '082456789012', 'Jl. Jendral Ahmad Yani No. 89, Balikpapan', '2024-01-22 05:50:00'),
(14, 'Nita Malang Realty', 'nitamalang', '25d55ad283aa400af464c76d713c07ad', '082567890123', 'Jl. Ijen No. 34, Malang', '2024-01-23 06:30:00'),
(15, 'Yoga Solo Property', 'yogasolo', '25d55ad283aa400af464c76d713c07ad', '082678901234', 'Jl. Slamet Riyadi No. 67, Solo', '2024-01-24 08:10:00');

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
(1, 'Ahmad Rizki Pratama', '081234567890', 'Jl. Merdeka No. 15, Jakarta Pusat', 'ahmadrizki', '25d55ad283aa400af464c76d713c07ad', '2024-01-15 00:30:00'),
(2, 'Siti Nurhaliza', '081345678901', 'Jl. Sudirman No. 23, Bandung', 'sitinur', '25d55ad283aa400af464c76d713c07ad', '2024-01-16 01:15:00'),
(3, 'Budi Santoso', '081456789012', 'Jl. Diponegoro No. 45, Surabaya', 'budisan', '25d55ad283aa400af464c76d713c07ad', '2024-01-17 02:45:00'),
(4, 'Maya Sari Dewi', '081567890123', 'Jl. Ahmad Yani No. 12, Medan', 'mayasari', '25d55ad283aa400af464c76d713c07ad', '2024-01-18 03:20:00'),
(5, 'Deni Kurniawan', '081678901234', 'Jl. Gatot Subroto No. 78, Makassar', 'denikur', '25d55ad283aa400af464c76d713c07ad', '2024-01-19 06:10:00'),
(6, 'Rina Oktavia', '081789012345', 'Jl. Pahlawan No. 34, Semarang', 'rinaokt', '25d55ad283aa400af464c76d713c07ad', '2024-01-20 07:30:00'),
(7, 'Fajar Ramadhan', '081890123456', 'Jl. Veteran No. 56, Yogyakarta', 'fajarram', '25d55ad283aa400af464c76d713c07ad', '2024-01-21 08:45:00'),
(8, 'Indira Putri', '081901234567', 'Jl. Kartini No. 89, Denpasar', 'indiraputri', '25d55ad283aa400af464c76d713c07ad', '2024-01-22 00:00:00'),
(9, 'Reza Firmansyah', '082012345678', 'Jl. Hasanuddin No. 67, Palembang', 'rezafirman', '25d55ad283aa400af464c76d713c07ad', '2024-01-23 01:30:00'),
(10, 'Lestari Wulandari', '082123456789', 'Jl. Cut Nyak Dien No. 21, Bandar Lampung', 'lestariwul', '25d55ad283aa400af464c76d713c07ad', '2024-01-24 05:15:00'),
(11, 'Hendra Wijaya', '082234567890', 'Jl. Imam Bonjol No. 43, Padang', 'hendrawij', '25d55ad283aa400af464c76d713c07ad', '2024-01-25 06:20:00'),
(12, 'Dewi Kusuma', '082345678901', 'Jl. R.A. Kartini No. 32, Pontianak', 'dewikus', '25d55ad283aa400af464c76d713c07ad', '2024-01-26 02:10:00'),
(13, 'Andi Saputra', '082456789012', 'Jl. Sultan Agung No. 54, Balikpapan', 'andisap', '25d55ad283aa400af464c76d713c07ad', '2024-01-27 03:40:00'),
(14, 'Nita Anggraini', '082567890123', 'Jl. Gajah Mada No. 76, Malang', 'nitaang', '25d55ad283aa400af464c76d713c07ad', '2024-01-28 04:50:00'),
(15, 'Yoga Pratama', '082678901234', 'Jl. Panglima Sudirman No. 98, Solo', 'yogaprat', '25d55ad283aa400af464c76d713c07ad', '2024-01-29 08:00:00');

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
(4, 'Cluster Anggrek - Type 45/90', 'Jl. Perintis', 350000000.00, 13, '45', '90', '3', '2', '1205202501353336.jpg', 'Rumah asri dengan taman belakang', '081234567891', 'Tersedia'),
(5, 'Cluster Mawar - Type 36/72', 'Jl. Perintis', 280000000.00, 1, '36', '72', '2', '1', '1205202501363045.jpg', 'Lokasi strategis, 5 menit ke tol', '082112345678', 'Tersedia'),
(6, 'Cluster Melati - Type 60/100', 'Jl. Perintis', 470000000.00, 2, '60', '100', '3', '2', '1205202501372454.jpg', 'Rumah hook dengan akses dua jalan', '081345678902', 'Tersedia'),
(7, 'Cluster Teratai - Type 40/84', 'Jl. Perintis', 320000000.00, 3, '40', '84', '2', '1', '1205202501383460.jpg', 'Cocok untuk keluarga kecil', '083245671122', 'Tersedia'),
(8, 'Cluster Cempaka - Type 75/120', 'Jl. Perintis', 580000000.00, 12, '75', '120', '4', '2', '1205202501394075.jpeg', 'Dilengkapi garasi & taman depan', '082176543210', 'Tersedia'),
(9, 'Cluster Flamboyan - Type 50/96', 'Jl. Perintis', 390000000.00, 10, '50', '96', '3', '2', '12052025014039100.jpeg', 'Dilengkapi kitchen set dan pagar', '083122334455', 'Tersedia'),
(10, 'Cluster Lavender - Type 45/84', 'Jl. Perintis', 350000000.00, 6, '45', '84', '3', '1', '12052025014132properti3.jpeg', 'Lokasi elite dan tenang', '082156789034', 'Tersedia'),
(11, 'Cluster Seruni - Type 30/60', 'Jl. Perintis', 240000000.00, 9, '30', '60', '1', '1', '1205202501431736.jpg', 'Rumah murah dengan fasilitas umum lengkap', '081212345670', 'Tersedia'),
(12, 'Cluster Bougenville - Type 65/120', 'Jl. Perintis', 530000000.00, 7, '65', '120', '4', '2', '12052025014402properti2.jpg', 'Bonus pagar keliling dan toren air', '081334567891', 'Tersedia'),
(13, 'Cluster Alamanda - Type 50/90', 'Jl. Perintis', 410000000.00, 8, '50', '90', '3', '2', '12052025014440properti3.jpeg', 'Siap huni, lingkungan bersih dan aman', '083212345678', 'Tersedia');

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
  `metode_pembayaran_222146` varchar(255) NOT NULL,
  `dp_percentage_222146` int(11) DEFAULT 0
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
  MODIFY `id_agen_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cicilan_222146`
--
ALTER TABLE `cicilan_222146`
  MODIFY `id_cicilan_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_cicilan_222146`
--
ALTER TABLE `detail_cicilan_222146`
  MODIFY `id_detail_cicilan_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `pembayaran_222146`
--
ALTER TABLE `pembayaran_222146`
  MODIFY `id_pembayaran_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengguna_222146`
--
ALTER TABLE `pengguna_222146`
  MODIFY `id_pengguna_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id_transaksi_222146` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
