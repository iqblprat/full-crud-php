-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2023 at 05:55 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `email`, `password`, `level`) VALUES
(1, 'Agus', 'agustusan', 'agus@gmail.com', '$2y$10$KyJI1wlk67bxUmjwVm.7j.IY/L8kHLsEJRsqp2TSGu.Si81V0FbMq', '1'),
(2, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$vKnqPKmtjBzMeyq.zxIBD.qUMjMOkVlLTzAKQUPaQ34Vj65iJTD4a', '1'),
(4, 'Operator Barang', 'opmbarang', 'opmbarang@gmail.com', '$2y$10$NhbCuPtTwGXCA6XU3FoXUuLUvv3VvWum1dDb/awCvb5krONhRqtWa', '2'),
(5, 'Operator Mahasiswa', 'opmahasiswa', 'opmahasiswa@gmail.com', '$2y$10$fD8lvAE/1Q4hGouu4eVAlOQG/.gV6/ybaFPRFDg7MQZEcLfoSRE4e', '3');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `barcode` varchar(15) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `jumlah`, `harga`, `barcode`, `tanggal`) VALUES
(1, 'Mouse', 5, 50000, '970464', '2023-08-14 04:16:07'),
(2, 'Headset', 11, 75000, '', '2023-08-03 01:31:29'),
(3, 'Meja', 2, 1200000, '', '2023-08-03 02:37:03'),
(4, 'Monitor', 2, 1500000, '', '2023-08-03 04:24:42'),
(5, 'CPU', 7, 2000000, '', '2023-08-03 04:25:06'),
(7, 'Mouse', 5, 50000, '', '2023-08-10 03:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `prodi`, `jk`, `telepon`, `alamat`, `email`, `foto`) VALUES
(4, 'Nurul', 'Teknik Listrik', 'Perempuan', '0813453546423', '', 'nurul@gmail.com', '64d09f2a84e22.jpg'),
(5, 'Rusli', 'Teknik Mesin', 'Laki-Laki', '081254565767', '', 'rusli@gmail.com', '64d098e5ad32a.jpg'),
(8, 'Husein', 'Teknik Informatika', 'Laki-Laki', '0823949932435', '', 'husein@gmail.com', '64d0a2caef4c4.jpg'),
(9, 'Rizky', 'Teknik Informatika', 'Laki-Laki', '089732942344', '', 'rizky@gmail.com', '64d0a3ae8937b.jpg'),
(11, 'Monitor', 'Teknik Mesin', 'Laki-Laki', '08696969696969', 'Cimahi 40513', 'montor@gmail.com', '64dad8dbee0d5.jpg'),
(12, 'Wawan', 'Teknik Listrik', 'Laki-Laki', '0894848239384', '<p><em><strong>Bandung</strong></em></p>', 'wawan@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
