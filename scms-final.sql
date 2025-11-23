-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2025 at 04:57 PM
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
-- Database: `scms-final`
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
(1, 'Room A', 'A101', 30, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 'Room B', 'B201', 40, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 'Room C', 'C301', 25, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_offerings`
--

INSERT INTO `course_offerings` (`id`, `subject_id`, `teacher_id`, `classroom_id`, `time_slot`, `schedule`, `start_time`, `end_time`, `join_start`, `join_end`, `fee`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 2, 'morning', 'mon-fri', '08:00:00', '10:00:00', '2025-11-13', '2025-12-23', 4528.00, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 2, 6, 1, 'morning', 'mon-fri', '08:00:00', '10:00:00', '2025-11-13', '2025-12-23', 2124.00, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 3, 2, 2, 'morning', 'mon-fri', '08:00:00', '10:00:00', '2025-11-13', '2025-12-23', 1355.00, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 4, 3, 2, 'morning', 'mon-fri', '08:00:00', '10:00:00', '2025-11-13', '2025-12-23', 3243.00, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(5, 5, 6, 3, 'morning', 'mon-fri', '08:00:00', '10:00:00', '2025-11-13', '2025-12-23', 4629.00, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('lab','quiz','homework1','homework2','homework3','midterm','final') COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'midterm', 'Midterm exam for course offering 1', 1, '2025-12-07', 100, 50, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 'midterm', 'Midterm exam for course offering 2', 2, '2025-12-07', 100, 50, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 'midterm', 'Midterm exam for course offering 3', 3, '2025-12-07', 100, 50, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 'midterm', 'Midterm exam for course offering 4', 4, '2025-12-07', 100, 50, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(5, 'midterm', 'Midterm exam for course offering 5', 5, '2025-12-07', 100, 50, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

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
(1, 'Expense 0', 'Description for expense 0', 261.00, '2025-11-04', 1, 13, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 'Expense 1', 'Description for expense 1', 181.00, '2025-11-23', 3, 41, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 'Expense 2', 'Description for expense 2', 453.00, '2025-11-01', 2, 18, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 'Expense 3', 'Description for expense 3', 81.00, '2025-11-15', 1, 5, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(5, 'Expense 4', 'Description for expense 4', 166.00, '2025-11-15', 1, 15, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(6, 'Expense 5', 'Description for expense 5', 500.00, '2025-11-02', 1, 17, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(7, 'Expense 6', 'Description for expense 6', 194.00, '2025-11-03', 1, 11, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(8, 'Expense 7', 'Description for expense 7', 272.00, '2025-11-04', 2, 48, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(9, 'Expense 8', 'Description for expense 8', 268.00, '2025-11-16', 2, 2, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(10, 'Expense 9', 'Description for expense 9', 163.00, '2025-11-15', 1, 39, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(11, 'Expense 10', 'Description for expense 10', 113.00, '2025-11-18', 1, 26, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(12, 'Expense 11', 'Description for expense 11', 300.00, '2025-11-13', 1, 38, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(13, 'Expense 12', 'Description for expense 12', 132.00, '2025-11-12', 3, 11, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(14, 'Expense 13', 'Description for expense 13', 286.00, '2025-10-24', 3, 9, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(15, 'Expense 14', 'Description for expense 14', 482.00, '2025-11-12', 2, 34, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(16, 'Expense 15', 'Description for expense 15', 258.00, '2025-11-13', 2, 2, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(17, 'Expense 16', 'Description for expense 16', 116.00, '2025-11-03', 2, 50, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(18, 'Expense 17', 'Description for expense 17', 421.00, '2025-11-16', 1, 38, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(19, 'Expense 18', 'Description for expense 18', 459.00, '2025-11-07', 3, 25, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(20, 'Expense 19', 'Description for expense 19', 400.00, '2025-11-22', 3, 22, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

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
(1, 'Maintenance', 'Maintenance expenses', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 'Utilities', 'Utilities expenses', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 'Events', 'Events expenses', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 'Supplies', 'Supplies expenses', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `fee_type_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `status` enum('unpaid','partially_paid','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `fee_type_id`, `created_by`, `amount`, `due_date`, `paid_date`, `status`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 3, NULL, 936.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 7, 2, NULL, 707.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 7, 4, NULL, 584.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 7, 1, NULL, 895.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(5, 8, 3, NULL, 502.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(6, 8, 2, NULL, 367.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(7, 8, 4, NULL, 590.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(8, 8, 1, NULL, 824.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(9, 9, 3, NULL, 955.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(10, 9, 2, NULL, 608.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(11, 9, 4, NULL, 308.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(12, 9, 1, NULL, 478.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(13, 10, 3, NULL, 884.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(14, 10, 2, NULL, 382.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(15, 10, 4, NULL, 146.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(16, 10, 1, NULL, 362.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(17, 11, 3, NULL, 622.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(18, 11, 2, NULL, 485.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(19, 11, 4, NULL, 138.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(20, 11, 1, NULL, 645.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(21, 12, 3, NULL, 325.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(22, 12, 2, NULL, 215.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(23, 12, 4, NULL, 316.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(24, 12, 1, NULL, 464.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(25, 13, 3, NULL, 765.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(26, 13, 2, NULL, 528.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(27, 13, 4, NULL, 566.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(28, 13, 1, NULL, 408.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(29, 14, 3, NULL, 244.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(30, 14, 2, NULL, 441.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(31, 14, 4, NULL, 694.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(32, 14, 1, NULL, 916.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(33, 15, 3, NULL, 791.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(34, 15, 2, NULL, 513.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(35, 15, 4, NULL, 966.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(36, 15, 1, NULL, 498.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(37, 16, 3, NULL, 519.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(38, 16, 2, NULL, 163.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(39, 16, 4, NULL, 918.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(40, 16, 1, NULL, 610.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(41, 17, 3, NULL, 796.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(42, 17, 2, NULL, 990.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(43, 17, 4, NULL, 501.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(44, 17, 1, NULL, 291.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(45, 18, 3, NULL, 719.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(46, 18, 2, NULL, 298.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(47, 18, 4, NULL, 239.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(48, 18, 1, NULL, 883.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(49, 19, 3, NULL, 260.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(50, 19, 2, NULL, 403.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(51, 19, 4, NULL, 874.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(52, 19, 1, NULL, 512.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(53, 20, 3, NULL, 827.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(54, 20, 2, NULL, 459.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(55, 20, 4, NULL, 952.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(56, 20, 1, NULL, 719.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(57, 21, 3, NULL, 335.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(58, 21, 2, NULL, 590.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(59, 21, 4, NULL, 677.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(60, 21, 1, NULL, 642.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(61, 22, 3, NULL, 549.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(62, 22, 2, NULL, 869.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(63, 22, 4, NULL, 991.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(64, 22, 1, NULL, 320.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(65, 23, 3, NULL, 373.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(66, 23, 2, NULL, 854.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(67, 23, 4, NULL, 341.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(68, 23, 1, NULL, 245.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(69, 24, 3, NULL, 849.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(70, 24, 2, NULL, 642.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(71, 24, 4, NULL, 978.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(72, 24, 1, NULL, 697.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(73, 25, 3, NULL, 953.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(74, 25, 2, NULL, 507.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(75, 25, 4, NULL, 614.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(76, 25, 1, NULL, 477.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(77, 26, 3, NULL, 495.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(78, 26, 2, NULL, 805.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(79, 26, 4, NULL, 970.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(80, 26, 1, NULL, 462.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(81, 27, 3, NULL, 268.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(82, 27, 2, NULL, 150.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(83, 27, 4, NULL, 296.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(84, 27, 1, NULL, 465.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(85, 28, 3, NULL, 264.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(86, 28, 2, NULL, 775.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(87, 28, 4, NULL, 593.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(88, 28, 1, NULL, 142.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(89, 29, 3, NULL, 727.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(90, 29, 2, NULL, 604.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(91, 29, 4, NULL, 690.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(92, 29, 1, NULL, 917.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(93, 30, 3, NULL, 186.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(94, 30, 2, NULL, 289.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(95, 30, 4, NULL, 758.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(96, 30, 1, NULL, 557.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(97, 31, 3, NULL, 892.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(98, 31, 2, NULL, 405.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(99, 31, 4, NULL, 718.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(100, 31, 1, NULL, 196.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(101, 32, 3, NULL, 374.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(102, 32, 2, NULL, 152.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(103, 32, 4, NULL, 503.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(104, 32, 1, NULL, 592.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(105, 33, 3, NULL, 400.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(106, 33, 2, NULL, 245.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(107, 33, 4, NULL, 807.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(108, 33, 1, NULL, 656.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(109, 34, 3, NULL, 935.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(110, 34, 2, NULL, 782.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(111, 34, 4, NULL, 708.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(112, 34, 1, NULL, 521.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(113, 35, 3, NULL, 967.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(114, 35, 2, NULL, 284.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(115, 35, 4, NULL, 438.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(116, 35, 1, NULL, 825.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(117, 36, 3, NULL, 230.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(118, 36, 2, NULL, 127.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(119, 36, 4, NULL, 563.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(120, 36, 1, NULL, 312.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(121, 37, 3, NULL, 745.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(122, 37, 2, NULL, 497.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(123, 37, 4, NULL, 631.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(124, 37, 1, NULL, 127.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(125, 38, 3, NULL, 618.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(126, 38, 2, NULL, 723.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(127, 38, 4, NULL, 703.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(128, 38, 1, NULL, 773.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(129, 39, 3, NULL, 228.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(130, 39, 2, NULL, 967.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(131, 39, 4, NULL, 719.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(132, 39, 1, NULL, 665.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(133, 40, 3, NULL, 926.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(134, 40, 2, NULL, 734.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(135, 40, 4, NULL, 156.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(136, 40, 1, NULL, 924.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(137, 41, 3, NULL, 302.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(138, 41, 2, NULL, 643.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(139, 41, 4, NULL, 253.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(140, 41, 1, NULL, 360.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(141, 42, 3, NULL, 284.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(142, 42, 2, NULL, 932.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(143, 42, 4, NULL, 949.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(144, 42, 1, NULL, 210.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(145, 43, 3, NULL, 804.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(146, 43, 2, NULL, 486.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(147, 43, 4, NULL, 212.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(148, 43, 1, NULL, 490.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(149, 44, 3, NULL, 446.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(150, 44, 2, NULL, 315.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(151, 44, 4, NULL, 877.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(152, 44, 1, NULL, 366.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(153, 45, 3, NULL, 414.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(154, 45, 2, NULL, 793.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(155, 45, 4, NULL, 172.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(156, 45, 1, NULL, 855.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(157, 46, 3, NULL, 663.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(158, 46, 2, NULL, 170.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(159, 46, 4, NULL, 332.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(160, 46, 1, NULL, 423.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(161, 47, 3, NULL, 479.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(162, 47, 2, NULL, 215.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(163, 47, 4, NULL, 668.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(164, 47, 1, NULL, 355.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(165, 48, 3, NULL, 307.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(166, 48, 2, NULL, 795.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(167, 48, 4, NULL, 269.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(168, 48, 1, NULL, 584.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(169, 49, 3, NULL, 612.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(170, 49, 2, NULL, 378.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(171, 49, 4, NULL, 110.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(172, 49, 1, NULL, 581.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(173, 50, 3, NULL, 556.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(174, 50, 2, NULL, 544.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(175, 50, 4, NULL, 671.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(176, 50, 1, NULL, 804.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(177, 51, 3, NULL, 209.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(178, 51, 2, NULL, 522.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(179, 51, 4, NULL, 910.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(180, 51, 1, NULL, 268.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(181, 52, 3, NULL, 635.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(182, 52, 2, NULL, 378.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(183, 52, 4, NULL, 734.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(184, 52, 1, NULL, 559.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(185, 53, 3, NULL, 416.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(186, 53, 2, NULL, 334.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(187, 53, 4, NULL, 132.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(188, 53, 1, NULL, 943.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(189, 54, 3, NULL, 446.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(190, 54, 2, NULL, 602.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(191, 54, 4, NULL, 360.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(192, 54, 1, NULL, 237.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(193, 55, 3, NULL, 245.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(194, 55, 2, NULL, 729.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(195, 55, 4, NULL, 341.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(196, 55, 1, NULL, 801.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(197, 56, 3, NULL, 630.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(198, 56, 2, NULL, 318.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(199, 56, 4, NULL, 238.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(200, 56, 1, NULL, 611.00, '2025-12-23', NULL, 'unpaid', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

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
(1, 'Tuition', 'Tuition fee', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 'Library', 'Library fee', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 'Lab', 'Lab fee', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 'Sports', 'Sports fee', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

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
(4, '4_create_permission_tables', 1);

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
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
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
(3, 'App\\Models\\User', 56);

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
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `received_by` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `fee_id` bigint UNSIGNED DEFAULT NULL,
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
(1, 'create attendance', 'web', '2025-11-23 03:56:10', '2025-11-23 03:56:10'),
(2, 'view attendance', 'web', '2025-11-23 03:56:10', '2025-11-23 03:56:10'),
(3, 'update attendance', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(4, 'delete attendance', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(5, 'create classroom', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(6, 'view classroom', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(7, 'update classroom', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(8, 'delete classroom', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(9, 'create course-offering', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(10, 'view course-offering', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(11, 'update course-offering', 'web', '2025-11-23 03:56:11', '2025-11-23 03:56:11'),
(12, 'delete course-offering', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(13, 'create exam', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(14, 'view exam', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(15, 'update exam', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(16, 'delete exam', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(17, 'create expense', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(18, 'view expense', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(19, 'update expense', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(20, 'delete expense', 'web', '2025-11-23 03:56:12', '2025-11-23 03:56:12'),
(21, 'create expense-category', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(22, 'view expense-category', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(23, 'update expense-category', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(24, 'delete expense-category', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(25, 'create fee', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(26, 'view fee', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(27, 'update fee', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(28, 'delete fee', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(29, 'create fee-type', 'web', '2025-11-23 03:56:13', '2025-11-23 03:56:13'),
(30, 'view fee-type', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(31, 'update fee-type', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(32, 'delete fee-type', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(33, 'create payment', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(34, 'view payment', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(35, 'update payment', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(36, 'delete payment', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(37, 'create score', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(38, 'view score', 'web', '2025-11-23 03:56:14', '2025-11-23 03:56:14'),
(39, 'update score', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(40, 'delete score', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(41, 'create student-course', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(42, 'view student-course', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(43, 'update student-course', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(44, 'delete student-course', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(45, 'create subject', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(46, 'view subject', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(47, 'update subject', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(48, 'delete subject', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(49, 'create teacher-subject', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(50, 'view teacher-subject', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(51, 'update teacher-subject', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(52, 'delete teacher-subject', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(53, 'create user', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(54, 'view user', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(55, 'update user', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(56, 'delete user', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(57, 'create role', 'web', '2025-11-23 07:14:09', '2025-11-23 07:14:09'),
(58, 'view role', 'web', '2025-11-23 07:14:09', '2025-11-23 07:14:09'),
(59, 'update role', 'web', '2025-11-23 07:14:09', '2025-11-23 07:14:09'),
(60, 'delete role', 'web', '2025-11-23 07:14:09', '2025-11-23 07:14:09');

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
(1, 'admin', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(2, 'teacher', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(3, 'student', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15'),
(5, 'staff', 'web', '2025-11-23 03:56:15', '2025-11-23 03:56:15');

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
(60, 1);

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
('39cCheBRTPapYuwoyJ6ggy3dPZnpq96nO3y7DuNR', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUEdVUzhuV2VBSndXVlVyakVNeGU5b2k0VjVJMG1GdFMwblhaQmludiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODEwMi9hZG1pbi91c2VycyI7czo1OiJyb3V0ZSI7czoxNzoiYWRtaW4udXNlcnMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2Mzg5NTQwMzt9fQ==', 1763896005),
('BHAVzoDRfqPYaLcu4BHrQDLIWGozNWOR9XB0lXEH', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVTM1NElrSjdmYWV2b3NjUUhqdWZBVTd1cjIxVGtkd2lpZTh0NzluQiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjY0OiJodHRwOi8vMTI3LjAuMC4xOjgxMDIvYWRtaW4vc3R1ZGVudF9jb3Vyc2VzP2NvdXJzZV9vZmZlcmluZ19pZD0xIjtzOjU6InJvdXRlIjtzOjI3OiJhZG1pbi5zdHVkZW50X2NvdXJzZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2MzkwNjQ0NTt9fQ==', 1763916911);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `grade_final` decimal(5,2) DEFAULT NULL,
  `status` enum('studying','suspended','dropped','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'studying',
  `payment_status` enum('pending','paid','overdue','free') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `course_offering_id`, `grade_final`, `status`, `payment_status`, `remarks`, `created_at`, `updated_at`) VALUES
(7, 3, 83.44, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(7, 4, 90.08, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(7, 5, 70.74, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(8, 3, 98.63, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(8, 4, 61.13, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(8, 5, 66.55, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(9, 2, 60.69, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(9, 4, 68.07, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(9, 5, 65.39, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(10, 1, 90.99, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(10, 2, 81.95, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(10, 5, 96.92, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(11, 1, 84.95, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(11, 2, 78.47, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(11, 3, 86.51, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(12, 2, 98.11, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(12, 3, 76.09, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(12, 4, 99.82, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(13, 1, 82.85, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(13, 2, 82.35, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(13, 5, 95.91, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(14, 2, 77.40, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(14, 3, 93.24, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(14, 4, 69.02, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(15, 2, 87.76, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(15, 3, 65.34, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(15, 5, 75.45, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(16, 2, 66.89, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(16, 3, 91.48, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(16, 4, 70.00, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(17, 2, 80.61, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(17, 3, 64.25, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(17, 5, 70.93, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(18, 1, 99.43, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(18, 4, 87.19, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(18, 5, 62.74, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(19, 1, 64.80, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(19, 4, 99.34, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(19, 5, 87.04, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(20, 3, 86.66, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(20, 4, 95.59, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(20, 5, 82.35, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(21, 1, 74.54, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(21, 4, 95.10, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(21, 5, 93.96, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(22, 1, 61.71, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(22, 2, 86.45, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(22, 5, 90.99, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(23, 3, 75.41, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(23, 4, 98.86, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(23, 5, 66.10, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(24, 1, 72.86, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(24, 2, 71.50, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(24, 4, 84.98, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(25, 2, 85.04, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(25, 3, 95.07, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(25, 4, 73.43, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(26, 1, 94.93, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(26, 2, 79.33, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(26, 5, 70.49, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(27, 3, 76.64, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(27, 4, 69.33, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(27, 5, 63.48, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(28, 2, 74.56, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(28, 4, 65.55, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(28, 5, 67.72, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(29, 2, 62.07, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(29, 4, 90.35, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(29, 5, 92.64, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(30, 1, 94.60, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(30, 2, 63.65, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(30, 5, 71.45, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(31, 1, 71.12, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(31, 4, 98.06, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(31, 5, 93.94, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(32, 2, 63.82, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(32, 4, 88.59, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(32, 5, 75.89, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(33, 2, 65.28, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(33, 3, 90.62, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(33, 5, 60.43, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(34, 1, 87.39, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(34, 2, 75.92, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(34, 5, 76.02, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(35, 1, 78.52, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(35, 4, 86.21, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(35, 5, 94.08, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(36, 1, 99.27, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(36, 2, 67.88, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(36, 3, 69.74, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(37, 1, 93.25, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(37, 2, 62.48, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(37, 5, 78.13, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(38, 2, 66.48, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(38, 4, 77.61, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(38, 5, 98.71, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(39, 3, 69.74, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(39, 4, 65.70, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(39, 5, 99.74, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(40, 2, 94.47, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(40, 3, 70.66, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(40, 4, 60.88, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(41, 3, 73.77, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(41, 4, 77.17, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(41, 5, 75.41, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(42, 1, 87.15, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(42, 3, 81.86, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(42, 4, 93.12, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(43, 3, 76.59, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(43, 4, 78.79, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(43, 5, 91.18, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(44, 1, 65.11, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(44, 3, 76.66, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(44, 5, 80.54, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(45, 1, 92.66, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(45, 2, 68.05, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(45, 4, 89.05, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(46, 1, 68.52, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(46, 2, 81.35, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(46, 3, 88.94, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(47, 1, 65.98, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(47, 2, 84.17, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(47, 3, 85.27, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(48, 1, 84.81, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(48, 4, 93.57, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(48, 5, 92.55, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(49, 1, 77.65, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(49, 2, 91.94, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(49, 3, 74.10, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(50, 1, 76.53, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(50, 3, 66.45, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(50, 4, 82.00, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(51, 1, 92.72, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(51, 2, 83.07, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(51, 5, 70.91, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(52, 2, 74.56, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(52, 3, 64.67, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(52, 5, 73.80, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(53, 1, 82.79, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(53, 3, 65.88, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(53, 5, 71.22, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(54, 3, 62.68, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(54, 4, 97.33, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(54, 5, 79.39, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(55, 2, 86.19, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(55, 3, 88.60, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(55, 4, 70.77, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(56, 3, 86.26, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(56, 4, 71.24, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(56, 5, 89.69, 'studying', 'pending', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28');

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
(1, 'Introduction to Programming', 'CS101', 'Introduction to Programming course description.', 3, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 'Data Structures', 'CS202', 'Data Structures course description.', 4, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 'British Literature', 'ENGL250', 'British Literature course description.', 3, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 'Creative Writing', 'ENGL301', 'Creative Writing course description.', 3, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(5, 'Calculus I', 'MATH150', 'Calculus I course description.', 4, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

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
(1, 'Admin User', 'admin@example.com', '2025-11-23 03:56:15', '$2y$12$8KSkfrAsJ3hOa6E1e1zHHeu57YZrNZX18c8./R.9iFpdyW9WJB8D2', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-23 03:56:15', '2025-11-23 03:56:15', NULL),
(2, 'Alice Farrell', 'teacher0@example.com', '2025-11-23 03:56:15', '$2y$12$eoiDLY2lnwcN3xQbZ29jmOhas2anGDTeP7cLGW9.oi19ITA3kex7.', NULL, NULL, NULL, 'female', '1997-03-12', 'Bachelor', '3 years', 'Literature', 55877.77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-23 03:56:15', '2025-11-23 03:56:15', NULL),
(3, 'Stella Howe', 'teacher1@example.com', '2025-11-23 03:56:16', '$2y$12$57YSP3L1Tr4vxc7FDBeukunQMFMa0q/vyTnWiGiuflOpp/nb3EtKq', NULL, NULL, NULL, 'female', '1981-06-20', 'PhD', '10 years', 'Science', 66962.42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-23 03:56:16', '2025-11-23 03:56:16', NULL),
(4, 'Dee Ward PhD', 'teacher2@example.com', '2025-11-23 03:56:16', '$2y$12$BKU36zSBxkXKynNCjYHZ9u5r8rfqCtdtDc13/MMny6.86m.pi65Se', NULL, NULL, NULL, 'male', '1985-03-17', 'PhD', '3 years', 'Science', 49347.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-23 03:56:16', '2025-11-23 03:56:16', NULL),
(5, 'Pink Bradtke', 'teacher3@example.com', '2025-11-23 03:56:16', '$2y$12$uDTqbTGAV8v91kqeby7jjOsYFKlNv0nC.AhKynjVIWLahHGSe9Qqu', NULL, NULL, NULL, 'female', '1983-10-17', 'Bachelor', '3 years', 'Literature', 62421.92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-23 03:56:16', '2025-11-23 03:56:16', NULL),
(6, 'Frank Gerlach', 'teacher4@example.com', '2025-11-23 03:56:16', '$2y$12$Qi0m90..rpHCSIknXMwRAedgF1rlfAdKeV9Mq8g.OoyOyd3/IWVeu', NULL, NULL, NULL, 'male', '2019-09-18', 'Bachelor', '3 years', 'Science', 60216.63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-23 03:56:16', '2025-11-23 03:56:16', NULL),
(7, 'Prof. Vanessa Windler I', 'student0@example.com', '2025-11-23 03:56:17', '$2y$12$aoGb7zeqj9jPLOsvQwaAVejD/Hv4d152AbI2Rd5sq6AWllr5umW6.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Hungary', 'Islam', '1993-12-07', NULL, NULL, NULL, NULL, '2025-11-23 03:56:17', '2025-11-23 03:56:17', NULL),
(8, 'Pascale Stoltenberg', 'student1@example.com', '2025-11-23 03:56:17', '$2y$12$9m1bKXqYoH10noeRDhPmJ.QBDpkajHiT7p4jhTUZJaDtU9yMHPQxm', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Reunion', 'Christianity', '2022-02-22', NULL, NULL, NULL, NULL, '2025-11-23 03:56:17', '2025-11-23 03:56:17', NULL),
(9, 'Ardith McCullough', 'student2@example.com', '2025-11-23 03:56:17', '$2y$12$YHd1CEWRqQ6TxbGT85Q0FuXlZtvS7b/0fD2nl5y/30tGzW7fOkeNC', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Equatorial Guinea', 'Islam', '1989-10-29', NULL, NULL, NULL, NULL, '2025-11-23 03:56:17', '2025-11-23 03:56:17', NULL),
(10, 'Charity Daniel', 'student3@example.com', '2025-11-23 03:56:17', '$2y$12$T7PTz7ZDPKHWlSFmGr5oHu32XCPepVIrD/rfBPRbYqYdUaNpXVRIG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Iraq', 'Christianity', '2020-10-06', NULL, NULL, NULL, NULL, '2025-11-23 03:56:17', '2025-11-23 03:56:17', NULL),
(11, 'Dr. Leonora Marvin', 'student4@example.com', '2025-11-23 03:56:17', '$2y$12$8sCqQKiqftqypUv23VbjfO.YTPeM.F3MgcLUh5Ou0jmvzDghjAfsO', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Brunei Darussalam', 'Islam', '1979-12-04', NULL, NULL, NULL, NULL, '2025-11-23 03:56:17', '2025-11-23 03:56:17', NULL),
(12, 'Reinhold Dare', 'student5@example.com', '2025-11-23 03:56:18', '$2y$12$sjrN4v1MOFBmiExyzPTBXeoezwVecdEqEvBvtbaiAMcVu9x5If2eK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'American Samoa', 'Hinduism', '2023-04-21', NULL, NULL, NULL, NULL, '2025-11-23 03:56:18', '2025-11-23 03:56:18', NULL),
(13, 'Adonis Schoen III', 'student6@example.com', '2025-11-23 03:56:18', '$2y$12$P87ifzNW6bF8xHarlqegT.bLs4yH1hIC4cLgXEq/nar2.FKvD5dxS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Solomon Islands', 'Christianity', '1979-06-25', NULL, NULL, NULL, NULL, '2025-11-23 03:56:18', '2025-11-23 03:56:18', NULL),
(14, 'Miss Jayda Miller PhD', 'student7@example.com', '2025-11-23 03:56:18', '$2y$12$nhCwbKQUCZBff5AESopaxe0rcExz3vguKi65oeax19/hcEI4TBtoa', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Brazil', 'Islam', '2020-05-18', NULL, NULL, NULL, NULL, '2025-11-23 03:56:18', '2025-11-23 03:56:18', NULL),
(15, 'Marta Hammes', 'student8@example.com', '2025-11-23 03:56:18', '$2y$12$XKDurhtHA6h8aO0udDqSvOTrYj4YOpkwkyB8WcYSuTBrkKSuFSx1.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Japan', 'Islam', '2022-12-08', NULL, NULL, NULL, NULL, '2025-11-23 03:56:18', '2025-11-23 03:56:18', NULL),
(16, 'Neil Marquardt', 'student9@example.com', '2025-11-23 03:56:19', '$2y$12$i.vp1qOQefBhxRIaFnnLhO/kTCS/k6YNafUbfbj1/KqgDBN/sGHx6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Andorra', 'Islam', '2005-07-08', NULL, NULL, NULL, NULL, '2025-11-23 03:56:19', '2025-11-23 03:56:19', NULL),
(17, 'Miss Loraine Gleason Jr.', 'student10@example.com', '2025-11-23 03:56:19', '$2y$12$zZ9xRzaS9NeQnuGcrB440OP20U/dZwGcg0o3gE/6iFZ8SqLX5pOiW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Northern Mariana Islands', 'Hinduism', '1995-11-12', NULL, NULL, NULL, NULL, '2025-11-23 03:56:19', '2025-11-23 03:56:19', NULL),
(18, 'Bernita Brakus', 'student11@example.com', '2025-11-23 03:56:19', '$2y$12$YQr9zFTlkaGmgkPk/pSGReQjkEW2eUarV3z3Quqk3DkZUF.cyRrje', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Congo', 'Hinduism', '1996-09-19', NULL, NULL, NULL, NULL, '2025-11-23 03:56:19', '2025-11-23 03:56:19', NULL),
(19, 'Remington Bailey', 'student12@example.com', '2025-11-23 03:56:19', '$2y$12$5RyLoGDCAgtKE42XWX/q1Oqz5ZnFRdmyZg8CaV7cx684VMmZ5XlW6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Italy', 'Islam', '2015-12-13', NULL, NULL, NULL, NULL, '2025-11-23 03:56:19', '2025-11-23 03:56:19', NULL),
(20, 'Brant Herzog', 'student13@example.com', '2025-11-23 03:56:19', '$2y$12$ZGKGbtI332EISIgbzI/t9erOKWwUKX24/LY1jMeH4yy7hyWp.0kA6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Seychelles', 'Christianity', '1986-01-13', NULL, NULL, NULL, NULL, '2025-11-23 03:56:19', '2025-11-23 03:56:19', NULL),
(21, 'Marge Wolf Sr.', 'student14@example.com', '2025-11-23 03:56:20', '$2y$12$Is4/EGokxHjwzn13ip9PPOU8KqkVVQ2Ahnk0ge3yhYPSSPTA3USYS', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Libyan Arab Jamahiriya', 'Christianity', '1994-07-01', NULL, NULL, NULL, NULL, '2025-11-23 03:56:20', '2025-11-23 03:56:20', NULL),
(22, 'Edgar Kerluke', 'student15@example.com', '2025-11-23 03:56:20', '$2y$12$MrwfJkw9R3n0WnbiTlhCsOdNTNs/Qp2Qb/oG1UNCkmK0GFUe2eypK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Turkey', 'Islam', '2024-08-06', NULL, NULL, NULL, NULL, '2025-11-23 03:56:20', '2025-11-23 03:56:20', NULL),
(23, 'Rylan Simonis', 'student16@example.com', '2025-11-23 03:56:20', '$2y$12$mslr3E19yLNVXewrg3dS9uPH2PQSDGd9CWLzpM.0F3P4PkA4ZKutS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'French Guiana', 'Islam', '2019-11-29', NULL, NULL, NULL, NULL, '2025-11-23 03:56:20', '2025-11-23 03:56:20', NULL),
(24, 'Dr. Jeff Boehm', 'student17@example.com', '2025-11-23 03:56:20', '$2y$12$pJfyuye1PhJldyUXcCGwzO5SFGCfkIJYL/1e5L8N2LFKbd5DXqkZi', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Svalbard & Jan Mayen Islands', 'Hinduism', '2007-01-12', NULL, NULL, NULL, NULL, '2025-11-23 03:56:20', '2025-11-23 03:56:20', NULL),
(25, 'Prof. Billy Wilderman', 'student18@example.com', '2025-11-23 03:56:21', '$2y$12$EJK8DPep8dRdvb66MV49keCiBX/f3A.wjVvtdbetqP6tkhQ3JxsKC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Costa Rica', 'Islam', '2001-06-17', NULL, NULL, NULL, NULL, '2025-11-23 03:56:21', '2025-11-23 03:56:21', NULL),
(26, 'Dina Stokes', 'student19@example.com', '2025-11-23 03:56:21', '$2y$12$F7gZkaSqLEmKyRYrSBLsy.TuCw4b1q7FFpqB5Y4kGBFNGJEnhPaOy', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Suriname', 'Christianity', '1990-02-19', NULL, NULL, NULL, NULL, '2025-11-23 03:56:21', '2025-11-23 03:56:21', NULL),
(27, 'Dr. Stacey Jacobi Sr.', 'student20@example.com', '2025-11-23 03:56:21', '$2y$12$lBv2/B9NXNsU5/P2wqEcluW8AP3a7z4fJNqN1Z6BntyaeQ4KkcLti', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Zimbabwe', 'Hinduism', '1980-09-09', NULL, NULL, NULL, NULL, '2025-11-23 03:56:21', '2025-11-23 03:56:21', NULL),
(28, 'Mrs. Eleanora Kiehn III', 'student21@example.com', '2025-11-23 03:56:21', '$2y$12$Z4K2.vfPVdfCWxxC5pX0.eYxWE6iuvRTNPHjasvv63Ub8AvRJaVGW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Switzerland', 'Christianity', '1992-12-29', NULL, NULL, NULL, NULL, '2025-11-23 03:56:21', '2025-11-23 03:56:21', NULL),
(29, 'Prof. Levi Davis', 'student22@example.com', '2025-11-23 03:56:21', '$2y$12$RxF8RkBZJcYR2aPuLOLUHuAbF8sdXWDBH5uox1tXPIOv2hzNI1HIS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Mali', 'Christianity', '2001-09-25', NULL, NULL, NULL, NULL, '2025-11-23 03:56:21', '2025-11-23 03:56:21', NULL),
(30, 'Neil Bauch', 'student23@example.com', '2025-11-23 03:56:22', '$2y$12$ytnRjSRqvX9jpFIgQOAFtOcluvauwJKr6t9p4amEo9HOJmgvnf372', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Belarus', 'Islam', '1976-04-22', NULL, NULL, NULL, NULL, '2025-11-23 03:56:22', '2025-11-23 03:56:22', NULL),
(31, 'Lizzie Rempel', 'student24@example.com', '2025-11-23 03:56:22', '$2y$12$oMyJG/e/iyrYxaw0u3oGHe6Wu9GHikzfKqNy5yKQmbuGMNyQ9D8r2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Hungary', 'Hinduism', '1998-10-07', NULL, NULL, NULL, NULL, '2025-11-23 03:56:22', '2025-11-23 03:56:22', NULL),
(32, 'German Bogisich Sr.', 'student25@example.com', '2025-11-23 03:56:22', '$2y$12$w14SoI69MjvDGckBYgY0i.PHgKOBD9JRQdAbOdgYvIaXNn7fSjw8O', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'New Caledonia', 'Hinduism', '1974-06-24', NULL, NULL, NULL, NULL, '2025-11-23 03:56:22', '2025-11-23 03:56:22', NULL),
(33, 'Fernando Terry IV', 'student26@example.com', '2025-11-23 03:56:22', '$2y$12$pTAugEPjVQcZeh1Cab2vnuYFE/C3uxpivJceeSiAemeTdtYp63NWG', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Norfolk Island', 'Hinduism', '1975-10-02', NULL, NULL, NULL, NULL, '2025-11-23 03:56:22', '2025-11-23 03:56:22', NULL),
(34, 'Zack Grant', 'student27@example.com', '2025-11-23 03:56:23', '$2y$12$Cteuprtu0e3lfYrEWE4hJu24bxgB9juwcehwY3uGpTqa7BX/8jnfS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'United Kingdom', 'Christianity', '1978-12-02', NULL, NULL, NULL, NULL, '2025-11-23 03:56:23', '2025-11-23 03:56:23', NULL),
(35, 'Grady Farrell', 'student28@example.com', '2025-11-23 03:56:23', '$2y$12$.tc8W2UZ3A/JYmQVWRfWbeTKToGPgHQIfkHiq048fgaawyKOG4LuO', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Tuvalu', 'Hinduism', '1974-12-09', NULL, NULL, NULL, NULL, '2025-11-23 03:56:23', '2025-11-23 03:56:23', NULL),
(36, 'Gladyce Larson', 'student29@example.com', '2025-11-23 03:56:23', '$2y$12$EZ3fwHfhHbXsJOx.mmIQTuNm10Dfl2x4gvqvgGn1m9.DEuFBHF.n6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Swaziland', 'Christianity', '1996-07-20', NULL, NULL, NULL, NULL, '2025-11-23 03:56:23', '2025-11-23 03:56:23', NULL),
(37, 'Yolanda Dicki', 'student30@example.com', '2025-11-23 03:56:23', '$2y$12$IrjtLVh01kO2oojuclKmrutREzw0ZUgWcHiqewP83bOzzwu8BczP6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Uruguay', 'Christianity', '2022-03-19', NULL, NULL, NULL, NULL, '2025-11-23 03:56:23', '2025-11-23 03:56:23', NULL),
(38, 'Austyn Haag', 'student31@example.com', '2025-11-23 03:56:24', '$2y$12$bfOwAPTfAGoolgpyMAWjPe69JpXblnXLtnJiZfLEuwyvp.mWn6YJq', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Bahamas', 'Islam', '2020-12-21', NULL, NULL, NULL, NULL, '2025-11-23 03:56:24', '2025-11-23 03:56:24', NULL),
(39, 'Prof. Bill Rippin', 'student32@example.com', '2025-11-23 03:56:24', '$2y$12$4tpSwy7vk75vmXzsu80Zme3aC52eOxM6Oak8XUoj9ACKvonre/sN.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Svalbard & Jan Mayen Islands', 'Hinduism', '2003-09-07', NULL, NULL, NULL, NULL, '2025-11-23 03:56:24', '2025-11-23 03:56:24', NULL),
(40, 'Manley Cronin', 'student33@example.com', '2025-11-23 03:56:24', '$2y$12$CB6.VASSCBuuAeQr/KQlte/HysOtIvEdZZCrZ5lwibMLpJ9wWSJSG', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Falkland Islands (Malvinas)', 'Islam', '1984-11-27', NULL, NULL, NULL, NULL, '2025-11-23 03:56:24', '2025-11-23 03:56:24', NULL),
(41, 'Jarrod Kling', 'student34@example.com', '2025-11-23 03:56:24', '$2y$12$gu48zA0YMjxLyYnDUF7CuOpqOIG9Q0Hv5lun53d5E3JyCVNXR3XSW', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Belarus', 'Islam', '2023-10-01', NULL, NULL, NULL, NULL, '2025-11-23 03:56:24', '2025-11-23 03:56:24', NULL),
(42, 'Dominique Batz DDS', 'student35@example.com', '2025-11-23 03:56:24', '$2y$12$HQG5GN/wx4TZREw81NBzOuFRoUnvxD/jFmnTzpuHPY9ehKZKCmg0O', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Suriname', 'Hinduism', '2024-05-12', NULL, NULL, NULL, NULL, '2025-11-23 03:56:24', '2025-11-23 03:56:24', NULL),
(43, 'Karson Stracke Sr.', 'student36@example.com', '2025-11-23 03:56:25', '$2y$12$GCTt1cGfEdT1JjyMCdo8juYrg0YEyz2jCmyaOngQ3F9C3umXMqkOm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Saint Vincent and the Grenadines', 'Hinduism', '1989-11-16', NULL, NULL, NULL, NULL, '2025-11-23 03:56:25', '2025-11-23 03:56:25', NULL),
(44, 'Abbie Leuschke', 'student37@example.com', '2025-11-23 03:56:25', '$2y$12$KisfocVbjJsQzP/eSb0Gb.GKMeTh1.QIeRiIhh1/9ByQyzbn2z.gO', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Kyrgyz Republic', 'Christianity', '2021-08-19', NULL, NULL, NULL, NULL, '2025-11-23 03:56:25', '2025-11-23 03:56:25', NULL),
(45, 'Kieran Walter I', 'student38@example.com', '2025-11-23 03:56:25', '$2y$12$0ydMd1/yYohz/zX5tqXIAOw3LRQgTpexqCHIyaafW2JeFDh6.eTm2', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Myanmar', 'Hinduism', '1991-01-05', NULL, NULL, NULL, NULL, '2025-11-23 03:56:25', '2025-11-23 03:56:25', NULL),
(46, 'Augustus Baumbach', 'student39@example.com', '2025-11-23 03:56:25', '$2y$12$6EHOwmKK1UlTgXs5V1xHSOx9j5ujN6pzoTRU4U5KE1h4Et12F0aFa', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Panama', 'Islam', '1970-11-28', NULL, NULL, NULL, NULL, '2025-11-23 03:56:25', '2025-11-23 03:56:25', NULL),
(47, 'Alisa Jakubowski', 'student40@example.com', '2025-11-23 03:56:26', '$2y$12$WKdSUIhmQlGBdgBF/E6fau1Br6xjVNnXw.jG.7mp.larQLj/C95/q', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Iran', 'Christianity', '1993-09-19', NULL, NULL, NULL, NULL, '2025-11-23 03:56:26', '2025-11-23 03:56:26', NULL),
(48, 'Stephanie Hoppe', 'student41@example.com', '2025-11-23 03:56:26', '$2y$12$k9PdgMmRCnn.hJ7pcXL2F.WH8o8XvvW2Ni/bqOAEoHUWuVc5WOojm', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Mali', 'Christianity', '2011-06-13', NULL, NULL, NULL, NULL, '2025-11-23 03:56:26', '2025-11-23 03:56:26', NULL),
(49, 'Theodore Kuhn', 'student42@example.com', '2025-11-23 03:56:26', '$2y$12$cX3jULZeVnegvsBlOCtRRei3lU8MTtYZwnv5Bs4L0j.bGp8.VRCmC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Mauritania', 'Christianity', '1971-01-01', NULL, NULL, NULL, NULL, '2025-11-23 03:56:26', '2025-11-23 03:56:26', NULL),
(50, 'Montana Franecki', 'student43@example.com', '2025-11-23 03:56:26', '$2y$12$BKYxgUwEaRWLhI5XXRbcFej2.W9vAW1SuLnaZJPyYBrx/XPsXLj7K', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Svalbard & Jan Mayen Islands', 'Islam', '2002-05-21', NULL, NULL, NULL, NULL, '2025-11-23 03:56:26', '2025-11-23 03:56:26', NULL),
(51, 'Prof. Rhiannon Bauch', 'student44@example.com', '2025-11-23 03:56:26', '$2y$12$kefJyFitd8y2q3hNESMrgecxFoGD6MQVWAMxeiNQ2rBupBYra/m3W', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Swaziland', 'Christianity', '1971-03-24', NULL, NULL, NULL, NULL, '2025-11-23 03:56:26', '2025-11-23 03:56:26', NULL),
(52, 'Patsy Strosin', 'student45@example.com', '2025-11-23 03:56:27', '$2y$12$hhjR8VMQA5aPLeYJu9kCbeIPtR6iVP5PfXnGITs1WPZxE9u25EApq', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Morocco', 'Islam', '1974-01-17', NULL, NULL, NULL, NULL, '2025-11-23 03:56:27', '2025-11-23 03:56:27', NULL),
(53, 'Geovany Lemke', 'student46@example.com', '2025-11-23 03:56:27', '$2y$12$UWbrgn1qqLpr.BRTbVlxr.WisTL.ar0WgHyHYmO14EqxY/WrEre92', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Liberia', 'Islam', '1975-01-05', NULL, NULL, NULL, NULL, '2025-11-23 03:56:27', '2025-11-23 03:56:27', NULL),
(54, 'Tate Krajcik I', 'student47@example.com', '2025-11-23 03:56:27', '$2y$12$SaQG/.UAIIHW84YAIWqugudwU085qT66tx2rLKezI2dMwF2dLm3DG', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Croatia', 'Hinduism', '1991-08-23', NULL, NULL, NULL, NULL, '2025-11-23 03:56:27', '2025-11-23 03:56:27', NULL),
(55, 'Delfina Wolff', 'student48@example.com', '2025-11-23 03:56:27', '$2y$12$Gmf/YIpSivBzGi9YMCpv8uVpWpiQqZHNYqFx4TWbL5ebmhq0B43B6', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Yemen', 'Hinduism', '1990-08-01', NULL, NULL, NULL, NULL, '2025-11-23 03:56:27', '2025-11-23 03:56:27', NULL),
(56, 'Columbus Tremblay', 'student49@example.com', '2025-11-23 03:56:28', '$2y$12$wbYwRiFxLBlTMD6B5ksqH.1jw4pbkGtFDn.4FVGi0Fg6rrfvZJN8i', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Belize', 'Hinduism', '1996-06-16', NULL, NULL, NULL, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_course_offering_id_foreign` (`course_offering_id`),
  ADD KEY `payments_received_by_foreign` (`received_by`),
  ADD KEY `payments_student_id_foreign` (`student_id`),
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
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD UNIQUE KEY `student_course_student_id_course_offering_id_unique` (`student_id`,`course_offering_id`),
  ADD KEY `student_course_course_offering_id_foreign` (`course_offering_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_offerings`
--
ALTER TABLE `course_offerings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
  ADD CONSTRAINT `payments_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `payments_fee_id_foreign` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `student_course_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_course_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
