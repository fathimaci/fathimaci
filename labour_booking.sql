-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 12:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labour_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `work_description` text NOT NULL,
  `appointment_date` date NOT NULL,
  `status` enum('pending','confirmed','canceled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `staff_id`, `work_description`, `appointment_date`, `status`) VALUES
(1, 10, 17, 'i need some landscaping in my house', '2024-10-22', 'confirmed'),
(2, 8, 18, 'house cleaning', '2024-10-27', 'canceled'),
(4, 8, 18, 'CLEAINING NEEDED', '2024-11-07', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `emailid` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `usertype` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`emailid`, `password`, `usertype`) VALUES
('', 'sapp@123', 0),
('admin@gmail.com', 'admin123', 2),
('fath@gmail.com', 'asdfgh', 0),
('ihzan123@gmail.com', 'ezaan@123', 1),
('irfan@gmail.com', 'irfaan123', 0),
('irfan@gmail.com', 'irfaan@123', 0),
('fasna@gmail.com', 'fasnaa@123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('cash','done') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `appointment_id`, `amount`, `payment_status`, `created_at`) VALUES
(1, 10, 1, 1000.00, 'cash', '2024-10-19 08:36:25'),
(2, 8, 3, 1000.00, 'done', '2024-10-19 09:50:53'),
(3, 8, 3, 1000.00, 'cash', '2024-10-19 09:51:23'),
(4, 8, 4, 1000.00, 'done', '2024-10-19 09:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `emailid` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `Name`, `phoneno`, `emailid`, `username`, `password`, `category`) VALUES
(17, 'ihzan', '1234567891', 'ihzan123@gmail.com', 'ezaan', 'ezaan@123', 'civil engineer'),
(18, 'fasna', '123654789', 'fasna@gmail.com', 'fasnaa', 'fasnaa@123', 'helper');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(30) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `usid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `phone_no`, `email_id`, `username`, `password`, `usid`) VALUES
('trdttd', '4654646', 'jh@gmail.com', 'gygy', 'guygyg', 2),
('anandhu', '2147483647', 'an@gmail.com', 'gfhhtr', 'ytryr@123', 4),
('safna', '696338922', 'sappu@gmail.com', 'sapp', 'sapp@123', 5),
('fathima', '2147481111', 'fath@gmail.com', 'fathima@123', 'asdfgh', 8),
('irfan', '8565452545', 'irfan@gmail.com', 'irfaaan', 'irfaan@123', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
