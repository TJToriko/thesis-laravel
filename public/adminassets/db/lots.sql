-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 04:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `lots`
--

CREATE TABLE `lots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section` varchar(255) NOT NULL,
  `lot_no` varchar(255) NOT NULL,
  `lot_type_id` bigint(20) UNSIGNED NOT NULL,
  `lot_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lot_status` enum('Intered','Available','Reserved','Unavailable') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`id`, `section`, `lot_no`, `lot_type_id`, `lot_class_id`, `customer_id`, `lot_status`, `created_at`, `updated_at`) VALUES
(1, 'A', 'A1', 1, 1, NULL, 'Available', NULL, NULL),
(2, 'A', 'A2', 1, 2, NULL, 'Available', NULL, NULL),
(3, 'A', 'A3', 1, 3, NULL, 'Available', NULL, NULL),
(4, 'B', 'B1', 2, 4, NULL, 'Available', NULL, NULL),
(5, 'B', 'B2', 2, 5, NULL, 'Available', NULL, NULL),
(6, 'B', 'B3', 2, 6, NULL, 'Available', NULL, NULL),
(7, 'C', 'C1', 3, NULL, NULL, 'Available', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lots_lot_type_id_foreign` (`lot_type_id`),
  ADD KEY `lots_lot_class_id_foreign` (`lot_class_id`),
  ADD KEY `lots_owner_id_foreign` (`owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lots`
--
ALTER TABLE `lots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lots`
--
ALTER TABLE `lots`
  ADD CONSTRAINT `lots_lot_class_id_foreign` FOREIGN KEY (`lot_class_id`) REFERENCES `lot_classes` (`id`),
  ADD CONSTRAINT `lots_lot_type_id_foreign` FOREIGN KEY (`lot_type_id`) REFERENCES `lot_types` (`id`),
  ADD CONSTRAINT `lots_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
