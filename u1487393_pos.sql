-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Sep 2023 pada 08.39
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1487393_pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash_flow`
--

CREATE TABLE `cash_flow` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `approval` varchar(255) DEFAULT NULL,
  `cash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cash_flow`
--

INSERT INTO `cash_flow` (`id`, `date`, `time`, `employee_id`, `categories`, `description`, `approval`, `cash`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, '2023-09-08', '16:04', '01220023', 'IN', 'Pemasukan dari penjualan kardus', '14045', '20000', '2023-09-08 09:05:56', '2023-09-08 09:05:56', 1, NULL),
(2, '2023-09-12', '08:53', '01220023', 'OUT', 'Pembayaran Counterpain 4pcs', '14045', '100000', '2023-09-12 01:54:03', '2023-09-12 01:54:03', 1, NULL),
(3, '2023-09-12', '08:54', '01220023', 'OUT', 'Pembayarn Counterpain 4pcs', '14045', '100000', '2023-09-12 01:55:14', '2023-09-12 01:55:14', 1, NULL),
(4, '2023-09-12', '08:55', '01220023', 'OUT', 'Test 1', '14045', '10000', '2023-09-12 01:55:42', '2023-09-12 01:55:42', 1, NULL),
(5, '2023-09-12', '10:22', '01220023', 'OUT', 'Pembayaran Kebersihan bln September', '14045', '25000', '2023-09-12 03:23:45', '2023-09-12 03:23:45', 1, NULL),
(6, '2023-09-12', '10:23', '01220023', 'IN', 'Pendapatan dari penjualan kardus', '14045', '20000', '2023-09-12 03:24:22', '2023-09-12 03:24:22', 1, NULL),
(7, '2023-09-12', '14:51', '01220023', 'IN', 'Modal pertama per hari ini', '14045', '500000', '2023-09-12 07:51:34', '2023-09-12 07:51:34', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cl_date`
--

CREATE TABLE `cl_date` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT '0000-00-00',
  `end_date` date DEFAULT '0000-00-00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cl_date`
--

INSERT INTO `cl_date` (`id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, '2023-09-01', '2023-09-30', '2023-09-12 07:56:21', '2023-09-12 07:56:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `memberships`
--

CREATE TABLE `memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reg_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `memberships`
--

INSERT INTO `memberships` (`id`, `code`, `name`, `phone`, `email`, `reg_at`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'MBR-00001', 'Firqy Sutanwaliyah Ikhsan', '085959238296', 'firqy@cj.co.id', '2023-09-17 00:00:00', NULL, NULL, NULL, NULL),
(2, 'MBR-00002', 'M. Ikhsan Fatturahman', '081807164451', 'm.ikhsan@cj.co.id', NULL, '2023-09-07 07:23:59', '2023-09-07 07:23:59', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
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
(39, '2023_02_09_090216_create_location_table', 28),
(40, '2023_02_07_021736_create_contacts_table', 29),
(41, '2023_02_07_040547_create_portfolio_images_table', 29),
(42, '2023_08_16_035851_create_table_products', 29),
(43, '2023_08_21_041734_create_tr_receive', 30),
(44, '2023_08_21_042007_create_tr_receive_detail', 30),
(47, '2023_08_24_022236_update_products', 32),
(48, '2023_08_24_022722_create_products_price_log', 33),
(49, '2023_08_22_033713_create_tr_transaction', 34),
(50, '2023_08_22_033746_create_tr_transaction_detail', 34),
(52, '2018_01_01_000000_create_permission_tables', 35),
(53, '2023_09_07_132331_create_memberships_table', 36),
(54, '2023_09_08_102825_create_tr_transaction_log_table', 37),
(55, '2023_09_08_103044_create_shift_management_table', 38),
(56, '2023_09_08_103334_create_cash_flow_table', 39),
(57, '2023_09_08_135140_create_tr_transaction_detail_log_table', 40),
(58, '2023_09_12_143442_create_cl_date_table', 41),
(59, '2023_09_12_152445_create_product_categories_table', 42),
(60, '2023_09_12_155739_create_suppliers_table', 43);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'PC Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(2, 'PC Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(3, 'PC Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(4, 'PC Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(5, 'P Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(6, 'P Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(7, 'P Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(8, 'P Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(9, 'RS Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(10, 'RS Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(11, 'RS Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(12, 'RS Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(13, 'RT Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(14, 'RT Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(15, 'RT Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(16, 'RT Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(17, 'R Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(18, 'R Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(19, 'R Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(20, 'R Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(21, 'T Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(22, 'T Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(23, 'T Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(24, 'T Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(25, 'Meta Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(26, 'Meta Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(27, 'Meta Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(28, 'Meta Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(29, 'User Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(30, 'User Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(31, 'User Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(32, 'User Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(33, 'Role Show', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(34, 'Role Create', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(35, 'Role Update', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55'),
(36, 'Role Delete', 'web', '2023-08-29 19:10:55', '2023-08-29 19:10:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` longtext NOT NULL,
  `name` varchar(255) NOT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price_store` int(11) NOT NULL,
  `price_olshop` int(11) NOT NULL,
  `discount_store` int(11) DEFAULT 0,
  `discount_olshop` int(11) DEFAULT 0,
  `is_vat` tinyint(1) DEFAULT 0,
  `stock` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `categories`, `description`, `price_store`, `price_olshop`, `discount_store`, `discount_olshop`, `is_vat`, `stock`, `is_active`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '8998685057308', 'Frozz Blueberry Mint 15g', 'External', '<p>Teh Botol Less Sugar 600 ML</p>', 4500, 5000, 0, 0, NULL, 172, 1, 1, 1, NULL, '2023-08-20 19:17:23', '2023-09-11 08:22:01'),
(2, '8996001326398', 'Kis Mint 150g', 'External', '<p>Kalengan</p>', 15000, 12000, 0, 0, 1, 155, 1, 1, 1, NULL, '2023-08-20 19:21:13', '2023-09-11 08:22:00'),
(3, '8601054', 'KARKAS BROILER 600-699 (B)', 'Internal', '<p>KARKAS AYAM BROILER UK 600-699</p>', 25000, 20000, 0, 0, NULL, 135, 1, 1, 1, NULL, '2023-08-22 19:19:35', '2023-09-18 18:20:16'),
(4, '8601055', 'KARKAS BROILER 700-799 (B)', 'Internal', '<p>KARKAS AYAM BROILER UK 700-799</p>', 15000, 20000, 0, 0, NULL, 138, 1, 1, 6, NULL, '2023-08-22 19:19:35', '2023-09-11 08:16:26'),
(5, '8601056', 'KARKAS BROILER 800-899 (B)', 'Internal', '<p>KARKAS AYAM BROILER UK 800-899</p>', 15000, 20000, 0, 0, NULL, 167, 1, 1, 6, NULL, '2023-08-22 19:19:35', '2023-09-11 08:16:26'),
(6, '8601057', 'KARKAS BROILER 900-999 (B)', 'Internal', '<p>KARKAS AYAM BROILER UK 900-999 TEST UPDATE</p>', 10000, 20000, 5, 10, NULL, 80, 1, 1, 1, NULL, '2023-08-22 19:19:35', '2023-09-18 18:20:16'),
(7, '8998009010231', 'Ultra Milk Chocolate 250ml', 'External', '<p>Ultra Milk UHT Cokelat 250ml</p>', 7000, 8500, 0, 0, NULL, -7, 1, 1, 6, NULL, '2023-09-05 00:13:46', '2023-09-12 03:10:12'),
(8, '8991102374309', 'Tango Chocolate (Kaleng)', 'External', '<p>Tango Chocolate (Kaleng)</p>', 20000, 25000, 0, 0, NULL, 0, 1, 1, 0, NULL, '2023-09-05 00:17:19', '2023-09-05 00:17:19'),
(9, '8993190912463', 'Amidis Mineral Water 330ml', 'External', '<p>Amidis Mineral Water 330ml</p>', 4000, 5000, 0, 0, NULL, -5, 1, 1, 1, NULL, '2023-09-05 00:18:36', '2023-09-18 18:20:16'),
(10, '8995201800028', 'Counterpain 30gram', 'External', '<p>Counterpain</p>', 25000, 15000, 0, 0, 1, 1, 1, 1, 6, NULL, '2023-09-12 01:49:57', '2023-09-12 02:08:01'),
(19, '89900001', 'Test product', NULL, NULL, 250, 250, NULL, NULL, 1, 0, 1, 1, 0, NULL, '2023-09-13 05:56:09', '2023-09-13 05:56:09'),
(20, '8899900001', 'Cobain', 'External', NULL, 300000, 300000, 5, 5, 0, 0, 1, 1, 0, NULL, '2023-09-13 06:01:21', '2023-09-13 06:01:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products_price_log`
--

CREATE TABLE `products_price_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `price_store` int(11) DEFAULT NULL,
  `price_olshop` int(11) DEFAULT NULL,
  `discount_store` int(11) DEFAULT 0,
  `discount_olshop` int(11) DEFAULT 0,
  `is_vat` int(11) DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products_price_log`
--

INSERT INTO `products_price_log` (`id`, `product_code`, `price_store`, `price_olshop`, `discount_store`, `discount_olshop`, `is_vat`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '8601057', 15000, 20000, 5, 10, 0, 1, NULL, '2023-08-23 21:22:25', '2023-08-23 21:22:25'),
(2, '8601057', 10000, 20000, 5, 10, 0, 1, NULL, '2023-08-24 20:15:35', '2023-08-24 20:15:35'),
(3, '8996001326398', 15000, 12000, 0, 0, 0, 1, NULL, '2023-09-05 00:09:54', '2023-09-05 00:09:54'),
(4, '8998685057308', 4500, 5000, 0, 0, 0, 1, NULL, '2023-09-05 00:11:35', '2023-09-05 00:11:35'),
(5, '8998009010231', 7000, 8500, 0, 0, 0, 1, NULL, '2023-09-05 00:13:46', '2023-09-05 00:13:46'),
(6, '8991102374309', 20000, 25000, 0, 0, 0, 1, NULL, '2023-09-05 00:17:19', '2023-09-05 00:17:19'),
(7, '8993190912463', 4000, 5000, 0, 0, 0, 1, NULL, '2023-09-05 00:18:36', '2023-09-05 00:18:36'),
(8, '8601054', 25000, 20000, 0, 0, NULL, 1, NULL, '2023-09-12 01:47:05', '2023-09-12 01:47:05'),
(9, '8995201800028', 25000, 15000, 0, 0, 1, 1, NULL, '2023-09-12 01:49:57', '2023-09-12 01:49:57'),
(10, '89900001', 250, 250, NULL, NULL, 1, 1, NULL, '2023-09-13 05:56:09', '2023-09-13 05:56:09'),
(11, '8899900001', 2500000, 2500000, NULL, NULL, 1, 1, NULL, '2023-09-13 06:01:22', '2023-09-13 06:01:22'),
(12, '8899900001', 2500000, 2500000, NULL, NULL, 1, 1, NULL, '2023-09-13 06:23:05', '2023-09-13 06:23:05'),
(13, '8899900001', 300000, 300000, 5, 5, 1, 1, NULL, '2023-09-13 06:25:08', '2023-09-13 06:25:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_categories`
--

INSERT INTO `product_categories` (`id`, `categories`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Minuman', 'minuman', '2023-09-12 09:08:00', '2023-09-12 09:08:00'),
(2, 'Ayam', 'ayam', '2023-09-12 10:51:52', '2023-09-12 10:51:52'),
(3, 'Ikan', 'ikan', '2023-09-12 10:52:04', '2023-09-12 10:52:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(3, 19, 1, 0, '2023-09-13 05:56:09', '2023-09-13 05:56:09', NULL, NULL),
(4, 19, 2, 0, '2023-09-13 05:56:09', '2023-09-13 05:56:09', NULL, NULL),
(6, 20, 3, 0, '2023-09-13 06:01:22', '2023-09-13 06:01:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Super admin', 'web', '2023-08-29 19:10:56', '2023-08-29 19:10:56', NULL),
(2, 'Cashier', 'web', '2023-08-29 19:10:56', '2023-08-29 19:16:51', NULL),
(3, 'Admin', 'web', '2023-08-29 19:10:56', '2023-09-18 17:53:44', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 3),
(3, 1),
(3, 3),
(4, 1),
(4, 3),
(5, 1),
(5, 3),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 1),
(11, 3),
(12, 1),
(12, 3),
(13, 1),
(13, 3),
(14, 1),
(14, 3),
(15, 1),
(15, 3),
(16, 1),
(16, 3),
(17, 1),
(17, 3),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(20, 1),
(20, 3),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
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
(36, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shift_management`
--

CREATE TABLE `shift_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `seq` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `begin` varchar(255) NOT NULL,
  `estimated_end` varchar(255) DEFAULT NULL,
  `end` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'IN_PROGRESS' COMMENT 'IN PROGRESS / FINISH',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `shift_management`
--

INSERT INTO `shift_management` (`id`, `date`, `seq`, `employee_id`, `start_time`, `end_time`, `begin`, `estimated_end`, `end`, `status`, `created_at`, `updated_at`) VALUES
(1, '2023-09-11', '1', '01220023', '14:16:06', '16:50:59', '500000', '711650', '711650', 'FINISH', '2023-09-11 07:16:06', '2023-09-11 07:16:06'),
(3, '2023-09-12', '1', '01220023', '10:27:48', '17:48:59', '500000', '1092185', '1092185', 'FINISH', '2023-09-12 03:27:48', '2023-09-12 03:27:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_code`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'SPR0001', 'PT SEJAHTERA JAYA', '0813123154123', 'sejahterajaya@sjj.co.id', 'Jamsostek Lt 15', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_receive`
--

CREATE TABLE `tr_receive` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receive_code` varchar(255) NOT NULL,
  `receive_date` date NOT NULL,
  `receive_time` varchar(50) NOT NULL DEFAULT '14:00:00',
  `delivery_no` varchar(255) NOT NULL,
  `delivery_file` text DEFAULT NULL,
  `supplier_code` varchar(100) DEFAULT NULL,
  `plate_no` varchar(255) DEFAULT NULL,
  `driver` varchar(255) DEFAULT NULL,
  `driver_phone` varchar(255) DEFAULT NULL,
  `is_warehouse` int(11) DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tr_receive`
--

INSERT INTO `tr_receive` (`id`, `receive_code`, `receive_date`, `receive_time`, `delivery_no`, `delivery_file`, `supplier_code`, `plate_no`, `driver`, `driver_phone`, `is_warehouse`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'RCV20230828024144', '2023-08-22', '14:00:00', 'DEL0135433065', NULL, NULL, 'F 14045 FFA', 'Ichsan', '083807164451', 0, 1, NULL, NULL, '2023-08-27 19:41:45', '2023-08-27 19:41:45'),
(2, 'RCV20230828024242', '2023-08-22', '14:00:00', 'DEL12312314145', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, '2023-08-27 19:42:42', '2023-08-27 19:42:42'),
(3, 'RCV20230828025018', '2023-08-28', '14:00:00', 'DELFRQ12315123', NULL, NULL, 'F 14045 FAF', 'Firqy', '0812312123123', 0, 1, NULL, NULL, '2023-08-27 19:50:18', '2023-08-27 19:50:18'),
(4, 'RCV20230828025113', '2023-08-28', '14:00:00', 'DELWRH0123456', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, '2023-08-27 19:51:13', '2023-08-27 19:51:13'),
(5, 'RCV20230828063248', '2023-08-28', '14:00:00', '1231123123123132', NULL, NULL, 'B F!', 'Firqy', '08123124123123', 0, 1, NULL, NULL, '2023-08-27 23:32:49', '2023-08-27 23:32:49'),
(6, 'RCV20230829093950', '2023-08-29', '14:00:00', 'DELWRH12345655', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-08-29 02:39:50', '2023-08-29 02:39:50'),
(7, 'RCV20230912085213', '2023-09-12', '14:00:00', '011201', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-09-12 01:52:13', '2023-09-12 01:52:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_receive_detail`
--

CREATE TABLE `tr_receive_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receive_code` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tr_receive_detail`
--

INSERT INTO `tr_receive_detail` (`id`, `receive_code`, `product_code`, `quantity`, `unit_price`, `amount`) VALUES
(1, 'RCV20230828024144', '8601057', 10, NULL, NULL),
(2, 'RCV20230828024144', '8601056', 40, NULL, NULL),
(3, 'RCV20230828024144', '8601055', 150, NULL, NULL),
(4, 'RCV20230828024144', '8601054', 25, NULL, NULL),
(5, 'RCV20230828024242', '8996001326398', 40, NULL, NULL),
(6, 'RCV20230828024242', '8998685057308', 190, NULL, NULL),
(7, 'RCV20230828025018', '8601057', 100, NULL, NULL),
(8, 'RCV20230828025113', '8601056', 150, NULL, NULL),
(9, 'RCV20230828025113', '8601054', 120, NULL, NULL),
(10, 'RCV20230828063248', '8996001326398', 8, NULL, NULL),
(11, 'RCV20230828063248', '8998685057308', 5, NULL, NULL),
(12, 'RCV20230829093950', '8601057', 2, NULL, NULL),
(13, 'RCV20230829093950', '8998685057308', 6, NULL, NULL),
(14, 'RCV20230829093950', '8996001326398', 133, NULL, NULL),
(15, 'RCV20230912085213', '8995201800028', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_transaction`
--

CREATE TABLE `tr_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `membership_id` bigint(20) DEFAULT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `emp_no` varchar(255) NOT NULL,
  `trans_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL COMMENT 'CASH, EDC - BCA, EDC - QRIS',
  `cash` varchar(255) DEFAULT NULL,
  `sub_price` varchar(255) NOT NULL DEFAULT '',
  `vat_ppn` int(11) NOT NULL,
  `total_price` varchar(50) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL COMMENT 'DRAFT, FINISH, CANCEL',
  `cancellation_reason` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kembalian` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tr_transaction`
--

INSERT INTO `tr_transaction` (`id`, `membership_id`, `invoice_no`, `receipt_no`, `emp_no`, `trans_date`, `payment_method`, `cash`, `sub_price`, `vat_ppn`, `total_price`, `status`, `cancellation_reason`, `deleted_at`, `created_at`, `updated_at`, `kembalian`) VALUES
(1, NULL, 'INV1012200231693190579', '51044120', '01220023', '2023-08-22', 'Tunai', '150000', '24500', 11, '6027000', 'FINISH', NULL, NULL, '2023-08-27 19:43:39', '2023-08-27 19:43:39', NULL),
(2, NULL, 'INV1012200231693190630', '69964968', '01220023', '2023-08-22', 'Tunai', '500000', '30000', 11, '9030000', 'FINISH', NULL, NULL, '2023-08-27 19:44:24', '2023-08-27 19:44:24', NULL),
(3, NULL, 'INV1012200231693190683', 'RCTQRB13350664', '01220023', '2023-08-22', 'EDC - QRIS', '', '19500', 11, '3822000', 'FINISH', NULL, NULL, '2023-08-27 19:45:22', '2023-08-27 19:45:22', NULL),
(4, NULL, 'INV1012200231693191096', '47934737', '01220023', '2023-08-28', 'Tunai', '85000', '15000', 11, '2265000', 'FINISH', NULL, NULL, '2023-08-27 19:51:50', '2023-08-27 19:51:50', NULL),
(5, NULL, 'INV1012200231693191115', '92426502', '01220023', '2023-08-28', 'Tunai', '105000', '14000', 11, '1974000', 'FINISH', NULL, NULL, '2023-08-27 19:52:21', '2023-08-27 19:52:21', NULL),
(6, NULL, 'INV1012200231693203165', '69960139', '01220023', '2023-08-28', 'Tunai', '200000', '19500', 11, '3822000', 'FINISH', NULL, NULL, '2023-08-27 23:18:11', '2023-08-27 23:18:11', NULL),
(7, NULL, 'INV1012200231693282703', '64762637', '01220023', '2023-08-29', 'Tunai', '40000', '34000', 11, '37740', 'FINISH', NULL, NULL, '2023-08-28 21:21:01', '2023-08-29 00:30:51', NULL),
(8, NULL, 'INV1012200231693295941', '54483750', '01220023', '2023-08-29', 'Tunai', '0', '15000', 11, '16650', 'DRAFT', NULL, NULL, '2023-08-29 00:59:51', '2023-08-29 00:59:51', NULL),
(9, NULL, 'INV1012200231693875153', '66344559', '01220023', '2023-09-05', 'Tunai', '20000', '4500', 11, '4995', 'FINISH', NULL, NULL, '2023-09-05 00:53:00', '2023-09-05 00:53:00', NULL),
(10, NULL, 'INV1012200231693875340', '18063289', '01220023', '2023-09-05', 'Tunai', '35000', '15000', 11, '16650', 'FINISH', NULL, NULL, '2023-09-05 00:56:15', '2023-09-05 00:56:15', NULL),
(11, NULL, 'INV1012200231693875592', '73233248', '01220023', '2023-09-05', 'Tunai', '17000', '15000', 11, '16650', 'FINISH', NULL, NULL, '2023-09-05 01:00:11', '2023-09-05 01:00:11', NULL),
(12, NULL, 'INV1012200231693876008', '96333148', '01220023', '2023-09-05', 'Tunai', '20000', '15000', 11, '16650', 'FINISH', NULL, NULL, '2023-09-05 01:07:02', '2023-09-05 01:07:02', NULL),
(13, NULL, 'INV6012200251693887687', '28512351', '01220025', '2023-09-05', 'Tunai', '20000', '15500', 11, '17205', 'FINISH', NULL, NULL, '2023-09-05 04:23:27', '2023-09-05 04:23:27', NULL),
(14, NULL, 'INV6012200251693887811', '81047007', '01220025', '2023-09-05', 'Tunai', '22205', '15500', 11, '17205', 'FINISH', NULL, NULL, '2023-09-05 04:24:55', '2023-09-05 04:28:18', NULL),
(15, NULL, 'INV6012200251693887898', '92256043', '01220025', '2023-09-05', 'Tunai', '50000', '15000', 11, '16650', 'FINISH', NULL, NULL, '2023-09-05 04:25:53', '2023-09-05 04:25:53', NULL),
(16, NULL, 'INV1012200231693889043', '91081433', '01220023', '2023-09-05', 'Tunai', '22000', '9500', 11, '10545', 'FINISH', NULL, NULL, '2023-09-05 04:44:51', '2023-09-05 04:44:51', NULL),
(17, NULL, 'INV1012200231694145932', '29959220', '01220023', '2023-09-08', 'Tunai', '10000', '15000', 0, '15000', 'DRAFT', NULL, NULL, '2023-09-08 04:09:53', '2023-09-08 04:09:53', '0'),
(22, 1, 'INV6012200251694419982', '44607558', '01220025', '2023-09-11', 'Tunai', '35000', '34000', 0, '34000', 'FINISH', NULL, NULL, '2023-09-11 08:14:51', '2023-09-11 08:14:51', '1000'),
(23, 0, 'INV6012200251694420136', '61978622', '01220025', '2023-09-11', 'Tunai', '65000', '54500', 0, '54500', 'FINISH', NULL, NULL, '2023-09-11 08:16:25', '2023-09-11 08:16:25', '10500'),
(24, 0, 'INV1012200231694420421', '37191366', '01220023', '2023-09-11', 'Tunai', '50000', '36150', 0, '36150', 'FINISH', NULL, NULL, '2023-09-11 08:21:59', '2023-09-11 08:21:59', '13850'),
(25, 0, 'INV6012200251694421683', '28106951', '01220025', '2023-09-11', 'Tunai', '20000', '19000', 0, '19000', 'FINISH', NULL, NULL, '2023-09-11 08:41:50', '2023-09-11 08:41:50', '1000'),
(26, 0, 'INV6012200251694421806', '42774096', '01220025', '2023-09-11', 'Tunai', '50000', '24500', 0, '24500', 'FINISH', NULL, NULL, '2023-09-11 08:44:12', '2023-09-11 08:44:12', '25500'),
(27, 0, 'INV6012200251694422863', '97865195', '01220025', '2023-09-11', 'Tunai', '50.000', '9500', 0, '9500', 'FINISH', NULL, NULL, '2023-09-11 09:01:24', '2023-09-11 09:01:24', '31.000'),
(28, 0, 'INV6012200251694423175', '16233701', '01220025', '2023-09-11', 'Tunai', '60.000', '24500', 0, '24500', 'DRAFT', NULL, NULL, '2023-09-11 09:07:37', '2023-09-11 09:07:37', '11.000'),
(29, 0, 'INV6012200251694423807', '84599471', '01220025', '2023-09-11', 'Tunai', '50.000', '9500', 0, '9500', 'DRAFT', NULL, NULL, '2023-09-11 09:17:12', '2023-09-11 09:17:12', '31.000'),
(30, 1, 'INV6012200251694484190', '39363517', '01220025', '2023-09-12', 'Tunai', '100.000', '44250', 0, '44250', 'FINISH', NULL, NULL, '2023-09-12 02:08:01', '2023-09-12 02:08:01', '250'),
(31, 0, 'INV6012200251694488003', '72053003', '01220025', '2023-09-12', 'Tunai', '80.000', '20500', 0, '20500', 'FINISH', NULL, NULL, '2023-09-12 03:10:12', '2023-09-12 03:10:12', '500'),
(32, 0, 'INV6012200251694488336', '86471224', '01220025', '2023-09-12', 'Tunai', NULL, '27650', 0, '27650', 'DRAFT', NULL, NULL, '2023-09-12 03:19:16', '2023-09-12 03:19:16', NULL),
(33, 0, 'INV1superadmin1695010175', '38290344', 'superadmin', '2023-09-18', 'Tunai', '40000', '38500', 0, '38500', 'FINISH', NULL, NULL, '2023-09-18 18:10:20', '2023-09-18 18:10:20', '1500'),
(34, 0, 'INV1superadmin1695010774', '73973831', 'superadmin', '2023-09-18', 'Tunai', '40000', '38500', 0, '38500', 'FINISH', NULL, NULL, '2023-09-18 18:20:16', '2023-09-18 18:20:16', '1500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_transaction_detail`
--

CREATE TABLE `tr_transaction_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basic_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tr_transaction_detail`
--

INSERT INTO `tr_transaction_detail` (`id`, `invoice_no`, `product_code`, `quantity`, `basic_price`, `discount`, `price`) VALUES
(1, 'INV1012200231693190579', '8601057', 5, 10000, 5, 9500),
(2, 'INV1012200231693190579', '8601054', 5, 15000, 0, 15000),
(3, 'INV1012200231693190630', '8601056', 20, 15000, 0, 15000),
(4, 'INV1012200231693190630', '8601055', 10, 15000, 0, 15000),
(5, 'INV1012200231693190683', '8996001326398', 5, 15000, 0, 15000),
(6, 'INV1012200231693190683', '8998685057308', 10, 4500, 0, 4500),
(7, 'INV1012200231693191096', '8996001326398', 5, 15000, 0, 15000),
(8, 'INV1012200231693191115', '8601057', 5, 10000, 5, 9500),
(9, 'INV1012200231693191115', '8998685057308', 10, 4500, 0, 4500),
(10, 'INV1012200231693203165', '8996001326398', 10, 15000, 0, 15000),
(11, 'INV1012200231693203165', '8998685057308', 1, 4500, 0, 4500),
(13, 'INV1012200231693282703', '8996001326398', 1, 15000, 0, 15000),
(14, 'INV1012200231693282703', '8601057', 2, 10000, 5, 9500),
(15, 'INV1012200231693295941', '8996001326398', 1, 15000, 0, 15000),
(16, 'INV1012200231693875153', '8998685057308', 4, 4500, 0, 4500),
(17, 'INV1012200231693875340', '8996001326398', 2, 15000, 0, 15000),
(18, 'INV1012200231693875592', '8601055', 1, 15000, 0, 15000),
(19, 'INV1012200231693876008', '8601056', 1, 15000, 0, 15000),
(20, 'INV6012200251693887687', '8998685057308', 1, 4500, 0, 4500),
(21, 'INV6012200251693887687', '8993190912463', 1, 4000, 0, 4000),
(22, 'INV6012200251693887687', '8998009010231', 1, 7000, 0, 7000),
(25, 'INV6012200251693887898', '8996001326398', 2, 15000, 0, 15000),
(26, 'INV6012200251693887811', '8998009010231', 1, 7000, 0, 7000),
(27, 'INV6012200251693887811', '8993190912463', 1, 4000, 0, 4000),
(28, 'INV6012200251693887811', '8998685057308', 1, 4500, 0, 4500),
(29, 'INV1012200231693889043', '8601057', 2, 10000, 5, 9500),
(30, 'INV1012200231694145932', '8601054', 1, 15000, 0, 15000),
(31, 'INV6012200251694419982', '8601057', 1, 10000, 5, 9500),
(32, 'INV6012200251694419982', '8601057', 1, 10000, 5, 9500),
(33, 'INV6012200251694419982', '8601056', 1, 15000, 0, 15000),
(34, 'INV6012200251694420136', '8601057', 2, 10000, 5, 9500),
(35, 'INV6012200251694420136', '8601054', 1, 15000, 0, 15000),
(36, 'INV6012200251694420136', '8601055', 1, 15000, 0, 15000),
(37, 'INV6012200251694420136', '8601056', 1, 15000, 0, 15000),
(38, 'INV1012200231694420421', '8601054', 1, 15000, 0, 15000),
(39, 'INV1012200231694420421', '8996001326398', 1, 16650, 0, 16650),
(40, 'INV1012200231694420421', '8998685057308', 2, 4500, 0, 4500),
(41, 'INV6012200251694421683', '8601057', 1, 10000, 5, 9500),
(42, 'INV6012200251694421683', '8601057', 1, 10000, 5, 9500),
(43, 'INV6012200251694421806', '8601057', 2, 10000, 5, 9500),
(44, 'INV6012200251694421806', '8601054', 1, 15000, 0, 15000),
(45, 'INV6012200251694422863', '8601057', 2, 10000, 5, 9500),
(46, 'INV6012200251694423175', '8601057', 2, 10000, 5, 9500),
(47, 'INV6012200251694423175', '8601056', 2, 15000, 0, 15000),
(48, 'INV6012200251694423807', '8601057', 2, 10000, 5, 9500),
(49, 'INV6012200251694484190', '8995201800028', 3, 27750, 0, 27750),
(50, 'INV6012200251694484190', '8601057', 1, 10000, 5, 9500),
(51, 'INV6012200251694484190', '8998009010231', 1, 7000, 0, 7000),
(52, 'INV6012200251694488003', '8993190912463', 1, 4000, 0, 4000),
(53, 'INV6012200251694488003', '8998009010231', 4, 7000, 0, 7000),
(54, 'INV6012200251694488003', '8601057', 5, 10000, 5, 9500),
(55, 'INV6012200251694488336', '8996001326398', 2, 16650, 0, 16650),
(56, 'INV6012200251694488336', '8993190912463', 1, 4000, 0, 4000),
(57, 'INV6012200251694488336', '8998009010231', 1, 7000, 0, 7000),
(58, 'INV1superadmin1695010175', '8993190912463', 1, 4000, 0, 4000),
(59, 'INV1superadmin1695010175', '8601054', 1, 25000, 0, 25000),
(60, 'INV1superadmin1695010175', '8601057', 1, 10000, 5, 9500),
(61, 'INV1superadmin1695010774', '8993190912463', 1, 4000, 0, 4000),
(62, 'INV1superadmin1695010774', '8601054', 1, 25000, 0, 25000),
(63, 'INV1superadmin1695010774', '8601057', 1, 10000, 5, 9500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_transaction_detail_log`
--

CREATE TABLE `tr_transaction_detail_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basic_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_transaction_log`
--

CREATE TABLE `tr_transaction_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `del_by` varchar(255) NOT NULL,
  `del_at` varchar(255) NOT NULL,
  `del_emp_appr` int(11) DEFAULT NULL,
  `del_reason` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `emp_no` varchar(255) NOT NULL,
  `trans_date` date NOT NULL DEFAULT '0000-00-00',
  `payment_method` varchar(255) NOT NULL DEFAULT '0',
  `cash` varchar(255) DEFAULT '0',
  `kembalian` varchar(255) DEFAULT '0',
  `sub_price` varchar(255) NOT NULL DEFAULT '0',
  `vat_ppn` int(11) NOT NULL DEFAULT 0,
  `total_price` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `cancelation_reason` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pin` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `employee_id`, `name`, `email`, `pin`, `email_verified_at`, `phone_number`, `office`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Master Admin IT', 'admin.it@cj.co.id', '14045', '2023-01-10 18:55:51', '08123456789', 'Jakarta', '$2y$10$Ra9HfC9VbIYR871aiH4lvOzo8CmXGIo3tXdytak4vdJr0g7D45EmO', '819675.png', 1, 'x6rbhqNnTDenDUGkXNkO73FHhtURbsqeL2tPDj8aYy43wbi8lDY9lnPciXI7', '2023-01-10 18:55:51', '2023-02-05 20:47:47'),
(6, 'cashier', 'John Doe', 'cashier@cj.co.id', '12345', '2023-08-09 21:20:40', '08123456789', 'Jakarta', '$2y$10$IUSxSPbvti6OF9zkcDshW.W9uxOfdXVufRGATF8vRan6oqT9Ci9F2', '819675.png', 1, 'vq59UQ5YyRM2nkX47PJmkX9VYokAiMAitZ7rAUXX1DBj9JcJX1zlgJlu3Tl2', '2023-08-09 21:20:40', '2023-08-29 01:21:33'),
(7, 'ms001', 'Expatriate', 'expatriate@cj.co.id', NULL, NULL, '012345678910', '0', '$2y$10$K9WnRObXIVG6gkhkcn9JKuGwV55nXqbZPcyaKFnnuJF1qTAJsqJ4C', '', 1, NULL, '2023-09-18 17:56:02', '2023-09-18 17:56:02'),
(8, 'ms002', 'Admin Toko', 'admin@cj.co.id', NULL, NULL, '0812345678910', '0', '$2y$10$IUSxSPbvti6OF9zkcDshW.W9uxOfdXVufRGATF8vRan6oqT9Ci9F2', '', 1, NULL, '2023-09-18 17:56:56', '2023-09-18 17:56:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cash_flow`
--
ALTER TABLE `cash_flow`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cl_date`
--
ALTER TABLE `cl_date`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `memberships_code_unique` (`code`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`) USING HASH;

--
-- Indeks untuk tabel `products_price_log`
--
ALTER TABLE `products_price_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_product_id_foreign` (`product_id`),
  ADD KEY `product_category_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `shift_management`
--
ALTER TABLE `shift_management`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tr_receive`
--
ALTER TABLE `tr_receive`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_receive_receive_code_unique` (`receive_code`);

--
-- Indeks untuk tabel `tr_receive_detail`
--
ALTER TABLE `tr_receive_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tr_transaction`
--
ALTER TABLE `tr_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_transaction_invoice_no_unique` (`invoice_no`),
  ADD UNIQUE KEY `tr_transaction_receipt_no_unique` (`receipt_no`);

--
-- Indeks untuk tabel `tr_transaction_detail`
--
ALTER TABLE `tr_transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tr_transaction_detail_log`
--
ALTER TABLE `tr_transaction_detail_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tr_transaction_log`
--
ALTER TABLE `tr_transaction_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cash_flow`
--
ALTER TABLE `cash_flow`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `cl_date`
--
ALTER TABLE `cl_date`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products_price_log`
--
ALTER TABLE `products_price_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `shift_management`
--
ALTER TABLE `shift_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tr_receive`
--
ALTER TABLE `tr_receive`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tr_receive_detail`
--
ALTER TABLE `tr_receive_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tr_transaction`
--
ALTER TABLE `tr_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tr_transaction_detail`
--
ALTER TABLE `tr_transaction_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `tr_transaction_detail_log`
--
ALTER TABLE `tr_transaction_detail_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tr_transaction_log`
--
ALTER TABLE `tr_transaction_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
