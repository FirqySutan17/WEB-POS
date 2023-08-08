-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 09:05 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koontjie_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_robots` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_image_width` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_image_height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_alternate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_creator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_site` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schema_markup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `name`, `slug`, `meta_title`, `meta_description`, `meta_keyword`, `meta_robots`, `og_title`, `og_site_name`, `og_description`, `og_url`, `og_image`, `og_image_width`, `og_image_height`, `og_type`, `og_locale`, `og_alternate`, `twitter_card`, `twitter_title`, `twitter_description`, `twitter_image`, `twitter_creator`, `twitter_site`, `schema_markup`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Home', 'home', 'Beranda - Koontjie', 'Koontjie Digital Agency', 'agency, house', 'index', 'Beranda - Koontjie', 'Beranda - Koontjie', 'Beranda - Koontjie', 'https://koontjie.id', 'logo.png', '230px', '450px', 'website', 'id_ID', 'en_EN', 'Beranda - Koontjie', 'Beranda - Koontjie', 'Beranda - Koontjie', 'logo.png', 'Koontjie', 'https://koontjie/koontjie', 'Beranda - Koontjie', '2023-01-29 22:59:23', '2023-01-29 22:59:23', 1, NULL),
(11, 'About', 'about', 'Tentang - Koontjie', 'Koontjie Digital Agency', 'agency, house', 'index', 'Tentang - Koontjie', 'Tentang - Koontjie', 'Tentang - Koontjie', 'https://koontjie.id/about', 'icon-koontjie.png', '230px', '450px', 'website', 'id_ID', 'en_EN', 'Tentang - Koontjie', 'Tentang - Koontjie', 'Tentang - Koontjie', 'icon-koontjie.png', 'Koontjie', 'https://twitter.com/koontjie', 'Check schema markup', '2023-07-13 23:30:18', '2023-07-13 23:30:18', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2018_01_01_000000_create_permission_tables', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2022_01_13_070437_create_password_resets_table', 1),
(10, '2022_01_13_070515_create_failed_jobs_table', 1),
(12, '2022_01_13_070247_create_users_table', 2),
(14, '2023_01_12_073814_create_hww_table', 3),
(15, '2023_01_13_025037_create_tech_stack_table', 4),
(16, '2023_01_13_064338_create_partner_table', 5),
(17, '2023_01_13_073852_create_team_table', 6),
(18, '2023_01_13_084358_create_service_table', 7),
(19, '2023_01_13_090742_create_product_promotion_table', 8),
(20, '2023_01_17_075327_create_product_table', 9),
(21, '2023_01_17_083150_create_gallery_table', 10),
(22, '2023_01_17_090509_create_journey_table', 11),
(23, '2023_01_30_024437_create_meta_table', 12),
(24, '2023_01_30_071646_create_event_table', 13),
(25, '2023_01_30_071804_create_event_image_table', 14),
(26, '2023_02_02_030826_create_career_table', 15),
(27, '2023_02_02_031422_create_career_req_description_table', 16),
(28, '2023_02_02_031609_create_career_job_description_table', 17),
(29, '2023_02_02_031653_create_career_benefit_table', 18),
(30, '2023_02_02_032625_create_skill_table', 19),
(31, '2023_02_02_032649_create_career_skill_table', 20),
(32, '2023_02_03_021326_create_career_skill_table', 21),
(33, '2023_02_07_021002_create_contact_table', 22),
(34, '2023_02_07_025013_create_career_form_table', 23),
(35, '2023_02_07_033502_create_project_type_table', 24),
(36, '2023_02_07_035735_create_portfolio_table', 25),
(37, '2023_02_07_035806_create_portfolio_image_table', 26),
(38, '2023_02_07_042135_create_portfolio_skill_table', 27),
(39, '2023_02_09_090216_create_location_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Portfolio Show', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(2, 'Portfolio Create', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(3, 'Portfolio Update', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(4, 'Portfolio Delete', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(5, 'Meta Show', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(6, 'Meta Create', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(7, 'Meta Update', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(8, 'Meta Delete', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(9, 'Skill Show', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(10, 'Skill Create', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(11, 'Skill Update', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(12, 'Skill Delete', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(13, 'User Show', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(14, 'User Create', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(15, 'User Update', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(16, 'User Delete', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(17, 'Role Show', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(18, 'Role Create', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(19, 'Role Update', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(20, 'Role Delete', 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_year` int(11) DEFAULT NULL,
  `end_year` int(11) DEFAULT NULL,
  `description_2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `client_name`, `slug`, `project_title`, `link`, `description`, `start_year`, `end_year`, `description_2`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(10, 'Check 1', 'check-1', 'PT. Cheil Jedang Indonesia', 'https://domain.com', 'Kita coba check disini, mengenai lorem ipsum dolor sit amet!', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL),
(11, 'EMMA S.', 'emma-s', 'Emma S. skincare is a Swedish skincare brand, founded by former supermodel Emma S. Wiklund.', 'https://domain.com', '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam enim assumenda officiis, praesentium voluptatem debitis sit voluptatum quaerat eius reiciendis illo architecto, totam unde sed ipsa voluptates tenetur, molestiae mollitia!<br /><br />Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates recusandae earum explicabo beatae, ullam quos hic, ipsa magni veritatis sed natus. Ratione iste tempora ipsam nostrum maiores doloribus dicta consequatur!</p>', 2021, 2023, '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam enim assumenda officiis, praesentium voluptatem debitis sit voluptatum quaerat eius reiciendis illo architecto, totam unde sed ipsa voluptates tenetur, molestiae mollitia!<br /><br />Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates recusandae earum explicabo beatae, ullam quos hic, ipsa magni veritatis sed natus. Ratione iste tempora ipsam nostrum maiores doloribus dicta consequatur!</p>', 1, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_image`
--

CREATE TABLE `portfolio_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `portfolio_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hover_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_image`
--

INSERT INTO `portfolio_image` (`id`, `portfolio_id`, `image`, `alt_text`, `hover_text`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, '10', 'Telkomsel.png', 'Alt Text', 'Hover Text', NULL, NULL, NULL, NULL),
(2, '10', 'axis.png', 'Alt Text 2', 'Hover Text 2', NULL, NULL, NULL, NULL),
(80, '11', 'detail-1.png', 'Alt Text', 'Hover Text', NULL, NULL, NULL, NULL),
(81, '11', 'detail-2.png', 'Alt Text 2', 'Hover Text 2', NULL, NULL, NULL, NULL),
(82, '11', 'detail-3.png', 'Alt Text 3', 'Hover Text 3', NULL, NULL, NULL, NULL),
(83, '11', 'detail-4.png', 'Alt Text 4', 'Hover Text 4', NULL, NULL, NULL, NULL),
(84, '11', 'detail-5.png', 'Alt Text 5', 'Hover Text 5', NULL, NULL, NULL, NULL),
(85, '11', 'detail-6.png', 'Alt Text 6', 'Hover Text 6', NULL, NULL, NULL, NULL),
(86, '11', 'detail-7.png', 'Alt Text 7', 'Hover Text 7', NULL, NULL, NULL, NULL),
(87, '11', 'detail-8.png', 'Alt Text 8', 'Hover Text 8', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_skill`
--

CREATE TABLE `portfolio_skill` (
  `portfolio_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_skill`
--

INSERT INTO `portfolio_skill` (`portfolio_id`, `skill_id`) VALUES
(10, 1),
(10, 3),
(10, 6),
(11, 1),
(11, 3),
(11, 2),
(11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_slider`
--

CREATE TABLE `portfolio_slider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `portfolio_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_slider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text_slider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hover_text_slider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_slider`
--

INSERT INTO `portfolio_slider` (`id`, `portfolio_id`, `image_slider`, `alt_text_slider`, `hover_text_slider`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, '11', 'detail-slide-1.png', 'Slider', 'Slider Hover', NULL, NULL, NULL, NULL),
(6, '11', 'detail-slide-2.png', 'Slider 2', 'Slider Hover 2', NULL, NULL, NULL, NULL),
(7, '11', 'detail-slide-3.png', 'Slider 3', 'Slider Hover 3', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', 'Have permission for data master Portfolio, Meta, Categories, Users & Roles', 'web', '2023-07-13 23:41:23', '2023-07-13 23:47:05'),
(2, 'Admin', NULL, 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23'),
(3, 'Editor', NULL, 'web', '2023-07-13 23:41:23', '2023-07-13 23:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
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
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(11, 3),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `single_upload`
--

CREATE TABLE `single_upload` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `single_upload`
--

INSERT INTO `single_upload` (`id`, `title`, `description`, `image`) VALUES
(1, 'test', 'deskripsi', 'photo_2022-08-23_01-14-45.jpg'),
(2, 'Check Triple', 'Good triple', 'background-3104413__480.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `name`, `slug`, `image`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Figma', 'figma', 'Group 1653.png', 1, '2023-02-02 00:02:31', '2023-02-02 00:02:31', 1, NULL),
(2, 'Javascript', 'javascript', 'Group 1652.png', 1, '2023-02-08 02:41:17', '2023-02-08 02:41:17', 1, NULL),
(3, 'Vue js', 'vue-js', 'Group 1651.png', 1, '2023-02-08 02:41:36', '2023-02-08 02:41:36', 1, NULL),
(4, 'Flutter', 'flutter', 'Group 1652.png', 1, '2023-02-08 02:43:33', '2023-02-08 02:43:33', 1, NULL),
(5, 'React Native', 'react-native', 'Group 1652.png', 1, '2023-02-08 02:43:49', '2023-02-08 02:43:49', 1, NULL),
(6, 'Java', 'java', 'Group 1652.png', 1, '2023-02-08 02:44:02', '2023-02-08 02:44:02', 1, NULL),
(7, 'Swift', 'swift', 'Group 1652.png', 1, '2023-02-08 02:44:21', '2023-02-08 02:44:21', 1, NULL),
(8, 'Kotlin', 'kotlin', 'Group 1652.png', 1, '2023-02-08 02:44:40', '2023-02-08 02:44:40', 1, NULL),
(9, 'Laravel', 'laravel', 'Group 1651.png', 1, '2023-02-08 02:44:59', '2023-02-08 02:44:59', 1, NULL),
(10, 'React Js', 'react-js', 'Group 1651.png', 1, '2023-02-08 02:45:18', '2023-02-08 02:45:18', 1, NULL),
(11, 'Node Js', 'node-js', 'Group 1651.png', 1, '2023-02-08 02:45:34', '2023-02-08 02:45:34', 1, NULL),
(12, 'Go', 'go', 'Group 1651.png', 1, '2023-02-08 02:45:57', '2023-02-08 02:45:57', 1, NULL),
(13, 'AI', 'ai', 'Group 1653.png', 1, '2023-02-08 02:46:16', '2023-02-08 02:46:16', 1, NULL),
(14, 'Photoshop', 'photoshop', 'Group 1653.png', 1, '2023-02-08 02:46:35', '2023-02-08 02:46:35', 1, NULL),
(15, 'Adobe XD', 'adobe-xd', 'Group 1653.png', 1, '2023-02-08 02:46:51', '2023-02-08 02:46:51', 1, NULL),
(16, 'Miro', 'miro', 'Group 1653.png', 1, '2023-02-08 02:47:07', '2023-02-08 02:47:07', 1, NULL),
(17, 'inVision', 'invision', 'Group 1653.png', 1, '2023-02-08 02:47:24', '2023-02-08 02:47:24', 1, NULL),
(18, 'UI/UX Design', 'ui-ux-design', 'magicpattern-blob-1665730082104.png', 1, '2023-02-08 03:12:08', '2023-02-08 03:12:08', 1, NULL),
(19, 'Design System', 'design-system', 'magicpattern-blob-1665730082104.png', 1, '2023-02-08 03:12:38', '2023-02-08 03:12:38', 1, NULL),
(20, 'Wireframing', 'wireframing', 'magicpattern-blob-1665730082104.png', 1, '2023-02-08 03:13:04', '2023-02-08 03:13:04', 1, NULL),
(21, 'Prototyping', 'prototyping', 'magicpattern-blob-1665730082104.png', 1, '2023-02-08 03:13:29', '2023-02-08 03:13:29', 1, NULL),
(24, 'Zheck', 'zheck', 'hww-flexible.png', 1, '2023-02-08 13:11:03', '2023-02-08 13:11:03', 1, NULL),
(25, 'Zeck', 'zeck', '', 1, '2023-02-08 13:11:53', '2023-02-08 13:11:53', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `name`, `email`, `email_verified_at`, `phone_number`, `office`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '01220023', 'Master Admin', 'admin@koontjie.id', '2023-01-10 18:55:51', '08123456789', 'Jakarta', '$2y$10$Ra9HfC9VbIYR871aiH4lvOzo8CmXGIo3tXdytak4vdJr0g7D45EmO', '819675.png', 1, 'qSTyLC5dwg6RLkRkIG1dSzp0LTdXBlOTiON96hp9Udygd723Z1hbPAOKA8ea', '2023-01-10 18:55:51', '2023-02-05 20:47:47'),
(2, '01220024', 'Firqy Sutan', 'firqy@cj.co.id', NULL, '085959238296', 'Jakarta', '$2y$10$UZEMvhdnmf9hGzGp9qVYfOl2HBPtYvDH8qtQ.CzwXGI0Kf2OdC3gS', 'public/images/NXNx34zMUAsp7ucoFS2CA4n3CmtpQEbZpJRbxK8l.png', 0, NULL, '2023-01-11 01:45:25', '2023-01-11 01:45:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_slug_unique` (`slug`);

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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolio_slug_unique` (`slug`);

--
-- Indexes for table `portfolio_image`
--
ALTER TABLE `portfolio_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_skill`
--
ALTER TABLE `portfolio_skill`
  ADD KEY `portfolio_skill_portfolio_id_foreign` (`portfolio_id`),
  ADD KEY `portfolio_skill_skill_id_foreign` (`skill_id`);

--
-- Indexes for table `portfolio_slider`
--
ALTER TABLE `portfolio_slider`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `single_upload`
--
ALTER TABLE `single_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skill_slug_unique` (`slug`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `portfolio_image`
--
ALTER TABLE `portfolio_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `portfolio_slider`
--
ALTER TABLE `portfolio_slider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `single_upload`
--
ALTER TABLE `single_upload`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `portfolio_skill`
--
ALTER TABLE `portfolio_skill`
  ADD CONSTRAINT `portfolio_skill_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `portfolio_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
