-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2023 pada 17.22
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
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor_inventaris` varchar(50) NOT NULL,
  `nup` int(11) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `nilai` varchar(50) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `prodi` varchar(40) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_ruang` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pinjam` varchar(50) NOT NULL,
  `kondisi` varchar(19) NOT NULL,
  `active` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at_username` varchar(100) NOT NULL,
  `ip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `nomor_inventaris`, `nup`, `merk`, `nilai`, `id_jenis`, `prodi`, `tanggal_masuk`, `id_ruang`, `status`, `pinjam`, `kondisi`, `active`, `updated_at`, `updated_at_username`, `ip`) VALUES
(335, 'LCD Dell 14 Inch', '023.04.300.02.001', 1, 'Dell', '2000001', 6, 'PTIK', '2018-09-27', '15', 'Ada', 'Mahasiswa', 'Perbaikan', 0, '2019-02-19 13:03:34', '', ''),
(336, 'LCD Dell 14 Inch', '023.04.300.02.002', 2, 'Dell', '200000', 6, 'PTIK', '2018-09-27', '16', 'Ada', 'Dosen, Mahasiswa', 'Baik', 0, '2018-10-16 01:04:56', '', ''),
(338, 'Mesin CNC', '023.04.300.32.001', 0, '', '', 7, 'PTM', '2018-09-27', '62', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(339, 'CPU Core I3 Skylake 3450', '023.04.300.22.001', 0, '', '', 6, 'PTIK', '2018-09-27', '16', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(340, 'Meja Rapat', '023.04.300.03.001', 0, '', '', 1, 'PTIK', '2018-09-27', '15', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(341, 'Bunga Hias', '023.04.300.92.001', 0, '', '', 2, 'PTIK', '2018-09-27', '15', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(343, 'Proyektor Acer JET 9891', '123.04.300.02.001', 0, '', '', 6, 'Jurusan', '2018-09-27', '21', 'Ada', 'Dosen', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(345, 'Kabel Olor 20 Meter', '023.04.333.02.001', 0, '', '', 2, 'Jurusan', '2018-09-27', '21', 'Ada', 'Mahasiswa', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(346, 'Telepon', '023.04.320.02.001', 0, '', '', 4, 'PTIK', '2018-09-27', '15', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2019-02-19 12:17:58', 'K3514000', '::1'),
(347, 'Mesin Serabut', '023.04.344.02.001', 0, '', '', 7, 'PTM', '2018-09-28', '66', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(349, 'Geraji', '123.04.300.02.231', 0, '', '', 8, 'PTB', '2018-09-28', '57', 'Ada', 'Mahasiswa', 'Baik', 0, '2018-10-16 01:08:44', '', ''),
(354, 'Mesin Bubut', '023.04.300.02.098', 0, '', '', 7, 'PTM', '2018-09-29', '65', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(355, 'Keyboard Logitech X231', '023.04.342.02.001', 0, '', '', 6, 'PTIK', '2018-09-29', '15', 'Ada', 'Mahasiswa', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(356, 'Router CX090 12', '123.04.300.02.441', 0, '', '', 6, 'PTIK', '2018-09-29', '16', 'Ada', 'Mahasiswa', 'Baik', 0, '2019-02-19 14:32:12', '', ''),
(357, 'Meja Kayu Jati', '023.04.431.02.001', 0, '', '', 2, 'PTM', '2018-09-29', '27', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(358, 'Air Cooler Sharp', '023.04.300.02.981', 0, '', '', 5, 'PTIK', '2018-09-30', '23', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2018-10-15 12:27:40', '', ''),
(359, 'Router CX090', '023.04.300.02.991', 3, '', '', 6, 'PTIK', '2018-10-02', '15', 'Ada', 'Dosen', 'Baik', 0, '2018-10-15 13:35:19', '', ''),
(360, 'LCD Samsung 19 inch', '123.3213.312', 0, '', '', 6, 'PTIK', '2019-02-19', '15', 'Tidak Ada', 'Tidak bisa dipinjam', 'Hilang', 0, '2019-02-19 15:18:49', '', ''),
(361, 'LCD Samsung 19 inch', '123.3213.31223', 0, '', '', 4, 'PTIK', '2019-02-19', '15', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2019-02-19 12:32:12', '', ''),
(365, 'CPU CORE I7', '233.213.231.231', 0, '', '', 6, 'PTB', '2019-02-19', '28', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2019-02-19 15:22:13', '', ''),
(366, 'LCD Samsung 19 inch', '123.323.123.132', 0, '', '', 6, 'PTB', '2019-02-18', '39', 'Ada', 'Tidak bisa dipinjam', 'Baik', 0, '2019-02-19 15:22:46', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int(11) NOT NULL,
  `kode_peminjaman` varchar(20) NOT NULL,
  `nomor_inventaris` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `kode_peminjaman`, `nomor_inventaris`, `nama`) VALUES
(1, 'SIIBNRJPTK-0', '023.04.300.02.001', 'LCD Dell 14 Inch'),
(2, 'SIIBNRJPTK-0', '023.04.300.02.001', 'LCD Dell 14 Inch'),
(3, 'SIIBNRJPTK-1', '023.04.300.02.001', 'LCD Dell 14 Inch'),
(4, 'SIIBNRJPTK-1', '123.04.300.02.441', 'Router CX090');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_ruang`
--

CREATE TABLE `detail_ruang` (
  `id` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam1` time NOT NULL,
  `jam2` time NOT NULL,
  `keterangan` varchar(90) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pinjam` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_ruang`
--

INSERT INTO `detail_ruang` (`id`, `id_ruang`, `hari`, `tanggal`, `jam1`, `jam2`, `keterangan`, `username`, `pinjam`, `prodi`) VALUES
(14, 15, '', '2019-02-05', '11:11:00', '11:12:00', 'Seminar', '1234', '', 'PTIK'),
(19, 30, '', '2019-02-19', '18:00:00', '21:00:00', 'Seminar', '', 'Afif Nuruddin M', 'PTIK');

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

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id`, `nama`, `nomor_inventaris`, `nup`, `merk`, `id_jenis`, `prodi`, `tanggal_masuk`, `tanggal_hapus`, `username`) VALUES
(1, 'Geraji', '023.04.300.02.421', '0', '', '8', 'PTB', '2018-09-28', '2018-10-16', ''),
(2, 'Sharp PJ-A55TY-B Air Cooler - Hitam', '023.04.300.12.001', '0', '', '5', 'PTIK', '2018-09-27', '2018-10-16', ''),
(3, 'aa', 'asdsa', '0', '', '4', 'PTIK', '0000-00-00', '2019-02-19', 'K3514000'),
(4, 'test1', '123.12321', '0', '', '4', 'PTIK', '0000-00-00', '2019-02-19', 'root'),
(5, 'test2', '123.132.232', '0', '', '4', 'PTIK', '0000-00-00', '2019-02-19', 'root');

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
(1, 'Sistem Informasi Inventaris Barang & Ruang JPTK FKIP UNS', 'fav.ico', 'logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs_barang`
--

CREATE TABLE `logs_barang` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(50) NOT NULL,
  `IP` varchar(60) NOT NULL,
  `id_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `logs_barang`
--

INSERT INTO `logs_barang` (`id`, `keterangan`, `datetime`, `username`, `IP`, `id_barang`) VALUES
(13, 'ditambahkan kedaftar pinjaman mahasiswa', '2019-02-19 13:02:33', 'K3514003', '::1', '023.04.300.02.001'),
(14, 'ditambahkan kedaftar pinjaman mahasiswa', '2019-02-19 13:02:35', 'K3514003', '::1', '123.04.300.02.441'),
(15, 'akan dipinjam mahasiswa', '2019-02-19 13:02:51', 'K3514003', '::1', '023.04.300.02.001'),
(16, 'akan dipinjam mahasiswa', '2019-02-19 13:02:51', 'K3514003', '::1', '123.04.300.02.441'),
(17, 'barang dipinjam', '2019-02-19 13:03:22', 'K3514000', '::1', '023.04.300.02.001'),
(18, 'barang dipinjam', '2019-02-19 13:03:22', 'K3514000', '::1', '123.04.300.02.441'),
(19, 'barang telah dikembalikan', '2019-02-19 13:03:34', 'K3514000', '::1', '023.04.300.02.001'),
(20, 'barang telah dikembalikan', '2019-02-19 13:03:34', 'K3514000', '::1', '123.04.300.02.441'),
(21, 'Ditambahkan', '2019-02-19 13:26:30', 'K3514000', '::1', '123.12321'),
(22, 'Ditambahkan', '2019-02-19 13:28:32', 'K3514000', '::1', '123.132.232'),
(23, 'Diperbarui', '2019-02-19 14:32:12', 'K3514000', '::1', '356'),
(24, 'kondisi diperbarui menjadi Hilang', '2019-02-19 15:18:49', 'K3514000', '::1', '360'),
(25, 'Ditambahkan', '2019-02-19 15:22:13', 'root', '::1', '233.213.231.231'),
(26, 'Ditambahkan', '2019-02-19 15:22:46', 'root', '::1', '123.323.123.132');

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

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`kode_peminjaman`, `username`, `tanggal_pinjam`, `tanggal_pengembalian`, `keperluan`, `status`, `prodi`, `catatan`) VALUES
('SIIBNRJPTK-0', 'K3514003', '2019-02-19 19:55:39', '2019-02-19 13:01:18', 'aa', 2, 'PTIK', 'aa'),
('SIIBNRJPTK-1', 'K3514003', '2019-02-19 20:02:51', '2019-02-19 13:03:34', 'pinjam', 2, 'PTIK', 'oke');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `prodi` varchar(40) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `prodi`, `awal`, `akhir`) VALUES
(1, 'PTIK', '2019-02-01', '2019-02-28'),
(2, 'PTB', '0000-00-00', '0000-00-00'),
(3, 'PTM', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `prodi2` varchar(20) NOT NULL,
  `kegunaan` varchar(40) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `ruang`, `prodi2`, `kegunaan`, `kapasitas`) VALUES
(15, 'Lab. Komputer Lantai 1 Gedung A', 'PTIK', 'Perkuliahan', 30),
(16, 'Lab. Komputer Lantai 2 Gedung B', 'PTIK', 'Perkuliahan', 30),
(21, 'Ruang Administrasi Lantai 1 Gedung A', 'Jurusan', 'Ruang Karyawan', 30),
(23, 'Ruang Kepala Prodi Lantai 1 Gedung A', 'PTIK', 'Ruang Dosen', 30),
(28, 'Ruang Dosen 1 Lantai 1 Gedung A', 'PTIK', 'Ruang Dosen', 30),
(29, 'Ruang Dosen 2 Lantai 1 Gedung A', 'PTIK', 'Ruang Dosen', 30),
(30, 'Ruang Sidang 1 Lantai 1 Gedung A', 'Jurusan', 'Seminar/Sidang/Mikro', 30),
(31, 'Ruang Baca Lantai 1 Gedung A', 'Jurusan', 'Umum', 30),
(32, 'Aula Lobby Lantai 1 Gedung A', 'Jurusan', 'Umum', 30),
(33, 'Ruang Dosen 1 Lantai 2 Gedung A', 'PTB', 'Ruang Dosen', 30),
(34, 'Ruang Dosen 2 Lantai 2 Gedung A', 'PTB', 'Ruang Dosen', 30),
(35, 'Ruang Kepala Prodi Lantai 2 Gedung A', 'PTB', 'Ruang Dosen', 30),
(36, 'Ruang Dosen 2 Lantai 1 Gedung A', 'PTM', 'Ruang Dosen', 30),
(37, 'Ruang Dosen 2 Lantai 2 Gedung A', 'PTM', 'Ruang Dosen', 30),
(38, 'Ruang Kepala Prodi Lantai 2 Gedung A', 'PTM', 'Ruang Dosen', 30),
(39, 'Ruang Gambar Lantai 3 Gedung A', 'PTB', 'Perkuliahan', 30),
(41, 'Ruang Studio Lantai 3 Gedung A', 'PTIK', 'Umum', 30),
(42, 'Ruang Sidang 1 Lantai 3 Gedung A', 'Jurusan', 'Seminar/Sidang/Mikro', 30),
(43, 'Ruang Sidang 2 Lantai 3 Gedung A', 'Jurusan', 'Seminar/Sidang/Mikro', 30),
(44, 'Ruang Micro 1 Lantai 3 Gedung A', 'Jurusan', 'Seminar/Sidang/Mikro', 30),
(45, 'Ruang Micro 2 Lantai 3 Gedung A', 'Jurusan', 'Seminar/Sidang/Mikro', 30),
(46, 'Ruang Seminar 1 Lantai 3 Gedung A', 'Jurusan', 'Seminar/Sidang/Mikro', 30),
(47, 'Ruang Seminar 2 Lantai 3 Gedung A', 'Jurusan', 'Seminar/Sidang/Mikro', 30),
(48, 'Aula Lantai 4 Gedung A', 'Jurusan', 'Umum', 30),
(49, 'Ruang Kuliah 1 Lantai 4 Gedung A', 'PTB', 'Perkuliahan', 30),
(50, 'Ruang Kuliah 2 Lantai 4 Gedung A', 'PTB', 'Perkuliahan', 30),
(51, 'Ruang Kuliah 1 Lantai 4 Gedung A', 'PTM', 'Perkuliahan', 30),
(52, 'Ruang Kuliah 2 Lantai 4 Gedung A', 'PTM', 'Perkuliahan', 30),
(53, 'Ruang Kuliah 3 Lantai 1 Gedung B', 'PTM', 'Perkuliahan', 30),
(54, 'Ruang Kuliah 1 Lantai 1 Gedung B', 'PTIK', 'Perkuliahan', 30),
(55, 'Ruang Kuliah 2 Lantai 1 Gedung B', 'PTIK', 'Perkuliahan', 30),
(56, 'Ruang Kuliah 3 Lantai 1 Gedung B', 'PTIK', 'Perkuliahan', 30),
(57, 'Ruang Gambar Lantai 2 Gedung B', 'PTB', 'Perkuliahan', 30),
(59, 'Ruang Kuliah 3 Lantai 1 Gedung C', 'PTB', 'Perkuliahan', 30),
(62, 'Bengkel CNC', 'PTM', 'Perkuliahan', 30),
(63, 'Las', 'PTM', 'Perkuliahan', 30),
(64, 'Ruang Kerja Bangku', 'PTM', 'Perkuliahan', 30),
(65, 'Bubut', 'PTM', 'Perkuliahan', 30),
(66, 'Bengkel Otomotif', 'PTM', 'Perkuliahan', 30);

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
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_ruang`
--
ALTER TABLE `detail_ruang`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `logs_barang`
--
ALTER TABLE `logs_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kode_peminjaman`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;

--
-- AUTO_INCREMENT untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `detail_ruang`
--
ALTER TABLE `detail_ruang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `logs_barang`
--
ALTER TABLE `logs_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
