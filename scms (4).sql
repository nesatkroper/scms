-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2025 at 07:16 PM
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
-- Database: `scms`
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
  `status` enum('present','absent','late','excused') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `student_id`, `course_offering_id`, `date`, `status`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, 1, '2025-11-20', 'absent', 'Sapiente et itaque d', '2025-11-20 11:27:39', '2025-11-20 11:46:53', NULL),
(2, 9, 1, '2025-11-20', 'present', 'Pariatur Beatae non', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(3, 10, 1, '2025-11-20', 'excused', 'Minus explicabo Et', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(4, 12, 1, '2025-11-20', 'late', 'Modi praesentium qui', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(5, 14, 1, '2025-11-20', 'present', 'Dolorem eu molestiae', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(6, 15, 1, '2025-11-20', 'absent', 'Fugit omnis tempori', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(7, 16, 1, '2025-11-20', 'late', 'Ex exercitation ut e', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(8, 17, 1, '2025-11-20', 'excused', 'Et et nulla incididu', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(9, 18, 1, '2025-11-20', 'absent', 'Quia dicta aliquam m', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(10, 19, 1, '2025-11-20', 'late', 'Mollit ad quia minim', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(11, 20, 1, '2025-11-20', 'absent', 'Reiciendis magna odi', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(12, 21, 1, '2025-11-20', 'absent', 'Qui id reiciendis a', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(13, 23, 1, '2025-11-20', 'absent', 'Corrupti illo exerc', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(14, 24, 1, '2025-11-20', 'present', 'Quia magni qui ut so', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(15, 26, 1, '2025-11-20', 'absent', 'Nam ea ut maiores pa', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(16, 28, 1, '2025-11-20', 'absent', 'Earum officiis omnis', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(17, 29, 1, '2025-11-20', 'absent', 'Illum nesciunt qua', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(18, 31, 1, '2025-11-20', 'late', 'Ut aspernatur volupt', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(19, 35, 1, '2025-11-20', 'absent', 'Dolore eligendi sapi', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(20, 36, 1, '2025-11-20', 'excused', 'Quia qui eligendi ut', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(21, 38, 1, '2025-11-20', 'excused', 'At voluptatem iusto', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(22, 39, 1, '2025-11-20', 'present', 'Cumque enim irure vo', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(23, 40, 1, '2025-11-20', 'excused', 'Qui beatae qui vel c', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(24, 41, 1, '2025-11-20', 'excused', 'Velit voluptas tempo', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(25, 44, 1, '2025-11-20', 'late', 'Officia culpa praes', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(26, 45, 1, '2025-11-20', 'excused', 'Maxime minus qui qui', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(27, 47, 1, '2025-11-20', 'late', 'Illum aperiam sint', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(28, 49, 1, '2025-11-20', 'present', 'Qui corporis mollit', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(29, 50, 1, '2025-11-20', 'late', 'Voluptas rem est ver', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(30, 53, 1, '2025-11-20', 'absent', 'Eaque illum ipsam q', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(31, 55, 1, '2025-11-20', 'absent', 'Veniam neque quo co', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(32, 56, 1, '2025-11-20', 'excused', 'Et nostrud quisquam', '2025-11-20 11:27:39', '2025-11-20 11:28:52', NULL),
(33, 8, 1, '1986-02-01', 'absent', 'Animi autem ratione', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(34, 9, 1, '1986-02-01', 'late', 'Esse autem aliquip', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(35, 10, 1, '1986-02-01', 'late', 'Hic accusantium in d', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(36, 12, 1, '1986-02-01', 'late', 'Cillum tempora autem', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(37, 14, 1, '1986-02-01', 'excused', 'Nostrud dolor cupida', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(38, 15, 1, '1986-02-01', 'present', 'Exercitationem qui i', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(39, 16, 1, '1986-02-01', 'excused', 'Aliquid natus aut do', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(40, 17, 1, '1986-02-01', 'absent', 'Quae fugit excepteu', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(41, 18, 1, '1986-02-01', 'excused', 'Tempora esse et exc', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(42, 19, 1, '1986-02-01', 'absent', 'Quos aute ut officii', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(43, 20, 1, '1986-02-01', 'absent', 'Ad nisi ut nobis dol', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(44, 21, 1, '1986-02-01', 'present', 'Nihil voluptates ad', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(45, 23, 1, '1986-02-01', 'absent', 'Ullamco sit voluptas', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(46, 24, 1, '1986-02-01', 'absent', 'Error asperiores a q', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(47, 26, 1, '1986-02-01', 'absent', 'Ipsum nesciunt sint', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(48, 28, 1, '1986-02-01', 'excused', 'Dolore aperiam conse', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(49, 29, 1, '1986-02-01', 'excused', 'Do vel qui non dolor', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(50, 31, 1, '1986-02-01', 'present', 'Illum pariatur Vel', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(51, 35, 1, '1986-02-01', 'excused', 'Sed incidunt ullamc', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(52, 36, 1, '1986-02-01', 'present', 'Cumque id ut velit n', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(53, 38, 1, '1986-02-01', 'excused', 'Non maiores rem ea c', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(54, 39, 1, '1986-02-01', 'present', 'Veniam ipsa ex par', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(55, 40, 1, '1986-02-01', 'late', 'Sed maiores id in q', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(56, 41, 1, '1986-02-01', 'late', 'Sit dignissimos dol', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(57, 44, 1, '1986-02-01', 'absent', 'Ex reprehenderit ver', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(58, 45, 1, '1986-02-01', 'excused', 'Est quisquam magna v', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(59, 47, 1, '1986-02-01', 'present', 'Natus maxime vitae p', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(60, 49, 1, '1986-02-01', 'present', 'Qui veritatis est e', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(61, 50, 1, '1986-02-01', 'absent', 'Ut id molestias nat', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(62, 53, 1, '1986-02-01', 'excused', 'Duis sed earum sunt', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(63, 55, 1, '1986-02-01', 'excused', 'Amet nihil perspici', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(64, 56, 1, '1986-02-01', 'present', 'Irure sint culpa qu', '2025-11-20 11:27:51', '2025-11-20 11:27:51', NULL),
(65, 7, 2, '2025-01-01', 'present', 'Sed voluptatibus rer', '2025-11-20 11:35:18', '2025-11-20 11:35:18', NULL),
(66, 12, 2, '2025-01-01', 'excused', 'Commodo et tempora c', '2025-11-20 11:35:18', '2025-11-20 11:35:18', NULL),
(67, 16, 2, '2025-01-01', 'excused', 'Deserunt doloremque', '2025-11-20 11:35:18', '2025-11-20 11:35:18', NULL),
(68, 17, 2, '2025-01-01', 'absent', 'Sint omnis ratione u', '2025-11-20 11:35:18', '2025-11-20 11:35:18', NULL),
(69, 18, 2, '2025-01-01', 'present', 'Eu cupiditate impedi', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(70, 19, 2, '2025-01-01', 'present', 'Id proident qui qui', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(71, 22, 2, '2025-01-01', 'late', 'Culpa dolore rem fu', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(72, 24, 2, '2025-01-01', 'late', 'Cumque ut obcaecati', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(73, 25, 2, '2025-01-01', 'late', 'Ipsam voluptatibus q', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(74, 27, 2, '2025-01-01', 'present', 'Ea ut fuga Deserunt', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(75, 28, 2, '2025-01-01', 'late', 'Consequatur labore', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(76, 31, 2, '2025-01-01', 'excused', 'Necessitatibus sit q', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(77, 32, 2, '2025-01-01', 'present', 'Ut consequuntur quia', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(78, 33, 2, '2025-01-01', 'excused', 'Id sed rem enim qui', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(79, 34, 2, '2025-01-01', 'excused', 'Iusto sit nihil et', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(80, 36, 2, '2025-01-01', 'late', 'Aut impedit corrupt', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(81, 37, 2, '2025-01-01', 'late', 'Dolor proident plac', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(82, 38, 2, '2025-01-01', 'excused', 'Iure eligendi quis q', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(83, 39, 2, '2025-01-01', 'excused', 'Eius ut numquam aut', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(84, 40, 2, '2025-01-01', 'excused', 'Earum quisquam et vo', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(85, 41, 2, '2025-01-01', 'excused', 'Aut accusamus alias', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(86, 42, 2, '2025-01-01', 'present', 'Elit sed eum cum ve', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(87, 47, 2, '2025-01-01', 'present', 'Duis quia et sed in', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(88, 49, 2, '2025-01-01', 'late', 'Qui facere dolorum v', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(89, 51, 2, '2025-01-01', 'excused', 'Consectetur rerum s', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(90, 52, 2, '2025-01-01', 'present', 'Mollitia earum tenet', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(91, 53, 2, '2025-01-01', 'present', 'Repellendus Nesciun', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(92, 54, 2, '2025-01-01', 'absent', 'Magnam aut sint cum', '2025-11-20 11:35:19', '2025-11-20 11:35:19', NULL),
(93, 8, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(94, 9, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(95, 10, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(96, 12, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(97, 14, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(98, 15, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(99, 16, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(100, 17, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(101, 18, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(102, 19, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(103, 20, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(104, 21, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(105, 23, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(106, 24, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(107, 26, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(108, 28, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(109, 29, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(110, 31, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(111, 35, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(112, 36, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(113, 38, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(114, 39, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(115, 40, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(116, 41, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(117, 44, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(118, 45, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(119, 47, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(120, 49, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(121, 50, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(122, 53, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(123, 55, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(124, 56, 1, '2025-11-21', 'absent', NULL, '2025-11-20 11:50:26', '2025-11-20 11:50:26', NULL),
(125, 8, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(126, 9, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(127, 10, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(128, 12, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(129, 14, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(130, 15, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(131, 16, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(132, 17, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(133, 18, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(134, 19, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(135, 20, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(136, 21, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(137, 23, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(138, 24, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(139, 26, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(140, 28, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(141, 29, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(142, 31, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(143, 35, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(144, 36, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(145, 38, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(146, 39, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(147, 40, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(148, 41, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(149, 44, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(150, 45, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(151, 47, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(152, 49, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(153, 50, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(154, 53, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(155, 55, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL),
(156, 56, 1, '2025-11-22', 'absent', NULL, '2025-11-20 11:50:31', '2025-11-20 11:50:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `room_number`, `capacity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Classroom A-101', 'A-101', 30, '2025-11-20 06:51:05', '2025-11-20 09:02:30', NULL),
(2, 'Classroom A-102', 'A-102', 30, '2025-11-20 06:51:05', '2025-11-20 09:02:36', NULL),
(3, 'Classroom B-101', 'B-101', 30, '2025-11-20 06:51:05', '2025-11-20 09:02:43', NULL),
(4, 'Classroom B-102', 'B-102', 30, '2025-11-20 06:51:05', '2025-11-20 09:02:49', NULL),
(5, 'Classroom C', 'C-101', 30, '2025-11-20 06:51:05', '2025-11-20 08:54:29', '2025-11-20 08:54:29'),
(6, 'Classroom C', 'C-102', 30, '2025-11-20 06:51:05', '2025-11-20 08:54:31', '2025-11-20 08:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE `course_offerings` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED DEFAULT NULL,
  `classroom_id` bigint UNSIGNED DEFAULT NULL,
  `time_slot` enum('morning','afternoon','evening') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'morning',
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

INSERT INTO `course_offerings` (`id`, `subject_id`, `teacher_id`, `classroom_id`, `time_slot`, `start_time`, `end_time`, `join_start`, `join_end`, `fee`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 'morning', '08:00:00', '10:00:00', '2025-11-10', '2025-12-20', 8.00, '2025-11-20 06:51:05', '2025-11-20 09:03:26', NULL),
(2, 2, 3, 3, 'morning', '08:00:00', '10:00:00', '2025-11-10', '2025-12-20', 12.00, '2025-11-20 06:51:05', '2025-11-20 09:04:37', NULL),
(3, 3, 2, 3, 'evening', '08:00:00', '10:00:00', '2025-11-10', '2025-12-20', 15.00, '2025-11-20 06:51:05', '2025-11-20 09:04:53', NULL),
(4, 4, 4, 4, 'morning', '08:00:00', '10:00:00', '2025-11-10', '2025-12-20', 12.00, '2025-11-20 06:51:05', '2025-11-20 09:05:53', NULL),
(5, 5, 2, 2, 'morning', '08:00:00', '10:00:00', '2025-11-10', '2025-12-20', 15.00, '2025-11-20 06:51:05', '2025-11-20 09:06:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', 'Oversees the daily operations and management of the school.', '2025-11-20 06:50:53', '2025-11-20 06:50:53', NULL),
(2, 'Office Word I', 'Manages all personnel-related functions.', '2025-11-20 06:50:53', '2025-11-20 06:50:53', NULL),
(3, 'Office Word II', 'Responsible for the school\'s budget and accounting.', '2025-11-20 06:50:53', '2025-11-20 06:50:53', NULL),
(4, 'Office Excel I', 'Handles upkeep and repair of facilities.', '2025-11-20 06:50:53', '2025-11-20 06:50:53', NULL),
(5, 'Office Excel II', 'Supports student well-being, counseling, extracurriculars.', '2025-11-20 06:50:53', '2025-11-20 06:50:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('lab','quiz','homework1','homework2','homework3','midterm','final') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
(1, 'midterm', 'Midterm exam for course offering 1', 1, '2025-12-04', 100, 50, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(2, 'midterm', 'Midterm exam for course offering 2', 2, '2025-12-04', 100, 50, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(3, 'midterm', 'Midterm exam for course offering 3', 3, '2025-12-04', 100, 50, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(4, 'midterm', 'Midterm exam for course offering 4', 4, '2025-12-04', 100, 50, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(5, 'midterm', 'Midterm exam for course offering 5', 5, '2025-12-04', 100, 50, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(6, 'homework2', NULL, 4, '2025-11-21', 100, 60, '2025-11-20 09:13:47', '2025-11-20 09:18:31', '2025-11-20 09:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `expense_category_id` bigint UNSIGNED DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `description`, `amount`, `date`, `expense_category_id`, `approved_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Expense 0', 'Description for expense 0', 358.00, '2025-10-31', 1, 29, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(2, 'Expense 1', 'Description for expense 1', 366.00, '2025-11-16', 2, 36, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(3, 'Expense 2', 'Description for expense 2', 141.00, '2025-11-12', 2, 16, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(4, 'Expense 3', 'Description for expense 3', 360.00, '2025-11-13', 4, 22, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(5, 'Expense 4', 'Description for expense 4', 197.00, '2025-10-21', 4, 44, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(6, 'Expense 5', 'Description for expense 5', 279.00, '2025-11-03', 3, 56, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(7, 'Expense 6', 'Description for expense 6', 211.00, '2025-10-21', 3, 7, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(8, 'Expense 7', 'Description for expense 7', 206.00, '2025-11-04', 3, 32, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(9, 'Expense 8', 'Description for expense 8', 229.00, '2025-10-30', 4, 8, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(10, 'Expense 9', 'Description for expense 9', 210.00, '2025-10-28', 3, 14, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(11, 'Expense 10', 'Description for expense 10', 251.00, '2025-10-28', 2, 56, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(12, 'Expense 11', 'Description for expense 11', 80.00, '2025-10-28', 1, 35, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(13, 'Expense 12', 'Description for expense 12', 60.00, '2025-11-02', 2, 28, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(14, 'Expense 13', 'Description for expense 13', 408.00, '2025-10-28', 3, 12, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(15, 'Expense 14', 'Description for expense 14', 426.00, '2025-11-15', 1, 27, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(16, 'Expense 15', 'Description for expense 15', 353.00, '2025-10-21', 1, 2, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(17, 'Expense 16', 'Description for expense 16', 225.00, '2025-10-28', 1, 27, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(18, 'Expense 17', 'Description for expense 17', 491.00, '2025-11-17', 4, 8, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(19, 'Expense 18', 'Description for expense 18', 490.00, '2025-11-16', 2, 56, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(20, 'Expense 19', 'Description for expense 19', 242.00, '2025-11-15', 2, 21, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Maintenance', 'Maintenance expenses', '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(2, 'Utilities', 'Utilities expenses', '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(3, 'Events', 'Events expenses', '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(4, 'Supplies', 'Supplies expenses', '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `fee_type_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('unpaid','partially_paid','paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `fee_type_id`, `amount`, `due_date`, `status`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 3, 205.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(2, 7, 2, 980.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(3, 7, 4, 256.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(4, 7, 1, 154.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(5, 8, 3, 236.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(6, 8, 2, 879.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(7, 8, 4, 131.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(8, 8, 1, 441.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(9, 9, 3, 538.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(10, 9, 2, 928.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(11, 9, 4, 285.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(12, 9, 1, 391.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(13, 10, 3, 587.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(14, 10, 2, 935.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(15, 10, 4, 378.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(16, 10, 1, 505.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(17, 11, 3, 503.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(18, 11, 2, 192.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(19, 11, 4, 592.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(20, 11, 1, 594.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(21, 12, 3, 942.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(22, 12, 2, 631.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(23, 12, 4, 504.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(24, 12, 1, 680.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(25, 13, 3, 444.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(26, 13, 2, 474.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(27, 13, 4, 969.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(28, 13, 1, 972.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(29, 14, 3, 388.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(30, 14, 2, 821.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(31, 14, 4, 172.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(32, 14, 1, 424.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(33, 15, 3, 504.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(34, 15, 2, 922.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(35, 15, 4, 106.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(36, 15, 1, 760.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(37, 16, 3, 353.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(38, 16, 2, 304.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(39, 16, 4, 232.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(40, 16, 1, 415.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(41, 17, 3, 304.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(42, 17, 2, 790.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(43, 17, 4, 1000.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(44, 17, 1, 721.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(45, 18, 3, 798.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(46, 18, 2, 812.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(47, 18, 4, 676.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(48, 18, 1, 314.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(49, 19, 3, 515.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(50, 19, 2, 338.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(51, 19, 4, 730.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(52, 19, 1, 187.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(53, 20, 3, 251.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(54, 20, 2, 167.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(55, 20, 4, 246.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(56, 20, 1, 473.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(57, 21, 3, 350.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(58, 21, 2, 996.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(59, 21, 4, 890.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(60, 21, 1, 995.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(61, 22, 3, 768.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(62, 22, 2, 318.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(63, 22, 4, 875.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(64, 22, 1, 126.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(65, 23, 3, 292.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(66, 23, 2, 294.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(67, 23, 4, 250.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(68, 23, 1, 216.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(69, 24, 3, 249.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(70, 24, 2, 807.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(71, 24, 4, 248.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(72, 24, 1, 699.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(73, 25, 3, 862.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(74, 25, 2, 578.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(75, 25, 4, 985.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(76, 25, 1, 247.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(77, 26, 3, 319.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(78, 26, 2, 616.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(79, 26, 4, 972.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(80, 26, 1, 443.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(81, 27, 3, 665.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(82, 27, 2, 869.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(83, 27, 4, 921.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(84, 27, 1, 543.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(85, 28, 3, 991.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(86, 28, 2, 740.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(87, 28, 4, 726.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(88, 28, 1, 645.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(89, 29, 3, 850.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(90, 29, 2, 790.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(91, 29, 4, 705.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(92, 29, 1, 394.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(93, 30, 3, 580.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(94, 30, 2, 494.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(95, 30, 4, 739.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(96, 30, 1, 406.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(97, 31, 3, 353.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(98, 31, 2, 476.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(99, 31, 4, 246.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(100, 31, 1, 804.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(101, 32, 3, 921.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(102, 32, 2, 653.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(103, 32, 4, 324.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(104, 32, 1, 125.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(105, 33, 3, 751.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(106, 33, 2, 587.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(107, 33, 4, 920.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(108, 33, 1, 619.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(109, 34, 3, 848.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(110, 34, 2, 531.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(111, 34, 4, 144.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(112, 34, 1, 540.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(113, 35, 3, 394.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(114, 35, 2, 950.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(115, 35, 4, 175.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(116, 35, 1, 180.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(117, 36, 3, 721.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(118, 36, 2, 630.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(119, 36, 4, 744.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(120, 36, 1, 651.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(121, 37, 3, 362.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(122, 37, 2, 599.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(123, 37, 4, 201.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(124, 37, 1, 869.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(125, 38, 3, 450.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(126, 38, 2, 856.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(127, 38, 4, 211.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(128, 38, 1, 270.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(129, 39, 3, 224.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(130, 39, 2, 589.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(131, 39, 4, 171.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(132, 39, 1, 161.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(133, 40, 3, 842.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(134, 40, 2, 228.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(135, 40, 4, 231.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(136, 40, 1, 280.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(137, 41, 3, 221.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(138, 41, 2, 499.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(139, 41, 4, 188.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(140, 41, 1, 698.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(141, 42, 3, 591.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(142, 42, 2, 605.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(143, 42, 4, 894.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(144, 42, 1, 720.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(145, 43, 3, 471.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(146, 43, 2, 530.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(147, 43, 4, 853.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(148, 43, 1, 250.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(149, 44, 3, 530.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(150, 44, 2, 909.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(151, 44, 4, 187.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(152, 44, 1, 946.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(153, 45, 3, 588.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(154, 45, 2, 199.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(155, 45, 4, 644.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(156, 45, 1, 304.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(157, 46, 3, 780.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(158, 46, 2, 708.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(159, 46, 4, 609.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(160, 46, 1, 759.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(161, 47, 3, 362.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(162, 47, 2, 214.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(163, 47, 4, 137.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(164, 47, 1, 744.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(165, 48, 3, 194.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(166, 48, 2, 845.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(167, 48, 4, 509.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(168, 48, 1, 310.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(169, 49, 3, 362.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(170, 49, 2, 604.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(171, 49, 4, 834.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(172, 49, 1, 363.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(173, 50, 3, 581.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(174, 50, 2, 689.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(175, 50, 4, 993.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(176, 50, 1, 757.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(177, 51, 3, 727.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(178, 51, 2, 229.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(179, 51, 4, 486.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(180, 51, 1, 346.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(181, 52, 3, 251.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(182, 52, 2, 274.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(183, 52, 4, 217.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(184, 52, 1, 161.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(185, 53, 3, 836.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(186, 53, 2, 393.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(187, 53, 4, 778.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(188, 53, 1, 673.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(189, 54, 3, 296.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(190, 54, 2, 379.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(191, 54, 4, 542.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(192, 54, 1, 608.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(193, 55, 3, 186.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(194, 55, 2, 684.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(195, 55, 4, 975.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(196, 55, 1, 827.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(197, 56, 3, 596.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(198, 56, 2, 253.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(199, 56, 4, 354.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(200, 56, 1, 155.00, '2025-12-20', 'unpaid', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tuition', 'Tuition fee', '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(2, 'Library', 'Library fee', '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(3, 'Lab', 'Lab fee', '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(4, 'Sports', 'Sports fee', '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2025_11_20_170056_remove_semester_from_scores_table', 2),
(6, '2025_11_20_180555_remove_classroom_id_from_attendances_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create attendance', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(2, 'view attendance', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(3, 'update attendance', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(4, 'delete attendance', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(5, 'create classroom', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(6, 'view classroom', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(7, 'update classroom', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(8, 'delete classroom', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(9, 'create course-offering', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(10, 'view course-offering', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(11, 'update course-offering', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(12, 'delete course-offering', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(13, 'create department', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(14, 'view department', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(15, 'update department', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(16, 'delete department', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(17, 'create district', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(18, 'view district', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(19, 'update district', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(20, 'delete district', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(21, 'create exam', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(22, 'view exam', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(23, 'update exam', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(24, 'delete exam', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(25, 'create expense', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(26, 'view expense', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(27, 'update expense', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(28, 'delete expense', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(29, 'create expense-category', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(30, 'view expense-category', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(31, 'update expense-category', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(32, 'delete expense-category', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(33, 'create fee', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(34, 'view fee', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(35, 'update fee', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(36, 'delete fee', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(37, 'create fee-type', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(38, 'view fee-type', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(39, 'update fee-type', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(40, 'delete fee-type', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(41, 'create payment', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(42, 'view payment', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(43, 'update payment', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(44, 'delete payment', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(45, 'create schedule', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(46, 'view schedule', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(47, 'update schedule', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(48, 'delete schedule', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(49, 'create score', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(50, 'view score', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(51, 'update score', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(52, 'delete score', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(53, 'create student-course', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(54, 'view student-course', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(55, 'update student-course', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(56, 'delete student-course', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(57, 'create subject', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(58, 'view subject', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(59, 'update subject', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(60, 'delete subject', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(61, 'create teacher-subject', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(62, 'view teacher-subject', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(63, 'update teacher-subject', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(64, 'delete teacher-subject', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(65, 'create user', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(66, 'view user', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(67, 'update user', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(68, 'delete user', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(2, 'teacher', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(3, 'student', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(4, 'guardian', 'web', '2025-11-20 06:50:53', '2025-11-20 06:50:53'),
(5, 'staff', 'web', '2025-11-20 06:50:54', '2025-11-20 06:50:54');

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
  `score` int NOT NULL,
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `student_id`, `exam_id`, `score`, `grade`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 2, 69, 'B', 'Est sapiente aut nul', '2025-11-20 10:10:29', '2025-11-20 10:51:52', NULL),
(2, 8, 1, 98, 'A+', 'Libero incididunt qu', '2025-11-20 10:01:25', '2025-11-20 10:51:46', NULL),
(3, 9, 1, 27, 'F', 'Soluta voluptatem re', '2025-11-20 10:01:25', '2025-11-20 10:51:46', NULL),
(4, 10, 1, 1, 'F', 'Exercitation qui ut', '2025-11-20 10:01:25', '2025-11-20 10:51:46', NULL),
(5, 12, 1, 91, 'A+', 'Dolorum quo blanditi', '2025-11-20 10:01:25', '2025-11-20 10:51:46', NULL),
(6, 12, 2, 3, 'F', 'Culpa molestias repr', '2025-11-20 10:10:29', '2025-11-20 10:51:52', NULL),
(7, 14, 1, 53, 'C+', 'Debitis a aperiam mi', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(8, 15, 1, 35, 'D', 'Tempor nisi quas rec', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(9, 16, 1, 97, 'A+', 'Culpa laborum offici', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(10, 16, 2, 44, 'C', 'Tempore excepteur q', '2025-11-20 10:10:29', '2025-11-20 10:51:52', NULL),
(11, 17, 1, 69, 'B', 'Hic dignissimos esse', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(12, 17, 2, 57, 'C+', 'Officia soluta aperi', '2025-11-20 10:10:29', '2025-11-20 10:51:52', NULL),
(13, 18, 1, 46, 'C', 'Dolores dolores alia', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(14, 18, 2, 100, 'A+', 'Nobis commodi repudi', '2025-11-20 10:10:29', '2025-11-20 10:51:52', NULL),
(15, 19, 1, 74, 'B+', 'Velit consequuntur', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(16, 19, 2, 45, 'C', 'Natus non aperiam qu', '2025-11-20 10:10:29', '2025-11-20 10:51:52', NULL),
(17, 20, 1, 55, 'C+', 'Rerum ipsam debitis', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(18, 21, 1, 26, 'F', 'Dolor ut placeat la', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(19, 22, 2, 74, 'B+', 'Quia delectus nobis', '2025-11-20 10:10:29', '2025-11-20 10:51:52', NULL),
(20, 23, 1, 55, 'C+', 'Labore in aut duis c', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(21, 24, 1, 97, 'A+', 'Quas ad iure volupta', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(22, 24, 2, 30, 'D', 'Ullamco aliqua Enim', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(23, 25, 2, 16, 'F', 'Aut incididunt debit', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(24, 26, 1, 55, 'C+', 'Asperiores est qui c', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(25, 27, 2, 12, 'F', 'Qui ullam officia do', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(26, 28, 1, 58, 'C+', 'Tempor consectetur', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(27, 28, 2, 96, 'A+', 'Numquam suscipit mol', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(28, 29, 1, 49, 'C', 'Ullam et in incidunt', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(29, 31, 1, 3, 'F', 'A officiis qui neque', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(30, 31, 2, 81, 'A', 'Omnis non eligendi q', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(31, 32, 2, 84, 'A', 'Nisi deserunt asperi', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(32, 33, 2, 38, 'D', 'Consectetur dolore', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(33, 34, 2, 49, 'C', 'Saepe quas magna lab', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(34, 35, 1, 72, 'B+', 'Voluptate sit neque', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(35, 36, 1, 54, 'C+', 'Cupidatat eum quia s', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(36, 36, 2, 50, 'C+', 'Deserunt tenetur aut', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(37, 37, 2, 44, 'C', 'Labore lorem ea amet', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(38, 38, 1, 12, 'F', 'Dolores voluptates q', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(39, 38, 2, 39, 'D', 'Tempor dolorem ut el', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(40, 39, 1, 8, 'F', 'Quia est est nihil', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(41, 39, 2, 80, 'A', 'Quaerat aliquip ut e', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(42, 40, 1, 69, 'B', 'Numquam doloremque a', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(43, 40, 2, 87, 'A', 'Placeat optio dolo', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(44, 41, 1, 51, 'C+', 'Nemo numquam sunt at', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(45, 41, 2, 31, 'D', 'Numquam tenetur dese', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(46, 42, 2, 62, 'B', 'Nihil adipisicing ex', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(47, 44, 1, 86, 'A', 'Deserunt est do repe', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(48, 45, 1, 9, 'F', 'Obcaecati accusantiu', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(49, 47, 1, 100, 'A+', 'Cillum perferendis v', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(50, 47, 2, 34, 'D', 'Suscipit repudiandae', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(51, 49, 1, 82, 'A', 'Optio inventore eni', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(52, 49, 2, 52, 'C+', 'Consequuntur reprehe', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(53, 50, 1, 87, 'A', 'Omnis officia velit', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(54, 51, 2, 90, 'A+', 'Tempora non itaque p', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(55, 52, 2, 95, 'A+', 'Tempor ullam et aspe', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(56, 53, 1, 65, 'B', 'Hic incididunt id q', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(57, 53, 2, 58, 'C+', 'Soluta excepturi inc', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(58, 54, 2, 57, 'C+', 'Duis qui praesentium', '2025-11-20 10:10:30', '2025-11-20 10:51:52', NULL),
(59, 55, 1, 61, 'B', 'Ea aut praesentium n', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(60, 56, 1, 45, 'C', 'Sunt ut excepturi a', '2025-11-20 10:01:26', '2025-11-20 10:51:46', NULL),
(61, 7, 5, 20, 'F', 'Amet eum et enim ex', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(62, 8, 5, 35, 'D', 'Quo voluptatem vita', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(63, 9, 5, 26, 'F', 'Qui eum ipsam aut hi', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(64, 10, 5, 16, 'F', 'Ut est est cupidata', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(65, 11, 5, 7, 'F', 'Illo maiores aliquip', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(66, 13, 5, 45, 'C', 'Sit est incidunt d', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(67, 14, 5, 92, 'A+', 'Sed necessitatibus v', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(68, 15, 5, 93, 'A+', 'Soluta voluptas est', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(69, 17, 5, 52, 'C+', 'Lorem nisi aliquid o', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(70, 19, 5, 59, 'C+', 'Id nisi facilis non', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(71, 20, 5, 98, 'A+', 'Eveniet sed id rer', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(72, 21, 5, 3, 'F', 'Totam cupidatat veli', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(73, 22, 5, 12, 'F', 'Eaque optio ea eos', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(74, 25, 5, 45, 'C', 'Aut impedit iste en', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(75, 26, 5, 54, 'C+', 'Officia voluptas quo', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(76, 27, 5, 32, 'D', 'Soluta ducimus dolo', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(77, 28, 5, 20, 'F', 'Atque accusantium se', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(78, 29, 5, 59, 'C+', 'Possimus saepe dolo', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(79, 30, 5, 10, 'F', 'Enim ut cupiditate a', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(80, 32, 5, 53, 'C+', 'Error quidem reprehe', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(81, 33, 5, 98, 'A+', 'Illo ex fugiat aut', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(82, 35, 5, 41, 'C', 'Assumenda omnis est', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(83, 36, 5, 8, 'F', 'Quia in quisquam dol', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(84, 37, 5, 21, 'F', 'Consequuntur quos pr', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(85, 39, 5, 79, 'B+', 'Natus numquam conseq', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(86, 42, 5, 16, 'F', 'Dolorem architecto s', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(87, 43, 5, 87, 'A', 'Minim sed voluptas e', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(88, 44, 5, 76, 'B+', 'Aute molestias minus', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(89, 46, 5, 25, 'F', 'Velit consectetur', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(90, 48, 5, 7, 'F', 'Aut perspiciatis qu', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(91, 49, 5, 92, 'A+', 'Consectetur ut eum', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(92, 54, 5, 49, 'C', 'Et dolore minim null', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(93, 56, 5, 54, 'C+', 'Consequatur non in', '2025-11-20 10:51:20', '2025-11-20 10:51:20', NULL),
(94, 11, 4, 12, 'F', 'Velit ea consequuntu', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(95, 13, 4, 78, 'B+', 'Facere consequat Ut', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(96, 14, 4, 54, 'C+', 'Ut enim et excepturi', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(97, 18, 4, 32, 'D', 'Omnis consectetur f', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(98, 23, 4, 70, 'B+', 'At delectus harum m', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(99, 26, 4, 91, 'A+', 'Deleniti voluptate m', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(100, 27, 4, 26, 'F', 'Laborum Autem odit', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(101, 29, 4, 79, 'B+', 'Temporibus non qui e', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(102, 30, 4, 6, 'F', 'Ullamco facere ad il', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(103, 31, 4, 22, 'F', 'Recusandae Fugiat', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(104, 32, 4, 55, 'C+', 'Eius nemo ut nostrud', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(105, 34, 4, 90, 'A+', 'Ut proident nostrum', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(106, 38, 4, 82, 'A', 'Aut distinctio Numq', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(107, 41, 4, 53, 'C+', 'Excepturi aut consec', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(108, 43, 4, 14, 'F', 'Adipisci minim est', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(109, 44, 4, 76, 'B+', 'Pariatur Cupiditate', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(110, 45, 4, 9, 'F', 'Modi obcaecati quis', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(111, 46, 4, 91, 'A+', 'Ipsa esse quasi nos', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(112, 47, 4, 22, 'F', 'Non modi reiciendis', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(113, 48, 4, 49, 'C', 'Laborum ipsum paria', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(114, 50, 4, 57, 'C+', 'Delectus enim nihil', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(115, 51, 4, 55, 'C+', 'Et duis mollit iste', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(116, 52, 4, 90, 'A+', 'Minus dolorem volupt', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(117, 53, 4, 27, 'F', 'Deserunt doloremque', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(118, 55, 4, 81, 'A', 'Nam consequatur ut', '2025-11-20 10:51:31', '2025-11-20 10:51:31', NULL),
(119, 7, 3, 57, 'C+', 'Quia quia voluptatem', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(120, 8, 3, 77, 'B+', 'Est incidunt doloru', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(121, 9, 3, 54, 'C+', 'Eius ea tenetur a et', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(122, 10, 3, 26, 'F', 'In omnis est aperiam', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(123, 11, 3, 92, 'A+', 'Ut nisi sapiente hic', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(124, 12, 3, 87, 'A', 'Aut reiciendis beata', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(125, 13, 3, 93, 'A+', 'Duis aut id quia vo', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(126, 15, 3, 100, 'A+', 'Duis velit illum no', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(127, 16, 3, 91, 'A+', 'Totam aut temporibus', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(128, 20, 3, 56, 'C+', 'Aliqua Laudantium', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(129, 21, 3, 47, 'C', 'Dolorem velit in in', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(130, 22, 3, 0, 'F', 'Enim ut suscipit pos', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(131, 23, 3, 69, 'B', 'Id animi nihil impe', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(132, 24, 3, 12, 'F', 'Obcaecati sit velit', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(133, 25, 3, 32, 'D', 'Non suscipit est qua', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(134, 30, 3, 5, 'F', 'Voluptatem irure rep', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(135, 33, 3, 36, 'D', 'Quia ipsam adipisici', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(136, 34, 3, 94, 'A+', 'Iure commodi dolorum', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(137, 35, 3, 22, 'F', 'Aliqua Nostrum prae', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(138, 37, 3, 53, 'C+', 'Reprehenderit aut do', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(139, 40, 3, 18, 'F', 'Dolor at nobis inven', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(140, 42, 3, 64, 'B', 'Voluptates ex omnis', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(141, 43, 3, 91, 'A+', 'Dolorem tempora exer', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(142, 45, 3, 20, 'F', 'Nesciunt omnis pers', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(143, 46, 3, 8, 'F', 'Odio laborum qui dol', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(144, 48, 3, 11, 'F', 'Eos est cumque atqu', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(145, 50, 3, 57, 'C+', 'Est qui sint tempor', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(146, 51, 3, 4, 'F', 'Odit ullamco ut sit', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(147, 52, 3, 6, 'F', 'Qui aut cumque eius', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(148, 54, 3, 61, 'B', 'Ullam maxime dolor r', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(149, 55, 3, 29, 'F', 'Molestias quas simil', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL),
(150, 56, 3, 11, 'F', 'Accusamus fugiat vel', '2025-11-20 10:52:00', '2025-11-20 10:52:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AYDe94kOJyIIXFnRDYV89msNC4QFDcpq63xwLWqZ', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNFBNWHdySUxvdXNGcGZGODI0NzVmeTd5UDh4MFB1UVoxZGJJd0xmZiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ0OiJodHRwOi8vMTI3LjAuMC4xOjgxMDIvYWRtaW4vY291cnNlX29mZmVyaW5ncyI7czo1OiJyb3V0ZSI7czoyODoiYWRtaW4uY291cnNlX29mZmVyaW5ncy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzYzNjQ2NzM4O319', 1763666156);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `grade_final` decimal(5,2) DEFAULT NULL,
  `status` enum('studying','suspended','dropped','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'studying',
  `payment_status` enum('pending','paid','overdue','free') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `course_offering_id`, `grade_final`, `status`, `payment_status`, `remarks`, `created_at`, `updated_at`) VALUES
(7, 2, 91.60, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(7, 3, 86.55, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(7, 5, 90.46, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(8, 1, 66.12, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(8, 3, 87.59, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(8, 5, 85.25, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(9, 1, 66.56, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(9, 3, 80.90, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(9, 5, 66.16, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(10, 1, 60.91, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(10, 3, 83.82, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(10, 5, 73.76, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(11, 3, 98.71, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(11, 4, 80.48, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(11, 5, 98.30, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(12, 1, 75.34, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(12, 2, 70.75, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(12, 3, 89.90, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(13, 3, 89.07, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(13, 4, 65.02, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(13, 5, 60.71, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(14, 1, 60.99, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(14, 4, 85.35, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(14, 5, 71.17, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(15, 1, 78.99, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(15, 3, 93.05, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(15, 5, 74.84, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(16, 1, 82.48, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(16, 2, 96.90, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(16, 3, 99.18, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(17, 1, 79.91, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(17, 2, 94.39, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(17, 5, 94.09, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(18, 1, 87.37, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(18, 2, 61.44, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(18, 4, 88.85, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(19, 1, 95.44, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(19, 2, 89.94, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(19, 5, 91.95, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(20, 1, 93.16, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(20, 3, 84.31, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(20, 5, 99.38, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(21, 1, 78.57, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(21, 3, 86.89, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(21, 5, 76.84, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(22, 2, 82.49, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(22, 3, 65.91, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(22, 5, 78.30, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(23, 1, 97.56, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(23, 3, 81.97, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(23, 4, 69.75, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(24, 1, 96.62, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(24, 2, 87.62, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(24, 3, 95.54, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(25, 2, 97.67, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(25, 3, 69.82, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(25, 5, 64.00, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(26, 1, 84.34, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(26, 4, 99.49, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(26, 5, 60.16, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(27, 2, 87.12, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(27, 4, 63.20, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(27, 5, 63.66, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(28, 1, 65.56, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(28, 2, 70.00, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(28, 5, 92.49, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(29, 1, 68.72, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(29, 4, 67.73, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(29, 5, 66.46, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(30, 3, 97.30, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(30, 4, 71.29, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(30, 5, 87.36, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(31, 1, 84.04, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(31, 2, 80.31, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(31, 4, 74.92, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(32, 2, 69.61, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(32, 4, 80.44, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(32, 5, 69.97, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(33, 2, 64.42, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(33, 3, 63.17, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(33, 5, 99.00, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(34, 2, 62.16, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(34, 3, 78.47, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(34, 4, 73.04, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(35, 1, 77.24, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(35, 3, 88.26, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(35, 5, 74.32, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(36, 1, 61.52, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(36, 2, 79.15, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(36, 5, 74.94, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(37, 2, 64.12, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(37, 3, 62.72, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(37, 5, 64.17, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(38, 1, 66.06, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(38, 2, 98.18, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(38, 4, 64.07, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(39, 1, 77.57, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(39, 2, 68.27, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(39, 5, 65.87, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(40, 1, 83.23, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(40, 2, 91.82, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(40, 3, 67.72, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(41, 1, 62.61, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(41, 2, 71.69, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(41, 4, 74.61, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(42, 2, 94.02, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(42, 3, 84.38, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(42, 5, 83.02, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(43, 3, 85.69, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(43, 4, 78.08, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(43, 5, 71.29, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(44, 1, 80.50, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(44, 4, 92.02, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(44, 5, 65.85, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(45, 1, 74.34, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(45, 3, 99.24, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(45, 4, 91.22, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(46, 3, 95.09, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(46, 4, 72.03, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(46, 5, 92.77, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(47, 1, 78.37, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(47, 2, 79.41, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(47, 4, 64.28, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(48, 3, 73.43, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(48, 4, 94.89, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(48, 5, 62.12, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(49, 1, 88.10, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(49, 2, 67.14, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(49, 5, 95.51, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(50, 1, 79.27, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(50, 3, 84.50, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(50, 4, 97.63, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(51, 2, 75.11, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(51, 3, 98.46, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(51, 4, 90.17, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(52, 2, 75.24, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(52, 3, 67.11, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(52, 4, 73.86, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(53, 1, 60.10, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(53, 2, 84.00, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(53, 4, 80.03, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(54, 2, 93.78, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(54, 3, 77.47, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(54, 5, 83.66, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(55, 1, 80.36, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(55, 3, 87.50, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(55, 4, 98.54, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(56, 1, 96.58, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(56, 3, 75.55, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05'),
(56, 5, 61.98, 'studying', 'pending', NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `credit_hours` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `credit_hours`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', 'ENG001', 'Introduction to Programming course description.', 4, '2025-11-20 06:51:05', '2025-11-20 09:00:20', NULL),
(2, 'Office Word I', 'WORD001', 'Data Structures course description.', 4, '2025-11-20 06:51:05', '2025-11-20 09:00:49', NULL),
(3, 'Office Word II', 'WORD002', 'British Literature course description.', 4, '2025-11-20 06:51:05', '2025-11-20 09:01:09', NULL),
(4, 'Office Excel I', 'EXCEL001', 'Creative Writing course description.', 4, '2025-11-20 06:51:05', '2025-11-20 09:01:24', NULL),
(5, 'Office Excel II', 'EXCEL002', 'Calculus I course description.', 4, '2025-11-20 06:51:05', '2025-11-20 09:01:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'male',
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `qualification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `salary` decimal(10,2) DEFAULT NULL,
  `cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `date_of_birth`, `gender`, `department_id`, `joining_date`, `qualification`, `experience`, `specialization`, `salary`, `cv`, `blood_group`, `nationality`, `religion`, `admission_date`, `occupation`, `company`, `avatar`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2025-11-20 06:50:54', '$2y$12$ZAi.g6MX0h90ZQba/KzlSuprKtppU4hxljJDtTnoVv4LjyqET/j/a', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 06:50:54', '2025-11-20 06:50:54', NULL),
(2, 'Miss Deja Rowe DVM', 'teacher0@example.com', '2025-11-20 06:50:54', '$2y$12$AXmdOQ2.TFa/8n5dEHa7XOcSEBeHN1bDnBKqoQzsIH91QaBi34Mky', NULL, NULL, NULL, 'female', 1, '1978-12-16', 'Master', '10 years', 'Science', 54728.92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 06:50:54', '2025-11-20 06:50:54', NULL),
(3, 'Prof. Darrion Kohler', 'teacher1@example.com', '2025-11-20 06:50:54', '$2y$12$1NxJkG71.ZDU8f8hhQeLZ.7yj5mOHcmAtJjwNEVRCzmVyT9J9LIxe', NULL, NULL, NULL, 'male', 2, '2024-04-25', 'Master', '5 years', 'Science', 45651.89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 06:50:54', '2025-11-20 06:50:54', NULL),
(4, 'Mr. Kirk Bode', 'teacher2@example.com', '2025-11-20 06:50:54', '$2y$12$s9viZ5EzM0XHPmGvm.QaAOTF3AKqKKiaRkihAWP07VF1.TRIIa/lK', NULL, NULL, NULL, 'male', 3, '1990-05-05', 'Master', '5 years', 'Math', 51966.92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 06:50:54', '2025-11-20 06:50:54', NULL),
(5, 'Miss Evie Ortiz', 'teacher3@example.com', '2025-11-20 06:50:55', '$2y$12$7bP.pMy6WVyhs2MP0SkON.OxcEqexc9PMJR7lf1wHLUj6pAOBi3Me', NULL, NULL, NULL, 'female', 2, '1987-01-02', 'Bachelor', '5 years', 'Math', 73406.92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 06:50:55', '2025-11-20 06:50:55', NULL),
(6, 'Rosalee Metz Sr.', 'teacher4@example.com', '2025-11-20 06:50:55', '$2y$12$AB81XBgPwaElZmZWJ7tdmO9HYCIFvKbar2HLM7CZDwkcSVIfL.CsO', NULL, NULL, NULL, 'female', 5, '1998-01-19', 'PhD', '5 years', 'Math', 56237.92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 06:50:55', '2025-11-20 06:50:55', NULL),
(7, 'Kelly Lang', 'student0@example.com', '2025-11-20 06:50:55', '$2y$12$u4QfNc0EEXymR0JOOTbevOueNGqfwt2KRQRIRCvcZCpmWRaHxDcVy', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'United Arab Emirates', 'Hinduism', '2019-07-25', NULL, NULL, NULL, NULL, '2025-11-20 06:50:55', '2025-11-20 06:50:55', NULL),
(8, 'Athena Anderson', 'student1@example.com', '2025-11-20 06:50:55', '$2y$12$LxFf5KhF7fprmXwbbwondug2H/TScyQGnvVpR0af3rLm6ioWms6aK', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Singapore', 'Buddhism', '1993-05-05', NULL, NULL, NULL, NULL, '2025-11-20 06:50:55', '2025-11-20 06:50:55', NULL),
(9, 'Lawson Dibbert Jr.', 'student2@example.com', '2025-11-20 06:50:55', '$2y$12$EWJI9uX6QRhk6i3Bb0wIiOUf7nne1NalTMQY6173W1SRfMnsQ01iC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Djibouti', 'Hinduism', '2015-12-27', NULL, NULL, NULL, NULL, '2025-11-20 06:50:55', '2025-11-20 06:50:55', NULL),
(10, 'Elfrieda Buckridge', 'student3@example.com', '2025-11-20 06:50:56', '$2y$12$yZC4IN1IxBLidZn8wc4HU.kzgkjlnMUxuKXwn7OcsdL3oE9nNrD5m', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Albania', 'Christianity', '1986-01-11', NULL, NULL, NULL, NULL, '2025-11-20 06:50:56', '2025-11-20 06:50:56', NULL),
(11, 'Devante Schowalter', 'student4@example.com', '2025-11-20 06:50:56', '$2y$12$i1PohozyDThIo5QlsYp/h.umO8em14qxsy53k7wbcnETzMFc3TzOO', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Malawi', 'Islam', '2021-04-08', NULL, NULL, NULL, NULL, '2025-11-20 06:50:56', '2025-11-20 06:50:56', NULL),
(12, 'Ms. Katelin Schumm V', 'student5@example.com', '2025-11-20 06:50:56', '$2y$12$/nZNENGYSLYybXTWDcHRBuOxVPElNPaKN2BjxZTSNdL9vUg/FdEZG', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Puerto Rico', 'Islam', '1987-10-22', NULL, NULL, NULL, NULL, '2025-11-20 06:50:56', '2025-11-20 06:50:56', NULL),
(13, 'Prof. Osborne Smith', 'student6@example.com', '2025-11-20 06:50:56', '$2y$12$NDg6S.uz/lW9bFu1RE6BfuHsowH0gx.J5bIVRdaV3WNmKphan37IS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Sierra Leone', 'Hinduism', '1988-01-26', NULL, NULL, NULL, NULL, '2025-11-20 06:50:56', '2025-11-20 06:50:56', NULL),
(14, 'Kay Orn DVM', 'student7@example.com', '2025-11-20 06:50:56', '$2y$12$Yx/MPPN2umZl/qhVZm98kunZsI1pOO96B9u6rpkm06IpMDUFYLgvm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Central African Republic', 'Buddhism', '1974-08-24', NULL, NULL, NULL, NULL, '2025-11-20 06:50:56', '2025-11-20 06:50:56', NULL),
(15, 'Lulu Mitchell', 'student8@example.com', '2025-11-20 06:50:57', '$2y$12$me2WDVfTrxzTti8WZbmqP.eFXXr8BjVNGWyBKY6Tu6SSO6T.CeV3S', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Saint Helena', 'Islam', '1987-04-09', NULL, NULL, NULL, NULL, '2025-11-20 06:50:57', '2025-11-20 06:50:57', NULL),
(16, 'Nella Oberbrunner', 'student9@example.com', '2025-11-20 06:50:57', '$2y$12$cBF9hahZHyM3R/So5s43W.xwuLdSFtP4Gaaz5MqN5CHEVnN8Yg08m', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Cape Verde', 'Buddhism', '1975-12-26', NULL, NULL, NULL, NULL, '2025-11-20 06:50:57', '2025-11-20 06:50:57', NULL),
(17, 'Prof. Keyon Wuckert II', 'student10@example.com', '2025-11-20 06:50:57', '$2y$12$.eUiqXwjY0RufFdYg0JWAOYXi6vwnYyo4AtXLnqTh8bpdgp1lIi4G', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Bolivia', 'Buddhism', '2005-12-27', NULL, NULL, NULL, NULL, '2025-11-20 06:50:57', '2025-11-20 06:50:57', NULL),
(18, 'Carolyne Doyle', 'student11@example.com', '2025-11-20 06:50:57', '$2y$12$LPs/Vgk0by6WjUYo4h5u4OR.k9DFnEzh4UZyGPjmMaftGNARrVubm', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Guinea', 'Hinduism', '2002-12-26', NULL, NULL, NULL, NULL, '2025-11-20 06:50:57', '2025-11-20 06:50:57', NULL),
(19, 'Aurore Kerluke', 'student12@example.com', '2025-11-20 06:50:57', '$2y$12$LPbOHSYD2e0FpISQMOCSYOSDwQnsre6.oxcDJmt0AU80K5pzgh.X.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Bosnia and Herzegovina', 'Islam', '1988-10-02', NULL, NULL, NULL, NULL, '2025-11-20 06:50:57', '2025-11-20 06:50:57', NULL),
(20, 'Samson Fritsch', 'student13@example.com', '2025-11-20 06:50:58', '$2y$12$YHgzMjNPbCxDr98/JHy0tectOt1sJ.tDj0gOB3aZKwrjXc2wwDfIW', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Slovakia (Slovak Republic)', 'Islam', '1974-01-24', NULL, NULL, NULL, NULL, '2025-11-20 06:50:58', '2025-11-20 06:50:58', NULL),
(21, 'Desmond Huels', 'student14@example.com', '2025-11-20 06:50:58', '$2y$12$TA7Qb5opGPmrGdTInL1pV.FRZ3ZTbuRmJhclibXwjjwW4Qx2F1LHi', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Netherlands', 'Islam', '2011-03-19', NULL, NULL, NULL, NULL, '2025-11-20 06:50:58', '2025-11-20 06:50:58', NULL),
(22, 'Amani Cole', 'student15@example.com', '2025-11-20 06:50:58', '$2y$12$pEtvUz5qbrbNrWaDiR7ijeGslgCC6JZXzePmbjSoFSG1BrwjuZfb.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Tunisia', 'Buddhism', '1982-03-07', NULL, NULL, NULL, NULL, '2025-11-20 06:50:58', '2025-11-20 06:50:58', NULL),
(23, 'Mustafa Prohaska', 'student16@example.com', '2025-11-20 06:50:58', '$2y$12$o8uCxi62ih1Q/iZBcOyMx.pSqqUQzQDWEFvPfj3VU9GFK8v5rHmxO', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Afghanistan', 'Christianity', '1983-08-20', NULL, NULL, NULL, NULL, '2025-11-20 06:50:58', '2025-11-20 06:50:58', NULL),
(24, 'Skylar Larson PhD', 'student17@example.com', '2025-11-20 06:50:58', '$2y$12$3G5L15FCN.2OXlOiSN6Zi.d2ka/jtNGyId04XOlTGJAA4hSv1end.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Korea', 'Christianity', '2018-07-28', NULL, NULL, NULL, NULL, '2025-11-20 06:50:58', '2025-11-20 06:50:58', NULL),
(25, 'Trent Graham Sr.', 'student18@example.com', '2025-11-20 06:50:59', '$2y$12$5E6hvdSnv1j4M6l2LUoof.fXr6214e5GbTZ7XMBGIczoch3yrvkBa', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Brunei Darussalam', 'Hinduism', '2012-09-15', NULL, NULL, NULL, NULL, '2025-11-20 06:50:59', '2025-11-20 06:50:59', NULL),
(26, 'Abel Hessel', 'student19@example.com', '2025-11-20 06:50:59', '$2y$12$JSveiUKcrwghfAC/z5D3vuRleidhM0Us7vSBc/IM76tl6OgY.QjN6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Chad', 'Hinduism', '1996-03-03', NULL, NULL, NULL, NULL, '2025-11-20 06:50:59', '2025-11-20 06:50:59', NULL),
(27, 'Tyrell Tromp', 'student20@example.com', '2025-11-20 06:50:59', '$2y$12$MpjFoSSbSPfhi3NZ/MfcO.a323JODNM.Le9EE4unQnk9WUkpA/gBy', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Cameroon', 'Islam', '1998-05-02', NULL, NULL, NULL, NULL, '2025-11-20 06:50:59', '2025-11-20 06:50:59', NULL),
(28, 'Jasper Hessel', 'student21@example.com', '2025-11-20 06:50:59', '$2y$12$4MYZJurbhkwWE398whE/6OwXlaHqq.8t4JBukQbN9dh4OV4XHhcqu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Sao Tome and Principe', 'Buddhism', '1972-12-17', NULL, NULL, NULL, NULL, '2025-11-20 06:50:59', '2025-11-20 06:50:59', NULL),
(29, 'Ewald Lemke', 'student22@example.com', '2025-11-20 06:50:59', '$2y$12$J2bNLF73CiLqiTIgsBcs2u818iz4TMO49hjxUsdi/K0VhXxXuPkzS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Finland', 'Hinduism', '2000-11-04', NULL, NULL, NULL, NULL, '2025-11-20 06:50:59', '2025-11-20 06:50:59', NULL),
(30, 'Alayna Schultz I', 'student23@example.com', '2025-11-20 06:51:00', '$2y$12$.o7X6SoZ1PzbxHhMIlj1HekUzV7Ojpr.WeR/n6tGa/hd9fx50lnAS', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'British Indian Ocean Territory (Chagos Archipelago)', 'Buddhism', '2012-08-08', NULL, NULL, NULL, NULL, '2025-11-20 06:51:00', '2025-11-20 06:51:00', NULL),
(31, 'Domenico Dietrich I', 'student24@example.com', '2025-11-20 06:51:00', '$2y$12$eQp4Uxhh5B5rrNG4hmq6SOG8usqWdiNabUPSOq4Laz96vIQ0Sjefu', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Marshall Islands', 'Christianity', '2004-08-02', NULL, NULL, NULL, NULL, '2025-11-20 06:51:00', '2025-11-20 06:51:00', NULL),
(32, 'Mr. Clifton Muller IV', 'student25@example.com', '2025-11-20 06:51:00', '$2y$12$nTc7D2nNNSm0k1itGntg5eZCuG8165FFJET.DAvdKLQ9mD84ESQMW', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Thailand', 'Islam', '1973-09-08', NULL, NULL, NULL, NULL, '2025-11-20 06:51:00', '2025-11-20 06:51:00', NULL),
(33, 'Savannah Hettinger I', 'student26@example.com', '2025-11-20 06:51:00', '$2y$12$5xHhpz6WscEI7aQXWrNJ6uzvCpEoLH2u1WkBYYvJoR9cfa/Xb6jni', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Samoa', 'Christianity', '1995-11-26', NULL, NULL, NULL, NULL, '2025-11-20 06:51:00', '2025-11-20 06:51:00', NULL),
(34, 'Elnora Nienow PhD', 'student27@example.com', '2025-11-20 06:51:00', '$2y$12$ebzC54PbMMcLGTldKUGkX.NrskdgfmAIqpIDAG0V8Ca4MdxMsEma2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Marshall Islands', 'Buddhism', '1985-04-09', NULL, NULL, NULL, NULL, '2025-11-20 06:51:00', '2025-11-20 06:51:00', NULL),
(35, 'Mrs. Beaulah Pagac', 'student28@example.com', '2025-11-20 06:51:01', '$2y$12$0V1MElGmt0gJss/fGOkz2eem5ZKCKSijedy4DrJT/rC7yJ3hOs49G', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'American Samoa', 'Christianity', '1979-09-21', NULL, NULL, NULL, NULL, '2025-11-20 06:51:01', '2025-11-20 06:51:01', NULL),
(36, 'Alvina Goldner', 'student29@example.com', '2025-11-20 06:51:01', '$2y$12$IKUyGfg0JIwey71FyoPdIuwpTzh.icv2xPB5NNlc4ZCtp3LWqOwmC', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Niue', 'Buddhism', '2020-08-31', NULL, NULL, NULL, NULL, '2025-11-20 06:51:01', '2025-11-20 06:51:01', NULL),
(37, 'Jarrett Dibbert', 'student30@example.com', '2025-11-20 06:51:01', '$2y$12$8Krh52ds3bGnXgnQnq7ZdOREE2TiAeXyaLfNa6Gc9D2HISw3r57E.', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Djibouti', 'Buddhism', '2001-01-29', NULL, NULL, NULL, NULL, '2025-11-20 06:51:01', '2025-11-20 06:51:01', NULL),
(38, 'Daryl Collins', 'student31@example.com', '2025-11-20 06:51:01', '$2y$12$kZjeE3CKUdZhcOSGfMm6JOz9tYe9FRSmiWV4MWR7CNhOjFTiq1TtW', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Mexico', 'Buddhism', '2012-01-21', NULL, NULL, NULL, NULL, '2025-11-20 06:51:01', '2025-11-20 06:51:01', NULL),
(39, 'Ms. Taya Romaguera', 'student32@example.com', '2025-11-20 06:51:01', '$2y$12$oHyDo9eyJ933hJAjPTnaWO63HAAgwsRoPxsoazN7RLfcUsWYcfO8.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Ireland', 'Christianity', '1986-05-19', NULL, NULL, NULL, NULL, '2025-11-20 06:51:01', '2025-11-20 06:51:01', NULL),
(40, 'Mrs. Itzel Lowe III', 'student33@example.com', '2025-11-20 06:51:02', '$2y$12$ScdLW4s09V7K4Kqiu0dj.OacclqJVXzrkK1G86fuQzOy9PiP3A5l.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Bhutan', 'Christianity', '2000-02-19', NULL, NULL, NULL, NULL, '2025-11-20 06:51:02', '2025-11-20 06:51:02', NULL),
(41, 'Maria Hermiston', 'student34@example.com', '2025-11-20 06:51:02', '$2y$12$Y.yB9ZdMwEK0130Xv6gigeTTHVsfQaFAeq9shMar6SPe0fQTKZkrK', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Papua New Guinea', 'Islam', '2025-07-26', NULL, NULL, NULL, NULL, '2025-11-20 06:51:02', '2025-11-20 06:51:02', NULL),
(42, 'Maida Walsh', 'student35@example.com', '2025-11-20 06:51:02', '$2y$12$vzsoyxsXD12MyFs7o5R2N.AG1Q/TdyGAi5wNTSfcdJLiYtyxJ/BI.', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Myanmar', 'Islam', '1984-04-15', NULL, NULL, NULL, NULL, '2025-11-20 06:51:02', '2025-11-20 06:51:02', NULL),
(43, 'Travis Dach', 'student36@example.com', '2025-11-20 06:51:02', '$2y$12$JZiejLbRlM5HnJ6IkplvQeeg22tajbaLUjrcbV.B2VoHh34HmeXC6', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'French Southern Territories', 'Buddhism', '1999-06-22', NULL, NULL, NULL, NULL, '2025-11-20 06:51:02', '2025-11-20 06:51:02', NULL),
(44, 'Jarred Cummings', 'student37@example.com', '2025-11-20 06:51:02', '$2y$12$k0v8BMSS6CPKF2lA5egyJeRMgtnm4sV3AAEZUbqF/qnXXvwfIT4ui', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Nigeria', 'Christianity', '2013-05-17', NULL, NULL, NULL, NULL, '2025-11-20 06:51:02', '2025-11-20 06:51:02', NULL),
(45, 'Ms. Zora Sipes', 'student38@example.com', '2025-11-20 06:51:03', '$2y$12$aGk1ucv/sc6i2O0gWdOUserL/zbLG6gnrSSXFTc6kxA1o3uD3MUV2', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Indonesia', 'Hinduism', '1973-06-23', NULL, NULL, NULL, NULL, '2025-11-20 06:51:03', '2025-11-20 06:51:03', NULL),
(46, 'Margaret Langosh', 'student39@example.com', '2025-11-20 06:51:03', '$2y$12$p1fTfMH2IcyWmqq/p.RoL.abMukOazpJbr0592PePstoqhanaTqNy', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Falkland Islands (Malvinas)', 'Hinduism', '2007-06-23', NULL, NULL, NULL, NULL, '2025-11-20 06:51:03', '2025-11-20 06:51:03', NULL),
(47, 'Petra Wunsch', 'student40@example.com', '2025-11-20 06:51:03', '$2y$12$W3dzsYpd8.AFuWfpFidMCeqH7AMf5mdGcYIvrKvTqBzisXpxvl1zW', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Djibouti', 'Christianity', '1992-03-15', NULL, NULL, NULL, NULL, '2025-11-20 06:51:03', '2025-11-20 06:51:03', NULL),
(48, 'Kaley Paucek III', 'student41@example.com', '2025-11-20 06:51:03', '$2y$12$gEghmqTRjbFgxxgi4l0mT.JqKGCTIllCKO3GapHb2lBVOuJh6V8Si', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Russian Federation', 'Christianity', '2019-09-20', NULL, NULL, NULL, NULL, '2025-11-20 06:51:03', '2025-11-20 06:51:03', NULL),
(49, 'Adolphus Bruen', 'student42@example.com', '2025-11-20 06:51:03', '$2y$12$xXVIu6h5fEB1Uzwn1AGkgeS2C0z/b3n1RE8b36A93HUN8szjOQ0gK', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Seychelles', 'Islam', '2006-03-29', NULL, NULL, NULL, NULL, '2025-11-20 06:51:03', '2025-11-20 06:51:03', NULL),
(50, 'Orrin Erdman', 'student43@example.com', '2025-11-20 06:51:04', '$2y$12$ph0/RcLKUiXCcJPnNG9gW.AMo4dFNwqZ9ptMGQORFFTMssQgx1tBS', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Brazil', 'Christianity', '1995-03-10', NULL, NULL, NULL, NULL, '2025-11-20 06:51:04', '2025-11-20 06:51:04', NULL),
(51, 'Modesta Deckow', 'student44@example.com', '2025-11-20 06:51:04', '$2y$12$3rWdBAwcDFwf.8gONT2JWePWKNwyXjqCYG7I847F8hpkdYvQDm3he', NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Mayotte', 'Hinduism', '1980-02-07', NULL, NULL, NULL, NULL, '2025-11-20 06:51:04', '2025-11-20 06:51:04', NULL),
(52, 'Bobbie O\'Kon', 'student45@example.com', '2025-11-20 06:51:04', '$2y$12$mSouB6YbJGmbWJkt0MQs.ubUM4iZPz.zmV7OYhDqqk9K3dqfcqOQC', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Northern Mariana Islands', 'Christianity', '1985-10-27', NULL, NULL, NULL, NULL, '2025-11-20 06:51:04', '2025-11-20 06:51:04', NULL),
(53, 'Xzavier Kuvalis', 'student46@example.com', '2025-11-20 06:51:04', '$2y$12$CfTuRD4Oy2XujBQZUV1BveCS816mka3wWe/wD32u9E5JLygqTLAfa', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Ghana', 'Buddhism', '1991-11-09', NULL, NULL, NULL, NULL, '2025-11-20 06:51:04', '2025-11-20 06:51:04', NULL),
(54, 'Cade Rowe', 'student47@example.com', '2025-11-20 06:51:04', '$2y$12$Oacv05CRv73OGRDiFO0VI.86lmkA/4twr0vwNywUZI3j39kGfERDm', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Cambodia', 'Buddhism', '1972-09-03', NULL, NULL, NULL, NULL, '2025-11-20 06:51:04', '2025-11-20 06:51:04', NULL),
(55, 'Mr. Cole Fritsch', 'student48@example.com', '2025-11-20 06:51:05', '$2y$12$bgLY9hCI8VvHE4wdHfH9AuGj8vqGMKKWtog4.fEZl8SON37kGqFdG', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AB+', 'Antarctica (the territory South of 60 deg S)', 'Christianity', '2010-11-09', NULL, NULL, NULL, NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL),
(56, 'Gust Willms', 'student49@example.com', '2025-11-20 06:51:05', '$2y$12$qKb76fmgsoCsP0E1dYW6p.hJzUmoukIZt.995E9lqHd2OWDD8123e', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Saint Martin', 'Hinduism', '2010-05-05', NULL, NULL, NULL, NULL, '2025-11-20 06:51:05', '2025-11-20 06:51:05', NULL);

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
  ADD KEY `exams_course_offering_id_foreign` (`course_offering_id`);

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
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_student_id_foreign` (`student_id`),
  ADD KEY `fees_fee_type_id_foreign` (`fee_type_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_offerings`
--
ALTER TABLE `course_offerings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

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
  ADD CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
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

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
