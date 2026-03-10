-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: Mar 09, 2026 at 12:45 PM
-- Server version: 8.4.8
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taste_africa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasteafrica_order_product`
--

CREATE TABLE `tasteafrica_order_product` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasteafrica_order_product`
--

INSERT INTO `tasteafrica_order_product` (`order_id`, `product_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasteafrica_product`
--

CREATE TABLE `tasteafrica_product` (
  `product_id` int NOT NULL,
  `desc_` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  `created_at` date DEFAULT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasteafrica_product`
--

INSERT INTO `tasteafrica_product` (`product_id`, `desc_`, `name`, `price`, `in_stock`, `created_at`, `category_id`) VALUES
(1, 'Dibi viande', 'Poulet Yassa', 12.50, 1, '2026-03-05', 1),
(2, 'jus de gingembre', 'Jus de Bissap', 4.00, 1, '2026-03-05', 2),
(3, 'Riz avec sauce d''arachide et viande', 'Thiebou Dienne', 14.99, 1, '2026-03-06', 1),
(4, 'Couscous sénégalais aux légumes et poulet', 'Couscous de Casamance', 13.50, 1, '2026-03-06', 1),
(5, 'Acras de morue croustillants', 'Accras de Morue', 8.50, 1, '2026-03-06', 1),
(6, 'Ragout de viande lente', 'Mafé Traditionnel', 15.00, 1, '2026-03-07', 1),
(7, 'Pâte de maïs avec sauce', 'Fufu Camerounais', 11.99, 1, '2026-03-07', 1),
(8, 'Jus naturel de fruits frais', 'Jus de Mangue Fraîche', 3.50, 1, '2026-03-06', 2),
(9, 'Boisson à base de mil fermenté', 'Bissap Traditionnel', 4.00, 1, '2026-03-06', 2),
(10, 'Café africain fort et riche', 'Café Éthiopien', 3.99, 1, '2026-03-07', 2),
(11, 'Thé aux épices et miel', 'Thé Marocain à la Menthe', 2.99, 1, '2026-03-07', 2),
(12, 'Jus de canne à sucre frais', 'Jus de Canne', 3.00, 1, '2026-03-08', 2),
(13, 'Pâtisserie au miel et amandes', 'Makrout au Miel', 6.50, 1, '2026-03-06', 3),
(14, 'Beignets sucrés enrobés de sucre', 'Loukouma', 5.99, 1, '2026-03-07', 3),
(15, 'Crème glacée à la noix de coco', 'Glace Coco Africaine', 4.99, 1, '2026-03-07', 3),
(16, 'Pudding au lait condensé et fruits', 'Pudding Savoureux', 5.50, 1, '2026-03-08', 3),
(17, 'Tarte aux fruits tropicaux', 'Tarte Exotique', 7.99, 1, '2026-03-08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `taste_africa_category`
--

CREATE TABLE `taste_africa_category` (
  `category_id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taste_africa_category`
--

INSERT INTO `taste_africa_category` (`category_id`, `name`) VALUES
(1, 'Plats'),
(2, 'Boissons'),
(3, 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `taste_africa_comment`
--

CREATE TABLE `taste_africa_comment` (
  `id_comment` int NOT NULL,
  `contenu_text` text NOT NULL,
  `created_at` date DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taste_africa_comment`
--

INSERT INTO `taste_africa_comment` (`id_comment`, `contenu_text`, `created_at`, `name`, `product_id`, `user_id`) VALUES
(1, 'Très bon plat !', '2026-03-06', 'Bob', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `taste_africa_order`
--

CREATE TABLE `taste_africa_order` (
  `order_id` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('en attente','expédiée','livrée','annulée') NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taste_africa_order`
--

INSERT INTO `taste_africa_order` (`order_id`, `order_date`, `status`, `user_id`) VALUES
(1, '2026-03-06 02:40:17', 'livrée', 2);

-- --------------------------------------------------------

--
-- Table structure for table `taste_africa_user`
--

CREATE TABLE `taste_africa_user` (
  `user_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taste_africa_user`
--

INSERT INTO `taste_africa_user` (`user_id`, `email`, `name`, `password`, `role`) VALUES
(1, 'alice@tasteafrica.com', 'Alice', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(2, 'bob@tasteafrica.com', 'Bob', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasteafrica_order_product`
--
ALTER TABLE `tasteafrica_order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tasteafrica_product`
--
ALTER TABLE `tasteafrica_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `taste_africa_category`
--
ALTER TABLE `taste_africa_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `taste_africa_comment`
--
ALTER TABLE `taste_africa_comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `taste_africa_order`
--
ALTER TABLE `taste_africa_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `taste_africa_user`
--
ALTER TABLE `taste_africa_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasteafrica_product`
--
ALTER TABLE `tasteafrica_product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taste_africa_category`
--
ALTER TABLE `taste_africa_category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taste_africa_comment`
--
ALTER TABLE `taste_africa_comment`
  MODIFY `id_comment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taste_africa_order`
--
ALTER TABLE `taste_africa_order`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taste_africa_user`
--
ALTER TABLE `taste_africa_user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasteafrica_order_product`
--
ALTER TABLE `tasteafrica_order_product`
  ADD CONSTRAINT `tasteafrica_order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `taste_africa_order` (`order_id`),
  ADD CONSTRAINT `tasteafrica_order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tasteafrica_product` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `tasteafrica_product`
--
ALTER TABLE `tasteafrica_product`
  ADD CONSTRAINT `tasteafrica_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `taste_africa_category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `taste_africa_comment`
--
ALTER TABLE `taste_africa_comment`
  ADD CONSTRAINT `taste_africa_comment_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tasteafrica_product` (`product_id`),
  ADD CONSTRAINT `taste_africa_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `taste_africa_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `taste_africa_order`
--
ALTER TABLE `taste_africa_order`
  ADD CONSTRAINT `taste_africa_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `taste_africa_user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
