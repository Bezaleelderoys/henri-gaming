-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Sep 2024 pada 01.47
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
-- Database: `db_apotek2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `iddetailtransaksi` int(4) NOT NULL,
  `idtransaksi` int(5) NOT NULL,
  `idobat` int(4) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `hargasatuan` double NOT NULL,
  `totalharga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `idkaryawan` int(4) NOT NULL,
  `namakaryawan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`idkaryawan`, `namakaryawan`, `alamat`, `telp`) VALUES
(1001, 'Sugidi', 'Jl. Tukad Rembo no 2', '08133425');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(65) NOT NULL,
  `leveluser` varchar(50) NOT NULL,
  `idkaryawan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int(4) NOT NULL,
  `id_supplier` int(4) NOT NULL,
  `namaobat` varchar(100) NOT NULL,
  `kategoriobat` varchar(50) NOT NULL,
  `hargajual` double NOT NULL,
  `hargabeli` double NOT NULL,
  `stok_obat` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `id_supplier`, `namaobat`, `kategoriobat`, `hargajual`, `hargabeli`, `stok_obat`, `keterangan`) VALUES
(77, 0, '', '', 0, 0, 15, 'Baik'),
(78, 0, 'Dumin', 'Demam', 50000, 30000, 20, 'Baik'),
(79, 0, 'paracetamol', 'demam', 50000, 35000, 20, 'Baik'),
(80, 0, 'paracetamol', 'demam', 50000, 35000, 20, 'Baik'),
(81, 0, 'paracetamol', 'demam', 50000, 35000, 20, 'Baik'),
(82, 0, 'Amoxcilyn', 'Bius', 100000, 50000, 15, 'Baik'),
(83, 0, 'Amoxcilyn', 'Bius', 100000, 50000, 15, 'Baik'),
(84, 0, 'Amoxcilyn', 'Bius', 100000, 50000, 15, 'Baik'),
(87, 16, 'Amoxcilyn', 'Bius', 100000, 50000, 15, 'Baik'),
(88, 16, 'Amoxcilyn', 'Bius', 100000, 50000, 15, 'Baik'),
(89, 16, 'Amoxcilynnn', 'Bius', 100000, 50000, 15, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `idpelanggan` int(4) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` int(15) NOT NULL,
  `usia` int(3) NOT NULL,
  `buktifotoresep` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`idpelanggan`, `namalengkap`, `alamat`, `telp`, `usia`, `buktifotoresep`) VALUES
(12, 'Sukadana', 'Jl. Bumi Galaxy', 81426577, 53, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(4) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `perusahaan`, `telp`, `alamat`, `keterangan`) VALUES
(13, 'Pt.Sinar Jaya', '08133425', 'Jl. Tukad Badung', 'Baik'),
(14, 'Pt. Setia Budi', '08714332', 'Jl. Bintang Soedirman', 'Baik'),
(16, 'Pt. Sinar Bumi', '0873166299', 'Jl. Tukad Citarum', 'Baik'),
(17, 'Pt. Kencana', '0818865324', 'Jl. Pedungan Batu', 'Baik'),
(19, 'Pt. Global Sinar', '087334177', 'Jl Sesetan ', 'Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `idtransaksi` int(5) NOT NULL,
  `idpelanggan` int(4) NOT NULL,
  `idkaryawan` int(4) NOT NULL,
  `tgltransaksi` date NOT NULL,
  `kategoripelanggan` varchar(20) NOT NULL,
  `totalbayar` double NOT NULL,
  `bayar` double NOT NULL,
  `kembali` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`idtransaksi`, `idpelanggan`, `idkaryawan`, `tgltransaksi`, `kategoripelanggan`, `totalbayar`, `bayar`, `kembali`) VALUES
(1011, 12, 1001, '2024-08-06', 'bagus', 20000, 16000, 4000),
(1012, 12, 1001, '0000-00-00', 'Bagus', 16000, 20000, 4000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`iddetailtransaksi`),
  ADD KEY `idtransaksi` (`idtransaksi`,`idobat`),
  ADD KEY `idobat` (`idobat`);

--
-- Indeks untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`idkaryawan`);

--
-- Indeks untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `idkaryawan` (`idkaryawan`);

--
-- Indeks untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `idkaryawan` (`idkaryawan`),
  ADD KEY `idpelanggan` (`idpelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `iddetailtransaksi` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `idkaryawan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `idpelanggan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `idtransaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_1` FOREIGN KEY (`idobat`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  ADD CONSTRAINT `tb_login_ibfk_1` FOREIGN KEY (`idkaryawan`) REFERENCES `tb_karyawan` (`idkaryawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`idkaryawan`) REFERENCES `tb_karyawan` (`idkaryawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`idpelanggan`) REFERENCES `tb_pelanggan` (`idpelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
