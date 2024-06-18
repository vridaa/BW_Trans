-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2024 pada 04.22
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bw_trans`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `ID_admin` int(11) NOT NULL,
  `Nama_admin` varchar(50) NOT NULL,
  `Email_admin` varchar(50) NOT NULL,
  `Kontak_admin` varchar(12) NOT NULL,
  `Alamat_admin` text NOT NULL,
  `password` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ID_admin`, `Nama_admin`, `Email_admin`, `Kontak_admin`, `Alamat_admin`, `password`) VALUES
(1, 'Pak Bowo', 'bowo@gmail.com', '083253746583', 'Jl. Mangga No. 70', 'bisa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `armada`
--

CREATE TABLE `armada` (
  `ID_Armada` int(11) NOT NULL,
  `nama_Armada` varchar(50) NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `estimasi_harga` int(11) NOT NULL,
  `ID_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `armada`
--

INSERT INTO `armada` (`ID_Armada`, `nama_Armada`, `jumlah_kursi`, `estimasi_harga`, `ID_admin`) VALUES
(16, 'Bus Ekonomi Tipe 1', 29, 40000, 1),
(17, 'Bus Ekonomi Tipe 2', 29, 50000, 1),
(18, 'Bus Ekonomi Tipe 3', 29, 60000, 1),
(19, 'Bus Ekonomi Tipe 4', 29, 70000, 1),
(20, 'Bus Ekonomi Tipe 5', 29, 80000, 1),
(21, 'Bus AC Ekonomi Tipe 1', 29, 90000, 1),
(22, 'Bus AC Ekonomi Tipe 2', 29, 100000, 1),
(23, 'Bus AC Ekonomi Tipe 3', 29, 110000, 1),
(24, 'Bus Ekonomi Tipe 1', 39, 45000, 1),
(26, 'Bus Ekonomi Tipe 5', 39, 12000, 1),
(27, 'Bus Ekonomi Tipe 4', 29, 1200, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `ID_customer` int(11) NOT NULL,
  `Nama_customer` varchar(50) NOT NULL,
  `Kontak_customer` int(11) NOT NULL,
  `Email_customer` varchar(50) NOT NULL,
  `Alamat_customer` text NOT NULL,
  `password` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`ID_customer`, `Nama_customer`, `Kontak_customer`, `Email_customer`, `Alamat_customer`, `password`) VALUES
(1, 'rani', 823, 'rani@gmail.com', 'prambanan', 'error'),
(2, 'kipas', 1978, 't@gmail.com', '', '1111'),
(3, 'ikan', 0, 'ikan@gmail.com', '', '111'),
(4, 'Dhea', 785, 'm@gmail.com', '', '122');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `ID_jadwal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `ID_sopir` int(11) NOT NULL,
  `Id_armada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`ID_jadwal`, `tanggal`, `ID_sopir`, `Id_armada`) VALUES
(8, '2024-06-19', 8, 20),
(9, '2024-06-20', 8, 24),
(10, '2024-06-20', 3, 22),
(11, '2024-06-20', 7, 16),
(12, '2024-06-20', 11, 20),
(14, '2024-06-27', 11, 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_sopir`
--

CREATE TABLE `jadwal_sopir` (
  `ID_jadwalsopir` int(11) NOT NULL,
  `ID_sopir` int(11) NOT NULL,
  `ID_pesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_sopir`
--

INSERT INTO `jadwal_sopir` (`ID_jadwalsopir`, `ID_sopir`, `ID_pesanan`) VALUES
(20, 8, 23),
(21, 8, 24),
(24, 3, 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_po_new`
--

CREATE TABLE `laporan_po_new` (
  `ID_pesanan` int(11) NOT NULL,
  `ID_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan_po_new`
--

INSERT INTO `laporan_po_new` (`ID_pesanan`, `ID_admin`) VALUES
(23, 1),
(24, 1),
(27, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `ID_pesanan` int(11) NOT NULL,
  `ID_customer` int(11) NOT NULL,
  `ID_jadwal` int(11) NOT NULL,
  `kota_tujuan` varchar(30) NOT NULL,
  `tanggal_resrvasi` date NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`ID_pesanan`, `ID_customer`, `ID_jadwal`, `kota_tujuan`, `tanggal_resrvasi`, `harga`) VALUES
(23, 1, 8, 'dalam_provinsi', '2024-06-19', 600000),
(24, 1, 9, 'semarang', '2024-06-20', 900000),
(27, 1, 10, 'solo', '2024-06-20', 750000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sopir`
--

CREATE TABLE `sopir` (
  `ID_sopir` int(11) NOT NULL,
  `Nama_sopir` varchar(50) NOT NULL,
  `Email_sopir` varchar(50) NOT NULL,
  `Kontak_sopir` varchar(12) NOT NULL,
  `Alamat_sopir` varchar(50) NOT NULL,
  `password` varchar(7) NOT NULL,
  `ID_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sopir`
--

INSERT INTO `sopir` (`ID_sopir`, `Nama_sopir`, `Email_sopir`, `Kontak_sopir`, `Alamat_sopir`, `password`, `ID_admin`) VALUES
(3, 'Slamet Rahardi', 'slamet@gmail.com', '087654637282', 'Jl. Kenangan No. 204', 'iyasih', 1),
(6, 'Raharjooo', 'raharjooo@gmail.com', '082537482716', 'Jl. Jogja No. 10', '', 1),
(7, 'Sugeng', 'sugeng21@gmail.com', '083123465786', 'Jl. Mataram No. 28', '', 1),
(8, 'Jeno', 'jenooo@gmail.com', '083546789534', 'Jl. Melati No. 23', '', 1),
(11, 'winter', 'kucing', '0987', 'jln', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_admin`);

--
-- Indeks untuk tabel `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`ID_Armada`),
  ADD KEY `ID_admin` (`ID_admin`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID_customer`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`ID_jadwal`),
  ADD KEY `ID_sopir` (`ID_sopir`),
  ADD KEY `Id_armada` (`Id_armada`);

--
-- Indeks untuk tabel `jadwal_sopir`
--
ALTER TABLE `jadwal_sopir`
  ADD PRIMARY KEY (`ID_jadwalsopir`),
  ADD KEY `jadwal_sopir_ibfk_3` (`ID_sopir`),
  ADD KEY `ID_pesanan` (`ID_pesanan`);

--
-- Indeks untuk tabel `laporan_po_new`
--
ALTER TABLE `laporan_po_new`
  ADD PRIMARY KEY (`ID_pesanan`,`ID_admin`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`ID_pesanan`),
  ADD KEY `index` (`ID_jadwal`),
  ADD KEY `ID_customer` (`ID_customer`);

--
-- Indeks untuk tabel `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`ID_sopir`),
  ADD KEY `idx_id_owner` (`ID_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `armada`
--
ALTER TABLE `armada`
  MODIFY `ID_Armada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `ID_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `ID_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `jadwal_sopir`
--
ALTER TABLE `jadwal_sopir`
  MODIFY `ID_jadwalsopir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `ID_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `sopir`
--
ALTER TABLE `sopir`
  MODIFY `ID_sopir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `armada`
--
ALTER TABLE `armada`
  ADD CONSTRAINT `armada_ibfk_1` FOREIGN KEY (`ID_admin`) REFERENCES `admin` (`ID_admin`);

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`ID_sopir`) REFERENCES `sopir` (`ID_sopir`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`Id_armada`) REFERENCES `armada` (`ID_Armada`);

--
-- Ketidakleluasaan untuk tabel `jadwal_sopir`
--
ALTER TABLE `jadwal_sopir`
  ADD CONSTRAINT `jadwal_sopir_ibfk_3` FOREIGN KEY (`ID_sopir`) REFERENCES `sopir` (`ID_sopir`),
  ADD CONSTRAINT `jadwal_sopir_ibfk_4` FOREIGN KEY (`ID_pesanan`) REFERENCES `pemesanan` (`ID_pesanan`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`ID_jadwal`) REFERENCES `jadwal` (`ID_jadwal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_4` FOREIGN KEY (`ID_customer`) REFERENCES `customer` (`ID_customer`);

--
-- Ketidakleluasaan untuk tabel `sopir`
--
ALTER TABLE `sopir`
  ADD CONSTRAINT `sopir_ibfk_1` FOREIGN KEY (`ID_admin`) REFERENCES `admin` (`ID_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
