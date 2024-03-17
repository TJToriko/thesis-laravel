-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 12:25 PM
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
-- Table structure for table `lot_classes`
--

CREATE TABLE `lot_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lot_class_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lot_classes`
--

INSERT INTO `lot_classes` (`id`, `lot_class_name`, `created_at`, `updated_at`) VALUES
(1, 'Deluxe', NULL, NULL),
(2, 'Premium', NULL, NULL),
(3, 'Super Premium', NULL, NULL),
(4, 'Standard - 4s', NULL, NULL),
(5, 'Deluxe - 4s', NULL, NULL),
(6, 'Premium - 4s', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lot_classes`
--
ALTER TABLE `lot_classes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lot_classes`
--
ALTER TABLE `lot_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
