-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 10:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tailordb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ordes_id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `orders_date` int(30) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ordes_id`, `user_id`, `orders_date`, `total_amount`) VALUES
(1, 19, NULL, 2.00),
(2, 14, NULL, 4500.00),
(3, 19, NULL, 4500.00),
(4, 14, NULL, 3999.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `ordes_id` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `payment_method`, `amount`, `ordes_id`, `user_id`) VALUES
(2, '0000-00-00', 'momo', 1200.00, NULL, NULL),
(3, '0000-00-00', 'aitel', 12003.00, 3, 21),
(4, '0000-00-00', 'cogebank', 800.00, 3, 21),
(7, '0000-00-00', 'equity bank', 2000000.00, 2, 21);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`username`, `email`, `password`, `address`) VALUES
('0780637450', 'nshimyumurw@gmail.com', '`1234df', 'mhjyb'),
('DAVID', 'davira@gmail.com', 'dv12', 'RUBAVU'),
('divine', NULL, NULL, 'kigali'),
('fedel', 'nshimyumurw@gmail.com', 'sss', 'nyaruguru'),
('Mr. Elia', 'niyomukielia10@gmail.com', 'Niyomukiza10@', 'MUHANGA'),
('niyomukiza', 'niyo@gmail.com', 'none', 'RUSIZI'),
('olivier', 'nsengimanaolivier@gmail.com', '12345', 'musenyi'),
('timothy', 'niyonsenga@gmail.com', 'timo', 'nyamasheke');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `quantity_available` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `time_in_stock` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `item_name`, `quantity_available`, `price`, `time_in_stock`, `order_id`, `payment_id`) VALUES
(1, 'rice', 23, 234.00, '2024-04-29 17:52:05', 1, 2),
(2, 'banana', 3, 300.00, '2024-04-15 08:40:40', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `role` varchar(40) DEFAULT NULL,
  `contact` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `role`, `contact`) VALUES
(14, 'chance', 'niyonkuru', 'vise president', 722323234),
(15, 'chance', 'niyonkuru', 'vise president', 722323234),
(16, '', '', '', 0),
(17, '', '', '', 0),
(18, '', '', '', 0),
(19, NULL, NULL, NULL, NULL),
(20, NULL, NULL, NULL, NULL),
(21, '', '', '', 0),
(22, 'ruth', 'abimana', 'suppller', 78987876),
(23, 'kagabe', 'ritha', 'customer', 675432);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ordes_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ordes_id` (`ordes_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `fk_payment_id` (`payment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ordes_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`ordes_id`) REFERENCES `orders` (`ordes_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
