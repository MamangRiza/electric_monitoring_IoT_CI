-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2020 pada 14.29
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pln`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `foto`) VALUES
(1, 'admin', '21232F297A57A5A743894A0E4A801FC3', 'Riza Irsyad', 'profil2.jpg'),
(2, 'ozil', 'f4e404c7f815fc68e7ce8e3c2e61e347', 'Mesut ', 'profil2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `appliance`
--

CREATE TABLE `appliance` (
  `appliance_id` int(11) NOT NULL,
  `appliance_name` varchar(255) NOT NULL,
  `watt` float DEFAULT NULL,
  `volt` float DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `trainwith` varchar(255) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `appliance`
--

INSERT INTO `appliance` (`appliance_id`, `appliance_name`, `watt`, `volt`, `photo`, `created`, `updated`, `trainwith`) VALUES
(1, 'Solder', 26.3, NULL, '1566101375391.jpg', '2019-08-10 19:17:28', '2019-08-18 04:33:10', 'NO'),
(2, 'Kipas Angin Meja', 15, NULL, '1565573537434.jpg', '2019-08-12 01:32:17', '2019-08-12 01:35:25', 'NO'),
(3, 'Charger Laptop Lenovo', 30.4, NULL, '1565573803184.jpg', '2019-08-12 01:36:43', '2019-08-13 00:52:47', 'NO'),
(10, 'TV', NULL, NULL, '1566097338471.jpg', '2019-08-18 03:02:18', '2019-08-18 03:02:18', 'NO'),
(11, 'Solders', NULL, NULL, '1566097421224.jpg', '2019-08-18 03:03:41', '2019-08-18 03:03:41', 'NO'),
(12, 'Kulkas', NULL, NULL, '1566097519453.jpg', '2019-08-18 03:05:19', '2019-08-18 03:05:19', 'NO'),
(13, 'Glue Gun', NULL, NULL, '1566168041132.jpg', '2019-08-18 22:40:41', '2019-08-18 22:40:41', 'NO'),
(14, 'Solders1', NULL, NULL, '1566192709076.jpg', '2019-08-19 05:31:49', '2019-08-19 05:31:49', 'NO'),
(15, 'TVs', NULL, NULL, '1566192782967.jpg', '2019-08-19 05:33:03', '2019-08-19 05:33:03', 'NO'),
(16, 'Solders12', NULL, NULL, '1566192841486.jpg', '2019-08-19 05:34:01', '2019-08-19 05:34:01', 'NO'),
(17, 'Setrika', NULL, NULL, '1566192856268.jpg', '2019-08-19 05:34:16', '2019-08-19 05:34:16', 'NO'),
(18, 'Solders123', NULL, NULL, '1566204528642.jpg', '2019-08-19 08:48:48', '2019-08-19 08:48:48', 'NO'),
(19, 'TV1', NULL, NULL, '1566204778274.PNG', '2019-08-19 08:52:58', '2019-08-19 08:52:58', 'NO'),
(20, 'SolderKKKK', NULL, NULL, '1566204798125.jpg', '2019-08-19 08:53:18', '2019-08-19 08:53:18', 'NO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `appliancedevice`
--

CREATE TABLE `appliancedevice` (
  `appliancedevice_id` int(11) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `appliance_id` int(11) NOT NULL,
  `max_kwh` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_active` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `appliancedevice`
--

INSERT INTO `appliancedevice` (`appliancedevice_id`, `device_id`, `appliance_id`, `max_kwh`, `created`, `updated`, `last_active`, `status`) VALUES
(1, 'ESPTEST1', 1, 0.1, '2019-08-10 19:17:51', '2019-08-19 04:31:39', '2019-08-19 04:31:39', 'OFF'),
(2, 'ESPTEST1', 3, 0.005, '2019-08-12 01:45:52', '2019-08-19 04:40:01', '2019-08-19 04:40:01', 'OFF'),
(3, 'ESPTEST1', 2, 0.003, '2019-08-12 01:53:58', '2019-08-12 01:56:47', '2019-08-12 01:56:47', 'OFF'),
(6, 'ESPTEST1', 13, 0.002, '2019-08-18 22:41:35', '2019-08-18 22:53:22', '2019-08-18 22:53:22', 'OFF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `config`
--

CREATE TABLE `config` (
  `config_id` int(11) UNSIGNED NOT NULL,
  `delay` int(11) DEFAULT NULL,
  `cost` float NOT NULL,
  `dirubah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `config`
--

INSERT INTO `config` (`config_id`, `delay`, `cost`, `dirubah`) VALUES
(1, 1000, 1500, 'tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `device`
--

CREATE TABLE `device` (
  `device_id` varchar(50) NOT NULL,
  `device_name` varchar(255) DEFAULT NULL,
  `kwh_max` float DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `device`
--

INSERT INTO `device` (`device_id`, `device_name`, `kwh_max`, `created`, `updated`) VALUES
('ESPTEST1', 'Esp Testing v1', 40, '2019-08-10 19:15:26', '2019-08-18 02:30:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kwh_transaction`
--

CREATE TABLE `kwh_transaction` (
  `kwh_trans_id` int(11) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `watt` float DEFAULT NULL,
  `ampere` float DEFAULT NULL,
  `volt` float DEFAULT NULL,
  `wh` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kwh_transaction`
--

INSERT INTO `kwh_transaction` (`kwh_trans_id`, `device_id`, `watt`, `ampere`, `volt`, `wh`, `created`) VALUES
(1, 'ESPTEST1', 25.9, 0.22, 228.1, 0, '2020-08-12 08:15:32'),
(2, 'ESPTEST1', 28.4, 0.23, 228.5, 0, '2020-08-12 08:15:35'),
(3, 'ESPTEST1', 23.8, 0.2, 228.2, 0, '2020-08-12 08:15:37'),
(4, 'ESPTEST1', 26.6, 0.22, 228.1, 0, '2020-08-12 08:15:39'),
(5, 'ESPTEST1', 24.8, 0.21, 228.2, 0, '2020-08-12 08:15:41'),
(6, 'ESPTEST1', 21.3, 0.19, 228.4, 0, '2020-08-12 08:15:43'),
(7, 'ESPTEST1', 24.4, 0.21, 228, 0, '2020-08-12 08:15:46'),
(8, 'ESPTEST1', 24.7, 0.21, 227.9, 0, '2020-08-12 08:15:48'),
(9, 'ESPTEST1', 21.8, 0.19, 228.2, 0, '2020-08-12 08:15:50'),
(10, 'ESPTEST1', 23.6, 0.2, 228.3, 0, '2020-08-12 08:15:52'),
(11, 'ESPTEST1', 24.1, 0.21, 227.8, 0, '2020-08-12 08:15:54'),
(12, 'ESPTEST1', 20.9, 0.19, 227.9, 0, '2020-08-12 08:15:56'),
(13, 'ESPTEST1', 22.3, 0.19, 228.3, 0, '2020-08-12 08:15:59'),
(14, 'ESPTEST1', 24.3, 0.21, 228.2, 0, '2020-08-12 08:16:01'),
(15, 'ESPTEST1', 24.3, 0.21, 227.8, 0, '2020-08-12 08:16:03'),
(16, 'ESPTEST1', 20.7, 0.19, 227.9, 0, '2020-08-12 08:16:05'),
(17, 'ESPTEST1', 23.7, 0.21, 228, 0, '2020-08-12 08:16:07'),
(18, 'ESPTEST1', 24.8, 0.21, 228.1, 0, '2020-08-12 08:16:09'),
(19, 'ESPTEST1', 21, 0.19, 228, 0, '2020-08-12 08:16:11'),
(20, 'ESPTEST1', 23.9, 0.21, 227.9, 0, '2020-08-12 08:16:14'),
(21, 'ESPTEST1', 25.2, 0.21, 228, 0, '2020-08-12 08:16:16'),
(22, 'ESPTEST1', 21.7, 0.19, 228, 0, '2020-08-12 08:16:18'),
(23, 'ESPTEST1', 24.1, 0.21, 227.9, 0, '2020-08-12 08:16:20'),
(24, 'ESPTEST1', 23.7, 0.2, 227.8, 0, '2020-08-12 08:16:22'),
(25, 'ESPTEST1', 20.3, 0.18, 228.3, 0, '2020-08-12 08:16:24'),
(26, 'ESPTEST1', 23.2, 0.2, 228, 0, '2020-08-12 08:16:27'),
(27, 'ESPTEST1', 26.7, 0.23, 227.3, 0, '2020-08-12 08:16:29'),
(28, 'ESPTEST1', 22.8, 0.2, 227.3, 0, '2020-08-12 08:16:31'),
(29, 'ESPTEST1', 20.7, 0.19, 227.8, 0, '2020-08-12 08:16:33'),
(30, 'ESPTEST1', 23.2, 0.2, 227.8, 0, '2020-08-12 08:16:35'),
(31, 'ESPTEST1', 24.1, 0.21, 227.3, 0, '2020-08-12 08:16:37'),
(32, 'ESPTEST1', 20.7, 0.19, 227.5, 0, '2020-08-12 08:16:40'),
(33, 'ESPTEST1', 23.3, 0.2, 227.8, 0, '2020-08-12 08:16:42'),
(34, 'ESPTEST1', 23.2, 0.2, 227.6, 0, '2020-08-12 08:16:44'),
(35, 'ESPTEST1', 19.6, 0.18, 227.6, 0, '2020-08-12 08:16:46'),
(36, 'ESPTEST1', 23.5, 0.2, 227.3, 0, '2020-08-12 08:16:48'),
(37, 'ESPTEST1', 21.4, 0.19, 227.6, 0, '2020-08-12 08:16:50'),
(38, 'ESPTEST1', 22, 0.19, 227.6, 0, '2020-08-12 08:16:52'),
(39, 'ESPTEST1', 23.2, 0.2, 227.2, 0, '2020-08-12 08:16:54'),
(40, 'ESPTEST1', 20.9, 0.19, 227.3, 0, '2020-08-12 08:16:56'),
(41, 'ESPTEST1', 21.9, 0.19, 227.4, 0, '2020-08-12 08:16:59'),
(42, 'ESPTEST1', 23.4, 0.2, 227.3, 0, '2020-08-12 08:17:01'),
(43, 'ESPTEST1', 21.9, 0.19, 227.9, 0, '2020-08-12 08:17:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kwh_usage`
--

CREATE TABLE `kwh_usage` (
  `id_usage` int(11) NOT NULL,
  `date` date NOT NULL,
  `kwh` float NOT NULL,
  `total_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_training`
--

CREATE TABLE `log_training` (
  `id_training` int(11) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `appliance_id` int(11) NOT NULL,
  `freq_watt` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `period`
--

CREATE TABLE `period` (
  `period_id` int(11) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `first_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `total_time` float NOT NULL,
  `kwh` float NOT NULL,
  `cost` float NOT NULL,
  `total_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `period`
--

INSERT INTO `period` (`period_id`, `device_id`, `first_time`, `last_time`, `total_time`, `kwh`, `cost`, `total_cost`) VALUES
(12, 'ESPTEST1', '2020-08-12 08:15:32', '2020-08-12 08:17:30', 114, 0, 1500, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_usage`
--

CREATE TABLE `tb_usage` (
  `id_usage` int(11) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `usage_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kwh` float NOT NULL,
  `total_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_usage`
--

INSERT INTO `tb_usage` (`id_usage`, `device_id`, `usage_date`, `kwh`, `total_cost`) VALUES
(12, 'ESPTEST1', '2020-08-12 08:15:32', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `appliance`
--
ALTER TABLE `appliance`
  ADD PRIMARY KEY (`appliance_id`);

--
-- Indeks untuk tabel `appliancedevice`
--
ALTER TABLE `appliancedevice`
  ADD PRIMARY KEY (`appliancedevice_id`),
  ADD KEY `fk_device_id` (`device_id`),
  ADD KEY `fk_appliance_id` (`appliance_id`);

--
-- Indeks untuk tabel `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indeks untuk tabel `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`);

--
-- Indeks untuk tabel `kwh_transaction`
--
ALTER TABLE `kwh_transaction`
  ADD PRIMARY KEY (`kwh_trans_id`),
  ADD KEY `fk_device_trans` (`device_id`);

--
-- Indeks untuk tabel `log_training`
--
ALTER TABLE `log_training`
  ADD PRIMARY KEY (`id_training`),
  ADD KEY `fk_appliance_training` (`appliance_id`),
  ADD KEY `fk_device_training` (`device_id`);

--
-- Indeks untuk tabel `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`period_id`),
  ADD KEY `fk_period_device_id` (`device_id`);

--
-- Indeks untuk tabel `tb_usage`
--
ALTER TABLE `tb_usage`
  ADD PRIMARY KEY (`id_usage`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `appliance`
--
ALTER TABLE `appliance`
  MODIFY `appliance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `appliancedevice`
--
ALTER TABLE `appliancedevice`
  MODIFY `appliancedevice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kwh_transaction`
--
ALTER TABLE `kwh_transaction`
  MODIFY `kwh_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `log_training`
--
ALTER TABLE `log_training`
  MODIFY `id_training` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `period`
--
ALTER TABLE `period`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_usage`
--
ALTER TABLE `tb_usage`
  MODIFY `id_usage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `appliancedevice`
--
ALTER TABLE `appliancedevice`
  ADD CONSTRAINT `fk_appliance_id` FOREIGN KEY (`appliance_id`) REFERENCES `appliance` (`appliance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kwh_transaction`
--
ALTER TABLE `kwh_transaction`
  ADD CONSTRAINT `fk_device_trans` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_training`
--
ALTER TABLE `log_training`
  ADD CONSTRAINT `fk_appliance_training` FOREIGN KEY (`appliance_id`) REFERENCES `appliance` (`appliance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_device_training` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `period`
--
ALTER TABLE `period`
  ADD CONSTRAINT `fk_period_device_id` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
