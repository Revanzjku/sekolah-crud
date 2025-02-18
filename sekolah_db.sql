-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2025 at 02:51 PM
-- Server version: 10.6.20-MariaDB-cll-lve
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `revansok_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'XI PPLG 1'),
(2, 'XI PPLG 2'),
(3, 'X PPLG 1'),
(6, 'X PPLG 2'),
(9, 'XI TPFL');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `Id_kelas` int(11) NOT NULL,
  `id_wali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_siswa`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `Id_kelas`, `id_wali`) VALUES
(1, '2333631', 'Revans Satria Putra', 'L', 'Semarang', '2007-10-05', 2, 1),
(2, '2333619', 'Imanuel Tegar N.I.A', 'L', 'Semarang', '2008-01-09', 2, 9),
(3, '2333625', 'Ndaru Ady Prasetia', 'L', 'Semarang', '2007-06-06', 2, 3),
(6, '2333608', 'Ahmad Faisal', 'L', 'Demak', '2008-07-07', 2, 5),
(7, '2333618', 'Erlan Eka Putra Susanto', 'L', 'Semarang', '6666-06-06', 2, 6),
(11, '2333635', 'Sayyid Muhammad Toha Kailani', 'L', 'Semarang', '2007-01-05', 2, 7),
(12, '8787897', 'Ambalingham', 'L', 'Jomokerto', '1211-12-12', 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `wali_murid`
--

CREATE TABLE `wali_murid` (
  `id_wali` int(11) NOT NULL,
  `nama_wali` varchar(100) NOT NULL,
  `kontak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wali_murid`
--

INSERT INTO `wali_murid` (`id_wali`, `nama_wali`, `kontak`) VALUES
(1, 'Revans', '082140451890'),
(2, 'Mr Tegar', '0882007014511'),
(3, 'Ndaru', '0882007014511'),
(5, 'Ahmad', '0882007014511'),
(6, 'Eka', '0895392078050'),
(7, 'Muhammad Yasin', '08561264026'),
(8, 'Suhadi', '8089809898'),
(9, 'JOKOWI', '08132415898');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`,`nis`),
  ADD KEY `id_kelas_fk` (`Id_kelas`),
  ADD KEY `id_wali_fk` (`id_wali`);

--
-- Indexes for table `wali_murid`
--
ALTER TABLE `wali_murid`
  ADD PRIMARY KEY (`id_wali`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wali_murid`
--
ALTER TABLE `wali_murid`
  MODIFY `id_wali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `id_kelas_fk` FOREIGN KEY (`Id_kelas`) REFERENCES `kelas` (`id_kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_wali_fk` FOREIGN KEY (`id_wali`) REFERENCES `wali_murid` (`id_wali`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
