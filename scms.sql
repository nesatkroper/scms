-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2025 at 03:30 PM
-- Server version: 8.0.43-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','late','excused') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `room_number`, `capacity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Classroom A', 'A-101', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(2, 'Classroom A', 'A-102', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(3, 'Classroom A', 'A-103', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(4, 'Classroom A', 'A-104', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(5, 'Classroom A', 'A-105', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(6, 'Classroom B', 'B-101', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(7, 'Classroom B', 'B-102', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(8, 'Classroom B', 'B-103', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(9, 'Classroom B', 'B-104', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(10, 'Classroom B', 'B-105', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(11, 'Classroom C', 'C-101', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(12, 'Classroom C', 'C-102', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(13, 'Classroom C', 'C-103', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(14, 'Classroom C', 'C-104', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(15, 'Classroom C', 'C-105', 30, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administration', 'Oversees the daily operations and management of the school.', '2025-11-16 08:29:25', '2025-11-16 08:29:25', NULL),
(2, 'Human Resources', 'Manages all personnel-related functions, including hiring and staff support.', '2025-11-16 08:29:25', '2025-11-16 08:29:25', NULL),
(3, 'Finance', 'Responsible for the school\'s budget, financial planning, and accounting.', '2025-11-16 08:29:25', '2025-11-16 08:29:25', NULL),
(4, 'Maintenance', 'Handles the upkeep and repair of all school facilities and grounds.', '2025-11-16 08:29:25', '2025-11-16 08:29:25', NULL),
(5, 'Student Services', 'Provides support for student well-being, including counseling and extracurricular activities.', '2025-11-16 08:29:25', '2025-11-16 08:29:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `subject_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `total_marks` int NOT NULL,
  `passing_marks` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `marks_obtained` decimal(5,2) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '1_create_tb', 1),
(2, '4_create_personal_access_tokens_table', 1),
(3, '5_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 32),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 34),
(3, 'App\\Models\\User', 35),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 40),
(3, 'App\\Models\\User', 41),
(3, 'App\\Models\\User', 42),
(3, 'App\\Models\\User', 43),
(3, 'App\\Models\\User', 44),
(3, 'App\\Models\\User', 45),
(3, 'App\\Models\\User', 46),
(3, 'App\\Models\\User', 47),
(3, 'App\\Models\\User', 48),
(3, 'App\\Models\\User', 49),
(3, 'App\\Models\\User', 50),
(3, 'App\\Models\\User', 51),
(3, 'App\\Models\\User', 52),
(3, 'App\\Models\\User', 53),
(3, 'App\\Models\\User', 54),
(3, 'App\\Models\\User', 55),
(3, 'App\\Models\\User', 56),
(3, 'App\\Models\\User', 57),
(3, 'App\\Models\\User', 58),
(3, 'App\\Models\\User', 59),
(3, 'App\\Models\\User', 60),
(3, 'App\\Models\\User', 61),
(3, 'App\\Models\\User', 62),
(3, 'App\\Models\\User', 63),
(3, 'App\\Models\\User', 64),
(3, 'App\\Models\\User', 65),
(3, 'App\\Models\\User', 66),
(3, 'App\\Models\\User', 67),
(3, 'App\\Models\\User', 68),
(3, 'App\\Models\\User', 69),
(3, 'App\\Models\\User', 70),
(3, 'App\\Models\\User', 71),
(3, 'App\\Models\\User', 72),
(3, 'App\\Models\\User', 73),
(3, 'App\\Models\\User', 74),
(3, 'App\\Models\\User', 75),
(3, 'App\\Models\\User', 76),
(3, 'App\\Models\\User', 77),
(3, 'App\\Models\\User', 78),
(3, 'App\\Models\\User', 79),
(3, 'App\\Models\\User', 80),
(3, 'App\\Models\\User', 81),
(3, 'App\\Models\\User', 82),
(3, 'App\\Models\\User', 83),
(3, 'App\\Models\\User', 84),
(3, 'App\\Models\\User', 85),
(3, 'App\\Models\\User', 86),
(3, 'App\\Models\\User', 87),
(3, 'App\\Models\\User', 88),
(3, 'App\\Models\\User', 89),
(3, 'App\\Models\\User', 90),
(3, 'App\\Models\\User', 91),
(3, 'App\\Models\\User', 92),
(3, 'App\\Models\\User', 93),
(3, 'App\\Models\\User', 94),
(3, 'App\\Models\\User', 95),
(3, 'App\\Models\\User', 96),
(3, 'App\\Models\\User', 97),
(3, 'App\\Models\\User', 98),
(3, 'App\\Models\\User', 99),
(3, 'App\\Models\\User', 100),
(3, 'App\\Models\\User', 101),
(3, 'App\\Models\\User', 102),
(3, 'App\\Models\\User', 103),
(3, 'App\\Models\\User', 104),
(3, 'App\\Models\\User', 105),
(1, 'App\\Models\\User', 106);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `received_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-11-16 08:29:25', '2025-11-16 08:29:25'),
(2, 'teacher', 'web', '2025-11-16 08:29:25', '2025-11-16 08:29:25'),
(3, 'student', 'web', '2025-11-16 08:29:25', '2025-11-16 08:29:25'),
(4, 'guardian', 'web', '2025-11-16 08:29:25', '2025-11-16 08:29:25'),
(5, 'staff', 'web', '2025-11-16 08:29:25', '2025-11-16 08:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` bigint UNSIGNED NOT NULL,
  `grade_final` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `grade_final`, `created_at`, `updated_at`) VALUES
(77, 69.61, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(22, 66.29, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(57, 96.09, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(58, 91.82, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(30, 61.00, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(101, 69.87, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(31, 87.46, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(12, 90.02, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(25, 78.31, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(63, 80.21, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(72, 64.23, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(93, 69.28, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(91, 85.38, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(90, 74.18, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(94, 83.43, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(7, 70.77, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(41, 69.84, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(59, 74.74, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(34, 66.17, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(64, 92.87, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(52, 65.18, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(89, 80.64, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(24, 93.53, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(18, 65.05, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(79, 84.50, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(26, 86.92, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(97, 94.45, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(68, 92.48, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(69, 68.63, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(29, 81.70, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(10, 83.42, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(75, 63.59, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(28, 88.26, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(102, 69.31, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(46, 65.31, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(27, 85.11, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(35, 71.84, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(104, 78.17, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(61, 85.80, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(33, 69.24, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(71, 70.01, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(47, 71.16, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(32, 89.28, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(105, 95.75, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(37, 60.59, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(19, 63.29, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(21, 71.59, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(73, 90.01, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(98, 83.69, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(85, 79.80, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(60, 78.56, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(39, 86.32, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(84, 98.88, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(80, 74.29, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(78, 60.95, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(48, 88.83, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(88, 68.06, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(50, 85.28, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(87, 69.57, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(9, 94.69, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(40, 69.91, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(99, 60.84, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(65, 71.12, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(100, 71.12, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(49, 77.47, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(36, 68.83, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(56, 63.12, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(76, 65.77, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(74, 98.48, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(14, 92.67, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(38, 83.04, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(11, 75.27, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(23, 77.40, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(66, 94.04, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(62, 92.85, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(67, 83.89, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(17, 85.10, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(95, 63.93, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(20, 61.61, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(51, 98.18, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(96, 76.44, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(70, 69.97, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(44, 67.24, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(6, 86.94, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(8, 61.62, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(43, 82.56, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(82, 90.45, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(16, 82.24, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(81, 85.63, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(53, 97.32, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(83, 95.41, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(55, 94.29, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(54, 62.68, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(13, 69.26, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(42, 67.61, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(86, 69.15, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(103, 78.35, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(92, 68.03, '2025-11-16 08:29:51', '2025-11-16 08:29:51'),
(15, 95.05, '2025-11-16 08:29:51', '2025-11-16 08:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `credit_hours` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `department_id`, `code`, `description`, `credit_hours`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Introduction to Programming', NULL, 'CS101', 'A foundational course on the principles of computer programming.', 3, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(2, 'Data Structures', NULL, 'CS202', 'An in-depth study of data organization and management.', 4, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(3, 'British Literature', NULL, 'ENGL250', 'A survey of key literary works from Great Britain.', 3, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(4, 'Creative Writing', NULL, 'ENGL301', 'Focuses on developing skills in various forms of creative writing.', 3, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL),
(5, 'Calculus I', NULL, 'MATH150', 'The first course in differential and integral calculus.', 4, '2025-11-16 08:29:51', '2025-11-16 08:29:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci DEFAULT 'male',
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` text COLLATE utf8mb4_unicode_ci,
  `salary` decimal(10,2) DEFAULT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `date_of_birth`, `gender`, `department_id`, `joining_date`, `qualification`, `experience`, `specialization`, `salary`, `cv`, `blood_group`, `nationality`, `religion`, `admission_date`, `occupation`, `company`, `avatar`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jaeden Bogisich', 'teacher0@example.com', '2025-11-16 08:29:25', '$2y$12$kT/KYqUExIG5isBENuYxxuHpg5wJdfvBemP5L6kMGdQlN3hrFDsFO', '+1-316-513-3628', '9282 Schultz Hill Suite 555\nLake Carmel, MT 27879-1903', '1977-05-20', 'male', 5, '1971-09-26', 'Bachelor', '5 years', 'Mathematics', 42906.08, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-16 08:29:26', '2025-11-16 08:29:26', NULL),
(2, 'River O\'Kon MD', 'teacher1@example.com', '2025-11-16 08:29:26', '$2y$12$xz/DZgZCDWrVJIXZqd6sieqVwhrYm/rW0jHnMWRjPI7Sv3MCLhZ2.', '+1-816-960-8369', '3299 Eulalia Alley Apt. 819\nO\'Reillychester, MS 58235', '2024-10-08', 'female', 2, '1993-11-26', 'Master', '10 years', 'Mathematics', 46605.48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-16 08:29:26', '2025-11-16 08:29:26', NULL),
(3, 'Domenick Beatty DDS', 'teacher2@example.com', '2025-11-16 08:29:26', '$2y$12$9kWLza0G06/tAnIfVK0r5eBdE1cRQCFzbjTm/1ZJwZ7zlKJLZ8Qbi', '401.956.0455', '68658 Luis Parks Suite 236\nMillsside, GA 67306-7664', '2009-12-19', 'male', 3, '1986-08-09', 'PhD', '5 years', 'Science', 73863.29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-16 08:29:26', '2025-11-16 08:29:26', NULL),
(4, 'Rubie Schowalter', 'teacher3@example.com', '2025-11-16 08:29:26', '$2y$12$47IAwPOcEVcj36rx60AeKufBTkBOY7TBTuRulmWBd.Pyd7/pOlRqy', '850-496-3925', '242 Farrell Village Suite 271\nNew Maidaborough, NV 33117-7802', '2007-08-24', 'female', 3, '2005-08-23', 'Bachelor', '10 years', 'Mathematics', 62704.72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-16 08:29:26', '2025-11-16 08:29:26', NULL),
(5, 'Prof. Branson Wolf', 'teacher4@example.com', '2025-11-16 08:29:26', '$2y$12$aqDql97xWseAmYY6duw90uUbg4x/aSDINOZEIKQw2DWJ6YJipYcHu', '+1.646.743.8834', '3142 Samantha Ridge Apt. 703\nLake Era, AL 96018-1926', '1970-10-07', 'male', 1, '2021-02-24', 'Master', '10 years', 'Mathematics', 42778.23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-16 08:29:27', '2025-11-16 08:29:27', NULL),
(6, 'Mireille Huels', 'student0@example.com', '2025-11-16 08:29:27', '$2y$12$sp/lBhpheA1q7cM0MWBsPO.0SIy0Y8D28Zl3aM1E/Qt2jNSNzkvLO', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Kiribati', 'Christianity', '2004-11-27', NULL, NULL, NULL, NULL, '2025-11-16 08:29:27', '2025-11-16 08:29:27', NULL),
(7, 'Nola Runolfsson', 'student1@example.com', '2025-11-16 08:29:27', '$2y$12$8xUJYIfl4c6M39iskY90t.SKPCLXbzWz1t3HFDGd2JeTp2i5CJZB2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'South Georgia and the South Sandwich Islands', 'Hinduism', '2002-12-21', NULL, NULL, NULL, NULL, '2025-11-16 08:29:27', '2025-11-16 08:29:27', NULL),
(8, 'Prof. Wilbert Pollich', 'student2@example.com', '2025-11-16 08:29:27', '$2y$12$ReW3RrJ3kYkVASy71Lcfwuu4bbn8WAWXglkyvOwOHTZsfiIEOL.I2', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Guatemala', 'Hinduism', '1992-05-26', NULL, NULL, NULL, NULL, '2025-11-16 08:29:27', '2025-11-16 08:29:27', NULL),
(9, 'Harrison Feeney MD', 'student3@example.com', '2025-11-16 08:29:27', '$2y$12$pFDR3ySrpxN3gWJ7oozyQuLWh1jiAl7H87x/qMcLTo/GVVBpA6aFe', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Cambodia', 'Christianity', '2002-05-04', NULL, NULL, NULL, NULL, '2025-11-16 08:29:28', '2025-11-16 08:29:28', NULL),
(10, 'Dr. Robb Dietrich', 'student4@example.com', '2025-11-16 08:29:28', '$2y$12$l.NTeEIgAZH8ASPlnkUdNeX1U7zQxG0ON4/fbDrbJLFipcQBbF8VG', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Vanuatu', 'Islam', '2023-11-26', NULL, NULL, NULL, NULL, '2025-11-16 08:29:28', '2025-11-16 08:29:28', NULL),
(11, 'Prof. Florida Weissnat', 'student5@example.com', '2025-11-16 08:29:28', '$2y$12$mx9y2Hol//hbvVwT6cfkbOPA6zrm0MkJXITSnG4RZbOEGpGtOADtq', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Luxembourg', 'Buddhism', '1971-05-28', NULL, NULL, NULL, NULL, '2025-11-16 08:29:28', '2025-11-16 08:29:28', NULL),
(12, 'Miss Jacky Robel', 'student6@example.com', '2025-11-16 08:29:28', '$2y$12$K5UTQmsKvaShCNKhh4qQre7BTZuqHF/egq82lt6ueb6U.xWs3hKEu', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Rwanda', 'Islam', '1997-03-04', NULL, NULL, NULL, NULL, '2025-11-16 08:29:28', '2025-11-16 08:29:28', NULL),
(13, 'Jacinthe Watsica', 'student7@example.com', '2025-11-16 08:29:28', '$2y$12$HP/fzaSIEaVzP4s/StrL4eI7mzup0AIAmA5bN3YaivCjDAwvhQoBW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Senegal', 'Christianity', '2023-02-21', NULL, NULL, NULL, NULL, '2025-11-16 08:29:28', '2025-11-16 08:29:28', NULL),
(14, 'Burley Gleichner', 'student8@example.com', '2025-11-16 08:29:28', '$2y$12$z8V.vqhBlQLTcZO.ib.gxO/pJz/7By5lmO2A70b.9NH1JuO5EGSmS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Austria', 'Christianity', '1995-01-23', NULL, NULL, NULL, NULL, '2025-11-16 08:29:29', '2025-11-16 08:29:29', NULL),
(15, 'Prof. Darien Vandervort', 'student9@example.com', '2025-11-16 08:29:29', '$2y$12$xS0WBFYQ9GRUuh0JF8Rc5uAnhzuRykzO155Q/RFB8kzH7gOf3NvoO', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Oman', 'Islam', '1976-05-06', NULL, NULL, NULL, NULL, '2025-11-16 08:29:29', '2025-11-16 08:29:29', NULL),
(16, 'Kaci Dietrich', 'student10@example.com', '2025-11-16 08:29:29', '$2y$12$KB1g4wdRWcXrmYD.HbeR.OOlDst9PJCS7uxdP0et4/2FeJBgt9M8e', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Maldives', 'Islam', '1979-02-28', NULL, NULL, NULL, NULL, '2025-11-16 08:29:29', '2025-11-16 08:29:29', NULL),
(17, 'Mr. Berta Kohler PhD', 'student11@example.com', '2025-11-16 08:29:29', '$2y$12$znFs1ge1D/etIxcBSfdz0e7PK8vViyd9xHYlZ/9lzh4Gfmqkrv/FC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Thailand', 'Islam', '2024-08-05', NULL, NULL, NULL, NULL, '2025-11-16 08:29:29', '2025-11-16 08:29:29', NULL),
(18, 'Dr. Elliott Bednar', 'student12@example.com', '2025-11-16 08:29:29', '$2y$12$Pjfehr.4XWkZR0IGzcggweWiS6C1npU0CxhVTF5OGU85Zv/VgoUJu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'France', 'Buddhism', '1987-04-29', NULL, NULL, NULL, NULL, '2025-11-16 08:29:30', '2025-11-16 08:29:30', NULL),
(19, 'Peggie Murazik', 'student13@example.com', '2025-11-16 08:29:30', '$2y$12$/eWal7e1FISVm1qqUPWi3udPTu89X6y5zuZeb2090SzN2YtGsjj5C', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Mongolia', 'Christianity', '1996-02-13', NULL, NULL, NULL, NULL, '2025-11-16 08:29:30', '2025-11-16 08:29:30', NULL),
(20, 'Dewitt Lakin', 'student14@example.com', '2025-11-16 08:29:30', '$2y$12$jA/I5DFA7hSOVYqfWOw76.rWMCFf2aYMPShhdOFZYF9yLCfdyiY1y', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Ethiopia', 'Christianity', '1980-05-19', NULL, NULL, NULL, NULL, '2025-11-16 08:29:30', '2025-11-16 08:29:30', NULL),
(21, 'Gudrun Feil', 'student15@example.com', '2025-11-16 08:29:30', '$2y$12$4PY52yhU3j3.dQibHO5BC.qXU5Ou/9gXyQYgQsI.mdAN2TU4Jmu26', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Saint Martin', 'Buddhism', '2019-05-08', NULL, NULL, NULL, NULL, '2025-11-16 08:29:30', '2025-11-16 08:29:30', NULL),
(22, 'Mr. Edgardo Considine', 'student16@example.com', '2025-11-16 08:29:30', '$2y$12$b1vL4r7ayBGcvl7HVzZkkeTqgdBuxIUgLsgkvhnsqigkFNYxXVrmq', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Brunei Darussalam', 'Hinduism', '1996-04-16', NULL, NULL, NULL, NULL, '2025-11-16 08:29:31', '2025-11-16 08:29:31', NULL),
(23, 'Van Feest', 'student17@example.com', '2025-11-16 08:29:31', '$2y$12$uPHqnhudmpTNLYpUe1PIlu/.wlVryM4BKukMxaa87Cd7ONkEqKHq2', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Trinidad and Tobago', 'Buddhism', '1998-02-14', NULL, NULL, NULL, NULL, '2025-11-16 08:29:31', '2025-11-16 08:29:31', NULL),
(24, 'Sherwood Roob', 'student18@example.com', '2025-11-16 08:29:31', '$2y$12$YwAvbPdfZHBrW7mGdI6L3u3JZ9UbScmqI.TEQEHOJN5L5CR5QK7Lm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Jordan', 'Hinduism', '1971-12-22', NULL, NULL, NULL, NULL, '2025-11-16 08:29:31', '2025-11-16 08:29:31', NULL),
(25, 'Mrs. Albertha Gleichner Jr.', 'student19@example.com', '2025-11-16 08:29:31', '$2y$12$FXBCvy4Px.yqBNaP44WuQO8EroM1Mr45D8d8ClosFzXXyPz.3/VJG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Costa Rica', 'Hinduism', '2000-09-02', NULL, NULL, NULL, NULL, '2025-11-16 08:29:31', '2025-11-16 08:29:31', NULL),
(26, 'Zena Macejkovic', 'student20@example.com', '2025-11-16 08:29:31', '$2y$12$NyPa7Mg5PhWkwSaDVpPVXuczAOOvlFmLBhhONkdmxDPEPPkeJtCZu', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Honduras', 'Christianity', '2021-10-05', NULL, NULL, NULL, NULL, '2025-11-16 08:29:31', '2025-11-16 08:29:31', NULL),
(27, 'Scarlett Prosacco II', 'student21@example.com', '2025-11-16 08:29:31', '$2y$12$KHLHNxBpEiASOSf/oRNJEuZCg3AkUXbA69d20qBTvepQEEZtFmdNG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Equatorial Guinea', 'Buddhism', '2013-03-29', NULL, NULL, NULL, NULL, '2025-11-16 08:29:32', '2025-11-16 08:29:32', NULL),
(28, 'Norberto Murphy III', 'student22@example.com', '2025-11-16 08:29:32', '$2y$12$Ui7umKVpM.3mwDUiKptG4.C0yCKmafdITEZijxvDLRWFXoV60AGKa', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'British Indian Ocean Territory (Chagos Archipelago)', 'Buddhism', '1982-04-14', NULL, NULL, NULL, NULL, '2025-11-16 08:29:32', '2025-11-16 08:29:32', NULL),
(29, 'Jordy Dooley', 'student23@example.com', '2025-11-16 08:29:32', '$2y$12$AzNKydEWTqnz1WyVld6Nh.9GkL8GMDq5sDiC3m3W5tFVPblBuuRVq', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Ecuador', 'Buddhism', '2019-04-02', NULL, NULL, NULL, NULL, '2025-11-16 08:29:32', '2025-11-16 08:29:32', NULL),
(30, 'Mr. Delmer Sipes', 'student24@example.com', '2025-11-16 08:29:32', '$2y$12$K7dyxsa7U8R5PDU4F5upiOCt9TNp2UA3tVMF9N/Ji3i/iW5lOHoDi', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Heard Island and McDonald Islands', 'Christianity', '1974-10-01', NULL, NULL, NULL, NULL, '2025-11-16 08:29:32', '2025-11-16 08:29:32', NULL),
(31, 'Jonas Trantow', 'student25@example.com', '2025-11-16 08:29:32', '$2y$12$wYD7OQhreC9mv0ko4IHmueJ7zDvxiBsZAET02b5KfFQWEoOmfW4l6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Congo', 'Christianity', '1978-11-29', NULL, NULL, NULL, NULL, '2025-11-16 08:29:33', '2025-11-16 08:29:33', NULL),
(32, 'Raul Lakin Jr.', 'student26@example.com', '2025-11-16 08:29:33', '$2y$12$HyHPvt.ISdE7OInlb8sJkO/dSQ7B4td67q6IsGjQjs.xAifQI1XGy', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Venezuela', 'Buddhism', '1983-12-11', NULL, NULL, NULL, NULL, '2025-11-16 08:29:33', '2025-11-16 08:29:33', NULL),
(33, 'Bonita Langworth', 'student27@example.com', '2025-11-16 08:29:33', '$2y$12$BsFXXSwwYy/a6Fv6nUsUI.Tz1jw6qZ/eL8rL8eOE.oENJjHNgWKDa', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Netherlands', 'Hinduism', '1971-12-04', NULL, NULL, NULL, NULL, '2025-11-16 08:29:33', '2025-11-16 08:29:33', NULL),
(34, 'Dr. Kim Sanford', 'student28@example.com', '2025-11-16 08:29:33', '$2y$12$3Fr7wrb4Bt1u0HMu3kGZeO8Pud/HWrSZMALyX6IDhDh/pZTjJSN6i', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Hong Kong', 'Christianity', '2002-02-27', NULL, NULL, NULL, NULL, '2025-11-16 08:29:33', '2025-11-16 08:29:33', NULL),
(35, 'Prof. Otto Tromp DVM', 'student29@example.com', '2025-11-16 08:29:33', '$2y$12$gt4bqA1hcalY9TF4DwtTUOmVbQtkUj6mEO4OzlRfXJzpoaHj0TO6a', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Korea', 'Hinduism', '2007-07-11', NULL, NULL, NULL, NULL, '2025-11-16 08:29:33', '2025-11-16 08:29:33', NULL),
(36, 'Carissa Baumbach', 'student30@example.com', '2025-11-16 08:29:33', '$2y$12$o2BJF0nRWoojo8XPxUKAFO4aMFB.EI5r/dcfbfODdBGz9Y5wnZDca', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Cuba', 'Christianity', '2011-11-04', NULL, NULL, NULL, NULL, '2025-11-16 08:29:34', '2025-11-16 08:29:34', NULL),
(37, 'Titus Cummerata', 'student31@example.com', '2025-11-16 08:29:34', '$2y$12$kAol9vJfeNRuzqbLoThEEuU5.Uq.XanLCeEJVohEAjLGRPbsyskxi', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Kuwait', 'Christianity', '1986-07-30', NULL, NULL, NULL, NULL, '2025-11-16 08:29:34', '2025-11-16 08:29:34', NULL),
(38, 'Dr. Alexa Bosco Jr.', 'student32@example.com', '2025-11-16 08:29:34', '$2y$12$Zta.uxE5p08.0prsppnDJuwXZCMnfc8K8gKHLwlJEtmxVG9Gk1mIu', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Venezuela', 'Hinduism', '1981-02-16', NULL, NULL, NULL, NULL, '2025-11-16 08:29:34', '2025-11-16 08:29:34', NULL),
(39, 'Edgardo Botsford', 'student33@example.com', '2025-11-16 08:29:34', '$2y$12$.ykrcCIQjesbWYyjcUPQjex3BFnY39enqJune6so9NoerGOy6h99m', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Macedonia', 'Christianity', '2004-04-25', NULL, NULL, NULL, NULL, '2025-11-16 08:29:34', '2025-11-16 08:29:34', NULL),
(40, 'Cydney O\'Connell Sr.', 'student34@example.com', '2025-11-16 08:29:34', '$2y$12$bIwwrpHiBXDaZ2tv6OoDn.EDg1mzA8hxC4.Owf7oRdnsL7BqvzI7G', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Puerto Rico', 'Hinduism', '2010-12-24', NULL, NULL, NULL, NULL, '2025-11-16 08:29:35', '2025-11-16 08:29:35', NULL),
(41, 'Tamara Erdman', 'student35@example.com', '2025-11-16 08:29:35', '$2y$12$2miNmy2vdSL0hNSpaxwS9.2aErBO1hjTfpkwcGu55hEzjE566jmHW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Russian Federation', 'Christianity', '2024-02-13', NULL, NULL, NULL, NULL, '2025-11-16 08:29:35', '2025-11-16 08:29:35', NULL),
(42, 'Irma Koepp', 'student36@example.com', '2025-11-16 08:29:35', '$2y$12$oTu9NH9Wx.zRQSACBypPy.zD77b1JwENN7RhF7CE7R4H0fr17wBne', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'French Guiana', 'Buddhism', '1997-07-11', NULL, NULL, NULL, NULL, '2025-11-16 08:29:35', '2025-11-16 08:29:35', NULL),
(43, 'Martin Hoppe', 'student37@example.com', '2025-11-16 08:29:35', '$2y$12$iIY4JNd1.cu1c6PEDhFBI.q1ONFlZbssF4L.brx0/eIFl8SSuN7bW', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Guernsey', 'Buddhism', '1996-08-09', NULL, NULL, NULL, NULL, '2025-11-16 08:29:35', '2025-11-16 08:29:35', NULL),
(44, 'Prof. Jaylan Fadel DDS', 'student38@example.com', '2025-11-16 08:29:35', '$2y$12$sIT3UY7rUOugeLeOIkodMO.XkfQxhiILApocWBbQH94nxwnvhdCtm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Lao People\'s Democratic Republic', 'Islam', '1996-11-26', NULL, NULL, NULL, NULL, '2025-11-16 08:29:36', '2025-11-16 08:29:36', NULL),
(45, 'Geovany Roberts', 'student39@example.com', '2025-11-16 08:29:36', '$2y$12$1ie.OSiq8PuWkUQwXx4fwOAW5BjN6aWrt2VqRLawF/pmg/e7rGjZu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Bangladesh', 'Hinduism', '2009-07-13', NULL, NULL, NULL, NULL, '2025-11-16 08:29:36', '2025-11-16 08:29:36', NULL),
(46, 'Zoie Leffler', 'student40@example.com', '2025-11-16 08:29:36', '$2y$12$FCivgnuvBvaZI73ZJnqE5ObePQMfYdZKLrFl2i.dzbY6snn/KfOpK', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Saint Helena', 'Buddhism', '2012-06-12', NULL, NULL, NULL, NULL, '2025-11-16 08:29:36', '2025-11-16 08:29:36', NULL),
(47, 'Lilliana Romaguera', 'student41@example.com', '2025-11-16 08:29:36', '$2y$12$L0M1I2Y67OvYITwywZGhTODZvnpyjKq04Dgpi8c/0uWvIzqfBiqIW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Chad', 'Islam', '2023-09-26', NULL, NULL, NULL, NULL, '2025-11-16 08:29:36', '2025-11-16 08:29:36', NULL),
(48, 'Tre Bauch', 'student42@example.com', '2025-11-16 08:29:36', '$2y$12$4nbDlq0NeethPpnuIEOg8e9.Jf8hfhPpxvWz9IuLNl04pGtprxFFa', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Solomon Islands', 'Hinduism', '1972-09-27', NULL, NULL, NULL, NULL, '2025-11-16 08:29:36', '2025-11-16 08:29:36', NULL),
(49, 'Jaqueline Wolf', 'student43@example.com', '2025-11-16 08:29:36', '$2y$12$.8DRj8cwd0e1A2micSXWZu.1zW8O7roVYVMv9lxqPAhwE6Z0JqR.a', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Iceland', 'Hinduism', '2014-02-07', NULL, NULL, NULL, NULL, '2025-11-16 08:29:37', '2025-11-16 08:29:37', NULL),
(50, 'Conrad Abernathy DDS', 'student44@example.com', '2025-11-16 08:29:37', '$2y$12$Mlf.N0gZ0IV4aC5O5eMWPeCAHBifsQ3hNIRupvSTuwp3h9fCpRZWi', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Sao Tome and Principe', 'Islam', '1977-06-16', NULL, NULL, NULL, NULL, '2025-11-16 08:29:37', '2025-11-16 08:29:37', NULL),
(51, 'Deangelo Huels', 'student45@example.com', '2025-11-16 08:29:37', '$2y$12$4uzEgdRpCxhUc7W5z1sdOeAgqN8OzPxW5Ccw16KEd1HCztyz7m69S', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Korea', 'Christianity', '1994-05-11', NULL, NULL, NULL, NULL, '2025-11-16 08:29:37', '2025-11-16 08:29:37', NULL),
(52, 'Jimmie Kunze', 'student46@example.com', '2025-11-16 08:29:37', '$2y$12$WcfF6jaLQcgE/epvnieDe.AEBE18SNGse2ND/94wliqhfjtfpE/h.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'United States of America', 'Christianity', '1972-08-12', NULL, NULL, NULL, NULL, '2025-11-16 08:29:37', '2025-11-16 08:29:37', NULL),
(53, 'Prof. Braden Hamill IV', 'student47@example.com', '2025-11-16 08:29:37', '$2y$12$gFpnUZ2HeqY5fZYEtDdFi.ENS7eBos0Uz1MFDqSgbGpZd.nV8S0sa', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Bulgaria', 'Christianity', '2004-09-25', NULL, NULL, NULL, NULL, '2025-11-16 08:29:38', '2025-11-16 08:29:38', NULL),
(54, 'Rhoda Reichert', 'student48@example.com', '2025-11-16 08:29:38', '$2y$12$LGfrvr.all4R8rkQKfxTv.ybiGpCH6lmpgHG7ilU/23x4MRsyasQm', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Kuwait', 'Hinduism', '2018-11-05', NULL, NULL, NULL, NULL, '2025-11-16 08:29:38', '2025-11-16 08:29:38', NULL),
(55, 'Kellie Olson V', 'student49@example.com', '2025-11-16 08:29:38', '$2y$12$kLAQJ9ja4MbLFsDEeSZ1GecpJyEBcMfvUwiyXSwJz10yFSVm38PPG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'El Salvador', 'Hinduism', '1994-08-15', NULL, NULL, NULL, NULL, '2025-11-16 08:29:38', '2025-11-16 08:29:38', NULL),
(56, 'Kristin King', 'student50@example.com', '2025-11-16 08:29:38', '$2y$12$j5l1VgOb05Hnx7aEFNz/VeF1vfQm2mGTX3FV9XX/Jve5PCilNQ8/W', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Saint Vincent and the Grenadines', 'Hinduism', '1998-05-04', NULL, NULL, NULL, NULL, '2025-11-16 08:29:38', '2025-11-16 08:29:38', NULL),
(57, 'Dr. Sandrine Hackett', 'student51@example.com', '2025-11-16 08:29:38', '$2y$12$X7ihGhm8zlQYqzYGT.uKPe1fQXMUVCuePHHeQfI5mR.l.7V6r.xvm', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Paraguay', 'Buddhism', '2010-02-16', NULL, NULL, NULL, NULL, '2025-11-16 08:29:39', '2025-11-16 08:29:39', NULL),
(58, 'Dr. Josh Wisozk IV', 'student52@example.com', '2025-11-16 08:29:39', '$2y$12$0gxaszcIcAXEIdYiL5bTQujX3YHecTg47oGUz.oV3Q.WGZq9BUCVS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Malawi', 'Christianity', '1996-11-26', NULL, NULL, NULL, NULL, '2025-11-16 08:29:39', '2025-11-16 08:29:39', NULL),
(59, 'Robert Conroy', 'student53@example.com', '2025-11-16 08:29:39', '$2y$12$iLdkH9/RtGvov72wAPgkDex6Wpx2a.nZ1ZE87C/Zu2QUgov5WCJbG', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Kyrgyz Republic', 'Hinduism', '2021-12-17', NULL, NULL, NULL, NULL, '2025-11-16 08:29:39', '2025-11-16 08:29:39', NULL),
(60, 'Lilian Russel', 'student54@example.com', '2025-11-16 08:29:39', '$2y$12$8rGCeQnylwwdRW..rPMoBuq8ZfLk5HTvqZESxi07DV3zwVoatOazK', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Falkland Islands (Malvinas)', 'Hinduism', '2011-08-11', NULL, NULL, NULL, NULL, '2025-11-16 08:29:39', '2025-11-16 08:29:39', NULL),
(61, 'Dr. Abdul Kunde V', 'student55@example.com', '2025-11-16 08:29:39', '$2y$12$vaOEQ4nS0AoTZdv/6g6e3OatFtg4t7qt6/MHkzCjcMWBwcHh/TfxK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'British Virgin Islands', 'Buddhism', '1992-12-08', NULL, NULL, NULL, NULL, '2025-11-16 08:29:39', '2025-11-16 08:29:39', NULL),
(62, 'Sheridan Baumbach', 'student56@example.com', '2025-11-16 08:29:39', '$2y$12$XZNz8/HJMNgJSO4efJoM5.dIYC9dI8d1XAbPWkD36g1PVTumhUhB.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Romania', 'Hinduism', '1975-12-21', NULL, NULL, NULL, NULL, '2025-11-16 08:29:40', '2025-11-16 08:29:40', NULL),
(63, 'Edgar Schuster', 'student57@example.com', '2025-11-16 08:29:40', '$2y$12$ZVFwtADUjdXvFtYm5KtsYu/KA8cRxW/Q1STbvJ1mXZ/dL.uBMivn2', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Saint Lucia', 'Islam', '2007-06-02', NULL, NULL, NULL, NULL, '2025-11-16 08:29:40', '2025-11-16 08:29:40', NULL),
(64, 'Hazle O\'Reilly MD', 'student58@example.com', '2025-11-16 08:29:40', '$2y$12$oubwjX1M9q6vGnZj7Duj7eke2ldDMWu1r26Gr1cmAFYVSlKM4Mvuy', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'United Kingdom', 'Islam', '2012-09-29', NULL, NULL, NULL, NULL, '2025-11-16 08:29:40', '2025-11-16 08:29:40', NULL),
(65, 'Corbin O\'Kon', 'student59@example.com', '2025-11-16 08:29:40', '$2y$12$uHTAKgRfujEvjfMaT63JIOqK5N9MvLhsR5AYbls4U0MykFy/Pt26e', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Denmark', 'Christianity', '1984-10-01', NULL, NULL, NULL, NULL, '2025-11-16 08:29:40', '2025-11-16 08:29:40', NULL),
(66, 'Caleb Aufderhar', 'student60@example.com', '2025-11-16 08:29:40', '$2y$12$WuM7Pcuylee6St.Q3pWz.ODmT2JRehvk1rONdSyNXJejNP0a6YA0i', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Chile', 'Buddhism', '1970-04-14', NULL, NULL, NULL, NULL, '2025-11-16 08:29:41', '2025-11-16 08:29:41', NULL),
(67, 'Mr. Reid Monahan DVM', 'student61@example.com', '2025-11-16 08:29:41', '$2y$12$4k95ofSUNDTBXfTIMdZ62.o/bBgknLjHvAedFT4DR8VDihkxqOU62', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Cook Islands', 'Buddhism', '1993-08-18', NULL, NULL, NULL, NULL, '2025-11-16 08:29:41', '2025-11-16 08:29:41', NULL),
(68, 'Trenton Gutkowski', 'student62@example.com', '2025-11-16 08:29:41', '$2y$12$51OHA8U2XS61hOvrsb.9pO8aO7o0xGEOFbTlW9CB5dqhF87u/M8um', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Malaysia', 'Christianity', '1989-01-22', NULL, NULL, NULL, NULL, '2025-11-16 08:29:41', '2025-11-16 08:29:41', NULL),
(69, 'Pasquale Kiehn', 'student63@example.com', '2025-11-16 08:29:41', '$2y$12$oQuoRUUdAdlkJjdI0ayhxO3wcSqZ/i9RZWonazAxYg7roi9BQOYoO', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Switzerland', 'Christianity', '1971-02-14', NULL, NULL, NULL, NULL, '2025-11-16 08:29:41', '2025-11-16 08:29:41', NULL),
(70, 'Jayne Hoeger', 'student64@example.com', '2025-11-16 08:29:41', '$2y$12$RyVQpj/suu8rXVRvKawhM.dwdD8rkkjc5eeG/BSAnM3EULwXLpnxG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Egypt', 'Islam', '1976-10-13', NULL, NULL, NULL, NULL, '2025-11-16 08:29:41', '2025-11-16 08:29:41', NULL),
(71, 'Dr. Dorcas Braun', 'student65@example.com', '2025-11-16 08:29:41', '$2y$12$WTQhn0F7OcywQbNsVSSKKus6oT2Aa.o5fUCE3cMMjzRWy90BEayJG', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Palestinian Territories', 'Christianity', '1981-06-18', NULL, NULL, NULL, NULL, '2025-11-16 08:29:42', '2025-11-16 08:29:42', NULL),
(72, 'Raven Baumbach', 'student66@example.com', '2025-11-16 08:29:42', '$2y$12$pfIFXVXhQgtYjwyV1YSfAu69356YWjk5U5EtyTU/bgpBrQZXorMJ2', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Venezuela', 'Buddhism', '2011-05-06', NULL, NULL, NULL, NULL, '2025-11-16 08:29:42', '2025-11-16 08:29:42', NULL),
(73, 'Destiney Parisian V', 'student67@example.com', '2025-11-16 08:29:42', '$2y$12$3tEeskTo3oTRQJUUaHv5iOkkF0gKdmvQhUiMhHcuFRgba2AtFPHW6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Barbados', 'Christianity', '2002-06-05', NULL, NULL, NULL, NULL, '2025-11-16 08:29:42', '2025-11-16 08:29:42', NULL),
(74, 'Ms. Amelie Jones', 'student68@example.com', '2025-11-16 08:29:42', '$2y$12$MOx.YysXO/v42uubwJ4zIuuVqC2gV4oH43HO6eZq52qv84r9.AGO2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Cayman Islands', 'Islam', '1981-08-07', NULL, NULL, NULL, NULL, '2025-11-16 08:29:42', '2025-11-16 08:29:42', NULL),
(75, 'Electa Reynolds', 'student69@example.com', '2025-11-16 08:29:42', '$2y$12$zSsiusKMNGCT5yuNB/OC4uUF38AIcgatMRRD6oLF1p.ONsTDhMYsO', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Uganda', 'Buddhism', '1998-09-20', NULL, NULL, NULL, NULL, '2025-11-16 08:29:43', '2025-11-16 08:29:43', NULL),
(76, 'Ms. Fay Satterfield DDS', 'student70@example.com', '2025-11-16 08:29:43', '$2y$12$0nYiMBG43kq4MVs3FraWfOV30rs2ZQya8QHlt024FQ7/OYBPVTAqe', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Nigeria', 'Hinduism', '2005-08-25', NULL, NULL, NULL, NULL, '2025-11-16 08:29:43', '2025-11-16 08:29:43', NULL),
(77, 'Garrick Kiehn', 'student71@example.com', '2025-11-16 08:29:43', '$2y$12$hO7H1ewwP.PJ1Hlc4KHY9uimNgtfsxjT0TmcCZ4ncz1bI4eKmj6qK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Somalia', 'Buddhism', '1983-09-12', NULL, NULL, NULL, NULL, '2025-11-16 08:29:43', '2025-11-16 08:29:43', NULL),
(78, 'Mrs. Ardella Lindgren Jr.', 'student72@example.com', '2025-11-16 08:29:43', '$2y$12$kNh0Rl6dycsm7Ad4K52cB.qI4oIUNcq2SZTiaWf2GX5ATG3yiDgEW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Tonga', 'Hinduism', '2014-08-18', NULL, NULL, NULL, NULL, '2025-11-16 08:29:43', '2025-11-16 08:29:43', NULL),
(79, 'Raul Ondricka', 'student73@example.com', '2025-11-16 08:29:43', '$2y$12$51tjd8g5EXIA0g3r4BDQhuCXoEwgjzRV5MMULQINadaT2Mbat2tiC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Benin', 'Buddhism', '1980-12-14', NULL, NULL, NULL, NULL, '2025-11-16 08:29:44', '2025-11-16 08:29:44', NULL),
(80, 'Kelsie Crona', 'student74@example.com', '2025-11-16 08:29:44', '$2y$12$VGm0YJ6EaxMBpUHB1.kLFOmV7J/1mpATbX7HDrZ6uhLXpHvKtHlB6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Antigua and Barbuda', 'Hinduism', '2001-06-03', NULL, NULL, NULL, NULL, '2025-11-16 08:29:44', '2025-11-16 08:29:44', NULL),
(81, 'Constance Marvin', 'student75@example.com', '2025-11-16 08:29:44', '$2y$12$MdrSWSd5JL7vZKxy/B72d.Owcu.tyxhg4uZ4sPLaVvG5F0hZGlu5.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Guinea-Bissau', 'Hinduism', '2009-11-27', NULL, NULL, NULL, NULL, '2025-11-16 08:29:44', '2025-11-16 08:29:44', NULL),
(82, 'Constantin Shanahan', 'student76@example.com', '2025-11-16 08:29:44', '$2y$12$o9wfnlGhtATCagdtJzUSOuWAnRBalfeL3uFrozDrnzV/BshxQ6AoS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Mozambique', 'Hinduism', '1970-10-30', NULL, NULL, NULL, NULL, '2025-11-16 08:29:44', '2025-11-16 08:29:44', NULL),
(83, 'Prof. Eldred Konopelski', 'student77@example.com', '2025-11-16 08:29:44', '$2y$12$N68aRakUufuZNawHPN5O7eM2/R6OHdWsRJdMy88vOOEkAPZ4m.ZQq', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Estonia', 'Islam', '1991-04-20', NULL, NULL, NULL, NULL, '2025-11-16 08:29:44', '2025-11-16 08:29:44', NULL),
(84, 'Prof. Stephanie Morissette', 'student78@example.com', '2025-11-16 08:29:44', '$2y$12$Oika0/KgAbbWHoLoGmrys.8NKwDPm0HRc4c336ZrdmuH4DBV0tGBG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Kenya', 'Islam', '2018-07-04', NULL, NULL, NULL, NULL, '2025-11-16 08:29:45', '2025-11-16 08:29:45', NULL),
(85, 'Bianka Macejkovic', 'student79@example.com', '2025-11-16 08:29:45', '$2y$12$F9PtQ3pbMwHmBZk7kFCblOVD1pFjKBJyumWh4YHgJMd1/6wPFlsg2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Malawi', 'Hinduism', '1994-06-02', NULL, NULL, NULL, NULL, '2025-11-16 08:29:45', '2025-11-16 08:29:45', NULL),
(86, 'Gilda Zboncak', 'student80@example.com', '2025-11-16 08:29:45', '$2y$12$6EoOgIKaWoFUvHTRsaTIkOTjgJd2gylgHr81xJjiL5L50832PQh1O', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Montenegro', 'Buddhism', '1995-12-16', NULL, NULL, NULL, NULL, '2025-11-16 08:29:45', '2025-11-16 08:29:45', NULL),
(87, 'Ova Aufderhar', 'student81@example.com', '2025-11-16 08:29:45', '$2y$12$.sR/1Psi5evClptx3o8Xuek.vSGwxgf8p0kAmPDm1SsXDxxVkOOYG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Turkmenistan', 'Hinduism', '1989-12-13', NULL, NULL, NULL, NULL, '2025-11-16 08:29:45', '2025-11-16 08:29:45', NULL),
(88, 'Lyla Bosco', 'student82@example.com', '2025-11-16 08:29:45', '$2y$12$Ie0xc7piaJ0An1B2ZYPJ4.iemNaFFpYF/i7jnfWsxoZVE2wB0ncqW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Croatia', 'Islam', '1983-05-21', NULL, NULL, NULL, NULL, '2025-11-16 08:29:46', '2025-11-16 08:29:46', NULL),
(89, 'Deja Mueller', 'student83@example.com', '2025-11-16 08:29:46', '$2y$12$16/N2QORwOhfUd/drasS..26IdnsUaz8y9EzYvRqi3ixHqf3oPFR.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Argentina', 'Islam', '2010-02-11', NULL, NULL, NULL, NULL, '2025-11-16 08:29:46', '2025-11-16 08:29:46', NULL),
(90, 'Haylee Moen', 'student84@example.com', '2025-11-16 08:29:46', '$2y$12$j8xtnOMNPp2DG.5uUYfmmeHuXByr1pYoGnVZClizhDFdvWQfTI4AS', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Nicaragua', 'Hinduism', '1989-04-23', NULL, NULL, NULL, NULL, '2025-11-16 08:29:46', '2025-11-16 08:29:46', NULL),
(91, 'Prof. Tracey Jast', 'student85@example.com', '2025-11-16 08:29:46', '$2y$12$0LCuGwP1N2j75wX7n6.M9.7ILeb4/.omFOumSArkbmpF5u2kTrXTe', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Austria', 'Christianity', '1979-05-04', NULL, NULL, NULL, NULL, '2025-11-16 08:29:46', '2025-11-16 08:29:46', NULL),
(92, 'Lola Bernier V', 'student86@example.com', '2025-11-16 08:29:46', '$2y$12$7rMKCS/AeevI2JXoSdVU2eRoUDB5gtIMKOB6ZNA6Fqho.S8ldP.ey', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Isle of Man', 'Buddhism', '1974-08-03', NULL, NULL, NULL, NULL, '2025-11-16 08:29:46', '2025-11-16 08:29:46', NULL),
(93, 'Cecil Feeney DVM', 'student87@example.com', '2025-11-16 08:29:46', '$2y$12$/QZ0IcAL6pmCIHgmn/FNJ./Q1RTxEzfEQrt5m7MnK6vYI/Ge.ww8q', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Norway', 'Islam', '1987-01-08', NULL, NULL, NULL, NULL, '2025-11-16 08:29:47', '2025-11-16 08:29:47', NULL),
(94, 'Prof. Vidal Dietrich', 'student88@example.com', '2025-11-16 08:29:47', '$2y$12$DQFf2.TAJ7z6KQYMw/s4le5w8BuEP1gU2LBijYvYY384.Ltfna/IC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Reunion', 'Hinduism', '1983-02-20', NULL, NULL, NULL, NULL, '2025-11-16 08:29:47', '2025-11-16 08:29:47', NULL),
(95, 'Prof. Delbert Dach', 'student89@example.com', '2025-11-16 08:29:47', '$2y$12$uAe44LmesYH1OQiJhpAHmueAuVL6Pu8HydzsHcusDyBOM/1dpHonu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Bouvet Island (Bouvetoya)', 'Islam', '1984-04-21', NULL, NULL, NULL, NULL, '2025-11-16 08:29:47', '2025-11-16 08:29:47', NULL),
(96, 'Otis Quitzon', 'student90@example.com', '2025-11-16 08:29:47', '$2y$12$OjQGO/lkGSY2stQ6iMsZku7.wZO1vWDbR/Nfgvb1bOVFH21oA.Jma', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Eritrea', 'Islam', '2019-06-17', NULL, NULL, NULL, NULL, '2025-11-16 08:29:47', '2025-11-16 08:29:47', NULL),
(97, 'Prof. Pascale Keeling', 'student91@example.com', '2025-11-16 08:29:47', '$2y$12$i9sVyr/MPIIIsmdyuHM1vuSE2yf/7TVsImkxXKV/MairOmw2e.DQe', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Lao People\'s Democratic Republic', 'Islam', '2011-10-09', NULL, NULL, NULL, NULL, '2025-11-16 08:29:48', '2025-11-16 08:29:48', NULL),
(98, 'Magnus Lueilwitz', 'student92@example.com', '2025-11-16 08:29:48', '$2y$12$8E5Tdk2hEQnDHWZBanPfeeZwEmcp5J09bo7/BKuCOPt9L8PrOmjQu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Trinidad and Tobago', 'Islam', '1973-02-05', NULL, NULL, NULL, NULL, '2025-11-16 08:29:48', '2025-11-16 08:29:48', NULL),
(99, 'Prof. Tony Moen', 'student93@example.com', '2025-11-16 08:29:48', '$2y$12$VGiYDfiIEtiDFBhfOn.36.eRL0KaJI16BgBDLHK.B3hOzfomNsf5a', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Canada', 'Hinduism', '1982-06-16', NULL, NULL, NULL, NULL, '2025-11-16 08:29:48', '2025-11-16 08:29:48', NULL),
(100, 'Prof. Watson McLaughlin', 'student94@example.com', '2025-11-16 08:29:48', '$2y$12$S8z94n2Q18vb/OiGa4npVeFB8WwY/l9ansVETB7gJ/6FcQYQ/CAfa', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Yemen', 'Buddhism', '2018-08-01', NULL, NULL, NULL, NULL, '2025-11-16 08:29:48', '2025-11-16 08:29:48', NULL),
(101, 'D\'angelo Cormier', 'student95@example.com', '2025-11-16 08:29:48', '$2y$12$xVeVGktaIr98sJAKw2AO6ug8tD5aj.8nnGZlxrF1pGKlR0sPLXKmS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Uzbekistan', 'Buddhism', '2023-07-08', NULL, NULL, NULL, NULL, '2025-11-16 08:29:49', '2025-11-16 08:29:49', NULL),
(102, 'Miss Maximillia Walker', 'student96@example.com', '2025-11-16 08:29:49', '$2y$12$gpiqlUS6xt6ZauuPu/h3QuWLNToQaoYXyy1e6cFRZ2ZTPr5nGLmRu', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Congo', 'Christianity', '2018-09-04', NULL, NULL, NULL, NULL, '2025-11-16 08:29:49', '2025-11-16 08:29:49', NULL),
(103, 'Ms. Shanny Miller IV', 'student97@example.com', '2025-11-16 08:29:49', '$2y$12$OHIRK6/cy9WXC.K47jUkd.SexM6IlKy.XwPeQgetIwLrfw8kpcscu', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Samoa', 'Buddhism', '2012-09-05', NULL, NULL, NULL, NULL, '2025-11-16 08:29:49', '2025-11-16 08:29:49', NULL),
(104, 'Prof. Cara Metz', 'student98@example.com', '2025-11-16 08:29:49', '$2y$12$0Vr6aQwHMyLxgFgULTB8MOkO8bGlnEq5kzPPeO0Iw96FsKxespt4m', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Fiji', 'Buddhism', '1970-01-11', NULL, NULL, NULL, NULL, '2025-11-16 08:29:49', '2025-11-16 08:29:49', NULL),
(105, 'Loma Haag', 'student99@example.com', '2025-11-16 08:29:49', '$2y$12$trTa44LjQTdcRNxkCNXIPeUrjBeMJTZOGczujqTMWrNPUG8kenp56', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Georgia', 'Buddhism', '2016-09-01', NULL, NULL, NULL, NULL, '2025-11-16 08:29:49', '2025-11-16 08:29:49', NULL),
(106, 'Admin User', 'admin@example.com', '2025-11-16 08:29:50', '$2y$12$Fq98qwhqU.UBXOa8yctuuOxKqQa8/q5fhH.lVsYCbrr1DVo5mVc7.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-16 08:29:50', '2025-11-16 08:29:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_student_id_date_unique` (`student_id`,`date`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classrooms_room_number_unique` (`room_number`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grades_student_id_exam_id_unique` (`student_id`,`exam_id`),
  ADD KEY `grades_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_received_by_foreign` (`received_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scores_student_id_exam_id_subject_id_semester_unique` (`student_id`,`exam_id`,`subject_id`,`semester`),
  ADD KEY `scores_exam_id_foreign` (`exam_id`),
  ADD KEY `scores_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD KEY `student_course_student_id_foreign` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_code_unique` (`code`),
  ADD KEY `subjects_department_id_foreign` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `student_course_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
