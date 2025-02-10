-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 12:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_bakus`
--

CREATE TABLE `bahan_bakus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimal_stok` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_bakus`
--

INSERT INTO `bahan_bakus` (`id`, `nama`, `stok`, `harga`, `satuan`, `status`, `minimal_stok`, `created_at`, `updated_at`) VALUES
(1, 'kopi latte', 10, 49000, 'Kg', '1', 3, '2024-01-04 02:30:38', '2024-01-24 09:12:41'),
(2, 'susu', 8, 20000, 'Pcs', '1', 1, '2024-01-04 03:50:35', '2024-01-24 09:12:21'),
(3, 'kopi bubuk', 10, 50000, 'Pcs', '1', 1, '2024-01-19 16:06:49', '2024-01-24 09:12:31'),
(4, 'kentang', 50, 2000, 'Kg', '1', 10, '2024-01-24 09:08:16', '2024-01-24 09:08:16'),
(5, 'kopi moca', 100, 65000, 'Pcs', '1', 10, '2024-01-24 09:08:38', '2024-01-24 09:12:54'),
(6, 'gula halus', 50, 8000, 'Kg', '1', 5, '2024-01-24 09:09:09', '2024-01-24 09:09:09'),
(7, 'tepung kue', 50, 10000, 'Kg', '1', 5, '2024-01-24 09:09:55', '2024-01-24 09:09:55'),
(8, 'coklat cair', 100, 20000, 'Kg', '1', 10, '2024-01-24 09:10:31', '2024-01-24 09:10:31'),
(9, 'saos pedas', 30, 25000, 'Pcs', '1', 3, '2024-01-24 09:11:16', '2024-01-24 09:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku_keluars`
--

CREATE TABLE `bahan_baku_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bahanbaku_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_baku_keluars`
--

INSERT INTO `bahan_baku_keluars` (`id`, `bahanbaku_id`, `jumlah`, `tanggal`, `created_at`, `updated_at`) VALUES
(4, 1, 5, '2024-01-22', '2024-01-22 05:00:43', '2024-01-22 05:00:43');

--
-- Triggers `bahan_baku_keluars`
--
DELIMITER $$
CREATE TRIGGER `delete_old_stok_bahanbakeluar` AFTER DELETE ON `bahan_baku_keluars` FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET stok = stok + OLD.jumlah
        WHERE
        id = OLD.bahanbaku_id;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_bahanbakukeluar` AFTER INSERT ON `bahan_baku_keluars` FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET stok = stok - NEW.jumlah
        WHERE
        id = NEW.bahanbaku_id;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku_masuks`
--

CREATE TABLE `bahan_baku_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bahanbaku_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_baku_masuks`
--

INSERT INTO `bahan_baku_masuks` (`id`, `bahanbaku_id`, `jumlah`, `tanggal`, `created_at`, `updated_at`) VALUES
(2, 1, 10, '2024-01-22', '2024-01-22 05:02:38', '2024-01-22 05:02:38');

--
-- Triggers `bahan_baku_masuks`
--
DELIMITER $$
CREATE TRIGGER `delete_old_stok_bahanbakumasuk` AFTER DELETE ON `bahan_baku_masuks` FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET stok = stok - OLD.jumlah
        WHERE
        id = OLD.bahanbaku_id;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_bahanbakumasuk` AFTER INSERT ON `bahan_baku_masuks` FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET stok = stok + NEW.jumlah
        WHERE
        id = NEW.bahanbaku_id;
        END
$$
DELIMITER ;

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
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `bahanbaku_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `porsi` int(50) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `menu_id`, `bahanbaku_id`, `jumlah`, `porsi`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 13, 1, 2, NULL, NULL, '2024-01-19 04:39:25', '2024-01-19 04:39:25'),
(2, 12, 2, 1, 30, 'Kopi asik membutuhkan 1kg kopi latte dan 10 pcs susu untuk membuat 50 cups', '2024-01-19 07:22:18', '2024-01-19 07:22:18'),
(3, 3, 2, 1, 50, 'untuk membuat kopiu testi dibutuhkan kopi latte 1kg dan susu 5pcs', '2024-01-19 07:23:26', '2024-01-19 07:23:26'),
(4, 4, 1, 2, 100, 'untuk membuat kopiu 2 dibutuhkan kopi latte 1kg dan susu 5pcs', '2024-01-19 07:27:39', '2024-01-19 07:27:39'),
(5, 4, 2, 10, 100, 'untuk membuat kopiu 2 dibutuhkan kopi latte 1kg dan susu 5pcs', '2024-01-19 07:27:39', '2024-01-19 07:27:39'),
(6, 11, 2, 10, 50, 'untuk membuat kopi nyuss  testi dibutuhkan kopi latte 1kg dan susu 10 pcs', '2024-01-19 16:10:44', '2024-01-19 16:10:44'),
(7, 11, 3, 1, 50, 'untuk membuat kopi nyuss  testi dibutuhkan kopi latte 1kg dan susu 10 pcs', '2024-01-19 16:10:44', '2024-01-19 16:10:44'),
(8, 15, 4, 10, 50, '10 kg kentang dan 10 saos pedas cukup untuk 50 porsi kentang krispi', '2024-01-24 09:53:57', '2024-01-24 09:53:57'),
(9, 15, 9, 10, 50, '10 kg kentang dan 10 saos pedas cukup untuk 50 porsi kentang krispi', '2024-01-24 09:53:57', '2024-01-24 09:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'makanan', '1', '2024-01-03 08:57:18', '2024-01-03 08:57:18'),
(2, 'minuman', '0', '2024-01-03 08:58:39', '2024-01-03 09:35:21'),
(3, 'dessert', '1', '2024-01-03 08:58:46', '2024-01-03 08:58:46'),
(4, 'snack', '1', '2024-01-03 08:58:55', '2024-01-03 08:58:55'),
(5, 'pudding', '1', '2024-01-03 08:59:03', '2024-01-03 08:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kursi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id`, `nama`, `kursi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MEJA001', '5', '1', '2024-01-03 10:11:17', '2024-01-03 10:14:27'),
(2, 'MEJA001_RF', '4', '0', '2024-01-03 10:11:43', '2024-01-03 10:11:43'),
(3, 'MEJA002', '2', '1', '2024-01-09 07:58:29', '2024-01-09 07:58:29'),
(4, 'MEJA003', '4', '0', '2024-01-09 07:58:43', '2024-01-09 07:58:43'),
(5, 'MEJA002_RF', '2', '1', '2024-01-09 07:59:01', '2024-01-09 07:59:01'),
(6, 'MEJA001_DPN', '2', '0', '2024-01-09 07:59:25', '2024-01-09 07:59:25'),
(7, 'MEJA005', '2', '0', '2024-01-15 04:40:17', '2024-01-15 04:40:17'),
(8, 'MEJA002_DPN', '4', '1', '2024-01-19 16:04:56', '2024-01-19 16:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `foto`, `kategori_id`, `harga`, `stok`, `status`, `created_at`, `updated_at`) VALUES
(3, 'kopi testi', 'menu/1704297187-kopi3.jpg', 2, 9000, 8, '1', '2024-01-03 15:46:29', '2024-01-03 15:53:07'),
(4, 'kopi 2', 'menu/1704296951-kopi1.png', 1, 23000, 49, '1', '2024-01-03 15:49:11', '2024-01-04 10:21:11'),
(5, 'kopi 3', 'menu/1704363629-mocano.jpg', 2, 16000, 20, '1', '2024-01-04 10:20:29', '2024-01-04 10:20:29'),
(6, 'kopi 4', 'menu/1704363662-kapucion.jpg', 2, 32000, 29, '0', '2024-01-04 10:21:02', '2024-01-22 15:20:00'),
(7, 'cake 1', 'menu/1704363701-cake2.jpg', 3, 35000, 17, '1', '2024-01-04 10:21:41', '2024-01-04 10:21:41'),
(8, 'cake 2', 'menu/1704363725-deset.jpg', 3, 40000, 21, '1', '2024-01-04 10:22:05', '2024-01-04 10:22:05'),
(9, 'cake 3', 'menu/1704363776-cake.jpg', 3, 45000, 9, '1', '2024-01-04 10:22:56', '2024-01-04 10:22:56'),
(10, 'Milk 1', 'menu/1704363812-milk.jpg', 2, 20000, 28, '1', '2024-01-04 10:23:32', '2024-01-04 10:23:32'),
(11, 'kopi nyuss', 'menu/1704363852-kopi1.png', 2, 25000, 10, '1', '2024-01-04 10:24:12', '2024-01-04 10:24:12'),
(12, 'kopi asik', 'menu/1704363881-kapucion.jpg', 2, 18000, 17, '1', '2024-01-04 10:24:41', '2024-01-04 10:24:41'),
(13, 'kopi goodbye', 'menu/1704363910-kapucion.jpg', 2, 30000, 17, '1', '2024-01-04 10:25:10', '2024-01-04 10:25:10'),
(14, 'kopi gurih', 'menu/1704364898-kopi3.jpg', 2, 30000, 16, '1', '2024-01-04 10:41:38', '2024-01-25 13:53:04'),
(15, 'kentang krispi', 'menu/1704366379-kentang.jfif', 4, 15000, 35, '0', '2024-01-04 11:06:19', '2024-01-19 16:07:50');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_03_20_164033_create_bahan_bakus_table', 1),
(5, '2022_03_25_071600_create_permission_tables', 1);

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
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meja_id` bigint(20) UNSIGNED DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `no_order`, `meja_id`, `catatan`, `total`, `waktu`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Order/202401/1', NULL, NULL, 225000, '2024-01-10 16:51:46', 'paid', '2024-01-10 09:51:55', '2024-01-12 17:19:10'),
(6, 'Order/202401/6', 2, NULL, 145000, '2024-01-12 21:33:27', 'unpaid', '2024-01-12 14:34:59', '2024-01-12 14:34:59'),
(7, 'Order/202401/7', NULL, 'jangan pedes', 120000, '2024-01-13 00:43:14', 'unpaid', '2024-01-12 17:44:29', '2024-01-12 17:44:29'),
(8, 'Order/202401/8', NULL, 'jangan pedes', 245000, '2024-01-13 00:51:59', 'unpaid', '2024-01-12 17:53:57', '2024-01-12 17:53:57'),
(9, 'Order/202401/9', NULL, NULL, 15000, '2024-01-15 11:53:53', 'paid', '2024-01-15 04:54:19', '2024-01-15 04:54:38'),
(10, 'Order/202401/10', 2, NULL, 45000, '2024-01-15 18:57:25', 'paid', '2024-01-15 11:57:44', '2024-01-15 11:57:55'),
(11, 'Order/202401/11', NULL, NULL, 75000, '2024-01-16 17:09:35', 'paid', '2024-01-16 10:09:42', '2024-01-19 01:41:44'),
(12, 'Order/202401/12', NULL, NULL, 45000, '2024-01-17 13:29:02', 'paid', '2024-01-17 06:29:24', '2024-01-19 01:38:37'),
(13, 'Order/202401/13', NULL, NULL, 105000, '2024-01-19 23:11:44', 'paid', '2024-01-19 16:13:58', '2024-01-19 16:19:01'),
(14, 'Order/202401/14', 2, 'kentang yang garis,', 210000, '2024-01-22 13:37:56', 'unpaid', '2024-01-22 06:38:18', '2024-01-22 06:38:18'),
(15, 'Order/202401/15', NULL, NULL, 185000, '2024-01-22 13:56:12', 'paid', '2024-01-22 06:56:33', '2024-01-22 07:01:33'),
(16, 'Order/202401/16', NULL, NULL, 120000, '2024-01-22 18:00:57', 'unpaid', '2024-01-22 11:01:17', '2024-01-22 11:01:17'),
(18, 'Order/202401/17', NULL, NULL, 120000, '2024-01-22 18:01:47', 'unpaid', '2024-01-22 11:01:57', '2024-01-22 11:01:57'),
(20, 'Order/202401/19', NULL, NULL, 98000, '2024-01-22 18:02:24', 'unpaid', '2024-01-22 11:02:30', '2024-01-22 11:02:30'),
(22, 'Order/202401/21', NULL, NULL, 45000, '2024-01-22 18:02:59', 'paid', '2024-01-22 11:03:05', '2024-01-22 14:11:54'),
(23, 'Order/202401/23', 2, NULL, 125000, '2024-01-22 21:15:26', 'paid', '2024-01-22 14:16:36', '2024-01-24 08:05:50'),
(24, 'Order/202401/24', NULL, NULL, 15000, '2024-01-22 21:40:49', 'paid', '2024-01-22 14:41:02', '2024-01-22 14:41:08'),
(26, 'Order/202401/25', NULL, NULL, 88000, '2024-01-23 11:07:07', 'paid', '2024-01-23 04:07:13', '2024-01-23 04:07:30'),
(27, 'Order/202401/27', NULL, NULL, 188000, '2024-01-24 17:10:37', 'paid', '2024-01-24 10:11:14', '2024-01-24 10:11:31'),
(28, 'Order/202401/28', 4, NULL, 48000, '2024-01-25 20:25:12', 'paid', '2024-01-25 13:30:19', '2024-01-25 13:40:37'),
(29, 'Order/202405/29', NULL, NULL, 78000, '2024-05-07 13:23:30', 'paid', '2024-05-07 06:24:25', '2024-05-07 06:25:21'),
(30, 'Order/202405/30', NULL, NULL, 60000, '2024-05-08 19:11:31', 'paid', '2024-05-08 12:11:38', '2024-05-08 12:13:59'),
(31, 'Order/202405/31', NULL, NULL, 50000, '2024-05-08 19:16:08', 'paid', '2024-05-08 12:16:19', '2024-05-08 12:16:30'),
(32, 'Order/202405/32', 2, NULL, 144000, '2024-05-08 19:21:53', 'unpaid', '2024-05-08 12:24:02', '2024-05-08 12:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `menu_id`, `jumlah`, `total`, `created_at`, `updated_at`) VALUES
(10, 5, 14, 3, 90000, '2024-01-10 09:51:55', '2024-01-10 09:51:55'),
(11, 5, 15, 3, 45000, '2024-01-10 09:51:55', '2024-01-10 09:51:55'),
(12, 5, 13, 3, 90000, '2024-01-10 09:51:55', '2024-01-10 09:51:55'),
(13, 6, 14, 1, 30000, '2022-01-20 14:35:00', '2024-01-12 14:35:00'),
(14, 6, 15, 2, 30000, '2024-01-12 14:35:00', '2024-01-12 14:35:00'),
(15, 6, 9, 1, 45000, '2024-01-12 14:35:00', '2024-01-12 14:35:00'),
(16, 6, 8, 1, 40000, '2022-01-30 17:00:00', '2024-01-12 14:35:00'),
(17, 7, 15, 2, 30000, '2024-01-12 17:44:29', '2024-01-12 17:44:29'),
(18, 7, 14, 1, 30000, '2024-01-12 17:44:29', '2024-01-12 17:44:29'),
(19, 7, 13, 2, 60000, '2024-01-12 17:44:29', '2024-01-12 17:44:29'),
(20, 8, 13, 3, 90000, '2024-01-12 17:53:57', '2024-01-12 17:53:57'),
(21, 8, 14, 2, 60000, '2024-01-12 17:53:57', '2024-01-12 17:53:57'),
(22, 8, 15, 1, 15000, '2024-01-12 17:53:57', '2024-01-12 17:53:57'),
(23, 8, 10, 4, 80000, '2024-01-12 17:53:57', '2024-01-12 17:53:57'),
(24, 9, 15, 1, 15000, '2024-01-15 04:54:19', '2024-01-15 04:54:19'),
(25, 10, 15, 1, 15000, '2024-01-15 11:57:44', '2024-01-15 11:57:44'),
(26, 10, 14, 1, 30000, '2024-01-15 11:57:44', '2024-01-15 11:57:44'),
(27, 11, 15, 1, 15000, '2024-01-16 10:09:42', '2024-01-16 10:09:42'),
(28, 11, 14, 1, 30000, '2024-01-16 10:09:42', '2024-01-16 10:09:42'),
(29, 11, 13, 1, 30000, '2024-01-16 10:09:42', '2024-01-16 10:09:42'),
(30, 12, 15, 1, 15000, '2024-01-17 06:29:24', '2024-01-17 06:29:24'),
(31, 12, 14, 1, 30000, '2024-01-17 06:29:24', '2024-01-17 06:29:24'),
(32, 13, 14, 1, 30000, '2024-01-19 16:13:58', '2024-01-19 16:13:58'),
(33, 13, 13, 1, 30000, '2024-01-19 16:13:58', '2024-01-19 16:13:58'),
(34, 13, 9, 1, 45000, '2024-01-19 16:13:58', '2024-01-19 16:13:58'),
(35, 14, 15, 10, 150000, '2024-01-22 06:38:18', '2024-01-22 06:38:18'),
(36, 14, 14, 2, 60000, '2024-01-22 06:38:18', '2024-01-22 06:38:18'),
(37, 15, 15, 1, 15000, '2024-01-22 06:56:33', '2024-01-22 06:56:33'),
(38, 15, 14, 1, 30000, '2024-01-22 06:56:33', '2024-01-22 06:56:33'),
(39, 15, 13, 1, 30000, '2024-01-22 06:56:33', '2024-01-22 06:56:33'),
(40, 15, 12, 1, 18000, '2024-01-22 06:56:33', '2024-01-22 06:56:33'),
(41, 15, 11, 1, 25000, '2024-01-22 06:56:33', '2024-01-22 06:56:33'),
(42, 15, 6, 1, 32000, '2024-01-22 06:56:33', '2024-01-22 06:56:33'),
(43, 15, 7, 1, 35000, '2024-01-22 06:56:33', '2024-01-22 06:56:33'),
(44, 16, 15, 1, 15000, '2024-01-22 11:01:17', '2024-01-22 11:01:17'),
(45, 16, 14, 1, 30000, '2024-01-22 11:01:17', '2024-01-22 11:01:17'),
(46, 16, 13, 1, 30000, '2024-01-22 11:01:17', '2024-01-22 11:01:17'),
(47, 16, 9, 1, 45000, '2024-01-22 11:01:17', '2024-01-22 11:01:17'),
(48, 18, 15, 1, 15000, '2024-01-22 11:01:57', '2024-01-22 11:01:57'),
(49, 18, 14, 1, 30000, '2024-01-22 11:01:57', '2024-01-22 11:01:57'),
(50, 18, 8, 1, 40000, '2024-01-22 11:01:57', '2024-01-22 11:01:57'),
(51, 18, 7, 1, 35000, '2024-01-22 11:01:57', '2024-01-22 11:01:57'),
(52, 20, 14, 1, 30000, '2024-01-22 11:02:30', '2024-01-22 11:02:30'),
(53, 20, 13, 1, 30000, '2024-01-22 11:02:30', '2024-01-22 11:02:30'),
(54, 20, 10, 1, 20000, '2024-01-22 11:02:30', '2024-01-22 11:02:30'),
(55, 20, 12, 1, 18000, '2024-01-22 11:02:30', '2024-01-22 11:02:30'),
(56, 22, 14, 1, 30000, '2024-01-22 11:03:05', '2024-01-22 11:03:05'),
(57, 22, 15, 1, 15000, '2023-01-22 11:03:05', '2024-01-22 11:03:05'),
(58, 23, 9, 1, 45000, '2024-01-22 14:16:36', '2024-01-22 14:16:36'),
(59, 23, 8, 2, 80000, '2023-01-22 14:16:36', '2024-01-22 14:16:36'),
(60, 24, 15, 1, 15000, '2024-01-22 14:41:02', '2024-01-22 14:41:02'),
(62, 26, 13, 1, 30000, '2024-01-23 04:07:13', '2024-01-23 04:07:13'),
(63, 26, 8, 1, 40000, '2024-01-23 04:07:13', '2024-01-23 04:07:13'),
(64, 26, 12, 1, 18000, '2024-01-23 04:07:13', '2024-01-23 04:07:13'),
(65, 27, 13, 2, 60000, '2024-01-24 10:11:14', '2024-01-24 10:11:14'),
(66, 27, 11, 1, 25000, '2024-01-24 10:11:14', '2024-01-24 10:11:14'),
(67, 27, 7, 1, 35000, '2024-01-24 10:11:14', '2024-01-24 10:11:14'),
(68, 27, 9, 1, 45000, '2024-01-24 10:11:14', '2024-01-24 10:11:14'),
(69, 27, 4, 1, 23000, '2024-01-24 10:11:14', '2024-01-24 10:11:14'),
(70, 28, 12, 1, 18000, '2024-01-25 13:30:19', '2024-01-25 13:30:19'),
(71, 28, 13, 1, 30000, '2024-01-25 13:30:19', '2024-01-25 13:30:19'),
(72, 29, 14, 2, 60000, '2024-05-07 06:24:25', '2024-05-07 06:24:25'),
(73, 29, 12, 1, 18000, '2024-05-07 06:24:25', '2024-05-07 06:24:25'),
(74, 30, 14, 1, 30000, '2024-05-08 12:11:38', '2024-05-08 12:11:38'),
(75, 30, 13, 1, 30000, '2024-05-08 12:11:38', '2024-05-08 12:11:38'),
(76, 31, 13, 1, 30000, '2024-05-08 12:16:19', '2024-05-08 12:16:19'),
(77, 31, 10, 1, 20000, '2024-05-08 12:16:19', '2024-05-08 12:16:19'),
(78, 32, 14, 1, 30000, '2024-05-08 12:24:02', '2024-05-08 12:24:02'),
(79, 32, 12, 3, 54000, '2024-05-08 12:24:02', '2024-05-08 12:24:02'),
(80, 32, 13, 2, 60000, '2024-05-08 12:24:02', '2024-05-08 12:24:02');

--
-- Triggers `order_detail`
--
DELIMITER $$
CREATE TRIGGER `delete_stok_menu` AFTER DELETE ON `order_detail` FOR EACH ROW BEGIN
        UPDATE menu
            SET stok = stok + OLD.jumlah
        WHERE
        id = OLD.menu_id;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_menu` AFTER INSERT ON `order_detail` FOR EACH ROW BEGIN 
	UPDATE menu
    SET stok = stok - NEW.jumlah
    WHERE
    id = NEW.menu_id;
    END
$$
DELIMITER ;

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
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uang` int(100) NOT NULL,
  `kembalian` int(100) DEFAULT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `order_id`, `user_id`, `uang`, `kembalian`, `waktu_bayar`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 250000, 25000, '2024-01-13 00:15:11', 225000, 'cash', '2024-01-12 17:15:20', '2024-01-12 17:15:20'),
(2, 5, 1, 250000, 25000, '2024-01-13 00:15:11', 225000, 'cash', '2024-01-12 17:16:11', '2024-01-12 17:16:11'),
(3, 5, 1, 250000, 25000, '2024-01-13 00:16:41', 225000, 'cash', '2024-01-12 17:16:48', '2024-01-12 17:16:48'),
(4, 5, 1, 250000, 25000, '2024-01-13 00:16:41', 225000, 'cash', '2024-01-12 17:19:10', '2024-01-12 17:19:10'),
(5, 9, 1, 20000, 5000, '2024-01-15 11:54:21', 15000, 'cash', '2024-01-15 04:54:38', '2024-01-15 04:54:38'),
(6, 10, 1, 100000, 55000, '2024-01-15 18:57:44', 45000, 'cash', '2024-01-15 11:57:55', '2024-01-15 11:57:55'),
(7, 12, 1, 50000, 5000, '2024-01-19 08:38:28', 45000, 'cash', '2024-01-19 01:38:37', '2024-01-19 01:38:37'),
(8, 11, 1, 100000, 25000, '2024-01-19 08:41:02', 75000, 'cash', '2024-01-19 01:41:44', '2024-01-19 01:41:44'),
(9, 13, 1, 120000, 15000, '2024-01-19 23:18:21', 105000, 'cash', '2024-01-19 16:19:01', '2024-01-19 16:19:01'),
(10, 15, 1, 185000, NULL, '2024-01-22 14:01:28', 185000, 'transfer', '2024-01-22 07:01:33', '2024-01-22 07:01:33'),
(11, 22, 1, 45000, NULL, '2024-01-22 21:11:33', 45000, 'ewallet', '2024-01-22 14:11:54', '2024-01-22 14:11:54'),
(12, 24, 1, 15000, NULL, '2024-01-22 21:41:02', 15000, 'transfer', '2024-01-22 14:41:08', '2024-01-22 14:41:08'),
(13, 26, 1, 88000, NULL, '2024-01-23 11:07:24', 88000, 'ewallet', '2024-01-23 04:07:30', '2024-01-23 04:07:30'),
(14, 23, 1, 125000, NULL, '2024-01-24 15:05:38', 125000, 'qris', '2024-01-24 08:05:50', '2024-01-24 08:05:50'),
(15, 27, 1, 188000, NULL, '2024-01-24 17:11:14', 188000, 'transfer', '2024-01-24 10:11:31', '2024-01-24 10:11:31'),
(16, 28, 1, 48000, NULL, '2024-01-25 20:36:17', 48000, 'ewallet', '2024-01-25 13:40:37', '2024-01-25 13:40:37'),
(17, 29, 1, 78000, 22000, '2024-05-07 13:24:25', 78000, 'qris', '2024-05-07 06:25:21', '2024-05-07 06:25:21'),
(18, 30, 1, 100000, 40000, '2024-05-08 19:11:38', 60000, 'cash', '2024-05-08 12:13:59', '2024-05-08 12:13:59'),
(19, 31, 1, 100000, 50000, '2024-05-08 19:16:20', 50000, 'cash', '2024-05-08 12:16:30', '2024-05-08 12:16:30');

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

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2024-01-03 04:02:32', '2024-01-03 04:02:32'),
(2, 'Dapur', 'web', '2024-01-03 04:02:32', '2024-01-03 04:02:32'),
(3, 'Kasir', 'web', '2024-01-03 04:02:32', '2024-01-03 04:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `no_hp`, `jenis_kelamin`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '08998089724', 'Laki-laki', 'admin@gmail.com', NULL, '$2y$10$wQWxg/unbYZYsirJywcfE.IW9TRbMkNs3gikt0cEmMyajHPAfXXAe', NULL, '2024-01-03 04:02:32', '2024-01-03 04:02:32'),
(2, 'Kasir', '08223008246', 'Laki-laki', 'kasir@gmail.com', NULL, '$2y$10$luRDPXQBlqhcZ6CKUT8/UeU.2l9QvH35JYw.BDMCebq8toBne0Y4O', NULL, '2024-01-03 04:02:32', '2024-01-03 04:02:32'),
(3, 'Dapur', '08588089205', 'Laki-laki', 'dapur@gmail.com', NULL, '$2y$10$nAvsL8jC.pToha45Z90gCO6rT6q5w47y55PRHkDXXUxwWO3kLoJZS', NULL, '2024-01-03 04:02:32', '2024-01-15 09:58:27'),
(5, 'adam', '08998081899', 'Laki-laki', 'adam@gmail.com', NULL, '$2y$10$QE46tUcpk7EYWkJUXPYKLeNWDSA.6VFlg2ykNf0p2ZG2TsXkCOW.q', NULL, '2024-01-25 13:58:35', '2024-05-08 12:17:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_bakus`
--
ALTER TABLE `bahan_bakus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahan_baku_keluars`
--
ALTER TABLE `bahan_baku_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan_baku_keluars_bahanbaku_id_foreign` (`bahanbaku_id`);

--
-- Indexes for table `bahan_baku_masuks`
--
ALTER TABLE `bahan_baku_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan_baku_masuks_bahanbaku_id_foreign` (`bahanbaku_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredients_menu_id_foreign` (`menu_id`),
  ADD KEY `ingredients_bahanbaku_id_foreign` (`bahanbaku_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_kategori_id_foreign` (`kategori_id`);

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
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_no_order_unique` (`no_order`),
  ADD KEY `order_meja_id_foreign` (`meja_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_order_id_foreign` (`order_id`),
  ADD KEY `order_detail_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_order_id_foreign` (`order_id`),
  ADD KEY `pembayaran_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_bakus`
--
ALTER TABLE `bahan_bakus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bahan_baku_keluars`
--
ALTER TABLE `bahan_baku_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bahan_baku_masuks`
--
ALTER TABLE `bahan_baku_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_baku_keluars`
--
ALTER TABLE `bahan_baku_keluars`
  ADD CONSTRAINT `bahan_baku_keluars_bahanbaku_id_foreign` FOREIGN KEY (`bahanbaku_id`) REFERENCES `bahan_bakus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bahan_baku_masuks`
--
ALTER TABLE `bahan_baku_masuks`
  ADD CONSTRAINT `bahan_baku_masuks_bahanbaku_id_foreign` FOREIGN KEY (`bahanbaku_id`) REFERENCES `bahan_bakus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_bahanbaku_id_foreign` FOREIGN KEY (`bahanbaku_id`) REFERENCES `bahan_bakus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingredients_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_meja_id_foreign` FOREIGN KEY (`meja_id`) REFERENCES `meja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
