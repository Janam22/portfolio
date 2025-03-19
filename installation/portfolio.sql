-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 11:52 AM
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
-- Database: `portfolio`
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
  `fcm_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `f_name`, `l_name`, `phone`, `email`, `image`, `password`, `status`, `remember_token`, `fcm_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Janam', 'Pandey', '+9779866077949', 'janampandey2@gmail.com', '2025-02-11-67ab3043027e3.png', '$2y$10$q5mHXA4mgUct1bVoPpblTOJdIKafmV0CQy1RaR8MHLJoX25tBBjnq', 1, NULL, NULL, '2023-09-30 04:31:25', '2025-03-02 05:33:00', 1),
(2, 'Prince', 'Yadav', '9813104240', 'prince@gmail.com', '2023-10-09-65241d9daf392.png', '$2y$10$q5mHXA4mgUct1bVoPpblTOJdIKafmV0CQy1RaR8MHLJoX25tBBjnq', 1, NULL, NULL, '2023-10-09 21:19:53', '2025-02-25 09:13:48', 5),
(5, 'Shristi', 'Shrestha', '9828367494', 'jananpandey1995@gmail.com', '2025-01-10-6780b2424a617.png', '$2y$10$q5mHXA4mgUct1bVoPpblTOJdIKafmV0CQy1RaR8MHLJoX25tBBjnq', 1, NULL, NULL, '2024-05-19 16:09:05', '2025-02-16 12:24:07', 5);

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
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_details` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `author_name`, `blog_image`, `blog_title`, `blog_details`, `status`, `slug`, `created_at`, `updated_at`) VALUES
(6, 'Janam Pandey', '2025-03-18-67d95e8729684.png', 'Latest Tech in Nepal', '<p>Testing Blog</p>', 1, 'latest-tech-in-nepal', '2025-03-18 06:07:39', '2025-03-18 06:07:39');

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
(111, 'about', '<p>Hello Testing</p>\r\n\r\n<p>&nbsp;</p>', 'admin_landing_page', '2025-03-11 06:18:33', '2025-03-11 06:18:33'),
(112, 'about_image', '2025-03-17-67d7ff4373fb0.png', 'admin_landing_page', '2025-03-17 05:05:03', '2025-03-17 05:05:03');

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
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'def.png',
  `description` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `service_id`, `name`, `image`, `description`, `link`, `status`, `created_at`, `updated_at`, `priority`, `slug`) VALUES
(71, 1, 'Cleaning', '2025-03-11-67cff746f0744.png', 'testing', 'www.testing.com', 1, '2025-01-13 06:08:33', '2025-03-15 23:28:05', 0, 'cleaning');

-- --------------------------------------------------------

--
-- Table structure for table `resume_details`
--

CREATE TABLE `resume_details` (
  `id` bigint(20) NOT NULL,
  `resume_type` varchar(255) NOT NULL COMMENT 'ed - Education\r\nex - Experience',
  `title` varchar(255) NOT NULL COMMENT 'Degree Name / Designation',
  `date_range` varchar(255) NOT NULL,
  `name_address` varchar(255) NOT NULL COMMENT 'Name (College, Company) / Address',
  `details` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume_details`
--

INSERT INTO `resume_details` (`id`, `resume_type`, `title`, `date_range`, `name_address`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ed', 'SEE', '2016-2017', 'Munal Academy, Gajuri Dhading', '<p>I completed with 3.75 GPA.</p>', 1, '2025-03-19 04:48:36', '2025-03-19 04:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'def.png',
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`, `priority`, `slug`) VALUES
(1, 'Website Development', '2025-03-11-67cfee8d01fda.png', 'Build your website with most experienced developer.', 1, '2025-03-11 02:19:29', '2025-03-11 05:58:22', 0, 'website-development');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rate` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `image`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PHP-Laravel', '2025-03-19-67da58d0777a5.png', 80, 1, '2025-03-18 23:55:32', '2025-03-19 00:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'https://www.facebook.com/janampandey12', 1, NULL, '2025-03-11 04:14:02'),
(2, 'linkedin', 'https://np.linkedin.com/in/janam-pandey-6bb571199', 1, NULL, '2025-03-11 04:14:53'),
(6, 'github', 'https://github.com/Janam22', 1, NULL, '2025-03-19 03:06:49');

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
(42, 'App\\Models\\EmailTemplate', '1', 'icon', 'public', '2025-02-27 08:53:53', '2025-02-27 08:53:53'),
(43, 'App\\Models\\Service', '1', 'image', 'public', '2025-03-11 02:19:29', '2025-03-11 02:19:29'),
(44, 'App\\Models\\Project', '71', 'image', 'public', '2025-03-11 02:56:43', '2025-03-11 02:56:43'),
(45, 'App\\Models\\DataSetting', '111', NULL, 'public', '2025-03-17 05:08:55', '2025-03-17 05:08:55'),
(46, 'App\\Models\\DataSetting', '112', NULL, 'public', '2025-03-17 05:05:03', '2025-03-17 05:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(4, 'mail_config', '{\"status\":\"1\",\"name\":\"Janam Pandey\",\"host\":\"mail.thinktankinfotech.com\",\"driver\":\"smtp\",\"port\":\"465\",\"username\":\"info@thinktankinfotech.com\",\"email_id\":\"info@thinktankinfotech.com\",\"encryption\":\"ssl\",\"password\":\"ThinkTankInfoTech#@21^^??\"}', NULL, '2025-03-10 07:17:54'),
(16, 'system_name', 'Janam Pandey\'s Portfolio', NULL, NULL),
(18, 'logo', '2025-03-10-67ce8be992d07.png', NULL, NULL),
(19, 'phone', '9866077949', NULL, NULL),
(20, 'email_address', 'jananpandey1995@gmail.com', NULL, NULL),
(21, 'address', 'Kathmandu Metro 16, Balaju, Kathmandu, Nepal', NULL, NULL),
(22, 'footer_text', 'All Right Reserved', NULL, NULL),
(23, 'customer_verification', '1', NULL, NULL),
(37, 'timezone', 'Asia/Katmandu', NULL, NULL),
(44, 'country', 'NP', NULL, NULL),
(78, 'recaptcha', '{\"status\":\"1\",\"site_key\":\"6Lf8pr0qAAAAABgqOAwm5wLrXmBdr__BFJS2Y6Zu\",\"secret_key\":\"6Lf8pr0qAAAAAEYX6SgutPJ-B3W0L9UnoHIqN3j1\"}', '2025-01-20 16:49:04', '2025-01-20 16:49:04'),
(79, 'language', '[\"en\"]', NULL, '2025-01-05 06:06:19'),
(82, 'icon', '2025-03-10-67ce8be99ab6d.png', NULL, NULL),
(97, 'feature', '[]', NULL, NULL),
(100, 'system_language', '[{\"id\":1,\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":true}]', '2023-07-10 00:56:39', '2025-01-05 06:06:19'),
(134, 'forget_password_mail_status_admin', '1', NULL, NULL),
(153, 'system_php_path', '/usr/bin/php', NULL, NULL),
(193, 'country_picker_status', '0', '2024-07-09 13:53:09', '2024-07-09 13:53:09'),
(194, 'local_storage', '1', '2024-07-09 16:07:20', '2024-07-09 16:07:20'),
(209, 'cookies_text', NULL, NULL, NULL),
(210, 'default_location', '{\"lat\":null,\"lng\":null}', NULL, NULL),
(211, 'timeformat', '12', NULL, NULL),
(212, 'digit_after_decimal_point', NULL, NULL, NULL),
(213, 'push_notification_service_file_content', '{\n  \"type\": \"service_account\",\n  \"project_id\": \"janam-70bc3\",\n  \"private_key_id\": \"5de4441ad35cf390430265858abfc34e3f907f58\",\n  \"private_key\": \"-----BEGIN PRIVATE KEY-----\\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDHi2jjnQgy6bJH\\nOxEGNqVkneF3PztB+Vqan33M1cYMZ4cRZzYpoVwfxjQuk7jLZu8dxCGE2iSr4SoM\\nirFceh/ky48fmBZeJWhywXYIcU4WOknQ17gmyyBn1+QtytoQk3Q33gLAlR7dZAQa\\nzMmN3QRJg+DpkwXPuzDDPe1RVCnY0HqSmiGfudKt+vkmCkBN5sv/Gq19p1CHuoNr\\ngBQwBq1WFDVNMGBfCUeXJ6UR0l3idmxocL1Zg0NKC4qdDfElBqDhLAf2k3RYwZOu\\n7QUaRkh2VSbvof8FyD49Aya68zPMU+5Ta5ZizLlFgTiOFOEtPOQyZZvV2pg2q2ky\\nufA4DPzfAgMBAAECggEAN92D5BWWsgpTazXSMlciPuUktmnxgSr6fsegRLSk2dwy\\nKGEo/Ma8L/khqtiYp/mNgFvktnkMQ0KqrxA1T5qxSzDiRQojWQBIGbin/v0Zy4dO\\nGzYJzHKaA/ihXWCpZHKj2vBA/QHCvmC99XLYCuuRw7M0SLBstBfIMyEnS9mwTY6x\\nJhBZqV+qUpYiXusRWV/ufjIvLSZavRtiH895+KPciyojjxGEGeS6nsAtIpI1+Ei9\\nZ5AIa3GUCgADF6NXWDR8/cBk0C9fHV+RmBVSYJSLbJolvXvBpDl4TVpw8Ts7t4so\\npawnGPRTpuafg1NApDYuNz8thGxwgvlYF54wbWFLQQKBgQD8/yxQMw3o21WzP2ID\\na6qGM1n5Tcob8r3OoG1L1N51BzEsORBi037JLh0vOrHXGAb3BuGmMxNH2MseUWQ+\\nsyFQqkUBZlcV63TKP2Uw8eg3Njf3+GztSz/tUUUqDrpz08MbxBDCcZw2los2HhhT\\nE5tCcLO46q2xHNHI3hbdhfo3aQKBgQDJ6c1Bvuq0KHmPf+QePOidjiERgqokEdwu\\nBgrG50UrNNeOcopR4c+/KDTgn0U97I2gzAYwYi6UiOoR426NgU029QcGVQTZB+ln\\nYe2Xdz3ruu39zWKCvnOacF0uPIsq+cDfReXW8MBEsH3twrbLDVBWumuOJiOgECtK\\nCPuWPtuRBwKBgAGkAfyPKDLvYTHlYlRVWWi/YoD8YSgnPdXeMndAbSTjJA1+XT3W\\n00aotuW8grS7Yigt8j6qrCBWJpMOwhCqBrhIMmRc7omk2kAJgzV7DB93iYthIAu1\\n5jc6xLEOIWVo5SYD8nvgUrwD4+k47r1zLhmTM4cqdm/kmPOthQZwvPupAoGAJWYs\\nAbCGMqaIlZ7ftwYbJAvObjrgntu8B75QwrTVqAIapyTqH+6Ol16wJKb7oVOujAke\\nYFnfPN37VSLmOEmp7rMGARNAWZ7Qibim1HZevsoaCPfA9mymZwXHDKhkMqqeIf0F\\nbIGda1uxh5eYWhX2Ooo/H85KrPwxuH3fc93it4MCgYBBAVX4vgschHb+Ydj8rOFX\\nzYnVywjtFzStfO5NnGcCW2LSoZi9P85feU96+NLj+6viIJpVcEASMflfzgHG0CXP\\n9ukfy6pJBkj2p+0iH6hrWQ8PDtcLVWwtM8KpLzjldKVzK/NgKQCKlJHA9zsd7KWZ\\noduMgbyopSNHJFCZFD42Mg==\\n-----END PRIVATE KEY-----\\n\",\n  \"client_email\": \"firebase-adminsdk-fbsvc@janam-70bc3.iam.gserviceaccount.com\",\n  \"client_id\": \"105140497374677914505\",\n  \"auth_uri\": \"https://accounts.google.com/o/oauth2/auth\",\n  \"token_uri\": \"https://oauth2.googleapis.com/token\",\n  \"auth_provider_x509_cert_url\": \"https://www.googleapis.com/oauth2/v1/certs\",\n  \"client_x509_cert_url\": \"https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-fbsvc%40janam-70bc3.iam.gserviceaccount.com\",\n  \"universe_domain\": \"googleapis.com\"\n}', NULL, NULL),
(214, 'fcm_project_id', 'janam-70bc3', NULL, NULL),
(215, 'fcm_credentials', '{\"apiKey\":\"AIzaSyCEFDZRDS95ct94KIX5ylmDoa8NEY3ZQEI\",\"authDomain\":\"janam-70bc3.firebaseapp.com\",\"projectId\":\"janam-70bc3\",\"storageBucket\":\"janam-70bc3.firebasestorage.app\",\"messagingSenderId\":\"430545914406\",\"appId\":\"1:430545914406:web:e0fd2298ba372136a4f4e7\",\"measurementId\":\"G-ZWHHS5BBCC\"}', NULL, NULL),
(217, 'client_count', '10', NULL, NULL),
(218, 'project_count', '20', NULL, NULL),
(219, 'service_count', '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `image`, `designation`, `message`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Janam Pandey', '2025-03-19-67da73f91198a.png', 'Developer, Global Tech', 'Very good.', 1, '2025-03-19 01:51:25', '2025-03-19 01:57:58');

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
(3921, 'App\\Models\\AdminRole', 5, 'en', 'name', 'Staff', NULL, NULL),
(3928, 'App\\Models\\Service', 1, 'en', 'name', 'Website Development', NULL, NULL),
(3929, 'App\\Models\\Project', 71, 'en', 'name', 'Cleaning', NULL, NULL),
(3930, 'App\\Models\\DataSetting', 111, 'en', 'about', '<p>Hello Testing</p>\r\n\r\n<p>&nbsp;</p>', NULL, NULL),
(3936, 'App\\Models\\Blog', 6, 'en', 'author_name', 'Janam Pandey', NULL, NULL),
(3937, 'App\\Models\\Skill', 1, 'en', 'name', 'PHP-Laravel', NULL, NULL),
(3938, 'App\\Models\\Testimonial', 3, 'en', 'name', 'Janam Pandey', NULL, NULL),
(3941, 'App\\Models\\ResumeDetail', 1, 'en', 'title', 'SEE', NULL, NULL);

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
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
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
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_details`
--
ALTER TABLE `resume_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storages_data_id_index` (`data_id`),
  ADD KEY `storages_value_index` (`value`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translations_translationable_id_index` (`translationable_id`),
  ADD KEY `translations_locale_index` (`locale`);

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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_settings`
--
ALTER TABLE `data_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

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
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `resume_details`
--
ALTER TABLE `resume_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3943;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
