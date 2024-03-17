-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 10:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lot_type_id` bigint(20) UNSIGNED NOT NULL,
  `lot_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_name` varchar(255) NOT NULL,
  `payment_type` enum('Cash','Installment') NOT NULL,
  `cash_full_price` decimal(10,2) DEFAULT NULL,
  `installment_full_price` decimal(10,2) DEFAULT NULL,
  `no_year` int(11) DEFAULT NULL,
  `installment_monthly_price` decimal(10,2) DEFAULT NULL,
  `with_rebate` varchar(255) DEFAULT NULL,
  `rebate_price` decimal(10,2) DEFAULT NULL,
  `interest_price` decimal(10,2) DEFAULT NULL,
  `min_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `lot_type_id`, `lot_class_id`, `payment_name`, `payment_type`, `cash_full_price`, `installment_full_price`, `no_year`, `installment_monthly_price`, `with_rebate`, `rebate_price`, `interest_price`, `min_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Spotcash', 'Cash', '63700.00', NULL, 1, NULL, 'yes', NULL, NULL, NULL, '2023-11-03 01:00:27', '2023-11-03 01:00:27'),
(2, 1, 1, '1 Year Term', 'Installment', NULL, '70200.00', 1, '5850.00', 'yes', '225.00', NULL, '5000.00', '2023-11-03 01:01:06', '2023-11-03 01:01:06'),
(3, 1, 1, '3 Years Term', 'Installment', NULL, '77000.00', 3, '2138.89', 'yes', '85.00', NULL, '4000.00', '2023-11-03 01:01:55', '2023-11-03 01:01:55'),
(4, 1, 2, 'Spotcash', 'Cash', '67600.00', NULL, 1, NULL, 'yes', NULL, NULL, NULL, '2023-11-03 01:02:13', '2023-11-03 01:02:13'),
(5, 1, 2, '1 Year Term', 'Installment', NULL, '74880.00', 1, '6240.00', 'yes', '240.00', NULL, '5000.00', '2023-11-03 01:02:49', '2023-11-03 01:02:49'),
(6, 1, 2, '3 Years Term', 'Installment', NULL, '82368.00', 3, '2288.00', 'yes', '90.00', NULL, '5000.00', '2023-11-03 01:06:30', '2023-11-03 01:06:30'),
(7, 1, 3, 'Spotcash', 'Cash', '72800.00', NULL, 1, NULL, 'yes', NULL, NULL, NULL, '2023-11-03 01:08:20', '2023-11-03 01:08:20'),
(8, 1, 3, '1 Year Term', 'Installment', NULL, '81000.00', 1, '6750.00', 'yes', '284.00', NULL, '5000.00', '2023-11-03 01:08:50', '2023-11-03 01:08:50'),
(9, 1, 3, '3 Years Term', 'Installment', NULL, '87920.00', 3, '2442.22', 'yes', '98.00', NULL, '5000.00', '2023-11-03 01:09:30', '2023-11-03 01:09:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_settings_lot_type_id_foreign` (`lot_type_id`),
  ADD KEY `payment_settings_lot_class_id_foreign` (`lot_class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD CONSTRAINT `payment_settings_lot_class_id_foreign` FOREIGN KEY (`lot_class_id`) REFERENCES `lot_classes` (`id`),
  ADD CONSTRAINT `payment_settings_lot_type_id_foreign` FOREIGN KEY (`lot_type_id`) REFERENCES `lot_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
