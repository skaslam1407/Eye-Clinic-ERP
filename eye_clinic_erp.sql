-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2026 at 02:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eye_clinic_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('Pending','Approved','Cancelled') NOT NULL DEFAULT 'Pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-03-16', '12:00:00', 'Approved', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(2, 2, 2, '2026-03-16', '13:30:00', 'Pending', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(3, 3, 2, '2026-03-10', '11:30:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(4, 4, 2, '2026-03-09', '16:30:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(5, 5, 2, '2026-03-16', '12:30:00', 'Approved', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(6, 6, 2, '2026-03-23', '16:30:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(7, 7, 2, '2026-03-19', '12:00:00', 'Approved', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(8, 8, 2, '2026-03-24', '10:30:00', 'Pending', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(9, 9, 2, '2026-03-13', '10:00:00', 'Approved', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(10, 10, 2, '2026-03-16', '14:00:00', 'Approved', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(11, 11, 2, '2026-03-24', '12:00:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(12, 12, 2, '2026-03-12', '14:00:00', 'Pending', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(13, 13, 2, '2026-03-24', '10:30:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(14, 14, 2, '2026-03-29', '12:00:00', 'Pending', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(15, 15, 2, '2026-03-21', '11:30:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(16, 16, 2, '2026-03-21', '18:00:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(17, 17, 2, '2026-03-10', '09:00:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(18, 18, 2, '2026-03-19', '17:00:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(19, 19, 2, '2026-03-19', '16:30:00', 'Cancelled', 'Follow regular checkup.', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(20, 20, 2, '2026-03-17', '11:00:00', 'Pending', 'Follow regular checkup.', '2026-03-09 05:46:12', '2026-03-09 05:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-branding_settings', 'O:18:\"App\\Models\\Setting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:1;s:11:\"brand_color\";s:7:\"#110de7\";s:11:\"font_family\";s:7:\"Manrope\";s:9:\"logo_path\";s:53:\"branding/jo8EcrAxtGSR7kBZWShO1viEvrZzM0mxpv9ilWW9.jpg\";s:10:\"created_at\";s:19:\"2026-03-23 11:43:23\";s:10:\"updated_at\";s:19:\"2026-03-23 11:46:34\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:1;s:11:\"brand_color\";s:7:\"#110de7\";s:11:\"font_family\";s:7:\"Manrope\";s:9:\"logo_path\";s:53:\"branding/jo8EcrAxtGSR7kBZWShO1viEvrZzM0mxpv9ilWW9.jpg\";s:10:\"created_at\";s:19:\"2026-03-23 11:43:23\";s:10:\"updated_at\";s:19:\"2026-03-23 11:46:34\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:11:\"brand_color\";i:1;s:11:\"font_family\";i:2;s:9:\"logo_path\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 2089626395);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eyeglass_orders`
--

DROP TABLE IF EXISTS `eyeglass_orders`;
CREATE TABLE `eyeglass_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `eyeglass_type` varchar(255) NOT NULL,
  `lens_power` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_status` enum('Pending','Delivered') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eyeglass_orders`
--

INSERT INTO `eyeglass_orders` (`id`, `patient_id`, `eyeglass_type`, `lens_power`, `order_date`, `delivery_date`, `delivery_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Progressive', '-0.50', '2026-02-14', '2026-03-09', 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(2, 2, 'Single Vision', '-2.00', '2026-03-01', '2026-03-09', 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(3, 3, 'Blue Cut', '-1.25', '2026-02-19', '2026-03-09', 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(4, 4, 'Progressive', '-0.50', '2026-02-24', '2026-03-09', 'Pending', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(5, 5, 'Single Vision', '+0.75', '2026-03-06', '2026-03-09', 'Pending', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(6, 6, 'Progressive', '-1.25', '2026-03-02', NULL, 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(7, 7, 'Progressive', '-1.25', '2026-02-22', NULL, 'Pending', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(8, 8, 'Progressive', '-0.50', '2026-02-20', '2026-03-09', 'Pending', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(9, 9, 'Progressive', '+0.75', '2026-03-04', '2026-03-09', 'Pending', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(10, 10, 'Single Vision', '-2.00', '2026-02-24', '2026-03-09', 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(11, 11, 'Single Vision', '+0.75', '2026-03-04', '2026-03-09', 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(12, 12, 'Blue Cut', '-0.50', '2026-02-25', '2026-03-09', 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(13, 13, 'Single Vision', '+0.75', '2026-03-06', NULL, 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(14, 14, 'Progressive', '+0.75', '2026-02-27', NULL, 'Pending', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(15, 15, 'Single Vision', '-1.25', '2026-02-26', '2026-03-09', 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(16, 16, 'Blue Cut', '-2.00', '2026-03-08', NULL, 'Delivered', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(17, 17, 'Single Vision', '+0.75', '2026-03-05', '2026-03-09', 'Pending', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(18, 18, 'Single Vision', '-2.00', '2026-02-17', NULL, 'Delivered', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(19, 19, 'Progressive', '-2.00', '2026-03-05', NULL, 'Pending', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(20, 20, 'Single Vision', '-2.00', '2026-02-13', '2026-03-09', 'Pending', '2026-03-09 05:46:12', '2026-03-09 05:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `eye_checkups`
--

DROP TABLE IF EXISTS `eye_checkups`;
CREATE TABLE `eye_checkups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vision_test` varchar(255) DEFAULT NULL,
  `right_eye_vision` varchar(255) DEFAULT NULL,
  `left_eye_vision` varchar(255) DEFAULT NULL,
  `lens_power` varchar(255) DEFAULT NULL,
  `sph` varchar(255) DEFAULT NULL,
  `cyl` varchar(255) DEFAULT NULL,
  `axis` varchar(255) DEFAULT NULL,
  `eye_condition` enum('Cataract','Glaucoma','Dry Eye','Normal') NOT NULL DEFAULT 'Normal',
  `doctor_notes` text DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `recommended_glasses` varchar(255) DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eye_checkups`
--

INSERT INTO `eye_checkups` (`id`, `patient_id`, `doctor_id`, `vision_test`, `right_eye_vision`, `left_eye_vision`, `lens_power`, `sph`, `cyl`, `axis`, `eye_condition`, `doctor_notes`, `prescription`, `recommended_glasses`, `follow_up_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Dry Eye', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-23', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(2, 2, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Normal', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-03-26', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(3, 3, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Glaucoma', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-03-24', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(4, 4, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Dry Eye', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-03-24', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(5, 5, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Glaucoma', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-06', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(6, 6, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Normal', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-03', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(7, 7, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Cataract', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-03-31', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(8, 8, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Cataract', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-03-27', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(9, 9, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Normal', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-12', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(10, 10, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Glaucoma', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-11', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(11, 11, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Normal', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-02', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(12, 12, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Dry Eye', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-03', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(13, 13, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Glaucoma', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-07', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(14, 14, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Normal', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-03-26', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(15, 15, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Normal', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-02', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(16, 16, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Normal', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-15', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(17, 17, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Glaucoma', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-03-26', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(18, 18, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Cataract', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-03-24', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(19, 19, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Normal', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-02', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(20, 20, 2, 'Snellen', '6/6', '6/9', '-1.25', '-1.00', '-0.50', '90', 'Dry Eye', 'Monitor symptoms and follow-up.', 'Use drops twice daily.', 'Blue light filter lenses', '2026-04-22', '2026-03-09 05:46:12', '2026-03-09 05:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `eye_test_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `eyeglass_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `medicine_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Paid','Pending') NOT NULL DEFAULT 'Pending',
  `invoice_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `patient_id`, `doctor_id`, `eye_test_charges`, `eyeglass_charges`, `medicine_charges`, `total_amount`, `payment_status`, `invoice_date`, `created_at`, `updated_at`) VALUES
(1, 'INV-2026-00001', 1, 2, 472.00, 1972.00, 803.00, 3247.00, 'Paid', '2026-02-02', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(2, 'INV-2026-00002', 2, 2, 743.00, 2301.00, 883.00, 3927.00, 'Paid', '2026-01-25', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(3, 'INV-2026-00003', 3, 2, 558.00, 1866.00, 485.00, 2909.00, 'Pending', '2026-02-26', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(4, 'INV-2026-00004', 4, 2, 324.00, 1095.00, 570.00, 1989.00, 'Paid', '2026-01-31', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(5, 'INV-2026-00005', 5, 2, 747.00, 1644.00, 135.00, 2526.00, 'Pending', '2026-03-07', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(6, 'INV-2026-00006', 6, 2, 554.00, 2103.00, 602.00, 3259.00, 'Paid', '2026-03-04', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(7, 'INV-2026-00007', 7, 2, 653.00, 655.00, 878.00, 2186.00, 'Paid', '2026-02-01', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(8, 'INV-2026-00008', 8, 2, 527.00, 2397.00, 789.00, 3713.00, 'Pending', '2026-02-07', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(9, 'INV-2026-00009', 9, 2, 256.00, 1842.00, 620.00, 2718.00, 'Pending', '2026-02-08', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(10, 'INV-2026-00010', 10, 2, 467.00, 1380.00, 569.00, 2416.00, 'Paid', '2026-01-15', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(11, 'INV-2026-00011', 11, 2, 420.00, 1906.00, 431.00, 2757.00, 'Paid', '2026-01-14', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(12, 'INV-2026-00012', 12, 2, 563.00, 2455.00, 134.00, 3152.00, 'Paid', '2026-01-30', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(13, 'INV-2026-00013', 13, 2, 468.00, 1595.00, 574.00, 2637.00, 'Pending', '2026-02-26', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(14, 'INV-2026-00014', 14, 2, 742.00, 582.00, 409.00, 1733.00, 'Pending', '2026-01-26', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(15, 'INV-2026-00015', 15, 2, 256.00, 659.00, 692.00, 1607.00, 'Paid', '2026-01-08', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(16, 'INV-2026-00016', 16, 2, 594.00, 933.00, 705.00, 2232.00, 'Paid', '2026-01-22', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(17, 'INV-2026-00017', 17, 2, 788.00, 2119.00, 721.00, 3628.00, 'Pending', '2026-02-17', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(18, 'INV-2026-00018', 18, 2, 761.00, 1115.00, 148.00, 2024.00, 'Pending', '2026-03-05', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(19, 'INV-2026-00019', 19, 2, 479.00, 1912.00, 619.00, 3010.00, 'Pending', '2026-02-02', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(20, 'INV-2026-00020', 20, 2, 264.00, 1927.00, 595.00, 2786.00, 'Paid', '2026-02-14', '2026-03-09 05:46:12', '2026-03-09 05:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2026_03_09_091524_add_role_id_to_users_table', 1),
(4, '2026_03_09_091525_create_roles_table', 1),
(5, '2026_03_09_091526_create_patients_table', 1),
(6, '2026_03_09_091527_create_appointments_table', 1),
(7, '2026_03_09_091527_create_invoices_table', 1),
(8, '2026_03_09_091528_create_eyeglass_orders_table', 1),
(9, '2026_03_09_091529_create_eye_checkups_table', 1),
(10, '2026_03_09_091530_create_notification_logs_table', 1),
(11, '2026_03_09_093657_add_foreign_key_to_users_role_id', 1),
(12, '2026_03_23_000001_create_settings_table', 2),
(13, '2026_03_23_000002_create_password_reset_tokens_table', 3),
(14, '2026_03_23_000003_add_status_columns_to_notification_logs_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

DROP TABLE IF EXISTS `notification_logs`;
CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `channel` enum('SMS','WhatsApp','Push') NOT NULL,
  `type` enum('Eye Checkup Reminder','Appointment Reminder','Eye Camp Schedule') NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `error` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_logs`
--

INSERT INTO `notification_logs` (`id`, `patient_id`, `channel`, `type`, `recipient`, `message`, `sent_at`, `status`, `provider_id`, `error`, `created_at`, `updated_at`) VALUES
(5, 10, 'SMS', 'Eye Checkup Reminder', '9832623749', 'hhhhhhhhhhhhhhhhh', '2026-03-23 13:31:40', 'Sent', NULL, NULL, '2026-03-23 08:01:38', '2026-03-23 08:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('aslam.ali@codeclouds.in', '$2y$12$JELnjdz2Clrp8A2PzNthV.bRVUJcZTfJAz9jsiN1/pMdpmBQSIPeq', '2026-03-23 07:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `eye_problem` varchar(255) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_code`, `name`, `age`, `gender`, `phone`, `address`, `email`, `eye_problem`, `registration_date`, `created_at`, `updated_at`) VALUES
(1, 'PAT-00001', 'Patient 1', 41, 'Female', '9897981883', 'Address 1', 'patient1@mail.test', 'Blurred vision', '2025-12-16', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(2, 'PAT-00002', 'Patient 2', 55, 'Female', '9824311872', 'Address 2', 'patient2@mail.test', 'Routine checkup', '2025-12-07', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(3, 'PAT-00003', 'Patient 3', 21, 'Female', '9881820175', 'Address 3', 'patient3@mail.test', 'Headache', '2026-01-02', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(4, 'PAT-00004', 'Patient 4', 31, 'Other', '9875797290', 'Address 4', 'patient4@mail.test', 'Blurred vision', '2026-01-25', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(5, 'PAT-00005', 'Patient 5', 33, 'Male', '9873521525', 'Address 5', 'patient5@mail.test', 'Headache', '2026-01-17', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(6, 'PAT-00006', 'Patient 6', 70, 'Female', '9846555300', 'Address 6', 'patient6@mail.test', 'Headache', '2026-02-18', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(7, 'PAT-00007', 'Patient 7', 38, 'Other', '9813611725', 'Address 7', 'patient7@mail.test', 'Routine checkup', '2025-12-27', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(8, 'PAT-00008', 'Patient 8', 24, 'Male', '9827755042', 'Address 8', 'patient8@mail.test', 'Blurred vision', '2026-01-07', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(9, 'PAT-00009', 'Patient 9', 36, 'Male', '9866777245', 'Address 9', 'patient9@mail.test', 'Headache', '2025-12-13', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(10, 'PAT-00010', 'Patient 10', 33, 'Male', '9833144554', 'Address 10', 'patient10@mail.test', 'Headache', '2025-12-28', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(11, 'PAT-00011', 'Patient 11', 34, 'Female', '9871258265', 'Address 11', 'patient11@mail.test', 'Dry eye', '2025-12-20', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(12, 'PAT-00012', 'Patient 12', 29, 'Other', '9890448263', 'Address 12', 'patient12@mail.test', 'Dry eye', '2025-11-28', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(13, 'PAT-00013', 'Patient 13', 35, 'Male', '9890162132', 'Address 13', 'patient13@mail.test', 'Dry eye', '2026-01-03', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(14, 'PAT-00014', 'Patient 14', 66, 'Male', '9840743931', 'Address 14', 'patient14@mail.test', 'Headache', '2025-11-23', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(15, 'PAT-00015', 'Patient 15', 66, 'Other', '9819271073', 'Address 15', 'patient15@mail.test', 'Routine checkup', '2025-11-23', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(16, 'PAT-00016', 'Patient 16', 57, 'Other', '9812134847', 'Address 16', 'patient16@mail.test', 'Headache', '2026-02-11', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(17, 'PAT-00017', 'Patient 17', 23, 'Female', '9876773641', 'Address 17', 'patient17@mail.test', 'Headache', '2026-03-07', '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(18, 'PAT-00018', 'Patient 18', 38, 'Female', '9824757000', 'Address 18', 'patient18@mail.test', 'Routine checkup', '2025-12-23', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(19, 'PAT-00019', 'Patient 19', 34, 'Other', '9824891570', 'Address 19', 'patient19@mail.test', 'Headache', '2025-12-20', '2026-03-09 05:46:12', '2026-03-09 05:46:12'),
(20, 'PAT-00020', 'Patient 20', 61, 'Male', '9888339591', 'Address 20', 'patient20@mail.test', 'Headache', '2025-12-25', '2026-03-09 05:46:12', '2026-03-09 05:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '[\"*\"]', '2026-03-09 05:46:09', '2026-03-09 05:46:09'),
(2, 'Admin', '[\"dashboard\",\"patients\",\"appointments\",\"invoices\",\"reports\",\"users\",\"notifications\"]', '2026-03-09 05:46:09', '2026-03-23 07:03:49'),
(3, 'Doctor', '[\"patients\",\"appointments\",\"checkups\"]', '2026-03-09 05:46:09', '2026-03-09 05:46:09'),
(4, 'Staff', '[\"patients\",\"invoices\",\"eyeglass-orders\"]', '2026-03-09 05:46:09', '2026-03-23 07:13:53'),
(5, 'Receptionist', '[\"patients\",\"appointments\"]', '2026-03-09 05:46:09', '2026-03-09 05:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_color` varchar(255) DEFAULT NULL,
  `font_family` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `brand_color`, `font_family`, `logo_path`, `created_at`, `updated_at`) VALUES
(1, '#110de7', 'Manrope', 'branding/jo8EcrAxtGSR7kBZWShO1viEvrZzM0mxpv9ilWW9.jpg', '2026-03-23 06:13:23', '2026-03-23 06:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'admin@eyeclinic.test', NULL, '$2y$12$zunooSYWMwX2ZeHUU6O5XecLYIos/I.1GJpd0FM.Va/hWYUGFmysu', '9999999999', NULL, '2026-03-09 05:46:10', '2026-03-09 05:46:10'),
(2, 3, 'Dr. Rahul Sen', 'doctor@eyeclinic.test', NULL, '$2y$12$SuSVj0ATbTApWblekhKPMeqh2Bcwl0lCD8ArDOdjgyaTngGc0jLAG', '8888888888', NULL, '2026-03-09 05:46:10', '2026-03-09 05:46:10'),
(3, 5, 'Reception User', 'reception@eyeclinic.test', NULL, '$2y$12$jA6xRUqXHdC9NopoHMFUdeIgtGBORP93KYYkJOdb6EuM8TVvoGlye', '7777777777', NULL, '2026-03-09 05:46:11', '2026-03-09 05:46:11'),
(4, 4, 'Sekh Aslam Ali', 'aslam.ali@codeclouds.in', NULL, '$2y$12$KvMDEt8HinZ4QyWQ/lM2xuUOS0crLN0NhuRGiagQDvxXDbulF0DHq', '9832623749', NULL, '2026-03-23 06:45:06', '2026-03-23 07:21:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `eyeglass_orders`
--
ALTER TABLE `eyeglass_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eyeglass_orders_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `eye_checkups`
--
ALTER TABLE `eye_checkups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eye_checkups_patient_id_foreign` (`patient_id`),
  ADD KEY `eye_checkups_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_patient_id_foreign` (`patient_id`),
  ADD KEY `invoices_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_logs_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_patient_code_unique` (`patient_code`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `eyeglass_orders`
--
ALTER TABLE `eyeglass_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `eye_checkups`
--
ALTER TABLE `eye_checkups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eyeglass_orders`
--
ALTER TABLE `eyeglass_orders`
  ADD CONSTRAINT `eyeglass_orders_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eye_checkups`
--
ALTER TABLE `eye_checkups`
  ADD CONSTRAINT `eye_checkups_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `eye_checkups_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `invoices_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD CONSTRAINT `notification_logs_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
