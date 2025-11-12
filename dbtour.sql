-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2025 lúc 06:37 AM
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
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int NOT NULL,
  `tour_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`booking_id`, `tour_id`, `customer_id`, `status`, `created_at`) VALUES
(1, 1, 1, 'confirmed', '2025-11-12 06:16:12'),
(2, 2, 2, 'confirmed', '2025-11-12 06:16:12'),
(3, 3, 3, 'pending', '2025-11-12 06:16:12'),
(4, 4, 4, 'completed', '2025-11-12 06:16:12'),
(5, 5, 5, 'pending', '2025-11-12 06:16:12'),
(6, 6, 6, 'cancelled', '2025-11-12 06:16:12'),
(7, 7, 7, 'confirmed', '2025-11-12 06:16:12'),
(8, 8, 8, 'completed', '2025-11-12 06:16:12'),
(9, 9, 9, 'pending', '2025-11-12 06:16:12');

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
(1, 'Miền Bắc'),
(2, 'Miền Trung'),
(3, 'Miền Nam'),
(4, 'Miền Tây'),
(5, 'Miền Đông'),
(6, 'Nước Ngoài'),
(7, 'Trong Nước'),
(8, 'Miền Cao'),
(9, 'Biển Đảo'),
(10, 'Thành Phố');

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
(1, 'Nguyễn Văn A', 'a@gmail.com', '0901000001', 'Hà Nội'),
(2, 'Trần Thị B', 'b@gmail.com', '0901000002', 'Đà Nẵng'),
(3, 'Lê Văn C', 'c@gmail.com', '0901000003', 'TP.HCM'),
(4, 'Phạm Thị D', 'd@gmail.com', '0901000004', 'Cần Thơ'),
(5, 'Hoàng Văn E', 'e@gmail.com', '0901000005', 'Huế'),
(6, 'Ngô Thị F', 'f@gmail.com', '0901000006', 'Hải Phòng'),
(7, 'Vũ Văn G', 'g@gmail.com', '0901000007', 'Nha Trang'),
(8, 'Đỗ Thị H', 'h@gmail.com', '0901000008', 'Bắc Ninh'),
(9, 'Bùi Văn I', 'i@gmail.com', '0901000009', 'Đà Lạt');

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
(1, 'DL10', 'Giảm 10% Tour Đà Lạt', 'percent', 10.00, '2024-12-01', '2025-01-15', 1, 'active'),
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
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `guides`
--

INSERT INTO `guides` (`guide_id`, `user_id`, `experience_years`, `specialization`, `note`) VALUES
(1, 3, 5, 'Miền Bắc', 'HDV chuyên nghiệp'),
(2, 4, 3, 'Miền Trung', 'Thân thiện'),
(3, 5, 6, 'Miền Nam', 'Nhiệt tình'),
(4, 6, 2, 'Miền Tây', 'Vui vẻ'),
(5, 7, 4, 'Miền Trung', 'Kinh nghiệm cao'),
(6, 8, 3, 'Miền Bắc', 'Giao tiếp tốt'),
(7, 9, 2, 'Miền Nam', 'Thấu hiểu khách hàng'),
(8, 10, 4, 'Miền Tây', 'Cẩn thận'),
(9, 5, 1, 'Miền Trung', 'Tận tâm'),
(10, 6, 5, 'Miền Nam', 'Hiểu biết văn hóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int NOT NULL,
  `supplier_id` int DEFAULT NULL,
  `hotel_name` varchar(150) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `supplier_id`, `hotel_name`, `address`, `rating`) VALUES
(1, 1, 'Paradise Resort', 'Nha Trang', 4.5),
(2, 2, 'Ocean View Hotel', 'Phú Quốc', 4.0),
(3, 6, 'Green Garden', 'Đà Lạt', 4.2),
(4, 7, 'Asia Palace', 'Huế', 4.3),
(5, 9, 'Sky Tower', 'Hà Nội', 4.8),
(6, 1, 'Blue Sea', 'Nha Trang', 4.1),
(7, 2, 'Sunny Pearl', 'Phú Quốc', 3.9),
(8, 6, 'Flower Hill', 'Đà Lạt', 4.7),
(9, 7, 'Royal River', 'Huế', 4.6),
(10, 9, 'Moonlight', 'Hà Nội', 4.4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `report_id` int NOT NULL,
  `guide_id` int DEFAULT NULL,
  `tour_id` int DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `content` text,
  `rating` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `reports`
--

INSERT INTO `reports` (`report_id`, `guide_id`, `tour_id`, `report_date`, `content`, `rating`) VALUES
(11, 1, 1, '2025-01-15', 'Tour Đà Lạt rất thành công.', 5),
(12, 2, 2, '2025-02-10', 'Phú Quốc có phản hồi tốt.', 4),
(13, 3, 3, '2024-12-25', 'Sapa gặp thời tiết xấu.', 3),
(14, 4, 4, '2024-12-10', 'Nha Trang được khách khen.', 5),
(15, 5, 5, '2025-03-18', 'Hạ Long đông khách.', 4),
(16, 6, 6, '2025-04-08', 'Huế dịch vụ tốt.', 4),
(17, 7, 7, '2025-05-12', 'Hội An tổ chức tốt.', 5),
(18, 8, 8, '2025-06-12', 'Cần Thơ vui.', 4),
(19, 9, 9, '2025-07-17', 'Ninh Bình cảnh đẹp.', 5),
(20, 10, 10, '2025-08-14', 'Đà Nẵng hài lòng.', 5);

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
(1, 1, 1, 1, 1, 3500000.00, 350000.00, 3150000.00, '2025-11-12 13:16:17', 'bank'),
(2, 2, 2, 2, 2, 5200000.00, 260000.00, 4940000.00, '2025-11-12 13:16:17', 'credit'),
(3, 3, 3, 3, 3, 4200000.00, 630000.00, 3570000.00, '2025-11-12 13:16:17', 'cash'),
(4, 4, 4, 4, 4, 2800000.00, 100000.00, 2700000.00, '2025-11-12 13:16:17', 'bank'),
(5, 5, 5, 5, 5, 4500000.00, 450000.00, 4050000.00, '2025-11-12 13:16:17', 'cash'),
(6, 6, 6, 6, 6, 2500000.00, 200000.00, 2300000.00, '2025-11-12 13:16:17', 'bank'),
(7, 7, 7, 7, 7, 3200000.00, 160000.00, 3040000.00, '2025-11-12 13:16:17', 'credit'),
(8, 8, 8, 8, 8, 2600000.00, 182000.00, 2418000.00, '2025-11-12 13:16:17', 'cash'),
(9, 9, 9, 9, 9, 2800000.00, 336000.00, 2464000.00, '2025-11-12 13:16:17', 'bank');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `type` enum('hotel','vehicle') NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `type`, `contact`, `address`) VALUES
(1, 'Resort Paradise', 'hotel', 'hotel1@example.com', 'Nha Trang'),
(2, 'Ocean View Hotel', 'hotel', 'hotel2@example.com', 'Phú Quốc'),
(3, 'Sun Travel', 'vehicle', 'travel1@example.com', 'Hà Nội'),
(4, 'Happy Bus', 'vehicle', 'travel2@example.com', 'Đà Nẵng'),
(5, 'Saigon Car', 'vehicle', 'travel3@example.com', 'TP.HCM'),
(6, 'Green Hotel', 'hotel', 'hotel3@example.com', 'Đà Lạt'),
(7, 'Asia Hotel', 'hotel', 'hotel4@example.com', 'Huế'),
(8, 'Luxury Bus', 'vehicle', 'travel4@example.com', 'Cần Thơ'),
(9, 'Sky Hotel', 'hotel', 'hotel5@example.com', 'Hà Nội'),
(10, 'GoNow Car', 'vehicle', 'travel5@example.com', 'Quảng Ninh');

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
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('upcoming','ongoing','finished') DEFAULT 'upcoming'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`tour_id`, `tour_name`, `description`, `price`, `category_id`, `start_date`, `end_date`, `status`) VALUES
(1, 'Tour Đà Lạt 3N2Đ', 'Khám phá thành phố ngàn hoa.', 3500000.00, 1, '2025-01-10', '2025-01-12', 'upcoming'),
(2, 'Tour Phú Quốc 4N3Đ', 'Vinpearl Safari, Grand World.', 5200000.00, 2, '2025-02-02', '2025-02-05', 'upcoming'),
(3, 'Tour Sapa 3N2Đ', 'Leo Fansipan, bản Cát Cát.', 4200000.00, 3, '2024-12-20', '2024-12-22', 'ongoing'),
(4, 'Tour Nha Trang 2N1Đ', 'Tắm biển và VinWonders.', 2800000.00, 4, '2024-12-05', '2024-12-06', 'finished'),
(5, 'Tour Hạ Long 3N2Đ', 'Du thuyền và hang Sửng Sốt.', 4500000.00, 5, '2025-03-15', '2025-03-17', 'upcoming'),
(6, 'Tour Huế 2N1Đ', 'Tham quan Kinh Thành Huế.', 2500000.00, 6, '2025-04-05', '2025-04-06', 'upcoming'),
(7, 'Tour Hội An 3N2Đ', 'Phố cổ và biển An Bàng.', 3200000.00, 7, '2025-05-10', '2025-05-12', 'upcoming'),
(8, 'Tour Cần Thơ 2N1Đ', 'Chợ nổi Cái Răng.', 2600000.00, 8, '2025-06-10', '2025-06-11', 'upcoming'),
(9, 'Tour Ninh Bình 2N1Đ', 'Tràng An - Tam Cốc.', 2800000.00, 9, '2025-07-15', '2025-07-16', 'upcoming'),
(10, 'Tour Đà Nẵng 3N2Đ', 'Bà Nà Hills - Mỹ Khê.', 3900000.00, 10, '2025-08-10', '2025-08-12', 'upcoming');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tour_guides`
--

CREATE TABLE `tour_guides` (
  `tour_id` int NOT NULL,
  `guide_id` int NOT NULL,
  `assigned_date` date DEFAULT NULL,
  `status` enum('assigned','completed','cancelled') DEFAULT 'assigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `tour_guides`
--

INSERT INTO `tour_guides` (`tour_id`, `guide_id`, `assigned_date`, `status`) VALUES
(1, 1, '2025-01-05', 'assigned'),
(2, 2, '2025-01-25', 'assigned'),
(3, 3, '2024-12-15', 'completed'),
(4, 4, '2024-12-04', 'completed'),
(5, 5, '2025-03-10', 'assigned'),
(6, 6, '2025-03-30', 'assigned'),
(7, 7, '2025-05-05', 'assigned'),
(8, 8, '2025-06-05', 'assigned'),
(9, 9, '2025-07-10', 'assigned'),
(10, 10, '2025-08-05', 'assigned');

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
(1, 'admin01', '123456', 'admin', 'Nguyễn Văn Quản', 'quan@example.com', '0909000001'),
(2, 'admin02', '123456', 'admin', 'Lê Thị Hoa', 'hoa@example.com', '0909000002'),
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
  `vehicle_id` int NOT NULL,
  `supplier_id` int DEFAULT NULL,
  `plate_number` varchar(20) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `capacity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `supplier_id`, `plate_number`, `type`, `capacity`) VALUES
(1, 3, '30A-12345', 'Bus', 45),
(2, 4, '43B-56789', 'Bus', 30),
(3, 5, '51C-99999', 'Car', 7),
(4, 8, '65D-22222', 'Bus', 40),
(5, 10, '79E-33333', 'Car', 16),
(6, 3, '30A-88888', 'Bus', 24),
(7, 5, '51C-77777', 'Car', 12),
(8, 8, '65D-66666', 'Bus', 50),
(9, 4, '43B-55555', 'Bus', 35),
(10, 10, '79E-11111', 'Car', 10);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `customer_id` (`customer_id`);

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
-- Chỉ mục cho bảng `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `guide_id` (`guide_id`),
  ADD KEY `tour_id` (`tour_id`);

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
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `tour_guides`
--
ALTER TABLE `tour_guides`
  ADD PRIMARY KEY (`tour_id`,`guide_id`),
  ADD KEY `guide_id` (`guide_id`);

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
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `guides`
--
ALTER TABLE `guides`
  MODIFY `guide_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `revenues`
--
ALTER TABLE `revenues`
  MODIFY `revenue_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

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
-- Các ràng buộc cho bảng `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Các ràng buộc cho bảng `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`);

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

--
-- Các ràng buộc cho bảng `tour_guides`
--
ALTER TABLE `tour_guides`
  ADD CONSTRAINT `tour_guides_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`),
  ADD CONSTRAINT `tour_guides_ibfk_2` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`);

--
-- Các ràng buộc cho bảng `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
