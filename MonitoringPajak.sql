-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2019 at 03:09 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MonitoringPajak`
--

-- --------------------------------------------------------

--
-- Table structure for table `Akun`
--

CREATE TABLE `Akun` (
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `JenisAkun` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Akun`
--

INSERT INTO `Akun` (`Username`, `Password`, `JenisAkun`) VALUES
('admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Rekening`
--

CREATE TABLE `Rekening` (
  `NomorRekening` varchar(13) NOT NULL,
  `JenisPajak` varchar(25) NOT NULL,
  `SubJenisPajak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Transaksi`
--

CREATE TABLE `Transaksi` (
  `NPWPD` varchar(13) NOT NULL,
  `NomorTransaksi` varchar(50) NOT NULL,
  `JenisPajak` varchar(25) NOT NULL,
  `TotalTransaksi` varchar(25) NOT NULL,
  `Pajak` varchar(25) NOT NULL,
  `SubNominal` varchar(25) NOT NULL,
  `Servis` varchar(25) NOT NULL,
  `Diskon` varchar(15) NOT NULL,
  `WaktuTransaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `WajibPajak`
--

CREATE TABLE `WajibPajak` (
  `NPWPD` varchar(13) NOT NULL,
  `NamaWP` varchar(50) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `JenisPajak` varchar(25) NOT NULL,
  `SubJenisPajak` varchar(25) NOT NULL,
  `NomorRekening` varchar(13) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `RiwayatData` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Akun`
--
ALTER TABLE `Akun`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `Rekening`
--
ALTER TABLE `Rekening`
  ADD PRIMARY KEY (`NomorRekening`);

--
-- Indexes for table `Transaksi`
--
ALTER TABLE `Transaksi`
  ADD PRIMARY KEY (`NomorTransaksi`),
  ADD KEY `NPWPD` (`NPWPD`);

--
-- Indexes for table `WajibPajak`
--
ALTER TABLE `WajibPajak`
  ADD PRIMARY KEY (`NPWPD`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Transaksi`
--
ALTER TABLE `Transaksi`
  ADD CONSTRAINT `Transaksi_ibfk_1` FOREIGN KEY (`NPWPD`) REFERENCES `WajibPajak` (`NPWPD`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
