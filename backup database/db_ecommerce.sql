-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2021 at 09:51 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(17) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password_akses` varchar(30) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `role_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password_akses`, `nama_lengkap`, `role_admin`) VALUES
(1, 'admin', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` varchar(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
('KAT01', 'ADIDAS ULTRABOOST'),
('KAT02', 'BALENCIAGA'),
('KAT03', 'NEW BALANCE'),
('KAT04', 'NIKE AIRFORCE'),
('KAT05', 'NIKE AIRJORDAN'),
('KAT06', 'NIKE AIRMAX'),
('KAT07', 'ADIDAS YEEZY'),
('KAT08', 'PUMA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` varchar(50) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `id_pelanggan` varchar(17) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `ukuran_produk` varchar(5) NOT NULL,
  `quantity_produk` int(11) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `subtotal_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `id_produk`, `id_pelanggan`, `nama_produk`, `ukuran_produk`, `quantity_produk`, `harga_produk`, `subtotal_produk`) VALUES
('OR12710602119900040', 'NF07', '1271060211990004', 'NIKE Airforce 1 07 Lx Bio ', '36', 2, 530000, 1060000),
('OR12710602119900041', 'AJ11', '1271060211990004', 'NIKE Air Jordan 1 Panda ', '42', 1, 530000, 530000),
('OR12710602119900041', 'NB06', '1271060211990004', 'NEW BALANCE', '42', 1, 245000, 245000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` varchar(17) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_akses` varchar(30) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_lengkap` varchar(500) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `nomor_rekening` varchar(20) NOT NULL,
  `nama_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `email`, `password_akses`, `nama_lengkap`, `tanggal_lahir`, `alamat_lengkap`, `nomor_telepon`, `nomor_rekening`, `nama_bank`) VALUES
('12131415161718', 'putrihidayah1616@gmail.com', 'testes', 'Putri Aja', '2021-08-02', 'kelambir 5', '6285360091852', '', 'Bank Negara Indonesia (BNI)'),
('1271060211990004', 'customer@email.com', 'customer', 'Customer', '1999-11-02', 'ini alamatku', '6285156370127', '8280377630', 'Bank Central Asia (BCA)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `id_usaha` varchar(20) NOT NULL,
  `nama_usaha` varchar(100) NOT NULL,
  `alamat_usaha` varchar(500) NOT NULL,
  `no_telepon_usaha` varchar(15) NOT NULL,
  `email_usaha` varchar(50) NOT NULL,
  `instagram_usaha` varchar(50) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `nomor_rekening_usaha` varchar(20) NOT NULL,
  `nama_bank_usaha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_usaha`, `nama_usaha`, `alamat_usaha`, `no_telepon_usaha`, `email_usaha`, `instagram_usaha`, `nama_pemilik`, `nomor_rekening_usaha`, `nama_bank_usaha`) VALUES
('ECM01', 'CV.Raja Group Indonesia', 'Jl.Cempaka No.61, Kec.Medan Helvetia, Medan, Sumatera Utara, 20125', '085369167831', 'contact@rajagroupindonesia.com', 'rajasneakers.id', 'CV. Raja Group Indonesia', '7865206488', 'Bank Central Asia (BCA)'),
('ECM02', 'CV.Raja Group Indonesia', 'Jl.Cempaka No.61, Kec.Medan Helvetia, Medan, Sumatera Utara, 20125', '085369167831', 'contact@rajagroupindonesia.com', 'rajasneakers.id', 'CV. Raja Group Indonesia', '2418376512', 'Bank Negara Indonesia (BNI)'),
('ECM03', 'CV.Raja Group Indonesia', 'Jl.Cempaka No.61, Kec.Medan Helvetia, Medan, Sumatera Utara, 20125', '085369167831', 'contact@rajagroupindonesia.com', 'rajasneakers.id', 'CV. Raja Group Indonesia', '1060011648964', 'Bank Mandiri'),
('ECM04', 'CV.Raja Group Indonesia', 'Jl.Cempaka No.61, Kec.Medan Helvetia, Medan, Sumatera Utara, 20125', '085369167831', 'contact@rajagroupindonesia.com', 'rajasneakers.id', 'CV. Raja Group Indonesia', '529801002010502', 'Bank Rakyat Indonesia (BRI)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `kategori_produk` varchar(50) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `ukuran_produk` varchar(5) NOT NULL,
  `deskripsi_produk` varchar(500) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `harga_produk`, `kategori_produk`, `stok_produk`, `ukuran_produk`, `deskripsi_produk`, `gambar_produk`) VALUES
('AD01', 'ADIDAS UltraBoost Woman', 345000, 'ADIDAS ULTRABOOST', 1, '36-41', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori\r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AD01.png'),
('AD02', 'ADIDAS UltraBoost Woman', 345000, 'ADIDAS ULTRABOOST', 20, '36-41', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AD02.png'),
('AD03', 'ADIDAS Ultraboost', 235000, 'ADIDAS ULTRABOOST', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AD03.png'),
('AD04', 'ADIDAS UltraBoost 4.0', 335000, 'ADIDAS ULTRABOOST', 20, '36-41', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AD04.png'),
('AD05', 'ADIDAS Ultraboost', 305000, 'ADIDAS ULTRABOOST', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AD05.png'),
('AD06', 'ADIDAS Ultraboost Ace 16 Man', 325000, 'ADIDAS ULTRABOOST', 20, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori\r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan\r\n\r\n\r\n', 'AD06.png'),
('AD07', 'ADIDAS Ultraboost 4.0 \"Dash Grey\"', 650000, 'ADIDAS ULTRABOOST', 17, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n\r\n', 'AD07.png'),
('AD08', 'ADIDAS Ultraboost 20 â€œCore Black Goldâ€œ ', 530000, 'ADIDAS ULTRABOOST', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n\r\n', 'AD08.png'),
('AD09', 'ADIDAS Ace 16+ Purecontrol Ultraboost', 590000, 'ADIDAS ULTRABOOST', 18, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AD09.png'),
('AD10', 'ADIDAS Ultraboost 3.0 \"Triple Black\"', 540000, 'ADIDAS ULTRABOOST', 20, '39-45', 'â€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n\r\n', 'AD10.png'),
('AD11', 'ADIDAS Ultraboost 3.0 \"Full White\"', 500000, 'ADIDAS ULTRABOOST', 20, '36-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AD11.png'),
('AD12', 'ADIDAS Ultraboost 20 ', 530000, 'ADIDAS ULTRABOOST', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n\r\n\r\n', 'AD12.png'),
('AD13', 'ADIDAS Ultraboost 4.0 Orca', 620000, 'ADIDAS ULTRABOOST', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AD13.png'),
('AJ01', 'NIKE Air Jordan Obsidian', 345000, 'NIKE AIRJORDAN', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AJ01.png'),
('AJ02', 'NIKE Air Jordan Low', 305000, 'NIKE AIRJORDAN', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AJ02.png'),
('AJ03', 'NIKE Air Jordan 1 Retro High For Man', 275000, 'NIKE AIRJORDAN', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AJ03.png'),
('AJ04', 'NIKE Air Jordan 4', 325000, 'NIKE AIRJORDAN', 13, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AJ04.png'),
('AJ05', 'NIKE Air Jordan 1 High ', 520000, 'NIKE AIRJORDAN', 15, '36-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ05.png'),
('AJ06', 'NIKE Air Jordan 1 Retro High ', 690000, 'NIKE AIRJORDAN', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ06.png'),
('AJ07', 'NIKE Air Jordan 1 Mid ', 580000, 'NIKE AIRJORDAN', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ07.png'),
('AJ08', 'NIKE Air Jordan 1 High ', 580000, 'NIKE AIRJORDAN', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ08.png'),
('AJ09', 'NIKE Air Jordan 1 Low \"Black Toe\"', 480000, 'ADIDAS ULTRABOOST', 15, '37-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ09.png'),
('AJ10', 'NIKE Air Jordan 1 High \"Black Toe\"', 530000, 'NIKE AIRJORDAN', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ10.png'),
('AJ11', 'NIKE Air Jordan 1 Panda ', 530000, 'NIKE AIRJORDAN', 14, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ11.png'),
('AJ12', 'NIKE Air Jordan 4 â€œWhat The\"', 550000, 'NIKE AIRJORDAN', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ12.png'),
('AJ14', 'NIKE Air Jordan 1 Mid SE \"Shadow Pink\"', 530000, 'NIKE AIRJORDAN', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ14.png'),
('AJ15', 'NIKE Air Jordan 1 \"Magenta Maroon\"', 580, 'NIKE AIRJORDAN', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AJ15.png'),
('AX01', 'NIKE Airmax 720 Import', 295000, 'NIKE AIRMAX', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AX01.png'),
('AX02', 'NIKE Airmax 270', 355000, 'NIKE AIRMAX', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AX02.png'),
('AX03', 'NIKE Airmax 720', 355000, 'NIKE AIRMAX', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AX03.png'),
('AX04', 'NIKE Airmax 720', 345000, 'NIKE AIRMAX', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AX04.png'),
('AX05', 'NIKE Airmax 270 Seattle Home ', 670000, 'NIKE AIRMAX', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AX05.png'),
('AX06', 'NIKE Airmax 270 ', 500000, 'NIKE AIRMAX', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AX06.png'),
('AX07', 'NIKE Airmax 720 ', 620000, 'NIKE AIRMAX', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AX07.png'),
('AX08', 'NIKE Airmax 97 Lx ', 560000, 'NIKE AIRMAX', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AX08.png'),
('AX09', 'NIKE Airmax 97 ', 540000, 'NIKE AIRMAX', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'AX09.png'),
('AY001', 'ADIDAS Yeezy SPLY 350', 225000, 'ADIDAS YEEZY', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AY001.png'),
('AY002', 'ADIDAS Yeezy SPLY 350', 225000, 'ADIDAS ULTRABOOST', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AY002.png'),
('AY003', 'ADIDAS sply 350', 225000, 'ADIDAS ULTRABOOST', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AY003.png'),
('AY004', 'ADIDAS Yeezy Boost 700 Man', 335000, 'ADIDAS YEEZY', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AY004.png'),
('AY005', 'ADIDAS Yeezy V2', 345000, 'ADIDAS YEEZY', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'AY005.png'),
('AY006', 'ADIDAS Yeezy Boost 700 ', 540000, 'ADIDAS YEEZY', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY006.png'),
('AY007', 'ADIDAS Yeezy Boost 350 Beluga Couple', 470000, 'ADIDAS YEEZY', 15, '36-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY007.png'),
('AY008', 'ADIDAS Yeezy Boost 350 V2 Blue \" Antlia \"', 590000, 'ADIDAS YEEZY', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY008.png'),
('AY009', 'ADIDAS Yeezy V2 Glow In The Dark', 590000, 'ADIDAS YEEZY', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY009.png'),
('AY010', 'ADIDAS Yeezy Boost 350 V2 \" Black Static \"', 660000, 'ADIDAS YEEZY', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY010.png'),
('AY011', 'ADIDAS Yeezy Boost 350 X Kaws White', 550000, 'ADIDAS YEEZY', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY011.png'),
('AY015', 'ADIDAS Yeezy Boost 350 V2 \"Pink\"', 565000, 'ADIDAS YEEZY', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY15.png'),
('AY016', 'ADIDAS Yeezy Boost 350 V2 \"True Form\"', 570000, 'ADIDAS YEEZY', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY16.png'),
('AY017', 'ADIDAS Yeezy Boost 700 \"Inertia\"', 640000, 'ADIDAS YEEZY', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY17.png'),
('AY018', 'ADIDAS Yeezy Boost V2 350 \"Black Red\"', 570000, 'ADIDAS YEEZY', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY18.png'),
('AY019', 'ADIDAS Yeezy Boost 350 V2 ', 590000, 'ADIDAS YEEZY', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY19.png'),
('AY020', 'ADIDAS Yeezy Boost 350 V2 \"Linen\"', 570000, 'ADIDAS ULTRABOOST', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'AY20.png'),
('BC01', 'BALENCIAGA Woman', 295000, 'ADIDAS ULTRABOOST', 20, '37-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'BC01.png'),
('BC02', 'BALENCIAGA Triple S Man', 325000, 'BALENCIAGA', 20, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'BC02.png'),
('BC03', 'BALENCIAGA Triple S For Woman', 375000, 'BALENCIAGA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'BC03.png'),
('BC05', 'BALENCIAGA Triple S For Woman', 375000, 'BALENCIAGA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'BC05.png'),
('BC06', 'BALENCIAGA Triple S For Woman', 375000, 'BALENCIAGA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'BC06.png'),
('BC07', 'BALENCIAGA Triple S For Woman', 375000, 'BALENCIAGA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'BC07.png'),
('BC08', 'BALENCIAGA Triple S For Woman', 375000, 'BALENCIAGA', 19, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'BC08.png'),
('BC09', 'BALENCIAGA Shoes', 325000, 'BALENCIAGA', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'BC09.png'),
('BC10', 'BALENCIAGA Triple S ', 750000, 'BALENCIAGA', 15, '37-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'BC10.png'),
('BC11', 'BALENCIAGA Triple S ', 730000, 'BALENCIAGA', 15, '37-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'BC11.png'),
('BC12', 'BALENCIAGA Triple S Clear Sole ', 830000, 'BALENCIAGA', 10, '37-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'BC12.png'),
('BC13', 'BALENCIAGA Triple S â€œWhiteâ€œ ', 750000, 'BALENCIAGA', 15, '37-41', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan\r\n', 'BC13.png'),
('BC15', 'BALENCIAGA Triple S \"Cream Pink\"', 750000, 'BALENCIAGA', 20, '37-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'BC15.png'),
('BC16', 'BALENCIAGA Triple S \"Red Blue\"', 750000, 'BALENCIAGA', 4, '36-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'BC16.png'),
('BC18', 'BALENCIAGA Triple S Black Red', 750000, 'BALENCIAGA', 20, '40-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'BC18.png'),
('BC19', 'BALENCIAGA Triple S \"Triple White\"', 750000, 'BALENCIAGA', 20, '37-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'BC19.png'),
('BC20', 'BALENCIAGA Triple S Triple Black', 750000, 'BALENCIAGA', 20, '40-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'BC20.png'),
('NB01', 'NEW BALANCE For Man', 275000, 'NEW BALANCE', 15, '39-43', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan\r\n', 'NB01.png'),
('NB02', 'NEW BALANCE', 245000, 'NEW BALANCE', 15, '36-43', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NB02.png'),
('NB03', 'NEW BALANCE', 245000, 'NEW BALANCE', 15, '36-43', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NB03.png'),
('NB04', 'NEW BALANCE', 245000, 'NEW BALANCE', 15, '36-43', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NB04.png'),
('NB05', 'NEW BALANCE', 245000, 'NEW BALANCE', 13, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NB05.png'),
('NB06', 'NEW BALANCE', 245000, 'NEW BALANCE', 14, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NB06.png'),
('NB07', 'NEW BALANCE Woman', 245000, 'NEW BALANCE', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NB07.png'),
('NB08', 'NEW BALANCE Woman', 335000, 'NEW BALANCE', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NB08.png'),
('NB09', 'NEW BALANCE 574 GNC ', 615000, 'NEW BALANCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NB09.png'),
('NB10', 'NEW B4LANCE 574 Sport \" Flight path \" ', 600000, 'NEW BALANCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NB10.png'),
('NB11', 'NEW BALANCE 2003R \"Light Grey\"', 650000, 'NEW BALANCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NB11.png'),
('NB12', 'NEW B4LANCE 574S \" All Black \"', 600000, 'NEW BALANCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NB12.png'),
('NB14', 'NEW B4LANCE MS247TG \" Tritium Pack \"', 570000, 'NEW BALANCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NB14.png'),
('NB15', 'NEW BALANCE 1500 Surplus Pack', 590000, 'NEW BALANCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NB15.png'),
('NB16', 'NEW BALANCE 574', 540000, 'NEW BALANCE', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NB16.png'),
('NF01', 'NIKE Airforce Untility', 285000, 'NIKE AIRFORCE', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NF01.png'),
('NF02', 'NIKE Airforce \"All White \"', 375000, 'NIKE AIRFORCE', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NF02.png'),
('NF03', 'NIKE Air Force 1 for Man', 385000, 'NIKE AIRFORCE', 15, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NF03.png'),
('NF04', 'NIKE Airforce 1 \"Brown\"', 310000, 'NIKE AIRFORCE', 15, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NF04.png'),
('NF05', 'NIKE Air Force 1 Low ', 600000, 'NIKE AIRFORCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NF05.png'),
('NF06', 'NIKE Airforce 1 Crest Logo ', 500000, 'ADIDAS ULTRABOOST', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NF06.png'),
('NF07', 'NIKE Airforce 1 07 Lx Bio ', 530000, 'NIKE AIRFORCE', 13, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NF07.png'),
('NF08', 'Nike Air Force x Off White 1 MCA', 890000, 'NIKE AIRFORCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NF08.png'),
('NF09', 'NIKE Airforce 1 Low X Off White', 740000, 'NIKE AIRFORCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NF09.png'),
('NF10', 'NIKE Airforce 1 Utility ', 590000, 'NIKE AIRFORCE', 15, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'NF10.png'),
('NF11', 'NIKE Airforce 1', 315000, 'ADIDAS ULTRABOOST', 20, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NF11.png'),
('NF12', 'NIKE Airforce \"Triple Black\"', 380000, 'NIKE AIRFORCE', 20, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NF12.png'),
('NF13', 'NIKE Airforce 1 Utility Low \"Baby Pink\"', 310000, 'NIKE AIRFORCE', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NF13.png'),
('NF14', 'NIKE Airforce 1 Woman', 335000, 'NIKE AIRFORCE', 20, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'NF14.png'),
('PM001', 'PUMA Suede â€˜Black Camoâ€™', 290000, 'PUMA', 20, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'PM001.png'),
('PM002', 'Puma Suede', 235000, 'PUMA', 20, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'PM002.png'),
('PM003', 'PUMA Suede Man', 235000, 'PUMA', 20, '39-44', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'PM003.png'),
('PM004', 'PUMA Rihanna', 305000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'PM004.png'),
('PM005', 'PUMA Rihanna', 305000, 'ADIDAS ULTRABOOST', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'PM005.png'),
('PM006', 'PUMA Rihanna', 305000, 'ADIDAS ULTRABOOST', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'PM006.png'),
('PM007', 'PUMA Rihanna Woman', 215000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang Grade Ori \r\nâ€¢ Garansi 100% uang kembali jika barang tidak sampai tujuan', 'PM007.png'),
('PM008', 'PUMA Suede Clasic Trainers â€œGrey Blue\"', 500000, 'PUMA', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM008.png'),
('PM009', 'PUMA Muse X2 \"Metallic Black Rose Gold\"', 650000, 'PUMA', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM009.png'),
('PM010', 'PUMA Nova X Sue Tsai \"Bright White\"', 650000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM010.png'),
('PM011', 'PUMA Muse 2 Satin Strap \"Peach Beige\"', 640000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM011.png'),
('PM012', 'PUMA Muse 2 Satin Strap \"Black Metallic\"', 640000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM012.png'),
('PM013', 'PUMA X Ader Error Suede', 565000, 'PUMA', 20, '39-45', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM013.png'),
('PM014', 'PUMA Cali X Slena Gomez \"White Black\"', 790000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM014.png'),
('PM015', 'PUMA Cali X Selena Gomes \"Triple White\"', 790000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM015.png'),
('PM016', 'PUMA RS-X Reinvention \"White Peach\"', 660000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM016.png'),
('PM017', 'PUMA RS-X Reinvention \"Sweet Lavender\"', 660000, 'PUMA', 20, '36-40', 'â€¢ 100% Realpict\r\nâ€¢ Kualitas barang DIJAMIN terbaik (BNIB PREMIUM HIGH QUALITY)\r\nâ€¢ GARANSI 100% uang kembali jika barang tidak sampai tujuan', 'PM017.png'),
('TES01', 'TES 01', 200000, 'ADIDAS ULTRABOOST', 9, '39-45', 'asfaeg', 'TES01.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_order` varchar(50) NOT NULL,
  `id_pelanggan` varchar(17) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `waktu_transaksi` time NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `status_transaksi` varchar(20) NOT NULL,
  `nomor_rekening_pelanggan` varchar(20) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `kota_tujuan` varchar(200) NOT NULL,
  `alamat_lengkap` varchar(1000) NOT NULL,
  `kurir_pengiriman` varchar(100) NOT NULL,
  `berat_kiriman` varchar(3) NOT NULL,
  `layanan_pengiriman` varchar(100) NOT NULL,
  `tarif_pengiriman` int(11) NOT NULL,
  `estimasi_pengiriman` varchar(10) NOT NULL,
  `nomor_resi_kurir` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_order`, `id_pelanggan`, `tanggal_transaksi`, `waktu_transaksi`, `total_transaksi`, `status_transaksi`, `nomor_rekening_pelanggan`, `bukti_pembayaran`, `kota_tujuan`, `alamat_lengkap`, `kurir_pengiriman`, `berat_kiriman`, `layanan_pengiriman`, `tarif_pengiriman`, `estimasi_pengiriman`, `nomor_resi_kurir`) VALUES
('TR12710602119900040', 'OR12710602119900040', '1271060211990004', '2021-09-06', '09:33:31', 1106000, 'Dalam Pengiriman', '8280377630', 'TR12710602119900040', 'Aceh Barat, Nanggroe Aceh Darussalam (NAD)', 'ini alamatku', 'jne', '1.5', 'OKE', 46000, '4-6 Hari', 'J1239875402'),
('TR12710602119900041', 'OR12710602119900041', '1271060211990004', '2021-09-06', '09:50:19', 789000, 'Belum Dibayar', '8280377630', 'TR12710602119900041', 'Medan, Sumatera Utara', 'ini alamatku', 'pos', '1.5', 'Paket Kilat Khusus', 14000, '2 HARI Har', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`id_usaha`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
