-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2025 at 04:55 AM
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
(1, 10, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(2, 11, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(3, 13, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(4, 18, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(5, 19, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(6, 21, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(7, 22, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(8, 24, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(9, 26, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(10, 30, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(11, 31, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(12, 34, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(13, 35, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(14, 36, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(15, 37, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(16, 42, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(17, 44, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(18, 45, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(19, 46, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(20, 47, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(21, 48, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:55', '2025-11-23 21:37:55', NULL),
(22, 49, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:56', '2025-11-23 21:37:56', NULL),
(23, 50, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:56', '2025-11-23 21:37:56', NULL),
(24, 51, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:56', '2025-11-23 21:37:56', NULL),
(25, 53, 1, '2026-12-12', 'absence', NULL, '2025-11-23 21:37:56', '2025-11-23 21:37:56', NULL),
(26, 10, 1, '2025-10-07', 'absence', 'Dolores dolor esse', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(27, 11, 1, '2025-10-07', 'permission', 'Iure sint facilis e', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(28, 13, 1, '2025-10-07', 'absence', 'Velit ad rerum moles', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(29, 18, 1, '2025-10-07', 'absence', 'Hic id odit consequa', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(30, 19, 1, '2025-10-07', 'attending', 'Voluptates dolorem i', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(31, 21, 1, '2025-10-07', 'absence', 'Consequuntur ullam u', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(32, 22, 1, '2025-10-07', 'attending', 'Duis beatae repellen', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(33, 24, 1, '2025-10-07', 'absence', 'Repellendus Est har', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(34, 26, 1, '2025-10-07', 'permission', 'Voluptatem ea id in', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(35, 30, 1, '2025-10-07', 'attending', 'Neque quis saepe qui', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(36, 31, 1, '2025-10-07', 'attending', 'Ullam voluptas persp', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(37, 34, 1, '2025-10-07', 'attending', 'Aliquam vitae magnam', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(38, 35, 1, '2025-10-07', 'permission', 'Corporis qui nostrum', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(39, 36, 1, '2025-10-07', 'absence', 'Eos eum saepe autem', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(40, 37, 1, '2025-10-07', 'attending', 'Accusamus enim volup', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(41, 42, 1, '2025-10-07', 'permission', 'Aliquip est placeat', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(42, 44, 1, '2025-10-07', 'absence', 'Praesentium magni bl', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(43, 45, 1, '2025-10-07', 'absence', 'Ut voluptatem sed qu', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(44, 46, 1, '2025-10-07', 'attending', 'Est hic adipisci qua', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(45, 47, 1, '2025-10-07', 'attending', 'Dolor quod modi est', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(46, 48, 1, '2025-10-07', 'permission', 'Dolorem aute dicta p', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(47, 49, 1, '2025-10-07', 'attending', 'Quia consectetur nos', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(48, 50, 1, '2025-10-07', 'absence', 'Ut voluptates sit ex', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(49, 51, 1, '2025-10-07', 'permission', 'Tempor qui enim labo', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(50, 53, 1, '2025-10-07', 'absence', 'Laudantium quibusda', '2025-11-23 21:39:20', '2025-11-23 21:39:20', NULL),
(51, 9, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:22', '2025-11-23 21:43:22', NULL),
(52, 10, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:22', '2025-11-23 21:43:22', NULL),
(53, 11, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:22', '2025-11-23 21:43:22', NULL),
(54, 12, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:22', '2025-11-23 21:43:22', NULL),
(55, 13, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(56, 14, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(57, 15, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(58, 16, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(59, 17, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(60, 22, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(61, 24, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(62, 25, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(63, 26, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(64, 28, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(65, 29, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(66, 30, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(67, 32, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(68, 33, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(69, 34, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(70, 36, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(71, 37, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(72, 38, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(73, 40, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(74, 45, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(75, 46, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(76, 47, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(77, 49, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(78, 51, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(79, 52, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(80, 55, 2, '2026-02-17', 'absence', NULL, '2025-11-23 21:43:23', '2025-11-23 21:43:23', NULL),
(81, 9, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(82, 10, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(83, 11, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(84, 12, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(85, 13, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(86, 14, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(87, 15, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(88, 16, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(89, 17, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(90, 22, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(91, 24, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(92, 25, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(93, 26, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(94, 28, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(95, 29, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(96, 30, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(97, 32, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(98, 33, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(99, 34, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(100, 36, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(101, 37, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(102, 38, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(103, 40, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(104, 45, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(105, 46, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(106, 47, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(107, 49, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(108, 51, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(109, 52, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(110, 55, 2, '2025-08-13', 'absence', NULL, '2025-11-23 21:43:36', '2025-11-23 21:43:36', NULL),
(111, 10, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(112, 11, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(113, 13, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(114, 18, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(115, 19, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(116, 21, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(117, 22, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(118, 24, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(119, 26, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(120, 30, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(121, 31, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(122, 34, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(123, 35, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(124, 36, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(125, 37, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(126, 42, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(127, 44, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(128, 45, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(129, 46, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(130, 47, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(131, 48, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(132, 49, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(133, 50, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(134, 51, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(135, 53, 1, '2025-07-12', 'absence', NULL, '2025-11-23 23:20:29', '2025-11-23 23:20:29', NULL),
(136, 10, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(137, 11, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(138, 13, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(139, 18, 1, '2026-08-29', 'permission', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(140, 19, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(141, 21, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(142, 22, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(143, 24, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(144, 26, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(145, 30, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(146, 31, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(147, 34, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(148, 35, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(149, 36, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(150, 37, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(151, 42, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(152, 44, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(153, 45, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(154, 46, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(155, 47, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(156, 48, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(157, 49, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(158, 50, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(159, 51, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(160, 53, 1, '2026-08-29', 'absence', NULL, '2025-11-23 23:20:32', '2025-11-23 23:20:32', NULL),
(161, 10, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(162, 11, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(163, 13, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(164, 18, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(165, 19, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(166, 21, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(167, 22, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(168, 24, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(169, 26, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(170, 30, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(171, 31, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(172, 34, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(173, 35, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(174, 36, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(175, 37, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(176, 42, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(177, 44, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(178, 45, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(179, 46, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(180, 47, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(181, 48, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(182, 49, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(183, 50, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(184, 51, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(185, 53, 1, '2026-09-01', 'absence', NULL, '2025-11-23 23:20:34', '2025-11-23 23:20:34', NULL),
(186, 10, 1, '2025-11-24', 'absence', 'Exercitationem ipsum', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(187, 11, 1, '2025-11-24', 'attending', 'Natus voluptates lab', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(188, 13, 1, '2025-11-24', 'permission', 'Sint et asperiores l', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(189, 18, 1, '2025-11-24', 'attending', 'Sapiente voluptatem', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(190, 19, 1, '2025-11-24', 'attending', 'Non et eveniet quis', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(191, 21, 1, '2025-11-24', 'permission', 'Tempore reprehender', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(192, 22, 1, '2025-11-24', 'absence', 'Deserunt sunt quisqu', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(193, 24, 1, '2025-11-24', 'permission', 'Officiis dolor fugit', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(194, 26, 1, '2025-11-24', 'attending', 'Animi nulla volupta', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(195, 30, 1, '2025-11-24', 'permission', 'Dolor odio sit omni', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(196, 31, 1, '2025-11-24', 'attending', 'Dolore quia irure se', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(197, 34, 1, '2025-11-24', 'permission', 'Qui culpa alias duci', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(198, 35, 1, '2025-11-24', 'attending', 'Vero in quasi conseq', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(199, 36, 1, '2025-11-24', 'permission', 'Do consequatur cillu', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(200, 37, 1, '2025-11-24', 'permission', 'Omnis et proident p', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(201, 42, 1, '2025-11-24', 'permission', 'Et amet qui omnis s', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(202, 44, 1, '2025-11-24', 'attending', 'Et libero ut accusan', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(203, 45, 1, '2025-11-24', 'permission', 'Quo doloremque reici', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(204, 46, 1, '2025-11-24', 'permission', 'Esse laboriosam sap', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(205, 47, 1, '2025-11-24', 'absence', 'Neque et ipsum aut q', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(206, 48, 1, '2025-11-24', 'attending', 'Deleniti in harum ve', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(207, 49, 1, '2025-11-24', 'attending', 'Autem incidunt nobi', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(208, 50, 1, '2025-11-24', 'absence', 'Est recusandae Aliq', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(209, 51, 1, '2025-11-24', 'absence', 'Ut eveniet providen', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(210, 53, 1, '2025-11-24', 'attending', 'Iusto error unde vol', '2025-11-23 23:53:59', '2025-11-23 23:53:59', NULL),
(211, 10, 1, '2025-11-25', 'absence', 'Doloremque est aliq', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(212, 11, 1, '2025-11-25', 'attending', 'Magnam esse dolores', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(213, 13, 1, '2025-11-25', 'permission', 'Numquam porro tempor', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(214, 18, 1, '2025-11-25', 'permission', 'Sunt dolorem nostru', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(215, 19, 1, '2025-11-25', 'absence', 'Exercitationem repel', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(216, 21, 1, '2025-11-25', 'absence', 'Nulla occaecat provi', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(217, 22, 1, '2025-11-25', 'absence', 'Sunt ipsum veritati', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(218, 24, 1, '2025-11-25', 'attending', 'Inventore quo commod', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(219, 26, 1, '2025-11-25', 'absence', 'Ea fugit beatae ea', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(220, 30, 1, '2025-11-25', 'permission', 'Suscipit dolores com', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(221, 31, 1, '2025-11-25', 'attending', 'Rerum iure consequat', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(222, 34, 1, '2025-11-25', 'permission', 'Et ipsum nobis et re', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(223, 35, 1, '2025-11-25', 'attending', 'Similique ut volupta', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(224, 36, 1, '2025-11-25', 'attending', 'Qui dolores dolore p', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(225, 37, 1, '2025-11-25', 'attending', 'Officia eiusmod dolo', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(226, 42, 1, '2025-11-25', 'attending', 'Explicabo Qui omnis', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(227, 44, 1, '2025-11-25', 'attending', 'Anim ad dicta elit', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(228, 45, 1, '2025-11-25', 'attending', 'Laudantium ex nihil', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(229, 46, 1, '2025-11-25', 'attending', 'Est voluptatem sunt', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(230, 47, 1, '2025-11-25', 'permission', 'Minim ut enim aspern', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(231, 48, 1, '2025-11-25', 'permission', 'Voluptas anim volupt', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(232, 49, 1, '2025-11-25', 'permission', 'Ipsa at ipsa ipsum', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(233, 50, 1, '2025-11-25', 'permission', 'Aut voluptate deseru', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(234, 51, 1, '2025-11-25', 'absence', 'Quas ut ut reiciendi', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(235, 53, 1, '2025-11-25', 'attending', 'Ut aut maxime ration', '2025-11-23 23:54:52', '2025-11-23 23:54:52', NULL),
(236, 10, 1, '2025-11-26', 'absence', 'Fugiat ut magnam do', '2025-11-23 23:54:57', '2025-11-23 23:54:57', NULL),
(237, 11, 1, '2025-11-26', 'permission', 'Aut placeat laboris', '2025-11-23 23:54:57', '2025-11-23 23:54:57', NULL),
(238, 13, 1, '2025-11-26', 'permission', 'Aut error consequat', '2025-11-23 23:54:57', '2025-11-23 23:54:57', NULL),
(239, 18, 1, '2025-11-26', 'absence', 'Harum quia rerum qui', '2025-11-23 23:54:57', '2025-11-23 23:54:57', NULL),
(240, 19, 1, '2025-11-26', 'permission', 'Odit ab voluptatem n', '2025-11-23 23:54:57', '2025-11-23 23:54:57', NULL),
(241, 21, 1, '2025-11-26', 'permission', 'Quia quos eu odit ea', '2025-11-23 23:54:57', '2025-11-23 23:54:57', NULL),
(242, 22, 1, '2025-11-26', 'permission', 'Minus ut nulla quasi', '2025-11-23 23:54:57', '2025-11-23 23:54:57', NULL),
(243, 24, 1, '2025-11-26', 'permission', 'Ea exercitationem au', '2025-11-23 23:54:57', '2025-11-23 23:54:57', NULL),
(244, 26, 1, '2025-11-26', 'absence', 'Velit velit praesent', '2025-11-23 23:54:57', '2025-11-25 18:56:41', NULL),
(245, 30, 1, '2025-11-26', 'attending', 'Ut lorem quis volupt', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(246, 31, 1, '2025-11-26', 'permission', 'Omnis incidunt eius', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(247, 34, 1, '2025-11-26', 'permission', 'Inventore voluptas t', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(248, 35, 1, '2025-11-26', 'absence', 'Labore explicabo Au', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(249, 36, 1, '2025-11-26', 'absence', 'Expedita tempor inci', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(250, 37, 1, '2025-11-26', 'attending', 'Temporibus distincti', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(251, 42, 1, '2025-11-26', 'absence', 'Et ducimus repudian', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(252, 44, 1, '2025-11-26', 'permission', 'Non ratione autem li', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(253, 45, 1, '2025-11-26', 'attending', 'Necessitatibus asper', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(254, 46, 1, '2025-11-26', 'permission', 'Dicta impedit elige', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(255, 47, 1, '2025-11-26', 'attending', 'Incidunt amet repr', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(256, 48, 1, '2025-11-26', 'attending', 'Laborum Placeat ve', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(257, 49, 1, '2025-11-26', 'permission', 'Numquam dolores esse', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(258, 50, 1, '2025-11-26', 'attending', 'Mollit et aperiam co', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(259, 51, 1, '2025-11-26', 'attending', 'Quis velit accusanti', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(260, 53, 1, '2025-11-26', 'attending', 'In nemo sit invento', '2025-11-23 23:54:58', '2025-11-23 23:54:58', NULL),
(261, 10, 1, '2025-11-27', 'attending', 'Enim amet qui dolor', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(262, 11, 1, '2025-11-27', 'permission', 'Voluptate atque aute', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(263, 13, 1, '2025-11-27', 'permission', 'Eum culpa ex quo qui', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(264, 18, 1, '2025-11-27', 'attending', 'Velit optio et com', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(265, 19, 1, '2025-11-27', 'permission', 'Consequatur Duis no', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(266, 21, 1, '2025-11-27', 'absence', 'Voluptas debitis lau', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(267, 22, 1, '2025-11-27', 'attending', 'Voluptatem aliquip', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(268, 24, 1, '2025-11-27', 'permission', 'Sit excepturi ad vol', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(269, 26, 1, '2025-11-27', 'permission', 'Est commodi quisquam', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(270, 30, 1, '2025-11-27', 'permission', 'Odio quod nihil sit', '2025-11-23 23:55:03', '2025-11-23 23:55:03', NULL),
(271, 31, 1, '2025-11-27', 'permission', 'Sit est quos vel sin', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(272, 34, 1, '2025-11-27', 'permission', 'Non nisi in aute qui', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(273, 35, 1, '2025-11-27', 'attending', 'Laborum Consequat', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(274, 36, 1, '2025-11-27', 'attending', 'Delectus recusandae', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(275, 37, 1, '2025-11-27', 'absence', 'Minus cum commodo ni', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(276, 42, 1, '2025-11-27', 'permission', 'Obcaecati omnis quo', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(277, 44, 1, '2025-11-27', 'attending', 'Sunt sapiente aut re', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(278, 45, 1, '2025-11-27', 'absence', 'Velit quibusdam nisi', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(279, 46, 1, '2025-11-27', 'absence', 'Tempore numquam dig', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(280, 47, 1, '2025-11-27', 'attending', 'Animi officia eaque', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(281, 48, 1, '2025-11-27', 'absence', 'Perferendis et magna', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(282, 49, 1, '2025-11-27', 'permission', 'Anim dicta et sunt', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(283, 50, 1, '2025-11-27', 'permission', 'Sequi magna quo dolo', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(284, 51, 1, '2025-11-27', 'permission', 'Sit minima nihil vel', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL),
(285, 53, 1, '2025-11-27', 'attending', 'Aspernatur voluptatu', '2025-11-23 23:55:04', '2025-11-23 23:55:04', NULL);

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
(1, 1, 3, 2, 'morning', 'mon-wed', '08:00:00', '10:00:00', '2025-11-13', '2025-12-23', 21.00, '2025-11-23 03:56:28', '2025-11-24 00:54:30', NULL),
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
(20, 'Expense 19', 'Description for expense 19', 400.00, '2025-11-22', 3, 22, NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(21, 'Adipisicing voluptat', 'Qui cumque sapiente', 58.00, '2026-06-11', 1, 1, 1, '2025-11-23 22:26:51', '2025-11-23 22:40:05', NULL),
(22, 'Dolor sapiente esse', 'Cupidatat Nam est ea', 85.00, '2026-03-04', 1, NULL, 1, '2025-11-23 22:40:41', '2025-11-23 22:40:41', NULL),
(23, 'Debitis deserunt cup', 'Laudantium explicab', 60.00, '2025-05-31', 1, NULL, 1, '2025-11-27 12:50:40', '2025-11-27 12:50:40', NULL);

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
(3, 'Events', 'Events expenses', '2025-11-23 03:56:28', '2025-11-27 07:15:32', '2025-11-27 07:15:32'),
(4, 'Supplies', 'Supplies expenses', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `student_course_id` bigint UNSIGNED DEFAULT NULL,
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

INSERT INTO `fees` (`id`, `student_id`, `student_course_id`, `fee_type_id`, `created_by`, `amount`, `due_date`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, NULL, 3, NULL, 936.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(2, 7, NULL, 2, NULL, 707.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(3, 7, NULL, 4, NULL, 584.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 7, NULL, 1, NULL, 895.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(5, 8, NULL, 3, NULL, 502.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(6, 8, NULL, 2, NULL, 367.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(7, 8, NULL, 4, NULL, 590.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(8, 8, NULL, 1, NULL, 824.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(9, 9, NULL, 3, NULL, 955.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(10, 9, NULL, 2, NULL, 608.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(11, 9, NULL, 4, NULL, 308.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(12, 9, NULL, 1, NULL, 478.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(13, 10, NULL, 3, NULL, 884.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(14, 10, NULL, 2, NULL, 382.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(15, 10, NULL, 4, NULL, 146.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(16, 10, NULL, 1, NULL, 362.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(17, 11, NULL, 3, NULL, 622.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(18, 11, NULL, 2, NULL, 485.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(19, 11, NULL, 4, NULL, 138.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(20, 11, NULL, 1, NULL, 645.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(21, 12, NULL, 3, NULL, 325.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(22, 12, NULL, 2, NULL, 215.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(23, 12, NULL, 4, NULL, 316.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(24, 12, NULL, 1, NULL, 464.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(25, 13, NULL, 3, NULL, 765.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(26, 13, NULL, 2, NULL, 528.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(27, 13, NULL, 4, NULL, 566.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(28, 13, NULL, 1, NULL, 408.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(29, 14, NULL, 3, NULL, 244.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(30, 14, NULL, 2, NULL, 441.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(31, 14, NULL, 4, NULL, 694.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(32, 14, NULL, 1, NULL, 916.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(33, 15, NULL, 3, NULL, 791.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(34, 15, NULL, 2, NULL, 513.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(35, 15, NULL, 4, NULL, 966.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(36, 15, NULL, 1, NULL, 498.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(37, 16, NULL, 3, NULL, 519.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(38, 16, NULL, 2, NULL, 163.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(39, 16, NULL, 4, NULL, 918.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(40, 16, NULL, 1, NULL, 610.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(41, 17, NULL, 3, NULL, 796.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(42, 17, NULL, 2, NULL, 990.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(43, 17, NULL, 4, NULL, 501.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(44, 17, NULL, 1, NULL, 291.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(45, 18, NULL, 3, NULL, 719.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(46, 18, NULL, 2, NULL, 298.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(47, 18, NULL, 4, NULL, 239.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(48, 18, NULL, 1, NULL, 883.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(49, 19, NULL, 3, NULL, 260.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(50, 19, NULL, 2, NULL, 403.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(51, 19, NULL, 4, NULL, 874.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(52, 19, NULL, 1, NULL, 512.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(53, 20, NULL, 3, NULL, 827.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(54, 20, NULL, 2, NULL, 459.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(55, 20, NULL, 4, NULL, 952.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(56, 20, NULL, 1, NULL, 719.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(57, 21, NULL, 3, NULL, 335.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(58, 21, NULL, 2, NULL, 590.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(59, 21, NULL, 4, NULL, 677.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(60, 21, NULL, 1, NULL, 642.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(61, 22, NULL, 3, NULL, 549.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(62, 22, NULL, 2, NULL, 869.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(63, 22, NULL, 4, NULL, 991.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(64, 22, NULL, 1, NULL, 320.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(65, 23, NULL, 3, NULL, 373.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(66, 23, NULL, 2, NULL, 854.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(67, 23, NULL, 4, NULL, 341.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(68, 23, NULL, 1, NULL, 245.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(69, 24, NULL, 3, NULL, 849.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(70, 24, NULL, 2, NULL, 642.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(71, 24, NULL, 4, NULL, 978.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(72, 24, NULL, 1, NULL, 697.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(73, 25, NULL, 3, NULL, 953.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(74, 25, NULL, 2, NULL, 507.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(75, 25, NULL, 4, NULL, 614.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(76, 25, NULL, 1, NULL, 477.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(77, 26, NULL, 3, NULL, 495.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(78, 26, NULL, 2, NULL, 805.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(79, 26, NULL, 4, NULL, 970.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(80, 26, NULL, 1, NULL, 462.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(81, 27, NULL, 3, NULL, 268.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(82, 27, NULL, 2, NULL, 150.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(83, 27, NULL, 4, NULL, 296.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(84, 27, NULL, 1, NULL, 465.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(85, 28, NULL, 3, NULL, 264.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(86, 28, NULL, 2, NULL, 775.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(87, 28, NULL, 4, NULL, 593.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(88, 28, NULL, 1, NULL, 142.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(89, 29, NULL, 3, NULL, 727.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(90, 29, NULL, 2, NULL, 604.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(91, 29, NULL, 4, NULL, 690.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(92, 29, NULL, 1, NULL, 917.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(93, 30, NULL, 3, NULL, 186.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(94, 30, NULL, 2, NULL, 289.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(95, 30, NULL, 4, NULL, 758.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(96, 30, NULL, 1, NULL, 557.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(97, 31, NULL, 3, NULL, 892.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(98, 31, NULL, 2, NULL, 405.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(99, 31, NULL, 4, NULL, 718.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(100, 31, NULL, 1, NULL, 196.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(101, 32, NULL, 3, NULL, 374.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(102, 32, NULL, 2, NULL, 152.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(103, 32, NULL, 4, NULL, 503.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(104, 32, NULL, 1, NULL, 592.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(105, 33, NULL, 3, NULL, 400.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(106, 33, NULL, 2, NULL, 245.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(107, 33, NULL, 4, NULL, 807.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(108, 33, NULL, 1, NULL, 656.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(109, 34, NULL, 3, NULL, 935.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(110, 34, NULL, 2, NULL, 782.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(111, 34, NULL, 4, NULL, 708.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(112, 34, NULL, 1, NULL, 521.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(113, 35, NULL, 3, NULL, 967.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(114, 35, NULL, 2, NULL, 284.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(115, 35, NULL, 4, NULL, 438.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(116, 35, NULL, 1, NULL, 825.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(117, 36, NULL, 3, NULL, 230.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(118, 36, NULL, 2, NULL, 127.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(119, 36, NULL, 4, NULL, 563.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(120, 36, NULL, 1, NULL, 312.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(121, 37, NULL, 3, NULL, 745.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(122, 37, NULL, 2, NULL, 497.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(123, 37, NULL, 4, NULL, 631.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(124, 37, NULL, 1, NULL, 127.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(125, 38, NULL, 3, NULL, 618.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(126, 38, NULL, 2, NULL, 723.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(127, 38, NULL, 4, NULL, 703.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(128, 38, NULL, 1, NULL, 773.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(129, 39, NULL, 3, NULL, 228.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(130, 39, NULL, 2, NULL, 967.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(131, 39, NULL, 4, NULL, 719.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(132, 39, NULL, 1, NULL, 665.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(133, 40, NULL, 3, NULL, 926.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(134, 40, NULL, 2, NULL, 734.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(135, 40, NULL, 4, NULL, 156.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(136, 40, NULL, 1, NULL, 924.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(137, 41, NULL, 3, NULL, 302.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(138, 41, NULL, 2, NULL, 643.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(139, 41, NULL, 4, NULL, 253.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(140, 41, NULL, 1, NULL, 360.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(141, 42, NULL, 3, NULL, 284.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(142, 42, NULL, 2, NULL, 932.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(143, 42, NULL, 4, NULL, 949.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(144, 42, NULL, 1, NULL, 210.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(145, 43, NULL, 3, NULL, 804.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(146, 43, NULL, 2, NULL, 486.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(147, 43, NULL, 4, NULL, 212.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(148, 43, NULL, 1, NULL, 490.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(149, 44, NULL, 3, NULL, 446.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(150, 44, NULL, 2, NULL, 315.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(151, 44, NULL, 4, NULL, 877.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(152, 44, NULL, 1, NULL, 366.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(153, 45, NULL, 3, NULL, 414.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(154, 45, NULL, 2, NULL, 793.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(155, 45, NULL, 4, NULL, 172.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(156, 45, NULL, 1, NULL, 855.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(157, 46, NULL, 3, NULL, 663.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(158, 46, NULL, 2, NULL, 170.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(159, 46, NULL, 4, NULL, 332.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(160, 46, NULL, 1, NULL, 423.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(161, 47, NULL, 3, NULL, 479.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(162, 47, NULL, 2, NULL, 215.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(163, 47, NULL, 4, NULL, 668.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(164, 47, NULL, 1, NULL, 355.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(165, 48, NULL, 3, NULL, 307.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(166, 48, NULL, 2, NULL, 795.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(167, 48, NULL, 4, NULL, 269.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(168, 48, NULL, 1, NULL, 584.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(169, 49, NULL, 3, NULL, 612.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(170, 49, NULL, 2, NULL, 378.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(171, 49, NULL, 4, NULL, 110.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(172, 49, NULL, 1, NULL, 581.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(173, 50, NULL, 3, NULL, 556.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(174, 50, NULL, 2, NULL, 544.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(175, 50, NULL, 4, NULL, 671.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(176, 50, NULL, 1, NULL, 804.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(177, 51, NULL, 3, NULL, 209.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(178, 51, NULL, 2, NULL, 522.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(179, 51, NULL, 4, NULL, 910.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(180, 51, NULL, 1, NULL, 268.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(181, 52, NULL, 3, NULL, 635.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(182, 52, NULL, 2, NULL, 378.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(183, 52, NULL, 4, NULL, 734.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(184, 52, NULL, 1, NULL, 559.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(185, 53, NULL, 3, NULL, 416.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(186, 53, NULL, 2, NULL, 334.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(187, 53, NULL, 4, NULL, 132.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(188, 53, NULL, 1, NULL, 943.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(189, 54, NULL, 3, NULL, 446.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(190, 54, NULL, 2, NULL, 602.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(191, 54, NULL, 4, NULL, 360.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(192, 54, NULL, 1, NULL, 237.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(193, 55, NULL, 3, NULL, 245.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(194, 55, NULL, 2, NULL, 729.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(195, 55, NULL, 4, NULL, 341.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(196, 55, NULL, 1, NULL, 801.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(197, 56, NULL, 3, NULL, 630.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(198, 56, NULL, 2, NULL, 318.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(199, 56, NULL, 4, NULL, 238.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(200, 56, NULL, 1, NULL, 611.00, '2025-12-23', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(201, 41, NULL, 4, 1, 12.00, '1989-04-19', 'Consequatur Animi', '2025-11-23 23:39:12', '2025-11-23 23:39:12', NULL),
(202, 41, NULL, 4, 1, 12.00, '1989-04-19', 'Consequatur Animi', '2025-11-23 23:39:53', '2025-11-23 23:39:53', NULL),
(203, 47, NULL, 1, 1, 18.00, '1997-03-19', 'Debitis dolore qui q', '2025-11-23 23:40:09', '2025-11-23 23:40:09', NULL),
(204, 27, NULL, 1, 1, 21.00, NULL, NULL, '2025-11-27 21:36:42', '2025-11-27 21:36:42', NULL),
(205, 27, NULL, 7, 1, 21.00, NULL, NULL, '2025-11-27 21:36:42', '2025-11-27 21:36:42', NULL),
(206, 32, NULL, 7, 1, 21.00, NULL, NULL, '2025-11-27 21:37:19', '2025-11-27 21:37:19', NULL);

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
(1, 'Course Fee', 'Tuition fee', '2025-11-23 03:56:28', '2025-11-27 21:32:43', NULL),
(2, 'Library', 'Library fee', '2025-11-23 03:56:28', '2025-11-26 23:41:55', '2025-11-26 23:41:55'),
(3, 'Lab', 'Lab fee', '2025-11-23 03:56:28', '2025-11-23 03:56:28', NULL),
(4, 'Sports', 'Sports fee', '2025-11-23 03:56:28', '2025-11-26 23:41:58', '2025-11-26 23:41:58'),
(5, 'William Sandoval', 'Consequuntur et dolo', '2025-11-23 23:39:05', '2025-11-26 23:13:45', '2025-11-26 23:13:45'),
(6, 'Registration', NULL, '2025-11-27 00:12:43', '2025-11-27 07:30:44', '2025-11-27 07:30:44'),
(7, 'Tuition', 'Default tuition fee type', '2025-11-27 21:36:42', '2025-11-27 21:36:42', NULL);

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
(5, '2025_11_24_042750_update_status_enum_in_attendances_table', 2),
(6, '2025_11_24_051614_create_notifications_table', 3),
(7, '2025_11_24_070857_update_exam_types_in_exams_table', 4),
(9, '2025_11_27_061207_update_fee_and_payment_tables_remove_unused_fields', 5),
(10, '2025_11_27_191307_add_student_course_id_to_fees_table', 6);

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
(3, 'App\\Models\\User', 56),
(3, 'App\\Models\\User', 57),
(3, 'App\\Models\\User', 58),
(2, 'App\\Models\\User', 59),
(3, 'App\\Models\\User', 60),
(2, 'App\\Models\\User', 61),
(3, 'App\\Models\\User', 61),
(12, 'App\\Models\\User', 61),
(3, 'App\\Models\\User', 62);

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
('0b05cfe8-fda5-482b-bc21-1ec1b6323574', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received\",\"body\":\"Payment of $142.00 was received for Fee #88\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/88\"}', NULL, '2025-11-27 12:46:01', '2025-11-27 12:46:01'),
('19f884c5-076e-4391-bb47-4637a15b9fea', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 61, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $284.00 was received for Fee #141\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/141\"}', NULL, '2025-11-27 12:47:54', '2025-11-27 12:47:54'),
('212be3e5-a385-4e9f-80c7-2f455f9a924e', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $284.00 was received for Fee #141\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/141\"}', NULL, '2025-11-27 12:47:54', '2025-11-27 12:47:54'),
('28b9f8fd-52a0-4a60-9b2b-9caa400c14b9', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 61, '{\"title\":\"New Payment Received\",\"body\":\"Payment of $804.00 was received for Fee #145\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/145\"}', NULL, '2025-11-27 12:46:14', '2025-11-27 12:46:14'),
('3de22ae8-0d06-484e-9adb-6410eabf80a5', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 61, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $446.00 was received for Fee #149\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/149\"}', NULL, '2025-11-27 12:47:36', '2025-11-27 12:47:36'),
('5b1976b8-1a82-4f78-a671-07cfefd74307', 'App\\Notifications\\ExpenseCreated', 'App\\Models\\User', 1, '{\"title\":\"New Expense Submitted\",\"body\":\"A new expense of $60.00 was submitted for category: Maintenance\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expenses\\/23\"}', NULL, '2025-11-27 12:50:40', '2025-11-27 12:50:40'),
('645d3c20-ce42-4091-96cc-b5e9293c4e82', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 61, '{\"title\":\"New Payment Received\",\"body\":\"Payment of $745.00 was received for Fee #121\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/121\"}', NULL, '2025-11-27 12:46:21', '2025-11-27 12:46:21'),
('694581d9-f51e-4450-9706-f526e02fb58c', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received\",\"body\":\"Payment of $745.00 was received for Fee #121\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/121\"}', NULL, '2025-11-27 12:46:21', '2025-11-27 12:46:21'),
('6e97e7c6-5aea-48cb-bf50-2762a95fcc00', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 61, '{\"title\":\"New Payment Received\",\"body\":\"Payment of $142.00 was received for Fee #88\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/88\"}', NULL, '2025-11-27 12:46:01', '2025-11-27 12:46:01'),
('97eeb511-6f3a-45c9-bd1c-a18c1ad6f9f0', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 41, '{\"title\":\"New Sports Assigned\",\"body\":\"You have been assigned a new fee of $12.00 (Due: Apr 19, 1989).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/202\",\"status\":\"partially_paid\"}', NULL, '2025-11-23 23:39:53', '2025-11-23 23:39:53'),
('9e7aee45-25af-4921-ad0d-84ed53935093', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received (Admin User)\",\"body\":\"Payment of $446.00 was received for Fee #149\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/149\"}', NULL, '2025-11-27 12:47:36', '2025-11-27 12:47:36'),
('a4eb32a5-784e-4435-bb64-c67ebfe837c6', 'App\\Notifications\\ExpenseCreated', 'App\\Models\\User', 1, '{\"title\":\"New Expense Submitted\",\"body\":\"A new expense of $58.00 was submitted for category: Maintenance\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expenses\\/21\"}', '2025-11-23 22:40:26', '2025-11-23 22:26:51', '2025-11-23 22:40:26'),
('ba1d402c-6c10-4040-a413-02218df85e60', 'App\\Notifications\\ExpenseCreated', 'App\\Models\\User', 61, '{\"title\":\"New Expense Submitted\",\"body\":\"A new expense of $60.00 was submitted for category: Maintenance\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expenses\\/23\"}', NULL, '2025-11-27 12:50:40', '2025-11-27 12:50:40'),
('cbc340fa-9d8d-47c7-9d61-06917f761167', 'App\\Notifications\\PaymentReceived', 'App\\Models\\User', 1, '{\"title\":\"New Payment Received\",\"body\":\"Payment of $804.00 was received for Fee #145\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/145\"}', NULL, '2025-11-27 12:46:14', '2025-11-27 12:46:14'),
('d19c0be0-0723-4aa9-b708-d81ebc9033b1', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 47, '{\"title\":\"New Tuition Assigned\",\"body\":\"You have been assigned a new fee of $18.00 (Due: Mar 19, 1997).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/203\",\"status\":\"unpaid\"}', NULL, '2025-11-23 23:40:09', '2025-11-23 23:40:09'),
('da6b7099-c589-442b-801c-df79472408ca', 'App\\Notifications\\ExpenseCreated', 'App\\Models\\User', 1, '{\"title\":\"New Expense Submitted\",\"body\":\"A new expense of $85.00 was submitted for category: Maintenance\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expenses\\/22\"}', '2025-11-24 00:18:36', '2025-11-23 22:40:41', '2025-11-24 00:18:36');

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
(1, 611.00, '2025-11-27', 'Cash', 'SCMS-FR09-FVHN-4560-47SB', NULL, 1, 200, '2025-11-27 11:09:51', '2025-11-27 11:09:51', NULL),
(2, 773.00, '2025-11-27', 'Cash', 'SCMS-JEU8-Z2EP-C8S2-HOVP', NULL, 1, 128, '2025-11-27 11:13:33', '2025-11-27 11:13:33', NULL),
(5, 366.00, '2025-11-27', 'Cash', 'SCMS-ABQ2-U7SC-VV4U-4C19', NULL, 1, 152, '2025-11-27 11:13:52', '2025-11-27 11:13:52', NULL),
(7, 490.00, '2025-11-27', 'Cash', 'SCMS-OX6B-U0ZM-9XUM-C6H6', NULL, 1, 148, '2025-11-27 11:14:40', '2025-11-27 11:14:40', NULL),
(8, 210.00, '2025-11-27', 'Cash', 'SCMS-IY8G-FM4F-GMC5-G47D', NULL, 1, 144, '2025-11-27 11:21:11', '2025-11-27 11:21:11', NULL),
(9, 618.00, '2025-11-27', 'Cash', 'SCMS-3BTC-OJGS-DGHG-MGMT', NULL, 1, 125, '2025-11-27 11:27:58', '2025-11-27 11:27:58', NULL),
(10, 825.00, '2025-11-27', 'Cash', 'SCMS-EY6X-W5N9-FOF8-V1J7', NULL, 1, 116, '2025-11-27 12:42:24', '2025-11-27 12:42:24', NULL),
(11, 18.00, '2025-11-27', 'Cash', 'SCMS-176H-E4N0-M7H7-OUJ2', NULL, 1, 203, '2025-11-27 12:42:33', '2025-11-27 12:42:33', NULL),
(12, 142.00, '2025-11-27', 'Cash', 'SCMS-RJAA-71GQ-499J-PBUJ', NULL, 1, 88, '2025-11-27 12:46:01', '2025-11-27 12:46:01', NULL),
(13, 804.00, '2025-11-27', 'Cash', 'SCMS-CN5V-3Q6R-E6D6-TUW2', NULL, 1, 145, '2025-11-27 12:46:14', '2025-11-27 12:46:14', NULL),
(14, 745.00, '2025-11-27', 'Cash', 'SCMS-2B2D-B3EL-PJ18-247F', NULL, 1, 121, '2025-11-27 12:46:21', '2025-11-27 12:46:21', NULL),
(15, 446.00, '2025-11-27', 'Cash', 'SCMS-H2CQ-QLCQ-WP1U-3W24', NULL, 1, 149, '2025-11-27 12:47:36', '2025-11-27 12:47:36', NULL),
(16, 284.00, '2025-11-27', 'Cash', 'SCMS-Y2SQ-O4X3-9H8G-LPCY', NULL, 1, 141, '2025-11-27 12:47:54', '2025-11-27 12:47:54', NULL);

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
(61, 'create_attendance', 'web', '2025-11-27 03:28:31', '2025-11-27 03:28:31'),
(62, 'view_attendance', 'web', '2025-11-27 03:28:31', '2025-11-27 03:28:31'),
(63, 'update_attendance', 'web', '2025-11-27 03:28:31', '2025-11-27 03:28:31'),
(64, 'delete_attendance', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(65, 'create_classroom', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(66, 'view_classroom', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(67, 'update_classroom', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(68, 'delete_classroom', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(69, 'create_course-offering', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(70, 'view_course-offering', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(71, 'update_course-offering', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(72, 'delete_course-offering', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(73, 'create_exam', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(74, 'view_exam', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(75, 'update_exam', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(76, 'delete_exam', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(77, 'create_expense', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(78, 'view_expense', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(79, 'update_expense', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(80, 'delete_expense', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(81, 'create_expense-category', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(82, 'view_expense-category', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(83, 'update_expense-category', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(84, 'delete_expense-category', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(85, 'create_fee', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(86, 'view_fee', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(87, 'update_fee', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(88, 'delete_fee', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(89, 'create_fee-type', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(90, 'view_fee-type', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(91, 'update_fee-type', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(92, 'delete_fee-type', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(93, 'create_payment', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(94, 'view_payment', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(95, 'update_payment', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(96, 'delete_payment', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(97, 'create_score', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(98, 'view_score', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(99, 'update_score', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(100, 'delete_score', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(101, 'create_student-course', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(102, 'view_student-course', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(103, 'update_student-course', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(104, 'delete_student-course', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(105, 'create_subject', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(106, 'view_subject', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(107, 'update_subject', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(108, 'delete_subject', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(109, 'create_user', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(110, 'view_user', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(111, 'update_user', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(112, 'delete_user', 'web', '2025-11-27 03:28:32', '2025-11-27 03:28:32'),
(113, 'create_role', 'web', '2025-11-27 03:37:25', '2025-11-27 03:37:25'),
(114, 'view_role', 'web', '2025-11-27 03:37:25', '2025-11-27 03:37:25'),
(115, 'update_role', 'web', '2025-11-27 03:37:25', '2025-11-27 03:37:25'),
(116, 'delete_role', 'web', '2025-11-27 03:37:25', '2025-11-27 03:37:25'),
(117, 'create_permission', 'web', '2025-11-27 03:37:25', '2025-11-27 03:37:25'),
(118, 'view_permission', 'web', '2025-11-27 03:37:25', '2025-11-27 03:37:25'),
(119, 'update_permission', 'web', '2025-11-27 03:37:25', '2025-11-27 03:37:25'),
(120, 'delete_permission', 'web', '2025-11-27 03:37:25', '2025-11-27 03:37:25'),
(121, 'create_teacher', 'web', '2025-11-27 03:42:34', '2025-11-27 03:42:34'),
(122, 'view_teacher', 'web', '2025-11-27 03:42:34', '2025-11-27 03:42:34'),
(123, 'update_teacher', 'web', '2025-11-27 03:42:34', '2025-11-27 03:42:34'),
(124, 'delete_teacher', 'web', '2025-11-27 03:42:34', '2025-11-27 03:42:34'),
(125, 'create_student', 'web', '2025-11-27 03:42:34', '2025-11-27 03:42:34'),
(126, 'view_student', 'web', '2025-11-27 03:42:34', '2025-11-27 03:42:34'),
(127, 'update_student', 'web', '2025-11-27 03:42:34', '2025-11-27 03:42:34'),
(128, 'delete_student', 'web', '2025-11-27 03:42:34', '2025-11-27 03:42:34');

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
(12, 'staff', 'web', '2025-11-25 02:54:26', '2025-11-25 02:54:26');

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
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1);

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

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `student_id`, `exam_id`, `score`, `grade`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 1, 79, 'B+', 'Ut officiis dolores', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(2, 11, 1, 99, 'A+', 'Aperiam veniam solu', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(3, 13, 1, 7, 'F', 'Asperiores est repud', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(4, 18, 1, 96, 'A+', 'Laborum nobis possim', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(5, 19, 1, 88, 'A', 'Nulla officia deseru', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(6, 21, 1, 77, 'B+', 'Est architecto moles', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(7, 22, 1, 72, 'B+', 'Accusamus exercitati', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(8, 24, 1, 17, 'F', 'Consectetur dolorem', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(9, 26, 1, 29, 'F', 'Praesentium dolores', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(10, 30, 1, 90, 'A+', 'Nostrum aut optio i', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(11, 31, 1, 9, 'F', 'Iusto culpa minus la', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(12, 34, 1, 17, 'F', 'Et minima eum id po', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(13, 35, 1, 41, 'C', 'In et amet vel volu', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(14, 36, 1, 25, 'F', 'Deserunt eos anim e', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(15, 37, 1, 28, 'F', 'Aute accusamus nisi', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(16, 42, 1, 67, 'B', 'Ex inventore repelle', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(17, 44, 1, 37, 'D', 'Qui proident ut ani', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(18, 45, 1, 9, 'F', 'In exercitationem in', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(19, 46, 1, 69, 'B', 'Nihil obcaecati minu', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(20, 47, 1, 1, 'F', 'Rem enim nostrud id', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(21, 48, 1, 7, 'F', 'Nisi doloremque maxi', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(22, 49, 1, 9, 'F', 'Aliquam beatae neces', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(23, 50, 1, 28, 'F', 'Quibusdam quam ipsum', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(24, 51, 1, 86, 'A', 'Consequuntur aut sun', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(25, 53, 1, 58, 'C+', 'Sit et ipsum fugit', '2025-11-23 23:26:10', '2025-11-27 05:55:35', NULL),
(26, 9, 1, 82, 'A', 'Dolor eius optio si', '2025-11-27 05:55:35', '2025-11-27 05:55:35', NULL),
(27, 20, 1, 63, 'B', 'Rerum suscipit ea no', '2025-11-27 05:55:35', '2025-11-27 05:55:35', NULL),
(28, 38, 1, 12, 'F', 'Proident rerum aut', '2025-11-27 05:55:35', '2025-11-27 05:55:35', NULL),
(29, 41, 1, 21, 'F', 'Ad commodi vero even', '2025-11-27 05:55:35', '2025-11-27 05:55:35', NULL),
(30, 61, 1, 79, 'B+', 'Consequat Dolorum l', '2025-11-27 05:55:35', '2025-11-27 05:55:35', NULL),
(31, 62, 1, 87, 'A', 'Eu qui magna consequ', '2025-11-27 05:55:35', '2025-11-27 05:55:35', NULL);

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
('6X97XoIDVTrgJr0b0DMNde6yn8cBPdtGUyOPw3t9', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT0hzOEhTRWZnQThBNzVvMlNGdzBidmhySVFaZnZUcG04SkJycFVIcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODEwMi9hZG1pbi9jb3Vyc2Vfb2ZmZXJpbmdzIjtzOjU6InJvdXRlIjtzOjI4OiJhZG1pbi5jb3Vyc2Vfb2ZmZXJpbmdzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764229822),
('n0J5JRDS50b79tX7NDEKIjeorlrqxGlN5cNS3dy9', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicXF1M1V4UEZMY2FGUmE5RjB6NGRTMzFxYm5ZUENJcHdSSUlqQUVrYiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjYwOiJodHRwOi8vMTI3LjAuMC4xOjgxMDIvYWRtaW4vYXR0ZW5kYW5jZXM/Y291cnNlX29mZmVyaW5nX2lkPTIiO3M6NToicm91dGUiO3M6MjM6ImFkbWluLmF0dGVuZGFuY2VzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764305567),
('PDzuE4ltb3KE6JE5irvg85JCmZU6tPc96ZxSJrxP', 3, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUGZKQUcwOE03Wm1ubFN3dUUwY3R4S0ZxYTFJZVVCQnVNc0x4V2NaVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODEwMi9hZG1pbi9mZWVfdHlwZXMiO3M6NToicm91dGUiO3M6MjE6ImFkbWluLmZlZV90eXBlcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzY0MTgxNjU4O319', 1764182257),
('TF7omJUlj1WlI8JwPn0M2iPmfLhfhdLr7zHJ28RY', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTjByM1FWS0s0SnJTS3JuVTFQNFZvcE56WVg3WjU2bzZSUEVFNlVDZSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjY0OiJodHRwOi8vMTI3LjAuMC4xOjgxMDIvYWRtaW4vc3R1ZGVudF9jb3Vyc2VzP2NvdXJzZV9vZmZlcmluZ19pZD0xIjtzOjU6InJvdXRlIjtzOjI3OiJhZG1pbi5zdHVkZW50X2NvdXJzZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NjoibG9jYWxlIjtzOjI6ImVuIjt9', 1764304639);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `grade_final` decimal(5,2) DEFAULT NULL,
  `status` enum('studying','suspended','dropped','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'studying',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `course_offering_id`, `grade_final`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(7, 3, 83.44, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(7, 4, 90.08, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(7, 5, 70.74, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(8, 3, 98.63, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(8, 4, 61.13, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(8, 5, 66.55, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(9, 1, NULL, 'studying', NULL, '2025-11-26 10:53:29', '2025-11-26 10:53:29'),
(9, 2, 60.69, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(9, 3, NULL, 'studying', NULL, '2025-11-26 10:58:30', '2025-11-26 10:58:30'),
(9, 4, 68.07, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(9, 5, 65.39, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(10, 1, 90.99, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(10, 2, 81.95, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(10, 5, 96.92, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(11, 1, 84.95, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(11, 2, 78.47, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(11, 3, 86.51, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(12, 2, 98.11, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(12, 3, 76.09, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(12, 4, 99.82, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(13, 1, 82.85, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(13, 2, 82.35, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(13, 3, NULL, 'studying', NULL, '2025-11-26 10:58:17', '2025-11-26 10:58:17'),
(13, 5, 95.91, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(14, 2, 77.40, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(14, 3, 93.24, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(14, 4, 69.02, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(15, 2, 87.76, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(15, 3, 65.34, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(15, 5, 75.45, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(16, 2, 66.89, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(16, 3, 91.48, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(16, 4, 70.00, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(17, 2, 80.61, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(17, 3, 64.25, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(17, 5, 70.93, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(18, 1, 99.43, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(18, 4, 87.19, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(18, 5, 62.74, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(19, 1, 64.80, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(19, 4, 99.34, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(19, 5, 87.04, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(20, 1, NULL, 'studying', NULL, '2025-11-26 10:54:06', '2025-11-26 10:54:06'),
(20, 3, 86.66, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(20, 4, 95.59, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(20, 5, 82.35, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(21, 1, 74.54, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(21, 4, 95.10, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(21, 5, 93.96, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(22, 1, 61.71, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(22, 2, 86.45, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(22, 5, 90.99, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(23, 3, 75.41, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(23, 4, 98.86, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(23, 5, 66.10, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(24, 1, 72.86, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(24, 2, 71.50, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(24, 4, 84.98, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(25, 2, 85.04, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(25, 3, 95.07, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(25, 4, 73.43, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(26, 1, 94.93, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(26, 2, 79.33, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(26, 5, 70.49, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(27, 1, NULL, 'studying', NULL, '2025-11-27 21:36:42', '2025-11-27 21:36:42'),
(27, 3, 76.64, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(27, 4, 69.33, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(27, 5, 63.48, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(28, 2, 74.56, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(28, 4, 65.55, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(28, 5, 67.72, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(29, 2, 62.07, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(29, 4, 90.35, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(29, 5, 92.64, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(30, 1, 94.60, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(30, 2, 63.65, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(30, 5, 71.45, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(31, 1, 71.12, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(31, 4, 98.06, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(31, 5, 93.94, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(32, 1, NULL, 'studying', NULL, '2025-11-27 21:37:19', '2025-11-27 21:37:19'),
(32, 2, 63.82, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(32, 4, 88.59, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(32, 5, 75.89, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(33, 1, NULL, 'studying', NULL, '2025-11-27 21:15:44', '2025-11-27 21:15:44'),
(33, 2, 65.28, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(33, 3, 90.62, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(33, 5, 60.43, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(34, 1, 87.39, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(34, 2, 75.92, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(34, 5, 76.02, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(35, 1, 78.52, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(35, 4, 86.21, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(35, 5, 94.08, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(36, 1, 99.27, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(36, 2, 67.88, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(36, 3, 69.74, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(37, 1, 93.25, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(37, 2, 62.48, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(37, 5, 78.13, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(38, 1, NULL, 'studying', NULL, '2025-11-26 10:46:19', '2025-11-26 10:46:19'),
(38, 2, 66.48, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(38, 3, NULL, 'studying', NULL, '2025-11-26 10:58:35', '2025-11-26 10:58:35'),
(38, 4, 77.61, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(38, 5, 98.71, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(39, 3, 69.74, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(39, 4, 65.70, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(39, 5, 99.74, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(40, 2, 94.47, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(40, 3, 70.66, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(40, 4, 60.88, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(41, 1, NULL, 'studying', 'Consectetur dolorem', '2025-11-26 10:46:11', '2025-11-26 10:46:11'),
(41, 3, 73.77, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(41, 4, 77.17, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(41, 5, 75.41, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(42, 1, 87.15, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(42, 3, 81.86, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(42, 4, 93.12, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(43, 3, 76.59, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(43, 4, 78.79, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(43, 5, 91.18, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(44, 1, 65.11, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(44, 3, 76.66, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(44, 5, 80.54, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(45, 1, 92.66, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(45, 2, 68.05, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(45, 4, 89.05, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(46, 1, 68.52, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(46, 2, 81.35, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(46, 3, 88.94, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(47, 1, 65.98, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(47, 2, 84.17, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(47, 3, 85.27, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(48, 1, 84.81, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(48, 4, 93.57, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(48, 5, 92.55, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(49, 1, 77.65, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(49, 2, 91.94, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(49, 3, 74.10, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(50, 1, 76.53, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(50, 3, 66.45, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(50, 4, 82.00, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(51, 1, 92.72, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(51, 2, 83.07, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(51, 5, 70.91, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(52, 2, 74.56, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(52, 3, 64.67, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(52, 5, 73.80, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(53, 1, 82.79, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(53, 3, 65.88, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(53, 5, 71.22, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(54, 3, 62.68, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(54, 4, 97.33, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(54, 5, 79.39, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(55, 2, 86.19, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(55, 3, 88.60, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(55, 4, 70.77, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(56, 3, 86.26, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(56, 4, 71.24, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(56, 5, 89.69, 'studying', NULL, '2025-11-23 03:56:28', '2025-11-23 03:56:28'),
(57, 1, NULL, 'studying', NULL, '2025-11-27 12:31:16', '2025-11-27 12:31:16'),
(61, 1, NULL, 'studying', NULL, '2025-11-26 10:46:37', '2025-11-26 10:46:37'),
(61, 2, NULL, 'studying', NULL, '2025-11-26 11:18:35', '2025-11-26 11:18:35'),
(62, 1, NULL, 'studying', NULL, '2025-11-26 11:17:14', '2025-11-26 11:17:14'),
(62, 2, NULL, 'studying', NULL, '2025-11-26 11:17:50', '2025-11-26 11:17:50'),
(62, 4, NULL, 'studying', NULL, '2025-11-26 11:17:21', '2025-11-26 11:17:21'),
(62, 5, NULL, 'studying', NULL, '2025-11-26 11:18:10', '2025-11-26 11:18:10');

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
(1, 'British Literature', 'CS101', 'Introduction to Programming course description.', 1, '2025-11-23 03:56:28', '2025-11-27 05:44:46', NULL),
(2, 'Office Word I', 'CS202', 'Data Structures course description.', 1, '2025-11-23 03:56:28', '2025-11-27 05:44:28', NULL),
(3, 'Office Word II', 'ENGL250', 'British Literature course description.', 3, '2025-11-23 03:56:28', '2025-11-27 05:44:41', NULL),
(4, 'Office Excel I', 'ENGL301', 'Creative Writing course description.', 3, '2025-11-23 03:56:28', '2025-11-27 05:45:33', NULL),
(5, 'Office Excel II', 'MATH150', 'Calculus I course description.', 4, '2025-11-23 03:56:28', '2025-11-27 05:45:46', NULL);

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
(56, 'Oscar Huff', 'pano@mailinator.com', '2025-11-23 03:56:28', '$2y$12$N.Oij/zwS2Zzqy.R/MjyuuHZm.ZTnBhr1P1rzC.jghZs1uK9zmrXG', '+1 (731) 351-5133', 'Quidem ipsa rerum e', '1973-07-20', 'other', NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Deserunt fugiat nem', 'Impedit nulla corru', '1973-12-09', 'Et nulla tempor dolo', 'Rutledge Buckley LLC', 'uploads/avatars/1764126669-26-11-2025_user_avatar.jpg', NULL, '2025-11-23 03:56:28', '2025-11-25 20:11:09', NULL),
(57, 'Craig Harrell', 'kipema@mailinator.com', NULL, '$2y$12$UnwgLITacehh/OXuLn6GFut57bqbBrbyb5rH0qVwa7XGV9SX3Sb8C', '+1 (321) 113-5711', 'Saepe aut fugiat est minim modi', '1996-02-05', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'Iure', 'Quis laboris sunt tempore quis quis saepe hic lau', 'Quasi omnis reprehenderit obcaecati proident Nam', '2014-06-07', 'Reiciendis ratione cumque ut earum quibusdam dolor similique', 'Kirby Rhodes Traders', NULL, NULL, '2025-11-25 10:43:24', '2025-11-25 10:43:24', NULL),
(58, 'Florence Robles', 'gohyti@mailinator.com', NULL, '$2y$12$nozOUhixqmN9GPt7vBCg3uKl56nhFEn1Iqq.s0a4qzuCOXz00XA8S', '+1 (491) 977-1443', 'Sed vel quidem in et harum placeat', '1975-03-10', 'other', NULL, NULL, NULL, NULL, NULL, NULL, 'Duis', 'Atque exercitationem quia proident quae earum ill', 'Quas dolores nisi ratione nulla necessitatibus ali', '1997-04-19', 'Irure ut quia enim fuga', 'Solomon Hansen Associates', NULL, NULL, '2025-11-25 10:43:39', '2025-11-25 10:43:39', NULL),
(59, 'Edan Jackson', 'hywilu@mailinator.com', NULL, '$2y$12$REQsSsTBspI5k0CrZ.0Bve8VG0RZadWUUnpYHIZbbD6PfqQ.L2tlS', '+1 (255) 982-6041', 'Velit cupiditate qu', '1999-07-09', 'other', NULL, NULL, NULL, NULL, NULL, NULL, 'A-', 'Velit amet suscipi', 'Doloremque deserunt', NULL, NULL, NULL, NULL, NULL, '2025-11-25 19:06:41', '2025-11-25 19:06:41', NULL),
(60, 'Rooney Hansen', 'babewag@mailinator.com', NULL, '$2y$12$MbmPycUd6VJdK4pNyQLDRuUeEwBhhUAJmQ2X4uoFuzzbYT5la0Gay', '+1 (687) 265-5172', 'In placeat ab delec', '1992-03-16', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A-', 'Qui in consectetur', 'Cupidatat corporis u', NULL, NULL, NULL, NULL, NULL, '2025-11-25 20:04:56', '2025-11-25 20:04:56', NULL),
(61, 'Basil Wilder', 'neloler@mailinator.com', NULL, '$2y$12$kyOcAxUVR4gxcLI3Kgw3tu0xiTvuYykeJUD.Wx./PBZUbIHJwc/N2', '+1 (914) 767-7271', 'Quibusdam voluptas s', '1987-09-19', 'male', '1998-11-09', 'Ut totam voluptate c', '1984', 'Qui qui nulla non au', 11.00, NULL, 'AB-', 'Sit facilis cum cul', 'Quia autem id exerc', '1971-08-07', 'Qui consectetur dig', 'Soto Wiley LLC', NULL, NULL, '2025-11-25 21:03:35', '2025-11-25 21:03:35', NULL),
(62, 'Rhea Bush', 'nyjehit@mailinator.com', NULL, '$2y$12$2DK3/y./tdk2jo2bIWyPKuO5TR3oj6c6KBFg/LeaVW1zj30rPfNRu', '+1 (724) 581-6062', 'Deserunt odio volupt', NULL, 'other', NULL, NULL, NULL, NULL, NULL, NULL, 'A-', 'Accusamus eiusmod au', 'Debitis ratione veli', NULL, 'Esse consequuntur na', 'Harrington Paul Co', 'uploads/avatars/1764144733-26-11-2025_user_avatar.jpg', NULL, '2025-11-26 01:11:02', '2025-11-26 01:12:14', NULL);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
