-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 06:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_scms`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_offering_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','late','excused') NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `publication_year` year(4) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `category_id`, `author`, `isbn`, `publication_year`, `publisher`, `quantity`, `description`, `cover_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sit corrupti qui q', 1, 'Veniam ut magnam la', 'Mollit ut consequatu', '2000', 'Obcaecati dolore ani', 135, 'Similique adipisicin', NULL, '2025-07-18 21:08:31', '2025-07-18 21:08:31', NULL),
(2, 'Consectetur laborum', 2, 'Eligendi accusamus n', 'Ut eligendi quaerat', '1994', 'Eaque eiusmod error', 430, 'Aut in repellendus', NULL, '2025-07-18 23:21:27', '2025-07-18 23:21:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Brynn Hughes', 'Autem ea similique up', '2025-07-18 20:51:31', '2025-07-18 23:17:32', '2025-07-18 23:17:32'),
(2, 'Catherine Morin up', 'Quis possimus animi up', '2025-07-18 21:59:08', '2025-07-18 23:25:12', NULL),
(3, 'bookup', 'Catherine Morin', '2025-07-18 22:49:28', '2025-07-18 23:15:38', '2025-07-18 23:15:38'),
(4, 'MacKenzie Fulton', 'Ut amet officiis in up', '2025-07-18 23:24:06', '2025-07-18 23:25:12', NULL),
(5, 'Ramona Moon', 'Dignissimos dolor lo', '2025-07-18 23:24:24', '2025-07-18 23:24:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `fine` decimal(8,2) NOT NULL DEFAULT 0.00,
  `status` enum('issued','returned','overdue') NOT NULL DEFAULT 'issued',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `facilities` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE `course_offerings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `academic_year` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Illana Melendez', 'Eum aut nobis ex sun', '2025-07-17 03:10:49', '2025-07-17 03:10:49', NULL),
(2, 'sdsf', 'sfsdf', '2025-07-17 03:17:56', '2025-07-17 03:17:56', NULL),
(3, 'sdfsdf', 'sdfsdf', '2025-07-17 03:18:04', '2025-07-29 10:11:34', '2025-07-29 10:11:34'),
(4, 'Economics Department', 'Economic theory and business basics', '2025-07-17 03:18:16', '2025-07-29 10:11:25', NULL),
(5, 'English Department', 'Department  English', '2025-07-17 03:18:27', '2025-07-23 10:01:51', NULL),
(6, 'khmer Department', 'Khmer Promotes Khmer language and culture', '2025-07-17 03:22:05', '2025-07-29 10:08:31', NULL),
(7, 'Computer Scienc', 'Focuses on programming, software engineering, and systems', '2025-07-21 04:11:31', '2025-07-21 04:11:31', NULL),
(8, 'Physical Education', 'Physical Education	Promotes health, fitness, and sports', '2025-07-21 04:13:14', '2025-07-29 10:11:25', NULL),
(9, 'Biology', 'Examines living organisms and ecosystems.', '2025-07-21 04:13:41', '2025-07-21 04:13:41', NULL),
(10, 'Mathematics Department', 'Responsible for teaching mathematics', '2025-07-29 10:06:32', '2025-07-29 10:06:32', NULL),
(11, 'Arts Department', 'Drawing, painting, and performing arts', '2025-07-29 10:06:57', '2025-07-29 10:06:57', NULL),
(12, 'ICT Department', 'Information and Communication Technology', '2025-07-29 10:07:19', '2025-07-29 10:07:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `type` enum('academic','cultural','sports','holiday','other') NOT NULL,
  `is_holiday` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `total_marks` int(11) NOT NULL,
  `passing_marks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `description`, `subject_id`, `date`, `total_marks`, `passing_marks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Imani Whitehead', 'Ea qui id suscipit', 4, '2025-07-22', 26, 11, '2025-07-19 11:04:49', '2025-07-19 11:04:49', NULL),
(2, 'miterm', 'Natus irure est ut e', 1, '2025-08-01', 76, 74, '2025-07-19 11:11:08', '2025-07-20 00:53:01', NULL),
(3, 'Xenos Jefferson', 'Autem et facilis mag', 4, '2025-08-02', 50, 25, '2025-07-20 01:27:46', '2025-07-20 01:30:42', NULL),
(4, 'test', 'estest', 4, '2025-08-08', 20, 12, '2025-07-20 01:29:48', '2025-07-20 01:29:48', NULL),
(5, 'Elaine Franks', 'Error mollit sint qu', 1, '2025-07-21', 50, 25, '2025-07-20 03:52:53', '2025-07-20 03:53:22', '2025-07-20 03:53:22'),
(6, 'test', 'test', 1, '2025-07-26', 50, 25, '2025-07-20 04:09:01', '2025-07-20 04:09:01', NULL),
(7, 'Fay', 'Consequuntur saepe s', 1, '2025-07-25', 50, 34, '2025-07-20 04:48:47', '2025-07-20 04:49:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `expense_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `description`, `amount`, `date`, `expense_category_id`, `approved_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Inventore debitis lo', 'Quo ut qui asperiore', 200.00, '2020-01-24', NULL, 1, '2025-07-20 22:47:04', '2025-07-20 22:47:04', NULL),
(2, 'Inventore debitis lo', 'Quo ut qui asperiore', 200.00, '2020-01-24', NULL, 1, '2025-07-20 22:47:10', '2025-07-20 22:47:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_structures`
--

CREATE TABLE `fee_structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `grade_level_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `frequency` enum('monthly','quarterly','semester','annual') NOT NULL,
  `effective_from` date NOT NULL,
  `effective_to` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `marks_obtained` decimal(5,2) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade_levels`
--

CREATE TABLE `grade_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grade_levels`
--

INSERT INTO `grade_levels` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1A', '232s', 'Dolorem ut libero co', '2025-07-18 17:37:46', '2025-07-29 11:22:47', NULL),
(2, '1B', 'f23t', 'Dolores voluptatem', '2025-07-18 17:38:14', '2025-07-29 11:22:47', NULL),
(3, 'C', 'Ne43', 'Quo maiores cillum e', '2025-07-18 17:43:17', '2025-07-18 17:45:13', '2025-07-18 17:45:13'),
(4, '1C', 'f2t', 'updated', '2025-07-18 18:03:56', '2025-07-29 11:22:47', NULL),
(5, '2', 'f2ttt', 'test up', '2025-07-18 18:46:13', '2025-07-18 18:49:37', '2025-07-18 18:49:37'),
(6, 'Herman Barron', 'Laboris ducimus nih', 'Obcaecati non non ad', '2025-07-18 18:50:10', '2025-07-18 18:50:32', '2025-07-18 18:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `relation` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_13_062542_create_personal_access_tokens_table', 1),
(5, '2025_06_13_065537_tb', 1),
(6, '2025_06_15_061008_create_permission_tables', 2),
(7, '2025_07_16_164734_create_scores_table', 2),
(8, '2025_07_17_072154_mod_teacher', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `audience` enum('all','teachers','students','parents','staff') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_fee_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `received_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `grade_level_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `grade_level_id`, `teacher_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2', 1, NULL, '2025-07-19 05:31:34', '2025-07-19 06:53:42', '2025-07-19 06:53:42'),
(2, 'A', 4, 1, '2025-07-19 05:45:06', '2025-07-19 08:56:10', NULL),
(3, 'Ae', 4, 2, '2025-07-19 05:46:41', '2025-07-19 08:32:43', NULL),
(4, 'McKenzie Stafford', 2, 1, '2025-07-19 06:54:42', '2025-07-19 06:57:08', '2025-07-19 06:57:08'),
(5, 'B', 1, 1, '2025-07-19 07:46:15', '2025-07-19 08:56:22', NULL),
(6, 'A', 1, 1, '2025-07-19 07:50:26', '2025-07-19 08:04:44', NULL),
(7, 'sdas', 1, 1, '2025-07-19 07:54:28', '2025-07-19 07:56:26', '2025-07-19 07:56:26'),
(8, 'Lyle Vinson', 2, 2, '2025-07-19 07:58:40', '2025-07-19 08:04:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vPFnHMvkZng3ZcXjSe3FY2icbobN50nZTAXd7IGl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZE5ma3hhWWhCTFNtaHF2endVZXM0cHFzcWtMV2VRaUpRWVpBTjJ4UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zY29yZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1Mzg0ODA0Mzt9fQ==', 1753855340);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `grade_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `admission_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `address`, `photo`, `dob`, `gender`, `grade_level_id`, `user_id`, `blood_group`, `nationality`, `religion`, `admission_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tit', '09924234', 'lavtit.nssp2021@gmail.com', 'srss', NULL, '2025-07-15', 'male', 1, NULL, '2', 'kh', 'sr', '2025-07-25', '2025-07-24 12:54:15', '2025-07-24 12:54:15', NULL),
(2, 'Caesar Raymond', '+1 (196) 249-8955', 'dedypy@mailinator.com', 'Fugiat esse sit nul', 'photos/student/1753388963-24-07-2025_addprofile-photo.jpg', '1995-11-26', 'female', 1, 1, '23', 'Fugit deserunt volu', 'Aute voluptate dolor', '1978-09-21', '2025-07-24 13:29:23', '2025-07-24 13:29:23', NULL),
(3, 'Ratanak Heng', '015777888', 'hengn@gmail.com', '#23, Tuol Kork Village#56, Preah Sihanouk Blvd', NULL, '2016-12-09', 'male', 2, 1, '5', 'Officia qui officia', 'Voluptas nihil et as', '1991-02-11', '2025-07-29 21:10:13', '2025-07-29 21:10:13', NULL),
(4, 'Chana Bora', '0889820067', 'admin@gmail.com', 'siem reap', 'photos/student/1753848736-30-07-2025_addprofile-photo.jpg', '2013-01-30', 'male', 4, NULL, '12', 'khmer', 'Aut praesentium proi', '2025-07-30', '2025-07-29 21:12:16', '2025-07-29 21:12:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_offering_id` bigint(20) UNSIGNED NOT NULL,
  `grade_final` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `fee_structure_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','partial','paid') NOT NULL DEFAULT 'pending',
  `due_date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_guardian`
--

CREATE TABLE `student_guardian` (
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `guardian_id` bigint(20) UNSIGNED NOT NULL,
  `relation_to_student` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `credit_hours` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `department_id`, `description`, `credit_hours`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', '22344', 1, 'Cillum quam est vel', 3, '2025-07-17 03:34:59', '2025-07-29 09:53:01', NULL),
(2, 'Vannda', 'tes23', 2, 'sdfsfsdfdf', 30, '2025-07-17 05:12:34', '2025-07-17 05:38:08', '2025-07-17 05:38:08'),
(3, 'Keefe Daniels', '2344', 5, 'Molestias quasi aliq', 24, '2025-07-17 05:38:39', '2025-07-17 05:39:42', '2025-07-17 05:39:42'),
(4, 'Khmer', '33Et', 1, 'Qui consequatur id q', 3, '2025-07-17 21:32:14', '2025-07-29 09:53:25', NULL),
(5, 'Physics', 'PHY110', 1, 'Mechanics and energy concepts', 4, '2025-07-29 10:13:25', '2025-07-29 10:13:25', NULL),
(6, 'Geography', 'GEO22', 12, 'Physical and political geography', 3, '2025-07-29 10:14:52', '2025-07-29 10:14:52', NULL),
(7, 'Economics', 'ECO99', 12, 'Introduction to Economics', 2, '2025-07-29 10:15:35', '2025-07-29 10:15:35', NULL),
(8, 'Math', 'MTH101', 10, 'Basic algebra and geometry', 4, '2025-07-29 10:19:02', '2025-07-29 10:19:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `joining_date` date NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `specialization` text DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `gender`, `dob`, `department_id`, `user_id`, `joining_date`, `qualification`, `experience`, `phone`, `email`, `address`, `specialization`, `salary`, `photo`, `cv`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kennedy Berger', NULL, NULL, 3, 1, '1981-03-01', 'Atque est eu quo ap', 'Irure sit perspiciat', '+1 (268) 512-9448', 'diqyrina@mailinator.com', 'Accusantium harum al', 'Laborum sed omnis in', 97.00, NULL, NULL, '2025-07-19 05:10:53', '2025-07-21 01:42:34', '2025-07-21 01:42:34'),
(2, 'Faith Ewing', 'male', '2025-07-23', 4, 1, '1991-04-20', 'Rerum excepteur qui', 'Et sunt corporis al', '+1 (659) 222-9074', 'boqocynofo@mailinator.com', '3', 'Aut non quis est dis', 600.00, 'photos/teacher/1753260035-23-07-2025_edc64.jfif', NULL, '2025-07-19 05:11:52', '2025-07-23 01:42:15', '2025-07-23 01:42:15'),
(3, 'Olga Newton', NULL, NULL, 1, 1, '2013-06-17', 'Aute quis veniam na', 'Do neque aut quidem', '+1 (693) 989-4301', 'nyvubozaqu@mailinator.com', 'Id eius rerum moles', 'Omnis ut aperiam exp', 91.00, 'teachers/photos/hw2sTt5D8IkibQq04WnwoGk83KIs1DkpnLAxMAU1.jpg', NULL, '2025-07-20 05:40:04', '2025-07-20 07:32:58', '2025-07-20 07:32:58'),
(4, 'Byron Jacobs', NULL, NULL, 1, 1, '2003-12-07', 'Voluptas vel sit la', 'Recusandae Minus et', '+1 (303) 591-2274', 'qycovabi@mailinator.com', 'Aut fugit perspicia', 'Eos cumque officia d', 2300.00, 'teachers/photos/IfCAQN0VYTk0qmwBmYzu5eAVzGdWh1chCcWHBbnK.jpg', NULL, '2025-07-20 07:13:17', '2025-07-20 07:32:58', '2025-07-20 07:32:58'),
(5, 'LAV TIT', 'male', '2018-03-14', 7, 1, '2025-07-23', 'Et id nemo rerum omn', '3', '+1 (493) 572-4873', 'lijyqeje@mailinator.com', 'Similique maiores re', 'Aut quibusdam velit', 900.00, 'photos/teacher/1753022307_profile-photo.jpg', 'photos/cv/1753264387-23-07-2025_edLav Tit Literature review and Referencing.pdf', '2025-07-20 07:38:27', '2025-07-23 02:53:07', NULL),
(6, 'Reathey', 'male', '2024-03-06', 1, 1, '2023-09-19', 'Quo dicta et invento', '2', '+1 (197) 774-7347', 'towixin@mailinator.com', 'Sit dolore aliqua P', 'Soluta et nesciunt', 2300.00, 'photos/teacher/1753022718_profile-photo.jpg', NULL, '2025-07-20 07:45:18', '2025-07-23 02:26:30', NULL),
(7, 'Mohammad Aguirre', 'male', '2025-07-23', 1, 1, '1982-02-18', 'Culpa culpa aut nul', '5', '+1 (951) 877-6031', 'rutiqece@mailinator.com', 'Autem eum corporis d', 'Incididunt fugiat al', 200.00, NULL, 'photos/cv/1753263642_Group1.docx', '2025-07-20 07:47:36', '2025-07-23 02:40:42', NULL),
(8, 'updated', 'female', '2025-07-23', 1, 1, '2025-01-29', 'Dolores iste volupta', '4', '+1 (959) 807-2713', 'he@mailinator.com', 'Dolore doloremque re', 'Nulla aute id id ut', 1500.00, 'photos/teacher/1753259320_avtarss1(1).jpg', NULL, '2025-07-20 21:28:43', '2025-07-23 02:26:57', NULL),
(9, 'Emma Jefferson', NULL, NULL, 4, 1, '1972-10-22', 'Earum est est nostru', 'Laboris veniam volu', '+1 (687) 942-5769', 'nehefic@mailinator.com', 'Ut non magnam enim i', 'Eos ex porro eaque o', 37.00, NULL, NULL, '2025-07-21 02:58:29', '2025-07-22 05:31:38', '2025-07-22 05:31:38'),
(10, 'Eden Fleming', NULL, NULL, 2, 1, '2013-08-30', 'Voluptatem itaque d', 'Eos sunt aut qui ap', '+1 (963) 256-6184', 'lymaqo@mailinator.com', 'Facere amet Nam sin', 'Sit molestiae commo', 18.00, 'photos/teacher/1753106941_room5.jpg', NULL, '2025-07-21 07:09:02', '2025-07-23 01:47:36', '2025-07-23 01:47:36'),
(11, 'Mara Ryan', NULL, NULL, 8, 1, '2006-05-03', 'Praesentium sint lab', 'Sit temporibus neque', '+1 (978) 755-4711', 'zowiwudad@mailinator.com', 'Suscipit cillum ut m', 'Omnis unde vel corpo', 33.00, 'photos/teacher/1753183944_profile-photo.jpg', 'photos/cv/1753183944_Group1.docx', '2025-07-22 04:32:24', '2025-07-22 05:34:19', '2025-07-22 05:34:19'),
(12, 'Chana Bora', 'other', '1977-08-23', 5, 1, '2025-07-23', 'Maxime sed quam vel', 'In ut et iure est ve', '0889820067', 'chan@gmail.com', 'siem reap', 'Culpa nulla sed sed', 690.00, 'photos/teacher/1753263122-23-07-2025_addprofile-photo.jpg', NULL, '2025-07-23 02:32:02', '2025-07-23 02:32:02', NULL),
(13, 'Sok Dara', 'female', '1994-02-17', 2, 1, '2025-07-23', 'Voluptate dolorum es', 'Perferendis voluptas', '+1 (962) 602-5209', 'mijozuxez@mailinator.com', 'Unde officia ea dele', 'Reiciendis odio nesc', 500.00, 'photos/teacher/1753283040-23-07-2025_addprofile-photo.jpg', 'photos/cv/1753283041-23-07-2025_edGroup1.docx', '2025-07-23 08:04:01', '2025-07-23 08:04:01', NULL),
(14, 'TaShya Richard', 'female', '1985-07-08', 1, 1, '2001-04-13', 'Proident quia et vo', 'Eaque nobis ad quibu', '+1 (553) 692-4108', 'cysy@mailinator.com', 'Aut sed odio aut har', 'Ut fuga Repudiandae', 73.00, 'photos/teacher/1753289278-23-07-2025_addavtarss1(3).jpg', NULL, '2025-07-23 09:47:58', '2025-07-23 09:47:58', NULL),
(15, 'Phoebe Mcdonald', 'female', '1988-03-19', 3, 1, '1979-05-06', 'Nisi veniam vel lab', 'Nesciunt doloribus', '+1 (724) 483-9124', 'zumeh@mailinator.com', 'Sapiente qui ut aut', 'Ipsum in voluptas a', 18.00, 'photos/teacher/1753289699-23-07-2025_edavtarss1(4).jpg', 'photos/cv/1753289395-23-07-2025_edGroup1.docx', '2025-07-23 09:49:55', '2025-07-23 09:54:59', NULL),
(16, 'Testing', 'male', '1978-09-14', 8, 1, '2025-07-24', 'Sit praesentium con', 'Totam officia sit pa', '+1 (559) 151-2544', 'guded@mailinator.com', 'Aut eum eaque magni', 'Nemo eiusmod quo asp', 25.00, 'photos/teacher/1753337607-24-07-2025_addprofile-photo.jpg', 'photos/cv/1753337607-24-07-2025_edGroup1.docx', '2025-07-23 23:13:27', '2025-07-23 23:17:01', '2025-07-23 23:17:01'),
(17, 'Alana Peck', 'other', '1991-10-04', 4, 1, '2014-11-04', 'Nostrum provident e', 'Eiusmod fugiat magn', '+1 (448) 404-6784', 'muxaqyn@mailinator.com', 'Id dolorem in quo in', 'Aut porro fugit max', 76.00, 'photos/teacher/1753346321-24-07-2025_addroom3.jpg', NULL, '2025-07-24 01:38:41', '2025-07-24 01:38:41', NULL),
(18, 'Eric Malone', 'other', '1974-02-10', 3, 1, '2000-01-14', 'Officia sed occaecat', 'Suscipit excepteur a', '+1 (483) 537-9076', 'zusijuxe@mailinator.com', 'Possimus veniam vo', 'Id totam esse quia', 47.00, 'photos/teacher/1753346352-24-07-2025_addc64.jfif', NULL, '2025-07-24 01:39:12', '2025-07-24 01:39:12', NULL),
(19, 'Mary Mcleod', 'male', '2014-12-29', 1, 1, '2003-05-08', 'Excepturi est conse', 'Sequi nihil in possi', '+1 (522) 909-8504', 'gufa@mailinator.com', 'Molestias aut lorem', 'Elit rerum ex incid', 100.00, 'photos/teacher/1753346411-24-07-2025_addavatardefault.png', 'photos/cv/1753346411-24-07-2025_edGroup1.docx', '2025-07-24 01:40:11', '2025-07-24 01:40:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetable_slots`
--

CREATE TABLE `timetable_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_offering_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` enum('monday','tuesday','wednesday','thursday','friday','saturday','sunday') NOT NULL,
  `room_override` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','teacher','student','parent','staff') NOT NULL DEFAULT 'student',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `phone`, `address`, `date_of_birth`, `gender`, `profile_photo_path`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vanna Sok', 'admin@gmail.com', NULL, '$2y$12$d9eRPqVEzvySZXb/ghcP5eDsbGwR5DxtbywcqgyW2Ng79UNyYCv5e', 'student', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-17 01:20:17', '2025-07-17 01:20:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_student_id_course_offering_id_date_unique` (`student_id`,`course_offering_id`,`date`),
  ADD KEY `attendances_course_offering_id_foreign` (`course_offering_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_categories_name_unique` (`name`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_issues_book_id_foreign` (`book_id`),
  ADD KEY `book_issues_student_id_foreign` (`student_id`),
  ADD KEY `book_issues_teacher_id_foreign` (`teacher_id`);

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
  ADD KEY `course_offerings_classroom_id_foreign` (`classroom_id`),
  ADD KEY `course_offerings_section_id_foreign` (`section_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guardians_email_unique` (`email`);

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
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notices_created_by_foreign` (`created_by`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scores_student_id_exam_id_semester_unique` (`student_id`,`exam_id`,`semester`),
  ADD KEY `scores_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_grade_level_id_foreign` (`grade_level_id`),
  ADD KEY `sections_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_grade_level_id_foreign` (`grade_level_id`),
  ADD KEY `students_user_id_foreign` (`user_id`);

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
  ADD UNIQUE KEY `subjects_code_unique` (`code`),
  ADD KEY `subjects_department_id_foreign` (`department_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`),
  ADD KEY `teachers_department_id_foreign` (`department_id`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetables_section_id_foreign` (`section_id`);

--
-- Indexes for table `timetable_slots`
--
ALTER TABLE `timetable_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetable_slots_course_offering_id_foreign` (`course_offering_id`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_offerings`
--
ALTER TABLE `course_offerings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_structures`
--
ALTER TABLE `fee_structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_levels`
--
ALTER TABLE `grade_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetable_slots`
--
ALTER TABLE `timetable_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `book_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD CONSTRAINT `book_issues_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_issues_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `book_issues_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD CONSTRAINT `course_offerings_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `grades_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_student_fee_id_foreign` FOREIGN KEY (`student_fee_id`) REFERENCES `student_fees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_grade_level_id_foreign` FOREIGN KEY (`grade_level_id`) REFERENCES `grade_levels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_grade_level_id_foreign` FOREIGN KEY (`grade_level_id`) REFERENCES `grade_levels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `student_course_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_course_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD CONSTRAINT `student_fees_fee_structure_id_foreign` FOREIGN KEY (`fee_structure_id`) REFERENCES `fee_structures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_guardian`
--
ALTER TABLE `student_guardian`
  ADD CONSTRAINT `student_guardian_guardian_id_foreign` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_guardian_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timetable_slots`
--
ALTER TABLE `timetable_slots`
  ADD CONSTRAINT `timetable_slots_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
