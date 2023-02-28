-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 09:26 AM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aset` enum('Tetap','Tidak Tetap') NOT NULL,
  `stok` int(11) NOT NULL,
  `nomor_inventaris` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_ruang` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `kondisi` varchar(19) NOT NULL,
  `active` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `nama`, `aset`, `stok`, `nomor_inventaris`, `merk`, `id_jenis`, `tanggal_masuk`, `id_ruang`, `status`, `kondisi`, `active`, `updated_at`) VALUES
(11, 'Laptop Core i3 Gen 10', 'Tetap', 1, '123.323.323.001', 'Acer Aspire', 6, '2023-02-01', '6', 'Ada', 'Baik', 1, '2023-02-22 16:42:09'),
(12, 'Kertas A4 10gram', 'Tidak Tetap', 50, '402.231.001', 'SiDu', 2, '2023-02-01', '9', 'Ada', 'Baik', 1, '2023-02-22 12:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `nomor_inventaris` varchar(100) NOT NULL,
  `namafile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id_foto`, `nomor_inventaris`, `namafile`) VALUES
(12, '123.323.323.001', '123.323.323.0011.jpg'),
(13, '123.323.323.001', '123.323.323.0012.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `nomor_inventaris` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `kode_pinjam` varchar(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `peminjam` varchar(50) NOT NULL,
  `operator` varchar(60) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `nomor_inventaris` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `nama`, `alamat`, `no_hp`, `foto`, `active`, `last_login`, `pinjam`) VALUES
(2, 'root', '$2y$05$nHq6Sagl3WrRlQNdAmos3.U7o1/08/5OCoISAjXs5jwrznBs2wCYi', 'Admin', 'Arief Kurniawan', 'Karanganyar RT 02 RW 01, Bejen, Bejen, Karanganyar, 574444', '6289670000000', 'root.jpg', 1, '2023-02-24 09:25:19', 0),
(7, 'K3514000', '$2y$05$UDhsJxOpVloG0nKDCMOtbOATCtq0HZTrGNtKhC9nrOhCie0f17hEC', 'Admin', 'Dwi Maryono, M.Pd', 'Colomadu', '', 'K3514000.jpg', 1, '2018-09-29 17:47:52', 0),
(20, 'andi', '$2y$05$sLA/2qrx5j8zAV9Rlt0.seU6d.LBnvnEBG/uvqVZQcaL5xRQel6qa', 'Staff', 'Andi Windu', 'jumantono', '090993123', 'andijpg', 1, '2023-02-24 08:57:20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

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
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
