-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2020 pada 04.05
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si-jamu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `si_kategori`
--

CREATE TABLE `si_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `si_kategori`
--

INSERT INTO `si_kategori` (`kategori_id`, `kategori_nama`) VALUES
(14, 'Jamu Ayam'),
(15, 'Herbal '),
(16, 'Obat Ayam'),
(17, 'Suplemen Ayam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `si_pengambilan`
--

CREATE TABLE `si_pengambilan` (
  `pengambilan_id` int(11) NOT NULL,
  `pengambilan_tgl` date NOT NULL,
  `pengambilan_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `si_pengambilan_detail`
--

CREATE TABLE `si_pengambilan_detail` (
  `pd_id` int(11) NOT NULL,
  `pd_pengambilan_id` int(11) NOT NULL,
  `pd_produk_id` int(11) NOT NULL,
  `pd_produk_harga` int(11) NOT NULL,
  `pd_jumlah` int(11) NOT NULL,
  `pd_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `si_produk`
--

CREATE TABLE `si_produk` (
  `produk_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `produk_nama` varchar(256) NOT NULL,
  `produk_harga` int(11) NOT NULL,
  `produk_harga_jual` int(11) NOT NULL,
  `produk_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `si_produk`
--

INSERT INTO `si_produk` (`produk_id`, `kategori_id`, `produk_nama`, `produk_harga`, `produk_harga_jual`, `produk_stok`) VALUES
(1, 14, 'Dopping Dewa', 125000, 200000, 0),
(2, 15, 'Herbal SN 35 Gram', 55000, 75000, 0),
(3, 15, 'Herbal SN 100 Gram', 15000, 23000, 0),
(4, 14, 'Bima Power', 55000, 75000, 0),
(5, 14, 'Dragon SN', 100000, 120000, 0),
(6, 14, 'Monster Pro', 60000, 80000, 0),
(7, 16, 'Super Rontox ', 50000, 80000, 0),
(8, 16, 'Magic SN Blue ', 55000, 75000, 0),
(9, 14, 'Magic SN Green', 55000, 75000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `si_user`
--

CREATE TABLE `si_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `si_user`
--

INSERT INTO `si_user` (`user_id`, `username`, `email`, `image`, `user_password`, `role_id`) VALUES
(1, 'sukmaaji11', 'sukmaaji11@gmail.com', 'default.png', '$2y$10$alRwiS84YHEEhcHVl79.juij5gR8UmlqhBbMAAdDqdu0wAsTZKCZe', 1),
(2, 'manager', 'manager@gmail.com', 'default.png', '$2y$10$M0Tlg6Ib/7i7kSK2jgxMw.AQRlglgywRrc2xCgUwoum7pMcll9l.q', 2),
(3, 'noorman', 'noormanwinar@gmail.com', 'default.png', '$2y$10$866Jv4e8rTC72DzPqa5AQe4MISKiCHPyH/4o61fDs0btKUDzZhyWu', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'manager');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `si_kategori`
--
ALTER TABLE `si_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `si_pengambilan`
--
ALTER TABLE `si_pengambilan`
  ADD PRIMARY KEY (`pengambilan_id`);

--
-- Indeks untuk tabel `si_pengambilan_detail`
--
ALTER TABLE `si_pengambilan_detail`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `pd_pengambilan_id` (`pd_pengambilan_id`),
  ADD KEY `pd_produk_id` (`pd_produk_id`);

--
-- Indeks untuk tabel `si_produk`
--
ALTER TABLE `si_produk`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `id_kategori` (`kategori_id`);

--
-- Indeks untuk tabel `si_user`
--
ALTER TABLE `si_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `si_kategori`
--
ALTER TABLE `si_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `si_pengambilan_detail`
--
ALTER TABLE `si_pengambilan_detail`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `si_produk`
--
ALTER TABLE `si_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `si_user`
--
ALTER TABLE `si_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `si_pengambilan_detail`
--
ALTER TABLE `si_pengambilan_detail`
  ADD CONSTRAINT `pd_pengambilan_id` FOREIGN KEY (`pd_pengambilan_id`) REFERENCES `si_pengambilan` (`pengambilan_id`),
  ADD CONSTRAINT `pd_produk_id` FOREIGN KEY (`pd_produk_id`) REFERENCES `si_produk` (`produk_id`);

--
-- Ketidakleluasaan untuk tabel `si_produk`
--
ALTER TABLE `si_produk`
  ADD CONSTRAINT `si_produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `si_kategori` (`kategori_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
