-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 20, 2025 lúc 10:20 AM
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
(1, 1, 1, 'present', NULL),
(2, 1, 2, 'present', NULL),
(3, 1, 3, 'present', NULL),
(4, 1, 4, 'present', NULL),
(5, 1, 5, 'present', NULL),
(6, 2, 6, 'present', NULL),
(7, 2, 7, 'present', NULL),
(8, 2, 8, 'present', NULL),
(9, 2, 9, 'present', NULL),
(10, 2, 10, 'present', NULL),
(11, 3, 11, 'present', NULL),
(12, 3, 12, 'present', NULL),
(13, 3, 13, 'present', NULL),
(14, 3, 14, 'present', NULL),
(15, 3, 15, 'present', NULL),
(16, 4, 16, 'present', NULL),
(17, 4, 17, 'present', NULL),
(18, 4, 18, 'present', NULL),
(19, 4, 19, 'present', NULL),
(20, 4, 20, 'present', NULL),
(21, 5, 21, 'present', NULL),
(22, 5, 22, 'present', NULL),
(23, 5, 23, 'present', NULL),
(24, 5, 24, 'present', NULL),
(25, 5, 25, 'present', NULL),
(26, 6, 26, 'present', NULL),
(27, 6, 27, 'present', NULL),
(28, 6, 28, 'present', NULL),
(29, 6, 29, 'present', NULL),
(30, 6, 30, 'present', NULL),
(31, 7, 1, 'present', NULL),
(32, 7, 2, 'present', NULL),
(33, 7, 3, 'present', NULL),
(34, 7, 4, 'present', NULL),
(35, 7, 5, 'present', NULL),
(36, 8, 6, 'present', NULL),
(37, 8, 7, 'present', NULL),
(38, 8, 8, 'present', NULL),
(39, 8, 9, 'present', NULL),
(40, 8, 10, 'present', NULL),
(41, 9, 11, 'present', NULL),
(42, 9, 12, 'present', NULL),
(43, 9, 13, 'present', NULL),
(44, 9, 14, 'present', NULL),
(45, 9, 15, 'present', NULL),
(46, 10, 16, 'present', NULL),
(47, 10, 17, 'present', NULL),
(48, 10, 18, 'present', NULL),
(49, 10, 19, 'present', NULL),
(50, 10, 20, 'present', NULL);

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
  `status` enum('cho_duyet','dang_dien_ra','cho_hdv_xac_nhan','da_hoan_thanh','da_huy') NOT NULL DEFAULT 'cho_duyet',
  `report` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`booking_id`, `tour_id`, `guide_id`, `hotel_id`, `vehicle_id`, `status`, `report`, `created_at`, `start_date`, `end_date`) VALUES
(1, 1, 1, 3, 5, 'da_hoan_thanh', NULL, '2025-11-20 08:10:40', '2025-03-22', '2025-03-25'),
(2, 2, 2, 3, 5, 'da_hoan_thanh', NULL, '2025-11-20 08:10:40', '2025-02-07', '2025-04-04'),
(3, 3, 3, 3, 5, 'da_hoan_thanh', NULL, '2025-11-20 08:10:40', '2025-04-20', '2025-04-23'),
(4, 4, 4, 3, 5, 'da_huy', NULL, '2025-11-20 08:10:40', '2025-03-06', '2025-04-21'),
(5, 5, 5, 3, 5, 'cho_hdv_xac_nhan', NULL, '2025-11-20 08:10:40', '2025-04-27', '2025-04-28'),
(6, 6, 6, 3, 5, 'da_huy', NULL, '2025-11-20 08:10:40', '2025-03-19', '2025-04-20'),
(7, 7, NULL, 3, 5, 'cho_duyet', NULL, '2025-11-20 08:10:40', '2025-03-11', '2025-03-15'),
(8, 8, 8, 3, 5, 'da_huy', NULL, '2025-11-20 08:10:40', '2025-01-25', '2025-02-25'),
(9, 9, 9, 3, 5, 'cho_hdv_xac_nhan', NULL, '2025-11-20 08:10:40', '2025-03-22', '2025-04-30'),
(10, 10, NULL, 3, 5, 'cho_duyet', NULL, '2025-11-20 08:10:40', '2025-04-21', '2025-04-25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_customers`
--

CREATE TABLE `booking_customers` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `is_main` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_customers`
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
(31, 7, 1, 1),
(32, 7, 2, 0),
(33, 7, 3, 0),
(34, 7, 4, 0),
(35, 7, 5, 0),
(36, 8, 6, 1),
(37, 8, 7, 0),
(38, 8, 8, 0),
(39, 8, 9, 0),
(40, 8, 10, 0),
(41, 9, 11, 1),
(42, 9, 12, 0),
(43, 9, 13, 0),
(44, 9, 14, 0),
(45, 9, 15, 0),
(46, 10, 16, 1),
(47, 10, 17, 0),
(48, 10, 18, 0),
(49, 10, 19, 0),
(50, 10, 20, 0);

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
(6, 'Nước Ngoài'),
(7, 'Trong Nước');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `full_name`, `email`, `phone`, `address`) VALUES
(1, 'Nguyễn Văn A', 'a1@gmail.com', '0901000001', 'Hà Nội'),
(2, 'Trần Thị B', 'b2@gmail.com', '0901000002', 'Đà Nẵng'),
(3, 'Lê Văn C', 'c3@gmail.com', '0901000003', 'TP.HCM'),
(4, 'Phạm Thị D', 'd4@gmail.com', '0901000004', 'Cần Thơ'),
(5, 'Hoàng Văn E', 'e5@gmail.com', '0901000005', 'Huế'),
(6, 'Ngô Thị F', 'f6@gmail.com', '0901000006', 'Hải Phòng'),
(7, 'Vũ Văn G', 'g7@gmail.com', '0901000007', 'Nha Trang'),
(8, 'Đỗ Thị H', 'h8@gmail.com', '0901000008', 'Bắc Ninh'),
(9, 'Bùi Văn I', 'i9@gmail.com', '0901000009', 'Đà Lạt'),
(10, 'Phan Văn K', 'k10@gmail.com', '0901000010', 'Hà Nội'),
(11, 'Đặng Thị L', 'l11@gmail.com', '0901000011', 'Quảng Ninh'),
(12, 'Mai Văn M', 'm12@gmail.com', '0901000012', 'Hải Dương'),
(13, 'Hồ Thị N', 'n13@gmail.com', '0901000013', 'Hà Tĩnh'),
(14, 'Kiều Văn O', 'o14@gmail.com', '0901000014', 'Bình Thuận'),
(15, 'Đan Thị P', 'p15@gmail.com', '0901000015', 'Kon Tum'),
(16, 'Phùng Văn Q', 'q16@gmail.com', '0901000016', 'Gia Lai'),
(17, 'Tạ Thị R', 'r17@gmail.com', '0901000017', 'Yên Bái'),
(18, 'Thái Văn S', 's18@gmail.com', '0901000018', 'Bắc Giang'),
(19, 'Chu Thị T', 't19@gmail.com', '0901000019', 'Vĩnh Phúc'),
(20, 'Lý Văn U', 'u20@gmail.com', '0901000020', 'Thanh Hóa'),
(21, 'Đỗ Thị V', 'v21@gmail.com', '0901000021', 'Nam Định'),
(22, 'Đinh Văn X', 'x22@gmail.com', '0901000022', 'Hà Nam'),
(23, 'Đoàn Thị Y', 'y23@gmail.com', '0901000023', 'Phú Thọ'),
(24, 'Hà Văn Z', 'z24@gmail.com', '0901000024', 'Hòa Bình'),
(25, 'Nguyễn Thu A1', 'a25@gmail.com', '0901000025', 'Ninh Thuận'),
(26, 'Mai Đức B1', 'b26@gmail.com', '0901000026', 'Quảng Bình'),
(27, 'Lê Hải C1', 'c27@gmail.com', '0901000027', 'Đồng Nai'),
(28, 'Hoàng Phát D1', 'd28@gmail.com', '0901000028', 'Vũng Tàu'),
(29, 'Trịnh Hoa E1', 'e29@gmail.com', '0901000029', 'Long An'),
(30, 'Trần Duy F1', 'f30@gmail.com', '0901000030', 'Bình Dương');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discounts`
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
-- Đang đổ dữ liệu cho bảng `discounts`
--

INSERT INTO `discounts` (`discount_id`, `code`, `description`, `discount_type`, `value`, `start_date`, `end_date`, `tour_id`, `status`) VALUES
(2, 'PQ5', 'Giảm 5% Tour Phú Quốc', 'percent', 5.00, '2025-01-01', '2025-02-10', 2, 'active'),
(3, 'SP15', 'Giảm 15% Tour Sapa', 'percent', 15.00, '2024-12-01', '2025-01-10', 3, 'expired'),
(4, 'NT100', 'Giảm 100k Tour Nha Trang', 'fixed', 100000.00, '2024-11-01', '2024-12-15', 4, 'expired'),
(5, 'HL10', 'Giảm 10% Tour Hạ Long', 'percent', 10.00, '2025-02-01', '2025-03-20', 5, 'upcoming'),
(6, 'HUE8', 'Giảm 8% Tour Huế', 'percent', 8.00, '2025-03-01', '2025-04-10', 6, 'upcoming'),
(7, 'HA5', 'Giảm 5% Tour Hội An', 'percent', 5.00, '2025-04-15', '2025-05-20', 7, 'upcoming'),
(8, 'CT7', 'Giảm 7% Tour Cần Thơ', 'percent', 7.00, '2025-05-15', '2025-06-20', 8, 'upcoming'),
(9, 'NB12', 'Giảm 12% Tour Ninh Bình', 'percent', 12.00, '2025-06-01', '2025-07-20', 9, 'upcoming'),
(10, 'DN200', 'Giảm 200k Tour Đà Nẵng', 'fixed', 200000.00, '2025-07-01', '2025-08-20', 10, 'upcoming');

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
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `guides`
--

INSERT INTO `guides` (`guide_id`, `user_id`, `experience_years`, `specialization`, `avatar`, `note`) VALUES
(1, 3, 5, 'Trong Nước', 'image/GuideImages/1763629786-tải xuống.png', 'HDV chuyên nghiệp'),
(2, 4, 3, 'Nước Ngoài', 'image/GuideImages/1763629786-tải xuống.png', 'Thân thiện'),
(3, 5, 6, 'Nước Ngoài', 'image/GuideImages/1763629786-tải xuống.png', 'Nhiệt tình'),
(4, 6, 2, 'Nước Ngoài', 'image/GuideImages/1763629786-tải xuống.png', 'Vui vẻ'),
(5, 7, 4, 'Trong Nước', 'image/GuideImages/1763629786-tải xuống.png', 'Kinh nghiệm cao'),
(6, 8, 3, 'Trong Nước', 'image/GuideImages/1763629786-tải xuống.png', 'Giao tiếp tốt'),
(7, 9, 2, 'Nước Ngoài', 'image/GuideImages/1763629786-tải xuống.png', 'Thấu hiểu khách hàng'),
(8, 10, 4, 'Trong Nước', 'image/GuideImages/1763629786-tải xuống.png', 'Cẩn thận'),
(9, 5, 1, 'Trong Nước', 'image/GuideImages/1763629786-tải xuống.png', 'Tận tâm'),
(10, 6, 5, 'Trong Nước', 'image/GuideImages/1763629786-tải xuống.png', 'Hiểu biết văn hoá');

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
(1, 1, 1, 0, 'history'),
(2, 2, 2, 0, 'history'),
(3, 3, 3, 0, 'history'),
(4, 4, 4, 0, 'history'),
(5, 5, 5, 0, 'current'),
(6, 6, 6, 0, 'history'),
(7, 8, 8, 0, 'history'),
(8, 9, 9, 0, 'current');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotels`
--

CREATE TABLE `hotels` (
  `hotel_service_id` int NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `room_type` varchar(255) DEFAULT NULL,
  `price_per_night` decimal(12,2) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `hotels`
--

INSERT INTO `hotels` (`hotel_service_id`, `service_name`, `room_type`, `price_per_night`, `description`) VALUES
(1, 'Vinpearl Hotel', 'Phòng Deluxe', 1800000.00, 'Khách sạn 5 sao, gần biển, hồ bơi vô cực.'),
(2, 'Furama Resort', 'Phòng Suite', 2500000.00, 'Resort cao cấp tại Đà Nẵng, bữa sáng buffet.'),
(3, 'Mường Thanh Luxury', 'Phòng Superior', 1200000.00, 'Khách sạn gần trung tâm thành phố, view biển.'),
(4, 'Novotel Saigon Centre', 'Phòng Executive', 2200000.00, 'Nằm tại trung tâm TP.HCM, view toàn cảnh phố.'),
(5, 'Golden Bay Hotel', 'Phòng Golden Suite', 3000000.00, 'Khách sạn dát vàng Đà Nẵng, hồ bơi vô cực.');

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

--
-- Đang đổ dữ liệu cho bảng `reports`
--

INSERT INTO `reports` (`report_id`, `guide_id`, `tour_id`, `booking_id`, `report_date`, `content`, `rating`) VALUES
(1, 1, 1, 1, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(2, 2, 2, 2, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(3, 3, 3, 3, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(4, 4, 4, 4, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(5, 5, 5, 5, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(6, 6, 6, 6, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(7, 7, 7, 7, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(8, 8, 8, 8, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(9, 9, 9, 9, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5),
(10, 10, 10, 10, '2025-11-20', 'Báo cáo mẫu từ hệ thống', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `revenues`
--

CREATE TABLE `revenues` (
  `revenue_id` int NOT NULL,
  `booking_id` int DEFAULT NULL,
  `tour_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `discount_id` int DEFAULT NULL,
  `original_price` decimal(12,2) DEFAULT NULL,
  `discount_amount` decimal(12,2) DEFAULT NULL,
  `final_price` decimal(12,2) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_method` enum('cash','bank','credit') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `revenues`
--

INSERT INTO `revenues` (`revenue_id`, `booking_id`, `tour_id`, `customer_id`, `discount_id`, `original_price`, `discount_amount`, `final_price`, `payment_date`, `payment_method`) VALUES
(1, 1, 1, 1, NULL, 3600000.00, 0.00, 3600000.00, '2025-11-20 15:10:51', 'cash'),
(2, 2, 2, 6, NULL, 5200000.00, 0.00, 5200000.00, '2025-11-20 15:10:51', 'cash'),
(3, 3, 3, 11, NULL, 4200000.00, 0.00, 4200000.00, '2025-11-20 15:10:51', 'cash'),
(4, 4, 4, 16, NULL, 2800000.00, 0.00, 2800000.00, '2025-11-20 15:10:51', 'cash'),
(5, 5, 5, 21, NULL, 4500000.00, 0.00, 4500000.00, '2025-11-20 15:10:51', 'cash'),
(6, 6, 6, 26, NULL, 2500000.00, 0.00, 2500000.00, '2025-11-20 15:10:51', 'cash'),
(7, 7, 7, 1, NULL, 3200000.00, 0.00, 3200000.00, '2025-11-20 15:10:51', 'cash'),
(8, 8, 8, 6, NULL, 2600000.00, 0.00, 2600000.00, '2025-11-20 15:10:51', 'cash'),
(9, 9, 9, 11, NULL, 2800000.00, 0.00, 2800000.00, '2025-11-20 15:10:51', 'cash'),
(10, 10, 10, 16, NULL, 3900000.00, 0.00, 3900000.00, '2025-11-20 15:10:51', 'cash');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tours`
--

CREATE TABLE `tours` (
  `tour_id` int NOT NULL,
  `tour_name` varchar(150) NOT NULL,
  `description` text,
  `price` decimal(12,2) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `tour_images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`tour_id`, `tour_name`, `description`, `price`, `category_id`, `tour_images`) VALUES
(1, 'Tour Đà Lạt 3N2Đ', 'Khám phá thành phố ngàn hoa.', 3600000.00, 6, ''),
(2, 'Tour Phú Quốc 4N3Đ', 'Vinpearl Safari, Grand World.', 5200000.00, 7, ''),
(3, 'Tour Sapa 3N2Đ', 'Leo Fansipan, bản Cát Cát.', 4200000.00, 6, ''),
(4, 'Tour Nha Trang 2N1Đ', 'Tắm biển và VinWonders.', 2800000.00, 6, ''),
(5, 'Tour Hạ Long 3N2Đ', 'Du thuyền và hang Sửng Sốt.', 4500000.00, 7, ''),
(6, 'Tour Huế 2N1Đ', 'Tham quan Kinh Thành Huế.', 2500000.00, 7, ''),
(7, 'Tour Hội An 3N2Đ', 'Phố cổ và biển An Bàng.', 3200000.00, 7, ''),
(8, 'Tour Cần Thơ 2N1Đ', 'Chợ nổi Cái Răng.', 2600000.00, 6, ''),
(9, 'Tour Ninh Bình 2N1Đ', 'Tràng An - Tam Cốc.', 2800000.00, 6, 'image/TourImages/1763629009-tải xuống (1).jpg'),
(10, 'Tour Đà Nẵng 3N2Đ', 'Bà Nà Hills - Mỹ Khê.', 3900000.00, 7, 'image/TourImages/1763628956-tải xuống.jpg');

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
(2, 'admin02', '123456', 'admin', 'Admin', 'hoa@example.com', '0909000002'),
(3, 'guide01', '123456', 'guide', 'Phạm Văn Sơn', 'son@example.com', '0909000003'),
(4, 'guide02', '123456', 'guide', 'Trần Thị Mai', 'mai@example.com', '0909000004'),
(5, 'guide03', '123456', 'guide', 'Đỗ Văn Nam', 'nam@example.com', '0909000005'),
(6, 'guide04', '123456', 'guide', 'Hoàng Lan', 'lan@example.com', '0909000006'),
(7, 'guide05', '123456', 'guide', 'Lê Văn Huy', 'huy@example.com', '0909000007'),
(8, 'guide06', '123456', 'guide', 'Ngô Minh', 'minh@example.com', '0909000008'),
(9, 'guide07', '123456', 'guide', 'Bùi Thảo', 'thao@example.com', '0909000009'),
(10, 'guide08', '123456', 'guide', 'Phan Hải', 'hai@example.com', '0909000010');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_service_id` int NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `seat` int DEFAULT NULL,
  `price_per_day` decimal(12,2) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `vehicles`
--

INSERT INTO `vehicles` (`vehicle_service_id`, `service_name`, `seat`, `price_per_day`, `description`) VALUES
(1, 'Toyota Fortuner', 7, 1200000.00, 'Xe SUV 7 chỗ, thích hợp đi tour gia đình.'),
(2, 'Ford Transit', 16, 2000000.00, 'Xe du lịch 16 chỗ, điều hoà mạnh, ghế cao cấp.'),
(3, 'Hyundai Universe', 45, 4500000.00, 'Xe giường nằm 45 chỗ, phù hợp tour đoàn lớn.'),
(4, 'Mazda 6', 4, 900000.00, 'Sedan sang trọng, phù hợp khách VIP.'),
(5, 'Mercedes Sprinter', 12, 1500000.00, 'Xe đưa đón 12 chỗ, nội thất cao cấp.');

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
-- Chỉ mục cho bảng `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `tour_id` (`tour_id`);

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
-- Chỉ mục cho bảng `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`revenue_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `discount_id` (`discount_id`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `category_id` (`category_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `booking_customers`
--
ALTER TABLE `booking_customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `guides`
--
ALTER TABLE `guides`
  MODIFY `guide_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `guide_tours`
--
ALTER TABLE `guide_tours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `revenues`
--
ALTER TABLE `revenues`
  MODIFY `revenue_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Các ràng buộc cho bảng `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`);

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
-- Các ràng buộc cho bảng `revenues`
--
ALTER TABLE `revenues`
  ADD CONSTRAINT `revenues_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `revenues_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`),
  ADD CONSTRAINT `revenues_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `revenues_ibfk_4` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`discount_id`);

--
-- Các ràng buộc cho bảng `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
