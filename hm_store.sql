-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jun 2026 pada 00.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hm_store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `kategori`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
(1, 'H&M Premium T-Shirt', 'T-Shirt', 129000, 17, 'tshirt.jpg', 'Kaos premium cotton'),
(2, 'H&M Oversized Tee', 'T-Shirt', 159000, 25, 'over.jpg', 'Kaos oversized modern'),
(3, 'H&M Basic Hoodie', 'Hoodie', 299000, 24, 'hoodie.jpg', 'Hoodie nyaman untuk harian'),
(4, 'H&M Cargo Pants', 'Pants', 349000, 21, '2.jpg', 'Celana cargo casual'),
(8, 'H&M Relaxed Fit Shirt', 'T-Shirt', 179000, 34, 'shirt1.jpg', 'Kemeja santai premium untuk aktivitas harian'),
(9, 'H&M Graphic Tee', 'T-Shirt', 149000, 40, 'graphictee.jpg', 'Kaos graphic modern dengan bahan cotton'),
(10, 'H&M Denim Jacket', 'Jacket', 399000, 15, 'denim.jpg', 'Jaket denim casual fashion pria dan wanita'),
(11, 'H&M Slim Fit Polo', 'T-Shirt', 189000, 28, 'polo.jpg', 'Polo shirt elegan untuk gaya semi formal'),
(12, 'H&M Cargo Jogger', 'Pants', 279000, 20, 'cargojogger.jpg', 'Celana cargo jogger nyaman dan stylish'),
(13, 'H&M Straight Jeans', 'Pants', 329000, 18, 'jeans.jpg', 'Celana jeans premium dengan potongan modern'),
(14, 'H&M Oversized Hoodie Black', 'Hoodie', 349000, 22, 'hoodieblack.jpg', 'Hoodie oversized warna hitam untuk daily wear'),
(15, 'H&M Zip Hoodie Grey', 'Hoodie', 359000, 16, 'ziphoodie.jpg', 'Hoodie resleting dengan bahan fleece lembut'),
(16, 'H&M Linen Shirt', 'Shirt', 299000, 14, 'linen.jpg', 'Kemeja linen premium cocok untuk cuaca tropis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `no_resi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `total_harga`, `tanggal`, `status`, `no_resi`) VALUES
(10, 1, 258000, NULL, 'Selesai', 'HM20260611183159113'),
(11, 1, 318000, NULL, 'Pending', 'HM20260612183815209'),
(12, 1, 478000, NULL, 'Pending', 'HM20260624153035226');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(5, 'User', 'user@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
