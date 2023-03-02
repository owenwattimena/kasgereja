-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 03:53 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `kode` int(11) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `thn_perolehan` varchar(20) NOT NULL,
  `harga` int(20) NOT NULL,
  `kondisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`kode`, `nama_brg`, `jumlah`, `thn_perolehan`, `harga`, `kondisi`) VALUES
(21, 'pengadaan trompet', 8, '2020', 5000000, 'Baik'),
(22, 'pengadan soun sistem', 5, '2020', 10000000, 'Baik'),
(23, 'printer', 1, '2020', 1500000, 'Baik'),
(24, 'keyboard', 2, '2020', 4500000, 'kurang baik');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `kode` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(10) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `keluar` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`kode`, `keterangan`, `tgl`, `jumlah`, `jenis`, `keluar`) VALUES
(1, 'Kolektan Ibadah Minggu', '2021-01-03', 3116000, 'masuk', 0),
(2, 'Perpuluhan', '2021-01-07', 7583000, 'masuk', 0),
(3, 'Kolektan Ibadah ,pelayanan laki-laki,sektor emaus ', '2021-01-03', 168000, 'masuk', 0),
(4, 'Kolektan Ibadah pelayanan perempuan,sektor emaus', '2021-01-03', 130000, 'masuk', 0),
(5, 'Kolektan Ibadah SMTPI', '2021-01-03', 620500, 'masuk', 0),
(6, 'Kolektan Ibadah unit sektor emaus', '2021-01-03', 270000, 'masuk', 0),
(7, 'Kolektan Ibadah syukuran HUT seorang anak emaus ', '2021-01-23', 100000, 'masuk', 0),
(8, 'Kolektan Ibadah pernikahan', '2021-01-26', 200000, 'masuk', 0),
(11, 'biaya khotba', '2021-01-03', 0, 'keluar', 900000),
(12, 'konsumsi mingguan', '2021-01-03', 0, 'keluar', 350000),
(13, 'pelayanan orang sakit ibu eci wattimena E1', '2021-01-05', 0, 'keluar', 300000),
(14, 'token listrik gereja elohim latta', '2021-01-03', 0, 'keluar', 2050000),
(15, 'foto copy tata ibada pemakaman ', '2021-01-11', 0, 'keluar', 180000),
(16, 'foto copy warta', '2021-01-03', 0, 'keluar', 456000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `username`, `nama`, `password`, `level`, `foto`) VALUES
(1, 'admin', 'admin', 'admin123', 'admin', 'admin.png'),
(2, 'klasis', 'klasis', 'klasis123', 'klasis', 'user1.png'),
(3, 'sinode', 'sinode', 'sinode123', 'sinode', 'user2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Klasis','Sinode','') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id`, `username`, `nama_lengkap`, `password`, `level`, `foto`) VALUES
(1, 'admin', 'Administrator Jemaat ', 'admin123', 'Admin', 'admin.png'),
(2, 'klasis', 'Klasis GPM', 'klasis123', 'Klasis', 'user2.png'),
(3, 'sinode', 'Sinode GPM', 'sinode123', 'Sinode', 'user1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
