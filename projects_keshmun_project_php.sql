-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 07:49 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects_keshmun_project_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `created_at`) VALUES
(7, 'کامپیوتر جیبی', 'یک محصول بسیار کاربردی و قابل حمل', '2021-05-05 22:04:26'),
(8, 'کتاب مدار منطقی', 'یک کتاب بسیار کاربردی و عالی', '2021-05-05 22:05:03'),
(9, 'توپ فوتبال', 'محصولی بسیار با کیفیت دارای جنس خوب و کیفیت عالی', '2021-05-05 22:05:43'),
(10, 'دوچرخه دیسک دار', 'این دوچرخه بسیار پیشرفته بوده و در جهت حفظ سلامتی به شما کمک خواهد کرد', '2021-05-05 22:06:34'),
(11, 'کامپیوتر', 'یک محصول بسیار کاربردی و مناسب برنامه نویسی', '2021-05-05 22:07:08'),
(12, 'چراغ قوه', 'بسیار قوی و بسیار عالی در حد چراخ خودرو', '2021-05-05 22:07:16'),
(13, 'کتاب ریاضی 2', 'خیلی خوب و سنگین مخصوص خواندن', '2021-05-05 22:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE `storages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `address` varchar(512) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id`, `name`, `address`, `created_at`) VALUES
(5, 'انبار تهران', 'تهران', '2021-05-05 22:08:06'),
(6, 'انبار تهران منطقه 1', 'تهران - منطقه 1', '2021-05-05 22:08:27'),
(7, 'انبار تهران منطقه 2', 'تهران - منطقه 2', '2021-05-05 22:08:32'),
(8, 'انبار تهران منطقه 3', 'تهران - منطقه 3', '2021-05-05 22:08:39'),
(9, 'انبار تهران منطقه 4', 'تهران - منطقه 4', '2021-05-05 22:08:48'),
(10, 'انبار تهران منطقه 5', 'تهران - منطقه 5', '2021-05-05 22:08:54'),
(11, 'انبار تهران منطقه 6', 'تهران - منطقه 6', '2021-05-05 22:09:03'),
(12, 'انبار تهران منطقه 7', 'تهران - منطقه 7', '2021-05-05 22:09:11'),
(13, 'انبار تهران منطقه 8', 'تهران - منطقه 8', '2021-05-05 22:09:19'),
(14, 'انبار تهران منطقه 9', 'تهران - منطقه 9', '2021-05-05 22:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `storages_products`
--

CREATE TABLE `storages_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `storage_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_count` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storages_products`
--

INSERT INTO `storages_products` (`id`, `storage_id`, `product_id`, `product_count`) VALUES
(10, 5, 7, 150),
(11, 7, 7, 21),
(12, 11, 7, 6),
(13, 7, 9, 85),
(14, 7, 10, 69),
(15, 11, 10, 21),
(17, 10, 12, 25),
(19, 12, 13, 41),
(20, 12, 10, 69),
(21, 13, 13, 21),
(22, 5, 13, 9),
(23, 6, 8, 500),
(24, 14, 10, 60),
(25, 10, 13, 92);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storages_products`
--
ALTER TABLE `storages_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `storages_products`
--
ALTER TABLE `storages_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
