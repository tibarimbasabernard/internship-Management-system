-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 11:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `institution` varchar(45) NOT NULL,
  `regno` varchar(45) NOT NULL,
  `report_data` longblob NOT NULL,
  `marks` int(20) NOT NULL,
  `upload_date` datetime NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `name`, `institution`, `regno`, `report_data`, `marks`, `upload_date`, `remarks`) VALUES
('RPT1345', 'Agaba Eldon ', 'must', '38/j', 0x756e697665727369747920726563632e706466, 50, '2024-07-06 12:08:07', 'good'),
('RPT3844', 'Agaba Eldon ', 'must', 'wsdfg9876/9876', 0x736f6674636f6465732e706466, 70, '2024-07-06 11:39:44', 'tttt'),
('RPT6326', 'Anthony', 'bsu', '38/j', 0x455949542e706466, 100, '2024-07-06 12:04:29', ''),
('RPT7507', 'Agaba Eldon ', 'must', 'wsdfg9876/9876', 0x756e697665727369747920726563632e706466, 0, '2024-07-06 12:11:40', ''),
('RPT8463', 'Agaba Eldon ', 'must', 'wsdfg9876/9876', 0x636f64696e65782e706466, 70, '2024-07-06 11:39:21', ''),
('RPT9684', 'Agaba Eldon ', 'must', '38/j', 0x756e697665727369747920726563632e706466, 0, '2024-07-06 12:08:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `type`) VALUES
(1, 'Agaba Eldon', 'eldon@gmail.com', '0760394618', '1234', 'supervisor'),
(2, 'Agaba Eldon', 'eldon@gmail.com', '0760394618', '098', 'supervisor'),
(3, 'benard', 'eldon@gmail.com', '4567890', '56', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
