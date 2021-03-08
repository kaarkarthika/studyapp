-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 07:39 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncert`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_service_log`
--

CREATE TABLE `api_service_log` (
  `autoid` bigint(20) NOT NULL,
  `request_data` text DEFAULT NULL,
  `event_key` varchar(100) DEFAULT NULL,
  `response_data` text DEFAULT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A=Active,I=Inactive',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category_management`
--

CREATE TABLE `category_management` (
  `auto_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chapter_management`
--

CREATE TABLE `chapter_management` (
  `auto_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `chapter_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `auto_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `user_type` enum('A','E') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=Admin, E=Event Manager',
  `city` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `rights` text COLLATE utf8_unicode_ci NOT NULL,
  `status_flag` enum('A','I') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive',
  `user_level` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `support_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `dob`, `user_type`, `city`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`, `rights`, `status_flag`, `user_level`, `mobile_number`, `email_id`, `support_number`, `designation`) VALUES
(1, 'admin', 'Admin', 'Admin', '0000-00-00', 'A', 'chennai', '8nAQquRZCfOFOdOngHc2lEhhJ5brco1t', '$2y$13$04h5Rr1SHyTvNkgGM0ot6OMWvkv9eHRZjVO..ZYRfZvQM3wQHa6tS', NULL, 10, 1459345080, 1459345080, '', 'A', '3', '9876541230', 'admin@gmail.com', '9488606730', 'Manager'),
(2, 'event', 'EVENT', 'Tester', '0000-00-00', 'E', '', '75NdAcA9zIg5wo7vRtKsq-c0nKhEsDab', '$2y$13$y/HXQvm71T/AcqTD0JM5DeLucudwFo6lVT9Ci9xKz6r3HDfPPevLq', NULL, 10, 0, 0, '', 'A', '2', '9876451230', NULL, NULL, 'event manager');

-- --------------------------------------------------------

--
-- Table structure for table `user_management`
--

CREATE TABLE `user_management` (
  `auto_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT 'NULL',
  `address` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_service_log`
--
ALTER TABLE `api_service_log`
  ADD PRIMARY KEY (`autoid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `category_management`
--
ALTER TABLE `category_management`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `chapter_management`
--
ALTER TABLE `chapter_management`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `user_management`
--
ALTER TABLE `user_management`
  ADD PRIMARY KEY (`auto_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_service_log`
--
ALTER TABLE `api_service_log`
  MODIFY `autoid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_management`
--
ALTER TABLE `category_management`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chapter_management`
--
ALTER TABLE `chapter_management`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_management`
--
ALTER TABLE `user_management`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
