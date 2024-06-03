-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2024 pada 22.06
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbweb_cashflow`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash`
--

CREATE TABLE `cash` (
  `id_cash` smallint(5) NOT NULL,
  `id_customer` smallint(5) NOT NULL,
  `total_cash` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cash`
--

INSERT INTO `cash` (`id_cash`, `id_customer`, `total_cash`) VALUES
(2, 12, 245000),
(4, 14, 10000000),
(5, 15, 0),
(6, 16, 0),
(7, 17, 0),
(8, 18, 85000),
(9, 19, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id_customer` smallint(5) NOT NULL,
  `id_user` smallint(5) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id_customer`, `id_user`, `name`) VALUES
(12, 60, 'M Nasrul Wahabi'),
(14, 62, 'sakura'),
(15, 63, 'sakuro'),
(16, 64, 'sibe rei'),
(17, 65, 'Nasrul Wahabi'),
(18, 66, 'Betrand '),
(19, 67, 'Saka Dicesort');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` smallint(5) NOT NULL,
  `id_customer` smallint(5) NOT NULL,
  `date_transaksi` date NOT NULL,
  `name_transaksi` varchar(128) NOT NULL,
  `total_transaksi` int(30) NOT NULL,
  `type_transaksi` enum('pemasukan','pengeluaran') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_customer`, `date_transaksi`, `name_transaksi`, `total_transaksi`, `type_transaksi`) VALUES
(39, 14, '2024-04-11', 'Crypto', 15000000, 'pemasukan'),
(40, 14, '2024-05-04', 'iPhone', 5000000, 'pengeluaran'),
(46, 18, '2024-05-27', 'Gaji', 100000, 'pemasukan'),
(47, 18, '2024-05-18', 'iPhone', 15000, 'pengeluaran'),
(53, 12, '2024-06-01', 'Angpau', 100000, 'pemasukan'),
(55, 12, '2024-01-30', 'Profit', 50000, 'pemasukan'),
(56, 12, '2024-06-01', 'Investasi', 100000, 'pemasukan'),
(59, 12, '2024-06-14', 'Investasi', 5000, 'pengeluaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` smallint(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`) VALUES
(60, 'wahabinasrul@gmail.com', '$2y$10$sQxjSseLILab6dKjVYLPqu8HkYVppH1hRkGripUrMMK/0z8VFDEKO'),
(62, 'sakura@gmail.com', '$2y$10$9DZcRhQDwFuNeEt3aihJ6uxUmdJNd669yQ2rLsb9fNWpGZbk7y5wO'),
(63, 'sakuro@gmail.com', '$2y$10$iPgaovFu6Zpd7RsVPTQJ2Oig3olmOTxnjWl9OrdlKKefTNs5Zm4aK'),
(64, 'siberei@gmail.com', '$2y$10$ZJjJirBooQbTRkRZW3scWeC7rMJiPhvSaYZw1PDspjgkISkFcBaBS'),
(65, 'sakuraji@gmail.com', '$2y$10$O8vCgltGkE6VRF27Jp4KEetklycPnImNRsgottpg5q9P5dsm1UhbS'),
(66, 'betrand123@gmail.com', '$2y$10$wB7Wh9MOynL9dEyrZGwmFePh4VovLmmD.AdhvoxFIUqwHH9/yhY1q'),
(67, 'sakadicesort@gmail.com', '$2y$10$ehsvHpPo3LuGGit3q18bne6SdQ485Cs91B5Gha2fOMual19TFLzpG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id_cash`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cash`
--
ALTER TABLE `cash`
  MODIFY `id_cash` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
