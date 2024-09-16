-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2024 at 06:06 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_paket` int NOT NULL,
  `qty` double NOT NULL,
  `hargatotal` int NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id`, `id_transaksi`, `id_paket`, `qty`, `hargatotal`, `keterangan`) VALUES
(1, 1, 7, 100, 900000, 'borongan'),
(2, 2, 7, 36, 324000, '-'),
(4, 4, 6, 55, 550000, 'terakhir'),
(8, 7, 6, 3, 30000, 'ada'),
(13, 11, 5, 8, 200000, '-'),
(14, 11, 6, 1, 10000, 'cepat'),
(21, 11, 5, 3, 15000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tlp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(2, 'Mia', 'Jl. Danau tempe no.24', 'P', '6289120009123'),
(4, 'Jordi', 'Jl. Bunda rahma no.22', 'L', '6281999666404'),
(5, 'Johnny', 'Jl. Badag no.55', 'L', '6278912312312');

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tlp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id`, `nama`, `alamat`, `tlp`) VALUES
(1, 'Sumbawa', 'Jl. Cenderawasih No. 3', '6281345666999'),
(5, 'Bali', 'Jl. Danau Tempe No. 4', '6281345678908'),
(6, 'Papua', 'Jl. Blitar no.32', '6281653423423');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id` int NOT NULL,
  `id_outlet` int NOT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_paket` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
(5, 1, 'kiloan', 'Hemat pangkal kaya', 5000),
(6, 1, 'selimut', 'Selimut pol', 15000),
(7, 5, 'bed_cover', 'Bed antinoda', 16000),
(8, 6, 'kaos', 'Kaos mulus', 13000),
(9, 6, 'lain', 'Bebas daki', 18000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int NOT NULL,
  `id_outlet` int NOT NULL,
  `kode_invoice` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_member` int DEFAULT NULL,
  `tgl` datetime NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `biaya_tambahan` int NOT NULL,
  `diskon` double NOT NULL,
  `pajak` double NOT NULL,
  `status` enum('baru','proses','selesai','diambil') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dibayar` enum('dibayar','belum_dibayar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `dibayar`, `id_user`) VALUES
(1, 5, 'INV-202403051', 2, '2024-03-05 09:53:00', '2024-03-08 09:53:00', '2024-03-19 10:09:49', 0, 0, 0.0075, 'baru', 'dibayar', 4),
(2, 5, 'INV-202403052', 2, '2024-03-05 09:53:58', '2024-03-08 09:53:58', '2024-03-18 17:11:32', 0, 0, 0.0075, 'proses', 'dibayar', 4),
(3, 5, 'INV-202403053', 2, '2024-03-05 09:54:28', '2024-03-08 09:54:28', NULL, 0, 0, 0.0075, 'baru', 'belum_dibayar', 5),
(4, 1, 'INV-202403054', 2, '2024-03-05 09:54:58', '2024-03-08 09:54:58', '2024-03-19 18:55:47', 0, 0, 0.0075, 'baru', 'dibayar', 2),
(5, 1, 'INV-202403055', 2, '2024-03-05 09:55:59', '2024-03-08 09:55:59', NULL, 0, 0, 0.0075, 'baru', 'belum_dibayar', 2),
(6, 5, 'INV-202403056', 4, '2024-03-05 12:48:09', '2024-03-08 12:48:09', NULL, 0, 0, 0.0075, 'baru', 'belum_dibayar', 4),
(7, 1, 'INV-202403137', 4, '2024-03-13 20:00:39', '2024-03-16 20:00:39', '2024-03-13 20:01:01', 0, 0, 0.0075, 'proses', 'dibayar', 2),
(9, 1, 'INV-202403158', 2, '2024-03-15 08:03:30', '2024-03-18 08:03:30', NULL, 0, 0, 0.0075, 'baru', 'belum_dibayar', 2),
(11, 1, 'INV-2024031910', 4, '2024-03-19 19:26:46', '2024-03-22 19:26:46', NULL, 0, 0, 0.0075, 'baru', 'belum_dibayar', 2),
(12, 1, 'INV-2024032112', 2, '2024-03-21 09:59:00', '2024-03-24 09:59:00', NULL, 5000, 10, 0.0075, 'baru', 'belum_dibayar', 2),
(13, 1, 'INV-2024/03/31/13', 4, '2024-03-31 08:14:53', '2024-04-03 08:14:53', NULL, 0, 10, 0.0075, 'baru', 'belum_dibayar', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_outlet` int NOT NULL,
  `role` enum('admin','kasir','owner') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `username`, `password`, `id_outlet`, `role`) VALUES
(2, 'Joel', 'admin', '$2y$10$YqUHzRP5PCIxolwi.BuGT.z3gJD6ihT8J/CDTCbFyZNn.XQZNeesi', 1, 'admin'),
(4, 'Ambatron', 'kasir', '$2y$10$NMLKwvfopuCaca915JsdmuUpfFjaFJGbwKMUfYM9dVbFz274zBAj2', 5, 'kasir'),
(5, 'Abdul Toqum', 'owner', '$2y$10$DvO8WEfETIapfW1hp5LSdOZgZbV4Nwai9GasnKrXUwRUYjIHClRZG', 5, 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `tb_detail_transaksi_ibfk_1` (`id_transaksi`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `tb_paket` (`id`),
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD CONSTRAINT `tb_paket_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id`),
  ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `tb_transaksi_ibfk_4` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `tb_outlet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
