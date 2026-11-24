-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 12:14 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppms`
--

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base_lines`
--

CREATE TABLE `base_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `base_line_type` enum('before','after') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'before',
  `private_conn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public_tap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_capita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public_toilet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water_seal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pit_latrine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `none` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `base_lines`
--

INSERT INTO `base_lines` (`id`, `project_id`, `base_line_type`, `private_conn`, `public_tap`, `source`, `average_time`, `per_capita`, `quality`, `public_toilet`, `water_seal`, `vip`, `pit_latrine`, `none`, `created_at`, `updated_at`) VALUES
(1, 1, 'before', '81', '54', '70', '6', '14', '56', '60', '45', '24', '82', 27, '2021-03-03 04:04:32', '2021-03-03 04:04:32'),
(2, 1, 'after', '78', '69', '62', '66', '20', '65', '96', '52', '66', '74', 44, '2021-03-03 04:04:32', '2021-03-03 04:04:32'),
(3, 2, 'before', '1', '97', '12', '63', '59', '11', '22', '43', '55', '81', 7, '2021-03-03 04:08:41', '2021-03-03 04:08:41'),
(4, 2, 'after', '63', '83', '52', '72', '27', '26', '75', '2', '82', '17', 11, '2021-03-03 04:08:41', '2021-03-03 04:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `beneficiary_sector` enum('water_supply','sanitation','drainage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dalit_f` int(11) DEFAULT NULL,
  `dalit_m` int(11) DEFAULT NULL,
  `janjati_f` int(11) DEFAULT NULL,
  `janjati_m` int(11) DEFAULT NULL,
  `bramin_f` int(11) DEFAULT NULL,
  `bramin_m` int(11) DEFAULT NULL,
  `other_f` int(11) DEFAULT NULL,
  `other_m` int(11) DEFAULT NULL,
  `muslim_f` int(11) DEFAULT NULL,
  `muslim_m` int(11) DEFAULT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `status_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `project_id`, `beneficiary_sector`, `dalit_f`, `dalit_m`, `janjati_f`, `janjati_m`, `bramin_f`, `bramin_m`, `other_f`, `other_m`, `muslim_f`, `muslim_m`, `status`, `status_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'water_supply', 5, 4, 5, 6, 2, 6, 5, 4, 2, 4, 'submitted', '2021-03-03', '2021-03-03 04:20:00', '2021-03-03 04:20:00'),
(2, 2, 'sanitation', 4, 2, 18, 9, 12, 22, 5, 4, 12, 5, 'submitted', '2021-03-03', '2021-03-03 04:20:35', '2021-03-03 04:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_logs`
--

CREATE TABLE `beneficiary_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `beneficiary_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_date` date NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beneficiary_logs`
--

INSERT INTO `beneficiary_logs` (`id`, `beneficiary_id`, `user_id`, `status`, `status_date`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'submitted', '2021-03-03', NULL, '2021-03-03 04:20:00', '2021-03-03 04:20:00'),
(2, 2, 2, 'submitted', '2021-03-03', NULL, '2021-03-03 04:20:35', '2021-03-03 04:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `short_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'India', 'IND', 'active', NULL, NULL, NULL),
(2, 'America', 'USA', 'active', NULL, NULL, NULL),
(3, 'China', 'CHINA', 'active', NULL, NULL, NULL),
(4, 'Canada', 'CANADA', 'active', NULL, NULL, NULL),
(5, 'Nepal', 'NPL', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `designation_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `designation_short_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Programmer', 'programmer', NULL, NULL, NULL),
(2, 'Manager', 'manager', NULL, NULL, NULL),
(3, 'CEO', 'ceo', NULL, NULL, NULL),
(4, 'Designer', 'designer', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `pradesh_id` int(10) UNSIGNED NOT NULL,
  `district_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nepali_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `english_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `pradesh_id`, `district_code`, `nepali_name`, `english_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'ताप्लेजुङ', 'Taplejung', NULL, NULL, '2018-01-23 21:11:20'),
(2, 1, '2', 'पाचथर', 'Panchthar', NULL, NULL, '2018-01-23 21:12:34'),
(3, 1, '3', 'ईलाम', 'Ilam', NULL, NULL, '2018-01-23 21:13:05'),
(4, 1, '4', 'झापा', 'Jhapa', NULL, NULL, '2018-01-23 21:13:31'),
(5, 1, '5', 'मोरङ', 'Morang', NULL, NULL, '2018-01-23 21:14:18'),
(6, 1, '6', 'सुनसरि', 'Sunsari', NULL, NULL, '2018-01-23 21:14:20'),
(7, 1, '7', 'धनकुटा', 'Dhankuta', NULL, NULL, '2018-01-23 21:14:55'),
(8, 1, '8', 'तेह्थुम', 'Terhathum', NULL, NULL, '2018-01-23 21:15:33'),
(9, 1, '9', 'Sankhuwasabha', 'Sankhuwasabha', NULL, NULL, NULL),
(10, 1, '10', 'Bhojpur', 'Bhojpur', NULL, NULL, NULL),
(11, 1, '11', 'Solukhumbu', 'Solukhumbu', NULL, NULL, NULL),
(12, 1, '12', 'Okhaldhunga', 'Okhaldhunga', NULL, NULL, NULL),
(13, 1, '13', 'Khotang', 'Khotang', NULL, NULL, NULL),
(14, 1, '14', 'Udayapur', 'Udayapur', NULL, NULL, NULL),
(15, 2, '15', 'सप्तरी', 'Saptari', NULL, NULL, '2018-01-23 21:13:47'),
(16, 2, '16', 'सिरहा', 'Siraha', NULL, NULL, '2018-01-23 21:14:19'),
(17, 2, '17', 'धनुषा', 'Dhanusa', NULL, NULL, '2018-01-23 21:11:18'),
(18, 2, '18', 'महोत्तरी', 'Mahottari', NULL, NULL, '2018-01-23 21:10:58'),
(19, 2, '19', 'Sarlahi', 'Sarlahi', NULL, NULL, NULL),
(20, 3, '20', 'सिन्धुली', 'Sindhuli', NULL, NULL, '2018-01-23 21:11:28'),
(21, 3, '21', 'Ramechhap', 'Ramechhap', NULL, NULL, NULL),
(22, 3, '22', 'Dolakha', 'Dolakha', NULL, NULL, NULL),
(23, 3, '23', 'सिन्धुपाल्चोक', 'Sindhupalchok', NULL, NULL, '2018-01-20 19:50:21'),
(24, 3, '24', 'काभ्रे', 'Kavre', NULL, NULL, '2018-01-23 21:15:38'),
(25, 3, '25', 'Lalitpur', 'Lalitpur', NULL, NULL, NULL),
(26, 3, '26', 'भक्तपुर', 'Bhaktapur', NULL, NULL, '2018-01-20 19:50:15'),
(27, 3, '27', 'काठमाण्डौ', 'Kathmandu', NULL, NULL, '2018-01-20 19:49:31'),
(28, 3, '28', 'Nuwakot', 'Nuwakot', NULL, NULL, NULL),
(29, 3, '29', 'रसुवा', 'Rasuwa', NULL, NULL, '2018-01-23 21:11:24'),
(30, 3, '30', 'धादिङ', 'Dhading', NULL, NULL, '2018-01-23 21:16:09'),
(31, 3, '31', 'Makwanpur', 'Makwanpur', NULL, NULL, NULL),
(32, 2, '32', 'Rautahat', 'Rautahat', NULL, NULL, NULL),
(33, 2, '33', 'बारा', 'Bara', NULL, NULL, '2018-01-23 21:09:33'),
(34, 2, '34', 'पर्सा', 'Parsa', NULL, NULL, '2018-01-23 21:12:26'),
(35, 3, '35', 'चितवन', 'Chitawan', NULL, NULL, '2018-01-23 21:14:04'),
(36, 4, '36', 'गोरखा', 'Gorkha', NULL, NULL, '2018-01-23 21:11:08'),
(37, 4, '37', 'लम्जुङ', 'Lamjung', NULL, NULL, '2018-01-23 21:14:28'),
(38, 4, '39', 'तनहुं', 'Tanahu', NULL, NULL, '2018-01-23 21:11:28'),
(39, 4, '41', 'स्याङ्जा', 'Syangja', NULL, NULL, '2018-01-23 21:12:52'),
(40, 4, '40', 'कास्की', 'Kaski', NULL, NULL, '2018-01-23 21:13:40'),
(41, 4, '41', 'Manang', 'Manang', NULL, NULL, NULL),
(42, 4, '42', 'Mustang', 'Mustang', NULL, NULL, NULL),
(43, 4, '43', 'Myagdi', 'Myagdi', NULL, NULL, NULL),
(44, 4, '44', 'पर्वत', 'Parbat', NULL, NULL, '2018-01-23 21:13:25'),
(45, 4, '45', 'Baglung', 'Baglung', NULL, NULL, NULL),
(46, 5, '46', 'Gulmi', 'Gulmi', NULL, NULL, NULL),
(47, 5, '47', 'Palpa', 'Palpa', NULL, NULL, NULL),
(48, 5, '48', 'Nawalpur', 'Nawalparasi', NULL, NULL, '2018-01-20 19:32:52'),
(49, 5, '49', 'रुपन्देही', 'Rupandehi', NULL, NULL, '2018-01-23 21:41:26'),
(50, 5, '50', 'Kapilbastu', 'Kapilbastu', NULL, NULL, NULL),
(51, 5, '51', 'Arghakhanchi', 'Arghakhanchi', NULL, NULL, '2018-01-19 18:42:33'),
(52, 5, '52', 'Pyuthan', 'Pyuthan', NULL, NULL, NULL),
(53, 5, '53', 'रोल्पा', 'Rolpa', NULL, NULL, '2018-01-23 21:12:38'),
(54, 6, '54', 'रुकुम', 'Rukum', NULL, NULL, '2018-01-23 21:12:25'),
(55, 6, '55', 'Salyan', 'Salyan', NULL, NULL, NULL),
(56, 5, '56', 'दाङ्ग', 'Dang', NULL, NULL, '2018-01-23 21:13:05'),
(57, 5, '57', 'बाँके', 'Banke', NULL, NULL, '2018-01-23 21:11:02'),
(58, 5, '58', 'Bardiya', 'Bardiya', NULL, NULL, NULL),
(59, 6, '59', 'सुर्खेत', 'Surkhet', NULL, NULL, '2018-01-23 21:11:12'),
(60, 6, '60', 'दैलेख', 'Dailekh', NULL, NULL, '2018-01-23 21:16:23'),
(61, 6, '61', 'जाजरकोटट', 'Jajarkot', NULL, NULL, '2018-01-20 19:49:40'),
(62, 6, '62', 'डोल्पा', 'Dolpa', NULL, NULL, '2018-01-23 21:12:06'),
(63, 6, '63', 'जुम्ला', 'Jumla', NULL, NULL, '2018-01-20 19:50:38'),
(64, 6, '64', 'कालिकोट', 'Kalikot', NULL, NULL, '2018-01-20 19:51:00'),
(65, 6, '65', 'मुगु', 'Mugu', NULL, NULL, '2018-01-20 19:54:37'),
(66, 6, '66', 'Humla', 'Humla', NULL, NULL, NULL),
(67, 7, '67', 'Bajura', 'Bajura', NULL, NULL, NULL),
(68, 7, '68', 'बझाङ्ग', 'Bajhang', NULL, NULL, '2018-01-23 21:10:50'),
(69, 7, '69', 'अछाम', 'Achham', NULL, NULL, '2018-01-23 21:10:01'),
(70, 7, '70', 'डोटी', 'Doti', NULL, NULL, '2018-01-23 21:10:18'),
(71, 7, '71', 'Kailali', 'Kailali', NULL, NULL, NULL),
(72, 7, '72', 'Kanchanpur', 'Kanchanpur', NULL, NULL, NULL),
(73, 7, '73', 'Dadeldhura', 'Dadeldhura', NULL, NULL, NULL),
(74, 7, '74', 'बैतडि', 'Baitadi', NULL, NULL, '2018-01-23 21:15:36'),
(75, 7, '75', 'Darchaula', 'Darchaula', NULL, NULL, NULL),
(76, 5, '76', 'पुर्वि रुकुम', NULL, NULL, '2018-01-20 19:30:57', '2018-01-20 19:31:39'),
(77, 5, '77', 'नवलपुर', NULL, NULL, '2018-01-20 19:31:59', '2018-01-20 19:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `doc_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`file`)),
  `external_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signed_date` date NOT NULL,
  `approved_date` date NOT NULL,
  `clearance_date` date NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `project_id`, `cat_id`, `doc_title`, `file`, `external_link`, `signed_date`, `approved_date`, `clearance_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Title 1', '[\"1614766863RuWyE4.png\"]', NULL, '2021-03-03', '2021-03-03', '2021-03-03', 2, '2021-03-03 04:36:03', '2021-03-03 04:36:03'),
(2, 2, 1, 'Title 2', '[\"1614766941kKAREp.png\"]', NULL, '2021-06-16', '2021-08-22', '2021-01-13', 2, '2021-03-03 04:37:21', '2021-03-03 04:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `document_catgories`
--

CREATE TABLE `document_catgories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_catgories`
--

INSERT INTO `document_catgories` (`id`, `cat_name`, `created_at`, `updated_at`) VALUES
(1, 'Category  1', '2021-03-03 04:34:24', '2021-03-03 04:34:24'),
(2, 'Category  2', '2021-03-03 04:34:28', '2021-03-03 04:34:28'),
(3, 'Category 3', '2021-03-03 04:34:33', '2021-03-03 04:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `environmental_monthlies`
--

CREATE TABLE `environmental_monthlies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` enum('ssEmp','environmental','risk','safety','community','issues','socialSafeguard') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `environmental_monthlies`
--

INSERT INTO `environmental_monthlies` (`id`, `title`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'Submission of SS-EMP Monitoring report (Monthly by Contractor )', 'ssEmp', NULL, NULL),
(2, 'Air quality Monitoing results (Bi-Annual)', 'environmental', NULL, NULL),
(3, 'Water quality Monitoring & results (Monthly)', 'environmental', NULL, NULL),
(4, 'Noise quality Monitoring & results (Monthly)', 'environmental', NULL, NULL),
(5, 'Minor Injury', 'risk', NULL, NULL),
(6, 'Major Injury', 'risk', NULL, NULL),
(7, 'Near miss', 'risk', NULL, NULL),
(8, 'Fatal Injury', 'risk', NULL, NULL),
(9, 'Record & Notify of accidents/incidents to RPMO within 24 Hrs', 'risk', NULL, NULL),
(10, 'Emergency Contact Details Available on-site', 'risk', NULL, NULL),
(11, 'MoU Tie-ups with local hospitals/clinics for emergencies Cases', 'safety', NULL, NULL),
(12, 'Safety and health facility for WorkersSafety and health facility for Workers', 'safety', NULL, NULL),
(13, 'Insurance of all Labor done', 'safety', NULL, NULL),
(14, 'Enough PPE Supply & use (gloves/goggles/ safety hat/ safety boots, etc..)', 'safety', NULL, NULL),
(15, 'Safety brefieing to workers by safety officers', 'safety', NULL, NULL),
(16, 'Daily Toolbox talks Conducted on Site', 'safety', NULL, NULL),
(17, 'Separate Toilet facilities for male and female', 'safety', NULL, NULL),
(18, 'Fire fighting Mechanisam, Fire extinguishe (since Welding is prone in the project)', 'safety', NULL, NULL),
(19, 'Drinking water supply available at Site', 'safety', NULL, NULL),
(20, 'Storage areas for chemicals protection', 'safety', NULL, NULL),
(21, 'Emergency Assembly management (incase of earthquake or flood or storm etc)', 'safety', NULL, NULL),
(22, 'Excavation areas provided with Hard barricades', 'community', NULL, NULL),
(23, 'Safety signages posted around the sites', 'community', NULL, NULL),
(24, 'Temporary and safe walkways for pedestrians available at sites', 'community', NULL, NULL),
(25, 'Record of treated wastewater quality testing/measurement', 'community', NULL, NULL),
(26, 'Kitchen is place away from resident room', 'community', NULL, NULL),
(27, 'Gas Cylinder place outside Kitchen', 'community', NULL, NULL),
(28, 'Traffic Management', 'community', NULL, NULL),
(29, 'Traffic signages available around the construction sites and nearby roads', 'community', NULL, NULL),
(30, 'Re-routing signages sufficient to guide motorists', 'community', NULL, NULL),
(31, 'Excavation sites along roads provided with barricades with reflectors', 'community', NULL, NULL),
(32, 'Excavation sites provided with sufficient lighting at night', 'community', NULL, NULL),
(33, 'Major issues/concerns (specify)', 'issues', NULL, NULL),
(34, 'Corrective Action to be implemented, timeline, responsible person/s, and budget specified', 'issues', NULL, NULL),
(35, 'Insurance?', 'socialSafeguard', NULL, NULL),
(36, 'PPE (gloves/goggles/safety hat/ safety boots, etc..)', 'socialSafeguard', NULL, NULL),
(37, 'Safety brefieing to workers by safety officersrecords', 'socialSafeguard', NULL, NULL),
(38, 'Mockdrills', 'socialSafeguard', NULL, NULL),
(39, 'Training if any:', 'socialSafeguard', NULL, NULL),
(40, 'Fire fighting (since Welding is prone in the project)', 'socialSafeguard', NULL, NULL),
(41, 'Emergency Assembly management (incase of earthquake or flood or storm etc)', 'socialSafeguard', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `environmental_monthly_records`
--

CREATE TABLE `environmental_monthly_records` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `env_group_id` int(10) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `status` enum('y','n','na') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `environmental_monthly_records`
--

INSERT INTO `environmental_monthly_records` (`id`, `project_id`, `env_group_id`, `year`, `month`, `status`, `result`, `file`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2017, 5, 'y', 'Deserunt quisquam te', '1614767133oKuX9S.png', 'Distinctio Et cupid', '2021-03-03 04:40:33', '2021-03-03 04:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `environments`
--

CREATE TABLE `environments` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `gon_tor_approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gon_tor_approval_date` date DEFAULT NULL,
  `gon_draft_iee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gon_draft_iee_date` date DEFAULT NULL,
  `gon_presen_iee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gon_presen_iee_date` date DEFAULT NULL,
  `gon_final_iee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gon_final_iee_date` date DEFAULT NULL,
  `gon_approval_iee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gon_approval_iee_date` date DEFAULT NULL,
  `adb_report_submi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adb_report_submi_date` date DEFAULT NULL,
  `adb_report_disclosed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adb_report_disclosed_date` date DEFAULT NULL,
  `adb_revised_iee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adb_revised_iee_date` date DEFAULT NULL,
  `adb_final_approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adb_final_approval_date` date DEFAULT NULL,
  `emp_ssemp_prepared` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SS-EMP Prepared & Approved',
  `focal_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Apoint of EHS Focal person (Contractor)',
  `safe_statutory_clearance` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Compliance With Statutory Clearances ',
  `safe_envi_clearance` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Environmental Clearance (EC), IEE approved',
  `safe_site_clearance` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Site location clearance',
  `safe_tree_cutting` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tree-cutting permit',
  `safe_no_objection` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'No Objection Certificate/Letter for work from concern authority ',
  `safe_construct_permit` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Permit/Consent to Construct (or equivalent)',
  `safe_operate_permit` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Permit/Consent to Operate (or equivalent)',
  `safe_road_cutting_permit` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Road-cutting permit',
  `safe_utility_shifting_permit` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Utilities shifting permit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `environments`
--

INSERT INTO `environments` (`id`, `project_id`, `gon_tor_approval`, `gon_tor_approval_date`, `gon_draft_iee`, `gon_draft_iee_date`, `gon_presen_iee`, `gon_presen_iee_date`, `gon_final_iee`, `gon_final_iee_date`, `gon_approval_iee`, `gon_approval_iee_date`, `adb_report_submi`, `adb_report_submi_date`, `adb_report_disclosed`, `adb_report_disclosed_date`, `adb_revised_iee`, `adb_revised_iee_date`, `adb_final_approval`, `adb_final_approval_date`, `emp_ssemp_prepared`, `focal_person`, `safe_statutory_clearance`, `safe_envi_clearance`, `safe_site_clearance`, `safe_tree_cutting`, `safe_no_objection`, `safe_construct_permit`, `safe_operate_permit`, `safe_road_cutting_permit`, `safe_utility_shifting_permit`, `created_at`, `updated_at`) VALUES
(1, 2, 'Aut quae in iusto se', '2021-03-04', 'Nostrud maxime sed c', '2021-03-25', 'Enim quis reiciendis', '2021-03-31', 'Cupidatat quia tempo', '2021-03-24', 'Dolor accusantium ei', '2021-03-24', 'Eos harum accusamus', '2021-03-03', 'Quibusdam incididunt', '2021-03-31', 'At omnis unde quo ip', '2021-03-24', 'Assumenda debitis re', '2021-03-23', 'y', 'y', 'y', 'n', 'y', 'n', 'n', 'n', 'y', 'n', 'y', '2021-03-03 04:40:15', '2021-03-03 04:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `eots`
--

CREATE TABLE `eots` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revised_contract_date` date DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stage1_completion_date` date DEFAULT NULL,
  `stage2_completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `category` enum('bug','suggestion','feedback') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_years`
--

CREATE TABLE `fiscal_years` (
  `id` int(10) UNSIGNED NOT NULL,
  `fy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fy_start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fy_start_date_localized` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fy_end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fy_end_date_localized` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fy_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fiscal_years`
--

INSERT INTO `fiscal_years` (`id`, `fy_name`, `fy_start_date`, `fy_start_date_localized`, `fy_end_date`, `fy_end_date_localized`, `fy_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2017', '2017-1-1', NULL, '2017-12-30', NULL, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grievances`
--

CREATE TABLE `grievances` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `issue` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recorded_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complain_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complain_date` date DEFAULT NULL,
  `affected_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_taken` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grievances`
--

INSERT INTO `grievances` (`id`, `project_id`, `issue`, `recorded_status`, `complain_by`, `complain_date`, `affected_site`, `action_taken`, `current_status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 'Commodi accusantium', 'Asperiores explicabo', 'Voluptatum sit ipsa', '2021-03-25', 'Voluptatem nemo arc', 'Quo iste voluptate p', 'Et quibusdam ipsum v', 'Non mollit laboris e', '2021-03-03 04:40:49', '2021-03-03 04:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `grievance_communities`
--

CREATE TABLE `grievance_communities` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `level` enum('ward','muni') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_id` int(11) NOT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forwarded_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grievance_communities`
--

INSERT INTO `grievance_communities` (`id`, `project_id`, `level`, `name`, `designation_id`, `contact_no`, `email`, `forwarded_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'ward', 'Mikayla Austin', 6, 21212312, 'zujecylez@mailinator.com', '2021-03-09', '2021-03-03 04:42:00', '2021-03-03 04:42:00'),
(2, 2, 'muni', 'Avye Bailey', 9, 312312312, 'gahor@mailinator.com', '2021-03-11', '2021-03-03 04:42:00', '2021-03-03 04:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `institutionals`
--

CREATE TABLE `institutionals` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `institution_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution_type` enum('school','healthpost','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_female` int(11) NOT NULL,
  `total_male` int(11) NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `status_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institutionals`
--

INSERT INTO `institutionals` (`id`, `project_id`, `institution_name`, `institution_type`, `total_female`, `total_male`, `status`, `status_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Institution 1', 'healthpost', 16, 73, 'submitted', '2021-03-03', '2021-03-03 04:21:01', '2021-03-03 04:21:01'),
(2, 2, 'Institution Name 2', 'school', 58, 19, 'submitted', '2021-03-03', '2021-03-03 04:21:12', '2021-03-03 04:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `institution_logs`
--

CREATE TABLE `institution_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_date` date NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institution_logs`
--

INSERT INTO `institution_logs` (`id`, `institution_id`, `user_id`, `status`, `status_date`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'submitted', '2021-03-03', NULL, '2021-03-03 04:21:01', '2021-03-03 04:21:01'),
(2, 2, 2, 'submitted', '2021-03-03', NULL, '2021-03-03 04:21:12', '2021-03-03 04:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `login_fails`
--

CREATE TABLE `login_fails` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fail_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_in_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_in_device` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_in_date` date DEFAULT NULL,
  `log_in_device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_in_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `log_in_date`, `log_in_device`, `log_in_ip`, `created_at`, `updated_at`) VALUES
(1, 2, '2021-03-03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '127.0.0.1', '2021-03-03 04:11:50', '2021-03-03 04:11:50'),
(2, 2, '2021-03-03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '127.0.0.1', '2021-03-03 04:16:52', '2021-03-03 04:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_css` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `menu_order` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `menu_name`, `menu_controller`, `menu_link`, `menu_css`, `menu_icon`, `menu_status`, `menu_order`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, 'Users', 'UserController', '/user', '', '<i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i>', '1', 2, NULL, NULL, NULL),
(2, 0, 'Roles', '', '', '', '<i class=\"fa fa-wrench\" aria-hidden=\"true\"></i>', '1', 3, NULL, NULL, NULL),
(3, 0, 'Configuration', '', '', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 4, NULL, NULL, NULL),
(4, 0, 'Logs', '', '', '', '<i class=\"fa fa-child\" aria-hidden=\"true\"></i>', '1', 5, NULL, NULL, NULL),
(5, 2, 'Menus', 'MenuController', '/roles/menu', '', '<i class=\"fa fa-list\" aria-hidden=\"true\"></i>', '1', 0, NULL, NULL, NULL),
(6, 2, 'User Groups', 'UserGroupController', '/roles/group', '', '<i class=\"fa fa-group\" aria-hidden=\"true\"></i>', '1', 1, NULL, NULL, NULL),
(7, 2, 'Role Access', 'RoleAccessController', '/roles/roleAccessIndex', '', '<i class=\"fa fa-unlock\" aria-hidden=\"true\"></i>', '1', 2, NULL, NULL, NULL),
(8, 3, 'Designation', 'DesignationController', '/configurations/designation', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 3, NULL, NULL, NULL),
(9, 3, 'Fiscal Year', 'FiscalYearController', '/configurations/fiscalYear', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 5, NULL, NULL, NULL),
(10, 3, 'Department', 'DepartmentController', '/configurations/department', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 1, NULL, NULL, NULL),
(11, 3, 'Country', 'CountryController', '/configurations/country', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 9, NULL, NULL, NULL),
(12, 3, 'Pradesh', 'PradeshController', '/configurations/pradesh', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 10, NULL, NULL, NULL),
(13, 3, 'Municipality Type', 'MuniTypeController', '/configurations/muniType', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 11, NULL, NULL, NULL),
(14, 3, 'District', 'DistrictController', '/configurations/district', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 13, NULL, NULL, NULL),
(15, 3, 'Municipality', 'MunicipalityController', '/configurations/municipality', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 13, NULL, NULL, NULL),
(16, 3, 'Office Type', 'OfficeTypeController', '/configurations/officeType', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 14, NULL, NULL, NULL),
(17, 3, 'Office', 'OfficeController', '/configurations/office', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 15, NULL, NULL, NULL),
(18, 3, 'ProgramTypes', 'ProgramTypeController', '/configurations/programTypes', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 16, NULL, NULL, NULL),
(19, 3, 'OBATypes', 'ObaTypeController', '/configurations/obaTypes', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 17, NULL, NULL, NULL),
(20, 4, 'Login Logs', 'LogController', '/logs/loginLogs', '', '<i class=\"fa fa-user-plus\" aria-hidden=\"true\"></i>', '1', 1, NULL, NULL, NULL),
(21, 4, 'Failed Login Logs', 'LogController', '/logs/failLoginLogs', '', '<i class=\"fa fa-user-times\" aria-hidden=\"true\"></i>', '1', 2, NULL, NULL, NULL),
(22, 0, 'Projects', '', '', '', '<i class=\"fas fa-bars\"></i>', '1', 7, NULL, NULL, NULL),
(23, 22, 'Details', 'ProjectController', '/project/details', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 1, NULL, NULL, NULL),
(24, 22, 'Beneficiary Details', 'BeneficiaryController', '/project/beneficiary', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 2, NULL, NULL, NULL),
(25, 22, 'Institutional Details', 'InstitutionalController', '/project/institutional', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 3, NULL, NULL, NULL),
(26, 22, 'Workmanship Details', 'WorkmanshipController', '/project/workmanship', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 4, NULL, NULL, NULL),
(27, 22, 'Programs Details', 'ProgramsController', '/project/programs', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 5, NULL, NULL, NULL),
(28, 22, 'Oba Details', 'ObaController', '/project/oba', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 6, NULL, NULL, NULL),
(29, 22, 'WUSC Information', 'MemberController', '/project/member', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 7, NULL, NULL, NULL),
(30, 22, 'Monitoring', 'MonitoringController', '/project/monitoring', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 8, NULL, NULL, NULL),
(31, 22, 'Vo Details', 'VoController', '/project/vo', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 10, NULL, NULL, NULL),
(32, 22, 'Eot Details', 'EotController', '/project/eot', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i', '1', 11, NULL, NULL, NULL),
(33, 22, 'Documents', 'DocumentController', '/project/document', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 12, NULL, NULL, NULL),
(34, 3, 'Document Category', 'DocumentCategoryController', '/configurations/document_category', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 18, NULL, NULL, NULL),
(35, 22, 'ProgressData', 'ProgressDataController', '/project/progressData', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 13, NULL, NULL, NULL),
(36, 3, 'PMO', 'PmoController', '/configurations/pmo', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 19, NULL, NULL, NULL),
(37, 22, 'Payment', 'PaymentController', '/project/payment', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 14, NULL, NULL, NULL),
(38, 22, 'Worker Details', 'WorkerController', '/project/worker', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 15, NULL, NULL, NULL),
(39, 0, 'Reports', '', '', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 8, NULL, NULL, NULL),
(40, 39, 'S-curve', 'ReportController', 'reports/s-curve', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 1, NULL, NULL, NULL),
(41, 22, 'Environment', 'EnvironmentController', '/project/environment', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 16, NULL, NULL, NULL),
(42, 22, 'Environmental Monthy Data', 'EnvironmentalMonthlyRecordController', '/project/environmental_monthly_record', '', '<i class=\"fas fa-arrow-alt-circle-right\"></i>', '1', 17, NULL, NULL, NULL),
(43, 3, 'QC Types', 'QCTypeController', '/configurations/qcType', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 20, NULL, NULL, NULL),
(44, 22, 'Grievanace', 'GrievanceController', '/project/grievance', '', '<i class=\"fas fa-arrow-alt-circle-right\" aria-hidden=\"true\"></i>', '1', 18, NULL, NULL, NULL),
(45, 22, 'Grievanace Committe', 'GrievanceCommitteController', '/project/grievanceCommitte', '', '<i class=\"fas fa-arrow-alt-circle-right\" aria-hidden=\"true\"></i>', '1', 19, NULL, NULL, NULL),
(46, 22, 'Social Safe Guard', 'SafeguardController', '/project/safeguard', '', '<i class=\"fas fa-arrow-alt-circle-right\" aria-hidden=\"true\"></i>', '1', 20, NULL, NULL, NULL),
(47, 22, 'Safe Guard Indicators', 'SafeGuardIndicatorsController', '/project/safeguardindicators', '', '<i class=\"fas fa-arrow-alt-circle-right\" aria-hidden=\"true\"></i>', '1', 2, NULL, NULL, NULL),
(48, 22, 'Quality Control', 'QualityControlController', '/project/qualityControl', '', '<i class=\"fas fa-arrow-alt-circle-right\" aria-hidden=\"true\"></i>', '1', 22, NULL, NULL, NULL),
(49, 22, 'Quality Control Test', 'QCTestController', '/project/qcTest', '', '<i class=\"fas fa-arrow-alt-circle-right\" aria-hidden=\"true\"></i>', '1', 23, NULL, NULL, NULL),
(50, 3, 'Project Type', 'ProjectTypeController', '/configurations/projecttype', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 18, NULL, NULL, NULL),
(51, 3, 'Structure', 'StructureController', '/configurations/structure', '', '<i class=\"fa fa-gears\" aria-hidden=\"true\"></i>', '1', 21, NULL, NULL, NULL),
(52, 22, 'Structure Estimation', 'ProjectStructureController', '/project/structure_estimation', '', '<i class=\"fas fa-arrow-alt-circle-right\" aria-hidden=\"true\"></i>', '1', 24, NULL, NULL, NULL),
(53, 22, 'Structure Progress', 'ProjectStructureProgressController', '/project/structure_progress', '', '<i class=\"fas fa-arrow-alt-circle-right\" aria-hidden=\"true\"></i>', '1', 25, NULL, NULL, NULL);

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2017_11_16_081741_create_pradeshs_table', 1),
(3, '2017_11_16_082004_create_districts_table', 1),
(4, '2017_11_17_021802_create_muni_types_table', 1),
(5, '2017_11_17_022931_create_municipalitys_table', 1),
(6, '2018_01_18_074710_create_countries_table', 1),
(7, '2018_03_19_071106_create_designations_table', 1),
(8, '2018_03_20_070816_create_menus_table', 1),
(9, '2018_03_20_070934_create_user_groups_table', 1),
(10, '2018_03_20_071031_create_fiscal_years_table', 1),
(11, '2018_03_20_071047_create_user_roles_table', 1),
(12, '2018_03_21_103641_create_departments_table', 1),
(13, '2018_03_25_054751_create_login_logs_table', 1),
(14, '2018_03_25_054819_create_login_fails_table', 1),
(15, '2018_03_25_085224_create_audit_log_table', 1),
(16, '2018_03_27_083725_create_office_types_table', 1),
(17, '2018_03_27_083727_create_offices_table', 1),
(18, '2020_07_01_080923_create_audits_table', 1),
(19, '2020_12_26_055326_create_project_regions_table', 1),
(20, '2020_12_26_154715_create_projects_table', 1),
(21, '2020_12_26_154716_create_users_table', 1),
(22, '2020_12_26_154717_create_feedback_table', 1),
(23, '2020_12_26_155057_create_user_projects_table', 1),
(24, '2020_12_28_053005_create_program_types_table', 1),
(25, '2020_12_28_055623_create_base_lines_table', 1),
(26, '2020_12_28_060257_create_beneficiaries_table', 1),
(27, '2020_12_28_061539_create_institutionals_table', 1),
(28, '2020_12_28_062918_create_programs_table', 1),
(29, '2020_12_28_065851_create_oba_types_table', 1),
(30, '2020_12_28_070220_create_obas_table', 1),
(31, '2020_12_28_081723_create_samitis_table', 1),
(32, '2020_12_28_082557_create_document_catgories_table', 1),
(33, '2020_12_28_082640_create_documents_table', 1),
(34, '2021_01_13_073341_create_monitorings_table', 1),
(35, '2021_01_13_075120_create_vos_table', 1),
(36, '2021_01_13_092951_add_column_to_monitorings', 1),
(37, '2021_01_20_080115_create_eots_table', 1),
(38, '2021_01_20_081305_add_date_column_to_vos', 1),
(39, '2021_01_25_071924_create_project_districts_table', 1),
(40, '2021_01_27_053901_create_pmos_table', 1),
(41, '2021_01_28_060626_add_column_to_base_lines', 1),
(42, '2021_01_28_111151_add_eot_date_to_projects', 1),
(43, '2021_01_31_082359_create_progress_data_table', 1),
(44, '2021_02_02_105036_create_payments_table', 1),
(45, '2021_02_04_055217_add_contract_date_to_projects', 1),
(46, '2021_02_04_091749_add_column_to_eots', 1),
(47, '2021_02_05_062505_create_oba_details_table', 1),
(48, '2021_02_07_062506_create_q_c_types_table', 1),
(49, '2021_02_07_063952_create_quality_controls_table', 1),
(50, '2021_02_07_064639_create_q_c_tests_table', 1),
(51, '2021_02_08_050953_create_worker_details_table', 1),
(52, '2021_02_10_091235_create_environments_table', 1),
(53, '2021_02_10_093605_create_environmental_monthlies_table', 1),
(54, '2021_02_10_094152_create_environmental_monthly_records_table', 1),
(55, '2021_02_10_095126_create_grievances_table', 1),
(56, '2021_02_10_095656_create_grievance_communities_table', 1),
(57, '2021_02_10_100512_create_safeguards_table', 1),
(58, '2021_02_10_101326_create_safeguard_indicators_table', 1),
(59, '2021_02_19_064347_create_program_logs_table', 1),
(60, '2021_02_21_052636_create_beneficiary_logs_table', 1),
(61, '2021_02_21_064036_create_institution_logs_table', 1),
(62, '2021_02_21_093051_create_oba_logs_table', 1),
(63, '2021_02_21_103906_create_qc_test_logs_table', 1),
(64, '2021_02_23_051746_create_project_source_details_table', 1),
(65, '2021_02_23_052520_create_project_reservoirs_table', 1),
(66, '2021_02_23_083433_create_project_types_table', 1),
(67, '2021_02_23_083434_create_project_details_table', 1),
(68, '2021_02_23_085322_create_units_table', 1),
(69, '2021_02_23_085501_create_structures_table', 1),
(70, '2021_02_23_085813_create_project_structures_table', 1),
(71, '2021_02_23_090455_create_structure_progress_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monitorings`
--

CREATE TABLE `monitorings` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leadBy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `participant` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_participant` int(11) NOT NULL,
  `observation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggestion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `improvement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monitorings`
--

INSERT INTO `monitorings` (`id`, `project_id`, `date`, `type`, `leadBy`, `participant`, `no_of_participant`, `observation`, `suggestion`, `improvement`, `file`, `created_at`, `updated_at`) VALUES
(1, 2, '2021-03-03', 'Type 1', 'Lead 1', 'Obcaecati cumque off', 2, 'Nisi perspiciatis c', 'Irure voluptates lab', 'Porro incidunt inve', NULL, '2021-03-03 04:24:57', '2021-03-03 04:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `id` int(10) UNSIGNED NOT NULL,
  `muni_type_id` int(10) UNSIGNED NOT NULL,
  `district_id` int(10) UNSIGNED NOT NULL,
  `muni_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muni_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muni_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `municipalities`
--

INSERT INTO `municipalities` (`id`, `muni_type_id`, `district_id`, `muni_code`, `muni_name`, `muni_name_en`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '1', 'फुङ्लिङ नगरपालिका', NULL, NULL, NULL, NULL),
(2, 4, 1, '2', 'आठराई त्रिवेणी गाउँपालिका', NULL, NULL, NULL, NULL),
(3, 4, 1, '3', 'सिदिङ्ग्वा गाउँपालिका', NULL, NULL, NULL, NULL),
(4, 4, 1, '4', 'फक्ताङलुङ गाउँपालिका', NULL, NULL, NULL, NULL),
(5, 4, 1, '5', 'मिक्वाखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(6, 4, 1, '6', 'मेरिङ्देन गाउँपालिका', NULL, NULL, NULL, NULL),
(7, 4, 1, '7', 'मैवाखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(8, 4, 1, '8', 'याङ्वरक गाउँपालिका', NULL, NULL, NULL, NULL),
(9, 4, 1, '9', 'सिरिजङ्गा गाउँपालिका', NULL, NULL, NULL, NULL),
(10, 3, 2, '10', 'फिदिम नगरपालिका', NULL, NULL, NULL, NULL),
(11, 4, 2, '11', 'फालेलुङ गाउँपालिका', NULL, NULL, NULL, NULL),
(12, 4, 2, '12', 'फाल्गुनन्द गाउँपालिका', NULL, NULL, NULL, NULL),
(13, 4, 2, '13', 'हिलिहाङ गाउँपालिका', NULL, NULL, NULL, NULL),
(14, 4, 2, '14', 'कुम्मायक गाउँपालिका', NULL, NULL, NULL, NULL),
(15, 4, 2, '15', 'मिक्लाजुङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(16, 4, 2, '16', 'तुम्वेहा गाउँपालिका', NULL, NULL, NULL, NULL),
(17, 4, 2, '17', 'याङ्वरक गाउँपालिका', NULL, NULL, NULL, NULL),
(18, 3, 3, '18', 'इलाम नगरपालिका', NULL, NULL, NULL, NULL),
(19, 3, 3, '19', 'देउमाई नगरपालिका', NULL, NULL, NULL, NULL),
(20, 3, 3, '20', 'माई नगरपालिका', NULL, NULL, NULL, NULL),
(21, 3, 3, '21', 'सूर्योदय नगरपालिका', NULL, NULL, NULL, NULL),
(22, 4, 3, '22', 'फाकफोकथुम गाउँपालिका ', NULL, NULL, NULL, NULL),
(23, 4, 3, '23', 'चुलाचुली गाउँपालिका', NULL, NULL, NULL, NULL),
(24, 4, 3, '24', 'माईजोगमाई गाउँपालिका', NULL, NULL, NULL, NULL),
(25, 4, 3, '25', 'माङ्सेबुङ गाउँपालिका', NULL, NULL, NULL, NULL),
(26, 4, 3, '26', 'रोङ गाउँपालिका', NULL, NULL, NULL, NULL),
(27, 4, 3, '27', 'सन्दकपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(28, 3, 4, '28', 'मेचीनगर नगरपालिका', NULL, NULL, NULL, NULL),
(29, 3, 4, '29', 'दमक नगरपालिका', NULL, NULL, NULL, NULL),
(30, 3, 4, '30', 'कन्काई नगरपालिका', NULL, NULL, NULL, NULL),
(31, 3, 4, '31', 'भद्रपुर नगरपालिका', NULL, NULL, NULL, NULL),
(32, 3, 4, '32', 'अर्जुनधारा नगरपालिका', NULL, NULL, NULL, NULL),
(33, 3, 4, '33', 'शिवसताक्षी नगरपालिका ', NULL, NULL, NULL, NULL),
(34, 3, 4, '34', 'गौरादह नगरपालिका', NULL, NULL, NULL, NULL),
(35, 3, 4, '35', 'विर्तामोड नगरपालिका', NULL, NULL, NULL, NULL),
(36, 4, 4, '36', 'कमल गाउँपालिका', NULL, NULL, NULL, NULL),
(37, 4, 4, '37', 'गौरीगञ्ज गाउँपालिका', NULL, NULL, NULL, NULL),
(38, 4, 4, '38', 'बाह्रदशी गाउँपालिका', NULL, NULL, NULL, NULL),
(39, 4, 4, '39', 'झापा गाउँपालिका', NULL, NULL, NULL, NULL),
(40, 4, 4, '40', 'बुद्धशान्ती गाउँपालिका', NULL, NULL, NULL, NULL),
(41, 4, 4, '41', 'हल्दीवारी गाउँपालिका', NULL, NULL, NULL, NULL),
(42, 4, 4, '42', 'कचनकवल गाउँपालिका', NULL, NULL, NULL, NULL),
(43, 2, 5, '43', 'विराटनगर महानगरपालिका', NULL, NULL, NULL, NULL),
(44, 3, 5, '44', 'बेलबारी नगरपालिका', NULL, NULL, NULL, NULL),
(45, 3, 5, '45', 'लेटाङ्ग नगरपालिका', NULL, NULL, NULL, NULL),
(46, 3, 5, '46', 'पथरी शनिश्चरे नगरपालिका', NULL, NULL, NULL, NULL),
(47, 3, 5, '47', 'रङ्गेली नगरपालिका', NULL, NULL, NULL, NULL),
(48, 3, 5, '48', 'रतुवामाई नगरपालिका', NULL, NULL, NULL, NULL),
(49, 3, 5, '49', 'सुनवर्षी नगरपालिका', NULL, NULL, NULL, NULL),
(50, 3, 5, '50', 'उर्लाबारी नगरपालिका', NULL, NULL, NULL, NULL),
(51, 3, 5, '51', 'सुन्दरहरैंचा नगरपालिका', NULL, NULL, NULL, NULL),
(52, 4, 5, '52', 'बुढीगङ्गा गाउँपालिका', NULL, NULL, NULL, NULL),
(53, 4, 5, '53', 'धनपालथान गाउँपालिका', NULL, NULL, NULL, NULL),
(54, 4, 5, '54', 'ग्रामथान गाउँपालिका', NULL, NULL, NULL, NULL),
(55, 4, 5, '55', 'जहदा गाउँपालिका', NULL, NULL, NULL, NULL),
(56, 4, 5, '56', 'कानेपोखरी गाउँपालिका', NULL, NULL, NULL, NULL),
(57, 4, 5, '57', 'कटहरी गाउँपालिका', NULL, NULL, NULL, NULL),
(58, 4, 5, '58', 'केराबारी गाउँपालिका', NULL, NULL, NULL, NULL),
(59, 4, 5, '59', 'मिक्लाजुङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(60, 2, 6, '60', 'ईटहरी उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(61, 2, 6, '61', 'धरान उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(62, 3, 6, '62', 'ईनरुवा नगरपालिका', NULL, NULL, NULL, NULL),
(63, 3, 6, '63', 'दुहवी नगरपालिका', NULL, NULL, NULL, NULL),
(64, 3, 6, '64', 'रामधुनी नगरपालिका', NULL, NULL, NULL, NULL),
(65, 3, 6, '65', 'बराह नगरपालिका', NULL, NULL, NULL, NULL),
(66, 4, 6, '66', 'देवानगञ्ज गाउँपालिका', NULL, NULL, NULL, NULL),
(67, 4, 6, '67', 'कोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(68, 4, 6, '68', 'गढी गाउँपालिका', NULL, NULL, NULL, NULL),
(69, 4, 6, '69', 'बर्जु गाउँपालिका', NULL, NULL, NULL, NULL),
(70, 4, 6, '70', 'भोक्राहा गाउँपालिका', NULL, NULL, NULL, NULL),
(71, 4, 6, '71', 'हरिनगरा गाउँपालिका', NULL, NULL, NULL, NULL),
(72, 3, 7, '72', 'पाख्रीबास नगरपालिका', NULL, NULL, NULL, NULL),
(73, 3, 7, '73', 'धनकुटा नगरपालिका', NULL, NULL, NULL, NULL),
(74, 3, 7, '74', 'महालक्ष्मी नगरपालिका', NULL, NULL, NULL, NULL),
(75, 4, 7, '75', 'साँगुरीगढी गाउँपालिका', NULL, NULL, NULL, NULL),
(76, 4, 7, '76', 'खाल्सा छिन्ताङ्ग शहीदभूमि गाउँपालिका', NULL, NULL, NULL, NULL),
(77, 4, 7, '77', 'छथर जोरपाटी गाउँपालिका', NULL, NULL, NULL, NULL),
(78, 4, 7, '78', 'चौविसे गाउँपालिका', NULL, NULL, NULL, NULL),
(79, 3, 8, '79', 'म्याङ्लुङ्ग नगरपालिका', NULL, NULL, NULL, NULL),
(80, 3, 8, '80', 'लालीगुराँस नगरपालिका', NULL, NULL, NULL, NULL),
(81, 4, 8, '81', 'आठराई गाउँपालिका', NULL, NULL, NULL, NULL),
(82, 4, 8, '82', 'छथर गाउँपालिका', NULL, NULL, NULL, NULL),
(83, 4, 8, '83', 'फेदाप गाउँपालिका', NULL, NULL, NULL, NULL),
(84, 4, 8, '84', 'मेन्छयायेम गाउँपालिका', NULL, NULL, NULL, NULL),
(85, 3, 9, '85', 'चैनपुर नगरपालिका', NULL, NULL, NULL, NULL),
(86, 3, 9, '86', 'धर्मदेवी नगरपालिका', NULL, NULL, NULL, NULL),
(87, 3, 9, '87', 'खाँदबारी नगरपालिका', NULL, NULL, NULL, NULL),
(88, 3, 9, '88', 'मादी नगरपालिका', NULL, NULL, NULL, NULL),
(89, 3, 9, '89', 'पाँचखपन नगरपालिका', NULL, NULL, NULL, NULL),
(90, 4, 9, '90', 'भोटखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(91, 4, 9, '91', 'चिचिला गाउँपालिका', NULL, NULL, NULL, NULL),
(92, 4, 9, '92', 'मकालु गाउँपालिका', NULL, NULL, NULL, NULL),
(93, 4, 9, '93', 'सभापोखरी गाउँपालिका', NULL, NULL, NULL, NULL),
(94, 4, 9, '94', 'सिलिचोङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(95, 3, 10, '95', 'भोजपुर नगरपालिका', NULL, NULL, NULL, NULL),
(96, 3, 10, '96', 'षडानन्द नगरपालिका', NULL, NULL, NULL, NULL),
(97, 4, 10, '97', 'ट्याम्के मैयुम गाउँपालिका', NULL, NULL, NULL, NULL),
(98, 4, 10, '98', 'रामप्रसादराई गाउँपालिका', NULL, NULL, NULL, NULL),
(99, 4, 10, '99', 'अरुण गाउँपालिका', NULL, NULL, NULL, NULL),
(100, 4, 10, '100', 'पौवादुम्मा गाउँपालिका', NULL, NULL, NULL, NULL),
(101, 4, 10, '101', 'साल्पा सिलिसो गाउँपालिका', NULL, NULL, NULL, NULL),
(102, 4, 10, '102', 'आम्चोक गाउँपालिका', NULL, NULL, NULL, NULL),
(103, 4, 10, '103', 'हतुवागढी गाउँपालिका', NULL, NULL, NULL, NULL),
(104, 3, 11, '104', 'सोलु दुधकुण्ड नगरपालिका', NULL, NULL, NULL, NULL),
(105, 4, 11, '105', 'दुधकोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(106, 4, 11, '106', 'खुम्बु पासाङ्गल्हामु गाउँपालिका', NULL, NULL, NULL, NULL),
(107, 4, 11, '107', 'दुधकौशीका गाउँपालिका', NULL, NULL, NULL, NULL),
(108, 4, 11, '108', 'नेचा सल्यान गाउँपालिका', NULL, NULL, NULL, NULL),
(109, 4, 11, '109', 'महाकुलुङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(110, 4, 11, '110', 'लिखुपिके गाउँपालिका', NULL, NULL, NULL, NULL),
(111, 4, 11, '111', 'सोपाङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(112, 3, 12, '112', 'सिद्धिचरण नगरपालिका', NULL, NULL, NULL, NULL),
(113, 4, 12, '113', 'खिजिदेम्बा गाउँपालिका', NULL, NULL, NULL, NULL),
(114, 4, 12, '114', 'चम्पादेवी गाउँपालिका', NULL, NULL, NULL, NULL),
(115, 4, 12, '115', 'चिशंखुगढी गाउँपालिका', NULL, NULL, NULL, NULL),
(116, 4, 12, '116', 'मानेभञ्ज्याङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(117, 4, 12, '117', 'मोलुङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(118, 4, 12, '118', 'लिखु गाउँपालिका', NULL, NULL, NULL, NULL),
(119, 4, 12, '119', 'सुनकोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(120, 3, 13, '120', 'हलेसी तुवाचुङ्ग नगरपालिका', NULL, NULL, NULL, NULL),
(121, 3, 13, '121', 'रुपाकोट मझुवागढी नगरपालिका', NULL, NULL, NULL, NULL),
(122, 4, 13, '122', 'ऐसेलुखर्क गाउँपालिका', NULL, NULL, NULL, NULL),
(123, 4, 13, '123', 'लामीडाँडा गाउँपालिका', NULL, NULL, NULL, NULL),
(124, 4, 13, '124', 'जन्तेढुङ्गा गाउँपालिका', NULL, NULL, NULL, NULL),
(125, 4, 13, '125', 'खोटेहाङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(126, 4, 13, '126', 'केपिलासगढी गाउँपालिका', NULL, NULL, NULL, NULL),
(127, 4, 13, '127', 'दिप्रुङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(128, 4, 13, '128', 'साकेला गाउँपालिका', NULL, NULL, NULL, NULL),
(129, 4, 13, '129', 'बराहपोखरी गाउँपालिका', NULL, NULL, NULL, NULL),
(130, 3, 14, '130', 'कटारी नगरपालिका', NULL, NULL, NULL, NULL),
(131, 3, 14, '131', 'चौदण्डीगढी नगरपालिका', NULL, NULL, NULL, NULL),
(132, 3, 14, '132', 'त्रियुगा नगरपालिका', NULL, NULL, NULL, NULL),
(133, 3, 14, '133', 'बेलका नगरपालिका', NULL, NULL, NULL, NULL),
(134, 4, 14, '134', 'उदयपुरगढी गाउँपालिका', NULL, NULL, NULL, NULL),
(135, 4, 14, '135', 'ताप्ली गाउँपालिका', NULL, NULL, NULL, NULL),
(136, 4, 14, '136', 'रौताहामाई गाउँपालिका', NULL, NULL, NULL, NULL),
(137, 4, 14, '137', 'सुनकोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(138, 3, 15, '138', 'राजविराज नगरपालिका', NULL, NULL, NULL, NULL),
(139, 3, 15, '139', 'कञ्चनरुप नगरपालिका', NULL, NULL, NULL, NULL),
(140, 3, 15, '140', 'डाक्नेश्वरी नगरपालिका', NULL, NULL, NULL, NULL),
(141, 3, 15, '141', 'बोदेबरसाईन नगरपालिका', NULL, NULL, NULL, NULL),
(142, 3, 15, '142', 'खडक नगरपालिका', NULL, NULL, NULL, NULL),
(143, 3, 15, '143', 'शम्भुनाथ नगरपालिका', NULL, NULL, NULL, NULL),
(144, 3, 15, '144', 'सुरुङ्गा नगरपालिका', NULL, NULL, NULL, NULL),
(145, 3, 15, '145', 'हनुमाननगर कङ्कालिनी नगरपालिका', NULL, NULL, NULL, NULL),
(146, 3, 15, '146', 'सप्तकोशी नगरपालिका', NULL, NULL, NULL, NULL),
(147, 4, 15, '147', 'अग्नीसाइर कृष्णासवरन गाउँपालिका', NULL, NULL, NULL, NULL),
(148, 4, 15, '148', 'छिन्नमस्ता गाउँपालिका', NULL, NULL, NULL, NULL),
(149, 4, 15, '149', 'महादेवा गाउँपालिका', NULL, NULL, NULL, NULL),
(150, 4, 15, '150', 'तिरहुत गाउँपालिका', NULL, NULL, NULL, NULL),
(151, 4, 15, '151', 'तिलाठी कोइलाडी गाउँपालिका', NULL, NULL, NULL, NULL),
(152, 4, 15, '152', 'रुपनी गाउँपालिका', NULL, NULL, NULL, NULL),
(153, 4, 15, '153', 'बेल्ही चपेना गाउँपालिका', NULL, NULL, NULL, NULL),
(154, 4, 15, '154', 'विष्णुपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(155, 4, 15, '155', 'बलान-विहुल गाउँपालिका', NULL, NULL, NULL, NULL),
(156, 3, 16, '156', 'लहान नगरपालिका', NULL, NULL, NULL, NULL),
(157, 3, 16, '157', 'धनगढीमाई नगरपालिका', NULL, NULL, NULL, NULL),
(158, 3, 16, '158', 'सिरहा नगरपालिका', NULL, NULL, NULL, NULL),
(159, 3, 16, '159', 'गोलबजार नगरपालिका', NULL, NULL, NULL, NULL),
(160, 3, 16, '160', 'मिर्चैया नगरपालिका', NULL, NULL, NULL, NULL),
(161, 3, 16, '161', 'कल्याणपुर नगरपालिका', NULL, NULL, NULL, NULL),
(162, 3, 16, '162', 'कर्जन्हा नगरपालिका', NULL, NULL, NULL, NULL),
(163, 3, 16, '163', 'सुखीपुर नगरपालिका', NULL, NULL, NULL, NULL),
(164, 4, 16, '164', 'भगवानपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(165, 4, 16, '165', 'औरही गाउँपालिका', NULL, NULL, NULL, NULL),
(166, 4, 16, '166', 'विष्णुपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(167, 4, 16, '167', 'बरियारपट्टी गाउँपालिका', NULL, NULL, NULL, NULL),
(168, 4, 16, '168', 'लक्ष्मीपुर पतारी गाउँपालिका', NULL, NULL, NULL, NULL),
(169, 4, 16, '169', 'नरहा गाउँपालिका', NULL, NULL, NULL, NULL),
(170, 4, 16, '170', 'सखुवानान्करकट्टी गाउँपालिका', NULL, NULL, NULL, NULL),
(171, 4, 16, '171', 'अर्नमा गाउँपालिका', NULL, NULL, NULL, NULL),
(172, 4, 16, '172', 'नवराजपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(173, 2, 17, '173', 'जनकपुर उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(174, 3, 17, '174', 'क्षिरेश्वरनाथ नगरपालिका', NULL, NULL, NULL, NULL),
(175, 3, 17, '175', 'गणेशमान चारनाथ नगरपालिका', NULL, NULL, NULL, NULL),
(176, 3, 17, '176', 'धनुषाधाम नगरपालिका', NULL, NULL, NULL, NULL),
(177, 3, 17, '177', 'कमला नगरपालिका', NULL, NULL, NULL, NULL),
(178, 3, 17, '178', 'नगराइन नगरपालिका', NULL, NULL, NULL, NULL),
(179, 3, 17, '179', 'विदेह नगरपालिका', NULL, NULL, NULL, NULL),
(180, 3, 17, '180', 'मिथिला नगरपालिका', NULL, NULL, NULL, NULL),
(181, 3, 17, '181', 'मिथिला विहारी नगरपालिका', NULL, NULL, NULL, NULL),
(182, 3, 17, '182', 'शहीदनगर नगरपालिका ', NULL, NULL, NULL, NULL),
(183, 3, 17, '183', 'सबैला नगरपालिका', NULL, NULL, NULL, NULL),
(184, 3, 17, '184', 'हंसपुर नगरपालिका', NULL, NULL, NULL, NULL),
(185, 4, 17, '185', 'औरही गाउँपालिका', NULL, NULL, NULL, NULL),
(186, 4, 17, '186', 'जनकनन्दिनी गाउँपालिका', NULL, NULL, NULL, NULL),
(187, 4, 17, '187', 'बटेश्वर गाउँपालिका', NULL, NULL, NULL, NULL),
(188, 4, 17, '188', 'मुखियापट्टी मुसहरनिया गाउँपालिका', NULL, NULL, NULL, NULL),
(189, 4, 17, '189', 'लक्ष्मीनिया गाउँपालिका', NULL, NULL, NULL, NULL),
(190, 4, 17, '190', 'धनौजी गाउँपालिका', NULL, NULL, NULL, NULL),
(191, 3, 18, '191', 'जलेश्वर नगरपालिका', NULL, NULL, NULL, NULL),
(192, 3, 18, '192', 'बर्दिबास नगरपालिका', NULL, NULL, NULL, NULL),
(193, 3, 18, '193', 'गौशाला नगरपालिका', NULL, NULL, NULL, NULL),
(194, 3, 18, '194', 'बलवा नगरपालिका', NULL, NULL, NULL, NULL),
(195, 3, 18, '195', 'लोहरपट्टी नगरपालिका', NULL, NULL, NULL, NULL),
(196, 3, 18, '196', 'मनरा सिसवा नगरपालिका', NULL, NULL, NULL, NULL),
(197, 3, 18, '197', 'रामगोपालपुर नगरपालिका', NULL, NULL, NULL, NULL),
(198, 3, 18, '198', 'औरही नगरपालिका', NULL, NULL, NULL, NULL),
(199, 3, 18, '199', 'भँगाहा नगरपालिका', NULL, NULL, NULL, NULL),
(200, 3, 18, '200', 'मटिहानी नगरपालिका', NULL, NULL, NULL, NULL),
(201, 4, 18, '201', 'सोनमा गाउँपालिका', NULL, NULL, NULL, NULL),
(202, 4, 18, '202', 'सम्सी गाउँपालिका', NULL, NULL, NULL, NULL),
(203, 4, 18, '203', 'महोत्तरी गाउँपालिका', NULL, NULL, NULL, NULL),
(204, 4, 18, '204', 'पिपरा गाउँपालिका', NULL, NULL, NULL, NULL),
(205, 4, 18, '205', 'एकडारा गाउँपालिका', NULL, NULL, NULL, NULL),
(206, 3, 19, '206', 'ईश्वरपुर नगरपालिका', NULL, NULL, NULL, NULL),
(207, 3, 19, '207', 'मलङ्गवा नगरपालिका', NULL, NULL, NULL, NULL),
(208, 3, 19, '208', 'लालबन्दी नगरपालिका', NULL, NULL, NULL, NULL),
(209, 3, 19, '209', 'हरिपुर नगरपालिका', NULL, NULL, NULL, NULL),
(210, 3, 19, '210', 'हरिपुर्वा नगरपालिका', NULL, NULL, NULL, NULL),
(211, 3, 19, '211', 'हरिवन नगरपालिका', NULL, NULL, NULL, NULL),
(212, 3, 19, '212', 'बरहथवा नगरपालिका', NULL, NULL, NULL, NULL),
(213, 3, 19, '213', 'बलरा नगरपालिका', NULL, NULL, NULL, NULL),
(214, 3, 19, '214', 'गोडैटा नगरपालिका', NULL, NULL, NULL, NULL),
(215, 3, 19, '215', 'बागमती नगरपालिका', NULL, NULL, NULL, NULL),
(216, 3, 19, '216', 'कबिलासी नगरपालिका', NULL, NULL, NULL, NULL),
(217, 4, 19, '217', 'चक्रघट्टा गाउँपालिका', NULL, NULL, NULL, NULL),
(218, 4, 19, '218', 'चन्द्रनगर गाउँपालिका', NULL, NULL, NULL, NULL),
(219, 4, 19, '219', 'धनकौल गाउँपालिका', NULL, NULL, NULL, NULL),
(220, 4, 19, '220', 'ब्रह्मपुरी गाउँपालिका', NULL, NULL, NULL, NULL),
(221, 4, 19, '221', 'रामनगर गाउँपालिका', NULL, NULL, NULL, NULL),
(222, 4, 19, '222', 'विष्णु गाउँपालिका', NULL, NULL, NULL, NULL),
(223, 4, 19, '223', 'बसबरीया गाउँपालिका', NULL, NULL, NULL, NULL),
(224, 4, 19, '224', 'कौडेना गाउँपालिका', NULL, NULL, NULL, NULL),
(225, 4, 19, '225', 'पर्सा गाउँपालिका', NULL, NULL, NULL, NULL),
(226, 3, 32, '226', 'चन्द्रपुर नगरपालिका', NULL, NULL, NULL, NULL),
(227, 3, 32, '227', 'गरुडा नगरपालिका', NULL, NULL, NULL, NULL),
(228, 3, 32, '228', 'गौर नगरपालिका', NULL, NULL, NULL, NULL),
(229, 3, 32, '229', 'बौधीमाई नगरपालिका', NULL, NULL, NULL, NULL),
(230, 3, 32, '230', 'वृन्दावन नगरपालिका', NULL, NULL, NULL, NULL),
(231, 3, 32, '231', 'देवाही गोनाही नगरपालिका', NULL, NULL, NULL, NULL),
(232, 3, 32, '232', 'गढीमाई नगरपालिका', NULL, NULL, NULL, NULL),
(233, 3, 32, '233', 'गजुरा नगरपालिका', NULL, NULL, NULL, NULL),
(234, 3, 32, '234', 'कटहरीया नगरपालिका', NULL, NULL, NULL, NULL),
(235, 3, 32, '235', 'माधवनारायण नगरपालिका', NULL, NULL, NULL, NULL),
(236, 3, 32, '236', 'मौलापुर नगरपालिका', NULL, NULL, NULL, NULL),
(237, 3, 32, '237', 'फतुवा विजयपुर नगरपालिका', NULL, NULL, NULL, NULL),
(238, 3, 32, '238', 'ईशनाथ नगरपालिका', NULL, NULL, NULL, NULL),
(239, 3, 32, '239', 'परोहा नगरपालिका', NULL, NULL, NULL, NULL),
(240, 3, 32, '240', 'राजपुर नगरपालिका', NULL, NULL, NULL, NULL),
(241, 3, 32, '241', 'राजदेवी नगरपालिका', NULL, NULL, NULL, NULL),
(242, 4, 32, '242', 'यमुनामाई गाउँपालिका', NULL, NULL, NULL, NULL),
(243, 4, 32, '243', 'दुर्गाभगवती गाउँपालिका', NULL, NULL, NULL, NULL),
(244, 2, 33, '244', 'कलैया उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(245, 2, 33, '245', 'जितपुर-सिमरा उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(246, 3, 33, '246', 'कोल्हवी नगरपालिका', NULL, NULL, NULL, NULL),
(247, 3, 33, '247', 'निजगढ नगरपालिका', NULL, NULL, NULL, NULL),
(248, 3, 33, '248', 'महागढीमाई नगरपालिका', NULL, NULL, NULL, NULL),
(249, 3, 33, '249', 'सिम्रौनगढ नगरपालिका', NULL, NULL, NULL, NULL),
(250, 3, 33, '250', 'पचरौता नगरपालिका', NULL, NULL, NULL, NULL),
(251, 4, 33, '251', 'परवानीपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(252, 4, 33, '252', 'प्रसौनी गाउँपालिका', NULL, NULL, NULL, NULL),
(253, 4, 33, '253', 'फेटा गाउँपालिका', NULL, NULL, NULL, NULL),
(254, 4, 33, '254', 'आदर्श कोटवाल गाउँपालिका', NULL, NULL, NULL, NULL),
(255, 4, 33, '255', 'करैयामाई गाउँपालिका', NULL, NULL, NULL, NULL),
(256, 4, 33, '256', 'देवताल गाउँपालिका', NULL, NULL, NULL, NULL),
(257, 4, 33, '257', 'बारागढी गाउँपालिका', NULL, NULL, NULL, NULL),
(258, 4, 33, '258', 'सुवर्ण गाउँपालिका', NULL, NULL, NULL, NULL),
(259, 4, 33, '259', 'विश्रामपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(260, 2, 34, '260', 'वीरगञ्ज महानगरपालिका', NULL, NULL, NULL, NULL),
(261, 3, 34, '261', 'पोखरीया नगरपालिका', NULL, NULL, NULL, NULL),
(262, 3, 34, '262', 'बहुदरमाई नगरपालिका', NULL, NULL, NULL, NULL),
(263, 3, 34, '263', 'पर्सागढी नगरपालिका', NULL, NULL, NULL, NULL),
(264, 4, 34, '264', 'ठोरी गाउँपालिका', NULL, NULL, NULL, NULL),
(265, 4, 34, '265', 'जगरनाथपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(266, 4, 34, '266', 'धोबीनी गाउँपालिका', NULL, NULL, NULL, NULL),
(267, 4, 34, '267', 'छिपहरमाई गाउँपालिका', NULL, NULL, NULL, NULL),
(268, 4, 34, '268', 'पकाहा मैनपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(269, 4, 34, '269', 'विन्दबासिनी गाउँपालिका', NULL, NULL, NULL, NULL),
(270, 4, 34, '270', 'सखुवा प्रसौनी गाउँपालिका', NULL, NULL, NULL, NULL),
(271, 4, 34, '271', 'पटेर्वा सुगौली गाउँपालिका', NULL, NULL, NULL, NULL),
(272, 4, 34, '272', 'कालिकामाई गाउँपालिका', NULL, NULL, NULL, NULL),
(273, 4, 34, '273', 'जिराभवानी गाउँपालिका', NULL, NULL, NULL, NULL),
(274, 3, 20, '274', 'कमलामाई नगरपालिका', NULL, NULL, NULL, NULL),
(275, 3, 20, '275', 'दुधौली नगरपालिका', NULL, NULL, NULL, NULL),
(276, 4, 20, '276', 'गोलञ्जोर गाउँपालिका', NULL, NULL, NULL, NULL),
(277, 4, 20, '277', 'घ्याङ्लेख गाउँपालिका', NULL, NULL, NULL, NULL),
(278, 4, 20, '278', 'तीनपाटन गाउँपालिका', NULL, NULL, NULL, NULL),
(279, 4, 20, '279', 'फिक्कल गाउँपालिका', NULL, NULL, NULL, NULL),
(280, 4, 20, '280', 'मरिण गाउँपालिका', NULL, NULL, NULL, NULL),
(281, 4, 20, '281', 'सुनकोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(282, 4, 20, '282', 'हरिहरपुरगढी गाउँपालिका', NULL, NULL, NULL, NULL),
(283, 3, 21, '283', 'मन्थली नगरपालिका', NULL, NULL, NULL, NULL),
(284, 3, 21, '284', 'रामेछाप नगरपालिका', NULL, NULL, NULL, NULL),
(285, 4, 21, '285', 'उमाकुण्ड गाउँपालिका', NULL, NULL, NULL, NULL),
(286, 4, 21, '286', 'खाँडादेवी गाउँपालिका', NULL, NULL, NULL, NULL),
(287, 4, 21, '287', 'गोकुलगङ्गा गाउँपालिका', NULL, NULL, NULL, NULL),
(288, 4, 21, '288', 'दोरम्भा गाउँपालिका', NULL, NULL, NULL, NULL),
(289, 4, 21, '289', 'लिखु गाउँपालिका', NULL, NULL, NULL, NULL),
(290, 4, 21, '290', 'सुनापती गाउँपालिका', NULL, NULL, NULL, NULL),
(291, 3, 22, '291', 'जिरी नगरपालिका', NULL, NULL, NULL, NULL),
(292, 3, 22, '292', 'भिमेश्वर नगरपालिका', NULL, NULL, NULL, NULL),
(293, 4, 22, '293', 'कालिञ्चोक गाउँपालिका', NULL, NULL, NULL, NULL),
(294, 4, 22, '294', 'गौरीशङ्कर गाउँपालिका', NULL, NULL, NULL, NULL),
(295, 4, 22, '295', 'तामाकोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(296, 4, 22, '296', 'मेलुङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(297, 4, 22, '297', 'विगु गाउँपालिका', NULL, NULL, NULL, NULL),
(298, 4, 22, '298', 'बैतेश्वर गाउँपालिका', NULL, NULL, NULL, NULL),
(299, 4, 22, '299', 'शैलुङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(300, 3, 23, '300', 'चौतारा साँगाचोकगढी नगरपालिका', NULL, NULL, NULL, NULL),
(301, 3, 23, '301', 'बाह्रविसे नगरपालिका', NULL, NULL, NULL, NULL),
(302, 3, 23, '302', 'मेलम्ची नगरपालिका', NULL, NULL, NULL, NULL),
(303, 4, 23, '303', 'ईन्द्रावती गाउँपालिका', NULL, NULL, NULL, NULL),
(304, 4, 23, '304', 'जुगल गाउँपालिका', NULL, NULL, NULL, NULL),
(305, 4, 23, '305', 'पाँचपोखरी थाङ्पाल गाउँपालिका', NULL, NULL, NULL, NULL),
(306, 4, 23, '306', 'बलेफी गाउँपालिका', NULL, NULL, NULL, NULL),
(307, 4, 23, '307', 'भोटेकोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(308, 4, 23, '308', 'लिसङ्खुपाखर गाउँपालिका', NULL, NULL, NULL, NULL),
(309, 4, 23, '309', 'सुनकोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(310, 4, 23, '310', 'हेलम्बु गाउँपालिका', NULL, NULL, NULL, NULL),
(311, 4, 23, '311', 'त्रिपुरासुन्दरी गाउँपालिका', NULL, NULL, NULL, NULL),
(312, 3, 24, '312', 'धुलिखेल नगरपालिका', NULL, NULL, NULL, NULL),
(313, 3, 24, '313', 'बनेपा नगरपालिका', NULL, NULL, NULL, NULL),
(314, 3, 24, '314', 'पनौती नगरपालिका', NULL, NULL, NULL, NULL),
(315, 3, 24, '315', 'पाँचखाल नगरपालिका', NULL, NULL, NULL, NULL),
(316, 3, 24, '316', 'नमोबुद्ध नगरपालिका', NULL, NULL, NULL, NULL),
(317, 4, 24, '317', 'खानीखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(318, 4, 24, '318', 'चौंरीदेउराली गाउँपालिका', NULL, NULL, NULL, NULL),
(319, 4, 24, '319', 'तेमाल गाउँपालिका', NULL, NULL, NULL, NULL),
(320, 4, 24, '320', 'बेथानचोक गाउँपालिका', NULL, NULL, NULL, NULL),
(321, 4, 24, '321', 'भुम्लु गाउँपालिका', NULL, NULL, NULL, NULL),
(322, 3, 24, '322', 'मण्डनदेउपुर नगरपालिका', NULL, NULL, NULL, NULL),
(323, 4, 24, '323', 'महाभारत गाउँपालिका', NULL, NULL, NULL, NULL),
(324, 4, 24, '324', 'रोशी गाउँपालिका', NULL, NULL, NULL, NULL),
(325, 2, 25, '325', 'ललितपुर महानगरपालिका', NULL, NULL, NULL, NULL),
(326, 3, 25, '326', 'गोदावरी नगरपालिका', NULL, NULL, NULL, NULL),
(327, 3, 25, '327', 'महालक्ष्मी नगरपालिका', NULL, NULL, NULL, NULL),
(328, 4, 25, '328', 'कोञ्ज्योसोम गाउँपालिका', NULL, NULL, NULL, NULL),
(329, 4, 25, '329', 'बागमती गाउँपालिका', NULL, NULL, NULL, NULL),
(330, 4, 25, '330', 'महाङ्काल गाउँपालिका', NULL, NULL, NULL, NULL),
(331, 3, 26, '331', 'चाँगुनारायण नगरपालिका', NULL, NULL, NULL, NULL),
(332, 3, 26, '332', 'भक्तपुर नगरपालिका', NULL, NULL, NULL, NULL),
(333, 3, 26, '333', 'मध्यपुर थिमी नगरपालिका', NULL, NULL, NULL, NULL),
(334, 3, 26, '334', 'सूर्यविनायक नगरपालिका', NULL, NULL, NULL, NULL),
(335, 2, 27, '335', 'काठमाण्डौं महानगरपालिका', NULL, NULL, NULL, NULL),
(336, 3, 27, '336', 'कागेश्वरी मनोहरा नगरपालिका', NULL, NULL, NULL, NULL),
(337, 3, 27, '337', 'कीर्तिपुर नगरपालिका', NULL, NULL, NULL, NULL),
(338, 3, 27, '338', 'गोकर्णेश्वर नगरपालिका', NULL, NULL, NULL, NULL),
(339, 3, 27, '339', 'चन्द्रागिरी नगरपालिका', NULL, NULL, NULL, NULL),
(340, 3, 27, '340', 'टोखा नगरपालिका', NULL, NULL, NULL, NULL),
(341, 3, 27, '341', 'तारकेश्वर नगरपालिका', NULL, NULL, NULL, NULL),
(342, 3, 27, '342', 'दक्षिणकाली नगरपालिका', NULL, NULL, NULL, NULL),
(343, 3, 27, '343', 'नागार्जुन नगरपालिका', NULL, NULL, NULL, NULL),
(344, 3, 27, '344', 'बुढानिलकण्ठ नगरपालिका', NULL, NULL, NULL, NULL),
(345, 3, 27, '345', 'शङ्करापुर नगरपालिका', NULL, NULL, NULL, NULL),
(346, 4, 29, '346', 'उत्तरगया गाउँपालिका', NULL, NULL, NULL, NULL),
(347, 4, 29, '347', 'कालिका गाउँपालिका', NULL, NULL, NULL, NULL),
(348, 4, 29, '348', 'गोसाईंकुण्ड गाउँपालिका', NULL, NULL, NULL, NULL),
(349, 4, 29, '349', 'नौकुण्ड गाउँपालिका', NULL, NULL, NULL, NULL),
(350, 4, 29, '350', 'पार्वतीकुण्ड गाउँपालिका', NULL, NULL, NULL, NULL),
(351, 3, 28, '351', 'विदुर नगरपालिका', NULL, NULL, NULL, NULL),
(352, 3, 28, '352', 'बेलकोटगढी नगरपालिका', NULL, NULL, NULL, NULL),
(353, 4, 28, '353', 'ककनी गाउँपालिका', NULL, NULL, NULL, NULL),
(354, 4, 28, '354', 'किस्पाङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(355, 4, 28, '355', 'तादी गाउँपालिका', NULL, NULL, NULL, NULL),
(356, 4, 28, '356', 'तारकेश्वर गाउँपालिका', NULL, NULL, NULL, NULL),
(357, 4, 28, '357', 'दुप्चेश्वर गाउँपालिका', NULL, NULL, NULL, NULL),
(358, 4, 28, '358', 'पञ्चकन्या गाउँपालिका', NULL, NULL, NULL, NULL),
(359, 4, 28, '359', 'लिखु गाउँपालिका', NULL, NULL, NULL, NULL),
(360, 4, 28, '360', 'मेघाङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(361, 4, 28, '361', 'शिवपुरी गाउँपालिका', NULL, NULL, NULL, NULL),
(362, 4, 28, '362', 'सूर्यगढी गाउँपालिका', NULL, NULL, NULL, NULL),
(363, 3, 29, '363', 'धुनीवेंशी नगरपालिका', NULL, NULL, NULL, NULL),
(364, 3, 29, '364', 'निलकण्ठ नगरपालिका', NULL, NULL, NULL, NULL),
(365, 4, 30, '365', 'खनीयाबास गाउँपालिका', NULL, NULL, NULL, NULL),
(366, 4, 30, '366', 'गजुरी गाउँपालिका', NULL, NULL, NULL, NULL),
(367, 4, 30, '367', 'गल्छी गाउँपालिका', NULL, NULL, NULL, NULL),
(368, 4, 30, '368', 'गङ्गाजमुना गाउँपालिका', NULL, NULL, NULL, NULL),
(369, 4, 30, '369', 'ज्वालामूखि गाउँपालिका', NULL, NULL, NULL, NULL),
(370, 4, 30, '370', 'थाक्रे गाउँपालिका', NULL, NULL, NULL, NULL),
(371, 4, 30, '371', 'नेत्रावती गाउँपालिका', NULL, NULL, NULL, NULL),
(372, 4, 30, '372', 'बेनीघाट रोराङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(373, 4, 30, '373', 'रुबीभ्याली गाउँपालिका', NULL, NULL, NULL, NULL),
(374, 4, 30, '374', 'सिद्धलेक गाउँपालिका', NULL, NULL, NULL, NULL),
(375, 4, 30, '375', 'त्रिपुरासुन्दरी गाउँपालिका', NULL, NULL, NULL, NULL),
(376, 2, 31, '376', 'हेटौंडा उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(377, 3, 31, '377', 'थाहा नगरपालिका', NULL, NULL, NULL, NULL),
(378, 4, 31, '378', 'ईन्द्रसरोवर गाउँपालिका', NULL, NULL, NULL, NULL),
(379, 4, 31, '379', 'कैलाश गाउँपालिका', NULL, NULL, NULL, NULL),
(380, 4, 31, '380', 'बकैया गाउँपालिका', NULL, NULL, NULL, NULL),
(381, 4, 31, '381', 'बागमती गाउँपालिका', NULL, NULL, NULL, NULL),
(382, 4, 31, '382', 'भीमफेदी गाउँपालिका', NULL, NULL, NULL, NULL),
(383, 4, 31, '383', 'मकवानपुरगढी गाउँपालिका', NULL, NULL, NULL, NULL),
(384, 4, 31, '384', 'मनोहरी गाउँपालिका', NULL, NULL, NULL, NULL),
(385, 4, 31, '385', 'राक्सीराङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(386, 2, 35, '386', 'भरतपुर महानगरपालिका', NULL, NULL, NULL, NULL),
(387, 3, 35, '387', 'कालिका नगरपालिका', NULL, NULL, NULL, NULL),
(388, 3, 35, '388', 'खैरहनी नगरपालिका', NULL, NULL, NULL, NULL),
(389, 3, 35, '389', 'माडी नगरपालिका', NULL, NULL, NULL, NULL),
(390, 3, 35, '390', 'रत्ननगर नगरपालिका', NULL, NULL, NULL, NULL),
(391, 3, 35, '391', 'राप्ती नगरपालिका', NULL, NULL, NULL, NULL),
(392, 4, 35, '392', 'ईच्छाकामना गाउँपालिका', NULL, NULL, NULL, NULL),
(393, 3, 36, '393', 'गोरखा नगरपालिका', NULL, NULL, NULL, NULL),
(394, 3, 36, '394', 'पालुङ्गटार नगरपालिका', NULL, NULL, NULL, NULL),
(395, 4, 36, '395', 'सुलीकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(396, 4, 36, '396', 'सिरानचोक गाउँपालिका', NULL, NULL, NULL, NULL),
(397, 4, 36, '397', 'अजिरकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(398, 4, 36, '398', 'आरुघाट गाउँपालिका', NULL, NULL, NULL, NULL),
(399, 4, 36, '399', 'गण्डकी गाउँपालिका', NULL, NULL, NULL, NULL),
(400, 4, 36, '400', 'चुमनुब्री गाउँपालिका', NULL, NULL, NULL, NULL),
(401, 4, 36, '401', 'धार्चे गाउँपालिका', NULL, NULL, NULL, NULL),
(402, 4, 36, '402', 'भिमसेन गाउँपालिका', NULL, NULL, NULL, NULL),
(403, 4, 36, '403', 'शहीदलखन गाउँपालिका', NULL, NULL, NULL, NULL),
(404, 3, 37, '404', 'बेंशीसहर नगरपालिका', NULL, NULL, NULL, NULL),
(405, 3, 37, '405', 'मध्यनेपाल नगरपालिका', NULL, NULL, NULL, NULL),
(406, 3, 37, '406', 'राईनास नगरपालिका', NULL, NULL, NULL, NULL),
(407, 3, 37, '407', 'सुन्दरवजार नगरपालिका', NULL, NULL, NULL, NULL),
(408, 4, 37, '408', 'क्व्होलासोथार गाउँपालिका', NULL, NULL, NULL, NULL),
(409, 4, 37, '409', 'दुधपोखरी गाउँपालिका', NULL, NULL, NULL, NULL),
(410, 4, 37, '410', 'दोर्दी गाउँपालिका', NULL, NULL, NULL, NULL),
(411, 4, 37, '411', 'मर्स्याङ्गदी गाउँपालिका', NULL, NULL, NULL, NULL),
(412, 3, 38, '412', 'भानु नगरपालिका', NULL, NULL, NULL, NULL),
(413, 3, 38, '413', 'भीमाद नगरपालिका', NULL, NULL, NULL, NULL),
(414, 3, 38, '414', 'ब्यास नगरपालिका', NULL, NULL, NULL, NULL),
(415, 3, 38, '415', 'शुक्लागण्डकी नगरपालिका', NULL, NULL, NULL, NULL),
(416, 4, 38, '416', 'आँबुखैरेनी गाउँपालिका', NULL, NULL, NULL, NULL),
(417, 4, 38, '417', 'ऋषिङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(418, 4, 38, '418', 'घिरिङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(419, 4, 38, '419', 'देवघाट गाउँपालिका', NULL, NULL, NULL, NULL),
(420, 4, 38, '420', 'म्याग्दे गाउँपालिका', NULL, NULL, NULL, NULL),
(421, 4, 38, '421', 'बन्दिपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(422, 3, 39, '422', 'गल्याङ्ग नगरपालिका', NULL, NULL, NULL, NULL),
(423, 3, 39, '423', 'चापाकोट नगरपालिका', NULL, NULL, NULL, NULL),
(424, 3, 39, '424', 'पुतलीवजार नगरपालिका', NULL, NULL, NULL, NULL),
(425, 3, 39, '425', 'भीरकोट नगरपालिका', NULL, NULL, NULL, NULL),
(426, 3, 39, '426', 'वालिङ्ग नगरपालिका', NULL, NULL, NULL, NULL),
(427, 4, 39, '427', 'अर्जुनचौपारी गाउँपालिका', NULL, NULL, NULL, NULL),
(428, 4, 39, '428', 'आँधिखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(429, 4, 39, '429', 'कालीगण्डकी गाउँपालिका', NULL, NULL, NULL, NULL),
(430, 4, 39, '430', 'फेदीखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(431, 4, 39, '431', 'विरुवा गाउँपालिका', NULL, NULL, NULL, NULL),
(432, 4, 39, '432', 'हरिनाश गाउँपालिका', NULL, NULL, NULL, NULL),
(433, 2, 40, '433', 'पोखरा लेखनाथ महानगरपालिका', NULL, NULL, NULL, NULL),
(434, 4, 40, '434', 'अन्नपूर्ण गाउँपालिका', NULL, NULL, NULL, NULL),
(435, 4, 40, '435', 'माछापुच्छ्रे गाउँपालिका', NULL, NULL, NULL, NULL),
(436, 4, 40, '436', 'मादी गाउँपालिका', NULL, NULL, NULL, NULL),
(437, 4, 40, '437', 'रुपा गाउँपालिका', NULL, NULL, NULL, NULL),
(438, 4, 41, '438', 'चामे गाउँपालिका', NULL, NULL, NULL, NULL),
(439, 4, 41, '439', 'नारफु गाउँपालिका', NULL, NULL, NULL, NULL),
(440, 4, 41, '440', 'नासोङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(441, 4, 41, '441', 'नेस्याङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(442, 4, 42, '442', 'घरपझोङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(443, 4, 42, '443', 'खासाङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(444, 4, 42, '444', 'दालोमे गाउँपालिका', NULL, NULL, NULL, NULL),
(445, 4, 42, '445', 'लोमन्थाङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(446, 4, 42, '446', 'बाह्रगाउँ मुक्तिक्षेत्र गाउँपालिका', NULL, NULL, NULL, NULL),
(447, 3, 43, '447', 'बेनी नगरपालिका', NULL, NULL, NULL, NULL),
(448, 4, 43, '448', 'अन्नपूर्ण गाउँपालिका', NULL, NULL, NULL, NULL),
(449, 4, 43, '449', 'धौलागिरी गाउँपालिका', NULL, NULL, NULL, NULL),
(450, 4, 43, '450', 'मङ्गला गाउँपालिका', NULL, NULL, NULL, NULL),
(451, 4, 43, '451', 'मालिका गाउँपालिका', NULL, NULL, NULL, NULL),
(452, 4, 43, '452', 'रघुगङ्गा गाउँपालिका', NULL, NULL, NULL, NULL),
(453, 3, 44, '453', 'कुश्मा नगरपालिका', NULL, NULL, NULL, NULL),
(454, 4, 44, '454', 'फलेवास गाउँपालिका', NULL, NULL, NULL, NULL),
(455, 4, 44, '455', 'जलजला गाउँपालिका', NULL, NULL, NULL, NULL),
(456, 4, 44, '456', 'पैयुँ गाउँपालिका', NULL, NULL, NULL, NULL),
(457, 4, 44, '457', 'महाशिला गाउँपालिका', NULL, NULL, NULL, NULL),
(458, 4, 44, '458', 'मोदी गाउँपालिका', NULL, NULL, NULL, NULL),
(459, 4, 44, '459', 'बिहादी गाउँपालिका', NULL, NULL, NULL, NULL),
(460, 3, 45, '460', 'बागलुङ्ग नगरपालिका', NULL, NULL, NULL, NULL),
(461, 3, 45, '461', 'गलकोट नगरपालिका', NULL, NULL, NULL, NULL),
(462, 3, 45, '462', 'जैमिनी नगरपालिका', NULL, NULL, NULL, NULL),
(463, 3, 45, '463', 'ढोरपाटन नगरपालिका', NULL, NULL, NULL, NULL),
(464, 4, 45, '464', 'बरेङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(465, 4, 45, '465', 'कोठेखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(466, 4, 45, '466', 'तमानखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(467, 4, 45, '467', 'ताराखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(468, 4, 45, '468', 'निसीखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(469, 4, 45, '469', 'बढीगाड गाउँपालिका', NULL, NULL, NULL, NULL),
(470, 3, 48, '470', 'कावासोती नगरपालिका', NULL, NULL, NULL, NULL),
(471, 3, 48, '471', 'गैंडाकोट नगरपालिका', NULL, NULL, NULL, NULL),
(472, 3, 48, '472', 'देवचुली नगरपालिका', NULL, NULL, NULL, NULL),
(473, 3, 48, '473', 'मध्यविन्दु नगरपालिका', NULL, NULL, NULL, NULL),
(474, 4, 48, '474', 'बुङ्दीकाली गाउँपालिका', NULL, NULL, NULL, NULL),
(475, 4, 48, '475', 'बुलिङ्टार गाउँपालिका', NULL, NULL, NULL, NULL),
(476, 4, 48, '476', 'विनयीत्रिवेणी गाउँपालिका', NULL, NULL, NULL, NULL),
(477, 4, 48, '477', 'हुप्सेकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(478, 3, 46, '478', 'मुसिकोट नगरपालिका', NULL, NULL, NULL, NULL),
(479, 3, 46, '479', 'रेसुङ्गा नगरपालिका', NULL, NULL, NULL, NULL),
(480, 4, 46, '480', 'ईश्मा गाउँपालिका', NULL, NULL, NULL, NULL),
(481, 4, 46, '481', 'कालीगण्डकी गाउँपालिका', NULL, NULL, NULL, NULL),
(482, 4, 46, '482', 'गुल्मीदरवार गाउँपालिका', NULL, NULL, NULL, NULL),
(483, 4, 46, '483', 'सत्यवती गाउँपालिका', NULL, NULL, NULL, NULL),
(484, 4, 46, '484', 'चन्द्रपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(485, 4, 46, '485', 'रुरु गाउँपालिका', NULL, NULL, NULL, NULL),
(486, 4, 46, '486', 'छत्रकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(487, 4, 46, '487', 'धुर्कोट गाउँपालिका', NULL, NULL, NULL, NULL),
(488, 4, 46, '488', 'मदाने गाउँपालिका', NULL, NULL, NULL, NULL),
(489, 4, 46, '489', 'मालिका गाउँपालिका', NULL, NULL, NULL, NULL),
(490, 3, 47, '490', 'रामपुर नगरपालिका', NULL, NULL, NULL, NULL),
(491, 3, 47, '491', 'तान्सेन नगरपालिका', NULL, NULL, NULL, NULL),
(492, 4, 47, '492', 'निस्दी गाउँपालिका', NULL, NULL, NULL, NULL),
(493, 4, 47, '493', 'पूर्वखोला गाउँपालिका', NULL, NULL, NULL, NULL),
(494, 4, 47, '494', 'रम्भा गाउँपालिका', NULL, NULL, NULL, NULL),
(495, 4, 47, '495', 'मातागढी गाउँपालिका', NULL, NULL, NULL, NULL),
(496, 4, 47, '496', 'तिनाउ गाउँपालिका', NULL, NULL, NULL, NULL),
(497, 4, 47, '497', 'बगनासकाली गाउँपालिका', NULL, NULL, NULL, NULL),
(498, 4, 47, '498', 'रिब्दिकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(499, 4, 47, '499', 'रैनादेवी छहरा गाउँपालिका', NULL, NULL, NULL, NULL),
(500, 3, 48, '500', 'बर्दघाट नगरपालिका', NULL, NULL, NULL, NULL),
(501, 3, 48, '501', 'रामग्राम नगरपालिका', NULL, NULL, NULL, NULL),
(502, 3, 48, '502', 'सुनवल नगरपालिका', NULL, NULL, NULL, NULL),
(503, 4, 48, '503', 'सुस्ता गाउँपालिका', NULL, NULL, NULL, NULL),
(504, 4, 48, '504', 'पाल्हीनन्दन गाउँपालिका', NULL, NULL, NULL, NULL),
(505, 4, 48, '505', 'प्रतापपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(506, 4, 48, '506', 'सरावल गाउँपालिका', NULL, NULL, NULL, NULL),
(507, 2, 49, '507', 'बुटवल उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(508, 3, 49, '508', 'देवदह नगरपालिका', NULL, NULL, NULL, NULL),
(509, 3, 49, '509', 'लुम्बिनी-साँस्कृतिक नगरपालिका', NULL, NULL, NULL, NULL),
(510, 3, 49, '510', 'सैनामैना नगरपालिका', NULL, NULL, NULL, NULL),
(511, 3, 49, '511', 'सिद्धार्थनगर नगरपालिका', NULL, NULL, NULL, NULL),
(512, 3, 49, '512', 'तिलोत्तमा नगरपालिका', NULL, NULL, NULL, NULL),
(513, 4, 49, '513', 'गैडहवा गाउँपालिका', NULL, NULL, NULL, NULL),
(514, 4, 49, '514', 'कञ्चन गाउँपालिका', NULL, NULL, NULL, NULL),
(515, 4, 49, '515', 'कोटहीमाई गाउँपालिका', NULL, NULL, NULL, NULL),
(516, 4, 49, '516', 'मर्चवारी गाउँपालिका', NULL, NULL, NULL, NULL),
(517, 4, 49, '517', 'मायादेवी गाउँपालिका', NULL, NULL, NULL, NULL),
(518, 4, 49, '518', 'ओमसतिया गाउँपालिका', NULL, NULL, NULL, NULL),
(519, 4, 49, '519', 'रोहिणी गाउँपालिका', NULL, NULL, NULL, NULL),
(520, 4, 49, '520', 'सम्मरीमाई गाउँपालिका', NULL, NULL, NULL, NULL),
(521, 4, 49, '521', 'सियारी गाउँपालिका', NULL, NULL, NULL, NULL),
(522, 4, 49, '522', 'सुद्धोदन गाउँपालिका', NULL, NULL, NULL, NULL),
(523, 3, 50, '523', 'कपिलवस्तु नगरपालिका', NULL, NULL, NULL, NULL),
(524, 3, 50, '524', 'बुद्धभूमि नगरपालिका', NULL, NULL, NULL, NULL),
(525, 3, 50, '525', 'शिवराज नगरपालिका', NULL, NULL, NULL, NULL),
(526, 3, 50, '526', 'महाराजगञ्ज नगरपालिका', NULL, NULL, NULL, NULL),
(527, 3, 50, '527', 'कृष्णनगर नगरपालिका', NULL, NULL, NULL, NULL),
(528, 3, 50, '528', 'बाणगङ्गा नगरपालिका', NULL, NULL, NULL, NULL),
(529, 4, 50, '529', 'मायादेवी गाउँपालिका', NULL, NULL, NULL, NULL),
(530, 4, 50, '530', 'यशोधरा गाउँपालिका', NULL, NULL, NULL, NULL),
(531, 4, 50, '531', 'शुद्धोदन गाउँपालिका', NULL, NULL, NULL, NULL),
(532, 4, 50, '532', 'विजयनगर गाउँपालिका', NULL, NULL, NULL, NULL),
(533, 3, 51, '533', 'सन्धिखर्क नगरपालिका', NULL, NULL, NULL, NULL),
(534, 3, 51, '534', 'शितगङ्गा नगरपालिका', NULL, NULL, NULL, NULL),
(535, 3, 51, '535', 'भूमिकास्थान नगरपालिका', NULL, NULL, NULL, NULL),
(536, 4, 51, '536', 'छत्रदेव गाउँपालिका', NULL, NULL, NULL, NULL),
(537, 4, 51, '537', 'पाणिनी गाउँपालिका', NULL, NULL, NULL, NULL),
(538, 4, 51, '538', 'मालारानी गाउँपालिका', NULL, NULL, NULL, NULL),
(539, 3, 52, '539', 'प्युठान नगरपालिका ', NULL, NULL, NULL, NULL),
(540, 3, 52, '540', 'स्वर्गद्वारी नगरपालिका', NULL, NULL, NULL, NULL),
(541, 4, 52, '541', 'गौमुखी गाउँपालिका', NULL, NULL, NULL, NULL),
(542, 4, 52, '542', 'माण्डवी गाउँपालिका', NULL, NULL, NULL, NULL),
(543, 4, 52, '543', 'सरुमारानी गाउँपालिका', NULL, NULL, NULL, NULL),
(544, 4, 52, '544', 'मल्लरानी गाउँपालिका', NULL, NULL, NULL, NULL),
(545, 4, 52, '545', 'नौबहिनी गाउँपालिका', NULL, NULL, NULL, NULL),
(546, 4, 52, '546', 'झिमरुक गाउँपालिका', NULL, NULL, NULL, NULL),
(547, 4, 52, '547', 'ऐरावती गाउँपालिका', NULL, NULL, NULL, NULL),
(548, 3, 53, '548', 'रोल्पा नगरपालिका', NULL, NULL, NULL, NULL),
(549, 4, 53, '549', 'त्रिवेणी गाउँपालिका', NULL, NULL, NULL, NULL),
(550, 4, 53, '550', 'दुईखोली गाउँपालिका', NULL, NULL, NULL, NULL),
(551, 4, 53, '551', 'माडी गाउँपालिका', NULL, NULL, NULL, NULL),
(552, 4, 53, '552', 'रुन्टीगढी गाउँपालिका', NULL, NULL, NULL, NULL),
(553, 4, 53, '553', 'लुङ्ग्री गाउँपालिका', NULL, NULL, NULL, NULL),
(554, 4, 53, '554', 'सुकीदह गाउँपालिका', NULL, NULL, NULL, NULL),
(555, 4, 53, '555', 'सुनछहरी गाउँपालिका', NULL, NULL, NULL, NULL),
(556, 4, 53, '556', 'सुवर्णवती गाउँपालिका', NULL, NULL, NULL, NULL),
(557, 4, 53, '557', 'थवाङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(558, 4, 54, '558', 'पुथाउथरगङ्गा गाउँपालिका', NULL, NULL, NULL, NULL),
(559, 4, 54, '559', 'भूमे गाउँपालिका', NULL, NULL, NULL, NULL),
(560, 4, 54, '560', 'सिस्ने गाउँपालिका', NULL, NULL, NULL, NULL),
(561, 2, 56, '561', 'तुल्सीपुर उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(562, 2, 56, '562', 'घोराही उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(563, 3, 56, '563', 'लमही नगरपालिका', NULL, NULL, NULL, NULL),
(564, 4, 56, '564', 'बङ्गलाचुली गाउँपालिका', NULL, NULL, NULL, NULL),
(565, 4, 56, '565', 'दङ्गीशरण गाउँपालिका', NULL, NULL, NULL, NULL),
(566, 4, 56, '566', 'गढवा गाउँपालिका', NULL, NULL, NULL, NULL),
(567, 4, 56, '567', 'राजपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(568, 4, 56, '568', 'राप्ती गाउँपालिका', NULL, NULL, NULL, NULL),
(569, 4, 56, '569', 'शान्तीनगर गाउँपालिका', NULL, NULL, NULL, NULL),
(570, 4, 56, '570', 'बबई गाउँपालिका', NULL, NULL, NULL, NULL),
(571, 2, 57, '571', 'नेपालगञ्ज उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(572, 3, 57, '572', 'कोहलपुर नगरपालिका', NULL, NULL, NULL, NULL),
(573, 4, 57, '573', 'नरैनापुर गाउँपालिका', NULL, NULL, NULL, NULL),
(574, 4, 57, '574', 'राप्तीसोनारी गाउँपालिका', NULL, NULL, NULL, NULL),
(575, 4, 57, '575', 'बैजनाथ गाउँपालिका', NULL, NULL, NULL, NULL),
(576, 4, 57, '576', 'खजुरा गाउँपालिका', NULL, NULL, NULL, NULL),
(577, 4, 57, '577', 'डुडुवा गाउँपालिका', NULL, NULL, NULL, NULL),
(578, 4, 57, '578', 'जानकी गाउँपालिका', NULL, NULL, NULL, NULL),
(579, 3, 58, '579', 'गुलरिया नगरपालिका', NULL, NULL, NULL, NULL),
(580, 3, 58, '580', 'मधुवन नगरपालिका', NULL, NULL, NULL, NULL),
(581, 3, 58, '581', 'राजापुर नगरपालिका', NULL, NULL, NULL, NULL),
(582, 3, 58, '582', 'ठाकुरबाबा नगरपालिका', NULL, NULL, NULL, NULL),
(583, 3, 58, '583', 'बाँसगढी नगरपालिका', NULL, NULL, NULL, NULL),
(584, 3, 58, '584', 'बारबर्दिया नगरपालिका', NULL, NULL, NULL, NULL),
(585, 4, 58, '585', 'बढैयाताल गाउँपालिका', NULL, NULL, NULL, NULL),
(586, 4, 58, '586', 'गेरुवा गाउँपालिका', NULL, NULL, NULL, NULL),
(587, 3, 55, '587', 'शारदा नगरपालिका', NULL, NULL, NULL, NULL),
(588, 3, 55, '588', 'बाघचौर नगरपालिका', NULL, NULL, NULL, NULL),
(589, 3, 55, '589', 'बनगाड कुपिण्डे नगरपालिका', NULL, NULL, NULL, NULL),
(590, 4, 55, '590', 'कालीमाटी गाउँपालिका', NULL, NULL, NULL, NULL),
(591, 4, 55, '591', 'त्रिवेणी गाउँपालिका', NULL, NULL, NULL, NULL),
(592, 4, 55, '592', 'कपुरकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(593, 4, 55, '593', 'छत्रेश्वरी गाउँपालिका', NULL, NULL, NULL, NULL),
(594, 4, 55, '594', 'ढोरचौर गाउँपालिका', NULL, NULL, NULL, NULL),
(595, 4, 55, '595', 'कुमाख मालिका गाउँपालिका', NULL, NULL, NULL, NULL),
(596, 4, 55, '596', 'दार्मा गाउँपालिका', NULL, NULL, NULL, NULL),
(597, 3, 54, '597', 'मुसीकोट नगरपालिका', NULL, NULL, NULL, NULL),
(598, 3, 54, '598', 'चौरजहारी नगरपालिका', NULL, NULL, NULL, NULL),
(599, 3, 54, '599', 'आठविसकोट नगरपालिका', NULL, NULL, NULL, NULL),
(600, 4, 54, '600', 'बाफिकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(601, 4, 54, '601', 'त्रिवेणी गाउँपालिका', NULL, NULL, NULL, NULL),
(602, 4, 54, '602', 'सानीभेरी गाउँपालिका', NULL, NULL, NULL, NULL),
(603, 3, 59, '603', 'वीरेन्द्रनगर नगरपालिका', NULL, NULL, NULL, NULL),
(604, 3, 59, '604', 'भेरीगङ्गा नगरपालिका', NULL, NULL, NULL, NULL),
(605, 3, 59, '605', 'गुर्भाकोट नगरपालिका', NULL, NULL, NULL, NULL),
(606, 3, 59, '606', 'पञ्चपुरी नगरपालिका', NULL, NULL, NULL, NULL),
(607, 3, 59, '607', 'लेकवेंशी नगरपालिका', NULL, NULL, NULL, NULL),
(608, 4, 59, '608', 'चौकुने गाउँपालिका', NULL, NULL, NULL, NULL),
(609, 4, 59, '609', 'बराहताल गाउँपालिका', NULL, NULL, NULL, NULL),
(610, 4, 59, '610', 'चिंगाड गाउँपालिका', NULL, NULL, NULL, NULL),
(611, 4, 59, '611', 'सिम्ता गाउँपालिका', NULL, NULL, NULL, NULL),
(612, 3, 60, '612', 'नारायण नगरपालिका', NULL, NULL, NULL, NULL),
(613, 3, 60, '613', 'दुल्लु नगरपालिका', NULL, NULL, NULL, NULL),
(614, 3, 60, '614', 'चामुण्डा विन्द्रासैनी नगरपालिका', NULL, NULL, NULL, NULL),
(615, 3, 60, '615', 'आठविस नगरपालिका', NULL, NULL, NULL, NULL),
(616, 4, 60, '616', 'भगवतीमाई गाउँपालिका', NULL, NULL, NULL, NULL),
(617, 4, 60, '617', 'गुराँस गाउँपालिका', NULL, NULL, NULL, NULL),
(618, 4, 60, '618', 'ढुङ्गेश्वर गाउँपालिका', NULL, NULL, NULL, NULL),
(619, 4, 60, '619', 'नौमुले गाउँपालिका', NULL, NULL, NULL, NULL),
(620, 4, 60, '620', 'महाबु गाउँपालिका', NULL, NULL, NULL, NULL),
(621, 4, 60, '621', 'भैरवी गाउँपालिका', NULL, NULL, NULL, NULL),
(622, 4, 60, '622', 'ठाँटीकाँध गाउँपालिका', NULL, NULL, NULL, NULL),
(623, 3, 61, '623', 'भेरी नगरपालिका', NULL, NULL, NULL, NULL),
(624, 3, 61, '624', 'छेडागाड नगरपालिका', NULL, NULL, NULL, NULL),
(625, 3, 61, '625', 'त्रिवेणीगाड नगरपालिका', NULL, NULL, NULL, NULL),
(626, 4, 61, '626', 'कुशे गाउँपालिका', NULL, NULL, NULL, NULL),
(627, 4, 61, '627', 'जुनीचाँदे गाउँपालिका', NULL, NULL, NULL, NULL),
(628, 4, 61, '628', 'बारेकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(629, 4, 61, '629', 'शिवालय गाउँपालिका', NULL, NULL, NULL, NULL),
(630, 3, 62, '630', 'ठूलीभेरी नगरपालिका', NULL, NULL, NULL, NULL),
(631, 3, 62, '631', 'त्रिपुरासुन्दरी नगरपालिका', NULL, NULL, NULL, NULL),
(632, 4, 62, '632', 'डोल्पोबुद्ध गाउँपालिका', NULL, NULL, NULL, NULL),
(633, 4, 62, '633', 'शे-फोक्सुण्डो गाउँपालिका', NULL, NULL, NULL, NULL),
(634, 4, 62, '634', 'जगदुल्ला गाउँपालिका', NULL, NULL, NULL, NULL),
(635, 4, 62, '635', 'मुड्केचुला गाउँपालिका', NULL, NULL, NULL, NULL),
(636, 4, 62, '636', 'काईके गाउँपालिका', NULL, NULL, NULL, NULL),
(637, 4, 62, '637', 'छार्का ताङ्सोङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(638, 3, 63, '638', 'चन्दननाथ नगरपालिका', NULL, NULL, NULL, NULL),
(639, 4, 63, '639', 'कनका सुन्दरी गाउँपालिका', NULL, NULL, NULL, NULL),
(640, 4, 63, '640', 'सिंजा गाउँपालिका', NULL, NULL, NULL, NULL),
(641, 4, 63, '641', 'हिमा गाउँपालिका', NULL, NULL, NULL, NULL),
(642, 4, 63, '642', 'तिला गाउँपालिका', NULL, NULL, NULL, NULL),
(643, 4, 63, '643', 'गुठीचौर गाउँपालिका', NULL, NULL, NULL, NULL),
(644, 4, 63, '644', 'तातोपानी गाउँपालिका', NULL, NULL, NULL, NULL),
(645, 4, 63, '645', 'पातारासी गाउँपालिका', NULL, NULL, NULL, NULL),
(646, 3, 64, '646', 'खाँडाचक्र नगरपालिका', NULL, NULL, NULL, NULL),
(647, 3, 64, '647', 'रासकोट नगरपालिका', NULL, NULL, NULL, NULL),
(648, 3, 64, '648', 'तिलागुफा नगरपालिका', NULL, NULL, NULL, NULL),
(649, 4, 64, '649', 'कचाल झरना गाउँपालिका', NULL, NULL, NULL, NULL),
(650, 4, 64, '650', 'सान्नीत्रिवेणी गाउँपालिका', NULL, NULL, NULL, NULL),
(651, 4, 64, '651', 'नरहरीनाथ गाउँपालिका', NULL, NULL, NULL, NULL),
(652, 4, 64, '652', 'कालिका गाउँपालिका', NULL, NULL, NULL, NULL),
(653, 4, 64, '653', 'महाबै गाउँपालिका', NULL, NULL, NULL, NULL),
(654, 4, 64, '654', 'पलाता गाउँपालिका', NULL, NULL, NULL, NULL),
(655, 3, 65, '655', 'छायानाथ रारा नगरपालिका', NULL, NULL, NULL, NULL),
(656, 4, 65, '656', 'मुगु मकार्मारोंग गाउँपालिका', NULL, NULL, NULL, NULL),
(657, 4, 65, '657', 'सोरु गाउँपालिका', NULL, NULL, NULL, NULL),
(658, 4, 65, '658', 'खत्याड गाउँपालिका', NULL, NULL, NULL, NULL),
(659, 4, 66, '659', 'सिमकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(660, 4, 66, '660', 'नाम्खा गाउँपालिका', NULL, NULL, NULL, NULL),
(661, 4, 66, '661', 'खार्पुनाथ गाउँपालिका', NULL, NULL, NULL, NULL),
(662, 4, 66, '662', 'सर्केगाड गाउँपालिका', NULL, NULL, NULL, NULL),
(663, 4, 66, '663', 'चङ्खेली गाउँपालिका', NULL, NULL, NULL, NULL),
(664, 4, 66, '664', 'अदानचुली गाउँपालिका', NULL, NULL, NULL, NULL),
(665, 4, 66, '665', 'ताँजाकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(666, 3, 67, '666', 'बडीमालिका नगरपालिका', NULL, NULL, NULL, NULL),
(667, 3, 67, '667', 'त्रिवेणी नगरपालिका', NULL, NULL, NULL, NULL),
(668, 3, 67, '668', 'बुढीगङ्गा नगरपालिका', NULL, NULL, NULL, NULL),
(669, 3, 67, '669', 'बुढीनन्दा नगरपालिका', NULL, NULL, NULL, NULL),
(670, 4, 67, '670', 'गौमूल गाउँपालिका', NULL, NULL, NULL, NULL),
(671, 4, 67, '671', 'पाण्डवगुफा गाउँपालिका', NULL, NULL, NULL, NULL),
(672, 4, 67, '672', 'स्वामिकार्तिक गाउँपालिका', NULL, NULL, NULL, NULL),
(673, 4, 67, '673', 'छेडेदह गाउँपालिका', NULL, NULL, NULL, NULL),
(674, 4, 67, '674', 'हिमाली गाउँपालिका', NULL, NULL, NULL, NULL),
(675, 3, 68, '675', 'जयपृथ्वी नगरपालिका', NULL, NULL, NULL, NULL),
(676, 3, 68, '676', 'बुङ्गल नगरपालिका', NULL, NULL, NULL, NULL),
(677, 4, 68, '677', 'तलकोट गाउँपालिका', NULL, NULL, NULL, NULL),
(678, 4, 68, '678', 'मस्टा गाउँपालिका', NULL, NULL, NULL, NULL),
(679, 4, 68, '679', 'खप्तड छात्रा गाउँपालिका', NULL, NULL, NULL, NULL),
(680, 4, 68, '680', 'थलारा गाउँपालिका', NULL, NULL, NULL, NULL),
(681, 4, 68, '681', 'विथ्थडचिर गाउँपालिका', NULL, NULL, NULL, NULL),
(682, 4, 68, '682', 'सुर्मा गाउँपालिका', NULL, NULL, NULL, NULL),
(683, 4, 68, '683', 'छब्बिसपाथीभेरा गाउँपालिका', NULL, NULL, NULL, NULL),
(684, 4, 68, '684', 'दुर्गाथली गाउँपालिका', NULL, NULL, NULL, NULL),
(685, 4, 68, '685', 'केदारस्यूँ गाउँपालिका', NULL, NULL, NULL, NULL),
(686, 4, 68, '686', 'काँडा गाउँपालिका', NULL, NULL, NULL, NULL),
(687, 3, 69, '687', 'मङ्गलसेन नगरपालिका', NULL, NULL, NULL, NULL),
(688, 3, 69, '688', 'कमलवजार नगरपालिका', NULL, NULL, NULL, NULL),
(689, 3, 69, '689', 'साँफेबगर नगरपालिका', NULL, NULL, NULL, NULL),
(690, 3, 69, '690', 'पञ्चदेवल विनायक नगरपालिका', NULL, NULL, NULL, NULL),
(691, 4, 69, '691', 'चौरपाटी गाउँपालिका', NULL, NULL, NULL, NULL),
(692, 4, 69, '692', 'मेल्लेख गाउँपालिका', NULL, NULL, NULL, NULL),
(693, 4, 69, '693', 'बाँन्नीगढी जयगढ गाउँपालिका', NULL, NULL, NULL, NULL),
(694, 4, 69, '694', 'रामारोसन गाउँपालिका', NULL, NULL, NULL, NULL),
(695, 4, 69, '695', 'ढकारी गाउँपालिका', NULL, NULL, NULL, NULL),
(696, 4, 69, '696', 'तुर्माखाँद गाउँपालिका', NULL, NULL, NULL, NULL),
(697, 3, 70, '697', 'दिपायल सिलगढी नगरपालिका', NULL, NULL, NULL, NULL),
(698, 3, 70, '698', 'शिखर नगरपालिका', NULL, NULL, NULL, NULL),
(699, 4, 70, '699', 'पूर्वीचौकी गाउँपालिका', NULL, NULL, NULL, NULL),
(700, 4, 70, '700', 'बढीकेदार गाउँपालिका', NULL, NULL, NULL, NULL),
(701, 4, 70, '701', 'जोरायल गाउँपालिका', NULL, NULL, NULL, NULL),
(702, 4, 70, '702', 'सायल गाउँपालिका', NULL, NULL, NULL, NULL),
(703, 4, 70, '703', 'आदर्श गाउँपालिका', NULL, NULL, NULL, NULL),
(704, 4, 70, '704', 'के.आई.सिङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(705, 4, 70, '705', 'बोगटान गाउँपालिका', NULL, NULL, NULL, NULL),
(706, 2, 71, '706', 'धनगढी उपमहानगरपालिका', NULL, NULL, NULL, NULL),
(707, 3, 71, '707', 'टिकापुर नगरपालिका', NULL, NULL, NULL, NULL),
(708, 3, 71, '708', 'घोडाघोडी नगरपालिका', NULL, NULL, NULL, NULL),
(709, 3, 71, '709', 'लम्कीचुहा नगरपालिका', NULL, NULL, NULL, NULL),
(710, 3, 71, '710', 'भजनी नगरपालिका', NULL, NULL, NULL, NULL),
(711, 3, 71, '711', 'गोदावरी नगरपालिका', NULL, NULL, NULL, NULL),
(712, 3, 71, '712', 'गौरीगङ्गा नगरपालिका', NULL, NULL, NULL, NULL),
(713, 4, 71, '713', 'जानकी गाउँपालिका', NULL, NULL, NULL, NULL),
(714, 4, 71, '714', 'बर्दगोरिया गाउँपालिका', NULL, NULL, NULL, NULL),
(715, 4, 71, '715', 'मोहन्याल गाउँपालिका', NULL, NULL, NULL, NULL),
(716, 4, 71, '716', 'कैलारी गाउँपालिका', NULL, NULL, NULL, NULL),
(717, 4, 71, '717', 'जोशीपुर गाउँपालिका', NULL, NULL, NULL, NULL),
(718, 4, 71, '718', 'चुरे गाउँपालिका', NULL, NULL, NULL, NULL),
(719, 3, 72, '719', 'भिमदत्त नगरपालिका', NULL, NULL, NULL, NULL),
(720, 3, 72, '720', 'पुनर्वास नगरपालिका', NULL, NULL, NULL, NULL),
(721, 3, 72, '721', 'बेदकोट नगरपालिका', NULL, NULL, NULL, NULL),
(722, 3, 72, '722', 'महाकाली नगरपालिका', NULL, NULL, NULL, NULL),
(723, 3, 72, '723', 'शुक्लाफाँटा नगरपालिका', NULL, NULL, NULL, NULL),
(724, 3, 72, '724', 'बेलौरी नगरपालिका', NULL, NULL, NULL, NULL),
(725, 3, 72, '725', 'कृष्णपुर नगरपालिका', NULL, NULL, NULL, NULL),
(726, 4, 72, '726', 'बेलडाँडी गाउँपालिका', NULL, NULL, NULL, NULL),
(727, 4, 72, '727', 'लालझाँडी गाउँपालिका', NULL, NULL, NULL, NULL),
(728, 3, 73, '728', 'अमरगढी नगरपालिका', NULL, NULL, NULL, NULL),
(729, 3, 73, '729', 'परशुराम नगरपालिका', NULL, NULL, NULL, NULL),
(730, 4, 73, '730', 'आलिताल गाउँपालिका', NULL, NULL, NULL, NULL),
(731, 4, 73, '731', 'भागेश्वर गाउँपालिका', NULL, NULL, NULL, NULL),
(732, 4, 73, '732', 'नवदुर्गा गाउँपालिका', NULL, NULL, NULL, NULL),
(733, 4, 73, '733', 'अजयमेरु गाउँपालिका', NULL, NULL, NULL, NULL),
(734, 4, 73, '734', 'गन्यापधुरा गाउँपालिका', NULL, NULL, NULL, NULL),
(735, 3, 74, '735', 'दशरथचन्द नगरपालिका', NULL, NULL, NULL, NULL),
(736, 3, 74, '736', 'पाटन नगरपालिका', NULL, NULL, NULL, NULL),
(737, 3, 74, '737', 'मेलौली नगरपालिका', NULL, NULL, NULL, NULL),
(738, 3, 74, '738', 'पुचौडी नगरपालिका', NULL, NULL, NULL, NULL),
(739, 4, 74, '739', 'सुर्नया गाउँपालिका', NULL, NULL, NULL, NULL),
(740, 4, 74, '740', 'सिगास गाउँपालिका', NULL, NULL, NULL, NULL),
(741, 4, 74, '741', 'शिवनाथ गाउँपालिका', NULL, NULL, NULL, NULL),
(742, 4, 74, '742', 'पञ्चेश्वर गाउँपालिका', NULL, NULL, NULL, NULL),
(743, 4, 74, '743', 'दगेडा केदार गाउँपालिका', NULL, NULL, NULL, NULL),
(744, 4, 74, '744', 'डिलासैनी गाउँपालिका', NULL, NULL, NULL, NULL),
(745, 3, 75, '745', 'महाकाली नगरपालिका', NULL, NULL, NULL, NULL),
(746, 3, 75, '746', 'शैलेश शिखर नगरपालिका', NULL, NULL, NULL, NULL),
(747, 4, 75, '747', 'मालिकार्जुन गाउँपालिका', NULL, NULL, NULL, NULL),
(748, 4, 75, '748', 'अपिहिमाल गाउँपालिका', NULL, NULL, NULL, NULL),
(749, 4, 75, '749', 'दुहुँ गाउँपालिका', NULL, NULL, NULL, NULL),
(750, 4, 75, '750', 'नौगाड गाउँपालिका', NULL, NULL, NULL, NULL),
(751, 4, 75, '751', 'मार्मा गाउँपालिका', NULL, NULL, NULL, NULL),
(752, 4, 75, '752', 'लेकङ्ग गाउँपालिका', NULL, NULL, NULL, NULL),
(753, 4, 75, '753', 'ब्यास गाउँपालिका', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `muni_types`
--

CREATE TABLE `muni_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `muni_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `muni_types`
--

INSERT INTO `muni_types` (`id`, `muni_type_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'महानगरपालिका', NULL, NULL, NULL),
(2, 'उपमहानगरपालिका', NULL, NULL, NULL),
(3, 'नगरपालिका', NULL, NULL, NULL),
(4, 'गाउँपालिका', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `obas`
--

CREATE TABLE `obas` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `oba_types_id` int(10) UNSIGNED NOT NULL,
  `water_type` enum('poor','vulnerable') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_id` int(10) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `months` int(11) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `status_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obas`
--

INSERT INTO `obas` (`id`, `project_id`, `oba_types_id`, `water_type`, `dis_id`, `year`, `months`, `remarks`, `status`, `status_date`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, 31, 2017, 2, 'Repudiandae culpa e', 'submitted', '2021-03-03', '2021-03-03 04:23:50', '2021-03-03 04:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `oba_details`
--

CREATE TABLE `oba_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `obas_id` int(10) UNSIGNED NOT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `casts_id` int(11) NOT NULL,
  `family_size` int(11) NOT NULL,
  `male_count` int(11) NOT NULL,
  `female_count` int(11) NOT NULL,
  `househead_women` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oba_details`
--

INSERT INTO `oba_details` (`id`, `obas_id`, `owner_name`, `casts_id`, `family_size`, `male_count`, `female_count`, `househead_women`, `created_at`, `updated_at`) VALUES
(1, 1, 'Owner 1', 4, 55, 3, 3, 0, '2021-03-03 04:23:50', '2021-03-03 04:23:50'),
(2, 1, 'Owner 2', 5, 70, 99, 81, 0, '2021-03-03 04:23:50', '2021-03-03 04:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `oba_logs`
--

CREATE TABLE `oba_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oba_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_date` date NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oba_logs`
--

INSERT INTO `oba_logs` (`id`, `oba_id`, `user_id`, `status`, `status_date`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'submitted', '2021-03-03', NULL, '2021-03-03 04:23:50', '2021-03-03 04:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `oba_types`
--

CREATE TABLE `oba_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `oba_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'HouseHold Toilet, Free piped connection etc..',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oba_types`
--

INSERT INTO `oba_types` (`id`, `oba_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Household Toilet Facility', NULL, NULL),
(2, 'Free Piped Water Connection', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(10) UNSIGNED NOT NULL,
  `office_type_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `district_id` int(10) UNSIGNED NOT NULL,
  `office_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_types`
--

CREATE TABLE `office_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `office_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `release_date` date NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `project_id`, `payment_date`, `release_date`, `type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, '2021-03-04', '2021-03-25', 'Type 1', '3500.00', '2021-03-03 04:38:54', '2021-03-03 04:38:54'),
(2, 2, '2021-03-19', '2021-03-30', 'Type 2', '123456.00', '2021-03-03 04:39:10', '2021-03-03 04:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `pmos`
--

CREATE TABLE `pmos` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_aggre_date` date NOT NULL,
  `loan_amount` decimal(8,2) NOT NULL,
  `interest_rate` double(8,2) NOT NULL,
  `loan_effective_date` date NOT NULL,
  `loan_closing_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pradeshes`
--

CREATE TABLE `pradeshes` (
  `id` int(10) UNSIGNED NOT NULL,
  `pradesh_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pradeshes`
--

INSERT INTO `pradeshes` (`id`, `pradesh_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pradesh-1', NULL, NULL, NULL),
(2, 'Pradesh-2', NULL, NULL, NULL),
(3, 'Pradesh-3', NULL, NULL, NULL),
(4, 'Pradesh-4', NULL, NULL, NULL),
(5, 'Pradesh-5', NULL, NULL, NULL),
(6, 'Pradesh-6', NULL, NULL, NULL),
(7, 'Pradesh-7', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `program_type_id` int(10) UNSIGNED NOT NULL,
  `program_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_files` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `bramin_f` int(11) NOT NULL,
  `bramin_m` int(11) NOT NULL,
  `dalit_f` int(11) NOT NULL,
  `dalit_m` int(11) NOT NULL,
  `janjati_f` int(11) NOT NULL,
  `janjati_m` int(11) NOT NULL,
  `others_f` int(11) NOT NULL,
  `others_m` int(11) NOT NULL,
  `muslim_f` int(11) NOT NULL,
  `muslim_m` int(11) NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `status_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `project_id`, `program_type_id`, `program_title`, `program_details`, `program_files`, `start_date`, `end_date`, `bramin_f`, `bramin_m`, `dalit_f`, `dalit_m`, `janjati_f`, `janjati_m`, `others_f`, `others_m`, `muslim_f`, `muslim_m`, `status`, `status_date`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 'Program Title 1', 'Alias aute in maxime', NULL, '2021-03-03', '2021-03-17', 8, 46, 85, 96, 94, 86, 39, 72, 6, 30, 'submitted', '2021-03-03', '2021-03-03 04:22:09', '2021-03-03 04:22:09'),
(2, 2, 5, 'Program Title 2', 'Quia est molestiae', NULL, '2021-03-13', '2021-03-26', 48, 78, 17, 51, 78, 35, 50, 92, 6, 6, 'submitted', '2021-03-03', '2021-03-03 04:23:21', '2021-03-03 04:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `program_logs`
--

CREATE TABLE `program_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_date` date NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_logs`
--

INSERT INTO `program_logs` (`id`, `program_id`, `user_id`, `status`, `status_date`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'submitted', '2021-03-03', NULL, '2021-03-03 04:22:09', '2021-03-03 04:22:09'),
(2, 2, 2, 'submitted', '2021-03-03', NULL, '2021-03-03 04:23:21', '2021-03-03 04:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `program_types`
--

CREATE TABLE `program_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_types`
--

INSERT INTO `program_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Training', NULL, NULL),
(2, 'Orientation', NULL, NULL),
(3, 'Consultation', NULL, NULL),
(4, 'Public Awarness', NULL, NULL),
(5, 'Meeting', NULL, NULL),
(6, 'School Wash Program', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `progress_data`
--

CREATE TABLE `progress_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `revision` int(11) NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` decimal(8,2) DEFAULT NULL,
  `progress` decimal(8,2) DEFAULT NULL,
  `financial_progress` decimal(8,2) DEFAULT NULL,
  `approve_rpmo` enum('y','n') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  `approve_rpmo_date` date DEFAULT NULL,
  `approve_rpmo_user_id` int(11) DEFAULT NULL,
  `approve_pmo` enum('y','n') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  `approve_pmo_date` date DEFAULT NULL,
  `approve_pmo_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progress_data`
--

INSERT INTO `progress_data` (`id`, `project_id`, `revision`, `year`, `month`, `target`, `progress`, `financial_progress`, `approve_rpmo`, `approve_rpmo_date`, `approve_rpmo_user_id`, `approve_pmo`, `approve_pmo_date`, `approve_pmo_user_id`, `created_at`, `updated_at`) VALUES
(4, 2, 0, '2021', 'Mar', '122.20', '25.00', '25.00', 'n', NULL, NULL, 'n', NULL, NULL, '2021-03-03 04:38:31', '2021-03-03 04:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `package_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector` enum('water_supply','sanitation','drainage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporting_fy_id` int(10) UNSIGNED NOT NULL,
  `proj_start_fy_id` int(10) UNSIGNED NOT NULL,
  `mou_signing_date` date DEFAULT NULL,
  `contract_amount` decimal(8,2) NOT NULL,
  `ded_approv_date` date NOT NULL,
  `estimated_amount` decimal(8,2) DEFAULT NULL,
  `contract_completion_date` date NOT NULL,
  `latest_eot` date NOT NULL,
  `financial_aggre_date` date DEFAULT NULL,
  `ded_pre_to_comm_date` date DEFAULT NULL,
  `bid_docu_date` date DEFAULT NULL,
  `ifb_pub_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `aprro_contractor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_signing_date` date DEFAULT NULL,
  `completion_date_stage1` date DEFAULT NULL,
  `completion_date_stage2` date DEFAULT NULL,
  `dlp_date` date DEFAULT NULL,
  `pbg_issued_date` date DEFAULT NULL,
  `pbg_expiry_date` date DEFAULT NULL,
  `apg_issued_date` date DEFAULT NULL,
  `apg_expiry_date` date DEFAULT NULL,
  `skilled_manpower` int(11) DEFAULT NULL,
  `unskilled_manpower` int(11) DEFAULT NULL,
  `survey_year` int(11) DEFAULT NULL,
  `survey_total_household` int(11) DEFAULT NULL,
  `survey_total_population` int(11) DEFAULT NULL,
  `survey_family_size` int(11) DEFAULT NULL,
  `base_year` int(11) DEFAULT NULL,
  `base_total_household` int(11) DEFAULT NULL,
  `base_total_population` int(11) DEFAULT NULL,
  `design_year` int(11) DEFAULT NULL,
  `design_total_household` int(11) DEFAULT NULL,
  `design_total_population` int(11) DEFAULT NULL,
  `aff_high_income` int(11) DEFAULT NULL,
  `aff_avg_income` int(11) DEFAULT NULL,
  `aff_low_income` int(11) DEFAULT NULL,
  `aff_bpl_income` int(11) DEFAULT NULL,
  `qc_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qc_plan_submitted` date DEFAULT NULL,
  `qc_calibiration_test` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qc_calibiration_test_submitted` date DEFAULT NULL,
  `qc_third_party` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qc_third_party_submitted` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `region_id`, `package_no`, `name`, `sector`, `reporting_fy_id`, `proj_start_fy_id`, `mou_signing_date`, `contract_amount`, `ded_approv_date`, `estimated_amount`, `contract_completion_date`, `latest_eot`, `financial_aggre_date`, `ded_pre_to_comm_date`, `bid_docu_date`, `ifb_pub_date`, `submission_date`, `aprro_contractor`, `contract_signing_date`, `completion_date_stage1`, `completion_date_stage2`, `dlp_date`, `pbg_issued_date`, `pbg_expiry_date`, `apg_issued_date`, `apg_expiry_date`, `skilled_manpower`, `unskilled_manpower`, `survey_year`, `survey_total_household`, `survey_total_population`, `survey_family_size`, `base_year`, `base_total_household`, `base_total_population`, `design_year`, `design_total_household`, `design_total_population`, `aff_high_income`, `aff_avg_income`, `aff_low_income`, `aff_bpl_income`, `qc_plan`, `qc_plan_submitted`, `qc_calibiration_test`, `qc_calibiration_test_submitted`, `qc_third_party`, `qc_third_party_submitted`, `created_at`, `updated_at`) VALUES
(1, 3, 'package 1', 'Project 1', 'sanitation', 1, 1, '2021-03-03', '34.00', '2021-03-04', '79.00', '2021-03-03', '2021-03-03', '2021-03-02', '2021-03-02', '2021-03-03', '2021-03-03', '2021-03-04', 'Contract Name 1', '2021-03-03', '2021-03-03', '2021-03-03', '2021-03-03', '2021-03-03', '2021-03-03', '2021-03-03', '2021-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-03 03:57:09', '2021-03-03 04:04:32'),
(2, 1, 'Package 2', 'Project 2', 'water_supply', 1, 1, '2021-03-24', '59.00', '2021-03-18', '68.00', '2021-03-26', '2021-03-25', '2021-03-17', '2021-03-23', '2021-03-18', '2021-03-17', '2021-03-25', 'Contarct 2', '2021-03-25', '2021-03-25', '2021-03-26', '2021-03-25', '2021-03-25', '2021-03-25', '2021-03-25', '2021-03-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-03 04:06:44', '2021-03-03 04:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `project_details`
--

CREATE TABLE `project_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `project_type_id` int(10) UNSIGNED NOT NULL,
  `existing_treatment_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposed_treatment_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_year_pvt_connection` int(11) NOT NULL,
  `design_year_pvt_connection` int(11) NOT NULL,
  `base_year_water_demand` int(11) NOT NULL,
  `design_year_water_demand` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_details`
--

INSERT INTO `project_details` (`id`, `project_id`, `project_type_id`, `existing_treatment_detail`, `proposed_treatment_detail`, `base_year_pvt_connection`, `design_year_pvt_connection`, `base_year_water_demand`, `design_year_water_demand`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Omnis porro veniam', 'In quisquam eiusmod', 2016, 2021, 2012, 2012, '2021-03-03 04:04:32', '2021-03-03 04:04:32'),
(2, 2, 3, 'Eos ea nostrud dolo', 'Itaque quas atque do', 1989, 1995, 2017, 1982, '2021-03-03 04:08:41', '2021-03-03 04:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `project_districts`
--

CREATE TABLE `project_districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `district_id` int(10) UNSIGNED NOT NULL,
  `muni_id` int(10) UNSIGNED NOT NULL,
  `ward_no` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_districts`
--

INSERT INTO `project_districts` (`id`, `project_id`, `district_id`, `muni_id`, `ward_no`, `created_at`, `updated_at`) VALUES
(2, 1, 68, 676, 8, '2021-03-03 04:04:32', '2021-03-03 04:04:32'),
(5, 2, 65, 656, 53, '2021-03-03 04:08:41', '2021-03-03 04:08:41'),
(6, 2, 12, 114, 25, '2021-03-03 04:08:41', '2021-03-03 04:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `project_regions`
--

CREATE TABLE `project_regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `region_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_regions`
--

INSERT INTO `project_regions` (`id`, `region_name`, `created_at`, `updated_at`) VALUES
(1, 'Eastern', NULL, NULL),
(2, 'Central', NULL, NULL),
(3, 'Western', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_reservoirs`
--

CREATE TABLE `project_reservoirs` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `reservoir_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_reservoirs` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `reservoir_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservoir_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservoir_lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservoirs_type` enum('overhead','ground') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_reservoirs`
--

INSERT INTO `project_reservoirs` (`id`, `project_id`, `reservoir_name`, `no_of_reservoirs`, `capacity`, `reservoir_location`, `reservoir_lat`, `reservoir_lang`, `reservoirs_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Reservoir 1', 89, 23, '27.7172° N', '85.3240° E', 'Aute quae veritatis', 'ground', '2021-03-03 04:04:32', '2021-03-03 04:04:32'),
(2, 2, 'Reservoir 2', 30, 5, 'Jhapa', '85.3240° E', '85.3240° E', 'ground', '2021-03-03 04:08:41', '2021-03-03 04:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `project_source_details`
--

CREATE TABLE `project_source_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `source_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_lan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposed_intake` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `discharge` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_source_details`
--

INSERT INTO `project_source_details` (`id`, `project_id`, `source_name`, `source_type`, `source_location`, `source_lat`, `source_lan`, `proposed_intake`, `discharge`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 'Source 1', 'Source Type 1', 'Kathmandu', '27.7172° N', '85.3240° E', 'Maxime sed consequat', 'Exercitationem enim', 'Blanditiis nisi quis', '2021-03-03 04:04:32', '2021-03-03 04:04:32'),
(2, 2, 'Source Name 3', 'Source Type 3', 'Jhapa', '85.3240° E', '85.3240° E', 'Incidunt earum rem', 'Commodo nostrum aut', 'Excepteur deserunt a', '2021-03-03 04:08:41', '2021-03-03 04:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `project_structures`
--

CREATE TABLE `project_structures` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `structure_id` int(10) UNSIGNED NOT NULL,
  `estimation` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_types`
--

CREATE TABLE `project_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_sector` enum('water_supply','sanitation','drainage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_types`
--

INSERT INTO `project_types` (`id`, `type_name`, `project_sector`, `created_at`, `updated_at`) VALUES
(1, 'Sanitation 1', 'sanitation', '2021-03-03 04:01:24', '2021-03-03 04:02:17'),
(2, 'Sanitation 2', 'sanitation', '2021-03-03 04:02:02', '2021-03-03 04:02:02'),
(3, 'Water Supply 1', 'water_supply', '2021-03-03 04:02:32', '2021-03-03 04:02:32'),
(4, 'Water Supply 2', 'water_supply', '2021-03-03 04:02:45', '2021-03-03 04:02:45'),
(5, 'Drainage 1', 'drainage', '2021-03-03 04:03:01', '2021-03-03 04:03:01'),
(6, 'Drainage 2', 'drainage', '2021-03-03 04:03:09', '2021-03-03 04:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `qc_test_logs`
--

CREATE TABLE `qc_test_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qc_test_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_date` date NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qc_test_logs`
--

INSERT INTO `qc_test_logs` (`id`, `qc_test_id`, `user_id`, `status`, `status_date`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'submitted', '2021-03-03', NULL, '2021-03-03 04:43:01', '2021-03-03 04:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `quality_controls`
--

CREATE TABLE `quality_controls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `qc_type_id` int(10) UNSIGNED NOT NULL,
  `target` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quality_controls`
--

INSERT INTO `quality_controls` (`id`, `project_id`, `qc_type_id`, `target`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 34, NULL, NULL),
(2, 2, 2, 44, NULL, NULL),
(3, 2, 3, 47, NULL, NULL),
(4, 2, 4, 97, NULL, NULL),
(5, 2, 5, 59, NULL, NULL),
(6, 2, 6, 69, NULL, NULL),
(7, 2, 7, 40, NULL, NULL),
(8, 2, 8, 49, NULL, NULL),
(9, 2, 9, 27, NULL, NULL),
(10, 2, 10, 29, NULL, NULL),
(11, 2, 1, 70, NULL, NULL),
(12, 2, 2, 72, NULL, NULL),
(13, 2, 3, 93, NULL, NULL),
(14, 2, 4, 84, NULL, NULL),
(15, 2, 5, 1, NULL, NULL),
(16, 2, 6, 82, NULL, NULL),
(17, 2, 7, 68, NULL, NULL),
(18, 2, 8, 80, NULL, NULL),
(19, 2, 9, 51, NULL, NULL),
(20, 2, 10, 56, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `q_c_tests`
--

CREATE TABLE `q_c_tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `qc_type_id` int(10) UNSIGNED NOT NULL,
  `followed_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_date` date NOT NULL,
  `test_location` enum('site','lab') COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` enum('y','n') COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result_detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `status_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `q_c_tests`
--

INSERT INTO `q_c_tests` (`id`, `project_id`, `qc_type_id`, `followed_code`, `test_date`, `test_location`, `result`, `test_by`, `result_detail`, `report_file`, `remarks`, `status`, `status_date`, `created_at`, `updated_at`) VALUES
(1, 2, 9, '5', '2021-03-17', 'lab', 'n', 'Demo', 'Aspernatur tenetur q', '[\"1614767281YmV3UI.png\"]', 'Eiusmod quia sint fu', 'submitted', '2021-03-03', '2021-03-03 04:43:01', '2021-03-03 04:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `q_c_types`
--

CREATE TABLE `q_c_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `q_c_types`
--

INSERT INTO `q_c_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'QC1', NULL, NULL),
(2, 'QC2', NULL, NULL),
(3, 'QC3', NULL, NULL),
(4, 'QC4', NULL, NULL),
(5, 'QC5', NULL, NULL),
(6, 'QC6', NULL, NULL),
(7, 'QC7', NULL, NULL),
(8, 'QC8', NULL, NULL),
(9, 'QC9', NULL, NULL),
(10, 'QC10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `safeguards`
--

CREATE TABLE `safeguards` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `ddr_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ddr_date` date NOT NULL,
  `ir_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ir_date` date NOT NULL,
  `ipp_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ipp_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `safeguards`
--

INSERT INTO `safeguards` (`id`, `project_id`, `ddr_status`, `ddr_date`, `ir_status`, `ir_date`, `ipp_status`, `ipp_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Molestiae quaerat au', '2021-03-31', 'Aut est necessitati', '2021-03-31', 'Animi sit fuga Qu', '2021-03-25', '2021-03-03 04:42:16', '2021-03-03 04:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `safeguard_indicators`
--

CREATE TABLE `safeguard_indicators` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `indicator_name` enum('compliances','land_record','third_party') COLLATE utf8mb4_unicode_ci NOT NULL,
  `indicator_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `samitis`
--

CREATE TABLE `samitis` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `samiti_year` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `member_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_cast_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `samitis`
--

INSERT INTO `samitis` (`id`, `project_id`, `samiti_year`, `position_id`, `member_name`, `member_gender`, `member_cast_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1997, 1, 'Graham Guthrie', 'female', '1', '2021-03-03 04:24:13', '2021-03-03 04:24:13'),
(2, 2, 1997, 5, 'Ashton Forbes', 'male', '5', '2021-03-03 04:24:13', '2021-03-03 04:24:13'),
(3, 2, 1997, 5, 'Chase Rich', 'male', '4', '2021-03-03 04:24:13', '2021-03-03 04:24:13'),
(4, 2, 1997, 5, 'Phelan Cleveland', 'female', '2', '2021-03-03 04:24:13', '2021-03-03 04:24:13'),
(5, 2, 1997, 4, 'Ava Herring', 'male', '5', '2021-03-03 04:24:13', '2021-03-03 04:24:13'),
(6, 2, 1997, 5, 'Kirestin Warner', 'male', '1', '2021-03-03 04:24:13', '2021-03-03 04:24:13'),
(7, 2, 1997, 1, 'Kalia Benson', 'female', '5', '2021-03-03 04:24:13', '2021-03-03 04:24:13'),
(8, 2, 1997, 5, 'Kiayada Austin', 'female', '3', '2021-03-03 04:24:13', '2021-03-03 04:24:13'),
(9, 2, 1997, 4, 'Ainsley Casey', 'female', '5', '2021-03-03 04:24:13', '2021-03-03 04:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `structures`
--

CREATE TABLE `structures` (
  `id` int(10) UNSIGNED NOT NULL,
  `sector_name` enum('water_supply','sanitation','drainage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `structure_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `structure_progress`
--

CREATE TABLE `structure_progress` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `structure_id` int(10) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `target` decimal(8,2) NOT NULL,
  `progress` decimal(8,2) NOT NULL,
  `status` enum('submitted','approved','canceled','revision') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `status_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `created_at`, `updated_at`) VALUES
(1, 'Nos', NULL, NULL),
(2, '%', NULL, NULL),
(3, 'Km', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_id` int(10) UNSIGNED NOT NULL,
  `user_group_id` int(10) UNSIGNED NOT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `project_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Project id only required for CSC user group',
  `region_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Region id only required for DSMC user group',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `designation_id`, `user_group_id`, `user_image`, `user_status`, `project_id`, `region_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Young Minds', 'developer@youngminds.com.np', '$2y$10$lfYJc/UDWDebiJkIBGTcG.Qc0ueiZhIr1TwYrSrRjnS49Yq5CaQXC', 1, 1, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'CSE User', 'cse@gmail.com', '$2y$10$ayC9UqDjl0P1mpmtljFdGeS/1XhSH/QhXYlxy9wVFBFbM15CQC9F2', 1, 2, NULL, 'active', 2, NULL, NULL, NULL, '2021-03-03 04:09:03', NULL),
(3, 'DSMC User', 'regional@gmail.com', '$2y$10$Z5s9oh5x73juTfOgGVzFtu/Q78KoPzuDL/b4M8A8EnqbZ8X.V9epm', 1, 3, NULL, 'active', NULL, 2, NULL, NULL, '2021-03-03 04:09:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_details`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', '', NULL, NULL, NULL),
(2, 'CSE User', 'Data entry user', NULL, NULL, NULL),
(3, 'DSMC User', 'dsmc', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_projects`
--

CREATE TABLE `user_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_group_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `allow_view` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `allow_add` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `allow_edit` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `allow_delete` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_group_id`, `menu_id`, `allow_view`, `allow_add`, `allow_edit`, `allow_delete`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '1', '1', '1', NULL, NULL, NULL),
(2, 1, 2, '1', '1', '1', '1', NULL, NULL, NULL),
(3, 1, 3, '1', '1', '1', '1', NULL, NULL, NULL),
(4, 1, 4, '1', '1', '1', '1', NULL, NULL, NULL),
(5, 1, 5, '1', '1', '1', '1', NULL, NULL, NULL),
(6, 1, 6, '1', '1', '1', '1', NULL, NULL, NULL),
(7, 1, 7, '1', '1', '1', '1', NULL, NULL, NULL),
(8, 1, 8, '1', '1', '1', '1', NULL, NULL, NULL),
(9, 1, 9, '1', '1', '1', '1', NULL, NULL, NULL),
(10, 1, 10, '1', '1', '1', '1', NULL, NULL, NULL),
(11, 1, 11, '1', '1', '1', '1', NULL, NULL, NULL),
(12, 1, 12, '1', '1', '1', '1', NULL, NULL, NULL),
(13, 1, 13, '1', '1', '1', '1', NULL, NULL, NULL),
(14, 1, 14, '1', '1', '1', '1', NULL, NULL, NULL),
(15, 1, 15, '1', '1', '1', '1', NULL, NULL, NULL),
(16, 1, 16, '1', '1', '1', '1', NULL, NULL, NULL),
(17, 1, 17, '1', '1', '1', '1', NULL, NULL, NULL),
(18, 1, 18, '1', '1', '1', '1', NULL, NULL, NULL),
(19, 1, 19, '1', '1', '1', '1', NULL, NULL, NULL),
(20, 1, 20, '1', '1', '1', '1', NULL, NULL, NULL),
(21, 1, 21, '1', '1', '1', '1', NULL, NULL, NULL),
(22, 1, 22, '1', '1', '1', '1', NULL, NULL, NULL),
(23, 1, 23, '1', '1', '1', '1', NULL, NULL, NULL),
(24, 1, 24, '1', '1', '1', '1', NULL, NULL, NULL),
(25, 1, 25, '1', '1', '1', '1', NULL, NULL, NULL),
(26, 1, 26, '1', '1', '1', '1', NULL, NULL, NULL),
(27, 1, 27, '1', '1', '1', '1', NULL, NULL, NULL),
(28, 1, 28, '1', '1', '1', '1', NULL, NULL, NULL),
(29, 1, 29, '1', '1', '1', '1', NULL, NULL, NULL),
(30, 1, 30, '1', '1', '1', '1', NULL, NULL, NULL),
(31, 1, 33, '1', '1', '1', '1', NULL, NULL, NULL),
(32, 1, 34, '1', '1', '1', '1', NULL, NULL, NULL),
(33, 1, 35, '1', '1', '1', '1', NULL, NULL, NULL),
(34, 1, 36, '1', '1', '1', '1', NULL, NULL, NULL),
(35, 1, 37, '1', '1', '1', '1', NULL, NULL, NULL),
(36, 1, 38, '1', '1', '1', '1', NULL, NULL, NULL),
(37, 1, 39, '1', '1', '1', '1', NULL, NULL, NULL),
(38, 1, 40, '1', '1', '1', '1', NULL, NULL, NULL),
(39, 1, 41, '1', '1', '1', '1', NULL, NULL, NULL),
(40, 1, 42, '1', '1', '1', '1', NULL, NULL, NULL),
(41, 1, 43, '1', '1', '1', '1', NULL, NULL, NULL),
(42, 1, 44, '1', '1', '1', '1', NULL, NULL, NULL),
(43, 1, 45, '1', '1', '1', '1', NULL, NULL, NULL),
(44, 1, 46, '1', '1', '1', '1', NULL, NULL, NULL),
(45, 1, 47, '1', '1', '1', '1', NULL, NULL, NULL),
(46, 1, 48, '1', '1', '1', '1', NULL, NULL, NULL),
(47, 1, 49, '1', '1', '1', '1', NULL, NULL, NULL),
(48, 1, 50, '1', '1', '1', '1', NULL, NULL, NULL),
(49, 1, 51, '1', '1', '1', '1', NULL, NULL, NULL),
(50, 1, 52, '1', '1', '1', '1', NULL, NULL, NULL),
(51, 2, 1, '0', '0', '0', '0', NULL, NULL, NULL),
(52, 2, 2, '0', '0', '0', '0', NULL, NULL, NULL),
(53, 2, 3, '0', '0', '0', '0', NULL, NULL, NULL),
(54, 2, 4, '0', '0', '0', '0', NULL, NULL, NULL),
(55, 2, 5, '0', '0', '0', '0', NULL, NULL, NULL),
(56, 2, 6, '0', '0', '0', '0', NULL, NULL, NULL),
(57, 2, 7, '0', '0', '0', '0', NULL, NULL, NULL),
(58, 2, 8, '0', '0', '0', '0', NULL, NULL, NULL),
(59, 2, 9, '0', '0', '0', '0', NULL, NULL, NULL),
(60, 2, 10, '0', '0', '0', '0', NULL, NULL, NULL),
(61, 2, 11, '0', '0', '0', '0', NULL, NULL, NULL),
(62, 2, 12, '0', '0', '0', '0', NULL, NULL, NULL),
(63, 2, 13, '0', '0', '0', '0', NULL, NULL, NULL),
(64, 2, 14, '0', '0', '0', '0', NULL, NULL, NULL),
(65, 2, 15, '0', '0', '0', '0', NULL, NULL, NULL),
(66, 2, 16, '0', '0', '0', '0', NULL, NULL, NULL),
(67, 2, 17, '0', '0', '0', '0', NULL, NULL, NULL),
(68, 2, 18, '0', '0', '0', '0', NULL, NULL, NULL),
(69, 2, 19, '0', '0', '0', '0', NULL, NULL, NULL),
(70, 2, 20, '0', '0', '0', '0', NULL, NULL, NULL),
(71, 2, 21, '0', '0', '0', '0', NULL, NULL, NULL),
(72, 2, 22, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:12:23'),
(73, 2, 23, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:12:29'),
(74, 2, 24, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:29'),
(75, 2, 25, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:29'),
(76, 2, 26, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:21:38'),
(77, 2, 27, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:30'),
(78, 2, 28, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:31'),
(79, 2, 29, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:20'),
(80, 2, 30, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:19'),
(81, 2, 31, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:18'),
(82, 2, 32, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:16'),
(83, 2, 33, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:14'),
(84, 2, 34, '0', '0', '0', '0', NULL, NULL, NULL),
(85, 2, 35, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:12'),
(86, 2, 36, '0', '0', '0', '0', NULL, NULL, NULL),
(87, 2, 37, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:09'),
(88, 2, 38, '1', '1', '1', '0', NULL, NULL, '2021-03-03 04:13:10'),
(89, 2, 39, '0', '0', '0', '0', NULL, NULL, NULL),
(90, 2, 40, '0', '0', '0', '0', NULL, NULL, NULL),
(91, 2, 41, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:06'),
(92, 2, 42, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:04'),
(93, 2, 43, '0', '0', '0', '0', NULL, NULL, NULL),
(94, 2, 44, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:03'),
(95, 2, 45, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:01'),
(96, 2, 46, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:00'),
(97, 2, 47, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:28'),
(98, 2, 48, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:13:00'),
(99, 2, 49, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:12:58'),
(100, 2, 50, '0', '0', '0', '0', NULL, NULL, NULL),
(101, 2, 51, '0', '0', '0', '0', NULL, NULL, NULL),
(102, 2, 52, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:12:57'),
(103, 2, 53, '1', '1', '1', '1', NULL, NULL, '2021-03-03 04:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `vos`
--

CREATE TABLE `vos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation_per` double(8,2) NOT NULL,
  `revised_cost_estimated` decimal(8,2) NOT NULL,
  `revised_contract_amount` decimal(8,2) NOT NULL,
  `date` date NOT NULL,
  `variation_amount` decimal(8,2) NOT NULL,
  `approved_date` date NOT NULL,
  `approved_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `worker_details`
--

CREATE TABLE `worker_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `skill_bramin_f` int(11) NOT NULL,
  `skill_bramin_m` int(11) NOT NULL,
  `skill_dalit_f` int(11) NOT NULL,
  `skill_dalit_m` int(11) NOT NULL,
  `skill_janjati_f` int(11) NOT NULL,
  `skill_janjati_m` int(11) NOT NULL,
  `skill_muslim_f` int(11) NOT NULL,
  `skill_muslim_m` int(11) NOT NULL,
  `skill_others_f` int(11) NOT NULL,
  `skill_others_m` int(11) NOT NULL,
  `unskill_bramin_f` int(11) NOT NULL,
  `unskill_bramin_m` int(11) NOT NULL,
  `unskill_dalit_f` int(11) NOT NULL,
  `unskill_dalit_m` int(11) NOT NULL,
  `unskill_janjati_f` int(11) NOT NULL,
  `unskill_janjati_m` int(11) NOT NULL,
  `unskill_muslim_f` int(11) NOT NULL,
  `unskill_muslim_m` int(11) NOT NULL,
  `unskill_others_f` int(11) NOT NULL,
  `unskill_others_m` int(11) NOT NULL,
  `year` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `worker_details`
--

INSERT INTO `worker_details` (`id`, `project_id`, `skill_bramin_f`, `skill_bramin_m`, `skill_dalit_f`, `skill_dalit_m`, `skill_janjati_f`, `skill_janjati_m`, `skill_muslim_f`, `skill_muslim_m`, `skill_others_f`, `skill_others_m`, `unskill_bramin_f`, `unskill_bramin_m`, `unskill_dalit_f`, `unskill_dalit_m`, `unskill_janjati_f`, `unskill_janjati_m`, `unskill_muslim_f`, `unskill_muslim_m`, `unskill_others_f`, `unskill_others_m`, `year`, `month`, `created_at`, `updated_at`) VALUES
(1, 2, 20, 14, 53, 41, 36, 98, 97, 9, 0, 33, 43, 36, 20, 83, 48, 86, 92, 1, 90, 40, '2017', '3', '2021-03-03 04:39:26', '2021-03-03 04:39:26'),
(2, 2, 72, 91, 16, 60, 7, 49, 69, 38, 38, 58, 97, 67, 75, 48, 99, 59, 95, 27, 89, 82, '2017', '2', '2021-03-03 04:39:35', '2021-03-03 04:39:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_log_name_index` (`log_name`);

--
-- Indexes for table `base_lines`
--
ALTER TABLE `base_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `base_lines_project_id_foreign` (`project_id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiaries_project_id_foreign` (`project_id`);

--
-- Indexes for table `beneficiary_logs`
--
ALTER TABLE `beneficiary_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_logs_beneficiary_id_foreign` (`beneficiary_id`),
  ADD KEY `beneficiary_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_pradesh_id_foreign` (`pradesh_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_project_id_foreign` (`project_id`),
  ADD KEY `documents_cat_id_foreign` (`cat_id`),
  ADD KEY `documents_user_id_foreign` (`user_id`);

--
-- Indexes for table `document_catgories`
--
ALTER TABLE `document_catgories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `environmental_monthlies`
--
ALTER TABLE `environmental_monthlies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `environmental_monthly_records`
--
ALTER TABLE `environmental_monthly_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `environmental_monthly_records_project_id_foreign` (`project_id`),
  ADD KEY `environmental_monthly_records_env_group_id_foreign` (`env_group_id`);

--
-- Indexes for table `environments`
--
ALTER TABLE `environments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `environments_project_id_foreign` (`project_id`);

--
-- Indexes for table `eots`
--
ALTER TABLE `eots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eots_project_id_foreign` (`project_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_user_id_foreign` (`user_id`);

--
-- Indexes for table `fiscal_years`
--
ALTER TABLE `fiscal_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grievances`
--
ALTER TABLE `grievances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grievances_project_id_foreign` (`project_id`);

--
-- Indexes for table `grievance_communities`
--
ALTER TABLE `grievance_communities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grievance_communities_project_id_foreign` (`project_id`);

--
-- Indexes for table `institutionals`
--
ALTER TABLE `institutionals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institutionals_project_id_foreign` (`project_id`);

--
-- Indexes for table `institution_logs`
--
ALTER TABLE `institution_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institution_logs_institution_id_foreign` (`institution_id`),
  ADD KEY `institution_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `login_fails`
--
ALTER TABLE `login_fails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitorings`
--
ALTER TABLE `monitorings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monitorings_project_id_foreign` (`project_id`);

--
-- Indexes for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipalities_muni_type_id_foreign` (`muni_type_id`),
  ADD KEY `municipalities_district_id_foreign` (`district_id`);

--
-- Indexes for table `muni_types`
--
ALTER TABLE `muni_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obas`
--
ALTER TABLE `obas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obas_project_id_foreign` (`project_id`),
  ADD KEY `obas_oba_types_id_foreign` (`oba_types_id`),
  ADD KEY `obas_dis_id_foreign` (`dis_id`);

--
-- Indexes for table `oba_details`
--
ALTER TABLE `oba_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oba_details_obas_id_foreign` (`obas_id`);

--
-- Indexes for table `oba_logs`
--
ALTER TABLE `oba_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oba_logs_oba_id_foreign` (`oba_id`),
  ADD KEY `oba_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `oba_types`
--
ALTER TABLE `oba_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offices_office_type_id_foreign` (`office_type_id`),
  ADD KEY `offices_district_id_foreign` (`district_id`);

--
-- Indexes for table `office_types`
--
ALTER TABLE `office_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_project_id_foreign` (`project_id`);

--
-- Indexes for table `pmos`
--
ALTER TABLE `pmos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pradeshes`
--
ALTER TABLE `pradeshes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_project_id_foreign` (`project_id`),
  ADD KEY `programs_program_type_id_foreign` (`program_type_id`);

--
-- Indexes for table `program_logs`
--
ALTER TABLE `program_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_logs_program_id_foreign` (`program_id`),
  ADD KEY `program_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `program_types`
--
ALTER TABLE `program_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress_data`
--
ALTER TABLE `progress_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progress_data_project_id_foreign` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_region_id_foreign` (`region_id`),
  ADD KEY `projects_reporting_fy_id_foreign` (`reporting_fy_id`),
  ADD KEY `projects_proj_start_fy_id_foreign` (`proj_start_fy_id`);

--
-- Indexes for table `project_details`
--
ALTER TABLE `project_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_details_project_id_foreign` (`project_id`),
  ADD KEY `project_details_project_type_id_foreign` (`project_type_id`);

--
-- Indexes for table `project_districts`
--
ALTER TABLE `project_districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_districts_project_id_foreign` (`project_id`),
  ADD KEY `project_districts_district_id_foreign` (`district_id`),
  ADD KEY `project_districts_muni_id_foreign` (`muni_id`);

--
-- Indexes for table `project_regions`
--
ALTER TABLE `project_regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_reservoirs`
--
ALTER TABLE `project_reservoirs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_reservoirs_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_source_details`
--
ALTER TABLE `project_source_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_source_details_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_structures`
--
ALTER TABLE `project_structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_structures_project_id_foreign` (`project_id`),
  ADD KEY `project_structures_structure_id_foreign` (`structure_id`);

--
-- Indexes for table `project_types`
--
ALTER TABLE `project_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qc_test_logs`
--
ALTER TABLE `qc_test_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qc_test_logs_qc_test_id_foreign` (`qc_test_id`),
  ADD KEY `qc_test_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `quality_controls`
--
ALTER TABLE `quality_controls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quality_controls_project_id_foreign` (`project_id`),
  ADD KEY `quality_controls_qc_type_id_foreign` (`qc_type_id`);

--
-- Indexes for table `q_c_tests`
--
ALTER TABLE `q_c_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `q_c_tests_project_id_foreign` (`project_id`),
  ADD KEY `q_c_tests_qc_type_id_foreign` (`qc_type_id`);

--
-- Indexes for table `q_c_types`
--
ALTER TABLE `q_c_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safeguards`
--
ALTER TABLE `safeguards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `safeguards_project_id_foreign` (`project_id`);

--
-- Indexes for table `safeguard_indicators`
--
ALTER TABLE `safeguard_indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `safeguard_indicators_project_id_foreign` (`project_id`);

--
-- Indexes for table `samitis`
--
ALTER TABLE `samitis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `samitis_project_id_foreign` (`project_id`);

--
-- Indexes for table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `structures_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `structure_progress`
--
ALTER TABLE `structure_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `structure_progress_project_id_foreign` (`project_id`),
  ADD KEY `structure_progress_structure_id_foreign` (`structure_id`);

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
  ADD KEY `users_designation_id_foreign` (`designation_id`),
  ADD KEY `users_user_group_id_foreign` (`user_group_id`),
  ADD KEY `users_project_id_foreign` (`project_id`),
  ADD KEY `users_region_id_foreign` (`region_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_projects`
--
ALTER TABLE `user_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_projects_user_id_foreign` (`user_id`),
  ADD KEY `user_projects_project_id_foreign` (`project_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_user_group_id_foreign` (`user_group_id`),
  ADD KEY `user_roles_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `vos`
--
ALTER TABLE `vos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vos_project_id_foreign` (`project_id`);

--
-- Indexes for table `worker_details`
--
ALTER TABLE `worker_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_details_project_id_foreign` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `base_lines`
--
ALTER TABLE `base_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `beneficiary_logs`
--
ALTER TABLE `beneficiary_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_catgories`
--
ALTER TABLE `document_catgories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `environmental_monthlies`
--
ALTER TABLE `environmental_monthlies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `environmental_monthly_records`
--
ALTER TABLE `environmental_monthly_records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `environments`
--
ALTER TABLE `environments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `eots`
--
ALTER TABLE `eots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fiscal_years`
--
ALTER TABLE `fiscal_years`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grievances`
--
ALTER TABLE `grievances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grievance_communities`
--
ALTER TABLE `grievance_communities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institutionals`
--
ALTER TABLE `institutionals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institution_logs`
--
ALTER TABLE `institution_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_fails`
--
ALTER TABLE `login_fails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `monitorings`
--
ALTER TABLE `monitorings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=754;

--
-- AUTO_INCREMENT for table `muni_types`
--
ALTER TABLE `muni_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `obas`
--
ALTER TABLE `obas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oba_details`
--
ALTER TABLE `oba_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oba_logs`
--
ALTER TABLE `oba_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oba_types`
--
ALTER TABLE `oba_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_types`
--
ALTER TABLE `office_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pmos`
--
ALTER TABLE `pmos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pradeshes`
--
ALTER TABLE `pradeshes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `program_logs`
--
ALTER TABLE `program_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `program_types`
--
ALTER TABLE `program_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `progress_data`
--
ALTER TABLE `progress_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_details`
--
ALTER TABLE `project_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_districts`
--
ALTER TABLE `project_districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_regions`
--
ALTER TABLE `project_regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_reservoirs`
--
ALTER TABLE `project_reservoirs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_source_details`
--
ALTER TABLE `project_source_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_structures`
--
ALTER TABLE `project_structures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_types`
--
ALTER TABLE `project_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `qc_test_logs`
--
ALTER TABLE `qc_test_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quality_controls`
--
ALTER TABLE `quality_controls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `q_c_tests`
--
ALTER TABLE `q_c_tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `q_c_types`
--
ALTER TABLE `q_c_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `safeguards`
--
ALTER TABLE `safeguards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `safeguard_indicators`
--
ALTER TABLE `safeguard_indicators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `samitis`
--
ALTER TABLE `samitis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `structure_progress`
--
ALTER TABLE `structure_progress`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_projects`
--
ALTER TABLE `user_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `vos`
--
ALTER TABLE `vos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `worker_details`
--
ALTER TABLE `worker_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `base_lines`
--
ALTER TABLE `base_lines`
  ADD CONSTRAINT `base_lines_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beneficiary_logs`
--
ALTER TABLE `beneficiary_logs`
  ADD CONSTRAINT `beneficiary_logs_beneficiary_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`),
  ADD CONSTRAINT `beneficiary_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_pradesh_id_foreign` FOREIGN KEY (`pradesh_id`) REFERENCES `pradeshes` (`id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `document_catgories` (`id`),
  ADD CONSTRAINT `documents_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `environmental_monthly_records`
--
ALTER TABLE `environmental_monthly_records`
  ADD CONSTRAINT `environmental_monthly_records_env_group_id_foreign` FOREIGN KEY (`env_group_id`) REFERENCES `environmental_monthlies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `environmental_monthly_records_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `environments`
--
ALTER TABLE `environments`
  ADD CONSTRAINT `environments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eots`
--
ALTER TABLE `eots`
  ADD CONSTRAINT `eots_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `grievances`
--
ALTER TABLE `grievances`
  ADD CONSTRAINT `grievances_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grievance_communities`
--
ALTER TABLE `grievance_communities`
  ADD CONSTRAINT `grievance_communities_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `institutionals`
--
ALTER TABLE `institutionals`
  ADD CONSTRAINT `institutionals_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `institution_logs`
--
ALTER TABLE `institution_logs`
  ADD CONSTRAINT `institution_logs_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutionals` (`id`),
  ADD CONSTRAINT `institution_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `monitorings`
--
ALTER TABLE `monitorings`
  ADD CONSTRAINT `monitorings_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD CONSTRAINT `municipalities_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `municipalities_muni_type_id_foreign` FOREIGN KEY (`muni_type_id`) REFERENCES `muni_types` (`id`);

--
-- Constraints for table `obas`
--
ALTER TABLE `obas`
  ADD CONSTRAINT `obas_dis_id_foreign` FOREIGN KEY (`dis_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `obas_oba_types_id_foreign` FOREIGN KEY (`oba_types_id`) REFERENCES `oba_types` (`id`),
  ADD CONSTRAINT `obas_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `oba_details`
--
ALTER TABLE `oba_details`
  ADD CONSTRAINT `oba_details_obas_id_foreign` FOREIGN KEY (`obas_id`) REFERENCES `obas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `oba_logs`
--
ALTER TABLE `oba_logs`
  ADD CONSTRAINT `oba_logs_oba_id_foreign` FOREIGN KEY (`oba_id`) REFERENCES `obas` (`id`),
  ADD CONSTRAINT `oba_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `offices`
--
ALTER TABLE `offices`
  ADD CONSTRAINT `offices_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `offices_office_type_id_foreign` FOREIGN KEY (`office_type_id`) REFERENCES `office_types` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_program_type_id_foreign` FOREIGN KEY (`program_type_id`) REFERENCES `program_types` (`id`),
  ADD CONSTRAINT `programs_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_logs`
--
ALTER TABLE `program_logs`
  ADD CONSTRAINT `program_logs_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`),
  ADD CONSTRAINT `program_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `progress_data`
--
ALTER TABLE `progress_data`
  ADD CONSTRAINT `progress_data_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_proj_start_fy_id_foreign` FOREIGN KEY (`proj_start_fy_id`) REFERENCES `fiscal_years` (`id`),
  ADD CONSTRAINT `projects_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `project_regions` (`id`),
  ADD CONSTRAINT `projects_reporting_fy_id_foreign` FOREIGN KEY (`reporting_fy_id`) REFERENCES `fiscal_years` (`id`);

--
-- Constraints for table `project_details`
--
ALTER TABLE `project_details`
  ADD CONSTRAINT `project_details_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_details_project_type_id_foreign` FOREIGN KEY (`project_type_id`) REFERENCES `project_types` (`id`);

--
-- Constraints for table `project_districts`
--
ALTER TABLE `project_districts`
  ADD CONSTRAINT `project_districts_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `project_districts_muni_id_foreign` FOREIGN KEY (`muni_id`) REFERENCES `municipalities` (`id`),
  ADD CONSTRAINT `project_districts_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_reservoirs`
--
ALTER TABLE `project_reservoirs`
  ADD CONSTRAINT `project_reservoirs_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_source_details`
--
ALTER TABLE `project_source_details`
  ADD CONSTRAINT `project_source_details_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_structures`
--
ALTER TABLE `project_structures`
  ADD CONSTRAINT `project_structures_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_structures_structure_id_foreign` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`);

--
-- Constraints for table `qc_test_logs`
--
ALTER TABLE `qc_test_logs`
  ADD CONSTRAINT `qc_test_logs_qc_test_id_foreign` FOREIGN KEY (`qc_test_id`) REFERENCES `q_c_tests` (`id`),
  ADD CONSTRAINT `qc_test_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `quality_controls`
--
ALTER TABLE `quality_controls`
  ADD CONSTRAINT `quality_controls_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quality_controls_qc_type_id_foreign` FOREIGN KEY (`qc_type_id`) REFERENCES `q_c_types` (`id`);

--
-- Constraints for table `q_c_tests`
--
ALTER TABLE `q_c_tests`
  ADD CONSTRAINT `q_c_tests_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `q_c_tests_qc_type_id_foreign` FOREIGN KEY (`qc_type_id`) REFERENCES `q_c_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `safeguards`
--
ALTER TABLE `safeguards`
  ADD CONSTRAINT `safeguards_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `safeguard_indicators`
--
ALTER TABLE `safeguard_indicators`
  ADD CONSTRAINT `safeguard_indicators_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `samitis`
--
ALTER TABLE `samitis`
  ADD CONSTRAINT `samitis_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `structures`
--
ALTER TABLE `structures`
  ADD CONSTRAINT `structures_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `structure_progress`
--
ALTER TABLE `structure_progress`
  ADD CONSTRAINT `structure_progress_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `structure_progress_structure_id_foreign` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `users_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `project_regions` (`id`),
  ADD CONSTRAINT `users_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_projects`
--
ALTER TABLE `user_projects`
  ADD CONSTRAINT `user_projects_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `user_projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vos`
--
ALTER TABLE `vos`
  ADD CONSTRAINT `vos_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `worker_details`
--
ALTER TABLE `worker_details`
  ADD CONSTRAINT `worker_details_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
