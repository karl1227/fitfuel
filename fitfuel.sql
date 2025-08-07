-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 04:17 PM
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
-- Database: `fitfuel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(9, 4, 1, 3, '2025-05-20 13:10:28'),
(10, 4, 2, 2, '2025-05-20 13:10:30'),
(11, 4, 3, 8, '2025-05-20 13:23:32'),
(14, 6, 8, 2, '2025-05-20 13:54:11'),
(15, 6, 15, 2, '2025-05-20 13:54:13'),
(16, 6, 4, 3, '2025-05-20 13:54:16'),
(17, 7, 3, 1, '2025-05-20 13:54:49'),
(18, 7, 6, 1, '2025-05-20 13:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(3, 'BCAAs'),
(2, 'Creatine'),
(5, 'Fat Burner'),
(4, 'Pre-Workout'),
(1, 'Whey Protein');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `image_url`, `category_id`, `stock_quantity`) VALUES
(1, 'Muscle Tech Whey Protein', 'A premium whey protein blend for muscle repair and growth, ideal post-workout.', 1599.00, 'imgs/Product/Whey/P1-Whey.png', 1, 50),
(2, 'Nitro Tech Whey Protein', 'Fast-absorbing whey formula packed with BCAAs and creatine.', 1799.00, 'imgs/Product/Whey/P2-Whey.png', 1, 50),
(3, 'Rule 1 Whey Protein', 'Low-fat, low-carb whey protein for lean muscle development.', 1650.00, 'imgs/Product/Whey/P3-Whey.png', 1, 50),
(4, 'Gold Standard Whey Protein', 'Award-winning protein with over 24g of protein per serving.', 1899.00, 'imgs/Product/Whey/P4-Whey.png', 1, 50),
(5, 'Nutra Bio Whey Protein', 'Clean-label whey isolate with no fillers or additives.', 1750.00, 'imgs/Product/Whey/P5-Whey.png', 1, 50),
(6, 'Muscle Tech Creatine', 'Micronized creatine for improved strength and endurance.', 999.00, 'imgs/Product/Creatine/P1-Creatine.png', 2, 100),
(7, 'Creatine Monohydrate', 'Lab-tested monohydrate creatine to power your workouts.', 850.00, 'imgs/Product/Creatine/P2-Creatine.png', 2, 100),
(8, 'Muscle Tech Monohydrate', 'Advanced creatine supplement for serious lifters.', 950.00, 'imgs/Product/Creatine/P3-Creatine.png', 2, 100),
(9, 'Rule 1 Creatine Monohydrate', 'Pure creatine monohydrate for explosive performance.', 899.00, 'imgs/Product/Creatine/P4-Creatine.png', 2, 100),
(10, 'Iron Labs Creatine', '100% creatine for improved ATP production during training.', 870.00, 'imgs/Product/Creatine/P5-Creatine.png', 2, 100),
(11, 'BCAAs Muscle Tech', 'Supports muscle recovery and reduces muscle breakdown.', 999.00, 'imgs/Product/BCAAs/P1-BCAAs.png', 3, 60),
(12, 'BCAAs 4:1:1', 'Advanced BCAA ratio for maximum anabolic response.', 899.00, 'imgs/Product/BCAAs/P2-BCAAs.png', 3, 60),
(13, 'Rule 1 BCAAs', 'Instantized BCAAs for easy mixing and faster absorption.', 950.00, 'imgs/Product/BCAAs/P3-BCAAs.png', 3, 60),
(14, 'BCAAs Sport Formula', 'Hydration + amino acids to support endurance athletes.', 980.00, 'imgs/Product/BCAAs/P4-BCAAs.png', 3, 60),
(15, 'XTEND BCAAs', 'Includes electrolytes and 7g of BCAAs per serving.', 1100.00, 'imgs/Product/BCAAs/P5-BCAAs.png', 3, 60),
(16, 'VAPORX5 Muscle Tech', 'Pre-workout explosion with caffeine, beta-alanine, and creatine.', 1199.00, 'imgs/Product/PreWorkout/P1-PreWO.png', 4, 75),
(17, 'Harness', 'Focus-driven pre-workout for a mental and physical edge.', 1250.00, 'imgs/Product/PreWorkout/P2-PreWO.png', 4, 75),
(18, 'The RIPPER', 'High-stim fat burning pre-workout for extreme energy.', 1100.00, 'imgs/Product/PreWorkout/P3-PreWO.png', 4, 75),
(19, 'Rule 1 Roar', 'Delivers powerful pumps and sustained energy.', 1150.00, 'imgs/Product/PreWorkout/P4-PreWO.png', 4, 75),
(20, 'Cellucor C4', 'The classic explosive pre-workout for new and experienced lifters.', 1300.00, 'imgs/Product/PreWorkout/P5-PreWO.png', 4, 75),
(21, 'Fat Burner Muscle Tech', 'Thermogenic fat burner to help boost metabolism and energy.', 1099.00, 'imgs/Product/FatBurner/P1-FatBurner.png', 5, 75),
(22, 'Relumins', 'Slimming support with natural herbal extracts.', 950.00, 'imgs/Product/FatBurner/P2-FatBurner.png', 5, 75),
(23, 'Garcinia Cambogia', 'Supports appetite control and fat metabolism.', 899.00, 'imgs/Product/FatBurner/P3-FatBurner.png', 5, 75),
(24, 'C-Burn', 'A powerful combination of CLA and green tea extract.', 999.00, 'imgs/Product/FatBurner/P4-FatBurner.png', 5, 75),
(25, 'Well Spring', 'All-day fat burning support with natural ingredients.', 899.00, 'imgs/Product/FatBurner/P5-FatBurner.png', 5, 75);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `register_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`register_id`, `firstname`, `lastname`, `email`, `telephone`, `address`, `dob`) VALUES
(4, 'David', 'Googins', 'david@gmail.com', '09770066555', 'Anonas St ', '2004-01-09'),
(5, 'John', 'Doe', 'jd@gmail.com', '098877441552', 'Potsdom St', '2005-02-20'),
(6, 'Alice', 'Gou', 'alice@gmail.com', NULL, NULL, NULL),
(7, 'Emmanuel', 'Espeña', 'espena.emman@gmail.com', NULL, NULL, NULL),
(9, 'admin', 'admin', 'admin@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `register_id`, `is_admin`) VALUES
(4, 'david123', '$2y$10$AHoNpjUS8WwfEFTjitP/N.nKjldDEzNvPt6VDLt6aQDVLnFah9NaK', 4, 0),
(5, 'jd213', '$2y$10$cPTaJdsfiTJCDsqP/2hDseBRB4r8T7ZZNVjmBosO6NEOqnc8yDH62', 5, 0),
(6, 'alice123', '$2y$10$KBo3WmhyKij00xtO68o04OAw4GXhCfQB9roxYlhW7NFfFYEDS31d.', 6, 0),
(7, 'emmanzxc', '$2y$10$sZpQwgzc4hk8MtKZP3z9WeUSklpWbVHSNW/aHf3FqysiDUm64rr4W', 7, 0),
(9, 'admin', '$2y$10$4k.IxMeqr6Lxdx9QrlrmD.XfcqQCvFtMjI..zKW1Cos/u49PZgaO6', 9, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`register_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `register_id` (`register_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `register` (`register_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
