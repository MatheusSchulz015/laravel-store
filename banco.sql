-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.2.3-MariaDB-log - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para store
CREATE DATABASE IF NOT EXISTS `store` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `store`;

-- Copiando estrutura para tabela store.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela store.migrations: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(44, '2014_10_12_000000_create_users_table', 1),
	(45, '2014_10_12_100000_create_password_resets_table', 1),
	(46, '2017_08_14_200225_create_products_table', 1),
	(47, '2017_08_24_195523_create_orders_table', 1),
	(48, '2017_08_24_195631_create_product_order_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `reference` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2','3','4','5','6','7','8','9') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` enum('1','2','3','4','5','6','7') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `date_refresh_status` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_reference_unique` (`reference`),
  UNIQUE KEY `orders_code_unique` (`code`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela store.orders: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `reference`, `code`, `status`, `payment_method`, `date`, `date_refresh_status`, `created_at`, `updated_at`) VALUES
	(47, 1, '2017090415503059ada0761934d', 'E06DFC27-446F-4361-9065-59F86A31FF56', '1', '2', '2017-09-04 15:50:35', NULL, '2004-09-17 00:00:00', '2004-09-17 00:00:00'),
	(48, 1, '2017090615041359b0389d91683', '46381B22-AE20-46E4-97D8-3A88B8E00A0D', '1', '2', '2017-09-06 15:04:19', NULL, '2006-09-17 00:00:00', '2006-09-17 00:00:00'),
	(49, 1, '2017090615535259b0444091a8c', '742D1E95-8330-4BC3-B285-654C5CC7A8C1', '1', '2', '2017-09-06 15:53:54', NULL, '2006-09-17 00:00:00', '2006-09-17 00:00:00'),
	(50, 1, '2017090615564559b044ed1b69a', 'BC8652FC-48F0-4BA9-9E52-B3C64CE8FE97', '1', '2', '2017-09-06 15:56:46', NULL, '2006-09-17 00:00:00', '2006-09-17 00:00:00'),
	(51, 1, '2017090616070959b0475d5cd13', 'CB066D2A-2654-4DB0-B10E-0BCBF33F597B', '1', '2', '2017-09-06 16:07:11', NULL, '2006-09-17 00:00:00', '2006-09-17 00:00:00'),
	(52, 1, '2017090616254659b04bba40d18', '8B620116-E832-4857-9FC0-C2F56B1C0A06', '1', '2', '2017-09-06 16:25:51', NULL, '2006-09-17 00:00:00', '2006-09-17 00:00:00'),
	(53, 1, '2017090616285259b04c74bc2ba', 'F8954823-9918-4FD5-B0AD-8B76087733A4', '3', '2', '2017-09-06 16:28:57', '2017-09-06 18:10:00', '2006-09-17 00:00:00', '2006-09-17 00:00:00'),
	(54, 1, '2017090616392359b04eebd7abf', '420DF470-B68F-45C7-B87F-A11851BB71C6', '3', '2', '2017-09-06 16:39:25', '2017-09-06 18:04:00', '2006-09-17 00:00:00', '2006-09-17 00:00:00'),
	(55, 1, '2017090618130059b064dc8cb48', 'AD561597-D5E0-4C5E-96A7-05DF9B7274BE', '5', '2', '2017-09-06 18:13:05', '2017-09-06 18:24:00', '2006-09-17 00:00:00', '2006-09-17 00:00:00');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Copiando estrutura para tabela store.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela store.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela store.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela store.products: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `description`, `img`, `price`, `created_at`, `updated_at`) VALUES
	(1, 'Produto 1', 'produsapidusa', 'product1.jpg', 60.00, '2017-08-24 17:22:12', NULL),
	(2, 'Produto 2\r\n', 'produsapidusa', 'product2.jpg', 50.00, '2017-08-24 17:22:12', NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Copiando estrutura para tabela store.product_order
CREATE TABLE IF NOT EXISTS `product_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `price` double(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_order_order_id_foreign` (`order_id`),
  KEY `product_order_product_id_foreign` (`product_id`),
  CONSTRAINT `product_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_order_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela store.product_order: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
INSERT INTO `product_order` (`id`, `order_id`, `product_id`, `price`, `qty`, `created_at`, `updated_at`) VALUES
	(42, 47, 1, 60.00, 1, NULL, NULL),
	(43, 48, 1, 60.00, 1, NULL, NULL),
	(44, 49, 1, 60.00, 1, NULL, NULL),
	(45, 50, 1, 60.00, 1, NULL, NULL),
	(46, 51, 1, 60.00, 1, NULL, NULL),
	(47, 52, 1, 60.00, 1, NULL, NULL),
	(48, 53, 1, 60.00, 1, NULL, NULL),
	(49, 54, 1, 60.00, 1, NULL, NULL),
	(50, 55, 1, 60.00, 1, NULL, NULL);
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;

-- Copiando estrutura para tabela store.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela store.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `area_code`, `phone`, `cpf`, `street`, `number`, `complement`, `district`, `postal_code`, `city`, `state`, `country`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Matheus Santos de Souza', 'c34725719695968397115@sandbox.pagseguro.com.br', '$2y$10$LuVCcbZRR.3xujd1Gid8vedKb9G9gPgkF7831mQ3G4eAoYB93NSdS', '71', '86255964', '11475714734', 'Rua São Francisco', '26', 'e', 'Paripe', '40810040', 'Salvador', 'BA', 'BR', 'mshAdmYcGVFSwuJNN4DO7RnMIx4OCzJVNitDGxXDCsLr9hFs9K3v6sYohf9Y', '2017-08-24 20:23:26', '2017-08-24 20:23:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
