-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2020 at 08:08 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `button_room`
--

CREATE TABLE `button_room` (
  `button_id` int(11) NOT NULL,
  `button_name` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL,
  `isSchedule` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-off , 1-on',
  `isOn` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-off, 1-on',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `button_room`
--

INSERT INTO `button_room` (`button_id`, `button_name`, `room_id`, `isSchedule`, `isOn`, `created_at`) VALUES
(1, 'Light 1', 1, 0, 0, '2020-09-23 00:22:20'),
(2, 'test', 2, 0, 1, '2020-09-23 23:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `dimar_room`
--

CREATE TABLE `dimar_room` (
  `dimar_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `dimar_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-off, 1= 1-speed, 2= 2-speed,3= 3-speed, ',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dimar_room`
--

INSERT INTO `dimar_room` (`dimar_id`, `room_id`, `dimar_name`, `status`, `created_at`) VALUES
(1, 2, '0', 0, '2020-09-23 23:49:05'),
(2, 2, 'test', 0, '2020-09-23 23:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `created_at`) VALUES
(1, 'Bedroom', '2020-09-22 23:28:12'),
(2, 'Living Room', '2020-09-22 23:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `device_type` int(10) DEFAULT NULL,
  `login_type` int(10) NOT NULL DEFAULT '0' COMMENT '0-normal, 1-google , 2-fb , 3-other ',
  `social_id` varchar(255) DEFAULT NULL,
  `user_status` tinyint(4) DEFAULT '1' COMMENT '1-active,  2-de_active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `city`, `mobile`, `password`, `device_token`, `device_type`, `login_type`, `social_id`, `user_status`, `created_at`, `updated_at`) VALUES
(1, 'Rakesh', 'Patel', 'rakeshpatel@gmail.com', 'indore', '8269316557', '202cb962ac59075b964b07152d234b70', NULL, NULL, 0, NULL, 1, '0000-00-00 00:00:00', '2020-09-15 00:00:00'),
(2, 'Rakesh1', 'Patel', 'rakeshpatel0850@gmail.com', NULL, '9131156141', '6c14da109e294d1e8155be8aa4b1ce8e', NULL, NULL, 0, NULL, 1, '2020-09-17 00:00:00', '2020-09-17 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `button_room`
--
ALTER TABLE `button_room`
  ADD PRIMARY KEY (`button_id`);

--
-- Indexes for table `dimar_room`
--
ALTER TABLE `dimar_room`
  ADD PRIMARY KEY (`dimar_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `button_room`
--
ALTER TABLE `button_room`
  MODIFY `button_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dimar_room`
--
ALTER TABLE `dimar_room`
  MODIFY `dimar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
