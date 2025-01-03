-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 05:06 AM
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
(4, 8, 18, 'CLEAINING NEEDED', '2024-11-07', 'confirmed'),
(5, 8, 22, 'jjj', '2024-11-28', 'pending'),
(6, 13, 25, 'hljggg', '2024-11-12', 'confirmed'),
(7, 13, 25, 'designing', '2024-12-10', 'confirmed'),
(8, 13, 26, 'lmel', '2024-12-14', 'pending'),
(9, 13, 25, 'this', '2024-12-27', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `feedback_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `name`, `email`, `message`, `feedback_date`) VALUES
(8, 'Fathima', 'fathi@gmail.com', 'wow what a nice website', '2024-11-09'),
(9, 'nazee', 'nazee@gmail.com', 'nice', '2024-12-04');

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
('admin@gmail.com', 'admin123', 2),
('irfan@gmail.com', 'Irfan@123', 0),
('fathiiii@gmail.com', 'Fathima@123', 1),
('safri@gmail.com', 'Safri@123', 1),
('nazeema@gmail.com', 'naze@123', 0),
('ihzan@gmail.com', 'ezan@123', 0),
('adila@gmail.com', 'adila@123', 0);

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
(4, 8, 4, 1000.00, 'done', '2024-10-19 09:55:13'),
(6, 10, 1, 0.00, 'cash', '2024-10-24 16:43:25'),
(7, 10, 1, 0.00, 'done', '2024-10-24 16:44:09'),
(8, 10, 1, 0.00, 'cash', '2024-10-24 16:44:28'),
(9, 13, 6, 1000.00, 'cash', '2024-11-11 04:26:12'),
(10, 13, 6, 1000.00, 'cash', '2024-12-04 13:33:49'),
(11, 13, 7, 500.00, 'done', '2024-12-04 13:38:13');

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
  `category` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `Name`, `phoneno`, `emailid`, `username`, `password`, `category`, `status`) VALUES
(25, 'fathima', '8569656586', 'fathiiii@gmail.com', '', '', 'architect', 'active'),
(26, 'safrin', '123456789', 'safri@gmail.com', 'safrii', 'Safri@123', 'civil engineer', 'active');

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
('irfan', '8563214589', 'irfan@gmail.com', 'irfann', 'Irfan@123', 13),
('nazeema', '9747085787', 'nazeema@gmail.com', 'nazee', 'naze@123', 14),
('ihzan', '9758423644', 'ihzan@gmail.com', 'ezan', 'ezan@123', 15),
('adila', '9853214756', 'adila@gmail.com', 'adila', 'adila@123', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
