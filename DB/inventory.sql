-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 06:28 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `billers`
--

CREATE TABLE `billers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billers`
--

INSERT INTO `billers` (`id`, `company`, `logo`, `email`, `phone`, `vat_no`, `gst_no`, `postcode`, `country`, `city`, `state`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'alibaba', '1621923203.webp', 'ali@gmail.com', '456456', '10', '10', '123', 'japan', 'japanis', 'uiyu', 'CE Palmer, A Galvez-Pol, R Hannah, A Fotopoulou, JM Kilner.', 1, '2021-05-25 00:13:23', '2021-05-25 00:13:23'),
(2, 'chaldal', '1622108909.jpg', 'sohelahmeditebd@gmail.com', '01474554', '10', '10', '1900', 'Bangladesh', 'Uttara', 'Dhaka', 'dhaka', 1, '2021-05-27 03:48:29', '2021-05-27 03:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TEER', '1621839216.png', 'tEER', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the', 1, '2021-05-24 00:53:36', '2021-05-24 00:53:36'),
(2, 'Fresh', '1621839292.jpg', 'fresh', 'It is a long established fact that a reader will be distracted by the readable content', 1, '2021-05-24 00:54:52', '2021-05-24 00:54:52'),
(3, 'ACI PURE', '1621839688.png', 'aCI PURE', 'products found in ACI PURE', 1, '2021-05-24 01:01:28', '2021-05-24 01:01:28'),
(4, 'hero', '1621918475.jpg', 'hero', 'Scooters in Bangladesh are a great way to travel. For the best two wheeler motorcycles and online tw', 1, '2021-05-24 22:54:35', '2021-05-24 22:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_id`, `slug`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Wheat Atta', 0, 'wheat Atta', '1621840571.jpg', 'SUSTAINABLE FLOUR FORTIFICATION STRATEGIES ARE IMPLEMENTED BY TEAMS FROM VARIOUS ORGANIZATIONS.', 1, '2021-05-24 01:16:11', '2021-05-24 01:16:11'),
(2, 'aci', 2, 'aci', '1621840674.jpg', 'What’s Turmeric Extract Powder 95% Curcumin?', 1, '2021-05-24 01:17:54', '2021-05-24 01:30:09'),
(3, 'pure', 2, 'pure', NULL, NULL, 1, '2021-05-24 01:31:07', '2021-05-24 04:01:41'),
(4, 'milk powder', 0, 'milk powder', '1621850544.jpg', 'DANO Power is full cream milk powder which includes all natural source of milk and it is natural str', 1, '2021-05-24 04:02:24', '2021-05-24 04:02:24'),
(5, 'bike', 0, 'bike', '1621918436.jpg', 'Scooters in Bangladesh are a great way to travel. For the best two wheeler motorcycles and online tw', 1, '2021-05-24 22:53:56', '2021-05-24 22:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_postcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_email`, `company_phone`, `company_logo`, `company_address`, `country`, `company_city`, `company_state`, `company_postcode`, `created_at`, `updated_at`) VALUES
(1, 'innovative', 'innovative@gmail.com', '012369825', '1622627885.png', 'kuril dhaka', 'Bangladesh', 'Uttara', 'Dhaka', '1900', '2021-05-24 00:18:40', '2021-06-02 03:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `country`, `state`, `city`, `postcode`, `status`, `created_at`, `updated_at`) VALUES
(1, 'nahid', '0156369542', 'nahid@gmail.com', 'Mohakhali, Dhaka 1212, Bangladesh', 'bangladesh', 'uttra', 'dhaka', '1400', 1, '2021-05-24 00:47:12', '2021-05-24 00:47:12'),
(2, 'allu arjun', '014789652', 'allu@gmail.com', 'india,tamil nadu state', 'India', 'kali', 'tamil nadu', '45456', 1, '2021-05-24 00:48:58', '2021-05-24 00:48:58'),
(3, 'mijan', '0236541636', 'mijan@gmail.com', 'Kuratoli Al-Noor Jame Masjid', 'Bangladesh', 'Dhaka', 'Uttara', '1900', 1, '2021-05-24 01:04:12', '2021-05-24 01:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `expense_amounts`
--

CREATE TABLE `expense_amounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_date` date NOT NULL,
  `expense_amount` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_amounts`
--

INSERT INTO `expense_amounts` (`id`, `expense_date`, `expense_amount`, `category_id`, `warehouse_id`, `note`, `attachment`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, '2021-05-24', '1000', 1, 1, NULL, '1621849399.webp', 1, 1, '2021-05-24 03:43:19', '2021-05-24 03:43:19'),
(2, '2021-05-24', '2000', 2, 3, NULL, '1622107165.jpg', 1, 1, '2021-05-24 03:55:21', '2021-05-27 03:19:25'),
(3, '2021-05-27', '15000', 2, 2, 'ghfc', '1621934201.jpg', 1, 1, '2021-05-25 03:16:41', '2021-05-27 03:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DANO', 1, '2021-05-24 01:18:57', '2021-05-24 01:18:57'),
(2, 'Marks', 1, '2021-05-24 01:19:25', '2021-05-24 01:19:25'),
(3, 'nido', 1, '2021-05-24 01:19:41', '2021-05-24 01:19:41');

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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(133, '2014_10_12_000000_create_users_table', 1),
(134, '2014_10_12_100000_create_password_resets_table', 1),
(135, '2019_08_19_000000_create_failed_jobs_table', 1),
(136, '2021_02_01_103020_create_products_table', 1),
(137, '2021_02_01_115847_create_product_warehouses_table', 1),
(138, '2021_02_02_033046_create_companies_table', 1),
(139, '2021_02_02_034928_create_customers_table', 1),
(140, '2021_02_02_035522_create_suppliers_table', 1),
(141, '2021_02_02_035704_create_brands_table', 1),
(142, '2021_02_02_040451_create_units_table', 1),
(143, '2021_02_02_040926_create_varients_table', 1),
(144, '2021_02_02_043548_create_categories_table', 1),
(145, '2021_02_02_051327_create_taxrates_table', 1),
(146, '2021_02_02_053055_create_warehouses_table', 1),
(147, '2021_02_02_055524_create_expense_categories_table', 1),
(148, '2021_02_02_055811_create_billers_table', 1),
(149, '2021_02_07_073847_create_expense_amounts_table', 1),
(150, '2021_02_09_095902_create_product_varients_table', 1),
(151, '2021_02_15_051101_create_purchases_table', 1),
(152, '2021_02_15_080222_create_temporary_purchases_table', 1),
(153, '2021_02_15_080306_create_purchase_items_table', 1),
(154, '2021_02_27_040410_create_sales_table', 1),
(155, '2021_02_27_041053_create_sale_items_table', 1),
(156, '2021_02_27_041119_create_temprary_sale_items_table', 1),
(157, '2021_03_01_114953_create_supplier_payments_table', 1),
(158, '2021_04_01_052140_create_sale_vat_temps_table', 1),
(159, '2021_04_01_052230_create_sale_discount_temps_table', 1),
(160, '2021_04_05_090354_create_purchase_discount_temps_table', 1),
(161, '2021_04_05_090422_create_purchase_vat_temps_table', 1),
(162, '2021_04_10_025259_create_quotations_table', 1),
(163, '2021_04_10_032624_create_quotation_items_table', 1),
(164, '2021_05_02_053310_create_sell_product_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_cost` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` decimal(18,2) DEFAULT NULL,
  `product_alert_qty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_weight` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_brand` bigint(20) UNSIGNED DEFAULT NULL,
  `product_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_subcat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_details_invoice` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_type`, `product_name`, `product_code`, `product_slug`, `product_cost`, `product_price`, `product_alert_qty`, `product_weight`, `product_image`, `product_qty`, `tax_rate_id`, `product_brand`, `product_cat_id`, `product_subcat_id`, `product_unit_id`, `product_details`, `product_details_invoice`, `created_at`, `updated_at`) VALUES
(1, 'Standard', 'Maida', 'code-1', 'maida', '90', '100.00', '10', NULL, '1621841972.webp', NULL, 2, 1, 1, NULL, 2, '1. Home delivery inside and outside Dhaka, from specific area shops to specific area\r\n2. The custome', NULL, '2021-05-24 01:39:32', '2021-05-24 01:39:32'),
(2, 'Standard', 'milk powder', 'code-2', 'milk powder', '200', '250.00', '100', '500gm', '1621850656.png', NULL, NULL, 2, 4, NULL, NULL, 'DANO Power is full cream milk powder which includes all natural source of milk and it is natural str', NULL, '2021-05-24 04:04:16', '2021-05-24 04:05:29'),
(3, 'Digital', 'Hero bike', 'code-3', 'hero bike', '150000', '200000.00', '10', NULL, '1621918543.jpg', NULL, 1, 4, 5, NULL, 3, NULL, NULL, '2021-05-24 22:55:43', '2021-05-24 22:55:43'),
(4, 'Standard', 'palser', 'code-4', 'palser', '200000', '220000.00', '10', NULL, '1621918970.jpg', NULL, 2, 2, 5, NULL, 3, 'Scooters in Bangladesh are a great way to travel. For the best two wheeler motorcycles and online tw', NULL, '2021-05-24 23:02:50', '2021-05-25 03:40:18'),
(5, 'Standard', 'laptop', 'code-5', 'laptop', '10000', '15000.00', '10', NULL, '1621937739.jpg', NULL, NULL, 2, 4, NULL, NULL, 'Buy laptop at Lowest price guaranteed in Bangladesh. All popular Laptop brands including Macbook, HP', NULL, '2021-05-25 04:15:39', '2021-05-25 04:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_varients`
--

CREATE TABLE `product_varients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `varient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price_addition` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alert_qty` bigint(20) NOT NULL DEFAULT 0,
  `variant_rack` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_varients`
--

INSERT INTO `product_varients` (`id`, `product_id`, `varient_id`, `warehouse_id`, `price_addition`, `qty`, `alert_qty`, `variant_rack`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, 3, 3, NULL, '103', 100, 'No Rack', 1, '2021-05-24 04:05:29', '2021-05-24 04:05:29'),
(7, 4, 3, 2, '20000', '226', 10, '10', 1, '2021-05-25 03:40:18', '2021-05-25 03:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouses`
--

CREATE TABLE `product_warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `varient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `alert_qty` bigint(20) NOT NULL DEFAULT 0,
  `racks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_warehouses`
--

INSERT INTO `product_warehouses` (`id`, `product_id`, `warehouse_id`, `varient_id`, `qty`, `alert_qty`, `racks`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, 121, 10, 'No Rack', '2021-05-24 01:39:32', '2021-05-24 01:39:32'),
(5, 2, 3, 3, 103, 100, 'No Rack', '2021-05-24 04:05:29', '2021-05-24 04:05:29'),
(6, 3, 2, NULL, 111, 10, 'No Rack', '2021-05-24 22:55:43', '2021-05-24 22:55:43'),
(9, 4, 2, 3, 226, 10, '10', '2021-05-25 03:40:18', '2021-05-25 03:40:18'),
(10, 5, 2, NULL, 101, 10, 'No Rack', '2021-05-25 04:15:39', '2021-05-25 04:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_vat_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_discount_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchased_by` bigint(20) UNSIGNED NOT NULL,
  `order_total_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_due` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `purchase_date`, `purchase_vat`, `purchase_vat_amount`, `purchase_discount`, `purchase_discount_amount`, `purchase_note`, `purchased_by`, `order_total_price`, `total_price`, `total_payment`, `total_due`, `status`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 3, '2021-05-24', '0', '0', '0', '0', NULL, 1, NULL, '1000', '1000', '0', 'Received', 'Paid', '2021-05-24 01:44:09', '2021-05-24 23:17:02'),
(2, 3, '2021-05-24', '0', '0', '0', '0', NULL, 1, NULL, '100', '100', '0', 'Received', 'Paid', '2021-05-24 01:47:19', '2021-05-24 23:17:02'),
(3, 3, '2021-05-24', '0', '0', '0', '0', NULL, 1, NULL, '500', '500', '0', 'Received', 'Due', '2021-05-24 04:06:01', '2021-05-31 05:16:10'),
(4, 1, '2021-05-24', '0', '0', '0', '0', NULL, 1, NULL, '100', '100', '0', 'Received', 'Paid', '2021-05-24 04:48:49', '2021-05-24 05:31:08'),
(5, 3, '2021-05-25', '10', '44000', '10', '44000', NULL, 1, NULL, '440000', '240000', '200000', 'Received', 'Paid', '2021-05-24 23:08:14', '2021-05-31 05:16:10'),
(6, 3, '2021-05-25', '5', '1188000', '10', '2376000', NULL, 1, NULL, '22572000', '22572000', '0', 'Received', 'Paid', '2021-05-25 01:29:24', '2021-05-25 01:29:24'),
(7, 2, '2021-05-25', '0', '0', '0', '0', NULL, 1, NULL, '240000', '240000', '0', 'Received', 'Paid', '2021-05-25 03:24:42', '2021-05-25 03:24:42'),
(8, 3, '2021-05-27', '5', '220000', '5', '220000', NULL, 1, NULL, '4400000', '4400000', '0', 'Received', 'Paid', '2021-05-27 00:44:24', '2021-05-27 00:44:24'),
(9, 2, '2021-05-27', '0', '0', '0', '0', NULL, 1, NULL, '15000', '0', '15000', 'Pending', 'Paid', '2021-05-27 01:00:14', '2021-05-31 05:13:22'),
(10, 1, '2021-05-31', '10', '360000', '0', '0', NULL, 1, NULL, '3960000', '3960000', '0', 'Received', 'Paid', '2021-05-31 04:54:05', '2021-05-31 04:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_discount_temps`
--

CREATE TABLE `purchase_discount_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount_amount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchased_by` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `warehouse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `supplier_id`, `purchase_date`, `purchased_by`, `warehouse_id`, `warehouse`, `product_id`, `product`, `product_price`, `code`, `cost`, `tax`, `tax_rate_id`, `tax_rate_type`, `varient_id`, `varient`, `varient_price`, `total_qty`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2021-05-24', 1, 3, 'Atta', 1, 'Maida', '100.00', 'code-1', '90', '5', '2', '1', '', '', '0', '10', '1000', '2021-05-24 01:44:09', '2021-05-24 01:44:09'),
(2, 2, 3, '2021-05-24', 1, 3, 'Atta', 1, 'Maida', '100.00', 'code-1', '90', '5', '2', '1', '', '', '0', '10', '100', '2021-05-24 01:47:19', '2021-05-24 01:47:19'),
(3, 3, 3, '2021-05-24', 1, 3, 'Atta', 2, 'milk powder', '250.00', 'code-2', '200', '0', '0', '0', '3', 'Rice', NULL, '2', '500', '2021-05-24 04:06:01', '2021-05-24 04:06:01'),
(4, 4, 1, '2021-05-24', 1, 3, 'Atta', 1, 'Maida', '100.00', 'code-1', '90', '5', '2', '1', '', '', '0', '1', '100', '2021-05-24 04:48:49', '2021-05-24 04:48:49'),
(5, 5, 3, '2021-05-25', 1, 2, 'Hero', 3, 'Hero bike', '200000.00', 'code-3', '150000', '10', '1', '0', '', '', '0', '1', '240000', '2021-05-24 23:08:14', '2021-05-24 23:08:14'),
(6, 5, 3, '2021-05-25', 1, 2, 'Hero', 4, 'palser', '220000.00', 'code-4', '200000', '5', '2', '1', '3', 'Rice', '20000', '1', '200000', '2021-05-24 23:08:14', '2021-05-24 23:08:14'),
(7, 6, 3, '2021-05-25', 1, 2, 'Hero', 4, 'palser', '220000.00', 'code-4', '200000', '5', '2', '1', '3', 'Rice', '20000', '99', '23760000', '2021-05-25 01:29:24', '2021-05-25 01:29:24'),
(8, 7, 2, '2021-05-25', 1, 2, 'Hero', 4, 'palser', '220000.00', 'code-4', '200000', '5', '2', '1', '3', 'Rice', '20000', '1', '240000', '2021-05-25 03:24:42', '2021-05-25 03:24:42'),
(9, 8, 3, '2021-05-27', 1, 2, 'Hero', 4, 'palser', '220000.00', 'code-4', '200000', '5', '2', '1', '3', 'Rice', '20000', '10', '2000000', '2021-05-27 00:44:24', '2021-05-27 00:44:24'),
(10, 8, 3, '2021-05-27', 1, 2, 'Hero', 3, 'Hero bike', '200000.00', 'code-3', '150000', '100', '1', '0', '', '', '0', '10', '2400000', '2021-05-27 00:44:24', '2021-05-27 00:44:24'),
(11, 9, 2, '2021-05-27', 1, 2, 'Hero', 5, 'laptop', '15000.00', 'code-5', '10000', '0', '0', '0', '', '', '0', '1', '15000', '2021-05-27 01:00:14', '2021-05-27 01:00:14'),
(12, 10, 1, '2021-05-31', 1, 2, 'Hero', 4, 'palser', '220000.00', 'code-4', '200000', '5', '2', '1', '3', 'Rice', '20000', '15', '3600000', '2021-05-31 04:54:05', '2021-05-31 04:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_vat_temps`
--

CREATE TABLE `purchase_vat_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vat_amount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quotation_date` date NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biller_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `tax_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `shipping` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

CREATE TABLE `quotation_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quotation_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variant_price` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_tax` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `sub_total` decimal(18,2) NOT NULL,
  `quotation_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `biller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_date` date NOT NULL,
  `sale_vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_vat_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_discount_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_by` bigint(20) UNSIGNED NOT NULL,
  `sale_total_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_due` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `biller_id`, `sale_date`, `sale_vat`, `sale_vat_amount`, `sale_discount`, `sale_discount_amount`, `sale_note`, `sale_by`, `sale_total_price`, `total_price`, `total_payment`, `total_due`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2021-05-03', '10', '100', '20', '200', 'dfzx', 1, '1000', '900', '900', '0', 'visa', '1', '2021-05-24 03:28:19', '2021-05-24 03:28:19'),
(2, 1, NULL, '2021-05-03', '0', '0', '0', '0', NULL, 1, '1250', '1250', '1200', '50', 'bKash', '1', '2021-05-24 04:06:29', '2021-05-24 04:06:29'),
(3, 1, NULL, '2021-05-03', '0', '0', '0', '0', NULL, 1, '2500', '2500', '2500', '0', 'bKash', '1', '2021-05-24 04:07:07', '2021-05-24 04:07:07'),
(4, 2, NULL, '2021-05-03', '0', '0', '0', '0', NULL, 1, '600', '600', '1000', '-400', 'bKash', '1', '2021-05-24 05:02:03', '2021-05-24 05:02:03'),
(5, 1, NULL, '2021-05-03', '10', '23500', '0', '0', 'Google\'s free service instantly translates words, phrases, and web pages between English and', 1, '235000', '258500', '235000', '23500', 'bKash', '1', '2021-05-27 00:35:01', '2021-05-27 00:35:01'),
(6, 3, NULL, '2021-05-27', '10', '43500', '0', '0', 'Google\'s free service instantly translates words, phrases, and web pages between English and', 1, '435000', '478500', '478500', '0', 'bKash', '1', '2021-05-27 00:36:21', '2021-05-27 00:36:21'),
(7, 3, NULL, '2021-05-27', '0', '0', '25', '55062.5', 'tyedtyert', 1, '220250', '165187.5', '65188', '99999.5', 'master', '1', '2021-05-27 03:57:26', '2021-05-27 03:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `sale_discount_temps`
--

CREATE TABLE `sale_discount_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount_amount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `biller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sales_date` date DEFAULT NULL,
  `sales_by` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `warehouse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sales_id`, `customer_id`, `biller_id`, `sales_date`, `sales_by`, `warehouse_id`, `warehouse`, `product_id`, `product`, `product_price`, `code`, `cost`, `tax`, `tax_rate_id`, `tax_rate_type`, `varient_id`, `varient`, `varient_price`, `total_qty`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 1, 3, 'Atta', 1, 'Maida', '100.00', 'code-1', '90', NULL, NULL, NULL, NULL, NULL, NULL, '10', '1000', '2021-05-24 03:28:19', '2021-05-24 03:28:19'),
(2, 2, 1, NULL, NULL, 1, 3, 'Atta', 2, 'milk powder', '250.00', 'code-2', '200', NULL, NULL, NULL, NULL, NULL, NULL, '5', '1250', '2021-05-24 04:06:29', '2021-05-24 04:06:29'),
(3, 3, 1, NULL, NULL, 1, 3, 'Atta', 2, 'milk powder', '250.00', 'code-2', '200', NULL, NULL, NULL, NULL, NULL, NULL, '10', '2500', '2021-05-24 04:07:07', '2021-05-24 04:07:07'),
(4, 4, 2, NULL, NULL, 1, 3, 'Atta', 1, 'Maida', '100.00', 'code-1', '90', NULL, NULL, NULL, NULL, NULL, NULL, '6', '600', '2021-05-24 05:02:03', '2021-05-24 05:02:03'),
(5, 5, 1, NULL, NULL, 1, 2, 'Hero', 4, 'palser', '220000.00', 'code-4', '200000', NULL, NULL, NULL, NULL, NULL, NULL, '1', '220000', '2021-05-27 00:35:01', '2021-05-27 00:35:01'),
(6, 5, 1, NULL, NULL, 1, 2, 'Hero', 5, 'laptop', '15000.00', 'code-5', '10000', NULL, NULL, NULL, NULL, NULL, NULL, '1', '15000', '2021-05-27 00:35:01', '2021-05-27 00:35:01'),
(7, 6, 3, NULL, NULL, 1, 2, 'Hero', 3, 'Hero bike', '200000.00', 'code-3', '150000', NULL, NULL, NULL, NULL, NULL, NULL, '1', '200000', '2021-05-27 00:36:21', '2021-05-27 00:36:21'),
(8, 6, 3, NULL, NULL, 1, 2, 'Hero', 4, 'palser', '220000.00', 'code-4', '200000', NULL, NULL, NULL, NULL, NULL, NULL, '1', '220000', '2021-05-27 00:36:21', '2021-05-27 00:36:21'),
(9, 6, 3, NULL, NULL, 1, 2, 'Hero', 5, 'laptop', '15000.00', 'code-5', '10000', NULL, NULL, NULL, NULL, NULL, NULL, '1', '15000', '2021-05-27 00:36:21', '2021-05-27 00:36:21'),
(10, 7, 3, NULL, NULL, 1, 3, 'Atta', 2, 'milk powder', '250.00', 'code-2', '200', NULL, NULL, NULL, NULL, NULL, NULL, '1', '250', '2021-05-27 03:57:26', '2021-05-27 03:57:26'),
(11, 7, 3, NULL, NULL, 1, 2, 'Hero', 4, 'palser', '220000.00', 'code-4', '200000', NULL, NULL, NULL, NULL, NULL, NULL, '1', '220000', '2021-05-27 03:57:26', '2021-05-27 03:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `sale_vat_temps`
--

CREATE TABLE `sale_vat_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vat_amount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sell_product`
--

CREATE TABLE `sell_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_phone`, `supplier_email`, `supplier_address`, `country`, `state`, `city`, `postcode`, `status`, `created_at`, `updated_at`) VALUES
(1, 'atoz online shop', '01365456503', 'atoz@gmail.com', 'ncorporated as a municipality in 1876, it is a trade centre, most notably for rice, jute, and fish.', 'barisal', 'potuakhali', 'putuakhali', '1231', 1, '2021-05-24 00:21:28', '2021-05-24 00:21:28'),
(2, 'innovative agro', '0195852565', 'agro@gmail.com', 'Umme Kulsum Road, Bashundhara R/A, Dhaka-1229', 'bangladesh', 'batara', 'dhaka', '1200', 1, '2021-05-24 00:41:38', '2021-05-24 00:41:38'),
(3, 'evaly', '01732569825', 'evaly@gmail.com', 'House #8, Road # 14,\r\nDhanmondi, Dhaka-1209.', 'bangladesh', 'dhanmondi', 'dhaka', '1500', 1, '2021-05-24 00:44:45', '2021-05-24 00:44:45'),
(4, 'onik', '01213658502', 'onik@email.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the', 'briten', 'bari', 'bro', '123', 1, '2021-06-02 04:00:49', '2021-06-02 04:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_invoice_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `total_purchase` decimal(18,2) NOT NULL,
  `total_payment` decimal(18,2) NOT NULL,
  `total_due` decimal(18,2) NOT NULL,
  `payment_amount` decimal(18,2) NOT NULL,
  `payment_by` bigint(20) UNSIGNED NOT NULL,
  `bkash_trx_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bkash_acc_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bkash_payment_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_acc_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_payment_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_payments`
--

INSERT INTO `supplier_payments` (`id`, `purchase_invoice_id`, `supplier_id`, `payment_date`, `total_purchase`, `total_payment`, `total_due`, `payment_amount`, `payment_by`, `bkash_trx_id`, `bkash_acc_no`, `bkash_payment_amount`, `bank_acc_no`, `bank_payment_amount`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2021-05-24', '100.00', '100.00', '0.00', '100.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-24 05:31:08', '2021-05-24 05:31:08'),
(2, 1, 3, '2021-05-25', '1000.00', '1000.00', '0.00', '100.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-24 23:17:02', '2021-05-24 23:17:02'),
(3, 2, 3, '2021-05-25', '100.00', '100.00', '0.00', '100.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-24 23:17:02', '2021-05-24 23:17:02'),
(4, 3, 3, '2021-05-25', '500.00', '0.00', '500.00', '0.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-24 23:17:02', '2021-05-24 23:17:02'),
(5, 5, 3, '2021-05-25', '440000.00', '0.00', '440000.00', '0.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-24 23:17:02', '2021-05-24 23:17:02'),
(6, 3, 3, '2021-05-25', '500.00', '0.00', '500.00', '0.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-24 23:20:38', '2021-05-24 23:20:38'),
(7, 5, 3, '2021-05-25', '440000.00', '40000.00', '400000.00', '40000.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-24 23:20:38', '2021-05-24 23:20:38'),
(8, 3, 3, '2021-05-23', '500.00', '0.00', '500.00', '0.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Due', '2021-05-24 23:23:12', '2021-05-24 23:23:12'),
(9, 5, 3, '2021-05-23', '440000.00', '240000.00', '200000.00', '200000.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-24 23:23:12', '2021-05-24 23:23:12'),
(10, 10, 1, '2021-05-31', '3960000.00', '3960000.00', '0.00', '3960000.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-31 04:54:40', '2021-05-31 04:54:40'),
(11, 9, 2, '2021-05-31', '15000.00', '0.00', '15000.00', '0.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-31 05:13:22', '2021-05-31 05:13:22'),
(12, 3, 3, '2021-05-31', '500.00', '500.00', '0.00', '500.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Due', '2021-05-31 05:16:10', '2021-05-31 05:16:10'),
(13, 5, 3, '2021-05-31', '440000.00', '240000.00', '200000.00', '0.00', 1, NULL, NULL, NULL, NULL, NULL, 'Cash', 'Paid', '2021-05-31 05:16:10', '2021-05-31 05:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `taxrates`
--

CREATE TABLE `taxrates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxrates`
--

INSERT INTO `taxrates` (`id`, `name`, `type`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, '1000', '0', '100', 1, '2021-05-24 01:07:51', '2021-05-25 03:59:25'),
(2, '100', '1', '5', 1, '2021-05-24 01:10:03', '2021-05-24 01:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `temporary_purchases`
--

CREATE TABLE `temporary_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `stock_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temprary_sale_items`
--

CREATE TABLE `temprary_sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `stock_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_rate_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varient_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_value` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `unit_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'litter', '5Lit', 1, '2021-05-24 01:05:43', '2021-05-24 01:13:51'),
(2, 'Kg', '5', 1, '2021-05-24 01:14:05', '2021-05-24 01:14:05'),
(3, 'pcs', '1', 1, '2021-05-24 22:52:07', '2021-05-24 22:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@email.com', NULL, '$2y$10$SPM.3OCiia2dCxa6nQAay.chPjY5C3asG1zCStLPzQ9imTsTe7mTa', NULL, '2021-05-24 00:09:58', '2021-05-24 00:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `varients`
--

CREATE TABLE `varients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `varient_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `varients`
--

INSERT INTO `varients` (`id`, `varient_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'oil', 1, '2021-05-24 01:06:35', '2021-05-27 03:54:44'),
(2, 'salt', 1, '2021-05-24 01:06:51', '2021-05-24 01:06:51'),
(3, 'Rice', 1, '2021-05-24 01:07:17', '2021-05-27 03:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `phone`, `email`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nokia', '012456958', 'Nokia@gmail.com', 'bandarban', 1, '2021-05-24 01:25:43', '2021-05-24 01:25:43'),
(2, 'Hero', '12546', 'Hero@gmail.com', 'Dhaka,khekhet', 1, '2021-05-24 01:27:29', '2021-05-24 01:27:29'),
(3, 'Atta', '3658220', 'Atta@gmail.com', 'khulna', 1, '2021-05-24 01:29:02', '2021-05-24 01:29:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billers`
--
ALTER TABLE `billers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_amounts`
--
ALTER TABLE `expense_amounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_varients`
--
ALTER TABLE `product_varients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_warehouses`
--
ALTER TABLE `product_warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_discount_temps`
--
ALTER TABLE `purchase_discount_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_vat_temps`
--
ALTER TABLE `purchase_vat_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_discount_temps`
--
ALTER TABLE `sale_discount_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_vat_temps`
--
ALTER TABLE `sale_vat_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_product`
--
ALTER TABLE `sell_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxrates`
--
ALTER TABLE `taxrates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_purchases`
--
ALTER TABLE `temporary_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temprary_sale_items`
--
ALTER TABLE `temprary_sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `varients`
--
ALTER TABLE `varients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billers`
--
ALTER TABLE `billers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense_amounts`
--
ALTER TABLE `expense_amounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_varients`
--
ALTER TABLE `product_varients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_warehouses`
--
ALTER TABLE `product_warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase_discount_temps`
--
ALTER TABLE `purchase_discount_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_vat_temps`
--
ALTER TABLE `purchase_vat_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_items`
--
ALTER TABLE `quotation_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_discount_temps`
--
ALTER TABLE `sale_discount_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sale_vat_temps`
--
ALTER TABLE `sale_vat_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sell_product`
--
ALTER TABLE `sell_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `taxrates`
--
ALTER TABLE `taxrates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temporary_purchases`
--
ALTER TABLE `temporary_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `temprary_sale_items`
--
ALTER TABLE `temprary_sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `varients`
--
ALTER TABLE `varients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
