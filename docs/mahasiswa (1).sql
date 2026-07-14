-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2026 at 06:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uniska_latihan_mvc_2026`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `npm` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `jurusan` enum('Teknik Informatika','Sistem Informasi') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `status_id` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `npm`, `nama_lengkap`, `fakultas`, `jurusan`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `status_id`, `created_at`, `updated_at`) VALUES
(2, '2310010002', 'Renata', 'Teknologi Informasi', 'Sistem Informasi', 'Banjarbaru', '2005-03-01', 'Perempuan', 1, '2026-07-08 12:46:18', '2026-07-08 17:07:11'),
(4, '2410010001', 'Rizky Muhammad', 'Teknologi Informasi', 'Teknik Informatika', 'Banjarmasin', '2006-03-12', 'Laki-laki', 1, '2026-07-08 14:40:18', '2026-07-08 14:40:18'),
(5, '2410010002', 'Eka Aditya', 'Teknologi Informasi', 'Teknik Informatika', 'Banjarbaru', '2005-03-11', 'Laki-laki', 1, '2026-07-08 14:40:18', '2026-07-08 15:43:00'),
(6, '2410010003', 'Taufik Hidayat', 'Teknologi Informasi', 'Teknik Informatika', 'Martapura', '2003-11-05', 'Laki-laki', 1, '2026-07-08 14:40:18', '2026-07-08 14:40:18'),
(7, '2410010191', 'Raditya', 'Teknologi Informasi', 'Sistem Informasi', 'Banjarmasin', '2004-03-03', 'Laki-laki', 1, '2026-07-08 16:05:48', '2026-07-08 17:05:16'),
(8, '2310040005', 'Andika', 'Teknologi Informasi', 'Sistem Informasi', 'Jakarta', '2002-12-12', 'Laki-laki', 1, '2026-07-10 15:31:46', '2026-07-10 15:31:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npm` (`npm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
