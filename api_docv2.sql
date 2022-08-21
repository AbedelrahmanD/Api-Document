-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2022 at 11:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_docv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `api_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `api_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_method` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `api_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_header` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_body_type` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `api_body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `api_response` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`api_id`, `project_id`, `api_title`, `api_method`, `api_url`, `api_header`, `api_body_type`, `api_body`, `api_response`) VALUES
(19, 2, 'ok', 'Post', '', '', 'FormData', 'qwqw', 'qwqw'),
(24, 1, 'xrtvyui', 'Post', '', '', 'FormData', 'dcfghj', 'cv00000000000rdtfyguhzzzzzzzzzzzzzzzzzzznjzzzzz'),
(25, 1, 'new', 'Post', 'new', '', 'FormData', '', ''),
(26, 1, 'ok', 'Post', 'aa', 'headr', 'FormData', 'b', 'r'),
(27, 1, 'asdsad555', 'Post', 'sfs', 'sdsd', 'FormData', 'wserdtfyuhio', ''),
(33, 1, 'users400', 'Post', '/user', '', 'FormData', '{\r\n\"name\":\"one\"\r\n}', '{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}{\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n\"status\":\"success\",\r\n\"message:\"welcome\"\r\n}'),
(37, 19, 'one', 'Post', 'one', '', 'FormData', 'one', 'one'),
(39, 0, ' users2', 'Post', ' users2', '', 'FormData', '', ''),
(40, 0, ' users2', 'Post', ' users2', '', 'FormData', '', ' users2'),
(41, 0, 'zz', 'Post', 'zz', '', 'FormData', '', ''),
(42, 1, 'users', 'Post', 'a', '', 'FormData', '', ''),
(44, 3, 'login', 'Post', '192.168.1.170:2001/ap/static/pal_app_api/palm/auth.php', '', 'json', '{\r\n\"username\":\"user1\',\r\n\"password\":\"p123456789\',\r\n}', '{\r\n\"status\":\"success\",\r\n\"user_id\":\"vhcbjsdc34567d8sfu9dsf\"\r\n}\r\n\r\n{\r\n\"status\":\"error\",\r\n\"message\":\"Wrong username or password\"\r\n}'),
(45, 1, 'Barcode', 'Post', '192.168.1.170:2001/ap/static/pal_app_api/barcode_app/barcode.php', '', 'json', '{\r\n\"code\":\"123\"\r\n}', '{\r\n\"status\":\"success\"\r\n}\r\n{\r\n\"status\":\"error\",\r\n\"message\":\"Not Found\" \r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_title`, `project_description`) VALUES
(1, 'masprices', 'desc1'),
(2, 'pda', 'pda1'),
(3, 'palm', ''),
(19, 'palm10', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
