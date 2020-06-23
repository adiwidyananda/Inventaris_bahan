-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 10:05 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_ketringan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `Username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `Username`, `Password`, `created_at`, `updated_at`) VALUES
(5, 'admin', '$2y$10$oT/vpkdJRQcU5bKkhJJkAODSY.hdTmV8nQxQuKFYiC3K7NzTUexUm', '2020-06-10 22:31:35', '2020-06-10 22:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `bahans`
--

CREATE TABLE `bahans` (
  `id` int(10) UNSIGNED NOT NULL,
  `Nama_Bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Harga_Satuan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahans`
--

INSERT INTO `bahans` (`id`, `Nama_Bahan`, `Jumlah`, `Satuan`, `Harga_Satuan`, `created_at`, `updated_at`, `id_kategori`) VALUES
(1, 'Ayam', 20, 'Kilogram', 10000, '2020-06-10 23:16:16', '2020-06-10 23:16:16', 1),
(3, 'Bayam', 220, 'Gram', 200, '2020-06-10 23:28:50', '2020-06-10 23:28:50', 2),
(4, 'Telur Ayam', 5, 'Butir', 2000, '2020-06-16 22:57:43', '2020-06-16 22:57:43', 3);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_keluars`
--

CREATE TABLE `bahan_keluars` (
  `id` int(10) UNSIGNED NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Harga_Total` int(11) NOT NULL,
  `Tanggal_Keluar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_bahan` int(10) UNSIGNED NOT NULL,
  `id_makanan` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_keluars`
--

INSERT INTO `bahan_keluars` (`id`, `Jumlah`, `Harga_Total`, `Tanggal_Keluar`, `created_at`, `updated_at`, `id_bahan`, `id_makanan`) VALUES
(4, 2, 20000, '2020-06-14', '2020-06-14 07:22:36', '2020-06-14 07:22:36', 1, 5),
(6, 200, 40000, '2020-06-17', '2020-06-16 19:06:50', '2020-06-16 19:06:50', 3, 5),
(7, 4, 40000, '2020-06-17', '2020-06-16 19:07:11', '2020-06-16 19:07:11', 1, 6),
(8, 200, 40000, '2020-06-17', '2020-06-16 19:07:19', '2020-06-16 19:07:19', 3, 6),
(9, 10, 20000, '2020-06-17', '2020-06-16 22:58:42', '2020-06-16 22:58:42', 4, 5),
(10, 5, 10000, '2020-06-17', '2020-06-16 22:58:56', '2020-06-16 22:58:56', 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_masuks`
--

CREATE TABLE `bahan_masuks` (
  `id` int(10) UNSIGNED NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Tanggal_Masuk` date NOT NULL,
  `Harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_bahan` int(10) UNSIGNED NOT NULL,
  `id_admin` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_masuks`
--

INSERT INTO `bahan_masuks` (`id`, `Jumlah`, `Tanggal_Masuk`, `Harga`, `created_at`, `updated_at`, `id_bahan`, `id_admin`) VALUES
(3, 4, '2020-06-14', 40000, '2020-06-14 07:22:46', '2020-06-14 07:22:46', 1, 5),
(4, 4, '2020-06-14', 40000, '2020-06-14 07:24:49', '2020-06-14 07:24:49', 1, 5),
(5, 2, '2020-06-14', 20000, '2020-06-14 07:25:06', '2020-06-14 07:25:06', 1, 5),
(6, 20, '2020-06-17', 8000, '2020-06-16 17:48:05', '2020-06-16 17:48:05', 3, 5),
(7, 400, '2020-06-17', 9000, '2020-06-16 17:48:18', '2020-06-16 17:48:18', 3, 5),
(8, 4, '2020-06-17', 40000, '2020-06-16 17:48:31', '2020-06-16 17:48:31', 1, 5),
(9, 20, '2020-06-17', 60000, '2020-06-16 22:58:14', '2020-06-16 22:58:14', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` int(10) UNSIGNED NOT NULL,
  `Nama_Kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `Nama_Kategori`, `created_at`, `updated_at`) VALUES
(1, 'Daging', '2020-06-10 22:53:21', '2020-06-10 22:53:21'),
(2, 'Sayuran', '2020-06-10 22:55:56', '2020-06-10 22:55:56'),
(3, 'Telur', '2020-06-10 22:56:30', '2020-06-10 22:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `makanans`
--

CREATE TABLE `makanans` (
  `id` int(10) UNSIGNED NOT NULL,
  `Nama_Makanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_admin` int(10) UNSIGNED NOT NULL,
  `Tanggal_Keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `makanans`
--

INSERT INTO `makanans` (`id`, `Nama_Makanan`, `Harga`, `created_at`, `updated_at`, `id_admin`, `Tanggal_Keluar`) VALUES
(5, 'Nasi Goreng', 80000, '2020-06-14 07:21:46', '2020-06-14 07:21:46', 5, '2020-06-14'),
(6, 'Nasi Padang', 90000, '2020-06-16 19:07:02', '2020-06-16 19:07:02', 5, '2020-06-17');

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
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_06_11_032236_create_admins_table', 1),
(4, '2020_06_11_032744_create_kategoris_table', 1),
(5, '2020_06_11_033302_create_bahans_table', 2),
(6, '2020_06_11_033659_create_makanans_table', 3),
(7, '2020_06_11_034144_create_bahan_masuks_table', 4),
(8, '2020_06_11_052650_create_bahan_keluars_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`Username`);

--
-- Indexes for table `bahans`
--
ALTER TABLE `bahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahans_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `bahan_keluars`
--
ALTER TABLE `bahan_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan_keluars_id_bahan_foreign` (`id_bahan`),
  ADD KEY `bahan_keluars_id_makanan_foreign` (`id_makanan`);

--
-- Indexes for table `bahan_masuks`
--
ALTER TABLE `bahan_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan_masuks_id_bahan_foreign` (`id_bahan`),
  ADD KEY `bahan_masuks_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `makanans`
--
ALTER TABLE `makanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `makanans_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bahans`
--
ALTER TABLE `bahans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bahan_keluars`
--
ALTER TABLE `bahan_keluars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bahan_masuks`
--
ALTER TABLE `bahan_masuks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `makanans`
--
ALTER TABLE `makanans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahans`
--
ALTER TABLE `bahans`
  ADD CONSTRAINT `bahans_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategoris` (`id`);

--
-- Constraints for table `bahan_keluars`
--
ALTER TABLE `bahan_keluars`
  ADD CONSTRAINT `bahan_keluars_id_bahan_foreign` FOREIGN KEY (`id_bahan`) REFERENCES `bahans` (`id`),
  ADD CONSTRAINT `bahan_keluars_id_makanan_foreign` FOREIGN KEY (`id_makanan`) REFERENCES `makanans` (`id`);

--
-- Constraints for table `bahan_masuks`
--
ALTER TABLE `bahan_masuks`
  ADD CONSTRAINT `bahan_masuks_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `bahan_masuks_id_bahan_foreign` FOREIGN KEY (`id_bahan`) REFERENCES `bahans` (`id`);

--
-- Constraints for table `makanans`
--
ALTER TABLE `makanans`
  ADD CONSTRAINT `makanans_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
