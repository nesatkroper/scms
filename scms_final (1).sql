-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2025 at 05:04 AM
-- Server version: 8.0.44-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scms_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('attending','absence','permission') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `student_id`, `course_offering_id`, `date`, `status`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, '2025-11-29', 'attending', NULL, '2025-11-28 19:55:17', '2025-11-28 19:55:17', NULL),
(2, 4, 1, '2025-11-29', 'attending', NULL, '2025-11-28 19:55:17', '2025-11-28 19:55:17', NULL),
(3, 5, 1, '2025-11-29', 'permission', NULL, '2025-11-28 19:55:17', '2025-11-28 19:55:17', NULL),
(4, 6, 1, '2025-11-29', 'attending', NULL, '2025-11-28 19:55:17', '2025-11-28 19:55:17', NULL);

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
(1, 'Scott Curry', '657', 25, '2025-11-28 10:11:32', '2025-11-28 10:25:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE `course_offerings` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED DEFAULT NULL,
  `classroom_id` bigint UNSIGNED DEFAULT NULL,
  `time_slot` enum('morning','afternoon','evening') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'morning',
  `schedule` enum('mon-wed','mon-fri','wed-fri','sat-sun') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mon-fri',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `join_start` date DEFAULT NULL,
  `join_end` date DEFAULT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_type` enum('course','monthly') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'course',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_offerings`
--

INSERT INTO `course_offerings` (`id`, `subject_id`, `teacher_id`, `classroom_id`, `time_slot`, `schedule`, `start_time`, `end_time`, `join_start`, `join_end`, `fee`, `payment_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 'morning', 'wed-fri', '08:00:00', '10:00:00', '2025-06-30', '2026-01-26', 15.00, 'course', '2025-11-28 10:12:53', '2025-11-28 10:12:53', NULL),
(2, 1, 2, 1, 'evening', 'mon-fri', '09:22:00', '13:56:00', '2026-02-21', '2027-03-30', 15.00, 'monthly', '2025-11-28 22:01:06', '2025-11-28 22:01:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `grade_final` decimal(5,2) DEFAULT NULL,
  `status` enum('studying','suspended','dropped','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'studying',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_offering_id`, `grade_final`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 3, 1, NULL, 'studying', NULL, '2025-11-28 10:21:42', '2025-11-28 10:21:42'),
(3, 4, 1, NULL, 'studying', NULL, '2025-11-28 10:24:48', '2025-11-28 10:24:48'),
(4, 5, 1, NULL, 'studying', NULL, '2025-11-28 10:31:18', '2025-11-28 10:31:18'),
(5, 6, 1, NULL, 'studying', NULL, '2025-11-28 10:31:38', '2025-11-28 10:31:38'),
(6, 3, 2, NULL, 'studying', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('midterm','final','speaking','listening','reading','lab1','lab2','lab3','quiz1','quiz2','quiz3','homework1','homework2','homework3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `total_marks` int NOT NULL,
  `passing_marks` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `type`, `description`, `course_offering_id`, `date`, `total_marks`, `passing_marks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'final', 'Aliqua Praesentium', 1, '2026-06-09', 76, 38, '2025-11-28 10:57:32', '2025-11-28 10:57:32', NULL);

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
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `description`, `amount`, `date`, `expense_category_id`, `approved_by`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Electricity', 'លួចលុយ', 89.00, '2025-11-29', 1, 1, 1, '2025-11-28 21:22:18', '2025-11-28 21:22:35', NULL);

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
(1, 'Utility', 'Electriciry, ....', '2025-11-28 21:18:07', '2025-11-28 21:18:07', NULL),
(2, 'Payroll', 'Payroll of Teacher, ....', '2025-11-28 21:19:52', '2025-11-28 21:19:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `enrollment_id` bigint UNSIGNED NOT NULL,
  `fee_type_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `enrollment_id`, `fee_type_id`, `created_by`, `amount`, `due_date`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 3, 2, 2, 1, 15.00, NULL, NULL, '2025-11-28 10:21:42', '2025-11-28 10:21:42', NULL),
(3, 4, 3, 2, 1, 15.00, NULL, NULL, '2025-11-28 10:24:48', '2025-11-28 10:24:48', NULL),
(4, 5, 4, 2, 1, 15.00, NULL, NULL, '2025-11-28 10:31:18', '2025-11-28 10:31:18', NULL),
(5, 6, 5, 2, 1, 15.00, NULL, NULL, '2025-11-28 10:31:38', '2025-11-28 10:31:38', NULL),
(6, 3, 6, 2, 1, 15.00, '2026-02-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(7, 3, 6, 2, 1, 15.00, '2026-03-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(8, 3, 6, 2, 1, 15.00, '2026-04-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(9, 3, 6, 2, 1, 15.00, '2026-05-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(10, 3, 6, 2, 1, 15.00, '2026-06-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(11, 3, 6, 2, 1, 15.00, '2026-07-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(12, 3, 6, 2, 1, 15.00, '2026-08-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(13, 3, 6, 2, 1, 15.00, '2026-09-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(14, 3, 6, 2, 1, 15.00, '2026-10-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(15, 3, 6, 2, 1, 15.00, '2026-11-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(16, 3, 6, 2, 1, 15.00, '2026-12-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(17, 3, 6, 2, 1, 15.00, '2027-01-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(18, 3, 6, 2, 1, 15.00, '2027-02-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(19, 3, 6, 2, 1, 15.00, '2027-03-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL),
(20, 3, 6, 2, 1, 15.00, '2027-04-16', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Course Fee', 'Automatically generated fee type for course enrollment', '2025-11-28 10:21:42', '2025-11-28 10:21:42', NULL);

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
(3, '3_create_personal_access_tokens_table', 1),
(4, '4_create_permission_tables', 1),
(5, '2025_11_29_044028_add_payment_type_to_course_offerings_table', 2);

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
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('19d3a431-1be5-41c7-8c93-b2cb98c5f54d', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Scarlett Spears in Althea Kirkland\",\"body\":\"Scarlett Spears has successfully enrolled in the course \'Althea Kirkland\'. The fee is $15.00.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/students\\/enrollments\\/4\\/1\",\"date\":\"Nov 28, 2025 17:24 PM\"}', '2025-11-28 20:53:51', '2025-11-28 10:24:48', '2025-11-28 20:53:51'),
('33fff875-98af-4edd-bd0d-bb989d43dacc', 'App\\Notifications\\ExpenseCreated', 'App\\Models\\User', 1, '{\"title\":\"New Expense Submitted\",\"body\":\"A new expense of $89.00 was submitted for category: Utility\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expenses\\/1\"}', NULL, '2025-11-28 21:22:18', '2025-11-28 21:22:18'),
('4d866cfe-5721-487b-9341-52853a67c2d1', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #5\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/5\"}', NULL, '2025-11-28 10:33:03', '2025-11-28 10:33:03'),
('545129ac-1936-4c33-b4f7-9a12c629aff9', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #2\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/2\"}', NULL, '2025-11-28 10:33:38', '2025-11-28 10:33:38'),
('80434332-2526-43e4-906c-46e4f073c296', 'App\\Notifications\\CourseAssigned', 'App\\Models\\User', 2, '{\"title\":\"New Course Assigned: Althea Kirkland\",\"body\":\"You have been assigned to teach Althea Kirkland in room Scott Curry. Schedule: mon-fri (2025-11-29 09:22:00 - 2025-11-29 13:56:00).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/course_offerings\\/2\",\"start_date\":\"2026-02-21T00:00:00.000000Z\"}', NULL, '2025-11-28 22:01:06', '2025-11-28 22:01:06'),
('94698d7b-4814-4cc1-ba03-2aa85b064f12', 'App\\Notifications\\ExpenseCategoryModified', 'App\\Models\\User', 1, '{\"title\":\"Expense Category Created\",\"body\":\"The expense category \\\"Utility\\\" has been created.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expense_categories\\/1\",\"category_id\":1,\"action\":\"created\"}', NULL, '2025-11-28 21:18:07', '2025-11-28 21:18:07'),
('a8f69843-05e7-497e-9b6b-233a679fb03e', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #8\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/8\"}', NULL, '2025-11-28 22:03:06', '2025-11-28 22:03:06'),
('aa92dc92-b623-4c3e-b41a-16ec1586800c', 'App\\Notifications\\ExpenseCategoryModified', 'App\\Models\\User', 1, '{\"title\":\"Expense Category Created\",\"body\":\"The expense category \\\"Payroll\\\" has been created.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expense_categories\\/2\",\"category_id\":2,\"action\":\"created\"}', NULL, '2025-11-28 21:19:52', '2025-11-28 21:19:52'),
('aaa56fba-e3b5-4b33-bd52-bf124f2cd356', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #6\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/6\"}', NULL, '2025-11-28 22:02:53', '2025-11-28 22:02:53'),
('ac345496-582f-411b-8530-fa7c0dbf38dc', 'App\\Notifications\\CourseAssigned', 'App\\Models\\User', 2, '{\"title\":\"New Course Assigned: Althea Kirkland\",\"body\":\"You have been assigned to teach Althea Kirkland in room Scott Curry. Schedule: wed-fri (2025-11-28 08:00:00 - 2025-11-28 10:00:00).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/course_offerings\\/1\",\"start_date\":\"2025-06-30T00:00:00.000000Z\"}', NULL, '2025-11-28 10:12:53', '2025-11-28 10:12:53'),
('c16e2b44-d979-428c-b8be-178865bdfb2f', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #4\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/4\"}', NULL, '2025-11-28 10:59:04', '2025-11-28 10:59:04'),
('cb903e6d-afc0-4648-a415-a95c7fea3b9b', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #9\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/9\"}', NULL, '2025-11-28 22:03:10', '2025-11-28 22:03:10'),
('cc1158ea-ad80-4533-875d-6036b3435f69', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Joan Hale in Althea Kirkland\",\"body\":\"Joan Hale has successfully enrolled in the course \'Althea Kirkland\'. The fee is $15.00.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/students\\/enrollments\\/6\\/1\",\"date\":\"Nov 28, 2025 17:31 PM\"}', '2025-11-28 20:55:53', '2025-11-28 10:31:38', '2025-11-28 20:55:53'),
('cf46910f-ad3b-4231-92ed-7537d39e0565', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #3\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/3\"}', NULL, '2025-11-28 10:33:43', '2025-11-28 10:33:43'),
('d281a403-6f18-4458-ae8c-ed10fd361a7c', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #13\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/13\"}', NULL, '2025-11-28 22:03:01', '2025-11-28 22:03:01'),
('e6fd7140-b6ae-46ca-ac25-8643ae03cebb', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Clinton Vincent in Althea Kirkland\",\"body\":\"Clinton Vincent has successfully enrolled in the course \'Althea Kirkland\'. The fee is $15.00.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/3\\/2\",\"date\":\"Nov 29, 2025 05:01 AM\"}', NULL, '2025-11-28 22:01:17', '2025-11-28 22:01:17'),
('e992fec2-ab1a-4134-8a59-704ffa42ba6c', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $15.00 was received for Fee #7\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/7\"}', NULL, '2025-11-28 22:02:56', '2025-11-28 22:02:56'),
('f707f8be-9e18-4ce3-80a2-8e9731d7ab7b', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Cailin Vazquez in Althea Kirkland\",\"body\":\"Cailin Vazquez has successfully enrolled in the course \'Althea Kirkland\'. The fee is $15.00.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/students\\/enrollments\\/5\\/1\",\"date\":\"Nov 28, 2025 17:31 PM\"}', '2025-11-28 20:55:55', '2025-11-28 10:31:18', '2025-11-28 20:55:55');

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
  `fee_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `payment_date`, `payment_method`, `transaction_id`, `remarks`, `received_by`, `fee_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 15.00, '2025-11-28', 'Cash', 'SCMS-VLPR-1NHN-CKLI-TDG6', NULL, 1, 5, '2025-11-28 10:33:03', '2025-11-28 10:33:03', NULL),
(2, 15.00, '2025-11-28', 'Cash', 'SCMS-Y6SP-KZX8-M2CB-2ME8', NULL, 1, 2, '2025-11-28 10:33:38', '2025-11-28 10:33:38', NULL),
(3, 15.00, '2025-11-28', 'Cash', 'SCMS-AK66-2V7W-VEKN-TEBX', NULL, 1, 3, '2025-11-28 10:33:43', '2025-11-28 10:33:43', NULL),
(4, 15.00, '2025-11-28', 'Cash', 'SCMS-F9C9-6CO7-51JV-6PBC', NULL, 1, 4, '2025-11-28 10:59:03', '2025-11-28 10:59:03', NULL),
(5, 15.00, '2025-11-29', 'Cash', 'SCMS-LOHA-9MOP-R1HQ-HY3Z', NULL, 1, 6, '2025-11-28 22:02:53', '2025-11-28 22:02:53', NULL),
(6, 15.00, '2025-11-29', 'Cash', 'SCMS-FIOK-SW4O-8D4P-FHHX', NULL, 1, 7, '2025-11-28 22:02:56', '2025-11-28 22:02:56', NULL),
(7, 15.00, '2025-11-29', 'Cash', 'SCMS-C8IN-VLMS-LJ9B-S0UR', NULL, 1, 13, '2025-11-28 22:03:01', '2025-11-28 22:03:01', NULL),
(8, 15.00, '2025-11-29', 'Cash', 'SCMS-9LSU-8EPE-2LAK-TFTJ', NULL, 1, 8, '2025-11-28 22:03:06', '2025-11-28 22:03:06', NULL),
(9, 15.00, '2025-11-29', 'Cash', 'SCMS-UD64-T838-YBFD-FKQ4', NULL, 1, 9, '2025-11-28 22:03:10', '2025-11-28 22:03:10', NULL);

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
(1, 'create_attendance', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(2, 'view_attendance', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(3, 'update_attendance', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(4, 'delete_attendance', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(5, 'create_classroom', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(6, 'view_classroom', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(7, 'update_classroom', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(8, 'delete_classroom', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(9, 'create_course-offering', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(10, 'view_course-offering', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(11, 'update_course-offering', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(12, 'delete_course-offering', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(13, 'create_enrollment', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(14, 'view_enrollment', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(15, 'update_enrollment', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(16, 'delete_enrollment', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(17, 'create_exam', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(18, 'view_exam', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(19, 'update_exam', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(20, 'delete_exam', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(21, 'create_expense', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(22, 'view_expense', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(23, 'update_expense', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(24, 'delete_expense', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(25, 'create_expense-category', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(26, 'view_expense-category', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(27, 'update_expense-category', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(28, 'delete_expense-category', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(29, 'create_fee', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(30, 'view_fee', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(31, 'update_fee', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(32, 'delete_fee', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(33, 'create_fee-type', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(34, 'view_fee-type', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(35, 'update_fee-type', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(36, 'delete_fee-type', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(37, 'create_payment', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(38, 'view_payment', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(39, 'update_payment', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(40, 'delete_payment', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(41, 'create_score', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(42, 'view_score', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(43, 'update_score', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(44, 'delete_score', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(45, 'create_subject', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(46, 'view_subject', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(47, 'update_subject', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(48, 'delete_subject', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(49, 'create_user', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(50, 'view_user', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(51, 'update_user', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(52, 'delete_user', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(53, 'create_role', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(54, 'view_role', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(55, 'update_role', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(56, 'delete_role', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(57, 'create_permission', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(58, 'view_permission', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(59, 'update_permission', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(60, 'delete_permission', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(61, 'create_teacher', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(62, 'view_teacher', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(63, 'update_teacher', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(64, 'delete_teacher', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(65, 'create_student', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(66, 'view_student', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(67, 'update_student', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(68, 'delete_student', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21');

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
(1, 'admin', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(2, 'teacher', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(3, 'student', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21'),
(4, 'staff', 'web', '2025-11-28 10:10:21', '2025-11-28 10:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
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
('VAIoZf3fmWIxeXjdGVg0q8CQcD7VP20OIAOLDDbl', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUlnVlh3MzFHUU1uWk5mc3dEOGxYa2lzM014Nk9kOFNRbHZNU3psZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODEwMi9hZG1pbi9ub3RpZmljYXRpb25zIjtzOjU6InJvdXRlIjtzOjI1OiJhZG1pbi5ub3RpZmljYXRpb25zLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764392608);

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
(1, 'Althea Kirkland', 'Nulla est minima qu', 'Tempora est sit solu', 57, '2025-11-28 10:11:45', '2025-11-28 10:11:45', NULL);

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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `date_of_birth`, `gender`, `joining_date`, `qualification`, `experience`, `specialization`, `salary`, `cv`, `blood_group`, `nationality`, `religion`, `admission_date`, `occupation`, `company`, `avatar`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2025-11-28 10:32:04', '$2y$12$xeh5hto7h/j.ve/DqCKMPuOvvx00xFJMAL2bYKtCAEZOtlCl5/GEC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-28 10:10:21', '2025-11-28 10:32:04', NULL),
(2, 'Bree Anderson', 'zysanaxuv@mailinator.com', NULL, '$2y$12$r9fW66vcZ7jm2KPPwTLmpeZKo6FKN3DY/XJi52GgHzqBXaPNki/va', '+1 (184) 768-3738', 'Aut aliquid sed aliq', '2014-10-09', 'other', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Similique laboris li', 'Quas enim enim aut a', NULL, NULL, NULL, NULL, NULL, '2025-11-28 10:12:02', '2025-11-28 10:12:02', NULL),
(3, 'Clinton Vincent', 'syjywe@mailinator.com', NULL, '$2y$12$IxYh6YfXVF44clUdRlObWeyuveaSVPHqmqqmtqzjSPAcjR10hrzaG', '+1 (701) 981-1282', 'Occaecat aut aut rep', '1990-07-28', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Est eiusmod nemo eo', 'Molestiae fugiat do', NULL, NULL, NULL, NULL, NULL, '2025-11-28 10:18:58', '2025-11-28 10:18:58', NULL),
(4, 'Scarlett Spears', 'guwoduz@mailinator.com', NULL, '$2y$12$2NKZMXkcVVJeC.awZR.JZurF4d5WDtpQWiqujTSr/AZx/z.KW.Ej2', '+1 (611) 459-4858', 'Quia adipisci enim c', '1999-03-06', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Nostrud aliquip fugi', 'Magna consequatur o', NULL, NULL, NULL, NULL, NULL, '2025-11-28 10:19:07', '2025-11-28 10:19:07', NULL),
(5, 'Cailin Vazquez', 'rowu@mailinator.com', NULL, '$2y$12$K.NzHO3GYTBDNu3sYTUdce5ioPmpQKfkKbVbHDkEwle2qvVn482oq', '+1 (323) 895-7487', 'Consequatur Minus q', '1979-04-08', 'other', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Recusandae Non vita', 'Ea ipsa sit deseru', NULL, NULL, NULL, NULL, NULL, '2025-11-28 10:31:02', '2025-11-28 10:31:02', NULL),
(6, 'Joan Hale', 'tuwuvab@mailinator.com', NULL, '$2y$12$IVwfjKjvMto3T530.bjC/OJornVqhAAAWah2I808wcvrcXa4MfOr6', '+1 (901) 292-6741', 'Adipisicing debitis', '1984-02-04', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Voluptas sed laborum', 'Quo dolor facere con', NULL, NULL, NULL, NULL, NULL, '2025-11-28 10:31:08', '2025-11-28 10:31:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_unique_idx` (`student_id`,`course_offering_id`,`date`),
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
  ADD KEY `course_offerings_teacher_id_foreign` (`teacher_id`),
  ADD KEY `course_offerings_classroom_id_foreign` (`classroom_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enrollments_student_id_course_offering_id_unique` (`student_id`,`course_offering_id`),
  ADD KEY `enrollments_course_offering_id_foreign` (`course_offering_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_course_offering_id_foreign` (`course_offering_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_category_id_foreign` (`expense_category_id`),
  ADD KEY `expenses_approved_by_foreign` (`approved_by`),
  ADD KEY `expenses_created_by_foreign` (`created_by`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expense_categories_name_unique` (`name`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_student_id_foreign` (`student_id`),
  ADD KEY `fees_enrollment_id_foreign` (`enrollment_id`),
  ADD KEY `fees_fee_type_id_foreign` (`fee_type_id`),
  ADD KEY `fees_created_by_foreign` (`created_by`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fee_types_name_unique` (`name`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
  ADD KEY `payments_received_by_foreign` (`received_by`),
  ADD KEY `payments_fee_id_foreign` (`fee_id`);

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
  ADD UNIQUE KEY `scores_student_id_exam_id_unique` (`student_id`,`exam_id`),
  ADD KEY `scores_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_offerings`
--
ALTER TABLE `course_offerings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`),
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD CONSTRAINT `course_offerings_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `course_offerings_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fees_enrollment_id_foreign` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_fee_type_id_foreign` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `payments_fee_id_foreign` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `scores_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
