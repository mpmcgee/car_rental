-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2020 at 12:26 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `vehicle_id`, `customer_id`, `start_date`, `end_date`) VALUES
(1, 1, 1, '2020-10-25', '2020-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(1, 'Super', 'Admin', 'phpuser', 'phpuser', 1),
(2, 'Jane', 'Doe', 'jdoe', 'password', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `make` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `engine_type` varchar(10) NOT NULL,
  `transmission` varchar(10) NOT NULL,
  `class` varchar(10) NOT NULL,
  `doors` tinyint(4) NOT NULL,
  `line` varchar(20) NOT NULL,
  `passengers` tinyint(4) NOT NULL,
  `suitcases` tinyint(4) NOT NULL,
  `combined_mpg` tinyint(4) NOT NULL,
  `sirius` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `price_per_day` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `year`, `make`, `model`, `engine_type`, `transmission`, `class`, `doors`, `line`, `passengers`, `suitcases`, `combined_mpg`, `sirius`, `price_per_day`) VALUES
(1, 2019, 'Nissan', 'Versa', 'gas', 'automatic', 'car', 4, 'compact', 5, 2, 30, 'yes', '29.99'),
(2, 2020, 'Nissan', 'Versa', 'gas', 'automatic', 'car', 4, 'compact', 5, 2, 30, 'yes', '29.99'),
(3, 2019, 'Nissan', 'Versa', 'gas', 'manual', 'car', 4, 'compact', 5, 2, 30, 'yes', '29.99'),
(4, 2017, 'Ford', 'Focus Electric', 'electric', 'electric', 'car', 4, 'compact', 5, 2, 107, 'yes', '29.99'),
(5, 2020, 'Ford', 'Focus', 'gas', 'automatic', 'car', 4, 'compact', 5, 2, 30, 'yes', '29.99'),
(6, 2019, 'Ford', 'Focus', 'gas', 'automatic', 'car', 4, 'compact', 5, 2, 30, 'yes', '29.99'),
(7, 2020, 'Chevrolet', 'Cruze', 'gas', 'automatic', 'car', 4, 'compact', 5, 2, 33, 'yes', '29.99'),
(8, 2020, 'Chevrolet', 'Cruze', 'gas', 'manual', 'car', 4, 'compact', 5, 2, 33, 'yes', '29.99'),
(9, 2019, 'Chevrolet', 'Cruze', 'gas', 'automatic', 'car', 4, 'compact', 5, 2, 33, 'yes', '29.99'),
(10, 2020, 'Toyota', 'Corolla', 'hybrid', 'hybrid', 'car', 4, 'midsize', 5, 3, 52, 'yes', '39.99'),
(11, 2019, 'Toyoya', 'Corolla', 'gas', 'automatic', 'car', 4, 'midsize', 5, 3, 34, 'yes', '39.99'),
(12, 2020, 'Toyota', 'Corolla', 'gas', 'manual', 'car', 4, 'midsize', 5, 3, 34, 'yes', '39.99'),
(13, 2020, 'Ford', 'Fusion', 'gas', 'automatic', 'car', 4, 'midsize', 5, 3, 25, 'yes', '39.99'),
(14, 2019, 'Ford', 'Fusion', 'gas', 'manual', 'car', 4, 'midsize', 5, 3, 25, 'yes', '39.99'),
(15, 2020, 'Ford', 'Fusion', 'hybrid', 'hybrid', 'car', 4, 'midsize', 5, 3, 42, 'yes', '39.99'),
(16, 2020, 'Chevrolet', 'Malibu', 'gas', 'automatic', 'car', 4, 'midsize', 5, 3, 32, 'yes', '39.99'),
(17, 2019, 'Chevrolet', 'Malibu', 'gas', 'manual', 'car', 4, 'midsize', 5, 3, 32, 'yes', '39.99'),
(18, 2019, 'Chevrolet', 'Malibu', 'hybrid', 'hybrid', 'car', 4, 'midsize', 5, 3, 46, 'yes', '39.99'),
(19, 2020, 'Nissan', 'Altima', 'gas', 'automatic', 'car', 4, 'fullsize', 5, 4, 31, 'yes', '44.99'),
(20, 2019, 'Nissan', 'Altima', 'gas', 'manual', 'car', 4, 'fullsize', 5, 4, 31, 'yes', '44.99'),
(21, 2020, 'Nissan', 'Altima', 'hybrid', 'hybrid', 'car', 4, 'fullsize', 5, 4, 34, 'yes', '44.99'),
(22, 2020, 'Ford', 'Taurus', 'gas', 'automatic', 'car', 4, 'fullsize', 5, 4, 19, 'yes', '44.99'),
(23, 2019, 'Ford', 'Taurus', 'gas', 'manual', 'car', 4, 'fullsize', 5, 4, 19, 'yes', '44.99'),
(24, 2019, 'Ford', 'Taurus', 'gas', 'automatic', 'car', 4, 'fullsize', 5, 4, 19, 'yes', '44.99'),
(25, 2020, 'Chevrolet', 'Impala', 'gas', 'automatic', 'car', 4, 'fullsize', 5, 4, 22, 'yes', '45.99'),
(26, 2020, 'Chevrolet', 'Impala', 'gas', 'automatic', 'car', 4, 'fullsize', 5, 4, 22, 'yes', '45.99'),
(27, 2020, 'Chevrolet', 'Impala', 'gas', 'manual', 'car', 4, 'fullsize', 5, 4, 22, 'yes', '45.99'),
(28, 2020, 'Mercedes-Benz', 'C43 AMG', 'gas', 'automatic', 'car', 4, 'luxury', 5, 3, 22, 'yes', '104.99'),
(29, 2020, 'Mercedes-Benz', 'C43 AMG', 'gas', 'automatic', 'car', 4, 'luxury', 5, 3, 22, 'yes', '104.99'),
(30, 2020, 'Mercedes-Benz', 'C43 AMG', 'gas', 'automatic', 'car', 4, 'luxury', 5, 3, 22, 'yes', '104.99'),
(32, 2019, 'Toyota', 'RAV4', 'gas', 'automatic', 'suv', 5, 'compact', 5, 4, 28, 'yes', '34.99'),
(33, 2020, 'Toyota', 'RAV4', 'gas', 'automatic', 'suv', 4, 'compact', 5, 4, 30, 'yes', '34.99'),
(34, 2020, 'Toyota', 'RAV4', 'hybrid', 'automatic', 'suv', 4, 'compact', 5, 4, 40, 'yes', '34.99'),
(35, 2019, 'Toyota', '4Runner', 'gas', 'automatic', 'suv', 4, 'full', 5, 4, 20, 'yes', '39.99'),
(36, 2020, 'Toyota', '4Runner', 'gas', 'automatic', 'suv', 4, 'full', 5, 4, 18, 'yes', '39.99'),
(37, 2019, 'Subaru', 'Impreza', 'gas', 'automatic', 'car', 4, 'compact', 5, 2, 25, 'yes', '29.99'),
(38, 2020, 'Subaru', 'Impreza', 'gas', 'automatic', 'car', 4, 'compact', 5, 2, 31, 'yes', '29.99'),
(39, 2019, 'Subaru', 'Forester', 'gas', 'automatic', 'suv', 4, 'compact', 5, 4, 29, 'yes', '34.99'),
(40, 2020, 'Subaru', 'Forester', 'gas', 'automatic', 'suv', 4, 'compact', 5, 4, 29, 'yes', '34.99'),
(41, 2020, 'Subaru', 'WRX', 'gas', 'manual', 'car', 4, 'sports', 5, 2, 19, 'yes', '39.99'),
(42, 2019, 'Subaru', 'WRX', 'gas', 'manual', 'car', 4, 'sports', 5, 2, 19, 'yes', '39.99'),
(43, 2019, 'Kia', 'Optima', 'gas', 'automatic', 'car', 4, 'mid', 5, 2, 31, 'yes', '34.99'),
(44, 2020, 'Kia', 'Optima', 'gas', 'automatic', 'car', 4, 'mid', 5, 2, 31, 'yes', '34.99'),
(45, 2020, 'Kia', 'Optima', 'hybrid', 'automatic', 'car', 4, 'mid', 5, 2, 42, 'yes', '34.99'),
(46, 2020, 'Tesla', 'Model S', 'electric', 'automatic', 'car', 4, 'luxury', 5, 2, 118, 'yes', '45.99'),
(47, 2020, 'Tesla', 'Model X', 'electric', 'automatic', 'suv', 4, 'luxury', 5, 4, 95, 'yes', '49.99'),
(48, 2020, 'Tesla', 'Model Y', 'electric', 'automatic', 'suv', 4, 'luxury', 5, 4, 120, 'yes', '49.99'),
(49, 2020, 'Porsche', '911 GT3 RS', 'gas', 'manual', 'car', 2, 'sports', 2, 0, 19, 'no', '69.99'),
(50, 2020, 'McLaren', 'GT', 'gas', 'manual', 'car', 2, 'exotic', 2, 0, 17, 'no', '69.99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`) USING BTREE,
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `customer_id` (`customer_id`) USING BTREE;

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
