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
(1, 'SS400', 1, 'test', 345345, 2016, '', 'knowledges_base_bg.jpg', '20170523_145633.jpg', 'codepro.png', 'social-icons.png', '', 1, 1, 1, '2022-03-23 07:46:44', NULL),
(2, '232132', 1, 'fsdaf', 110000, 2018, 'Xe Ga', 'featured-img-300.jpg', '', '', '', '', NULL, NULL, NULL, '2022-03-23 18:16:37', NULL),
(3, '43ss1', 1, 'không', 100000, 2018, 'Xe Ga', 'nmax.jpg', '', '', '', '', NULL, NULL, NULL, '2022-03-23 11:07:00', NULL),
(4, '43C2-59434', 1, 'không có', 120000, 2018, 'Xe Côn', 'bike_755x430.png', '', '', '', '', NULL, NULL, NULL, '2022-03-23 11:17:58', NULL),
(5, '43C2-59436', 1, 'không', 110000, 2018, 'Xe Số', 'front-image.jpg', '', '', '', '', NULL, NULL, NULL, '2022-03-23 16:54:03', NULL);

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

CREATE TABLE IF NOT EXISTS `dathang` (
  `id` int(30) NOT NULL PRIMARY KEY,
  `idkhachhang` int(30) NOT NULL,
  `idxe` int(30) NOT NULL,
  `NgayThue` date NOT NULL,
  `NgayTra` date NOT NULL,
  `SoNgayThue` int(11) NOT NULL DEFAULT 0,
  `GiaTriHopDong` float NOT NULL DEFAULT 0,
  `DatTruoc` float NOT NULL DEFAULT 0,
  `ConLai` float NOT NULL DEFAULT 0,
  `GhiChu` varchar(255) DEFAULT NULL,
  `TinhTrang` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Picked -up, 1 =Returned, 2=Cancelled',
  `NgayNhap` datetime NOT NULL DEFAULT current_timestamp(),
  `NgayCapNhat` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- nhập thông tin vào bảng đặt hàng
--

INSERT INTO `dathang` (`id`, `idkhachhang`, `idxe`, `NgayThue`, `NgayTra`,`SoNgayThue`, `GiaTriHopDong`, `DatTruoc`, `ConLai`, `GhiChu`, `TinhTrang`, `NgayNhap`,`NgayCapNhat`) 
VALUES
(1, 1, 2, '2022-04-1', '2022-04-5', 5,550000, 100000, 450000, 'Nón bảo hiểm', 0,'2022-04-1 06:59:27',null);

--Tạo bảng bảo dưỡng

CREATE TABLE IF NOT EXISTS `baoduong` (
  `id` int(30) NOT NULL PRIMARY KEY,
  `idxe` int(30) NOT NULL,
  `ODO` int NOT NULL,
  `num` int(1) NOT NULL,
  `NgayThayDau` date NOT NULL,
  `NgayBDGN` date NOT NULL,
  `NgayBDTT` date NOT NULL,
  `NgayNhap` datetime NOT NULL DEFAULT current_timestamp(),
  `NgayCapNhat` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `baoduong` (`id`, `idxe`, `ODO`, `num`,`NgayThayDau`,`NgayBDGN`,`NgayBDTT`, `NgayNhap`,`NgayCapNhat`) 
VALUES
(1, 1, 10000, 1,'2022-04-1','2022-04-1','2022-07-1','2022-04-1 06:59:27',null);

-- Tạo bảng sửa chữa

CREATE TABLE IF NOT EXISTS `suachua` (
  `id` int(30) NOT NULL PRIMARY KEY,
  `idxe` int(30) NOT NULL,
  `GhiChu` longtext NOT NULL,
  `SoTien` int NOT NULL,
  `NgayNhap` datetime NOT NULL DEFAULT current_timestamp(),
  `NgayCapNhat` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `suachua` (`id`, `idxe`, `GhiChu`, `SoTien`, `NgayNhap`,`NgayCapNhat`) 
VALUES
(1, 1, 'thay lop', 65000,'2022-04-1 06:59:27',null);

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- Tạo bảng bảo hiểm
CREATE TABLE IF NOT EXISTS `suachua` (
  `id` int(30) NOT NULL PRIMARY KEY,
  `idxe` int(30) NOT NULL,
  `GhiChu` longtext NOT NULL,
  `SoTien` int NOT NULL,
  `NgayNhap` datetime NOT NULL DEFAULT current_timestamp(),
  `NgayCapNhat` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `suachua` (`id`, `idxe`, `GhiChu`, `SoTien`, `NgayNhap`,`NgayCapNhat`) 
VALUES
(1, 1, 'thay lop', 65000,'2022-04-1 06:59:27',null);

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
ALTER TABLE `dathang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `baoduong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `suachua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `baohiem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;