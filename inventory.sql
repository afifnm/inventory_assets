-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2023 pada 18.19
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

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
-- Struktur dari tabel `aset`
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
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`id_aset`, `nama`, `aset`, `stok`, `nomor_inventaris`, `merk`, `id_jenis`, `tanggal_masuk`, `id_ruang`, `status`, `kondisi`, `active`, `updated_at`) VALUES
(5, 'Laptop Core i3 Gen 11', 'Tetap', 1, '123.323.323.001', 'Acer', 6, '2023-02-20', '9', 'Ada', 'Baik', 1, '2023-02-20 16:59:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `nomor_inventaris` varchar(100) NOT NULL,
  `namafile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor_inventaris` varchar(50) NOT NULL,
  `nup` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `id_jenis` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_hapus` date NOT NULL,
  `username` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `jenis`) VALUES
(1, 'Peralatan Kantor'),
(2, 'Perabot Kantor'),
(4, 'Alat Komunikasi'),
(5, 'Perabot Kantor Tempelan'),
(6, 'Paket Komputer'),
(7, 'Mesin-Mesin'),
(8, 'Perkakas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id` int(11) NOT NULL,
  `nama_website` varchar(80) NOT NULL,
  `favicon` varchar(80) NOT NULL,
  `logo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id`, `nama_website`, `favicon`, `logo`) VALUES
(1, 'Sistem Informasi Inventaris Aset', 'fav.ico', 'logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs_aset`
--

CREATE TABLE `logs_aset` (
  `id_logs_aset` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(50) NOT NULL,
  `IP` varchar(60) NOT NULL,
  `nomor_inventaris` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `logs_aset`
--

INSERT INTO `logs_aset` (`id_logs_aset`, `keterangan`, `datetime`, `username`, `IP`, `nomor_inventaris`) VALUES
(1, 'Ditambahkan', '2023-02-20 16:52:09', 'root', '127.0.0.1', '123..323.323.001'),
(2, 'Ditambahkan', '2023-02-20 16:52:52', 'root', '127.0.0.1', '123..323.323.001'),
(3, 'Ditambahkan', '2023-02-20 16:58:32', 'root', '127.0.0.1', '123..323.323.001'),
(4, 'Ditambahkan', '2023-02-20 16:59:16', 'root', '127.0.0.1', '123.323.323.001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kode_peminjaman` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal_pinjam` datetime NOT NULL,
  `tanggal_pengembalian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keperluan` text NOT NULL,
  `status` int(11) NOT NULL,
  `prodi` varchar(10) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruang`
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
-- Struktur dari tabel `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `nomor_inventaris` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Dosen','Mahasiswa','Admin') NOT NULL,
  `nama` varchar(70) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `nama`, `prodi`, `angkatan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_hp`, `foto`, `active`, `last_login`, `pinjam`) VALUES
(2, 'root', '$2y$05$6DMzgP8rt3VpsoqvY0TMkedK7vY2SriSGE7YXrdkPG7c8LVs3juIm', 'Admin', 'Senen', 'Jurusan', '2012', 'Karanganyar', '1996-09-02', 'Karanganyar RT 02 RW 01, Bejen, Bejen, Karanganyar, 574444', 'agusefendi@staff.uns.ac.id', '6289670000000', 'root.jpg', 1, '2018-10-04 09:40:55', 0),
(3, 'K3514001', '$2y$05$y5Z3nZS3WBU11f2ZBqZZguK33R75fuPv4Oc2bozbf1E.ZGAE8hywe', 'Mahasiswa', 'Abdur Rahman Yusuf', 'PTIK', '2014', 'Sukoharjo', '2018-09-25', 'Sukoharjo', 'abdur@student.uns.ac.id', '089054634', 'K3514001.jpg', 1, '2018-09-27 15:42:57', 0),
(4, 'K3514002', '$2y$05$sfWiAxw0hM3fudQt/jNW..ZEfkVG4ne59ooH7ppyvI4oICPxWM3X.', 'Mahasiswa', 'Adi Prakoso', 'PTIK', '2014', 'Jakarta', '0000-00-00', '', '', '', 'K3514002.jpg', 0, '2018-09-27 15:43:02', 0),
(5, 'K3514003', '$2y$05$E6cvam62HaVPMszZTjWMoe48UBVmQMov05GvIkBg5Cjp2GWT7E9/e', 'Mahasiswa', 'Afif Nuruddin Maisaroh', 'PTIK', '2014', 'Sukoharjo', '1996-06-08', 'Suruh RT 02 RW 01, Kayuapak, Polokarto, Sukoharjo, 57555', 'afifnuruddinmaisaroh@gmail.com', '089673333318', 'K3514003.jpg', 1, '2019-02-19 20:03:34', 4),
(7, 'K3514000', '$2y$05$UDhsJxOpVloG0nKDCMOtbOATCtq0HZTrGNtKhC9nrOhCie0f17hEC', 'Admin', 'Dwi Maryono, M.Pd', 'PTIK', '2010', 'Colomadu', '1960-09-05', 'Colomadu', 'dwimar@staff.uns.ac.id', '', 'K3514000.jpg', 1, '2018-09-29 17:47:52', 0),
(10, 'N3514001', '$2y$05$yYDF2/1AuxRhVz125LoHUOLjyP6X5uD23AZGsFkFh3JLt0zuHvYca', 'Mahasiswa', 'Andysti Kusuma', 'PTB', '2014', '', '0000-00-00', '', '', '', 'N35140001.jpg', 1, '2018-10-16 09:37:38', 0),
(16, 'M3514001', '$2y$05$XggkNBdPcMzXv90n3XVN9uf.hI5pCvpN7p2AQBMMah9zcRKgxxug2', 'Mahasiswa', 'Panji', 'PTM', '', '', '0000-00-00', '', '', '', 'M3514001.jpg', 1, '2018-09-29 00:11:13', 0),
(17, '1234', '$2y$05$XL4qDO06xE9FVURQL/FA0uk.Rjv.DWbUM2fRMR.CLFDl.1lUDLaI.', 'Dosen', 'Agus Efendi', 'PTIK', '', '', '0000-00-00', '', '', '0896733318', '1234.jpg', 1, '2019-02-19 18:45:02', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logs_aset`
--
ALTER TABLE `logs_aset`
  ADD PRIMARY KEY (`id_logs_aset`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kode_peminjaman`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indeks untuk tabel `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `logs_aset`
--
ALTER TABLE `logs_aset`
  MODIFY `id_logs_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
