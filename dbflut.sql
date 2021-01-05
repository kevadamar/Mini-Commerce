-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mobile_globalshop.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mobile_globalshop.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT IGNORE INTO `categories` (`id`, `name`, `slug`, `parent_id`, `cover_image`, `created_at`, `update_at`) VALUES
	(10, 'Hijab', '', NULL, NULL, '2020-10-07 10:18:46', '2020-10-07 10:18:46'),
	(11, 'Accesories', '', NULL, NULL, '2020-10-07 10:18:46', '2020-10-07 10:18:46');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.flutter_barang
CREATE TABLE IF NOT EXISTS `flutter_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `image` text NOT NULL,
  `tglexpired` date NOT NULL,
  `tglinput` date NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mobile_globalshop.flutter_barang: ~3 rows (approximately)
/*!40000 ALTER TABLE `flutter_barang` DISABLE KEYS */;
INSERT IGNORE INTO `flutter_barang` (`id_barang`, `id_kategori`, `id_satuan`, `userid`, `nama_barang`, `harga`, `image`, `tglexpired`, `tglinput`) VALUES
	(1, 2, 1, 1, 'guitars', 100000, '16112020042131scaled_image_picker668147117.jpg', '2023-04-18', '2020-10-21'),
	(2, 1, 1, 1, 'darto waringin sumedi', 123333, '16112020060758scaled_image_picker54894523.jpg', '2020-11-16', '2020-11-16'),
	(3, 1, 2, 1, 'susu ultra', 565656, '16112020060825scaled_image_picker196328713.jpg', '2020-11-16', '2020-11-16'),
	(4, 1, 1, 1, 'Susu Ultra', 50000, '25112020123519scaled_image_picker1948840188.jpg', '2020-11-25', '2020-11-25'),
	(5, 1, 1, 1, 'susu ultra', 520000, '28112020160812scaled_image_picker1464939666.jpg', '2020-11-30', '2020-11-28');
/*!40000 ALTER TABLE `flutter_barang` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.flutter_kategori
CREATE TABLE IF NOT EXISTS `flutter_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mobile_globalshop.flutter_kategori: ~2 rows (approximately)
/*!40000 ALTER TABLE `flutter_kategori` DISABLE KEYS */;
INSERT IGNORE INTO `flutter_kategori` (`id_kategori`, `nama_kategori`) VALUES
	(1, 'minuman'),
	(2, 'makanan');
/*!40000 ALTER TABLE `flutter_kategori` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.flutter_penjualan
CREATE TABLE IF NOT EXISTS `flutter_penjualan` (
  `id_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `id_faktur_m` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `grandtotal` decimal(10,0) NOT NULL,
  `nilaibayar` decimal(10,0) NOT NULL,
  `nilaikembali` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_faktur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mobile_globalshop.flutter_penjualan: ~2 rows (approximately)
/*!40000 ALTER TABLE `flutter_penjualan` DISABLE KEYS */;
INSERT IGNORE INTO `flutter_penjualan` (`id_faktur`, `id_faktur_m`, `userid`, `tgl_penjualan`, `grandtotal`, `nilaibayar`, `nilaikembali`) VALUES
	(1, '', 1, '2021-01-04', 150000, 200000, 50000),
	(2, '', 2, '2021-01-03', 520000, 600000, 80000),
	(3, '', 1, '2021-01-04', 100000, 120000, 20000);
/*!40000 ALTER TABLE `flutter_penjualan` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.flutter_penjualan_detail
CREATE TABLE IF NOT EXISTS `flutter_penjualan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_faktur` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mobile_globalshop.flutter_penjualan_detail: ~4 rows (approximately)
/*!40000 ALTER TABLE `flutter_penjualan_detail` DISABLE KEYS */;
INSERT IGNORE INTO `flutter_penjualan_detail` (`id`, `id_faktur`, `id_barang`, `qty`, `harga`) VALUES
	(1, 1, 4, 1, 50000),
	(2, 1, 1, 1, 100000),
	(3, 2, 5, 1, 520000),
	(4, 3, 4, 2, 100000);
/*!40000 ALTER TABLE `flutter_penjualan_detail` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.flutter_satuan
CREATE TABLE IF NOT EXISTS `flutter_satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(50) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mobile_globalshop.flutter_satuan: ~2 rows (approximately)
/*!40000 ALTER TABLE `flutter_satuan` DISABLE KEYS */;
INSERT IGNORE INTO `flutter_satuan` (`id_satuan`, `nama_satuan`, `satuan`) VALUES
	(1, 'pieces', 'pcs'),
	(2, 'kilogram', 'kg');
/*!40000 ALTER TABLE `flutter_satuan` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.flutter_shopping_cart
CREATE TABLE IF NOT EXISTS `flutter_shopping_cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id_cart`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mobile_globalshop.flutter_shopping_cart: ~3 rows (approximately)
/*!40000 ALTER TABLE `flutter_shopping_cart` DISABLE KEYS */;
INSERT IGNORE INTO `flutter_shopping_cart` (`id_cart`, `userid`, `id_barang`, `qty`, `harga`, `createDate`) VALUES
	(10, 2, 2, 1, 123333, '2021-01-04 11:43:49'),
	(12, 2, 5, 2, 1040000, '2021-01-04 11:58:12'),
	(13, 2, 4, 1, 50000, '2021-01-04 11:58:19');
/*!40000 ALTER TABLE `flutter_shopping_cart` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.flutter_users
CREATE TABLE IF NOT EXISTS `flutter_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nama` text NOT NULL,
  `status` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mobile_globalshop.flutter_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `flutter_users` DISABLE KEYS */;
INSERT IGNORE INTO `flutter_users` (`userid`, `username`, `password`, `level`, `email`, `nama`, `status`, `createDate`) VALUES
	(1, 'keva', '202cb962ac59075b964b07152d234b70', 1, '1118100066@smtikglobal.ac.id', 'Keva Damar Galih', 0, '2020-12-11 18:31:48'),
	(2, 'samuel', '202cb962ac59075b964b07152d234b70', 1, 'samuel@gmail.com', 'Samuel Cuy', 0, '2020-12-11 18:32:13');
/*!40000 ALTER TABLE `flutter_users` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_address` tinytext NOT NULL,
  `pincode` int(10) NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `total_amt` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mobile_globalshop.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `cover_image` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mobile_globalshop.products: ~0 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table mobile_globalshop.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL,
  `path` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mobile_globalshop.product_images: ~0 rows (approximately)
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
