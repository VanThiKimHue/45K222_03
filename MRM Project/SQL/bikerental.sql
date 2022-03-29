-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2017 at 07:57 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bikerental`
--

-- --------------------------------------------------------

--
-- Tạo bảng admin
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- nhập dữ liệu vào bảng admin
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4', '2017-06-18 12:22:38');

-- --------------------------------------------------------
-- tạo bảng thongtinxe
CREATE TABLE IF NOT EXISTS`thongtinxe` (
  `id` int(11) NOT NULL primary key,
  `TenXe` varchar(150) DEFAULT NULL,
  `HangXe` int(11) DEFAULT NULL,
  `MoTaXe` longtext DEFAULT NULL,
  `GiaThueTheoNgay` int(11) DEFAULT NULL,
  `NamSanXuat` int(6) DEFAULT NULL,
  `Type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `MuBaoHiem` int(11) DEFAULT NULL,
  `GiaDoDienThoai` int(11) DEFAULT NULL,
  `GheNgoiChoTreEm` int(11) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- nhập dữ liệu bảng `thongtinxe`
--

INSERT INTO `thongtinxe` (`id`, `TenXe`, `HangXe`, `MoTaXe`, `GiaThueTheoNgay`, `NamSanXuat`, `Type`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `MuBaoHiem`, `GiaDoDienThoai`, `GheNgoiChoTreEm`, `RegDate`, `UpdationDate`) VALUES
(1, 'SS400', 2, 'test', 345345, 2016, '', 'knowledges_base_bg.jpg', '20170523_145633.jpg', 'codepro.png', 'social-icons.png', '', 1, 1, 1, '2022-03-23 07:46:44', NULL),
(2, '232132', 3, 'fsdaf', 110000, 2018, 'Xe Ga', 'featured-img-300.jpg', '', '', '', '', NULL, NULL, NULL, '2022-03-23 18:16:37', NULL),
(3, '43ss1', 2, 'không', 100000, 2018, 'Xe Ga', 'nmax.jpg', '', '', '', '', NULL, NULL, NULL, '2022-03-23 11:07:00', NULL),
(4, '43C2-59434', 3, 'không có', 120000, 2018, 'Xe Côn', 'bike_755x430.png', '', '', '', '', NULL, NULL, NULL, '2022-03-23 11:17:58', NULL),
(5, '43C2-59436', 3, 'không', 110000, 2018, 'Xe Số', 'front-image.jpg', '', '', '', '', NULL, NULL, NULL, '2022-03-23 16:54:03', NULL);

-- tạo bảng khách hàng
 CREATE TABLE IF NOT EXISTS `KhachHang` (
  `id` int(11) NOT NULL primary key,
  `HoVaTen` varchar(120) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `CCCD` varchar(20) DEFAULT NULL,
  `SoDienThoai` char(11) DEFAULT NULL,
  `NgaySinh` varchar(100) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `Quan` varchar(100) DEFAULT NULL,
  `ThanhPho` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `KhachHang` (`id`, `HoVaTen`, `Email`, `CCCD`, `SoDienThoai`, `NgaySinh`, `DiaChi`, `Quan`, `ThanhPho`, `RegDate`, `UpdationDate`) VALUES
(1, 'Harry Den', 'demo@gmail.com', '951365745213', '2147483647', '2001-11-11', '336 Cua Dai', 'Hải Châu', 'Đà Nẵng', '2017-06-17 19:59:27', '2017-06-26 21:02:58');
ALTER TABLE `KhachHang`
--
-- tạo bảng hãng xe
CREATE TABLE IF NOT EXISTS `HangXe` (
  `id` int(11) NOT NULL primary key,
  `TenHang` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Thêm dữ liệu vào bảng HangXe
--

INSERT INTO `HangXe` (`id`, `TenHang`, `CreationDate`, `UpdationDate`) VALUES
(1, 'KTM', '2017-06-18 16:24:34', NULL);
-- tạo bảng đặt hàng
--

CREATE TABLE IF NOT EXISTS `DatHang` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `Email` varchar(100) DEFAULT NULL,
  `BienSoXe` varchar(11) DEFAULT NULL,
  `NgayThue` varchar(20) DEFAULT NULL,
  `NgayTra` varchar(20) DEFAULT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- nhập thông tin vào bảng đặt hàng
--

INSERT INTO `DatHang` (`id`, `Email`, `BienSoXe`, `NgayThue`, `NgayTra`, `GhiChu`) VALUES
(1, 'test@gmail.com', '43C1-55035', '22/06/2017', '25/06/2017', 'Lorem ipsum', 'Xedep');
-- --------------------------------------------------------


-- Tạo khóa tự động cho bảng
--  bảng admin
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
-- bảng khách hàng
ALTER TABLE `KhachHang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
-- bảng hãng xe
ALTER TABLE `HangXe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
-- Bảng thông tin xe
ALTER TABLE `thongtinxe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
-- bảng đặt hàng
ALTER TABLE `DatHang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;