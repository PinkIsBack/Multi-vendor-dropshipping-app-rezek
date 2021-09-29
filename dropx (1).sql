-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 04:53 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dropx`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `img`, `created_at`, `updated_at`) VALUES
(5, 'Autem eaque ut dolor', 'Dolor dolorem cillum', '/images/category/dropbox.png', '2021-08-04 03:38:39', '2021-08-04 03:38:39'),
(6, 'AK', 'ak', '/images/category/headphones.png', '2021-08-04 05:42:25', '2021-08-04 06:28:30'),
(7, 'Products', 'product', '/images/category/WhatsApp Image 2021-08-13 at 10.44.png', '2021-08-26 07:56:18', '2021-08-26 07:56:18'),
(8, 'Mobile', 'mobile', '/images/category/Mg-Cal_720x.png', '2021-08-26 07:57:15', '2021-08-26 07:57:15'),
(9, 'Cloths', 'cloth', '/images/category/WhatsApp Image 2021-08-13 at 10.44.png', '2021-08-26 07:57:36', '2021-08-26 07:57:36'),
(10, 'Electronics', 'Elec', '/images/category/ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', '2021-08-26 07:58:15', '2021-08-26 07:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` int(10) UNSIGNED NOT NULL,
  `charge_id` bigint(20) NOT NULL,
  `test` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `interval` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capped_amount` decimal(8,2) DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL,
  `billing_on` timestamp NULL DEFAULT NULL,
  `activated_on` timestamp NULL DEFAULT NULL,
  `trial_ends_on` timestamp NULL DEFAULT NULL,
  `cancelled_on` timestamp NULL DEFAULT NULL,
  `expires_on` timestamp NULL DEFAULT NULL,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_charge` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Lahore', 1, '2021-08-24 09:25:15', '2021-08-24 09:25:15'),
(2, 'Multan...', 1, '2021-08-24 09:25:15', '2021-08-25 01:27:10'),
(3, 'Dunyapur', 1, '2021-08-24 09:25:15', '2021-08-24 09:25:15');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE `finances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `no_products` int(11) DEFAULT NULL,
  `cost_products` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cost_shipping` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `paid_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`id`, `created_at`, `updated_at`, `order_id`, `supplier_id`, `no_products`, `cost_products`, `cost_shipping`, `paid_at`, `description`, `is_paid`, `status`) VALUES
(1, NULL, '2021-09-23 07:32:28', 21, 10, 2, '22', '59', '2021-09-23 12:32:28', NULL, 1, 0),
(2, '2021-09-23 00:44:20', '2021-09-24 01:45:53', 22, 10, 1, '627', '12', '2021-09-24 06:45:53', NULL, 1, 0),
(3, '2021-09-23 02:13:38', '2021-09-23 07:33:09', 22, 13, 1, '12', '12', '2021-09-23 12:33:09', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `finance_logs`
--

CREATE TABLE `finance_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finance_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finance_logs`
--

INSERT INTO `finance_logs` (`id`, `created_at`, `updated_at`, `title`, `description`, `finance_id`, `order_id`) VALUES
(3, '2021-09-23 06:10:12', '2021-09-23 06:10:12', 'Order Paid', 'Order ZA22 has been paid amount of 627 at 2021-09-23 11:10:12', 2, 22),
(4, '2021-09-23 06:10:12', '2021-09-23 06:10:12', 'Order fulfilled', 'Order ZA22 has been fulfilled at 2021-09-23 11:10:12', 2, 22),
(5, '2021-09-23 06:10:12', '2021-09-23 06:10:12', 'Shipping Charges Added', 'Order ZA22 has been shipped with amount of 12', 2, 22),
(6, '2021-09-23 07:15:00', '2021-09-23 07:15:00', 'Shipping Updated', 'Shipping amount set as 12 USD at 2021-09-23 12:15:00', 1, 21),
(7, '2021-09-23 07:15:45', '2021-09-23 07:15:45', 'Shipping Updated', 'Shipping amount set as 1 USD at 2021-09-23 12:15:45', 1, 21),
(8, '2021-09-23 07:32:28', '2021-09-23 07:32:28', 'Admin Paid', 'Order ZA21 has been paid by Admin at2021-09-23 12:32:28', 1, 21),
(9, '2021-09-23 07:33:09', '2021-09-23 07:33:09', 'Admin Paid', 'Order ZA22 has been paid by Admin at2021-09-23 12:33:09', 3, 22),
(10, '2021-09-23 08:20:29', '2021-09-23 08:20:29', 'Shipping Updated', 'Shipping amount set as 12 USD at 2021-09-23 13:20:29', 3, 22),
(11, '2021-09-23 08:20:37', '2021-09-23 08:20:37', 'Shipping Updated', 'Shipping amount set as 6 USD at 2021-09-23 13:20:37', 3, 22),
(12, '2021-09-24 01:45:53', '2021-09-24 01:45:53', 'Admin Paid', 'Order ZA22 has been paid by Admin at 2021-09-24 06:45:53', 2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `fulfillment_line_items`
--

CREATE TABLE `fulfillment_line_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fulfilled_quantity` int(11) DEFAULT NULL,
  `order_fulfillment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_line_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fulfillment_line_items`
--

INSERT INTO `fulfillment_line_items` (`id`, `fulfilled_quantity`, `order_fulfillment_id`, `order_line_item_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 25, '2021-09-17 02:59:09', '2021-09-17 02:59:09'),
(2, 1, 1, 26, '2021-09-17 02:59:09', '2021-09-17 02:59:09'),
(3, 1, 1, 27, '2021-09-17 02:59:09', '2021-09-17 02:59:09'),
(4, 1, 2, 29, '2021-09-17 09:43:20', '2021-09-17 09:43:20'),
(5, 1, 3, 29, '2021-09-17 09:50:12', '2021-09-17 09:50:12'),
(6, 1, 8, 34, '2021-09-21 09:03:03', '2021-09-21 09:03:03'),
(7, 1, 9, 36, '2021-09-21 09:40:37', '2021-09-21 09:40:37'),
(8, 1, 9, 37, '2021-09-21 09:40:37', '2021-09-21 09:40:37'),
(9, 1, 10, 38, '2021-09-23 02:13:38', '2021-09-23 02:13:38'),
(10, 1, 10, 39, '2021-09-23 02:13:38', '2021-09-23 02:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_customers`
--

CREATE TABLE `merchant_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_shopify_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_spent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addresses` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_customers`
--

INSERT INTO `merchant_customers` (`id`, `customer_shopify_id`, `first_name`, `last_name`, `total_spent`, `phone`, `email`, `addresses`, `shop_id`, `created_at`, `updated_at`) VALUES
(5, '5530850361496', 'Test', 'Kanwar', '815.48', NULL, 'test@gmail.com', NULL, 7, '2021-08-24 05:57:59', '2021-08-24 05:57:59'),
(6, '5444513235140', 'Afeef', 'Ali', '283.37', NULL, 'afeef.ali@tetralogicx.com', NULL, 9, '2021-09-14 06:28:39', '2021-09-14 06:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_line_items`
--

CREATE TABLE `merchant_line_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_order_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_product_variant_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopify_product_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopify_variant_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `variant_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fulfilled_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requires_shipping` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxable` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fulfillable_quantity` int(11) DEFAULT NULL,
  `fulfillment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `dropship_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `linked_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `linked_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `supplier_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `margin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_supplier_fulfill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_line_items`
--

INSERT INTO `merchant_line_items` (`id`, `merchant_order_id`, `merchant_product_variant_id`, `shopify_product_id`, `shopify_variant_id`, `title`, `quantity`, `variant_title`, `sku`, `vendor`, `price`, `fulfilled_by`, `requires_shipping`, `taxable`, `name`, `properties`, `fulfillable_quantity`, `fulfillment_status`, `cost`, `dropship_variant_id`, `linked_product_id`, `linked_variant_id`, `created_at`, `updated_at`, `supplier_price`, `margin`, `is_supplier_fulfill`, `supplier_id`) VALUES
(13, '8', '10300289548440', '6967144087704', '40770289664152', 'New Shirt', 1, 'black / m', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '627.00', 'ZADropship', '1', 1, 'New Shirt - black / m', '[]', 1, NULL, 627, NULL, NULL, NULL, '2021-08-24 05:57:59', '2021-08-24 05:57:59', '0', '0', '0', NULL),
(14, '8', '10300289581208', '6967146348696', '40770307293336', 'Qui ad dolore sequi', 1, '30', 'Qui eveniet quam di', 'Duis eu tempore adi', '36.00', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 30', '[]', 1, NULL, 36, NULL, NULL, NULL, '2021-08-24 05:57:59', '2021-08-24 05:57:59', '0', '0', '0', NULL),
(15, '8', '10300289613976', '6967142711448', '40770284814488', 'shirt', 1, 'white / m', '123', 'kjkk', '20.00', 'ZADropship', '1', 1, 'shirt - white / m', '[]', 1, NULL, 12, NULL, NULL, NULL, '2021-08-24 05:57:59', '2021-08-24 05:57:59', '0', '0', '0', NULL),
(16, '9', '10300287484056', '6967143661720', '40770287468696', 'Kanwar', 2, '', '123', 'kanwar', '10.00', 'ZADropship', '1', 1, 'Kanwar', '[]', 2, NULL, 10, NULL, NULL, NULL, '2021-08-24 05:57:59', '2021-08-24 05:57:59', '0', '0', '0', NULL),
(17, '10', '10424864833732', '6880600588484', '40620951503044', 'Qui ad dolore sequi', 1, '60', 'Qui eveniet quam di', 'Duis eu tempore adi', '39.60', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 60', '[]', 1, NULL, 39.6, NULL, NULL, NULL, '2021-09-14 06:28:39', '2021-09-14 06:28:39', '0', '0', '0', NULL),
(18, '11', '10424864833732', '6880600588484', '40620951503044', 'Qui ad dolore sequi', 1, '60', 'Qui eveniet quam di', 'Duis eu tempore adi', '39.60', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 60', '[]', 1, NULL, 39.6, NULL, NULL, NULL, '2021-09-14 07:22:13', '2021-09-14 07:22:13', '0', '0', '0', NULL),
(19, '12', '10424864833732', '6880600588484', '40620951503044', 'Qui ad dolore sequi', 1, '60', 'Qui eveniet quam di', 'Duis eu tempore adi', '39.60', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 60', '[]', 1, NULL, 39.6, NULL, NULL, NULL, '2021-09-14 07:23:32', '2021-09-14 07:23:32', '0', '0', '0', NULL),
(20, '13', '10424864833732', '6880600588484', '40620951503044', 'Qui ad dolore sequi', 1, '60', 'Qui eveniet quam di', 'Duis eu tempore adi', '39.60', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 60', '[]', 1, NULL, 39.6, NULL, NULL, NULL, '2021-09-14 07:24:15', '2021-09-14 07:24:15', '0', '0', '0', NULL),
(21, '14', '10428181774532', '6881936867524', '40627817251012', 'Qui ad dolore sequi', 1, '30', 'Qui eveniet quam di', 'Duis eu tempore adi', '39.60', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 30', '[]', 1, NULL, 39.6, NULL, 23, 438, '2021-09-15 03:39:46', '2021-09-15 03:39:46', '10', '0', '0', '9'),
(22, '14', '10428181807300', '6881936867524', '40627817283780', 'Qui ad dolore sequi', 1, '60', 'Qui eveniet quam di', 'Duis eu tempore adi', '39.60', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 60', '[]', 1, NULL, 39.6, NULL, 23, 439, '2021-09-15 03:39:46', '2021-09-15 03:39:46', '12', '0', '1', '10'),
(23, '15', '10428181774532', '6881936867524', '40627817251012', 'Qui ad dolore sequi', 1, '30', 'Qui eveniet quam di', 'Duis eu tempore adi', '39.60', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 30', '[]', 1, NULL, 39.6, NULL, 23, 438, '2021-09-17 02:39:39', '2021-09-17 02:39:39', '0', '0', '0', NULL),
(24, '15', '10428181807300', '6881936867524', '40627817283780', 'Qui ad dolore sequi', 1, '60', 'Qui eveniet quam di', 'Duis eu tempore adi', '39.60', 'ZADropship', '1', 1, 'Qui ad dolore sequi - 60', '[]', 1, NULL, 39.6, NULL, 23, 439, '2021-09-17 02:39:39', '2021-09-17 02:39:39', '0', '0', '0', NULL),
(25, '16', '10435556147396', '6885612060868', '40641821606084', 'New Shirt', 1, 'black / s', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '700.00', 'ZADropship', '1', 1, 'New Shirt - black / s', '[]', -3, 'fulfilled', 689.7, NULL, 24, 440, '2021-09-17 02:45:00', '2021-09-17 02:59:09', '627', '10', '1', '10'),
(26, '16', '10435556180164', '6885612060868', '40641821638852', 'New Shirt', 1, 'black / m', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '800.00', 'ZADropship', '1', 1, 'New Shirt - black / m', '[]', -3, 'fulfilled', 689.7, NULL, 24, 441, '2021-09-17 02:45:00', '2021-09-17 02:59:09', '627', '10', '1', '10'),
(27, '16', '10435556212932', '6885612060868', '40641821671620', 'New Shirt', 1, 'black / l', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '689.70', 'ZADropship', '1', 1, 'New Shirt - black / l', '[]', -3, 'fulfilled', 689.7, NULL, 24, 442, '2021-09-17 02:45:00', '2021-09-17 02:59:09', '627', '10', '1', '10'),
(28, '17', '10436164845764', '6886255886532', '40643690922180', 'test supplier', 1, '', '12', 'asd', '13.20', 'ZADropship', '1', 1, 'test supplier', '[]', 1, NULL, 13.2, NULL, 25, NULL, '2021-09-17 07:51:04', '2021-09-17 07:57:00', '12', '10', '1', '13'),
(29, '17', '10436164878532', '6885612060868', '40641821606084', 'New Shirt', 1, 'black / s', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '700.00', 'ZADropship', '1', 1, 'New Shirt - black / s', '[]', -1, 'fulfilled', 689.7, NULL, 24, 440, '2021-09-17 07:51:04', '2021-09-17 09:50:12', '627', '10', '1', '10'),
(30, '18', '10449585832132', '6885612060868', '40641821704388', 'New Shirt', 1, 'black / xl', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '689.70', 'ZADropship', '1', 1, 'New Shirt - black / xl', '[]', 1, NULL, 689.7, NULL, 24, 443, '2021-09-21 05:50:36', '2021-09-21 06:14:47', '627', '10', '1', '10'),
(31, '18', '10449585864900', '6886255886532', '40643690922180', 'test supplier', 1, '', '12', 'asd', '13.20', 'ZADropship', '1', 1, 'test supplier', '[]', 0, 'fulfilled', 13.2, NULL, 25, NULL, '2021-09-21 05:50:36', '2021-09-21 08:40:23', '12', '10', '1', '13'),
(32, '19', '10450045665476', '6885612060868', '40641821606084', 'New Shirt', 1, 'black / s', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '700.00', 'ZADropship', '1', 1, 'New Shirt - black / s', '[]', 0, 'fulfilled', 689.7, NULL, 24, 440, '2021-09-21 08:45:44', '2021-09-21 08:48:17', '627', '10', '1', '10'),
(33, '19', '10450045698244', '6886255886532', '40643690922180', 'test supplier', 1, '', '12', 'asd', '13.20', 'ZADropship', '1', 1, 'test supplier', '[]', 1, NULL, 13.2, NULL, 25, NULL, '2021-09-21 08:45:44', '2021-09-21 08:46:26', '12', '10', '1', '13'),
(34, '20', '10450073190596', '6885612060868', '40641821638852', 'New Shirt', 1, 'black / m', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '800.00', 'ZADropship', '1', 1, 'New Shirt - black / m', '[]', 0, 'fulfilled', 689.7, NULL, 24, 441, '2021-09-21 08:56:21', '2021-09-21 09:03:03', '627', '10', '1', '10'),
(35, '20', '10450073223364', '6886255886532', '40643690922180', 'test supplier', 1, '', '12', 'asd', '13.20', 'ZADropship', '1', 1, 'test supplier', '[]', 1, NULL, 13.2, NULL, 25, NULL, '2021-09-21 08:56:21', '2021-09-21 08:57:51', '12', '10', '1', '13'),
(36, '21', '10450252595396', '6885612060868', '40641821737156', 'New Shirt', 1, 'black / xxl', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '689.70', 'ZADropship', '1', 1, 'New Shirt - black / xxl', '[]', 0, 'fulfilled', 689.7, NULL, 24, 444, '2021-09-21 09:39:49', '2021-09-21 09:40:37', '627', '10', '1', '10'),
(37, '21', '10450252628164', '6886255886532', '40643690922180', 'test supplier', 1, '', '12', 'asd', '13.20', 'ZADropship', '1', 1, 'test supplier', '[]', 0, 'fulfilled', 13.2, NULL, 25, NULL, '2021-09-21 09:39:49', '2021-09-21 09:40:37', '12', '10', '1', '13'),
(38, '22', '10454838837444', '6885612060868', '40641821802692', 'New Shirt', 1, 'white / s', 'Distinctio Aut illu', 'Quo cupidatat ex sed', '689.70', 'ZADropship', '1', 1, 'New Shirt - white / s', '[]', 0, 'fulfilled', 689.7, NULL, 24, 445, '2021-09-22 09:20:49', '2021-09-23 06:08:37', '627', '10', '1', '10'),
(39, '22', '10454838870212', '6886255886532', '40643690922180', 'test supplier', 1, '', '12', 'asd', '13.20', 'ZADropship', '1', 1, 'test supplier', '[]', 0, 'fulfilled', 13.2, NULL, 25, NULL, '2021-09-22 09:20:49', '2021-09-23 02:13:38', '12', '10', '0', '13');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_orders`
--

CREATE TABLE `merchant_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shopify_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopify_created_at` timestamp NULL DEFAULT NULL,
  `shopify_updated_at` timestamp NULL DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `subtotal_price` double DEFAULT NULL,
  `total_weight` double DEFAULT NULL,
  `total_tax` double DEFAULT NULL,
  `taxes_included` tinyint(1) DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_discounts` double DEFAULT NULL,
  `customer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fulfilled_by` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sync_status` tinyint(1) DEFAULT NULL,
  `cost_to_pay` double DEFAULT NULL,
  `shop_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `shipping_price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_shopify_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_shopify_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `financial_status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transit_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_supplier` tinyint(1) DEFAULT 0,
  `supplier_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `commission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_orders`
--

INSERT INTO `merchant_orders` (`id`, `shopify_order_id`, `email`, `phone`, `shopify_created_at`, `shopify_updated_at`, `note`, `name`, `total_price`, `subtotal_price`, `total_weight`, `total_tax`, `taxes_included`, `currency`, `total_discounts`, `customer`, `billing_address`, `shipping_address`, `paid`, `status`, `fulfilled_by`, `sync_status`, `cost_to_pay`, `shop_id`, `customer_id`, `shipping_price`, `admin_shopify_id`, `admin_shopify_name`, `financial_status`, `delivery_status`, `transit_time`, `created_at`, `updated_at`, `is_supplier`, `supplier_price`, `commission`) VALUES
(8, '4016217391256', 'test@gmail.com', NULL, '2021-08-24 07:52:37', '2021-08-24 07:52:39', 'nothing', '#1002', 792.28, 683, 59000, 109.28, 0, 'PKR', 0, '{\"id\":5530850361496,\"email\":\"test@gmail.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-24T12:51:08+05:00\",\"updated_at\":\"2021-08-24T12:52:38+05:00\",\"first_name\":\"Test\",\"last_name\":\"Kanwar\",\"orders_count\":2,\"state\":\"disabled\",\"total_spent\":\"815.48\",\"last_order_id\":4016217391256,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1002\",\"currency\":\"PKR\",\"accepts_marketing_updated_at\":\"2021-08-24T12:51:08+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5530850361496\",\"default_address\":{\"id\":6699875532952,\"customer_id\":5530850361496,\"first_name\":\"Test\",\"last_name\":\"Kanwar\",\"company\":\"nova\",\"address1\":\"ONYX COMPUTERS\",\"address2\":\"22\",\"city\":\"Islamabad\",\"province\":null,\"country\":\"Pakistan\",\"zip\":\"\",\"phone\":\"+923056307009\",\"name\":\"Test Kanwar\",\"province_code\":null,\"country_code\":\"PK\",\"country_name\":\"Pakistan\",\"default\":true}}', '{\"first_name\":\"Test\",\"address1\":\"ONYX COMPUTERS\",\"phone\":\"+923056307009\",\"city\":\"Islamabad\",\"zip\":\"\",\"province\":null,\"country\":\"Pakistan\",\"last_name\":\"Kanwar\",\"address2\":\"22\",\"company\":\"nova\",\"latitude\":33.7159795,\"longitude\":73.06969649999999,\"name\":\"Test Kanwar\",\"country_code\":\"PK\",\"province_code\":null}', '{\"first_name\":\"Test\",\"address1\":\"ONYX COMPUTERS\",\"phone\":\"+923056307009\",\"city\":\"Islamabad\",\"zip\":\"\",\"province\":null,\"country\":\"Pakistan\",\"last_name\":\"Kanwar\",\"address2\":\"22\",\"company\":\"nova\",\"latitude\":33.7159795,\"longitude\":73.06969649999999,\"name\":\"Test Kanwar\",\"country_code\":\"PK\",\"province_code\":null}', 0, 'unfulfilled', 'ZADropship', 1, 675, 7, 5, NULL, NULL, 'ZA8', 'paid', NULL, NULL, '2021-08-24 05:57:59', '2021-08-24 05:57:59', 0, '0', '0'),
(9, '4016216277144', 'test@gmail.com', NULL, '2021-08-24 07:51:31', '2021-08-24 07:51:32', 'Do Nothing', '#1001', 23.2, 20, 2000, 3.2, 0, 'PKR', 0, '{\"id\":5530850361496,\"email\":\"test@gmail.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-24T12:51:08+05:00\",\"updated_at\":\"2021-08-24T12:52:38+05:00\",\"first_name\":\"Test\",\"last_name\":\"Kanwar\",\"orders_count\":2,\"state\":\"disabled\",\"total_spent\":\"815.48\",\"last_order_id\":4016217391256,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1002\",\"currency\":\"PKR\",\"accepts_marketing_updated_at\":\"2021-08-24T12:51:08+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5530850361496\",\"default_address\":{\"id\":6699875532952,\"customer_id\":5530850361496,\"first_name\":\"Test\",\"last_name\":\"Kanwar\",\"company\":\"nova\",\"address1\":\"ONYX COMPUTERS\",\"address2\":\"22\",\"city\":\"Islamabad\",\"province\":null,\"country\":\"Pakistan\",\"zip\":\"\",\"phone\":\"+923056307009\",\"name\":\"Test Kanwar\",\"province_code\":null,\"country_code\":\"PK\",\"country_name\":\"Pakistan\",\"default\":true}}', '{\"first_name\":\"Test\",\"address1\":\"ONYX COMPUTERS\",\"phone\":\"+923056307009\",\"city\":\"Islamabad\",\"zip\":\"\",\"province\":null,\"country\":\"Pakistan\",\"last_name\":\"Kanwar\",\"address2\":\"22\",\"company\":\"nova\",\"latitude\":33.7159795,\"longitude\":73.06969649999999,\"name\":\"Test Kanwar\",\"country_code\":\"PK\",\"province_code\":null}', '{\"first_name\":\"Test\",\"address1\":\"ONYX COMPUTERS\",\"phone\":\"+923056307009\",\"city\":\"Islamabad\",\"zip\":\"\",\"province\":null,\"country\":\"Pakistan\",\"last_name\":\"Kanwar\",\"address2\":\"22\",\"company\":\"nova\",\"latitude\":33.7159795,\"longitude\":73.06969649999999,\"name\":\"Test Kanwar\",\"country_code\":\"PK\",\"province_code\":null}', 0, 'unfulfilled', 'ZADropship', 1, 20, 7, 5, NULL, NULL, 'ZA9', 'paid', NULL, NULL, '2021-08-24 05:57:59', '2021-08-24 05:57:59', 0, '0', '0'),
(15, '4085919940804', 'afeef.ali@tetralogicx.com', NULL, '2021-09-14 20:39:32', '2021-09-14 20:39:33', NULL, '#1009', 79.2, 79.2, 54000, 0, 0, 'USD', 0, '{\"id\":5444513235140,\"email\":\"afeef.ali@tetralogicx.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-20T15:12:46+05:00\",\"updated_at\":\"2021-09-15T13:39:33+05:00\",\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"orders_count\":8,\"state\":\"disabled\",\"total_spent\":\"362.57\",\"last_order_id\":4085919940804,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1009\",\"currency\":\"USD\",\"accepts_marketing_updated_at\":\"2021-08-20T15:12:46+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5444513235140\",\"default_address\":{\"id\":6772357923012,\"customer_id\":5444513235140,\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"company\":\"Tetralogicx\",\"address1\":\"Lahore, punjab\",\"address2\":\"\",\"city\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"zip\":\"\",\"phone\":\"\",\"name\":\"Afeef Ali\",\"province_code\":\"AL\",\"country_code\":\"US\",\"country_name\":\"United States\",\"default\":true}}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', 1, 'Paid', 'ZADropship', 1, 79.2, 9, 6, '99', NULL, 'ZA15', 'paid', NULL, NULL, '2021-09-17 02:39:39', '2021-09-17 02:40:07', 0, '0', '79.2'),
(16, '4089754910916', 'afeef.ali@tetralogicx.com', NULL, '2021-09-17 07:44:49', '2021-09-17 07:44:50', NULL, '#1010', 2189.7, 2189.7, 66000, 0, 0, 'USD', 0, '{\"id\":5444513235140,\"email\":\"afeef.ali@tetralogicx.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-20T15:12:46+05:00\",\"updated_at\":\"2021-09-17T12:44:50+05:00\",\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"orders_count\":9,\"state\":\"disabled\",\"total_spent\":\"2552.27\",\"last_order_id\":4089754910916,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1010\",\"currency\":\"USD\",\"accepts_marketing_updated_at\":\"2021-08-20T15:12:46+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5444513235140\",\"default_address\":{\"id\":6772357923012,\"customer_id\":5444513235140,\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"company\":\"Tetralogicx\",\"address1\":\"Lahore, punjab\",\"address2\":\"\",\"city\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"zip\":\"\",\"phone\":\"\",\"name\":\"Afeef Ali\",\"province_code\":\"AL\",\"country_code\":\"US\",\"country_name\":\"United States\",\"default\":true}}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', 1, 'fulfilled', 'ZADropship', 1, 2069.1, 9, 6, '99', NULL, 'ZA16', 'paid', NULL, NULL, '2021-09-17 02:45:00', '2021-09-17 02:53:47', 0, '1881', '188.1'),
(17, '4090092191940', 'afeef.ali@tetralogicx.com', NULL, '2021-09-17 00:50:47', '2021-09-17 00:50:49', NULL, '#1011', 713.2, 713.2, 34000, 0, 0, 'USD', 0, '{\"id\":5444513235140,\"email\":\"afeef.ali@tetralogicx.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-20T15:12:46+05:00\",\"updated_at\":\"2021-09-17T17:50:48+05:00\",\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"orders_count\":10,\"state\":\"disabled\",\"total_spent\":\"3265.47\",\"last_order_id\":4090092191940,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1011\",\"currency\":\"USD\",\"accepts_marketing_updated_at\":\"2021-08-20T15:12:46+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5444513235140\",\"default_address\":{\"id\":6772357923012,\"customer_id\":5444513235140,\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"company\":\"Tetralogicx\",\"address1\":\"Lahore, punjab\",\"address2\":\"\",\"city\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"zip\":\"\",\"phone\":\"\",\"name\":\"Afeef Ali\",\"province_code\":\"AL\",\"country_code\":\"US\",\"country_name\":\"United States\",\"default\":true}}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', 1, 'fulfilled', 'ZADropship', 1, 702.9, 9, 6, '99', NULL, 'ZA17', 'paid', NULL, NULL, '2021-09-17 07:51:04', '2021-09-17 09:50:12', 0, '639', '63.9'),
(18, '4097404076228', 'afeef.ali@tetralogicx.com', NULL, '2021-09-20 22:50:21', '2021-09-20 22:50:22', NULL, '#1012', 702.9, 702.9, 34000, 0, 0, 'USD', 0, '{\"id\":5444513235140,\"email\":\"afeef.ali@tetralogicx.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-20T15:12:46+05:00\",\"updated_at\":\"2021-09-21T15:50:21+05:00\",\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"orders_count\":11,\"state\":\"disabled\",\"total_spent\":\"3968.37\",\"last_order_id\":4097404076228,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1012\",\"currency\":\"USD\",\"accepts_marketing_updated_at\":\"2021-08-20T15:12:46+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5444513235140\",\"default_address\":{\"id\":6772357923012,\"customer_id\":5444513235140,\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"company\":\"Tetralogicx\",\"address1\":\"Lahore, punjab\",\"address2\":\"\",\"city\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"zip\":\"\",\"phone\":\"\",\"name\":\"Afeef Ali\",\"province_code\":\"AL\",\"country_code\":\"US\",\"country_name\":\"United States\",\"default\":true}}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', 1, 'fulfilled', 'ZADropship', 1, 702.9, 9, 6, '99', NULL, 'ZA18', 'paid', NULL, NULL, '2021-09-21 05:50:36', '2021-09-21 08:40:23', 0, '639', '63.9'),
(19, '4097672380612', 'afeef.ali@tetralogicx.com', NULL, '2021-09-21 01:44:44', '2021-09-21 01:44:47', NULL, '#1013', 713.2, 713.2, 34000, 0, 0, 'USD', 0, '{\"id\":5444513235140,\"email\":\"afeef.ali@tetralogicx.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-20T15:12:46+05:00\",\"updated_at\":\"2021-09-21T18:44:45+05:00\",\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"orders_count\":12,\"state\":\"disabled\",\"total_spent\":\"4681.57\",\"last_order_id\":4097672380612,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1013\",\"currency\":\"USD\",\"accepts_marketing_updated_at\":\"2021-08-20T15:12:46+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5444513235140\",\"default_address\":{\"id\":6772357923012,\"customer_id\":5444513235140,\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"company\":\"Tetralogicx\",\"address1\":\"Lahore, punjab\",\"address2\":\"\",\"city\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"zip\":\"\",\"phone\":\"\",\"name\":\"Afeef Ali\",\"province_code\":\"AL\",\"country_code\":\"US\",\"country_name\":\"United States\",\"default\":true}}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', 1, 'unfulfilled', 'ZADropship', 1, 702.9, 9, 6, '99', NULL, 'ZA19', 'paid', NULL, NULL, '2021-09-21 08:45:44', '2021-09-21 08:48:17', 0, '639', '63.9'),
(20, '4097687060676', 'afeef.ali@tetralogicx.com', NULL, '2021-09-21 01:52:09', '2021-09-21 01:52:11', NULL, '#1014', 813.2, 813.2, 34000, 0, 0, 'USD', 0, '{\"id\":5444513235140,\"email\":\"afeef.ali@tetralogicx.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-20T15:12:46+05:00\",\"updated_at\":\"2021-09-21T18:52:10+05:00\",\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"orders_count\":13,\"state\":\"disabled\",\"total_spent\":\"5494.77\",\"last_order_id\":4097687060676,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1014\",\"currency\":\"USD\",\"accepts_marketing_updated_at\":\"2021-08-20T15:12:46+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5444513235140\",\"default_address\":{\"id\":6772357923012,\"customer_id\":5444513235140,\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"company\":\"Tetralogicx\",\"address1\":\"Lahore, punjab\",\"address2\":\"\",\"city\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"zip\":\"\",\"phone\":\"\",\"name\":\"Afeef Ali\",\"province_code\":\"AL\",\"country_code\":\"US\",\"country_name\":\"United States\",\"default\":true}}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', 1, 'unfulfilled', 'ZADropship', 1, 702.9, 9, 6, '99', NULL, 'ZA20', 'paid', NULL, NULL, '2021-09-21 08:56:21', '2021-09-21 09:03:03', 0, '639', '63.9'),
(21, '4097785823428', 'afeef.ali@tetralogicx.com', NULL, '2021-09-21 02:39:36', '2021-09-21 02:39:37', NULL, '#1015', 702.9, 702.9, 34000, 0, 0, 'USD', 0, '{\"id\":5444513235140,\"email\":\"afeef.ali@tetralogicx.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-20T15:12:46+05:00\",\"updated_at\":\"2021-09-21T19:39:37+05:00\",\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"orders_count\":14,\"state\":\"disabled\",\"total_spent\":\"6197.67\",\"last_order_id\":4097785823428,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1015\",\"currency\":\"USD\",\"accepts_marketing_updated_at\":\"2021-08-20T15:12:46+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5444513235140\",\"default_address\":{\"id\":6772357923012,\"customer_id\":5444513235140,\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"company\":\"Tetralogicx\",\"address1\":\"Lahore, punjab\",\"address2\":\"\",\"city\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"zip\":\"\",\"phone\":\"\",\"name\":\"Afeef Ali\",\"province_code\":\"AL\",\"country_code\":\"US\",\"country_name\":\"United States\",\"default\":true}}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', 1, 'unfulfilled', 'ZADropship', 1, 702.9, 9, 6, '99', NULL, 'ZA21', 'paid', NULL, NULL, '2021-09-21 09:39:49', '2021-09-21 09:40:37', 0, '639', '63.9'),
(22, '4100362633412', 'afeef.ali@tetralogicx.com', NULL, '2021-09-22 02:20:39', '2021-09-22 02:20:40', NULL, '#1016', 702.9, 702.9, 34000, 0, 0, 'USD', 0, '{\"id\":5444513235140,\"email\":\"afeef.ali@tetralogicx.com\",\"accepts_marketing\":false,\"created_at\":\"2021-08-20T15:12:46+05:00\",\"updated_at\":\"2021-09-22T19:20:40+05:00\",\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"orders_count\":15,\"state\":\"disabled\",\"total_spent\":\"6900.57\",\"last_order_id\":4100362633412,\"note\":null,\"verified_email\":true,\"multipass_identifier\":null,\"tax_exempt\":false,\"phone\":null,\"tags\":\"\",\"last_order_name\":\"#1016\",\"currency\":\"USD\",\"accepts_marketing_updated_at\":\"2021-08-20T15:12:46+05:00\",\"marketing_opt_in_level\":null,\"tax_exemptions\":[],\"admin_graphql_api_id\":\"gid:\\/\\/shopify\\/Customer\\/5444513235140\",\"default_address\":{\"id\":6772357923012,\"customer_id\":5444513235140,\"first_name\":\"Afeef\",\"last_name\":\"Ali\",\"company\":\"Tetralogicx\",\"address1\":\"Lahore, punjab\",\"address2\":\"\",\"city\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"zip\":\"\",\"phone\":\"\",\"name\":\"Afeef Ali\",\"province_code\":\"AL\",\"country_code\":\"US\",\"country_name\":\"United States\",\"default\":true}}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', '{\"first_name\":\"Afeef\",\"address1\":\"Lahore, punjab\",\"phone\":\"\",\"city\":\"\",\"zip\":\"\",\"province\":\"Alabama\",\"country\":\"United States\",\"last_name\":\"Ali\",\"address2\":\"\",\"company\":\"Tetralogicx\",\"latitude\":null,\"longitude\":null,\"name\":\"Afeef Ali\",\"country_code\":\"US\",\"province_code\":\"AL\"}', 1, 'fulfilled', 'ZADropship', 1, 702.9, 9, 6, '99', NULL, 'ZA22', 'paid', NULL, NULL, '2021-09-22 09:20:49', '2021-09-23 02:13:38', 0, '639', '63.9');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_products`
--

CREATE TABLE `merchant_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compare_price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option3` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fulfilled_by` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toShopify` text COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `shopify_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_item_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managed_inventory` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imported_from_shopify` text COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_dropship_product` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `import_status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linked_product_id` int(10) UNSIGNED DEFAULT NULL,
  `shop_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `margin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `supplier_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_products`
--

INSERT INTO `merchant_products` (`id`, `title`, `description`, `images`, `type`, `vendor`, `tags`, `cost`, `price`, `compare_price`, `quantity`, `weight`, `sku`, `barcode`, `length`, `width`, `height`, `variants`, `attribute1`, `attribute2`, `attribute3`, `option1`, `option2`, `option3`, `featured_image`, `status`, `fulfilled_by`, `toShopify`, `shopify_id`, `inventory_item_id`, `managed_inventory`, `imported_from_shopify`, `is_dropship_product`, `import_status`, `linked_product_id`, `shop_id`, `created_at`, `updated_at`, `margin`, `supplier_price`, `supplier_id`) VALUES
(6, 'Kanwar', '<p>jbdkajbkdjbsakadjbakjd</p>', NULL, 'shirt', 'kanwar', '1,2,3,4,5,AK,NEW,kanwar', '10', '10', NULL, '100', '1', '123', '009', '1', '2', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'ZADropship', '1', '6967143661720', NULL, NULL, '0', NULL, NULL, 8, 7, '2021-08-24 02:43:56', '2021-08-24 02:46:49', '0', '0', NULL),
(7, 'kanwar123', '<p>Fringilla, molestias sapiente anim. Proident, veniam cursus porttitor tempora voluptate fugit vero, integer hendrerit. Dignissim voluptate odit quam illo adipiscing aptent potenti, architecto cumque, fuga. Quo exercitation, illo, phasellus mollis ipsa nunc nisi mi. Adipiscing qui. At aptent, recusandae adipisci, imperdiet augue consectetur pariatur quod neque sapiente amet quo irure at, senectus! Quos magna consequatur tempus sint perferendis orci ac, nam soluta incididunt, perferendis consectetuer! Condimentum, debitis aptent sapien quisque vestibulum duis litora donec primis illum magna! Earum. Tempor euismod sint irure scelerisque sagittis, maxime cursus massa irure iaculis facere pellentesque voluptatem convallis, harum, fuga elit accusamus. Excepturi sapien, commodo.<br></p>', NULL, 'Vel ipsam optio exe', 'Quo cupidatat ex sed', 'Eiusmod temporibus d,AK,AK,Autem eaque ut dolor,NEW,kanwar,kanwar', '627', '627', NULL, '655', '22', 'Distinctio Aut illu', 'Vel voluptatibus fug', '60', '58', '97', 'on', 'Color', 'size', NULL, 'black,white', 's,m,l,xl,xxl', NULL, NULL, '1', 'ZADropship', '1', '6967144087704', NULL, NULL, '0', NULL, NULL, 2, 7, '2021-08-24 02:44:00', '2021-08-26 03:13:41', '0', '0', NULL),
(8, 'Qui ad dolore sequi', '<p>Reprehenderit integer justo incidunt corrupti, class nisl mollit taciti hic ligula augue fames cupiditate? Eros! Blanditiis qui nostra vivamus, pellentesque omnis sint blanditiis luctus, mus quasi placerat, vitae nibh senectus ultrices volutpat rhoncus, dui, doloremque, nunc, error, rem tempore mauris viverra reprehenderit commodi. Tempor occaecat! Repellendus do cupiditate! Irure a? Ullamco phasellus vel per sapiente non urna mollitia nibh natoque harum recusandae! Necessitatibus totam, non ornare officiis iste cursus, dignissimos, quasi minus, sit platea aut porttitor beatae? Volutpat? Accusantium excepturi molestias interdum similique, possimus minim consequat curabitur vestibulum voluptatum nostrud anim purus pariatur debitis eligendi, porta quam porro asperiores diam.<br></p>', NULL, 'Aut sed dolore labor', 'Duis eu tempore adi', 'Pariatur Elit quod,1,2,33,Autem eaque ut dolor', '36', '36', NULL, '619', '27', 'Qui eveniet quam di', 'Sequi enim eu unde e', '93', '36', '49', 'on', 'size', NULL, NULL, '30,60', NULL, NULL, NULL, '1', 'ZADropship', '1', '6967146348696', NULL, NULL, '0', NULL, NULL, 3, 7, '2021-08-24 02:46:33', '2021-08-24 02:48:21', '0', '0', NULL),
(9, 'Provident adipisici', 'Reprehenderit integer justo incidunt corrupti, class nisl mollit taciti hic ligula augue fames cupiditate? Eros! Blanditiis qui nostra vivamus, pellentesque omnis sint blanditiis luctus, mus quasi placerat, vitae nibh senectus ultrices volutpat rhoncus, dui, doloremque, nunc, error, rem tempore mauris viverra reprehenderit commodi. Tempor occaecat! Repellendus do cupiditate! Irure a? Ullamco phasellus vel per sapiente non urna mollitia nibh natoque harum recusandae! Necessitatibus totam, non ornare officiis iste cursus, dignissimos, quasi minus, sit platea aut porttitor beatae? Volutpat? Accusantium excepturi molestias interdum similique, possimus minim consequat curabitur vestibulum voluptatum nostrud anim purus pariatur debitis eligendi, porta quam porro asperiores diam.', NULL, 'Mollitia illum mini', 'Eveniet commodi min', 'Aliquip cumque ipsam,AK,Autem eaque ut dolor,kanwar', '672', '672', NULL, '565', '46', 'Aliquam esse cupidit', 'Suscipit maxime nost', '81', '48', '61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'ZADropship', '1', '6967146152088', NULL, NULL, '0', NULL, NULL, 5, 7, '2021-08-24 02:46:35', '2021-08-24 02:48:13', '0', '0', NULL),
(10, 'shirt', '<p>blaw</p>', NULL, 'jj', 'kjkk', 'k,kj,ki,AK,NEW,kanwar', '12', '12', NULL, '100', '10', '123', '0009', '12', '12', '12', 'on', 'color', 'size', NULL, 'black,white', 's,m,l', NULL, NULL, '1', 'ZADropship', '1', '6971150336152', NULL, NULL, '0', NULL, NULL, 9, 7, '2021-08-26 01:24:00', '2021-08-26 01:25:13', '0', '0', NULL),
(11, 'Remesol', '<p>Reprehenderit integer justo incidunt corrupti, class nisl mollit taciti hic ligula augue fames cupiditate? Eros! Blanditiis qui nostra vivamus, pellentesque omnis sint blanditiis luctus, mus quasi placerat, vitae nibh senectus ultrices volutpat rhoncus, dui, doloremque, nunc, error, rem tempore mauris viverra reprehenderit commodi. Tempor occaecat! Repellendus do cupiditate! Irure a? Ullamco phasellus vel per sapiente non urna mollitia nibh natoque harum recusandae! Necessitatibus totam, non ornare officiis iste cursus, dignissimos, quasi minus, sit platea aut porttitor beatae? Volutpat? Accusantium excepturi molestias interdum similique, possimus minim consequat curabitur vestibulum voluptatum nostrud anim purus pariatur debitis eligendi, porta quam porro asperiores diam.<br></p>', NULL, 'Repudiandae nesciunt', 'Labore sed laboris q', 'Aut minus voluptatem,AK,NEW', '141', '141', NULL, '966', '54', 'Aut pariatur Est et', 'Neque tempore culpa', '50', '13', '21', 'on', 'c', 'b', 'd', '1,2,3,4,5', '1,2,3,4,5', '1,2,3,4,5', NULL, '1', 'ZADropship', '0', NULL, NULL, NULL, '0', NULL, NULL, 4, 7, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(12, 'Qui ad dolore sequi', '<p>Reprehenderit integer justo incidunt corrupti, class nisl mollit taciti hic ligula augue fames cupiditate? Eros! Blanditiis qui nostra vivamus, pellentesque omnis sint blanditiis luctus, mus quasi placerat, vitae nibh senectus ultrices volutpat rhoncus, dui, doloremque, nunc, error, rem tempore mauris viverra reprehenderit commodi. Tempor occaecat! Repellendus do cupiditate! Irure a? Ullamco phasellus vel per sapiente non urna mollitia nibh natoque harum recusandae! Necessitatibus totam, non ornare officiis iste cursus, dignissimos, quasi minus, sit platea aut porttitor beatae? Volutpat? Accusantium excepturi molestias interdum similique, possimus minim consequat curabitur vestibulum voluptatum nostrud anim purus pariatur debitis eligendi, porta quam porro asperiores diam.<br></p>', NULL, 'Aut sed dolore labor', 'Duis eu tempore adi', 'Pariatur Elit quod,1,2,33,Autem eaque ut dolor', '36', '36', NULL, '619', '27', 'Qui eveniet quam di', 'Sequi enim eu unde e', '93', '36', '49', 'on', 'size', NULL, NULL, '30,60', NULL, NULL, NULL, '1', 'ZADropship', '1', '7000405213336', NULL, NULL, '0', NULL, NULL, 3, 6, '2021-09-07 05:58:09', '2021-09-07 05:58:38', '0', '0', NULL),
(24, 'New Shirt', '<p>Fringilla, molestias sapiente anim. Proident, veniam cursus porttitor tempora voluptate fugit vero, integer hendrerit. Dignissim voluptate odit quam illo adipiscing aptent potenti, architecto cumque, fuga. Quo exercitation, illo, phasellus mollis ipsa nunc nisi mi. Adipiscing qui. At aptent, recusandae adipisci, imperdiet augue consectetur pariatur quod neque sapiente amet quo irure at, senectus! Quos magna consequatur tempus sint perferendis orci ac, nam soluta incididunt, perferendis consectetuer! Condimentum, debitis aptent sapien quisque vestibulum duis litora donec primis illum magna! Earum. Tempor euismod sint irure scelerisque sagittis, maxime cursus massa irure iaculis facere pellentesque voluptatem convallis, harum, fuga elit accusamus. Excepturi sapien, commodo.<br></p>', NULL, 'Vel ipsam optio exe', 'Quo cupidatat ex sed', 'Eiusmod temporibus d,AK,AK,NEW,kanwar,kanwar', '689.7', '689.7', NULL, '655', '22', 'Distinctio Aut illu', 'Vel voluptatibus fug', '60', '58', '97', 'on', 'Color', 'size', NULL, 'black,white', 's,m,l,xl,xxl', NULL, NULL, '1', 'ZADropship', '1', '6885612060868', NULL, NULL, '0', NULL, NULL, 2, 9, '2021-09-17 02:42:30', '2021-09-17 02:43:13', '10', '627', '10'),
(25, 'test supplier', '<p>test supplier<br></p>', NULL, 'sd', 'asd', 'asdsd,Electronics', '13.2', '13.2', NULL, '12', '12', '12', '12', '12', '12', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'ZADropship', '1', '6886255886532', NULL, NULL, '0', NULL, NULL, 10, 9, '2021-09-17 07:47:47', '2021-09-17 07:48:06', '10', '12', '13');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_product_images`
--

CREATE TABLE `merchant_product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isV` tinyint(1) DEFAULT 0,
  `shopify_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `shop_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_product_images`
--

INSERT INTO `merchant_product_images` (`id`, `position`, `isV`, `shopify_id`, `src`, `product_id`, `shop_id`, `created_at`, `updated_at`) VALUES
(8, '1', NULL, NULL, 'images/products/202108160815Mg-Cal_720x.png', 6, 7, '2021-08-24 02:43:56', '2021-08-24 02:43:56'),
(9, '1', 0, NULL, 'images/products/202108131124ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', 7, 7, '2021-08-24 02:44:00', '2021-08-24 02:44:00'),
(10, '1', 0, NULL, 'images/products/202108131139ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', 8, 7, '2021-08-24 02:46:33', '2021-08-24 02:46:33'),
(11, '2', 0, NULL, 'images/products/202108131134Mg-Cal_720x.png', 8, 7, '2021-08-24 02:46:33', '2021-08-24 02:46:33'),
(12, '3', NULL, NULL, 'images/products/202108121400Screenshot-2021-08-10-at-4.19.41-PM.png', 8, 7, '2021-08-24 02:46:33', '2021-08-24 02:46:33'),
(13, '4', NULL, NULL, 'images/products/202108121400Screenshot-2021-08-11-at-7.12.17-PM.png', 8, 7, '2021-08-24 02:46:33', '2021-08-24 02:46:33'),
(14, '1', NULL, NULL, 'images/products/202108131132ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', 9, 7, '2021-08-24 02:46:35', '2021-08-24 02:46:35'),
(15, '1', 0, NULL, 'images/products/202108161113ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', 10, 7, '2021-08-26 01:24:00', '2021-08-26 01:24:00'),
(16, '2', NULL, NULL, 'images/products/202108161110Mg-Cal_720x.png', 10, 7, '2021-08-26 01:24:00', '2021-08-26 01:24:00'),
(17, '1', 0, NULL, 'images/products/202108131131ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', 11, 7, '2021-08-26 01:37:37', '2021-08-26 01:37:37'),
(18, '1', 0, NULL, 'images/products/202108131139ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', 12, 6, '2021-09-07 05:58:09', '2021-09-07 05:58:09'),
(19, '2', 0, NULL, 'images/products/202108131134Mg-Cal_720x.png', 12, 6, '2021-09-07 05:58:09', '2021-09-07 05:58:09'),
(20, '3', NULL, NULL, 'images/products/202108121400Screenshot-2021-08-10-at-4.19.41-PM.png', 12, 6, '2021-09-07 05:58:09', '2021-09-07 05:58:09'),
(21, '4', NULL, NULL, 'images/products/202108121400Screenshot-2021-08-11-at-7.12.17-PM.png', 12, 6, '2021-09-07 05:58:09', '2021-09-07 05:58:09'),
(59, '1', 0, NULL, 'images/products/202108131124ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', 24, 9, '2021-09-17 02:42:30', '2021-09-17 02:42:30'),
(60, '1', NULL, NULL, 'images/products/202109171246494272-how-we-test-drones.jpg', 25, 9, '2021-09-17 07:47:47', '2021-09-17 07:47:47'),
(61, '2', NULL, NULL, 'images/products/202109171246202005082043touch-screen.png', 25, 9, '2021-09-17 07:47:47', '2021-09-17 07:47:47'),
(62, '3', NULL, NULL, 'images/products/202109171246Drone.jpg', 25, 9, '2021-09-17 07:47:47', '2021-09-17 07:47:47'),
(63, '4', 0, NULL, 'images/products/20210809072620170803_coupon_01.png', 25, 9, '2021-09-17 07:47:47', '2021-09-17 07:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_variants`
--

CREATE TABLE `merchant_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compare_price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopify_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_item_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_dropship_variant` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `linked_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `margin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `supplier_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_variants`
--

INSERT INTO `merchant_variants` (`id`, `title`, `option1`, `option2`, `option3`, `price`, `compare_price`, `cost`, `quantity`, `sku`, `barcode`, `image`, `shopify_id`, `inventory_item_id`, `is_dropship_variant`, `shop_id`, `product_id`, `linked_variant_id`, `created_at`, `updated_at`, `margin`, `supplier_price`, `supplier_id`) VALUES
(267, 'black/s', 'black', 's', NULL, '700', NULL, '627', '655', 'Distinctio Aut illu', NULL, '9', '40770289631384', '42865579196568', NULL, 7, 7, 180, '2021-08-24 02:44:00', '2021-08-26 03:12:23', '0', '0', NULL),
(268, 'black/m', 'black', 'm', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, '9', '40770289664152', '42865579229336', NULL, 7, 7, 181, '2021-08-24 02:44:00', '2021-08-26 03:15:46', '0', '0', NULL),
(269, 'black/l', 'black', 'l', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, NULL, '40770289696920', '42865579262104', NULL, 7, 7, 182, '2021-08-24 02:44:00', '2021-08-24 02:47:12', '0', '0', NULL),
(270, 'black/xl', 'black', 'xl', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, NULL, '40770289729688', '42865579294872', NULL, 7, 7, 183, '2021-08-24 02:44:00', '2021-08-24 02:47:15', '0', '0', NULL),
(271, 'black/xxl', 'black', 'xxl', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, NULL, '40770289762456', '42865579327640', NULL, 7, 7, 184, '2021-08-24 02:44:00', '2021-08-24 02:47:18', '0', '0', NULL),
(272, 'white/s', 'white', 's', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, NULL, '40770289795224', '42865579360408', NULL, 7, 7, 185, '2021-08-24 02:44:00', '2021-08-24 02:47:20', '0', '0', NULL),
(273, 'white/m', 'white', 'm', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, NULL, '40770289827992', '42865579393176', NULL, 7, 7, 186, '2021-08-24 02:44:00', '2021-08-24 02:47:23', '0', '0', NULL),
(274, 'white/l', 'white', 'l', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, NULL, '40770289860760', '42865579425944', NULL, 7, 7, 187, '2021-08-24 02:44:00', '2021-08-24 02:47:26', '0', '0', NULL),
(275, 'white/xl', 'white', 'xl', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, NULL, '40770289893528', '42865579458712', NULL, 7, 7, 188, '2021-08-24 02:44:00', '2021-08-24 02:47:28', '0', '0', NULL),
(276, 'white/xxl', 'white', 'xxl', NULL, '627', NULL, '627', '655', 'Distinctio Aut illu', NULL, NULL, '40770289926296', '42865579491480', NULL, 7, 7, 189, '2021-08-24 02:44:00', '2021-08-24 02:47:31', '0', '0', NULL),
(277, '30', '30', NULL, NULL, '36', NULL, '36', NULL, 'Qui eveniet quam di', NULL, '10', '40770307293336', '42865596858520', NULL, 7, 8, 43, '2021-08-24 02:46:33', '2021-08-24 02:48:21', '0', '0', NULL),
(278, '60', '60', NULL, NULL, '36', NULL, '36', NULL, 'Qui eveniet quam di', NULL, '11', '40770307326104', '42865596891288', NULL, 7, 8, 44, '2021-08-24 02:46:33', '2021-08-24 02:48:23', '0', '0', NULL),
(279, 'black/s', 'black', 's', NULL, '12', NULL, '12', '100', '123', NULL, '16', '40785636425880', '42880939851928', NULL, 7, 10, 190, '2021-08-26 01:24:00', '2021-08-26 01:25:13', '0', '0', NULL),
(280, 'black/m', 'black', 'm', NULL, '12', NULL, '12', '100', '123', NULL, NULL, '40785636458648', '42880939884696', NULL, 7, 10, 191, '2021-08-26 01:24:00', '2021-08-26 01:25:16', '0', '0', NULL),
(281, 'black/l', 'black', 'l', NULL, '12', NULL, '12', '100', '123', NULL, NULL, '40785636491416', '42880939917464', NULL, 7, 10, 192, '2021-08-26 01:24:00', '2021-08-26 01:25:19', '0', '0', NULL),
(282, 'white/s', 'white', 's', NULL, '12', NULL, '12', '100', '123', NULL, NULL, '40785636524184', '42880939950232', NULL, 7, 10, 193, '2021-08-26 01:24:00', '2021-08-26 01:25:21', '0', '0', NULL),
(283, 'white/m', 'white', 'm', NULL, '12', NULL, '12', '100', '123', NULL, NULL, '40785636556952', '42880939983000', NULL, 7, 10, 194, '2021-08-26 01:24:00', '2021-08-26 01:25:24', '0', '0', NULL),
(284, 'white/l', 'white', 'l', NULL, '12', NULL, '12', '100', '123', NULL, NULL, '40785636589720', '42880940015768', NULL, 7, 10, 195, '2021-08-26 01:24:00', '2021-08-26 01:25:26', '0', '0', NULL),
(285, '1/1/1', '1', '1', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 55, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(286, '1/1/2', '1', '1', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 56, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(287, '1/1/3', '1', '1', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 57, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(288, '1/1/4', '1', '1', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 58, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(289, '1/1/5', '1', '1', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 59, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(290, '1/2/1', '1', '2', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 60, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(291, '1/2/2', '1', '2', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 61, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(292, '1/2/3', '1', '2', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 62, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(293, '1/2/4', '1', '2', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 63, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(294, '1/2/5', '1', '2', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 64, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(295, '1/3/1', '1', '3', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 65, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(296, '1/3/2', '1', '3', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 66, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(297, '1/3/3', '1', '3', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 67, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(298, '1/3/4', '1', '3', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 68, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(299, '1/3/5', '1', '3', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 69, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(300, '1/4/1', '1', '4', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 70, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(301, '1/4/2', '1', '4', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 71, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(302, '1/4/3', '1', '4', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 72, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(303, '1/4/4', '1', '4', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 73, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(304, '1/4/5', '1', '4', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 74, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(305, '1/5/1', '1', '5', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 75, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(306, '1/5/2', '1', '5', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 76, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(307, '1/5/3', '1', '5', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 77, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(308, '1/5/4', '1', '5', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 78, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(309, '1/5/5', '1', '5', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 79, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(310, '2/1/1', '2', '1', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 80, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(311, '2/1/2', '2', '1', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 81, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(312, '2/1/3', '2', '1', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 82, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(313, '2/1/4', '2', '1', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 83, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(314, '2/1/5', '2', '1', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 84, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(315, '2/2/1', '2', '2', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 85, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(316, '2/2/2', '2', '2', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 86, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(317, '2/2/3', '2', '2', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 87, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(318, '2/2/4', '2', '2', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 88, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(319, '2/2/5', '2', '2', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 89, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(320, '2/3/1', '2', '3', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 90, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(321, '2/3/2', '2', '3', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 91, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(322, '2/3/3', '2', '3', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 92, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(323, '2/3/4', '2', '3', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 93, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(324, '2/3/5', '2', '3', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 94, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(325, '2/4/1', '2', '4', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 95, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(326, '2/4/2', '2', '4', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 96, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(327, '2/4/3', '2', '4', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 97, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(328, '2/4/4', '2', '4', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 98, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(329, '2/4/5', '2', '4', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 99, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(330, '2/5/1', '2', '5', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 100, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(331, '2/5/2', '2', '5', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 101, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(332, '2/5/3', '2', '5', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 102, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(333, '2/5/4', '2', '5', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 103, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(334, '2/5/5', '2', '5', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 104, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(335, '3/1/1', '3', '1', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 105, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(336, '3/1/2', '3', '1', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 106, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(337, '3/1/3', '3', '1', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 107, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(338, '3/1/4', '3', '1', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 108, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(339, '3/1/5', '3', '1', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 109, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(340, '3/2/1', '3', '2', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 110, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(341, '3/2/2', '3', '2', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 111, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(342, '3/2/3', '3', '2', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 112, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(343, '3/2/4', '3', '2', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 113, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(344, '3/2/5', '3', '2', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 114, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(345, '3/3/1', '3', '3', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 115, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(346, '3/3/2', '3', '3', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 116, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(347, '3/3/3', '3', '3', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 117, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(348, '3/3/4', '3', '3', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 118, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(349, '3/3/5', '3', '3', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 119, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(350, '3/4/1', '3', '4', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 120, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(351, '3/4/2', '3', '4', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 121, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(352, '3/4/3', '3', '4', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 122, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(353, '3/4/4', '3', '4', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 123, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(354, '3/4/5', '3', '4', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 124, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(355, '3/5/1', '3', '5', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 125, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(356, '3/5/2', '3', '5', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 126, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(357, '3/5/3', '3', '5', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 127, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(358, '3/5/4', '3', '5', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 128, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(359, '3/5/5', '3', '5', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 129, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(360, '4/1/1', '4', '1', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 130, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(361, '4/1/2', '4', '1', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 131, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(362, '4/1/3', '4', '1', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 132, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(363, '4/1/4', '4', '1', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 133, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(364, '4/1/5', '4', '1', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 134, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(365, '4/2/1', '4', '2', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 135, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(366, '4/2/2', '4', '2', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 136, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(367, '4/2/3', '4', '2', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 137, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(368, '4/2/4', '4', '2', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 138, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(369, '4/2/5', '4', '2', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 139, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(370, '4/3/1', '4', '3', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 140, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(371, '4/3/2', '4', '3', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 141, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(372, '4/3/3', '4', '3', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 142, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(373, '4/3/4', '4', '3', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 143, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(374, '4/3/5', '4', '3', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 144, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(375, '4/4/1', '4', '4', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 145, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(376, '4/4/2', '4', '4', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 146, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(377, '4/4/3', '4', '4', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 147, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(378, '4/4/4', '4', '4', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 148, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(379, '4/4/5', '4', '4', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 149, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(380, '4/5/1', '4', '5', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 150, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(381, '4/5/2', '4', '5', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 151, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(382, '4/5/3', '4', '5', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 152, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(383, '4/5/4', '4', '5', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 153, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(384, '4/5/5', '4', '5', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 154, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(385, '5/1/1', '5', '1', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 155, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(386, '5/1/2', '5', '1', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 156, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(387, '5/1/3', '5', '1', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 157, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(388, '5/1/4', '5', '1', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 158, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(389, '5/1/5', '5', '1', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 159, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(390, '5/2/1', '5', '2', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 160, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(391, '5/2/2', '5', '2', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 161, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(392, '5/2/3', '5', '2', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 162, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(393, '5/2/4', '5', '2', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 163, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(394, '5/2/5', '5', '2', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 164, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(395, '5/3/1', '5', '3', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 165, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(396, '5/3/2', '5', '3', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 166, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(397, '5/3/3', '5', '3', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 167, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(398, '5/3/4', '5', '3', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 168, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(399, '5/3/5', '5', '3', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 169, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(400, '5/4/1', '5', '4', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 170, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(401, '5/4/2', '5', '4', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 171, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(402, '5/4/3', '5', '4', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 172, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(403, '5/4/4', '5', '4', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 173, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(404, '5/4/5', '5', '4', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 174, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(405, '5/5/1', '5', '5', '1', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 175, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(406, '5/5/2', '5', '5', '2', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 176, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(407, '5/5/3', '5', '5', '3', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 177, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(408, '5/5/4', '5', '5', '4', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 178, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(409, '5/5/5', '5', '5', '5', '141', NULL, '141', '966', 'Aut pariatur Est et', NULL, NULL, NULL, NULL, NULL, 7, 11, 179, '2021-08-26 01:37:37', '2021-08-26 01:37:37', '0', '0', NULL),
(410, '30', '30', NULL, NULL, '36', NULL, '36', NULL, 'Qui eveniet quam di', NULL, '18', '40887167385752', '42982848102552', NULL, 6, 12, 43, '2021-09-07 05:58:09', '2021-09-07 05:58:38', '0', '0', NULL),
(411, '60', '60', NULL, NULL, '36', NULL, '36', NULL, 'Qui eveniet quam di', NULL, '19', '40887167418520', '42982848135320', NULL, 6, 12, 44, '2021-09-07 05:58:09', '2021-09-07 05:58:40', '0', '0', NULL),
(440, 'blacks', 'black', 's', NULL, '700', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, '59', '40641821606084', '42737065361604', NULL, 9, 24, 180, '2021-09-17 02:42:30', '2021-09-17 02:43:13', '10', '627', '10'),
(441, 'blackm', 'black', 'm', NULL, '800', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821638852', '42737065394372', NULL, 9, 24, 181, '2021-09-17 02:42:30', '2021-09-17 02:43:15', '10', '627', '10'),
(442, 'blackl', 'black', 'l', NULL, '689.7', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821671620', '42737065427140', NULL, 9, 24, 182, '2021-09-17 02:42:30', '2021-09-17 02:43:18', '10', '627', '10'),
(443, 'blackxl', 'black', 'xl', NULL, '689.7', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821704388', '42737065459908', NULL, 9, 24, 183, '2021-09-17 02:42:30', '2021-09-17 02:43:20', '10', '627', '10'),
(444, 'blackxxl', 'black', 'xxl', NULL, '689.7', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821737156', '42737065492676', NULL, 9, 24, 184, '2021-09-17 02:42:30', '2021-09-17 02:43:23', '10', '627', '10'),
(445, 'whites', 'white', 's', NULL, '689.7', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821802692', '42737065525444', NULL, 9, 24, 185, '2021-09-17 02:42:30', '2021-09-17 02:43:26', '10', '627', '10'),
(446, 'whitem', 'white', 'm', NULL, '689.7', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821835460', '42737065558212', NULL, 9, 24, 186, '2021-09-17 02:42:30', '2021-09-17 02:43:28', '10', '627', '10'),
(447, 'whitel', 'white', 'l', NULL, '689.7', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821868228', '42737065590980', NULL, 9, 24, 187, '2021-09-17 02:42:30', '2021-09-17 02:43:30', '10', '627', '10'),
(448, 'whitexl', 'white', 'xl', NULL, '689.7', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821900996', '42737065623748', NULL, 9, 24, 188, '2021-09-17 02:42:30', '2021-09-17 02:43:32', '10', '627', '10'),
(449, 'whitexxl', 'white', 'xxl', NULL, '689.7', NULL, '689.7', NULL, 'Distinctio Aut illu', NULL, NULL, '40641821933764', '42737065656516', NULL, 9, 24, 189, '2021-09-17 02:42:30', '2021-09-17 02:43:36', '10', '627', '10');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_02_095506_create_permission_tables', 1),
(5, '2021_08_02_095523_create_products_table', 2),
(6, '2021_08_03_100738_create_categories_table', 3),
(7, '2021_08_03_100752_create_sub_categories_table', 3),
(8, '2020_01_29_010501_create_plans_table', 4),
(9, '2020_01_29_230905_create_shops_table', 4),
(10, '2020_01_29_231006_create_charges_table', 4),
(11, '2020_07_03_211514_add_interval_column_to_charges_table', 4),
(12, '2020_07_03_211854_add_interval_column_to_plans_table', 4),
(14, '2021_08_04_114003_create_variants_table', 5),
(15, '2021_08_04_115325_create_product_images_table', 5),
(16, '2021_08_04_120320_create_product_categories_table', 5),
(17, '2021_08_04_120328_create_product_sub_categories_table', 5),
(18, '2021_08_12_101607_create_product_statuses_table', 6),
(19, '2021_08_04_113953_create_products_table', 7),
(29, '2021_08_23_070727_add_fields_to_users', 9),
(30, '2021_08_17_073725_create_merchant_products_table', 10),
(31, '2021_08_17_073735_create_merchant_variants_table', 10),
(32, '2021_08_17_080103_create_merchant_product_images_table', 10),
(33, '2021_08_24_075941_create_merchant_orders_table', 11),
(34, '2021_08_24_075953_create_merchant_line_items_table', 11),
(35, '2021_08_24_080005_create_merchant_customers_table', 11),
(36, '2021_08_24_090525_create_order_fulfillments_table', 12),
(37, '2021_08_24_090534_create_order_logs_table', 12),
(38, '2021_08_24_120204_create_settings_table', 13),
(39, '2021_08_24_132653_create_states_table', 14),
(40, '2021_08_24_132715_create_cities_table', 14),
(41, '2021_08_25_080640_create_shipping_routes_table', 15),
(42, '2021_08_25_111219_add_profile_to_users', 16),
(49, '2021_09_14_105838_add_commission_column_in_merchant_products_table', 17),
(50, '2021_09_14_105921_add_commission_column_in_merchant_products_variant_table', 17),
(51, '2021_09_15_062358_add_supplier_price_column_inline_items', 17),
(52, '2021_09_15_062551_add_column_in_order_for_supplier_total', 17),
(54, '2021_09_16_131111_create_order_trackings_table', 18),
(55, '2021_09_17_061756_create_fulfillment_line_items_table', 19),
(56, '2021_09_17_103201_create_order_transactions_table', 20),
(57, '2021_09_22_065856_create_finances_table', 21),
(58, '2021_09_22_065934_create_finance_logs_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 13),
(6, 'App\\Models\\User', 6),
(6, 'App\\Models\\User', 7),
(6, 'App\\Models\\User', 9),
(6, 'App\\Models\\User', 12);

-- --------------------------------------------------------

--
-- Table structure for table `order_fulfillments`
--

CREATE TABLE `order_fulfillments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fulfillment_shopify_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_fulfillment_shopify_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_company` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_fulfillments`
--

INSERT INTO `order_fulfillments` (`id`, `merchant_order_id`, `name`, `status`, `tracking_url`, `tracking_number`, `tracking_notes`, `fulfillment_shopify_id`, `admin_fulfillment_shopify_id`, `tracking_company`, `created_at`, `updated_at`) VALUES
(1, 16, '#1010.1', 'fulfilled', NULL, NULL, NULL, '3627091984580', NULL, NULL, '2021-09-17 02:59:09', '2021-09-17 02:59:09'),
(2, 17, '#1011.1', 'fulfilled', NULL, NULL, NULL, '3627707433156', NULL, NULL, '2021-09-17 09:43:20', '2021-09-17 09:43:20'),
(3, 17, '#1011.1', 'fulfilled', NULL, NULL, NULL, '3627707433156', NULL, NULL, '2021-09-17 09:50:12', '2021-09-17 09:50:12'),
(4, 18, '#1012.1', 'fulfilled', NULL, NULL, NULL, '3633975001284', NULL, NULL, '2021-09-21 08:40:23', '2021-09-21 08:40:23'),
(5, 18, '#1012.1', 'fulfilled', NULL, NULL, NULL, '3633975001284', NULL, NULL, '2021-09-21 08:43:37', '2021-09-21 08:43:37'),
(6, 19, '#1013.1', 'fulfilled', NULL, NULL, NULL, '3634079858884', NULL, NULL, '2021-09-21 08:48:17', '2021-09-21 08:48:17'),
(7, 19, '#1013.2', 'fulfilled', NULL, NULL, NULL, '3634081792196', NULL, NULL, '2021-09-21 08:51:15', '2021-09-21 08:51:15'),
(8, 20, '#1014.1', 'fulfilled', NULL, NULL, NULL, '3634102468804', NULL, NULL, '2021-09-21 09:03:03', '2021-09-21 09:03:03'),
(9, 21, '#1015.1', 'fulfilled', NULL, NULL, NULL, '3634172002500', NULL, NULL, '2021-09-21 09:40:37', '2021-09-21 09:40:37'),
(10, 22, '#1016.1', 'fulfilled', NULL, NULL, NULL, '3638112485572', NULL, NULL, '2021-09-23 02:13:38', '2021-09-23 02:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_logs`
--

CREATE TABLE `order_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_logs`
--

INSERT INTO `order_logs` (`id`, `message`, `status`, `merchant_order_id`, `created_at`, `updated_at`) VALUES
(1, 'Order synced to WeFullFill on 24 Aug, 2021 10:56 am', 'Newly Synced', 7, '2021-08-24 05:56:51', '2021-08-24 05:56:51'),
(2, 'Order synced to WeFullFill on 24 Aug, 2021 10:57 am', 'Newly Synced', 8, '2021-08-24 05:57:59', '2021-08-24 05:57:59'),
(3, 'Order synced to WeFullFill on 24 Aug, 2021 10:57 am', 'Newly Synced', 9, '2021-08-24 05:57:59', '2021-08-24 05:57:59'),
(4, 'Order synced to WeFullFill on 14 Sep, 2021 11:28 am', 'Newly Synced', 10, '2021-09-14 06:28:39', '2021-09-14 06:28:39'),
(5, 'Order synced to WeFullFill on 14 Sep, 2021 12:24 pm', 'Newly Synced', 13, '2021-09-14 07:24:15', '2021-09-14 07:24:15'),
(6, 'Order synced to Zadropship on 15 Sep, 2021 08:39 am', 'Newly Synced', 14, '2021-09-15 03:39:46', '2021-09-15 03:39:46'),
(7, 'Order synced to Zadropship on 17 Sep, 2021 07:39 am', 'Newly Synced', 15, '2021-09-17 02:39:39', '2021-09-17 02:39:39'),
(8, 'Order synced to Zadropship on 17 Sep, 2021 07:45 am', 'Newly Synced', 16, '2021-09-17 02:45:00', '2021-09-17 02:45:00'),
(9, 'A fulfillment named #1010.1 has been processed successfully on 17 Sep, 2021 07:59 am', 'Fulfillment', 16, '2021-09-17 02:59:09', '2021-09-17 02:59:09'),
(10, 'Order synced to Zadropship on 17 Sep, 2021 12:51 pm', 'Newly Synced', 17, '2021-09-17 07:51:04', '2021-09-17 07:51:04'),
(11, 'A fulfillment named #1011.1 has been processed successfully on 17 Sep, 2021 02:43 pm', 'Fulfillment', 17, '2021-09-17 09:43:20', '2021-09-17 09:43:20'),
(12, 'A fulfillment named #1011.1 has been processed successfully on 17 Sep, 2021 02:50 pm', 'Fulfillment', 17, '2021-09-17 09:50:12', '2021-09-17 09:50:12'),
(13, 'Order synced to Zadropship on 21 Sep, 2021 10:50 am', 'Newly Synced', 18, '2021-09-21 05:50:36', '2021-09-21 05:50:36'),
(14, 'A fulfillment named #1012.1 has been processed successfully on 21 Sep, 2021 01:40 pm', 'Fulfillment', 18, '2021-09-21 08:40:23', '2021-09-21 08:40:23'),
(15, 'A fulfillment named #1012.1 has been processed successfully on 21 Sep, 2021 01:43 pm', 'Fulfillment', 18, '2021-09-21 08:43:37', '2021-09-21 08:43:37'),
(16, 'Order synced to Zadropship on 21 Sep, 2021 01:45 pm', 'Newly Synced', 19, '2021-09-21 08:45:45', '2021-09-21 08:45:45'),
(17, 'A fulfillment named #1013.1 has been processed successfully on 21 Sep, 2021 01:48 pm', 'Fulfillment', 19, '2021-09-21 08:48:17', '2021-09-21 08:48:17'),
(18, 'A fulfillment named #1013.2 has been processed successfully on 21 Sep, 2021 01:51 pm', 'Fulfillment', 19, '2021-09-21 08:51:15', '2021-09-21 08:51:15'),
(19, 'Order synced to Zadropship on 21 Sep, 2021 01:56 pm', 'Newly Synced', 20, '2021-09-21 08:56:21', '2021-09-21 08:56:21'),
(20, 'A fulfillment named #1014.1 has been processed successfully on 21 Sep, 2021 02:03 pm', 'Fulfillment', 20, '2021-09-21 09:03:03', '2021-09-21 09:03:03'),
(21, 'Order synced to Zadropship on 21 Sep, 2021 02:39 pm', 'Newly Synced', 21, '2021-09-21 09:39:49', '2021-09-21 09:39:49'),
(22, 'A fulfillment named #1015.1 has been processed successfully on 21 Sep, 2021 02:40 pm', 'Fulfillment', 21, '2021-09-21 09:40:37', '2021-09-21 09:40:37'),
(23, 'Order synced to Zadropship on 22 Sep, 2021 02:20 pm', 'Newly Synced', 22, '2021-09-22 09:20:49', '2021-09-22 09:20:49'),
(24, 'A fulfillment named #1016.1 has been processed successfully on 23 Sep, 2021 07:13 am', 'Fulfillment', 22, '2021-09-23 02:13:38', '2021-09-23 02:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_trackings`
--

CREATE TABLE `order_trackings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_shipping` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_trackings`
--

INSERT INTO `order_trackings` (`id`, `supplier_id`, `order_id`, `courier_name`, `courier_code`, `number`, `url`, `cost_shipping`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, '10', '14', 'USPS', 'xrke2', 'asds', 'http://phpstack-176572-1976867.cloudwaysapps.com', '0', NULL, 0, '2021-09-16 09:03:26', '2021-09-17 00:44:18'),
(2, '10', '16', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-17 07:23:47', '2021-09-17 07:23:47'),
(14, '10', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 06:14:47', '2021-09-21 06:14:47'),
(15, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 06:36:47', '2021-09-21 06:36:47'),
(16, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 06:38:32', '2021-09-21 06:38:32'),
(17, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 07:34:27', '2021-09-21 07:34:27'),
(18, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:38:22', '2021-09-21 08:38:22'),
(19, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:39:09', '2021-09-21 08:39:09'),
(20, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:39:28', '2021-09-21 08:39:28'),
(21, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:40:08', '2021-09-21 08:40:08'),
(22, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:40:20', '2021-09-21 08:40:20'),
(23, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:42:44', '2021-09-21 08:42:44'),
(24, '13', '18', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:43:35', '2021-09-21 08:43:35'),
(25, '13', '19', '2021', 'xrke', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:46:26', '2021-09-21 08:46:26'),
(26, '10', '19', 'asd', 'xrke', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:48:15', '2021-09-21 08:48:15'),
(27, '10', '19', 'asd', 'xrke', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:51:12', '2021-09-21 08:51:12'),
(28, '13', '20', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 08:57:51', '2021-09-21 08:57:51'),
(29, '10', '20', 'asd', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 09:02:59', '2021-09-21 09:02:59'),
(30, '13', '21', '2021', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '0', NULL, 0, '2021-09-21 09:40:17', '2021-09-21 09:40:17'),
(31, '10', '21', '2021', 'xrke', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '1', NULL, 0, '2021-09-21 09:40:32', '2021-09-23 07:15:45'),
(32, '10', '22', '2020', 'xrke', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '2.569', NULL, 0, '2021-09-23 00:44:20', '2021-09-23 00:44:33'),
(33, '13', '22', '2021', 'xrke', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '6', NULL, 0, '2021-09-23 02:13:36', '2021-09-23 08:20:37'),
(34, '10', '22', 'asd', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '12', NULL, 0, '2021-09-23 06:08:37', '2021-09-23 06:08:37'),
(35, '10', '22', 'asd', 'asd', 'asd', 'https://phpstack-176572-1976867.cloudwaysapps.com/public/deployer.zip', '12', NULL, 0, '2021-09-23 06:10:12', '2021-09-23 06:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_transactions`
--

CREATE TABLE `order_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$IzM5/7xPTvaTOpaJcSMbuOm8qXtD2yLzRI7r03JGwdaogr2ZbPt2G', '2021-08-02 10:13:11'),
('kanwartalha009@gmail.com', '$2y$10$1SlnH.ZfGEKDxbpVzaSbye43LCgOq97md5Y2UJMdDW2He/Wi//Csa', '2021-08-02 10:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2021-08-02 05:17:00', '2021-08-02 05:17:00'),
(2, 'role-create', 'web', '2021-08-02 05:17:00', '2021-08-02 05:17:00'),
(3, 'role-edit', 'web', '2021-08-02 05:17:00', '2021-08-02 05:17:00'),
(4, 'role-delete', 'web', '2021-08-02 05:17:00', '2021-08-02 05:17:00'),
(5, 'product-list', 'web', '2021-08-02 05:17:00', '2021-08-02 05:17:00'),
(6, 'product-create', 'web', '2021-08-02 05:17:00', '2021-08-02 05:17:00'),
(7, 'product-edit', 'web', '2021-08-02 05:17:00', '2021-08-02 05:17:00'),
(8, 'product-delete', 'web', '2021-08-02 05:17:00', '2021-08-02 05:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `interval` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capped_amount` decimal(8,2) DEFAULT NULL,
  `terms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL,
  `test` tinyint(1) NOT NULL DEFAULT 0,
  `on_install` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compare_price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option3` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_status` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `import_count` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `images`, `type`, `vendor`, `tags`, `cost`, `price`, `compare_price`, `quantity`, `weight`, `sku`, `barcode`, `length`, `width`, `height`, `variants`, `attribute1`, `attribute2`, `attribute3`, `option1`, `option2`, `option3`, `featured_image`, `status`, `admin_status`, `supplier_id`, `created_at`, `updated_at`, `import_count`) VALUES
(2, 'New Shirt', '<p>Fringilla, molestias sapiente anim. Proident, veniam cursus porttitor tempora voluptate fugit vero, integer hendrerit. Dignissim voluptate odit quam illo adipiscing aptent potenti, architecto cumque, fuga. Quo exercitation, illo, phasellus mollis ipsa nunc nisi mi. Adipiscing qui. At aptent, recusandae adipisci, imperdiet augue consectetur pariatur quod neque sapiente amet quo irure at, senectus! Quos magna consequatur tempus sint perferendis orci ac, nam soluta incididunt, perferendis consectetuer! Condimentum, debitis aptent sapien quisque vestibulum duis litora donec primis illum magna! Earum. Tempor euismod sint irure scelerisque sagittis, maxime cursus massa irure iaculis facere pellentesque voluptatem convallis, harum, fuga elit accusamus. Excepturi sapien, commodo.<br></p>', NULL, 'Vel ipsam optio exe', 'Quo cupidatat ex sed', 'Eiusmod temporibus d', '12', '627', NULL, '655', '22', 'Distinctio Aut illu', 'Vel voluptatibus fug', '60', '58', '97', 'on', 'Color', 'size', NULL, 'black,white', 's,m,l,xl,xxl', NULL, NULL, '1', 3, 10, '2021-08-12 06:17:32', '2021-09-17 02:42:30', '7'),
(3, 'Qui ad dolore sequi', '<p>Reprehenderit integer justo incidunt corrupti, class nisl mollit taciti hic ligula augue fames cupiditate? Eros! Blanditiis qui nostra vivamus, pellentesque omnis sint blanditiis luctus, mus quasi placerat, vitae nibh senectus ultrices volutpat rhoncus, dui, doloremque, nunc, error, rem tempore mauris viverra reprehenderit commodi. Tempor occaecat! Repellendus do cupiditate! Irure a? Ullamco phasellus vel per sapiente non urna mollitia nibh natoque harum recusandae! Necessitatibus totam, non ornare officiis iste cursus, dignissimos, quasi minus, sit platea aut porttitor beatae? Volutpat? Accusantium excepturi molestias interdum similique, possimus minim consequat curabitur vestibulum voluptatum nostrud anim purus pariatur debitis eligendi, porta quam porro asperiores diam.<br></p>', NULL, 'Aut sed dolore labor', 'Duis eu tempore adi', 'Pariatur Elit quod,1,2,33', '74', '36', NULL, '619', '27', 'Qui eveniet quam di', 'Sequi enim eu unde e', '93', '36', '49', 'on', 'size', NULL, NULL, '30,60', NULL, NULL, NULL, '1', 3, 10, '2021-08-12 09:00:51', '2021-09-15 03:36:41', '14'),
(4, 'Remesol', '<p>Reprehenderit integer justo incidunt corrupti, class nisl mollit taciti hic ligula augue fames cupiditate? Eros! Blanditiis qui nostra vivamus, pellentesque omnis sint blanditiis luctus, mus quasi placerat, vitae nibh senectus ultrices volutpat rhoncus, dui, doloremque, nunc, error, rem tempore mauris viverra reprehenderit commodi. Tempor occaecat! Repellendus do cupiditate! Irure a? Ullamco phasellus vel per sapiente non urna mollitia nibh natoque harum recusandae! Necessitatibus totam, non ornare officiis iste cursus, dignissimos, quasi minus, sit platea aut porttitor beatae? Volutpat? Accusantium excepturi molestias interdum similique, possimus minim consequat curabitur vestibulum voluptatum nostrud anim purus pariatur debitis eligendi, porta quam porro asperiores diam.<br></p>', NULL, 'Repudiandae nesciunt', 'Labore sed laboris q', 'Aut minus voluptatem', '39', '141', NULL, '966', '54', 'Aut pariatur Est et', 'Neque tempore culpa', '50', '13', '21', 'on', 'c', 'b', 'd', '1,2,3,4,5', '1,2,3,4,5', '1,2,3,4,5', NULL, '1', 3, 10, '2021-08-13 02:06:42', '2021-08-26 01:37:37', '6'),
(5, 'Provident adipisici', 'Reprehenderit integer justo incidunt corrupti, class nisl mollit taciti hic ligula augue fames cupiditate? Eros! Blanditiis qui nostra vivamus, pellentesque omnis sint blanditiis luctus, mus quasi placerat, vitae nibh senectus ultrices volutpat rhoncus, dui, doloremque, nunc, error, rem tempore mauris viverra reprehenderit commodi. Tempor occaecat! Repellendus do cupiditate! Irure a? Ullamco phasellus vel per sapiente non urna mollitia nibh natoque harum recusandae! Necessitatibus totam, non ornare officiis iste cursus, dignissimos, quasi minus, sit platea aut porttitor beatae? Volutpat? Accusantium excepturi molestias interdum similique, possimus minim consequat curabitur vestibulum voluptatum nostrud anim purus pariatur debitis eligendi, porta quam porro asperiores diam.', NULL, 'Mollitia illum mini', 'Eveniet commodi min', 'Aliquip cumque ipsam', '93', '672', NULL, '565', '46', 'Aliquam esse cupidit', 'Suscipit maxime nost', '81', '48', '61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, 10, '2021-08-13 06:32:58', '2021-08-24 02:46:35', '1'),
(8, 'Kanwar', '<p>jbdkajbkdjbsakadjbakjd</p>', NULL, 'shirt', 'kanwar', '1,2,3,4,5', '8', '10', NULL, '100', '1', '123', '009', '1', '2', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, 10, '2021-08-16 03:15:49', '2021-08-24 02:43:56', '2'),
(9, 'shirt', '<p>blaw</p>', NULL, 'jj', 'kjkk', 'k,kj,ki', '19', '12', NULL, '100', '10', '123', '0009', '12', '12', '12', 'on', 'color', 'size', NULL, 'black,white', 's,m,l', NULL, NULL, '1', 3, 10, '2021-08-16 06:10:43', '2021-08-26 01:24:00', '2'),
(10, 'test supplier', '<p>test supplier<br></p>', NULL, 'sd', 'asd', 'asdsd', '12', '12', NULL, '12', '12', '12', '12', '12', '12', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 3, 13, '2021-09-17 07:46:36', '2021-09-17 07:47:47', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 2, 6, NULL, NULL),
(3, 5, 6, NULL, NULL),
(10, 12, 5, NULL, NULL),
(13, 2, 6, NULL, NULL),
(15, 3, 5, NULL, NULL),
(16, 4, 6, NULL, NULL),
(17, 5, 5, NULL, NULL),
(21, 8, 6, NULL, NULL),
(22, 9, 6, NULL, NULL),
(23, 10, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isV` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `position`, `alt`, `width`, `height`, `src`, `isV`, `variant_id`, `shop_id`, `product_id`, `created_at`, `updated_at`) VALUES
(29, '1', NULL, NULL, NULL, 'images/products/20210809072620170803_coupon_01.png', '0', NULL, NULL, 10, '2021-08-09 02:26:48', '2021-08-09 02:26:48'),
(35, '3', NULL, NULL, NULL, 'images/products/202108121400Screenshot-2021-08-10-at-4.19.41-PM.png', NULL, NULL, NULL, 3, '2021-08-12 09:00:51', '2021-08-13 06:39:14'),
(36, '4', NULL, NULL, NULL, 'images/products/202108121400Screenshot-2021-08-11-at-7.12.17-PM.png', NULL, NULL, NULL, 3, '2021-08-12 09:00:51', '2021-08-13 06:39:14'),
(37, '1', NULL, NULL, NULL, 'images/products/202108131124ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', '0', NULL, NULL, 2, '2021-08-13 06:24:53', '2021-08-13 06:24:53'),
(38, '1', NULL, NULL, NULL, 'images/products/202108131131ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', '0', NULL, NULL, 4, '2021-08-13 06:31:55', '2021-08-13 06:31:55'),
(39, NULL, NULL, NULL, NULL, 'images/products/202108131132ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', NULL, NULL, NULL, 5, '2021-08-13 06:32:58', '2021-08-13 06:32:58'),
(40, '2', NULL, NULL, NULL, 'images/products/202108131134Mg-Cal_720x.png', '0', NULL, NULL, 3, '2021-08-13 06:34:47', '2021-08-13 06:39:14'),
(41, '1', NULL, NULL, NULL, 'images/products/202108131139ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', '0', NULL, NULL, 3, '2021-08-13 06:39:09', '2021-08-13 06:39:14'),
(42, NULL, NULL, NULL, NULL, 'images/products/202108160815Mg-Cal_720x.png', NULL, NULL, NULL, 8, '2021-08-16 03:15:49', '2021-08-16 03:15:49'),
(43, '2', NULL, NULL, NULL, 'images/products/202108161110Mg-Cal_720x.png', NULL, NULL, NULL, 9, '2021-08-16 06:10:43', '2021-08-16 06:13:41'),
(44, '1', NULL, NULL, NULL, 'images/products/202108161113ezgif.com-gif-maker_4_833f832c-bfb7-4760-8891-27caff85c084_540x.jpg', '0', NULL, NULL, 9, '2021-08-16 06:13:29', '2021-08-16 06:13:41'),
(45, NULL, NULL, NULL, NULL, 'images/products/202109171246494272-how-we-test-drones.jpg', NULL, NULL, NULL, 10, '2021-09-17 07:46:36', '2021-09-17 07:46:36'),
(46, NULL, NULL, NULL, NULL, 'images/products/202109171246202005082043touch-screen.png', NULL, NULL, NULL, 10, '2021-09-17 07:46:36', '2021-09-17 07:46:36'),
(47, NULL, NULL, NULL, NULL, 'images/products/202109171246Drone.jpg', NULL, NULL, NULL, 10, '2021-09-17 07:46:36', '2021-09-17 07:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_statuses`
--

CREATE TABLE `product_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_color` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_statuses`
--

INSERT INTO `product_statuses` (`id`, `title`, `bg_color`, `text_color`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Pending', '#6fb1d3', '#f5f5f5', 'All Pending Products to approve', '2021-08-12 05:33:00', '2021-08-12 05:43:38'),
(3, 'Approved', '#32c81e', '#ffffff', 'Approved to be sell by merchant', '2021-08-12 06:01:20', '2021-08-26 01:30:44'),
(4, 'Declined', '#ec5b5b', '#f7f3f3', 'Declined', '2021-08-12 06:02:46', '2021-08-12 06:02:46'),
(5, 'Changes Required', '#eff25a', '#faf9f9', 'Kindly Review Product and Make Changes', '2021-08-12 06:03:31', '2021-08-12 06:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `product_id`, `subcategory_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, NULL, NULL),
(2, 2, 4, NULL, NULL),
(5, 5, 4, NULL, NULL),
(13, 2, 4, NULL, NULL),
(14, 4, 3, NULL, NULL),
(18, 8, 3, NULL, NULL),
(19, 8, 4, NULL, NULL),
(20, 9, 3, NULL, NULL),
(21, 9, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-08-02 05:17:59', '2021-08-02 05:17:59'),
(2, 'Supplier', 'web', '2021-08-02 05:28:20', '2021-08-02 07:41:55'),
(6, 'Merchant', 'web', '2021-08-13 05:56:39', '2021-08-13 05:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_label` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `margin` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `currency`, `currency_label`, `margin`, `created_at`, `updated_at`) VALUES
(1, '$', 'USD', '10', '2021-08-24 07:19:46', '2021-08-25 01:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_routes`
--

CREATE TABLE `shipping_routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin_city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `destination_city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_routes`
--

INSERT INTO `shipping_routes` (`id`, `price`, `processing_time`, `shipping_time`, `origin_city_id`, `destination_city_id`, `created_at`, `updated_at`) VALUES
(3, '10', '1', '2', 1, 2, '2021-08-25 03:28:30', '2021-08-25 03:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Punjab', '2021-08-24 09:06:40', '2021-08-25 01:22:49'),
(4, 'Sindh', '2021-08-25 01:32:57', '2021-08-25 01:32:57'),
(5, 'KPK', '2021-08-25 01:33:03', '2021-08-25 01:33:03'),
(6, 'Baluchistan', '2021-08-25 01:33:20', '2021-08-25 01:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `title`, `slug`, `img`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 'NEW', 'new', '/images/category/forgot-2.png', 6, '2021-08-04 06:17:18', '2021-08-04 06:17:18'),
(4, 'kanwar', 'kanwar', '/images/category/telephone.png', 6, '2021-08-04 06:29:05', '2021-08-04 06:34:10');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shopify_grandfathered` tinyint(1) NOT NULL DEFAULT 0,
  `shopify_namespace` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopify_freemium` tinyint(1) NOT NULL DEFAULT 0,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `service` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_img` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `shopify_grandfathered`, `shopify_namespace`, `shopify_freemium`, `plan_id`, `deleted_at`, `service`, `location_id`, `business_name`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone`, `profile_img`) VALUES
(1, 'Talha Kanwar', 'admin@gmail.com', NULL, '$2y$10$OAjmacEQKOOVM4fJMZBGueNcbOS9v2XuCHUiqGc53C0GZVNAsSK0S', 'npaEPaFWx5uRCi5h2hFZyMl7yKWNI70jNWfjVb6snWYYAgbp6UOJUiC6aSz3', '2021-08-02 05:17:59', '2021-09-07 04:33:16', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/images/profile/Screenshot 2021-09-02 at 4.41.57 PM.png'),
(5, 'Kanwar', 'kanwartalha009@gmail.com', NULL, '$2y$10$OAjmacEQKOOVM4fJMZBGueNcbOS9v2XuCHUiqGc53C0GZVNAsSK0S', NULL, '2021-08-12 07:58:44', '2021-08-12 07:58:44', 0, '$2y$10$CHuYdoqhDNM.CiHY3NKZB.zVZwLa5Qqtv/nwrf.Um.SXjkzXHofUe', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'nutrifypk.myshopify.com', 'shop@nutrifypk.myshopify.com', NULL, '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', NULL, '2021-08-13 05:52:13', '2021-08-13 06:04:12', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'redixitsolution.myshopify.com', 'shop@redixitsolution.myshopify.com', NULL, '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', NULL, '2021-08-16 02:05:49', '2021-08-25 07:16:21', 0, NULL, 0, NULL, NULL, 'ZADropship', '64323158168', 'Malachi Snow', '32 White Milton Avenue', 'Non sit alias omnis', 'Dolore est aliquip', 'Accusantium aut quis', '88324', 'Fuga Nisi aut eaque', '99', '/images/profile/Screenshot 2021-08-23 at 10.30.44 PM.png'),
(9, 'ffb-dropshipping-app.myshopify.com', 'shop@ffb-dropshipping-app.myshopify.com', NULL, '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', NULL, '2021-09-16 02:25:21', '2021-09-16 02:25:40', 0, NULL, 0, NULL, NULL, 'ZADropship', '65371275460', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'sup', 'afeef.ali@tetralogicx.com', NULL, '$2y$10$.29T9hvsSOAUn8jsFhLGlu9p2sF2FRNCoXWu43gsxME7n14GByf3y', NULL, '2021-09-15 05:46:35', '2021-09-15 05:46:35', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'ffb1-dropshipping-app.myshopify.com', 'shop@ffb1-dropshipping-app.myshopify.com', NULL, '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', NULL, '2021-09-14 01:42:00', '2021-09-16 02:15:58', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Supplier', 'supplier@gmail.com', NULL, '$2y$10$.29T9hvsSOAUn8jsFhLGlu9p2sF2FRNCoXWu43gsxME7n14GByf3y', 'HQpXLOxOcs2g0qeZ5N8tHZhHwQ9Ya3SFuYDIRQtFRJpdgkpIruwezhP95Lvi', '2021-09-17 07:45:24', '2021-09-17 07:45:24', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compare_price` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `title`, `option1`, `option2`, `option3`, `price`, `compare_price`, `quantity`, `sku`, `barcode`, `weight`, `cost`, `image_id`, `product_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(29, '1', '1', NULL, NULL, '801', NULL, NULL, 'Aspernatur consequat', NULL, NULL, '61', NULL, 10, 10, '2021-08-05 10:48:28', '2021-08-12 02:30:34'),
(30, '2', '2', NULL, NULL, '801', NULL, NULL, 'Aspernatur consequat', NULL, NULL, '61', NULL, 10, 10, '2021-08-05 10:48:28', '2021-08-12 02:30:34'),
(35, 'k/1', 'k', '1', NULL, '572', NULL, '818', 'Elit laborum Ex ut', NULL, NULL, '30', NULL, 5, 10, '2021-08-09 07:27:59', '2021-08-09 07:27:59'),
(36, 'k/2', 'k', '2', NULL, '572', NULL, '818', 'Elit laborum Ex ut', NULL, NULL, '30', NULL, 5, 10, '2021-08-09 07:27:59', '2021-08-09 07:27:59'),
(37, 'b/1', 'b', '1', NULL, '572', NULL, '818', 'Elit laborum Ex ut', NULL, NULL, '30', NULL, 5, 10, '2021-08-09 07:27:59', '2021-08-09 07:27:59'),
(38, 'b/2', 'b', '2', NULL, '572', NULL, '818', 'Elit laborum Ex ut', NULL, NULL, '30', NULL, 5, 10, '2021-08-09 07:27:59', '2021-08-09 07:27:59'),
(43, '30', '30', NULL, NULL, '36', NULL, NULL, 'Qui eveniet quam di', NULL, NULL, '74', 41, 3, 10, '2021-08-16 01:32:36', '2021-08-16 01:45:22'),
(44, '60', '60', NULL, NULL, '36', NULL, NULL, 'Qui eveniet quam di', NULL, NULL, '74', 40, 3, 10, '2021-08-16 01:32:36', '2021-08-16 01:45:22'),
(55, '1/1/1', '1', '1', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(56, '1/1/2', '1', '1', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(57, '1/1/3', '1', '1', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(58, '1/1/4', '1', '1', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(59, '1/1/5', '1', '1', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(60, '1/2/1', '1', '2', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(61, '1/2/2', '1', '2', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(62, '1/2/3', '1', '2', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(63, '1/2/4', '1', '2', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(64, '1/2/5', '1', '2', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(65, '1/3/1', '1', '3', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(66, '1/3/2', '1', '3', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(67, '1/3/3', '1', '3', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(68, '1/3/4', '1', '3', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(69, '1/3/5', '1', '3', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(70, '1/4/1', '1', '4', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(71, '1/4/2', '1', '4', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(72, '1/4/3', '1', '4', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(73, '1/4/4', '1', '4', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(74, '1/4/5', '1', '4', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(75, '1/5/1', '1', '5', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(76, '1/5/2', '1', '5', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(77, '1/5/3', '1', '5', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(78, '1/5/4', '1', '5', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(79, '1/5/5', '1', '5', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(80, '2/1/1', '2', '1', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(81, '2/1/2', '2', '1', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(82, '2/1/3', '2', '1', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(83, '2/1/4', '2', '1', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(84, '2/1/5', '2', '1', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(85, '2/2/1', '2', '2', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(86, '2/2/2', '2', '2', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(87, '2/2/3', '2', '2', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(88, '2/2/4', '2', '2', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(89, '2/2/5', '2', '2', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(90, '2/3/1', '2', '3', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(91, '2/3/2', '2', '3', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(92, '2/3/3', '2', '3', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(93, '2/3/4', '2', '3', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(94, '2/3/5', '2', '3', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(95, '2/4/1', '2', '4', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(96, '2/4/2', '2', '4', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(97, '2/4/3', '2', '4', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(98, '2/4/4', '2', '4', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(99, '2/4/5', '2', '4', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(100, '2/5/1', '2', '5', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(101, '2/5/2', '2', '5', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(102, '2/5/3', '2', '5', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(103, '2/5/4', '2', '5', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(104, '2/5/5', '2', '5', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(105, '3/1/1', '3', '1', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(106, '3/1/2', '3', '1', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(107, '3/1/3', '3', '1', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(108, '3/1/4', '3', '1', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(109, '3/1/5', '3', '1', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(110, '3/2/1', '3', '2', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(111, '3/2/2', '3', '2', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(112, '3/2/3', '3', '2', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(113, '3/2/4', '3', '2', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(114, '3/2/5', '3', '2', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(115, '3/3/1', '3', '3', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(116, '3/3/2', '3', '3', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(117, '3/3/3', '3', '3', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(118, '3/3/4', '3', '3', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(119, '3/3/5', '3', '3', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(120, '3/4/1', '3', '4', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(121, '3/4/2', '3', '4', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(122, '3/4/3', '3', '4', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(123, '3/4/4', '3', '4', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(124, '3/4/5', '3', '4', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(125, '3/5/1', '3', '5', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(126, '3/5/2', '3', '5', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(127, '3/5/3', '3', '5', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(128, '3/5/4', '3', '5', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(129, '3/5/5', '3', '5', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(130, '4/1/1', '4', '1', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(131, '4/1/2', '4', '1', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(132, '4/1/3', '4', '1', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(133, '4/1/4', '4', '1', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(134, '4/1/5', '4', '1', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(135, '4/2/1', '4', '2', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(136, '4/2/2', '4', '2', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(137, '4/2/3', '4', '2', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(138, '4/2/4', '4', '2', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(139, '4/2/5', '4', '2', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(140, '4/3/1', '4', '3', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(141, '4/3/2', '4', '3', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(142, '4/3/3', '4', '3', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(143, '4/3/4', '4', '3', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(144, '4/3/5', '4', '3', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(145, '4/4/1', '4', '4', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(146, '4/4/2', '4', '4', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(147, '4/4/3', '4', '4', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(148, '4/4/4', '4', '4', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(149, '4/4/5', '4', '4', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(150, '4/5/1', '4', '5', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(151, '4/5/2', '4', '5', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(152, '4/5/3', '4', '5', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(153, '4/5/4', '4', '5', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(154, '4/5/5', '4', '5', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(155, '5/1/1', '5', '1', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(156, '5/1/2', '5', '1', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(157, '5/1/3', '5', '1', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(158, '5/1/4', '5', '1', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(159, '5/1/5', '5', '1', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(160, '5/2/1', '5', '2', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(161, '5/2/2', '5', '2', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(162, '5/2/3', '5', '2', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(163, '5/2/4', '5', '2', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(164, '5/2/5', '5', '2', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(165, '5/3/1', '5', '3', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(166, '5/3/2', '5', '3', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(167, '5/3/3', '5', '3', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(168, '5/3/4', '5', '3', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(169, '5/3/5', '5', '3', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(170, '5/4/1', '5', '4', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(171, '5/4/2', '5', '4', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(172, '5/4/3', '5', '4', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(173, '5/4/4', '5', '4', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(174, '5/4/5', '5', '4', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(175, '5/5/1', '5', '5', '1', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(176, '5/5/2', '5', '5', '2', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(177, '5/5/3', '5', '5', '3', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(178, '5/5/4', '5', '5', '4', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(179, '5/5/5', '5', '5', '5', '141', NULL, '966', 'Aut pariatur Est et', NULL, NULL, '39', NULL, 4, 10, '2021-08-16 02:52:00', '2021-08-16 02:52:00'),
(180, 'blacks', 'black', 's', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(181, 'blackm', 'black', 'm', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(182, 'blackl', 'black', 'l', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(183, 'blackxl', 'black', 'xl', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(184, 'blackxxl', 'black', 'xxl', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(185, 'whites', 'white', 's', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(186, 'whitem', 'white', 'm', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(187, 'whitel', 'white', 'l', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(188, 'whitexl', 'white', 'xl', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(189, 'whitexxl', 'white', 'xxl', NULL, '627', NULL, NULL, 'Distinctio Aut illu', NULL, NULL, '12', NULL, 2, 10, '2021-08-16 02:52:50', '2021-08-26 07:08:02'),
(190, 'black/s', 'black', 's', NULL, '12', NULL, '100', '123', NULL, NULL, '19', 43, 9, 10, '2021-08-16 06:10:43', '2021-08-16 06:13:18'),
(191, 'black/m', 'black', 'm', NULL, '12', NULL, '100', '123', NULL, NULL, '19', NULL, 9, 10, '2021-08-16 06:10:43', '2021-08-16 06:10:43'),
(192, 'black/l', 'black', 'l', NULL, '12', NULL, '100', '123', NULL, NULL, '19', NULL, 9, 10, '2021-08-16 06:10:43', '2021-08-16 06:10:43'),
(193, 'white/s', 'white', 's', NULL, '12', NULL, '100', '123', NULL, NULL, '19', NULL, 9, 10, '2021-08-16 06:10:43', '2021-08-16 06:10:43'),
(194, 'white/m', 'white', 'm', NULL, '12', NULL, '100', '123', NULL, NULL, '19', NULL, 9, 10, '2021-08-16 06:10:43', '2021-08-16 06:10:43'),
(195, 'white/l', 'white', 'l', NULL, '12', NULL, '100', '123', NULL, NULL, '19', NULL, 9, 10, '2021-08-16 06:10:43', '2021-08-16 06:10:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charges_user_id_foreign` (`user_id`),
  ADD KEY `charges_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_logs`
--
ALTER TABLE `finance_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fulfillment_line_items`
--
ALTER TABLE `fulfillment_line_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_customers`
--
ALTER TABLE `merchant_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_line_items`
--
ALTER TABLE `merchant_line_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_orders`
--
ALTER TABLE `merchant_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_products`
--
ALTER TABLE `merchant_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_product_images`
--
ALTER TABLE `merchant_product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_variants`
--
ALTER TABLE `merchant_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `order_fulfillments`
--
ALTER TABLE `order_fulfillments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_logs`
--
ALTER TABLE `order_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_trackings`
--
ALTER TABLE `order_trackings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_transactions`
--
ALTER TABLE `order_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_statuses`
--
ALTER TABLE `product_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_routes`
--
ALTER TABLE `shipping_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `finance_logs`
--
ALTER TABLE `finance_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fulfillment_line_items`
--
ALTER TABLE `fulfillment_line_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `merchant_customers`
--
ALTER TABLE `merchant_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `merchant_line_items`
--
ALTER TABLE `merchant_line_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `merchant_orders`
--
ALTER TABLE `merchant_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `merchant_products`
--
ALTER TABLE `merchant_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `merchant_product_images`
--
ALTER TABLE `merchant_product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `merchant_variants`
--
ALTER TABLE `merchant_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=450;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_fulfillments`
--
ALTER TABLE `order_fulfillments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_logs`
--
ALTER TABLE `order_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_trackings`
--
ALTER TABLE `order_trackings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_transactions`
--
ALTER TABLE `order_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_statuses`
--
ALTER TABLE `product_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_routes`
--
ALTER TABLE `shipping_routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `charges`
--
ALTER TABLE `charges`
  ADD CONSTRAINT `charges_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  ADD CONSTRAINT `charges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
