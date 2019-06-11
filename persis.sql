-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2019 at 11:00 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persis`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'IT', '2019-05-08 02:32:32', '2019-05-08 02:32:32'),
(3, 'HRD', '2019-05-10 07:24:21', '2019-05-10 07:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'staff', '2019-05-08 02:42:02', '2019-05-08 02:42:02'),
(2, 'manajer', '2019-05-08 02:48:05', '2019-05-08 02:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2019_04_04_070454_create_tasks_table', 1),
('2019_05_07_094744_create_pegawai_table', 2),
('2019_05_07_152308_create_divisi_table', 3),
('2019_05_08_093846_create_jabatan_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `divisi` int(11) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `atasan` int(11) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `email`, `password`, `remember_token`, `divisi`, `jabatan`, `alamat`, `telepon`, `atasan`, `tanggal_lahir`, `tanggal_masuk`, `tanggal_keluar`, `created_at`, `updated_at`) VALUES
(1, 'lq', '', '', '', 3, 1, 'jl eerere', '00989', 3, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 03:32:17', '2019-06-11 04:45:59'),
(2, 'adam', 'adam@gmail.com', '$2y$10$lVdTF6gT/BVXbsLmSknqV.b9DHulFq8JiQDMFDcioqcyUkowBjM4W', 'x8gK1sAuzUTk7FdC2pba6wjO3hkvHGhXuu1Ja7asgDnwH8REXzpB1weqIaWB', 2, 2, 'jl perak 123', '2121212', 2, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 03:38:19', '2019-06-11 08:40:48'),
(3, 'ada2', '', '', '', 2, 3, 'asasasas', '21212121', 0, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 03:38:42', '2019-06-11 04:24:43'),
(4, 'aqqqqq', '', '', '', 2, 3, 'sss', 'sasas', 2, '2019-06-11', '2019-06-11', '0000-00-00', '2019-05-07 04:20:10', '2019-06-11 04:38:24'),
(5, 'a', '', '', '', 0, 0, '', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 04:20:12', '2019-05-07 04:20:12'),
(6, 'a', '', '', '', 0, 0, '', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 04:20:15', '2019-05-07 04:20:15'),
(7, 'a', '', '', '', 0, 0, '', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 04:20:18', '2019-05-07 04:20:18'),
(8, 'a', '', '', '', 0, 0, '', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 04:20:23', '2019-05-07 04:20:23'),
(9, 'a', '', '', '', 0, 0, '', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 04:20:25', '2019-05-07 04:20:25'),
(12, 'w', '', '', '', 0, 0, '', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', '2019-05-07 08:07:42', '2019-05-07 08:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'adam', '2019-05-07 03:00:02', '2019-05-07 03:00:02'),
(2, 'ad', '2019-05-07 03:13:05', '2019-05-07 03:13:05'),
(4, 'aa', '2019-05-07 03:30:09', '2019-05-07 03:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'adam', 'adam@gmail.com', '\r\n$2y$10$b9.dCdbkD1bUD5.xRRXGj.UddkpTFK1K31R.s6ZBODy1YPeOWNZlK', 'htk9jEIK81L5n43XYt5NszxwFrcqmehn5R9GQAVpAcZvW2xNveifZ88HUPH4', '2019-06-10 01:59:58', '2019-06-10 07:52:21'),
(3, 'nana', 'nana@gmail.com', 'nananana', NULL, '2019-06-10 07:43:03', '2019-06-10 07:43:03'),
(4, 'nini', 'nini@gmail.com', '$2y$10$Mma8QCBQSgov7hmuef5Iu.juH05bXgxpMzTsMl57AErt9LJr2OE52', 'c3jRB2aCCwvzxAAhuNjGcgKBUgDwNoufRhA3t1hFMNdHXWrFOGFHx17Tpxh6', '2019-06-10 07:51:40', '2019-06-10 07:52:45'),
(5, 'nunu', 'nunu@gmail.com', '$2y$10$TsOim/HRGr9ei7qCGguBveTr.AxMK/XPIVSexbKST3ZXX/mqwT10u', 'PVLvM8V9oAVQdQfWwxKyN4Z2uMcirOp1a8ihjsrMkf7XV2M4ZgZm5JXkAzoa', '2019-06-10 08:05:44', '2019-06-10 08:05:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
