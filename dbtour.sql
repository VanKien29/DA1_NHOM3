-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 07, 2025 lúc 05:26 AM
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `checkins`
--

CREATE TABLE `checkins` (
  `checkin_id` int NOT NULL,
  `guide_id` int DEFAULT NULL,
  `tour_id` int DEFAULT NULL,
  `checkin_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ;

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','hdv') DEFAULT 'hdv',
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int NOT NULL,
  `plate_number` varchar(20) DEFAULT NULL,
  `supplier_id` int DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `capacity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Chỉ mục cho bảng `checkins`
--
ALTER TABLE `checkins`
  ADD PRIMARY KEY (`checkin_id`),
  ADD KEY `guide_id` (`guide_id`),
  ADD KEY `tour_id` (`tour_id`);

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
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `checkins`
--
ALTER TABLE `checkins`
  MODIFY `checkin_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `guides`
--
ALTER TABLE `guides`
  MODIFY `guide_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int NOT NULL AUTO_INCREMENT;

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
-- Các ràng buộc cho bảng `checkins`
--
ALTER TABLE `checkins`
  ADD CONSTRAINT `checkins_ibfk_1` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`guide_id`),
  ADD CONSTRAINT `checkins_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`);

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
