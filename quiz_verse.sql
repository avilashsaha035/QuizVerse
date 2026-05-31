-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2026 at 04:49 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_verse`
--

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_minutes` int NOT NULL,
  `no_of_ques` int DEFAULT NULL,
  `is_shuffling` tinyint(1) NOT NULL DEFAULT '0',
  `pass_marks` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `access_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attempts_allowed` int UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `slug`, `description`, `thumbnail`, `exam_type`, `duration_minutes`, `no_of_ques`, `is_shuffling`, `pass_marks`, `start_date`, `start_time`, `end_date`, `end_time`, `is_active`, `language`, `access_code`, `attempts_allowed`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Test Exam', 'test-exam-6a0e9774bdb8a', '<p>This exam is created for testing.</p>', 'ai-generated-concert-crowd-enjoying-live-music-event-photo.jpg', 'bank', 10, 5, 1, 2, '2026-05-26', '00:17:00', '2026-06-02', '11:25:00', 1, 'en', NULL, 2, 1, '2026-05-21 05:26:12', '2026-05-25 17:15:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_attempt_users`
--

CREATE TABLE `exam_attempt_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `score` int DEFAULT NULL,
  `percentile` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `exam_id`, `question_id`, `order`, `created_at`, `updated_at`) VALUES
(50, 2, 9, 1, '2026-05-25 17:15:15', '2026-05-25 17:15:15'),
(51, 2, 10, 2, '2026-05-25 17:15:15', '2026-05-25 17:15:15'),
(52, 2, 14, 1, '2026-05-25 17:15:15', '2026-05-25 17:15:15'),
(53, 2, 15, 2, '2026-05-25 17:15:15', '2026-05-25 17:15:15'),
(54, 2, 17, 1, '2026-05-25 17:15:15', '2026-05-25 17:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `exam_subjects`
--

CREATE TABLE `exam_subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `question_count` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_subjects`
--

INSERT INTO `exam_subjects` (`id`, `exam_id`, `subject_id`, `question_count`, `created_at`, `updated_at`) VALUES
(5, 2, 1, 2, '2026-05-21 05:26:12', '2026-05-25 17:15:15'),
(6, 2, 2, 2, '2026-05-21 05:26:12', '2026-05-25 17:15:15'),
(7, 2, 3, 1, '2026-05-21 05:26:12', '2026-05-25 17:15:15');

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
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('success','failure') COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_id` bigint UNSIGNED DEFAULT NULL,
  `imported_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_11_13_182015_create_subjects_table', 1),
(6, '2025_11_13_182016_create_exams_table', 1),
(7, '2025_11_13_182036_create_questions_table', 1),
(8, '2025_11_13_182050_create_options_table', 1),
(9, '2025_11_13_182127_create_question_explanations_table', 1),
(10, '2025_11_13_182305_create_exam_questions_table', 1),
(11, '2025_11_13_182415_create_exam_attempt_users_table', 1),
(12, '2025_11_13_182636_create_answers_table', 1),
(13, '2025_11_13_182701_create_imports_table', 1),
(14, '2025_11_13_182759_create_question_tags_table', 1),
(15, '2025_11_26_191417_remove_subject_id_from_exams_table', 1),
(16, '2025_11_26_192333_create_exam_subjects_table', 1),
(17, '2025_12_08_133103_create_permission_tables', 1),
(18, '2026_02_03_110401_rename_answers_to_user_answers', 1),
(19, '2026_02_12_160955_create_participants_table', 1),
(20, '2026_05_29_212857_create_site_settings_table', 2),
(21, '2026_05_30_200530_add_social_links_to_site_settings_table', 3);

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
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `option_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_text`, `is_correct`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhaka', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(2, 1, 'Sylhet', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(3, 1, 'Rajshahi', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(4, 1, 'Chittagong', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(5, 2, 'Water Lily', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(6, 2, 'Rose', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(7, 2, 'Lotus', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(8, 2, 'Sunflower', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(9, 3, 'Padma', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(10, 3, 'Meghna', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(11, 3, 'Jamuna', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(12, 3, 'Karnaphuli', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(13, 4, 'Sheikh Mujibur Rahman', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(14, 4, 'Ziaur Rahman', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(15, 4, 'Abu Sayeed Chowdhury', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(16, 4, 'Tajuddin Ahmad', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(17, 5, 'Royal Bengal Tiger', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(18, 5, 'Lion', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(19, 5, 'Elephant', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(20, 5, 'Deer', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(21, 6, 'রবীন্দ্রনাথ ঠাকুর', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(22, 6, 'মাইকেল মধুসূদন দত্ত', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(23, 6, 'ঈশ্বরচন্দ্র বিদ্যাসাগর', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(24, 6, 'কাজী নজরুল ইসলাম', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(25, 7, 'মেঘনাদবধ কাব্য', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(26, 7, 'পদ্মাবতী', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(27, 7, 'শ্রীকৃষ্ণকীর্তন', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(28, 7, 'আনন্দমঠ', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(29, 8, 'বিদ্রোহী কবি', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(30, 8, 'রোমান্টিক কবি', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(31, 8, 'পল্লীকবি', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(32, 8, 'ভক্তিকবি', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(33, 9, '1947', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(34, 9, '1950', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(35, 9, '1952', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(36, 9, '1956', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(37, 10, 'নোবেল', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(38, 10, 'পুলিৎজার', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(39, 10, 'বুকার', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(40, 10, 'অস্কার', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(41, 11, 'Sad', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(42, 11, 'Angry', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(43, 11, 'Joyful', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(44, 11, 'Tired', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(45, 12, 'Run', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(46, 12, 'Beautiful', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(47, 12, 'Happy', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(48, 12, 'Quick', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(49, 13, 'Childs', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(50, 13, 'Childes', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(51, 13, 'Children', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(52, 13, 'Childrens', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(53, 14, 'An', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(54, 14, 'A', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(55, 14, 'The', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(56, 14, 'No article', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(57, 15, 'Past', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(58, 15, 'Simple Present', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(59, 15, 'Present Continuous', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(60, 15, 'Future', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(61, 16, '20', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(62, 16, '25', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(63, 16, '30', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(64, 16, '35', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(65, 17, '10', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(66, 17, '20', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(67, 17, '25', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(68, 17, '30', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(69, 18, '20', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(70, 18, '25', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(71, 18, '30', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(72, 18, '40', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(73, 19, '10', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(74, 19, '11', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(75, 19, '12', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(76, 19, '13', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(77, 20, '10', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(78, 20, '12', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(79, 20, '14', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(80, 20, '16', 0, '2026-04-27 16:35:10', '2026-04-27 16:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upazilla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `user_id`, `profile_image`, `date_of_birth`, `division`, `district`, `upazilla`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 16:42:46', '2026-04-27 16:42:46');

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
(1, 'manage_question', 'web', '2026-04-27 16:19:16', '2026-04-27 16:19:16'),
(2, 'manage_exam', 'web', '2026-04-27 16:19:16', '2026-04-27 16:19:16'),
(3, 'manage_exam_setting', 'web', '2026-04-27 16:19:16', '2026-04-27 16:19:16'),
(4, 'manage_user', 'web', '2026-04-27 16:19:16', '2026-04-27 16:19:16'),
(5, 'manage_acl', 'web', '2026-04-27 16:19:16', '2026-04-27 16:19:16'),
(6, 'manage_site_setting', 'web', '2026-05-29 15:33:02', '2026-05-29 15:33:02');

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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `subject_id`, `exam_type`, `language`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'What is capital of BD?', 4, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(2, 'What is the national flower of Bangladesh?', 4, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(3, 'Which river is the longest in Bangladesh?', 4, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(4, 'Who is the first President of Bangladesh?', 4, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(5, 'What is the national animal of Bangladesh?', 4, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(6, 'বাংলা ভাষার জনক কে?', 1, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(7, 'বাংলা সাহিত্যের প্রথম মহাকাব্য কোনটি?', 1, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(8, 'কাজী নজরুল ইসলামকে কী বলা হয়?', 1, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(9, 'বাংলা ভাষা আন্দোলন হয় কোন সালে?', 1, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(10, 'রবীন্দ্রনাথ ঠাকুর কোন পুরস্কার পেয়েছিলেন?', 1, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(11, 'What is the synonym of \'Happy\'?', 2, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(12, 'Which is a verb?', 2, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(13, 'What is the plural of \'Child\'?', 2, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(14, 'Choose the correct article: ___ honest man', 2, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(15, 'Which tense is used in: \'I am reading a book\'?', 2, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(16, 'What is 10 + 15?', 3, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(17, 'What is the square of 5?', 3, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(18, 'What is 100 ÷ 4?', 3, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(19, 'If x = 5, what is x + 7?', 3, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(20, 'What is the value of 2 × (3 + 4)?', 3, 'bcs', 'en', 1, '2026-04-27 16:35:10', '2026-04-27 16:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `question_explanations`
--

CREATE TABLE `question_explanations` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `explanation_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_explanations`
--

INSERT INTO `question_explanations` (`id`, `question_id`, `explanation_text`, `language`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhaka is capital	', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(2, 2, 'Water Lily is the national flower of Bangladesh', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(3, 3, 'Meghna is the longest river in Bangladesh', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(4, 4, 'Abu Sayeed Chowdhury was the first President of Bangladesh', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(5, 5, 'Royal Bengal Tiger is the national animal of Bangladesh', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(6, 6, 'ঈশ্বরচন্দ্র বিদ্যাসাগরকে বাংলা ভাষার জনক বলা হয়', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(7, 7, 'মেঘনাদবধ কাব্য বাংলা সাহিত্যের প্রথম মহাকাব্য', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(8, 8, 'কাজী নজরুল ইসলাম বিদ্রোহী কবি নামে পরিচিত', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(9, 9, '১৯৫২ সালে বাংলা ভাষা আন্দোলন সংঘটিত হয়', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(10, 10, 'রবীন্দ্রনাথ ঠাকুর নোবেল পুরস্কার পেয়েছিলেন', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(11, 11, '\'Joyful\' is the synonym of Happy', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(12, 12, '\'Run\' is a verb', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(13, 13, '\'Children\' is the correct plural of Child', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(14, 14, '\'An\' is used before words starting with vowel sound', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(15, 15, 'The sentence is in Present Continuous tense', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(16, 16, '10 + 15 = 25', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(17, 17, '5 × 5 = 25', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(18, 18, '100 divided by 4 equals 25', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(19, 19, 'x + 7 = 12', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10'),
(20, 20, '2 × (3 + 4) = 14', 'en', '2026-04-27 16:35:10', '2026-04-27 16:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `question_tags`
--

CREATE TABLE `question_tags` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'admin', 'web', '2026-04-27 16:19:16', '2026-04-27 16:19:16'),
(2, 'participant', 'web', '2026-04-27 16:49:19', '2026-04-27 16:49:19');

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
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banners` json DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `banners`, `address`, `email`, `contact_number`, `facebook_link`, `linkedin_link`, `instagram_link`, `whatsapp_link`, `created_at`, `updated_at`) VALUES
(1, 'settings/1VqQDEEQ6XOqby9SLo6zxRFrbatnfXLKyFvOR8iv.png', '[\"settings/banners/bHm8GDeLbdiUJ8cSJSo0eaqTwWvJq9cmp6h5ESxv.jpg\", \"settings/banners/qfIV65Z0Xjsmy314DSye5xPsUSPSLC4FYekEtlay.jpg\"]', 'West Khabaspur', 'info@quizverse.com', '+8801777020443', 'https://facebook.com', NULL, NULL, NULL, '2026-05-29 16:31:00', '2026-05-30 14:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 'bangla', '2026-04-27 16:23:21', '2026-04-27 16:23:21'),
(2, 'English', 'english', '2026-04-27 16:23:35', '2026-04-27 16:23:35'),
(3, 'Mathematics', 'math', '2026-04-27 16:23:57', '2026-04-27 16:23:57'),
(4, 'General Knowledge', 'gk', '2026-04-27 16:24:05', '2026-04-27 16:24:05');

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
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$HV1s52/9T2iL1n4cV/J7v.oVeJ.dvwuAGyZAXs.InWCinmardorAm', 'admin', NULL, '2026-04-27 16:19:16', '2026-04-27 16:19:16'),
(2, 'Avilash Saha', 'avilash@gmail.com', NULL, '$2y$12$.z14VDxEtup8xV1wPGIU4.DNCna74fNGnurF5QkxrHbqKGtGYjRGS', 'user', NULL, '2026-04-27 16:42:46', '2026-04-27 16:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_attempt_users_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `selected_option_id` bigint UNSIGNED DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `answered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exams_slug_unique` (`slug`),
  ADD KEY `exams_created_by_foreign` (`created_by`),
  ADD KEY `exams_exam_type_is_active_index` (`exam_type`,`is_active`),
  ADD KEY `exams_start_date_end_date_index` (`start_date`,`end_date`);

--
-- Indexes for table `exam_attempt_users`
--
ALTER TABLE `exam_attempt_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_attempt_users_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_attempt_users_user_id_exam_id_index` (`user_id`,`exam_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_questions_exam_id_question_id_unique` (`exam_id`,`question_id`),
  ADD KEY `exam_questions_question_id_foreign` (`question_id`),
  ADD KEY `exam_questions_exam_id_order_index` (`exam_id`,`order`);

--
-- Indexes for table `exam_subjects`
--
ALTER TABLE `exam_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_subjects_exam_id_subject_id_unique` (`exam_id`,`subject_id`),
  ADD KEY `exam_subjects_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imports_admin_id_foreign` (`admin_id`),
  ADD KEY `imports_exam_id_foreign` (`exam_id`);

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
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_subject_id_foreign` (`subject_id`),
  ADD KEY `questions_created_by_foreign` (`created_by`);

--
-- Indexes for table `question_explanations`
--
ALTER TABLE `question_explanations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_explanations_question_id_foreign` (`question_id`);

--
-- Indexes for table `question_tags`
--
ALTER TABLE `question_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_tags_question_id_foreign` (`question_id`);

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
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `answers_exam_attempt_users_id_question_id_unique` (`exam_attempt_users_id`,`question_id`),
  ADD KEY `answers_question_id_foreign` (`question_id`),
  ADD KEY `answers_selected_option_id_foreign` (`selected_option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_attempt_users`
--
ALTER TABLE `exam_attempt_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `exam_subjects`
--
ALTER TABLE `exam_subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `question_explanations`
--
ALTER TABLE `question_explanations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `question_tags`
--
ALTER TABLE `question_tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_attempt_users`
--
ALTER TABLE `exam_attempt_users`
  ADD CONSTRAINT `exam_attempt_users_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_attempt_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_subjects`
--
ALTER TABLE `exam_subjects`
  ADD CONSTRAINT `exam_subjects_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `imports`
--
ALTER TABLE `imports`
  ADD CONSTRAINT `imports_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `imports_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `question_explanations`
--
ALTER TABLE `question_explanations`
  ADD CONSTRAINT `question_explanations_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_tags`
--
ALTER TABLE `question_tags`
  ADD CONSTRAINT `question_tags_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `answers_exam_attempt_users_id_foreign` FOREIGN KEY (`exam_attempt_users_id`) REFERENCES `exam_attempt_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_selected_option_id_foreign` FOREIGN KEY (`selected_option_id`) REFERENCES `options` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
