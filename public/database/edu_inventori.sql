-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2022 at 10:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edu_inventori`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(10) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `stok` int(10) NOT NULL,
  `keterangan` text NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `id_supplier` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama`, `stok`, `keterangan`, `id_kategori`, `id_supplier`) VALUES
(3, 'BRS-1  ', 'Beras', 160, 'Beras Raja Lele 10 Kg.', 6, 5),
(4, 'TRG', 'TeriguKu', 80, 'Terigu Rose Bran', 8, 5),
(5, 'MK-1 ', 'Masako Ayam', 0, 'Masako bumbu untuk masak', 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(10) NOT NULL,
  `no_order` varchar(10) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_barang` int(10) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `no_order`, `tanggal_keluar`, `id_barang`, `customer`, `jumlah`, `keterangan`) VALUES
(6, 'OT-1', '2022-10-01', 3, 'Eduardo Kharisma Rikin', 20, 'Beras 20 karung beras'),
(7, 'OT-2', '2022-10-31', 3, 'Eduardo Kharisma Rikin', 20, 'Beras 20 karung beras'),
(8, 'OT-3', '2022-10-01', 4, 'Eduardo Kharisma Rikin', 20, 'Terigu terjual'),
(9, 'OT-4', '2022-10-31', 4, 'Eduardo Kharisma Rikin', 20, 'Terigu terjual 20 box');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `hapus_keluar` AFTER DELETE ON `barang_keluar` FOR EACH ROW BEGIN
	UPDATE barang SET stok = stok + OLD.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
	UPDATE barang SET stok = stok - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubah_keluar` AFTER UPDATE ON `barang_keluar` FOR EACH ROW BEGIN
	UPDATE barang SET stok = ( stok + OLD.jumlah ) - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(10) NOT NULL,
  `no_order` varchar(10) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_barang` int(10) NOT NULL,
  `id_supplier` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `no_order`, `tanggal_masuk`, `id_barang`, `id_supplier`, `jumlah`, `keterangan`) VALUES
(6, 'PO-1', '2022-10-01', 3, 5, 100, 'Masuk 100 karung beras'),
(7, 'PO-2', '2022-10-02', 3, 5, 100, 'Masuk 100 karung beras'),
(8, 'PO-3', '2022-10-01', 4, 5, 100, 'Terigu masuk 100 box'),
(9, 'PO-4', '2022-10-31', 4, 5, 20, 'Terigu masuk 20 box');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `hapus_masuk` AFTER DELETE ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang SET stok = stok - OLD.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang SET stok = stok + NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubah_masuk` AFTER UPDATE ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang SET stok = ( stok - OLD.jumlah ) + NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(6, 'Kilogram'),
(7, 'Pcs'),
(8, 'Box'),
(9, 'Satuan');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(10) NOT NULL,
  `nama_level` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(101, 'Administrator'),
(102, 'Kepala Gudang'),
(103, 'Staff Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(13) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `nama`, `jabatan`, `username`, `password`, `foto`, `email`, `id_level`) VALUES
(2, 'Admin Eduhoster', 'Administrasi', 'admin', '$2y$10$2AuH.FD7HD5sQoXvvKBES.hfXAyz1PEvDCNzGBw28AVDeAi8rGay6', '', 'eduardo.kharismaaaaa@gmail.com', 101),
(3, 'Kepala Eduhoster', 'Kepala Gudang', 'kepala', '$2y$10$8cdRYNBDuE1MosVrN3.VBu6g1bjzOXyRsa1tkj6ipaVOTKpS4zeZO', '', 'eduardo.kharismaaaaa@gmail.com', 102),
(4, 'Staff Eduhoster', 'Staff Gudang', 'staff', '$2y$10$ZBADtJPNMyRvNhQfU6verOb4TBxykasRCB23Cwht2GvjzuAx5SBUK', '', 'eduardo.kharismaaaaa@gmail.com', 103);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kota` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `kota`) VALUES
(5, 'PT Makmur Abadi', 'Jakarta Barat'),
(6, 'PT Ingin Sukses Selalu', 'Tangerang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
