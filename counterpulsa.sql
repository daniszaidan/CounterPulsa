-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2018 at 01:52 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counterpulsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `id_user` int(10) NOT NULL,
  `id_komplain` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `image_resource` varchar(255) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `status_komplain` int(1) NOT NULL,
  `id_transaksi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `pembelian_saldo`
-- (See below for the actual view)
--
CREATE TABLE `pembelian_saldo` (
`id_pesan_saldo` int(10)
,`id_saldo` int(10)
,`nominal_saldo` int(10)
,`harga_saldo` int(10)
,`status_pembelian` int(1)
,`tanggal` varchar(255)
,`waktu` varchar(255)
,`bukti_pembayaran` varchar(255)
,`id_user` int(10)
,`nama_lengkap` varchar(30)
,`current_saldo` int(10)
,`saldo_out` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_user` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `waktu` varchar(8) NOT NULL,
  `image_resource` varchar(255) NOT NULL,
  `id_pengumuman` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesan_saldo`
--

CREATE TABLE `pesan_saldo` (
  `id_pesan_saldo` int(10) NOT NULL,
  `id_saldo` int(10) NOT NULL,
  `nominal` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan_saldo`
--

INSERT INTO `pesan_saldo` (`id_pesan_saldo`, `id_saldo`, `nominal`, `harga`, `tanggal`, `status`, `bukti_pembayaran`, `waktu`) VALUES
(1, 1, 50000, 52073, '2018/03/26', 0, '', '12:14:24'),
(2, 1, 50000, 52088, '2018/03/27', 0, '', '10:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `current_saldo` int(10) NOT NULL,
  `saldo_out` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `id_user`, `current_saldo`, `saldo_out`) VALUES
(1, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id_service` int(10) NOT NULL,
  `nama_service` varchar(30) NOT NULL,
  `kategori_service` int(10) NOT NULL,
  `harga_service` int(10) NOT NULL,
  `status_service` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_user`
--

CREATE TABLE `service_user` (
  `id_service_user` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_service` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `service_user_view`
-- (See below for the actual view)
--
CREATE TABLE `service_user_view` (
`id_service_user` int(10)
,`id_user` int(10)
,`id_service` int(10)
,`nama_service` varchar(30)
,`kategori_service` int(10)
,`harga_service` int(10)
,`status_service` int(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_service` int(10) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `waktu` varchar(8) NOT NULL,
  `status_transaksi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi_view`
-- (See below for the actual view)
--
CREATE TABLE `transaksi_view` (
`id_transaksi` int(10)
,`id_user` int(10)
,`id_service` int(10)
,`no_hp` varchar(15)
,`tanggal` varchar(10)
,`waktu` varchar(8)
,`status_transaksi` int(1)
,`nama_service` varchar(30)
,`kategori_service` int(10)
,`harga_service` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `no_ktp`, `nama_lengkap`, `email`, `no_hp`, `alamat`, `password`, `status`) VALUES
(6, '7371093006980009', '7371093006980009', '7371093006980009@.com', '082188432070', '7371093006980009', 'programer', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_saldo`
-- (See below for the actual view)
--
CREATE TABLE `user_saldo` (
`id_user` int(10)
,`no_ktp` varchar(20)
,`nama_lengkap` varchar(30)
,`email` varchar(30)
,`no_hp` varchar(15)
,`alamat` varchar(255)
,`password` varchar(255)
,`status` int(1)
,`id_saldo` int(10)
,`current_saldo` int(10)
,`saldo_out` int(10)
);

-- --------------------------------------------------------

--
-- Structure for view `pembelian_saldo`
--
DROP TABLE IF EXISTS `pembelian_saldo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pembelian_saldo`  AS  select `pesan_saldo`.`id_pesan_saldo` AS `id_pesan_saldo`,`pesan_saldo`.`id_saldo` AS `id_saldo`,`pesan_saldo`.`nominal` AS `nominal_saldo`,`pesan_saldo`.`harga` AS `harga_saldo`,`pesan_saldo`.`status` AS `status_pembelian`,`pesan_saldo`.`tanggal` AS `tanggal`,`pesan_saldo`.`waktu` AS `waktu`,`pesan_saldo`.`bukti_pembayaran` AS `bukti_pembayaran`,`saldo`.`id_user` AS `id_user`,`user`.`nama_lengkap` AS `nama_lengkap`,`saldo`.`current_saldo` AS `current_saldo`,`saldo`.`saldo_out` AS `saldo_out` from ((`pesan_saldo` join `saldo`) join `user`) where (`pesan_saldo`.`id_saldo` = `saldo`.`id_saldo`) ;

-- --------------------------------------------------------

--
-- Structure for view `service_user_view`
--
DROP TABLE IF EXISTS `service_user_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `service_user_view`  AS  select `service_user`.`id_service_user` AS `id_service_user`,`service_user`.`id_user` AS `id_user`,`service`.`id_service` AS `id_service`,`service`.`nama_service` AS `nama_service`,`service`.`kategori_service` AS `kategori_service`,`service`.`harga_service` AS `harga_service`,`service`.`status_service` AS `status_service` from ((`service_user` join `user`) join `service`) where ((`service_user`.`id_user` = `user`.`id_user`) and (`service_user`.`id_service` = `service`.`id_service`)) ;

-- --------------------------------------------------------

--
-- Structure for view `transaksi_view`
--
DROP TABLE IF EXISTS `transaksi_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_view`  AS  select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`id_user` AS `id_user`,`transaksi`.`id_service` AS `id_service`,`transaksi`.`no_hp` AS `no_hp`,`transaksi`.`tanggal` AS `tanggal`,`transaksi`.`waktu` AS `waktu`,`transaksi`.`status_transaksi` AS `status_transaksi`,`service`.`nama_service` AS `nama_service`,`service`.`kategori_service` AS `kategori_service`,`service`.`harga_service` AS `harga_service` from (`transaksi` join `service`) where (`transaksi`.`id_service` = `service`.`id_service`) ;

-- --------------------------------------------------------

--
-- Structure for view `user_saldo`
--
DROP TABLE IF EXISTS `user_saldo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_saldo`  AS  select `user`.`id_user` AS `id_user`,`user`.`no_ktp` AS `no_ktp`,`user`.`nama_lengkap` AS `nama_lengkap`,`user`.`email` AS `email`,`user`.`no_hp` AS `no_hp`,`user`.`alamat` AS `alamat`,`user`.`password` AS `password`,`user`.`status` AS `status`,`saldo`.`id_saldo` AS `id_saldo`,`saldo`.`current_saldo` AS `current_saldo`,`saldo`.`saldo_out` AS `saldo_out` from (`user` join `saldo`) where (`user`.`id_user` = `saldo`.`id_user`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`id_komplain`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pesan_saldo`
--
ALTER TABLE `pesan_saldo`
  ADD PRIMARY KEY (`id_pesan_saldo`),
  ADD KEY `id_saldo` (`id_saldo`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `service_user`
--
ALTER TABLE `service_user`
  ADD PRIMARY KEY (`id_service_user`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_service` (`id_service`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`,`id_service`),
  ADD KEY `id_service` (`id_service`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komplain`
--
ALTER TABLE `komplain`
  MODIFY `id_komplain` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan_saldo`
--
ALTER TABLE `pesan_saldo`
  MODIFY `id_pesan_saldo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_user`
--
ALTER TABLE `service_user`
  MODIFY `id_service_user` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komplain`
--
ALTER TABLE `komplain`
  ADD CONSTRAINT `komplain_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komplain_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesan_saldo`
--
ALTER TABLE `pesan_saldo`
  ADD CONSTRAINT `pesan_saldo_ibfk_1` FOREIGN KEY (`id_saldo`) REFERENCES `saldo` (`id_saldo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `saldo_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_user`
--
ALTER TABLE `service_user`
  ADD CONSTRAINT `service_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_user_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
