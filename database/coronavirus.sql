-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 12:05 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coronavirus`
--

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_country`
--

CREATE TABLE `cvdb_country` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `number_of_patients` int(11) NOT NULL,
  `number_of_death` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_detect`
--

CREATE TABLE `cvdb_detect` (
  `id` int(11) NOT NULL,
  `time` varchar(45) COLLATE utf8_persian_ci NOT NULL COMMENT 'timestamp',
  `user_agent` text COLLATE utf8_persian_ci NOT NULL,
  `ip` int(11) NOT NULL COMMENT 'set for ipv6',
  `content` text COLLATE utf8_persian_ci NOT NULL COMMENT 'detect content'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_login`
--

CREATE TABLE `cvdb_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL COMMENT 'timestamp',
  `user_agent` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_symptom`
--

CREATE TABLE `cvdb_symptom` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '[1 : text answer] [2 : yes or no answer]',
  `impact_percentage` int(11) NOT NULL COMMENT 'Percentage of impact this symptom',
  `updated_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_user`
--

CREATE TABLE `cvdb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL COMMENT 'set for sha1 char len size'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_view`
--

CREATE TABLE `cvdb_view` (
  `id` bigint(20) NOT NULL,
  `time` int(11) NOT NULL COMMENT 'timestamp',
  `user_agent` text COLLATE utf8_persian_ci NOT NULL,
  `ip` varchar(45) COLLATE utf8_persian_ci NOT NULL COMMENT 'set for ipv6',
  `section` varchar(100) COLLATE utf8_persian_ci NOT NULL COMMENT 'view section'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cvdb_country`
--
ALTER TABLE `cvdb_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvdb_detect`
--
ALTER TABLE `cvdb_detect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvdb_login`
--
ALTER TABLE `cvdb_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cvdb_symptom`
--
ALTER TABLE `cvdb_symptom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvdb_user`
--
ALTER TABLE `cvdb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvdb_view`
--
ALTER TABLE `cvdb_view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cvdb_country`
--
ALTER TABLE `cvdb_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvdb_detect`
--
ALTER TABLE `cvdb_detect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvdb_login`
--
ALTER TABLE `cvdb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvdb_symptom`
--
ALTER TABLE `cvdb_symptom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvdb_user`
--
ALTER TABLE `cvdb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvdb_view`
--
ALTER TABLE `cvdb_view`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cvdb_login`
--
ALTER TABLE `cvdb_login`
  ADD CONSTRAINT `cvdb_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cvdb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
