-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 03:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airpeace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `date_created`) VALUES
(1, 'admin@gmail.com', '1', '2024-10-22 21:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `flight_id` varchar(255) NOT NULL,
  `depature_city` varchar(255) NOT NULL,
  `destination_city` varchar(255) NOT NULL,
  `depature_date` date NOT NULL,
  `depature_time` time NOT NULL,
  `amount` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flight_id`, `depature_city`, `destination_city`, `depature_date`, `depature_time`, `amount`, `date_added`) VALUES
('FlightA1347', 'Nasarawa', 'Sokoto', '2024-10-30', '16:30:00', 20000, '2024-10-26 14:31:01'),
('FlightA6020', 'Lafia', 'Warri', '2024-11-01', '17:20:00', 200000, '2024-10-26 12:11:48'),
('FlightA6822', 'Keffi', 'Lagos', '2024-10-30', '03:00:00', 50000, '2024-10-25 10:54:15'),
('FlightA9018', 'Adamawa', 'Kebbi', '2024-10-31', '15:15:00', 50000, '2024-10-26 12:09:47'),
('FlightA9388', 'Maiduguri', 'Kebbi', '2024-10-02', '14:30:00', 100, '2024-10-26 12:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `flight_id` varchar(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `cancelled_by` varchar(30) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `flight_id`, `user_id`, `status`, `cancelled_by`, `date_created`) VALUES
(5, 'FlightA6822', 3, 'Cancelled', 'user', '2024-10-26 06:35:00'),
(6, NULL, 3, 'Cancelled', 'admin', '2024-10-26 06:43:22'),
(7, NULL, 3, 'Confirmed', NULL, '2024-10-26 11:40:05'),
(8, 'FlightA6020', 3, 'Cancelled', 'admin', '2024-10-26 12:12:22'),
(9, 'FlightA9018', 3, 'Cancelled', 'user', '2024-10-26 12:12:30'),
(10, NULL, 7, 'Cancelled', 'user', '2024-10-26 14:15:52'),
(11, 'FlightA6020', 7, 'Cancelled', 'admin', '2024-10-26 14:16:48'),
(12, 'FlightA9018', 7, 'Confirmed', NULL, '2024-10-26 14:16:56'),
(13, 'FlightA9018', 8, 'Confirmed', NULL, '2024-10-26 14:22:30'),
(14, 'FlightA9388', 3, 'Cancelled', 'admin', '2024-10-26 14:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `email`, `password`, `is_active`, `date_created`) VALUES
(1, 'Musa yahaya Gabriel', 'user@gmail.com', '1', 1, '2024-10-22 21:48:49'),
(2, 'Ibrahim Nurudeen Shehu', 'ibrahimnurudeenshehu1447@gmail.com', '1', 1, '2024-10-23 04:16:48'),
(3, 'Jibrin Abdullahi Jibrin', 'jb@gmail.com', '1', 0, '2024-10-23 04:20:28'),
(4, 'Sidi Samaila Agya', 'sidi@gmail.com', '', 1, '2024-10-23 04:22:02'),
(5, 'Umar Musa Allu', 'umar@gmail.com', '1', 0, '2024-10-23 04:23:43'),
(6, 'Ibrahim Nurudeen Shehu', 'ibrahimnurudeenshehu@gmail.com', '1', 1, '2024-10-26 14:12:52'),
(7, 'Muhammad Sagir', 'sagir@gmail.com', '1', 1, '2024-10-26 14:13:17'),
(8, 'suleiman abdulateef suleiman', 'sabdulateef007@gmail.com', '123456789', 1, '2024-10-26 14:21:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `reservation_flight` (`flight_id`),
  ADD KEY `reservation_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_flight` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservation_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
