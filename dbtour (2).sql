-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 10, 2025 lúc 08:31 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dbtour`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `status` enum('present','absent') DEFAULT 'present',
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `attendance`
--

INSERT INTO `attendance` (`id`, `booking_id`, `customer_id`, `status`, `note`) VALUES
(130, 18, 38, 'present', NULL),
(131, 18, 37, 'present', NULL),
(132, 18, 36, 'present', NULL),
(133, 19, 50, 'absent', NULL),
(134, 19, 49, 'absent', NULL),
(135, 19, 48, 'absent', NULL),
(136, 19, 47, 'absent', NULL),
(140, 21, 1, 'present', NULL),
(141, 21, 2, 'present', NULL),
(142, 21, 3, 'present', NULL),
(143, 22, 4, 'present', NULL),
(144, 22, 5, 'present', NULL),
(145, 22, 6, 'present', NULL),
(146, 23, 7, 'present', NULL),
(147, 23, 8, 'present', NULL),
(148, 23, 9, 'present', NULL),
(152, 25, 13, 'present', NULL),
(153, 25, 14, 'present', NULL),
(154, 25, 15, 'present', NULL),
(155, 26, 16, 'present', NULL),
(156, 26, 17, 'present', NULL),
(157, 26, 18, 'present', NULL),
(158, 27, 19, 'present', NULL),
(159, 27, 20, 'present', NULL),
(160, 27, 21, 'present', NULL),
(161, 28, 22, 'present', NULL),
(162, 28, 23, 'present', NULL),
(163, 28, 24, 'present', NULL),
(164, 29, 25, 'present', NULL),
(165, 29, 26, 'present', NULL),
(166, 29, 27, 'present', NULL),
(167, 30, 28, 'present', NULL),
(168, 30, 29, 'present', NULL),
(169, 30, 30, 'present', NULL),
(170, 31, 31, 'present', NULL),
(171, 31, 32, 'present', NULL),
(172, 31, 33, 'present', NULL),
(173, 32, 34, 'present', NULL),
(174, 32, 35, 'present', NULL),
(175, 32, 36, 'present', NULL),
(176, 33, 37, 'present', NULL),
(177, 33, 38, 'present', NULL),
(178, 33, 39, 'present', NULL),
(182, 35, 43, 'present', NULL),
(183, 35, 44, 'present', NULL),
(184, 35, 45, 'present', NULL),
(185, 36, 46, 'present', NULL),
(186, 36, 47, 'present', NULL),
(187, 36, 48, 'present', NULL),
(188, 37, 49, 'present', NULL),
(189, 37, 50, 'present', NULL),
(190, 37, 1, 'present', NULL),
(191, 38, 2, 'present', NULL),
(192, 38, 3, 'present', NULL),
(193, 38, 4, 'present', NULL),
(197, 40, 8, 'present', NULL),
(198, 40, 9, 'present', NULL),
(199, 40, 10, 'present', NULL),
(200, 13, 42, 'absent', NULL),
(201, 13, 41, 'absent', NULL),
(202, 13, 40, 'absent', NULL),
(207, 42, 50, 'absent', NULL),
(208, 42, 50, 'absent', NULL),
(209, 42, 49, 'absent', NULL),
(210, 42, 48, 'absent', NULL),
(211, 42, 47, 'absent', NULL),
(212, 42, 46, 'absent', NULL),
(213, 42, 44, 'absent', NULL),
(219, 43, 50, 'absent', NULL),
(220, 43, 49, 'absent', NULL),
(221, 43, 48, 'absent', NULL),
(222, 43, 47, 'absent', NULL),
(223, 43, 46, 'absent', NULL),
(248, 44, 50, 'absent', NULL),
(249, 44, 49, 'absent', NULL),
(250, 44, 48, 'absent', NULL),
(251, 44, 47, 'absent', NULL),
(252, 44, 46, 'absent', NULL),
(253, 44, 45, 'absent', NULL),
(254, 44, 44, 'absent', NULL),
(255, 44, 43, 'absent', NULL),
(256, 45, 29, 'present', NULL),
(257, 45, 28, 'present', NULL),
(258, 45, 27, 'present', NULL),
(259, 45, 26, 'absent', NULL),
(260, 46, 1, 'present', NULL),
(261, 46, 2, 'present', NULL),
(262, 46, 3, 'present', NULL),
(263, 47, 4, 'present', NULL),
(264, 47, 5, 'present', NULL),
(265, 47, 6, 'present', NULL),
(266, 48, 7, 'present', NULL),
(267, 48, 8, 'present', NULL),
(268, 48, 9, 'present', NULL),
(269, 49, 10, 'present', NULL),
(270, 49, 11, 'present', NULL),
(271, 49, 12, 'present', NULL),
(272, 70, 1, 'present', NULL),
(273, 70, 2, 'present', NULL),
(274, 70, 3, 'present', NULL),
(275, 71, 4, 'present', NULL),
(276, 71, 5, 'present', NULL),
(277, 71, 6, 'present', NULL),
(278, 72, 7, 'present', NULL),
(279, 72, 8, 'present', NULL),
(280, 72, 9, 'present', NULL),
(281, 73, 10, 'present', NULL),
(282, 73, 11, 'present', NULL),
(283, 73, 12, 'present', NULL),
(284, 74, 13, 'present', NULL),
(285, 74, 14, 'present', NULL),
(286, 74, 15, 'present', NULL),
(287, 75, 16, 'present', NULL),
(288, 75, 17, 'present', NULL),
(289, 75, 18, 'present', NULL),
(290, 76, 19, 'present', NULL),
(291, 76, 20, 'present', NULL),
(292, 76, 21, 'present', NULL),
(293, 77, 22, 'present', NULL),
(294, 77, 23, 'present', NULL),
(295, 77, 24, 'present', NULL),
(296, 78, 25, 'present', NULL),
(297, 78, 26, 'present', NULL),
(298, 78, 27, 'present', NULL),
(299, 79, 28, 'present', NULL),
(300, 79, 29, 'present', NULL),
(301, 79, 30, 'present', NULL),
(302, 15, 50, 'absent', NULL),
(303, 15, 49, 'absent', NULL),
(304, 15, 48, 'absent', NULL),
(305, 15, 44, 'absent', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int NOT NULL,
  `tour_id` int DEFAULT NULL,
  `guide_id` int DEFAULT NULL,
  `hotel_id` int DEFAULT NULL,
  `vehicle_id` int DEFAULT NULL,
  `status` enum('sap_dien_ra','dang_dien_ra','cho_xac_nhan_ket_thuc','da_hoan_thanh','da_huy') NOT NULL DEFAULT 'sap_dien_ra',
  `report` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`booking_id`, `tour_id`, `guide_id`, `hotel_id`, `vehicle_id`, `status`, `report`, `created_at`, `start_date`, `end_date`, `total_price`, `note`) VALUES
(13, 3, 2, 1, 4, 'dang_dien_ra', '', '2025-12-05 09:25:47', '2025-12-06', '2025-12-09', 0.00, 'auogwfihhwfa'),
(15, 1, 3, 5, 4, 'da_hoan_thanh', '', '2025-12-07 03:30:22', '2025-12-27', '2025-12-30', 0.00, 'auogwfihhwfa'),
(18, 1, 1, 2, 4, 'da_hoan_thanh', '', '2025-12-07 03:40:36', '2025-12-20', '2025-12-23', 0.00, 'auogwfihhwfa'),
(19, 1, 4, 3, 4, 'da_hoan_thanh', '', '2025-12-07 04:10:52', '2025-11-07', '2025-11-10', 0.00, 'auogwfihhwfa'),
(21, 1, 1, 1, 1, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-01-05', '2025-01-08', 0.00, 'auogwfihhwfa'),
(22, 2, 2, 2, 2, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-01-18', '2025-01-22', 0.00, 'auogwfihhwfa'),
(23, 3, 3, 3, 3, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-02-05', '2025-02-08', 0.00, 'auogwfihhwfa'),
(25, 1, 5, 5, 5, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-03-05', '2025-03-08', 0.00, 'auogwfihhwfa'),
(26, 2, 1, 1, 1, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-03-18', '2025-03-22', 0.00, 'auogwfihhwfa'),
(27, 3, 2, 2, 2, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-04-05', '2025-04-08', 0.00, 'auogwfihhwfa'),
(28, 4, 3, 3, 3, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-04-18', '2025-04-23', 0.00, 'auogwfihhwfa'),
(29, 1, 4, 4, 4, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-05-05', '2025-05-08', 0.00, 'auogwfihhwfa'),
(30, 2, 5, 5, 5, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-05-18', '2025-05-22', 0.00, 'auogwfihhwfa'),
(31, 3, 1, 1, 1, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-06-05', '2025-06-08', 0.00, 'auogwfihhwfa'),
(32, 4, 2, 2, 2, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-06-18', '2025-06-23', 0.00, 'auogwfihhwfa'),
(33, 1, 3, 3, 3, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-07-05', '2025-07-08', 0.00, 'auogwfihhwfa'),
(35, 3, 5, 5, 5, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-08-05', '2025-08-08', 0.00, 'auogwfihhwfa'),
(36, 4, 1, 1, 1, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-08-18', '2025-08-23', 0.00, 'auogwfihhwfa'),
(37, 1, 2, 2, 2, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-09-05', '2025-09-08', 0.00, 'auogwfihhwfa'),
(38, 2, 3, 3, 3, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-09-18', '2025-09-22', 0.00, 'auogwfihhwfa'),
(40, 4, 5, 5, 5, 'da_hoan_thanh', '', '2024-12-15 02:00:00', '2025-10-18', '2025-10-23', 0.00, 'auogwfihhwfa'),
(42, 17, 1, 3, 4, 'cho_xac_nhan_ket_thuc', '', '2025-12-08 02:59:37', '2025-10-31', '2025-11-02', 0.00, 'auogwfihhwfa'),
(43, 22, 1, 3, 3, 'cho_xac_nhan_ket_thuc', '', '2025-12-08 03:30:25', '2025-12-01', '2025-12-06', 0.00, 'auogwfihhwfa'),
(44, 24, 3, 4, 5, 'dang_dien_ra', '', '2025-12-08 03:31:24', '2025-12-08', '2025-12-12', 0.00, 'auogwfihhwfa'),
(45, 15, 1, 5, 4, 'da_hoan_thanh', '', '2025-12-08 03:35:08', '2025-12-08', '2025-12-10', 0.00, 'auogwfihhwfa'),
(46, 1, 1, 1, 1, 'dang_dien_ra', '', '2025-12-08 23:42:45', '2025-12-07', '2025-12-10', 0.00, 'Tour đang hoạt động ổn định'),
(47, 2, 2, 2, 2, 'dang_dien_ra', '', '2025-12-08 23:42:45', '2025-12-08', '2025-12-12', 0.00, 'Khách phản hồi tốt'),
(48, 3, 3, 3, 3, 'sap_dien_ra', '', '2025-12-08 23:42:45', '2025-12-15', '2025-12-18', 0.00, 'Chuẩn bị triển khai tour'),
(49, 4, 4, 4, 4, 'sap_dien_ra', '', '2025-12-08 23:42:45', '2025-12-20', '2025-12-25', 0.00, 'Tour dự kiến đông khách'),
(70, 1, 1, 1, 1, 'dang_dien_ra', '', '2025-12-08 23:46:37', '2025-12-07', '2025-12-10', 0.00, 'Tour đông khách'),
(71, 2, 2, 2, 2, 'dang_dien_ra', '', '2025-12-08 23:46:37', '2025-12-06', '2025-12-11', 0.00, 'Khách checkin chậm'),
(72, 3, 3, 3, 3, 'dang_dien_ra', '', '2025-12-08 23:46:37', '2025-12-05', '2025-12-09', 0.00, 'HDV phản hồi tốt'),
(73, 4, 4, 4, 4, 'dang_dien_ra', '', '2025-12-08 23:46:37', '2025-12-08', '2025-12-12', 0.00, 'Thời tiết xấu'),
(74, 15, 5, 5, 5, 'dang_dien_ra', '', '2025-12-08 23:46:37', '2025-12-09', '2025-12-14', 0.00, 'Xe đến trễ 15 phút'),
(75, 1, 1, 1, 1, 'sap_dien_ra', '', '2025-12-08 23:46:37', '2025-12-15', '2025-12-18', 0.00, 'Tour sắp khởi hành'),
(76, 2, 2, 2, 2, 'sap_dien_ra', '', '2025-12-08 23:46:37', '2025-12-17', '2025-12-20', 0.00, 'Dự kiến đông khách'),
(77, 3, 3, 3, 3, 'sap_dien_ra', '', '2025-12-08 23:46:37', '2025-12-19', '2025-12-23', 0.00, 'Chuẩn bị thêm xe'),
(78, 4, 4, 4, 4, 'sap_dien_ra', '', '2025-12-08 23:46:37', '2025-12-21', '2025-12-25', 0.00, 'HDV đã nhận lịch'),
(79, 16, 5, 5, 5, 'sap_dien_ra', '', '2025-12-08 23:46:37', '2025-12-22', '2025-12-27', 0.00, 'Khách đang hoàn tất thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_customers`
--

CREATE TABLE `booking_customers` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `is_main` tinyint(1) DEFAULT '0',
  `price_per_customer` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_customers`
--

INSERT INTO `booking_customers` (`id`, `booking_id`, `customer_id`, `is_main`, `price_per_customer`) VALUES
(130, 18, 38, 1, 7900000),
(131, 18, 37, 0, 7900000),
(132, 18, 36, 0, 7900000),
(133, 19, 50, 0, 8475000),
(134, 19, 49, 1, 8475000),
(135, 19, 48, 0, 8475000),
(136, 19, 47, 0, 8475000),
(140, 21, 1, 1, 5000000),
(141, 21, 2, 0, 5000000),
(142, 21, 3, 0, 5000000),
(143, 22, 4, 1, 5100000),
(144, 22, 5, 0, 5100000),
(145, 22, 6, 0, 5100000),
(146, 23, 7, 1, 5200000),
(147, 23, 8, 0, 5200000),
(148, 23, 9, 0, 5200000),
(152, 25, 13, 1, 5400000),
(153, 25, 14, 0, 5400000),
(154, 25, 15, 0, 5400000),
(155, 26, 16, 1, 5500000),
(156, 26, 17, 0, 5500000),
(157, 26, 18, 0, 5500000),
(158, 27, 19, 1, 5600000),
(159, 27, 20, 0, 5600000),
(160, 27, 21, 0, 5600000),
(161, 28, 22, 1, 5700000),
(162, 28, 23, 0, 5700000),
(163, 28, 24, 0, 5700000),
(164, 29, 25, 1, 5800000),
(165, 29, 26, 0, 5800000),
(166, 29, 27, 0, 5800000),
(167, 30, 28, 1, 5900000),
(168, 30, 29, 0, 5900000),
(169, 30, 30, 0, 5900000),
(170, 31, 31, 1, 6000000),
(171, 31, 32, 0, 6000000),
(172, 31, 33, 0, 6000000),
(173, 32, 34, 1, 6100000),
(174, 32, 35, 0, 6100000),
(175, 32, 36, 0, 6100000),
(176, 33, 37, 1, 6200000),
(177, 33, 38, 0, 6200000),
(178, 33, 39, 0, 6200000),
(182, 35, 43, 1, 6400000),
(183, 35, 44, 0, 6400000),
(184, 35, 45, 0, 6400000),
(185, 36, 46, 1, 6500000),
(186, 36, 47, 0, 6500000),
(187, 36, 48, 0, 6500000),
(188, 37, 49, 1, 6600000),
(189, 37, 50, 0, 6600000),
(190, 37, 1, 0, 6600000),
(191, 38, 2, 1, 6700000),
(192, 38, 3, 0, 6700000),
(193, 38, 4, 0, 6700000),
(197, 40, 8, 1, 6900000),
(198, 40, 9, 0, 6900000),
(199, 40, 10, 0, 6900000),
(200, 13, 42, 1, 14000000),
(201, 13, 41, 0, 5500000),
(202, 13, 40, 0, 5500000),
(207, 42, 50, 1, 4814286),
(208, 42, 50, 1, 4814286),
(209, 42, 49, 0, 4814286),
(210, 42, 48, 0, 4814286),
(211, 42, 47, 0, 4814286),
(212, 42, 46, 0, 4214286),
(213, 42, 44, 0, 4214286),
(219, 43, 50, 0, 19500000),
(220, 43, 49, 1, 19500000),
(221, 43, 48, 0, 19500000),
(222, 43, 47, 0, 19500000),
(223, 43, 46, 0, 17500000),
(248, 44, 50, 0, 13300000),
(249, 44, 49, 0, 13300000),
(250, 44, 48, 0, 13300000),
(251, 44, 47, 0, 13300000),
(252, 44, 46, 0, 8300000),
(253, 44, 45, 0, 8300000),
(254, 44, 44, 1, 8300000),
(255, 44, 43, 0, 8300000),
(256, 45, 29, 0, 5650000),
(257, 45, 28, 0, 5650000),
(258, 45, 27, 1, 5150000),
(259, 45, 26, 0, 5650000),
(260, 46, 1, 1, 5000000),
(261, 46, 2, 0, 5000000),
(262, 46, 3, 0, 5000000),
(263, 47, 4, 1, 5200000),
(264, 47, 5, 0, 5200000),
(265, 47, 6, 0, 5200000),
(266, 48, 7, 1, 5400000),
(267, 48, 8, 0, 5400000),
(268, 48, 9, 0, 5400000),
(269, 49, 10, 1, 5600000),
(270, 49, 11, 0, 5600000),
(271, 49, 12, 0, 5600000),
(302, 70, 1, 1, 5000000),
(303, 70, 2, 0, 5000000),
(304, 70, 3, 0, 5000000),
(305, 71, 4, 1, 5200000),
(306, 71, 5, 0, 5200000),
(307, 71, 6, 0, 5200000),
(308, 72, 7, 1, 5400000),
(309, 72, 8, 0, 5400000),
(310, 72, 9, 0, 5400000),
(311, 73, 10, 1, 5600000),
(312, 73, 11, 0, 5600000),
(313, 73, 12, 0, 5600000),
(314, 74, 13, 1, 5800000),
(315, 74, 14, 0, 5800000),
(316, 74, 15, 0, 5800000),
(317, 75, 16, 1, 6000000),
(318, 75, 17, 0, 6000000),
(319, 75, 18, 0, 6000000),
(320, 76, 19, 1, 6200000),
(321, 76, 20, 0, 6200000),
(322, 76, 21, 0, 6200000),
(323, 77, 22, 1, 6400000),
(324, 77, 23, 0, 6400000),
(325, 77, 24, 0, 6400000),
(326, 78, 25, 1, 6600000),
(327, 78, 26, 0, 6600000),
(328, 78, 27, 0, 6600000),
(329, 79, 28, 1, 6800000),
(330, 79, 29, 0, 6800000),
(331, 79, 30, 0, 6800000),
(332, 15, 50, 1, 7375000),
(333, 15, 49, 0, 7375000),
(334, 15, 48, 0, 7375000),
(335, 15, 44, 0, 7175000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Trong Nước'),
(2, 'Nước Ngoài');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('adult','child','vip') NOT NULL DEFAULT 'adult',
  `address` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `full_name`, `email`, `phone`, `role`, `address`, `age`) VALUES
(1, 'Nguyễn Văn An', 'c1@gmail.com', '0901111001', 'adult', 'Hà Nội', 9),
(2, 'Trần Thị Minh Ngọc', 'c2@gmail.com', '0901111002', 'child', 'Hà Nội', 11),
(3, 'Lê Hoàng Hải', 'c3@gmail.com', '0901111003', 'child', 'Hà Nội', 13),
(4, 'Phạm Thị Thu Trang', 'c4@gmail.com', '0901111004', 'adult', 'Hà Nội', 15),
(5, 'Hoàng Văn Huy', 'c5@gmail.com', '0901111005', 'adult', 'Hà Nội', 11),
(6, 'Đỗ Ngọc Ánh', 'c6@gmail.com', '0901111006', 'child', 'Hà Nội', 6),
(7, 'Vũ Thanh Phong', 'c7@gmail.com', '0901111007', 'child', 'Hà Nội', 10),
(8, 'Bùi Thị Mỹ Linh', 'c8@gmail.com', '0901111008', 'adult', 'Hà Nội', 8),
(9, 'Võ Minh Tuấn', 'c9@gmail.com', '0901111009', 'adult', 'Hà Nội', 12),
(10, 'Đinh Thu Hà', 'c10@gmail.com', '0901111010', 'adult', 'Hà Nội', 10),
(11, 'Nguyễn Thị Hồng Nhung', 'c11@gmail.com', '0901111011', 'adult', 'Hà Nội', 8),
(12, 'Trần Đức Thắng', 'c12@gmail.com', '0901111012', 'adult', 'Hà Nội', 15),
(13, 'Lê Minh Khang', 'c13@gmail.com', '0901111013', 'adult', 'Hà Nội', 15),
(14, 'Phạm Thị Thảo', 'c14@gmail.com', '0901111014', 'child', 'Hà Nội', 6),
(15, 'Hoàng Anh Tú', 'c15@gmail.com', '0901111015', 'child', 'Hà Nội', 8),
(16, 'Đỗ Bảo Trân', 'c16@gmail.com', '0901111016', 'child', 'Hà Nội', 8),
(17, 'Vũ Hoàng Nam', 'c17@gmail.com', '0901111017', 'child', 'Hà Nội', 12),
(18, 'Bùi Gia Hưng', 'c18@gmail.com', '0901111018', 'child', 'Hà Nội', 8),
(19, 'Võ Thị Nhã Uyên', 'c19@gmail.com', '0901111019', 'child', 'Hà Nội', 8),
(20, 'Đinh Quốc Khánh', 'c20@gmail.com', '0901111020', 'child', 'Hà Nội', 12),
(21, 'Nguyễn Thị Kim Anh', 'c21@gmail.com', '0901111021', 'adult', 'Hà Nội', 8),
(22, 'Trần Văn Dũng', 'c22@gmail.com', '0901111022', 'adult', 'Hà Nội', 12),
(23, 'Lê Thiên Phúc', 'c23@gmail.com', '0901111023', 'child', 'Hà Nội', 7),
(24, 'Phạm Bảo Ngân', 'c24@gmail.com', '0901111024', 'child', 'Hà Nội', 15),
(25, 'Hoàng Ngọc Đức', 'c25@gmail.com', '0901111025', 'adult', 'Hà Nội', 10),
(26, 'Đỗ Thị Yến Nhi', 'c26@gmail.com', '0901111026', 'adult', 'Hà Nội', 9),
(27, 'Vũ Minh Tâm', 'c27@gmail.com', '0901111027', 'child', 'Hà Nội', 10),
(28, 'Bùi Thảo Nhi', 'c28@gmail.com', '0901111028', 'adult', 'Hà Nội', 15),
(29, 'Võ Hoài Phương', 'c29@gmail.com', '0901111029', 'adult', 'Hà Nội', 12),
(30, 'Đinh Tuấn Kiệt', 'c30@gmail.com', '0901111030', 'adult', 'Hà Nội', 7),
(31, 'Nguyễn Khánh Vy', 'c31@gmail.com', '0901111031', 'adult', 'Hà Nội', 15),
(32, 'Trần Hoàng Minh', 'c32@gmail.com', '0901111032', 'child', 'Hà Nội', 7),
(33, 'Lê Mỹ Duyên', 'c33@gmail.com', '0901111033', 'child', 'Hà Nội', 15),
(34, 'Phạm Minh Đức', 'c34@gmail.com', '0901111034', 'adult', 'Hà Nội', 10),
(35, 'Hoàng Bảo Châu', 'c35@gmail.com', '0901111035', 'adult', 'Hà Nội', 7),
(36, 'Đỗ Tiến Đạt', 'c36@gmail.com', '0901111036', 'adult', 'Hà Nội', 9),
(37, 'Vũ Tường Vy', 'c37@gmail.com', '0901111037', 'child', 'Hà Nội', 9),
(38, 'Bùi Đức Long', 'c38@gmail.com', '0901111038', 'child', 'Hà Nội', 13),
(39, 'Võ Phương Linh', 'c39@gmail.com', '0901111039', 'adult', 'Hà Nội', 14),
(40, 'Đinh Minh Quân', 'c40@gmail.com', '0901111040', 'child', 'Hà Nội', 12),
(41, 'Nguyễn Ngọc Bích', 'c41@gmail.com', '0901111041', 'child', 'Hà Nội', 6),
(42, 'Trần Anh Khoa', 'c42@gmail.com', '0901111042', 'adult', 'Hà Nội', 8),
(43, 'Lê Tố Như', 'c43@gmail.com', '0901111043', 'child', 'Hà Nội', 8),
(44, 'Phạm Thanh Lâm', 'c44@gmail.com', '0901111044', 'child', 'Hà Nội', 7),
(45, 'Hoàng Trúc Vy', 'c45@gmail.com', '0901111045', 'child', 'Hà Nội', 7),
(46, 'Đỗ Hữu Nghĩa', 'c46@gmail.com', '0901111046', 'child', 'Hà Nội', 10),
(47, 'Vũ Nhật Hạ', 'c47@gmail.com', '0901111047', 'adult', 'Hà Nội', 14),
(48, 'Bùi Gia Bảo', 'c48@gmail.com', '0901111048', 'adult', 'Hà Nội', 15),
(49, 'Võ Thảo My', 'c49@gmail.com', '0901111049', 'adult', 'Hà Nội', 6),
(50, 'Đinh Hoài Nam', 'c50@gmail.com', '0901111050', 'adult', 'Hà Nội', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `guides`
--

CREATE TABLE `guides` (
  `guide_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `experience_years` int DEFAULT '0',
  `specialization` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `note` text,
  `cccd` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `guides`
--

INSERT INTO `guides` (`guide_id`, `user_id`, `experience_years`, `specialization`, `avatar`, `note`, `cccd`) VALUES
(1, 2, 3, 'Du lịch sinh thái', 'image/GuideImages/1765211296-tải xuống (9).jpg', 'Luôn đến sớm 15 phút trước giờ đón khách, xử lý tình huống tốt.', '079203001584'),
(2, 3, 4, 'Du lịch văn hóa', 'image/GuideImages/1765211288-tải xuống (9).jpg', 'Hướng dẫn viên nhiệt huyết, am hiểu văn hóa địa phương và có khả năng dẫn dắt đoàn rất tốt.', '038204009712'),
(3, 4, 2, 'Du lịch biển', 'image/GuideImages/1765211282-tải xuống (9).jpg', 'Thành thạo tiếng Anh, giao tiếp thân thiện và luôn tạo không khí vui vẻ cho đoàn.', '096303005821'),
(4, 5, 5, 'Du lịch núi', 'image/GuideImages/1765211273-tải xuống (9).jpg', 'Có nhiều năm kinh nghiệm dẫn tour trải nghiệm và khám phá, đặc biệt ở khu vực miền Trung.', '001192007436'),
(5, 6, 1, 'City tour', 'image/GuideImages/1765211253-tải xuống (9).jpg', 'Phong cách làm việc chuyên nghiệp, chu đáo với khách lớn tuổi và gia đình có trẻ nhỏ.', '048185003927');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `guide_tours`
--

CREATE TABLE `guide_tours` (
  `id` int NOT NULL,
  `guide_id` int NOT NULL,
  `booking_id` int NOT NULL,
  `tour_id` int NOT NULL,
  `status` enum('current','history') DEFAULT 'current'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `guide_tours`
--

INSERT INTO `guide_tours` (`id`, `guide_id`, `booking_id`, `tour_id`, `status`) VALUES
(78, 2, 13, 3, 'current'),
(80, 3, 15, 1, 'history'),
(83, 1, 18, 1, 'current'),
(84, 4, 19, 1, 'current'),
(86, 1, 21, 1, 'history'),
(87, 2, 22, 2, 'history'),
(88, 3, 23, 3, 'history'),
(90, 5, 25, 1, 'history'),
(91, 1, 26, 2, 'history'),
(92, 2, 27, 3, 'history'),
(93, 3, 28, 4, 'history'),
(94, 4, 29, 1, 'history'),
(95, 5, 30, 2, 'history'),
(96, 1, 31, 3, 'history'),
(97, 2, 32, 4, 'history'),
(98, 3, 33, 1, 'history'),
(100, 5, 35, 3, 'history'),
(101, 1, 36, 4, 'history'),
(102, 2, 37, 1, 'history'),
(103, 3, 38, 2, 'history'),
(105, 5, 40, 4, 'history'),
(107, 1, 42, 17, 'current'),
(108, 1, 43, 22, 'current'),
(109, 3, 44, 24, 'current'),
(110, 1, 45, 15, 'current'),
(111, 1, 46, 1, 'current'),
(112, 2, 47, 2, 'current'),
(113, 3, 48, 3, 'current'),
(114, 4, 49, 4, 'current'),
(125, 1, 70, 1, 'current'),
(126, 2, 71, 2, 'current'),
(127, 3, 72, 3, 'current'),
(128, 4, 73, 4, 'current'),
(129, 5, 74, 15, 'current'),
(130, 1, 75, 1, 'current'),
(131, 2, 76, 2, 'current'),
(132, 3, 77, 3, 'current'),
(133, 4, 78, 4, 'current'),
(134, 5, 79, 16, 'current');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotels`
--

CREATE TABLE `hotels` (
  `hotel_service_id` int NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `room_type` varchar(255) DEFAULT NULL,
  `price_per_night` decimal(12,2) DEFAULT NULL,
  `description` text,
  `hotel_manager` varchar(100) NOT NULL,
  `hotel_manager_phone` varchar(20) NOT NULL,
  `hotel_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `hotels`
--

INSERT INTO `hotels` (`hotel_service_id`, `service_name`, `room_type`, `price_per_night`, `description`, `hotel_manager`, `hotel_manager_phone`, `hotel_image`) VALUES
(1, 'Hotel A', 'Standard', 500000.00, 'Khách sạn A phòng Standard', 'Nguyễn Thành Long', '0905123456', 'image/HotelImages/1765209636-tải xuống (6).jpg'),
(2, 'Hotel B', 'Deluxe', 800000.00, 'Khách sạn B phòng Deluxe', 'Trần Hồng Phúc', '0933445566', 'image/HotelImages/1765209628-tải xuống (4).jpg'),
(3, 'Hotel C', 'Suite', 1200000.00, 'Khách sạn C phòng Suite', 'Lê Ngọc Anh', '0977333222', 'image/HotelImages/1765209620-tải xuống (3).jpg'),
(4, 'Hotel D', 'Standard', 450000.00, 'Khách sạn D phòng Standard', 'Phạm Thanh Tùng', '0919888777', 'image/HotelImages/1765209613-tải xuống (2).jpg'),
(5, 'Hotel E', 'Premium', 1500000.00, 'Khách sạn E phòng Premium', 'Võ Minh Quân', '0988777666', 'image/HotelImages/1765209562-tải xuống.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `report_id` int NOT NULL,
  `guide_id` int DEFAULT NULL,
  `tour_id` int DEFAULT NULL,
  `booking_id` int DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `content` text,
  `rating` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tours`
--

CREATE TABLE `tours` (
  `tour_id` int NOT NULL,
  `tour_name` varchar(150) NOT NULL,
  `description` text,
  `price_adult` int NOT NULL DEFAULT '0',
  `price_child` int NOT NULL DEFAULT '0',
  `days` int NOT NULL DEFAULT '1',
  `category_id` int DEFAULT NULL,
  `tour_images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`tour_id`, `tour_name`, `description`, `price_adult`, `price_child`, `days`, `category_id`, `tour_images`) VALUES
(1, 'Hà Nội – Hạ Long – Sapa', 'Tour 3N2Đ khám phá miền Bắc', 1000000, 800000, 3, 1, 'image/TourImages/1765172227-tải xuống (3).jpg'),
(2, 'Đà Nẵng – Hội An – Bà Nà Hills', 'Tour 4N3Đ du lịch miền Trung', 1000000, 1200000, 4, 1, 'image/TourImages/1765172200-tải xuống (2).jpg'),
(3, 'TP.HCM – Phú Quốc', 'Tour nghỉ dưỡng 3N2Đ', 10000000, 1500000, 3, 1, 'image/TourImages/1765172170-tải xuống (1).jpg'),
(4, 'Hà Nội – Bangkok – Pattaya', 'Tour nước ngoài 5N4Đ Thái Lan', 2800000, 1800000, 5, 2, 'image/TourImages/1765171334-tải xuống.jpg'),
(15, 'Hà Nội – Ninh Bình – Tam Cốc', 'Hành trình khám phá danh thắng Tràng An – Tam Cốc, du thuyền trên dòng Ngô Đồng và thưởng thức ẩm thực đặc sản Ninh Bình. Tour phù hợp gia đình và nhóm bạn thích trải nghiệm thiên nhiên.', 1400000, 900000, 2, 1, 'image/TourImages/1765173010-tải xuống (13).jpg'),
(16, 'Phan Thiết – Mũi Né – Đồi Cát Bay', 'Tour nghỉ dưỡng nhẹ nhàng tại Mũi Né, tham quan đồi cát bay, Bàu Trắng và vui chơi tại biển. Lịch trình được thiết kế tối ưu để du khách thư giãn và chụp ảnh sống ảo.', 2000000, 1300000, 3, 1, 'image/TourImages/1765172990-tải xuống (12).jpg'),
(17, 'Cần Thơ – Chợ Nổi Cái Răng – Mỹ Khánh', 'Khám phá miền Tây sông nước, trải nghiệm văn hóa chợ nổi, thưởng thức trái cây miệt vườn tươi ngon và tham quan khu du lịch Mỹ Khánh.', 1700000, 1100000, 2, 1, 'image/TourImages/1765172969-tải xuống (11).jpg'),
(18, 'Sài Gòn City Tour – Một ngày khám phá', 'City Tour tham quan Nhà thờ Đức Bà, Bưu điện Thành phố, Dinh Độc Lập và các điểm tham quan nổi tiếng khác. Tour ngắn phù hợp lịch trình bận rộn.', 900000, 600000, 1, 1, 'image/TourImages/1765172932-tải xuống (10).jpg'),
(19, 'Đà Lạt – Thành phố ngàn hoa', 'Hành trình 3 ngày khám phá Đà Lạt với nhiều điểm đến nổi tiếng: Hồ Xuân Hương, đồi chè Cầu Đất, quảng trường Lâm Viên và nhiều trải nghiệm thú vị.', 2400000, 1600000, 3, 1, 'image/TourImages/1765172902-tải xuống (9).jpg'),
(20, 'Huế – Đại Nội – Chùa Thiên Mụ', 'Tour văn hóa – lịch sử dành cho du khách yêu thích nét cổ kính. Khám phá quần thể di tích triều Nguyễn cùng những món ăn đặc trưng xứ Huế.', 2300000, 1500000, 2, 1, 'image/TourImages/1765172880-tải xuống (8).jpg'),
(21, 'Hà Nội – Tokyo – Núi Phú Sĩ', 'Tour Nhật Bản 5 ngày 4 đêm trải nghiệm văn hóa, thưởng thức ẩm thực Nhật và tham quan núi Phú Sĩ – biểu tượng nổi tiếng thế giới.', 12000000, 9000000, 5, 2, 'image/TourImages/1765172855-tải xuống (7).jpg'),
(22, 'Hà Nội – Seoul – Everland', 'Khám phá Hàn Quốc với cung điện Gyeongbokgung, công viên Everland và phố mua sắm Myeongdong. Tour phù hợp cho gia đình và cặp đôi.', 10000000, 8000000, 5, 2, 'image/TourImages/1765172811-tải xuống (6).jpg'),
(23, 'Hà Nội – Singapore – Marina Bay', 'Hành trình 4N3Đ tham quan Gardens by the Bay, Marina Bay Sands, Merlion Park và nhiều địa điểm hiện đại nổi tiếng tại Singapore.', 9000000, 7000000, 4, 2, 'image/TourImages/1765172787-tải xuống (5).jpg'),
(24, 'Hà Nội – Bali – Thiên đường biển đảo', 'Trải nghiệm tour nghỉ dưỡng Bali cao cấp: tắm biển, vui chơi ở Waterbom, tham quan đền Uluwatu và thưởng thức show Kecak truyền thống.', 10000000, 5000000, 4, 2, 'image/TourImages/1765172761-tải xuống (4).jpg'),
(26, 'Sài Gòn – Singapore – Bali', 'Tour quốc tế 6N5Đ khám phá thiên đường du lịch Singapore & Bali\r\n', 12500000, 12500000, 2, 1, 'image/TourImages/1765187880-tải xuống (7).jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tour_schedules`
--

CREATE TABLE `tour_schedules` (
  `tour_schedule_id` int NOT NULL,
  `tour_id` int NOT NULL,
  `day_number` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `tour_schedules`
--

INSERT INTO `tour_schedules` (`tour_schedule_id`, `tour_id`, `day_number`, `title`, `description`) VALUES
(94, 4, 1, 'Khởi hành – Nhận phòng – Tham quan địa phương', 'Du khách tập trung tại điểm hẹn, khởi hành đến địa điểm du lịch. Sau khi nhận phòng và nghỉ ngơi, đoàn bắt đầu tham quan các điểm nổi bật trong khu vực, hòa mình vào không khí trong lành và trải nghiệm văn hóa bản địa.'),
(95, 4, 2, 'Tham quan các điểm nổi bật – Hoạt động trải nghiệm', 'Trong ngày thứ hai, đoàn sẽ khám phá những thắng cảnh nổi tiếng, tham gia các hoạt động ngoài trời, chụp ảnh lưu niệm và thưởng thức các món ăn đặc sản địa phương. Đây là ngày có nhiều trải nghiệm thú vị nhất của hành trình.'),
(96, 4, 3, 'Tự do vui chơi – Mua sắm – Kết thúc hành trình', 'Buổi sáng du khách tự do dạo chơi, nghỉ dưỡng hoặc mua quà lưu niệm. Sau đó đoàn làm thủ tục trả phòng và di chuyển về điểm đón ban đầu, kết thúc chuyến đi đầy kỷ niệm.'),
(105, 23, 1, 'Gardens by the Bay', 'Tham quan siêu cây và Cloud Forest.'),
(106, 23, 2, 'Marina Bay Sands', 'Ngắm toàn cảnh Singapore từ tầng cao.'),
(107, 23, 3, 'Sentosa', 'Vui chơi tại đảo Sentosa.'),
(108, 23, 4, 'Chợ đêm ChinaTown', 'Mua sắm – ăn uống.'),
(109, 22, 1, 'Cung điện Gyeongbokgung', 'Mặc Hanbok chụp ảnh tại cung điện.'),
(110, 22, 2, 'Everland', 'Vui chơi trong công viên giải trí lớn nhất Hàn Quốc.'),
(111, 22, 3, 'Tháp Namsan', 'Tham quan và ngắm toàn cảnh Seoul.'),
(112, 22, 4, 'Myeongdong', 'Mua sắm mỹ phẩm – thời trang.'),
(113, 22, 5, 'Trở về', 'Di chuyển ra sân bay.'),
(119, 21, 1, 'Bay đến Tokyo', 'Tham quan Tokyo Tower và phố Shibuya.'),
(120, 21, 2, 'Núi Phú Sĩ', 'Chụp ảnh tại trạm 5 núi Phú Sĩ – làng cổ Oshino Hakkai.'),
(121, 21, 3, 'Disneyland Tokyo', 'Vui chơi trọn ngày tại công viên giải trí.'),
(122, 21, 4, 'Shopping – Akihabara', 'Tự do mua sắm.'),
(123, 21, 5, 'Trở về Việt Nam', 'Làm thủ tục và bay về.'),
(124, 20, 1, 'Đại Nội Huế', 'Khám phá Hoàng thành và kiến trúc triều Nguyễn.'),
(125, 20, 2, 'Chùa Thiên Mụ – Sông Hương', 'Du thuyền sông Hương và thưởng thức món ăn Huế.'),
(126, 19, 1, 'Check-in Đà Lạt', 'Tham quan quảng trường Lâm Viên, hồ Xuân Hương.'),
(127, 19, 2, 'Đồi chè Cầu Đất – Đồi thông', 'Chụp ảnh tại đồi chè và cảnh quan núi rừng.'),
(128, 19, 3, 'Chợ đêm Đà Lạt', 'Tự do ăn uống – mua sắm.'),
(129, 17, 1, 'Chợ nổi Cái Răng', 'Khám phá chợ nổi vào buổi sáng, thưởng thức trái cây miền Tây.'),
(130, 17, 2, 'Mỹ Khánh – Tham quan vườn', 'Thăm quan khu du lịch Mỹ Khánh và trải nghiệm văn hóa địa phương.'),
(131, 16, 1, 'Khởi hành – Biển Mũi Né', 'Nhận phòng, tắm biển và tham quan làng chài Mũi Né.'),
(132, 16, 2, 'Đồi cát bay – Bàu Trắng', 'Chụp ảnh đồi cát, trải nghiệm moto địa hình.'),
(133, 16, 3, 'Tự do nghỉ dưỡng', 'Dạo biển – check-out – trở về.'),
(134, 15, 1, 'Khởi hành – Tràng An', 'Tham quan quần thể Tràng An, đi thuyền xuyên hang và khám phá cảnh quan hùng vĩ.'),
(135, 15, 2, 'Tam Cốc – Mua sắm', 'Đi đò Tam Cốc và thưởng thức đặc sản dê núi Ninh Bình.'),
(140, 1, 1, 'Khởi hành – Hạ Long', 'Tham quan vịnh Hạ Long, hang Sửng Sốt, chèo kayak.'),
(141, 1, 2, 'Hạ Long – Sapa', 'Di chuyển đi Sapa, tham quan bản Cát Cát, núi Hàm Rồng.'),
(142, 1, 3, 'Fansipan – Hà Nội', 'Chinh phục Fansipan, quay về Hà Nội kết thúc chuyến đi.'),
(147, 2, 1, 'Đà Nẵng – Mỹ Khê', 'Tham quan biển Mỹ Khê, cầu Rồng.'),
(148, 2, 2, 'Hội An cổ kính', 'Tham quan phố cổ, chùa Cầu, thưởng thức ẩm thực Hội An.'),
(149, 2, 3, 'Bà Nà Hills', 'Check in Cầu Vàng, tham quan Bà Nà Hills.'),
(150, 2, 4, 'Đà Nẵng – Kết thúc', 'Tự do mua sắm và trở về.'),
(155, 3, 1, 'Bãi Sao – Sunset Sanato', 'Tắm biển, check-in hoàng hôn đẹp nhất Phú Quốc.'),
(156, 3, 2, 'VinWonders – Safari', 'Tham quan Safari và VinWonders.'),
(157, 3, 3, 'Chợ đêm – Trở về', 'Tham quan chợ đêm Phú Quốc, kết thúc chuyến đi.'),
(162, 26, 1, 'Khám phá Singapore về đêm', 'Du khách sẽ tham gia hành trình tham quan Marina Bay Sands, Gardens by the Bay và thưởng thức không khí Singapore lung linh về đêm. Bầu không khí mát mẻ, kết hợp ánh đèn hiện đại khiến hành trình trở nên vô cùng ấn tượng. Ngoài ra, đoàn còn được trải nghiệm show nhạc nước Spectra độc đáo không thể bỏ lỡ.'),
(163, 26, 2, 'Tận hưởng vẻ đẹp Bali', 'Buổi sáng, du khách di chuyển đến Bali để thăm Đền Tanah Lot cổ kính nằm giữa biển. Buổi chiều, tắm biển ở Kuta với bãi cát trắng trải dài và những con sóng mạnh tuyệt đẹp. Cả đoàn được tự do chụp ảnh, nghỉ dưỡng và thưởng thức ẩm thực địa phương mang hương vị đặc trưng của đảo Bali.'),
(164, 24, 1, 'Check-in Bali', 'Nhận phòng – tắm biển – nghỉ dưỡng.'),
(165, 24, 2, 'Uluwatu – Kecak Show', 'Tham quan đền và xem biểu diễn truyền thống.'),
(166, 24, 3, 'Nusa Dua – Waterbom', 'Vui chơi tại công viên nước lớn nhất Bali.'),
(167, 24, 4, 'Tự do nghỉ dưỡng – Trở về', 'Mua sắm – check-out – về Việt Nam.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guide') NOT NULL DEFAULT 'guide',
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `name`, `email`, `phone`) VALUES
(1, 'admin', '123', 'admin', 'Admin', 'admin@gmail.com', '0900000000'),
(2, 'guide1', '123', 'guide', 'Nguyễn Minh Khoa', 'khoanguyen.travel@gmail.com', '0900000001'),
(3, 'guide2', '123', 'guide', 'Trần Hoàng Phúc', 'phuc.tran.tourguide@gmail.com', '0900000002'),
(4, 'guide3', '123', 'guide', 'Lê Hải Nam', 'hainam.guide@gmail.com', '0900000003'),
(5, 'guide4', '123', 'guide', 'Đỗ Thanh Tùng', 'tung.do.travel@gmail.com', '0900000004'),
(6, 'guide5', '123', 'guide', 'Vũ Bảo Long', 'longvu.guideservice@gmail.com', '0900000005');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_service_id` int NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `seat` int DEFAULT NULL,
  `price_per_day` decimal(12,2) DEFAULT NULL,
  `description` text,
  `driver_name` varchar(100) NOT NULL,
  `driver_phone` varchar(20) NOT NULL,
  `license_plate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `vehicles`
--

INSERT INTO `vehicles` (`vehicle_service_id`, `service_name`, `seat`, `price_per_day`, `description`, `driver_name`, `driver_phone`, `license_plate`) VALUES
(1, 'Xe 16 chỗ', 16, 1500000.00, 'Xe 16 chỗ phổ thông', 'Nguyễn Minh Khang', '0912345678', '51A-12345'),
(2, 'Xe 29 chỗ', 29, 2200000.00, 'Xe 29 chỗ du lịch', 'Lê Tuấn Kiệt', '0987654321', '51B-67890'),
(3, 'Xe 45 chỗ', 45, 3500000.00, 'Xe 45 chỗ đoàn lớn', 'Đặng Quang Khải', '0909123456', '51C-24680'),
(4, 'Xe Limousine', 9, 2500000.00, 'Xe Limousine cao cấp', 'Võ Minh Thiện', '0933555777', '51D-13579'),
(5, 'Xe VIP', 7, 3000000.00, 'Xe VIP riêng tư', 'Bùi Anh Dũng', '0977333444', '51E-11223');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_ibfk_1` (`booking_id`),
  ADD KEY `attendance_ibfk_2` (`customer_id`);

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `fk_booking_guide` (`guide_id`),
  ADD KEY `fk_booking_hotel_service` (`hotel_id`),
  ADD KEY `fk_booking_vehicle_service` (`vehicle_id`);

--
-- Chỉ mục cho bảng `booking_customers`
--
ALTER TABLE `booking_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_customers_ibfk_1` (`booking_id`),
  ADD KEY `booking_customers_ibfk_2` (`customer_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`guide_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `guide_tours`
--
ALTER TABLE `guide_tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guide_id` (`guide_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Chỉ mục cho bảng `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_service_id`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `guide_id` (`guide_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `fk_report_booking` (`booking_id`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `tour_schedules`
--
ALTER TABLE `tour_schedules`
  ADD PRIMARY KEY (`tour_schedule_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_service_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `booking_customers`
--
ALTER TABLE `booking_customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `guides`
--
ALTER TABLE `guides`
  MODIFY `guide_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `guide_tours`
--
ALTER TABLE `guide_tours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT cho bảng `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `tour_schedules`
--
ALTER TABLE `tour_schedules`
  MODIFY `tour_schedule_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`),
  ADD CONSTRAINT `fk_booking_guide` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_hotel_service` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_service_id`),
  ADD CONSTRAINT `fk_booking_vehicle_service` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_service_id`);

--
-- Các ràng buộc cho bảng `booking_customers`
--
ALTER TABLE `booking_customers`
  ADD CONSTRAINT `booking_customers_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_customers_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE RESTRICT;

--
-- Các ràng buộc cho bảng `guides`
--
ALTER TABLE `guides`
  ADD CONSTRAINT `guides_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `guide_tours`
--
ALTER TABLE `guide_tours`
  ADD CONSTRAINT `guide_tours_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`),
  ADD CONSTRAINT `guide_tours_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

--
-- Các ràng buộc cho bảng `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_report_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`);

--
-- Các ràng buộc cho bảng `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Các ràng buộc cho bảng `tour_schedules`
--
ALTER TABLE `tour_schedules`
  ADD CONSTRAINT `tour_schedules_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
