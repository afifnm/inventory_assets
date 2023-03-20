-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 09:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambil`
--

CREATE TABLE `ambil` (
  `id_ambil` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `nomor_inventaris` varchar(80) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aset` enum('Tetap','Tidak Tetap') NOT NULL,
  `stok` int(11) NOT NULL,
  `nomor_inventaris` varchar(80) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_sumber_dana` int(11) NOT NULL,
  `tahun_perolehan` int(11) NOT NULL,
  `harga` double NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_ruang` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `kondisi` varchar(19) NOT NULL,
  `active` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `nama`, `aset`, `stok`, `nomor_inventaris`, `merk`, `id_jenis`, `id_sumber_dana`, `tahun_perolehan`, `harga`, `tanggal_masuk`, `id_ruang`, `status`, `kondisi`, `active`, `updated_at`) VALUES
(2, 'qwe', 'Tetap', 1, 'qwe', 'qwe', 4, 2, 2001, 90000, '2023-03-20', '9', 'Ada', 'Baik', 1, '2023-03-20 07:40:36'),
(3, 'ert', 'Tetap', 1, 'ert', 'ert', 4, 2, 2005, 90000, '2023-03-20', '9', 'Ada', 'Baik', 1, '2023-03-20 07:41:37'),
(6, 'LCD Monitor 20inch', 'Tetap', 1, '1223.232.3231', 'Samsung', 4, 4, 2023, 800000, '2023-03-20', '4', 'Ada', 'Baik', 1, '2023-03-20 08:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_detail_pinjam` int(11) NOT NULL,
  `kode_pinjam` varchar(20) NOT NULL,
  `nomor_inventaris` varchar(80) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` int(11) NOT NULL,
  `kondisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `nomor_inventaris` varchar(80) NOT NULL,
  `namafile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `jenis`) VALUES
(1, 'Peralatan Kantor'),
(2, 'Perabot Kantor'),
(4, 'Alat Komunikasi'),
(5, 'Perabot Kantor'),
(6, 'Paket Komputer'),
(7, 'Mesin-Mesin'),
(8, 'Perkakas');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id` int(11) NOT NULL,
  `nama_website` varchar(80) NOT NULL,
  `favicon` varchar(80) NOT NULL,
  `logo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id`, `nama_website`, `favicon`, `logo`) VALUES
(1, 'Sistem Informasi Inventaris Aset', 'fav.ico', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id_logs` int(11) NOT NULL,
  `tabel` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(50) NOT NULL,
  `IP` varchar(60) NOT NULL,
  `nomor_inventaris` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id_logs`, `tabel`, `keterangan`, `datetime`, `username`, `IP`, `nomor_inventaris`) VALUES
(2, 'aset', 'Muklisin  telah menambahkan qwe dengan nomor inventaris qwe', '2023-03-20 07:40:36', 'admin', '::1', 'qwe'),
(3, 'aset', 'Muklisin  telah menambahkan ert dengan nomor inventaris ert', '2023-03-20 07:41:37', 'admin', '::1', 'ert'),
(4, 'aset', 'Muklisin  telah menghapus LCD Monitor 20inch dengan nomor inventaris 1223.232.3231', '2023-03-20 08:02:01', 'admin', '::1', '1223.232.3231'),
(5, 'aset', 'Muklisin  telah menghapus Kertas F4 dengan nomor inventaris 123.123.2.121', '2023-03-20 08:02:03', 'admin', '::1', '123.123.2.121'),
(6, 'aset', 'Muklisin  telah mengubah jenis aset  menjadi Alat Komunikasi, ruang  menjadi Ruang 3, sumber dana  menjadi , harga 900000 menjadi 800000, tahun_perolehan 2020 menjadi 2023, dari aset LCD Monitor 20inch dengan nomor inventaris 1223.232.3231', '2023-03-20 08:05:14', 'admin', '::1', '1223.232.3231'),
(7, 'aset', 'Muklisin  telah mengubah sumber dana  menjadi Ruang 3, dari aset LCD Monitor 20inch dengan nomor inventaris 1223.232.3231', '2023-03-20 08:05:58', 'admin', '::1', '1223.232.3231'),
(8, 'aset', 'Muklisin  telah menghapus Kertas F4 dengan nomor inventaris 123.123.2.121', '2023-03-20 08:22:56', 'admin', '::1', '123.123.2.121');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `kode_pinjam` varchar(50) NOT NULL,
  `peminjam` varchar(50) NOT NULL,
  `username` varchar(60) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal_pinjam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `ruang`, `keterangan`) VALUES
(1, 'Ruang 1', 'Ruang Kelas'),
(3, 'Ruang 2', 'Ruang Kelas'),
(4, 'Ruang 3', 'Ruang Kelas'),
(5, 'Ruang 4', 'Ruang Kelas'),
(6, 'Lab Komputer 1', 'Lab Komputer'),
(7, 'Lab Komputer 2', 'Lab Komputer'),
(8, 'Ruang Guru', '-'),
(9, 'Gudang Barat', 'Tempat penyimpanan');

-- --------------------------------------------------------

--
-- Table structure for table `sumber_dana`
--

CREATE TABLE `sumber_dana` (
  `id_sumber_dana` int(11) NOT NULL,
  `sumber_dana` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sumber_dana`
--

INSERT INTO `sumber_dana` (`id_sumber_dana`, `sumber_dana`) VALUES
(1, 'BOS'),
(2, 'BOP'),
(4, 'Usman');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `nomor_inventaris` varchar(80) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_kembali`
--

CREATE TABLE `temp_kembali` (
  `id_temp_kembali` int(11) NOT NULL,
  `nomor_inventaris` varchar(80) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Staff','Gudang','Admin') NOT NULL,
  `nama` varchar(70) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `nama`, `alamat`, `no_hp`, `foto`, `active`, `last_login`, `pinjam`) VALUES
(2, 'root', '$2y$05$CxyynpFnDJAm9kOPIl/sIuViSHnOXud1Eo.y1OcCNbq7v/Z7rPuOq', 'Admin', 'Muklisin', 'Karanganyar RT 02 RW 01, Bejen, Bejen, Karanganyar, 574444', '6289670000000', 'root.jpg', 1, '2023-03-20 06:35:17', 0),
(20, 'andi', '$2y$05$sLA/2qrx5j8zAV9Rlt0.seU6d.LBnvnEBG/uvqVZQcaL5xRQel6qa', 'Staff', 'Andi Winduu', 'jumantonoo', '090993123', 'andijpg', 1, '2023-03-20 06:35:17', 0),
(21, 'herdi', '$2y$05$7ifzuWj/Vh3dBKK3Plb9tuNELNNrH8K60V/tK/V82it2/3Nmu4Q/u', 'Staff', 'herdiminn', 'karanganyarr', '08148471212', 'herdijpg', 1, '2023-03-20 06:35:17', 0),
(22, 'admin', '$2y$05$aYQBks0Ft0syRDEBnkL.RugQrleO95y/hxGLni81jbUydPWvhssx6', 'Admin', 'Muklisin ', '-', '-', 'adminjpg', 1, '2023-03-20 06:35:17', 0),
(23, 'aditya', '$2y$05$FcHSkzXq0MvomI3NXAsib.op68YjdWxpsoBhV0.PfgARP4Oek5zHy', 'Admin', 'Aditya Roostiantoko, A.Md', 'Bangsri Karangpandan', '08995286999', 'adityajpg', 1, '2023-03-20 06:35:17', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambil`
--
ALTER TABLE `ambil`
  ADD PRIMARY KEY (`id_ambil`);

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id_detail_pinjam`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_logs`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`kode_pinjam`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  ADD PRIMARY KEY (`id_sumber_dana`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_kembali`
--
ALTER TABLE `temp_kembali`
  ADD PRIMARY KEY (`id_temp_kembali`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambil`
--
ALTER TABLE `ambil`
  MODIFY `id_ambil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id_detail_pinjam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  MODIFY `id_sumber_dana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_kembali`
--
ALTER TABLE `temp_kembali`
  MODIFY `id_temp_kembali` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
