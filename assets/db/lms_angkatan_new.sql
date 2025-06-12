-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 09:52 AM
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
-- Database: `lms_angkatan_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `education` varchar(256) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `id_role`, `name`, `gender`, `education`, `phone`, `email`, `password`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin', 1, 'SMA', '1234', 'test@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'tester', '2025-06-10 03:00:26', '2025-06-12 07:17:19'),
(3, 2, 'Retha', 0, 'SMA', '1234', 'retha@gmail.com', '12dea96fec20593566ab75692c9949596833adc9', 'adas', '2025-06-03 08:04:46', '2025-06-12 07:46:18'),
(5, 1, 'Superuser', 1, 'S3', '1234', 'superuser@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'tester', '2025-06-11 02:11:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructor_majors`
--

CREATE TABLE `instructor_majors` (
  `id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_majors`
--

INSERT INTO `instructor_majors` (`id`, `id_major`, `id_instructor`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2025-06-10 03:25:38', '2025-06-10 03:26:26'),
(2, 3, 4, '2025-06-10 03:26:12', NULL),
(4, 2, 1, '2025-06-10 03:41:30', NULL),
(5, 4, 1, '2025-06-10 05:16:28', NULL),
(6, 2, 5, '2025-06-11 02:14:58', NULL),
(8, 4, 5, '2025-06-11 02:40:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated _at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `name`, `created_at`, `updated _at`) VALUES
(1, 'UI & UX', '2025-06-10 02:01:56', '2025-06-10 02:59:10'),
(2, 'Web Development ', '2025-06-10 02:59:20', NULL),
(3, 'Content Creator', '2025-06-10 02:59:35', NULL),
(4, 'Designer', '2025-06-10 02:59:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(5) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `icon` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `urutan` int(5) DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `icon`, `url`, `urutan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', 'bi bi-grid', 'home.php', 1, 0, '2025-06-11 04:33:02', '2025-06-11 05:18:20'),
(2, 0, 'Master Data', 'bi bi-menu-button-wide', '', 2, 0, '2025-06-11 04:38:09', NULL),
(3, 0, 'Modul', 'bi bi-book', '?page=moduls', 3, 0, '2025-06-11 04:38:50', '2025-06-11 05:18:55'),
(4, 2, 'instructors', 'bi bi-circle', 'instructor', 1, 0, '2025-06-11 04:42:43', '2025-06-11 05:20:07'),
(5, 2, 'Major', 'bi bi-circle', 'majors', 2, 0, '2025-06-11 04:43:56', '2025-06-11 05:20:11'),
(6, 2, 'Menu', 'bi bi-circle', 'menu', 3, 0, '2025-06-11 04:44:11', '2025-06-11 05:20:16'),
(7, 2, 'Role', 'bi bi-circle', 'role', 4, 0, '2025-06-11 04:44:41', '2025-06-11 05:20:21'),
(8, 2, 'User', 'bi bi-circle', 'user', 5, 0, '2025-06-11 04:45:02', '2025-06-11 05:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `menu_roles`
--

CREATE TABLE `menu_roles` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_roles`
--

INSERT INTO `menu_roles` (`id`, `id_role`, `id_menu`, `created_at`, `updated_at`) VALUES
(24, 3, 1, '2025-06-12 07:34:21', NULL),
(25, 3, 2, '2025-06-12 07:34:21', NULL),
(26, 3, 4, '2025-06-12 07:34:21', NULL),
(27, 3, 5, '2025-06-12 07:34:21', NULL),
(28, 3, 6, '2025-06-12 07:34:21', NULL),
(29, 3, 7, '2025-06-12 07:34:21', NULL),
(30, 3, 8, '2025-06-12 07:34:21', NULL),
(31, 3, 3, '2025-06-12 07:34:21', NULL),
(81, 4, 1, '2025-06-12 07:45:48', NULL),
(82, 4, 2, '2025-06-12 07:45:48', NULL),
(83, 4, 4, '2025-06-12 07:45:48', NULL),
(84, 4, 5, '2025-06-12 07:45:48', NULL),
(85, 4, 6, '2025-06-12 07:45:48', NULL),
(86, 4, 7, '2025-06-12 07:45:48', NULL),
(87, 4, 8, '2025-06-12 07:45:48', NULL),
(88, 4, 3, '2025-06-12 07:45:48', NULL),
(89, 2, 1, '2025-06-12 07:45:58', NULL),
(90, 2, 3, '2025-06-12 07:45:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `id_majors` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated _at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `id_instructor`, `id_majors`, `name`, `created_at`, `updated _at`) VALUES
(4, 1, 4, 'test', '2025-06-10 05:16:46', NULL),
(6, 5, 2, 'Web Development ', '2025-06-11 02:40:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modules_detail`
--

CREATE TABLE `modules_detail` (
  `id` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `file` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules_detail`
--

INSERT INTO `modules_detail` (`id`, `id_modul`, `file`, `created_at`, `updated_at`) VALUES
(3, 4, '6847bfbe36674-PGN-LNG.pdf', '2025-06-10 05:16:46', NULL),
(5, 6, '6848ec8f76936-6847bfbe36674-PGN-LNG.pdf', '2025-06-11 02:40:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated _at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated _at`) VALUES
(1, 'Instructors', '2025-06-10 02:02:05', '2025-06-11 01:21:55'),
(2, 'Students', '2025-06-11 01:21:03', '2025-06-11 01:21:49'),
(3, 'Administrator', '2025-06-11 01:21:26', NULL),
(4, 'Admin', '2025-06-11 01:21:34', NULL),
(5, 'PIC', '2025-06-11 01:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `education` varchar(256) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `id_major`, `password`, `name`, `gender`, `education`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Superadmin', 1, 'SMA', '1234', 'test@gmail.com', 'test', '2025-06-10 03:00:26', '2025-06-11 02:02:55'),
(3, 1, '12dea96fec20593566ab75692c9949596833adc9', 'Retha', 0, 'SMA', '1234', 'retha@gmail.com', 'adas', '2025-06-03 08:04:46', '2025-06-11 02:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_role`, `name`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'Superadmin', 'superadmin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2025-06-03 03:07:01', '2025-06-11 01:47:14', 0),
(2, 2, 'coba1234', 'coba1234@gmail.com', '12dea96fec20593566ab75692c9949596833adc9', '2025-06-03 07:12:38', '2025-06-11 01:47:23', 0),
(6, 1, 'Superuser', 'superuser@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2025-06-11 02:08:55', '2025-06-11 02:10:23', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_majors`
--
ALTER TABLE `instructor_majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules_detail`
--
ALTER TABLE `modules_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructor_majors`
--
ALTER TABLE `instructor_majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_roles`
--
ALTER TABLE `menu_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modules_detail`
--
ALTER TABLE `modules_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
