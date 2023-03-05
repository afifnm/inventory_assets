-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Mar 2023 pada 17.29
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
(11, 'Laptop Core i3 Gen 10', 'Tetap', 1, '123.323.323.001', 'Acer Aspire', 6, '2023-02-01', '6', 'Ada', 'Baik', 1, '2023-03-05 16:14:36'),
(12, 'Kertas A4 10gram', 'Tidak Tetap', 50, '402.231.001', 'SiDu', 2, '2023-02-01', '9', 'Ada', 'Baik', 1, '2023-02-22 12:54:35'),
(13, 'Laptop Core i5', 'Tetap', 1, '000.232.122', 'Dell', 6, '2023-03-02', '9', 'Dipinjam', 'Baik', 1, '2023-03-05 16:22:07'),
(14, 'Gamestick Rexus', 'Tetap', 1, '123.3123.111', 'Rexus', 6, '2023-03-05', '9', 'Ada', 'Rusak', 1, '2023-03-05 16:14:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_detail_pinjam` int(11) NOT NULL,
  `kode_pinjam` varchar(20) NOT NULL,
  `nomor_inventaris` varchar(20) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` int(11) NOT NULL,
  `kondisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id_detail_pinjam`, `kode_pinjam`, `nomor_inventaris`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `kondisi`) VALUES
(3, '20230305072348', '123.323.323.001', '2023-03-05', '2023-03-05', 1, 'Baik'),
(4, '20230305072348', '123.3123.111', '2023-03-05', '2023-03-05', 1, 'Rusak'),
(5, '20230305171040', '123.323.323.001', '2023-03-05', '2023-03-05', 1, 'Baik'),
(6, '20230305171040', '123.3123.111', '2023-03-05', '2023-03-05', 1, 'Rusak'),
(7, '20230305172221', '000.232.122', '2023-03-05', '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `nomor_inventaris` varchar(100) NOT NULL,
  `namafile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`id_foto`, `nomor_inventaris`, `namafile`) VALUES
(12, '123.323.323.001', '123.323.323.0011.jpg'),
(13, '123.323.323.001', '123.323.323.0012.jpg');

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
(5, 'Perabot Kantor'),
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
-- Struktur dari tabel `logs`
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

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id_logs`, `tabel`, `keterangan`, `datetime`, `username`, `IP`, `nomor_inventaris`) VALUES
(1, 'aset', 'Arief Kurniawan telah menambahkan Laptop Core i5 dengan nomor inventaris 000.232.122', '2023-03-02 06:55:08', 'root', '127.0.0.1', '000.232.122'),
(2, 'aset', 'Arief Kurniawan telah menambahkan Gamestick Rexus dengan nomor inventaris 123.3123.111', '2023-03-05 05:37:15', 'root', '127.0.0.1', '123.3123.111'),
(3, 'aset', 'Budi telah meminjam Laptop Core i3 Gen 10 dengan nomor inventaris 123.323.323.001 pada tanggal 05-Mar-2023', '2023-03-05 06:23:48', 'root', '127.0.0.1', '123.323.323.001'),
(4, 'aset', 'Budi telah meminjam Gamestick Rexus dengan nomor inventaris 123.3123.111 pada tanggal 05-Mar-2023', '2023-03-05 06:23:48', 'root', '127.0.0.1', '123.3123.111'),
(5, 'aset', 'Budi telah mengembalikan aset dengan nomor inventaris 123.3123.111 pada tanggal 05-Mar-2023 dalam keadaan Baik', '2023-03-05 12:41:30', 'root', '127.0.0.1', '123.3123.111'),
(6, 'aset', 'Budi telah mengembalikan aset dengan nomor inventaris 123.3123.111 pada tanggal 05-Mar-2023 dalam keadaan Baik', '2023-03-05 12:42:49', 'root', '127.0.0.1', '123.3123.111'),
(7, 'aset', 'Budi telah mengembalikan aset dengan nomor inventaris 123.3123.111 pada tanggal 05-Mar-2023 dalam keadaan Baik', '2023-03-05 12:42:50', 'root', '127.0.0.1', '123.3123.111'),
(8, 'aset', 'Budi telah mengembalikan aset dengan nomor inventaris 123.3123.111 pada tanggal 05-Mar-2023 dalam keadaan Baik', '2023-03-05 12:43:02', 'root', '127.0.0.1', '123.3123.111'),
(9, 'aset', 'Budi telah mengembalikan aset dengan nomor inventaris 123.323.323.001 pada tanggal 05-Mar-2023 dalam keadaan Rusak', '2023-03-05 12:48:19', 'root', '127.0.0.1', '123.323.323.001'),
(10, 'aset', 'Afif telah meminjam Laptop Core i3 Gen 10 dengan nomor inventaris 123.323.323.001 pada tanggal 05-Mar-2023', '2023-03-05 16:10:40', 'root', '127.0.0.1', '123.323.323.001'),
(11, 'aset', 'Afif telah meminjam Gamestick Rexus dengan nomor inventaris 123.3123.111 pada tanggal 05-Mar-2023', '2023-03-05 16:10:40', 'root', '127.0.0.1', '123.3123.111'),
(12, 'aset', 'Afif telah mengembalikan aset dengan nomor inventaris 123.3123.111 pada tanggal 05-Mar-2023 dalam keadaan Rusak', '2023-03-05 16:14:24', 'root', '127.0.0.1', '123.3123.111'),
(13, 'aset', 'Afif telah mengembalikan aset dengan nomor inventaris 123.323.323.001 pada tanggal 05-Mar-2023 dalam keadaan Baik', '2023-03-05 16:14:36', 'root', '127.0.0.1', '123.323.323.001'),
(14, 'aset', 'Dwi telah meminjam Laptop Core i5 dengan nomor inventaris 000.232.122 pada tanggal 05-Mar-2023', '2023-03-05 16:22:21', 'root', '127.0.0.1', '000.232.122');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `kode_pinjam` varchar(50) NOT NULL,
  `peminjam` varchar(50) NOT NULL,
  `username` varchar(60) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal_pinjam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`kode_pinjam`, `peminjam`, `username`, `keterangan`, `status`, `tanggal_pinjam`) VALUES
('20230305072348', 'Budi', 'root', 'untuk input data raport', 0, '2023-03-05'),
('20230305171040', 'Afif', 'root', 'UKK', 0, '2023-03-05'),
('20230305172221', 'Dwi', 'root', 'buat ngerjain tugas', 0, '2023-03-05');

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
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_kembali`
--

CREATE TABLE `temp_kembali` (
  `id_temp_kembali` int(11) NOT NULL,
  `nomor_inventaris` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `nama`, `alamat`, `no_hp`, `foto`, `active`, `last_login`, `pinjam`) VALUES
(2, 'root', '$2y$05$nHq6Sagl3WrRlQNdAmos3.U7o1/08/5OCoISAjXs5jwrznBs2wCYi', 'Admin', 'Arief Kurniawan', 'Karanganyar RT 02 RW 01, Bejen, Bejen, Karanganyar, 574444', '6289670000000', 'root.jpg', 1, '2023-02-24 09:25:19', 0),
(7, 'K3514000', '$2y$05$UDhsJxOpVloG0nKDCMOtbOATCtq0HZTrGNtKhC9nrOhCie0f17hEC', 'Admin', 'Dwi Maryono, M.Pd', 'Colomadu', '', 'K3514000.jpg', 1, '2018-09-29 17:47:52', 0),
(20, 'andi', '$2y$05$sLA/2qrx5j8zAV9Rlt0.seU6d.LBnvnEBG/uvqVZQcaL5xRQel6qa', 'Staff', 'Andi Windu', 'jumantono', '090993123', 'andijpg', 1, '2023-02-24 08:57:20', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indeks untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id_detail_pinjam`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

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
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_logs`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`kode_pinjam`);

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
-- Indeks untuk tabel `temp_kembali`
--
ALTER TABLE `temp_kembali`
  ADD PRIMARY KEY (`id_temp_kembali`);

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
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id_detail_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `temp_kembali`
--
ALTER TABLE `temp_kembali`
  MODIFY `id_temp_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
