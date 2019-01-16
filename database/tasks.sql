-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2019 at 11:26 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks_list`
--

CREATE TABLE `tasks_list` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks_list`
--

INSERT INTO `tasks_list` (`id`, `title`, `status`, `created`) VALUES
(17, 'testing 5', 'Completed', '2019-01-16 11:30:33'),
(25, 'zxZxZ', 'Remained', '2019-01-16 13:26:05'),
(28, 'testing tasks 2', 'Remained', '2019-01-16 21:55:42'),
(29, 'do the laundry', 'Completed', '2019-01-16 21:56:29'),
(30, 'Finish my app', 'Completed', '2019-01-16 21:56:48'),
(31, 'Take the dog out', 'Completed', '2019-01-16 21:57:07'),
(32, 'test', 'Completed', '2019-01-16 21:57:48'),
(33, 'Wash the car', 'Completed', '2019-01-16 21:58:44'),
(34, 'Buy food', 'Completed', '2019-01-16 22:00:17'),
(35, 'Code review', 'Remained', '2019-01-16 22:00:33'),
(36, 'Debug', 'Completed', '2019-01-16 22:00:50'),
(38, 'tttt', 'Completed', '2019-01-16 22:45:18'),
(39, 'gjgh', 'Remained', '2019-01-16 22:45:24'),
(40, 'chgchjgf', 'Remained', '2019-01-16 22:45:40'),
(41, 'gnvbnvbnv', 'Remained', '2019-01-16 22:45:48'),
(44, 'checking FF', 'Completed', '2019-01-16 23:22:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks_list`
--
ALTER TABLE `tasks_list`
  ADD UNIQUE KEY `"PRIMARY"` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks_list`
--
ALTER TABLE `tasks_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
