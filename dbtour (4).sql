-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 11, 2025 lúc 10:50 AM
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
(320, 85, 50, 'absent', NULL),
(321, 85, 49, 'absent', NULL),
(322, 85, 48, 'absent', NULL),
(323, 85, 47, 'absent', NULL),
(324, 85, 46, 'absent', NULL),
(325, 86, 41, 'absent', NULL),
(326, 86, 39, 'absent', NULL),
(327, 86, 38, 'absent', NULL),
(328, 86, 37, 'absent', NULL),
(329, 86, 36, 'absent', NULL),
(330, 87, 45, 'absent', NULL),
(331, 87, 44, 'absent', NULL),
(332, 87, 43, 'absent', NULL),
(333, 87, 42, 'absent', NULL),
(334, 87, 40, 'absent', NULL);

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
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`booking_id`, `tour_id`, `guide_id`, `hotel_id`, `vehicle_id`, `status`, `report`, `created_at`, `start_date`, `end_date`, `total_price`, `note`) VALUES
(85, 21, 3, 3, NULL, 'dang_dien_ra', '', '2025-12-11 02:02:33', '2025-12-11', '2025-12-16', 0.00, NULL),
(86, 26, 5, 3, NULL, 'dang_dien_ra', '', '2025-12-11 02:53:31', '2025-12-11', '2025-12-13', 0.00, NULL),
(87, 23, 4, 3, NULL, 'sap_dien_ra', '', '2025-12-11 03:45:02', '2025-12-12', '2025-12-16', 0.00, NULL);

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
(350, 85, 50, 0, 21840000),
(351, 85, 49, 0, 19840000),
(352, 85, 48, 0, 19840000),
(353, 85, 47, 0, 21840000),
(354, 85, 46, 0, 18840000),
(355, 86, 41, 0, 17483333),
(356, 86, 39, 0, 17483333),
(357, 86, 38, 0, 15733333),
(358, 86, 37, 0, 14900000),
(359, 86, 36, 0, 14900000),
(360, 87, 45, 0, 11800000),
(361, 87, 44, 0, 11800000),
(362, 87, 43, 0, 11800000),
(363, 87, 42, 1, 13800000),
(364, 87, 40, 0, 11800000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_segment_customers`
--

CREATE TABLE `booking_segment_customers` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `tour_schedule_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `segment_price_per_customer` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_segment_customers`
--

INSERT INTO `booking_segment_customers` (`id`, `booking_id`, `tour_schedule_id`, `customer_id`, `vehicle_id`, `segment_price_per_customer`) VALUES
(85, 85, 119, 50, 2, 440000),
(86, 85, 119, 49, 2, 440000),
(87, 85, 119, 48, 2, 440000),
(88, 85, 119, 47, 2, 440000),
(89, 85, 119, 46, 2, 440000),
(90, 85, 120, 50, 3, 700000),
(91, 85, 120, 49, 3, 700000),
(92, 85, 120, 48, 3, 700000),
(93, 85, 120, 47, 3, 700000),
(94, 85, 120, 46, 3, 700000),
(95, 85, 121, 50, 4, 833333),
(96, 85, 121, 49, 4, 0),
(97, 85, 121, 48, 4, 0),
(98, 85, 121, 47, 4, 833333),
(99, 85, 121, 46, 4, 833333),
(100, 85, 122, 50, 3, 700000),
(101, 85, 122, 49, 3, 700000),
(102, 85, 122, 48, 3, 700000),
(103, 85, 122, 47, 3, 700000),
(104, 85, 122, 46, 3, 700000),
(105, 85, 123, 50, 3, 1166667),
(106, 85, 123, 49, 3, 0),
(107, 85, 123, 48, 3, 0),
(108, 85, 123, 47, 3, 1166667),
(109, 85, 123, 46, 3, 1166667),
(110, 86, 162, 41, 3, 1750000),
(111, 86, 162, 39, 3, 1750000),
(112, 86, 162, 38, 3, 0),
(113, 86, 162, 37, 3, 0),
(114, 86, 162, 36, 3, 0),
(115, 86, 163, 41, 4, 833333),
(116, 86, 163, 39, 4, 833333),
(117, 86, 163, 38, 4, 833333),
(118, 86, 163, 37, 4, 0),
(119, 86, 163, 36, 4, 0);

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
(138, 3, 85, 21, 'current'),
(139, 5, 86, 26, 'current'),
(140, 4, 87, 23, 'current');

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
-- Chỉ mục cho bảng `booking_segment_customers`
--
ALTER TABLE `booking_segment_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_booking` (`booking_id`),
  ADD KEY `idx_schedule` (`tour_schedule_id`),
  ADD KEY `idx_customer` (`customer_id`),
  ADD KEY `idx_vehicle` (`vehicle_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `booking_customers`
--
ALTER TABLE `booking_customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT cho bảng `booking_segment_customers`
--
ALTER TABLE `booking_segment_customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

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
-- Các ràng buộc cho bảng `booking_segment_customers`
--
ALTER TABLE `booking_segment_customers`
  ADD CONSTRAINT `fk_bsc_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bsc_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `fk_bsc_schedule` FOREIGN KEY (`tour_schedule_id`) REFERENCES `tour_schedules` (`tour_schedule_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bsc_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_service_id`);

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
