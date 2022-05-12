-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2022 at 12:40 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employees`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees_details`
--

CREATE TABLE `employees_details` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact` int(11) UNSIGNED NOT NULL,
  `designation` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees_details`
--

INSERT INTO `employees_details` (`id`, `employee_id`, `employee_name`, `date_of_birth`, `contact`, `designation`, `salary`, `email`, `address`) VALUES
(4, 21, 'Amish', '2022-05-07', 211554, 'SRE', 400, 'amishapanwar123@gmail.com', 'Polytechnic quarters Sanawad'),
(7, 4, 'Ami', '2022-05-08', 7, 'SRE', 4000, 'Amishapanwar123@gmail.com', 'Polytechnic quarters Sanawad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees_details`
--
ALTER TABLE `employees_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees_details`
--
ALTER TABLE `employees_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
