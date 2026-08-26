-- --------------------------------------------------------
-- SQL Database Dump untuk InfinityFree (phpMyAdmin)
-- Project: RentalMobilku
-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";

-- --------------------------------------------------------
-- Tabel: users
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `ktp_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_license` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_ktp_unique` (`ktp_number`),
  UNIQUE KEY `users_license_unique` (`driver_license`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data Awal Akun Admin Utama
-- Password default: password123 (Silakan ganti di Admin Panel setelah login)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `avatar`, `role`, `ktp_number`, `driver_license`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'doomspire008@gmail.com', NOW(), '$2y$12$41kZ/51bYx8qgA9wFkC8yOGh69Z7Mh/KxQk8P95e7P8LpG.7iP8l2', '081299779053', 'Jl. Seteran Tengah No. 9, Semarang', NULL, 'admin', NULL, NULL, NULL, NOW(), NOW()),
(2, 'Pelanggan Demo', 'pelanggan@example.com', NOW(), '$2y$12$41kZ/51bYx8qgA9wFkC8yOGh69Z7Mh/KxQk8P95e7P8LpG.7iP8l2', '081234567890', 'Jakarta Selatan', NULL, 'customer', '3171012345678901', 'D1234567890', NULL, NOW(), NOW())
ON DUPLICATE KEY UPDATE `email`=`email`;

-- --------------------------------------------------------
-- Tabel: categories
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sedan', 'sedan', 'car', 'Sedan elegan dan nyaman untuk perjalanan bisnis dan harian', NOW(), NOW()),
(2, 'SUV', 'suv', 'truck', 'Sport Utility Vehicle tangguh untuk berbagai medan dan wisata', NOW(), NOW()),
(3, 'MPV', 'mpv', 'users', 'Multi Purpose Vehicle berkapasitas besar untuk keluarga', NOW(), NOW()),
(4, 'Hatchback', 'hatchback', 'car', 'Mobil lincah dan hemat bahan bakar untuk mobilitas perkotaan', NOW(), NOW()),
(5, 'Luxury', 'luxury', 'crown', 'Mobil mewah premium untuk acara formal, VIP, dan pernikahan', NOW(), NOW()),
(6, 'Electric', 'electric', 'bolt', 'Mobil listrik ramah lingkungan berteknologi tinggi dan canggih', NOW(), NOW())
ON DUPLICATE KEY UPDATE `slug`=`slug`;

-- --------------------------------------------------------
-- Tabel: cars
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cars` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `plate_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_per_day` decimal(12,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_images` json DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `seats` int(11) NOT NULL DEFAULT 5,
  `transmission` enum('automatic','manual') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'automatic',
  `fuel_type` enum('bensin','diesel','electric','hybrid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bensin',
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `stock` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cars_plate_number_unique` (`plate_number`),
  KEY `cars_category_id_foreign` (`category_id`),
  CONSTRAINT `cars_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cars` (`id`, `category_id`, `name`, `brand`, `model`, `year`, `plate_number`, `price_per_day`, `description`, `image`, `status`, `seats`, `transmission`, `fuel_type`, `is_available`, `stock`, `created_at`, `updated_at`) VALUES
(1, 3, 'Toyota Avanza 1.5 G', 'Toyota', 'Avanza Facelift', 2024, 'B 1420 SSK', 450000.00, 'MPV keluarga terfavorit di Indonesia. Nyaman, kabin lega untuk 7 penumpang, hemat BBM, dan dilengkapi fitur keselamatan Toyota Safety Sense.', 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800&auto=format&fit=crop&q=80', 'available', 7, 'automatic', 'bensin', 1, 5, NOW(), NOW()),
(2, 2, 'Toyota Fortuner 2.8 GR Sport', 'Toyota', 'Fortuner 4x2', 2024, 'B 8899 LUX', 1250000.00, 'High SUV berkarakter gagah dan tangguh dengan mesin diesel 2.800cc turbo bertenaga. Sangat ideal untuk perjalanan dinas, wisata luar kota, maupun acara formal.', 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800&auto=format&fit=crop&q=80', 'available', 7, 'automatic', 'diesel', 1, 3, NOW(), NOW()),
(3, 3, 'Toyota Innova Zenix 2.0 V CVT', 'Toyota', 'Innova Zenix', 2024, 'B 2341 ZNX', 850000.00, 'MPV mewah generasi terbaru dengan platform TNGA yang sangat senyap dan stabil. Dilengkapi panoramic sunroof, layar hiburan kabin belakang, dan captain seat.', 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800&auto=format&fit=crop&q=80', 'available', 7, 'automatic', 'bensin', 1, 4, NOW(), NOW()),
(4, 2, 'Mitsubishi Pajero Sport Dakar 4x2', 'Mitsubishi', 'Pajero Sport', 2023, 'B 9901 PJR', 1200000.00, 'SUV petualang premium dengan transmisi 8-speed AT responsif, suspensi kokoh, dan fitur active safety lengkap untuk kenyamanan perjalanan jauh.', 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&auto=format&fit=crop&q=80', 'available', 7, 'automatic', 'diesel', 1, 2, NOW(), NOW()),
(5, 5, 'BMW 530i M Sport', 'BMW', '5 Series Sedan', 2024, 'B 1 VIP', 3500000.00, 'Executive luxury sedan kelas atas. Interior berbalut kulit Nappa eksklusif, Harman Kardon surround audio, dan handling sempurna untuk acara istimewa & VIP escort.', 'https://images.unsplash.com/photo-1555353540-64580b51c258?w=800&auto=format&fit=crop&q=80', 'available', 5, 'automatic', 'bensin', 1, 1, NOW(), NOW()),
(6, 6, 'Hyundai Ioniq 5 Signature Long Range', 'Hyundai', 'Ioniq 5', 2024, 'B 7788 ION', 1500000.00, 'Mobil listrik murni berdesain futuristik dengan jarak tempuh hingga 451 km dalam sekali pengisian. Hening, ramah lingkungan, dan teknologi Vehicle-to-Load (V2L).', 'https://images.unsplash.com/photo-1563720223185-11003d516935?w=800&auto=format&fit=crop&q=80', 'available', 5, 'automatic', 'electric', 1, 2, NOW(), NOW())
ON DUPLICATE KEY UPDATE `plate_number`=`plate_number`;

-- --------------------------------------------------------
-- Tabel: bookings
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `booking_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_days` int(11) NOT NULL DEFAULT 1,
  `total_price` decimal(12,2) NOT NULL,
  `status` enum('pending','confirmed','active','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `driver_option` enum('with_driver','self_drive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'self_drive',
  `pickup_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_code_unique` (`booking_code`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_car_id_foreign` (`car_id`),
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: payments
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_proof` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `payments_booking_id_foreign` (`booking_id`),
  CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: reviews
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_car_id_foreign` (`car_id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: sessions & cache (Pelengkap Laravel)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;
