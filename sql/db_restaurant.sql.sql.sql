-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 10, 2023 at 08:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `is_deleted`) VALUES
(1, 'meal', '2023-08-20', 0),
(2, 'drink', '2023-08-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `category_id`, `created_at`, `is_deleted`) VALUES
(1, 'hamburger', 1, '2023-08-21', 0),
(2, 'coca-cola', 2, '2023-08-21', 0),
(3, 'pizza', 1, '2023-08-29', 0),
(4, 'fanta', 2, '2023-08-29', 0),
(5, 'sushi', 1, '2023-08-29', 0),
(6, 'water', 2, '2023-08-29', 0),
(7, 'pancake', 1, '2023-08-29', 0),
(8, 'sprite', 2, '2023-08-29', 0),
(9, 'french fries', 1, '2023-08-29', 0),
(10, 'orange juice', 2, '2023-08-29', 0),
(11, 'pljeskavica', 1, '2023-08-29', 0),
(12, 'beer', 2, '2023-08-29', 0),
(13, 'salad', 1, '2023-08-29', 0),
(14, 'apple juice', 2, '2023-08-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `foods_orders`
--

CREATE TABLE `foods_orders` (
  `foods_id` int(11) NOT NULL,
  `quantity` varchar(11) DEFAULT NULL,
  `orders_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `foods_orders`
--

INSERT INTO `foods_orders` (`foods_id`, `quantity`, `orders_id`) VALUES
(1, NULL, 1),
(2, NULL, 1),
(1, NULL, 2),
(3, NULL, 7),
(5, NULL, 7),
(1, NULL, 8),
(3, NULL, 8),
(6, NULL, 8),
(5, NULL, 9),
(4, NULL, 9),
(11, NULL, 10),
(12, NULL, 10),
(8, NULL, 10),
(13, NULL, 16),
(11, NULL, 16),
(9, NULL, 16),
(8, NULL, 16),
(4, NULL, 16),
(6, NULL, 16),
(2, NULL, 16),
(1, NULL, 20),
(3, NULL, 20),
(10, NULL, 20),
(8, NULL, 20),
(13, NULL, 20),
(1, NULL, 21),
(3, NULL, 21),
(6, NULL, 21),
(8, NULL, 21),
(12, NULL, 21),
(1, NULL, 22),
(3, NULL, 22),
(6, NULL, 22),
(7, NULL, 23),
(11, NULL, 23),
(9, NULL, 23),
(14, NULL, 23),
(11, NULL, 23),
(1, '2', 26),
(3, '3', 26),
(2, '5', 26),
(1, '2', 27),
(3, '3', 27),
(2, '5', 27),
(1, '2', 28),
(3, '3', 28),
(2, '5', 28),
(2, '3', 4),
(3, '5', 5),
(9, '3', 29),
(7, '2', 29),
(11, '1', 29),
(12, '1', 29),
(3, '3', 30),
(6, '3', 30),
(1, '1', 31),
(4, '1', 31),
(1, '2', 32),
(5, '2', 32),
(6, '1', 32),
(4, '4', 32),
(1, '2', 33),
(7, '4', 33),
(6, '5', 33);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`, `is_deleted`) VALUES
(1, 1, '2023-08-27 10:50:03', 1),
(2, 1, '2023-08-27 09:30:00', 1),
(3, 2, '2023-08-29 15:11:08', 0),
(4, 2, '2023-08-29 15:15:00', 1),
(5, 2, '2023-08-29 15:17:01', 1),
(6, 2, '2023-08-29 15:18:27', 0),
(7, 2, '2023-08-29 15:20:22', 1),
(8, 2, '2023-08-29 15:26:17', 1),
(9, 2, '2023-08-29 15:42:34', 1),
(10, 2, '2023-08-29 15:47:14', 1),
(11, 2, '2023-08-29 15:48:09', 0),
(12, 2, '2023-08-29 15:48:37', 0),
(13, 2, '2023-08-29 15:48:51', 0),
(14, 2, '2023-08-29 15:49:05', 0),
(15, 2, '2023-08-29 15:49:29', 0),
(16, 2, '2023-08-29 15:49:53', 1),
(17, 2, '2023-08-29 16:03:48', 0),
(18, 2, '2023-08-29 16:04:13', 0),
(19, 2, '2023-08-29 16:04:15', 0),
(20, 2, '2023-08-29 16:05:02', 1),
(21, 2, '2023-08-29 16:06:04', 1),
(22, 2, '2023-09-02 11:17:53', 1),
(23, 3, '2023-09-08 15:35:18', 1),
(24, 2, '2023-09-08 15:56:50', 0),
(25, 2, '2023-09-08 15:57:16', 0),
(26, 2, '2023-09-08 16:03:29', 1),
(27, 2, '2023-09-08 16:06:13', 1),
(28, 2, '2023-09-08 16:07:08', 1),
(29, 2, '2023-09-08 16:17:01', 1),
(30, 2, '2023-09-08 16:20:02', 1),
(31, 2, '2023-09-08 16:24:00', 1),
(32, 2, '2023-10-21 11:19:54', 0),
(33, 3, '2023-10-21 13:16:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `is_deleted`) VALUES
(1, 'admin', '2023-08-20', 0),
(2, 'moderator', '2023-08-20', 0),
(3, 'editor', '2023-08-20', 0),
(4, 'viewer', '2023-08-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `created_at`, `is_deleted`) VALUES
(1, 'rile', 'rile@mail.com', 'admin', 1, '2023-08-20', 0),
(2, 'RileAdmin', 'rrile@mail.com', '$2y$10$t2XISBs01Eca4OKW/4VxL.sJyJcFCP16I5/HNTuycnQV45KjJdPHa', 1, '2023-08-21', 0),
(3, 'Mira123', 'mmira@mail.com', '$2y$10$Pog4wkPnp2PhG1O4SP/s4eZUmM3wRXO8FCWe65GaGE6O7XYxxInWq', 2, '2023-08-27', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `foods_orders`
--
ALTER TABLE `foods_orders`
  ADD KEY `foods_id` (`foods_id`),
  ADD KEY `orders_id` (`orders_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `foods_orders`
--
ALTER TABLE `foods_orders`
  ADD CONSTRAINT `foods_orders_ibfk_1` FOREIGN KEY (`foods_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `foods_orders_ibfk_2` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
