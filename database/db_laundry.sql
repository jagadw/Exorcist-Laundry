-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2024 at 11:46 PM
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
(1, 1, 5, 1, 27188, '-'),
(2, 2, 6, 3, 30225, '-'),
(3, 3, 7, 3, 21158, '-');

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
(2, 'Ada Wong', 'Jl. Sulawesi no.33', 'P', '6285174300248'),
(4, 'Albert Wesker', 'Jl. Semongko no.09', 'L', '6281997665504');

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
(1, 'Gianyar', 'Jl. Merdeka no.17', '6281234593445'),
(5, 'Bangli', 'Jl. Diponegoro no.44', '6281345678908'),
(6, 'Batubulan', 'Jl. hasanudin no.38', '6289123456789');

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
(5, 1, 'kiloan', 'Hemat 5 kg', 25000),
(6, 1, 'selimut', 'Selimut tetangga', 10000),
(7, 5, 'bed_cover', 'Bed mantul', 7000),
(8, 6, 'kaos', 'Kaos antikotor', 8000),
(9, 6, 'lain', 'Kinclong 69', 24000);

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
  `pajak` int NOT NULL,
  `status` enum('baru','proses','selesai','diambil') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dibayar` enum('dibayar','belum_dibayar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int NOT NULL,
  `nama_pelanggan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `dibayar`, `id_user`, `nama_pelanggan`) VALUES
(1, 1, 'INV-024022024', 2, '2024-02-24 21:25:47', '2024-02-20 20:00:00', NULL, 2000, 0, 188, 'baru', 'belum_dibayar', 2, 'Ada Wong'),
(2, 1, 'INV-124022024', 4, '2024-02-24 21:26:28', '2024-02-26 05:00:00', '2024-02-24 22:41:59', 0, 0, 225, 'proses', 'dibayar', 2, 'Albert Wesker'),
(3, 5, 'INV-224022024', 2, '2024-02-24 21:28:43', '2024-02-26 10:00:00', NULL, 0, 0, 158, 'baru', 'belum_dibayar', 4, 'Ada Wong');

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
(2, 'luis serra', 'admin', '$2y$10$YqUHzRP5PCIxolwi.BuGT.z3gJD6ihT8J/CDTCbFyZNn.XQZNeesi', 1, 'admin'),
(4, 'pak wowo', 'kasir', '$2y$10$NMLKwvfopuCaca915JsdmuUpfFjaFJGbwKMUfYM9dVbFz274zBAj2', 5, 'kasir'),
(5, 'maskuli', 'owner', '$2y$10$DvO8WEfETIapfW1hp5LSdOZgZbV4Nwai9GasnKrXUwRUYjIHClRZG', 6, 'owner');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
