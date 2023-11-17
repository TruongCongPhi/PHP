-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 17, 2023 lúc 07:44 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `truongcongphi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cau_hoi`
--

CREATE TABLE `cau_hoi` (
  `id_cau_hoi` int(11) NOT NULL,
  `id_khoa_hoc` int(11) NOT NULL,
  `ten_cau_hoi` varchar(255) NOT NULL,
  `anh` varchar(255) DEFAULT NULL,
  `muc_do` int(11) NOT NULL,
  `loai_cau_hoi` varchar(50) NOT NULL,
  `nguoi_them` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cau_hoi`
--

INSERT INTO `cau_hoi` (`id_cau_hoi`, `id_khoa_hoc`, `ten_cau_hoi`, `anh`, `muc_do`, `loai_cau_hoi`, `nguoi_them`) VALUES
(1, 1, 'hi', '', 1, 'mot lua chon', 'tk1'),
(2, 1, 'hi', '', 1, 'mot lua chon', 'tk1'),
(3, 1, 'f', '', 1, 'mot lua chon', 'tk1'),
(4, 1, '', '', 1, 'mot lua chon', 'tk1'),
(5, 1, 'hi', '', 1, 'mot lua chon', 'tk1'),
(6, 1, 'd', '', 1, 'mot lua chon', 'tk1'),
(7, 1, 'g', '', 1, 'mot lua chon', 'tk1'),
(8, 1, 'g', '', 1, 'mot lua chon', 'tk1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dap_an`
--

CREATE TABLE `dap_an` (
  `id_dap_an` int(11) NOT NULL,
  `id_cau_hoi` int(11) NOT NULL,
  `ten_dap_an` varchar(255) NOT NULL,
  `dap_an_dung` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dap_an`
--

INSERT INTO `dap_an` (`id_dap_an`, `id_cau_hoi`, `ten_dap_an`, `dap_an_dung`) VALUES
(1, 1, '1', 0),
(2, 1, '2', 0),
(3, 1, '3', 1),
(4, 1, '4', 0),
(5, 2, '1', 0),
(6, 2, '2', 0),
(7, 2, '3', 1),
(8, 2, '4', 0),
(9, 3, 'f', 1),
(10, 3, '3', 0),
(11, 3, '5', 0),
(12, 3, '5', 0),
(13, 3, '3', 0),
(14, 3, '5', 0),
(15, 4, '', 0),
(16, 4, '', 0),
(17, 4, '', 0),
(18, 4, '', 0),
(19, 5, '1', 1),
(20, 5, '', 0),
(21, 5, '', 0),
(22, 5, '', 0),
(23, 6, '', 1),
(24, 6, '', 0),
(25, 6, '', 0),
(26, 6, '', 0),
(27, 7, '', 1),
(28, 7, '', 0),
(29, 7, '', 0),
(30, 7, '', 0),
(31, 8, '', 1),
(32, 8, '', 0),
(33, 8, '', 0),
(34, 8, '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id_khoa_hoc` int(11) NOT NULL,
  `ten_khoa_hoc` varchar(255) NOT NULL,
  `mo_ta_khoa_hoc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id_khoa_hoc`, `ten_khoa_hoc`, `mo_ta_khoa_hoc`) VALUES
(1, 'Công nghệ web', 'Chủ đề: Mảng và chuỗi'),
(2, 'Nền tảng phát triển web', NULL),
(3, 'Lập trình mạng', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quan_ly_khoa_hoc`
--

CREATE TABLE `quan_ly_khoa_hoc` (
  `id` int(11) NOT NULL,
  `id_khoa_hoc` int(11) DEFAULT NULL,
  `id_username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quan_ly_khoa_hoc`
--

INSERT INTO `quan_ly_khoa_hoc` (`id`, `id_khoa_hoc`, `id_username`) VALUES
(1, 1, 'tk1'),
(2, 2, 'tk1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', 'c4ca4238a0b923820dcc509a6f75849b'),
('tk1', 'c4ca4238a0b923820dcc509a6f75849b');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD PRIMARY KEY (`id_cau_hoi`);

--
-- Chỉ mục cho bảng `dap_an`
--
ALTER TABLE `dap_an`
  ADD PRIMARY KEY (`id_dap_an`),
  ADD KEY `id_cau_hoi` (`id_cau_hoi`);

--
-- Chỉ mục cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id_khoa_hoc`);

--
-- Chỉ mục cho bảng `quan_ly_khoa_hoc`
--
ALTER TABLE `quan_ly_khoa_hoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_khoa_hoc` (`id_khoa_hoc`),
  ADD KEY `id_username` (`id_username`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  MODIFY `id_cau_hoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `dap_an`
--
ALTER TABLE `dap_an`
  MODIFY `id_dap_an` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  MODIFY `id_khoa_hoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dap_an`
--
ALTER TABLE `dap_an`
  ADD CONSTRAINT `dap_an_ibfk_1` FOREIGN KEY (`id_cau_hoi`) REFERENCES `cau_hoi` (`id_cau_hoi`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `quan_ly_khoa_hoc`
--
ALTER TABLE `quan_ly_khoa_hoc`
  ADD CONSTRAINT `quan_ly_khoa_hoc_ibfk_1` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`),
  ADD CONSTRAINT `quan_ly_khoa_hoc_ibfk_2` FOREIGN KEY (`id_username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
