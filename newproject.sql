-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2021 at 02:16 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_itineraries`
--

CREATE TABLE `agent_itineraries` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `tenant_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tenant_id_reff` varchar(255) DEFAULT NULL,
  `unique_key` varchar(255) DEFAULT NULL,
  `dep_type` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent_itineraries`
--

INSERT INTO `agent_itineraries` (`id`, `departure_id`, `title`, `description`, `pdf_file`, `tenant_id`, `user_id`, `tenant_id_reff`, `unique_key`, `dep_type`, `status`, `created_at`, `updated_at`) VALUES
(14, 15, 'Almaty 4 night 7 days ssssss', '<p>ssssssssssss ggg</p>', 'dummy-1600437949-HhL.pdf', 'VmlDyHlMxP1599195347', 6, NULL, 'FWWvx4xrQC1613989124', 'main', 1, '2021-02-22 04:48:44', '2021-02-22 05:18:17'),
(15, 1, 'Almaty 4 night 7 days ssssss', '<p>ssssssssssss ggg</p>', 'dummy-1600437949-HhL.pdf', 'VmlDyHlMxP1599195347', 1, NULL, 'FWWvx4xrQC1613981234', 'main', 1, '2021-02-22 04:48:44', '2021-02-22 05:18:17'),
(16, 17, 'dddddd', 'dddddddgggggggggggggggggggggggggg', '3848378395-t5V.pdf', NULL, 1, NULL, 'eQ0yOTGBZJ1614668100', 'main', 1, '2021-03-02 01:25:00', '2021-03-02 01:25:00'),
(17, 21, 'dook', 'er[;p', '3848378395-lR5.pdf', 'xnlcgfokzme8269053174', 9, NULL, 'tznhaacrML1614857426', 'main', 1, '2021-03-04 06:00:26', '2021-03-04 06:00:26'),
(18, 22, 'dook', 'eeeeeeeeee', '3848378395-A6e.pdf', 'xnlcgfokzme8269053174', 9, NULL, '770fgKpHgp1614918913', 'main', 1, '2021-03-04 23:05:13', '2021-03-04 23:05:13'),
(19, 29, 'New Departure', NULL, 'paymentDetail (5)-HhA.pdf', 'tynpvmgksib3149687250', 13, NULL, '7rnIe7cjSs1616056638', 'main', 1, '2021-03-18 03:07:18', '2021-03-18 03:07:18'),
(20, 28, 'New Departure', NULL, 'paymentDetail (5)-WrQ.pdf', 'xnlcgfokzme8269053174', 9, NULL, 'LSrKWSSwGl1616063251', 'main', 1, '2021-03-18 04:57:31', '2021-03-18 04:57:31'),
(21, 30, 'New Departure', 'no any conditions', 'paymentDetail (5)-0vK.pdf', 'xnlcgfokzme8269053174', 9, NULL, 'htdA9rQ9KY1616065441', 'main', 1, '2021-03-18 05:34:01', '2021-03-18 05:34:01'),
(22, 31, 'Latest Departure', 'no conditions', 'sample-LZU.pdf', 'ixwjpvekmsq9035671428', 15, NULL, 'h4TGxYGDEd1616153439', 'main', 1, '2021-03-19 18:30:39', '2021-03-19 18:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `all_airlines`
--

CREATE TABLE `all_airlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `airline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_airlines`
--

INSERT INTO `all_airlines` (`id`, `airline`, `created_at`, `updated_at`) VALUES
(1, 'IndiGo', NULL, NULL),
(2, 'Air India', NULL, NULL),
(3, 'SpiceJet', NULL, NULL),
(4, 'GoAir', NULL, NULL),
(5, 'AirAsia India', NULL, NULL),
(6, 'Vistara', NULL, NULL),
(7, 'Alliance Air', NULL, NULL),
(8, 'TruJet', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `all_destinations`
--

CREATE TABLE `all_destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_destinations`
--

INSERT INTO `all_destinations` (`id`, `destination`, `created_at`, `updated_at`) VALUES
(1, 'Delhi', NULL, NULL),
(2, 'Mumbai', NULL, NULL),
(3, 'Goa', NULL, NULL),
(4, 'Dehradun', NULL, NULL),
(5, 'Shimla', NULL, NULL),
(6, 'Manali', NULL, NULL),
(7, 'Patna', NULL, NULL),
(8, 'panjab', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_departures`
--

CREATE TABLE `book_departures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `booked_seat` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_departures`
--

INSERT INTO `book_departures` (`id`, `user_id`, `departure_id`, `booked_seat`, `date`, `created_at`, `updated_at`) VALUES
(5, 9, 27, 1, '2021-03-09', '2021-03-09 07:13:15', '2021-03-09 07:13:15'),
(6, 9, 26, 1, '2021-03-09', '2021-03-09 07:13:28', '2021-03-09 07:13:28'),
(7, 10, 27, 1, '2021-03-11', '2021-03-10 23:37:17', '2021-03-10 23:37:17'),
(8, 9, 31, 20, '2021-03-19', '2021-03-19 19:38:29', '2021-03-19 19:38:29'),
(9, 9, 30, 2, '2021-03-19', '2021-03-19 19:39:08', '2021-03-19 19:39:08'),
(10, 6, 31, 1, '2021-03-19', '2021-03-19 19:41:52', '2021-03-19 19:41:52'),
(11, 6, 31, 1, '2021-03-19', '2021-03-19 19:42:11', '2021-03-19 19:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `country_name` varchar(200) DEFAULT NULL,
  `official_name` varchar(200) DEFAULT NULL,
  `capital` varchar(100) DEFAULT NULL,
  `largest_city` varchar(200) DEFAULT NULL,
  `continent` varchar(100) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `sub_continent` varchar(100) DEFAULT NULL,
  `iso_2` varchar(50) DEFAULT NULL,
  `iso_3` varchar(50) DEFAULT NULL,
  `isd_code` varchar(20) DEFAULT NULL,
  `latitude` varchar(200) DEFAULT NULL,
  `longitude` varchar(200) DEFAULT NULL,
  `internet_tld` varchar(50) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `currency_code` varchar(10) DEFAULT NULL,
  `cost_index_id` int(10) DEFAULT NULL,
  `drives_on` varchar(100) DEFAULT NULL,
  `area` varchar(222) DEFAULT NULL,
  `area_unit` varchar(200) DEFAULT NULL,
  `population` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `reference_id`, `country_name`, `official_name`, `capital`, `largest_city`, `continent`, `description`, `sub_continent`, `iso_2`, `iso_3`, `isd_code`, `latitude`, `longitude`, `internet_tld`, `currency`, `currency_symbol`, `currency_code`, `cost_index_id`, `drives_on`, `area`, `area_unit`, `population`, `status`, `created_at`, `updated_at`) VALUES
(1, 208, 'Kazakhstan', 'Republic of Kazakhstan', 'Nur-Sultan', 'Almaty', 'Asia', 'Kazakhstan is a transcontinental country largely located in Central Asia with the most western parts of it being located in Eastern Europe. It is the worlds largest landlocked country, and the ninth-largest country in the world, with an area of 2,724,900 square kilometres (1,052,100 sq mi). Kazakhstan is the most dominant nation of Central Asia economically, generating 60% of the regions GDP, primarily through its oil and gas industry.', 'Central Asia', 'KZ', 'KAZ', '7', '48.019573', '66.923684', '.kz', 'Tenge', '₸', 'KZT', NULL, 'Right', '2724900', 'Sq Km', '18448600', 1, '2021-02-04 06:47:28', '2021-02-04 07:04:52'),
(2, 242, 'Azerbaijan', 'Republic of Azerbaijan', 'Baku', 'Baku', 'Asia', 'Azerbaijan is a country in the South Caucasus region of Eurasia at the crossroads of Eastern Europe and Western Asia. It is bounded by the Caspian Sea to the east, Russia to the north, Georgia to the northwest, Armenia to the west and Iran to the south. The exclave of Nakhchivan is bounded by Armenia to the north and east, Iran to the south and west, and has an 11 km (6.8 mi) long border with Turkey in the northwest.', 'Eastern Europe', 'AZ', 'AZE', '994', '40.143105', '47.576927', '.az', 'Manat', '₼', 'AZN', NULL, 'Right', '86600', 'Sq Km', '10000000', 1, '2021-02-04 06:47:29', '2021-02-04 07:04:53'),
(3, 194, 'Russia', 'Russian Federation', 'Moscow', 'Moscow', 'Europe', 'Russia is a transcontinental country located in Eastern Europe and Northern Asia. Covering an area of 17,125,200 square kilometres (6,612,100 sq mi), it is the largest country in the world by area, spanning more than one-eighth of the Earths inhabited land area, stretching eleven time zones, and bordering 16 sovereign nations.', 'North Asia', 'RU', 'RUS', '7', '61.52401', '105.318756', '.ru', 'Russian ruble', '₽', 'RUB', NULL, 'Right', '17098246', 'Sq Km', '146793744', 1, '2021-02-04 07:13:07', '2021-02-04 07:13:07'),
(4, 209, 'Indonesia', 'Republic of Indonesia', 'Jakarta', 'Jakarta', 'Asia', 'Indonesia is a country in Southeast Asia and Oceania, between the Indian and Pacific oceans. It consists of more than seventeen thousand islands, including Sumatra, Java, Borneo (Kalimantan), Sulawesi, and New Guinea (Papua). Indonesia is the worlds largest island country and the 14th largest country by land area, at 1,904,569 square kilometres.', 'South Asia', 'ID', 'IDN', '62', '-0.789275', '113.921327', '.id', 'Indonesian rupiah', 'Rp', 'IDR', NULL, 'Left', '1904569', 'Sq Km', '261115456', 1, '2021-02-28 23:55:47', '2021-02-28 23:55:47'),
(5, 192, 'India', 'Republic of India', 'New Delhi', 'Mumbai', 'Asia', 'India is the largest country in the South Asia Region, located primarily in the center of South Asia. The country shares land borders with Pakistan to the northwest, China and Nepal to the north, Bhutan to the northeast, and Bangladesh and Myanmar are to the east. Maritime borders in the Indian Ocean exist with Sri Lanka to the south, Maldives to the southwest, and Indonesia to the southeast.', 'South Asia', 'IN', 'IND', '91', '20.593684', '78.96288', '.in', 'Indian rupee', '₹', 'INR', NULL, 'Left', '3287263', 'Sq Km', '1324171354', 1, '2021-03-02 00:00:01', '2021-03-02 00:00:01'),
(6, 190, 'France', 'French Republic', 'Paris', 'Paris', 'Europe', 'France is a country with which almost every traveller has a relationship. Many dream of its joie de vivre shown by the countless restaurants, picturesque villages and world-famous gastronomy. Some come to follow the trail of Frances great philosophers, writers and artists, or to immerse in the beautiful language it gave the world.', 'Western Europe', 'FR', 'FRA', '33', '46.227638', '2.213749', '.fr', 'Euro', '€', 'EUR', NULL, 'Right', '643801', 'Sq Km', '66998000', 1, '2021-03-02 01:27:20', '2021-03-02 01:27:20'),
(7, 154, 'Haiti', '', '', '', '', 'Haiti is a country located on the island of Hispaniola in the Greater Antilles archipelago of the Caribbean Sea, to the east of Cuba and Jamaica and south of The Bahamas and the Turks and Caicos Islands. It occupies the western three-eighths of the island which it shares with the Dominican Republic.', '', 'HT', 'HTI', '', '18.971187', '-72.285215', '', '', '', '', NULL, '', '', '', '', 1, '2021-03-04 04:57:10', '2021-03-04 04:57:10'),
(8, 192, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 1, '2021-03-04 07:15:17', '2021-03-04 07:15:17'),
(9, 154, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 1, '2021-03-04 23:06:13', '2021-03-04 23:06:13'),
(10, 209, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 1, '2021-03-05 01:14:07', '2021-03-05 01:14:07'),
(11, 58, 'Brazil', '', '', '', '', 'Brazil is the largest country in South America and fifth largest in the world. Famous for its football (soccer) tradition and its annual Carnaval in Rio de Janeiro, Salvador, Recife and Olinda. It is a country of great diversity, from the bustling urban mosaic of S?o Paulo to the infinite cultural energy of Alagoas, Pernambuco and Bahia, the wilderness of the Amazon rainforest and world-class landmarks such as the Igua?u Falls, there is plenty to see and to do in Brazil.', '', 'BR', 'BRA', '', '-14.235004', '-51.92528', '', '', '', '', NULL, '', '', '', '', 1, '2021-03-05 04:42:21', '2021-03-05 04:42:21'),
(12, 58, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 1, '2021-03-05 05:37:16', '2021-03-05 05:37:16'),
(13, 190, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 1, '2021-03-18 05:07:17', '2021-03-18 05:07:17'),
(14, 193, 'United Kingdom', 'United Kingdom of Great Britain and Northern Ireland', 'London', 'London', 'Europe', 'United Kingdom is a sovereign country located off the north?western coast of the European mainland. The United Kingdom includes the island of Great Britain, the north?eastern part of the island of Ireland, and many smaller islands. Northern Ireland shares a land border with the Republic of Ireland. Otherwise, the United Kingdom is surrounded by the Atlantic Ocean, with the North Sea to the east, the English Channel to the south and the Celtic Sea to the southwest, giving it the 12th-longest coastline in the world.', 'North Europe', 'GB', 'GBR', '44', '55.378051', '-3.435973', '.uk', 'Pound sterling', '£', 'GBP', NULL, 'Left', '242495', 'Sq Km', '66921307', 1, '2021-03-18 05:23:46', '2021-03-18 05:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `countries_old`
--

CREATE TABLE `countries_old` (
  `id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `country_name` varchar(200) DEFAULT NULL,
  `iso_2` varchar(20) DEFAULT NULL,
  `iso_3` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries_old`
--

INSERT INTO `countries_old` (`id`, `reference_id`, `country_name`, `iso_2`, `iso_3`, `status`, `created_at`, `updated_at`) VALUES
(1, 194, 'Russia', NULL, NULL, 1, '2020-08-21 01:57:59', '2020-08-21 01:57:59'),
(2, 187, 'Thailand', NULL, NULL, 1, '2020-08-21 01:57:59', '2020-09-10 10:05:21'),
(3, 189, 'Spain', NULL, NULL, 1, '2020-08-21 02:04:01', '2020-08-21 02:04:01'),
(4, 208, 'Kazakhstan', NULL, NULL, 1, '2020-08-24 05:41:20', '2020-10-23 01:13:08'),
(5, 187, 'Bangkok', NULL, NULL, 1, '2020-09-10 09:59:02', '2020-09-10 09:59:02'),
(6, 187, 'Phuket', NULL, NULL, 1, '2020-09-10 23:42:45', '2020-09-10 23:42:45'),
(7, 242, 'Azerbaijan', NULL, NULL, 1, '2021-02-03 00:51:05', '2021-02-03 00:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `country_departures`
--

CREATE TABLE `country_departures` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country_departures`
--

INSERT INTO `country_departures` (`id`, `departure_id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 14, 1, '2021-02-04 07:04:52', '2021-02-04 07:04:52'),
(2, 14, 2, '2021-02-04 07:04:53', '2021-02-04 07:04:53'),
(3, 15, 3, '2021-02-04 07:13:07', '2021-02-04 07:13:07'),
(4, 16, 4, '2021-02-28 23:55:47', '2021-02-28 23:55:47'),
(5, 17, 5, '2021-03-02 00:00:01', '2021-03-02 00:00:01'),
(6, 18, 6, '2021-03-02 01:27:20', '2021-03-02 01:27:20'),
(7, 19, 6, '2021-03-04 04:46:34', '2021-03-04 04:46:34'),
(8, 20, 7, '2021-03-04 04:57:11', '2021-03-04 04:57:11'),
(9, 21, 6, '2021-03-04 05:58:14', '2021-03-04 05:58:14'),
(19, 23, 10, '2021-03-05 01:14:07', '2021-03-05 01:14:07'),
(22, 22, 8, '2021-03-05 05:35:48', '2021-03-05 05:35:48'),
(28, 25, 5, '2021-03-05 05:52:09', '2021-03-05 05:52:09'),
(32, 29, 5, '2021-03-18 03:05:56', '2021-03-18 03:05:56'),
(45, 26, 14, '2021-03-18 05:23:46', '2021-03-18 05:23:46'),
(46, 28, 6, '2021-03-18 05:29:35', '2021-03-18 05:29:35'),
(48, 27, 5, '2021-03-18 05:30:44', '2021-03-18 05:30:44'),
(52, 30, 5, '2021-03-18 05:35:02', '2021-03-18 05:35:02'),
(55, 31, 5, '2021-03-19 18:31:42', '2021-03-19 18:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `currency_symbols`
--

CREATE TABLE `currency_symbols` (
  `id` int(11) NOT NULL,
  `currency_symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso_2` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso_3` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_symbols`
--

INSERT INTO `currency_symbols` (`id`, `currency_symbol`, `iso_2`, `iso_3`, `created_at`, `updated_at`) VALUES
(94, '₹', 'IN', 'IND', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, '¥', 'JP', 'JPN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, '$', 'BN', 'BRN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, '€', 'VA', 'VAT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, '£', 'GS', 'GS1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `departures`
--

CREATE TABLE `departures` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug_url` varchar(255) DEFAULT NULL,
  `no_of_nights` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `meal_type` varchar(255) DEFAULT NULL,
  `transport_type` varchar(255) DEFAULT NULL,
  `team_size` int(11) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `ending_at` varchar(255) DEFAULT NULL,
  `total_seat` varchar(50) DEFAULT NULL,
  `flight` varchar(255) DEFAULT NULL,
  `unique_key` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `company_name` varchar(255) DEFAULT NULL,
  `tenant_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dep_type` varchar(50) DEFAULT NULL,
  `price_inr` varchar(35) DEFAULT NULL,
  `price_usd` varchar(35) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `departure_ownner` varchar(255) DEFAULT NULL,
  `hotel_category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departures`
--

INSERT INTO `departures` (`id`, `title`, `slug_url`, `no_of_nights`, `no_of_days`, `meal_type`, `transport_type`, `team_size`, `description`, `start_date`, `from`, `ending_at`, `total_seat`, `flight`, `unique_key`, `status`, `company_name`, `tenant_id`, `user_id`, `dep_type`, `price_inr`, `price_usd`, `created_at`, `updated_at`, `departure_ownner`, `hotel_category`) VALUES
(30, 'New Departure', NULL, 4, 5, 'European Plan', 'Private', NULL, 'no', '2121-08-26', 'Shimla', 'Shimla', '33', 'GoAir', 'XYlNGGmN0r1616065401', 2, 'abc', 'xnlcgfokzme8269053174', 9, 'main', '5555', '1111', '2021-03-18 05:33:21', '2021-03-18 05:37:22', 'Abc', '3 Star'),
(31, 'Latest Departure', NULL, 4, 5, 'Continent Meal Plan', 'Private', NULL, 'jjjjjjj', '2121-03-24', 'Dehradun', 'Delhi', '33', 'GoAir', 'p5mQ0TrYTr1616153375', 2, 'ABC', 'ixwjpvekmsq9035671428', 15, 'main', '5555', '443', '2021-03-19 18:29:35', '2021-03-19 19:05:37', 'ABC', '3 Star');

-- --------------------------------------------------------

--
-- Table structure for table `departure_destinations`
--

CREATE TABLE `departure_destinations` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departure_destinations`
--

INSERT INTO `departure_destinations` (`id`, `departure_id`, `destination_id`, `created_at`, `updated_at`) VALUES
(75, 7, 2, '2020-09-18 04:47:05', '2020-09-18 04:47:05'),
(82, 1, 1, '2020-09-22 06:37:49', '2020-09-22 06:37:49'),
(83, 1, 3, '2020-09-22 06:37:49', '2020-09-22 06:37:49'),
(84, 1, 2, '2020-09-22 06:37:49', '2020-09-22 06:37:49'),
(88, 5, 4, '2020-10-17 10:02:09', '2020-10-17 10:02:09'),
(89, 4, 2, '2020-10-17 10:03:06', '2020-10-17 10:03:06'),
(90, 11, 7, '2020-10-19 05:33:20', '2020-10-19 05:33:20'),
(91, 12, 7, '2020-10-23 01:13:08', '2020-10-23 01:13:08'),
(92, 13, 7, '2020-10-23 01:15:11', '2020-10-23 01:15:11'),
(101, 14, 1, '2021-02-04 07:04:52', '2021-02-04 07:04:52'),
(102, 14, 2, '2021-02-04 07:04:53', '2021-02-04 07:04:53'),
(103, 15, 3, '2021-02-04 07:13:07', '2021-02-04 07:13:07'),
(104, 16, 4, '2021-02-28 23:55:47', '2021-02-28 23:55:47'),
(105, 17, 5, '2021-03-02 00:00:01', '2021-03-02 00:00:01'),
(106, 18, 6, '2021-03-02 01:27:20', '2021-03-02 01:27:20'),
(107, 19, 6, '2021-03-04 04:46:34', '2021-03-04 04:46:34'),
(108, 20, 7, '2021-03-04 04:57:11', '2021-03-04 04:57:11'),
(109, 21, 6, '2021-03-04 05:58:14', '2021-03-04 05:58:14'),
(118, 25, 5, '2021-03-05 05:52:09', '2021-03-05 05:52:09'),
(122, 29, 5, '2021-03-18 03:05:56', '2021-03-18 03:05:56'),
(127, 26, 10, '2021-03-18 05:23:46', '2021-03-18 05:23:46'),
(128, 28, 6, '2021-03-18 05:29:35', '2021-03-18 05:29:35'),
(129, 27, 5, '2021-03-18 05:30:44', '2021-03-18 05:30:44'),
(131, 30, 5, '2021-03-18 05:35:02', '2021-03-18 05:35:02'),
(133, 31, 5, '2021-03-19 18:31:42', '2021-03-19 18:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `actualname` varchar(255) DEFAULT NULL,
  `dest_name` varchar(255) DEFAULT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `country_iso_2` varchar(255) DEFAULT NULL,
  `country_iso_3` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `reference_id`, `country_id`, `actualname`, `dest_name`, `country_name`, `latitude`, `longitude`, `country_iso_2`, `country_iso_3`, `region`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 22942, 1, 'Almaty', 'Almaty', 'Kazakhstan', 43.25667, 76.92861, 'KZ', 'KAZ', 'Almaty', 'Almaty is the largest city in Kazakhstan, with a population of about 2,000,000 people, about 11% of the countrys total population, and more than 2.7 million in its built-up area that encompasses Talgar, Boraldai, Otegen Batyr and many other suburbs.', 1, '2021-02-04 06:47:29', '2021-02-04 07:04:52'),
(2, 2, 2, 'Baku', 'Baku', 'Azerbaijan', 40.37767, 49.89201, 'AZ', 'AZE', 'Baki', 'Baku is the capital and largest city of Azerbaijan, as well as the largest city on the Caspian Sea and of the Caucasus region.', 1, '2021-02-04 06:47:29', '2021-02-04 07:04:53'),
(3, 11110, 3, 'Moscow', 'Moscow', 'Russia', 55.75222, 37.61556, 'RU', 'RUS', 'Moscow', 'Moscow is the capital and largest city of Russia. The megacity stands on the Moskva River in the central portion of Western Russia, with a population estimated at 12.6 million residents within the city limits, while over 17 million residents in the urban area, and over 20 million residents in the Moscow Metropolitan Area.', 1, '2021-02-04 07:13:07', '2021-02-04 07:13:07'),
(4, 1966, 4, 'Denpasar', 'Denpasar', 'Indonesia', -8.65, 115.21667, 'ID', 'IDN', 'Bali', 'null', 1, '2021-02-28 23:55:47', '2021-02-28 23:55:47'),
(5, 20485, 5, 'Delhi', 'Delhi', 'India', 28.65195, 77.23149, 'IN', 'IND', 'NCT-Delhi', 'Delhi is a city and a union territory of India containing New Delhi, the capital of India. It is bordered by the state of Haryana on three sides and by Uttar Pradesh to the east. The NCT covers an area of 1,484 square kilometres (573 sq mi).', 1, '2021-03-02 00:00:01', '2021-03-02 00:00:01'),
(6, 463, 6, 'Deuil-la-Barre', 'Deuil-la-Barre', 'France', 48.97674, 2.32722, 'FR', 'FRA', 'lle-de-France', 'Deuil-la-Barre is a commune in the northern suburbs of Paris, France. It is in the Department of Val dOise, the préfecture of Cergy-Pontoise and the sous-préfecture of Sarcelles. It is 13.7 km from the centre of Paris.', 1, '2021-03-02 01:27:20', '2021-03-02 01:27:20'),
(7, 1555, 7, 'Delmas 73', 'Delmas 73', 'Haiti', 18.54472, -72.30278, 'HT', 'HTI', 'Ouest', 'null', 1, '2021-03-04 04:57:11', '2021-03-04 04:57:11'),
(8, 1712, 4, 'Deli Tua', 'Deli Tua', 'Indonesia', 3.5078, 98.6839, 'ID', 'IDN', 'North Sumatra', 'null', 1, '2021-03-05 01:05:59', '2021-03-05 01:05:59'),
(9, 5224, 11, 'Delmiro Gouveia', 'Delmiro Gouveia', 'Brazil', -9.38861, -37.99917, 'BR', 'BRA', 'Alagoas', 'null', 1, '2021-03-05 04:42:21', '2021-03-05 04:42:21'),
(10, 1138, 14, 'Deeside', 'Deeside', 'United Kingdom', 53.20053, -3.03841, 'GB', 'GBR', 'Wales', 'null', 1, '2021-03-18 05:23:46', '2021-03-18 05:23:46'),
(11, 1972, 4, 'Delanggu', 'Delanggu', 'Indonesia', -7.61667, 110.68333, 'ID', 'IDN', 'Central Java', 'null', 1, '2021-03-19 18:29:36', '2021-03-19 18:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `destinations_old`
--

CREATE TABLE `destinations_old` (
  `id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `dest_name` varchar(255) DEFAULT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `iso_2` varchar(20) DEFAULT NULL,
  `iso_3` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinations_old`
--

INSERT INTO `destinations_old` (`id`, `reference_id`, `country_id`, `dest_name`, `country_name`, `iso_2`, `iso_3`, `status`, `created_at`, `updated_at`) VALUES
(1, 14461, 2, 'Bangkok', 'Thailand', NULL, NULL, 1, '2020-08-18 23:17:16', '2020-09-10 23:56:18'),
(2, 14337, 2, 'Phuket', 'Thailand', NULL, NULL, 1, '2020-08-18 23:17:16', '2020-09-10 23:52:58'),
(3, 14361, 2, 'Chiang Mai', 'Thailand', NULL, NULL, 1, '2020-08-18 23:17:16', '2020-08-18 23:17:16'),
(4, 11110, 1, 'Moscow', 'Russia', NULL, NULL, 1, '2020-08-21 01:57:59', '2020-08-21 01:57:59'),
(5, 14314, 2, 'Chumphon', 'Thailand', NULL, NULL, 1, '2020-08-21 01:58:00', '2020-08-21 01:58:00'),
(6, 19297, 3, 'Valencia', 'Spain', NULL, NULL, 1, '2020-08-21 02:04:01', '2020-08-21 02:04:01'),
(7, 22942, 4, 'Almaty', 'Kazakhstan', NULL, NULL, 1, '2020-08-24 05:41:20', '2020-08-24 05:41:20'),
(8, 22879, 4, 'Aktobe', 'Kazakhstan', NULL, NULL, 1, '2020-09-03 05:27:26', '2020-09-03 05:27:26'),
(9, 14410, 2, 'Uthai Thani', 'Thailand', NULL, NULL, 1, '2020-09-05 01:20:34', '2020-09-05 01:20:34'),
(10, 14321, 2, 'Kathu', 'Thailand', NULL, NULL, 1, '2020-09-10 10:05:22', '2020-09-10 10:05:22'),
(11, 14323, 2, 'Pa Sang', 'Thailand', NULL, NULL, 1, '2020-09-10 10:10:48', '2020-09-10 10:10:48'),
(12, 14324, 2, 'Tha Maka', 'Thailand', NULL, NULL, 1, '2020-09-10 10:11:58', '2020-09-10 10:11:58'),
(13, 2, 7, 'Baku', 'Azerbaijan', NULL, NULL, 1, '2021-02-03 00:51:05', '2021-02-03 00:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `destination_itinerary_point_of_interests`
--

CREATE TABLE `destination_itinerary_point_of_interests` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `itinerary_id` int(11) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `point_of_interest_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destination_itinerary_point_of_interests`
--

INSERT INTO `destination_itinerary_point_of_interests` (`id`, `departure_id`, `itinerary_id`, `destination_id`, `point_of_interest_id`, `created_at`, `updated_at`) VALUES
(9, 1, 2, 3, 4021, '2020-08-19 03:03:02', '2020-08-19 03:03:02'),
(10, 1, 2, 3, 13143, '2020-08-19 03:03:02', '2020-08-19 03:03:02'),
(17, 4, 3, 2, 11488, '2020-08-24 05:48:22', '2020-08-24 05:48:22'),
(18, 4, 3, 2, 11512, '2020-08-24 05:48:22', '2020-08-24 05:48:22'),
(23, 4, 4, 2, 17248, '2020-08-26 02:20:29', '2020-08-26 02:20:29'),
(24, 4, 4, 2, 11499, '2020-08-26 02:20:29', '2020-08-26 02:20:29'),
(43, 5, 5, 4, 4444, '2020-08-26 08:14:09', '2020-08-26 08:14:09'),
(44, 5, 6, 4, 4445, '2020-08-26 08:14:09', '2020-08-26 08:14:09'),
(57, 1, 1, 1, 17094, '2020-09-05 02:14:30', '2020-09-05 02:14:30'),
(58, 1, 1, 1, 16370, '2020-09-05 02:14:30', '2020-09-05 02:14:30'),
(59, 1, 1, 3, 13143, '2020-09-05 02:14:30', '2020-09-05 02:14:30'),
(71, 7, 12, 2, 11466, '2020-09-10 10:27:41', '2020-09-10 10:27:41'),
(72, 7, 13, 2, 83301, '2020-09-18 04:54:00', '2020-09-18 04:54:00'),
(74, 11, 14, 7, 5295, '2020-10-17 11:48:04', '2020-10-17 11:48:04');

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
-- Table structure for table `hold_departures`
--

CREATE TABLE `hold_departures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `departure_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hold_till` int(10) NOT NULL DEFAULT 21,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hold_departures`
--

INSERT INTO `hold_departures` (`id`, `user_id`, `departure_id`, `hold_till`, `date`, `created_at`, `updated_at`) VALUES
(15, 9, '30', 16, '2021-03-18 11:03:21', '2021-03-18 05:33:21', '2021-03-18 05:33:21'),
(16, 15, '31', 21, '2021-03-19 11:29:35', '2021-03-19 18:29:35', '2021-03-19 18:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `hold_departure_seats`
--

CREATE TABLE `hold_departure_seats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `hold_seat` int(11) NOT NULL,
  `hold_duration` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hold_departure_seats`
--

INSERT INTO `hold_departure_seats` (`id`, `user_id`, `departure_id`, `hold_seat`, `hold_duration`, `date`, `created_at`, `updated_at`) VALUES
(17, 15, 31, 10, 24, '2021-03-20 11:32:12', '2021-03-19 18:32:12', '2021-03-19 18:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `hold_durations`
--

CREATE TABLE `hold_durations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hours` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hold_durations`
--

INSERT INTO `hold_durations` (`id`, `hours`, `created_at`, `updated_at`) VALUES
(1, 24, NULL, NULL),
(2, 48, NULL, NULL),
(3, 72, NULL, NULL),
(4, 96, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hold_tills`
--

CREATE TABLE `hold_tills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hold_tills`
--

INSERT INTO `hold_tills` (`id`, `days`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL),
(4, 4, NULL, NULL),
(5, 5, NULL, NULL),
(6, 6, NULL, NULL),
(7, 7, NULL, NULL),
(8, 8, NULL, NULL),
(9, 9, NULL, NULL),
(10, 10, NULL, NULL),
(11, 11, NULL, NULL),
(12, 12, NULL, NULL),
(13, 13, NULL, NULL),
(14, 14, NULL, NULL),
(15, 15, NULL, NULL),
(16, 16, NULL, NULL),
(17, 17, NULL, NULL),
(18, 18, NULL, NULL),
(19, 19, NULL, NULL),
(20, 20, NULL, NULL),
(21, 21, NULL, NULL),
(22, 22, NULL, NULL),
(23, 23, NULL, NULL),
(24, 24, NULL, NULL),
(25, 25, NULL, NULL),
(26, 26, NULL, NULL),
(27, 27, NULL, NULL),
(28, 28, NULL, NULL),
(29, 29, NULL, NULL),
(30, 30, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_categories`
--

CREATE TABLE `hotel_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_categories`
--

INSERT INTO `hotel_categories` (`id`, `hotel_category`, `created_at`, `updated_at`) VALUES
(1, '1 Star', NULL, NULL),
(2, '2 Star', NULL, NULL),
(3, '3 Star', NULL, NULL),
(4, '4 Star', NULL, NULL),
(5, '5 Star', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inclusions`
--

CREATE TABLE `inclusions` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `dep_type` varchar(20) DEFAULT NULL,
  `tenant_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inclusions`
--

INSERT INTO `inclusions` (`id`, `departure_id`, `name`, `description`, `dep_type`, `tenant_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 4, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'VmlDyHlMxP1599195347', 6, '2020-08-24 05:42:00', '2020-08-24 05:42:00'),
(7, 4, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'VmlDyHlMxP1599195347', 6, '2020-08-24 05:42:00', '2020-08-24 05:42:00'),
(8, 4, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', 'VmlDyHlMxP1599195347', 6, '2020-08-24 05:42:00', '2020-08-24 05:42:00'),
(9, 4, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'VmlDyHlMxP1599195347', 6, '2020-08-24 05:42:00', '2020-08-24 05:42:00'),
(10, 4, 'Flights', 'International flights included.', 'main', 'VmlDyHlMxP1599195347', 6, '2020-08-24 05:42:00', '2020-08-24 05:42:00'),
(11, 1, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'VmlDyHlMxP1599195347', 6, '2020-08-25 08:10:36', '2020-08-25 08:10:36'),
(12, 1, 'Flights', 'International flights included.', 'main', 'VmlDyHlMxP1599195347', 6, '2020-08-25 08:10:37', '2020-08-25 08:10:37'),
(13, 1, 'Guide', 'Services of experienced guide licenced by the Ministry', 'main', 'VmlDyHlMxP1599195347', 1, '2020-08-25 08:10:37', '2020-08-25 08:10:37'),
(14, 1, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer.', 'main', 'VmlDyHlMxP1599195347', 1, '2020-08-25 08:10:37', '2020-08-25 08:10:37'),
(15, 5, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', 'VmlDyHlMxP1599195347', 1, '2020-08-25 08:10:37', '2020-08-25 08:10:37'),
(16, 5, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'VmlDyHlMxP1599195347', 1, '2020-08-25 08:10:37', '2020-08-25 08:10:37'),
(17, 5, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'VmlDyHlMxP1599195347', 1, '2020-08-24 05:42:00', '2020-08-24 05:42:00'),
(18, 5, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach', 'main', 'VmlDyHlMxP1599195347', 1, '2020-08-24 05:42:00', '2020-08-24 05:42:00'),
(39, 7, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'VmlDyHlMxP1599195347', 1, '2020-09-18 04:47:17', '2020-09-18 04:47:17'),
(40, 7, 'Meals', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'VmlDyHlMxP1599195347', 1, '2020-09-18 04:47:17', '2020-09-18 04:47:17'),
(41, 7, 'Transport', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'VmlDyHlMxP1599195347', 1, '2020-09-18 04:47:17', '2020-09-18 04:47:17'),
(45, 11, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'VmlDyHlMxP1599195347', 1, '2020-10-17 10:09:24', '2020-10-17 10:09:24'),
(46, 11, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'VmlDyHlMxP1599195347', 1, '2020-10-17 10:09:24', '2020-10-17 10:09:24'),
(47, 11, 'Transport', 'bFrom St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'VmlDyHlMxP1599195347', 1, '2020-10-17 10:09:24', '2020-10-17 10:09:24'),
(48, 14, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'VmlDyHlMxP1599195347', 6, '2021-02-03 01:52:53', '2021-02-03 01:52:53'),
(49, 14, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'VmlDyHlMxP1599195347', 6, '2021-02-03 01:52:53', '2021-02-03 01:52:53'),
(50, 14, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'VmlDyHlMxP1599195347', 1, '2021-02-03 01:52:53', '2021-02-03 01:52:53'),
(64, 17, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', NULL, 1, '2021-03-02 00:57:19', '2021-03-02 00:57:19'),
(65, 17, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', NULL, 1, '2021-03-02 00:57:19', '2021-03-02 00:57:19'),
(66, 17, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', NULL, 1, '2021-03-02 00:57:19', '2021-03-02 00:57:19'),
(67, 17, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', NULL, 1, '2021-03-02 00:57:19', '2021-03-02 00:57:19'),
(68, 17, 'Flights', 'International flights included.', 'main', NULL, 1, '2021-03-02 00:57:19', '2021-03-02 00:57:19'),
(69, 17, 'pritam', 'welcome', 'main', NULL, 1, '2021-03-02 00:57:19', '2021-03-02 00:57:19'),
(70, 17, 'pk', 'welcome to wat', 'main', NULL, 1, '2021-03-02 00:57:19', '2021-03-02 00:57:19'),
(71, 18, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', NULL, 1, '2021-03-02 01:28:31', '2021-03-02 01:28:31'),
(72, 18, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', NULL, 1, '2021-03-02 01:28:31', '2021-03-02 01:28:31'),
(73, 18, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', NULL, 1, '2021-03-02 01:28:31', '2021-03-02 01:28:31'),
(74, 18, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', NULL, 1, '2021-03-02 01:28:31', '2021-03-02 01:28:31'),
(75, 18, 'Flights', 'International flights included.', 'main', NULL, 1, '2021-03-02 01:28:31', '2021-03-02 01:28:31'),
(76, 18, 'pk', 'rrrrrrrr', 'main', NULL, 1, '2021-03-02 01:28:31', '2021-03-02 01:28:31'),
(83, 21, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-04 06:00:08', '2021-03-04 06:00:08'),
(84, 21, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-04 06:00:08', '2021-03-04 06:00:08'),
(85, 21, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-04 06:00:09', '2021-03-04 06:00:09'),
(86, 21, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-04 06:00:09', '2021-03-04 06:00:09'),
(87, 21, 'Flights', 'International flights included.', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-04 06:00:09', '2021-03-04 06:00:09'),
(88, 21, 'pk', 'welcome to wat', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-04 06:00:09', '2021-03-04 06:00:09'),
(93, 23, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-05 01:06:43', '2021-03-05 01:06:43'),
(94, 23, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-05 01:06:43', '2021-03-05 01:06:43'),
(95, 23, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-05 01:06:43', '2021-03-05 01:06:43'),
(96, 23, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-05 01:06:43', '2021-03-05 01:06:43'),
(97, 23, 'Flights', 'International flights included.', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-05 01:06:43', '2021-03-05 01:06:43'),
(98, 22, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-05 01:17:46', '2021-03-05 01:17:46'),
(99, 27, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-05 01:17:46', '2021-03-05 01:17:46'),
(100, 27, 'Flights', 'International flights included.', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-05 01:17:46', '2021-03-05 01:17:46'),
(107, 29, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'tynpvmgksib3149687250', 13, '2021-03-18 03:06:50', '2021-03-18 03:06:50'),
(108, 29, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'tynpvmgksib3149687250', 13, '2021-03-18 03:06:50', '2021-03-18 03:06:50'),
(109, 29, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', 'tynpvmgksib3149687250', 13, '2021-03-18 03:06:50', '2021-03-18 03:06:50'),
(110, 29, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'tynpvmgksib3149687250', 13, '2021-03-18 03:06:50', '2021-03-18 03:06:50'),
(111, 29, 'Flights', 'International flights included.', 'main', 'tynpvmgksib3149687250', 13, '2021-03-18 03:06:50', '2021-03-18 03:06:50'),
(112, 29, 'hotel', '5 star hotel', 'main', 'tynpvmgksib3149687250', 13, '2021-03-18 03:06:50', '2021-03-18 03:06:50'),
(113, 28, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-18 04:57:17', '2021-03-18 04:57:17'),
(114, 28, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-18 04:57:17', '2021-03-18 04:57:17'),
(121, 30, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-18 05:35:05', '2021-03-18 05:35:05'),
(122, 30, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-18 05:35:05', '2021-03-18 05:35:05'),
(123, 30, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-18 05:35:06', '2021-03-18 05:35:06'),
(124, 30, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-18 05:35:06', '2021-03-18 05:35:06'),
(125, 30, 'Flights', 'International flights included.', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-18 05:35:06', '2021-03-18 05:35:06'),
(126, 30, 'hotel', '5 star hotel', 'main', 'xnlcgfokzme8269053174', 9, '2021-03-18 05:35:06', '2021-03-18 05:35:06'),
(132, 31, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', 'main', 'ixwjpvekmsq9035671428', 15, '2021-03-19 18:31:46', '2021-03-19 18:31:46'),
(133, 31, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', 'main', 'ixwjpvekmsq9035671428', 15, '2021-03-19 18:31:46', '2021-03-19 18:31:46'),
(134, 31, 'Meals', '4 breakfastsThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', 'main', 'ixwjpvekmsq9035671428', 15, '2021-03-19 18:31:46', '2021-03-19 18:31:46'),
(135, 31, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)Air-conditioned non-smoking coach or mini-bus and train', 'main', 'ixwjpvekmsq9035671428', 15, '2021-03-19 18:31:46', '2021-03-19 18:31:46'),
(136, 31, 'Flights', 'International flights included.', 'main', 'ixwjpvekmsq9035671428', 15, '2021-03-19 18:31:46', '2021-03-19 18:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `inclusion_masters`
--

CREATE TABLE `inclusion_masters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inclusion_masters`
--

INSERT INTO `inclusion_masters` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Accommodation', '4 star hotels and 4 bed sleeper cabin accommodation in the train', '2020-08-07 08:46:45', '0000-00-00 00:00:00'),
(2, 'Guide', 'Services of experienced guide licenced by the Ministry of Tourism', '2020-08-07 08:46:45', '0000-00-00 00:00:00'),
(3, 'Meals', '4 breakfasts\r\n\r\nThis tour offers Jain, Vegetarian, Halal and Kosher food options on request. Simply let our Customer Support team know the food option that you prefer. Vegan is not available for this tour.', '2020-08-07 08:49:28', NULL),
(4, 'Transport', 'From St. Petersburg airport to the Travel Talk hotel (on day 1)\r\nAir-conditioned non-smoking coach or mini-bus and train', '2020-08-07 08:49:28', NULL),
(5, 'Flights', 'International flights included.', '2020-08-07 08:49:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE `itineraries` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  `day_heading` varchar(255) NOT NULL,
  `included` text DEFAULT NULL,
  `excluded` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `unique_key` varchar(150) DEFAULT NULL,
  `dep_type` varchar(20) DEFAULT NULL,
  `tenant_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itineraries`
--

INSERT INTO `itineraries` (`id`, `departure_id`, `day_number`, `day_heading`, `included`, `excluded`, `description`, `unique_key`, `dep_type`, `tenant_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 15, 1, 'Arrive Bangkok, Thailand', '<ol><li>Four Seasons Hotel Moscow</li><li>Meals: Dinner</li></ol>', NULL, '<p>Arrive in Moscow, the capital of Russia, where you are met and transferred to your hotel, situated steps from Red Square. Gather this evening for a welcome briefing followed by dinner.</p>', 'uj4ZVOKCqx1598428258', 'main', 'VmlDyHlMxP1599195347', 6, 1, '2020-08-18 23:38:19', '2020-08-26 06:11:23'),
(2, 1, 2, 'Welcometo Chiang Mai', '<ol><li>Hotel Provided</li><li>Meals: Dinner</li></ol>', NULL, '<p><span style=\"color: rgb(70, 70, 70); font-family: Cairo, sans-serif; font-size: 16.5px;\">Tour two of the Kremlin’s cathedrals as well as the State Armory, home to priceless artifacts dating to the 14th century, and enjoy exclusive A&amp;K Insider Access to the Grand Kremlin Palace, official residence of President Putin (subject to closure for official functions). Later, tour the Moscow Metro, before dining at a local restaurant.</span><br></p>', 'RqzmX9ztTs1598428266', 'main', 'VmlDyHlMxP1599195347', 6, 1, '2020-08-19 03:03:02', '2020-08-26 02:21:06'),
(3, 4, 1, 'Welcome to phuket', '<ol><li>Four Seasons Hotel Moscow</li><li>Meals: Dinner<br></li></ol>', '<ol><li>Meals: Breakfast</li></ol>', '<p><span style=\"color: rgb(70, 70, 70); font-family: Cairo, sans-serif; font-size: 16.5px;\">Arrive in Moscow, the capital of Russia, where you are met and transferred to your hotel, situated steps from Red Square. Gather this evening for a welcome briefing followed by dinner.</span></p><p><br></p>', 'vGLtUtpdEI1598428219', 'main', 'VmlDyHlMxP1599195347', 6, 1, '2020-08-24 05:48:21', '2020-09-03 01:18:45'),
(4, 4, 2, 'Welcome to phuket', '<ol><li>Meals: Dinner</li><li>Four Seasons Hotel Moscow<br></li></ol>', '<ol><li>Meals: Breakfast</li><li>Hotel Moscow<br></li></ol>', '<p>Tour two of the Kremlin’s cathedrals as well as the State Armory, home to priceless artifacts dating to the 14th century, and enjoy exclusive A&amp;K Insider Access to the Grand Kremlin Palace, official residence of President Putin (subject to closure for official functions). Later, tour the Moscow Metro, before dining at a local restaurant.<br></p>', 'jmZF8MCEsA1598428229', 'main', 'VmlDyHlMxP1599195347', 6, 1, '2020-08-24 05:50:18', '2020-08-26 02:20:29'),
(5, 5, 1, 'Welcome to Moscow', '<ol><li>Meals: Dinner</li><li>Four Seasons Hotel Moscow<br></li></ol>', NULL, '<p>Tour two of the Kremlin’s cathedrals as well as the State Armory, home to priceless artifacts dating to the 14th century, and enjoy exclusive A&amp;K Insider Access to the Grand Kremlin Palace, official residence of President Putin (subject to closure for official functions). Later, tour the Moscow Metro, before dining at a local restaurant.<br></p>', 'jmZF8MCEsA15984282b4', 'main', 'VmlDyHlMxP1599195347', 6, 1, '2020-08-24 05:50:18', '2020-08-26 02:20:29'),
(6, 5, 2, 'Continue to Moscow', '<ol><li>Meals: Dinner</li><li>Four Seasons Hotel Moscow<br></li></ol>', '<ol><li>Meals: Breakfast</li><li>Hotel Moscow<br></li></ol>', '<p>Tour two of the Kremlin’s cathedrals as well as the State Armory, home to priceless artifacts dating to the 14th century, and enjoy exclusive A&amp;K Insider Access to the Grand Kremlin Palace, official residence of President Putin (subject to closure for official functions). Later, tour the Moscow Metro, before dining at a local restaurant.<br></p>', 'jmZF8MCEsA159842824f', 'main', 'VmlDyHlMxP1599195347', 6, 1, '2020-08-24 05:50:18', '2020-08-26 02:20:29'),
(10, 8, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '<ul><li><span style=\"font-weight: 700; margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry.</span></li><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><span style=\"font-weight: 700; margin: 0px; padding: 0px;\">Lorem Ipsum</span>&nbsp;is simply dummy text.<br></span><br></li></ul>', '<ol><li><span style=\"font-weight: 700; margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry.</span></li><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><span style=\"font-weight: 700; margin: 0px; padding: 0px;\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing.<br></span><br></li></ol>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span><br></p>', 'zD2tCFw78y1599290840', 'land', 'VmlDyHlMxP1599195347', 6, 0, '2020-09-05 01:57:20', '2020-09-06 06:48:09'),
(11, 8, 2, 'Qff ghghh kjhkjhkj gjgj bbbbbbbbb', '<ol><li>asdfgh</li><li>zxcvbn</li><li>bb</li></ol>', '<ul><li>sdfghj</li><li>bvcxgfhgf</li><li>dfsdg</li></ul>', '<p>asdfghjkl qwertyuio yhn zxcvbnm,&nbsp;</p><p>asfdsafdsgf dsgfdsgfd</p>', 'qkoMTXzvTb1599291750', 'land', 'VmlDyHlMxP1599195347', 6, 1, '2020-09-05 02:12:30', '2020-09-05 02:30:24'),
(12, 27, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '<ul><li><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text.</span></li><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing.<br></span><br></li></ul>', '<ul><li><span style=\"font-weight: 700; margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text.</span></li></ul>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span><br></p>', 's3kGtLpPIo1599753461', 'main', 'VmlDyHlMxP1599195347', 9, 1, '2020-09-10 10:27:41', '2020-09-10 10:27:41'),
(13, 27, 2, 'sssssss', '<p>ssssssss</p>', '<p>ssssssssss</p>', '<p>ssssssssssss</p>', 'cVo0csX9WN1600424640', 'main', 'VmlDyHlMxP1599195347', 9, 1, '2020-09-18 04:54:00', '2020-09-18 04:54:00'),
(14, 26, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. vv', '45,46,47', NULL, '<p>sadcsaf dcfdf</p>', 'xLS2hNsk1Q1602954861', 'main', 'VmlDyHlMxP1599195347', 9, 1, '2020-10-17 11:44:21', '2020-10-17 11:53:18');

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
(4, '2021_03_04_103806_create_all_destinations_table', 2),
(5, '2021_03_04_103902_create_all_airlines_table', 2),
(6, '2021_03_04_103939_create_hotel_categories_table', 2),
(7, '2021_03_05_094818_create_hold_departures_table', 3),
(8, '2021_03_08_113308_create_hold_tills_table', 4),
(9, '2021_03_08_113352_create_hold_durations_table', 4),
(10, '2021_03_09_094451_create_hold_departure_seats_table', 5),
(11, '2021_03_09_095100_create_book_departures_table', 6),
(13, '2021_03_15_103414_create_roles_table', 7);

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
('pritam.kumar@watconsultingservices.com', '$2y$10$/uj9UCC9AiKbKvYdmVe3sOJIHy/MTqFp5prdTFWkD6TWftjsnEvHi', '2021-03-03 00:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `module`, `created_at`, `updated_at`) VALUES
(23, 'Create-Departure', 'Departure', NULL, NULL),
(24, 'Departure-Edit', 'Departure', NULL, NULL),
(25, 'user-create', 'User', NULL, NULL),
(26, 'User-Edit', 'User', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_roles`
--

CREATE TABLE `permission_roles` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission_roles`
--

INSERT INTO `permission_roles` (`id`, `permission_id`, `role_id`) VALUES
(13, 1, 1),
(14, 2, 1),
(15, 1, 4),
(16, 2, 4),
(17, 15, 4),
(18, 16, 4),
(19, 21, 4);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `price_type_id` int(11) DEFAULT NULL,
  `symbol_inr` varchar(20) DEFAULT NULL,
  `price_inr` double DEFAULT NULL,
  `symbol_usd` varchar(20) DEFAULT NULL,
  `price_usd` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `departure_id`, `price_type_id`, `symbol_inr`, `price_inr`, `symbol_usd`, `price_usd`, `status`, `created_at`, `updated_at`) VALUES
(88, 27, 1, '₹', 520, '$', 100, 1, '2021-03-18 05:01:48', '2021-03-18 05:01:48'),
(89, 27, 2, '₹', 1100, '$', 110, 1, '2021-03-18 05:01:49', '2021-03-18 05:01:49'),
(90, 27, 3, '₹', 8888, '$', 9999, 1, '2021-03-18 05:01:49', '2021-03-18 05:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_types`
--

CREATE TABLE `pricing_types` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `symbol_inr` varchar(20) DEFAULT NULL,
  `symbol_usd` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing_types`
--

INSERT INTO `pricing_types` (`id`, `type`, `name`, `symbol_inr`, `symbol_usd`, `created_at`, `updated_at`) VALUES
(1, 'Type A', 'Agent Connect', '₹', '$', '2021-02-03 08:56:54', NULL),
(2, 'Type B', 'B2C', '₹', '$', '2021-02-03 08:56:54', NULL),
(3, 'Type C', 'Other', '₹', '$', '2021-02-03 08:57:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `tenant_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'technical', 'xnlcgfokzme8269053174', 9, 0, '2021-03-15 05:17:22', '2021-03-15 05:17:22'),
(2, 'udd', 'xnlcgfokzme8269053174', 9, 0, '2021-03-15 05:20:31', '2021-03-15 05:20:31'),
(3, 'ffff', 'xnlcgfokzme8269053174', 9, 0, '2021-03-15 06:08:36', '2021-03-15 06:08:36'),
(4, 'Manager', 'xnlcgfokzme8269053174', 9, 0, '2021-03-18 05:58:12', '2021-03-18 05:58:12');

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
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referred_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) NOT NULL DEFAULT 0,
  `user_type` int(10) NOT NULL DEFAULT 0,
  `main_user_type` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `mobile`, `company_name`, `company_id`, `status`, `country`, `address`, `referred_by`, `created_at`, `updated_at`, `tenant_id`, `role_id`, `user_type`, `main_user_type`) VALUES
(6, 'Raj Kumar', 'raj.kumar@watconsultingservices.com', '2021-03-03 01:00:16', '$2y$10$0hq4S147sAUvUoF28I7fyeQ5FoOSkubHkX6copBckcDo5BA8pZ5xm', 'vCROR710XoeOxtVdBvqOIoMt9ZaebGMlqhvAMWAC1zVjeJyUWs5NXUF0GbpG', NULL, 'DOOK', 'DOOKINTER', 0, NULL, NULL, NULL, '2021-03-03 00:59:47', '2021-03-03 01:00:16', 'VmlDyHlMxP1599195347', 0, 0, 2),
(9, 'pritam', 'pritam.kumar@watconsultingservices.com', '2021-03-01 13:38:04', '$2y$10$HyFlipRBuhZ3t.Sly9Uct.nl96T66bxXITajikqg2inHw1cSjzw5G', NULL, '8540075106', 'abc', '34et5r5uyhj', 0, NULL, NULL, NULL, '2021-03-04 03:53:49', '2021-03-04 03:53:49', 'xnlcgfokzme8269053174', 0, 0, 0),
(15, 'pritam', 'kpritamk123@gmail.com', '2021-03-18 23:15:36', '$2y$10$wQC/IaZdd/06zvZ8z8L7xO7H65HLJkkLZvrztGjsrF0Hrvfiukey6', NULL, '8540075106', 'ABC', 'fsdfd', 0, NULL, NULL, NULL, '2021-03-18 23:14:31', '2021-03-18 23:15:36', 'ixwjpvekmsq9035671428', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_itineraries`
--
ALTER TABLE `agent_itineraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_airlines`
--
ALTER TABLE `all_airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_destinations`
--
ALTER TABLE `all_destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_departures`
--
ALTER TABLE `book_departures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries_old`
--
ALTER TABLE `countries_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_departures`
--
ALTER TABLE `country_departures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_symbols`
--
ALTER TABLE `currency_symbols`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departures`
--
ALTER TABLE `departures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departure_destinations`
--
ALTER TABLE `departure_destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departure_id` (`departure_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations_old`
--
ALTER TABLE `destinations_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination_itinerary_point_of_interests`
--
ALTER TABLE `destination_itinerary_point_of_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hold_departures`
--
ALTER TABLE `hold_departures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hold_departure_seats`
--
ALTER TABLE `hold_departure_seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hold_durations`
--
ALTER TABLE `hold_durations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hold_tills`
--
ALTER TABLE `hold_tills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_categories`
--
ALTER TABLE `hotel_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inclusions`
--
ALTER TABLE `inclusions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inclusion_masters`
--
ALTER TABLE `inclusion_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itineraries`
--
ALTER TABLE `itineraries`
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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_roles`
--
ALTER TABLE `permission_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_types`
--
ALTER TABLE `pricing_types`
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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_itineraries`
--
ALTER TABLE `agent_itineraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `all_airlines`
--
ALTER TABLE `all_airlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `all_destinations`
--
ALTER TABLE `all_destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `book_departures`
--
ALTER TABLE `book_departures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `countries_old`
--
ALTER TABLE `countries_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `country_departures`
--
ALTER TABLE `country_departures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `currency_symbols`
--
ALTER TABLE `currency_symbols`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `departures`
--
ALTER TABLE `departures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `departure_destinations`
--
ALTER TABLE `departure_destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `destinations_old`
--
ALTER TABLE `destinations_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `destination_itinerary_point_of_interests`
--
ALTER TABLE `destination_itinerary_point_of_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hold_departures`
--
ALTER TABLE `hold_departures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hold_departure_seats`
--
ALTER TABLE `hold_departure_seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hold_durations`
--
ALTER TABLE `hold_durations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hold_tills`
--
ALTER TABLE `hold_tills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `hotel_categories`
--
ALTER TABLE `hotel_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inclusions`
--
ALTER TABLE `inclusions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `inclusion_masters`
--
ALTER TABLE `inclusion_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itineraries`
--
ALTER TABLE `itineraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `permission_roles`
--
ALTER TABLE `permission_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `pricing_types`
--
ALTER TABLE `pricing_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
