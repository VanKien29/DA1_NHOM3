-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2025 at 11:21 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtour`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `status` enum('present','absent') DEFAULT 'present',
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `booking_id`, `customer_id`, `status`, `note`) VALUES
(84, 27, 35, 'present', NULL),
(85, 27, 34, 'absent', NULL),
(86, 27, 33, 'present', NULL),
(87, 27, 32, 'present', NULL),
(88, 27, 31, 'present', NULL),
(97, 53, 46, 'present', NULL),
(98, 53, 45, 'absent', NULL),
(99, 53, 44, 'absent', NULL),
(100, 53, 43, 'absent', NULL),
(101, 26, 30, 'absent', NULL),
(102, 26, 29, 'absent', NULL),
(103, 26, 28, 'absent', NULL),
(104, 26, 27, 'absent', NULL),
(105, 26, 26, 'absent', NULL),
(106, 25, 25, 'present', NULL),
(107, 25, 24, 'present', NULL),
(108, 25, 23, 'absent', NULL),
(109, 25, 22, 'present', NULL),
(110, 25, 21, 'absent', NULL),
(119, 48, 50, 'present', NULL),
(120, 48, 49, 'present', NULL),
(121, 48, 48, 'present', NULL),
(122, 48, 47, 'present', NULL),
(123, 48, 46, 'present', NULL),
(124, 48, 4, 'present', NULL),
(125, 48, 3, 'absent', NULL),
(126, 48, 2, 'absent', NULL),
(134, 54, 34, 'absent', NULL),
(136, 54, 32, 'absent', NULL),
(137, 54, 36, 'absent', NULL),
(138, 54, 44, 'absent', NULL),
(140, 21, 5, 'present', NULL),
(141, 21, 4, 'absent', NULL),
(142, 21, 3, 'absent', NULL),
(143, 21, 2, 'absent', NULL),
(144, 21, 1, 'absent', NULL),
(151, 55, 48, 'absent', NULL),
(152, 55, 46, 'absent', NULL),
(153, 55, 45, 'absent', NULL),
(169, 59, 45, 'present', NULL),
(170, 59, 44, 'absent', NULL),
(171, 59, 43, 'absent', NULL),
(172, 60, 25, 'absent', NULL),
(173, 60, 24, 'absent', NULL),
(174, 60, 23, 'absent', NULL),
(175, 60, 22, 'absent', NULL),
(176, 60, 21, 'absent', NULL),
(177, 60, 20, 'absent', NULL),
(178, 61, 10, 'absent', NULL),
(179, 61, 9, 'absent', NULL),
(180, 61, 8, 'absent', NULL),
(181, 61, 7, 'absent', NULL),
(182, 61, 6, 'absent', NULL),
(183, 62, 40, 'absent', NULL),
(184, 62, 39, 'absent', NULL),
(185, 62, 38, 'absent', NULL),
(186, 62, 37, 'absent', NULL),
(187, 62, 36, 'absent', NULL),
(188, 63, 16, 'absent', NULL),
(189, 63, 15, 'absent', NULL),
(190, 63, 14, 'absent', NULL),
(191, 64, 40, 'absent', NULL),
(192, 64, 32, 'absent', NULL),
(193, 64, 31, 'absent', NULL),
(194, 64, 30, 'absent', NULL),
(195, 65, 47, 'absent', NULL),
(196, 65, 46, 'absent', NULL),
(197, 65, 45, 'absent', NULL),
(198, 66, 50, 'absent', NULL),
(199, 66, 49, 'absent', NULL),
(200, 66, 48, 'absent', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int NOT NULL,
  `tour_id` int DEFAULT NULL,
  `guide_id` int DEFAULT NULL,
  `hotel_id` int DEFAULT NULL,
  `vehicle_id` int DEFAULT NULL,
  `status` enum('cho_duyet','dang_dien_ra','da_hoan_thanh','da_huy') NOT NULL DEFAULT 'cho_duyet',
  `report` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_price` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `tour_id`, `guide_id`, `hotel_id`, `vehicle_id`, `status`, `report`, `created_at`, `start_date`, `end_date`, `total_price`) VALUES
(1, 1, 1, 1, 1, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-01', '2025-02-01', '0.00'),
(2, 2, 1, 2, 2, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-01', '2025-02-01', '0.00'),
(3, 3, 1, 3, 3, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-01', '2025-02-01', '0.00'),
(4, 4, 1, 4, 4, 'da_hoan_thanh', 'Hoàn thành tốt tour 4 bởi HDV 1', '2025-11-20 11:07:16', '2025-01-01', '2025-01-03', '0.00'),
(5, 5, 1, 5, 5, 'da_hoan_thanh', 'Hoàn thành tốt tour 5 bởi HDV 1', '2025-11-20 11:07:16', '2025-01-01', '2025-01-03', '0.00'),
(6, 6, 1, 1, 1, 'da_hoan_thanh', 'Hoàn thành tốt tour 6 bởi HDV 1', '2025-11-20 11:07:16', '2025-01-01', '2025-01-03', '0.00'),
(7, 7, 2, 2, 2, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-02', '2025-02-02', '0.00'),
(8, 8, 2, 3, 3, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-02', '2025-02-02', '0.00'),
(9, 9, 2, 4, 4, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-02', '2025-02-02', '0.00'),
(10, 10, 2, 5, 5, 'da_hoan_thanh', 'Hoàn thành tốt tour 10 bởi HDV 2', '2025-11-20 11:07:16', '2025-01-02', '2025-01-04', '0.00'),
(11, 1, 2, 1, 1, 'da_hoan_thanh', 'Hoàn thành tốt tour 1 bởi HDV 2', '2025-11-20 11:07:16', '2025-01-02', '2025-01-04', '0.00'),
(12, 2, 2, 2, 2, 'da_hoan_thanh', 'Hoàn thành tốt tour 2 bởi HDV 2', '2025-11-20 11:07:16', '2025-01-02', '2025-01-04', '0.00'),
(13, 3, 3, 3, 3, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-03', '2025-02-03', '0.00'),
(14, 4, 3, 4, 4, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-03', '2025-02-03', '0.00'),
(15, 5, 3, 5, 5, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-03', '2025-02-03', '0.00'),
(16, 6, 3, 1, 1, 'da_hoan_thanh', 'Hoàn thành tốt tour 6 bởi HDV 3', '2025-11-20 11:07:16', '2025-01-03', '2025-01-05', '0.00'),
(17, 7, 3, 2, 2, 'da_hoan_thanh', 'Hoàn thành tốt tour 7 bởi HDV 3', '2025-11-20 11:07:16', '2025-01-03', '2025-01-05', '0.00'),
(18, 8, 3, 3, 3, 'da_hoan_thanh', 'Hoàn thành tốt tour 8 bởi HDV 3', '2025-11-20 11:07:16', '2025-01-03', '2025-01-05', '0.00'),
(19, 9, 4, 4, 4, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-02-04', '2025-02-04', '0.00'),
(21, 1, 4, 1, 1, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-12-31', '2025-12-31', '0.00'),
(22, 2, 4, 2, 2, 'da_hoan_thanh', 'Hoàn thành tốt tour 2 bởi HDV 4', '2025-11-20 11:07:16', '2025-01-04', '2025-01-06', '0.00'),
(23, 3, 4, 3, 3, 'da_hoan_thanh', 'Hoàn thành tốt tour 3 bởi HDV 4', '2025-11-20 11:07:16', '2025-01-04', '2025-01-06', '0.00'),
(24, 4, 4, 4, 4, 'da_hoan_thanh', 'Hoàn thành tốt tour 4 bởi HDV 4', '2025-11-20 11:07:16', '2025-01-04', '2025-01-06', '0.00'),
(25, 5, 5, 5, 5, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2026-01-23', '2026-01-23', '0.00'),
(26, 6, 5, 1, 1, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-12-31', '2025-12-31', '0.00'),
(27, 7, 5, 2, 2, 'dang_dien_ra', NULL, '2025-11-20 11:07:16', '2025-12-25', '2025-12-25', '0.00'),
(28, 8, 5, 3, 3, 'da_hoan_thanh', 'Hoàn thành tốt tour 8 bởi HDV 5', '2025-11-20 11:07:16', '2025-01-05', '2025-01-07', '0.00'),
(29, 9, 5, 4, 4, 'da_hoan_thanh', 'Hoàn thành tốt tour 9 bởi HDV 5', '2025-11-20 11:07:16', '2025-01-05', '2025-01-07', '0.00'),
(30, 10, 5, 5, 5, 'da_hoan_thanh', 'Hoàn thành tốt tour 10 bởi HDV 5', '2025-11-20 11:07:16', '2025-01-05', '2025-01-07', '0.00'),
(48, 10, 5, 5, 3, 'dang_dien_ra', '', '2025-11-20 10:24:51', '2025-12-03', '2025-12-04', '0.00'),
(53, 10, 5, 4, 5, 'dang_dien_ra', '', '2025-11-21 00:51:48', '2025-12-26', '2025-12-27', '0.00'),
(54, 10, 3, 1, 5, 'dang_dien_ra', '', '2025-11-21 03:14:47', '2025-12-13', '2025-12-14', '0.00'),
(55, 5, 1, 3, 5, 'dang_dien_ra', '', '2025-11-24 03:04:20', '2025-11-05', '2025-11-05', '0.00'),
(59, 7, 5, 5, 5, 'dang_dien_ra', '', '2025-11-28 03:37:03', '2025-11-28', '2025-11-30', '0.00'),
(60, 10, 2, 4, 5, 'dang_dien_ra', '', '2025-11-28 23:14:14', '2025-11-28', '2025-11-30', '0.00'),
(61, 10, 1, 4, 5, 'dang_dien_ra', '', '2025-11-28 23:20:51', '2025-11-28', '2025-11-30', '0.00'),
(62, 3, 3, 4, 1, 'dang_dien_ra', '', '2025-11-28 23:23:12', '2025-11-28', '2025-11-30', '0.00'),
(63, 10, 4, 4, 4, 'dang_dien_ra', '', '2025-11-28 23:31:21', '2025-11-28', '2025-11-30', '0.00'),
(64, 10, 4, 4, 4, 'dang_dien_ra', '', '2025-11-29 00:54:08', '2025-11-20', '2025-11-27', '0.00'),
(65, 10, 4, 4, 5, 'dang_dien_ra', '', '2025-11-29 04:18:42', '2025-11-13', '2025-11-14', '0.00'),
(66, 10, 3, 4, 5, 'dang_dien_ra', '', '2025-11-29 04:19:18', '2025-11-13', '2025-11-14', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `booking_customers`
--

CREATE TABLE `booking_customers` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `is_main` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking_customers`
--

INSERT INTO `booking_customers` (`id`, `booking_id`, `customer_id`, `is_main`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 1, 5, 0),
(6, 2, 6, 1),
(7, 2, 7, 0),
(8, 2, 8, 0),
(9, 2, 9, 0),
(10, 2, 10, 0),
(11, 3, 11, 1),
(12, 3, 12, 0),
(13, 3, 13, 0),
(14, 3, 14, 0),
(15, 3, 15, 0),
(16, 4, 16, 1),
(17, 4, 17, 0),
(18, 4, 18, 0),
(19, 4, 19, 0),
(20, 4, 20, 0),
(21, 5, 21, 1),
(22, 5, 22, 0),
(23, 5, 23, 0),
(24, 5, 24, 0),
(25, 5, 25, 0),
(26, 6, 26, 1),
(27, 6, 27, 0),
(28, 6, 28, 0),
(29, 6, 29, 0),
(30, 6, 30, 0),
(31, 7, 31, 1),
(32, 7, 32, 0),
(33, 7, 33, 0),
(34, 7, 34, 0),
(35, 7, 35, 0),
(36, 8, 36, 1),
(37, 8, 37, 0),
(38, 8, 38, 0),
(39, 8, 39, 0),
(40, 8, 40, 0),
(41, 9, 41, 1),
(42, 9, 42, 0),
(43, 9, 43, 0),
(44, 9, 44, 0),
(45, 9, 45, 0),
(46, 10, 46, 1),
(47, 10, 47, 0),
(48, 10, 48, 0),
(49, 10, 49, 0),
(50, 10, 50, 0),
(51, 11, 1, 1),
(52, 11, 2, 0),
(53, 11, 3, 0),
(54, 11, 4, 0),
(55, 11, 5, 0),
(56, 12, 6, 1),
(57, 12, 7, 0),
(58, 12, 8, 0),
(59, 12, 9, 0),
(60, 12, 10, 0),
(61, 13, 11, 1),
(62, 13, 12, 0),
(63, 13, 13, 0),
(64, 13, 14, 0),
(65, 13, 15, 0),
(66, 14, 16, 1),
(67, 14, 17, 0),
(68, 14, 18, 0),
(69, 14, 19, 0),
(70, 14, 20, 0),
(71, 15, 21, 1),
(72, 15, 22, 0),
(73, 15, 23, 0),
(74, 15, 24, 0),
(75, 15, 25, 0),
(76, 16, 26, 1),
(77, 16, 27, 0),
(78, 16, 28, 0),
(79, 16, 29, 0),
(80, 16, 30, 0),
(81, 17, 31, 1),
(82, 17, 32, 0),
(83, 17, 33, 0),
(84, 17, 34, 0),
(85, 17, 35, 0),
(86, 18, 36, 1),
(87, 18, 37, 0),
(88, 18, 38, 0),
(89, 18, 39, 0),
(90, 18, 40, 0),
(91, 19, 41, 1),
(92, 19, 42, 0),
(93, 19, 43, 0),
(94, 19, 44, 0),
(95, 19, 45, 0),
(106, 22, 6, 1),
(107, 22, 7, 0),
(108, 22, 8, 0),
(109, 22, 9, 0),
(110, 22, 10, 0),
(111, 23, 11, 1),
(112, 23, 12, 0),
(113, 23, 13, 0),
(114, 23, 14, 0),
(115, 23, 15, 0),
(116, 24, 16, 1),
(117, 24, 17, 0),
(118, 24, 18, 0),
(119, 24, 19, 0),
(120, 24, 20, 0),
(136, 28, 36, 1),
(137, 28, 37, 0),
(138, 28, 38, 0),
(139, 28, 39, 0),
(140, 28, 40, 0),
(141, 29, 41, 1),
(142, 29, 42, 0),
(143, 29, 43, 0),
(144, 29, 44, 0),
(145, 29, 45, 0),
(146, 30, 46, 1),
(147, 30, 47, 0),
(148, 30, 48, 0),
(149, 30, 49, 0),
(150, 30, 50, 0),
(305, 27, 35, 0),
(306, 27, 34, 0),
(307, 27, 33, 0),
(308, 27, 32, 0),
(309, 27, 31, 1),
(318, 53, 46, 0),
(319, 53, 45, 1),
(320, 53, 44, 0),
(321, 53, 43, 0),
(322, 26, 30, 0),
(323, 26, 29, 0),
(324, 26, 28, 0),
(325, 26, 27, 0),
(326, 26, 26, 1),
(327, 25, 25, 0),
(328, 25, 24, 0),
(329, 25, 23, 0),
(330, 25, 22, 0),
(331, 25, 21, 1),
(340, 48, 50, 0),
(341, 48, 49, 0),
(342, 48, 48, 0),
(343, 48, 47, 1),
(344, 48, 46, 0),
(345, 48, 4, 0),
(346, 48, 3, 0),
(347, 48, 2, 0),
(355, 54, 34, 0),
(357, 54, 32, 0),
(358, 54, 36, 0),
(359, 54, 44, 0),
(361, 21, 5, 0),
(362, 21, 4, 0),
(363, 21, 3, 0),
(364, 21, 2, 0),
(365, 21, 1, 1),
(372, 55, 48, 0),
(373, 55, 46, 0),
(374, 55, 45, 0),
(390, 59, 45, 0),
(391, 59, 44, 0),
(392, 59, 43, 1),
(393, 60, 25, 0),
(394, 60, 24, 0),
(395, 60, 23, 0),
(396, 60, 22, 0),
(397, 60, 21, 0),
(398, 60, 20, 1),
(399, 61, 10, 1),
(400, 61, 9, 0),
(401, 61, 8, 0),
(402, 61, 7, 0),
(403, 61, 6, 0),
(404, 62, 40, 0),
(405, 62, 39, 0),
(406, 62, 38, 1),
(407, 62, 37, 0),
(408, 62, 36, 0),
(409, 63, 16, 1),
(410, 63, 15, 0),
(411, 63, 14, 0),
(412, 64, 40, 0),
(413, 64, 32, 0),
(414, 64, 31, 0),
(415, 64, 30, 1),
(416, 65, 47, 0),
(417, 65, 46, 1),
(418, 65, 45, 0),
(419, 66, 50, 1),
(420, 66, 49, 0),
(421, 66, 48, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_rooms`
--

CREATE TABLE `booking_rooms` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `room_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking_rooms`
--

INSERT INTO `booking_rooms` (`id`, `booking_id`, `room_id`) VALUES
(1, 64, 6),
(2, 65, 6),
(3, 66, 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Trong Nước'),
(2, 'Nước Ngoài');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('adult','child','vip') NOT NULL DEFAULT 'adult',
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `full_name`, `email`, `phone`, `role`, `address`) VALUES
(1, 'Nguyễn Văn An', 'c1@gmail.com', '0901111001', 'adult', 'Hà Nội'),
(2, 'Trần Thị Minh Ngọc', 'c2@gmail.com', '0901111002', 'child', 'Hà Nội'),
(3, 'Lê Hoàng Hải', 'c3@gmail.com', '0901111003', 'vip', 'Hà Nội'),
(4, 'Phạm Thị Thu Trang', 'c4@gmail.com', '0901111004', 'vip', 'Hà Nội'),
(5, 'Hoàng Văn Huy', 'c5@gmail.com', '0901111005', 'adult', 'Hà Nội'),
(6, 'Đỗ Ngọc Ánh', 'c6@gmail.com', '0901111006', 'child', 'Hà Nội'),
(7, 'Vũ Thanh Phong', 'c7@gmail.com', '0901111007', 'adult', 'Hà Nội'),
(8, 'Bùi Thị Mỹ Linh', 'c8@gmail.com', '0901111008', 'adult', 'Hà Nội'),
(9, 'Võ Minh Tuấn', 'c9@gmail.com', '0901111009', 'vip', 'Hà Nội'),
(10, 'Đinh Thu Hà', 'c10@gmail.com', '0901111010', 'vip', 'Hà Nội'),
(11, 'Nguyễn Thị Hồng Nhung', 'c11@gmail.com', '0901111011', 'vip', 'Hà Nội'),
(12, 'Trần Đức Thắng', 'c12@gmail.com', '0901111012', 'adult', 'Hà Nội'),
(13, 'Lê Minh Khang', 'c13@gmail.com', '0901111013', 'child', 'Hà Nội'),
(14, 'Phạm Thị Thảo', 'c14@gmail.com', '0901111014', 'child', 'Hà Nội'),
(15, 'Hoàng Anh Tú', 'c15@gmail.com', '0901111015', 'child', 'Hà Nội'),
(16, 'Đỗ Bảo Trân', 'c16@gmail.com', '0901111016', 'child', 'Hà Nội'),
(17, 'Vũ Hoàng Nam', 'c17@gmail.com', '0901111017', 'adult', 'Hà Nội'),
(18, 'Bùi Gia Hưng', 'c18@gmail.com', '0901111018', 'adult', 'Hà Nội'),
(19, 'Võ Thị Nhã Uyên', 'c19@gmail.com', '0901111019', 'adult', 'Hà Nội'),
(20, 'Đinh Quốc Khánh', 'c20@gmail.com', '0901111020', 'vip', 'Hà Nội'),
(21, 'Nguyễn Thị Kim Anh', 'c21@gmail.com', '0901111021', 'adult', 'Hà Nội'),
(22, 'Trần Văn Dũng', 'c22@gmail.com', '0901111022', 'adult', 'Hà Nội'),
(23, 'Lê Thiên Phúc', 'c23@gmail.com', '0901111023', 'child', 'Hà Nội'),
(24, 'Phạm Bảo Ngân', 'c24@gmail.com', '0901111024', 'vip', 'Hà Nội'),
(25, 'Hoàng Ngọc Đức', 'c25@gmail.com', '0901111025', 'child', 'Hà Nội'),
(26, 'Đỗ Thị Yến Nhi', 'c26@gmail.com', '0901111026', 'child', 'Hà Nội'),
(27, 'Vũ Minh Tâm', 'c27@gmail.com', '0901111027', 'child', 'Hà Nội'),
(28, 'Bùi Thảo Nhi', 'c28@gmail.com', '0901111028', 'adult', 'Hà Nội'),
(29, 'Võ Hoài Phương', 'c29@gmail.com', '0901111029', 'adult', 'Hà Nội'),
(30, 'Đinh Tuấn Kiệt', 'c30@gmail.com', '0901111030', 'vip', 'Hà Nội'),
(31, 'Nguyễn Khánh Vy', 'c31@gmail.com', '0901111031', 'vip', 'Hà Nội'),
(32, 'Trần Hoàng Minh', 'c32@gmail.com', '0901111032', 'child', 'Hà Nội'),
(33, 'Lê Mỹ Duyên', 'c33@gmail.com', '0901111033', 'adult', 'Hà Nội'),
(34, 'Phạm Minh Đức', 'c34@gmail.com', '0901111034', 'child', 'Hà Nội'),
(35, 'Hoàng Bảo Châu', 'c35@gmail.com', '0901111035', 'adult', 'Hà Nội'),
(36, 'Đỗ Tiến Đạt', 'c36@gmail.com', '0901111036', 'adult', 'Hà Nội'),
(37, 'Vũ Tường Vy', 'c37@gmail.com', '0901111037', 'adult', 'Hà Nội'),
(38, 'Bùi Đức Long', 'c38@gmail.com', '0901111038', 'adult', 'Hà Nội'),
(39, 'Võ Phương Linh', 'c39@gmail.com', '0901111039', 'vip', 'Hà Nội'),
(40, 'Đinh Minh Quân', 'c40@gmail.com', '0901111040', 'vip', 'Hà Nội'),
(41, 'Nguyễn Ngọc Bích', 'c41@gmail.com', '0901111041', 'vip', 'Hà Nội'),
(42, 'Trần Anh Khoa', 'c42@gmail.com', '0901111042', 'vip', 'Hà Nội'),
(43, 'Lê Tố Như', 'c43@gmail.com', '0901111043', 'vip', 'Hà Nội'),
(44, 'Phạm Thanh Lâm', 'c44@gmail.com', '0901111044', 'vip', 'Hà Nội'),
(45, 'Hoàng Trúc Vy', 'c45@gmail.com', '0901111045', 'adult', 'Hà Nội'),
(46, 'Đỗ Hữu Nghĩa', 'c46@gmail.com', '0901111046', 'adult', 'Hà Nội'),
(47, 'Vũ Nhật Hạ', 'c47@gmail.com', '0901111047', 'child', 'Hà Nội'),
(48, 'Bùi Gia Bảo', 'c48@gmail.com', '0901111048', 'child', 'Hà Nội'),
(49, 'Võ Thảo My', 'c49@gmail.com', '0901111049', 'child', 'Hà Nội'),
(50, 'Đinh Hoài Nam', 'c50@gmail.com', '0901111050', 'adult', 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discount_type` enum('percent','fixed') DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `tour_id` int DEFAULT NULL,
  `status` enum('active','expired','upcoming') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`discount_id`, `code`, `description`, `discount_type`, `value`, `start_date`, `end_date`, `tour_id`, `status`) VALUES
(1, 'SALE10', 'Giảm 10%', 'percent', '10.00', '2025-01-01', '2025-12-31', 1, 'active'),
(2, 'SALE20', 'Giảm 20%', 'percent', '20.00', '2025-01-01', '2025-12-31', 2, 'active'),
(3, 'FIX100', 'Giảm 100.000', 'fixed', '100000.00', '2025-01-01', '2025-12-31', 3, 'active'),
(4, 'FIX150', 'Giảm 150.000', 'fixed', '150000.00', '2025-01-01', '2025-12-31', 4, 'active'),
(5, 'SUPER30', 'Giảm 30%', 'percent', '30.00', '2025-01-01', '2025-12-31', 5, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `guide_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `experience_years` int DEFAULT '0',
  `specialization` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`guide_id`, `user_id`, `experience_years`, `specialization`, `avatar`, `note`) VALUES
(1, 2, 3, 'Du lịch sinh thái', 'image/GuideImages/1763637528-tải xuống.jpg', NULL),
(2, 3, 4, 'Du lịch văn hóa', 'image/GuideImages/1763637528-tải xuống.jpg', NULL),
(3, 4, 2, 'Du lịch biển', 'image/GuideImages/1763637528-tải xuống.jpg', NULL),
(4, 5, 5, 'Du lịch núi', 'image/GuideImages/1763637528-tải xuống.jpg', NULL),
(5, 6, 1, 'City tour', 'image/GuideImages/1763637528-tải xuống.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `guide_tours`
--

CREATE TABLE `guide_tours` (
  `id` int NOT NULL,
  `guide_id` int NOT NULL,
  `booking_id` int NOT NULL,
  `tour_id` int NOT NULL,
  `status` enum('current','history') DEFAULT 'current'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guide_tours`
--

INSERT INTO `guide_tours` (`id`, `guide_id`, `booking_id`, `tour_id`, `status`) VALUES
(1, 1, 1, 1, 'current'),
(2, 1, 2, 2, 'current'),
(3, 1, 3, 3, 'current'),
(4, 1, 4, 4, 'history'),
(5, 1, 5, 5, 'history'),
(6, 1, 6, 6, 'history'),
(7, 2, 7, 7, 'current'),
(8, 2, 8, 8, 'current'),
(9, 2, 9, 9, 'current'),
(10, 2, 10, 10, 'history'),
(11, 2, 11, 1, 'history'),
(12, 2, 12, 2, 'history'),
(13, 3, 13, 3, 'current'),
(14, 3, 14, 4, 'current'),
(15, 3, 15, 5, 'current'),
(16, 3, 16, 6, 'history'),
(17, 3, 17, 7, 'history'),
(18, 3, 18, 8, 'history'),
(19, 4, 19, 9, 'current'),
(21, 4, 21, 1, 'current'),
(22, 4, 22, 2, 'history'),
(23, 4, 23, 3, 'history'),
(24, 4, 24, 4, 'history'),
(25, 5, 25, 5, 'current'),
(26, 5, 26, 6, 'current'),
(27, 5, 27, 7, 'current'),
(28, 5, 28, 8, 'history'),
(29, 5, 29, 9, 'history'),
(30, 5, 30, 10, 'history'),
(38, 5, 48, 10, 'current'),
(43, 2, 53, 10, 'current'),
(44, 3, 54, 10, 'current'),
(45, 1, 55, 5, 'current'),
(49, 5, 59, 7, 'current'),
(50, 2, 60, 10, 'current'),
(51, 1, 61, 10, 'current'),
(52, 3, 62, 3, 'current'),
(53, 4, 63, 10, 'current'),
(54, 4, 64, 10, 'current'),
(55, 4, 65, 10, 'current'),
(56, 3, 66, 10, 'current');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_service_id` int NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `room_type` varchar(255) DEFAULT NULL,
  `price_per_night` decimal(12,2) DEFAULT NULL,
  `description` text,
  `hotel_image` varchar(255) DEFAULT NULL,
  `total_rooms` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_service_id`, `service_name`, `room_type`, `price_per_night`, `description`, `hotel_image`, `total_rooms`) VALUES
(1, 'Hotel A', 'Standard', '500000.00', 'Khách sạn A phòng Standard', NULL, 0),
(2, 'Hotel B', 'Deluxe', '800000.00', 'Khách sạn B phòng Deluxe', NULL, 0),
(3, 'Hotel C', 'Suite', '1200000.00', 'Khách sạn C phòng Suite', NULL, 0),
(4, 'Hotel D', 'Standard', '450000.00', 'Khách sạn D phòng Standard', NULL, 100),
(5, 'Hotel E', 'Premium', '1500000.00', 'Khách sạn E phòng Premium', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rooms`
--

CREATE TABLE `hotel_rooms` (
  `room_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `capacity` int DEFAULT '2',
  `bed_type` varchar(100) DEFAULT '1 giường đôi',
  `price_per_night` decimal(12,2) NOT NULL,
  `description` text,
  `status` enum('available','booked') DEFAULT 'available',
  `booking_id` int DEFAULT NULL,
  `room_number` varchar(50) NOT NULL,
  `floor` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hotel_rooms`
--

INSERT INTO `hotel_rooms` (`room_id`, `hotel_id`, `room_name`, `room_type`, `capacity`, `bed_type`, `price_per_night`, `description`, `status`, `booking_id`, `room_number`, `floor`) VALUES
(1, 1, 'Phòng Standard 1', 'Standard', 2, '1 giường đôi', '500000.00', 'Phòng tiêu chuẩn của Hotel A', 'available', NULL, '', 1),
(2, 1, 'Phòng Deluxe 1', 'Deluxe', 2, '1 giường lớn', '650000.00', 'Phòng Deluxe tiện nghi Hotel A', 'available', NULL, '', 1),
(3, 2, 'Phòng Deluxe 2', 'Deluxe', 2, '1 giường lớn', '800000.00', 'Phòng Deluxe khách sạn B', 'available', NULL, '', 1),
(4, 2, 'Phòng Suite 2', 'Suite', 4, '2 giường đôi', '1200000.00', 'Suite cao cấp tại Hotel B', 'available', NULL, '', 1),
(5, 3, 'Suite Family 3', 'Suite', 4, '2 giường lớn', '1500000.00', 'Phòng suite gia đình Hotel C', 'available', NULL, '', 1),
(6, 4, 'Standard D1', 'Standard', 2, '1 giường đôi', '450000.00', 'Phòng Standard Hotel D', 'available', NULL, '3', 1),
(7, 4, 'Deluxe D1', 'Deluxe', 2, '1 giường lớn', '650000.00', 'Phòng Deluxe Hotel D', 'available', NULL, '2', 1),
(8, 5, 'Premium E1', 'Premium', 2, '1 giường lớn', '1500000.00', 'Phòng Premium khách sạn E', 'available', NULL, '', 1),
(9, 5, 'Premium E2', 'Premium', 3, '1 giường lớn + 1 giường đơn', '1700000.00', 'Phòng Premium mở rộng Hotel E', 'available', NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
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
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `tour_id` int NOT NULL,
  `tour_name` varchar(150) NOT NULL,
  `description` text,
  `price_adult` int NOT NULL DEFAULT '0',
  `price_child` int NOT NULL DEFAULT '0',
  `price_vip` int NOT NULL DEFAULT '0',
  `price` decimal(12,2) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `tour_images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`tour_id`, `tour_name`, `description`, `price_adult`, `price_child`, `price_vip`, `price`, `category_id`, `tour_images`) VALUES
(1, 'Tour Biển 1', 'Tham quan biển 1', 0, 0, 0, '2000000.00', 1, NULL),
(2, 'Tour Biển 2', 'Tham quan biển 2', 0, 0, 0, '2200000.00', 1, NULL),
(3, 'Tour Biển 3', 'Tham quan biển 3', 0, 0, 0, '2300000.00', 1, NULL),
(4, 'Tour Núi 1', 'Khám phá núi 1', 0, 0, 0, '1500000.00', 2, NULL),
(5, 'Tour Núi 2', 'Khám phá núi 2', 0, 0, 0, '1800000.00', 2, NULL),
(6, 'Tour Núi 3', 'Khám phá núi 3', 0, 0, 0, '2100000.00', 2, NULL),
(7, 'Tour Hỗn hợp 1', 'Biển và núi 1', 0, 0, 0, '2500000.00', 1, NULL),
(8, 'Tour Hỗn hợp 2', 'Biển và núi 2', 0, 0, 0, '2600000.00', 2, NULL),
(9, 'Tour Premium 1', 'Trải nghiệm cao cấp 1', 0, 0, 0, '3000000.00', 1, NULL),
(10, 'Tour Premium 2', 'Trải nghiệm cao cấp 2', 0, 0, 0, '3500000.00', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `name`, `email`, `phone`) VALUES
(1, 'admin', '123', 'admin', 'Admin', 'admin@gmail.com', '0900000000'),
(2, 'guide1', '123', 'guide', 'Nguyễn HDV 1', 'g1@gmail.com', '0900000001'),
(3, 'guide2', '123', 'guide', 'Nguyễn HDV 2', 'g2@gmail.com', '0900000002'),
(4, 'guide3', '123', 'guide', 'Nguyễn HDV 3', 'g3@gmail.com', '0900000003'),
(5, 'guide4', '123', 'guide', 'Nguyễn HDV 4', 'g4@gmail.com', '0900000004'),
(6, 'guide5', '123', 'guide', 'Nguyễn HDV 5', 'g5@gmail.com', '0900000005');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_service_id` int NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `seat` int DEFAULT NULL,
  `price_per_day` decimal(12,2) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_service_id`, `service_name`, `seat`, `price_per_day`, `description`) VALUES
(1, 'Xe 16 chỗ', 16, '1500000.00', 'Xe 16 chỗ phổ thông'),
(2, 'Xe 29 chỗ', 29, '2200000.00', 'Xe 29 chỗ du lịch'),
(3, 'Xe 45 chỗ', 45, '3500000.00', 'Xe 45 chỗ đoàn lớn'),
(4, 'Xe Limousine', 9, '2500000.00', 'Xe Limousine cao cấp'),
(5, 'Xe VIP', 7, '3000000.00', 'Xe VIP riêng tư');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_ibfk_1` (`booking_id`),
  ADD KEY `attendance_ibfk_2` (`customer_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `fk_booking_guide` (`guide_id`),
  ADD KEY `fk_booking_hotel_service` (`hotel_id`),
  ADD KEY `fk_booking_vehicle_service` (`vehicle_id`);

--
-- Indexes for table `booking_customers`
--
ALTER TABLE `booking_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_customers_ibfk_1` (`booking_id`),
  ADD KEY `booking_customers_ibfk_2` (`customer_id`);

--
-- Indexes for table `booking_rooms`
--
ALTER TABLE `booking_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`guide_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `guide_tours`
--
ALTER TABLE `guide_tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guide_id` (`guide_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_service_id`);

--
-- Indexes for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `guide_id` (`guide_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `fk_report_booking` (`booking_id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `booking_customers`
--
ALTER TABLE `booking_customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=422;

--
-- AUTO_INCREMENT for table `booking_rooms`
--
ALTER TABLE `booking_rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `guide_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guide_tours`
--
ALTER TABLE `guide_tours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`),
  ADD CONSTRAINT `fk_booking_guide` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_hotel_service` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_service_id`),
  ADD CONSTRAINT `fk_booking_vehicle_service` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_service_id`);

--
-- Constraints for table `booking_customers`
--
ALTER TABLE `booking_customers`
  ADD CONSTRAINT `booking_customers_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_customers_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE RESTRICT;

--
-- Constraints for table `booking_rooms`
--
ALTER TABLE `booking_rooms`
  ADD CONSTRAINT `booking_rooms_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_rooms_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `hotel_rooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`);

--
-- Constraints for table `guides`
--
ALTER TABLE `guides`
  ADD CONSTRAINT `guides_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `guide_tours`
--
ALTER TABLE `guide_tours`
  ADD CONSTRAINT `guide_tours_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`),
  ADD CONSTRAINT `guide_tours_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

--
-- Constraints for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD CONSTRAINT `hotel_rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_report_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`);

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
