-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2023 at 01:19 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imv`
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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_pwd` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'priest',
  `p1_email` int(11) DEFAULT NULL,
  `p1_email_sent_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `voted` int(11) DEFAULT NULL,
  `voted_dtime` datetime DEFAULT NULL,
  `votecnt` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `cus_pwd`, `user_type`, `p1_email`, `p1_email_sent_at`, `voted`, `voted_dtime`, `votecnt`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jerin Monish', 'jerinmonish007@gmail.com', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'priest', 1, '2023-11-22 16:37:53', 1, '2023-11-22 16:59:11', NULL, NULL, '2023-11-22 04:24:38', '2023-11-22 11:29:11'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'admin', NULL, '2023-11-22 21:29:38', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Albin Antony', 'b20201@dbcyelagiri.edu.in', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'priest', 1, '2023-11-22 16:32:14', NULL, NULL, 1, NULL, NULL, '2023-11-22 11:29:11'),
(4, 'Micheal', 'antonyraj6569@gmail.com', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'priest', 1, '2023-11-22 16:32:14', NULL, NULL, NULL, NULL, NULL, '2023-11-22 11:23:40'),
(5, 'Naveen', 'naveen@gmail.com', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'priest', NULL, '2023-11-22 21:29:38', NULL, NULL, 1, NULL, NULL, '2023-11-22 11:29:11'),
(6, 'Adaikalaraj', 'adaikalaraj@gmail.com', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'priest', NULL, '2023-11-22 21:29:38', NULL, NULL, 1, NULL, NULL, '2023-11-22 11:29:11'),
(7, 'Manigandan', 'mani@gmail.com', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'priest', NULL, '2023-11-22 21:29:38', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Daniel', 'dani@gmail.com', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'priest', NULL, '2023-11-22 21:29:38', NULL, NULL, 1, NULL, NULL, '2023-11-22 11:29:11'),
(9, 'Joan', 'joan@gmail.com', NULL, '$2y$12$vJpJBfJ4e.Y.IkeHVWu0E.LNe/F9deB0wz6jltGzFZwSsHMqraQzS', 'TVh3VEhvNWtROUJzWHg0WVQ4Q0N1dXNPTFFZek5pVDBsSld4Zm1GSENSSQ==', 'priest', NULL, '2023-11-22 21:29:38', NULL, NULL, 1, NULL, NULL, '2023-11-22 11:29:11');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
