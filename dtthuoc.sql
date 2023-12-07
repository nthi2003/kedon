-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 07, 2023 lúc 05:58 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dtthuoc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bacsi`
--

CREATE TABLE `bacsi` (
  `BacSiId` int(255) NOT NULL,
  `TenBS` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bacsi`
--

INSERT INTO `bacsi` (`BacSiId`, `TenBS`, `email`, `phone`) VALUES
(1, 'Nguyễn Văn Quốc Thi', 'quocthi,dev@gmail.com', '0922134131');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `benhnhan`
--

CREATE TABLE `benhnhan` (
  `BenhNhanId` int(255) NOT NULL,
  `TenBenhNhan` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gioitinh` char(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `benhnhan`
--

INSERT INTO `benhnhan` (`BenhNhanId`, `TenBenhNhan`, `gioitinh`, `phone`) VALUES
(6, 'thi2', 'nam', '0904543956');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonthuoc`
--

CREATE TABLE `chitietdonthuoc` (
  `id` int(255) NOT NULL,
  `DonThuocId` int(255) NOT NULL,
  `thuocId` int(255) NOT NULL,
  `tinhthuongxuyen` int(255) NOT NULL,
  `doseOnly` int(255) NOT NULL,
  `doseDay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donthuoc`
--

CREATE TABLE `donthuoc` (
  `DonThuocId` int(255) NOT NULL,
  `BacSiId` int(200) NOT NULL,
  `BenhNhanId` int(255) NOT NULL,
  `NgayBatdau` datetime NOT NULL,
  `NgayKetThuc` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuoc`
--

CREATE TABLE `thuoc` (
  `thuocId` int(255) NOT NULL,
  `tenThuoc` varchar(30) NOT NULL,
  `lieuToiThieu` int(255) NOT NULL,
  `LieuToiDa` int(255) NOT NULL,
  `TanXuat` int(255) NOT NULL,
  `Donvi` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thuoc`
--

INSERT INTO `thuoc` (`thuocId`, `tenThuoc`, `lieuToiThieu`, `LieuToiDa`, `TanXuat`, `Donvi`) VALUES
(4, 'thuoc ho', 2, 10, 1, 100);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bacsi`
--
ALTER TABLE `bacsi`
  ADD PRIMARY KEY (`BacSiId`);

--
-- Chỉ mục cho bảng `benhnhan`
--
ALTER TABLE `benhnhan`
  ADD PRIMARY KEY (`BenhNhanId`);

--
-- Chỉ mục cho bảng `chitietdonthuoc`
--
ALTER TABLE `chitietdonthuoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_donthuoc` (`DonThuocId`),
  ADD KEY `FK_thuoc` (`thuocId`);

--
-- Chỉ mục cho bảng `donthuoc`
--
ALTER TABLE `donthuoc`
  ADD PRIMARY KEY (`DonThuocId`),
  ADD KEY `FK_donthuoc_bacsi` (`BacSiId`),
  ADD KEY `FK_donthuoc_benhnhan` (`BenhNhanId`);

--
-- Chỉ mục cho bảng `thuoc`
--
ALTER TABLE `thuoc`
  ADD PRIMARY KEY (`thuocId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bacsi`
--
ALTER TABLE `bacsi`
  MODIFY `BacSiId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `benhnhan`
--
ALTER TABLE `benhnhan`
  MODIFY `BenhNhanId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `chitietdonthuoc`
--
ALTER TABLE `chitietdonthuoc`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `donthuoc`
--
ALTER TABLE `donthuoc`
  MODIFY `DonThuocId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thuoc`
--
ALTER TABLE `thuoc`
  MODIFY `thuocId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonthuoc`
--
ALTER TABLE `chitietdonthuoc`
  ADD CONSTRAINT `FK_donthuoc` FOREIGN KEY (`DonThuocId`) REFERENCES `donthuoc` (`DonThuocId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_thuoc` FOREIGN KEY (`thuocId`) REFERENCES `thuoc` (`thuocId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donthuoc`
--
ALTER TABLE `donthuoc`
  ADD CONSTRAINT `FK_donthuoc_bacsi` FOREIGN KEY (`BacSiId`) REFERENCES `bacsi` (`BacSiId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_donthuoc_benhnhan` FOREIGN KEY (`BenhNhanId`) REFERENCES `benhnhan` (`BenhNhanId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
