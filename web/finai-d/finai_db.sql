-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2020 at 07:33 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finai_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankerdata_db`
--

CREATE TABLE `bankerdata_db` (
  `id` int(20) NOT NULL,
  `admin_username` varchar(20) NOT NULL,
  `broker_username` varchar(20) NOT NULL,
  `broker_email` varchar(60) NOT NULL,
  `broker_age` int(20) NOT NULL,
  `broker_income` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bankerdata_db`
--

INSERT INTO `bankerdata_db` (`id`, `admin_username`, `broker_username`, `broker_email`, `broker_age`, `broker_income`) VALUES
(1, 'garymurphy', 'janedoe', 'janedoe@example.com', 30, '161423'),
(2, 'garymurphy', 'zaidsalman', 'zaidsalman@example.com', 34, '171113'),
(3, 'marybarry', 'jenameza', 'jenameza@example.com', 29, '157800'),
(4, 'marybarry', 'joebloggs', 'joebloggs@example.com', 36, '181500');

-- --------------------------------------------------------

--
-- Table structure for table `banker_db`
--

CREATE TABLE `banker_db` (
  `id` int(20) NOT NULL,
  `admin_username` varchar(20) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banker_db`
--

INSERT INTO `banker_db` (`id`, `admin_username`, `admin_email`, `admin_pwd`) VALUES
(1, 'garymurphy', 'garymurphy@example.com', '$2y$10$QH2658rKGH0S.mp2x.5u1uUFCcC03wJvQFE9a1qGTXdzh2i9i4kZu'),
(2, 'marybarry', 'marybarry@example.com', '$2y$10$vzgpTljbBHqjzLViiGoebe84cCr1dAOVHofCr6OQclc9pHpiePdp.');

-- --------------------------------------------------------

--
-- Table structure for table `broker_db`
--

CREATE TABLE `broker_db` (
  `id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `broker_db`
--

INSERT INTO `broker_db` (`id`, `username`, `user_email`, `user_pwd`) VALUES
(1, 'janedoe', 'janedoe@example.com', '$2y$10$VQDwMtzzlsmOkpAk.GsbLuanSXTIpwj1ndhyNLosxZHLrEVeMju6C'),
(2, 'joebloggs', 'joebloggs@example.com', '$2y$10$WQfReOTE7Vay1zAIBA6mqOZKoaaO.ngcOPOH4HhO91qN2y3NLKAZa'),
(3, 'jenameza', 'jenameza@example.com', '$2y$10$DpPVfjkU6hS0ADmvkew9dOqq/YEYanCyAI5aMovodYv/akIWeBxe.'),
(4, 'zaidsalman', 'zaidsalman@example.com', '$2y$10$IE..tmKhKfvwzQjxzWqtj.cXaTRUAobAulCKbdCRtrxesIh3CmfGS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankerdata_db`
--
ALTER TABLE `bankerdata_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banker_db`
--
ALTER TABLE `banker_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `broker_db`
--
ALTER TABLE `broker_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankerdata_db`
--
ALTER TABLE `bankerdata_db`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banker_db`
--
ALTER TABLE `banker_db`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `broker_db`
--
ALTER TABLE `broker_db`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
