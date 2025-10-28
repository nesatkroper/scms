-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 28, 2025 at 05:50 AM
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
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','late','excused') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
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
(1, 'Classroom A', 'A-101', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(2, 'Classroom A', 'A-102', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(3, 'Classroom A', 'A-103', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(4, 'Classroom A', 'A-104', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(5, 'Classroom A', 'A-105', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(6, 'Classroom B', 'B-101', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(7, 'Classroom B', 'B-102', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(8, 'Classroom B', 'B-103', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(9, 'Classroom B', 'B-104', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(10, 'Classroom B', 'B-105', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(11, 'Classroom C', 'C-101', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(12, 'Classroom C', 'C-102', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(13, 'Classroom C', 'C-103', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(14, 'Classroom C', 'C-104', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(15, 'Classroom C', 'C-105', 30, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE `course_offerings` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `classroom_id` bigint UNSIGNED NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_year` year NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_offerings`
--

INSERT INTO `course_offerings` (`id`, `subject_id`, `student_id`, `classroom_id`, `semester`, `academic_year`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 2, 'Fall', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(2, 5, 2, 10, 'Summer', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(3, 1, 1, 14, 'Summer', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(4, 4, 3, 3, 'Summer', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(5, 4, 3, 2, 'Fall', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(6, 1, 3, 15, 'Fall', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(7, 3, 2, 1, 'Spring', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(8, 4, 2, 10, 'Fall', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(9, 1, 4, 1, 'Summer', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(10, 4, 2, 5, 'Spring', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(11, 1, 5, 15, 'Spring', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(12, 2, 2, 1, 'Fall', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(13, 4, 3, 12, 'Spring', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(14, 4, 1, 1, 'Summer', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(15, 4, 3, 4, 'Spring', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(16, 5, 1, 12, 'Summer', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(17, 5, 5, 9, 'Fall', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(18, 4, 4, 1, 'Fall', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(19, 1, 5, 14, 'Fall', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(20, 2, 5, 7, 'Spring', '2025', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL);

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
(1, 'Administration', 'Oversees the daily operations and management of the school.', '2025-10-27 05:17:42', '2025-10-27 05:17:42', NULL),
(2, 'Human Resources', 'Manages all personnel-related functions, including hiring and staff support.', '2025-10-27 05:17:42', '2025-10-27 05:17:42', NULL),
(3, 'Finance', 'Responsible for the school\'s budget, financial planning, and accounting.', '2025-10-27 05:17:42', '2025-10-27 05:17:42', NULL),
(4, 'Maintenance', 'Handles the upkeep and repair of all school facilities and grounds.', '2025-10-27 05:17:42', '2025-10-27 05:17:42', NULL),
(5, 'Student Services', 'Provides support for student well-being, including counseling and extracurricular activities.', '2025-10-27 05:17:42', '2025-10-27 05:17:42', NULL);

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
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `expense_category_id` bigint UNSIGNED DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Salaries', 'Employee salaries and wages.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(2, 'Rent', 'Rental expenses for buildings and facilities.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(3, 'Utilities', 'Expenses for electricity, water, gas, and internet.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(4, 'Supplies', 'Costs for office, classroom, and maintenance supplies.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(5, 'Maintenance', 'Expenses related to the upkeep and repair of school property.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_structures`
--

CREATE TABLE `fee_structures` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `frequency` enum('monthly','quarterly','semester','annual') COLLATE utf8mb4_unicode_ci NOT NULL,
  `effective_from` date NOT NULL,
  `effective_to` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `grade_levels`
--

CREATE TABLE `grade_levels` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grade_levels`
--

INSERT INTO `grade_levels` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Year 1', 'Y1', 'First year of formal education.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(2, 'Year 2', 'Y2', 'Second year of formal education.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(3, 'Year 3', 'Y3', 'Third year of formal education.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(4, 'Year 4', 'Y4', 'Fourth year of formal education.', '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(2, '2_create_cache_table', 1),
(3, '3_create_jobs_table', 1),
(4, '4_create_personal_access_tokens_table', 1),
(5, '5_create_permission_tables', 1),
(8, '2025_10_28_054230_remove-phto-user', 2);

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
  `student_fee_id` bigint UNSIGNED NOT NULL,
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

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create address', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(2, 'view address', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(3, 'update address', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(4, 'delete address', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(5, 'create attendance', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(6, 'view attendance', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(7, 'update attendance', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(8, 'delete attendance', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(9, 'create book', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(10, 'view book', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(11, 'update book', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(12, 'delete book', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(13, 'create book-category', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(14, 'view book-category', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(15, 'update book-category', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(16, 'delete book-category', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(17, 'create book-issue', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(18, 'view book-issue', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(19, 'update book-issue', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(20, 'delete book-issue', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(21, 'create classroom', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(22, 'view classroom', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(23, 'update classroom', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(24, 'delete classroom', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(25, 'create commune', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(26, 'view commune', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(27, 'update commune', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(28, 'delete commune', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(29, 'create course-offering', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(30, 'view course-offering', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(31, 'update course-offering', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(32, 'delete course-offering', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(33, 'create department', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(34, 'view department', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(35, 'update department', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(36, 'delete department', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(37, 'create district', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(38, 'view district', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(39, 'update district', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(40, 'delete district', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(41, 'create event', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(42, 'view event', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(43, 'update event', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(44, 'delete event', 'web', '2025-10-27 05:17:41', '2025-10-27 05:17:41'),
(45, 'create exam', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(46, 'view exam', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(47, 'update exam', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(48, 'delete exam', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(49, 'create expense', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(50, 'view expense', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(51, 'update expense', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(52, 'delete expense', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(53, 'create expense-category', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(54, 'view expense-category', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(55, 'update expense-category', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(56, 'delete expense-category', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(57, 'create fee-structure', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(58, 'view fee-structure', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(59, 'update fee-structure', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(60, 'delete fee-structure', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(61, 'create grade', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(62, 'view grade', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(63, 'update grade', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(64, 'delete grade', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(65, 'create grade-level', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(66, 'view grade-level', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(67, 'update grade-level', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(68, 'delete grade-level', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(69, 'create guardian', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(70, 'view guardian', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(71, 'update guardian', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(72, 'delete guardian', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(73, 'create notice', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(74, 'view notice', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(75, 'update notice', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(76, 'delete notice', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(77, 'create payment', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(78, 'view payment', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(79, 'update payment', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(80, 'delete payment', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(81, 'create permission', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(82, 'view permission', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(83, 'update permission', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(84, 'delete permission', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(85, 'create province', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(86, 'view province', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(87, 'update province', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(88, 'delete province', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(89, 'create role', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(90, 'view role', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(91, 'update role', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(92, 'delete role', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(93, 'create score', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(94, 'view score', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(95, 'update score', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(96, 'delete score', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(97, 'create student', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(98, 'view student', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(99, 'update student', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(100, 'delete student', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(101, 'create student-fee', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(102, 'view student-fee', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(103, 'update student-fee', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(104, 'delete student-fee', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(105, 'create subject', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(106, 'view subject', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(107, 'update subject', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(108, 'delete subject', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(109, 'create teacher', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(110, 'view teacher', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(111, 'update teacher', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(112, 'delete teacher', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(113, 'create user', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(114, 'view user', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(115, 'update user', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(116, 'delete user', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(117, 'create village', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(118, 'view village', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(119, 'update village', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(120, 'delete village', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42');

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
(1, 'admin', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(2, 'teacher', 'web', '2025-10-27 05:17:42', '2025-10-27 05:17:42'),
(3, 'student', 'web', '2025-10-27 05:17:43', '2025-10-27 05:17:43'),
(4, 'guardian', 'web', '2025-10-27 05:17:43', '2025-10-27 05:17:43'),
(5, 'staff', 'web', '2025-10-27 05:17:43', '2025-10-27 05:17:43');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6AAV5FrM1VykDE81l7B1zVvuFpA4OnxG0QnrYWMT', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXA0cVNwUTNKOFJ0R1h0cGxuNHlremRsMUhmOXllQVhBeGIwREo2YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODEwMi9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1761625288),
('TpZ6OeKL7VTiEGht8s6kwADhSfo9r2i4mIWoJCVX', 106, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTzhYMXhQeVpQYlpNM1BUQmdsNlpYQ2J0TkpGWkJMcWJiZlpoa0dVeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODEwMi9hZG1pbi9zY29yZXMiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLnNjb3Jlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwNjtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NjE2MjU0MDU7fX0=', 1761630513);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `grade_final` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `course_offering_id`, `grade_final`, `created_at`, `updated_at`) VALUES
(6, 12, 77.18, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(7, 14, 97.12, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(10, 15, 97.92, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(10, 19, 84.18, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(12, 9, 67.38, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(14, 13, 93.58, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(16, 3, 69.13, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(17, 2, 62.17, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(17, 8, 75.10, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(17, 19, 83.04, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(20, 11, 81.20, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(21, 10, 62.66, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(21, 19, 75.06, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(22, 7, 79.97, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(22, 15, 83.29, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(24, 6, 88.93, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(24, 9, 77.84, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(24, 16, 83.84, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(24, 17, 72.13, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(25, 17, 73.82, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(26, 12, 61.97, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(26, 13, 69.03, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(29, 1, 95.45, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(29, 17, 90.60, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(31, 12, 84.55, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(31, 15, 70.77, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(32, 5, 87.95, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(34, 13, 78.73, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(35, 8, 99.18, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(36, 4, 83.38, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(36, 14, 76.21, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(36, 18, 67.77, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(37, 20, 66.45, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(38, 16, 83.17, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(39, 7, 65.32, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(39, 9, 96.56, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(40, 20, 73.97, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(41, 3, 98.71, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(44, 2, 98.44, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(46, 2, 87.32, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(47, 1, 80.70, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(50, 8, 81.00, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(50, 15, 61.69, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(52, 4, 88.72, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(52, 12, 78.23, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(53, 5, 65.78, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(54, 16, 88.51, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(55, 14, 66.97, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(57, 13, 83.32, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(59, 1, 75.05, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(63, 2, 66.61, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(63, 9, 99.31, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(63, 13, 73.25, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(64, 9, 60.70, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(66, 7, 84.48, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(68, 9, 69.67, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(68, 10, 84.92, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(69, 4, 91.50, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(69, 6, 60.83, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(69, 7, 66.68, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(69, 13, 71.43, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(69, 16, 78.78, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(70, 1, 62.71, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(70, 6, 70.15, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(71, 5, 78.29, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(74, 12, 62.25, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(75, 9, 95.17, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(77, 10, 90.83, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(77, 18, 95.96, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(77, 19, 96.18, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(81, 13, 85.78, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(81, 16, 63.39, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(82, 7, 85.78, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(82, 18, 88.63, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(84, 6, 87.23, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(84, 16, 62.11, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(85, 15, 62.46, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(85, 19, 65.42, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(86, 7, 94.35, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(88, 5, 83.25, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(90, 11, 95.19, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(90, 14, 87.33, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(91, 9, 66.09, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(91, 19, 99.12, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(92, 4, 74.07, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(94, 1, 87.92, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(95, 9, 86.92, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(95, 20, 71.23, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(96, 3, 83.79, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(96, 4, 71.94, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(96, 14, 65.34, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(97, 7, 63.44, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(98, 16, 98.68, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(102, 15, 65.78, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(103, 3, 73.54, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(103, 8, 96.76, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(104, 15, 71.59, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(104, 18, 95.03, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(105, 9, 85.12, '2025-10-27 05:18:02', '2025-10-27 05:18:02'),
(105, 20, 84.44, '2025-10-27 05:18:02', '2025-10-27 05:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `fee_structure_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','partial','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `due_date` date NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_guardian`
--

CREATE TABLE `student_guardian` (
  `student_id` bigint UNSIGNED NOT NULL,
  `guardian_id` bigint UNSIGNED NOT NULL,
  `relation_to_student` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `credit_hours`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Introduction to Programming', 'CS101', 'A foundational course on the principles of computer programming.', 3, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(2, 'Data Structures', 'CS202', 'An in-depth study of data organization and management.', 4, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(3, 'British Literature', 'ENGL250', 'A survey of key literary works from Great Britain.', 3, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(4, 'Creative Writing', 'ENGL301', 'Focuses on developing skills in various forms of creative writing.', 3, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL),
(5, 'Calculus I', 'MATH150', 'The first course in differential and integral calculus.', 4, '2025-10-27 05:18:02', '2025-10-27 05:18:02', NULL);

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
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
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
(1, 'Brain Howe', 'teacher0@example.com', '2025-10-27 05:17:43', '$2y$12$FK.mDsrOz25/MWCAghzfD.vtwmH1LwuFsN/BfR0HO7ywWdzmuvJ0K', '651.829.7136', '775 Maxwell Haven Apt. 012\nEast Elvaport, SC 57639', '2003-12-27', 'male', 5, '1970-11-13', 'Master', '5 years', 'Science', 74114.67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-27 05:17:43', '2025-10-27 05:17:43', NULL),
(2, 'Matteo Leffler DVM', 'teacher1@example.com', '2025-10-27 05:17:43', '$2y$12$lNXhPcq4x3XA.6HqTZ2dLeVI1Ux5elXAQfvXhfuZv8KZPvSUEUUv2', '715-904-7261', '50643 Fisher Wells\nDrakeshire, MT 63580-3838', '2020-10-09', 'male', 4, '1986-02-02', 'Bachelor', '5 years', 'Mathematics', 79366.12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-27 05:17:43', '2025-10-27 05:17:43', NULL),
(3, 'Christina Gulgowski', 'teacher2@example.com', '2025-10-27 05:17:43', '$2y$12$Bm/HLBWLqMirEoY7Fhw1DuVRicAtgkxPOiW7WXryAIdbUQN.Vf6da', '+1-856-701-5526', '2499 Beahan Stream\nPort Maciport, DE 47591-1900', '2013-05-17', 'female', 3, '1984-11-26', 'Bachelor', '5 years', 'Literature', 71185.43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-27 05:17:43', '2025-10-27 05:17:43', NULL),
(4, 'Della Schuppe', 'teacher3@example.com', '2025-10-27 05:17:43', '$2y$12$ugTBZe1Fil9XjLd.wE8V4eBu6UVKryUeGvX1KYl/1tcy2fiT64o/6', '505-623-1362', '5697 Jenkins Port Suite 632\nNew Andreanneville, KS 41662', '1994-07-17', 'female', 2, '2010-10-13', 'Bachelor', '10 years', 'Literature', 52798.91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-27 05:17:43', '2025-10-27 05:17:43', NULL),
(5, 'Erin Hammes', 'teacher4@example.com', '2025-10-27 05:17:43', '$2y$12$EcC9BapOYiBd0YY5oMOPNeYAEnDDaoiYcza6lD5AqPh3CnjZHG2Ae', '+1.618.780.1240', '89534 Powlowski Estate Apt. 677\nWeissnatfurt, DE 03587', '2001-11-13', 'male', 3, '2007-12-30', 'Master', '10 years', 'Science', 42772.92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-27 05:17:43', '2025-10-27 05:17:43', NULL),
(6, 'Terrell Durgan III', 'student0@example.com', '2025-10-27 05:17:43', '$2y$12$Yo7tBo/oQ67ywf01qpDhR.zSeMtxAFn1mbbhaNO7.7u4RsPXaALbK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Iceland', 'Buddhism', '2008-06-02', NULL, NULL, NULL, NULL, '2025-10-27 05:17:44', '2025-10-27 05:17:44', NULL),
(7, 'Mr. Eldon Emmerich DVM', 'student1@example.com', '2025-10-27 05:17:44', '$2y$12$lL72pOFqi79PxJBseSlonONL6yjoaRQ4dMxTQ2wrqbEKaYtx.LFPC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Guinea-Bissau', 'Christianity', '1974-10-17', NULL, NULL, NULL, NULL, '2025-10-27 05:17:44', '2025-10-27 05:17:44', NULL),
(8, 'Jordy Baumbach', 'student2@example.com', '2025-10-27 05:17:44', '$2y$12$6hADPbZfOwkk8EvK2q6yFO3FEHHbp6Oi/XQL4S9YiIpMupcZZPLUm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'El Salvador', 'Christianity', '1973-03-25', NULL, NULL, NULL, NULL, '2025-10-27 05:17:44', '2025-10-27 05:17:44', NULL),
(9, 'Helmer Heller DDS', 'student3@example.com', '2025-10-27 05:17:44', '$2y$12$3a86aLA/TJ0eGxvB9qat/O3N9AIOGieZ60.exI/l6nt22IsaXrvFq', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Kenya', 'Islam', '1983-04-20', NULL, NULL, NULL, NULL, '2025-10-27 05:17:44', '2025-10-27 05:17:44', NULL),
(10, 'Dr. Noble Becker V', 'student4@example.com', '2025-10-27 05:17:44', '$2y$12$DGmoi3L49Jhne8dHX7yk9uRwmuH.Jh18KXFV9P4/uXGuVVXVXOCxy', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Martinique', 'Buddhism', '2007-11-22', NULL, NULL, NULL, NULL, '2025-10-27 05:17:44', '2025-10-27 05:17:44', NULL),
(11, 'Rex Von', 'student5@example.com', '2025-10-27 05:17:44', '$2y$12$WBdWxIU5VmgIzHgxt7.wUOf7kAO3hiHkAo1zomcTc5EkXi2NtWdyu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Suriname', 'Hinduism', '1993-06-17', NULL, NULL, NULL, NULL, '2025-10-27 05:17:44', '2025-10-27 05:17:44', NULL),
(12, 'Eldred Schultz', 'student6@example.com', '2025-10-27 05:17:44', '$2y$12$3PLEd3gS4/zWP1y5JVz1ZO19YBHb6mpsHEEEYvRbbY5LxKQtY6wb2', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Guinea-Bissau', 'Islam', '2014-11-20', NULL, NULL, NULL, NULL, '2025-10-27 05:17:45', '2025-10-27 05:17:45', NULL),
(13, 'Mr. Cleo Heaney', 'student7@example.com', '2025-10-27 05:17:45', '$2y$12$zVjAYtqxOiSrZB6txSiXE.loKRxCVUQzQtAMplrDr770zNtZQroXm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Moldova', 'Hinduism', '2012-11-20', NULL, NULL, NULL, NULL, '2025-10-27 05:17:45', '2025-10-27 05:17:45', NULL),
(14, 'Kenyon Anderson', 'student8@example.com', '2025-10-27 05:17:45', '$2y$12$joic6u6SI3zE/9UaXRpnVu5Hs9HuU2pkGOopUQhep6/0MHzIsFaSu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Azerbaijan', 'Islam', '1999-03-11', NULL, NULL, NULL, NULL, '2025-10-27 05:17:45', '2025-10-27 05:17:45', NULL),
(15, 'Isabel Berge', 'student9@example.com', '2025-10-27 05:17:45', '$2y$12$QAJuB.CN71dc4FtDi3UJ9.0Fm43LBnSIzdtWr5uIEftmKKHTcJU..', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Romania', 'Christianity', '1987-07-25', NULL, NULL, NULL, NULL, '2025-10-27 05:17:45', '2025-10-27 05:17:45', NULL),
(16, 'Jerrod Wilderman', 'student10@example.com', '2025-10-27 05:17:45', '$2y$12$1u8ll.gpjgv75uxV52m7Z.SETPuZzke7CScFz5f1jlKHPCxgRGZT6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Vanuatu', 'Islam', '1971-03-08', NULL, NULL, NULL, NULL, '2025-10-27 05:17:45', '2025-10-27 05:17:45', NULL),
(17, 'Prof. Teagan Wisoky', 'student11@example.com', '2025-10-27 05:17:45', '$2y$12$7kiwEq8eGFMJUInlETMRwOybBESql3S2UZ8EY9nJmcnOB9AiDYpKO', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Cote d\'Ivoire', 'Islam', '2013-08-02', NULL, NULL, NULL, NULL, '2025-10-27 05:17:45', '2025-10-27 05:17:45', NULL),
(18, 'Prof. Darrick Volkman', 'student12@example.com', '2025-10-27 05:17:45', '$2y$12$R4Rz1zueWwFr4Tx158d6IOva1q0h4aOWhWLtBlfHGH5iWQHy6ATlq', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Bolivia', 'Buddhism', '2017-12-11', NULL, NULL, NULL, NULL, '2025-10-27 05:17:46', '2025-10-27 05:17:46', NULL),
(19, 'Adelle Tremblay', 'student13@example.com', '2025-10-27 05:17:46', '$2y$12$Rkf6xWkIVFkH0zF3z4mfPeIkckVSw1f8B0z3OAwthRGIK9DDqO/Ky', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'United Kingdom', 'Hinduism', '2001-08-12', NULL, NULL, NULL, NULL, '2025-10-27 05:17:46', '2025-10-27 05:17:46', NULL),
(20, 'Joany Nicolas', 'student14@example.com', '2025-10-27 05:17:46', '$2y$12$l7tI131MuLFMaWqjHjt/oOFicpY6XxPaZ75GysWhh3pQ3Zf44qzni', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Egypt', 'Buddhism', '1985-06-27', NULL, NULL, NULL, NULL, '2025-10-27 05:17:46', '2025-10-27 05:17:46', NULL),
(21, 'Candace Lehner', 'student15@example.com', '2025-10-27 05:17:46', '$2y$12$7s7akgrIhhxI2vb8/7n4X.E0W0mcOJCZ802bxsFUB63Cm2G0Qshny', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'British Indian Ocean Territory (Chagos Archipelago)', 'Hinduism', '2019-07-14', NULL, NULL, NULL, NULL, '2025-10-27 05:17:46', '2025-10-27 05:17:46', NULL),
(22, 'Prof. Laverne Stokes', 'student16@example.com', '2025-10-27 05:17:46', '$2y$12$5atyMQ0S1YvjdUxHOBJEB.hh9oThTpvmf06t37q.59LO9WbP05gDa', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Ghana', 'Islam', '1980-08-28', NULL, NULL, NULL, NULL, '2025-10-27 05:17:46', '2025-10-27 05:17:46', NULL),
(23, 'Ernest Hackett', 'student17@example.com', '2025-10-27 05:17:46', '$2y$12$18RYRHm/DREXN8MRfhIi8eApwGRA/5zSp8Nu2T5ut/i.tsXnzrkty', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Solomon Islands', 'Hinduism', '1992-12-29', NULL, NULL, NULL, NULL, '2025-10-27 05:17:46', '2025-10-27 05:17:46', NULL),
(24, 'Tiana Marquardt', 'student18@example.com', '2025-10-27 05:17:46', '$2y$12$eWglGfc8EvYEWTAhD..q3.kmLDjz5a9RV5QaQwzszcieM5p5yaQm6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Guyana', 'Christianity', '1985-10-23', NULL, NULL, NULL, NULL, '2025-10-27 05:17:47', '2025-10-27 05:17:47', NULL),
(25, 'Prof. Rahul Schinner', 'student19@example.com', '2025-10-27 05:17:47', '$2y$12$oI6XdtffdICvkp9NVfrWGOrgtZSLM5kCTfmOHXdoHBX2dllyBUl3e', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Moldova', 'Christianity', '2008-05-19', NULL, NULL, NULL, NULL, '2025-10-27 05:17:47', '2025-10-27 05:17:47', NULL),
(26, 'Ladarius Bogisich IV', 'student20@example.com', '2025-10-27 05:17:47', '$2y$12$KQgXKUhLkoTNQemH3zZsouYq4TBDxQ2aULEi./hzJ1DUoyrxk.wIS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Sao Tome and Principe', 'Hinduism', '1970-05-28', NULL, NULL, NULL, NULL, '2025-10-27 05:17:47', '2025-10-27 05:17:47', NULL),
(27, 'Prof. Verda Stark', 'student21@example.com', '2025-10-27 05:17:47', '$2y$12$qVs8TfJe/godyegdj/cnp.bMiQZ/2orNScpXjGIokMru/iVsuSbdu', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Croatia', 'Buddhism', '2025-07-18', NULL, NULL, NULL, NULL, '2025-10-27 05:17:47', '2025-10-27 05:17:47', NULL),
(28, 'Dannie Lebsack', 'student22@example.com', '2025-10-27 05:17:47', '$2y$12$1q6QZSGYfGSANDgzhBXAR.ULvuc/NBdGuBj63D77ENS0e1xGaNmDi', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Switzerland', 'Buddhism', '2024-02-10', NULL, NULL, NULL, NULL, '2025-10-27 05:17:47', '2025-10-27 05:17:47', NULL),
(29, 'Geo Fisher', 'student23@example.com', '2025-10-27 05:17:47', '$2y$12$qdbDonGjnYpjGRB4uRkNGO7AdSSpk4Gd.eN4VEyZO7XR3xh26UaJC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Mali', 'Christianity', '2022-09-16', NULL, NULL, NULL, NULL, '2025-10-27 05:17:47', '2025-10-27 05:17:47', NULL),
(30, 'Moriah Labadie', 'student24@example.com', '2025-10-27 05:17:47', '$2y$12$jo8J5nVxwrdlm4VRv3dgNO.4cxRv/OXaGN20MyLi3cDpEJLagNkVO', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Mongolia', 'Christianity', '2019-08-29', NULL, NULL, NULL, NULL, '2025-10-27 05:17:48', '2025-10-27 05:17:48', NULL),
(31, 'Miss Anastasia Langosh I', 'student25@example.com', '2025-10-27 05:17:48', '$2y$12$p9JwK2GODHO3gihuoVHnneZA6KHQFCAt0tfRCeOqPRIdWoKBu8ame', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Singapore', 'Hinduism', '1973-03-16', NULL, NULL, NULL, NULL, '2025-10-27 05:17:48', '2025-10-27 05:17:48', NULL),
(32, 'Prof. Vickie Gottlieb Sr.', 'student26@example.com', '2025-10-27 05:17:48', '$2y$12$jdyi3OiwGKvBBSN0Uawxlu0o.MPkONXT0z45IbgpQDGPEGeNGFWgW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Uruguay', 'Islam', '1980-04-12', NULL, NULL, NULL, NULL, '2025-10-27 05:17:48', '2025-10-27 05:17:48', NULL),
(33, 'Efrain Murphy', 'student27@example.com', '2025-10-27 05:17:48', '$2y$12$tQggFuNP23yd75IkuPLlru3WjyTTXaW1wf4Kr7izP5c/OZ3vTNJ9G', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Svalbard & Jan Mayen Islands', 'Islam', '1986-01-17', NULL, NULL, NULL, NULL, '2025-10-27 05:17:48', '2025-10-27 05:17:48', NULL),
(34, 'Leonor Torphy', 'student28@example.com', '2025-10-27 05:17:48', '$2y$12$hkAK8VvKFz7gbHYge9AWdeNsudC8Eskb.3MpxE4c/B.IlqNFIKu1u', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Cuba', 'Hinduism', '1989-03-05', NULL, NULL, NULL, NULL, '2025-10-27 05:17:48', '2025-10-27 05:17:48', NULL),
(35, 'Miss Edwina Witting Jr.', 'student29@example.com', '2025-10-27 05:17:48', '$2y$12$FLu3RVJNT60HJdT0yhFmGOO.iBAFUY.sBBYpj6AqJxtZYUy3prGPG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Equatorial Guinea', 'Islam', '1992-10-20', NULL, NULL, NULL, NULL, '2025-10-27 05:17:49', '2025-10-27 05:17:49', NULL),
(36, 'Kamille Wintheiser Jr.', 'student30@example.com', '2025-10-27 05:17:49', '$2y$12$BbqKsRMDY93bWD26oKP01u7EYP9gQttIY4eYpjFY2qS4lhJenqLXq', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Guatemala', 'Hinduism', '2012-09-13', NULL, NULL, NULL, NULL, '2025-10-27 05:17:49', '2025-10-27 05:17:49', NULL),
(37, 'Margot Dickinson III', 'student31@example.com', '2025-10-27 05:17:49', '$2y$12$YdfhSxdrPjabY.5DRYYZTuofYPLlrEA..wla4XrNH4EOQM4MDlale', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Antigua and Barbuda', 'Buddhism', '2004-07-22', NULL, NULL, NULL, NULL, '2025-10-27 05:17:49', '2025-10-27 05:17:49', NULL),
(38, 'Dr. Glenda Cole Jr.', 'student32@example.com', '2025-10-27 05:17:49', '$2y$12$.FPLnnI3FvSPkA9zWWjj2.G.F7lF.DOuKB/.nNSIk5QKfHRg1FsYO', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Cocos (Keeling) Islands', 'Buddhism', '2002-11-21', NULL, NULL, NULL, NULL, '2025-10-27 05:17:49', '2025-10-27 05:17:49', NULL),
(39, 'Bertram Hirthe III', 'student33@example.com', '2025-10-27 05:17:49', '$2y$12$SYirmrlRu0DxHhaC7T7Dyu0niYevHs1Nm.APq2o29GeqZc9BZ4vry', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Finland', 'Hinduism', '2005-01-21', NULL, NULL, NULL, NULL, '2025-10-27 05:17:49', '2025-10-27 05:17:49', NULL),
(40, 'Richmond Ernser Jr.', 'student34@example.com', '2025-10-27 05:17:49', '$2y$12$JjWfAHrHUvCoDkh09WOumu0jzvIlrHoVMUXluWfW1olzQNIaBroUK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Turks and Caicos Islands', 'Hinduism', '2022-03-25', NULL, NULL, NULL, NULL, '2025-10-27 05:17:49', '2025-10-27 05:17:49', NULL),
(41, 'Walker Satterfield', 'student35@example.com', '2025-10-27 05:17:49', '$2y$12$GP7xbC5VFQZ470Rq6Paug.vAA/6iFxgQYU3999GfSvAqdOCmM2sSm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Lithuania', 'Christianity', '2003-04-08', NULL, NULL, NULL, NULL, '2025-10-27 05:17:50', '2025-10-27 05:17:50', NULL),
(42, 'Vicente Bruen V', 'student36@example.com', '2025-10-27 05:17:50', '$2y$12$xwOzxB0HYjwdwfImZwzOFOC7dbhVF31sMCHIzp/6IZ4y0uYuX4gZC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Pakistan', 'Buddhism', '1971-11-27', NULL, NULL, NULL, NULL, '2025-10-27 05:17:50', '2025-10-27 05:17:50', NULL),
(43, 'John Waelchi', 'student37@example.com', '2025-10-27 05:17:50', '$2y$12$IwGMPAQfpzsAJEdpwAJl.ubcnp6gL1rn4ZXrIMh0lJ7OzNNAwGHcS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Guinea-Bissau', 'Buddhism', '2021-10-18', NULL, NULL, NULL, NULL, '2025-10-27 05:17:50', '2025-10-27 05:17:50', NULL),
(44, 'Terrell Collins', 'student38@example.com', '2025-10-27 05:17:50', '$2y$12$3Ee.y0khywAFKdoNVPfFfeZlw/ntaDjzRDPCxsWl3.4jFq.IoquMC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Mauritania', 'Buddhism', '1985-06-17', NULL, NULL, NULL, NULL, '2025-10-27 05:17:50', '2025-10-27 05:17:50', NULL),
(45, 'Ashlynn Schroeder', 'student39@example.com', '2025-10-27 05:17:50', '$2y$12$7DBYmviQ8HRE9wgwo9m.feaeJe4gjZM0B26SmwD9z2Ptd2V1xmQCy', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Burundi', 'Islam', '1983-07-14', NULL, NULL, NULL, NULL, '2025-10-27 05:17:50', '2025-10-27 05:17:50', NULL),
(46, 'Daren Rosenbaum', 'student40@example.com', '2025-10-27 05:17:50', '$2y$12$9XJ0Ezu1TPl6Zi3IQvRhqOVivN/eKRg368i1tST98qO5MbVbHwtPm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Wallis and Futuna', 'Hinduism', '1975-02-28', NULL, NULL, NULL, NULL, '2025-10-27 05:17:50', '2025-10-27 05:17:50', NULL),
(47, 'Quincy Tremblay', 'student41@example.com', '2025-10-27 05:17:50', '$2y$12$cX6GvL.w48mM6d6/5otAhOQiJHhpG72Kc1VCtLdmpE1uQnAOHk0ja', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Hungary', 'Islam', '1972-09-18', NULL, NULL, NULL, NULL, '2025-10-27 05:17:51', '2025-10-27 05:17:51', NULL),
(48, 'Prof. Oliver Wiza', 'student42@example.com', '2025-10-27 05:17:51', '$2y$12$8fde.9/rva1mZv0nxmykLeQ1APsZUHgYoo3Dtd7jHWB7au7ckcG6.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Niger', 'Buddhism', '2025-04-28', NULL, NULL, NULL, NULL, '2025-10-27 05:17:51', '2025-10-27 05:17:51', NULL),
(49, 'Katrine Schimmel PhD', 'student43@example.com', '2025-10-27 05:17:51', '$2y$12$ne4Lhw51jlqjY1nGlCNuTuluJS73Kz/g6bq71dWTVveyN3V7FpU9m', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Niue', 'Christianity', '2009-02-06', NULL, NULL, NULL, NULL, '2025-10-27 05:17:51', '2025-10-27 05:17:51', NULL),
(50, 'Priscilla Lind', 'student44@example.com', '2025-10-27 05:17:51', '$2y$12$xBGCet131R9cuRaujWp.OuIF271TydLYMCqXcvD5nODPQTmk35i0a', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Reunion', 'Islam', '1985-03-19', NULL, NULL, NULL, NULL, '2025-10-27 05:17:51', '2025-10-27 05:17:51', NULL),
(51, 'Madilyn Jerde', 'student45@example.com', '2025-10-27 05:17:51', '$2y$12$e9cGgcfHO8Xkv8fT5zcc0.pI9xBcm/NSwyYK1K.1pyl/E3Dx7blEq', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Uganda', 'Islam', '2008-01-04', NULL, NULL, NULL, NULL, '2025-10-27 05:17:51', '2025-10-27 05:17:51', NULL),
(52, 'Prof. Bernhard Hansen', 'student46@example.com', '2025-10-27 05:17:51', '$2y$12$6KBiyEWmQyoRifUqhM/RxOwQ6sto2xHm8Q8wou7zD2QFtQrMw2Kvi', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Mongolia', 'Buddhism', '1985-07-17', NULL, NULL, NULL, NULL, '2025-10-27 05:17:51', '2025-10-27 05:17:51', NULL),
(53, 'Kurt Olson IV', 'student47@example.com', '2025-10-27 05:17:51', '$2y$12$/Lyqvb27pbGzw335eQgtO.UY0YjyUyyECd5YU160As8dt1yeICFdi', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Northern Mariana Islands', 'Buddhism', '1989-03-02', NULL, NULL, NULL, NULL, '2025-10-27 05:17:52', '2025-10-27 05:17:52', NULL),
(54, 'Rubie Crist', 'student48@example.com', '2025-10-27 05:17:52', '$2y$12$/MVoz00p38M00FnJDXiGKuwXhETcCUR2EJ3diNlmL8mrlvXikP2rC', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'United States Virgin Islands', 'Hinduism', '2017-10-15', NULL, NULL, NULL, NULL, '2025-10-27 05:17:52', '2025-10-27 05:17:52', NULL),
(55, 'Quinn Wolff', 'student49@example.com', '2025-10-27 05:17:52', '$2y$12$LfQ4lk4pwR2Wxy.pG3OaoesMqpn4PtdYM9MTvZf8DsDtBdb8h01b6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Bermuda', 'Hinduism', '1977-03-10', NULL, NULL, NULL, NULL, '2025-10-27 05:17:52', '2025-10-27 05:17:52', NULL),
(56, 'Dr. Rosario Donnelly', 'student50@example.com', '2025-10-27 05:17:52', '$2y$12$qh1UFQ62tFmR1wb6/IDYZOsxnSYwWF.6NLDdkT6lun/TMyFvOnA8i', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Switzerland', 'Islam', '2003-07-29', NULL, NULL, NULL, NULL, '2025-10-27 05:17:52', '2025-10-27 05:17:52', NULL),
(57, 'Norma Nicolas', 'student51@example.com', '2025-10-27 05:17:52', '$2y$12$GzNqxwsfIgPHV81Wre0ozeWuGgLpIXN89VDm6gTzwdUhFK6xxaGWG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Uganda', 'Christianity', '2008-07-19', NULL, NULL, NULL, NULL, '2025-10-27 05:17:52', '2025-10-27 05:17:52', NULL),
(58, 'Emelie Carroll DDS', 'student52@example.com', '2025-10-27 05:17:52', '$2y$12$dzc.EWqLVTB4PN3DSDx2rO3dT1TSAJUoeyexx2HoyPj0.WvMK6lpK', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Burkina Faso', 'Buddhism', '2020-06-10', NULL, NULL, NULL, NULL, '2025-10-27 05:17:52', '2025-10-27 05:17:52', NULL),
(59, 'Paxton Wehner', 'student53@example.com', '2025-10-27 05:17:52', '$2y$12$rYtP6j09EHz3d1dYQL/tmueyLDqugCfVCaPrtq2M2oJEXsDZv53r6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Cape Verde', 'Christianity', '1970-10-30', NULL, NULL, NULL, NULL, '2025-10-27 05:17:53', '2025-10-27 05:17:53', NULL),
(60, 'Dr. Izaiah Mohr', 'student54@example.com', '2025-10-27 05:17:53', '$2y$12$4TlgPkUC0WVPo5ObDSuKv.Eo92Wh2BGxwKQB977j9FXBkya9bTcuC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Hong Kong', 'Islam', '1971-04-04', NULL, NULL, NULL, NULL, '2025-10-27 05:17:53', '2025-10-27 05:17:53', NULL),
(61, 'Hannah Hickle', 'student55@example.com', '2025-10-27 05:17:53', '$2y$12$3drz3jaJIFaWHRfIW4drFeXHdjzL0FHYtKCojzQNZc8sEGCJSiu1m', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Jersey', 'Christianity', '1971-07-30', NULL, NULL, NULL, NULL, '2025-10-27 05:17:53', '2025-10-27 05:17:53', NULL),
(62, 'Christopher Robel', 'student56@example.com', '2025-10-27 05:17:53', '$2y$12$2Xrot3CfX27kRQPkht/MNOh0K5m9LNbIqEnKRrilUnf4KBq/iVktm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Australia', 'Islam', '2010-05-27', NULL, NULL, NULL, NULL, '2025-10-27 05:17:53', '2025-10-27 05:17:53', NULL),
(63, 'Prof. Holden Rogahn', 'student57@example.com', '2025-10-27 05:17:53', '$2y$12$Ctvz0c1vMWIb8r.5N48mb.JEm85mo.9i0by5CL/sjl5yV7lmDctba', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Ghana', 'Christianity', '2024-01-02', NULL, NULL, NULL, NULL, '2025-10-27 05:17:53', '2025-10-27 05:17:53', NULL),
(64, 'Brandy Reichel', 'student58@example.com', '2025-10-27 05:17:53', '$2y$12$ks.1KfUsnrrE1Tqwj07vo.3mHcbGzkMtjtIx4ONw0yWhsY3cP94te', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Liberia', 'Buddhism', '1994-05-24', NULL, NULL, NULL, NULL, '2025-10-27 05:17:53', '2025-10-27 05:17:53', NULL),
(65, 'Myriam Okuneva', 'student59@example.com', '2025-10-27 05:17:53', '$2y$12$ModKg7ASoWndhS88OkRb5.kdQw7Z0s0CTPFsA5yQqmjhzNu2S/z.O', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Niue', 'Buddhism', '2004-04-13', NULL, NULL, NULL, NULL, '2025-10-27 05:17:54', '2025-10-27 05:17:54', NULL),
(66, 'Dr. Zane Hane', 'student60@example.com', '2025-10-27 05:17:54', '$2y$12$z/vySvhbFCrWMAStrZxAEeSjrbt.4ThnzNfP/Rwm1wxYZm2jyO/DC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Grenada', 'Buddhism', '1970-11-30', NULL, NULL, NULL, NULL, '2025-10-27 05:17:54', '2025-10-27 05:17:54', NULL),
(67, 'Molly Prohaska', 'student61@example.com', '2025-10-27 05:17:54', '$2y$12$V.Y3.Tia842KuBxiM6NuzuvJkLjeo1D0UKQ6lS5di/8e/vfp4A8zG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Austria', 'Christianity', '1973-05-14', NULL, NULL, NULL, NULL, '2025-10-27 05:17:54', '2025-10-27 05:17:54', NULL),
(68, 'Vilma Schinner', 'student62@example.com', '2025-10-27 05:17:54', '$2y$12$Gz4BU3.XRTODADf/JpZPZe6qoQkN14hAxnJr26E2KD87h5aDP72z2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Maldives', 'Christianity', '2000-05-30', NULL, NULL, NULL, NULL, '2025-10-27 05:17:54', '2025-10-27 05:17:54', NULL),
(69, 'Mrs. Gracie Bernhard', 'student63@example.com', '2025-10-27 05:17:54', '$2y$12$D2J2QMyWfDW/Xdglmtnh1ehi7cJC6Ih5UAwV9wu.DhWdMIwWf96c6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Turkmenistan', 'Islam', '2009-04-24', NULL, NULL, NULL, NULL, '2025-10-27 05:17:54', '2025-10-27 05:17:54', NULL),
(70, 'Bonita O\'Conner', 'student64@example.com', '2025-10-27 05:17:54', '$2y$12$ts1n9N.prAyIrtlLZ2.Oxuv53VGwv9gTbv8t.Vj01VQfFfht/F09a', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Faroe Islands', 'Islam', '2007-03-16', NULL, NULL, NULL, NULL, '2025-10-27 05:17:54', '2025-10-27 05:17:54', NULL),
(71, 'Dr. Gerda Krajcik', 'student65@example.com', '2025-10-27 05:17:54', '$2y$12$VExc7PKIr3EKkZ9esAyyOOqRia9SZxnaF782NPPEnypUAvtX1U0o.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Antarctica (the territory South of 60 deg S)', 'Christianity', '2002-08-25', NULL, NULL, NULL, NULL, '2025-10-27 05:17:55', '2025-10-27 05:17:55', NULL),
(72, 'Miss Susana Bode', 'student66@example.com', '2025-10-27 05:17:55', '$2y$12$hvod.6y4CFRGzs4lPr2Kk.Vzc.EnDkMZEzvIdWKIQYe..p5LPiwWK', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Burkina Faso', 'Christianity', '1973-02-27', NULL, NULL, NULL, NULL, '2025-10-27 05:17:55', '2025-10-27 05:17:55', NULL),
(73, 'Cleve Orn', 'student67@example.com', '2025-10-27 05:17:55', '$2y$12$2AmV3u1LcfCwt2RSEAMrKuqkpFMujllI5qEc0Q3edAHeYWgRS3qxC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'South Africa', 'Hinduism', '2001-05-12', NULL, NULL, NULL, NULL, '2025-10-27 05:17:55', '2025-10-27 05:17:55', NULL),
(74, 'Elinor Schaefer', 'student68@example.com', '2025-10-27 05:17:55', '$2y$12$4vEDdY3TGtcSJ9Lu7eHzvuKI3yNc6N9vg9V4PT1hg.63cbZSFgsy2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Malta', 'Hinduism', '1986-05-21', NULL, NULL, NULL, NULL, '2025-10-27 05:17:55', '2025-10-27 05:17:55', NULL),
(75, 'Daphne Quitzon PhD', 'student69@example.com', '2025-10-27 05:17:55', '$2y$12$rHNr/NRX.bJNxHju/XPRtu6EM7adkuwvgPAUMDZ6a1OzKyoHq0976', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Maldives', 'Christianity', '1996-05-21', NULL, NULL, NULL, NULL, '2025-10-27 05:17:55', '2025-10-27 05:17:55', NULL),
(76, 'Aletha Orn DDS', 'student70@example.com', '2025-10-27 05:17:55', '$2y$12$YC0AN1Wul5J2rTJhklezJuiT63j18CnC9XqAuWw69kUUIuSab9T0G', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Poland', 'Islam', '2013-08-21', NULL, NULL, NULL, NULL, '2025-10-27 05:17:56', '2025-10-27 05:17:56', NULL),
(77, 'Lauretta Reichert', 'student71@example.com', '2025-10-27 05:17:56', '$2y$12$4336xSZN5OX3f2LNanmROOxB3dqLNwfp4AXbqNnYbjL75HIi3Bng6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Pitcairn Islands', 'Hinduism', '1997-09-25', NULL, NULL, NULL, NULL, '2025-10-27 05:17:56', '2025-10-27 05:17:56', NULL),
(78, 'Kallie Crist', 'student72@example.com', '2025-10-27 05:17:56', '$2y$12$tdxBLre5v8oqjjD5ARubmupDK3hF.cbezv1Sp4y3IGprMJXaU2vqi', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Saint Martin', 'Buddhism', '2013-03-31', NULL, NULL, NULL, NULL, '2025-10-27 05:17:56', '2025-10-27 05:17:56', NULL),
(79, 'Dr. Adelbert Mante Sr.', 'student73@example.com', '2025-10-27 05:17:56', '$2y$12$KHfbcZtexgKE0axNFc7IYerlZRp6/6zKl77XeYddPy.Jw1G1c37/C', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Guyana', 'Christianity', '2009-10-25', NULL, NULL, NULL, NULL, '2025-10-27 05:17:56', '2025-10-27 05:17:56', NULL),
(80, 'Alvera Smith', 'student74@example.com', '2025-10-27 05:17:56', '$2y$12$pIensnxrlGUtB/GTDowrt.RLeGVlLz7mS6TjglMCRO6I/ySm454wS', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Micronesia', 'Islam', '1991-12-02', NULL, NULL, NULL, NULL, '2025-10-27 05:17:56', '2025-10-27 05:17:56', NULL),
(81, 'Lee Mante', 'student75@example.com', '2025-10-27 05:17:56', '$2y$12$VxIU2uzduljd6EmlKe5DcuZDUVtnzh0OSbxq74QALVYRzgbyt62Ym', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Kenya', 'Buddhism', '1995-03-10', NULL, NULL, NULL, NULL, '2025-10-27 05:17:56', '2025-10-27 05:17:56', NULL),
(82, 'Ms. Adrianna Jacobson I', 'student76@example.com', '2025-10-27 05:17:56', '$2y$12$Yu79wVT2/8aVnMZt3jZ.HOGsg7vvh3EmNcMlBpDEA/aZ2IxM.x/Wy', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Ecuador', 'Christianity', '2018-02-27', NULL, NULL, NULL, NULL, '2025-10-27 05:17:57', '2025-10-27 05:17:57', NULL),
(83, 'Dr. Jakayla Koch', 'student77@example.com', '2025-10-27 05:17:57', '$2y$12$0mDRpzzxmaCrGjmezhae8.e.YinMI.MmNvcN3dnEqlcCNR0Ztk0rm', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'United Arab Emirates', 'Buddhism', '2002-01-12', NULL, NULL, NULL, NULL, '2025-10-27 05:17:57', '2025-10-27 05:17:57', NULL),
(84, 'Miss America Lakin Sr.', 'student78@example.com', '2025-10-27 05:17:57', '$2y$12$viJzGqzSTGdyzydyZ3bcW.2W0pQ9dLiwfxL1dK8zAoqKfDNIxG20i', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Bolivia', 'Islam', '1980-03-19', NULL, NULL, NULL, NULL, '2025-10-27 05:17:57', '2025-10-27 05:17:57', NULL),
(85, 'Kitty Kozey PhD', 'student79@example.com', '2025-10-27 05:17:57', '$2y$12$W2AnJHSgqjyej.k/xUOjbec5GB04e2B.SXCmkqd1IobkaCg8toxeq', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Serbia', 'Hinduism', '2018-09-09', NULL, NULL, NULL, NULL, '2025-10-27 05:17:57', '2025-10-27 05:17:57', NULL),
(86, 'Kraig Senger', 'student80@example.com', '2025-10-27 05:17:57', '$2y$12$VtgXQV/cZRIPYABrlfc2J.Qdya1Mx3Ut9bVy58z1v7YJudstvyadK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Lesotho', 'Buddhism', '1995-05-28', NULL, NULL, NULL, NULL, '2025-10-27 05:17:57', '2025-10-27 05:17:57', NULL),
(87, 'Ilene Schmeler Sr.', 'student81@example.com', '2025-10-27 05:17:57', '$2y$12$3ojdtGgo7Pgnf.5hrXxB/OVjmnZKX4eU5vVZnybSIDmLM7AhlvFE2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Seychelles', 'Buddhism', '2010-03-06', NULL, NULL, NULL, NULL, '2025-10-27 05:17:57', '2025-10-27 05:17:57', NULL),
(88, 'Meta Stiedemann', 'student82@example.com', '2025-10-27 05:17:57', '$2y$12$xrPWU7IKpffkYpZ/sbAWF.dOOjNdr9Kgv7e2yv69W4/bAnhLWDGwu', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'United States Virgin Islands', 'Christianity', '1981-09-19', NULL, NULL, NULL, NULL, '2025-10-27 05:17:58', '2025-10-27 05:17:58', NULL),
(89, 'Abel Howell', 'student83@example.com', '2025-10-27 05:17:58', '$2y$12$S0.eUaVM7CH7oBokoYmh3.pz1a0wwnXUaTXPvYCvXS6yb8V.s7KYK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Saint Pierre and Miquelon', 'Hinduism', '2012-04-28', NULL, NULL, NULL, NULL, '2025-10-27 05:17:58', '2025-10-27 05:17:58', NULL),
(90, 'Monica Bins', 'student84@example.com', '2025-10-27 05:17:58', '$2y$12$7PoLC13umk3uQTf8Vzn/a.PRxMWeFbNFUPNCLMh35pEdtqbxgySgK', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Kenya', 'Christianity', '1988-01-31', NULL, NULL, NULL, NULL, '2025-10-27 05:17:58', '2025-10-27 05:17:58', NULL),
(91, 'Ms. Emily Zboncak Jr.', 'student85@example.com', '2025-10-27 05:17:58', '$2y$12$72X5N/whe0K606qSAtsk3eyL681JdqAMtUCuC8afqDh0HhyydHFP6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Uganda', 'Christianity', '2019-07-01', NULL, NULL, NULL, NULL, '2025-10-27 05:17:58', '2025-10-27 05:17:58', NULL),
(92, 'Dr. Junior Boehm', 'student86@example.com', '2025-10-27 05:17:58', '$2y$12$OuY0iqjooQOhcujszHExouvQiw3az3eymsy.JHCgeuIGoplIdgtNu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Eritrea', 'Buddhism', '2025-04-20', NULL, NULL, NULL, NULL, '2025-10-27 05:17:58', '2025-10-27 05:17:58', NULL),
(93, 'Maximilian Heathcote', 'student87@example.com', '2025-10-27 05:17:58', '$2y$12$zc4dzCTGPnIuomE/kXVKd.xpFPKpqL.Hh7ScBfFsrewxYdM1yOPG6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Norway', 'Islam', '1994-07-01', NULL, NULL, NULL, NULL, '2025-10-27 05:17:58', '2025-10-27 05:17:58', NULL),
(94, 'Orin Abernathy', 'student88@example.com', '2025-10-27 05:17:58', '$2y$12$5rxO2RK1r2Smiu7KIUQYbuHth2UsyWLUXXjGl8iXdr60XmqyF0J.K', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Tanzania', 'Buddhism', '2010-12-28', NULL, NULL, NULL, NULL, '2025-10-27 05:17:59', '2025-10-27 05:17:59', NULL),
(95, 'Armand Bernier', 'student89@example.com', '2025-10-27 05:17:59', '$2y$12$uZohH9LzzV0jo9V.UmNgKuNkaZ/sJ5WGhpnCFXmMJnOWJr.hdDcnS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Seychelles', 'Christianity', '2000-11-24', NULL, NULL, NULL, NULL, '2025-10-27 05:17:59', '2025-10-27 05:17:59', NULL),
(96, 'Miss Karine Jaskolski DVM', 'student90@example.com', '2025-10-27 05:17:59', '$2y$12$qTmhsXZT.vNxwu1IRVwKP.CbLKLaSR2/9lsSNiN7gpIxdBiFsk5qO', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Saint Vincent and the Grenadines', 'Buddhism', '1993-10-04', NULL, NULL, NULL, NULL, '2025-10-27 05:17:59', '2025-10-27 05:17:59', NULL),
(97, 'Maggie Emard', 'student91@example.com', '2025-10-27 05:17:59', '$2y$12$tcN1qHTywxs6W.hWyVVAHumpx.Uqchf8RHwg3sPXQOQFFADuYN1ui', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Chad', 'Buddhism', '2019-01-20', NULL, NULL, NULL, NULL, '2025-10-27 05:17:59', '2025-10-27 05:17:59', NULL),
(98, 'Mercedes Thiel Sr.', 'student92@example.com', '2025-10-27 05:17:59', '$2y$12$ySJCxtqAOrLzXb6PEDedQOQQ2AbsHA8SjVVKlZTOSX/m6K0SqGSci', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Iceland', 'Hinduism', '2020-08-06', NULL, NULL, NULL, NULL, '2025-10-27 05:17:59', '2025-10-27 05:17:59', NULL),
(99, 'Dr. Eli Schneider', 'student93@example.com', '2025-10-27 05:17:59', '$2y$12$9S0y1v7wfF7L7RDshv7DO.pxXM7GjxQW0mvwnRjKTp1yqQSI3aMaO', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Indonesia', 'Christianity', '1983-10-25', NULL, NULL, NULL, NULL, '2025-10-27 05:17:59', '2025-10-27 05:17:59', NULL),
(100, 'Shaun Gerlach', 'student94@example.com', '2025-10-27 05:17:59', '$2y$12$M0JjqnxODBl43hgZfb38uO7cfa0WuLZW50blW7vHPDFbD9enDYttm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Russian Federation', 'Christianity', '1997-04-28', NULL, NULL, NULL, NULL, '2025-10-27 05:18:00', '2025-10-27 05:18:00', NULL),
(101, 'Prof. Janessa Walter III', 'student95@example.com', '2025-10-27 05:18:00', '$2y$12$1nWRnTcnutQ56hekpid2EuiKGvIZxOCoeSqwUHYgiWEWqSROhuqam', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Macao', 'Islam', '1991-05-18', NULL, NULL, NULL, NULL, '2025-10-27 05:18:00', '2025-10-27 05:18:00', NULL),
(102, 'Clemens Block PhD', 'student96@example.com', '2025-10-27 05:18:00', '$2y$12$nwRwQxiOHwYvP7Hlb9lHTey3qXz72xD6KqA6I34.V5KY6SUf6ZP0.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Georgia', 'Buddhism', '1993-03-18', NULL, NULL, NULL, NULL, '2025-10-27 05:18:00', '2025-10-27 05:18:00', NULL),
(103, 'Dr. Valentina Rodriguez PhD', 'student97@example.com', '2025-10-27 05:18:00', '$2y$12$ln5u14ThYQBGE9eOefHZU.dxqklDuc9N/n/6p8PsYsIWkLl7wLtze', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Saudi Arabia', 'Christianity', '1983-08-30', NULL, NULL, NULL, NULL, '2025-10-27 05:18:00', '2025-10-27 05:18:00', NULL),
(104, 'Jerrold Johnston', 'student98@example.com', '2025-10-27 05:18:00', '$2y$12$atk8PKAvQ6P8yxRahZYgc.W3.4LS.QI6Bly32mftIw1D04V65.y5a', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Namibia', 'Hinduism', '2003-09-11', NULL, NULL, NULL, NULL, '2025-10-27 05:18:00', '2025-10-27 05:18:00', NULL),
(105, 'Dr. Dana Bailey', 'student99@example.com', '2025-10-27 05:18:00', '$2y$12$6Qb.O2/ACEFVE/nbiqnZcOiH2vBfLhN8RwylkbiKz9sfoIWef1eVm', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Jamaica', 'Buddhism', '2012-07-30', NULL, NULL, NULL, NULL, '2025-10-27 05:18:00', '2025-10-27 05:18:00', NULL),
(106, 'Admin User', 'admin@example.com', '2025-10-27 05:18:01', '$2y$12$wXkZt6Xn9FPz/7IBeZMdGu2MSosHLVgz6C1l8BZNkzlt2tUIGlhgy', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-27 05:18:01', '2025-10-27 05:18:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_student_id_course_offering_id_date_unique` (`student_id`,`course_offering_id`,`date`),
  ADD KEY `attendances_course_offering_id_foreign` (`course_offering_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classrooms_room_number_unique` (`room_number`);

--
-- Indexes for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_offerings_subject_id_foreign` (`subject_id`),
  ADD KEY `course_offerings_student_id_foreign` (`student_id`),
  ADD KEY `course_offerings_classroom_id_foreign` (`classroom_id`);

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
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_category_id_foreign` (`expense_category_id`),
  ADD KEY `expenses_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expense_categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fee_structures`
--
ALTER TABLE `fee_structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_structures_grade_level_id_foreign` (`grade_level_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grades_student_id_exam_id_unique` (`student_id`,`exam_id`),
  ADD KEY `grades_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `grade_levels`
--
ALTER TABLE `grade_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grade_levels_code_unique` (`code`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `payments_student_fee_id_foreign` (`student_fee_id`),
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
  ADD PRIMARY KEY (`student_id`,`course_offering_id`),
  ADD KEY `student_course_course_offering_id_foreign` (`course_offering_id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_fees_student_id_foreign` (`student_id`),
  ADD KEY `student_fees_fee_structure_id_foreign` (`fee_structure_id`);

--
-- Indexes for table `student_guardian`
--
ALTER TABLE `student_guardian`
  ADD PRIMARY KEY (`student_id`,`guardian_id`),
  ADD KEY `student_guardian_guardian_id_foreign` (`guardian_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_code_unique` (`code`);

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
-- AUTO_INCREMENT for table `course_offerings`
--
ALTER TABLE `course_offerings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_structures`
--
ALTER TABLE `fee_structures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_levels`
--
ALTER TABLE `grade_levels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
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
  ADD CONSTRAINT `attendances_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD CONSTRAINT `course_offerings_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fee_structures`
--
ALTER TABLE `fee_structures`
  ADD CONSTRAINT `fee_structures_grade_level_id_foreign` FOREIGN KEY (`grade_level_id`) REFERENCES `grade_levels` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `payments_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `payments_student_fee_id_foreign` FOREIGN KEY (`student_fee_id`) REFERENCES `student_fees` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `student_course_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_course_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD CONSTRAINT `student_fees_fee_structure_id_foreign` FOREIGN KEY (`fee_structure_id`) REFERENCES `fee_structures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_guardian`
--
ALTER TABLE `student_guardian`
  ADD CONSTRAINT `student_guardian_guardian_id_foreign` FOREIGN KEY (`guardian_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_guardian_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
