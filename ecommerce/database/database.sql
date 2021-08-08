-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2021 at 11:20 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aminsale_eco`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `pin`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Ridoy Paul', 'cse.ridoypaul@gmail.com', '$2y$10$/DHvyufDkfAtg0SMhtFM5uwAtbV.3.xlCq.VTLhLIbGRuDmkO7Nki', 2426, 1, '2021-06-14 04:59:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_wallets`
--

CREATE TABLE `admin_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point_or_tk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum_buy` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_wallets`
--

INSERT INTO `admin_wallets` (`id`, `campaign_name`, `type`, `point_or_tk`, `price_amount`, `maximum_buy`, `start_date`, `exp_date`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Registration Promotion', 'registration', 'point', '500', NULL, '2021-06-28', '2021-06-30', '0', '2021-06-27 18:00:00', '2021-06-27 18:00:00'),
(2, 'Sell Campaign', 'sell', 'point', '200', '500', '2021-06-28', '2021-07-30', '1', '2021-06-27 18:00:00', '2021-07-03 18:00:00'),
(3, 'Registration Promotion for this week', 'registration', 'tk', '100', NULL, '2021-06-27', '2021-07-07', '1', '2021-06-27 18:00:00', NULL),
(4, 'Sell Promotion', 'sell', 'tk', '50', '1000', '2021-07-02', '2021-07-08', '0', '2021-06-30 18:00:00', '2021-06-30 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta_title` mediumtext COLLATE utf8mb4_unicode_ci,
  `meta_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `url`, `image`, `alt`, `description`, `meta_title`, `meta_description`, `author`, `date`, `created_at`, `updated_at`) VALUES
(1, 'ALSO THE LEAP INTO ELECTRONI', 'also-the-leap-into-electroni', 'images/1705005499893252.jpg', 'ALSO THE LEA', '<p>s ipsum scelerisque nisl, nec iaculis leo elit id arcu. Aliquam id ante elit. Donec commodo purus eget lacus pharetra, et egestas metus blandit. Quisque pellentesque porta urna.&nbsp;paul</p>\r\n\r\n<p>&nbsp;</p>', 'Nulla quam turpis,', '<ul>\r\n	<li>Donec ut metus sit amet elit consectetur vel turpis.</li>\r\n	<li>Aenean in mi eu elit mollis tincidunt.</li>\r\n	<li>Etiam blandit</li>\r\n	<li>In scelerisque libero ut mi ornare, neque pulvinar.</li>\r\n	<li>Morbi molestie lacus blandit interdum sodales.</li>\r\n	<li>Curabitur eleifend velit molestie eleifend interdum.</li>\r\n	<li>paul</li>\r\n</ul>', 'Ridoy Paul', '2021-07-21', '2021-07-11 10:12:34', NULL),
(2, 'ALSO THE LEAP INTO ELECTRONIC TYPESETTING, REMAINING ESSENTIALLY UNCHANGED. paul', 'also-the-leap-into-electronic-typesetting,-remaining-essentially-unchanged.-paul', 'images/1705004250025289.jpg', 'ALSO THE LEAP INTO ELECTRONIC TYPESETTING, REMAINING ESSENTIALLY UNCHANGED. paul', '<p>Fusce scelerisque augue a viverra semper. Etiam nisi nibh, vestibulum quis augue id, imperdiet fringilla dolor. Nulla sed nisl vel nisi cursus finibus. Vivamus ut augue nec justo viverra laoreet. Nunc efficitur, arcu ac cursus gravida, lorem elit commodo urna, id viverra libero tellus non ipsum. Fusce molestie ultrices nibh feugiat pretium. Donec pulvinar arcu metus, et dapibus odio condimentum id. Quisque malesuada mauris sit amet dui feugiat, ut pretium mauris luctus. Ut aliquam, tellus nec molestie condimentum, tellus arcu dignissim quam, a gravida nunc nulla vel magna. Sed pulvinar tortor et euismod blandit. Proin accumsan orci ac nunc fermentum vehicula.</p>\r\n\r\n<p>Cras quis neque urna. Pellentesque mollis, dui nec elementum elementum, ipsum quam suscipit ligula, sit amet lobortis dolor sem sed neque. Vivamus consequat est non sodales efficitur. Aliquam sodales eleifend sodales. Aliquam auctor ipsum quis nisl facilisis, at convallis mauris iaculis. Duis eleifend, magna ac convallis blandit, dui dui auctor leo, sed tincidunt nisi mauris ut nulla. Praesent porttitor dui ac turpis commodo porttitor. Integer ligula nisi, bibendum non sem at, porta condimentum dui.</p>\r\n\r\n<p>Proin id eleifend diam, euismod dictum nibh. Ut ullamcorper in purus at tempor. Nullam mattis risus nec velit semper lobortis. Donec accumsan ligula fermentum, ultricies massa eget, cursus leo. Suspendisse placerat elit et lacus aliquam, ut elementum leo aliquet. Integer ornare, ipsum eu lacinia viverra, lectus ipsum scelerisque nisl, nec iaculis leo elit id arcu. Aliquam id ante elit. Donec commodo purus eget lacus pharetra, et egestas metus blandit. Quisque pellentesque porta urna.&nbsp;paul</p>\r\n\r\n<p>&nbsp;</p>', 'Nulla quam turpis, commodo et placerat eu, mollis ut odio. Donec pellentesque egestas consequat. Vestibulum ante ipsum primis in', '<ul>\r\n	<li>Donec ut metus sit amet elit consectetur vel turpis.</li>\r\n	<li>Aenean in mi eu elit mollis tincidunt.</li>\r\n	<li>Etiam blandit metus vitae purus lacinia ultricies.</li>\r\n	<li>Nunc quis nulla sagittis, tempus metus.</li>\r\n	<li>In scelerisque libero ut mi ornare, neque pulvinar.</li>\r\n	<li>Morbi molestie lacus blandit interdum sodales.</li>\r\n	<li>Curabitur eleifend velit molestie eleifend interdum.</li>\r\n	<li>Vestibulum fringilla tortor et lorem sagittis,</li>\r\n	<li>In scelerisque libero ut mi ornare, neque pulvinar.</li>\r\n	<li>Morbi molestie lacus blandit interdum sodales.</li>\r\n	<li>Curabitur eleifend velit molestie eleifend interdum.</li>\r\n	<li>paul</li>\r\n</ul>', 'Ridoy Paul', '2021-07-11', '2021-07-11 10:11:02', NULL),
(3, 'blog 3', 'blog-3', 'images/1705092632619179.jpg', 'dfgfd', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'this is the slider q', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'Ridoy Paul', '2021-07-12', '2021-07-12 09:17:34', NULL),
(4, 'blog 4', 'blog-4', 'images/1705092661366763.png', 'dfgfd', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'this is the slider q', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'Ridoy Paul', '2021-07-12', '2021-07-12 09:17:58', NULL),
(5, 'blog 5', 'blog-5', 'images/1705092686070641.jpg', 'dfgfd', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'this is the slider q', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'Ridoy Paul', '2021-07-12', '2021-07-12 09:18:22', NULL),
(6, 'blog 6', 'blog-6', 'images/1705092753732080.jpg', 'dfgfd', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'this is the slider q', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'Ridoy Paul', '2021-07-12', '2021-07-12 09:19:26', NULL),
(7, 'blog 7', 'blog-7', 'images/1705092811333738.jpg', 'dfgfd', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'this is the slider q', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'Ridoy Paul', '2021-07-12', '2021-07-12 09:20:21', NULL),
(8, 'blog 8', 'blog-8', 'images/1705092861774429.jpg', 'dfgfd', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'this is the slider q', '<p>The&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag defines metadata about an HTML document. Metadata is data (information) about data.</p>\r\n\r\n<p><code>&lt;meta&gt;</code>&nbsp;tags always go inside the &lt;head&gt; element, and are typically used to specify character set, page description, keywords, author of the document, and viewport settings.</p>\r\n\r\n<p>Metadata will not be displayed on the page, but is machine parsable.</p>\r\n\r\n<p>Metadata is used by browsers (how to display content or reload page), search engines (keywords), and other web services.</p>\r\n\r\n<p>There is a method to let web designers take control over the viewport (the user&#39;s visible area of a web page), through the&nbsp;<code>&lt;meta&gt;</code>&nbsp;tag (See &quot;Setting The Viewport&quot; example below).</p>', 'Ridoy Paul', '2021-07-12', '2021-07-12 09:21:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `url`, `image`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', 'samsung', 'images/1702610991431716.jpg', 1, '2021-06-14 23:28:18', '2021-06-14 18:00:00'),
(2, 'Evaly 900', 'evaly-900', 'images/1702610826745039.jpeg', 1, '2021-06-14 23:30:29', '2021-06-14 18:00:00'),
(3, 'Realme', 'realme', 'images/1704660104689272.jpg', 1, '2021-07-07 14:42:42', NULL),
(4, 'Walton', 'walton', 'images/1704966063534349.jpg', 1, '2021-07-11 10:45:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('Reg','Not_Reg') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `price` double NOT NULL,
  `isVariation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_variations`
--

CREATE TABLE `cart_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cartsID` int(11) NOT NULL,
  `variID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` int(11) NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `url`, `serial_number`, `image`, `active`, `created_at`, `updated_at`) VALUES
(1, 'FARA IT Fusion', 'fara-it-fusion', 4, 'images/1702540980505593.png', 1, '2021-06-13 18:00:00', '2021-07-08 07:48:14'),
(2, 'Ridoy Paul', 'ridoy-paul', 2, 'images/1702560486565737.jpg', 1, '2021-06-13 18:00:00', NULL),
(3, 'Paper', 'paper', 3, 'images/1702971399004421.png', 1, '2021-06-18 18:00:00', NULL),
(4, 'Organic Food', 'organic-food', 1, 'images/1702971433994958.jpg', 1, '2021-06-18 18:00:00', '2021-07-08 07:47:43'),
(5, 'Offer Of The Day', 'offer-of-the-day', 5, 'images/1702971542944636.png', 1, '2021-06-18 18:00:00', NULL),
(6, 'Fruits Of Summer', 'fruits-of-summer', 6, 'images/1702971564605028.jpg', 1, '2021-06-18 18:00:00', NULL),
(7, 'Fruits & Vegetables', 'fruits-&-vegetables', 7, 'images/1702971584877106.png', 1, '2021-06-18 18:00:00', NULL),
(8, 'Household', 'household', 8, 'images/1702971621285486.png', 1, '2021-06-18 18:00:00', NULL);

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
(1, '2021_06_10_100847_create_admins_table', 1),
(2, '2021_06_11_152723_create_categories_table', 1),
(3, '2021_06_12_120546_create_shop_settings_table', 1),
(4, '2021_06_14_115641_create_sub_categories_table', 2),
(5, '2021_06_15_050637_create_brands_table', 3),
(6, '2021_06_15_065328_create_products_table', 4),
(7, '2021_06_17_051425_create_varieations_table', 5),
(8, '2021_06_17_094641_create_product_variations_table', 6),
(9, '2021_06_21_085304_create_carts_table', 7),
(10, '2021_06_21_090028_create_cart_variations_table', 8),
(11, '2021_06_24_063826_create_shipping_charges_table', 9),
(12, '2021_06_24_075500_create_promo_codes_table', 10),
(13, '2021_06_25_155504_create_shipping_sub_areas_table', 11),
(14, '2014_10_12_000000_create_users_table', 12),
(15, '2021_06_27_155556_create_admin_wallets_table', 13),
(16, '2021_07_02_101038_create_payment_methods_table', 14),
(17, '2021_07_03_045326_create_orders_table', 15),
(18, '2021_07_03_055049_create_orders_products_table', 15),
(19, '2021_07_03_055849_create_orders_product_variations_table', 15),
(20, '2021_07_05_142156_create_sliders_table', 16),
(21, '2021_07_08_161817_create_promotion_banners_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `userPhone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_note` text COLLATE utf8mb4_unicode_ci,
  `shipping_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_to_another_address` text COLLATE utf8mb4_unicode_ci,
  `subtotal` double NOT NULL,
  `shippingID` int(11) NOT NULL,
  `shippingCrg` double NOT NULL,
  `couponDiscount` double DEFAULT NULL,
  `wallet_bl` double DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_cancel` int(11) NOT NULL DEFAULT '0',
  `cancel_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_cancel_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invID`, `userID`, `userPhone`, `order_note`, `shipping_address`, `ship_to_another_address`, `subtotal`, `shippingID`, `shippingCrg`, `couponDiscount`, `wallet_bl`, `payment_method`, `transactionID`, `date`, `order_status`, `order_cancel`, `cancel_by`, `order_cancel_reason`, `created_at`, `updated_at`) VALUES
(8, '0407211', 12, '01627382866', NULL, NULL, NULL, 5400, 1, 70, 70, 25, 'cashonD', NULL, '2021-07-04', 'processing', 0, NULL, NULL, '2021-07-04 10:07:58', '2021-07-09 09:41:31'),
(9, '0407212', 12, '01627382866', NULL, NULL, NULL, 1200, 1, 70, 0, 12.5, 'Rocket', 'R56T', '2021-07-04', 'delivered', 0, NULL, NULL, '2021-07-04 10:35:08', NULL),
(10, '0807213', 12, '01627382866', NULL, NULL, NULL, 3115, 3, 100, 0, 6.25, 'cashonD', NULL, '2021-07-08', 'canceled', 1, 'user', 'Expected delivery date has changed and the product is arriving at a later date.', '2021-07-08 08:01:01', '2021-07-09 05:00:35'),
(11, '0708214', 16, '01780504501', NULL, 'mirpur10', NULL, 110, 1, 70, 0, 0, 'cashonD', NULL, '2021-08-07', 'pending', 0, NULL, NULL, '2021-08-07 09:32:29', NULL),
(12, '0708215', 12, '01627382866', NULL, 'Shah Ali plaza-1205. Kandir par, 1012, Comilla', NULL, 473, 1, 70, 0, 0, 'cashonD', NULL, '2021-08-07', 'pending', 0, NULL, NULL, '2021-08-07 16:11:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `qty` double NOT NULL,
  `price` double NOT NULL,
  `is_variable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `invID`, `pid`, `qty`, `price`, `is_variable`, `created_at`, `updated_at`) VALUES
(33, '0407211', 15, 2, 500, '1', '2021-07-04 10:07:58', NULL),
(34, '0407211', 16, 1, 200, 'variation', '2021-07-04 10:07:58', NULL),
(35, '0407211', 14, 5, 800, '1', '2021-07-04 10:07:58', NULL),
(36, '0407211', 17, 1, 200, 'variation', '2021-07-04 10:07:58', NULL),
(37, '0407212', 13, 2, 200, '1', '2021-07-04 10:35:08', NULL),
(38, '0407212', 14, 1, 800, '1', '2021-07-04 10:35:08', NULL),
(39, '0507213', 17, 1, 200, 'variation', '2021-07-05 03:45:01', NULL),
(40, '0507213', 16, 1, 200, 'variation', '2021-07-05 03:45:01', NULL),
(41, '0507213', 15, 1, 500, '1', '2021-07-05 03:45:01', NULL),
(42, '0507213', 14, 1, 800, '1', '2021-07-05 03:45:01', NULL),
(43, '0507213', 17, 1, 200, 'variation', '2021-07-05 03:52:37', NULL),
(44, '0507213', 16, 1, 200, 'variation', '2021-07-05 03:52:37', NULL),
(45, '0507213', 15, 1, 500, '1', '2021-07-05 03:52:37', NULL),
(46, '0507213', 14, 1, 800, '1', '2021-07-05 03:52:37', NULL),
(47, '0507213', 17, 1, 200, 'variation', '2021-07-05 03:53:14', NULL),
(48, '0507213', 16, 1, 200, 'variation', '2021-07-05 03:53:14', NULL),
(49, '0507213', 15, 1, 500, '1', '2021-07-05 03:53:14', NULL),
(50, '0507213', 14, 1, 800, '1', '2021-07-05 03:53:14', NULL),
(51, '0507213', 17, 1, 200, 'variation', '2021-07-05 03:53:26', NULL),
(52, '0507213', 16, 1, 200, 'variation', '2021-07-05 03:53:26', NULL),
(53, '0507213', 15, 1, 500, '1', '2021-07-05 03:53:26', NULL),
(54, '0507213', 14, 1, 800, '1', '2021-07-05 03:53:26', NULL),
(55, '0507213', 17, 1, 200, 'variation', '2021-07-05 03:55:33', NULL),
(56, '0507213', 16, 1, 200, 'variation', '2021-07-05 03:55:33', NULL),
(57, '0507213', 15, 1, 500, '1', '2021-07-05 03:55:33', NULL),
(58, '0507213', 14, 1, 800, '1', '2021-07-05 03:55:33', NULL),
(59, '0807213', 22, 7, 55, '1', '2021-07-08 08:01:01', NULL),
(60, '0807213', 23, 2, 66, '1', '2021-07-08 08:01:01', NULL),
(61, '0807213', 15, 2, 500, '1', '2021-07-08 08:01:01', NULL),
(62, '0807213', 14, 1, 800, '1', '2021-07-08 08:01:01', NULL),
(63, '0807213', 13, 1, 200, '1', '2021-07-08 08:01:01', NULL),
(64, '0807213', 18, 2, 44, '1', '2021-07-08 08:01:01', NULL),
(65, '0807213', 21, 1, 55, '1', '2021-07-08 08:01:01', NULL),
(66, '0807213', 24, 1, 55, '1', '2021-07-08 08:01:01', NULL),
(67, '0807213', 20, 1, 400, '1', '2021-07-08 08:01:01', NULL),
(68, '0708214', 22, 2, 55, 'simple', '2021-08-07 09:32:29', NULL),
(69, '0708215', 23, 3, 66, '1', '2021-08-07 16:11:20', NULL),
(70, '0708215', 22, 4, 55, 'simple', '2021-08-07 16:11:20', NULL),
(71, '0708215', 21, 1, 55, '1', '2021-08-07 16:11:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_product_variations`
--

CREATE TABLE `orders_product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `variationID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_product_variations`
--

INSERT INTO `orders_product_variations` (`id`, `invID`, `pid`, `variationID`, `variation_name`, `variation`, `created_at`, `updated_at`) VALUES
(51, '0407211', 16, '80', 'Weight', '5kg', '2021-07-04 10:07:58', NULL),
(52, '0407211', 17, '57', 'Size', '34', '2021-07-04 10:07:58', NULL),
(53, '0407211', 17, '68', 'Weight', '5kg', '2021-07-04 10:07:58', NULL),
(54, '0407211', 17, '78', 'Litre', '2L', '2021-07-04 10:07:58', NULL),
(55, '0407211', 17, '76', 'Hello   Size', '90', '2021-07-04 10:07:58', NULL),
(56, '0507213', 17, '60', 'Size', '35', '2021-07-05 03:45:01', NULL),
(57, '0507213', 17, '68', 'Weight', '5kg', '2021-07-05 03:45:01', NULL),
(58, '0507213', 16, '81', 'Weight', '10kg', '2021-07-05 03:45:01', NULL),
(59, '0507213', 17, '60', 'Size', '35', '2021-07-05 03:52:37', NULL),
(60, '0507213', 17, '68', 'Weight', '5kg', '2021-07-05 03:52:37', NULL),
(61, '0507213', 16, '81', 'Weight', '10kg', '2021-07-05 03:52:37', NULL),
(62, '0507213', 17, '60', 'Size', '35', '2021-07-05 03:53:14', NULL),
(63, '0507213', 17, '68', 'Weight', '5kg', '2021-07-05 03:53:14', NULL),
(64, '0507213', 16, '81', 'Weight', '10kg', '2021-07-05 03:53:14', NULL),
(65, '0507213', 17, '60', 'Size', '35', '2021-07-05 03:53:26', NULL),
(66, '0507213', 17, '68', 'Weight', '5kg', '2021-07-05 03:53:26', NULL),
(67, '0507213', 16, '81', 'Weight', '10kg', '2021-07-05 03:53:26', NULL),
(68, '0507213', 17, '60', 'Size', '35', '2021-07-05 03:55:33', NULL),
(69, '0507213', 17, '68', 'Weight', '5kg', '2021-07-05 03:55:33', NULL),
(70, '0507213', 16, '81', 'Weight', '10kg', '2021-07-05 03:55:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_name`, `number`, `created_at`, `updated_at`) VALUES
(1, 'Bkash', '01627382865', '2021-07-02 04:45:48', '2021-07-02 09:04:36'),
(2, 'Rocket', '01627382861', '2021-07-02 05:05:44', '2021-07-02 09:03:50'),
(3, 'Nagad', '01627382866', '2021-07-02 07:57:33', NULL),
(4, 'Upay', '01627382867', '2021-07-02 07:58:00', '2021-07-02 09:03:22'),
(5, 'DBBL', '01627382866', '2021-07-02 09:44:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catID` int(11) NOT NULL,
  `subCatID` int(11) DEFAULT NULL,
  `brandID` int(11) DEFAULT NULL,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_discount` int(11) DEFAULT NULL,
  `product_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `small_image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lg_image_1` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lg_image_2` longtext COLLATE utf8mb4_unicode_ci,
  `lg_image_3` longtext COLLATE utf8mb4_unicode_ci,
  `previous_price` double DEFAULT NULL,
  `price` double NOT NULL,
  `short_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_data` varchar(900) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `unique_code`, `title`, `url`, `catID`, `subCatID`, `brandID`, `stock`, `sku`, `special_discount`, `product_type`, `small_image`, `lg_image_1`, `lg_image_2`, `lg_image_3`, `previous_price`, `price`, `short_description`, `description`, `meta_title`, `meta_data`, `active`, `created_at`, `updated_at`) VALUES
(1, '0', 'Best Hosting Package', 'best-hosting-package', 4, 1, 2, NULL, NULL, 0, '', 'images/product/1702719392473647.jpg', 'images/product/1702705866485710.png', 'images/product/1702719367888530.jpg', 'images/product/1702719240747350.png', 56, 450, 'link an image to another document, simply nest the <img> tag inside an <a> tag (see example below).To link an image to another document, simply nest the <img> tag inside an <a> tag (see example below).', '<p>To link an image to another document, simply nest the&nbsp;<code>&lt;img&gt;</code>&nbsp;tag inside an&nbsp;<a href=\"https://www.w3schools.com/tags/tag_a.asp\">&lt;a&gt;</a>&nbsp;tag (see example below).To link an image to another document, simply nest the&nbsp;<code>&lt;img&gt;</code>&nbsp;tag inside an&nbsp;<a href=\"https://www.w3schools.com/tags/tag_a.asp\">&lt;a&gt;</a>&nbsp;tag (see example below).To link an image to another document, simply nest the&nbsp;<code>&lt;img&gt;</code>&nbsp;tag inside an&nbsp;<a href=\"https://www.w3schools.com/tags/tag_a.asp\">&lt;a&gt;</a>&nbsp;tag (see example below).To link an image to another document, simply nest the&nbsp;<code>&lt;img&gt;</code>&nbsp;tag inside an&nbsp;<a href=\"https://www.w3schools.com/tags/tag_a.asp\">&lt;a&gt;</a>&nbsp;tag (see example below).</p>', 'To link an image to another document, simply nest the <img> tag inside an <a> tag (see example below).', '<p>To link an image to another document, simply nest the&nbsp;<code>&lt;img&gt;</code>&nbsp;tag inside an&nbsp;<a href=\"https://www.w3schools.com/tags/tag_a.asp\">&lt;a&gt;</a>&nbsp;tag (see example below).To link an image to another document, simply nest the&nbsp;<code>&lt;img&gt;</code>&nbsp;tag inside an&nbsp;<a href=\"https://www.w3schools.com/tags/tag_a.asp\">&lt;a&gt;</a>&nbsp;tag (see example below).To link an image to another document, simply nest the&nbsp;<code>&lt;img&gt;</code>&nbsp;tag inside&nbsp;</p>', 0, '2021-06-16 01:00:53', '2021-06-18 09:06:15'),
(2, 'p2', 'Ecommerce Website', 'ecommerce-website', 4, NULL, 2, '0', 'eco', 1, 'variation', 'images/product/1702809956061977.png', 'images/product/1702809956286261.png', '', '', 400, 350, NULL, NULL, NULL, NULL, 1, '2021-06-17 04:35:21', '2021-06-18 09:06:32'),
(13, 'p3', 'jhkhg jghj', 'jhkhg-jghj', 4, NULL, NULL, '55', NULL, NULL, 'simple', 'images/product/1702916498347101.jpg', 'images/product/1702916498535651.jpg', '', '', NULL, 200, NULL, NULL, NULL, NULL, 1, '2021-06-18 08:48:47', '2021-06-18 09:01:34'),
(14, 'p4', 'HBQ I7S TWS Double Dual Wireless 4.1 Bluetooth Earphone With Power Case', 'hbq-i7s-tws-double-dual-wireless-4.1-bluetooth-earphone-with-power-case', 4, NULL, NULL, '50', NULL, NULL, 'simple', 'images/product/1702935078914545.jpg', 'images/product/1702935079173417.jpg', 'images/product/1702935079532912.jpg', 'images/product/1702935079931096.png', 100, 800, 'HBQ I7S Double Dual Mini Earphone With Power', '<p>HBQ I7S Double Dual Mini Earphone With Power CaseBluetooth earphone with power case is very small and ultra-lightweight. This headphones only need 1-hour charging time, saving much time for you, 1-3 hours music and phone call time, volume battery 65MAH. Noise canceling headphones, stereo sound, It is your ideal standby earphones Only. These headphones connect seamlessly with most of Bluetooth enabled devices up to 30 feet away depends on different vacations.</p>', 'Product details of HBQ I7S TWS Double Dual Wireless 4.1 Bluetooth Earphone With Power Case', '<p>HBQ I7S Double Dual Mini Earphone With Power CaseBluetooth earphone with power case is very small and ultra-lightweight. This headphones only need 1-hour charging time, saving much time for you, 1-3 hours music and phone call time, volume battery 65MAH. Noise canceling headphones, stereo sound, It is your ideal standby earphones Only. These headphones connect seamlessly with most of Bluetooth enabled devices up to 30 feet away depends on different vacations.</p>', 1, '2021-06-18 13:44:08', '2021-06-18 13:49:50'),
(15, 'p5', 'Ladies Jeans Pant', 'ladies-jeans-pant', 4, 2, 1, '50', NULL, NULL, 'simple', 'images/product/1702976060452328.jpg', 'images/product/1702976060979709.png', '', '', 0, 500, NULL, NULL, NULL, NULL, 1, '2021-06-19 00:35:31', NULL),
(16, 'p6', 'Chinigora Rice', 'chinigora-rice', 4, NULL, NULL, '60', NULL, NULL, 'variation', 'images/product/1702976136838239.jpg', 'images/product/1702976136885568.jpg', '', '', NULL, 200, 'Deshi polao rice is low in cholesterol. There is a very small amount of fat. There is no gluten. So this rice helps to keep the heart healthy in all aspect', '<p>Deshi polao rice is low in cholesterol. There is a very small amount of fat. There is no gluten. So this rice helps to keep the heart healthy in all aspect</p>', 'Deshi polao rice is low in cholesterol. There is a very small amount of fat. There is no gluten. So this rice helps to keep the heart healthy in all aspect', 'Deshi polao rice is low in cholesterol. There is a very small amount of fat. There is no gluten. So this rice helps to keep the heart healthy in all aspect', 1, '2021-06-19 00:36:43', NULL),
(17, 'p7', 'Ghee', 'ghee', 1, 1, NULL, '100', NULL, NULL, 'variation', 'images/product/1702976255349647.jpg', 'images/product/1702976255405056.jpg', '', '', NULL, 200, 'Deshi polao rice is low in cholesterol. There is a very small amount of fat. There is no gluten. So this rice helps to keep the heart healthy in all aspect', '<p>Deshi polao rice is low in cholesterol. There is a very small amount of fat. There is no gluten. So this rice helps to keep the heart healthy in all aspect</p>', 'Deshi polao rice is low in cholesterol. There is a very small amount of fat. There is no gluten. So this rice helps to keep the heart healthy in all aspect', '<p>Deshi polao rice is low in cholesterol. There is a very small amount of fat. There is no gluten. So this rice helps to keep the heart healthy in all aspect</p>', 1, '2021-06-19 00:38:36', '2021-07-07 05:21:54'),
(18, 'p8', 'Product 1', 'product-1', 1, 1, 1, '66', 'p1', NULL, 'simple', 'images/product/1704635590180314.jpg', 'images/product/1704635597220207.jpg', 'images/product/1704635598546383.jpg', 'images/product/1704635601764776.jpg', 66, 44, NULL, NULL, NULL, NULL, 1, '2021-07-07 08:13:15', NULL),
(19, 'p9', 'Product 2', 'product-2', 1, 3, 1, '66', 'p2', 1, 'simple', 'images/product/1704635687529624.jpg', 'images/product/1704635689815272.jpg', 'images/product/1704635693310353.jpg', 'images/product/1704635697270865.jpg', 66, 55, NULL, NULL, NULL, NULL, 1, '2021-07-07 08:14:45', NULL),
(20, 'p10', 'Product 3', 'product-3', 1, 2, 1, '66', 'p3', 1, 'simple', 'images/product/1704635853648205.jpg', 'images/product/1704635857404841.jpg', 'images/product/1704635860622316.jpg', 'images/product/1704635861986441.jpg', 500, 400, NULL, NULL, NULL, NULL, 1, '2021-07-07 08:17:22', NULL),
(21, 'p11', 'Product 4', 'product-4', 1, 1, 1, '44', 'p4', 1, 'simple', 'images/product/1704635915519588.jpg', 'images/product/1704635918837307.jpg', '', '', 66, 55, NULL, NULL, NULL, NULL, 1, '2021-07-07 08:18:15', NULL),
(22, 'p12', 'Product 5', 'product-5', 1, 1, 1, '44', 'p5', 1, 'simple', 'images/product/1704636021565837.jpg', 'images/product/1704636023311669.jpg', 'images/product/1704636025354175.jpg', '', 88, 55, NULL, NULL, NULL, NULL, 1, '2021-07-07 08:19:59', NULL),
(23, 'p13', 'Product 6', 'product-6', 1, 1, 1, '44', 'p6', 1, 'simple', 'images/product/1704636126464957.jpg', 'images/product/1704636130661117.png', 'images/product/1704636130981168.jpg', '', 55, 66, NULL, NULL, NULL, NULL, 1, '2021-07-07 08:21:40', NULL),
(24, 'p14', 'Product 7', 'product-7', 1, NULL, 1, '44', 'p7', 1, 'variation', 'images/product/1704636212519030.jpg', 'images/product/1704636213766216.jpg', 'images/product/1704636217480942.jpg', '', 66, 55, NULL, NULL, NULL, NULL, 1, '2021-07-07 08:23:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation_id` int(11) NOT NULL,
  `attribute_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_unique_id`, `variation_id`, `attribute_name`, `price`, `created_at`, `updated_at`) VALUES
(25, 'p3', 2, '34', 100, '2021-06-17 07:03:47', NULL),
(26, 'p3', 1, '#e71313', 100, '2021-06-17 07:03:47', NULL),
(27, 'p3', 2, '34', 100, '2021-06-17 07:03:47', NULL),
(28, '2', 1, '#12de4f', 100, '2021-06-17 07:03:47', '2021-06-18 13:32:48'),
(36, '2', 1, '#d70909', 100, '2021-06-18 13:26:20', '2021-06-18 13:32:48'),
(38, '2', 2, '34', NULL, '2021-06-18 13:32:23', '2021-06-18 13:32:48'),
(39, '2', 2, '35', 100, '2021-06-18 13:32:23', '2021-06-18 13:32:48'),
(40, '2', 2, '66', NULL, '2021-06-18 13:32:23', '2021-06-18 13:32:48'),
(41, '2', 2, '36', NULL, '2021-06-18 13:32:23', '2021-06-18 13:32:48'),
(44, '13', 1, '#dd1d1d', NULL, '2021-06-18 13:34:09', '2021-06-18 13:37:02'),
(45, '13', 1, '#1fff0f', NULL, '2021-06-18 13:34:09', '2021-06-18 13:37:02'),
(46, '13', 2, '66', NULL, '2021-06-18 13:37:02', '2021-06-18 13:37:02'),
(50, '14', 2, '34', 100, '2021-06-18 23:04:17', '2021-06-18 23:57:32'),
(51, '14', 2, '35', 800, '2021-06-18 23:57:32', '2021-06-18 23:57:32'),
(57, '17', 2, '34', 100, '2021-06-19 10:13:35', '2021-06-20 05:25:22'),
(58, '17', 1, '#fe8800', 100, '2021-06-19 10:13:35', '2021-06-20 05:25:22'),
(59, '17', 1, '#c10606', 100, '2021-06-19 11:15:20', '2021-06-20 05:25:22'),
(60, '17', 2, '35', NULL, '2021-06-20 02:40:41', '2021-06-20 05:25:22'),
(61, '17', 2, '36', NULL, '2021-06-20 02:40:41', '2021-06-20 05:25:22'),
(62, '17', 2, '37', NULL, '2021-06-20 02:40:41', '2021-06-20 05:25:22'),
(63, '17', 2, '38', NULL, '2021-06-20 02:40:41', '2021-06-20 05:25:22'),
(64, '17', 1, '#ea0606', 100, '2021-06-20 02:41:26', '2021-06-20 05:25:22'),
(65, '17', 1, '#035906', 78, '2021-06-20 02:41:26', '2021-06-20 05:25:22'),
(66, '17', 1, '#ab179e', 90, '2021-06-20 02:41:26', '2021-06-20 05:25:22'),
(67, '17', 3, '2kg', 200, '2021-06-20 02:48:44', '2021-06-20 05:25:22'),
(68, '17', 3, '5kg', 800, '2021-06-20 02:48:44', '2021-06-20 05:25:22'),
(69, '17', 3, '7kg', 1200, '2021-06-20 02:48:44', '2021-06-20 05:25:22'),
(74, '17', 5, '88', NULL, '2021-06-20 05:05:37', '2021-06-20 05:25:22'),
(75, '17', 5, '89', NULL, '2021-06-20 05:05:37', '2021-06-20 05:25:22'),
(76, '17', 5, '90', NULL, '2021-06-20 05:05:37', '2021-06-20 05:25:22'),
(77, '17', 4, '1L', NULL, '2021-06-20 05:25:22', '2021-06-20 05:25:22'),
(78, '17', 4, '2L', NULL, '2021-06-20 05:25:22', '2021-06-20 05:25:22'),
(79, '17', 4, '3L', NULL, '2021-06-20 05:25:22', '2021-06-20 05:25:22'),
(80, '16', 3, '5kg', 500, '2021-06-26 03:00:32', '2021-06-26 03:00:51'),
(81, '16', 3, '10kg', 900, '2021-06-26 03:00:32', '2021-06-26 03:00:51'),
(82, '16', 3, '20kg', 1750, '2021-06-26 03:00:32', '2021-06-26 03:00:51'),
(83, '24', 2, '34', 100, '2021-07-08 12:27:03', '2021-08-07 11:32:20'),
(84, '24', 2, '35', 100, '2021-07-08 12:27:03', '2021-08-07 11:32:20'),
(85, '24', 3, '5kg', 236, '2021-08-07 11:32:20', '2021-08-07 11:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_banners`
--

CREATE TABLE `promotion_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_num` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotion_banners`
--

INSERT INTO `promotion_banners` (`id`, `banner_title`, `image`, `serial_num`, `created_at`, `updated_at`) VALUES
(1, 'banner 1', 'images/1704741383337095.png', 1, '2021-07-08 10:54:53', '2021-07-08 12:14:33'),
(2, 'banner 2', 'images/1704736481998601.png', 2, '2021-07-08 10:56:39', NULL),
(3, 'banner 3', 'images/1704740761893745.jpg', 3, '2021-07-08 12:04:46', NULL),
(4, 'banner 4', 'images/1704740799659403.jpg', 4, '2021-07-08 12:05:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_d_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_buy_amount` double NOT NULL,
  `expire_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `discount_type`, `d_amount`, `max_d_amount`, `m_buy_amount`, `expire_date`, `active`, `created_at`, `updated_at`) VALUES
(1, '883D4S', 'Percentage', '50', '70', 1000, '2021-07-08', 1, '2021-06-23 18:00:00', '2021-07-01 18:00:00'),
(2, '883D', 'Fixed', '100', '100', 500, '2021-06-29', 1, '2021-06-25 18:00:00', '2021-06-25 18:00:00'),
(3, '4DFGH', 'Percentage', '5', '100', 1000, '2021-06-28', 1, '2021-06-25 18:00:00', '2021-06-25 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `name`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 70, '2021-06-23 18:00:00', '2021-06-25 23:20:12'),
(2, 'Laxmipur', 100, '2021-06-23 18:00:00', '2021-07-11 10:40:34'),
(3, 'Comilla', 100, '2021-06-24 18:00:00', NULL),
(4, 'Chandpur', 100, '2021-07-11 05:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_sub_areas`
--

CREATE TABLE `shipping_sub_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ship_id` int(11) NOT NULL,
  `shipping_sub_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_sub_areas`
--

INSERT INTO `shipping_sub_areas` (`id`, `ship_id`, `shipping_sub_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'Kandir par, 1012', '2021-06-25 18:00:00', '2021-06-25 23:20:39'),
(2, 1, 'Mirpur-10, 1216', '2021-06-25 18:00:00', '2021-06-25 23:22:19'),
(3, 2, 'Hajiganj', '2021-06-25 18:00:00', '2021-06-25 23:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `shop_settings`
--

CREATE TABLE `shop_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkden` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_policy` longtext COLLATE utf8mb4_unicode_ci,
  `mission_and_vission` longtext COLLATE utf8mb4_unicode_ci,
  `Terms_and_conditions` longtext COLLATE utf8mb4_unicode_ci,
  `popup_modal_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `popup_modal_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `popup_modal_image` longtext COLLATE utf8mb4_unicode_ci,
  `minimum_point_to_convert` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point_to_tk_convert_rate` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_point` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimum_purchase_amount_in_tk_use_wallet_bl` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_settings`
--

INSERT INTO `shop_settings` (`id`, `shop_name`, `logo`, `address`, `phone_1`, `phone_2`, `email`, `facebook`, `youtube`, `instagram`, `twitter`, `linkden`, `privacy_policy`, `mission_and_vission`, `Terms_and_conditions`, `popup_modal_title`, `popup_modal_description`, `popup_modal_image`, `minimum_point_to_convert`, `point_to_tk_convert_rate`, `purchase_point`, `minimum_purchase_amount_in_tk_use_wallet_bl`, `created_at`, `updated_at`) VALUES
(1, 'FARA IT Fusion', 'images/1707412035608912.png', 'Shah Ali plaza', '01627382866', '01849706261', 'cse.ridoypaul@gmail.com', NULL, NULL, NULL, NULL, 'null', NULL, NULL, NULL, 'Sadek Vai', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was p', 'images/1702540728995587.jpg', '50', '0.5', '0.1', '50', '2021-06-14 05:12:26', '2021-08-07 10:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_title` mediumtext COLLATE utf8mb4_unicode_ci,
  `meta_title` mediumtext COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_title`, `meta_title`, `image`, `created_at`, `updated_at`) VALUES
(1, 'slider 1', NULL, 'images/1704457708241220.jpg', '2021-07-05 08:39:20', '2021-07-05 09:18:27'),
(2, 'slider 2', 'fd', 'images/1704456171850788.jpg', '2021-07-05 08:41:15', NULL),
(3, 'slider 3', 'this is the slider 3', 'images/1704457745960278.jpg', '2021-07-05 09:06:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catID` int(11) NOT NULL,
  `sub_cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `catID`, `sub_cat_name`, `url`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'color pen', 'color-pen', 1, '2021-06-14 06:28:57', '2021-06-13 18:00:00'),
(2, 1, 'Monitor Pc 1st', 'monitor-pc-1st', 1, '2021-06-14 06:29:25', '2021-06-13 18:00:00'),
(3, 1, 'Monitor Pc 1st', 'monitor-pc-1st', 1, '2021-06-14 22:45:41', '2021-06-14 22:45:55'),
(4, 2, 'Monitor Pc 1st', 'monitor-pc-1st', 1, '2021-07-06 14:41:45', NULL),
(5, 2, 'color pen', 'color-pen', 1, '2021-07-06 14:41:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `point`, `balance`, `district`, `thana`, `address`, `email_verified_at`, `password`, `active`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(3, 'Ridoy Paul', 'ridoypaul2580@gmail.com', '01849706261', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$gER3zy85QoRN5Ha2igtmEu1U36AOky20y4sO6jDzjr4ltv37BMTX.', 'active', NULL, NULL, NULL, '2021-06-27 02:04:40', '2021-07-10 05:23:24'),
(5, 'Sheaikh Shakil', 'shakilsumy@gmail.com', '01733391826', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$moYRAT8JcrszbFrrAXX6.u6/zO5fbvKS6qG.AwR/vmQCLCOfCdpvu', 'pending', NULL, NULL, NULL, '2021-06-27 02:55:50', '2021-06-27 02:57:03'),
(12, 'Ridoy Paul', 'cse.ridoypaul@gmail.com', '01627382866', 1000, 6.25, '3', '1', 'Shah Ali plaza-1205', NULL, '$2y$10$oOiyLPRUuT8aZThDfwAaF.Ryjidesmhp/EeK1D8KFpdDEVy7J9mgS', 'active', NULL, NULL, NULL, '2021-06-28 04:43:38', '2021-07-10 08:38:41'),
(15, 'Mehedi', 'mehedi@gmail.com', '01849706262', NULL, NULL, '2', '3', 'Comilla', NULL, '', 'pending', NULL, NULL, NULL, '2021-07-03 10:12:22', NULL),
(16, 'akil', 'akhtabakil@gmail.com', '01780504501', 0, 0, '1', '2', 'mirpur 10 sha ali plaza level11', NULL, '', 'pending', NULL, NULL, NULL, '2021-08-07 09:32:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `varieations`
--

CREATE TABLE `varieations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vari_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `varieations`
--

INSERT INTO `varieations` (`id`, `vari_name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Color', 1, '2021-06-16 18:00:00', '2021-06-16 18:00:00'),
(2, 'Size', 1, '2021-06-16 18:00:00', NULL),
(3, 'Weight', 1, '2021-06-19 18:00:00', NULL),
(4, 'Litre', 1, '2021-06-19 18:00:00', NULL),
(5, 'Hello   Size', 1, '2021-06-19 18:00:00', '2021-06-19 18:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_wallets`
--
ALTER TABLE `admin_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_variations`
--
ALTER TABLE `cart_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_product_variations`
--
ALTER TABLE `orders_product_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_banners`
--
ALTER TABLE `promotion_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_sub_areas`
--
ALTER TABLE `shipping_sub_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_settings`
--
ALTER TABLE `shop_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `varieations`
--
ALTER TABLE `varieations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_wallets`
--
ALTER TABLE `admin_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_variations`
--
ALTER TABLE `cart_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `orders_product_variations`
--
ALTER TABLE `orders_product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `promotion_banners`
--
ALTER TABLE `promotion_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipping_sub_areas`
--
ALTER TABLE `shipping_sub_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_settings`
--
ALTER TABLE `shop_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `varieations`
--
ALTER TABLE `varieations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
