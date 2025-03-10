-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 11:41 AM
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
-- Database: `naccfl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `f_name`, `l_name`, `phone`, `email`, `image`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Janam', 'Pandey', '+9779866077949', 'janampandey2@gmail.com', '2025-02-11-67ab3043027e3.png', '$2y$10$q5mHXA4mgUct1bVoPpblTOJdIKafmV0CQy1RaR8MHLJoX25tBBjnq', 1, NULL, '2023-09-30 04:31:25', '2025-03-02 05:33:00', 1),
(2, 'Prince', 'Yadav', '9813104240', 'prince@gmail.com', '2023-10-09-65241d9daf392.png', '$2y$10$q5mHXA4mgUct1bVoPpblTOJdIKafmV0CQy1RaR8MHLJoX25tBBjnq', 1, NULL, '2023-10-09 21:19:53', '2025-02-25 09:13:48', 5),
(5, 'Shristi', 'Shrestha', '9828367494', 'jananpandey1995@gmail.com', '2025-01-10-6780b2424a617.png', '$2y$10$/cQcMpqdFvVobRp5ZPM2q.Zx1sxzI21Z9R9Vx7kJSeJGZhYc/xofO', 1, NULL, '2024-05-19 16:09:05', '2025-02-16 12:24:07', 5);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `modules` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `modules`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master Admin', NULL, 1, NULL, NULL),
(5, 'Staff', '[\"attendance\",\"timesheet\",\"leave\",\"travelorder\"]', 1, '2025-01-08 09:19:46', '2025-03-02 05:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_logs`
--

CREATE TABLE `attendance_logs` (
  `id` int(11) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `checkin_time` datetime NOT NULL DEFAULT current_timestamp(),
  `ci_lat` varchar(191) NOT NULL,
  `ci_lon` varchar(191) NOT NULL,
  `checkout_time` datetime DEFAULT NULL,
  `co_lat` varchar(191) DEFAULT NULL,
  `co_lon` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_logs`
--

INSERT INTO `attendance_logs` (`id`, `emp_id`, `checkin_time`, `ci_lat`, `ci_lon`, `checkout_time`, `co_lat`, `co_lon`, `created_at`, `updated_at`) VALUES
(9, 5, '2025-02-18 17:12:48', '27.7108', '85.3251', NULL, NULL, NULL, '2025-02-18 17:12:48', '2025-02-18 17:12:48'),
(10, 5, '2025-02-27 17:29:21', '27.6955787', '85.3006855', '2025-02-27 17:39:25', '27.6941615', '85.3006854', '2025-02-27 17:29:21', '2025-02-27 17:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(4, 'mail_config', '{\"status\":\"1\",\"name\":\"NACCFL\",\"host\":\"mail.thinktankinfotech.com\",\"driver\":\"smtp\",\"port\":\"465\",\"username\":\"info@thinktankinfotech.com\",\"email_id\":\"info@thinktankinfotech.com\",\"encryption\":\"ssl\",\"password\":\"ThinkTankInfoTech#@21^^??\"}', NULL, '2025-02-16 09:36:29'),
(16, 'business_name', 'Field Staff Management System', NULL, NULL),
(18, 'logo', '2025-02-16-67b1a0b670313.png', NULL, NULL),
(19, 'phone', '+977015153170', NULL, NULL),
(20, 'email_address', 'skbks.nepal@gmail.com', NULL, NULL),
(21, 'address', 'Dhobighat-3 Lalitpur Province -3,Nepal', NULL, NULL),
(22, 'footer_text', 'All Right Reserved', NULL, NULL),
(23, 'customer_verification', '1', NULL, NULL),
(37, 'timezone', 'Asia/Katmandu', NULL, NULL),
(44, 'country', 'AF', NULL, NULL),
(78, 'recaptcha', '{\"status\":\"1\",\"site_key\":\"6Lf8pr0qAAAAABgqOAwm5wLrXmBdr__BFJS2Y6Zu\",\"secret_key\":\"6Lf8pr0qAAAAAEYX6SgutPJ-B3W0L9UnoHIqN3j1\"}', '2025-01-20 16:49:04', '2025-01-20 16:49:04'),
(79, 'language', '[\"en\"]', NULL, '2025-01-05 06:06:19'),
(82, 'icon', '2025-02-16-67b1ab9c9d143.png', NULL, NULL),
(97, 'feature', '[]', NULL, NULL),
(100, 'system_language', '[{\"id\":1,\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":true}]', '2023-07-10 00:56:39', '2025-01-05 06:06:19'),
(134, 'forget_password_mail_status_admin', '1', NULL, NULL),
(153, 'system_php_path', '/usr/bin/php', NULL, NULL),
(193, 'country_picker_status', '0', '2024-07-09 13:53:09', '2024-07-09 13:53:09'),
(194, 'local_storage', '1', '2024-07-09 16:07:20', '2024-07-09 16:07:20'),
(209, 'cookies_text', NULL, NULL, NULL),
(210, 'default_location', '{\"lat\":null,\"lng\":null}', NULL, NULL),
(211, 'timeformat', '12', NULL, NULL),
(212, 'digit_after_decimal_point', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_settings`
--

CREATE TABLE `data_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_settings`
--

INSERT INTO `data_settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'admin_login_url', 'admin', 'login_admin', '2023-06-20 16:55:51', '2023-06-20 16:55:51'),
(2, 'admin_employee_login_url', 'staff', 'login_admin_employee', '2023-06-20 16:55:51', '2023-06-20 16:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `background_image` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `button_name` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `email_type` varchar(255) DEFAULT NULL,
  `email_template` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `body`, `background_image`, `image`, `logo`, `icon`, `button_name`, `button_url`, `footer_text`, `copyright_text`, `type`, `email_type`, `email_template`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Change Password Request', '<p>The following user has forgotten his password &amp; requested to change/reset their password.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>User Name: {userName}</strong></p>', NULL, NULL, NULL, '2025-02-27-67c028219789d.png', '', '', 'Please contact us for any queries; we’re always happy to help.', '© 2025 NACCFL. All rights reserved.', 'admin', 'forget_password', '5', 1, '2023-06-20 18:19:43', '2025-02-27 08:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `leave_type` varchar(255) NOT NULL COMMENT 'sl = Sick Leave\r\nel = Emergency Leave',
  `from_date` date NOT NULL DEFAULT current_timestamp(),
  `to_date` date NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(255) NOT NULL,
  `reason_description` varchar(255) NOT NULL,
  `leave_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `emp_id`, `leave_type`, `from_date`, `to_date`, `subject`, `reason_description`, `leave_status`, `created_at`, `updated_at`) VALUES
(1, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(2, 2, 'el', '2025-02-27', '2025-02-28', '', 'I need leave', 'approved', '2025-02-25 14:59:21', '2025-02-27 13:35:58'),
(3, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(4, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'rejected', '2025-02-25 13:57:32', '2025-02-25 16:52:37'),
(5, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(6, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(7, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(8, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(9, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(10, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(11, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(12, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(13, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(14, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(15, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(16, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(17, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(18, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(19, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(20, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(21, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(22, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(23, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(24, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(25, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(26, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(27, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(28, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(29, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(30, 5, 'sl', '2025-02-26', '2025-03-01', '', 'I have fever. So, I cant come.', 'approved', '2025-02-25 13:57:32', '2025-02-25 14:54:50'),
(31, 5, 'el', '2025-02-28', '2025-03-05', 'Bratabandha Leave', 'I have to attend my son\'s bratabandha. So, I need leave.', 'rejected', '2025-02-27 10:45:38', '2025-02-27 12:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_05_081114_create_admins_table', 1),
(53, '2021_05_10_152713_create_business_settings_table', 10),
(134, '2021_07_13_133941_create_admin_roles_table', 44),
(137, '2021_07_14_110011_create_employee_roles_table', 46),
(212, '2021_12_22_114414_create_translations_table', 75),
(325, '2023_05_10_184114_create_data_settings_table', 87),
(329, '2023_05_18_161133_create_email_templates_table', 87),
(382, '2024_06_06_115927_create_storages_table', 91);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `otp_hit_count` tinyint(4) NOT NULL DEFAULT 0,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `temp_block_time` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) DEFAULT 'user',
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE `storages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_type` varchar(255) NOT NULL,
  `data_id` varchar(100) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id`, `data_type`, `data_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\BusinessSetting', '160', NULL, 'public', '2025-01-10 08:33:02', '2025-01-10 08:33:02'),
(10, 'App\\Models\\BusinessSetting', '118', NULL, 'public', '2024-12-31 10:12:57', '2024-12-31 10:12:57'),
(21, 'App\\Models\\BusinessSetting', '198', NULL, 'public', '2024-10-21 15:26:16', '2024-10-21 15:26:16'),
(22, 'App\\Models\\BusinessSetting', '199', NULL, 'public', '2024-10-21 15:26:16', '2024-10-21 15:26:16'),
(23, 'App\\Models\\BusinessSetting', '200', NULL, 'public', '2024-12-31 06:24:18', '2024-12-31 06:24:18'),
(24, 'App\\Models\\BusinessSetting', '196', NULL, 'public', '2025-01-28 05:41:21', '2025-01-28 05:41:21'),
(25, 'App\\Models\\BusinessSetting', '100', NULL, 'public', '2025-01-05 06:05:29', '2025-01-05 06:05:29'),
(26, 'App\\Models\\BusinessSetting', '79', NULL, 'public', '2025-01-05 06:06:19', '2025-01-05 06:06:19'),
(27, 'App\\Models\\BusinessSetting', '53', NULL, 'public', '2025-01-07 06:39:43', '2025-01-07 06:39:43'),
(28, 'App\\Models\\DataSetting', '108', NULL, 'public', '2025-01-07 06:07:10', '2025-01-07 06:07:10'),
(29, 'App\\Models\\DataSetting', '109', NULL, 'public', '2025-01-07 06:07:10', '2025-01-07 06:07:10'),
(30, 'App\\Models\\DataSetting', '110', NULL, 'public', '2025-01-07 06:07:10', '2025-01-07 06:07:10'),
(32, 'App\\Models\\Admin', '1', 'image', 'public', '2025-02-11 11:10:59', '2025-02-11 11:10:59'),
(33, 'App\\Models\\Admin', '5', 'image', 'public', '2025-01-10 05:38:10', '2025-01-10 05:38:10'),
(42, 'App\\Models\\EmailTemplate', '1', 'icon', 'public', '2025-02-27 08:53:53', '2025-02-27 08:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `supporting_images` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timesheets`
--

INSERT INTO `timesheets` (`id`, `emp_id`, `details`, `supporting_images`, `created_at`, `updated_at`) VALUES
(1, 5, 'fdasgvfsdg', NULL, '2025-03-02 12:31:24', '2025-03-02 12:31:24'),
(2, 5, 'drsfgdfgdfshgsfd', '[{\"img\":\"2025-03-02-67c40f10d755f.png\",\"storage\":\"public\"},{\"img\":\"2025-03-02-67c40f10dabe9.png\",\"storage\":\"public\"},{\"img\":\"2025-03-02-67c40f10dc792.png\",\"storage\":\"public\"}]', '2025-03-02 13:41:00', '2025-03-02 13:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `translationable_type` varchar(255) NOT NULL,
  `translationable_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `translationable_type`, `translationable_id`, `locale`, `key`, `value`, `created_at`, `updated_at`) VALUES
(111, 'App\\Models\\EmailTemplate', 1, 'en', 'title', 'Change Password Request', NULL, NULL),
(112, 'App\\Models\\EmailTemplate', 1, 'en', 'body', '<p>The following user has forgotten his password &amp; requested to change/reset their password.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>User Name: {userName}</strong></p>', NULL, NULL),
(113, 'App\\Models\\EmailTemplate', 1, 'en', 'button_name', '', NULL, NULL),
(114, 'App\\Models\\EmailTemplate', 1, 'en', 'footer_text', 'Please contact us for any queries; we’re always happy to help.', NULL, NULL),
(115, 'App\\Models\\EmailTemplate', 1, 'en', 'copyright_text', '© 2023 NACCFL. All rights reserved.', NULL, NULL),
(156, 'App\\Models\\EmailTemplate', 28, 'en', 'title', 'Reset Your Password', NULL, NULL),
(157, 'App\\Models\\EmailTemplate', 28, 'en', 'body', '<p>Please click on this link to reset your Password&nbsp;&rarr;</p>', NULL, NULL),
(158, 'App\\Models\\EmailTemplate', 28, 'en', 'button_name', '', NULL, NULL),
(159, 'App\\Models\\EmailTemplate', 28, 'en', 'footer_text', 'Please contact us for any queries; we’re always happy to help.', NULL, NULL),
(160, 'App\\Models\\EmailTemplate', 28, 'en', 'copyright_text', '© 2024 Knockdoor. All rights reserved.', NULL, NULL),
(3921, 'App\\Models\\AdminRole', 5, 'en', 'name', 'Staff', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `travel_orders`
--

CREATE TABLE `travel_orders` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `from_date` date NOT NULL DEFAULT current_timestamp(),
  `to_date` date NOT NULL DEFAULT current_timestamp(),
  `travel_place` varchar(255) NOT NULL,
  `travel_mode` varchar(255) NOT NULL,
  `travel_order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_orders`
--

INSERT INTO `travel_orders` (`id`, `emp_id`, `from_date`, `to_date`, `travel_place`, `travel_mode`, `travel_order_status`, `created_at`, `updated_at`) VALUES
(1, 5, '2025-03-03', '2025-03-08', 'Chitwan', 'Bus', 'approved', '2025-02-27 12:09:32', '2025-02-27 12:13:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_settings`
--
ALTER TABLE `data_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storages_data_id_index` (`data_id`),
  ADD KEY `storages_value_index` (`value`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translations_translationable_id_index` (`translationable_id`),
  ADD KEY `translations_locale_index` (`locale`);

--
-- Indexes for table `travel_orders`
--
ALTER TABLE `travel_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `data_settings`
--
ALTER TABLE `data_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3928;

--
-- AUTO_INCREMENT for table `travel_orders`
--
ALTER TABLE `travel_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
