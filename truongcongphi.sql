-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 02:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truongcongphi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bai_giang`
--

CREATE TABLE `bai_giang` (
  `id_bai_giang` int(11) NOT NULL,
  `tieu_de_bai_giang` varchar(255) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `id_khoa_hoc` int(11) DEFAULT NULL,
  `thoi_gian` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bai_giang`
--

INSERT INTO `bai_giang` (`id_bai_giang`, `tieu_de_bai_giang`, `noi_dung`, `id_khoa_hoc`, `thoi_gian`) VALUES
(1, 'TUẦN 10', 'Thêm câu hỏi', 1, '2023-11-16 07:00:59'),
(2, 'Tuần 11', 'Thêm câu hỏi', 1, '2023-11-16 07:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `cau_hoi`
--

CREATE TABLE `cau_hoi` (
  `id_cau_hoi` int(11) NOT NULL,
  `id_bai_giang` int(11) NOT NULL,
  `ten_cau_hoi` varchar(255) NOT NULL,
  `anh` varchar(255) DEFAULT NULL,
  `muc_do` int(11) NOT NULL,
  `loai_cau_hoi` varchar(50) NOT NULL,
  `nguoi_them` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cau_hoi`
--

INSERT INTO `cau_hoi` (`id_cau_hoi`, `id_bai_giang`, `ten_cau_hoi`, `anh`, `muc_do`, `loai_cau_hoi`, `nguoi_them`) VALUES
(1, 2, '1+1= ?', NULL, 1, 'dien', 'tk1');

-- --------------------------------------------------------

--
-- Table structure for table `dap_an`
--

CREATE TABLE `dap_an` (
  `id_dap_an` int(11) NOT NULL,
  `id_cau_hoi` int(11) NOT NULL,
  `ten_dap_an` varchar(255) NOT NULL,
  `dap_an_dung` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id_khoa_hoc` int(11) NOT NULL,
  `ten_khoa_hoc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id_khoa_hoc`, `ten_khoa_hoc`) VALUES
(1, 'Công nghệ web'),
(2, 'Nền tảng phát triển web'),
(3, 'Lập trình mạng');

-- --------------------------------------------------------

--
-- Table structure for table `quan_ly_khoa_hoc`
--

CREATE TABLE `quan_ly_khoa_hoc` (
  `id` int(11) NOT NULL,
  `id_khoa_hoc` int(11) DEFAULT NULL,
  `id_username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quan_ly_khoa_hoc`
--

INSERT INTO `quan_ly_khoa_hoc` (`id`, `id_khoa_hoc`, `id_username`) VALUES
(1, 1, 'tk1'),
(2, 2, 'tk1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', 'c4ca4238a0b923820dcc509a6f75849b'),
('tk1', 'c4ca4238a0b923820dcc509a6f75849b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bai_giang`
--
ALTER TABLE `bai_giang`
  ADD PRIMARY KEY (`id_bai_giang`),
  ADD KEY `id_khoa_hoc` (`id_khoa_hoc`);

--
-- Indexes for table `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD PRIMARY KEY (`id_cau_hoi`),
  ADD KEY `id_bai_giang` (`id_bai_giang`);

--
-- Indexes for table `dap_an`
--
ALTER TABLE `dap_an`
  ADD PRIMARY KEY (`id_dap_an`),
  ADD KEY `id_cau_hoi` (`id_cau_hoi`);

--
-- Indexes for table `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id_khoa_hoc`);

--
-- Indexes for table `quan_ly_khoa_hoc`
--
ALTER TABLE `quan_ly_khoa_hoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_khoa_hoc` (`id_khoa_hoc`),
  ADD KEY `id_username` (`id_username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  MODIFY `id_khoa_hoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bai_giang`
--
ALTER TABLE `bai_giang`
  ADD CONSTRAINT `bai_giang_ibfk_1` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`);

--
-- Constraints for table `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD CONSTRAINT `cau_hoi_ibfk_1` FOREIGN KEY (`id_bai_giang`) REFERENCES `bai_giang` (`id_bai_giang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dap_an`
--
ALTER TABLE `dap_an`
  ADD CONSTRAINT `dap_an_ibfk_1` FOREIGN KEY (`id_cau_hoi`) REFERENCES `cau_hoi` (`id_cau_hoi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quan_ly_khoa_hoc`
--
ALTER TABLE `quan_ly_khoa_hoc`
  ADD CONSTRAINT `quan_ly_khoa_hoc_ibfk_1` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`),
  ADD CONSTRAINT `quan_ly_khoa_hoc_ibfk_2` FOREIGN KEY (`id_username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
